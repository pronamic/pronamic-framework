<?php

class Pronamic_Helper_Html {
    public static function text( $name, $id, $value, $classes = array() ) {

        $input = "<input type='text' name='{$name}' id='{$id}' value='{$value}'";

        if ( ! empty( $classes ) ) {
            $input .= ' class="' . implode(' ', $classes ) . '"';
        }

        $input .= '>';

        return $input;
        
    }

    public static function select( $name, $id, $value, $options = array(), $classes = array() ) {
  
        $input = "<select name='{$name}' id='{$id}'";

        if ( ! empty( $classes ) ) {
            $input .= ' class="' . implode(' ', $classes ) . '"';
        }

        $input .= '>';

        foreach ( $options as $option ) {
            if ( $value == $option['value'] ) {
                $input .= "<option value='{$option['value']}' selected='selected'>{$option['text']}</option>";
            } else {
                $input .= "<option value={$option['value']}>{$option['text']}</option>";    
            }
        }

        $input .= '</select>';

        return $input;
    }

    public static function textarea( $name, $id, $value, $classes = array() ) {
        $input = "<textarea name='{$name}' id='{$id}'";

        if ( ! empty( $classes ) ) {
            $input .= ' class="' . implode(' ', $classes ) . '"';
        }

        $input .= '>';

        $input .= $value;
        $input .= '</textarea>';

        return $input;

    }

    public static function button( $name, $id, $value, $classes = array() ) {
        $input = "<input type='button' name='{$name}' id='{$id}' value='{$value}'";

        if ( ! empty( $classes ) ) {
            $input .= ' class="' . implode(' ', $classes ) . '"';
        }

        $input .= '>';

        return $input;
    }
}