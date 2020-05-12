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
							<li class="breadcrumb-item"><a href="?p=students">Students</a></li>
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
										<button type="button" class="btn btn-warning" id="user-disable" title="Deactivate student" onclick="return confirm('Deactivate student?') ? userModifyLogin('0'): false;"><i class="fas fa-user-slash"></i></button>
										<button type="button" class="btn btn-info" id="user-reset" title="Reset student account/password" onclick="return confirm('Reset student account/password?') ? userModifyLogin('1'): false;"><i class="fas fa-sync-alt"></i></button>
									</div>
									<div class="btn-group btn-group-sm" id="form-modify">
										<!--<button type="button" class="btn btn-info" id="user-print-id" title="Print ID"><i class="fas fa-id-card"></i></button>-->									
										<a href="?p=students&modify=<?php echo $_GET['show'];?>" class="btn btn-info"  id="user-edit" title="Modify student"><i class="fas fa-user-edit"></i></a>
									</div>
								</div>
							</div>
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
											<a class="dropdown-item" id="custom-content-below-family-tab" data-toggle="pill" href="#custom-content-below-family" role="tab" aria-controls="custom-content-below-family" aria-selected="true">Family Information</a>
											<a class="dropdown-item" id="custom-content-below-contact-tab" data-toggle="pill" href="#custom-content-below-contact" role="tab" aria-controls="custom-content-below-contact" aria-selected="true">Emergency Contact</a>
											<a class="dropdown-item" id="custom-content-below-background-tab" data-toggle="pill" href="#custom-content-below-background" role="tab" aria-controls="custom-content-below-background" aria-selected="true">Enrollment History</a>
										</div>
									</li>
									<li class="nav-item">
										<a class="nav-link" id="custom-content-below-schedule-tab" data-toggle="pill" href="#custom-content-below-schedule" role="tab" aria-controls="custom-content-below-schedule" aria-selected="true">Schedule</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" id="custom-content-below-grades-tab" data-toggle="pill" href="#custom-content-below-grades" role="tab" aria-controls="custom-content-below-grades" aria-selected="true">Grades</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" id="custom-content-below-historicalprospectus-tab" data-toggle="pill" href="#custom-content-below-historicalprospectus" role="tab" aria-controls="custom-content-below-historicalprospectus" aria-selected="true">Prospectus</a>
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
															<th width="30%">Fields</th>
															<th>Details</th>													
													</thead>
													<tbody id="my-parents"> 	
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="custom-content-below-contact" role="tabpanel" aria-labelledby="custom-content-below-contact-tab">
										<div class="card-body">
											<div class="table-responsive">
												<table class="table table-hover table-condensed table-striped">
													<thead>
															<th width="30%">Fields</th>
															<th>Details</th>													
													</thead>
													<tbody id="my-guardian"> 

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
														<th width="15%">School Year</th>
														<th>School</th>
														<th width="5%">Level</th>
														<th width="17%">Section</th>
														<th width="14%">Status</th>
													</thead>
													<tbody id="my-history"> 
													</tbody>
												</table>
											</div>														
										</div>														
									</div>
									<div class="tab-pane fade show" id="custom-content-below-schedule" role="tabpanel" aria-labelledby="custom-content-below-schedule-tab">
										<br>
										<div class="row">
											<div class="col-md-8">
											</div>
											<div class="col-md-4">
												<select class="form-control" onchange="changeTerm();" id="myacademics-myterms">

												</select><br>
											</div>
										</div>
										
										<div class="card">
											<div class="card-body table-responsive p-0">
												<table class="table table-hover table-striped">
													<thead>
														<tr>
															<th width="15%">Course Code</th>
															<th>Descriptive Title</th>
															<th width="3%"></th>
															<th width="15%">Time</th>
															<th width="8%">Days</th>
															<th width="10%">Room</th>
															<th width="15%">Teacher</th>
														</tr>		
													</thead>
													<tbody id="myacademics-schedule"> 
					
													</tbody>
												</table>
											</div>	
										</div>	
									</div>
									<div class="tab-pane fade" id="custom-content-below-grades" role="tabpanel" aria-labelledby="custom-content-below-grades-tab">
										<br>
										<div id="myacademics-grade">									

										</div>
									</div>
									<div class="tab-pane fade show" id="custom-content-below-historicalprospectus" role="tabpanel" aria-labelledby="custom-content-below-historicalprospectus-tab">
										<br>
										<div id="myacademics-prospectushistory">
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
var currentSY = <?php echo $_SESSION['current_sy'];?>;
var currentSem = <?php echo $_SESSION['current_sem'];?>;
var currentCurrYear = <?php echo $_SESSION['current_currYear'];?>;
	
