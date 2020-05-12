	<div class="content-wrapper">
	
		<section class="content-header">
			<div class="container">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>My Profile</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="?p=my"><i class="fas fa-home"></i></a></li>
							<li class="breadcrumb-item active">My Profile</li>
						</ol>
					</div>
				</div>
			</div>
		</section>

		<section class="content">
			<div class="container">
				<div class="row">
					<div class="col-md-9">
						<div class="card card-primary">
							<div class="card-body">
								<div class="row" id="my-basic">

								</div>		
								<br>
								<ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
									<li class="nav-item dropdown">
										<a class="nav-link dropdown-toggle active" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">My Information</a>
										<div class="dropdown-menu">
											<a class="dropdown-item" id="custom-content-below-basic-tab" data-toggle="pill" href="#custom-content-below-basic" role="tab" aria-controls="custom-content-below-basic" aria-selected="true">Basic Information</a>
											<a class="dropdown-item" id="custom-content-below-address-tab" data-toggle="pill" href="#custom-content-below-address" role="tab" aria-controls="custom-content-below-address" aria-selected="true">Address Information</a>
											<a class="dropdown-item" id="custom-content-below-family-tab" data-toggle="pill" href="#custom-content-below-family" role="tab" aria-controls="custom-content-below-family" aria-selected="true">Family</a>
											<a class="dropdown-item" id="custom-content-below-background-tab" data-toggle="pill" href="#custom-content-below-background" role="tab" aria-controls="custom-content-below-background" aria-selected="true">Educational Background</a>
											<a class="dropdown-item" id="custom-content-below-ids-tab" data-toggle="pill" href="#custom-content-below-ids" role="tab" aria-controls="custom-content-below-ids" aria-selected="true">Personal IDs</a>
										</div>
									</li>
									<li class="nav-item">
										<a class="nav-link" id="custom-content-below-designation-tab" data-toggle="pill" href="#custom-content-below-designation" role="tab" aria-controls="custom-content-below-designation" aria-selected="false">Designations</a>
									</li>		
									<!--
									<li class="nav-item">
										<a class="nav-link" id="custom-content-below-message-tab" data-toggle="pill" href="#custom-content-below-message" role="tab" aria-controls="custom-content-below-message" aria-selected="false">Messages</a>
									</li>
									-->
								</ul>
								<div class="tab-content" id="custom-content-below-tabContent">
									<div class="tab-pane fade show active" id="custom-content-below-basic" role="tabpanel" aria-labelledby="custom-content-below-basic-tab">
										<div class="card-body">
											<div class="table-responsive">
												<table class="table table-hover table-condensed table-striped">
													<thead>
														<tr>
															<th width="30%">Fields</th>
															<th>Details</th>
														</tr>
													</thead>
													<tbody id="my-full"> 														
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="custom-content-below-address" role="tabpanel" aria-labelledby="custom-content-below-address-tab">
										<div class="card-body">
											<div class="table-responsive">
												<table class="table table-hover table-condensed table-striped">
													<thead>
															<th width="30%">Fields</th>
															<th>Details</th>													
													</thead>
													<tbody id="my-addresses"> 
																	
													</tbody>
												</table>	
											</div>														
										</div>														
									</div>														
									<div class="tab-pane fade" id="custom-content-below-family" role="tabpanel" aria-labelledby="custom-content-below-family-tab">
										<div class="card-body">
											<div class="table-responsive">
												<table class="table table-hover table-condensed table-striped">
													<thead>
															<th>Name</th>
															<th width="25%">Relationship</th>
													</thead>
													<tbody id="my-family"> 
													</tbody>
												</table>	
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="custom-content-below-background" role="tabpanel" aria-labelledby="custom-content-below-background-tab">
										<div class="card-body">
											<div class="table-responsive">
												<table class="table table-hover table-condensed table-striped">
													<thead>
														<th width="15%">Level</th>
														<th>Degree</th>
														<th width="25%">Major</th>
														<th width="25%">Minor</th>
														<th width="15%">Units</th>
													</thead>
													<tbody id="my-education"> 
													</tbody>
												</table>
											</div>														
										</div>														
									</div>
									<div class="tab-pane fade" id="custom-content-below-ids" role="tabpanel" aria-labelledby="custom-content-below-ids-tab">
										<div class="card-body">
											<div class="table-responsive">
												<table class="table table-hover table-condensed table-striped">
													<thead>
														<th>ID Type</th>
														<th width="25%">ID Number</th>
														<th width="20%">Date Issued</th>
														<th width="30%">Place Issued</th>
													</thead>
													<tbody id="my-ids"> 
													</tbody>
												</table>
											</div>														
										</div>														
									</div>
									<div class="tab-pane fade" id="custom-content-below-designation" role="tabpanel" aria-labelledby="custom-content-below-designation-tab">
										<div class="card-body">
											<div class="table-responsive">
												<table class="table table-hover table-condensed table-striped">
													<thead>
														<th width="20%">Appointment</th>
														<th>Plantilla Item #</th>
														<th width="25%">Date of Appointment	</th>
														<th width="25%">First Day of Service</th>
													</thead>
													<tbody id="my-appointment"> 
													</tbody>
												</table>
											</div>														
										</div>	
										<hr>
										<div class="card-body">
											<div class="table-responsive">
												<table class="table table-hover table-condensed table-striped">
													<thead>
														<th>Designation</th>
														<th width="25%">Date of Designation	</th>
														<th width="20%">Start School Year</th>
														<th width="20%">End School Year</th>
													</thead>
													<tbody id="my-designation"> 
													</tbody>
												</table>
											</div>														
										</div>	
									</div>
									<div class="tab-pane fade" id="custom-content-below-message" role="tabpanel" aria-labelledby="custom-content-below-message-tab">
										<div class="card-body">
											
											<div class="table-responsive">
												<table class="table table-hover table-condensed table-striped">
													<thead>
														<th width="20%">Date Created</th>
														<th>Feedback</th>
														<th>Remarks</th>
													</thead>
													<tbody id="my-message"> 
														<tr>
															<td></td>
															<td></td>
															<td></td>
														</tr>	
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="card card-default">
							<div class="card-body">
								<h3 class="card-title">Recent Logins</h3>
								<div class="form-group">
									<div class="table-responsive">
										<table class="table table-hover table-condensed table-striped">
											<thead>
												<tr style="line-height: 1px;">
													<th width="40%"><small><strong>Location</strong></small></th>
													<th><small><strong>Time</strong></small></th>
												</tr>
											</thead>
											<tbody id="my-logs"> 
											</tbody>
										</table>
									</div>
								</div>
							</div>												
						</div>

						<!--
						<div class="card card-default">
							<div class="card-body">	
								<h3 class="card-title">Feedback Form</h3>
								<div class="form-group">
									<label for="exampleInputEmail1" style="line-height: 0.8"><small><small>Write down the details of your feedback to the Administrative Officer (eg. name correction, and other employee records-related concerns):</small></small></label>
									<textarea class="form-control" style="font-size: 12px;" rows="4"></textarea>
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-info float-right">Submit</button>
								</div>
							</div>												
						</div>
						-->
					</div>
				</div>
			</div>
		</section>
	</div>		
	
