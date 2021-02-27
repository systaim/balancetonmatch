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

// Compteurs animés homepage
let compteurs = document.querySelectorAll(".compteur");

compteurs.forEach(compteur => {
    function animateValue(obj, start, end, duration) {
        let startTimestamp = null;
        const step = timestamp => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min(
                (timestamp - startTimestamp) / duration, 1);
            obj.innerHTML = Math.floor(progress * (start + end) + start);
            if (progress < valeurCompteur) {
                window.requestAnimationFrame(step);
            }
        };
        window.requestAnimationFrame(step);
    }
    let valeurCompteur = compteur.innerHTML;
    animateValue(compteur, 0, valeurCompteur, 3000);
});

let menuRegions = document.getElementById('menuRegions')
let sousMenuRegion = document.getElementById('sousMenuRegions')

menuRegions.addEventListener('click', function() {
    sousMenuRegion.classList.toggle('select')
})

let submitButton = document.querySelector('[type=Submit]')

submitButton.addEventListener('load', function() {
    submitButton.setAttribute('disabled', 'disabled')

})