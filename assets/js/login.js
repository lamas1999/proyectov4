$(document).ready(function(){
    $('#show').mousedown(function(){
        $('#txtPassword').removeAttr('type'); 
        $('#show').addClass('fa-eye-slash').removeClass('fa-eye');  
    });

    $('#show').mouseup(function(){
        $('#txtPassword').attr('type','password');
        $('#show').addClass('fa-eye').removeClass('fa-eye-slash');
        
    });
});




