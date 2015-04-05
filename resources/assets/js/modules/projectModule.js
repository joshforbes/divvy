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
        $('body').on('click', '.task-overview__settings-button', function() {
            showSettings(this);
        });
        $('body').on('click', '.task-overview__settings-close', function() {
            hideSettings(this);
        })
    }

    function showSettings(that) {
        $(that).siblings(s.settingsOverlay).removeClass('hide');
    }

    function hideSettings(that) {
        $(that).parent(s.settingsOverlay).addClass('hide');
    }

    function bindPusherEvents() {
        var pusher = new Pusher('bf3b73f9a228dfef0913');
        var channel = pusher.subscribe('p7');

        channel.bind('taskWasIncomplete', taskWasIncomplete);
        channel.bind('projectCompletionChanged', projectProgressChanged);
        channel.bind('updateActivityLog', updateActivityLog);
        channel.bind('taskWasCompleted', taskWasCompleted);
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

    function taskWasCompleted(data) {
        var task = $("form[action*='task/" + data.taskId + "/complete']").parents('.task-wrapper');

        task.html(data.partial);
    }

    return {
        settings: {
            tasks: $('.tasks'),
            completionContainer: $('.task-progress'),
            activityLog: $('.activity-log'),
            settingsButton: $('.task-overview__settings-button'),
            settingsOverlay: $('.task-overview__settings-overlay'),
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

