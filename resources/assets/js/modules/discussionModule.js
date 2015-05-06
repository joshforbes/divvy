var discussionModule = (function() {
    var s;

    // binds the pusher event listeners
    function bindPusherEvents() {
        var pusher = new Pusher('bf3b73f9a228dfef0913');
        var channel = pusher.subscribe(divvy.channel);

        channel.bind('discussionWasModified', discussionWasModified);
        channel.bind('discussionWasDeleted', discussionWasDeleted);
    }

    // Pusher event listener that replaces the specified discussion with an
    // updated version from the server.
    function discussionWasModified(data) {
        var discussion = $('.discussion');
        var editModal = s.editModal;
        var editForm = editModal.find('.modal-form');

        editModal.modal('hide');

        discussion.replaceWith(data.partial);

        editForm.parent().html(data.editPartial);
    }

    // Pusher event listener that responds to the Discussion being deleted.
    // Replaces the whole discussion page with data from the server, which
    // provides a link back to the task page
    function discussionWasDeleted(data) {
        $('.header').siblings('.container').html(data.partial);
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

    //bind Pusher events that are fired at the task level
    function bindPusherTaskEvents() {
        var pusher = new Pusher('bf3b73f9a228dfef0913');
        var channel = pusher.subscribe(divvy.taskChannel);

        channel.bind('taskWasDeleted', taskWasDeleted);
        channel.bind('taskWasCompleted', taskWasCompleted);
    }

    // Pusher event listener that responds to the Task being deleted.
    // Replaces the whole task page with data from the server, which
    // provides a link back to the project page
    function taskWasDeleted(data) {
        $('.header').siblings('.container').html(data.partial);
    }

    // Pusher event listener that responds to the Task being completed.
    // Replaces the discussion body with a completed-overlay and removes
    // buttons from the header
    function taskWasCompleted(data) {
        $('.header').siblings('.container').html(data.partial);
        $('.header__controls').remove();
    }

    return {
        settings: {
            discussion: $('.discussion'),
            editModal: $('.edit-discussion-modal')

        },

        init: function() {
            s = this.settings;
            bindPusherEvents();
            bindPusherProjectEvents();
            bindPusherTaskEvents();
        }
    }
})();