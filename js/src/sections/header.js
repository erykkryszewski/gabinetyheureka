window.addEventListener("scroll", function () {
    const headerElement = document.querySelector(".header");
    const scrollNow = window.scrollY;

    if (scrollNow >= 60) {
        headerElement.classList.add("header--fixed");
        headerElement.querySelector(".nav").classList.add("nav--fixed");
        headerElement.querySelector(".nav__logo").classList.add("nav__logo--fixed");
        headerElement.querySelector(".nav__menu").classList.add("nav__menu--fixed");
        headerElement.querySelector(".nav__button").classList.add("nav__button--fixed");
        headerElement.querySelector(".nav__hamburger").classList.add("nav__hamburger--fixed");
    } else if (scrollNow < 30) {
        headerElement.classList.remove("header--fixed");
        headerElement.querySelector(".nav").classList.remove("nav--fixed");
        headerElement.querySelector(".nav__logo").classList.remove("nav__logo--fixed");
        headerElement.querySelector(".nav__menu").classList.remove("nav__menu--fixed");
        headerElement.querySelector(".nav__button").classList.remove("nav__button--fixed");
        headerElement.querySelector(".nav__hamburger").classList.remove("nav__hamburger--fixed");
    }

    if (scrollNow > 5) {
        headerElement.classList.add("header--background");
    } else {
        headerElement.classList.remove("header--background");
    }
});
