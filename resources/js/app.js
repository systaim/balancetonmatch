require("./bootstrap");

let burger = document.getElementById('burger');
let nav = document.getElementById('main-nav');
let header = document.getElementById('header');

burger.addEventListener('click', function(){
	this.classList.toggle('is-open');
	nav.classList.toggle('is-open');
	header.classList.toggle('height-100');
});


