$(document).ready(function(){
    $(".modal-success").click(function(){
        $('.modal').css('display','block');
        $('.user-name').text($(this).attr('data-name'));
        $('.user-email').text($(this).attr('data-email'));
        $('.user-created_at').text($(this).attr('data-created_at'));
    });

    $(".modal-pubs-success").click(function(){
        $('.modal').css('display','block');
        $('.pubs-name').text($(this).attr('data-product_name'));
        $('.pubs-amount').text($(this).attr('data-amount'));
        $('.pubs-price').text($(this).attr('data-price'));
        $('.pubs-total').text($(this).attr('data-total'));
        $('.pubs-user').text($(this).attr('data-user'));
        $('.pubs-created_at').text($(this).attr('data-created_at'));
        let users = JSON.parse($(this).attr('data-users'));
        $('.pubs-users div').remove();
        $(users).each(function(index, value) {
            $('.pubs-users').append('<div>'+ value +' </div>');
        });
        let data_image = JSON.parse($(this).attr('data-images'));
        $('.pubs-image img').remove();
        $(data_image).each(function(index, value) {
            var images = "files_pubs/"+value;
            $('.pubs-image').append('<img style="width: 100%;height: 150px" src="'+images+'" alt="">');
        });
    });

    $(".modal-pubs-delete").click(function(e){
        $('.modal-delete').css('display','block');
        $('.form-modal-delete').attr('action',$(this).attr('data-href'));
    });

    $(".modal-close").click(function(){
        $('.modal-delete').css('display','none');
    });

    $(".modal-close").click(function(){
        $('.modal').css('display','none');
    });

    $(".btn-add-image").click(function(){
        $('#file_upload').trigger('click');
    });

    $('.list-input-hidden-upload').on('change', '#file_upload', function(event){
        let today = new Date();
        let time = today.getTime();
        let image = event.target.files[0];
        let file_name = event.target.files[0].name;
        let box_image = $('<div class="box-image"></div>');
        box_image.append('<img src="' + URL.createObjectURL(image) + '" class="picture-box">');
        box_image.append('<div class="wrap-btn-delete"><span data-id='+time+' class="btn-delete-image">x</span></div>');
        $(".list-images").append(box_image);
        $(this).removeAttr('id');
        $(this).attr( 'id', time);
        let input_type_file = '<input type="file" name="images[]" id="file_upload" class="myfrm form-control hidden">';
        $('.list-input-hidden-upload').append(input_type_file);
    });

    $(".list-images").on('click', '.btn-delete-image', function(){
        let id = $(this).data('id');
        $('#'+id).remove();
        $(this).parents('.box-image').remove();
    });
});
