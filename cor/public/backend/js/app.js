$(document).ready(function(){
    $(".modal-success").click(function(){
        $('.modal').css('display','block');
        $('.user-name').text($(this).attr('data-name'));
        $('.user-email').text($(this).attr('data-email'));
        // $('.user-password').text($(this).attr('data-password'));
        $('.user-created_at').text($(this).attr('data-created_at'));
    });

    $(".modal-close").click(function(){
        $('.modal').css('display','none');
    });
});