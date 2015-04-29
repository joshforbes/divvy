(function() {

    // Quickie PubSub
    var o = $({});
    $.subscribe = function() { o.on.apply(o, arguments) };
    $.publish = function() { o.trigger.apply(o, arguments) };


    // Async submit a form's input.
    var submitLaravelRequest = function(e) {
        var form = $(this);
        var method = form.find('input[name="_method"]').val() || 'POST';

        $.ajax({
            type: method,
            url: form.prop('action'),
            data: form.serialize(),

            success: function() {
                $.publish('ajax.request.success', [form]);
                form[0].reset();
            },
            error: function(data) {
                if (data.status === 500) {
                    document.location.reload(true);
                }

                if (data.status === 401) {
                    document.location.reload(true);
                }

                var errors = $.parseJSON(data.responseText);

                $.each(errors, function(index, value) {
                    $(form).find('.error-container').html('').append(value).append('<br />').removeClass('hide');
                });
            }
        });

        e.preventDefault();
    };


    // Offer flash notification messages.
    // 'data-remote-success-message' => 'Yay. All Done.'
    $.subscribe('ajax.request.success', function(e, form) {
        var message = $(form).data('remote-success-message');

        if (message) {
            $('.flash').html(message).fadeIn(300).delay(2500).fadeOut(300);
        }
    });

    // Handle success callbacks. To trigger Task.foo(), do:
    // 'data-model' => 'Task', 'data-remote-on-success' => 'foo'
    $.subscribe('ajax.request.success', function(e, form) {
        triggerClickCallback.apply(form, [e, $(form).data('remote-on-success')]);
    });


    // Confirm an action before proceeding.
    var confirmAction = function(e) {
        var input = $(this);

        input.prop('disabled', 'disabled');

        // Or, much better, use a dedicated modal.
        if ( ! confirm(input.data('confirm'))) {
            e.preventDefault();
        }

        input.removeAttr('disabled');
    };


    // Trigger the registered callback for a click or form submission.
    var triggerClickCallback = function(e, method, data) {
        var that = $(this);

        // What's the name of the parent model/scope/object.
        if ( ! (model = that.closest('*[data-model]').data('model'))) {
            return;
        }


        // As long as the object and method exist, trigger it and pass through the form.
        if (typeof window[model] == 'object' && typeof window[model][method] == 'function') {
            window[model][method](that);
        } else {
            console.error('Could not call method ' + method + ' on object ' + model);
        }

        e.preventDefault();
    }

    // Dom bindings.
    $('body').on('submit', 'form[data-remote]', submitLaravelRequest);
    $('input[data-confirm], button[data-confirm]').on('click', confirmAction);
    $('*[data-click]').on('click', function(e) {
        triggerClickCallback.apply(this, [e, $(this).data('click')]);
    });

})();
var dashboardModule = (function() {
    var s;

    function showSettings() {
        $(this).next(s.projectSettingsOverlay).hide().removeClass('hide').slideDown(600);
    }

    function hideSettings() {
        $(this).parent(s.projectSettingsOverlay).slideUp(600);
    }

    function bindUIactions() {
        $('body').on('click', '.project-overview__settings-button', showSettings);
        $('body').on('click', '.project-overview__settings-close', hideSettings);
    }


    function bindPusherEvents() {
        var pusher = new Pusher('bf3b73f9a228dfef0913');
        var channel = pusher.subscribe(divvy.channel);

        channel.bind('projectWasRemoved', projectWasRemoved);
        channel.bind('projectWasModified', projectWasModified);
    }

    function projectWasRemoved(data) {
        var project = $(".project-wrapper[data-project='" + data.projectId + "']");

        project.animate({
            height: 0,
            width: 0,
            opacity: 0,
            padding: 0,
            margin: 0
        }, 500, function() {
            project.remove();
        })
    }

    function projectWasModified(data) {
        var project = $(".project-wrapper[data-project='" + data.projectId + "']");

        if ( isProjectMember(data) && project.length == 0) {
            s.projects.prepend(data.partial);
        }

        if ( !isProjectMember(data) && !isProjectAdmin(data) && project.length == 1) {
            project.remove();
        }

        $("#" + data.projectId + "-modal").modal('hide');

        project.replaceWith(data.partial);
    }

    function isProjectAdmin(data) {
        var found = false;

        $.each(data.admins, function(index, value) {
            if (divvy.currentUser == value.username) {
                found = true;
            }
        });

        return found;
    }

    function isProjectMember(data) {
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
            projectSettingsOverlay: $('.project-overview__settings-overlay'),
            projects: $('.projects')
        },

        init: function() {
            s = this.settings;
            bindUIactions();
            bindPusherEvents();
        }
    }
})();


