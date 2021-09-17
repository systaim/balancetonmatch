const { forEach } = require("lodash");

require("./bootstrap");



// /******************************
//  * 
//  * menu Hamburger
//  * 
//  ******************************/

// let burger = document.getElementById("burger");
// let nav = document.getElementById("main-nav");
// let container = document.getElementById("container");

// burger.addEventListener("click", function () {
//     this.classList.toggle("is-open");
//     nav.classList.toggle("is-open");
//     container.classList.toggle("is-open");
// });

/******************************
 * 
 * menu Hamburger bas de page
 * 
 ******************************/

let burger2 = document.getElementById("burger2");
let menuMobile = document.getElementById("menu-mobile");
let profile = document.getElementById("profile");
let menuProfile = document.getElementById("menu-profile");
let matchs = document.getElementById("matchs");
let menuMatchs = document.getElementById("menu-matchs");

burger2.addEventListener("click", function () {
    this.classList.toggle("is-open");
    menuMobile.classList.toggle("is-open");

    if (menuProfile.classList.contains('is-open')) {
        menuProfile.classList.toggle("is-open");
    }
    if (menuMatchs.classList.contains('is-open')) {
        menuMatchs.classList.toggle("is-open");
    }
});

profile.addEventListener("click", function () {
    this.classList.toggle("is-open");
    menuProfile.classList.toggle("is-open");
    
    if (menuMobile.classList.contains('is-open')) {
        menuMobile.classList.toggle("is-open");
    }
    if (menuMatchs.classList.contains('is-open')) {
        menuMatchs.classList.toggle("is-open");
    }
    if (burger2.classList.contains('is-open')) {
        burger2.classList.toggle("is-open");
    }
});

matchs.addEventListener("click", function () {
    this.classList.toggle("is-open");
    menuMatchs.classList.toggle("is-open");

    if (menuProfile.classList.contains('is-open')) {
        menuProfile.classList.toggle("is-open");
    }
    if (menuMobile.classList.contains('is-open')) {
        menuMobile.classList.toggle("is-open");
    }
    if (burger2.classList.contains('is-open')) {
        burger2.classList.toggle("is-open");
    }
});

/******************************
 * 
 * compteurs animés
 * 
 ******************************/


let compteurs = document.querySelectorAll(".compteur");

compteurs.forEach(compteur => {
    console.log(compteur);
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
// /******************************
//  * 
//  * main menu
//  * 
//  ******************************/

// let menuRegions = document.getElementById('menuRegions')
// let sousMenuRegion = document.getElementById('sousMenuRegions')

// menuRegions.addEventListener('click', function () {
//     sousMenuRegion.classList.toggle('select')
// })

/******************************
 * 
 * desactiver bouton pendant chargement
 * 
 ******************************/

let submitButton = document.querySelector('[type=Submit]')
if (submitButton != null) {
    submitButton.addEventListener('load', function () {
        submitButton.setAttribute('disabled', 'disabled')

    })
}


/******************************
 * 
 * detections position écran pour animations
 * 
 ******************************/

function moveLeftToRight(div) {
    for (let i = 0; i < div.length; i++) {
        if (div[i].style.opacity == 0 && window.scrollY >= (div[i].offsetTop - (window.screen.height - 300))) {

            div[i].style.opacity = 1
            div[i].style.animation = "left-to-right 500ms"
        }
    }
}

function moveRightToLeft(div) {
    for (let i = 0; i < div.length; i++) {
        if (div[i].style.opacity == 0 && window.scrollY >= (div[i].offsetTop - (window.screen.height - 300))) {

            div[i].style.opacity = 1
            div[i].style.animation = "right-to-left 500ms"
        }
    }
}

function moveBottomToTop(div) {
    for (let i = 0; i < div.length; i++) {
        if (div[i].style.opacity == 0 && window.scrollY >= (div[i].offsetTop - (window.screen.height - 300))) {

            div[i].style.opacity = 1
            div[i].style.animation = "bottom-to-top 500ms"
        }
    }
}

function moveTopToBottom(div) {
    for (let i = 0; i < div.length; i++) {
        if (div[i].style.opacity == 0 && window.scrollY >= (div[i].offsetTop - (window.screen.height - 300))) {

            div[i].style.opacity = 1
            div[i].style.animation = "top-to-bottom 500ms"
        }
    }
}
window.addEventListener('scroll', function () {
    let moveToLeft = document.querySelectorAll('.moveToLeft')
    let moveToRight = document.querySelectorAll('.moveToRight')
    let moveToBottom = document.querySelectorAll('.moveToBottom')
    let moveToTop = document.querySelectorAll('.moveToTop')
    if (moveToLeft != null)
        moveLeftToRight(moveToLeft)

    if (moveToRight != null)
        moveRightToLeft(moveToRight)

    if (moveToBottom != null)
        moveTopToBottom(moveToBottom)

    if (moveToTop != null)
        moveBottomToTop(moveToTop)
})

// SERVICE WORKER

if("serviceWorker" in navigator){
    navigator.serviceWorker.register("/serviceWorker.js");
}

import Echo from "laravel-echo";

window.Pusher = require("pusher-js");

window.Echo = new Echo({
    broadcaster: "pusher",
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true
});
if (window.User) {
    window.Echo.private("App.Models.User." + User.id).notification(
        notification => {
            document.getElementById("js-count").innerHTML =
                parseInt(document.getElementById("js-count").innerHTML) + 1;
            console.log(notification.type);
        }
    );
}
 


