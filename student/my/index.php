<?php
/*
 * Academics Visible Page
 *
 * This page is used to manage the features for Student->My. 
 * @author    	Fernando B. Enad
 * @license    	Public
 */
?>
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
											<a class="dropdown-item" id="custom-content-below-family-tab" data-toggle="pill" href="#custom-content-below-family" role="tab" aria-controls="custom-content-below-family" aria-selected="true">Family Information</a>
											<a class="dropdown-item" id="custom-content-below-contact-tab" data-toggle="pill" href="#custom-content-below-contact" role="tab" aria-controls="custom-content-below-contact" aria-selected="true">Emergency Contact</a>
											
											<a class="dropdown-item" id="custom-content-below-background-tab" data-toggle="pill" href="#custom-content-below-background" role="tab" aria-controls="custom-content-below-background" aria-selected="true">Enrollment History</a>
										</div>
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
									<div class="tab-pane fade" id="custom-content-below-message" role="tabpanel" aria-labelledby="custom-content-below-message-tab">
										<div class="card-body">
											
											<div class="table-responsive">
												<table class="table table-hover table-condensed table-striped">
													<thead>
														<th width="20%">Date Created</th>
														<th>Feedback</th>
														<th>Remarks</th>
													</thead>
													<tbody id="messages"> 
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
									<label for="exampleInputEmail1" style="line-height: 0.8"><small><small>Write down the details of your feedback to the School Registrar (eg. name correction, and other student records-related concerns):</small></small></label>
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
var id = <?php echo $_SESSION['stud_no'];?>;
	
setTimeout(function(){preLoad();}, 1);

function preLoad(){
	getProfile();
	setTimeout(function(){getCourse();}, 1);
	getProfileFull();	
	getProfileAddresses();
	getParents();
	getGuardian();
	getHistory();
	getLogs();
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

function getCourse(){
	var action = 'getCourse';
	var data = [action, id];
	
	$.ajax({
		type: 'POST',
		url: 'my/action.php',
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

function getParents(){
	var action = 'getParents';
	var data = [action, id];
	
	$.ajax({
		type: 'POST',
		url: 'my/action.php',
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
		url: 'my/action.php',
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
		url: 'my/action.php',
		data: {data:data},	
		success: function(result){
			$('#my-history').html(result);
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
</script>	