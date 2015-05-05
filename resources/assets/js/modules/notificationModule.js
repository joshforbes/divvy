var notificationModule = (function() {
    var s;

    // show and animate the notification dropdown
    function showNotificationDropdown() {
        if (s.notificationsWrapper.children().length === 0) {
            s.notificationEmpty.removeClass('hide');
        }
        s.notificationDropdown.css({'display': 'none'}).removeClass('hide').velocity("slideDown", { duration: 500 });
    }

    // hide and animate the notification dropdown
    function closeNotificationDropdown() {
        $('.notification-nav__count-wrapper').html('');
        s.notificationDropdown.velocity("slideUp", { duration: 500 });

        setTimeout(function() {
            s.notificationsWrapper.html('');
            s.notificationEmpty.removeClass('hide');
        }, 600);
    }

    // send an ajax request to mark the notification as read
    function markAsRead(notificationUrl) {
        $.get(notificationUrl, function() {});
    }

    // bind any UI actions. Note that if an action is bound through the body
    // that means it needs to be applied to a dynamic element that may be added
    // through ajax or pusher.
    function bindUIactions() {
        $('body').on('click', '.notification-dropdown__close', closeNotificationDropdown);

        s.notificationLink.on('click', function(e) {
            e.preventDefault();
            showNotificationDropdown();
            markAsRead($(this).attr('href'));
        });

    }

    // bind the pusher event listeners
    function bindPusherEvents() {
        if (typeof window.divvy != 'undefined') {
            var pusher = new Pusher('bf3b73f9a228dfef0913');
            var channel = pusher.subscribe(divvy.userChannel);

            channel.bind('notifyUsers', notifyUsers);
        }
    }

    // Pusher event listener that adds a new notification to the affected
    // users notification dropdown. Also updates the unread notification counter
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

