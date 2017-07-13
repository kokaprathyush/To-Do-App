
<?php get_header() ?>
<!-- <button type="button" class="col-md-1 btn btn-primary">Sign-Out</button>  -->
<?php redirect(); ?>
<!-- <div class="row"> -->
	<h3 style=" color:white; margin-top:0px;" class="col-md-6 ">WELCOME : <?php global $current_user;
	$current_user = wp_get_current_user();
	 	echo $current_user->user_login ;?> 
	</h3>
	<button  type="button" class="col-md-1 btn btn-default btn-md" id="signout" style="margin-left:40%; margin-bottom: 10px">Sign-Out</button>
<!-- </div> -->
	<!-- <h3 style="text-align:center; color:white" >WELCOME : <?php $current_user = wp_get_current_user();
	 	echo $current_user->user_login ;?> 
	</h3>
	<div style="padding-left:90%;"><button type="button" class="btn btn-default btn-md">SignOut</button></div> -->
	<!-- <h2 style="text-align:right; color:white">Hello World</h2> -->
	<!-- <div style= "padding-left:30%"> -->
	<!-- <button  type="button" class="col-md-1 btn btn-primary">Sign-Out</button> -->
	<!-- </div> -->	
<div id="primary" class="content-area">
	<div class="container" >
		<div class="row	">
			<div class="col-sm-6">
				<div class="panel panel-default">
					<div class="panel-body"  id="listinput" >
						<form method="post">
							<div class="form-group"><input id="todoheader" class="form-control" name="header" required type="text" placeholder="TO-DO list header">
							</div>
							<div class="form-group">
							<textarea rows="8" id="todocontent" class="form-control" name="content" required placeholder="TO-DO list content"></textarea>
							</div>
							<div>
								<div style="padding-left:40%;" >
					            <button style="width:30%" type="submit" class="btn btn-primary" id="save">Save</button>
					            <!-- <button style="width:30%" type="button" class="btn btn-primary" id="cancel" onclick= ""> Cancel</button> -->
					            </div>

							</div>
						</form>
						
					</div>
				</div>
			</div>
			<div  style="padding-left:10%;" class="col-sm-6">
				<div class="panel panel-primary" >
					<div class="panel-heading">
						Your To-Do tasks list
					</div>
					<div class="panel-body" id="listid" >
						<?php 
							$query = new WP_Query(array(
								'author' => $current_user->ID,
								'posts_per_page' => -1,
							    'post_type' => 'post',
							    'post_status' => 'publish'
							));
							while ($query->have_posts()) {
							    $query->the_post(); $id = get_the_ID(); ?>
							    <!-- <div> -->
							   	<button type="button" class="todo_list btn btn-link" value= "<?php the_ID();?>" ><?php the_title() ?></button>
							   	<label><?php echo get_the_date();?></label>
							   	<!-- <div style= " padding-left:5%"> </div> -->
							   	<button type="button" value= "<?php the_ID();?>" class="delete_option btn btn-danger btn-xs"> delete</button>
							    <!-- </div> -->
							    <?php echo "<br>";
							}						
						?>
					</div>	
				</div>
			</div>
		</div>
	</div>
</div>	
<?php get_footer() ?>