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

    return {
        settings: {
            projectSettingsOverlay: $('.project-overview__settings-overlay'),
        },

        init: function() {
            s = this.settings;
            bindUIactions();
        }
    }
})();

