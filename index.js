jQuery(document).ready(function(){

	jQuery("#create_user").click( function(){
		var usn = document.getElementById('susn');
		var email = document.getElementById('semail');
		var pwd = document.getElementById('spwd');

		console.log(usn.value);
		console.log(email.value);
		console.log(pwd.value);

		jQuery.ajax({
			type:'POST',
			url: window.location.origin +'/My_Test/wp-admin/admin-ajax.php',
			data: { 
				action: "testing",
				usn: usn.value,
				email: email.value, 	
				pwd: pwd.value
			},
			success: function(response) {
				console.log("ajax:",response);
			}
		})
	})

jQuery("#lid").click(function(){
	var username = document.getElementById('usn');
	var password = document.getElementById('pwd');
	console.log("debug ponit 1");
	console.log(username.value);
	console.log(password.value);
	jQuery.ajax({
		type: 'POST',
		url: window.location.origin + '/My_Test/wp-admin/admin-ajax.php',
		data :{
			action: "redirect",
			username: username.value,
			password: password.value		
		},
		success: function(response){
			console.log(response);
		}, 
		failure: function(response){
			console.log("failed");
		}
	})
})

jQuery("#save").click(function(){
	var header = document.getElementById('todoheader');
	var content = document.getElementById('todocontent');
	console.log(header.value);
	console.log(content.value);
	jQuery.ajax({
		type: "POST",
		url: window.location.origin + '/My_Test/wp-admin/admin-ajax.php',
		data:{
			action: "wp_save_as_post",
			header: header.value,
			content: content.value
		},
		success: function(response){
				console.log(response);
				// jQuery("#todo_list_id").load(document.URL,"#todo_list_id");

		},
		failure: function(response){

		}
	})
}) 
jQuery(".todo_list").click(function(){
	var todoheader = document.getElementById("header");
	var todocontent = document.getElementById('content');
	var post_id = jQuery(this).val();
	console.log(post_id);
	jQuery.ajax({
		type: "POST",
		url: window.location.origin + '/My_Test/wp-admin/admin-ajax.php',
		data:{
			action: "get_data",
			post_id: post_id	
		},
		success: function(response){
			var list = response.split(",");

			jQuery("#todoheader").val(list[0]);
			jQuery("#todocontent").val(list[1]);

		},
		failure: function(response){
			console.log("Failure in retriving data");
		}
	})
})
	jQuery(".delete_option").click(function(){
		var post_del_id = jQuery(this).val();
		console.log(post_del_id);
		jQuery.ajax({
			type: "POST",
			url: window.location.origin + "/My_Test/wp-admin/admin-ajax.php",
			data:{
				action: "delete_post",
				post_del_id: post_del_id
			},
			success: function(response){
				console.log(response);
				// jQuery("#todo_list_id").load(document.URl,"#todo_list_id");
			},
			failure: function(response){
				console.log("Deleting the post has failed");
			}
		})
	})	
})

