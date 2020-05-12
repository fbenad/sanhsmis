	<div class="content-wrapper">
	
		<section class="content-header">
			<div class="container">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Curriculum Management</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="?p=my"><i class="fas fa-home"></i></a></li>
							<li class="breadcrumb-item"><a href="?p=schmgmt">School Management</a></li>
							<li class="breadcrumb-item active">Curricula</li>
						</ol>
					</div>
				</div>
			</div>
		</section>

		<section class="content">
			<div class="container">
				<div class="row">
					<div class="col-md-3">
						<div class="info-box">
							<span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
							<div class="info-box-content">
								<span class="info-box-number">
									<a href="javascript:void(0);" id="add-curriculum" title="Add curriculum" 
										data-toggle="modal" data-target="#modal-input" rowID="0" 
										data-backdrop="static" data-keyboard="false" data-type="addCurriculum">
										New curriculum
									</a>
								</span>
								<span class="info-box-number">
									<a href="javascript:void(0);" id="add-program" title="Add program" 
										data-toggle="modal" data-target="#modal-input" rowID="0" 
										data-backdrop="static" data-keyboard="false" data-type="addProgram">
										New program
									</a>
								</span>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="info-box">
							<span class="info-box-icon bg-danger elevation-1"><i class="fas fa-bookmark"></i></span>
							<div class="info-box-content">
								<span class="info-box-text">Curricula</span>
								<span class="info-box-number" id="dashboard-label-2">0</span>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="info-box">
							<span class="info-box-icon bg-success elevation-1"><i class="fas fa-medal"></i></span>
							<div class="info-box-content">
								<span class="info-box-text">Programs</span>
								<span class="info-box-number" id="dashboard-label-3">0</span>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="info-box">
							<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-file-alt"></i></span>
							<div class="info-box-content">
								<span class="info-box-text">Subjects</span>
								<span class="info-box-number" id="dashboard-label-4">0</span>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">List</h3>
								<div class="card-tools">
									<div class="input-group input-group-sm" style="width: 500px;">
										<select class="form-control" id="pros_part" name="pros_part" onchange="getCurrProgram();">
											<option value="1">Official listing</option>
											<option value="0">Added listing</option>
											<option value="%">All listing</option>
										</select>
										<select class="form-control" id="pros_track" name="pros_track" onchange="getCurrProgram('1');">
										</select>
										<select class="form-control" id="pros_curr" name="pros_curr" onchange="loadCurrPrograms();">
										</select>
									</div>
								</div>
							</div>
							<div class="card-body" id="acadcurr-curriculum">
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
			
			if(actionType == 'addCurriculum'){
				$('#modal-size').addClass('modal-sm');
				$('#modal-title').html('Create curriculum');
				$('#submit').html('Submit');
				userFunc = "return confirm('Save curriculum?') ? submitAction('addCurriculum') : false;";
				$('#submit').attr('onclick', userFunc);
				
			} else if(actionType == 'addProgram'){
				$('#modal-size').addClass('modal-md');
				$('#modal-title').html('Create program ');
				$('#submit').html('Submit');
				userFunc = "return confirm('Save program?') ? submitAction('addProgram') : false;";
				$('#submit').attr('onclick', userFunc);
				
			} else if(actionType == 'addSubject'){
				$('#modal-size').addClass('modal-lg');
				$('#modal-title').html('Create subject'+ (id == 0 ? '' : ' for Grade <span id="list-id">'+id+'</span>'));
				$('#submit').html('Submit');
				userFunc = "return confirm('Save subject?') ? submitAction('addSubject') : false;";
				$('#submit').attr('onclick', userFunc);
				
			} else if(actionType == 'modifySubject'){
				$('#modal-size').addClass('modal-lg');
				$('#modal-title').html('Modify subject #<span id="list-id">'+id+'</span>');
				$('#submit').html('Update');
				userFunc = "return confirm('Update subject?') ? submitAction('modifySubject') : false;";
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
	loadCurrYears();
	loadDashboardCounts();
}


function loadCurrYears(){
	var action = 'loadCurrYears';
	
	var data = [action];
	$.ajax({
		type: 'POST',
		url: 'schmgmt/acadcurr/action.php',
		data: {data:data},	
		success: function(result){
			$('#pros_curr').html(result);
			$('#pros_part').val('1').change();
			loadCurrPrograms();
		}
	});
}

function loadCurrPrograms(){
	var action = 'loadCurrPrograms';
	var pros_curr = $('#pros_curr').val();
	
	var data = [action, pros_curr];
	$.ajax({
		type: 'POST',
		url: 'schmgmt/acadcurr/action.php',
		data: {data:data},	
		success: function(result){
			$('#pros_track').html(result);
			$('#pros_part').val('1').change();
			getCurrProgram('1');
		}
	});
}

