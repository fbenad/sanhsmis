	<div class="content-wrapper">
	
		<section class="content-header">
			<div class="container">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Class Management</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="?p=my"><i class="fas fa-home"></i></a></li>
							<li class="breadcrumb-item active">Classes</li>
						</ol>
					</div>
				</div>
			</div>
		</section>

		<section class="content">
			<div class="container">
				<div class="row">
				
					<div class="col-md-12">

						<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col-md-3">
										<button href="javascript:void(0);" id="class-create" class="btn btn-info" title="Create class" 
											data-toggle="modal" data-target="#modal-input" rowID="0" 
											data-backdrop="static" data-keyboard="false" data-type="addClass">
											Create Class
										</button>
										
									</div>
									<div class="col-md-3"></div>
									<div class="col-md-6">
										<div class="btn-group float-right">
											<select class="form-control" id="class-sys" name="class-sys" onChange="changeSY();">
											</select>
										</div>
									</div>
								</div>
								<br>
								<?php if($_SESSION['eosy'] == true){ ?>
									<br>
									<div class="row bg-default"">
										<div class="col-md-12">
											<div class="callout callout-info">
												<h5><i class="fas fa-info"></i> Note:</h5>
												<small>
												<p><strong>EOSY Updating</strong> is now open.</p>
												<p>Select a class for eosy updating. Finalized classes are marked with the lock icon.</p>
												<p>Once all classes are finalized, the school enrolment for the current school year will automatically be finalized.</p>
												<p>As a designated admin, you have the option to reopen updating of a class while the school's enrolment is not yet finalized.</p>
												</small>
											</div>
										</div>
									</div>
								<?php } ?>								
								<ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" id="custom-content-below-0-tab" data-toggle="pill" href="#custom-content-below-0" role="tab" aria-controls="custom-content-below-0" aria-selected="true">Overview</a>
									</li>
									<!--
									<li class="nav-item">
										<a class="nav-link" id="custom-content-below-1-tab" data-toggle="pill" href="#custom-content-below-1" role="tab" aria-controls="custom-content-below-1" aria-selected="true">Elementary School</a>
									</li>
									-->
									<li class="nav-item">
										<a class="nav-link " id="custom-content-below-2-tab" data-toggle="pill" href="#custom-content-below-2" role="tab" aria-controls="custom-content-below-2" aria-selected="true">Junior High School</a>
									</li>
									<li class="nav-item">
										<a class="nav-link " id="custom-content-below-3-tab" data-toggle="pill" href="#custom-content-below-3" role="tab" aria-controls="custom-content-below-3" aria-selected="true">Senior High School</a>
									</li>									
								</ul>
								<div class="tab-content" id="custom-content-below-tabContent">
									<div class="tab-pane fade show active" id="custom-content-below-0" role="tabpanel" aria-labelledby="custom-content-below-0-tab">	
										<br>
										<div class="row" id="classes-tab-0b">
										</div>	
										<div class="row" id="classes-tab-0">
										</div>
										<br>
										<div class="row" id="classes-tab-0a">
										</div>	
										
									</div>
									<div class="tab-pane fade show " id="custom-content-below-1" role="tabpanel" aria-labelledby="custom-content-below-1-tab">	
										<br>
										<div class="btn-group float-right">
											<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
												<i class="fas fa-print"></i> School Forms
											</button>
											<div class="dropdown-menu dropdown-menu-right" role="menu">
												<a href="javascript:void(0);" title="Print SF 4" target="_blank" 
													onclick="window.open('../reports/pdf_sf4.php?sy=<?php echo $_SESSION['current_sy'];?>&month=<?php echo $_SESSION['current_month'];?>&level=es', 'newwindow', 'width=1175, height=550'); return false;" 
													class="dropdown-item">
													SF 4 - Monthly Learner’s Movement and Attendance</a>
												<a href="javascript:void(0);" title="Print SF 6" target="_blank" 
													onclick="window.open('../reports/pdf_sf6.php?sy=<?php echo $_SESSION['current_sy'];?>&level=es', 'newwindow', 'width=1175, height=550'); return false;" 
													class="dropdown-item">
													SF 6 - Summarized Report on Promotion and Learning Progress & Achievement </a>
											</div>
										</div>
										<br>
										<br>
										<div class="row" id="classes-tab-1">
										</div>																												
									</div>
									<div class="tab-pane fade show " id="custom-content-below-2" role="tabpanel" aria-labelledby="custom-content-below-2-tab">
										<br>
										<div class="btn-group float-right">
											<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
												<i class="fas fa-print"></i> School Forms
											</button>
											<div class="dropdown-menu dropdown-menu-right" role="menu">
												<a href="javascript:void(0);" title="Print SF 4" target="_blank" 
													onclick="window.open('../reports/pdf_sf4.php?sy=<?php echo $_SESSION['current_sy'];?>&month=<?php echo $_SESSION['current_month'];?>&level=jhs', 'newwindow', 'width=1175, height=550'); return false;" 
													class="dropdown-item">
													SF 4 - Monthly Learner’s Movement and Attendance</a>
												<a href="javascript:void(0);" title="Print SF 6" target="_blank" 
													onclick="window.open('../reports/pdf_sf6.php?sy=<?php echo $_SESSION['current_sy'];?>&level=jhs', 'newwindow', 'width=1175, height=550'); return false;" 
													class="dropdown-item">
													SF 6 - Summarized Report on Promotion and Learning Progress & Achievement </a>
											</div>
										</div>
										<br>
										<br>
										<div class="row" id="classes-tab-2">
																											
										</div>
									</div>
									<div class="tab-pane fade show" id="custom-content-below-3" role="tabpanel" aria-labelledby="custom-content-below-3-tab">
										<br>	
										<div class="btn-group float-right">
											<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
												<i class="fas fa-print"></i> School Forms
											</button>
											<div class="dropdown-menu dropdown-menu-right" role="menu">
												<a href="#" href="javascript:void(0);" title="Print SF 4" target="_blank" 
													onclick="window.open('../reports/pdf_sf4.php?sy=<?php echo $_SESSION['current_sy'];?>&month=<?php echo $_SESSION['current_month'];?>&level=shs', 'newwindow', 'width=1175, height=550'); return false;" 
													class="dropdown-item">
													SF 4 - Monthly Learner’s Movement and Attendance</a>
												<a href="javascript:void(0);" title="Print SF 6" target="_blank" 
													onclick="window.open('../reports/pdf_sf6.php?sy=<?php echo $_SESSION['current_sy'];?>&level=shs', 'newwindow', 'width=1175, height=550'); return false;" 
													class="dropdown-item">
													SF 6 - Summarized Report on Promotion and Learning Progress & Achievement </a>
											</div>
										</div>
										<br>
										<br>
										<div class="row" id="classes-tab-3">
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
				<div id="class-input">
				</div>
			</div>			
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-default" data-dismiss="modal" id="close2">Close</button>
				<button type="submit" class="btn btn-info" name="submit" id="submit">Submit</button>
				<div class="btn-group" id="form-modify">
					<button type="button" class="btn btn-danger" name="delete" id="delete">Delete</button>
					<button type="submit" class="btn btn-info" name="update" id="update">Update</button>
				</div>
				</form>	
			</div>			
		</div>
	</div>
