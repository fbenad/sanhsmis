	<div class="content-wrapper">
	
		<section class="content-header">
			<div class="container">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Load Assignment Management</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="?p=my"><i class="fas fa-home"></i></a></li>
							<li class="breadcrumb-item"><a href="?p=schmgmt">School Management</a></li>
							<li class="breadcrumb-item active">Load Assignment</li>
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
								<span class="info-box-text">Tools</span>
								<span class="info-box-number" id="dashboard-label-1">Click <i class="fas fa-external-link-alt"></i></span>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="info-box">
							<span class="info-box-icon bg-danger elevation-1"><i class="fas fa-user-tie"></i></span>
							<div class="info-box-content">
								<span class="info-box-text">Total Teachers</span>
								<span class="info-box-number" id="dashboard-label-2">0</span>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="info-box">
							<span class="info-box-icon bg-success elevation-1"><i class="fas fa-thumbs-up"></i></span>
							<div class="info-box-content">
								<span class="info-box-text">With Assignment</span>
								<span class="info-box-number" id="dashboard-label-3">0</span>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="info-box">
							<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-thumbs-down"></i></span>
							<div class="info-box-content">
								<span class="info-box-text">Without Assignment</span>
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
									<div class="input-group input-group-sm" style="width: 650px;">
										<select class="form-control" id="class_user_name" name="class_user_name" onchange="loadAssignments2();">
										</select>
										<select class="form-control" id="class_pros_no" name="class_pros_no" onchange="loadAssignments();">
										</select>
										<select class="form-control" id="class_sy" name="class_sy" onchange="loadClassLoads();">
										</select>
									</div>
								</div>
							</div>
							<div class="card-body" id="acadload-assignment">
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
			
			if(actionType == 'modifyOffering'){
				$('#modal-size').addClass('modal-md');
				$('#modal-title').html('Modify offering #<span id="list-id">'+id+'</span>');
				$('#submit').html('Update');
				userFunc = "return confirm('Update offerings?') ? submitAction('modifyOffering') : false;";
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
	loadTeachers();
	loadDashboardCounts();
}

function loadClassSYs(){
	var action = 'loadClassSYs';
	
	var data = [action];
	$.ajax({
		type: 'POST',
		url: 'schmgmt/acadload/action.php',
		data: {data:data},	
		success: function(result){
			$('#class_sy').html(result);
			loadClassLoads();
		}
	});		
}

function loadClassLoads(){
	var action = 'loadClassLoads';
	var class_sy = $('#class_sy').val();
	
	var data = [action, class_sy];
	$.ajax({
		type: 'POST',
		url: 'schmgmt/acadload/action.php',
		data: {data:data},	
		success: function(result){
			$('#class_pros_no').html(result);
			loadAssignments();
		}
	});		
}

function loadTeachers(){
	var action = 'loadTeachers';
	
	var data = [action];
	$.ajax({
		type: 'POST',
		url: 'schmgmt/acadload/action.php',
		data: {data:data},	
		success: function(result){
			$('#class_user_name').html(result);
		}
	});		
}

function loadAssignments(){
	var action = 'loadAssignments';
	var class_sy = $('#class_sy').val();
	var class_pros_no = $('#class_pros_no').val();

	var data = [action, class_sy, class_pros_no];
	$.ajax({
		type: 'POST',
		url: 'schmgmt/acadload/action.php',
		data: {data:data},	
		success: function(result){
			$('#acadload-assignment').html(result);
		}
	});		
}

function loadAssignments2(){
	var action = 'loadAssignments2';
	var class_sy = $('#class_sy').val();
	var class_user_name = $('#class_user_name').val();

	var data = [action, class_sy, class_user_name];
	$.ajax({
		type: 'POST',
		url: 'schmgmt/acadload/action.php',
		data: {data:data},	
		success: function(result){
			$('#acadload-assignment').html(result);
		}
	});		
}

function loadDashboardCounts(){
	var action = 'loadDashboardCounts';
	
	var data = [action, " teach_no FROM teacher ", " WHERE (teach_status = '1' AND teach_teacher = '1') ", ""];
	$.ajax({
		type: 'POST',
		url: 'schmgmt/acadcurr/action.php',
		data: {data:data},	
		success: function(result){
			$('#dashboard-label-2').html(result[3]);
		}
	});		
	
	var data = [action, " teach_no FROM teacher ", " WHERE ((teach_status = '1' AND teach_teacher = '1') AND teach_no NOT IN (SELECT class_user_name FROM class WHERE class_sy = '.<?php echo $_SESSION['current_sy'];?>.'))", ""];
	$.ajax({
		type: 'POST',
		url: 'schmgmt/acadcurr/action.php',
		data: {data:data},	
		success: function(result){
			$('#dashboard-label-3').html(result[3]);
		}
	});	
	
	var dashboardLabel2 = parseInt($('#dashboard-label-2').html());
	var dashboardLabel3 = parseInt($('#dashboard-label-3').html());
	var dashboardLabel4 = dashboardLabel2 - dashboardLabel3;
	$('#dashboard-label-4').html(dashboardLabel4);
}


function showAction(actionType, list_id){
	var action = 'showAction';

	if(actionType == 'modifyOffering'){
		var data = [action, actionType, list_id];
		$.ajax({
			type: 'POST',
			url: 'schmgmt/acadoffer/action.php',
			data: {data:data},	
			success: function(result){	
				$('#form-input').html(result);
				$('#delete').attr('disabled', 'disabled');
			}
		});	
		
	} 
}

function submitAction(actionType){
	var action = 'submitAction';
	
	if(actionType == 'modifyOffering'){
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
		
	} 
	
	return result;
}
</script>	