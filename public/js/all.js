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
                var errors = $.parseJSON(data.responseText);

                $.each(errors, function(index, value) {
                    $(form).find('.error-container').append(value).append('<br />').removeClass('hide');
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

    return {
        settings: {
            projectSettingsOverlay: $('.project-overview__settings-overlay'),
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
        });
    }

    return {
        settings: {
            avatarUploadButton: $('.avatar-upload-button'),
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

    function memberJoinedProject(data) {
        s.membersEditBody.html(data.membersEditPartial);
        s.membersBody.html(data.membersBodyPartial);

        $(".members-edit__list").select2();
    }

    function memberRemovedFromProject(data) {
        s.membersEditBody.html(data.membersEditPartial);
        s.membersBody.html(data.membersBodyPartial);

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



(function() {
    $.fn.modal.Constructor.prototype.enforceFocus = function() {};

    profileModule.init();
    notificationModule.init();
}());