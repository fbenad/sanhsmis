	<div class="content-wrapper">
	
		<section class="content-header">
			<div class="container">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Manage Employee</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="?p=my"><i class="fas fa-home"></i></a></li>
							<li class="breadcrumb-item"><a href="?p=employees">Employees</a></li>
							<li class="breadcrumb-item"><a href="?p=employees&show=<?php echo $_GET['modify'];?>">Profile</a></li>
							<li class="breadcrumb-item active">Manage</li>
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
							<div class="card-body">
								<span id="entity-name"></span><br>
								<ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" id="custom-content-below-1-tab" data-toggle="pill" href="#custom-content-below-1" role="tab" aria-controls="custom-content-below-1" aria-selected="false">Basic Information</a>
									</li>	
									<li class="nav-item">
										<a class="nav-link" id="custom-content-below-2-tab" data-toggle="pill" href="#custom-content-below-2" role="tab" aria-controls="custom-content-below-2" aria-selected="false">Family</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" id="custom-content-below-3-tab" data-toggle="pill" href="#custom-content-below-3" role="tab" aria-controls="custom-content-below-3" aria-selected="false">Educational Background</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" id="custom-content-below-4-tab" data-toggle="pill" href="#custom-content-below-4" role="tab" aria-controls="custom-content-below-4" aria-selected="false">Personal IDs</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" id="custom-content-below-5-tab" data-toggle="pill" href="#custom-content-below-5" role="tab" aria-controls="custom-content-below-5" aria-selected="false">Appointments</a>
									</li>
								</ul>
								<div class="tab-content" id="custom-content-below-tabContent">
									<div class="tab-pane fade show active" id="custom-content-below-1" role="tabpanel" aria-labelledby="custom-content-below-1-tab">
										<br>
										<div class="card">
											<form role="form" id="form" method="post" onSubmit="return false;">	
											<div class="card-body table-responsive p-0" id="getBasic">
											</div>
											<div class="card-footer clearfix" id="edit-entity">
												<div class="row">
													<div class="col-md-4">
														<button type="button" class="btn btn-default" id="btnCancel" name="btnCancel" onclick="hideEditForm();">Cancel</button>
													</div>
													<div class="col-md-4">
													</div>
													<div class="col-md-4">
														<button type="submit" class="btn btn-info float-right" id="btnSubmit" name="btnSubmit" onclick="return confirm('Update employee?') ? modifyEntity() : false;">Update</button>
													</div>
												</div>
											</div>
											</form>
										</div>										
									</div>
									<div class="tab-pane fade show " id="custom-content-below-2" role="tabpanel" aria-labelledby="custom-content-below-2-tab">
										<br>
										<div class="card">
											<div class="card-body table-responsive p-0" id="get-other-1">
											</div>
										</div>
									</div>
									<div class="tab-pane fade show " id="custom-content-below-3" role="tabpanel" aria-labelledby="custom-content-below-3-tab">
										<br>
										<div class="card">
											<div class="card-body table-responsive p-0" id="get-other-2">
											</div>
										</div>
									</div>
									<div class="tab-pane fade show " id="custom-content-below-4" role="tabpanel" aria-labelledby="custom-content-below-4-tab">
										<br>
										<div class="card">
											<div class="card-body table-responsive p-0" id="get-other-3">
											</div>
										</div>
									</div>
									<div class="tab-pane fade show" id="custom-content-below-5" role="tabpanel" aria-labelledby="custom-content-below-5-tab">
										<br>
										<div id="get-other-4">
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

<div class="modal fade" id="modal-input">
	<div class="modal-dialog" id="modal-size">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="modal-title">x</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close1">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form role="form" id="form" method="post" onSubmit="return false;">	
				<div id="form-input">
				</div>
			</div>			
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-default" data-dismiss="modal" id="close2">Close</button>
				<button type="submit" class="btn btn-info" name="submit" id="submit"></button>
				</form>	
			</div>			
		</div>
	</div>
</div>
	
<script type="text/javascript">	
var teach_no = <?php echo $_GET['modify'];?>;

setTimeout(function(){preLoad();}, 1);

