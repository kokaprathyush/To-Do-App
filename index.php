<?php get_header() ?>
<h3 style="text-align:center;color:white">SET YOUR TO-DO-LISTS AND TRY TO PUT YOURSELF ON TOP THEM</h3>
<div class= "container">
	<div class=" login panel panel-default">
		<div class="panel-heading">
			<div class="tabbable">
				<ul class="nav nav-tabs" role="tablist">
					<li class="active" ><a href="#login" data-toggle="tab">Login</a></li>
					<li ><a href= "#signup" data-toggle="tab">Create New Account</a></li> 	
				</ul>
			</div>
		</div>
		<div class="panel-body">
			<div class="tab-content">
				<div class= "tab-pane active" id="login">
					<form method="post" >
				        <div class="form-group input-group">
				            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
				            <input type="text" class="form-control" name="lusername"  placeholder="username" id="usn" required> 
				        </div>
				        <div class="form-group input-group">
				            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
				            <input type="password" class="form-control" name="lpassword" placeholder="password" id="pwd" required>
				        </div>
				        <div style="padding-left:30%;" >
			            <button style="width:50%" type="submit" class="btn btn-primary" id="lid" >Login</button>
			          	</div>
			          	<br>
			          	<div style="padding-left:35%">
			          		<a href="">Forgot password?</a>
			          	</div>
			          	  
				    </form>
				</div>	
				<div class="tab-pane " id="signup">
					<form method="form">
			            <div class="form-group input-group">
			            	<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
			            	<input type="text"  class="form-control" name="susername"  placeholder="username" id="susn" required> 
			          	</div>
			            <div class="form-group input-group">
			            	<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
			            	<input type="email"  class="form-control" name="semail" placeholder="email" id="semail" required>
			          	</div>
			            <div class="form-group input-group">
			            	<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
			            	<input type="password"  class="form-control" name="spassword" placeholder="password" id="spwd" required>
			          	</div>
			            <div style="padding-left:30%;" >
			            <button style="width:50%" type="submit" id="create_user" class="btn btn-primary" >Sign Up</button>
			          	</div>
			        </form>		
				</div>
			</div>
		</div>
	</div>
</div>
<?php get_footer() ?>
