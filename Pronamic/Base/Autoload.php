<?php

/*
 * Component Version: 1.0
 * Class Version: 1.0
 */
class Pronamic_Base_Autoload {
    
    public static $instance = null;
    
    /**
     * Collection of all registered components
     * 
     * @see register_components()
     * @var array
     */
    private $_components = array();
    
    /**
     * Collection of all registered classes
     * 
     * @see register_classes()
     * @var array
     */
    private $_classes = array();
    
    /**
     * Collection of all registered folders
     * 
     * @see register_folders()
     * @var array
     */
    private $_folders = array();
    
    public static function get_instance() {
        if ( ! isset( self::$instance ) )
            self::$instance = new Pronamic_Base_Autoload();
        
        return self::$instance;
    }
    
    public function register() {
        spl_autoload_register( array( $this, 'autoload' ) );
    }
    
    public function unregister() {
        spl_autoload_unregister( array( $this, 'autoload' ) );
    }
    
    /**
     * Here you can register the components that you wish to use, and the location to their
     * folders. It will get from the contents, the latest version from the registration
     *         
     * Usage:
     * 
     * $autoload->register_components( array( 
     *     'Pronamic\Base' => __DIR__ . '/pronamic-framework',
     *     'Pronamic\Settings' => __DIR__ . '/pronamic-framework'
     * ) );
     * 
     * @param  array  $components [description]
     */
    public function register_components( $components = array() ) {
        if ( is_array( $components ) && ! empty( $components ) ) {
            
            foreach ( $components as $name => $directory ) {
                
                if ( array_key_exists( $name, $this->_components ) ) {
                    
                    $existing_component_version = $this->get_component_version( $this->_components[$name], $name );
                    $new_component_version = $this->get_component_version( $directory, $name );
                    
                    if ( $new_component_version > $existing_component_version ) {
                        $this->_components[$name] = $directory;  
                    }
                    
                } else {
                    $this->_components[$name] = $directory;    
                }
                
            }
            
        }
    }
    
    /**
     * Will return the component version from the first class it finds
     * 
     * Usage:
     * 
     * $version = $autoload->get_component_version( __DIR__ . '/pronamic-framework', 'Pronamic/Base' );
     * 
     * @param  string $component_directory | The Directory to the component
     * @return string                      | The version number
     */
    public function get_component_version( $component_directory, $name ) {
        $files = glob( $component_directory . DIRECTORY_SEPARATOR . $name . '/*.php' );
        
        if ( ! empty( $files ) ) {
            $file_data = get_file_data( $files[0], array( 'ComponentVersion' => 'Component Version' ) );
            
            return $file_data['ComponentVersion'];
        }
    }
    
    /**
     * Here you can specify the exact classes location.  It will get the version number from
     * the class and check a later version is already register elsewhere
     * 
     * Usage:
     * 
     * $autoload->register_classes( array( 
     *     'Pronamic\\Base\\View' => __DIR__ . '/pronamic-framework/Pronamic/Base/View.php',
     *     'Pronamic\\Settings\\Field' => __DIR__ . '/pronamic-framework/Pronamic/Settings/Field.php'
     * ) );
     * 
     * @param  array  $classes [description]
     * @return [type]          [description]
     */
    public function register_classes( $classes = array() ) {
        if ( is_array( $classes ) && ! empty( $classes ) ) {
            
            foreach ( $classes as $class => $directory ) {
                
                if ( array_key_exists( $class, $this->_classes ) ) {
                    
                    $existing_registered_version = $this->get_class_version( $this->_classes[$class] );
                    $new_registered_version = $this->get_class_version( $directory );
                    
                    if ( $new_registered_version > $existing_registered_version ) {
                        $this->_classes[$class] = $directory;
                    }
                    
                } else {
                    $this->_classes[$class] = $directory;
                }
                
            }
        }
    }
    
    /**
     * Will return the Version of the class
     * 
     * Usage:
     * 
     * $version = $autoload->get_class_version( __DIR__ . '/pronamic-framework/Pronamic/Base/View.php' );
     * 
     * @param  string $class_file | The full root to the class file, included extension
     * @return string             | The version number
     */
    public function get_class_version( $class_file ) {
        if ( is_readable( $class_file ) ) {
            $file_data = get_file_data( $class_file, array( 'ClassVersion' => 'Class Version' ) );
            
            return $file_data['ClassVersion'];
        }
    }
    
    /**
     * Adds folders to the autoloader, anything here has the highest priority
     * 
     * Usage:
     * 
     * $autoload->register_folders( array(
     *     __DIR__ . '/lib'
     * ) );
     * 
     * @param  array  $folders | Locations of the folders
     * @return void
     */
    public function register_folders( $folders = array() ) {
        if ( is_array( $folders ) && ! empty( $folders ) )
            $this->_folders = array_merge( $folders, $this->_folders );
    }
    
    /**
     * The autoload method that will check through the folders entries first, then the
     * classes and finially components
     * 
     * This allows you to overide components with specific classes, or overide those classes
     * and components with your plugin specific classes
     * 
     * @param  string $class_name | The class name written
     */
    public function autoload( $class_name ) {
        // Get the class name into folder structure
        $class_name = str_replace( ['\\', '_'], DIRECTORY_SEPARATOR, $class_name );
        
        if ( $file = $this->_check_folders( $class_name ) ) {
            require_once $file;        
        } else if ( $file = $this->_check_classes( $class_name ) ) {
            require_once $file;
        } else if ( $file = $this->_check_components( $class_name ) ) {
            require_once $file;
        }
        
    }
    
    /**
     * Will look for the class inside the registered folders array
     * 
     * @param  string $class_name | The prepared class name
     * @return path/false         | Either the path to the class or false
     */
    private function _check_folders( $class_name ) {
        
        foreach ( $this->_folders as $folder ) {
            $path = $folder . DIRECTORY_SEPARATOR . $class_name . '.php';
            
            if ( is_readable( $path ) )
                return $path;
        }
        
        return false;
    }
    
    /**
     * Will look for the class inside the registered classes array
     * 
     * @param  string $class_name | The prepared class name
     * @return path/false         | Either the path to the class or false
     */
    private function _check_classes( $class_name ) {
        
        if ( array_key_exists( $class_name, $this->_classes ) ) {
            
            if ( is_readable( $this->_classes[$class_name] ) )
                return $this->_classes[$class_name];
        }
        
        return false;
            
    }
    
    /**
     * Will finially look for the class inside the registered components array
     * 
     * @param  string $class_name | The prepared class name
     * @return path/false         | Either the path to the class or false
     */
    private function _check_components( $class_name ) {
        
        $components = array_keys( $this->_components );
        
        foreach ( $components as $component ) {
            $position = strpos( $class_name, $component );
            
            if ( $position !== false ) {
                // Use the directory of this registered component
                $directory = $this->_components[$component];    
                $path = $directory . DIRECTORY_SEPARATOR . $class_name . '.php';
                
                if ( file_exists( $path ) )
                    return $path;
            }
        }
        
        return false;
    }
}