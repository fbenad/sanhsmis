	<div class="content-wrapper">
	
		<section class="content-header">
			<div class="container">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Manage Student</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="?p=my"><i class="fas fa-home"></i></a></li>
							<li class="breadcrumb-item"><a href="?p=students">Students</a></li>
							<li class="breadcrumb-item"><a href="?p=students&show=<?php echo $_GET['modify'];?>">Profile</a></li>
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
										<a class="nav-link" id="custom-content-below-1-tab" data-toggle="pill" onclick="window.location = '?p=students&modify='+urlParam('modify')+'&t=basic';" href="#custom-content-below-1" role="tab" aria-controls="custom-content-below-1" aria-selected="false">Basic Information</a>
									</li>	
									<li class="nav-item">
										<a class="nav-link " id="custom-content-below-2-tab" data-toggle="pill" onclick="window.location = '?p=students&modify='+urlParam('modify')+'&t=contact';" href="#custom-content-below-2" role="tab" aria-controls="custom-content-below-2" aria-selected="false">Family</a>
									</li>
									<li class="nav-item">
										<a class="nav-link " id="custom-content-below-3-tab" data-toggle="pill" onclick="window.location = '?p=students&modify='+urlParam('modify')+'&t=schedule';" href="#custom-content-below-3" role="tab" aria-controls="custom-content-below-3" aria-selected="false">Schedule</a>
									</li>
									<li class="nav-item">
										<a class="nav-link " id="custom-content-below-4-tab" data-toggle="pill" onclick="window.location = '?p=students&modify='+urlParam('modify')+'&t=grade';" href="#custom-content-below-4" role="tab" aria-controls="custom-content-below-4" aria-selected="false">Grades</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" id="custom-content-below-5-tab" data-toggle="pill" onclick="window.location = '?p=students&modify='+urlParam('modify')+'&t=history';" href="#custom-content-below-5" role="tab" aria-controls="custom-content-below-5" aria-selected="false">Enrollment History</a>
									</li>
									
									
								</ul>
								<div class="tab-content" id="custom-content-below-tabContent">
									<div class="tab-pane fade show" id="custom-content-below-1" role="tabpanel" aria-labelledby="custom-content-below-1-tab">
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
														<button type="submit" class="btn btn-info float-right" id="btnSubmit" name="btnSubmit" onclick="return confirm('Update student?') ? modifyEntity() : false;">Update</button>
													</div>
												</div>
											</div>
											</form>
										</div>										
									</div>
									<div class="tab-pane fade show" id="custom-content-below-2" role="tabpanel" aria-labelledby="custom-content-below-2-tab">
										<br>
										<div id="get-other-1">
										</div>
									</div>
									<div class="tab-pane fade show " id="custom-content-below-3" role="tabpanel" aria-labelledby="custom-content-below-3-tab">
										<br>
										<div class="row">
											<div class="col-md-12">
											<button href="javascript:void(0);"  type="button" class="btn btn-info float-right" 
												onclick="window.open('../reports/pdf_ss.php?id=<?php echo $_GET['modify'];?>&sy=<?php echo $_SESSION['current_sy'];?>&sem=<?php echo $_SESSION['current_sem'];?>', 'newwindow', 'width=850, height=550'); return false;">
												<i class="fas fa-print"></i> Schedule</button>
											</div>
										</div>
										<br>
										<div id="get-other-2">
										</div>
									</div>
									<div class="tab-pane fade show " id="custom-content-below-4" role="tabpanel" aria-labelledby="custom-content-below-4-tab">
										<br>
										<div class="row">
											<div class="col-md-12">
												<div class="btn-group  float-right">
													<button href="javascript:void(0);" type="button" class="btn btn-info" 
														onclick="window.open('../reports/pdf_sf10.php?id=<?php echo $_GET['modify'];?>&sy=<?php echo $_SESSION['current_sy'];?>&sem=<?php echo $_SESSION['current_sem'];?>', 'newwindow', 'width=850, height=550'); return false;">
														<i class="fas fa-print"></i> SF10 / Form 137</button>
													<button href="javascript:void(0);" type="button" class="btn btn-info" 
														onclick="window.open('../reports/pdf_sf9.php?id=<?php echo $_GET['modify'];?>&sy=<?php echo $_SESSION['current_sy'];?>&sem=<?php echo $_SESSION['current_sem'];?>', 'newwindow', 'width=1024, height=550'); return false;">
														<i class="fas fa-print"></i> SF9 / Form 138</button>
												</div>
											</div>
										</div>
										<br>
										<div id="get-other-3">
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
var stud_no = <?php echo $_GET['modify'];?>;
var current_sy = <?php echo $_SESSION['current_sy'];?>;
var current_sem = <?php echo $_SESSION['current_sem'];?>;

setTimeout(function(){preLoad();}, 1);

