( function($) {
    jQuery(window).load(function(){

        if(jQuery('.ihf-ajax-description').length) {
            jQuery('.ihf-ajax-description').each(function () {
                $d = jQuery(this);

                if($d.hasClass('exclude-ajax')){
                    return;
                }

                $listing_url = $d.data('url');

                if ($listing_url) {
                    jQuery.post(
                        ajax_object.ajax_url,
                        {
                            'action': 'ihf_listing_excerpt_by_url',
                            'listing-url': $listing_url
                        },
                        function ($result) {
                            $data = jQuery.parseJSON($result);
                            if ($data.listing_id && $data.excerpt) {
                                $target_container = jQuery(".ihf-ajax-description[data-id='" + $data.listing_id + "']");
                                $target_container.append($data.excerpt);
                            } else {
                                console.log('There\'s an error on ajax returned data.');
                            }
                        }
                    );
                }
            });
        }

    });

})(jQuery);

// [ihf-featured-property url ="" listing-description="true"] 