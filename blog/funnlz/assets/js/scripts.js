(function( root, $, undefined ) {
	"use strict";

	$(function () {
		// DOM ready, take it away
		$('a.login').click(function(e){
			console.log('clicked');
			$('.login-box').toggleClass('show');
			e.preventDefault();
			
		});
	});

} ( this, jQuery ));
