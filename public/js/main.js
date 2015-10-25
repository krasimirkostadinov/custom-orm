$(document).ready(function () {
    var loader = '<img class="loader-image" src="' + host_path + '/public/images/loader.gif" />';

    //if found general error hide navbar-top, because overlap error
    if($('body .general-error').length){
        $('.navbar-fixed-top').remove();
    }
});
