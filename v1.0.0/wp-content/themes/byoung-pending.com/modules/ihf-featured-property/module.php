<?php

new AIOSIhfMarketReport();

class AIOSIhfMarketReport
{
    private static $module_name = 'ihf-featured-property';

    private static $module_js_dir_url;

    private static $excerpt_length = 80;


    public function __construct()
    {
        self::$module_js_dir_url = get_stylesheet_directory_uri() . '/modules/' . self::$module_name . '/js/';

        add_shortcode(self::$module_name, array($this, 'ihf_featured_property'));

        add_action('wp_ajax_ihf_listing_excerpt_by_url', array($this, 'ajax_ihf_listing_excerpt_by_url'));

        add_action('wp_ajax_nopriv_ihf_listing_excerpt_by_url', array($this, 'ajax_ihf_listing_excerpt_by_url'));

        wp_register_script(self::$module_name . '-scripts', self::$module_js_dir_url . 'scripts.js', array('jquery'), false, false);

        wp_localize_script(self::$module_name . '-scripts', 'ajax_object', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'stylesheet_dir' => get_stylesheet_directory_uri()
        ));
    }


    public function ihf_featured_property($atts)
    {
        $data = shortcode_atts(array(
            'url' => false,
            'results-per-page' => 10,
            'title' => false,
            'default-featured-img' => '',
            'listing-description' => false
        ), $atts);

        $response = '';

        if ($data['listing-description']) {
            wp_enqueue_script(self::$module_name . '-scripts');
        }


        if ($data['url']) {

            // Get the based URL only
            if (strpos($data['url'], '?')) {
                $data['url'] = explode('?', $data['url'])[0];
            }

            // Check if valid URL
            if (!filter_var($data['url'], FILTER_VALIDATE_URL))
                return 'Supplied report url is not url.';

            $data['url'] = (substr($data['url'], -1) == '/') ? $data['url'] : $data['url'] . '/';

            // Apply the parameters
            $data['url'] = $data['url']
                . '?q=true&'
                . 'resultsPerPage=' . $data['results-per-page'];

            $html = wp_remote_get($data['url']);
            $html = $html['body'];

            $dom = new PHPHtmlParser\Dom;
            $dom->setOptions([
                'Strict' => false,
                'cleanupInput' => true,
                'removeScripts' => false

            ]);
            $dom->load($html);

            if ($dom->find('.ihf-listing-search-results .ihf-grid-result', 0)) {
                $listingList = $dom->find('.ihf-listing-search-results .ihf-grid-result');

                foreach ($listingList as $list) {
                    // <span class="ihf-ajax-description" data-url=""></span> -> Insert this section for description/ make sure to supply the value off data-url
                    $listingId = $list->getAttribute('data-ihf-listing-number');
                    $url = $list->find('a')[0]->getAttribute('href');
                    $address = $list->getAttribute('data-ihf-listing-address');
                    $addressSplit = ($address) ? explode(', ', $address) : false;
                    $price = ($list->find('.ihf-for-sale-price', 0)) ? trim($list->find('.ihf-for-sale-price')->text) : false;
                    $beds = ($list->find('.ihf-grid-result-basic-info-item1 b', 0)) ? trim($list->find('.ihf-grid-result-basic-info-item1 b')->text) : false;
                    $bedsAndLabel = ($list->find('.ihf-grid-result-basic-info-item1', 0)) ? trim(preg_replace('/\s+/', ' ', strip_tags($list->find('.ihf-grid-result-basic-info-item1')->innerHtml))) : false;
                    $baths = ($list->find('.ihf-grid-result-basic-info-item2 b', 0)) ? trim($list->find('.ihf-grid-result-basic-info-item2 b')->text) : false;
                    $bathsAndLabel = ($list->find('.ihf-grid-result-basic-info-item2', 0)) ? trim(preg_replace('/\s+/', ' ', strip_tags($list->find('.ihf-grid-result-basic-info-item2')->innerHtml))) : false;
                    $sqft = ($list->find('.ihf-grid-result-basic-info-item3 b', 0)) ? trim($list->find('.ihf-grid-result-basic-info-item3 b')->text) : false;
                    $sqftAndLabel = ($list->find('.ihf-grid-result-basic-info-item3', 0)) ? trim(preg_replace('/\s+/', ' ', strip_tags($list->find('.ihf-grid-result-basic-info-item3')->innerHtml))) : false;
                    $mlsAndPropertyType = ($list->find('.ihf-grid-result-mlsnum-proptype', 0)) ? explode(' | ', trim($list->find('.ihf-grid-result-mlsnum-proptype')->text)) : false;;
                    $imageUrl = ($list->find('.ihf-results-grid-photo', 0))
                        ? ($list->find('.ihf-results-grid-photo')->getAttribute('data-ihf-main-source'))
                            ? $list->find('.ihf-results-grid-photo')->getAttribute('data-ihf-main-source')
                            : $list->find('.ihf-results-grid-photo')->getAttribute('data-ihf-alternate-source')
                        : $data['default-featured-img'];

                        $image .= '<div class="fp">
                                    <a href="'.$url.'">
                                        <div class="fp-img">
                                            <canvas width="320" height="310" style="background-image: url('.$imageUrl.')"></canvas>
                                        </div>
                                        <div class="fp-overlay">
                                            <div class="btn-b">View More</div>
                                        </div>
                                    </a>
                                </div>';

                        $details .= '<div class="fp-details">
                                        <div class="fp-det">
                                            <span class="fp-price">'.$price.'</span>
                                        </div>
                                        <div class="fp-det">
                                            <span class="fp-address">
                                                '.$address.'
                                            </span>
                                        </div>
                                        <div class="fp-det">
                                            <span class="fp-beds">
                                                <em>'.$beds.'</em> Beds
                                            </span>
                                            <span class="fp-baths">
                                                <em>'.$baths.'</em> Baths
                                            </span>
                                        </div>
                                    </div>';

                        
 }

                    // Concatenated HTML
                    $response .= '<div class="fp-list">
                                    '.$image.'
                                    </div>
                                    <div class="fp-details-list">
                                         '.$details.'
                                    </div>';
               

            } else {
                $response = 'There\'s no result found.';
            }

        } else {
            $response = 'Please check for the required parameter.';
        }

        return $response;
    }


    public function ajax_ihf_listing_excerpt_by_url()
    {
        $response = false;

        if (!empty($_POST['listing-url'])) {
            $wp_remote_get = wp_remote_get($_POST['listing-url']);

            $idx_listing_page_content = $wp_remote_get['body'];

            $dom = new PHPHtmlParser\Dom;
            $dom->setOptions([
                'Strict' => false,
                'cleanupInput' => true,
                'removeScripts' => false
            ]);

            $dom->load($idx_listing_page_content);

            $contents = $dom->find('.ihf-description')->innerHtml;


            if ($contents) {
                $content_raw = trim(strip_tags($contents));
                if (strlen($content_raw) > self::$excerpt_length) {
                    $excerpt = substr($content_raw, 0, self::$excerpt_length) . '...';
                } else {
                    $excerpt = trim($contents);
                }
                $response['excerpt'] = $excerpt;
            }

            $listing_id = $dom->find('.ihf-listing-detail')->getAttribute('data-ihf-listing-number');
            if ($listing_id) {
                $response['listing_id'] = $listing_id;
            }
        }

        echo json_encode($response);
        exit();
    }
}