var commentModule = (function() {
    var s;

    function showSettings() {
        $(this).next(s.projectSettingsOverlay).hide().removeClass('hide').slideDown(600);
    }

    function hideSettings() {
        $(this).parent(s.projectSettingsOverlay).slideUp(600);
    }

    function showCommentForm() {
        s.commentForm.hide().removeClass('hide').slideDown(600);
        s.newCommentButton.slideUp(600);
    }

    function hideCommentForm() {
        $(s.commentForm).slideUp(600);
        s.newCommentButton.slideDown(600);
    }

    function bindUIactions() {
        $('body').on('click', '.comment__settings-button', showSettings);
        $('body').on('click', '.comment__settings-close', hideSettings);
        s.newCommentButton.on('click', showCommentForm);
    }

    function bindPusherEvents() {
        var pusher = new Pusher('bf3b73f9a228dfef0913');
        var channel = pusher.subscribe(divvy.channel);

        channel.bind('commentWasDeleted', commentWasDeleted);
        channel.bind('commentWasLeft', commentWasLeft);
        channel.bind('commentWasModified', commentWasModified);
    }

    function commentWasDeleted(data) {
        var comment = $(".comment[data-comment='" + data.commentId + "']");

        comment.animate({
            height: 0,
            opacity: 0,
            padding: 0,
            margin: 0
        }, 500, function() {
            comment.remove();
        })
    }

    // Pusher event listener that adds a new comment
    // to the comments container.
    function commentWasLeft(data) {
        var newComment = $(data.partial).hide();

        newComment.appendTo(s.comments);
        newComment.last().slideDown(500);

        hideCommentForm();
    }

    // Pusher event listener that replaces the specified comment with an
    // updated version from the server.
    function commentWasModified(data) {
        console.log('yes');
        var comment = $(".comment[data-comment='" + data.commentId + "']");
        var newComment = $(data.partial);

        $("#" + data.commentId + "-modal").modal('hide');

        comment.replaceWith(newComment);
    }

    return {
        settings: {
            comments: $('.comments'),
            commentSettingsOverlay: $('.comment__settings-overlay'),
            commentForm: $('.comments__form-wrapper'),
            newCommentButton: $('.comments__new-link')
        },

        init: function() {
            s = this.settings;
            bindUIactions();
            bindPusherEvents();
        }
    }
})();