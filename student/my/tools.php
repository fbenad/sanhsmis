<?php
/*
 * Tools Visible Page
 *
 * This class is used to manage the features for Student->Tools. 
 * @author    	Fernando B. Enad
 * @license    	Public
 */
?>
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
									<li class="nav-item">
										<a class="nav-link" id="custom-content-below-phone-tab" data-toggle="pill" href="#custom-content-below-phone" role="tab" aria-controls="custom-content-below-phone" aria-selected="true">Phone Number</a>
									</li>
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
														  <input type="password" class="form-control" id="password1" placeholder="Old Password" name="password1" autofocus>
														</div>
													</div>
													<div class="form-group row">
														<label for="inputPassword3" class="col-sm-5 col-form-label">New Password</label>
														<div class="col-sm-7">
														  <input type="password" class="form-control" id="password2" placeholder="New Password" name="password2">
														</div>
													</div>
													<div class="form-group row">
														<label for="inputPassword3" class="col-sm-5 col-form-label">Confirm New Password</label>
														<div class="col-sm-7">
														  <input type="password" class="form-control" id="password3" placeholder="Confirm New Password" name="password3">
														</div>
													</div>
													<div class="row">
														<div class="col-6">
														</div>
													  <div class="col-6">
														<button type="submit" class="btn btn-info btn-block" name="submit" onClick="submitPasswordForm();" id="submit">Update Password</button>
													  </div>
													</div>
												</form>
												</div>
											</div>
										</div>
									</div>
									<div class="tab-pane fade show" id="custom-content-below-phone" role="tabpanel" aria-labelledby="custom-content-below-phone-tab">
										<div class="card-body">
											<div class="row">
												<div class="col-md-12">
												<form role="form" id="form2" method="post" onSubmit="return false;">
													<div class="form-group row">
														<label for="inputPassword3" class="col-sm-5 col-form-label">Phone Number</label>
														<div class="col-sm-7">
															<input type="text" class="form-control" id="phone" placeholder="Phone Number" name="phone">
														</div>
													</div>
													<div class="row">
														<div class="col-6">
														</div>
														<div class="col-6">
															<button type="submit" class="btn btn-info btn-block" name="submit2" onClick="submitPhoneForm();" id="submit2">Update Phone</button>
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
var id = '<?php echo $_SESSION['stud_no'];?>';

setTimeout(function(){preLoad();}, 1);

function preLoad(){
	getPhone();
}

function submitPasswordForm(){
	var sanitizeFormResult = sanitizeForm();
	
	if(sanitizeFormResult[0] == 1){
		var action = 'verifyPassword';
		var data = [action, id, sanitizeFormResult[2], sanitizeFormResult[3]];
		
		$('#submit').attr('disabled', 'disabled');
		document.getElementById('submit').innerHTML = 'Validating...';
		
		$.ajax({
			type: 'POST',
			url: 'my/action.php',
			data: {data:data},	
			success: function(result){
				if(result[0] == 1){
					toastr.success(result[1]+'');
					setTimeout(function(){document.getElementById('submit').innerHTML = 'Changing...';}, 1000);
					setTimeout(function(){document.getElementById('submit').innerHTML = 'Update Password';}, 2000);
					setTimeout(function(){window.location = '?p=lock';}, 3000);
					
				} else {
					toastr.error(result[1]+'');	
					setTimeout(function(){document.getElementById('submit').innerHTML = 'Update Password';}, 1000);
					setTimeout(function(){$('#submit').removeAttr('disabled');}, 2000);	
				}
				
			}
		});
	} else {
		toastr.error(sanitizeFormResult[1]+'');
	}
}

function sanitizeForm(){
	var status = 1;
	var message = '';
	var password1 = $('#password1').val();
	var password2 = $('#password2').val();
	var password3 = $('#password3').val();
	var result;
	password1 = password1.trim();
	password2 = password2.trim();
	password3 = password3.trim();
	
	if(password1 == ''){
		status = -1;
		message = 'Old password is a required field.';
	} else if(password2 == ''){
		status = -1;
		message = 'New password is a required field.';
	} else if(password3 == ''){
		status = -1;
		message = 'Confirm password is a required field.';
	} else if(password2 != password3){
		status = -1;
		message = 'New and confirm passwords do not match.';
	}
	
	result =  [status, message, password1, password2, password3];
	
	return result;
}


function getPhone(){
	var action = 'getPhone';
	var data = [action, id];
	
	$.ajax({
		type: 'POST',
		url: 'my/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				$('#phone').val(result[2]+'');	
			} else {
				$toastr.error(result[1]+'');
			}
		}
	});
}

function submitPhoneForm(){
	var action = 'submitPhoneForm';
	var phone = $('#phone').val();
	var data = [action, id, phone];
	
	if(isNaN(phone)){
		toastr.error('Invalid phone number format.');
	} else{
		$('#submit2').attr('disabled', 'disabled');
		document.getElementById('submit2').innerHTML = 'Validating...';
		
		$.ajax({
			type: 'POST',
			url: 'my/action.php',
			data: {data:data},	
			success: function(result){
				if(result[0] == 1){
					toastr.success(result[1]+'');
					setTimeout(function(){document.getElementById('submit2').innerHTML = 'Update Phone';}, 1000);
					setTimeout(function(){$('#submit2').removeAttr('disabled');}, 1000);
				} else {
					$toastr.error(result[1]+'');
					setTimeout(function(){document.getElementById('submit2').innerHTML = 'Update Phone';}, 1000);
					setTimeout(function(){$('#submit2').removeAttr('disabled');}, 1000);	
				}	
			}
		});	
	}

}
</script>