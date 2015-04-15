var notificationModule = (function() {
    var s;

    function showNotificationDropdown() {
        if (s.notificationsWrapper.children().length === 0) {
            s.notificationEmpty.removeClass('hide');
        }
        s.notificationDropdown.css({'display': 'none'}).removeClass('hide').velocity("slideDown", { duration: 500 });
    }

    function closeNotificationDropdown() {
        $('.notification-nav__count-wrapper').html('');
        s.notificationDropdown.velocity("slideUp", { duration: 500 });

        setTimeout(function() {
            s.notificationsWrapper.html('');
            s.notificationEmpty.removeClass('hide');
        }, 600);
    }

    function markAsRead(notificationUrl) {
        $.get(notificationUrl, function() {});
    }

    function bindUIactions() {
        $('body').on('click', '.notification-dropdown__close', closeNotificationDropdown);

        s.notificationLink.on('click', function(e) {
            e.preventDefault();
            showNotificationDropdown();
            markAsRead($(this).attr('href'));
        });

    }

    function bindPusherEvents() {
        var pusher = new Pusher('bf3b73f9a228dfef0913');
        var channel = pusher.subscribe(divvy.userChannel);

        channel.bind('notifyUsers', notifyUsers);
    }

    function notifyUsers(data) {
        s.notificationEmpty.addClass('hide');
        s.notificationsWrapper.prepend(data.notificationPartial);
        $('.notification-nav__count-wrapper').html(data.notificationCountPartial);

    }

    return {
        settings: {
            notificationLink: $('.notification-nav__link'),
            notificationDropdown: $('.notification-dropdown'),
            notificationsWrapper: $('.notification-dropdown__notifications-wrapper'),
            notificationEmpty: $('.notification-dropdown__empty')
        },

        init: function() {
            s = this.settings;
            bindUIactions();
            bindPusherEvents();
        }
    }
})();

