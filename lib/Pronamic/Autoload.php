<?php

class Pronamic_Autoload
{
    public static $directories = array();
    
    public static function register() {
        spl_autoload_register( array( __CLASS__, 'autoload' ) );
    }
    
    public static function autoload( $name ) {
        $name = str_replace( '\\', DIRECTORY_SEPARATOR, $name );
        $name = str_replace( '_',  DIRECTORY_SEPARATOR, $name );

        foreach ( self::$directories as $directory ) {
            
            $file = $directory . DIRECTORY_SEPARATOR . $name . '.php';
            
            if ( is_readable( $file ) ) {
                    require_once $file;
                    
                    break;
            }
        }
    }
    
    public static function add_directory( $directory ) {
            self::$directories[] = $directory;
    } 
}