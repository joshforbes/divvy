var taskModule = (function() {
    var s;

    function bindUIactions() {

    }

    function bindPusherEvents() {
        var pusher = new Pusher('bf3b73f9a228dfef0913');
        var channel = pusher.subscribe(divvy.channel);

        channel.bind('taskCompletionChanged', taskProgressChanged);
        channel.bind('updateActivityLog', updateActivityLog);
        channel.bind('subtaskAddedToTask', subtaskAddedToTask);
        channel.bind('subtaskWasDeleted', subtaskWasDeleted);
        channel.bind('subtaskWasModified', subtaskWasModified);

    }

    function updateActivityLog(data) {
        s.activityLog.html(data.partial);
    }

    function taskProgressChanged(data) {
        s.completionContainer.html(data.partial);
    }

    function subtaskAddedToTask(data) {
        var newSubtask = $(data.partial).hide();
        s.subtasks.parent().append($(data.editPartial));

        newSubtask.prependTo(s.subtasks.children('tbody'));
        newSubtask.first().show(500);

        $('.add-subtask-modal').modal('hide');
    }

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

    function subtaskWasModified(data) {
        var subtask = $(".subtasks__row[data-subtask='" + data.subtaskId + "']");
        var editModal = $("#" + data.subtaskId + "-modal");
        var editForm = editModal.find('.subtask-form');

        editModal.modal('hide');

        subtask.replaceWith(data.partial);

        editForm.parent().html(data.editPartial);

    }

    return {
        settings: {
            completionContainer: $('.task-progress'),
            activityLog: $('.activity-log'),
            subtasks: $('.subtasks__table')
        },


        init: function() {
            s = this.settings;
            bindUIactions();
            bindPusherEvents();
        }
    }
})();