</div>
	
<script type="text/javascript">	
var current_sy = <?php echo $_SESSION['current_sy'];?>;
var selected_sy = current_sy;

setTimeout(function(){preLoad();}, 1);

setTimeout(function(){
	$(function(){
		$('#modal-input').on('show.bs.modal', function(e){
			var actionType = $(e.relatedTarget).attr('data-type');
			var id = $(e.relatedTarget).attr('rowID');
			var userFunc;
			
			if(actionType == 'addClass'){
				$('#form-modify').hide();
				$('#modal-size').addClass('modal-md');
				$('#modal-title').html('Add class');
				userFunc = "return confirm('Save class?') ? submitAction('addClass') : false;";
				$('#submit').attr('onclick', userFunc);
				
			} else if(actionType == 'modifyClass'){
				$('#submit').hide();
				$('#modal-size').addClass('modal-md');
				$('#modal-title').html('Modify class');
				userFunc = "return confirm('Delete class?') ? submitAction('deleteClass') : false;";
				$('#delete').attr('onclick', userFunc);
				userFunc = "return confirm('Update class?') ? submitAction('modifyClass') : false;";
				$('#update').attr('onclick', userFunc);
				
			} else if(actionType == 'unfinalizeClass'){
				$('#form-modify').hide();
				$('#modal-size').addClass('modal-md');
				$('#modal-title').html('Unfinalize class');
				$('#submit').html('Unfinalize');
				userFunc = "return confirm('Unfinalize class?') ? submitAction('unfinalizeClass') : false;";
				$('#submit').attr('onclick', userFunc);
				
			} else if(actionType == 'viewBogus'){
				$('#form-modify').hide();
				$('#submit').hide();
				$('#modal-size').addClass('modal-lg');
				$('#modal-title').html('Bogus sections');
			}
			
			showAction(actionType, id);
		});
		
		$('#modal-input').on('hidden.bs.modal', function(){
			$('#modal-size').removeClass('modal-xs');
			$('#modal-size').removeClass('modal-sm');
			$('#modal-size').removeClass('modal-md');
			$('#modal-size').removeClass('modal-lg');
			$('#modal-size').removeClass('modal-xl');
			$('#form').trigger('reset');
			$('#class-input').html('');
			
			$('#form-modify').show();
			$('#submit').show();
			$('#delete').html('Delete');
			$('#update').html('Update');
			$('#submit').html('Submit');
			
			$('#close1').removeAttr('disabled');
			$('#close2').removeAttr('disabled');
			$('#delete').removeAttr('disabled');
			$('#update').removeAttr('disabled');
			$('#submit').removeAttr('disabled');			
		});
	});
}, 1);

