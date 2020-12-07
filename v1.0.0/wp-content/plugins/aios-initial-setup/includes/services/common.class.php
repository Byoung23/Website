<?php
/**
 * List of functions
 * to help array
 */

namespace AIOS\Services;
class CommonHelper {

    /**
     * Create correctly writable folder.
     * Check if folder exist and writable.
     * If not exist try to create it one writable.
     *
     * @return bool
     *     true folder has been created or exist and writable. 
     *     False folder not exist and cannot be created. 
     */
    public static function createWritableFolder( $folder ) {
        if( $folder != '.' && $folder != '/' ) self::createWritableFolder( dirname($folder) );
        if( file_exists( $folder ) ) return is_writable( $folder );

        return is_writable( $folder ) && mkdir( $folder, 0777, true );
    }
    
}