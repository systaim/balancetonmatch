const { forEach } = require("lodash");

require("./bootstrap");

// Menu hamburger

let burger = document.getElementById("burger");
let nav = document.getElementById("main-nav");
let container = document.getElementById("container");

burger.addEventListener("click", function() {
    this.classList.toggle("is-open");
    nav.classList.toggle("is-open");
    container.classList.toggle("is-open");
});