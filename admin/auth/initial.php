	<div class="content-wrapper">
		<div class="content">
			<div class="container">
				<div class="row">
					<div class="col-lg-4"></div>
					<div class="col-lg-4">
						<br>
						<div class="card">
							<div class="card-body login-card-body">
								<p class="login-box-msg">
									<img src="../assets/images/lock.png" style="width: 80px;"><br>
									Password change is required for <br>
									<strong><?php echo $_SESSION['user_fullname'];?></strong>
									<div id="demo"></div>
								</p>
								<form role="form" id="form" method="post" onSubmit="return false;">
									<div class="input-group mb-3">
										<input type="password" class="form-control" placeholder="New Password" name="pass_word1" id="pass_word1" autofocus>
										<div class="input-group-append">
											<div class="input-group-text">
												<span class="fas fa-lock"></span>
											</div>
										</div>
									</div>
									<div class="input-group mb-3">
										<input type="password" class="form-control" placeholder="Confirm Password" name="pass_word2" id="pass_word2">
										<div class="input-group-append">
											<div class="input-group-text">
												<span class="fas fa-lock"></span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-4">
										</div>
										<div class="col-2">
										</div>
										<div class="col-6">
											<button type="submit" class="btn btn-info btn-block" name="submit" id="submit" onClick="changePassword();">Change Password</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="col-lg-4"></div>	
				</div>
			</div>
		</div>
	</div>
	
<script type="text/javascript">	
var user_name = '<?php echo $_SESSION['user_name'];?>';

function changePassword(){	
	if(sanitizeForm() == true){
		var pass_word1 = $('#pass_word1').val();
		var action = 'changePassword';
		
		var data = [action, user_name, pass_word1];
		
		document.getElementById('submit').innerHTML = 'Validating...';
		$('#submit').attr('disabled', 'disabled');
		
		$.ajax({
			type: 'POST',
			url: 'auth/action.php',
			data: {data:data},	
			success: function(result){
				if(result[0] == 1){
					toastr.success(result[1]+'');
					setTimeout(function(){document.getElementById('submit').innerHTML = 'Updating...';}, 1000);	
					setTimeout(function(){document.getElementById('submit').innerHTML = 'Signing in...';}, 2000);	
					setTimeout(function(){window.location = "?p=home";}, 3000);
				} else {
					toastr.error(result[1]+'');	
					setTimeout(function(){document.getElementById('submit').innerHTML = 'Sign In';}, 1000);	
					setTimeout(function(){$('#submit').removeAttr('disabled');}, 2000);
					
				}
			}
		});
	} else {
		
	}
}

function sanitizeForm(){
	var pass_word1 = $('#pass_word1').val();
	var pass_word2 = $('#pass_word2').val();
	var result = true;
	
	pass_word1 = pass_word1.trim();
	pass_word2 = pass_word2.trim();
	
	if(pass_word1 == ''){
		result = false;
		toastr.error('New password is a required field.');
	} else if(pass_word2 == ''){
		result = false;
		toastr.error('Confirm password is a required field.');
	} else if(pass_word1 != pass_word2){
		result = false;
		$('#pass_word1').val('');
		$('#pass_word2').val('');
		$('#pass_word1').focus();
		toastr.error('New and confirm password must match.');
	} else if(pass_word1 == pass_word2 && pass_word1 == '<?php echo $default_pass;?>'){
		result = false;
		$('#pass_word1').val('');
		$('#pass_word2').val('');
		$('#pass_word1').focus();
		toastr.error('You can\'t use the default password to sign in.');
	}
	
	return result;
}
</script>	
