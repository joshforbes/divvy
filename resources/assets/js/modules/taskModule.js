var taskModule = (function() {
    var s;

    function bindUIactions() {

    }


    // binds all of the Pusher event listeners
    function bindPusherEvents() {
        var pusher = new Pusher('bf3b73f9a228dfef0913');
        var channel = pusher.subscribe(divvy.channel);

        channel.bind('taskCompletionChanged', taskProgressChanged);
        channel.bind('updateActivityLog', updateActivityLog);
        channel.bind('subtaskAddedToTask', subtaskAddedToTask);
        channel.bind('subtaskWasDeleted', subtaskWasDeleted);
        channel.bind('subtaskWasModified', subtaskWasModified);
        channel.bind('discussionStartedInTask', discussionStartedInTask);
        channel.bind('discussionWasDeleted', discussionWasDeleted);
        channel.bind('discussionWasModified', discussionWasModified);
        channel.bind('taskModified', taskModified);
        channel.bind('tasWasDeleted', taskWasDeleted);

    }

    // Pusher event listener that replaces the task activity
    // log with an updated version
    function updateActivityLog(data) {
        s.activityLog.html(data.partial);
    }

    // Pusher event listener that replaces the task progress completion
    // percentage with an updated value from the server
    function taskProgressChanged(data) {
        s.completionContainer.html(data.partial);
    }

    // Pusher event listener that adds a new subtask to the subtask
    // container. Because the subtask container is a bootstrap table
    // we have to append the edit modal seperately
    function subtaskAddedToTask(data) {
        var newSubtask = $(data.partial).hide();
        s.subtasks.parent().append($(data.editPartial));

        newSubtask.prependTo(s.subtasks.children('tbody'));
        newSubtask.first().show(500);

        $('.add-subtask-modal').modal('hide');
    }

    // Pusher event listener that removes the specified subtask from the
    // subtask container
    function subtaskWasDeleted(data) {
        var subtask = $(".subtasks__row[data-subtask='" + data.subtaskId + "']");

        subtask.animate({
            height: 0,
            width: 0,
            opacity: 0,
            padding: 0,
            margin: 0
        }, 500, function() {
            subtask.remove();
        })
    }

    // Pusher event listener that replaces the specified subtask with an
    // updated version from the server. Because the subtask is contained in a
    // bootstrap table the edit modal has to be replaced separately.
    function subtaskWasModified(data) {
        var subtask = $(".subtasks__row[data-subtask='" + data.subtaskId + "']");
        var editModal = $("#" + data.subtaskId + "-modal");
        var editForm = editModal.find('.subtask-form');

        editModal.modal('hide');

        subtask.replaceWith(data.partial);

        editForm.parent().html(data.editPartial);
    }

    // Pusher event listener that adds a new discussion to the discussion
    // container. Because the discussion container is a bootstrap table
    // we have to append the edit modal separately
    function discussionStartedInTask(data) {
        var newDiscussion = $(data.partial).hide();
        s.discussions.parent().append($(data.editPartial));

        newDiscussion.prependTo(s.discussions.children('tbody'));
        newDiscussion.first().show(500);

        $('.add-discussion-modal').modal('hide');
    }

    // Pusher event listener that removes the specified discussion from the
    // discussion container
    function discussionWasDeleted(data) {
        var discussion = $(".discussion__row[data-discussion='" + data.discussionId + "']");

        discussion.animate({
            height: 0,
            width: 0,
            opacity: 0,
            padding: 0,
            margin: 0
        }, 500, function() {
            discussion.remove();
        })
    }

    // Pusher event listener that replaces the specified discussion with an
    // updated version from the server. Because the discussion is contained in a
    // bootstrap table the edit modal has to be replaced separately.
    function discussionWasModified(data) {
        var discussion = $(".discussion__row[data-discussion='" + data.discussionId + "']");
        var editModal = $("#" + data.discussionId + "-modal");
        var editForm = editModal.find('.discussion-form');

        editModal.modal('hide');

        discussion.replaceWith(data.partial);

        editForm.parent().html(data.editPartial);
    }

    // Pusher event listener that updates the members list as well as the
    // task title if an admin changes them.
    function taskModified(data) {

        if ( !isTaskMember(data) && !isProjectAdmin() ) {
            $('.header').siblings('.container').html(data.removedPartial);
        }

        s.membersBody.html(data.partial);

        $('.header__title').html(data.taskName);

    }

    // Pusher event listener that responds to the Task being deleted.
    // Replaces the whole task page with data from the server, which
    // provides a link back to the project page
    function taskWasDeleted(data) {
        $('.header').siblings('.container').html(data.partial);
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
            completionContainer: $('.task-progress'),
            activityLog: $('.activity-log'),
            subtasks: $('.subtasks__table'),
            discussions: $('.discussions__table'),
            membersBody: $('.members__body-wrapper')
        },


        init: function() {
            s = this.settings;
            bindUIactions();
            bindPusherEvents();
        }
    }
})();

