<?php

/*
 * Component Version: 1.0
 * Class Version: 1.0
 */
class Pronamic_Helper_Upload {

    public static function inputs( $name, $id, $value ) {
        $input_text = Pronamic_Helper_Html::text(
            $name,
            $name,
            $value,
            array( 'widefat' )
        );

        $input_button = Pronamic_Helper_Html::button(
            $name . '_button',
            $name . '_button',
            __( 'Upload' ),
            array( 'button', 'button-secondary', 'jMediaUploader' )
        );

        $string = "<div class='uploader'>";
        $string .= $input_text;
        $string .= $input_button;
        $string .= "</div>";

        return $string;
    }

    public static function scripts() {
        wp_enqueue_media();
        return "
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
                                input = self.attr('id').replace('_button', ''),
                                send_attachment_old = wp.media.editor.send.attachment;

                            wp.media.editor.send.attachment = function(props, attachment) {
                                $('#' + input).val(attachment.url);
                                wp.media.editor.send.attachment = send_attachment_old;
                            };

                            wp.media.editor.open(self);
                        }
                    };

                    PF_Upload.ready();
                });
            </script>

        ";
    }
}