function preLoad(){
	getSYs();
	var next_sy = parseInt(current_sy)+1;
	$('#class-sy').html('SY '+current_sy+'-'+next_sy);	
	loadCreateClass();
	getClassTab0();
	getClassTab0b();
	getClassTab1();
	getClassTab2();
	getClassTab3();
}


function loadCreateClass(){
	if(current_sy != selected_sy){
		$('#class-create').attr('disabled', 'disabled');
	} else {
		$('#class-create').removeAttr('disabled');
	}
}

function getClassTab0(){
	var action = 'getClassTab0';
	
	var data = [action, selected_sy];
	$.ajax({
		type: 'POST',
		url: 'classes/action.php',
		data: {data:data},	
		success: function(result){
			$('#classes-tab-0').html(result);
		}
	});	
}

function getClassTab0a(){
	var action = 'getClassTab0a';
	$('#classes-tab-0a').show();
	var min = 7;
	var max = 12;
	
	var data = [action, selected_sy, min, max];
	$.ajax({
		type: 'POST',
		url: 'classes/action.php',
		data: {data:data},	
		success: function(result){
			$('#classes-tab-0a').html(result);
		}
	});
}

function getClassTab0b(){
	var action = 'getClassTab0b';
	$('#classes-tab-0b').show();
	
	var data = [action, selected_sy];
	$.ajax({
		type: 'POST',
		url: 'classes/action.php',
		data: {data:data},	
		success: function(result){
			$('#classes-tab-0b').html(result);
		}
	});
}

function closeClassTab0a(){
	$('#classes-tab-0a').html('');
	$('#classes-tab-0a').hide();
}

function getClassTab1(){
	var action = 'getClassTab';
	var min = 0;
	var max = 6;
	
	var data = [action, selected_sy, min, max];
	$.ajax({
		type: 'POST',
		url: 'classes/action.php',
		data: {data:data},	
		success: function(result){
			$('#classes-tab-1').html(result);
		}
	});
	
}

