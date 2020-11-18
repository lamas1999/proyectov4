$(document).ready(function(){
    $('#showpass').mousedown(function(){
        $('#txtretype_pass').removeAttr('type'); 
        $('#showpass').addClass('fa-eye-slash').removeClass('fa-eye');  
    });

    $('#showpass').mouseup(function(){
        $('#txtretype_pass').attr('type','password');
        $('#showpass').addClass('fa-eye').removeClass('fa-eye-slash');
        
    });
});