var projectModule = (function() {
    var s;

    function bindUIactions() {
        $('body').on('click', '.task-overview__settings-button', showSettings);

        $('body').on('click', '.task-overview__settings-close', hideSettings);

        $('body').on('click', '.members__settings-button', showMembersSettings);

        $('body').on('click', '.members__settings-close', hideMembersSettings);

        s.select2Container.select2();
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
        var channel = pusher.subscribe('p11');

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
        s.tasks.prepend(data.partial);
        $('.add-task-modal').modal('hide');

        $(".task-form__member-select").select2();
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

    function taskModified(data) {
        var task = $("form[action*='task/" + data.taskId + "']").parents('.task-wrapper');
        $("#" + data.taskId + "-modal").modal('hide');

        task.html(data.partial);
    }

    function taskWasDeleted(data) {
        var task = $("form[action*='task/" + data.taskId + "']").parents('.task-wrapper');
        task.remove();
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

