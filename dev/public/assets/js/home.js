$(document).ready(function(){
	 if($('.home').length !== 0){
		//signin
		var frm = $('#loginform');
		frm.submit(function (e) {
			e.preventDefault();
			$('#loginform .statusbox').html('<div class="alert alert-info">Please wait...</div>');
			$.ajax({
				type: frm.attr('method'),
				url: frm.attr('action'),
				data: frm.serialize(),
				success: function (data) {
					try{
						var data = jQuery.parseJSON(data);
						if(data.success==0){
							 $('#loginform .statusbox').html('<div class="alert alert-danger">'+data.message+'</div>');
						}else{
							window.location.replace('/dashboard/');
						}
					}catch(err){
						alert("an error occured");
					}
				},
				error: function (data) {
					console.log('An error occurred.');
					console.log(data);
				},
			});
		});
		//signup
		var frm2 = $('#signupform');
		frm2.submit(function (e) {
			e.preventDefault();
			$('#signupform .statusbox').html('<div class="alert alert-info">Please wait...</div>');
			$.ajax({
				type: frm2.attr('method'),
				url: frm2.attr('action'),
				data: frm2.serialize(),
				success: function (data) {
					try{
						var data = jQuery.parseJSON(data);
						if(data.success==0){
							 $('#signupform .statusbox').html('<div class="alert alert-danger">'+data.message+'</div>');
						}else{
							$('#signupform .statusbox').html('<div class="alert alert-success">'+data.message+'</div>');
						}
					}catch(err){
						alert("an error occured");
					}
				},
				error: function (data) {
					console.log('An error occurred.');
					console.log(data);
				},
			});
		});
	}
});	
