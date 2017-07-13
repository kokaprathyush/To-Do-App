jQuery(document).ready(function(){
	// =================== Creating an User =================== //
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
				action: "creating_user",
				usn: usn.value,
				email: email.value, 	
				pwd: pwd.value
			},
			success: function(response) {
				jQuery.ajax({
					type: "POST",
					url : window.location.origin + "/My_Test/wp-admin/admin-ajax.php",
					data:{

					},
					success: function(response){

					},
					failure: function(response){

					}
				})
			}
		})
	})
	// =================== User Sign-In =================== //
	jQuery("#lid").click(function(event){
		event.preventDefault();
		var username = document.getElementById('usn');
		var password = document.getElementById('pwd');
		console.log("debug ponit 1");
		console.log(username.value);
		console.log(password.value);
		jQuery.ajax({
			type: 'POST',
			url: window.location.origin + '/My_Test/wp-admin/admin-ajax.php',
			data :{
				action: "login",
				username: username.value,
				password: password.value		
			},
			success: function(response){
				console.log(response);
				jQuery.ajax({
					type: "POST",
					url : window.location.origin + "/My_Test/wp-admin/admin-ajax.php",
					data: {
						action: "redirect",

					},
					success: function(response){
						console.log(response);
						location.reload(false);
					},
					failure: function(response){

					}
				})
				
			}, 
			failure: function(response){
				console.log("failed");
			}
		})
	})
	// =================== Saving the todo tasks as posts =================== //
	jQuery("#save").click(function(event){
		event.preventDefault();
		var header = document.getElementById('todoheader');
		var content = document.getElementById('todocontent');
		if(header.value != '' && content.value != ''){
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
					jQuery("#todoheader").val(""); 
					jQuery("#todocontent").val(""); 
					console.log(response);
					// jQuery("#listid").load(location.href,"#listid");			
					location.reload(false);

				},
				failure: function(response){
					console.log("save didn't work");
				}
			})

		}
		else {
			alert("Don't save with empty fields");
		}
	})
	// =================== Shows data for editing when user clicks the title =================== // 
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
	// =================== Deletes the data =================== //
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
				location.reload(false);
				// jQuery("#todo_list_id").load(document.URl,"#todo_list_id");
			},
			failure: function(response){
				console.log("Deleting the post has failed");
			}
		})
	})	
})

