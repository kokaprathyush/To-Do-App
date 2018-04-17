jQuery(document).ready(function($){

	// =================== Creating an User =================== //
	$("#create_user").click( function(event){
		event.preventDefault();
		var usn = document.getElementById('susn');
		var email = document.getElementById('semail');
		var pwd = document.getElementById('spwd');
		console.log(usn.value);
		console.log(email.value);
		console.log(pwd.value);
		$.ajax({
			type:'POST',
			url: window.location.origin +'/My_Test/wp-admin/admin-ajax.php',
			data: { 
				action: "creating_user",
				usn: usn.value,
				email: email.value, 	
				pwd: pwd.value
			},
			success: function(response) {
				// console.log(response);
				$.ajax({
					type: "POST",
					url : window.location.origin + "/My_Test/wp-admin/admin-ajax.php",
					data:{
						action: "redirect"
					},
					success: function(response){
						console.log(response);
						location.reload(false);
					},
					failure: function(response){

					}
				})
			}
		})
	})

	// =================== User Sign-In =================== //
	$("#lid").click(function(event){
		event.preventDefault();
		var username = document.getElementById('usn');
		var password = document.getElementById('pwd');
		console.log("debug ponit 1");
		console.log(username.value);
		console.log(password.value);
		$.ajax({
			type: 'POST',
			url: window.location.origin + '/My_Test/wp-admin/admin-ajax.php',
			data :{
				action: "login",
				username: username.value,
				password: password.value		
			},
			success: function(response){
				console.log(response);
				$.ajax({
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

	// =================== Saving the content as posts =================== //
	$("#save").click(function(event){
		event.preventDefault();
		var header = document.getElementById('todoheader');
		var content = document.getElementById('todocontent');
		if(header.value != '' && content.value != ''){
			console.log(header.value);
			console.log(content.value);			
			$.ajax({
				type: "POST",
				url: window.location.origin + '/My_Test/wp-admin/admin-ajax.php',
				data:{
					action: "wp_save_as_post",
					header: header.value,
					content: content.value
				},
				success: function(response){
					$("#todoheader").val(""); 
					$("#todocontent").val(""); 
					console.log(response);	
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

	// =================== Shows data for editing when user clicks the to-do-header =================== // 
	$(".todo_list").click(function(){
		var todoheader = document.getElementById("header");
		var todocontent = document.getElementById('content');
		var post_id = $(this).val();
		console.log(post_id);
		$.ajax({
			type: "POST",
			url: window.location.origin + '/My_Test/wp-admin/admin-ajax.php',
			data:{
				action: "get_data",
				post_id: post_id	
			},
			success: function(response){
				var list = response.split(",");
				$("#todoheader").val(list[0]);
				$("#todocontent").val(list[1]);
			},
			failure: function(response){
				console.log("Failure in retriving data");
			}
		})
	})

	// =================== Deletes the posts(Moves to trash) =================== //
	$(".delete_option").click(function(){
		var post_del_id = $(this).val();
		console.log(post_del_id);
		$.ajax({
			type: "POST",
			url: window.location.origin + "/My_Test/wp-admin/admin-ajax.php",
			data:{
				action: "delete_post",
				post_del_id: post_del_id
			},
			success: function(response){
				console.log(response);
				location.reload(false);
			},
			failure: function(response){
				console.log("Deleting the post has failed");
			}
		})
	})

	// =================== Sign-Out =================== //
	$("#signout").click(function(){
		$.ajax({
			type: "POST",
			url: window.location.origin + '/My_Test/wp-admin/admin-ajax.php',
			data:{
				action: "signout",
			},
			success: function(response){
				location.reload();
			},
			failure: function(response){

			}
		})
	})	
})
(
							<label>No previous transactions exist</label>
						)
					}
				</Col>
				<Col xs={12} md={6}>
				{
					(this.context.store.getState().user_data.wallet_public_address) ?
					(
						<Row>
							{
								!this.state.ethereumNode ?
								(
									<Alert bsStyle="warning" style={{"marginBottom":"10px","fontSize":"15px"}}>
										<strong>Attention!!!</strong>&nbsp;We are facing issues with ethereum network please try after some time 
									</Alert>
								): null
							}
							<div>
					      		<h3 style={{"marginTop":"0px"}}>Wallet Details</h3>
								<div>
									<label>Wallet Address:</label>&nbsp;
									<span>{"0x" + wallet_address}</span>&nbsp;&nbsp;
									<CopyToClipboard text={"0x" + wallet_address} onCopy={() => this.setState({copied: true})}>
										<OverlayTrigger placement="top" overlay={<Tooltip id="tooltip">Copy Address</Tooltip>}>
											<i className="fa fa-clipboard" aria-hidden="true" style={clipboardStyle}></i>
										</OverlayTrigger>
									</CopyToClipboard>
								</div>
								<div>
									<label>Wallet Balance</label>&nbsp;
										<a onClick={this.handleChange} style={{"cursor":"pointer"}}>
											<OverlayTrigger placement="top" overlay={<Tooltip id="tooltip">Update Balance</Tooltip>}>
												<i className="fa fa-refresh"></i>
											</OverlayTrigger>
										</a><br/>
									<span>{this.state.tokens + " CUBE "}</span><br/>
									<span>{this.state.ether + " ETH"}</span><br />
									<span><a onClick={this.showPayoutModal} style={{"cursor":"pointer"}}>Token Payout History</a></span>
								</div>
					      	</div>
						</Row>
					): 
					(
						<Alert bsStyle="warning" style={{"marginTop":"10px","fontSize":"16px"}}>
							<strong>Attention!!!</strong>&nbsp; Wallet Creation is Mandatory
						</Alert>
					)
				}
					<Row>
						<Col xs={12}>
						<div style={{"marginTop":"20px"}}>
							
							{
								(this.props.wallet_data["wallet_login"]) ?
								(
									<div>
										<Link to="/wallet/unlock" className= { path == '/wallet/unlock' ? "btn btn-info " : "btn btn-default"} style={{"marginRight":"10px"}} >Wallet Actions</Link>
										<Button className="btn btn-danger" onClick={this.handleForget}>Forget Wallet</Button>
									</div>
								):
								(
									<div>
										<Link to="/wallet/unlock" className= { path == '/wallet/unlock' ? "btn btn-info " : "btn btn-default"} style={{"marginRight":"10px"}} >Unlock Wallet</Link>
										<Link to="/wallet/import" className={path == '/wallet/import' ? "btn btn-info" : "btn btn-default"} style={{"marginRight":"10px"}} >Import Wallet</Link>
										<Link to="/wallet/create" className={path == '/wallet/create' ? "btn btn-info" : "btn btn-default"}>Create Wallet</Link>
									</div>
								)
							}
						</div>
						</Col>
						<Col>
							{this.props.children }
						</Col>
					</Row>
				<TokenPayoutModal modalType="Bounty" userId={userId}/>
				</Col>

				<Col xs={12} md={3}>
					<h3 style={{"marginTop":"0px"}}>
						Contributions
						<a onClick={this.handleContributions} style={{"cursor":"pointer","marginLeft":"8px","fontSize":"18px"}}>
							<OverlayTrigger placement="top" overlay={<Tooltip id="tooltip">Update Contributions List</Tooltip>}>
								<i className="fa fa-refresh"></i>
							</OverlayTrigger>
						</a>
					</h3>
					{
						(this.state.madeContributions) ? 
						(
							<Table condensed hover>
						    	<thead>
								    <tr>
								    	<th>Community</th>
								    	<th>Contribution (CUBE)</th>
								    </tr>
								</thead>
								<tbody>
										{
									    	this.state.contributionsList
									    }
								</tbody>
							</Table>
						):
						(
							<label>There aren't any contributions made</label>
						)
					}
				</Col>
			</Row>
		</DocumentMeta>
		)

