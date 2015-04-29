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
        channel.bind('projectWasModified', projectWasModified);
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

    function projectWasModified(data) {
        var project = $(".project-wrapper[data-project='" + data.projectId + "']");

        if ( isProjectMember(data) && project.length == 0) {
            s.projects.prepend(data.partial);
        }

        if ( !isProjectMember(data) && !isProjectAdmin(data) && project.length == 1) {
            project.remove();
        }

        $("#" + data.projectId + "-modal").modal('hide');

        project.replaceWith(data.partial);
    }

    function isProjectAdmin(data) {
        var found = false;

        $.each(data.admins, function(index, value) {
            if (divvy.currentUser == value.username) {
                found = true;
            }
        });

        return found;
    }

    function isProjectMember(data) {
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
            projectSettingsOverlay: $('.project-overview__settings-overlay'),
            projects: $('.projects')
        },

        init: function() {
            s = this.settings;
            bindUIactions();
            bindPusherEvents();
        }
    }
})();

