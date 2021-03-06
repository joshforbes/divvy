var subtaskModule = (function() {
    var s;

    // binds all the pusher event listeners
    function bindPusherEvents() {
        var pusher = new Pusher('bf3b73f9a228dfef0913');
        var channel = pusher.subscribe(divvy.channel);

        channel.bind('subtaskWasModified', subtaskWasModified);
        channel.bind('subtaskWasDeleted', subtaskWasDeleted);
        channel.bind('subtaskWasCompleted', subtaskWasCompleted);
        channel.bind('subtaskWasIncomplete', subtaskWasIncomplete);
    }

    // Pusher event listener that replaces the specified discussion with an
    // updated version from the server.
    function subtaskWasModified(data) {
        var subtask = $('.subtask');
        var editModal = s.editModal;
        var editForm = editModal.find('.modal-form');

        editModal.modal('hide');

        subtask.replaceWith(data.partial);

        editForm.parent().html(data.editPartial);
    }

    // Pusher event listener that responds to the Subtask being deleted.
    // Replaces the whole discussion page with data from the server, which
    // provides a link back to the task page
    function subtaskWasDeleted(data) {
        s.header.siblings('.container').html(data.partial);
    }

    // Pusher event listener that replaces the page body with a completed overlay
    // and removes the subtask buttons from the header
    function subtaskWasCompleted(data) {
        s.header.siblings('.container').html(data.partial);
        $('.header__controls').replaceWith(data.headerPartial);
    }

    // Pusher event listener that removes the completed overlay from the page body
    // and adds the subtask controls to the header
    function subtaskWasIncomplete(data) {
        s.header.siblings('.container').html(data.partial);
        $('.header__controls').replaceWith(data.headerPartial);
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
    }

    // Pusher event listener that responds to the Task being deleted.
    // Replaces the whole task page with data from the server, which
    // provides a link back to the project page
    function taskWasDeleted(data) {
        $('.header').siblings('.container').html(data.partial);
    }

    return {
        settings: {
            subtask: $('.subtask'),
            editModal: $('.edit-subtask-modal'),
            header: $('.header')
        },

        init: function() {
            s = this.settings;
            bindPusherEvents();
            bindPusherProjectEvents();
            bindPusherTaskEvents();
        }
    }
})();