setTimeout(function(){
	$(function(){
		$('#modal-input').on('show.bs.modal', function(e){
			var actionType = $(e.relatedTarget).attr('data-type');
			var actionTitle = $(e.relatedTarget).attr('title');
			var id = $(e.relatedTarget).attr('rowID');
			var userFunc = '';
			
			if(actionType == 'addFamily'){
				$('#modal-size').addClass('modal-md');
				$('#modal-title').html(actionTitle);
				$('#submit').html('Submit');
				userFunc = "return confirm('Save family?') ? submitAction('"+actionType+"') : false;";
				$('#submit').attr('onclick', userFunc);
			} else if(actionType == 'addEducation'){
				$('#modal-size').addClass('modal-md');
				$('#modal-title').html(actionTitle);
				$('#submit').html('Submit');
				userFunc = "return confirm('Save education?') ? submitAction('"+actionType+"') : false;";
				$('#submit').attr('onclick', userFunc);
			} else if(actionType == 'addID'){
				$('#modal-size').addClass('modal-md');
				$('#modal-title').html(actionTitle);
				$('#submit').html('Submit');
				userFunc = "return confirm('Save ID?') ? submitAction('"+actionType+"') : false;";
				$('#submit').attr('onclick', userFunc);
			} else if(actionType == 'addAppointment'){
				$('#modal-size').addClass('modal-md');
				$('#modal-title').html(actionTitle);
				$('#submit').html('Submit');
				userFunc = "return confirm('Save appointment?') ? submitAction('"+actionType+"') : false;";
				$('#submit').attr('onclick', userFunc);
			} else if(actionType == 'addDesignation'){
				$('#modal-size').addClass('modal-md');
				$('#modal-title').html(actionTitle);
				$('#submit').html('Submit');
				userFunc = "return confirm('Save designation?') ? submitAction('"+actionType+"') : false;";
				$('#submit').attr('onclick', userFunc);
			} else if(actionType == 'modifyFamily'){
				$('#modal-size').addClass('modal-md');
				$('#modal-title').html(actionTitle+' #<span id="list-id">'+id+'</span>');
				$('#submit').html('Update');
				userFunc = "return confirm('Update family?') ? submitAction('"+actionType+"') : false;";
				$('#submit').attr('onclick', userFunc);
			} else if(actionType == 'modifyEducation'){
				$('#modal-size').addClass('modal-md');
				$('#modal-title').html(actionTitle+' #<span id="list-id">'+id+'</span>');
				$('#submit').html('Update');
				userFunc = "return confirm('Update education?') ? submitAction('"+actionType+"') : false;";
				$('#submit').attr('onclick', userFunc);
			} else if(actionType == 'modifyID'){
				$('#modal-size').addClass('modal-md');
				$('#modal-title').html(actionTitle+' #<span id="list-id">'+id+'</span>');
				$('#submit').html('Update');
				userFunc = "return confirm('Update ID?') ? submitAction('"+actionType+"') : false;";
				$('#submit').attr('onclick', userFunc);
			} else if(actionType == 'modifyAppointment'){
				$('#modal-size').addClass('modal-md');
				$('#modal-title').html(actionTitle+' #<span id="list-id">'+id+'</span>');
				$('#submit').html('Update');
				userFunc = "return confirm('Update appointment?') ? submitAction('"+actionType+"') : false;";
				$('#submit').attr('onclick', userFunc);
			} else if(actionType == 'modifyDesignation'){
				$('#modal-size').addClass('modal-md');
				$('#modal-title').html(actionTitle+' #<span id="list-id">'+id+'</span>');
				$('#submit').html('Update');
				userFunc = "return confirm('Update designation?') ? submitAction('"+actionType+"') : false;";
				$('#submit').attr('onclick', userFunc);
			}
			
			showAction(actionType, $('#list-id').html());
		});
		
		$('#modal-input').on('hidden.bs.modal', function(){
			$('#modal-size').removeClass('modal-xs');
			$('#modal-size').removeClass('modal-sm');
			$('#modal-size').removeClass('modal-md');
			$('#modal-size').removeClass('modal-lg');
			$('#modal-size').removeClass('modal-xl');
			$('#form').trigger('reset');
			$('#form-input').html('');
			
			$('#submit').html('');
			$('#submit').removeAttr('disabled');
			
			$('#close1').removeAttr('disabled');
			$('#close2').removeAttr('disabled');						
		});
	});
}, 1);

function preLoad(){
	getBasic();
	hideEditForm();
	setTimeout(function(){hideEditForm();}, 300);
	getOther();
}

function getBasic(){
	var action = 'getBasic';
	
	var data = [action, teach_no];	
	$.ajax({
		type: 'POST',
		url: 'employees/show/action.php',
		data: {data:data},	
		success: function(result){
			$('#getBasic').html(result);
		}
	});	
}

function hideEditForm(){
	var action = 'hideEditForm';
	$('#teach_id').hide();
	$('#teach_fname').hide();
	$('#teach_mname').hide();
	$('#teach_lname').hide();
	$('#teach_xname').hide();
	$('#teach_gender').hide();
	$('#teach_bdate').hide();
	$('#teach_residence').hide();
	$('#teach_cstatus').hide();
	$('#teach_dialect').hide();
	$('#teach_ethnicity').hide();
	$('#teach_tin').hide();
	$('#teach_bio_no').hide();
	$('#edit-entity').hide();
	$('#entity-edit-button').attr('onclick', 'showEditForm();');
	$('#entity-edit-button').html('<i class="fas fa-pen"></i>');	
}

function showEditForm(){
	var action = 'showEditForm';
	$('#teach_id').show();
	$('#teach_fname').show();
	$('#teach_mname').show();
	$('#teach_lname').show();
	$('#teach_xname').show();
	$('#teach_gender').show();
	$('#teach_bdate').show();
	$('#teach_residence').show();
	$('#teach_cstatus').show();
	$('#teach_dialect').show();
	$('#teach_ethnicity').show();
	$('#teach_tin').show();	
	$('#teach_bio_no').show();	
	$('#edit-entity').show();	
	$('#entity-edit-button').attr('onclick', 'hideEditForm()');	
	$('#entity-edit-button').html('<i class="fas fa-times"></i>');	
}

