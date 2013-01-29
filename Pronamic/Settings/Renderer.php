<?php

class Pronamic_Settings_Renderer {

    public function text( $args ) {
        printf(
            '<input name="%s" id="%s" type="text" value="%s" class="%s" />',
            esc_attr( $args['label_for'] ),
            esc_attr( $args['label_for'] ),
            esc_attr( get_option( $args['label_for'] ) ),
            'regular-text code'
        );
    }

    public function select( $args ) {
        $chosen = get_option( $args['label_for'] );

        $html = "<select name='{$args['label_for']}'>";

        foreach ( $args['options'] as $option ) {
            if ( $chosen == $option['value'] ) {
                $html .= "<option value='{$option['value']}' selected='selected'>{$option['label_for']}</option>";
            }
            else {
                $html .= "<option value='{$option['value']}'>{$option['label_for']}</option>";
            }
        }

        $html .= '</select>';

        echo $html;
    }

    public function textarea( $args ) {
        printf(
            '<textarea name="%s" id="%s" class="%s">%s</textarea>',
            esc_attr( $args['label_for'] ),
            esc_attr( $args['label_for'] ),
            'regular-text code',
            esc_attr( get_option( $args['label_for'] ) )
        );
    }

    public function editor( $args )
    {
        wp_editor( get_option( $args['label_for'] ), $args['label_for'] );
    }

    public function uploader( $args )
    {
        wp_enqueue_media();

        $string =   '<div class="uploader">' .
                        '<input type="text" name="%s" id="%s" value="%s" class="widefat"/>' .
                        '<input type="button" class="button button-secondary jMediaUploader" name="%s_button" id="%s_button" value="%s" />' .
                    '</div>';

        printf(
            $string,
            esc_attr( $args['label_for'] ),
            esc_attr( $args['label_for'] ),
            get_option( $args['label_for'] ),
            esc_attr( $args['label_for'] ),
            esc_attr( $args['label_for'] ),
            __( 'Upload' )
        );
    }

    public function colorpicker( $args )
    {
        wp_enqueue_style( 'wp-color-picker' );

        printf(
            '<input type="text" class="jColorPicker" name="%s" value="%s"/>',
            esc_attr( $args['label_for'] ),
            get_option( $args['label_for'] )
        );
    }
}