
(function() {
    var pusher = new Pusher('bf3b73f9a228dfef0913');
    var channel = pusher.subscribe('p7');
    channel.bind('taskWasIncomplete', function(data) {

        var task = $('form').filter(function() {
            if ( $(this).prop('action').indexOf('/task/' + data.taskId + '/incomplete') >= 0) {
                return $(this).parents('.task-wrapper');
            }
        });

        task.parent().html(data.partial);
    });

    profileModule.init();
    projectModule.init();
}());