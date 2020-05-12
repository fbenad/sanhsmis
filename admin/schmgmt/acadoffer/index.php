	<div class="content-wrapper">
	
		<section class="content-header">
			<div class="container">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Offerings Management</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="?p=my"><i class="fas fa-home"></i></a></li>
							<li class="breadcrumb-item"><a href="?p=schmgmt">School Management</a></li>
							<li class="breadcrumb-item active">Offerings</li>
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
								<span class="info-box-text">
									<select class="form-control-sm" style="width: 100%;" id="class_sem" name="class_sem">
										<option value="1">Sem 1</option>
										<option value="2">Sem 2</option>
									</select>
								</span>
								<span class="info-box-number" id="dashboard-label-1">
									<a href="javascript:void(0);" id="add-subjects" title="Add subjects" 
										data-toggle="modal" data-target="#modal-input" rowID="0" 
										data-backdrop="static" data-keyboard="false" data-type="addSubjects">
										Assign offerings
									</a>
								</span>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="info-box">
							<span class="info-box-icon bg-danger elevation-1"><i class="fas fa-chalkboard-teacher"></i></span>
							<div class="info-box-content">
								<span class="info-box-text">Total Sections</span>
								<span class="info-box-number" id="dashboard-label-2">0</span>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="info-box">
							<span class="info-box-icon bg-success elevation-1"><i class="fas fa-thumbs-up"></i></span>
							<div class="info-box-content">
								<span class="info-box-text">With Offerings</span>
								<span class="info-box-number" id="dashboard-label-3">0</span>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="info-box">
							<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-thumbs-down"></i></span>
							<div class="info-box-content">
								<span class="info-box-text">Without Offerings</span>
								<span class="info-box-number" id="dashboard-label-4">0</span>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">Subject Offerings</h3>
								<div class="card-tools">
									<div class="input-group input-group-sm" style="width: 500px;">
										<select class="form-control" id="class_section_no" name="class_section_no" onchange="loadSectionCourses();">
										</select>
										<select class="form-control" id="class_sy" name="class_sy" onchange="loadClassSections();">
										</select>
									</div>
								</div>
							</div>
							<div class="card-body" id="acadoffer-offering">
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
			
			if(actionType == 'addSubjects'){
				$('#modal-size').addClass('modal-lg');
				$('#modal-title').html('Add subjects');
				$('#submit').html('Submit');
				userFunc = "return confirm('Save offerings?') ? submitAction('addSubjects') : false;";
				$('#submit').attr('onclick', userFunc);
				
			} else if(actionType == 'modifyOffering'){
				$('#modal-size').addClass('modal-md');
				$('#modal-title').html('Modify offering #<span id="list-id">'+id+'</span>');
				$('#submit').html('Update');
				userFunc = "return confirm('Update offering?') ? submitAction('modifyOffering') : false;";
				$('#submit').attr('onclick', userFunc);
				
			} else if(actionType == 'addOffering'){
				$('#modal-size').addClass('modal-md');
				$('#modal-title').html('Add offering');
				$('#submit').html('Submit');
				userFunc = "return confirm('Save offerings?') ? submitAction('addOffering') : false;";
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
	loadClassSYs();
	loadDashboardCounts();
}

function loadClassSYs(){
	var action = 'loadClassSYs';
	
	var data = [action];
	$.ajax({
		type: 'POST',
		url: 'schmgmt/acadoffer/action.php',
		data: {data:data},	
		success: function(result){
			$('#class_sy').html(result);
			loadClassSections();
		}
	});		
}

function loadClassSections(){
	var action = 'loadClassSections';
	var class_sy = $('#class_sy').val();
	
	var data = [action, class_sy];
	$.ajax({
		type: 'POST',
		url: 'schmgmt/acadoffer/action.php',
		data: {data:data},	
		success: function(result){
			$('#class_section_no').html(result);
			loadSectionCourses();
		}
	});		
}


function loadSectionCourses(){
	var action = 'loadSectionCourses';
	var class_sy = $('#class_sy').val();
	var class_section_no = $('#class_section_no').val();

	var data = [action, class_sy, class_section_no];
	$.ajax({
		type: 'POST',
		url: 'schmgmt/acadoffer/action.php',
		data: {data:data},	
		success: function(result){
			$('#acadoffer-offering').html(result);
		}
	});		
	
}