function modifyEntity(){
	var action = 'modifyEntity';
	var teach_id = $('#teach_id').val();
	var teach_fname = $('#teach_fname').val();
	var teach_mname = $('#teach_mname').val();
	var teach_lname = $('#teach_lname').val();
	var teach_xname = $('#teach_xname').val();
	var teach_gender = $('#teach_gender').val();
	var teach_bdate = $('#teach_bdate').val();
	var teach_residence = $('#teach_residence').val();
	var teach_cstatus = $('#teach_cstatus').val();
	var teach_dialect = $('#teach_dialect').val();
	var teach_ethnicity = $('#teach_ethnicity').val();
	var teach_tin = $('#teach_tin').val();	
	var teach_bio_no = $('#teach_bio_no').val();	
	var teach_no = <?php echo $_GET['modify'];?>;	
	
	var data = [action, teach_id, teach_fname, teach_mname, teach_lname, teach_xname, teach_gender, 
		teach_bdate, teach_residence, teach_cstatus, teach_dialect, teach_ethnicity, teach_tin, teach_bio_no, teach_no];
	if(data[1] == '' || data[1] < 100000 || data[1] > 999999999){
		toastr.error('Invalid employee number.');
	} else if(data[2] == '' || data[2].length < 3){
		toastr.error('Invalid first name.');
	} else if(data[4] == '' || data[4].length < 3){
		toastr.error('Invalid last name.');
	} else if(data[6] == ''){
		toastr.error('Invalid gender.');
	} else if(data[7] == '' || Date.parse(data[7]) < Date.parse('<?php echo date('Y-m-d', strtotime('-50 years'));?>') || Date.parse(data[7]) > Date.parse('<?php echo date('Y-m-d', strtotime('-18 years'));?>')){
		toastr.error('Invalid birth date.');
	} else if(data[8] == '' || data[8].length < 3){
		toastr.error('Invalid residence.');
	} else if(data[9] == ''){
		toastr.error('Invalid civil status.');
	} else if(data[10] == '' || data[10].length < 11){
		toastr.error('Invalid phone number.');
	} else if(data[11] == '' || data[10].length < 3){
		toastr.error('Invalid email.');
	} else if(data[12] == '' || data[12] < 100000000 || data[12] > 999999999){
		toastr.error('Invalid TIN.');
	} else if(data[13] == '' || data[13] < 1 || data[13] > 10000){
		toastr.error('Invalid biometric ID.');
	} else {
		$('#btnCancel').attr('disabled', 'disabled');
		$('#btnSubmit').attr('disabled', 'disabled');
		$('#btnSubmit').html('Validating...');
		
		$.ajax({
			type: 'POST',
			url: 'employees/show/action.php',
			data: {data:data},	
			success: function(result){
				if(result[0] == 1){
					setTimeout(function(){$('#btnSubmit').html('Saving...');}, 500);
					setTimeout(function(){$('#btnSubmit').html('Submit');}, 1000);
					setTimeout(function(){$('#btnSubmit').removeAttr('disabled', 'disabled');}, 1000);
					setTimeout(function(){$('#btncancel').removeAttr('disabled', 'disabled');}, 1000);
					setTimeout(function(){toastr.success(result[1]);}, 1500);
					setTimeout(function(){preLoad();}, 2000);
				} else {
					setTimeout(function(){$('#btnSubmit').html('Submit');}, 500);
					setTimeout(function(){$('#btnSubmit').removeAttr('disabled', 'disabled');}, 500);
					setTimeout(function(){$('#btncancel').removeAttr('disabled', 'disabled');}, 500);
					setTimeout(function(){toastr.error(result[1]);}, 500);
				}
			}
		});	
	}
}

function getOther(){
	var action = 'getOther';
	
	var data = ['getOther1', teach_no];	
	$.ajax({
		type: 'POST',
		url: 'employees/show/action.php',
		data: {data:data},	
		success: function(result){
			$('#get-other-1').html(result);
		}
	});
	
	var data = ['getOther2', teach_no];	
	$.ajax({
		type: 'POST',
		url: 'employees/show/action.php',
		data: {data:data},	
		success: function(result){
			$('#get-other-2').html(result);
		}
	});
	
	var data = ['getOther3', teach_no];	
	$.ajax({
		type: 'POST',
		url: 'employees/show/action.php',
		data: {data:data},	
		success: function(result){
			$('#get-other-3').html(result);
		}
	});
	
	var data = ['getOther4', teach_no];	
	$.ajax({
		type: 'POST',
		url: 'employees/show/action.php',
		data: {data:data},	
		success: function(result){
			$('#get-other-4').html(result);
		}
	});
}

function showAction(actionType, list_id){
	var action = 'showAction';
	
	var data = [action, actionType, list_id];
	if(actionType == 'addFamily'){
		$.ajax({
			type: 'POST',
			url: 'employees/show/action.php',
			data: {data:data},	
			success: function(result){
				$('#form-input').html(result);
			}
		});
	} else if(actionType == 'addEducation'){
		$.ajax({
			type: 'POST',
			url: 'employees/show/action.php',
			data: {data:data},	
			success: function(result){
				$('#form-input').html(result);
			}
		});
	} else if(actionType == 'addID'){
		$.ajax({
			type: 'POST',
			url: 'employees/show/action.php',
			data: {data:data},	
			success: function(result){
				$('#form-input').html(result);
			}
		});
	} else if(actionType == 'addAppointment'){
		$.ajax({
			type: 'POST',
			url: 'employees/show/action.php',
			data: {data:data},	
			success: function(result){
				$('#form-input').html(result);
			}
		});
	} else if(actionType == 'addDesignation'){
		$.ajax({
			type: 'POST',
			url: 'employees/show/action.php',
			data: {data:data},	
			success: function(result){
				$('#form-input').html(result);
			}
		});
	} else 	if(actionType == 'modifyFamily'){
		$.ajax({
			type: 'POST',
			url: 'employees/show/action.php',
			data: {data:data},	
			success: function(result){
				$('#form-input').html(result);
			}
		});
	} else if(actionType == 'modifyEducation'){
		$.ajax({
			type: 'POST',
			url: 'employees/show/action.php',
			data: {data:data},	
			success: function(result){
				$('#form-input').html(result);
			}
		});
	} else if(actionType == 'modifyID'){
		$.ajax({
			type: 'POST',
			url: 'employees/show/action.php',
			data: {data:data},	
			success: function(result){
				$('#form-input').html(result);
			}
		});
	} else if(actionType == 'modifyAppointment'){
		$.ajax({
			type: 'POST',
			url: 'employees/show/action.php',
			data: {data:data},	
			success: function(result){
				$('#form-input').html(result);
			}
		});
	} else if(actionType == 'modifyDesignation'){
		$.ajax({
			type: 'POST',
			url: 'employees/show/action.php',
			data: {data:data},	
			success: function(result){
				$('#form-input').html(result);
			}
		});
	}
}

