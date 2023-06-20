/*! apollo.js v1.7.0 | (c) 2014 @toddmotto | https://github.com/toddmotto/apollo */
!function(n,t){"function"==typeof define&&define.amd?define(t):"object"==typeof exports?module.exports=t:n.apollo=t()}(this,function(){"use strict";var n,t,s,e,o={},c=function(n,t){"[object Array]"!==Object.prototype.toString.call(n)&&(n=n.split(" "));for(var s=0;s<n.length;s++)t(n[s],s)};return"classList"in document.documentElement?(n=function(n,t){return n.classList.contains(t)},t=function(n,t){n.classList.add(t)},s=function(n,t){n.classList.remove(t)},e=function(n,t){n.classList.toggle(t)}):(n=function(n,t){return new RegExp("(^|\\s)"+t+"(\\s|$)").test(n.className)},t=function(t,s){n(t,s)||(t.className+=(t.className?" ":"")+s)},s=function(t,s){n(t,s)&&(t.className=t.className.replace(new RegExp("(^|\\s)*"+s+"(\\s|$)*","g"),""))},e=function(e,o){(n(e,o)?s:t)(e,o)}),o.hasClass=function(t,s){return n(t,s)},o.addClass=function(n,s){c(s,function(s){t(n,s)})},o.removeClass=function(n,t){c(t,function(t){s(n,t)})},o.toggleClass=function(n,t){c(t,function(t){e(n,t)})},o});

(function () {

	// cria um novo elemento
	var mobile = document.createElement('div');

	// adiciona uma classe ao novo elemento
	mobile.className = 'nav-mobile';

	// coloca a nova tag no codigo fonte
	document.querySelector('.nav').appendChild(mobile);

	// seleciona a nav-mobile no codigo fonte
	var mobileNav = document.querySelector('.nav-mobile');

	// seleciona o nav-list
	var toggle = document.querySelector('.nav-list');

	mobileNav.onclick = function() {
		apollo.toggleClass(mobileNav, 'nav-mobile-open');
		apollo.toggleClass(toggle, 'nav-active');
	}

})();