var taskModule = (function() {
    var s;
    var showingCompleted = 0;

    function bindUIactions() {
        $('body').on('click', '.subtasks__more-link', showCompletedSubtasks);
    }

    function showCompletedSubtasks(e) {
        var completedSubtasks = $('.subtasks__row--completed');

        e.preventDefault();
        if ( completedSubtasks.hasClass('hide') ) {
            completedSubtasks.removeClass('hide');
            showingCompleted = 1;
            s.completedSubtasksButton.children('a').html('- Hide Completed -');
        } else {
            completedSubtasks.addClass('hide').appendTo($('.subtasks__table'));
            showingCompleted = 0;
            s.completedSubtasksButton.children('a').html('- See Completed -');
        }
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
        channel.bind('subtaskWasCompleted', subtaskWasCompleted);
        channel.bind('subtaskWasIncomplete', subtaskWasIncomplete)
        channel.bind('discussionStartedInTask', discussionStartedInTask);
        channel.bind('discussionWasDeleted', discussionWasDeleted);
        channel.bind('discussionWasModified', discussionWasModified);
        channel.bind('taskModified', taskModified);
        channel.bind('taskWasDeleted', taskWasDeleted);
        channel.bind('taskWasCompleted', taskWasCompleted);
        channel.bind('commentWasLeftOnSubtask', commentWasLeftOnSubtask);
        channel.bind('commentWasLeftOnDiscussion', commentWasLeftOnDiscussion);
        channel.bind('commentWasDeletedOnSubtask', commentWasDeletedOnSubtask);
        channel.bind('commentWasDeletedOnDiscussion', commentWasDeletedOnDiscussion);
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

    // Pusher event listener that replaces a subtask overview with the
    // completed version
    function subtaskWasCompleted(data) {
        var subtask = $(".subtasks__row[data-subtask='" + data.subtaskId + "']");
        var completedSubtask = $(data.partial);

        completedSubtask.removeClass('hide');

        subtask.replaceWith(completedSubtask);

        // if the subtask container is not showing completed subtasks
        // then we want to show the subtask as complete and then slowly
        // fade it out.  Once faded it will be appended to the bottom of
        // the completed subtasks for viewing when the user is showing
        // completed.  We perform one final check at the end of the animation
        // just to make sure the user didn't decide to show complete during the
        // process. If they have we will make sure the completed subtask isn't hidden
        if (showingCompleted === 0) {
            completedSubtask.delay(4000).fadeOut(2000, function() {
                s.completedSubtasksButton.removeClass('hide');
                completedSubtask
                    .addClass('hide')
                    .appendTo($('.subtasks__table'))
                    .show();
                if (showingCompleted === 1 ) {
                    completedSubtask.removeClass('hide');
                }
            });
        } else {
            s.completedSubtasksButton.removeClass('hide');
        }

    }

    // Pusher event listener that replaces a completed subtask with
    // a regular open task partial
    function subtaskWasIncomplete(data) {
        var subtask = $(".subtasks__row[data-subtask='" + data.subtaskId + "']");
        var incompleteSubtask = $(data.partial);

        subtask.replaceWith(incompleteSubtask);
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
        var discussion = $(".discussions__row[data-discussion='" + data.discussionId + "']");

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
        var discussion = $(".discussions__row[data-discussion='" + data.discussionId + "']");
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

    // Pusher event listener that responds to a Task being completed.
    // Replaces the page body with a completed overlay and removes
    // the header controls
    function taskWasCompleted(data) {
        $('.header').siblings('.container').html(data.partial);
        $('.header__button').remove();
    }

    // Pusher event listener that responds to a Comment being left on
    // a subtask. Replaces the comments overview indicator
    function commentWasLeftOnSubtask(data) {
        var subtask = $(".subtasks__row[data-subtask='" + data.subtaskId + "']");

        if (subtask.find('.subtasks__controls__comments').length > 0) {
            subtask.find('.subtasks__controls__comments').replaceWith(data.partial);
        } else {
            subtask.find('.subtasks__controls').prepend(data.partial);
        }
    }

    // Pusher event listener that responds to a Comment being left on
    // a discussion. Replaces the comments overview indicator
    function commentWasLeftOnDiscussion(data) {
        var discussion = $(".discussions__row[data-discussion='" + data.discussionId + "']");

        if (discussion.find('.discussions__controls__comments').length > 0) {
            discussion.find('.discussions__controls__comments').replaceWith(data.partial);
        } else {
            discussion.find('.discussions__controls').prepend(data.partial);
        }
    }

    // Pusher event listener that responds to a Comment being deleted on
    // a subtask. Replaces the comments overview indicator or removes it
    function commentWasDeletedOnSubtask(data) {
        var subtask = $(".subtasks__row[data-subtask='" + data.subtaskId + "']");

        if (subtask.find('.subtasks__controls__comments-count').html() > 1) {
            subtask.find('.subtasks__controls__comments').replaceWith(data.partial);
        } else {
            subtask.find('.subtasks__controls__comments').remove();
        }
    }

    // Pusher event listener that responds to a Comment being deleted on
    // a discussion. Replaces the comments overview indicator or removes it
    function commentWasDeletedOnDiscussion(data) {
        var discussion = $(".discussions__row[data-discussion='" + data.discussionId + "']");

        console.log(discussion.find('.discussions__controls__comments-count').html());

        if (discussion.find('.discussions__controls__comments-count').html() > 1) {
            discussion.find('.discussions__controls__comments').replaceWith(data.partial);
        } else {
            discussion.find('.discussions__controls__comments').remove();
        }
    }

    //bind Pusher events that are fired at the project level
    function bindPusherProjectEvents() {
        var pusher = new Pusher('bf3b73f9a228dfef0913');
        var channel = pusher.subscribe(divvy.projectChannel);

        channel.bind('projectWasRemoved', projectWasRemoved);
    }

    // Pusher event listener that responds to the Project being deleted.
    // Replaces the whole project page with data from the server, which
    // provides a link back to the dashboard page
    function projectWasRemoved(data) {
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
            membersBody: $('.members__body-wrapper'),
            completedSubtasksButton: $('.subtasks__more-link'),
            completedSubtasks: $('.subtasks__row--completed')
        },


        init: function() {
            s = this.settings;
            bindUIactions();
            bindPusherEvents();
            bindPusherProjectEvents();
        }
    }
})();

