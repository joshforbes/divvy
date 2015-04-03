var projectModule = (function() {
    var s;

    function clearSelectBox() {
        var selectedText = s.selectBoxSelected.text();
        s.selectBoxOption.filter(function () {
            return $(this).html() == selectedText;
        }).remove();
        s.selectBoxSelected.html('');
    }

    function bindUIactions() {
        s.reopenTaskButton.on('click', function() {

        });
    }

    return {
        settings: {
            tasks: $('.tasks'),
            reopenTaskButton: $('.js-reopen-task-button'),
            selectBoxSelected: $('.select2-selection__rendered'),
            selectBoxOption: $('.js-user-list option')
        },

        test: function(form, data) {
            var currentTask = $(form).parents(".task-overview");

            //$('form').prop('action').contains(' + data + ').filter(function() {
            //    return $(this).text() == "findthis";
            //});

            //console.log($(".tasks:contains('Work')"));

            var task = $('form').filter(function() {
                if ( $(this).prop('action').indexOf('/task/' + data + '/incomplete') >= 0) {
                    console.log($(this).parents('.task-wrapper'));
                }
            });

            //'attr('action').contains(data);
            //console.log($("form"));


            //var replacementTask = tasks.filter(function() {
            //    return $(this).html() === currentTask.html());
            //});
            //console.log(replacementTask);
            //var tasks = parsedData.find(".tasks");

            //this.settings.reopenTaskButton.parents('.tasks').replaceWith(tasks);
        },

        addUser: function() {
            clearSelectBox();
        },

        init: function() {
            s = this.settings;
            bindUIactions();
        }
    }
})();

