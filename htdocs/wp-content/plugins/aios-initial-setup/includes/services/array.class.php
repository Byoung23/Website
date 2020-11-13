<?php
/**
 * List of functions
 * to help array
 */

namespace AIOS\Services;
class ArrayHelper {

    /**
     * Implode recursive
     * 
     * @access  public
     * @param   array   $array         multi-dimensional array to recursively implode
     * @param   string  $glue          value that glues elements together	
     * @param   bool    $include_keys  include keys before their values
     * @param   bool    $trim_all      trim ALL whitespace from string
     * @since 4.1.0
     * @return string
     */
    public static function implode_recursive( array $array = array(), string $glue = null, $include_keys = false, $trim_all = true ) {
        $glued_string = '';
        /** Recursively iterates array and adds key/value to glued string */
        array_walk_recursive($array, function($value, $key) use ($glue, $include_keys, &$glued_string){
            $include_keys and $glued_string .= $key.$glue;
            $glued_string .= $value.$glue;
        });
        /** Removes last $glue from string */
        strlen($glue) > 0 and $glued_string = substr($glued_string, 0, -strlen($glue));
        /** Trim ALL whitespace */
        $trim_all and $glued_string = preg_replace("/(\s)/ixsm", '', $glued_string);
        return $glued_string;
    }

    /**
     * Is array recursive or associative
     * 
     * @access public
     * @param array $array - foreach array $item
     * @param array $alreadySeen - check if array is $alreadySeen
     * @since 4.1.0
     * @return boolean;
     */
    public static function is_array_recursive( $array ) {
        $array = is_array( $array ) ? $array : array( $array );
		if( array_keys($array) !== range(0, count($array) - 1) )
			return true;
		return false;
    }

    /** 
     * Check if $key_value exists in recursive array
     * 
     * @access public
     * @since 4.1.0
     * @param array $array - recursive array
     * @param string $key
     * @param array|string $key_value
     * @return bool
     */
    public static function isin_array_recursive($array, $key, $key_value){
        if( is_array( $array ) ) $array = array( $array );
        $within_array = 'no';
        foreach( $array as $k => $v ){
            if( is_array($v) ){
                $within_array = is_in_array( $v, $key, $key_value );
                if( $within_array == 'yes' ){
                    return true;
                    break;
                }
            } else {
                if( $v == $key_value && $k == $key ){
                    $within_array = 'yes';
                    return true;
                    break;
                }
            }
        }
        return false;
    }

    /**
     * Remove slashes on different levels of array
     * 
     * @access public
     * @since 4.1.4
     * @param array $array - force array
     * @return array
     */
    public static function stripslashes_deep( array $array ) {
        $array = is_array($array) ? array_map('stripslashes_deep', $array) : stripslashes($array);
        return $array;
    }

    
}