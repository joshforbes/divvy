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

