	<div class="content-wrapper">
	
		<section class="content-header">
			<div class="container">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>School Management</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="?p=my"><i class="fas fa-home"></i></a></li>
							<li class="breadcrumb-item active">School Information</li>
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
								<ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
									<li class="nav-item">
										<a class="nav-link" id="custom-content-below-schinfo-tab" data-toggle="pill" href="#custom-content-below-schinfo" role="tab" aria-controls="custom-content-below-schinfo" aria-selected="false">School Information</a>
									</li>
									<li class="nav-item">
										<a class="nav-link active" id="custom-content-below-schyears-tab" data-toggle="pill" href="#custom-content-below-schyears" role="tab" aria-controls="custom-content-below-schyears" aria-selected="false">School Year Settings</a>
									</li>	
								</ul>
								<div class="tab-content" id="custom-content-below-tabContent">
									<div class="tab-pane fade show" id="custom-content-below-schinfo" role="tabpanel" aria-labelledby="custom-content-below-schinfo-tab">
										<br>
										<form role="form" id="form2" method="post" onSubmit="return false;">	
										<div class="card">
											<div class="table-responsive p-0">
												<table class="table table-hover">
													<thead>
														<tr>
															<th width="30%">Field</th>
															<th>Details</th>
															<th><span class="float-right"><a href="javascript:void(0);" onclick="showEditSchInfo();" id="show-hide" title="Modify school information"><i class="fas fa-pen" id="show-hide-icon"></i></a></span></th>
														</tr>
													</thead>
													<tbody id="schmgmt-schinfo"> 														
													</tbody>
												</table>
											</div>
											<div class="card-footer" id="editAction">
												<button type="submit" class="btn btn-info float-right" onclick="return confirm('Update school information?') ? modfySchInfo() : false;">Update</button>
											</div>
										</div>										
										</form>
									</div>									
									<div class="tab-pane fade show active" id="custom-content-below-schyears" role="tabpanel" aria-labelledby="custom-content-below-schyears-tab">
										<br>
										<div class="card">
											<div class="table-responsive p-0">
												<table class="table table-hover">
													<thead>
														<tr>
															<th width="8%">#</th>
															<th>School Year / Status</th>
															<th>Curriculum Year</th>
															<th>BOSY</th>
															<th>EOSY</th>
															<th>School Days</th>
															<th><a href="javascript:void(0);" id="add-schoolyear" title="Add school year" 
																	data-toggle="modal" data-target="#modal-input" rowID="0" 
																	data-backdrop="static" data-keyboard="false" data-type="addSchoolYear">
																	<i class="fas fa-plus-square"></i>
																</a>
															</th>
														</tr>
													</thead>
													<tbody id="schmgmt-schyears"> 														
													</tbody>
												</table>
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
				<button type="submit" class="btn btn-primary" name="submit" id="submit">Submit</button>
				</form>	
			</div>			
		</div>
	</div>
</div>
	
<script type="text/javascript">	
setTimeout(function(){preLoad();}, 1);

