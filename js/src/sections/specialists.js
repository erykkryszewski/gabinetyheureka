import $ from "jquery";

document.addEventListener("DOMContentLoaded", function () {
    // Existing behavior: scroll if needed
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

    // ---- New: Plan4U closest date injector ----
    const $dateBox = $(".specialist__closest-date");
    if (!$dateBox.length) return;

    const hideBox = () => $dateBox.css("display", "none");

    // Ensure there's a <strong>, and clear it so we can fill it
    let $strong = $dateBox.find("strong");
    if (!$strong.length) {
        $strong = $("<strong/>").appendTo($dateBox);
    }
    $strong.text("");

    // Find zone_id from .specialist__plan4u
    const $planWrap = $(".specialist__plan4u");
    if (!$planWrap.length) return hideBox();

    const $iframe = $planWrap.find("iframe");
    if (!$iframe.length) return hideBox();

    let zoneId = null;

    // Try from src: .../index/{id}
    const src = $iframe.attr("src") || "";
    const m1 = src.match(/\/index\/(\d+)(?:[/?#]|$)/);
    if (m1 && m1[1]) {
        zoneId = m1[1];
    }

    // Fallback: from iframe id like fBookVenue7
    if (!zoneId) {
        const fid = $iframe.attr("id") || "";
        const m2 = fid.match(/fBookVenue(\d+)/);
        if (m2 && m2[1]) zoneId = m2[1];
    }

    if (!zoneId) return hideBox();

    // Fetch next available slots
    const url = `https://my.plan4u.pl/froebel/biuro/api/v1/o_NextForZone/${encodeURIComponent(zoneId)}`;

    // Small helper: format "YYYY-MM-DD HH:MM:SS" -> "DD.MM.YYYY, HH:MM"
    const pad = (n) => (n < 10 ? "0" + n : "" + n);
    const formatPL = (ts) => {
        // Treat as local time (Europe/Warsaw) for display purposes
        // Safari-safe: replace space with 'T'
        const safe = ts.replace(" ", "T");
        const d = new Date(safe);
        if (isNaN(d.getTime())) return null;
        return `${pad(d.getDate())}.${pad(d.getMonth() + 1)}.${d.getFullYear()}, ${pad(d.getHours())}:${pad(d.getMinutes())}`;
    };

    // Choose the earliest slot (API already returns ascending; we still guard)
    const pickEarliest = (arr) => {
        if (!Array.isArray(arr) || !arr.length) return null;
        // Filter to valid dates and sort just in case
        const withDates = arr
            .map((x) => (x && x.startTime ? x.startTime : null))
            .filter(Boolean)
            .map((s) => [s, new Date(s.replace(" ", "T")).getTime()])
            .filter(([, t]) => !isNaN(t));
        if (!withDates.length) return null;
        withDates.sort((a, b) => a[1] - b[1]);
        return withDates[0][0];
    };

    // Fetch with timeout
    const controller = new AbortController();
    const timer = setTimeout(() => controller.abort(), 7000);

    fetch(url, { method: "GET", signal: controller.signal })
        .then((r) => (r.ok ? r.json() : Promise.reject(new Error("HTTP " + r.status))))
        .then((json) => {
            if (!json || json.status !== "success" || !Array.isArray(json.data)) {
                hideBox();
                return;
            }
            const earliest = pickEarliest(json.data);
            if (!earliest) {
                hideBox();
                return;
            }
            const formatted = formatPL(earliest);
            if (!formatted) {
                hideBox();
                return;
            }
            $strong.text(formatted);
            // Make sure box is visible (in case of previous state)
            $dateBox.css("display", "");
        })
        .catch(() => {
            // Any failure -> hide
            hideBox();
        })
        .finally(() => clearTimeout(timer));
});
