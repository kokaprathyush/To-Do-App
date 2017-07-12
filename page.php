
<?php get_header() ?>
<div id="primary" class="content-area">
<main id="main" class="site-main" role ="main">
	
	<div class="container" >
		<div class="row	">
			<div class="col-sm-6">
				<div class="panel panel-default">
					<div class="panel-body">
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
				<div class="panel panel-primary">
					<div class="panel-heading">
						Your To-Do tasks list
					</div>
					<div class="panel-body" id = "todo_list_id" >
						<?php $args = array ('posts_per_page' => -1, 'post_type' => 'post');
							$posts_array = get_posts($args); 
							// echo $posts_array;
							// foreach ($posts_array as $key=>$wpPostObject) {
							//     echo $wpPostObject->post_title;
							// }
							
							$query = new WP_Query(array(
								'posts_per_page' => -1,
							    'post_type' => 'post',
							    'post_status' => 'publish'
							));


							while ($query->have_posts()) {
							    $query->the_post(); ?>
							    <!-- <div> -->
							   	<button type="button" class="todo_list btn btn-link" value= "<?php the_ID();?>" ><?php the_title() ?></button>
							   	<!-- <label><?php  the_date('F j, Y g:i a','','',true);?></label> -->
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
</main>
</div>	
<?php get_footer() ?>