setTimeout(function(){
	$(function(){
		$('#modal-input').on('show.bs.modal', function(e){
			var actionType = $(e.relatedTarget).attr('data-type');
			var id = $(e.relatedTarget).attr('rowID');
			var userFunc;
			
			if(actionType == 'addSchoolYear'){
				$('#modal-size').addClass('modal-lg');
				$('#modal-title').html('Create school year');
				$('#submit').html('Submit');
				userFunc = "return confirm('Save school year?') ? submitAction('addSchoolYear') : false;";
				$('#submit').attr('onclick', userFunc);
				
			} else if(actionType == 'modifySchoolYear'){
				$('#modal-size').addClass('modal-lg');
				$('#modal-title').html('Modify school year #<span id="list-id">'+id+'</span>');
				$('#submit').html('Update');
				userFunc = "return confirm('Update school year?') ? submitAction('modifySchoolYear') : false;";
				$('#submit').attr('onclick', userFunc);
				
			} else if(actionType == 'modifySchoolDays'){
				$('#modal-size').addClass('modal-md');
				$('#modal-title').html('Modify school days #<span id="list-id">'+id+'</span>');
				$('#submit').html('Update');
				userFunc = "return confirm('Update school days?') ? submitAction('modifySchoolDays') : false;";
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
	getSchoolYears();
	getSchoolInfo();
	setTimeout(function(){hideEditSchInfo();}, 200);
}

function getSchoolYears(){
	var action = 'getSchoolYears';
	
	var data = [action];
	$.ajax({
		type: 'POST',
		url: 'schmgmt/action.php',
		data: {data:data},	
		success: function(result){
			$('#schmgmt-schyears').html(result);
		}
	});	
}

function getSchoolInfo(){
	var action = 'getSchoolInfo';
	
	var data = [action];
	$.ajax({
		type: 'POST',
		url: 'schmgmt/action.php',
		data: {data:data},	
		success: function(result){
			$('#schmgmt-schinfo').html(result);
		}
	});	
}

function hideEditSchInfo(){
	$('#show-hide-icon').removeClass('fa-times');
	$('#show-hide-icon').addClass('fa-pen');		
	$('#show-hide').attr('onclick', 'showEditSchInfo();');
	$('#current_school_code').hide();
	$('#current_school_name').hide();
	$('#current_school_full').hide();
	$('#current_school_short').hide();
	$('#current_school_address').hide();
	$('#current_school_district').hide();
	$('#current_school_division').hide();
	$('#current_school_region').hide();
	$('#current_school_reg_code').hide();
	$('#current_school_contact').hide();
	$('#current_school_email').hide();
	$('#current_school_minlevel').hide();
	$('#current_school_maxlevel').hide();
	$('#current_school_name').hide();
	$('#editAction').hide();
}

function showEditSchInfo(){
	$('#show-hide-icon').removeClass('fa-pen');
	$('#show-hide-icon').addClass('fa-times');
	$('#show-hide').attr('onclick', 'hideEditSchInfo();');	
	$('#current_school_code').show();
	$('#current_school_name').show();
	$('#current_school_full').show();
	$('#current_school_short').show();
	$('#current_school_address').show();
	$('#current_school_district').show();
	$('#current_school_division').show();
	$('#current_school_region').show();
	$('#current_school_reg_code').show();
	$('#current_school_contact').show();
	$('#current_school_email').show();
	$('#current_school_minlevel').show();
	$('#current_school_maxlevel').show();
	$('#editAction').show();
}

function modfySchInfo(){
	var action = 'modfySchInfo';
	var current_school_code = $('#current_school_code').val();
	var current_school_name = $('#current_school_name').val();
	var current_school_full = $('#current_school_full').val();
	var current_school_short = $('#current_school_short').val();
	var current_school_address = $('#current_school_address').val();
	var current_school_district = $('#current_school_district').val();
	var current_school_division = $('#current_school_division').val();
	var current_school_region = $('#current_school_region').val();
	var current_school_reg_code = $('#current_school_reg_code').val();
	var current_school_contact = $('#current_school_contact').val();
	var current_school_email = $('#current_school_email').val();
	var current_school_minlevel = $('#current_school_minlevel').val();
	var current_school_maxlevel = $('#current_school_maxlevel').val();
	
	var data = [action, current_school_code, current_school_name, current_school_full, current_school_short, current_school_address, current_school_district, current_school_division, current_school_region, current_school_reg_code, current_school_contact, current_school_email, current_school_minlevel, current_school_maxlevel];
	if(sanitizeForm2(data) == true){
		$.ajax({
			type: 'POST',
			url: 'schmgmt/action.php',
			data: {data:data},	
			success: function(result){
				if(result[0] == 1){
					toastr.success(result[1]);
					preLoad();
				} else {
					toastr.error(result[1]);

				}
			}
		});	
	} else {
		// error handling done by the sanitizeForm2() function
	}
}

function sanitizeForm2(data){
	var result = true;
	
	if(data[1] ==  ''){
		result = false;
		toastr.error('Invalid school code.');
	} else if(data[2] ==  ''){
		result = false;
		toastr.error('Invalid school name.');		
	} else if(data[3] ==  ''){
		result = false;
		toastr.error('Invalid school full name.');		
	} else if(data[4] ==  ''){
		result = false;
		toastr.error('Invalid school short name.');		
	} else if(data[5] ==  ''){
		result = false;
		toastr.error('Invalid address.');		
	} else if(data[6] ==  ''){
		result = false;
		toastr.error('Invalid schools dstrict.');		
	} else if(data[7] ==  ''){
		result = false;
		toastr.error('Invalid schools division.');		
	} else if(data[8] ==  ''){
		result = false;
		toastr.error('Invalid schools region.');		
	} else if(data[9] ==  ''){
		result = false;
		toastr.error('Invalid schools region code.');		
	} else if(data[10] ==  ''){
		result = false;
		toastr.error('Invalid school contact #.');		
	} else if(data[11] ==  ''){
		result = false;
		toastr.error('Invalid school email.');		
	} else if(data[12] ==  '' || data[12] < 0 || data[12] > <?php echo $max_level;?>){
		result = false;
		toastr.error('Invalid lowest grade level offering.');		
	} else if(data[13] ==  '' || data[12] < 0 || data[12] > <?php echo $max_level;?>){
		result = false;
		toastr.error('Invalid highest grade level offering.');		
	} 
	
	return result;	
}

function activateSY(settings_sy){
	var action = 'activateSY';
	
	var data = [action, settings_sy];
	$.ajax({
		type: 'POST',
		url: 'schmgmt/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				toastr.success(result[1]);
				setTimeout(function(){toastr.success('Reloading page to apply changes...');}, 1000);
				setTimeout(function(){window.location = '?p=siteconfig';}, 2000);
			} else {
				toastr.error(result[1]);
			}
		}
	});	
}

function showAction(actionType, list_id){
	var action = 'showAction';
	
	if(actionType == 'addSchoolYear'){
		var data = [action, actionType, list_id];
		$.ajax({
			type: 'POST',
			url: 'schmgmt/action.php',
			data: {data:data},	
			success: function(result){
				$('#form-input').html(result);
			}
		});		
		
	} else if(actionType == 'modifySchoolYear'){
		var data = [action, 'addSchoolYear', list_id];
		$.ajax({
			type: 'POST',
			url: 'schmgmt/action.php',
			data: {data:data},	
			success: function(result){
				$('#form-input').html(result);
			}
		});	
		
		var data = [action, actionType, list_id];
		$.ajax({
			type: 'POST',
			url: 'schmgmt/action.php',
			data: {data:data},	
			success: function(result){
				$('#settings_sy').attr('disabled', 'disabled');
				$('#settings_sy').val(result[2].settings_sy);
				$('#settings_pros').val(result[2].settings_pros);
				$('#settings_pros').attr('disabled', 'disabled');
				$('#settings_registrar').val(result[2].settings_registrar);
				$('#settings_principal').val(result[2].settings_principal);
				$('#settings_supervisor').val(result[2].settings_supervisor);
				$('#settings_representative').val(result[2].settings_representative);
				$('#settings_superintendent').val(result[2].settings_superintendent);
				$('#settings_bosy').val(result[2].settings_bosy);
				$('#settings_eosy').val(result[2].settings_eosy);
				$('#settings_late1').val(result[2].settings_late1);
				$('#settings_late2').val(result[2].settings_late2);
				$('#settings_closing').val(result[2].settings_closing);
			}
		});	
		
	} else if(actionType == 'modifySchoolDays'){
		var data = [action, actionType, list_id];
		$.ajax({
			type: 'POST',
			url: 'schmgmt/action.php',
			data: {data:data},	
			success: function(result){
				$('#form-input').html(result);
			}
		});			
	}
}

function submitAction(actionType){
	var action = 'submitAction';
	
	if(actionType == 'addSchoolYear'){	
		var settings_sy = $('#settings_sy').val();
		var settings_pros = $('#settings_pros').val();
		var settings_registrar = $('#settings_registrar').val();
		var settings_principal = $('#settings_principal').val();
		var settings_supervisor = $('#settings_supervisor').val();
		var settings_representative = $('#settings_representative').val();
		var settings_superintendent = $('#settings_superintendent').val();
		var settings_bosy = $('#settings_bosy').val();
		var settings_eosy = $('#settings_eosy').val();
		var settings_late1 = $('#settings_late1').val();
		var settings_late2 = $('#settings_late2').val();
		var settings_closing = $('#settings_closing').val();
		
		var data = [action, actionType, settings_sy, settings_pros, settings_registrar, settings_principal, settings_supervisor, settings_representative, settings_superintendent, settings_bosy, settings_eosy, settings_late1, settings_late2, settings_closing];

		if(sanitizeForm1(data) == true){
			$('#close1').attr('disabled', 'disabled');
			$('#close2').attr('disabled', 'disabled');
			$('#submit').attr('disabled', 'disabled');
			$('#submit').html('Validating...');
			
			$.ajax({
				type: 'POST',
				url: 'schmgmt/action.php',
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
		} else {
			// error handling handled by the sanitizeForm1() function
		}
		
		var data = [action, 'addSchoolDays', settings_sy, settings_bosy];
		$.ajax({
			type: 'POST',
			url: 'schmgmt/action.php',
			data: {data:data},	
			success: function(result){
				if(result[0] == 1){
					//toastr.success(result[1]);
				} else {
					//toastr.error(result[1]);
				}
			}
		});			
	
		
	} else if(actionType == 'modifySchoolYear'){
		var settings_sy = $('#list-id').html();
		var settings_pros = $('#settings_pros').val();
		var settings_registrar = $('#settings_registrar').val();
		var settings_principal = $('#settings_principal').val();
		var settings_supervisor = $('#settings_supervisor').val();
		var settings_representative = $('#settings_representative').val();
		var settings_superintendent = $('#settings_superintendent').val();
		var settings_bosy = $('#settings_bosy').val();
		var settings_eosy = $('#settings_eosy').val();
		var settings_late1 = $('#settings_late1').val();
		var settings_late2 = $('#settings_late2').val();
		var settings_closing = $('#settings_closing').val();
				
		if(settings_pros == ''){
			settings_pros = '-';
		}
		var data = [action, actionType, settings_sy, settings_pros, settings_registrar, settings_principal, settings_supervisor, settings_representative, settings_superintendent, settings_bosy, settings_eosy, settings_late1, settings_late2, settings_closing];

		if(sanitizeForm1(data) == true){
			$('#close1').attr('disabled', 'disabled');
			$('#close2').attr('disabled', 'disabled');
			$('#submit').attr('disabled', 'disabled');
			$('#submit').html('Validating...');
			
			$.ajax({
				type: 'POST',
				url: 'schmgmt/action.php',
				data: {data:data},	
				success: function(result){
					if(result[0] == 1){
						setTimeout(function(){$('#submit').html('Updating...');}, 500);
						setTimeout(function(){$('#submit').html('Submit');}, 1000);
						setTimeout(function(){toastr.success(result[1]);}, 1000);
						setTimeout(function(){$('#modal-input').modal('hide');}, 1500);	
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
		} else {
			// error handling handled by the sanitizeForm1() function
		}
		
		var data = [action, 'modifyBOSY', settings_sy, settings_bosy];
		$.ajax({
			type: 'POST',
			url: 'schmgmt/action.php',
			data: {data:data},	
			success: function(result){
				if(result[0] == 1){
					//toastr.success(result[1]);
				} else {
					//toastr.error(result[1]);
				}
			}
		});			
		
	} else if(actionType == 'modifySchoolDays'){
		var sch_sy = $('#list-id').html();
		var sch_m1 = $('#sch_m1').val();
		var sch_m2 = $('#sch_m2').val();
		var sch_m3 = $('#sch_m3').val();
		var sch_m4 = $('#sch_m4').val();
		var sch_m5 = $('#sch_m5').val();
		var sch_m6 = $('#sch_m6').val();
		var sch_m7 = $('#sch_m7').val();
		var sch_m8 = $('#sch_m8').val();
		var sch_m9 = $('#sch_m9').val();
		var sch_m10 = $('#sch_m10').val();
		var sch_m11 = $('#sch_m11').val();
		var sch_m12 = $('#sch_m12').val();
		
		var data = [action, actionType, sch_sy, sch_m1, sch_m2, sch_m3, sch_m4, sch_m5, sch_m6, sch_m7, sch_m8, sch_m9, sch_m10, sch_m11, sch_m12];
	
		if(sanitizeForm1(data) == true){
			$('#close1').attr('disabled', 'disabled');
			$('#close2').attr('disabled', 'disabled');
			$('#submit').attr('disabled', 'disabled');
			$('#submit').html('Validating...');
			
			$.ajax({
				type: 'POST',
				url: 'schmgmt/action.php',
				data: {data:data},	
				success: function(result){
					if(result[0] == 1){
						setTimeout(function(){$('#submit').html('Updating...');}, 500);
						setTimeout(function(){$('#submit').html('Submit');}, 1000);
						setTimeout(function(){toastr.success(result[1]);}, 1000);
						setTimeout(function(){$('#modal-input').modal('hide');}, 1500);	
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
		} else{
			// error handling handled by the sanitizeForm1() function
		}

	}
}

function sanitizeForm1(data){
	var result = true;
	
	if(data[1] == 'addSchoolYear' || data[1] == 'modifySchoolYear'){
		var min_date = Date.parse('<?php echo date('Y-m-d',  strtotime('-1 year'));?>');
		var max_date = Date.parse('<?php echo date('Y-m-d',  strtotime('+1 year'));?>');
		
		if(data[2] == ''){
			result = false;
			toastr.error('Invalid school year.');
		} else if(data[3] == ''){
			result = false;
			toastr.error('Invalid curriculum year.');		
		} else if(data[4] == ''){
			result = false;
			toastr.error('Invalid school registrar.');		
		} else if(data[5] == ''){
			result = false;
			toastr.error('Invalid school principal.');		
		} else if(data[6] == ''){
			result = false;
			toastr.error('Invalid public schools district supervisor.');		
		} else if(data[7] == ''){
			result = false;
			toastr.error('Invalid schools division representative.');		
		} else if(data[8] == ''){
			result = false;
			toastr.error('Invalid schools division superintendent.');		
		} else if(data[9] == '' || Date.parse(data[9]) < min_date || Date.parse(data[9]) > max_date){
			result = false;
			toastr.error('Invalid BOSY date.');		
		} else if(data[10] == '' || Date.parse(data[10]) < min_date || Date.parse(data[10]) > max_date){
			result = false;
			toastr.error('Invalid EOSY date.');		
		} else if(data[11] == '' || Date.parse(data[11]) < min_date || Date.parse(data[11]) > max_date){
			result = false;
			toastr.error('Invalid late date (1st sem).');		
		} else if(data[12] == '' || Date.parse(data[12]) < min_date || Date.parse(data[12]) > max_date){
			result = false;
			toastr.error('Invalid last date (2nd sem).');		
		} else if(data[13] == '' || Date.parse(data[13]) < min_date || Date.parse(data[13]) > max_date){
			result = false;
			toastr.error('Invalid closing date.');		
		}
		
	} else if(data[1] == 'modifySchoolDays'){
		var min_days = 0;
		var max_days = 31;
		
		if(data[2] == ''){
			result = false;
			toastr.error('Invalid  school days.');
		} else if(data[3] == '' || data[3] < min_days || data[3] > max_days){
			result = false;
			toastr.error('Invalid June school days.');
		} else if(data[4] == '' || data[4] < min_days || data[4] > max_days){
			result = false;
			toastr.error('Invalid July school days.');
		} else if(data[5] == '' || data[5] < min_days || data[5] > max_days){
			result = false;
			toastr.error('Invalid August school days.');
		} else if(data[6] == '' || data[6] < min_days || data[6] > max_days){
			result = false;
			toastr.error('Invalid September school days.');
		} else if(data[7] == '' || data[7] < min_days || data[7] > max_days){
			result = false;
			toastr.error('Invalid October school days.');
		} else if(data[8] == '' || data[8] < min_days || data[8] > max_days){
			result = false;
			toastr.error('Invalid November school days.');
		} else if(data[9] == '' || data[9] < min_days || data[9] > max_days){
			result = false;
			toastr.error('Invalid December school days.');
		} else if(data[10] == '' || data[10] < min_days || data[10] > max_days){
			result = false;
			toastr.error('Invalid January school days.');
		} else if(data[11] == '' || data[11] < min_days || data[11] > max_days){
			result = false;
			toastr.error('Invalid February school days.');
		} else if(data[12] == '' || data[12] < min_days || data[12] > max_days){
			result = false;
			toastr.error('Invalid March school days.');
		} else if(data[13] == '' || data[13] < min_days || data[13] > max_days){
			result = false;
			toastr.error('Invalid April school days.');
		} else if(data[14] == '' || data[14] < min_days || data[14] > max_days){
			result = false;
			toastr.error('Invalid May school days.');
		}		
	}
	
	return result;
}
</script>	