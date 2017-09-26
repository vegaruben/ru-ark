(function( root, $, undefined ) {
	"use strict";

	$(function () {
		// DOM ready, take it away
		$("#login").click(function(e){
			e.preventDefault();
			$("#signupForm").slideUp("slow");
			if ($("#loginForm").is(":hidden")){
				$("#loginForm").slideDown("slow");
			}
			else{
				$("#loginForm").slideUp("slow");
			}
		});
		$('#loginSubmit').click(function(){
			setTimeout(function(){				
				$("#loginForm").slideUp("slow");
			}, 2000);
		});
		
		$("#signup").click(function(e){
			e.preventDefault();
			$("#loginForm").slideUp("slow");
			if ($("#signupForm").is(":hidden")){
				$("#signupForm").slideDown("slow");
			}
			else{
				$("#signupForm").slideUp("slow");
			}
		});
		$('#signupSubmit').click(function(){
			setTimeout(function(){				
				$("#signupForm").slideUp("slow");
			}, 2000);
		});
	});

} ( this, jQuery ));
