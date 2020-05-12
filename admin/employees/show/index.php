	<div class="content-wrapper">
	
		<section class="content-header">
			<div class="container">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Profile</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="?p=my"><i class="fas fa-home"></i></a></li>
							<li class="breadcrumb-item"><a href="?p=employees">Employees</a></li>
							<li class="breadcrumb-item active">Profile</li>
						</ol>
					</div>
				</div>
			</div>
		</section>

		<section class="content">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="card card-primary">
							<div class="card-header bg-white">
								<div class="card-tools">
									<div class="btn-group btn-group-sm" id="form-modify">
										<!--<button type="button" class="btn btn-info" id="user-photo-upload" title="Upload photo"><i class="fas fa-camera"></i></button>
										<button type="button" class="btn btn-info" id="user-print-id" title="Print ID"><i class="fas fa-id-card"></i></button>-->									
										<a type="button" class="btn btn-info"  id="user-edit" title="Modify student" href="?p=employees&modify=<?php echo $_GET['show'];?>"><i class="fas fa-user-edit"></i></a>
									</div>
								</div>
							</div>
							<div class="card-body">
								<div class="row" id="my-basic">

								</div>		
								<br>
								<ul class="nav nav-tabs " id="custom-content-below-tab" role="tablist">
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
									<li class="nav-item">
										<a class="nav-link" id="custom-content-below-loads-tab" data-toggle="pill" href="#custom-content-below-loads" role="tab" aria-controls="custom-content-below-loads" aria-selected="false">Class Loads</a>
									</li>
									
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
												<small>
												<table class="table table-hover table-condensed table-striped">
													<thead>
														<th width="24%">Appointment</th>
														<th>Plantilla Item #</th>
														<th width="25%">Date of Appointment	</th>
														<th width="25%">First Day of Service</th>
													</thead>
													<tbody id="my-appointment"> 
													</tbody>
												</table>
												</small>
											</div>														
										</div>	
										<hr>
										<div class="card-body">
											<div class="table-responsive">
												<small>
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
												</small>
											</div>														
										</div>
									</div>
									<div class="tab-pane fade show" id="custom-content-below-loads" role="tabpanel" aria-labelledby="custom-content-below-loads-tab">
										<br>
										<div id="my-loads">
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
var id = <?php echo $_GET['show'];?>;

setTimeout(function(){preLoad();}, 1);

function preLoad(){
	getProfile();
	getProfileFull();
	getCurrentPosition();	
	getProfileAddresses();
	getFamily();
	getEducation();
	getIDs();
	getAppointment();
	getDesignation();	
	getSchedules();
}

function getProfile(){
	var action = 'getProfile';

	var data = [action, id];
	
	$.ajax({
		type: 'POST',
		url: '../employee/my/action.php',
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
		url: '../employee/my/action.php',
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
		url: '../employee/my/action.php',
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
		url: '../employee/my/action.php',
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
		url: '../employee/my/action.php',
		data: {data:data},	
		success: function(result){
			$('#my-guardian').html(result);
		}
	});	
}

function getFamily(){
	var action = 'getFamily';
	var data = [action, id];
	
	$.ajax({
		type: 'POST',
		url: '../employee/my/action.php',
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
		url: '../employee/my/action.php',
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
		url: '../employee/my/action.php',
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
		url: '../employee/my/action.php',
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
		url: '../employee/my/action.php',
		data: {data:data},	
		success: function(result){
			$('#my-designation').html(result);
		}
	});		
}

function getSchedules(){
	var action = 'getSchedules';
	var data = [action, id, <?php echo $_SESSION['current_sy'];?>];
	
	$.ajax({
		type: 'POST',
		url: '../employee/academics/action.php',
		data: {data:data},	
		success: function(result){
			$('#my-loads').html(result);
		}
	});	
}
</script>	