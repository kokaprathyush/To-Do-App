<?php
function add_styles(){
	wp_enqueue_style("style",get_stylesheet_uri());
	wp_enqueue_style("bootstrap",get_template_directory_uri()."/bower_components/bootstrap/dist/css/bootstrap.min.css");
	wp_enqueue_script("jquery",get_template_directory_uri()."/bower_components/jquery/dist/jquery.min.js");
	wp_enqueue_script("bootstap-min",get_template_directory_uri()."/bower_components/bootstrap/dist/js/bootstrap.min.js","jquery");
	wp_enqueue_script("index",get_template_directory_uri()."/index.js","jquery",false);
}
add_action('template_redirect', 'redirect');
add_action('wp_enqueue_scripts','add_styles');
add_action('wp_ajax_nopriv_creating_user','creating_user');
add_action('wp_ajax_creating_user','creating_user');
add_action("wp_ajax_wp_save_as_post","save_as_post");
add_action("wp_ajax_nopriv_wp_save_as_post", "save_as_post");
add_action("wp_ajax_get_data","get_data");
add_action("wp_ajax_nopriv_get_data","get_data");
add_action("wp_ajax_delete_post","delete_post");
add_action("wp_ajax_nopriv_delete_post","delete_post");
add_action("wp_ajax_redirect", "redirect");
add_action("wp_ajax_nopriv_redirect","redirect");
add_action("wp_ajax_signout","signout");
add_action("wp_ajax_nopriv_signout","signout");
// ========== Creating a new user(SignUp) ========== //
function creating_user(){
	$usn = $_POST['usn'];
	$email = $_POST['email'];
	$pwd = $_POST['pwd'];
	$user_data = array(
		'user_login' => $usn,
		'user_email' => $email,
		'user_pass' => $pwd
	);
	$user_id = wp_insert_user($user_data);
	$user = new WP_User( $user_id );
  	$user->set_role( 'author' );
	if(!is_wp_error($user_id)){
		$cred = array ('user_login' => $usn, 'user_password' => $pwd, 'remember' => true);
  		$user_login = wp_signon($cred,false);
  		if($user_login){
  			echo "User Created and successfully logged in";
  		}
  		else{
  			echo "Failed to create User" ;
  		}
	}
}
add_action('wp_ajax_login','login');
add_action('wp_ajax_nopriv_login','login');

// ========== Login feature ========== //
function login(){
	$credentials = array();
	$credentials['user_password'] = $_POST['password'];
	$credentials['user_login'] = $_POST['username'];
	$credentials['remember'] = true;
	$user = wp_signon($credentials,false);
	if($user){

		echo "Success";
	}
	else{
		echo "Failed";
	}
}
// ========== Saving the post ========== //
function save_as_post(){
	$title = $_POST['header'];
	$content = $_POST['content'];
	$post_id = post_exists($title);
	$postarr = array ('ID' => $post_id, 'post_title' => $title, 'post_content' => $content);
	$post_id = wp_insert_post($postarr);	
	if($post_id != 0){	
		wp_publish_post($post_id);
		echo "Sucess";
	}
	else{
		echo "Failure";
	}
	wp_die();
}
// ========== Gets data into input fields for editing ========== // 
function get_data(){
	$post_id = $_POST['post_id'];
	if($post_id != 0){
		$post_title = get_the_title($post_id);
		$post = get_post($post_id);
		$post_content = $post->post_content;
		echo $post_title.','.$post_content;
		die();	
	}
}

// ========== Deleting a Post ========== //
function delete_post(){
	$post_id = $_POST["post_del_id"];
	$result = wp_delete_post($post_id);
	if($result == false){
		echo "Unable to delete";
	}
	else{
		echo "Deleted Successfully"	;
	}
}

// ========== Page redirecting is done here ========== //
function redirect(){
	if (!is_page( 'to-do-list' ) && is_user_logged_in()){	// After login or signup page redirects to to-do-list
		wp_redirect(home_url('/to-do-list/'));
		die();
	}
	else if(is_page('to-do-list') && !is_user_logged_in()){	// Without logging-in if user tries to access to-do-list it redirects to home	
		wp_redirect(home_url('/'));
		exit();
	}		
}

// ========== SignOut ========== //
function signout(){
	wp_logout();
	redirect();
}