<script type="text/javascript">	
var id = <?php echo $_SESSION['user_no'];?>;
	
setTimeout(function(){preLoad();}, 1);

function preLoad(){
	getProfile();
	getProfileFull();
	getCurrentPosition();	
	getProfileAddresses();
	getLogs();
	getFamily();
	getEducation();
	getIDs();
	getAppointment();
	getDesignation();
	getMessage();
	
}

function getProfile(){
	var action = 'getProfile';
	var data = [action, id];
	
	$.ajax({
		type: 'POST',
		url: 'my/action.php',
		data: {data:data},	
		success: function(result){
			$('#my-basic').html(result);
		}
	});
}

function getCurrentPosition(){
	var action = 'getCurrentPosition';
	var data = [action, id];
	$.ajax({
		type: 'POST',
		url: 'my/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				$position = result[2].field_ext;				
				$('#profile-position').html($position.substr(2));
			} else {
				toastr.erro(result[1]);
			}
		}
	});		
}

function getProfileFull(){
	var action = 'getProfileFull';
	var data = [action, id];
	
	$.ajax({
		type: 'POST',
		url: 'my/action.php',
		data: {data:data},	
		success: function(result){
			$('#my-full').html(result);
		}
	});
}

function getProfileAddresses(){
	var action = 'getProfileAddresses';
	var data = [action, id];
	
	$.ajax({
		type: 'POST',
		url: 'my/action.php',
		data: {data:data},	
		success: function(result){
			$('#my-addresses').html(result);
		}
	});
}


function getGuardian(){
	var action = 'getGuardian';
	var data = [action, id];
	
	$.ajax({
		type: 'POST',
		url: 'my/action.php',
		data: {data:data},	
		success: function(result){
			$('#my-guardian').html(result);
		}
	});	
}

function getLogs(){
	var action = 'getLogs';
	var data = [action, id];
	
	$.ajax({
		type: 'POST',
		url: 'my/action.php',
		data: {data:data},	
		success: function(result){
			$('#my-logs').html(result);
		}
	});	
}

function getFamily(){
	var action = 'getFamily';
	var data = [action, id];
	
	$.ajax({
		type: 'POST',
		url: 'my/action.php',
		data: {data:data},	
		success: function(result){
			$('#my-family').html(result);
		}
	});		
}

function getEducation(){
	var action = 'getEducation';
	var data = [action, id];
	
	$.ajax({
		type: 'POST',
		url: 'my/action.php',
		data: {data:data},	
		success: function(result){
			$('#my-education').html(result);
		}
	});		
}

function getIDs(){
	var action = 'getIDs';
	var data = [action, id];
	
	$.ajax({
		type: 'POST',
		url: 'my/action.php',
		data: {data:data},	
		success: function(result){
			$('#my-ids').html(result);
		}
	});		
}

function getAppointment(){
	var action = 'getAppointment';
	var data = [action, id];
	
	$.ajax({
		type: 'POST',
		url: 'my/action.php',
		data: {data:data},	
		success: function(result){
			$('#my-appointment').html(result);
		}
	});		
}

function getDesignation(){
	var action = 'getDesignation';
	var data = [action, id];
	
	$.ajax({
		type: 'POST',
		url: 'my/action.php',
		data: {data:data},	
		success: function(result){
			$('#my-designation').html(result);
		}
	});		
}

function getMessage(){
	var action = 'getMessage';
	var data = [action, id];
	
	$.ajax({
		type: 'POST',
		url: 'my/action.php',
		data: {data:data},	
		success: function(result){
			$('#my-message').html(result);
		}
	});		
}
</script>	