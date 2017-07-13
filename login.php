
<?php 
	
		$uid = $_POST['usn'];
		$pwd = $_POST['pwd'];

		if(wp_authenticate($uid,$pwd)){
			echo "login success" ;
		}
		else{
			echo "login failed";
		}
?>

<?php 							
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