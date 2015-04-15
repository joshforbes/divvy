var notificationModule = (function() {
    var s;

    function showNotificationDropdown() {
        s.notificationDropdown.css({'display': 'none'}).removeClass('hide').velocity("slideDown", { duration: 500 });
    }

    function closeNotificationDropdown() {
        s.notificationCount.remove();
        s.notificationDropdown.velocity("slideUp", { duration: 500 });
    }

    function markAsRead(notificationUrl) {
        $.get(notificationUrl, function() {});
    }

    function bindUIactions() {
        s.notificationLink.on('click', function(e) {
            e.preventDefault();
            showNotificationDropdown();
            markAsRead($(this).attr('href'));
        });

        s.notificationClose.on('click', function() {
            closeNotificationDropdown();
        });

    }

    return {
        settings: {
            notificationLink: $('.notification-nav__link'),
            notificationClose: $('.notification-dropdown__close'),
            notificationDropdown: $('.notification-dropdown'),
            notificationCount: $('.notification-nav__count')
        },

        init: function() {
            s = this.settings;
            bindUIactions();
        }
    }
})();

