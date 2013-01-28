<?php

class Pronamic_Settings_Field {
    
    private $_id;
    
    private $_title;
    
    private $_type;
    
    private $_args = array();
    
    public function __construct( $id, $title = null, $type = null ) {
        $this->_id      = $id;
        $this->_title   = $title;
        $this->_type    = $type;
        
        $this->_args = array( 'label_for' => $id );
    }
    
    public function get_id() {
        return $this->_id;
    }
    
    public function set_title( $title ) {
        $this->_title = $title;
        return $this;
    }
    
    public function get_title() {
        return $this->_title;
    }
    
    public function set_type( $type ) {
        $this->_type = $type;
        return $this;
    }
    
    public function get_type() {
        return $this->_type;
    }
    
    public function set_argument( $key, $value ) {
        $this->_args[$key] = $value;
        return $this;
    }
    
    public function get_args() {
        return $this->_args;
    }
}