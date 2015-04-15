var notificationModule = (function() {
    var s;

    function showNotificationDropdown() {
        s.notificationDropdown.css({'display': 'none'}).removeClass('hide').velocity("slideDown", { duration: 500 });
    }

    function closeNotificationDropdown() {
        s.notificationDropdown.velocity("slideUp", { duration: 500 });
    }

    function bindUIactions() {
        s.notificationLink.on('click', function(e) {
            e.preventDefault();
            showNotificationDropdown();
        });

        s.notificationClose.on('click', function() {
            closeNotificationDropdown();
        });

    }

    return {
        settings: {
            notificationLink: $('.notification-link'),
            notificationClose: $('.notification-dropdown__close'),
            notificationDropdown: $('.notification-dropdown')
        },

        init: function() {
            s = this.settings;
            bindUIactions();
        }
    }
})();

