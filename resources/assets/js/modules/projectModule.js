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