function submitAction(actionType){
	var action = 'submitAction';
	
	if(actionType == 'addFamily'){
		var teachCont_fname = $('#teachCont_fname').val();
		var teachCont_mname = $('#teachCont_mname').val();
		var teachCont_lname = $('#teachCont_lname').val();
		var teachCont_xname = $('#teachCont_xname').val();
		var teachCont_type = $('#teachCont_type').val();
		
		var data = [action, actionType, teachCont_fname, teachCont_mname, teachCont_lname, teachCont_xname, teachCont_type, teach_no];
		if(data[2] == ''){
			toastr.error('Invalid first name.');
		} else if(data[4] == ''){
			toastr.error('Invalid last name.');
		} else if(data[6] == ''){
			toastr.error('Invalid relationship.');
		} else {
			$('#close1').attr('disabled', 'disabled');
			$('#close2').attr('disabled', 'disabled');
			$('#submit').attr('disabled', 'disabled');
			$('#submit').html('Validating...');
			
			$.ajax({
				type: 'POST',
				url: 'employees/show/action.php',
				data: {data:data},	
				success: function(result){
					if(result[0] == 1){
						setTimeout(function(){$('#submit').html('Saving...');}, 500);
						setTimeout(function(){$('#submit').html('Submit');}, 1000);
						setTimeout(function(){toastr.success(result[1]);}, 1000);
						setTimeout(function(){$('#modal-input').modal('hide');}, 1500);	
						preLoad();
						
					} else {
						setTimeout(function(){$('#close1').removeAttr('disabled');}, 500);
						setTimeout(function(){$('#close2').removeAttr('disabled');}, 500);	
						setTimeout(function(){$('#submit').removeAttr('disabled');}, 500);						
						setTimeout(function(){$('#submit').html('Submit');}, 500);						
						setTimeout(function(){toastr.error(result[1]);}, 500);						
					}
				}
			});	
		}
		
	} else if(actionType == 'addEducation'){
		var eback_level = $('#eback_level').val();
		var eback_degree = $('#eback_degree').val();
		var eback_major = $('#eback_major').val();
		var eback_minor = $('#eback_minor').val();
		var eback_units = $('#eback_units').val();
		
		var data = [action, actionType, eback_level, eback_degree, eback_major, eback_minor, eback_units, teach_no];
		if(data[2] == ''){
			toastr.error('Invalid educational level.');
		} else if(data[3] == ''){
			toastr.error('Invalid degree.');
		} else if(data[6] == ''){
			toastr.error('Invalid obtained units value.');
		} else {
			$('#close1').attr('disabled', 'disabled');
			$('#close2').attr('disabled', 'disabled');
			$('#submit').attr('disabled', 'disabled');
			$('#submit').html('Validating...');
			
			$.ajax({
				type: 'POST',
				url: 'employees/show/action.php',
				data: {data:data},	
				success: function(result){
					if(result[0] == 1){
						setTimeout(function(){$('#submit').html('Saving...');}, 500);
						setTimeout(function(){$('#submit').html('Submit');}, 1000);
						setTimeout(function(){toastr.success(result[1]);}, 1000);
						setTimeout(function(){$('#modal-input').modal('hide');}, 1500);	
						preLoad();
						
					} else {
						setTimeout(function(){$('#close1').removeAttr('disabled');}, 500);
						setTimeout(function(){$('#close2').removeAttr('disabled');}, 500);	
						setTimeout(function(){$('#submit').removeAttr('disabled');}, 500);						
						setTimeout(function(){$('#submit').html('Submit');}, 500);						
						setTimeout(function(){toastr.error(result[1]);}, 500);						
					}
				}
			});	
		}
		
	} else if(actionType == 'addID'){
		var teacherids_id = $('#teacherids_id').val();
		var teacherids_details = $('#teacherids_details').val();
		var teacherids_date_issued = $('#teacherids_date_issued').val();
		var teacherids_place_issued = $('#teacherids_place_issued').val();
		
		var data = [action, actionType, teacherids_id, teacherids_details, teacherids_date_issued, teacherids_place_issued, teach_no];
		if(data[2] == ''){
			toastr.error('Invalid ID type.');
		} else if(data[3] == ''){
			toastr.error('Invalid ID number.');
		} else if(data[4] == '' || Date.parse(data[4]) < Date.parse('<?php echo date('Y-m-d' ,strtotime('-25 years'));?>')|| Date.parse(data[4]) > Date.parse('<?php echo date('Y-m-d');?>')){
			toastr.error('Invalid date issued.');
		} else if(data[5] == ''){
			toastr.error('Invalid place issued.');
		} else {
			$('#close1').attr('disabled', 'disabled');
			$('#close2').attr('disabled', 'disabled');
			$('#submit').attr('disabled', 'disabled');
			$('#submit').html('Validating...');
			
			$.ajax({
				type: 'POST',
				url: 'employees/show/action.php',
				data: {data:data},	
				success: function(result){
					if(result[0] == 1){
						setTimeout(function(){$('#submit').html('Saving...');}, 500);
						setTimeout(function(){$('#submit').html('Submit');}, 1000);
						setTimeout(function(){toastr.success(result[1]);}, 1000);
						setTimeout(function(){$('#modal-input').modal('hide');}, 1500);	
						preLoad();
						
					} else {
						setTimeout(function(){$('#close1').removeAttr('disabled');}, 500);
						setTimeout(function(){$('#close2').removeAttr('disabled');}, 500);	
						setTimeout(function(){$('#submit').removeAttr('disabled');}, 500);						
						setTimeout(function(){$('#submit').html('Submit');}, 500);						
						setTimeout(function(){toastr.error(result[1]);}, 500);						
					}
				}
			});	
		}
	} else if(actionType == 'addAppointment'){
		var employee_type = $('#employee_type').val();
		var teacherappointments_position = $('#teacherappointments_position').val();
		var teacherappointments_item_no = $('#teacherappointments_item_no').val();
		var teacherappointments_date = $('#teacherappointments_date').val();
		var teacherappointments_fdaydate = $('#teacherappointments_fdaydate').val();
		var teacherappointments_status = $('#teacherappointments_status').val();
		var teacherappointments_funding = $('#teacherappointments_funding').val();
		var teacherappointments_active = $('#teacherappointments_active').is(":checked") ? '1' : '0';
		
		var data = [action, actionType, employee_type, teacherappointments_position, teacherappointments_item_no, teacherappointments_date, 
				teacherappointments_fdaydate, teacherappointments_status, teacherappointments_funding,
				teacherappointments_active,	teach_no];
		if(data[2] == ''){
			toastr.error('Invalid employee type.');
		} else if(data[3] == ''){
			toastr.error('Invalid position.');
		} else if(data[4] == ''){
			toastr.error('Invalid item number.');
		} else if(data[5] == '' || Date.parse(data[5]) < Date.parse('<?php echo date('Y-m-d' ,strtotime('-25 years'));?>')|| Date.parse(data[5]) > Date.parse('<?php echo date('Y-m-d');?>')){
			toastr.error('Invalid appointment date.');
		} else if(data[6] == '' || Date.parse(data[6]) < Date.parse('<?php echo date('Y-m-d' ,strtotime('-25 years'));?>')|| Date.parse(data[6]) > Date.parse('<?php echo date('Y-m-d');?>')){
			toastr.error('Invalid first day date.');
		} else if(data[7] == ''){
			toastr.error('Invalid status.');
		} else if(data[8] == ''){
			toastr.error('Invalid funding.');
		} else {
			$('#close1').attr('disabled', 'disabled');
			$('#close2').attr('disabled', 'disabled');
			$('#submit').attr('disabled', 'disabled');
			$('#submit').html('Validating...');
			
			$.ajax({
				type: 'POST',
				url: 'employees/show/action.php',
				data: {data:data},	
				success: function(result){
					if(result[0] == 1){
						setTimeout(function(){$('#submit').html('Saving...');}, 500);
						setTimeout(function(){$('#submit').html('Submit');}, 1000);
						setTimeout(function(){toastr.success(result[1]);}, 1000);
						if(teacherappointments_active == '1'){
							setTimeout(function(){updateTeacher(teach_no, employee_type);}, 2000);
							setTimeout(function(){updateAppointment(teach_no, result[2]);}, 2500);
						} 
						setTimeout(function(){preLoad();}, 3000);
						setTimeout(function(){$('#modal-input').modal('hide');}, 3500);
						
						
					} else {
						setTimeout(function(){$('#close1').removeAttr('disabled');}, 500);
						setTimeout(function(){$('#close2').removeAttr('disabled');}, 500);	
						setTimeout(function(){$('#submit').removeAttr('disabled');}, 500);						
						setTimeout(function(){$('#submit').html('Submit');}, 500);						
						setTimeout(function(){toastr.error(result[1]);}, 500);						
					}
				}
			});	
		}
	} else if(actionType == 'addDesignation'){
		var teacherappointments_position = $('#teacherappointments_position').val();
		var teacherappointments_date = $('#teacherappointments_date').val();
		var teacherappointments_status = $('#teacherappointments_status').val();
		var teacherappointments_funding = $('#teacherappointments_funding').val();
		
		var data = [action, actionType, teacherappointments_position, teacherappointments_date, 
				teacherappointments_status, teacherappointments_funding, teach_no];
		if(data[2] == ''){
			toastr.error('Invalid designation.');
		} else if(data[3] == '' || Date.parse(data[3]) < Date.parse('<?php echo date('Y-m-d' ,strtotime('-25 years'));?>')|| Date.parse(data[3]) > Date.parse('<?php echo date('Y-m-d');?>')){
			toastr.error('Invalid designation date.');
		} else if(data[4] == ''){
			toastr.error('Invalid effective SY.');
		} else if(data[5] == ''){
			toastr.error('Invalid end SY.');
		} else {
			$('#close1').attr('disabled', 'disabled');
			$('#close2').attr('disabled', 'disabled');
			$('#submit').attr('disabled', 'disabled');
			$('#submit').html('Validating...');
			
			$.ajax({
				type: 'POST',
				url: 'employees/show/action.php',
				data: {data:data},	
				success: function(result){
					if(result[0] == 1){
						setTimeout(function(){$('#submit').html('Saving...');}, 500);
						setTimeout(function(){$('#submit').html('Submit');}, 1000);
						setTimeout(function(){toastr.success(result[1]);}, 1000);
						setTimeout(function(){$('#modal-input').modal('hide');}, 2500);
						preLoad();					
					} else {
						setTimeout(function(){$('#close1').removeAttr('disabled');}, 500);
						setTimeout(function(){$('#close2').removeAttr('disabled');}, 500);	
						setTimeout(function(){$('#submit').removeAttr('disabled');}, 500);						
						setTimeout(function(){$('#submit').html('Submit');}, 500);						
						setTimeout(function(){toastr.error(result[1]);}, 500);						
					}
				}
			});	
		}
		
	} else if(actionType == 'modifyFamily'){
		var teachCont_no = $('#list-id').html();
		var teachCont_fname = $('#teachCont_fname').val();
		var teachCont_mname = $('#teachCont_mname').val();
		var teachCont_lname = $('#teachCont_lname').val();
		var teachCont_xname = $('#teachCont_xname').val();
		var teachCont_type = $('#teachCont_type').val();
		
		var data = [action, actionType, teachCont_fname, teachCont_mname, teachCont_lname, teachCont_xname, teachCont_type, teachCont_no];
		if(data[2] == ''){
			toastr.error('Invalid first name.');
		} else if(data[4] == ''){
			toastr.error('Invalid last name.');
		} else if(data[6] == ''){
			toastr.error('Invalid relationship.');
		} else {
			$('#close1').attr('disabled', 'disabled');
			$('#close2').attr('disabled', 'disabled');
			$('#submit').attr('disabled', 'disabled');
			$('#btnDelete').attr('disabled', 'disabled');
			$('#submit').html('Validating...');
			
			$.ajax({
				type: 'POST',
				url: 'employees/show/action.php',
				data: {data:data},	
				success: function(result){
					if(result[0] == 1){
						setTimeout(function(){$('#submit').html('Updating...');}, 500);
						setTimeout(function(){$('#submit').html('Update');}, 1000);
						setTimeout(function(){toastr.success(result[1]);}, 1000);
						setTimeout(function(){$('#modal-input').modal('hide');}, 1500);	
						preLoad();
						
					} else {
						setTimeout(function(){$('#close1').removeAttr('disabled');}, 500);
						setTimeout(function(){$('#close2').removeAttr('disabled');}, 500);	
						setTimeout(function(){$('#submit').removeAttr('disabled');}, 500);						
						setTimeout(function(){$('#btnDelete').removeAttr('disabled');}, 500);						
						setTimeout(function(){$('#submit').html('Update');}, 500);						
						setTimeout(function(){toastr.error(result[1]);}, 500);						
					}
				}
			});	
		}
		
	} else if(actionType == 'modifyEducation'){
		var eback_no  = $('#list-id').html();
		var eback_level = $('#eback_level').val();
		var eback_degree = $('#eback_degree').val();
		var eback_major = $('#eback_major').val();
		var eback_minor = $('#eback_minor').val();
		var eback_units = $('#eback_units').val();
		
		var data = [action, actionType, eback_level, eback_degree, eback_major, eback_minor, eback_units, eback_no];
		if(data[2] == ''){
			toastr.error('Invalid educational level.');
		} else if(data[3] == ''){
			toastr.error('Invalid degree.');
		} else if(data[6] == ''){
			toastr.error('Invalid obtained units value.');
		} else {
			$('#close1').attr('disabled', 'disabled');
			$('#close2').attr('disabled', 'disabled');
			$('#submit').attr('disabled', 'disabled');
			$('#btnDelete').attr('disabled', 'disabled');
			$('#submit').html('Validating...');
			
			$.ajax({
				type: 'POST',
				url: 'employees/show/action.php',
				data: {data:data},	
				success: function(result){
					if(result[0] == 1){
						setTimeout(function(){$('#submit').html('Updating...');}, 500);
						setTimeout(function(){$('#submit').html('Update');}, 1000);
						setTimeout(function(){toastr.success(result[1]);}, 1000);
						setTimeout(function(){$('#modal-input').modal('hide');}, 1500);	
						preLoad();
						
					} else {
						setTimeout(function(){$('#close1').removeAttr('disabled');}, 500);
						setTimeout(function(){$('#close2').removeAttr('disabled');}, 500);	
						setTimeout(function(){$('#submit').removeAttr('disabled');}, 500);						
						setTimeout(function(){$('#btnDelete').removeAttr('disabled');}, 500);						
						setTimeout(function(){$('#submit').html('Update');}, 500);						
						setTimeout(function(){toastr.error(result[1]);}, 500);						
					}
				}
			});	
		}
		
	} else if(actionType == 'modifyID'){
		var teacherids_no  = $('#list-id').html();
		var teacherids_id = $('#teacherids_id').val();
		var teacherids_details = $('#teacherids_details').val();
		var teacherids_date_issued = $('#teacherids_date_issued').val();
		var teacherids_place_issued = $('#teacherids_place_issued').val();
		
		var data = [action, actionType, teacherids_id, teacherids_details, teacherids_date_issued, teacherids_place_issued, teacherids_no];
		if(data[2] == ''){
			toastr.error('Invalid ID type.');
		} else if(data[3] == ''){
			toastr.error('Invalid ID number.');
		} else if(data[4] == '' || Date.parse(data[4]) < Date.parse('<?php echo date('Y-m-d' ,strtotime('-25 years'));?>')|| Date.parse(data[4]) > Date.parse('<?php echo date('Y-m-d');?>')){
			toastr.error('Invalid date issued.');
		} else if(data[5] == ''){
			toastr.error('Invalid place issued.');
		} else {
			$('#close1').attr('disabled', 'disabled');
			$('#close2').attr('disabled', 'disabled');
			$('#submit').attr('disabled', 'disabled');
			$('#btnDelete').attr('disabled', 'disabled');
			$('#submit').html('Validating...');
			
			$.ajax({
				type: 'POST',
				url: 'employees/show/action.php',
				data: {data:data},	
				success: function(result){
					if(result[0] == 1){
						setTimeout(function(){$('#submit').html('Updating...');}, 500);
						setTimeout(function(){$('#submit').html('Update');}, 1000);
						setTimeout(function(){toastr.success(result[1]);}, 1000);
						setTimeout(function(){$('#modal-input').modal('hide');}, 1500);	
						preLoad();
						
					} else {
						setTimeout(function(){$('#close1').removeAttr('disabled');}, 500);
						setTimeout(function(){$('#close2').removeAttr('disabled');}, 500);	
						setTimeout(function(){$('#submit').removeAttr('disabled');}, 500);						
						setTimeout(function(){$('#btnDelete').removeAttr('disabled');}, 500);						
						setTimeout(function(){$('#submit').html('Update');}, 500);						
						setTimeout(function(){toastr.error(result[1]);}, 500);						
					}
				}
			});	
		}
		
	} else if(actionType == 'modifyAppointment'){
		var teacherappointments_no = $('#list-id').html();
		var employee_type = $('#employee_type').val();
		var teacherappointments_position = $('#teacherappointments_position').val();
		var teacherappointments_item_no = $('#teacherappointments_item_no').val();
		var teacherappointments_date = $('#teacherappointments_date').val();
		var teacherappointments_fdaydate = $('#teacherappointments_fdaydate').val();
		var teacherappointments_status = $('#teacherappointments_status').val();
		var teacherappointments_funding = $('#teacherappointments_funding').val();
		var teacherappointments_active = $('#teacherappointments_active').is(":checked") ? '1' : '0';
		
		var data = [action, actionType, employee_type, teacherappointments_position, teacherappointments_item_no, teacherappointments_date, 
				teacherappointments_fdaydate, teacherappointments_status, teacherappointments_funding,
				teacherappointments_active,	teacherappointments_no];
		if(data[2] == ''){
			toastr.error('Invalid employee type.');
		} else if(data[3] == ''){
			toastr.error('Invalid position.');
		} else if(data[4] == ''){
			toastr.error('Invalid item number.');
		} else if(data[5] == '' || Date.parse(data[5]) < Date.parse('<?php echo date('Y-m-d' ,strtotime('-25 years'));?>')|| Date.parse(data[5]) > Date.parse('<?php echo date('Y-m-d');?>')){
			toastr.error('Invalid appointment date.');
		} else if(data[6] == '' || Date.parse(data[6]) < Date.parse('<?php echo date('Y-m-d' ,strtotime('-25 years'));?>')|| Date.parse(data[6]) > Date.parse('<?php echo date('Y-m-d');?>')){
			toastr.error('Invalid first day date.');
		} else if(data[7] == ''){
			toastr.error('Invalid status.');
		} else if(data[8] == ''){
			toastr.error('Invalid funding.');
		} else {
			$('#close1').attr('disabled', 'disabled');
			$('#close2').attr('disabled', 'disabled');
			$('#submit').attr('disabled', 'disabled');
			$('#btnDelete').attr('disabled', 'disabled');
			$('#submit').html('Validating...');
			
			$.ajax({
				type: 'POST',
				url: 'employees/show/action.php',
				data: {data:data},	
				success: function(result){
					if(result[0] == 1){
						setTimeout(function(){$('#submit').html('Updating...');}, 500);
						setTimeout(function(){$('#submit').html('Update');}, 1000);
						setTimeout(function(){toastr.success(result[1]);}, 1000);
						if(teacherappointments_active == '1'){
							setTimeout(function(){updateTeacher(teach_no, employee_type);}, 2000);
							setTimeout(function(){updateAppointment(teach_no, teacherappointments_no);}, 2500);
						} 
						setTimeout(function(){preLoad();}, 3000);
						setTimeout(function(){$('#modal-input').modal('hide');}, 3500);
						
						
					} else {
						setTimeout(function(){$('#close1').removeAttr('disabled');}, 500);
						setTimeout(function(){$('#close2').removeAttr('disabled');}, 500);	
						setTimeout(function(){$('#submit').removeAttr('disabled');}, 500);						
						setTimeout(function(){$('#btnDelete').removeAttr('disabled');}, 500);						
						setTimeout(function(){$('#submit').html('Update');}, 500);						
						setTimeout(function(){toastr.error(result[1]);}, 500);						
					}
				}
			});	
		}
		
	} else if(actionType == 'modifyDesignation'){
		var teacherappointments_no = $('#list-id').html();
		var teacherappointments_position = $('#teacherappointments_position').val();
		var teacherappointments_date = $('#teacherappointments_date').val();
		var teacherappointments_status = $('#teacherappointments_status').val();
		var teacherappointments_funding = $('#teacherappointments_funding').val();
		
		var data = [action, actionType, teacherappointments_position, teacherappointments_date, 
				teacherappointments_status, teacherappointments_funding, teacherappointments_no];
		if(data[2] == ''){
			toastr.error('Invalid designation.');
		} else if(data[3] == '' || Date.parse(data[3]) < Date.parse('<?php echo date('Y-m-d' ,strtotime('-25 years'));?>')|| Date.parse(data[3]) > Date.parse('<?php echo date('Y-m-d');?>')){
			toastr.error('Invalid designation date.');
		} else if(data[4] == ''){
			toastr.error('Invalid effective SY.');
		} else if(data[5] == ''){
			toastr.error('Invalid end SY.');
		} else {
			$('#close1').attr('disabled', 'disabled');
			$('#close2').attr('disabled', 'disabled');
			$('#submit').attr('disabled', 'disabled');
			$('#btnDelete').attr('disabled', 'disabled');
			$('#submit').html('Validating...');
			
			$.ajax({
				type: 'POST',
				url: 'employees/show/action.php',
				data: {data:data},	
				success: function(result){
					if(result[0] == 1){
						setTimeout(function(){$('#submit').html('Updating...');}, 500);
						setTimeout(function(){$('#submit').html('Update');}, 1000);
						setTimeout(function(){toastr.success(result[1]);}, 1000);
						setTimeout(function(){$('#modal-input').modal('hide');}, 2500);
						preLoad();					
					} else {
						setTimeout(function(){$('#close1').removeAttr('disabled');}, 500);
						setTimeout(function(){$('#close2').removeAttr('disabled');}, 500);	
						setTimeout(function(){$('#submit').removeAttr('disabled');}, 500);						
						setTimeout(function(){$('#btnDelete').removeAttr('disabled');}, 500);						
						setTimeout(function(){$('#submit').html('Update');}, 500);						
						setTimeout(function(){toastr.error(result[1]);}, 500);						
					}
				}
			});	
		}
	}
}