function loadDashboardCounts(){
	var action = 'loadDashboardCounts';
	
	var data = [action, " section_no FROM section ", " WHERE (section_bogus = '0' AND section_sy = '<?php echo $_SESSION['current_sy'];?>') ", ""];
	$.ajax({
		type: 'POST',
		url: 'schmgmt/acadoffer/action.php',
		data: {data:data},	
		success: function(result){
			$('#dashboard-label-2').html(result[3]);
		}
	});		
	
	var data = [action, " section_no FROM section ", " WHERE (section_bogus = '0' AND section_sy = '<?php echo $_SESSION['current_sy'];?>' AND section_no IN (SELECT class_section_no FROM class WHERE class_sy = '<?php echo $_SESSION['current_sy'];?>'))", ""];
	$.ajax({
		type: 'POST',
		url: 'schmgmt/acadoffer/action.php',
		data: {data:data},	
		success: function(result){
			$('#dashboard-label-3').html(result[3]);
		}
	});	
	
	var data = [action, " section_no FROM section ", " WHERE (section_bogus = '0' AND section_sy = '<?php echo $_SESSION['current_sy'];?>' AND section_no NOT IN (SELECT class_section_no FROM class WHERE class_sy = '<?php echo $_SESSION['current_sy'];?>'))", ""];
	$.ajax({
		type: 'POST',
		url: 'schmgmt/acadoffer/action.php',
		data: {data:data},	
		success: function(result){
			$('#dashboard-label-4').html(result[3]);
		}
	});	
}

function showAction(actionType, list_id){
	var action = 'showAction';
	var class_sy = $('#class_sy').val();
	var class_section_no = $('#class_section_no').val();
	var class_sem = $('#class_sem').val();

	if(actionType == 'addSubjects'){
		var data = [action, actionType, class_sy, class_section_no, class_sem];
		$.ajax({
			type: 'POST',
			url: 'schmgmt/acadoffer/action.php',
			data: {data:data},	
			success: function(result){	
				$('#form-input').html(result);
			}
		});	
		
	} else if(actionType == 'modifyOffering'){
		var data = [action, actionType, list_id];
		$.ajax({
			type: 'POST',
			url: 'schmgmt/acadoffer/action.php',
			data: {data:data},	
			success: function(result){	
				$('#form-input').html(result);
			}
		});	
		
	} else if(actionType == 'addOffering'){
		var data = [action, actionType, class_sy, class_section_no, class_sem];
		$.ajax({
			type: 'POST',
			url: 'schmgmt/acadoffer/action.php',
			data: {data:data},	
			success: function(result){	
				$('#form-input').html(result);
			}
		});	
	}
}