function getClassTab2(){
	var action = 'getClassTab';
	var min = 7;
	var max = 10;
	
	var data = [action, selected_sy, min, max];
	$.ajax({
		type: 'POST',
		url: 'classes/action.php',
		data: {data:data},	
		success: function(result){
			$('#classes-tab-2').html(result);
		}
	});
	
}

function getClassTab3(){
	var action = 'getClassTab';
	var min = 11;
	var max = 12;
	
	var data = [action, selected_sy, min, max];
	$.ajax({
		type: 'POST',
		url: 'classes/action.php',
		data: {data:data},	
		success: function(result){
			$('#classes-tab-3').html(result);
		}
	});
	
}

function createClass(){
	toastr.success('You clicked on create class!');
}

function changeSY(){
	selected_sy = $('#class-sys').val();
	loadCreateClass();
	$('#classes-tab-0a').hide();
	getClassTab0();
	getClassTab0b();
	getClassTab1();
	getClassTab2();
	getClassTab3();
}

function getSYs(){
	var action = 'getSYs';
	
	var data = [action];
	$.ajax({
		type: 'POST',
		url: 'classes/action.php',
		data: {data:data},	
		success: function(result){
			$('#class-sys').html(result);
			$('#class-sys').val(selected_sy).change();
		}
	});	
}

function showAction(actionType, id){
	var action = 'showAction';

	if(actionType == 'addClass'){
		var data = [action, actionType, id];
		$.ajax({
			type: 'POST',
			url: 'classes/action.php',
			data: {data:data},	
			success: function(result){
				$('#class-input').html(result);
			}
		});		
		
	} else if(actionType == 'modifyClass'){
		var data = [action, 'addClass', id];
		$.ajax({
			type: 'POST',
			url: 'classes/action.php',
			data: {data:data},	
			success: function(result){
				$('#class-input').html(result);
				$('#section_name').attr('readonly', 'readonly');
			}
		});	

		var data = [action, actionType, id];
		$.ajax({
			type: 'POST',
			url: 'classes/action.php',
			data: {data:data},	
			success: function(result){
				if(result[0] == 1){
					$('#section_name').val(result[2].section_name);
					$('#section_bogus').val(result[2].section_bogus).change();
					$('#section_level').val(result[2].section_level).change();
					$('#section_cap').val(result[2].section_cap);
					setTimeout(function(){$('#section_track').val(result[2].section_track).change();}, 100);
					$('#section_adviser').val(result[2].section_adviser);
					$('#section_sy').val(result[2].section_sy);
					$('#section_no').val(result[2].section_no);
					getSectionCount(result[2].section_name, result[2].section_sy);
					getSectionAssociation(result[2].section_no, result[2].section_sy);
					if(modacc_role == 2){ 
						$('#delete').hide(); 
					} else{ 
						$('#delete').show();
					}
				} else {
					toastr.success(result[1]);
				}
			}
		});	

	} else if(actionType == 'unfinalizeClass'){
		var data = [action, actionType, id];
		$.ajax({
			type: 'POST',
			url: 'classes/action.php',
			data: {data:data},	
			success: function(result){
				$('#class-input').html(result);
				if(modacc_role == 2){ 
					$('#submit').hide(); 
				} else{ 
					$('#submit').show();
				}
			}
		});	
		
	} else if(actionType == 'viewBogus'){
		var data = [action, actionType, selected_sy];
		$.ajax({
			type: 'POST',
			url: 'classes/action.php',
			data: {data:data},	
			success: function(result){
				$('#class-input').html(result);
			}
		});	
	}
}

