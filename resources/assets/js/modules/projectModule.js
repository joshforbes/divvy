var projectModule = (function() {
    var s;

    // bind UI actions for the page. Actions are bound to the body instead of the
    // individual element so that if an element is dynamically created through an
    // ajax or Pusher event it won't have to have these actions rebound to it
    function bindUIactions() {
        $('body').on('click', '.task-overview__settings-button', showSettings);
        $('body').on('click', '.task-overview__settings-close', hideSettings);
        $('body').on('click', '.members__settings-button', showMembersSettings);
        $('body').on('click', '.members__settings-close', hideMembersSettings);
    }

    // animate in the Task Overview settings overlay
    function showSettings() {
        $(this).next(s.taskSettingsOverlay).hide().removeClass('hide').slideDown(600);
    }

    // animate out the Task Overview settings overlay
    function hideSettings() {
        $(this).parent(s.taskSettingsOverlay).slideUp(600);
    }

    // animate in the Member Overview settings overlay
    function showMembersSettings() {
        $(this).next(s.membersSettingsOverlay).hide().removeClass('hide').slideDown(600);
    }

    // animate out the Member Overview settings overlay
    function hideMembersSettings() {
        $(this).parent().slideUp(600);
    }

    // binds all of the Pusher event listeners
    function bindPusherEvents() {
        var pusher = new Pusher('bf3b73f9a228dfef0913');
        var channel = pusher.subscribe(divvy.channel);

        channel.bind('taskWasIncomplete', taskWasIncomplete);
        channel.bind('projectCompletionChanged', projectProgressChanged);
        channel.bind('updateActivityLog', updateActivityLog);
        channel.bind('taskWasCompleted', taskWasCompleted);
        channel.bind('taskModified', taskModified);
        channel.bind('memberJoinedProject', memberJoinedProject);
        channel.bind('memberRemovedFromProject', memberRemovedFromProject);
        channel.bind('taskWasDeleted', taskWasDeleted);
        channel.bind('taskAddedToProject', taskAddedToProject);
        channel.bind('projectWasRemoved', projectWasRemoved);
        channel.bind('projectWasModified', projectWasModified);
    }

    // Pusher event listener that adds a new Task to the task container
    // only if the current user is a member of the task or is a project admin
    // also hides the add task modal, and resets the select2 field.
    function taskAddedToProject(data) {
        var newTask = $(data.partial).hide();

        if ( isTaskMember(data) ) {
            newTask.prependTo(s.tasks);
            newTask.first().show(500);
            $('.no-assigned-tasks-message').remove();
        }

        //remove the settings button if not a project admin
        if ( !isProjectAdmin() ) {
            newTask.find('.task-overview__settings-button').remove();
        }

        if ( isProjectAdmin() ) {
            newTask.prependTo(s.tasks);
            newTask.first().show(500);
        }

        $('.add-task-modal').modal('hide');

        $(".task-form__member-select").val('');

        $(".task-form__member-select").select2();
    }

    // Pusher event listener that replaces a completed task with
    // a regular open task partial
    function taskWasIncomplete(data) {
        var task = $(".task-wrapper[data-task='" + data.taskId + "']");

        task.html(data.partial);
    }

    // Pusher event listener that replaces the project progress completion
    // percentage with an updated value from the server
    function projectProgressChanged(data) {
        s.completionContainer.html(data.partial);
    }

    // Pusher event listener that replaces the project activity
    // log with an updated version
    function updateActivityLog(data) {
        s.activityLog.html(data.partial);
    }

    // Pusher event listener that replaces a task overview with the
    // completed version
    function taskWasCompleted(data) {
        var task = $(".task-wrapper[data-task='" + data.taskId + "']");

        task.html(data.partial);
    }

    // Pusher event listener that replaces the specified task with an
    // updated version from the server. If that modification removed the
    // current user from the list of assigned members for that task, then
    // the task is removed from their view.  If the modification added the
    // current user to the members of the task then that task is appended
    // to their tasks container.
    function taskModified(data) {
        var task = $(".task-wrapper[data-task='" + data.taskId + "']");
        var newTask = $(data.partial);

        if ( isTaskMember(data) && task.length == 0) {
            s.tasks.prepend(newTask);
            $('.no-assigned-tasks-message').remove();
        }

        //remove the task if the user is no longer assigned to the task
        if ( !isTaskMember(data) && !isProjectAdmin() && task.length == 1) {
            task.remove();
        }

        $("#" + data.taskId + "-modal").modal('hide');

        task.replaceWith(newTask);

        //remove the settings button if not a project admin
        if ( !isProjectAdmin() ) {
            newTask.find('.task-overview__settings-button').remove();
        }

        $(".task-form__member-select").select2();

    }

    // Pusher event listener that removes the specified task from the
    // task container
    function taskWasDeleted(data) {
        var task = $(".task-wrapper[data-task='" + data.taskId + "']");

        task.animate({
            height: 0,
            width: 0,
            opacity: 0,
            padding: 0,
            margin: 0
        }, 500, function() {
            task.remove();
        })
    }

    // Pusher event listener that responds to the Project being deleted.
    // Replaces the whole project page with data from the server, which
    // provides a link back to the dashboard page
    function projectWasRemoved(data) {
        $('.header').next().html(data.partial);
    }

    // Pusher event listener that replaces the projects title if it is
    // changed
    function projectWasModified(data) {
        $('.header__title').html(data.partial);
    }

    // Pusher event listener that updates the member overview when a member
    // joins the project.  Also adds the new members information to the
    // select field for creating a new task.
    function memberJoinedProject(data) {
        s.membersEditBody.html(data.membersEditPartial);
        s.membersBody.html(data.membersBodyPartial);
        $('.task-form__member-select').append($('<option>', {
            value: data.memberId,
            text: data.memberUsername
        }));

        $(".members-edit__list").select2();
    }

    // Pusher event listener that updates the member overview when a member
    // is removed from the project. Also removes that members info from the
    // select field for creating a new task.
    function memberRemovedFromProject(data) {
        s.membersEditBody.html(data.membersEditPartial);
        s.membersBody.html(data.membersBodyPartial);
        $('.task-form__member-select option[value="' + data.memberId + '"]').remove();
        $(".select2-selection__choice:contains('" + data.memberUsername + "')").remove();
        $(".task-overview__member:contains('" + data.memberUsername + "')").remove();

        $(".members-edit__list").select2();
    }

    // Checks to see if the current user is an admin of the project
    function isProjectAdmin() {
        var found = false;

        $.each(divvy.admins, function(index, value) {
            if (divvy.currentUser == value.username) {
                found = true;
            }
        });

        return found;
    }

    // Checks to see if the current user is a member of the specified task
    function isTaskMember(data) {
        var found = false;

        $.each(data.members, function(index, value) {
            if (divvy.currentUser == value.username) {
                found = true;
            }
        });

        return found;
    }

    return {
        settings: {
            tasks: $('.tasks'),
            completionContainer: $('.task-progress'),
            activityLog: $('.activity-log'),
            taskSettingsOverlay: $('.task-overview__settings-overlay'),
            membersSettingsOverlay: $('.members__settings-overlay'),
            membersEditBody: $('.members-edit-wrapper'),
            membersBody: $('.members__body-wrapper'),
            select2Container: $('.members-edit__list')
        },


        init: function() {
            s = this.settings;
            bindUIactions();
            bindPusherEvents();
        }
    }
})();