function submitAction(actionType){
	var action = 'submitAction';
	
	if(actionType == 'addSubjects'){
		var class_sy = $('#class_sy').val();
		var class_section_no = $('#class_section_no').val();
		var class_pros_no = new Array();
		$('input[name^="pros_no"]').each(function() { !$(this).is(":checked") ? '' :  class_pros_no.push($(this).val()); });
		var class_sem = new Array();
		$('input[name^="pros_sem"]').each(function() { $(this).disabled ? '' : class_sem.push($(this).val()); });
		
		$('#close1').attr('disabled', 'disabled');
		$('#close2').attr('disabled', 'disabled');
		$('#submit').attr('disabled', 'disabled');
		$('#submit').html('Validating...');
		
		var data = [action, actionType, class_sy, class_section_no, class_pros_no, class_sem];		
		$.ajax({
			type: 'POST',
			url: 'schmgmt/acadoffer/action.php',
			data: {data:data},	
			success: function(result){	
				if(result[0] == 1){
					setTimeout(function(){$('#submit').html('Saving...');}, 500);
					setTimeout(function(){$('#submit').html('Submit');}, 1000);
					setTimeout(function(){toastr.success(result[1]);}, 1000);
					setTimeout(function(){$('#modal-input').modal('hide');}, 1500);	
					loadSectionCourses();
				} else {
					setTimeout(function(){$('#close1').removeAttr('disabled');}, 500);
					setTimeout(function(){$('#close2').removeAttr('disabled');}, 500);	
					setTimeout(function(){$('#submit').removeAttr('disabled');}, 500);						
					setTimeout(function(){$('#submit').html('Submit');}, 500);						
					setTimeout(function(){toastr.error(result[1]);}, 500);							
				}
			}
		});	
		
	} else if(actionType == 'modifyOffering'){
		var class_no = $('#class_no2').val();
		var class_timeslots = $('#class_timeslots2').val();		
		var class_days = $('#class_days2').val();
		var class_room = $('#class_room2').val();
		var class_sem = $('#class_sem2').val();
		var class_user_name  = $('#class_user_name2').val();
		
		var data = [action, actionType, class_no, class_timeslots, class_days, class_room, class_sem, class_user_name];
		if(sanitizeForm(data) == true){
			$('#close1').attr('disabled', 'disabled');
			$('#close2').attr('disabled', 'disabled');
			$('#submit').attr('disabled', 'disabled');
			$('#submit').html('Validating...');
			
			$.ajax({
				type: 'POST',
				url: 'schmgmt/acadoffer/action.php',
				data: {data:data},	
				success: function(result){	
					if(result[0] == 1){
						setTimeout(function(){$('#submit').html('Updating...');}, 500);
						setTimeout(function(){$('#submit').html('Update');}, 1000);
						setTimeout(function(){toastr.success(result[1]);}, 1000);
						setTimeout(function(){$('#modal-input').modal('hide');}, 1500);	
						loadSectionCourses();
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
			// error handling handled by sanitizeForm() function
		}
		
	} else if(actionType == 'deleteOffering'){
		var class_no = $('#class_no2').val();
		
		var data = [action, actionType, class_no];
		$('#close1').attr('disabled', 'disabled');
		$('#close2').attr('disabled', 'disabled');
		$('#submit').attr('disabled', 'disabled');
		$('#submit').html('Validating...');
		
		$.ajax({
			type: 'POST',
			url: 'schmgmt/acadoffer/action.php',
			data: {data:data},	
			success: function(result){	
				if(result[0] == 1){
					setTimeout(function(){$('#submit').html('Deleting...');}, 500);
					setTimeout(function(){$('#submit').html('Update');}, 1000);
					setTimeout(function(){toastr.success(result[1]);}, 1000);
					setTimeout(function(){$('#modal-input').modal('hide');}, 1500);	
					loadSectionCourses();
				} else {
					setTimeout(function(){$('#close1').removeAttr('disabled');}, 500);
					setTimeout(function(){$('#close2').removeAttr('disabled');}, 500);	
					setTimeout(function(){$('#submit').removeAttr('disabled');}, 500);						
					setTimeout(function(){$('#submit').html('Update');}, 500);						
					setTimeout(function(){toastr.error(result[1]);}, 500);							
				}
			}
		});	
		
	} else if(actionType == 'addOffering'){
		var class_sy = $('#class_sy').val();
		var class_section_no = $('#class_section_no').val();
		var class_sem = $('#class_sem2').val();		
		var class_pros_no = $('#class_pros_no2').val();		
		
		var data = [action, actionType, class_sy, class_section_no, class_sem, class_pros_no];
		if(sanitizeForm(data) == true){
			$('#close1').attr('disabled', 'disabled');
			$('#close2').attr('disabled', 'disabled');
			$('#submit').attr('disabled', 'disabled');
			$('#submit').html('Validating...');
			
			$.ajax({
				type: 'POST',
				url: 'schmgmt/acadoffer/action.php',
				data: {data:data},	
				success: function(result){	
					if(result[0] == 1){
						setTimeout(function(){$('#submit').html('Updating...');}, 500);
						setTimeout(function(){$('#submit').html('Update');}, 1000);
						setTimeout(function(){toastr.success(result[1]);}, 1000);
						setTimeout(function(){$('#modal-input').modal('hide');}, 1500);	
						loadSectionCourses();
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
			// error handling handled by sanitizeForm() function
		}
		
	}
}

function sanitizeForm(data) {
	var result = true;
	
	if(data[1] == 'modifyOffering'){
		if(data[2] == ''){
			result = false;
			toastr.error('Invalid class no.');
		} else if(data[3] == ''){
			result = false;
			toastr.error('Invalid timeslot(s).');
		} else if(data[4] == ''){
			result = false;
			toastr.error('Invalid day(s).');
		} else if(data[5] == ''){
			result = false;
			toastr.error('Invalid classroom.');
		} else if(data[6] == ''){
			result = false;
			toastr.error('Invalid semester.');
		} else if(data[7] == ''){
			result = false;
			toastr.error('Invalid teacher.');
		}
		
	} else if(data[1] == 'addOffering'){
		if(data[2] == ''){
			result = false;
			toastr.error('Invalid school year.');
		} else if(data[3] == ''){
			result = false;
			toastr.error('Invalid section.');
		} else if(data[4] == ''){
			result = false;
			toastr.error('Invalid input.');
		} else if(data[5] == ''){
			result = false;
			toastr.error('Invalid input.');
		}
	} 
	
	return result;
}
</script>	