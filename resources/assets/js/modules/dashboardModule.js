var dashboardModule = (function() {
    var s;

    // show and animate the project settings overlay
    function showSettings() {
        $(this).next(s.projectSettingsOverlay).hide().removeClass('hide').slideDown(600);
    }

    // hide and animate the project settings overlay
    function hideSettings() {
        $(this).parent(s.projectSettingsOverlay).slideUp(600);
    }

    // bind any UI actions. Note that if an action is bound through the body
    // that means it needs to be applied to a dynamic element that may be added
    // through ajax or pusher.
    function bindUIactions() {
        $('body').on('click', '.project-overview__settings-button', showSettings);
        $('body').on('click', '.project-overview__settings-close', hideSettings);
    }

    // binds the pusher event listeners
    function bindPusherEvents() {
        var pusher = new Pusher('bf3b73f9a228dfef0913');
        var channel = pusher.subscribe(divvy.channel);

        channel.bind('projectWasRemoved', projectWasRemoved);
        channel.bind('projectWasModified', projectWasModified);
    }

    // Pusher event listener that removes the specified project
    // from the projects container
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

    // Pusher event listener that replaces the specified project with an
    // updated version from the server.
    function projectWasModified(data) {
        var project = $(".project-wrapper[data-project='" + data.projectId + "']");

        // if the edit action added the user to the project, append it
        if ( isProjectMember(data) && project.length == 0) {
            s.projects.prepend(data.partial);
        }

        // if the edit action removed the user from the project and they are not
        // a project admin, remove it
        if ( !isProjectMember(data) && !isProjectAdmin(data) && project.length == 1) {
            project.remove();
        }

        $("#" + data.projectId + "-modal").modal('hide');

        project.replaceWith(data.partial);

        //remove the settings button if not a project admin
        if ( !isProjectAdmin(data) ) {
            project.find('.project-overview__settings-button').remove();
        }
    }

    // checks to see if the current user is a project admin
    function isProjectAdmin(data) {
        var found = false;

        $.each(data.admins, function(index, value) {
            if (divvy.currentUser == value.username) {
                found = true;
            }
        });

        return found;
    }

    // checks if the current user is a project member
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

