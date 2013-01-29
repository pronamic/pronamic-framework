<?php

class Pronamic_Settings_Renderer {

    public function text( $args ) {

        echo Pronamic_Helper_Html::text( 
            $args['label_for'], 
            $args['label_for'], 
            get_option( $args['label_for'] ), 
            array('regular-text', 'code') 
        );
    }

    public function select( $args ) {
        
        echo Pronamic_Helper_Html::select(
            $args['label_for'],
            $args['label_for'],
            get_option( $args['label_for'] ),
            $args['options']
        );
    }

    public function textarea( $args ) {

        echo Pronamic_Helper_Html::textarea(
            $args['label_for'],
            $args['label_for'],
            get_option( $args['label_for'] ),
            array( 'regular-text', 'code' )
        );
    }

    public function editor( $args ) {
        wp_editor( 
            get_option( $args['label_for'] ), 
            $args['label_for'] 
        );
    }

    public function upload( $args ) {
        wp_enqueue_media();

        $input_text = Pronamic_Helper_Html::text(
            $args['label_for'],
            $args['label_for'],
            get_option( $args['label_for'] ),
            array( 'widefat' )
        );

        $input_button = Pronamic_Helper_Html::button(
            $args['label_for'] . '_button',
            $args['label_for'] . '_button',
            __( 'Upload' ),
            array( 'button', 'button-secondary', 'jMediaUploader' )
        );

        echo "<div class='uploader'>";
        echo $input_text;
        echo $input_button;
        echo "</div>";

        echo "
            <script type='text/javascript'>
                jQuery(document).ready(function($){
                    var PF_Upload = {
                        button: '',
                        ready: function() {
                            PF_Upload.button = $('.jMediaUploader');
                            PF_Upload.binds();
                        },
                        binds: function() {
                            PF_Upload.button.click(PF_Upload.do_upload);
                        },
                        do_upload: function(e) {
                            e.preventDefault();
                            var self = $(this),
                                input = self.attr('id').replace('_button', '');

                            wp.media.editor.send.attachment = function(props, attachment) {
                                $('#' + input).val(attachment.url);
                            };

                            wp.media.editor.open(self);
                        }
                    };

                    PF_Upload.ready();
                });
            </script>
        ";
    }

    public function colorpicker( $args ) {
        wp_enqueue_script( 'wp-color-picker');
        wp_enqueue_style( 'wp-color-picker' );

        echo Pronamic_Helper_Html::text(
            $args['label_for'],
            $args['label_for'],
            get_option( $args['label_for'] ),
            array( 'jColorPicker' )
        );

        echo "
            <script type='text/javascript'>
                jQuery(document).ready(function($){
                    var PF_ColorPicker = {
                        element:'',
                        ready: function() {
                            PF_ColorPicker.element = $('.jColorPicker');

                            PF_ColorPicker.binds();
                        },
                        binds: function() {
                            PF_ColorPicker.element.wpColorPicker();
                        }
                    };

                    PF_ColorPicker.ready();
                });
            </script>
        ";
    }
    
    public function radio( $args ) {
        
        $values = array();
        if ( ! empty( $args['values'] ) ) {
            foreach( $args['values'] as $value ) {
                echo Pronamic_Helper_Html::radio(
                    $args['label_for'],
                    $args['label_for'],
                    $value,
                    get_option( $args['label_for'] )
                );
            }
        }
    }
    
    public function password( $args ) {
        echo Pronamic_Helper_Html::password( 
            $args['label_for'], 
            $args['label_for'], 
            null, 
            array('regular-text', 'code') 
        );
    }
    
    public function hidden( $args ) {
        echo Pronamic_Helper_Html::hidden( 
            $args['label_for'], 
            $args['label_for'], 
            get_option( $args['label_for'] ), 
            array('regular-text', 'code') 
        );
    }
}