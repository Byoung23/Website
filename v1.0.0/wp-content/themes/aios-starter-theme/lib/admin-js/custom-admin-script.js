/* 404 Page Script */
function upload_error_photos() {
    jQuery( '.error-add-photo' ).on( 'click', function(e) {
        e.preventDefault();

        targetArea = jQuery(this).data("img");

        var image = wp.media({ 
            title: 'Upload 404 Page Photo (Left Area)',
            multiple: false
        }).open()
        .on( 'select', function(e){
            var uploaded_image = image.state().get( 'selection' ).first();

            // We convert uploaded_image to a JSON object to make accessing it easier
            var image_url = uploaded_image.toJSON().url;

            // Let's assign the url value to the input field
            jQuery( '.admin-error-photo-option.'+targetArea ).empty().prepend( '<img src="' + image_url + '" alt="'+targetArea+'">' );

           	jQuery('input[name="'+targetArea+'"]').val(image_url);
           
        });

    });


    jQuery('.error-delete-photo').on('click', function(e) {
    	e.preventDefault();

    	targetArea = jQuery(this).data("img");


        jQuery('.admin-error-photo-option.'+targetArea ).find('img').remove();

        jQuery( '.admin-error-photo-option.'+targetArea ).html('No Image');
        	jQuery('input[name="'+targetArea+'"]').val('');
        
    })
}



jQuery(document).ready(function($){

	upload_error_photos();
	
})