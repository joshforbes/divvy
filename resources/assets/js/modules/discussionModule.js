var discussionModule = (function() {
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

    }

    return {
        settings: {
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