setTimeout(function(){
	$(function(){
		$('#modal-input').on('show.bs.modal', function(e){
			var actionType = $(e.relatedTarget).attr('data-type');
			var actionTitle = $(e.relatedTarget).attr('title');
			var id = $(e.relatedTarget).attr('rowID');
			var userFunc = '';
			
			if(actionType == 'modifyFamily'){
				$('#modal-size').addClass('modal-lg');
				$('#modal-title').html(actionTitle+' #<span id="list-id">'+id+'</span>');
				$('#submit').html('Update');
				userFunc = "return confirm('Update family?') ? submitAction('"+actionType+"') : false;";
				$('#submit').attr('onclick', userFunc);
				
			} else if(actionType == 'modifyEnrollment'){
				$('#modal-size').addClass('modal-md');
				$('#modal-title').html(actionTitle+' #<span id="list-id">'+id+'</span>');
				$('#submit').html('Update');
				userFunc = "return confirm('Update enrollment details?') ? submitAction('"+actionType+"') : false;";
				$('#submit').attr('onclick', userFunc);
				
			} else if(actionType == 'addSubject'){
				$('#modal-size').addClass('modal-md');
				$('#modal-title').html(actionTitle+' for Grade <span id="list-id">'+id+'</span> level');
				$('#submit').html('Submit');
				userFunc = "return confirm('Save subject?') ? submitAction('"+actionType+"') : false;";
				$('#submit').attr('onclick', userFunc);
				
			} else if(actionType == 'modifyGrade'){
				$('#modal-size').addClass('modal-lg');
				$('#modal-title').html(actionTitle+' #<span id="list-id">'+id+'</span>');
				$('#submit').html('Update');
				userFunc = "return confirm('Update grade details?') ? submitAction('"+actionType+"') : false;";
				$('#submit').attr('onclick', userFunc);
				
			} else if(actionType == 'addHistoricalSubject'){
				$('#modal-size').addClass('modal-md');
				$('#modal-title').html(actionTitle+' for term #<span id="list-id">'+id+'</span>');
				$('#submit').html('Submit');
				userFunc = "return confirm('Save?') ? submitAction('"+actionType+"') : false;";
				$('#submit').attr('onclick', userFunc);
				
			} else if(actionType == 'addHistory'){
				$('#modal-size').addClass('modal-lg');
				$('#modal-title').html(actionTitle);
				$('#submit').html('Submit');
				userFunc = "return confirm('Save enrollment history?') ? submitAction('"+actionType+"') : false;";
				$('#submit').attr('onclick', userFunc);
				
			} else if(actionType == 'modifyHistory'){
				$('#modal-size').addClass('modal-lg');
				$('#modal-title').html(actionTitle+' #<span id="list-id">'+id+'</span>');
				$('#submit').html('Update');
				userFunc = "return confirm('Update enrollment history?') ? submitAction('"+actionType+"') : false;";
				$('#submit').attr('onclick', userFunc);
				
			} else if(actionType == 'modifyCurrent'){
				$('#modal-size').addClass('modal-lg');
				$('#modal-title').html(actionTitle+' #<span id="list-id">'+id+'</span>');
				$('#submit').html('Update');
				userFunc = "return confirm('Update current enrollment?') ? submitAction('"+actionType+"') : false;";
				$('#submit').attr('onclick', userFunc);
				
			} else if(actionType == 'enrollSem2'){
				$('#modal-size').addClass('modal-md');
				$('#modal-title').html(actionTitle+' <span id="list-id">'+id+'</span>');
				$('#submit').html('Enroll');
				userFunc = "return confirm('Enroll student to second term?') ? submitAction('"+actionType+"') : false;";
				$('#submit').attr('onclick', userFunc);
				$('#list-id').hide();
				
			} else if(actionType == 'updateStatus'){
				$('#modal-size').addClass('modal-md');
				$('#modal-title').html('Update status'+' #<span id="list-id">'+id+'</span>');
				$('#submit').html('Update');
				userFunc = "return confirm('Update status?') ? submitAction('"+actionType+"') : false;";
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
	setTimeout(function(){hideEditForm();}, 200);
	getOther();
	checkEnrollmentHistory();
	
	checkRedirect();	
}

function getBasic(){
	var action = 'getBasic';
	
	var data = [action, stud_no];	
	$.ajax({
		type: 'POST',
		url: 'students/show/action.php',
		data: {data:data},	
		success: function(result){
			$('#getBasic').html(result);
		}
	});	
}

function hideEditForm(){
	var action = 'hideEditForm';
	$('#stud_lrn').hide();
	$('#stud_fname').hide();
	$('#stud_mname').hide();
	$('#stud_lname').hide();
	$('#stud_xname').hide();
	$('#stud_gender').hide();
	$('#stud_bdate').hide();
	$('#stud_residence').hide();
	$('#stud_religion').hide();
	$('#stud_dialect').hide();
	$('#stud_ethnicity').hide();
	$('#stud_cct').hide();
	$('#edit-entity').hide();
	$('#entity-edit-button').attr('onclick', 'showEditForm();');
	$('#entity-edit-button').html('<i class="fas fa-pen"></i>');	
}

function showEditForm(){
	var action = 'showEditForm';
	$('#stud_lrn').show();
	$('#stud_fname').show();
	$('#stud_mname').show();
	$('#stud_lname').show();
	$('#stud_xname').show();
	$('#stud_gender').show();
	$('#stud_bdate').show();
	$('#stud_residence').show();
	$('#stud_religion').show();
	$('#stud_dialect').show();
	$('#stud_ethnicity').show();
	$('#stud_cct').show();
	$('#edit-entity').show();	
	$('#entity-edit-button').attr('onclick', 'hideEditForm()');	
	$('#entity-edit-button').html('<i class="fas fa-times"></i>');	
}

function modifyEntity(){
	var action = 'modifyEntity';
	var stud_lrn = $('#stud_lrn').val();
	var stud_fname = $('#stud_fname').val();
	var stud_mname = $('#stud_mname').val();
	var stud_lname = $('#stud_lname').val();
	var stud_xname = $('#stud_xname').val();
	var stud_gender = $('#stud_gender').val();
	var stud_bdate = $('#stud_bdate').val();
	var stud_residence = $('#stud_residence').val();
	var stud_religion = $('#stud_religion').val();
	var stud_dialect = $('#stud_dialect').val();
	var stud_ethnicity = $('#stud_ethnicity').val();
	var stud_cct = $('#stud_cct').val();	
	var stud_no = <?php echo $_GET['modify'];?>;	
	
	var data = [action, stud_lrn, stud_fname, stud_mname, stud_lname, stud_xname, stud_gender, 
		stud_bdate, stud_residence, stud_religion, stud_dialect, stud_ethnicity, stud_cct, stud_no];
	if(data[1] == '' || data[1] < 100000000000 || data[1] > 999999999999){
		toastr.error('Invalid LRN.');
	} else if(data[2] == '' || data[2].length < 3){
		toastr.error('Invalid first name.');
	} else if(data[4] == '' || data[4].length < 3){
		toastr.error('Invalid last name.');
	} else if(data[6] == ''){
		toastr.error('Invalid gender.');
	} else if(data[7] == '' || Date.parse(data[7]) < Date.parse('<?php echo date('Y-m-d', strtotime('-50 years'));?>') || Date.parse(data[7]) > Date.parse('<?php echo date('Y-m-d', strtotime('-4 years'));?>')){
		toastr.error('Invalid birth date.');
	} else if(data[8] == '' || data[8].length < 3){
		toastr.error('Invalid residence.');
	} else if(data[9] == ''){
		toastr.error('Invalid religion.');
	} else if(data[10] == ''){
		toastr.error('Invalid dialect.');
	} else if(data[11] == ''){
		toastr.error('Invalid ethnicity.');
	} else if(data[12] == ''){
		toastr.error('Invalid CCT value.');
	} else {
		$('#btnCancel').attr('disabled', 'disabled');
		$('#btnSubmit').attr('disabled', 'disabled');
		$('#btnSubmit').html('Validating...');
		
		$.ajax({
			type: 'POST',
			url: 'students/show/action.php',
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
	
	var data = [action, stud_no];	
	$.ajax({
		type: 'POST',
		url: 'students/show/action.php',
		data: {data:data},	
		success: function(result){
			$('#get-other-1').html(result);
			getSchedules();
			getGrades();
			getHistory();
			checkRequirementsPriorToEnroll();
		}
	});
}

function getSchedules(){
	var action = 'getSchedules';
	
	var data = [action, stud_no, current_sy];	
	$.ajax({
		type: 'POST',
		url: 'students/show/action.php',
		data: {data:data},	
		success: function(result){
			$('#get-other-2').html(result);
		}
	});	
}

function getGrades(){
	var action = 'getGrades';
	
	var data = [action, stud_no];	
	$.ajax({
		type: 'POST',
		url: 'students/show/action.php',
		data: {data:data},	
		success: function(result){
			$('#get-other-3').html(result);
		}
	});		
}

function getHistory(){
	var action = 'getHistory';
	
	var data = [action, stud_no];	
	$.ajax({
		type: 'POST',
		url: 'students/show/action.php',
		data: {data:data},	
		success: function(result){
			$('#get-other-4').html(result);
		}
	});		
}

function showAction(actionType, list_id){
	var action = 'showAction';
	
	if(actionType == 'modifyFamily'){
		var data = [action, actionType, list_id];	
		$.ajax({
			type: 'POST',
			url: 'students/show/action.php',
			data: {data:data},	
			success: function(result){
				$('#form-input').html(result);
			}
		});	
		
	} else if(actionType == 'modifyEnrollment'){
		var data = [action, actionType, list_id, current_sy];	
		$.ajax({
			type: 'POST',
			url: 'students/show/action.php',
			data: {data:data},	
			success: function(result){
				$('#form-input').html(result);
			}
		});	
		
	} else if(actionType == 'addSubject'){
		var data = [action, actionType, stud_no, current_sy, current_sem, list_id];	
		$.ajax({
			type: 'POST',
			url: 'students/show/action.php',
			data: {data:data},	
			success: function(result){
				$('#form-input').html(result);
			}
		});	
		
	} else if(actionType == 'modifyGrade'){
		var data = [action, actionType, list_id];	
		$.ajax({
			type: 'POST',
			url: 'students/show/action.php',
			data: {data:data},	
			success: function(result){
				$('#form-input').html(result);
			}
		});	
		
	} else if(actionType == 'addHistoricalSubject'){
		var term_str = list_id.split('-');
		var sy = term_str[0];
		var sem = term_str[1];
		var level = term_str[2];

		var data = [action, actionType, sy, sem, level, stud_no];	
		$.ajax({
			type: 'POST',
			url: 'students/show/action.php',
			data: {data:data},	
			success: function(result){
				$('#form-input').html(result);
			}
		});	
		
	} else if(actionType == 'addHistory'){
		var data = [action, actionType, stud_no];	
		$.ajax({
			type: 'POST',
			url: 'students/show/action.php',
			data: {data:data},	
			success: function(result){
				$('#form-input').html(result);
			}
		});	
		
	} else if(actionType == 'modifyHistory'){
		var data = [action, actionType, list_id];	
		$.ajax({
			type: 'POST',
			url: 'students/show/action.php',
			data: {data:data},	
			success: function(result){
				$('#form-input').html(result);
				checkAssociations();
			}
		});	
		
	} else if(actionType == 'modifyCurrent'){
		var data = [action, actionType, list_id];	
		$.ajax({
			type: 'POST',
			url: 'students/show/action.php',
			data: {data:data},	
			success: function(result){
				$('#form-input').html(result);
				setTimeout(function(){checkAssociations();}, 200);	
			}
		});	
		
	} else if(actionType == 'enrollSem2'){
		var data = [action, actionType, stud_no, current_sy, current_sem, list_id];	
		$.ajax({
			type: 'POST',
			url: 'students/show/action.php',
			data: {data:data},	
			success: function(result){
				$('#form-input').html(result);
			}
		});	
		
	} else if(actionType == 'updateStatus'){
		var data = [action, actionType, list_id];	
		$.ajax({
			type: 'POST',
			url: 'students/show/action.php',
			data: {data:data},	
			success: function(result){
				$('#form-input').html(result);
			}
		});	
		
	}
}

function checkAssociations(){
	var action = 'checkAssociations';
	var enrol_sy = $('#enrol_sy').val();
	
	var data = [action, enrol_sy, stud_no];
	$.ajax({
		type: 'POST',
		url: 'students/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				$('#btnDelete').attr('disabled', 'disabled');
			} else {
				$('#btnDelete').removeAttr('disabled');
			}
			
			updateTrack($('#enrol_level').val());
		}
	});
}


function submitAction(actionType){
	var action = 'submitAction';
	var list_id = $('#list-id').html();
	
	if(actionType == 'modifyFamily'){
		var studCont_no = list_id;
		var studCont_stud_ffname = $('#studCont_stud_ffname').val();
		var studCont_stud_fmname = $('#studCont_stud_fmname').val();
		var studCont_stud_flname = $('#studCont_stud_flname').val();
		var studCont_stud_mfname = $('#studCont_stud_mfname').val();
		var studCont_stud_mmname = $('#studCont_stud_mmname').val();
		var studCont_stud_mlname = $('#studCont_stud_mlname').val();
		var studCont_stud_gfname = $('#studCont_stud_gfname').val();
		var studCont_stud_gmname = $('#studCont_stud_gmname').val();
		var studCont_stud_glname = $('#studCont_stud_glname').val();
		var studCont_stud_grelation = $('#studCont_stud_grelation').val();
		var studCont_stud_gcontact = $('#studCont_stud_gcontact').val();

		var data = [action, actionType, studCont_no, studCont_stud_ffname, studCont_stud_fmname, studCont_stud_flname, 
			studCont_stud_mfname, studCont_stud_mmname, studCont_stud_mlname, 
			studCont_stud_gfname, studCont_stud_gmname, studCont_stud_glname, 
			studCont_stud_grelation, studCont_stud_gcontact];
		if(data[3] == ''){
			toastr.error('Invalid father first name.');
		} else if(data[4] == ''){
			toastr.error('Invalid father middle name.');
		} else if(data[5] == ''){
			toastr.error('Invalid father last name.');
		} else if(data[6] == ''){
			toastr.error('Invalid mother first name.');
		} else if(data[7] == ''){
			toastr.error('Invalid mother maiden middle name.');
		} else if(data[8] == ''){
			toastr.error('Invalid mother maiden last name.');
		} else if(data[9] == ''){
			toastr.error('Invalid guardian first name.');
		} else if(data[10] == ''){
			toastr.error('Invalid guardian middle name.');
		} else if(data[11] == ''){
			toastr.error('Invalid guardian last name.');
		} else if(data[12] == ''){
			toastr.error('Invalid guardian relationship.');
		} else if(data[13] == ''){
			toastr.error('Invalid contact number.');
		} else {
			$('#close1').attr('disabled', 'disabled');
			$('#close2').attr('disabled', 'disabled');
			$('#submit').attr('disabled', 'disabled');
			$('#submit').html('Validating...');
			
			$.ajax({
				type: 'POST',
				url: 'students/show/action.php',
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
		
	} else if(actionType == 'modifyEnrollment'){
		var grade_no = $('#list-id').html();
		var grade_class_no = $('#class_no').val();

		var data = [action, actionType, grade_no, grade_class_no];
		if(data[3] == ''){
			toastr.error('Invalid section.');
		} else {
			$('#close1').attr('disabled', 'disabled');
			$('#close2').attr('disabled', 'disabled');
			$('#submit').attr('disabled', 'disabled');
			$('#submit').html('Validating...');
			
			$.ajax({
				type: 'POST',
				url: 'students/show/action.php',
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
						setTimeout(function(){$('#submit').html('Update');}, 500);						
						setTimeout(function(){toastr.error(result[1]);}, 500);						
					}
				}
			});	
		}
		
	} else if(actionType == 'addSubject'){
		var grade_class_no = $('#class_no').val();

		var data = [action, actionType, stud_no, grade_class_no, current_sy, current_sem, list_id];
		if(data[3] == ''){
			toastr.error('Invalid section.');
		} else {
			$('#close1').attr('disabled', 'disabled');
			$('#close2').attr('disabled', 'disabled');
			$('#submit').attr('disabled', 'disabled');
			$('#submit').html('Validating...');
			
			$.ajax({
				type: 'POST',
				url: 'students/show/action.php',
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
		
	} else if(actionType == 'addHistoricalSubject'){
		var list_id = $('#list-id').html();
		var term_str = list_id.split('-');
		var sy = term_str[0];
		var sem = term_str[1];
		var level = term_str[2];
		var pros_no = $('#pros_no').val();

		var data = [action, actionType, sy, sem, level, pros_no, stud_no];
		if(data[3] == ''){
			toastr.error('Invalid section.');
		} else {
			$('#close1').attr('disabled', 'disabled');
			$('#close2').attr('disabled', 'disabled');
			$('#submit').attr('disabled', 'disabled');
			$('#submit').html('Validating...');
			
			$.ajax({
				type: 'POST',
				url: 'students/show/action.php',
				data: {data:data},	
				success: function(result){
					if(result[0] == 1){
						setTimeout(function(){$('#submit').html('Saving...');}, 500);
						setTimeout(function(){$('#submit').html('Submit');}, 1000);
						setTimeout(function(){toastr.success(result[1]);}, 1000);
						setTimeout(function(){addHistoricalGrade(sy, sem, stud_no, result[2]);}, 2000);
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
		
	} else if(actionType == 'deleteSubject'){
		var data = [action, actionType, list_id];
		$('#close1').attr('disabled', 'disabled');
		$('#close2').attr('disabled', 'disabled');
		$('#submit').attr('disabled', 'disabled');
		$('#btnDelete').attr('disabled', 'disabled');
		$('#submit').html('Validating...');

		$.ajax({
			type: 'POST',
			url: 'students/show/action.php',
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

	} else if(actionType == 'modifyGrade'){
		var pros_level = $('#pros-level').html();
		var grade_q1 = $('#grade_q1').val();
		var grade_q2 = $('#grade_q2').val();
		var grade_q3 = $('#grade_q3').val();
		var grade_q4 = $('#grade_q4').val();
		var grade_final = $('#grade_final').val();
		var grade_remarks = grade_final < <?php echo $pass_grade;?> ? 0 : 1;
		var grade_remedialgrade = $('#grade_remedialgrade').val() == null ? 0 : $('#grade_remedialgrade').val();
		var grade_recomputedfinalgrade	= $('#grade_recomputedfinalgrade').val() == null ? 0 : $('#grade_recomputedfinalgrade').val();
		var grade_finalremarks = grade_recomputedfinalgrade < <?php echo $pass_grade;?> ? 0 : 1;
		var rem_from = $('#rem_from').val() == null ? '-' : $('#rem_from').val();
		var rem_to = $('#rem_to').val() == null ? '-' : $('#rem_to').val();
		var rem_li = $('#rem_li').val() == null ? '-' : $('#rem_li').val();
		var rem_liadd = $('#rem_liadd').val() == null ? '-' : $('#rem_liadd').val();
		var grade_notes = grade_remedialgrade == null ? '-' : (rem_li+' - '+rem_liadd+' From:'+rem_from+' To:'+rem_to);
		
		var data = [action, actionType, list_id, grade_q1, grade_q2, grade_q3, grade_q4, grade_final, grade_remarks, 
			grade_remedialgrade, grade_recomputedfinalgrade, grade_finalremarks, grade_notes];
			
		$('#close1').attr('disabled', 'disabled');
		$('#close2').attr('disabled', 'disabled');
		$('#submit').attr('disabled', 'disabled');
		$('#btnDelete').attr('disabled', 'disabled');
		$('#submit').html('Validating...');
		$.ajax({
			type: 'POST',
			url: 'students/show/action.php',
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
		
	} else if(actionType == 'addHistory'){
		var enrol_sy = $('#enrol_sy').val();
		var enrol_level = $('#enrol_level').val();
		var enrol_average  = $('#enrol_average').val();
		var enrol_graddate = $('#enrol_graddate').val();
		var enrol_status2 = $('#enrol_status2').val();
		var enrol_track2 = $('#enrol_track2').val();
		var enrol_strand2 = $('#enrol_strand2').val();
		var enrol_track = $('#enrol_track').val();
		var enrol_strand = $('#enrol_strand').val();
		var enrol_combo = $('#enrol_combo').val();
		var enrol_school_0 = $('#enrol_school_0').val();
		var enrol_school_1 = $('#enrol_school_1').val();
		var enrol_school_2 = $('#enrol_school_2').val();
		var enrol_eligibility = $('#enrol_eligibility').val();
		var enrol_section = $('#enrol_section').val();
		var enrol_remarks = $('#enrol_remarks').val();

		var data = [action, actionType, stud_no, enrol_sy, enrol_level, enrol_average, enrol_graddate, enrol_status2, 
			enrol_track2, enrol_strand2, enrol_track, enrol_strand, enrol_combo,
			enrol_school_0, enrol_school_1, enrol_school_2, enrol_eligibility, enrol_section, enrol_remarks];
			
		if(data[3] == ''){
			toastr.error('Invalid school year.');
		} else if(data[4] == ''){
			toastr.error('Invalid grade level.');
		} else if(data[5] < <?php echo $min_grade;?> || data[5] > <?php echo $max_grade;?>){
			toastr.error('Invalid average grade.');
		} else if(data[6] == '' || Date.parse(data[6]) < Date.parse('<?php echo date('Y-m-d', strtotime('-25 years'));?>') || Date.parse(data[6]) > Date.parse('<?php echo date('Y-m-d');?>')){
			toastr.error('Invalid date completed.');
		} else if(data[7] == ''){
			toastr.error('Invalid EOSY status.');
		} else if(enrol_level < 10 && data[8] == ''){
			toastr.error('Invalid program type.');
		} else if(enrol_level < 10 && data[9] == ''){
			toastr.error('Invalid program name.');
		} else if(enrol_level > 10 && data[10] == ''){
			toastr.error('Invalid track.');
		} else if(enrol_level > 10 && data[11] == ''){
			toastr.error('Invalid strand.');
		} else if(enrol_level > 10 && data[12] == ''){
			toastr.error('Invalid combo.');
		} else if(data[13] == '' || data[13] < 111111 || data[13] > 999999999){
			toastr.error('Invalid school ID.');
		} else if(data[14] == ''){
			toastr.error('Invalid school/learning institution name.');
		} else if(data[15] == ''){
			toastr.error('Invalid school/learning institution address.');
		} else if(data[16] == ''){
			toastr.error('Invalid admission eligiblity.');
		} else if(data[17] == ''){
			toastr.error('Invalid section name.');
		} else if(data[18] == ''){
			toastr.error('Invalid remarks.');
		}else {
			$('#close1').attr('disabled', 'disabled');
			$('#close2').attr('disabled', 'disabled');
			$('#submit').attr('disabled', 'disabled');
			$('#submit').html('Validating...');
			
			$.ajax({
				type: 'POST',
				url: 'students/show/action.php',
				data: {data:data},	
				success: function(result){
					if(result[0] == 1){
						setTimeout(function(){$('#submit').html('Saving...');}, 500);
						setTimeout(function(){$('#submit').html('Submit');}, 1000);
						setTimeout(function(){toastr.success(result[1]);}, 1000);
						setTimeout(function(){addSchooldays(stud_no, enrol_sy);}, 1000);
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
		
	} else if(actionType == 'modifyHistory'){
		var enrol_sy = $('#enrol_sy').val();
		var enrol_level = $('#enrol_level').val();
		var enrol_average  = $('#enrol_average').val();
		var enrol_graddate = $('#enrol_graddate').val();
		var enrol_status2 = $('#enrol_status2').val();
		var enrol_track2 = $('#enrol_track2').val();
		var enrol_strand2 = $('#enrol_strand2').val();
		var enrol_track = $('#enrol_track').val();
		var enrol_strand = $('#enrol_strand').val();
		var enrol_combo = $('#enrol_combo').val();
		var enrol_school_0 = $('#enrol_school_0').val();
		var enrol_school_1 = $('#enrol_school_1').val();
		var enrol_school_2 = $('#enrol_school_2').val();
		var enrol_eligibility = $('#enrol_eligibility').val();
		var enrol_section = $('#enrol_section').val();
		var enrol_remarks = $('#enrol_remarks').val();

		var data = [action, actionType, stud_no, enrol_sy, enrol_level, enrol_average, enrol_graddate, enrol_status2, 
			enrol_track2, enrol_strand2, enrol_track, enrol_strand, enrol_combo,
			enrol_school_0, enrol_school_1, enrol_school_2, enrol_eligibility, enrol_section, enrol_remarks, list_id];
			
		if(data[3] == ''){
			toastr.error('Invalid school year.');
		} else if(data[4] == ''){
			toastr.error('Invalid grade level.');
		} else if(data[5] < <?php echo $min_grade;?> || data[5] > <?php echo $max_grade;?>){
			toastr.error('Invalid average grade.');
		} else if(data[6] == '' || Date.parse(data[6]) < Date.parse('<?php echo date('Y-m-d', strtotime('-25 years'));?>') || Date.parse(data[6]) > Date.parse('<?php echo date('Y-m-d');?>')){
			toastr.error('Invalid date completed.');
		} else if(data[7] == ''){
			toastr.error('Invalid EOSY status.');
		} else if(enrol_level < 10 && data[8] == ''){
			toastr.error('Invalid program type.');
		} else if(enrol_level < 10 && data[9] == ''){
			toastr.error('Invalid program name.');
		} else if(enrol_level > 10 && data[10] == ''){
			toastr.error('Invalid track.');
		} else if(enrol_level > 10 && data[11] == ''){
			toastr.error('Invalid strand.');
		} else if(enrol_level > 10 && data[12] == ''){
			toastr.error('Invalid combo.');
		} else if(data[13] == '' || data[13] < 111111 || data[13] > 999999999){
			toastr.error('Invalid school ID.');
		} else if(data[14] == ''){
			toastr.error('Invalid school/learning institution name.');
		} else if(data[15] == ''){
			toastr.error('Invalid school/learning institution address.');
		} else if(data[16] == ''){
			toastr.error('Invalid admission eligiblity.');
		} else if(data[17] == ''){
			toastr.error('Invalid section name.');
		} else if(data[18] == ''){
			toastr.error('Invalid remarks.');
		}else {
			$('#close1').attr('disabled', 'disabled');
			$('#close2').attr('disabled', 'disabled');
			$('#submit').attr('disabled', 'disabled');
			$('#btnDelete').attr('disabled', 'disabled');
			$('#submit').html('Validating...');
			
			$.ajax({
				type: 'POST',
				url: 'students/show/action.php',
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
						setTimeout(function(){$('#submit').html('Submit');}, 500);						
						setTimeout(function(){toastr.error(result[1]);}, 500);						
					}
				}
			});	
		}	
		
	} else if(actionType == 'deleteHistory'){
		var data = [action, actionType, list_id];
		var enrol_sy = $('#enrol_sy').val();
		$('#close1').attr('disabled', 'disabled');
		$('#close2').attr('disabled', 'disabled');
		$('#submit').attr('disabled', 'disabled');
		$('#btnDelete').attr('disabled', 'disabled');
		$('#submit').html('Validating...');
		
		$.ajax({
			type: 'POST',
			url: 'students/show/action.php',
			data: {data:data},	
			success: function(result){
				if(result[0] == 1){
					setTimeout(function(){$('#submit').html('Deleting...');}, 500);
					setTimeout(function(){$('#submit').html('Update');}, 1000);
					setTimeout(function(){toastr.success(result[1]);}, 1000);
					setTimeout(function(){deleteSchoolDays(enrol_sy, stud_no);}, 1000);
					setTimeout(function(){deleteCoreValues(enrol_sy, stud_no);}, 1000);
					setTimeout(function(){deleteSubjects(enrol_sy, stud_no);}, 1000);
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
	
	} else if(actionType == 'modifyCurrent'){
		var enrol_level = $('#enrol_level').val();
		var enrol_section = $('#enrol_section').val();
		var enrol_remarks = $('#enrol_remarks').val();
		var enrol_track2 = $('#enrol_track2').val();
		var enrol_track1 = $('#enrol_track1').val();
		var enrol_strand = $('#enrol_strand').val();
		var enrol_combo = $('#enrol_combo').val();
		
		if(enrol_level > 10){
			enrol_track = enrol_track1;
		} else{
			enrol_track = enrol_track2;
			enrol_strand = '-';
			enrol_combo =  '-';		
		}	
		
		var data = [action, actionType, current_sy, stud_no, enrol_level, enrol_section, enrol_remarks, enrol_track, enrol_strand, enrol_combo, list_id];

		if(data[7] == ''){
			toastr.error('Invalid specialization combination.');
		} else {
			$('#close1').attr('disabled', 'disabled');
			$('#close2').attr('disabled', 'disabled');
			$('#btnDelete').attr('disabled', 'disabled');
			$('#submit').attr('disabled', 'disabled');
			$('#submit').html('Validating...');
			
			$.ajax({
				type: 'POST',
				url: 'students/show/action.php',
				data: {data:data},	
				success: function(result){
					if(result[0] == 1){
						setTimeout(function(){$('#submit').html('Saving...');}, 500);
						setTimeout(function(){$('#submit').html('Submit');}, 1000);
						setTimeout(function(){toastr.success(result[1]);}, 1000);
						setTimeout(function(){$('#modal-input').modal('hide');}, 1500);	
						
					} else {
						setTimeout(function(){$('#close1').removeAttr('disabled');}, 500);
						setTimeout(function(){$('#close2').removeAttr('disabled');}, 500);						
						setTimeout(function(){$('#submit').html('Submit');}, 500);
						setTimeout(function(){$('#submit').removeAttr('disabled');}, 500);
						setTimeout(function(){$('#btnDelete').removeAttr('disabled');}, 500);
						setTimeout(function(){toastr.error(result[1]);}, 500);	
					}
				}
			});	
			
		}
	
	} else if(actionType == 'enrollSem2'){
		var class_no = new Array();
		$('input[name^="class_no"]').each(function() { $(this).is(":checked") ? class_no.push($(this).val()) : ''; });
		
		var data = [action, actionType, stud_no, current_sy, current_sem, class_no];
		
		$('#close1').attr('disabled', 'disabled');
		$('#close2').attr('disabled', 'disabled');
		$('#submit').attr('disabled', 'disabled');
		$('#submit').html('Validating...');
		
		$.ajax({
			type: 'POST',
			url: 'students/show/action.php',
			data: {data:data},	
			success: function(result){
				if(result[0] == 1){
					setTimeout(function(){$('#submit').html('Enrolling...');}, 500);
					setTimeout(function(){$('#submit').html('Enroll');}, 1000);
					setTimeout(function(){toastr.success(result[1]);}, 1000);
					setTimeout(function(){$('#modal-input').modal('hide');}, 1500);	
					
				} else {
					setTimeout(function(){$('#close1').removeAttr('disabled');}, 500);
					setTimeout(function(){$('#close2').removeAttr('disabled');}, 500);						
					setTimeout(function(){$('#submit').html('Enroll');}, 500);
					setTimeout(function(){$('#submit').removeAttr('disabled');}, 500);
					setTimeout(function(){toastr.error(result[1]);}, 500);	
				}
			}
		});
		
	} else if(actionType == 'deleteSem2'){
		var data = [action, actionType, stud_no, current_sy, current_sem];
		var enrol_sy = $('#enrol_sy').val();
		$('#close1').attr('disabled', 'disabled');
		$('#close2').attr('disabled', 'disabled');
		$('#submit').attr('disabled', 'disabled');
		$('#btnDelete').attr('disabled', 'disabled');
		$('#submit').html('Validating...');
		
		$.ajax({
			type: 'POST',
			url: 'students/show/action.php',
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
	
	} else if(actionType == 'updateStatus'){
		var enrol_status2 = $('#enrol_status2').val();
		var enrol_gradawards = $('#enrol_gradawards').val();
		var enrol_remarks;
		var enrol_graddate;
		var enrol_status1;
		
		if(enrol_status2 == 'REGULAR' || enrol_status2 == 'IRREGULAR'){
			enrol_status1 = 'ENROLLED';
			enrol_remarks  = 'OK'
			enrol_graddate = '0000-00-00';
		} else if(enrol_status2 == 'DROPPED OUT' || enrol_status2 == 'TRANSFERRED OUT'){
			enrol_status1 = 'INACTIVE';
			
			if(enrol_status2 == 'DROPPED OUT'){
				enrol_remarks = $('#enrol_remarks1').val();
				enrol_graddate = $('#enrol_graddate1').val();
			} else if(enrol_status2 == 'TRANSFERRED OUT'){
				enrol_remarks = $('#enrol_remarks2').val();
				enrol_graddate = $('#enrol_graddate2').val();
			}
		}

		var data = [action, actionType, list_id, enrol_status1, enrol_status2, enrol_gradawards, enrol_graddate, enrol_remarks];
		toastr.success(data);
		if(enrol_status1 == 'INACTIVE' && data[6] == ''){
			toastr.error('Invalid effective date.');
		} else if(enrol_status1 == 'INACTIVE' && data[7] == ''){
			toastr.error('Invalid remarks.');
		} else {
			$('#close1').attr('disabled', 'disabled');
			$('#close2').attr('disabled', 'disabled');
			$('#submit').attr('disabled', 'disabled');
			$('#submit').html('Validating...');
			
			$.ajax({
				type: 'POST',
				url: 'students/show/action.php',
				data: {data:data},	
				success: function(result){
					if(result[0] == 1){
						setTimeout(function(){$('#submit').html('Updating...');}, 500);
						setTimeout(function(){$('#submit').html('Submit');}, 1000);
						setTimeout(function(){toastr.success(result[1]);}, 1000);
						setTimeout(function(){$('#modal-input').modal('hide');}, 1500);	
						getHistory();
					} else {
						setTimeout(function(){$('#close1').removeAttr('disabled');}, 500);
						setTimeout(function(){$('#close2').removeAttr('disabled');}, 500);						
						setTimeout(function(){$('#submit').html('Submit');}, 500);
						setTimeout(function(){$('#submit').removeAttr('disabled');}, 500);
						setTimeout(function(){toastr.error(result[1]);}, 500);	
					}
				}
			});	
			
		}
	
	}
	
}

function deleteSchoolDays(sch_sy, sch_stud_no){
	var action = 'deleteSchoolDays';
	
	var data = [action, sch_sy, sch_stud_no];
	$.ajax({
		type: 'POST',
		url: 'students/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				toastr.success('School days were deleted.');				
			} else {
				toastr.error(result[1]);
			}			
		}
	});
}

function deleteCoreValues(coreval_enrol_sy, coreval_stud_no){
	var action = 'deleteCoreValues';
	
	var data = [action, coreval_enrol_sy, coreval_stud_no];
	$.ajax({
		type: 'POST',
		url: 'students/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				toastr.success('Core values were deleted.');				
			} else {
				toastr.error(result[1]);
			}			
		}
	});
}

function deleteSubjects(grade_sy, grade_stud_no){
	var action = 'deleteSubjects';
	
	var data = [action, grade_sy, grade_stud_no];
	$.ajax({
		type: 'POST',
		url: 'students/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				toastr.success('Subjects were deleted.');				
			} else {
				toastr.error(result[1]);
			}			
		}
	});
}

function checkLRN(){
	var action = 'checkLRN';
	var stud_lrn = $('#stud_lrn').val();
	
	var data = [action, stud_lrn];	
	$.ajax({
		type: 'POST',
		url: 'students/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				toastr.error('LRN already used.');
				$('#stud_lrn').addClass('is-invalid');
				$('#btnSubmit').attr('disabled',  'disabled');
				
			} else {
				$('#stud_lrn').removeClass('is-invalid');
				$('#btnSubmit').removeAttr('disabled',  'disabled');
			}			
		}
	});
}

function getSubject(){
	var action = 'getSubject';
	var class_no = $('#class_no').val();
	
	var data = [action, '', '', current_sy, class_no];	
	$.ajax({
		type: 'POST',
		url: 'students/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				$('#submit').removeAttr('disabled');
				var description = result[2].pros_desc;
				$('#subject-description').html(description);
				var details = result[2].section_name+'; '+result[2].class_timeslots+'; '+result[2].class_days;
				$('#subject-details').html(details);
				var teacher = result[2].teach_lname+', '+result[2].teach_fname+(result[2].teach_xname == '' ? '' : ', '+result[2].teach_xname)+', '+result[2].teach_mname;
				$('#subject-teacher').html(teacher);				
			} else {
				$('#subject-description').html('Not found!');
				$('#subject-details').html('Not found!');
				$('#subject-teacher').html('Not found!');
				$('#submit').attr('disabled', 'disabled');
			}			
		}
	});	
	
}

function addHistoricalGrade(grade_sy, grade_sem, grade_stud_no, grade_class_no){
	var action = 'addSubject';
	
	var data = ['submitAction' , action, grade_stud_no, grade_class_no, grade_sy, grade_sem];
	$.ajax({
		type: 'POST',
		url: 'students/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				toastr.success('Subject added.');
				getGrades();
			} else {
				toastr.error(result[1]);
			}			
		}
	});		
}

function checkEnrollmentHistory(){
	var action = "checkEnrollmentHistory";
	
	var data = [action, stud_no];
	$.ajax({
		type: 'POST',
		url: 'students/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1 && result[2].enrol_sy == <?php echo ($_SESSION['current_sy']-1);?>){
				$(document).Toasts('create', {
					class: 'bg-success', 
					 position: 'bottomLeft',
					icon: 'fas fa-flag',
					autohide: true,
					delay: 10000,
					title: 'Elligible for enrollment',
					body: 'Student has met the required credentials to enrol. Click the <strong>"Enroll Learner"</strong> button to enrol.'
				 });
			} else if(result[0] == 1 && result[2].enrol_sy == <?php echo $_SESSION['current_sy'];?>){
			} else {
				$(document).Toasts('create', {
					class: 'bg-danger', 
					 position: 'bottomLeft',
					icon: 'fas fa-flag',
					autohide: true,
					delay: 10000,
					title: 'Required enrollment history not found',
					body: 'Student\'s required enrollment history is not found. Click <strong>"Add History"</strong> button to fill out previous school year\'s history.'
				 });				
			}
		}
	});	
}

function updateGradeLevel(){
	var enrol_level = $('#enrol_level').val();
	var value;
	
	var data = ['setLevel', enrol_level];
	$.ajax({
		type: 'POST',
		url: 'students/show/action.php',
		data: {data:data},	
		success: function(result){
		}
	});	
	
	if(enrol_level > 10){
		value = '<option value="">Select status</option><option value="PROMOTED">REGULAR</option><option value="IRREGULAR">IRREGULAR</option><option value="RETAINED">RETAINED</option><option value="DROPPED OUT">DROPPED OUT</option>';
		$('#esjhs-1').hide();
		$('#esjhs-2').hide();
		$('#shs-1').show();
		$('#shs-2').show();
		$('#shs-3').show();
	} else if(enrol_level > 0){
		value = '<option value="">Select status</option><option value="PROMOTED">PROMOTED</option><option value="IRREGULAR">CONDITIONAL</option><option value="RETAINED">RETAINED</option><option value="DROPPED OUT">DROPPED OUT</option>';
		$('#esjhs-1').show();
		$('#esjhs-2').show();
		$('#shs-1').hide();
		$('#shs-2').hide();
		$('#shs-3').hide();
	} else {
		$('#esjhs-1').hide();
		$('#esjhs-2').hide();
		$('#shs-1').hide();
		$('#shs-2').hide();
		$('#shs-3').hide();					
	}
	
	$('#enrol_status2').html(value);
		
	var condition;
	
	if(enrol_level >= 7){
		condition = " field_category LIKE 'TRACK' AND field_name LIKE 'JHS%' ";
	} else if(enrol_level >= 0){
		condition = " field_category LIKE 'TRACK' AND field_name LIKE 'ES%' ";
	} else {
		condition = "";
	}
	
	var data = ['updateESJHSTrack', condition];
	$.ajax({
		type: 'POST',
		url: 'students/show/action.php',
		data: {data:data},	
		success: function(result){
			$('#enrol_track2').html(result);
		}
	});	
}

function updateStrand(){
	var action = 'updateStrand';
	var enrol_track = $('#enrol_track').val();

	var data = [action, " field_category LIKE 'STRAND-"+enrol_track+"%' "];
	
	$.ajax({
		type: 'POST',
		url: 'students/show/action.php',
		data: {data:data},	
		success: function(result){
			$('#enrol_strand').html(result);
		}
	});		
}

function requireRemarks(){
	var enrol_eligibility = $('#enrol_eligibility').val();

	if(enrol_eligibility == "Others/Old Student"){
		$('#enrol_school_0').val('<?php echo $sch_code;?>');
		$('#enrol_school_1').val('<?php echo $sch_fullname;?>');
		$('#enrol_school_2').val('<?php echo $sch_citymun.", ".$sch_province;?>');
	}
	else if(enrol_eligibility == "Philippine Education Placement Test Passer" ||  enrol_eligibility == "Alternative Learning System Passer"){
		$('#enrol_remarks').val('');
		$('#enrol_remarks').removeAttr('readonly');
		
	} else{
		$('#enrol_remarks').val('OK');
		$('#enrol_remarks').attr('readonly', 'readonly');
	}
}

function addSchooldays(sch_stud_no, sch_sy){
	var action = 'addSchooldays';
	
	var data = [action, sch_stud_no, sch_sy];
	$.ajax({
		type: 'POST',
		url: 'students/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				toastr.success('School days added.');
			} else {
				toastr.error(result[1]);
			}
		}
	});		
}

function updateProgramName(){
	var enrol_track2 = $('#enrol_track2').val();
	var program_name_str = enrol_track2.split(" ");
	var program_name = program_name_str[1];

	$('#enrol_strand2').val(program_name);
}

function checkRequirementsPriorToEnroll(){
	var action = "checkStudentDetails";
	
	var data = [action, stud_no];
	$.ajax({
		type: 'POST',
		url: 'students/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				if(result[2].stud_religion == '' || result[2].stud_dialect == '' || result[2].stud_ethnicity == ''){
					$(document).Toasts('create', {
						class: 'bg-warning', 
						position: 'bottomLeft',
						icon: 'fas fa-flag',
						autohide: true,
						delay: 5000,
						title: 'Incomplete student data',
						body: 'Student\'s basic data is incomplete. Click <a href="?p=students&modify='+stud_no+'&t=basic">here</a> to supply missing data.'
					 });	
				} 
				
				if(result[2].studCont_stud_ffname == null || result[2].studCont_stud_ffname == '-' || result[2].studCont_stud_mfname == null || result[2].studCont_stud_mfname == '-'){
					$(document).Toasts('create', {
						class: 'bg-warning', 
						position: 'bottomLeft',
						icon: 'fas fa-flag',
						autohide: true,
						delay: 5000,
						title: 'Incomplete contact data',
						body: 'Student\'s contact data is incomplete. Click <a href="?p=students&modify='+stud_no+'&t=contact">here</a> to supply missing data.'
					 });					
				}
				
			} else {
				
			}
		}
	});		
	
}

function checkRedirect(){
	var tab = '<?php echo (isset($_GET['t']) ? $_GET['t'] : "history");?>';

	if(tab == 'basic'){
		removeActiveClasses();	
		$('#custom-content-below-1-tab').addClass('active');
		$('#custom-content-below-1').addClass('active');		
	} else if(tab == 'contact'){
		removeActiveClasses();	
		$('#custom-content-below-2-tab').addClass('active');
		$('#custom-content-below-2').addClass('active');	
	} else if(tab == 'schedule'){
		removeActiveClasses();	
		$('#custom-content-below-3-tab').addClass('active');
		$('#custom-content-below-3').addClass('active');
	} else if(tab == 'grade'){
		removeActiveClasses();	
		$('#custom-content-below-4-tab').addClass('active');
		$('#custom-content-below-4').addClass('active');
	} else if(tab == 'history'){
		removeActiveClasses();	
		$('#custom-content-below-5-tab').addClass('active');
		$('#custom-content-below-5').addClass('active');
	}
}

function removeActiveClasses(){
	$('#custom-content-below-1-tab').removeClass('active');
	$('#custom-content-below-1').removeClass('active');
	$('#custom-content-below-2-tab').removeClass('active');
	$('#custom-content-below-2').removeClass('active');
	$('#custom-content-below-3-tab').removeClass('active');
	$('#custom-content-below-3').removeClass('active');
	$('#custom-content-below-4-tab').removeClass('active');
	$('#custom-content-below-4').removeClass('active');
	$('#custom-content-below-5-tab').removeClass('active');
	$('#custom-content-below-5').removeClass('active');
}

function urlParam (name){
	var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
	return results[1] || 0;
}

function updateSection(){
	var action = 'updateSection';
	var enrol_level = $('#enrol_level').val();

	var data = [action, enrol_level];
	$.ajax({
		type: 'POST',
		url: 'classes/admissions/action.php',
		data: {data:data},	
		success: function(result){
			$('#enrol_section').html(result);
			updateTrack(enrol_level);
		}
	});	
	
}

function updateTrack(enrol_level){
	if(enrol_level > 10){
		$('#track-shs').show();
		$('#track-esjhs').hide();		
	} else {
		$('#track-shs').hide();
		$('#track-esjhs').show();				
	}
}

/*
function updateStrand(){
	var action = 'updateStrand';
	var enrol_track1 = $('#enrol_track1').val();

	var data = [action, enrol_track1];
	$.ajax({
		type: 'POST',
		url: 'classes/admissions/action.php',
		data: {data:data},	
		success: function(result){
			$('#enrol_strand').html(result);
		}
	});		
}

*/

function updateCombo(){
	var action = 'updateCombo';
	var enrol_strand = $('#enrol_strand').val();

	var data = [action, enrol_strand];
	$.ajax({
		type: 'POST',
		url: 'classes/admissions/action.php',
		data: {data:data},	
		success: function(result){
			$('#enrol_combo').html(result);
		}
	});		
}
</script>