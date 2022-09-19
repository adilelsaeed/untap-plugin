<?php

add_shortcode('untap_signup', 'untp_signup');
function untp_signup()
{
	ob_start();
	global $wpdb, $user_ID;  
	$account_page_url = get_permalink(UNTP_ACCOUNT_PAGE_ID); 
	//Check whether the user is already logged in  
	if ($user_ID){  
	    // They're already logged in, redirect them to account page. 
	    if(!is_admin()){ // skip redirect on admin dashboard 
	     	wp_redirect($account_page_url);
	     	exit();  
     	}
	   
	} 
	else{  
	   
	    $errors = array();  
	   
	    if($_POST && !$_POST['untp_login']){  
	        // Check username is present and not already in use  
	        $username = $wpdb->escape($_REQUEST['username']);  
	        if ( strpos($username, ' ') !== false )
	        {   
	            $errors['username'] = __("Sorry, no spaces allowed in usernames", "untap");  
	        }  
	        if(empty($username)) 
	        {   
	            $errors['username'] = __("Please enter a username", "untap");  
	        } elseif( username_exists( $username ) ) 
	        {  
	            $errors['username'] = __("Username already exists, please try another", "untap");  
	        }  
	   
	        // Check email address is present and valid  
	        $email = $wpdb->escape($_REQUEST['email']);  
	        if( !is_email( $email ) ) 
	        {   
	            $errors['email'] = __("Please enter a valid email", "untap");  
	        } elseif( email_exists( $email ) ) 
	        {  
	            $errors['email'] = __("This email address is already in use", "untap");  
	        }  
	   
	        // Check password is valid  
	        if(0 === preg_match("/.{6,}/", $_POST['password']))
	        {  
	          $errors['password'] = __("Password must be at least six characters", "untap");  
	        }  
	   
	        // Check password confirmation_matches  
	        if(0 !== strcmp($_POST['password'], $_POST['password_confirmation']))
	         {  
	          $errors['password_confirmation'] = __("Passwords do not match", "untap");  
	        }  
	   
	        if(empty($errors)) 
	         {  
	   
	            $password = $_POST['password'];  
	   
	            $new_user_id = wp_create_user( $username, $password, $email );  
	   
	            // You could do all manner of other things here like send an email to the user, etc. I leave that to you.  
	   
	            $success = 1;  
	   				
	            // logged user in and redirect to account page
	            wp_set_current_user($new_user_id); // set the current wp user
    			wp_set_auth_cookie($new_user_id); // start the cookie for the current registered user
	            wp_redirect($account_page_url);
     			exit();   
	        }  
	   
	    }  
	}  
	  
	  if(!empty($errors)){
	  	echo "<div class='signup-errors'>";
	  	foreach($errors as $error){
	  		?>
	  		<p class="error"><?php echo $error; ?> </p>
	  		<?php
	  	}
	  	echo "</div>";
	  }
	?>  
	  

	<form id="untp_signup" class="untp_form" action="<?php the_permalink(); ?>" method="post">  
	  
	        <label for="username"><?php _e('Username', 'untap'); ?></label>  
	        <input type="text" name="username" id="username">  
	        <label for="email"><?php _e('Email address', 'untap'); ?></label>  
	        <input type="text" name="email" id="email">  
	        <label for="password"><?php _e('Password', 'untap'); ?></label>  
	        <input type="password" name="password" id="password">  
	        <label for="password_confirmation"><?php _e('Confirm Password', 'untap'); ?></label>  
	        <input type="password" name="password_confirmation" id="password_confirmation">  
	        <input type="hidden" name="untp_signup" value="1">
	        <input type="submit" id="submitbtn" name="submit" value="<?php _e('Sign Up', 'untap'); ?>" />  
	        
	  
	</form>  

	<?php
	return ob_get_clean();
}