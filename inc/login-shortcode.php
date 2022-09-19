<?php
add_shortcode( 'untap_login', 'untp_login' );	
function untp_login()
{
	ob_start();
	if($_POST && !$_POST['untp_signup']){  
	   
	    global $wpdb;  
	   
	    //We shall SQL escape all inputs  
	    $username = $wpdb->escape($_REQUEST['username']);  
	    $password = $wpdb->escape($_REQUEST['password']);  
 
	    $login_data = array();  
	    $login_data['user_login'] = $username;  
	    $login_data['user_password'] = $password;  

	    $user_verify = wp_signon( $login_data, false );   
	   
	    if ( is_wp_error($user_verify) )   
	    {  
	    	?>
	    	<p class="error">
	    		<?php _e('Invalid login details', 'untap'); ?>
	    	</p>
	    	<?php  
	    }
	    else{ // redirect logged in user to account page
	    	if(!is_admin()){ // skip redirect on admin dashboard
	    		$account_page_url = get_permalink(UNTP_ACCOUNT_PAGE_ID); 
		     	wp_redirect($account_page_url);
		     	exit();
	    	}
	     	
	    } 
	   
	} 

	else{    
		    // No login details entered 
		 ?>  
		  
		<form id="untp-login" class="untp_form" name="form" action="<?php the_permalink(); ?>" method="post">  
		  		<label for="username"><?php _e('Username', 'untap'); ?></label>
		        <input id="username" type="text"  name="username"><br>  
		        <label for="password"><?php _e('Password', 'untap'); ?></label>
		        <input id="password" type="password"  name="password">  
		        <input type="hidden" name="untp_login" value="1">
		        <input id="submit" type="submit" name="submit" value="Submit">  
		</form>    
		<?php

	}
	return ob_get_clean();
}