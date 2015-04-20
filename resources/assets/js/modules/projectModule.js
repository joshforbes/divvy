var projectModule = (function() {
    var s;

    function bindUIactions() {
        $('body').on('click', '.task-overview__settings-button', showSettings);
        $('body').on('click', '.task-overview__settings-close', hideSettings);
        $('body').on('click', '.members__settings-button', showMembersSettings);
        $('body').on('click', '.members__settings-close', hideMembersSettings);

    }

    function showSettings() {
        $(this).next(s.taskSettingsOverlay).hide().removeClass('hide').slideDown(600);
    }

    function hideSettings() {
        $(this).parent(s.taskSettingsOverlay).slideUp(600);
    }

    function showMembersSettings() {
        $(this).next(s.membersSettingsOverlay).hide().removeClass('hide').slideDown(600);
    }

    function hideMembersSettings() {
        $(this).parent().slideUp(600);
    }

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

    function taskAddedToProject(data) {
        var newTask = $(data.partial).hide();

        if ( isTaskMember(data) ) {
            newTask.prependTo(s.tasks);
            newTask.first().show(500);
        }

        if ( isProjectAdmin() ) {
            newTask.prependTo(s.tasks);
            newTask.first().show(500);
        }

        $('.add-task-modal').modal('hide');

        $(".task-form__member-select").val('');

        $(".task-form__member-select").select2();
    }

    function taskWasIncomplete(data) {
        var task = $(".task-wrapper[data-task='" + data.taskId + "']");

        task.html(data.partial);
    }

    function projectProgressChanged(data) {
        s.completionContainer.html(data.partial);
    }

    function updateActivityLog(data) {
        s.activityLog.html(data.partial);
    }

    function taskWasCompleted(data) {
        var task = $(".task-wrapper[data-task='" + data.taskId + "']");

        task.html(data.partial);
    }

    function taskModified(data) {
        var task = $(".task-wrapper[data-task='" + data.taskId + "']");

        if ( isTaskMember(data) && task.length == 0) {
            s.tasks.prepend(data.partial);
        }

        if ( !isTaskMember(data) && !isProjectAdmin() && task.length == 1) {
            task.remove();
        }

        $("#" + data.taskId + "-modal").modal('hide');

        task.replaceWith(data.partial);

        $(".task-form__member-select").select2();

    }

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

    function projectWasRemoved(data) {
        $('.header').next().html(data.partial);
    }

    function projectWasModified(data) {
        $('.header__title').html(data.partial);
    }

    function memberJoinedProject(data) {
        s.membersEditBody.html(data.membersEditPartial);
        s.membersBody.html(data.membersBodyPartial);
        $('.task-form__member-select').append($('<option>', {
            value: data.memberId,
            text: data.memberUsername
        }));

        $(".members-edit__list").select2();
    }

    function memberRemovedFromProject(data) {
        s.membersEditBody.html(data.membersEditPartial);
        s.membersBody.html(data.membersBodyPartial);
        $('.task-form__member-select option[value="' + data.memberId + '"]').remove();
        $(".select2-selection__choice:contains('" + data.memberUsername + "')").remove();
        $(".task-overview__member:contains('" + data.memberUsername + "')").remove();

        $(".members-edit__list").select2();
    }

    function isProjectAdmin() {
        var found = false;

        $.each(divvy.admins, function(index, value) {
            if (divvy.currentUser == value.username) {
                found = true;
            }
        });

        return found;
    }

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

