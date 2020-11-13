<?php
header('Access-Control-Allow-Origin: *');

/** Check method POST  */
$request_method = isset( $_SERVER['REQUEST_METHOD'] ) && $_SERVER['REQUEST_METHOD'] && strtolower( $_SERVER['REQUEST_METHOD'] ) == 'get' ? true : false;

if ( $request_method ) {
    /** 
     * Get header Authorization
     */
    function getAuthorizationHeader(){
        $headers = null;
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        }
        else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { /** Nginx or fast CGI */
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            /** Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization) */
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            /** print_r($requestHeaders); */
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        return $headers;
    }

    /**
     * get access token from header
     */
    function getBearerToken() {
        $headers = getAuthorizationHeader();
        /** HEADER: Get the access token from the header */
        if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                return $matches[1];
            }
        }
        return null;
    }

    /**
     * remove http, www, and last /
     */
    function cleanUrl( $url ) {
        return preg_replace('#^https?://#', '', rtrim($url,'/'));
    }

    $parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
    require_once( $parse_uri[0] . 'wp-load.php' );

    if( getBearerToken() == '$2a$07$FpTV42zYaRHUCb29jHZ1OumvXoJRgCU/Nth4zT7yhxqtgG0JrQ6Dm' && $_SERVER['HTTP_USER_AGENT'] == 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:28.0) Gecko/20100101 Firefox/28.0' ) {
        $params     = explode( '&', $_SERVER['QUERY_STRING'] );
        $isp        = str_replace( 'isp=', '', $params[0] );
        $domain     = urldecode( $params[1] );
        $site       = get_site_url();
        
        if( cleanUrl( $domain ) && cleanUrl( $site ) && strpos( $_SERVER['HTTP_REFERER'], 'aios-' ) !== false ) {
            $post       = get_posts( array( 'title' => $isp, 'post_type' => 'aios-login-attempts' ));
            $isExists   = !empty( $post[0]->ID ) ? $post[0]->ID : false;
    
            if( $isp == 'all' ) {
                $args = array(
                    /** Only get post ID's to improve performance **/
                    'fields'			=> 'ids', 
                    'post_type' 		=> 'aios-login-attempts',
                    'posts_per_page' 	=> -1,
                    'showposts' 		=> -1
                );
                
                $attempts = new WP_Query( $args );
                
                if( $attempts->have_posts() && $request_method ) {
                    while( $attempts->have_posts() && $request_method ) {
                        $attempts->the_post();
                        wp_delete_post( get_the_ID(), true );
                    }
                    exit( json_encode( ['success' => 'Unblocked all ISP.'] ) );
                }
            } else {
                if( $isExists && $request_method ) {
                    wp_delete_post( $isExists, true );
                    exit( json_encode( ['success' => $isp . ' is unblocked.'] ) );
                }
            }
        }
        exit( json_encode( ['warning' => ( $isp == 'all' ? 'No blocked ISP' : $isp . ' is not blocked.' )] ) );
    } else {
        exit( json_encode( ['error' => 'Please Authorization Token.'] ) );
    }
} else {
    exit( json_encode( ['error' => 'Please Authorization Token.'] ) );
}