setTimeout(function(){preLoad();}, 1);

function preLoad(){
	getProfile();
	getCourse();
	getProfileFull();	
	getProfileAddresses();
	getParents();
	getGuardian();
	getHistory();
	getStatus();
	
	getScheduleTerms();
	getGradeTerms();
	getSchedules();
	getProspectusHistory();
	
	checkRequirementsPriorToEnroll();
}

function getProfile(){
	var action = 'getProfile';
	var data = [action, id];
	
	$.ajax({
		type: 'POST',
		url: '../student/my/action.php',
		data: {data:data},	
		success: function(result){
			$('#my-basic').html(result);
		}
	});
}

function getCourse(){
	var action = 'getCourse';
	var data = [action, id];
	
	$.ajax({
		type: 'POST',
		url: '../student/my/action.php',
		data: {data:data},	
		success: function(result){
			$('#my-course').html(result);
		}
	});
}

function getProfileFull(){
	var action = 'getProfileFull';
	var data = [action, id];
	
	$.ajax({
		type: 'POST',
		url: '../student/my/action.php',
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
		url: '../student/my/action.php',
		data: {data:data},	
		success: function(result){
			$('#my-addresses').html(result);
		}
	});
}

function getParents(){
	var action = 'getParents';
	var data = [action, id];
	
	$.ajax({
		type: 'POST',
		url: '../student/my/action.php',
		data: {data:data},	
		success: function(result){
			$('#my-parents').html(result);
		}
	});	
}

function getGuardian(){
	var action = 'getGuardian';
	var data = [action, id];
	
	$.ajax({
		type: 'POST',
		url: '../student/my/action.php',
		data: {data:data},	
		success: function(result){
			$('#my-guardian').html(result);
		}
	});	
}

function getHistory(){
	var action = 'getHistory';
	var data = [action, id];
	
	$.ajax({
		type: 'POST',
		url: '../student/my/action.php',
		data: {data:data},	
		success: function(result){
			$('#my-history').html(result);
		}
	});	
}

function getStatus(){
	var action = 'getStatus';
	var data = [action, id];
	
	$.ajax({
		type: 'POST',
		url: 'students/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[2].stud_status == 1){
				$('#user-disable').removeAttr('disabled');
			} else {
				$('#user-disable').attr('disabled', 'disabled');
			}			
		}
	});			
}

function userModifyLogin(status){
	var action = 'userModifyLogin';
	var option = status == '0' ? " stud_status = '0' " : " stud_status = '1', stud_password = '<?php echo MD5($default_pass);?>' ";
	
	var data = [action, id, option];	
	$.ajax({
		type: 'POST',
		url: 'students/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				toastr.success(result[1]);
				getStatus();
			} else {
				toastr.error(result[1]);
			}	
		}
	});	
	
}

function getScheduleTerms(){
	var action = 'getScheduleTerms';
	var data = [action, id];
	
	$.ajax({
		type: 'POST',
		url: '../student/my/action.php',
		data: {data:data},	
		success: function(result){
			$('#myacademics-myterms').html(result);
		}
	});	
}

function getSchedules(){
	var action = 'getSchedules';
	var data = [action, id, currentSY, currentSem];
	
	$.ajax({
		type: 'POST',
		url: '../student/my/action.php',
		data: {data:data},	
		success: function(result){
			$('#myacademics-schedule').html(result);
			//$('#myacademics-myterms').val(currentSY+''+currentSem).change();
		}
	});	
}

function changeTerm(){
	currentSY = $('#myacademics-myterms').val().substring(0,4);
	currentSem = $('#myacademics-myterms').val().substring(4);
	getSchedules();
}

function getGradeTerms(){
	var action = 'getGradeTerms';
	var data = [action, id];
	
	$.ajax({
		type: 'POST',
		url: '../student/my/action.php',
		data: {data:data},	
		success: function(result){
			$('#myacademics-grade').html(result);
		}
	});	
}

function getProspectusHistory(){
	var action = 'getProspectusHistory';
	var data = [action, id, currentSY, currentCurrYear];
	
	$.ajax({
		type: 'POST',
		url: '../student/my/action.php',
		data: {data:data},	
		success: function(result){
			$('#myacademics-prospectushistory').html(result);
		}
	});	
}


</script>	