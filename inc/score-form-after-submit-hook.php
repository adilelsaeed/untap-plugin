<?php
/*
check if a field is the final score field and assign the sum of (Score 1 +
Score 2 + Score 3) in it on score form
*/
add_action( 'gform_after_submission', 'untp_final_score_sum', 10, 2 );
function untp_final_score_sum($entry, $form)
{
	$form_id = rgar($form, 'id');
	// trigger only on final score form
	if($form_id != UNTP_SOCRE_FORM_ID) return;

	$score_field = GFAPI::get_field($form, UNTP_FINAL_SCORE_FIELD_ID);
	
    $final_score_check = rgar($score_field, 'final_score_check');
    // check if the field is the final score field
    if($final_score_check){
	    $score1 = rgar($entry, UNTP_SCORE1_FIELD_ID);
	    $score2 = rgar($entry, UNTP_SCORE2_FIELD_ID);
	    $score3 = rgar($entry, UNTP_SCORE3_FIELD_ID);
    	$final_score = $score1 + $score2 + $score3;
    	$entry_id = rgar($entry, 'id');
    	// update final score 
    	GFAPI::update_entry_field( $entry_id, 7, $final_score );
    }
    
}