function submitAction(actionType){
	var action = 'submitAction';
	
	if(actionType == 'addClass'){
		var section_name = $('#section_name').val();
		var section_bogus = $('#section_bogus').val();
		var section_level  = $('#section_level').val();
		var section_cap = $('#section_cap').val();
		var section_track = $('#section_track').val();
		var section_adviser = $('#section_adviser').val();  
		
		if(section_bogus == "1"){
			section_track = '-';
			section_adviser = '1';
		} 
		var formInputs = [section_name, section_bogus, section_level, section_cap, section_track, section_adviser];
		
		if(sanitizeForm(formInputs) == true){
			$('#close1').attr('disabled', 'disabled');
			$('#close2').attr('disabled', 'disabled');
			$('#submit').attr('disabled', 'disabled');
			$('#submit').html('Validating...');
			
			var data = [action, actionType, section_name, section_bogus, section_level, section_cap, section_track, section_adviser, selected_sy];
			$.ajax({
				type: 'POST',
				url: 'classes/action.php',
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
						setTimeout(function(){$('#submit').html('Submit');}, 500);
						setTimeout(function(){$('#submit').removeAttr('disabled');}, 500);
						setTimeout(function(){toastr.error(result[1]);}, 500);						
					}
				}
			});				
		} else {
			// error handling performed by the 
		}	
		
	} else if(actionType == 'modifyClass'){
		var section_name = $('#section_name').val();
		var section_bogus = $('#section_bogus').val();
		var section_level  = $('#section_level').val();
		var section_cap = $('#section_cap').val();
		var section_track = $('#section_track').val();
		var section_adviser = $('#section_adviser').val();  
		var section_no = $('#section_no').val();  
		
		if(section_bogus == "1"){
			section_track = '-';
			section_adviser = '1';
		} 
		var formInputs = [section_name, section_bogus, section_level, section_cap, section_track, section_adviser];
		
		if(sanitizeForm(formInputs) == true){
			$('#close1').attr('disabled', 'disabled');
			$('#close2').attr('disabled', 'disabled');
			$('#update').attr('disabled', 'disabled');
			$('#update').html('Validating...');
			
			var data = [action, actionType, section_name, section_bogus, section_level, section_cap, section_track, section_adviser, section_no];
			$.ajax({
				type: 'POST',
				url: 'classes/action.php',
				data: {data:data},	
				success: function(result){
					if(result[0] == 1){
						setTimeout(function(){$('#update').html('Updating...');}, 500);
						setTimeout(function(){$('#update').html('Update');}, 1000);
						setTimeout(function(){toastr.success(result[1]);}, 1000);
						setTimeout(function(){$('#modal-input').modal('hide');}, 1500);	
						preLoad();
						
					} else {
						setTimeout(function(){$('#close1').removeAttr('disabled');}, 500);
						setTimeout(function(){$('#close2').removeAttr('disabled');}, 500);						
						setTimeout(function(){$('#update').html('Update');}, 500);
						setTimeout(function(){$('#update').removeAttr('disabled');}, 500);
						setTimeout(function(){toastr.error(result[1]);}, 500);						
					}
				}
			});				
		} else {
			// error handling performed by the 
		}	
		
	} else if(actionType == 'deleteClass'){
		var section_no = $('#section_no').val();
		var section_name = $('#section_name').val();
		var section_sy = $('#section_sy').val();

		$('#close1').attr('disabled', 'disabled');
		$('#close2').attr('disabled', 'disabled');
		$('#update').attr('disabled', 'disabled');
		$('#delete').attr('disabled', 'disabled');
		$('#delete').html('Validating...');
		
		var data = [action, actionType, section_no];

		$.ajax({
			type: 'POST',
			url: 'classes/action.php',
			data: {data:data},	
			success: function(result){
				if(result[0] == 1){
					setTimeout(function(){$('#delete').html('Deleting...');}, 500);
					setTimeout(function(){$('#delete').html('Delete');}, 1000);
					setTimeout(function(){toastr.success(result[1]);}, 1000);
					setTimeout(function(){$('#modal-input').modal('hide');}, 1500);	
					preLoad();
					
				} else {
					setTimeout(function(){$('#close1').removeAttr('disabled');}, 500);
					setTimeout(function(){$('#close2').removeAttr('disabled');}, 500);						
					setTimeout(function(){$('#delete').html('Submit');}, 500);
					setTimeout(function(){$('#update').removeAttr('disabled');}, 500);
					setTimeout(function(){toastr.error(result[1]);}, 500);						
				}
			}
		});

	} else if(actionType == 'unfinalizeClass'){
		var section_no = $('#section_no').val();

		$('#close1').attr('disabled', 'disabled');
		$('#close2').attr('disabled', 'disabled');
		$('#submit').attr('disabled', 'disabled');
		$('#submit').html('Validating...');
		
		var data = [action, actionType, section_no];

		$.ajax({
			type: 'POST',
			url: 'classes/action.php',
			data: {data:data},	
			success: function(result){
				if(result[0] == 1){
					setTimeout(function(){$('#submit').html('Unfinalizing...');}, 500);
					setTimeout(function(){$('#submit').html('Unfinalize');}, 1000);
					setTimeout(function(){toastr.success(result[1]);}, 1000);
					setTimeout(function(){$('#modal-input').modal('hide');}, 1500);	
					preLoad();
					
				} else {
					setTimeout(function(){$('#close1').removeAttr('disabled');}, 500);
					setTimeout(function(){$('#close2').removeAttr('disabled');}, 500);						
					setTimeout(function(){$('#submit').html('Unfinalize');}, 500);
					setTimeout(function(){$('#submit').removeAttr('disabled');}, 500);
					setTimeout(function(){toastr.error(result[1]);}, 500);						
				}
			}
		});

	}
	
}

