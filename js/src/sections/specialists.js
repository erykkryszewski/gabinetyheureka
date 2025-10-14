import $ from "jquery";

document.addEventListener("DOMContentLoaded", function () {
    var path = window.location.pathname || "";
    var qs = window.location.search || "";
    if (path.indexOf("/specjalisci") !== -1 && /^\?_/.test(qs)) {
        var $t = $("#specialists");
        if ($t.length) {
            setTimeout(function () {
                $("html, body").stop(true).animate({ scrollTop: $t.offset().top }, 650);
            }, 200);
        }
    }
});
