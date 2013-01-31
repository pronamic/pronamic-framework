<?php

class Pronamic_Helper_Html {
    public static function text( $name, $id, $value, $classes = array() ) {

        $input  = "<input type='text' name='";
        $input .= esc_attr( $name );
        $input .="' id='";
        $input .= esc_attr( $id );
        $input .="' value='";
        $input .= esc_attr( $value );
        $input .="'";

        if ( ! empty( $classes ) ) {
            $input .= ' class="' . implode(' ', $classes ) . '"';
        }

        $input .= '>';

        return $input;
        
    }

    public static function select( $name, $id, $value, $options = array(), $classes = array() ) {
  
        $input  = "<select name='";
        $input .= esc_attr( $name );
        $input .="' id='";
        $input .= esc_attr( $id );
        $input .="'";

        if ( ! empty( $classes ) )
            $input .= ' class="' . implode(' ', $classes ) . '"';

        $input .= '>';

        foreach ( $options as $name => $v ) {
            $input .= "<option value='" . esc_attr( $v ) . "'";
             
            if ( $value == $v ) 
                $input .= 'selected="selected"';
            
            $input .= '>';
            $input .= esc_attr( $name );
            $input .= '</option>';
        }

        $input .= '</select>';

        return $input;
    }

    public static function textarea( $name, $id, $value, $classes = array() ) {
        $input = "<textarea name='{$name}' id='{$id}'";

        if ( ! empty( $classes ) )
            $input .= ' class="' . implode(' ', $classes ) . '"';
        
        $input .= '>';

        $input .= $value;
        $input .= '</textarea>';

        return $input;

    }

    public static function button( $name, $id, $value, $classes = array() ) {
        $input = "<input type='button' name='{$name}' id='{$id}' value='{$value}'";

        if ( ! empty( $classes ) )
            $input .= ' class="' . implode(' ', $classes ) . '"';
        
        $input .= '>';

        return $input;
    }
    
    public static function radio( $name, $id, $value, $current, $classes = array() ) {
        $input  = "<label>";
        $input .= $value;
        $input .= "</label>";
        $input .= "<input type='radio' name='";
        $input .= esc_attr( $name );
        $input .= "' id='";
        $input .= esc_attr( $id );
        $input .= "' value='";
        $input .= esc_attr( $value );
        $input .= "'";
        
        if ( ! empty( $current ) && $value == $current )
            $input .= ' checked="checked"';
        
        if ( ! empty( $classes ) )
            $input .= ' classes="' . impode( ' ', $classes ) . '"';
        
        $input .= ' />';
        
        return $input;
    }
    
    public static function hidden( $name, $id, $value ) {
        $input  = "<input type='hidden' name='";
        $input .= esc_attr( $name );
        $input .="' id='";
        $input .= esc_attr( $id );
        $input .="' value='";
        $input .= esc_attr( $value );
        $input .="'";
        $input .= '>';

        return $input;
    }
    
    public static function password( $name, $id, $value, $classes = array() ) {
        $input  = "<input type='password' name='";
        $input .= esc_attr( $name );
        $input .="' id='";
        $input .= esc_attr( $id );
        $input .="' value='";
        $input .= esc_attr( $value );
        $input .="'";

        if ( ! empty( $classes ) ) {
            $input .= ' class="' . implode(' ', $classes ) . '"';
        }

        $input .= '>';

        return $input;
    }
}