function updatePosition(){
	var action = 'updatePosition';
	var employee_type = $('#employee_type').val();
	
	var data = [action, employee_type];
	$.ajax({
		type: 'POST',
		url: 'employees/show/action.php',
		data: {data:data},	
		success: function(result){
			$('#teacherappointments_position').html(result);
		}
	});	
}


function updateTeacher(teach_no, teach_teacher){
	var action = 'updateTeacher';
	
	var data = [action, teach_no, teach_teacher];
	$.ajax({
		type: 'POST',
		url: 'employees/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				toastr.success('Employee profile updated.');
			} else {
				toastr.error(result[1]);
			}
		}
	});		
}

function updateAppointment(teacherappointments_teach_no, teacherappointments_no){
	var action = 'updateAppointment';
	
	var data = [action, teacherappointments_teach_no, teacherappointments_no];
	$.ajax({
		type: 'POST',
		url: 'employees/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				toastr.success('Appointment updated.');
			} else {
				toastr.error(result[1]);
			}
		}
	});		
}

function deleteAction(actionType){
	var action = 'deleteAction';
	var list_id = $('#list-id').html();
	
	$('#close1').attr('disabled', 'disabled');
	$('#close2').attr('disabled', 'disabled');
	$('#submit').attr('disabled', 'disabled');
	$('#btnDelete').attr('disabled', 'disabled');
	$('#submit').html('Validating...');
			
	if(actionType == 'deleteFamily'){
		var data = [action, "teachercontacts", "teachCont_no = "+list_id];
	} else if(actionType == 'deleteEducation'){
		var data = [action, "teacher_ebackground", "eback_no = "+list_id];
	} else if(actionType == 'deleteID'){
		var data = [action, "teacherids", "teacherids_no = "+list_id];
	} else if(actionType == 'deleteAppointment'){
		var data = [action, "teacherappointments", "teacherappointments_no = "+list_id];
	} else if(actionType == 'deleteDesignation'){
		var data = [action, "teacherappointments", "teacherappointments_no = "+list_id];
	} 
	
	$.ajax({
		type: 'POST',
		url: 'employees/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				setTimeout(function(){$('#submit').html('Deleting...');}, 500);
				setTimeout(function(){$('#submit').html('Update');}, 1000);
				setTimeout(function(){toastr.success(result[1]);}, 1000);
				setTimeout(function(){$('#modal-input').modal('hide');}, 2500);
				preLoad();					
			} else {
				setTimeout(function(){$('#close1').removeAttr('disabled');}, 500);
				setTimeout(function(){$('#close2').removeAttr('disabled');}, 500);	
				setTimeout(function(){$('#submit').removeAttr('disabled');}, 500);						
				setTimeout(function(){$('#btnDelete').removeAttr('disabled');}, 500);						
				setTimeout(function(){$('#submit').html('Update');}, 500);						
				setTimeout(function(){toastr.error(result[1]);}, 500);						
			}
		}
	});
}

