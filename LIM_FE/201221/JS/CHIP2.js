var modal = document.querySelector(".modal");
var styled = document.querySelector(".styled");
var closeButton = document.querySelector(".close-button");
var cancelButton = document.querySelector("#cancel");

//console.log(modal);

function toggleModal() {
	modal.classList.toggle("show-modal");
}

function windowOnClick(event) {
	if (event.target === modal) {
		toggleModal();
	}
}

styled.addEventListener("click", toggleModal);
closeButton.addEventListener("click", toggleModal);
cancel.addEventListener("click", toggleModal);
window.addEventListener("click", windowOnClick);

//µÎ¹øÂ° ¹öÆ°
var model = document.querySelector(".model");
var stylel = document.querySelector(".stylel");
var closeButon = document.querySelector(".close-buton");
var cencelButon = document.querySelector("#cencel");

//console.log(modal);

function toggleModel() {
	model.classList.toggle("show-model");
}

function windowOnClick(event) {
	if (event.target === model) {
		toggleModel();
	}
}

stylel.addEventListener("click", toggleModel);
closeButon.addEventListener("click", toggleModel);
cencel.addEventListener("click", toggleModel);
window.addEventListener("click", windowOnClick);

//To change button text
//$(selector).text(content)
///$(document).ready(function () {
//	$(".plus-button+.plus-button--large").click(function (i, oldText) {
//		return oldText === '´ÝÈû' ? '¿­¸²' : oldText;
//	});
//});

//¼¼¹øÂ°ÆË¾÷
//var modell = document.querySelector(".modell");
//var plusbutton = document.querySelector(".plus-button--large");
//var closeButonl = document.querySelector(".close-butonl");
//var cencelButonl = document.querySelector("#cencell");

//console.log(modal);

//function toggleModell() {
//	modell.classList.toggle("show-modell");
///}

//function windowOnClick(event) {
//	if (event.target === modell) {
//		toggleModell();
//	}
//}

//plusbutton.addEventListener("click", toggleModell);
//closeButonl.addEventListener("click", toggleModell);
//cencell.addEventListener("click", toggleModell);
//window.addEventListener("click", windowOnClick);

