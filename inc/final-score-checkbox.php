<?php
/* Create a custom checkbox in the “Final Score” field general settings says “This field will hold the
final score”.
*/

add_action( 'gform_field_standard_settings', 'untp_final_score_field_setting', 10, 2 );
function untp_final_score_field_setting( $position, $form_id ) {
    $score_form = GFAPI::get_form( $form_id );
    //create settings on position 25 (right after Field Label)
    if ($form_id == 1 && $position == 25 ) {
        ?>
        
        <li class="final_score_setting field_setting">
            <input type="checkbox" id="final_score_check" onclick="SetFieldProperty('final_score_check', this.checked);"/>
            <label for="final_score_check" style="display:inline;">
                <?php _e("This field will hold the final score", "untap"); ?>      
            </label>
        </li>

        <?php
    }
}

//Action to inject supporting script to the form editor page
add_action( 'gform_editor_js', 'untp_gform_editor_script' );
function untp_gform_editor_script(){
    ?>
    <script type='text/javascript'>
        //adding setting to fields of type "text"
        fieldSettings.text += ', .final_score_setting';
        //binding to the load field settings event to initialize the checkbox
        jQuery(document).on('gform_load_field_settings', function(event, field, form){
            jQuery( '#final_score_check' ).prop( 'checked', Boolean( rgar( field, 'final_score_check' ) ) );
        });
    </script>
    <?php
}
