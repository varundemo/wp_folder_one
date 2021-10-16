// This is script file


jQuery(document).ready( function () {

    jQuery('#btn-upload').on("click",function(){
        // alert('btn is click');
        var image = wp.media({
            title:"Upload Image for My Book",
            // multiple:false
            multiple:true
        }).open().on("select",function(){
            var uploaded_image = image.state().get("selection").first();
            console.log(uploaded_image);
            // console.log(uploaded_image.attributes);
            var img_url = uploaded_image.toJSON().url;
            jQuery("#show_image").html("<img src='"+img_url+"' id='image_url' alt='' style='width:100px; height:100px;'>");
            jQuery("#image_name").val(img_url);
        });
    })


    jQuery('#booking-table').DataTable();
    // jQuery("#btn").on("click",function(){
    //     alert("Get in");

    // })
    jQuery('#formaddprod').validate({
        submitHandler:function(){
            var post_data = "action=booking_data&param=save_booking&"+jQuery('#formaddprod').serialize();
            // console.log(roombookingajax);

            jQuery.post(roombookingajax,post_data,function(response){
                console.log(response);
                var data = jQuery.parseJSON(response);
                if(data.status == 1){
                    jQuery('#notify_bar').html(`<div class="alert alert-primary">${data.message}</div>`);
                    jQuery('#prod_name').val('');
                    jQuery('#prod_desc').val('');
                    jQuery('#image_name').val('');
                    jQuery('#prod_price').val('');
                    jQuery("#show_image").html('');
                }
                else{
                      jQuery('#notify_bar').html(`<div class="alert alert-danger">Unable to Add product</div>`);
                }
            });

        }
    })
    

        jQuery('#formupdateprod').validate({
            submitHandler:function(){
                // console.log("form submit");
                 var post_data = "action=booking_data&param=update_booking&"+jQuery('#formupdateprod').serialize();

                 jQuery.post(roombookingajax,post_data,function(response){
                console.log(response);
                var data = jQuery.parseJSON(response);
                if(data.status == 1){
                    jQuery('#notify_bar').html(`<div class="alert alert-primary">${data.message}</div>`);
                    jQuery('#prod_name').val('');
                    jQuery('#prod_desc').val('');
                    jQuery('#image_name').val('');
                    jQuery('#prod_price').val('');
                    jQuery("#show_image").html('');
                }
                else{
                      jQuery('#notify_bar').html(`<div class="alert alert-danger">Unable to Add product</div>`);
                }
            });

            }
        })


} );



