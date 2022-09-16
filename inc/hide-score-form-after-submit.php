<?php
/* Hide score form if user already submitted the form */

add_filter( 'the_content', 'untp_submitted_form_check',1);
function untp_submitted_form_check($content){
	//This is only relevant to users who are logged and the account page
    if(!is_user_logged_in() || get_the_ID() != UNTP_ACCOUNT_PAGE_ID) return $content;

    $current_user = wp_get_current_user();//The curent user    
    $date = strtotime(current_time( 'mysql' ). ' -1 year'); //Today minus one year 
    $startdate= date('Y-m-d', $date); //Today minus one year (Y-m-d format) 
    $enddate = current_time( 'mysql' ); // Today
    
    $search_criteria = array(
        'status'     => 'active', //Active forms 
        'start_date' => $startdate, //Get entires starting one year ago 
        'end_date'   => $enddate,   //upto now
        'field_filters' => array( //which fields to search
        
            array(
            
                'key' => 'created_by', 'value' => $current_user->ID, //Current logged in user
            )
          )
        );

    // Now the main Gravity form api function to count the entries 
    // using our custom search criteria.
    $entry_count = GFAPI::count_entries( UNTP_SOCRE_FORM_ID, $search_criteria );

	if($entry_count >= "1") { // If they have submitted the form:
	    return __('Hello ', 'untap') . $current_user->display_name . __(' You have submitted the form.', 'untap');
	} else {
	// return content which will have form shortcode 
	return $content;
	} 
}
