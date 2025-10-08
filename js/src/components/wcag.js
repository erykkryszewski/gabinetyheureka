document.addEventListener("DOMContentLoaded", function () {
    const bodyElement = document.body;
    const wcagFontSizeInput = document.querySelector(".wcag__font-size");
    const wcagContrastInput = document.querySelector(".wcag__contrast");
    const storageFontKey = "wcagFontSizeEnabled";
    const storageContrastKey = "wcagContrastEnabled";

    function applyInitialState() {
        const isFontSaved = localStorage.getItem(storageFontKey) === "1";
        const isContrastSaved = localStorage.getItem(storageContrastKey) === "1";
        if (isFontSaved) {
            bodyElement.classList.add("wcag-font-size");
            if (wcagFontSizeInput) wcagFontSizeInput.classList.add("wcag__font-size--active");
        }
        if (isContrastSaved) {
            bodyElement.classList.add("wcag-contrast");
            if (wcagContrastInput) wcagContrastInput.classList.add("wcag__contrast--active");
        }
    }

    function toggleFontSize() {
        const isActive = wcagFontSizeInput.classList.toggle("wcag__font-size--active");
        if (isActive) {
            bodyElement.classList.add("wcag-font-size");
            localStorage.setItem(storageFontKey, "1");
        } else {
            bodyElement.classList.remove("wcag-font-size");
            localStorage.removeItem(storageFontKey);
        }
    }

    function toggleContrast() {
        const isActive = wcagContrastInput.classList.toggle("wcag__contrast--active");
        if (isActive) {
            bodyElement.classList.add("wcag-contrast");
            localStorage.setItem(storageContrastKey, "1");
        } else {
            bodyElement.classList.remove("wcag-contrast");
            localStorage.removeItem(storageContrastKey);
        }
    }

    if (wcagFontSizeInput) wcagFontSizeInput.addEventListener("click", toggleFontSize);
    if (wcagContrastInput) wcagContrastInput.addEventListener("click", toggleContrast);
    applyInitialState();
});