function checkTeachID(){
	var action = 'checkEntity';
	var teach_id = $('#teach_id').val();
	
	var data = [action, " teach_id LIKE '"+teach_id+"' "];
	$.ajax({
		type: 'POST',
		url: 'employees/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				toastr.error('Teacher ID already used.');
				$('#teach_id').addClass('is-invalid');
				$('#btnSubmit').attr('disabled',  'disabled');
				
			} else {
				$('#teach_id').removeClass('is-invalid');
				$('#btnSubmit').removeAttr('disabled');
			}
		}
	});	
}

function checkBiometricID(){
	var action = 'checkEntity';
	var teach_bio_no = $('#teach_bio_no').val();
	
	var data = [action, " teach_bio_no LIKE '"+teach_bio_no+"' "];
	$.ajax({
		type: 'POST',
		url: 'employees/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				toastr.error('Biometric ID already used.');
				$('#teach_bio_no').addClass('is-invalid');
				$('#btnSubmit').attr('disabled',  'disabled');
				
			} else {
				$('#teach_bio_no').removeClass('is-invalid');
				$('#btnSubmit').removeAttr('disabled');
			}
		}
	});	
}

function checkPhone(){
	var action = 'checkEntity';
	var teach_dialect = $('#teach_dialect').val();
	
	var data = [action, " teach_dialect LIKE '"+teach_dialect+"' "];
	$.ajax({
		type: 'POST',
		url: 'employees/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				toastr.error('Phone already used.');
				$('#teach_dialect').addClass('is-invalid');
				$('#btnSubmit').attr('disabled',  'disabled');
				
			} else {
				$('#teach_dialect').removeClass('is-invalid');
				$('#btnSubmit').removeAttr('disabled');
			}
		}
	});		
}

function checkEmail(){
	var action = 'checkEntity';
	var teach_ethnicity = $('#teach_ethnicity').val();
	
	var data = [action, " teach_ethnicity LIKE '"+teach_ethnicity+"' "];
	$.ajax({
		type: 'POST',
		url: 'employees/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				toastr.error('Email already used.');
				$('#teach_ethnicity').addClass('is-invalid');
				$('#btnSubmit').attr('disabled',  'disabled');
				
			} else {
				$('#teach_ethnicity').removeClass('is-invalid');
				$('#btnSubmit').removeAttr('disabled');
			}
		}
	});		
}

function checkTIN(){
	var action = 'checkEntity';
	var teach_tin = $('#teach_tin').val();
	
	var data = [action, " teach_tin LIKE '"+teach_tin+"' "];
	$.ajax({
		type: 'POST',
		url: 'employees/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				toastr.error('TIN already used.');
				$('#teach_tin').addClass('is-invalid');
				$('#btnSubmit').attr('disabled',  'disabled');
				
			} else {
				$('#teach_tin').removeClass('is-invalid');
				$('#btnSubmit').removeAttr('disabled');
			}
		}
	});		
}
</script>