var profileModule = (function() {
    var s;

    function selectFilePrompt() {
        s.avatarInput.click();
    }

    function submitAvatarUpload() {
        s.avatarSubmit.click();
    }

    function bindUIactions() {
        s.avatarUploadButton.on('click', function() {
            selectFilePrompt();
        });
        s.avatarInput.on('change', function() {
            submitAvatarUpload();
            $('body').css({'cursor' : 'wait'});
        });
    }

    return {
        settings: {
            avatarUploadButton: $('.profile-form__avatar-upload'),
            avatarInput: $('#avatar-input'),
            avatarSubmit: $('#avatar-submit')
        },

        init: function() {
            s = this.settings;
            bindUIactions();
        }
    }
})();


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
        var discussion = $(".discussion__row[data-discussion='" + data.discussionId + "']");

        if (discussion.find('.discussion__controls__comments').length > 0) {
            discussion.find('.discussion__controls__comments').replaceWith(data.partial);
        } else {
            discussion.find('.discussion__controls').prepend(data.partial);
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
        var discussion = $(".discussion__row[data-discussion='" + data.discussionId + "']");

        console.log(discussion.find('.discussion__controls__comments-count').html());

        if (discussion.find('.discussion__controls__comments-count').html() > 1) {
            discussion.find('.discussion__controls__comments').replaceWith(data.partial);
        } else {
            discussion.find('.discussion__controls__comments').remove();
        }
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
        }
    }
})();


var notificationModule = (function() {
    var s;

    function showNotificationDropdown() {
        if (s.notificationsWrapper.children().length === 0) {
            s.notificationEmpty.removeClass('hide');
        }
        s.notificationDropdown.css({'display': 'none'}).removeClass('hide').velocity("slideDown", { duration: 500 });
    }

    function closeNotificationDropdown() {
        $('.notification-nav__count-wrapper').html('');
        s.notificationDropdown.velocity("slideUp", { duration: 500 });

        setTimeout(function() {
            s.notificationsWrapper.html('');
            s.notificationEmpty.removeClass('hide');
        }, 600);
    }

    function markAsRead(notificationUrl) {
        $.get(notificationUrl, function() {});
    }

    function bindUIactions() {
        $('body').on('click', '.notification-dropdown__close', closeNotificationDropdown);

        s.notificationLink.on('click', function(e) {
            e.preventDefault();
            showNotificationDropdown();
            markAsRead($(this).attr('href'));
        });

    }

    function bindPusherEvents() {
        var pusher = new Pusher('bf3b73f9a228dfef0913');
        var channel = pusher.subscribe(divvy.userChannel);

        channel.bind('notifyUsers', notifyUsers);
    }

    function notifyUsers(data) {
        s.notificationEmpty.addClass('hide');
        s.notificationsWrapper.prepend(data.notificationPartial);
        $('.notification-nav__count-wrapper').html(data.notificationCountPartial);

    }

    return {
        settings: {
            notificationLink: $('.notification-nav__link'),
            notificationDropdown: $('.notification-dropdown'),
            notificationsWrapper: $('.notification-dropdown__notifications-wrapper'),
            notificationEmpty: $('.notification-dropdown__empty')
        },

        init: function() {
            s = this.settings;
            bindUIactions();
            bindPusherEvents();
        }
    }
})();


var subtaskModule = (function() {
    var s;

    function showSettings() {
        $(this).next(s.projectSettingsOverlay).hide().removeClass('hide').slideDown(600);
    }

    function hideSettings() {
        $(this).parent(s.projectSettingsOverlay).slideUp(600);
    }

    function showCommentForm() {
        s.commentForm.hide().removeClass('hide').slideDown(600);
        s.newCommentButton.slideUp(600);
    }

    function hideCommentForm() {
        $(s.commentForm).slideUp(600);
        s.newCommentButton.slideDown(600);

    }

    function bindUIactions() {
        $('body').on('click', '.comment__settings-button', showSettings);
        $('body').on('click', '.comment__settings-close', hideSettings);
        s.newCommentButton.on('click', showCommentForm);
    }

    function bindPusherEvents() {

    }

    return {
        settings: {
            commentSettingsOverlay: $('.comment__settings-overlay'),
            commentForm: $('.comments__form-wrapper'),
            newCommentButton: $('.comments__new-link')
        },

        init: function() {
            s = this.settings;
            bindUIactions();
            bindPusherEvents();
        }
    }
})();

(function() {
    $.fn.modal.Constructor.prototype.enforceFocus = function() {};

    profileModule.init();
    notificationModule.init();
}());