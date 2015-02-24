var projectModule = (function() {
    var s;

    return {
        settings: {
            selectBoxSelected: $('.select2-selection__rendered'),
            selectBoxOption: $('#usersList option')
        },

        show: function() {
            var selectedText = s.selectBoxSelected.text();
            s.selectBoxOption.filter(function () {
                return $(this).html() == selectedText;
            }).remove();
            s.selectBoxSelected.html('');
        },

        init: function() {
            s = this.settings;
        }
    }
})();

