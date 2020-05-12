	<div class="content-wrapper">
	
		<section class="content-header">
			<div class="container">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Tools</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="?p=my"><i class="fas fa-home"></i></a></li>
							<li class="breadcrumb-item active">Tools</li>
						</ol>
					</div>
				</div>
			</div>
		</section>

		<section class="content">
			<div class="container">
				<div class="row">
			
					<div class="col-md-6">

						<div class="card card-primary">
							<div class="card-body">								
								<ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" id="custom-content-below-account-tab" data-toggle="pill" href="#custom-content-below-account" role="tab" aria-controls="custom-content-below-account" aria-selected="true">Update Password</a>
									</li>
									<!--
									<li class="nav-item">
										<a class="nav-link" id="custom-content-below-phone-tab" data-toggle="pill" href="#custom-content-below-phone" role="tab" aria-controls="custom-content-below-phone" aria-selected="true">Phone Number</a>
									</li>
									-->
								</ul>
								
								<div class="tab-content" id="custom-content-below-tabContent">
									<div class="tab-pane fade show active" id="custom-content-below-account" role="tabpanel" aria-labelledby="custom-content-below-account-tab">
										<div class="card-body">
											<div class="row">
												<div class="col-md-12">
												<form role="form" id="form1" method="post" onSubmit="return false;">
													<div class="form-group row">
														<label for="inputPassword3" class="col-sm-5 col-form-label">Old Password</label>
														<div class="col-sm-7">
														  <input type="password" class="form-control" id="password1" name="password1" placeholder="Old Password" required autofocus>
														</div>
													</div>
													<div class="form-group row">
														<label for="inputPassword3" class="col-sm-5 col-form-label">New Password</label>
														<div class="col-sm-7">
														  <input type="password" class="form-control" id="password2" name="password2" placeholder="New Password" required>
														</div>
													</div>
													<div class="form-group row">
														<label for="inputPassword3" class="col-sm-5 col-form-label">Confirm New Password</label>
														<div class="col-sm-7">
														  <input type="password" class="form-control" id="password3" name="password3" placeholder="Confirm New Password" required>
														</div>
													</div>
													<div class="row">
														<div class="col-6">
														</div>
													  <div class="col-6">
														<button type="submit" class="btn btn-info btn-block" name="submit" id="submit" onClick="verifyPassword();">Update Password</button>
													  </div>
													</div>
												</form>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>

<script type="text/javascript">	
var user_name = '<?php echo $_SESSION['user_name'];?>';

function verifyPassword(){

	if(sanitizeForm() == true){
		var action = 'verifyPassword';
		var password1 = $('#password1').val();
		
		var data = [action, user_name, password1];
			
		$.ajax({
			type: 'POST',
			url: 'auth/action.php',
			data: {data:data},	
			success: function(result){
				if(result[0] == 1){
					changePassword();
				} else {
					toastr.error(result[1]);
				}
				
			}
		});
				
	} else {
		// error handling done by the sanitizeForm() function
	}
}

function changePassword(){
	var action = 'changePassword';
	var password2 = $('#password2').val();
	
	var data = [action, user_name, password2];
	
	$('#submit').attr('disabled', 'disabled');
	$('#submit').html('Validating...');
	
	$.ajax({
		type: 'POST',
		url: 'auth/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				setTimeout(function(){$('#submit').html('Updating...');}, 1000);
				setTimeout(function(){$('#submit').html('Update Password');}, 2000);
				setTimeout(function(){window.location = '?p=lock';}, 3000);
				toastr.success(result[1]);
			} else {
				setTimeout(function(){$('#submit').html('Update Password');}, 1000);
				setTimeout(function(){$('#submit').removeAttr('disabled');}, 2000);
				toastr.error(result[1]);
			}
			
		}
	});
}

function sanitizeForm(){
	var result = true;

	var password1 = $('#password1').val();
	var password2 = $('#password2').val();
	var password3 = $('#password3').val();
	
	password1 = password1.trim();
	password2 = password2.trim();
	password3 = password3.trim();
	
	if(password1 == ''){
		result = false;
		toastr.error('Old password is a required field.');
	} else if(password2 == ''){
		result = false;
		toastr.error('New password is a required field.');
	} else if(password3 == ''){
		result = false;
		toastr.error('Confirm password is a required field.');
	} else if(password2 != password3){
		result = false;
		toastr.error('New and confirm passwords do not match.');
	} 
		
	return result;
}
</script>