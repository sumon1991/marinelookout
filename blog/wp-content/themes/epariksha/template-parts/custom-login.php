<?php
/*
 *
 Template Name:Custom Login
 *
 */
define('WP_USE_THEMES', false);
get_header();
     $creds = array(); 
    $creds['user_login'] = $_GET['username']; 
    $creds['user_password'] = $_GET['password']; 
    $creds['remember'] = true; 
        
    $user = wp_signon( $creds, true );  
    if( is_wp_error($user)) 
    { 
      echo 'oops!! we got some error in sigining in '.$user->get_error_message(); 
    }else{ 
      echo '<br>User is now logged in !!<br>'; 
   }         
get_footer();