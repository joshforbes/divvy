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
    })


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
    $('form[data-remote]').on('submit', submitLaravelRequest);
    $('input[data-confirm], button[data-confirm]').on('click', confirmAction);
    $('*[data-click]').on('click', function(e) {
        triggerClickCallback.apply(this, [e, $(this).data('click')]);
    });

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

    function clearSelectBox() {
        var selectedText = s.selectBoxSelected.text();
        s.selectBoxOption.filter(function () {
            return $(this).html() == selectedText;
        }).remove();
        s.selectBoxSelected.html('');
    }

    function bindUIactions() {
    }

    function bindPusherEvents() {
        var pusher = new Pusher('bf3b73f9a228dfef0913');
        var channel = pusher.subscribe('p7');

        channel.bind('taskWasIncomplete', taskWasIncomplete);
        channel.bind('projectCompletionChanged', projectProgressChanged);
        channel.bind('updateActivityLog', updateActivityLog);
    }

    function taskWasIncomplete(data) {
        var task = $("form[action*='task/" + data.taskId + "/incomplete']").parents('.task-wrapper');

        task.html(data.partial);
    }

    function projectProgressChanged(data) {
        s.completionContainer.html(data.partial);
    }

    function updateActivityLog(data) {
        s.activityLog.html(data.partial);
    }


    return {
        settings: {
            tasks: $('.tasks'),
            completionContainer: $('.task-progress'),
            activityLog: $('.activity-log'),
            selectBoxSelected: $('.select2-selection__rendered'),
            selectBoxOption: $('.js-user-list option')
        },

        addUser: function() {
            clearSelectBox();
        },

        init: function() {
            s = this.settings;
            bindUIactions();
            bindPusherEvents();
        }
    }
})();



(function() {
    //var pusher = new Pusher('bf3b73f9a228dfef0913');
    //var channel = pusher.subscribe('p7');
    //channel.bind('taskWasIncomplete', function(data) {
    //
    //    var task = $("form[action*='task/" + data.taskId + "/incomplete']").parent();
    //
    //    task.html(data.partial);
    //
    //});

    profileModule.init();
    projectModule.init();
}());