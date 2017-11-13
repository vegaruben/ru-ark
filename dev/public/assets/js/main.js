var oldIE=false;

$(document).ready(function () {		
	"use strict";

    // Detecting IE http://stackoverflow.com/a/10965091    
    if ($('html').is('.ie6, .ie7, .ie8')) {
        oldIE = true;        
    }    
    
    if(error_fields){
		var xy =jQuery.parseJSON(error_fields);
		for(var i=0;i<xy.length;i++){			
			$('#'+xy[i]).addClass('has-error');
		}
	}
});