function getCurrProgram(pros_part){
	var action = 'getCurrProgram';
	var pros_curr = $('#pros_curr').val();
	var pros_track = $('#pros_track').val();
	pros_part = pros_part != '' ? $('#pros_part').val() : pros_part;
	$('#pros-track-label').html(' <strong>('+$('#pros_track').val()+')</strong>');
	
	var data = [action, pros_curr, pros_track, pros_part];
	$.ajax({
		type: 'POST',
		url: 'schmgmt/acadcurr/action.php',
		data: {data:data},	
		success: function(result){
			$('#acadcurr-curriculum').html(result);
		}
	});	
}

function moveSort(pros_no, pros_sort, direction){
	var action = 'moveSort';
	
	var data = [action, pros_no, pros_sort, direction];
	$.ajax({
		type: 'POST',
		url: 'schmgmt/acadcurr/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				getCurrProgram();
			} else {
				toastr.error(result[1]);
			}
		}
	});	
}

function loadDashboardCounts(){
	var action = 'loadDashboardCounts';
	
	var data = [action, " pros_no FROM prospectus ", "", " GROUP BY pros_curr "];
	$.ajax({
		type: 'POST',
		url: 'schmgmt/acadcurr/action.php',
		data: {data:data},	
		success: function(result){
			$('#dashboard-label-2').html(result[3]);
		}
	});		
	
	var data = [action, " pros_no FROM prospectus ", " WHERE (pros_track NOT LIKE 'SHS %') ", "  GROUP BY pros_track "];
	$.ajax({
		type: 'POST',
		url: 'schmgmt/acadcurr/action.php',
		data: {data:data},	
		success: function(result){
			$('#dashboard-label-3').html(result[3]);
		}
	});	
	
	var data = [action, " pros_no FROM prospectus ", " WHERE (pros_part = '1') ", ""];
	$.ajax({
		type: 'POST',
		url: 'schmgmt/acadcurr/action.php',
		data: {data:data},	
		success: function(result){
			$('#dashboard-label-4').html(result[3]);
		}
	});	
}

function showAction(actionType, list_id){
	var action = 'showAction';
	
	if(actionType == 'addCurriculum'){
		var data = [action, actionType, list_id];
		$.ajax({
			type: 'POST',
			url: 'schmgmt/acadcurr/action.php',
			data: {data:data},	
			success: function(result){
				$('#form-input').html(result);
			}
		});		
		
	} else if(actionType == 'addProgram'){
		var data = [action, actionType, list_id];
		$.ajax({
			type: 'POST',
			url: 'schmgmt/acadcurr/action.php',
			data: {data:data},	
			success: function(result){
				$('#form-input').html(result);
			}
		});		
		
	} else if(actionType == 'addSubject'){
		var data = [action, actionType, list_id];
		$.ajax({
			type: 'POST',
			url: 'schmgmt/acadcurr/action.php',
			data: {data:data},	
			success: function(result){
				$('#form-input').html(result);
				$('#pros_curr2').val($('#pros_curr').val());
				$('#pros_track2').val($('#pros_track').val());
				
				if(list_id != '0'){
					$('#pros_level2').val(list_id);
				}
			}
		});		
		
	} else if(actionType == 'modifySubject'){
		var data = [action, 'addSubject', list_id];
		$.ajax({
			type: 'POST',
			url: 'schmgmt/acadcurr/action.php',
			data: {data:data},	
			success: function(result){
				$('#form-input').html(result);
			}
		});	

		var data = [action, actionType, list_id];
		$.ajax({
			type: 'POST',
			url: 'schmgmt/acadcurr/action.php',
			data: {data:data},	
			success: function(result){
				$('#modify-form').show();
				$('#pros_level2').val(result[2].pros_level);
				$('#pros_sem2').val(result[2].pros_sem);
				$('#pros_title2').val(result[2].pros_title);
				$('#pros_track2').val(result[2].pros_track);
				$('#pros_desc2').val(result[2].pros_desc);
				$('#pros_unit2').val(result[2].pros_unit);
				$('#pros_hoursPerWk2').val(result[2].pros_hoursPerWk);
				$('#pros_cutoff2').val(result[2].pros_cutoff);
				$('#pros_prereq2').val(result[2].pros_prereq);
				result[2].pros_part == '1' ? $('#pros_part3').attr('checked', 'checked') : $('#pros_part3').removeAttr('checked');
				checkProspectusAssociation(result[2].pros_no);
			}
		});			
		
	}
	
}

