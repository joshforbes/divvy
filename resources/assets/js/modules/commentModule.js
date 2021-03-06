var commentModule = (function() {
    var s;

    // show and animate the project settings overlay
    function showSettings() {
        $(this).next(s.projectSettingsOverlay).hide().removeClass('hide').slideDown(600);
    }

    // hide and animate the project settings overlay
    function hideSettings() {
        $(this).parent(s.projectSettingsOverlay).slideUp(600);
    }

    // show and animate the comment form
    function showCommentForm() {
        $('.comments__form-wrapper').hide().removeClass('hide').slideDown(600);
        $('.comments__new-link').slideUp(600);
    }

    // hide and animate the comment form
    function hideCommentForm() {
        $('.comments__form-wrapper').slideUp(600);
        $('.comments__new-link').slideDown(600);
    }

    // bind any UI actions. Note that if an action is bound through the body
    // that means it needs to be applied to a dynamic element that may be added
    // through ajax or pusher.
    function bindUIactions() {
        $('body').on('click', '.comment__settings-button', showSettings);
        $('body').on('click', '.comment__settings-close', hideSettings);
        $('body').on('click', '.comments__new-link', showCommentForm);
    }

    // bind the pusher event listeners
    function bindPusherEvents() {
        var pusher = new Pusher('bf3b73f9a228dfef0913');
        var channel = pusher.subscribe(divvy.channel);

        channel.bind('commentWasDeleted', commentWasDeleted);
        channel.bind('commentWasLeft', commentWasLeft);
        channel.bind('commentWasModified', commentWasModified);
    }

    // Pusher event listener that removes the specified comment
    // from the comment container
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
        var commentEdit = $(data.editPartial);

        newComment.appendTo('.comments');
        newComment.last().slideDown(500);

        commentEdit.appendTo('.comments');

        hideCommentForm();

        //remove the settings button if not a project admin
        if ( !isCommentAuthor(data.author.username) ) {
            newComment.find('.comment__settings-button').remove();
        }
    }

    // Pusher event listener that replaces the specified comment with an
    // updated version from the server.
    function commentWasModified(data) {
        var comment = $(".comment[data-comment='" + data.commentId + "']");
        var newComment = $(data.partial);
        var editModal = $('#' + data.commentId + '-modal');
        var editForm = editModal.find('.modal-form');

        editModal.modal('hide');

        comment.replaceWith(newComment);
        editForm.parent().html(data.editPartial);


        //remove the settings button if not a project admin
        if ( !isCommentAuthor(data.author.username) ) {
            newComment.find('.comment__settings-button').remove();
        }
    }

    // checks to see if current user is the comment author
    function isCommentAuthor(author) {
        return divvy.currentUser == author;
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