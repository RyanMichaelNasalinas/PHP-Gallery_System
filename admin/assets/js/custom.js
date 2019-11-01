window.setTimeout(function() {
    $("#alert").fadeTo(500,0).slideUp(500, function(){
        $(this).remove();
    });
}, 4000);


$(document).ready(function(){


    var user_href;
    var user_href_splitted;
    var user_id;
    var image_src;
    var image_src_splitted;
    var image_name;
    var photo_id;

    //Check if image is clicked
    $(".modal_thumbnails").click(function() {

        $("#btn_imgsave").prop('disabled', false);

        $(this).addClass('selected');
        //User ID from delete button in edit_user.php
        user_href = $("#user_id").prop("href"); 
        user_href_splitted = user_href.split("=");
        user_id = user_href_splitted[user_href_splitted.length -1];

        image_src = $(this).prop("src");
        image_src_splitted = image_src.split("/");
        image_name = image_src_splitted[image_src_splitted.length -1];


        photo_id = $(this).attr("data");

s
       $.ajax({
           url: "includes/ajax_code.php",
           data: {photo_id:photo_id},
           type: "POST",
           success: function(data) {
               if(!data.error) {
                    $("#modal_sidebar").html(data)
               }
           }
       });
    });


    $("#btn_imgsave").click(function() {
        
        $.ajax({
            url: "includes/ajax_code.php",
            data:{image_name: image_name,user_id:user_id},
            type: "POST",
            success: function(data){
                if(!data.error) {
                   $(".user_image_box a img").prop('src',data);
                }
            }
        });
    });


   

    // Tiny mce editor
    tinymce.init({selector:'textarea'});
});






