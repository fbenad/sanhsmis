<?php
/*
 * Login Visible Page
 *
 * This page is used to change passwords when it is still in the default value. 
 * @author    	Fernando B. Enad
 * @license    	Public
 */
?>
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
									<strong><?php echo $_SESSION['stud_fullname'];?></strong>
									<div id="demo"></div>
								</p>
								<form role="form" id="form" method="post" onSubmit="return false;">
									<div class="input-group mb-3">
										<input type="password" class="form-control" placeholder="New Password" name="password1" id="password1" autofocus>
										<div class="input-group-append">
											<div class="input-group-text">
												<span class="fas fa-lock"></span>
											</div>
										</div>
									</div>
									<div class="input-group mb-3">
										<input type="password" class="form-control" placeholder="Confirm Password" name="password2" id="password2">
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
var id = <?php echo $_SESSION['stud_no'];?>;

function changePassword(){	
	if(sanitizeForm() == true){
		var password = $('#password1').val();
		var action = 'changePassword';
		var data = [action, id, password];
		
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
					setTimeout(function(){window.location = '<?php echo $_SESSION['prev_url'];?>';}, 3000);
				} else {
					toastr.error(result[1]+'');	
					setTimeout(function(){document.getElementById('submit').innerHTML = 'Sign In';}, 1000);	
					setTimeout(function(){$('#submit').removeAttr('disabled');}, 2000);
					
				}
			}
		});
	} else {
		$('#password2').val('');
	}
}

function sanitizeForm(){
	var password1 = $('#password1').val();
	var password2 = $('#password2').val();
	var result = true;
	
	password1 = password1.trim();
	password2 = password2.trim();
	
	if(password1 == ''){
		result = false;
		toastr.error('New password is a required field.');
	} else if(password2 == ''){
		result = false;
		toastr.error('Confirm password is a required field.');
	} else if(password1 != password2){
		result = false;
		toastr.error('New and confirm password must match.');
	} else if(password1 == password2 && password1 == '<?php echo $default_pass;?>'){
		result = false;
		toastr.error('You can\'t use the default password to sign in.');
	}
	
	return result;
}
</script>	