function submitAction(actionType){
	var action = 'submitAction';
	
	if(actionType == 'addCurriculum'){
		var field_category = $('#field_category').val();
		var field_name = $('#field_name').val();
		
		var data = [action, actionType, field_category, field_name];
		if(sanitizeForm(data) == true){			
			$('#close1').attr('disabled', 'disabled');
			$('#close2').attr('disabled', 'disabled');
			$('#submit').attr('disabled', 'disabled');
			$('#submit').html('Validating...');
			
			$.ajax({
				type: 'POST',
				url: 'schmgmt/acadcurr/action.php',
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
			// error handing performed by the sanitizeForm() function
		}
		
	} else if(actionType == 'addProgram'){	
		var field_category = $('#field_category').val();
		var program_track = $('#program_track').val() == '' ? '-' : $('#program_track').val();
		var program_strand = $('#program_strand').val() == '' ? '-' : $('#program_strand').val();
		var program_combo = $('#program_combo').val() == '' ? '-' : $('#program_combo').val();
		var field_nameprefix = $('#field_nameprefix').val();
		var field_name = $('#field_name').val();
		
		var data = [action, actionType, field_category, program_track, program_strand, program_combo, field_nameprefix, field_name];
		if(sanitizeForm(data) == true){
			$('#close1').attr('disabled', 'disabled');
			$('#close2').attr('disabled', 'disabled');
			$('#submit').attr('disabled', 'disabled');
			$('#submit').html('Validating...');
			
			$.ajax({
				type: 'POST',
				url: 'schmgmt/acadcurr/action.php',
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
		} else{
			// error handing performed by the sanitizeForm() function
		}
		
	} else if(actionType == 'addSubject'){	
		var pros_level = $('#pros_level2').val();
		var pros_sem = $('#pros_sem2').val();
		var pros_track = $('#pros_track2').val();
		var pros_title = $('#pros_title2').val();
		var pros_desc = $('#pros_desc2').val();
		var pros_unit = $('#pros_unit2').val();
		var pros_hoursPerWk = $('#pros_hoursPerWk2').val();
		var pros_cutoff = $('#pros_cutoff2').val();
		var pros_prereq = $('#pros_prereq2').val();
		var pros_curr = $('#pros_curr2').val();
		var pros_sort = $('#pros_sort2').val();
		var pros_part = $('#pros_part2').val();
		
		var data = [action, actionType, pros_level, pros_sem, pros_track, pros_title, pros_desc, pros_unit, pros_hoursPerWk, pros_cutoff, pros_prereq, pros_curr, pros_sort, pros_part];
		if(sanitizeForm(data) == true){
			$('#close1').attr('disabled', 'disabled');
			$('#close2').attr('disabled', 'disabled');
			$('#submit').attr('disabled', 'disabled');
			$('#submit').html('Validating...');
			
			$.ajax({
				type: 'POST',
				url: 'schmgmt/acadcurr/action.php',
				data: {data:data},	
				success: function(result){
					if(result[0] == 1){
						setTimeout(function(){$('#submit').html('Saving...');}, 500);
						setTimeout(function(){$('#submit').html('Submit');}, 1000);
						setTimeout(function(){toastr.success(result[1]);}, 1000);
						setTimeout(function(){$('#modal-input').modal('hide');}, 1500);	
						$('#pros_track').val($('#pros_track2').val()).change();;						
					} else {
						setTimeout(function(){$('#close1').removeAttr('disabled');}, 500);
						setTimeout(function(){$('#close2').removeAttr('disabled');}, 500);	
						setTimeout(function(){$('#submit').removeAttr('disabled');}, 500);						
						setTimeout(function(){$('#submit').html('Submit');}, 500);						
						setTimeout(function(){toastr.error(result[1]);}, 500);							
					}
				}
			});				
		} else{
			// error handing performed by the sanitizeForm() function
		}
		
	} else if(actionType == 'modifySubject'){
		var pros_level = $('#pros_level2').val();
		var pros_sem = $('#pros_sem2').val();
		var pros_track = $('#pros_track2').val();
		var pros_title = $('#pros_title2').val();
		var pros_desc = $('#pros_desc2').val();
		var pros_unit = $('#pros_unit2').val();
		var pros_hoursPerWk = $('#pros_hoursPerWk2').val();
		var pros_cutoff = $('#pros_cutoff2').val();
		var pros_prereq = $('#pros_prereq2').val();
		var pros_curr = '-';
		var pros_sort = '-';
		var pros_part = $('#pros_part3').is(":checked") ? '1' : '0';
		var pros_no = $('#list-id').html();
		
		var data = [action, actionType, pros_level, pros_sem, pros_track, pros_title, pros_desc, pros_unit, pros_hoursPerWk, pros_cutoff, pros_prereq, pros_curr, pros_sort, pros_part, pros_no];
		if(sanitizeForm(data) == true){
			$('#close1').attr('disabled', 'disabled');
			$('#close2').attr('disabled', 'disabled');
			$('#submit').attr('disabled', 'disabled');
			$('#submit').html('Validating...');
			
			$.ajax({
				type: 'POST',
				url: 'schmgmt/acadcurr/action.php',
				data: {data:data},	
				success: function(result){
					if(result[0] == 1){
						setTimeout(function(){$('#submit').html('Updating...');}, 500);
						setTimeout(function(){$('#submit').html('Update');}, 1000);
						setTimeout(function(){toastr.success(result[1]);}, 1000);
						setTimeout(function(){$('#modal-input').modal('hide');}, 1500);	
						$('#pros_track').val($('#pros_track2').val()).change();;						
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
			// error handing performed by the sanitizeForm() function
		}
		
	} else if(actionType == 'deleteSubject'){
		var pros_no = $('#list-id').html();
		var data = [action, actionType, pros_no];
		
		$('#close1').attr('disabled', 'disabled');
		$('#close2').attr('disabled', 'disabled');
		$('#submit').attr('disabled', 'disabled');
		$('#delete').attr('disabled', 'disabled');
		$('#submit').html('Validating...');
		
		$.ajax({
			type: 'POST',
			url: 'schmgmt/acadcurr/action.php',
			data: {data:data},	
			success: function(result){
				if(result[0] == 1){
					setTimeout(function(){$('#submit').html('Deleting...');}, 500);
					setTimeout(function(){$('#submit').html('Submit');}, 1000);
					setTimeout(function(){toastr.success(result[1]);}, 1000);
					setTimeout(function(){$('#modal-input').modal('hide');}, 1500);	
					$('#pros_track').val($('#pros_track2').val()).change();;						
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
}	


function sanitizeForm(data){
	var result = true;
	
	if(data[1] == 'addCurriculum'){
		var min_year = Date.parse('<?php echo date('Y', strtotime('-1 year'));?>');
		var max_year = Date.parse('<?php echo date('Y', strtotime('+1 year'));?>');

		if(data[3] == '' || Date.parse(data[3]) < min_year || Date.parse(data[3]) > max_year){
			result = false;
			toastr.error('Invalid year.');
		}	
		
	} else if(data[1] == 'addProgram'){
		if(data[3] == ''){
			result = false;
			toastr.error('Invalid class type.');
		} else if(data[4] == ''){
			result = false;
			toastr.error('Invalid program track.');			
		} else if(data[5] == ''){
			result = false;
			toastr.error('Invalid program strand.');			
		} else if(data[6] == ''){
			result = false;
			toastr.error('Invalid program prefix.');			
		} else if(data[7] == ''){
			result = false;
			toastr.error('Invalid program name');			
		}
		
	} else if(data[1] == 'addSubject' || data[1] == 'modifySubject'){
		if(data[2] == ''){
			result = false;
			toastr.error('Invalid grade level.');
		} else if(data[3] == ''){
			result = false;
			toastr.error('Invalid term.');
		} else if(data[4] == ''){
			result = false;
			toastr.error('Invalid category.');
		} else if(data[5] == ''){
			result = false;
			toastr.error('Invalid subject code.');
		} else if(data[6] == ''){
			result = false;
			toastr.error('Invalid subject description.');
		} else if(data[7] == ''){
			result = false;
			toastr.error('Invalid unit(s).');
		} else if(data[8] == ''){
			result = false;
			toastr.error('Invalid hrs/week.');
		} else if(data[9] == ''){
			result = false;
			toastr.error('Invalid cut-off grade.');
		} else if(data[10] == ''){
			result = false;
			toastr.error('Invalid pre-requisites.');
		} else if(data[11] == ''){
			result = false;
			toastr.error('Invalid curriculum year.');
		} else if(data[12] == ''){
			result = false;
			toastr.error('Invalid sort value.');
		} else if(data[13] == ''){
			result = false;
			toastr.error('Invalid part.');
		}
	}
	
	return result;
}

function checkSY(){
	var action = 'checkSY';
	var field_name = $('#field_name').val();

	var data = [action, 'CURRICULUM', field_name];
	$.ajax({
		type: 'POST',
		url: 'schmgmt/acadcurr/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				toastr.error('Curriculum year already exists.');
				$('#field_name').addClass('is-invalid');
				$('#submit').attr('disabled', 'disabled');
			} else {
				$('#field_name').removeClass('is-invalid');
				$('#submit').removeAttr('disabled');
			}
		}			
	});		
}

function checkFieldName(){
	var action = 'checkFieldName';
	var field_nameprefix = $('#field_nameprefix').val();
	var field_name = $('#field_name').val();
	var field_name_value = field_nameprefix + field_name;
	
	var data = [action, 'TRACK', field_name_value];
	$.ajax({
		type: 'POST',
		url: 'schmgmt/acadcurr/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				toastr.error('Program already exists.');
				$('#field_name').addClass('is-invalid');
				$('#submit').attr('disabled', 'disabled');
			} else {
				$('#field_name').removeClass('is-invalid');
				$('#submit').removeAttr('disabled');
			}
		}			
	});	
}

function changeStrands(){
	var action = 'changeStrands';
	var program_track = $('#program_track').val();
	
	var data = [action, program_track];
	$.ajax({
		type: 'POST',
		url: 'schmgmt/acadcurr/action.php',
		data: {data:data},	
		success: function(result){
			$('#program_strand').html(result);
			$('#field_nameprefix').val('SHS-'+program_track+'-');	
			if(program_track == 'TVL'){
				$('#program-combo').show();
			} else {
				$('#program-combo').hide();
			}
		}			
	});		
}

function chooseStrand(){
	var field_nameprefix = $('#field_nameprefix').val();
	var program_strand = $('#program_strand').val();
	var field_name_value = field_nameprefix + program_strand;
	$('#field_nameprefix').val(field_name_value);
}


function changeGradeLevel(){
	var action = 'changeGradeLevel';
	var pros_level2 = $('#pros_level2').val();
	
	if(pros_level2 < 7){
		$('#pros_sem2').html('<option value="12">Full Year</option>');
		
		var data = [action, " (field_category = 'TRACK' AND field_name LIKE 'ES%')"];
		$.ajax({
			type: 'POST',
			url: 'schmgmt/acadcurr/action.php',
			data: {data:data},	
			success: function(result){
				$('#pros_track2').html(result);			
			}			
		});	
	} else if (pros_level2 < 11) {
		$('#pros_sem2').html('<option value="12">Full Year</option>');
		
		var data = [action, " (field_category = 'TRACK' AND field_name LIKE 'JHS%')"];
		$.ajax({
			type: 'POST',
			url: 'schmgmt/acadcurr/action.php',
			data: {data:data},	
			success: function(result){
				$('#pros_track2').html(result);			
			}			
		});
	} else {
		$('#pros_sem2').html('<option value="">Select term</option><option value="1">Sem 1</option><option value="2">Sem 2</option>');
		
		var data = [action, " (field_category = 'TRACK' AND field_name LIKE 'SHS-%') "];
		$.ajax({
			type: 'POST',
			url: 'schmgmt/acadcurr/action.php',
			data: {data:data},	
			success: function(result){
				$('#pros_track2').html(result);	
				updateSort();
			}			
		});
	}
	
	

}

function updateSort(){
	var action = 'updateSort';
	var pros_level2 = $('#pros_level2').val();
	var pros_sem2 = $('#pros_sem2').val();
	var pros_track2 = $('#pros_track2').val();
	var pros_curr = $('#pros_curr').val();

	var data = [action, pros_level2, pros_sem2, pros_track2, pros_curr];
	$.ajax({
		type: 'POST',
		url: 'schmgmt/acadcurr/action.php',
		data: {data:data},	
		success: function(result){
			$('#pros_sort2').val(result[3] == '0' ? 1 : result[3]);			
		}			
	});	
}

function checkSubjectCode(){
	var action = 'checkSubjectCode';
	var pros_title2 = $('#pros_title2').val();
	var pros_track2 = $('#pros_track2').val();
	var pros_curr = $('#pros_curr').val();

	var data = [action, pros_title2, pros_track2, pros_curr];
	
	$.ajax({
		type: 'POST',
		url: 'schmgmt/acadcurr/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				toastr.error('Subject code already exists.');
				$('#pros_title2').addClass('is-invalid');
				$('#submit').attr('disabled', 'disabled');
			} else {
				$('#pros_title2').removeClass('is-invalid');
				$('#submit').removeAttr('disabled');
			}				
		}			
	});		
}


function checkProspectusAssociation(pros_no){
	var action = 'checkProspectusAssociation';

	var data = [action, pros_no];
	$.ajax({
		type: 'POST',
		url: 'schmgmt/acadcurr/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				$('#delete').attr('disabled', 'disabled');
			} else {
				$('#delete').removeAttr('disabled');
			}	
		}			
	});	
}
</script>	