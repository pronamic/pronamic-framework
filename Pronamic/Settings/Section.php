<?php

/*
 * Component Version: 1.0
 * Class Version: 1.0
 */
class Pronamic_Settings_Section {

    
    /**
     * Unique name for this settings section
     * @var string
     */
    private $_name;
    
    /**
     * Title for this section
     * @var string
     */
    private $_title;
    
    /**
     * Page for this to show up on
     * @var string
     */
    private $_page_slug;
    
    /**
     * The details to show under this sections title
     * @var string
     */
    private $_details;
    
    /**
     * The class that makes the settings fields
     * @var Pronamic_Settings_Renderer
     */
    private $_renderer;
    
    /**
     * All fields associated with this section
     * @var array
     */
    private $_fields = array();
    
    /**
     * All the ID's of all fields
     * @var array
     */
    private $_fields_ids = array();
    
    public function __construct( $id, $title = null, $page_slug = null ) {
        $this->_id          = $id;
        $this->_title       = $title;
        $this->_page_slug   = $page_slug;
    }
    
    public function set_title( $title ) {
        $this->_title = $title;
        return $this;
    }
    
    public function get_title() {
        return $this->_title;
    }
    
    public function set_page( $page_slug ) {
        $this->_page_slug = $page_slug;
        return $this;
    }
    
    public function get_page() {
        return $this->_page_slug;
    }
    
    public function set_details( $details ) {
        $this->_details = $details;
        return $this;
    }
    
    public function get_details() {
        return $this->_details;
    }
    
    public function set_field_renderer( Pronamic_Settings_Renderer $renderer ) {
        $this->_renderer = $renderer;
        return $this; 
    }
    
    public function add_field( Pronamic_Settings_Field $field ) {
        $this->_fields[] = $field;
        return $this;
    }
    
    public function register( $option_group ) {
            
        // Make this section    
        add_settings_section(
            $this->_id,
            $this->_title,
            array( $this, 'get_details' ),
            $this->_page_slug
        );
        
        // Register all the fields for this section
        foreach( $this->_fields as $field ) {
            add_settings_field(
                $field->get_id(),
                $field->get_title(),
                array( $this->_renderer, $field->get_type() ),
                $this->_page_slug,
                $this->_id,
                $field->get_args()
            );
            
            // Add the ids to an array...
            $this->_fields_ids[] = $field->get_id();
        }
        
        // ...to register the settings finially
        foreach( $this->_fields_ids as $id ) {
            register_setting( $option_group, $id );
        }
    }    
}