var Lang = (function () {
    var selector = 'languages';

    function init() {
        var langs = document.getElementsByClassName(selector);
        if (langs.length > 0) {
            for (var i = 0; i < langs.length; i++) {
                langs[i].onclick = function () {
                    change(this.id);
                }
            }
        }
    }

    function change(lang) {
        $.ajax({
            method: 'POST',
            url: '/language',
            async: true,
            data: {
                lang: lang
            },
            success: function () {
                location.reload();
            }
        });
    }

    return {
        init: init
    };
})();

$(document).ready(function () {
    Lang.init();
});