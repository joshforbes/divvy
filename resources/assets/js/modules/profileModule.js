var profileModule = (function() {
    var s;

    // opens the file prompt when the avatar input is clicked
    function selectFilePrompt() {
        s.avatarInput.click();
    }

    // submits the avatar form when a file is chosen
    function submitAvatarUpload() {
        s.avatarSubmit.click();
    }

    // binds UI actions to dom elements
    function bindUIactions() {
        s.avatarUploadButton.on('click', function() {
            selectFilePrompt();
        });
        s.avatarInput.on('change', function() {
            submitAvatarUpload();
            $('body').css({'cursor' : 'wait'});
        });
    }

    return {
        settings: {
            avatarUploadButton: $('.profile-form__avatar-upload'),
            avatarInput: $('#avatar-input'),
            avatarSubmit: $('#avatar-submit')
        },

        init: function() {
            s = this.settings;
            bindUIactions();
        }
    }
})();