function sanitizeForm(formInputs){
	var result = true;
	
	if(formInputs[0] == '' || formInputs[0].length < 3){
		result = false;
		toastr.error('Invalid name');
	} else if(formInputs[2] == ''){
		result = false;
		toastr.error('Invalid level ');		
	} else if(formInputs[3] == '' || formInputs[3] < 0){
		result = false;
		toastr.error('Invalid capacity');
	} else if(formInputs[4] == ''){
		result = false;
		toastr.error('Invalid class type');
	} else if(formInputs[5] == ''){
		result = false;
		toastr.error('Invalid adviser');
	}
	return result;
}

function updateClassType(){
	var action = 'updateClassType';
	var section_level = $('#section_level').val();

	var data = [action, section_level];
	$.ajax({
		type: 'POST',
		url: 'classes/action.php',
		data: {data:data},	
		success: function(result){
			$('#section_track').html(result);
		}
	});
}

function checkDuplicateName(){
	var action = 'checkDuplicateName';
	var section_name = $('#section_name').val();

	if(section_name.length > 2){
		var data = [action, section_name, selected_sy];
		$.ajax({
			type: 'POST',
			url: 'classes/action.php',
			data: {data:data},	
			success: function(result){
				if(result[0] == 1){
					$('#section_name').addClass('is-invalid');
					$('#submit').attr('disabled', 'disabled');					
					toastr.error('Duplicate name existing.');
				} else {
					$('#section_name').removeClass('is-invalid');
					$('#submit').removeAttr('disabled');	
				}
			}
		});			
	}
	
}

function getSectionCount(section_name, section_sy){	
	var action = 'getSectionCount';
	
	var data = [action, section_sy, section_name];
	$.ajax({
		type: 'POST',
		url: 'classes/action.php',
		data: {data:data},	
		success: function(result){
			if(result[2].sectionCount > 0){
				$('#delete').attr('disabled', 'disabled');
			} else {
				$('#delete').removeAttr('disabled');
			}
		}
	});
}

function getSectionAssociation(section_no, section_sy){	
	var action = 'getSectionAssociation';
	
	var data = [action, section_sy, section_no];
	$.ajax({
		type: 'POST',
		url: 'classes/action.php',
		data: {data:data},	
		success: function(result){
			if(result[2].associationCount > 0){
				$('#delete').attr('disabled', 'disabled');
			} else {
				$('#delete').removeAttr('disabled');
			}
		}
	});
}
</script>	