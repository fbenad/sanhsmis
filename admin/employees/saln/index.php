	<div class="content-wrapper">
	
		<section class="content-header">
			<div class="container">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>SALN Management</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="?p=my"><i class="fas fa-home"></i></a></li>
							<li class="breadcrumb-item"><a href="?p=employees">Employees</a></li>
							<li class="breadcrumb-item active">SALNS</li>
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
							<span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
							<div class="info-box-content">
								<span class="info-box-text">Total Employees</span>
								<span class="info-box-number" id="dashboard-label-1">0</span>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="info-box">
							<span class="info-box-icon bg-danger elevation-1"><i class="fas fa-user-tie"></i></span>
							<div class="info-box-content">
								<span class="info-box-text">Expected Employees</span>
								<span class="info-box-number" id="dashboard-label-2">0</span>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="info-box">
							<span class="info-box-icon bg-success elevation-1"><i class="fas fa-thumbs-up"></i></span>
							<div class="info-box-content">
								<span class="info-box-text">Compliant</span>
								<span class="info-box-number" id="dashboard-label-3">0</span>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="info-box">
							<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-thumbs-down"></i></span>
							<div class="info-box-content">
								<span class="info-box-text">Non-compliant</span>
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
									<div class="input-group input-group-sm" style="width: 580px;">
										<select class="form-control" id="teachSaln_teach_no" name="teachSaln_teach_no" onchange="loadTeacherList();">
										</select>
										<select class="form-control" id="teachSaln_issueyear" name="teachSaln_issueyear" onchange="loadList();">
										</select>
									</div>
								</div>
							</div>
							<div class="card-body table-responsive p-0">
								<small>
								<table class="table table-hover">
									<thead>
										<tr>
											<th width="5%">#</th>
											<th>Name</th>
											<th width="13%">Filing Type</th>
											<th width="13%">Net Worth (Php)</th>
											<th width="15%">Last Update</th>
											<th width="13%">Status</th>
											<th width="10%"></th>
										</tr>
									</thead>
									<tbody id="saln-list">
									</tbody>
								</table>
								</small>
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
			var actionTitle = $(e.relatedTarget).attr('title');
			var id = $(e.relatedTarget).attr('rowID');
			var userFunc;
			
			if(actionType == 'addSubjects'){
				$('#modal-size').addClass('modal-md');
				$('#modal-title').html(actionTitle);
				$('#submit').html('Submit');
				userFunc = "return confirm('Save family?') ? submitAction('"+actionType+"') : false;";
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
	loadSYs();
	loadEmployees();
}

function loadSYs(){
	var action = 'loadSYs';
	
	var data = [action];	
	$.ajax({
		type: 'POST',
		url: 'employees/saln/action.php',
		data: {data:data},	
		success: function(result){
			$('#teachSaln_issueyear').html(result);
			loadList();
			loadCounts();
		}
	});	
}

function loadEmployees(){
	var action = 'loadEmployees';
	
	var data = [action];	
	$.ajax({
		type: 'POST',
		url: 'employees/saln/action.php',
		data: {data:data},	
		success: function(result){
			$('#teachSaln_teach_no').html(result);
		}
	});	
}

function loadList(){
	var action = 'loadList';
	var teachSaln_issueyear = $('#teachSaln_issueyear').val();
	var data = [action, teachSaln_issueyear];	
	$.ajax({
		type: 'POST',
		url: 'employees/saln/action.php',
		data: {data:data},	
		success: function(result){
			$('#saln-list').html(result);
		}
	});	
}

function loadTeacherList(){
	var action = 'loadTeacherList';
	var teachSaln_teach_no = $('#teachSaln_teach_no').val();
	
	var data = [action, teachSaln_teach_no];
	$.ajax({
		type: 'POST',
		url: 'employees/saln/action.php',
		data: {data:data},	
		success: function(result){
			$('#saln-list').html(result);
		}
	});	
}

function loadCounts(){
	var action = 'loadCounts';
	var teachSaln_issueyear = $('#teachSaln_issueyear').val();

	var data = [action, "teacher", " teach_status = '1' "];
	$.ajax({
		type: 'POST',
		url: 'employees/saln/action.php',
		data: {data:data},	
		success: function(result){
			$('#dashboard-label-1').html(result[3]);
		}
	});	
	
	var data = [action, "teacher INNER JOIN teacherappointments ON teach_no = teacherappointments_teach_no", 
		" teacherappointments_status = 'REGULAR-PERMANENT' AND teacherappointments_funding = 'NATIONAL' AND teach_status = '1' AND teacherappointments_active = '1' "];
	$.ajax({
		type: 'POST',
		url: 'employees/saln/action.php',
		data: {data:data},	
		success: function(result){
			$('#dashboard-label-2').html(result[3]);
		}
	});	
	
	var data = [action, "teacher INNER JOIN teacherappointments ON teach_no = teacherappointments_teach_no INNER JOIN teachsaln ON teach_no = teachSaln_teach_no", 
		" teacherappointments_status = 'REGULAR-PERMANENT' AND teacherappointments_funding = 'NATIONAL' AND teach_status = '1' AND teacherappointments_active = '1' AND teachSaln_issueyear = '"+teachSaln_issueyear+"' AND teachSaln_status = '3' "];
	$.ajax({
		type: 'POST',
		url: 'employees/saln/action.php',
		data: {data:data},	
		success: function(result){
			$('#dashboard-label-3').html(result[3]);
		}
	});
	
	setTimeout(function(){
		var expected = parseInt($('#dashboard-label-2').html());
		var compliant = parseInt($('#dashboard-label-3').html());
		var noncompliant = expected - compliant;
		$('#dashboard-label-4').html(noncompliant);
	}, 200);
}

function revertSALNStatus(teachSaln_no){
	var action = 'revertSALNStatus';
	
	var data = [action, teachSaln_no];
	$.ajax({
		type: 'POST',
		url: 'employees/saln/action.php',
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
	
}
</script>	