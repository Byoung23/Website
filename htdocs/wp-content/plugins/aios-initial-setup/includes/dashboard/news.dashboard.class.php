<?php
if ( !class_exists( 'aios_initial_setup_news_dashboard' ) ) {
	
	class aios_initial_setup_news_dashboard {

		public function __construct() { $this->add_actions(); }

		/**
		 * Add Actions.
		 *
		 * @since 3.8.8
		 * @access protected
		 */
		protected function add_actions() {
            add_action( 'init', array( $this, 'get_agentimage_details' ) );
            add_action( 'wp_dashboard_setup', array( $this, 'amnwidget' ), 999 );
        }

        /**
		 * Global declare $jsondata_ai_details but this need to be transfer once init.dashboard.class.php is used
		 *
		 * @since 3.8.8
		 * @return string
		 */
		public function get_agentimage_details(){
            global $jsondata_ai_details;
            $json_ai_url_details = 'https://resources.agentimage.com/plugins/aios-initial-setup/agentimage-info.json';
            
            function curl_get_ai_details($url) {
                $ch = curl_init();
                curl_setopt( $ch, CURLOPT_URL, $url );
                curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
                curl_setopt( $ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13' );
                $data = curl_exec($ch);
                curl_close($ch);
                return $data;
            }
    
            $jsondata_ai_details = curl_get_ai_details( $json_ai_url_details );
            $jsondata_ai_details = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $jsondata_ai_details), true );
    
        }

        /**
         * Add dashboard meta box
         * 
         * @since 3.8.8
         * @return string
         */
        public function amnwidget() {

            remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
            remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );		
            remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
            remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
            remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
            
            remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
            remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
            remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
            remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );
            remove_meta_box( 'agent_image_news-dashboard-widget', 'dashboard', 'side' );

            add_meta_box( 
                'amnwidget', 
                'Agent Image News', 
                array( $this, 'amn_widget_display' ), 
                'dashboard', 
                'side',
                'high'
            );
    
        }
        
        /**
         * Callback function for Agent Image News
         * 
         * @since 3.8.8
         * @return string
         */
        public function amn_widget_display( $post, $callback_args ) {
            global $jsondata_ai_details;

            /** Get RSS Feed(s) */
            require_once( ABSPATH . WPINC . '/feed.php' );

            $maximum_number_of_items_to_show = 3;

            $subtitle = ( isset( $jsondata_ai_details['sub-title' ] ) ? $jsondata_ai_details['sub-title' ] : '' );
            $sales = ( isset( $jsondata_ai_details['phone']['sales'] ) ? $jsondata_ai_details['phone']['sales'] : '' );
            $support = ( isset( $jsondata_ai_details['phone']['support'] ) ? $jsondata_ai_details['phone']['support'] : '' );

            $feed_content = '<div class="amw-logo">
                <a href="//www.agentimage.com/" target="_blank" class="amw-logo-link">
                    <em class="ai-font-agentimage-logo"></em>
                    <span class="amw-sub">' . $subtitle . '</span>
                </a>
                <div class="amn-contact-details">
                    <span class="sales-btn">
                        Sales
                        <a href="tel:' . $sales . '"><i class="ai-font-phone"></i> ' . $sales . '</a>
                    </span>
                    <span class="support-btn">
                        Support
                        <a href="//www.agentimage.com/support/" class="ai-num-dark"><i class="ai-font-phone"></i> ' . $support . '</a>
                    </span>
                </div>
            </div>';
        
            /** Get a SimplePie feed object from the specified feed source. */
            $rss = fetch_feed( $jsondata_ai_details['feed_uri'] );
        
            $max_items = 0;
            /** Checks that the object is created correctly */
            if ( !is_wp_error( $rss ) ) {
                /** Figure out how many total items there are. */
                $max_items = $rss->get_item_quantity( $maximum_number_of_items_to_show ); 

                /** Build an array of all the items, starting with element 0( i.e. first element ). */
                $rss_items = $rss->get_items( 0, $max_items );
            }
        
            if ( $max_items == 0 ) {
                $feed_content = '<div class="no-items-to-show">Refresh to load news.</div>';
            } else {
                $feed_content .= '<div class="rss-widget"><ul>';
                foreach ( $rss_items as $rss_item ) {
                
                    $enclosure = $rss_item->get_enclosure();
                    $rss_item_title = $rss_item->get_title();
                    $rss_item_page_url = $rss_item->get_permalink();
                    $rss_item_date = $rss_item->get_date( 'M j, Y' );

                    $rss_item_content = $rss_item->get_content();

                    /**
                     * Get image inside <featuredimage>
                     * featuredimage - inserted using add_filter rss
                     */
                    $regex = sprintf('/\<img class="rss-ai-feed" src="%s(.*?)"\>/', $jsondata_ai_details['feed_image_regex']);
                    preg_match( $regex , $rss_item_content, $featured_image );
                
                    /** Cut off the rss_item_content and strip html tags */
                    $rss_item_excerpt = strip_tags( $rss_item_content );
                    if ( ( $char_count = strlen( $rss_item_excerpt ) ) > 250 ) {
                        /** Cut characters */
                        $rss_item_excerpt = substr( $rss_item_excerpt, 0, 250 );
                        /** Remove up until the last occurence of a space */
                        $rss_item_excerpt = substr( $rss_item_excerpt, 0, strrpos( $rss_item_excerpt, ' ' ) );
                        /** Add ellipsis */
                        $rss_item_excerpt .= '...';
                    }
                
                    $feed_content .= '<li>
                        <div class="rssTitle">
                            <a class="rsswidget" href="' . $rss_item_page_url . '" target="_blank">' . $rss_item_title . '</a>
                            <span class="rss-date">' . $rss_item_date . '</span>
                        </div>
                        <div class="rssContainer">
                            <div class="rssSummaryImg">
                                <a class="rsswidget" href="' . $rss_item_page_url . '" target="_blank">
                                    <canvas width="300" height="100" style="background-image: url( https://www.agentimage.com/' . $featured_image[1] . ' );"></canvas>
                                </a>
                            </div>
                            <div class="rssSummary">' . $rss_item_excerpt . '</div>
                        </div>
                    </li>';
                }
                $feed_content .= '</ul></div>';
            }

            $feed_content .= '<a href="//www.agentimage.com/blog/" target="_blank" class="amn-more-tips">More Real Estate Marketing Tips</a>';
        
            echo $feed_content;
        }

    }

    $aios_initial_setup_news_dashboard = new aios_initial_setup_news_dashboard();

}