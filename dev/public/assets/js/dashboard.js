$(document).ready(function(){
    function getParameterByName(name, url) {
        if (!url) url = window.location.href;
        name = name.replace(/[\[\]]/g, "\\$&");
        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
    }
    //check if its on dashboard page
    if($('#dashboard-box').length !== 0) {
        console.log('rrr',getParameterByName('activated'));
        if(getParameterByName('activated')==1){
            $("#welcomeDlg").modal();
        }

    }
});