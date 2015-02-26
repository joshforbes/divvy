var projectModule = (function() {
    var s;

    function clearSelectBox() {
        var selectedText = s.selectBoxSelected.text();
        s.selectBoxOption.filter(function () {
            return $(this).html() == selectedText;
        }).remove();
        s.selectBoxSelected.html('');
    }

    return {
        settings: {
            selectBoxSelected: $('.select2-selection__rendered'),
            selectBoxOption: $('.js-user-list option')
        },

        addUser: function() {
            clearSelectBox();
        },

        init: function() {
            s = this.settings;
        }
    }
})();

