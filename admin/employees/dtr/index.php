	<div class="content-wrapper">
	
		<section class="content-header">
			<div class="container">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>DTR	 Management</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="?p=my"><i class="fas fa-home"></i></a></li>
							<li class="breadcrumb-item"><a href="?p=employees">Employees</a></li>
							<li class="breadcrumb-item active">DTR Management</li>
						</ol>
					</div>
				</div>
			</div>
		</section>

		<section class="content">
			<div class="container">
				<div class="card">
					<div class="card-body">
					<div class="row">
						<div class="col-md-9">
						</div>
						<div class="col-md-3">
							<select class="form-control" onchange="changeActiveMonthYear();" name="dtr_monthyear" id="dtr_monthyear">
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="custom-content-below-currentLogs-tab" data-toggle="pill" href="#custom-content-below-currentLogs" role="tab" aria-controls="custom-content-below-currentLogs" aria-selected="true">Current Logs</a>
								</li>	
								<li class="nav-item">
									<a class="nav-link " id="custom-content-below-missingLogs-tab" data-toggle="pill" href="#custom-content-below-missingLogs" role="tab" aria-controls="custom-content-below-missingLogs" aria-selected="true">Missing Logs</a>
								</li>	
							</ul>
							<div class="tab-content" id="custom-content-below-tabContent">
								<div class="tab-pane fade show active" id="custom-content-below-currentLogs" role="tabpanel" aria-labelledby="custom-content-below-currentLogs-tab">
									<br>
									<div class="row">
										<div class="col-md-5">
											<select class="form-control" onchange="getLogs('1');" name="dtr_employees" id="dtr_employees">
											</select>
										</div>
										<div class="col-md-7">											
										</div>
									</div>
									<br>
									<div class="card card-default">
										<div class="card-header">
											<h3 class="card-title" id="dtr-monthyear1">{dtr-monthyear1}</h3>
											<a href="javascript:void(0);" class="float-right" title="Print DTR" id="print-dtr">
												<i class="fas fa-print"></i>
											</a>
										</div>
										<div class="card-body table-responsive p-0">
											<small>
											<table class="table table-hover">
												<thead>
													<tr>
														<th width="6%">#</th>
														<th>Name</th>
														<th width="8%">Date</th>
														<th width="5%">Day</th>
														<th width="10%">Time Stamp</th>
														<th width="6%">State</th>
														<th width="9%">Source</th>
														<th width="30%">Remarks</th>
													</tr>
												</thead>
												<tbody id="dtr-currentLogs">
												</tbody>
											</table>
											</small>
										</div>
									</div>
								</div>
								<div class="tab-pane fade show" id="custom-content-below-missingLogs" role="tabpanel" aria-labelledby="custom-content-below-missingLogs-tab">
									<br>
									<div class="row">
										<div class="col-md-5">
											<select class="form-control" onchange="getMissingLogs('1');" name="dtr_employees2" id="dtr_employees2">
											</select>
										</div>
										<div class="col-md-4">	
										</div>
										<div class="col-md-3">	
											<select class="form-control" onchange="getMissingLogs('1');" name="dtr_missingLogs_filter" id="dtr_missingLogs_filter">
												<option value="0">Pending applications</option>
												<option value="1">Approved applications</option>
												<option value="-1">Disapproved applications</option>
												<option value="%">All applications</option>
											</select>
										</div>
									</div>
									<br>
									<div class="card card-default">
										<div class="card-header">
											<h3 class="card-title" id="dtr-monthyear2">{dtr-monthyear2}</h3>
										</div>
										<div class="card-body table-responsive p-0">
											<small>
											<table class="table table-hover">
												<thead>
													<tr>
														<th width="6%">#</th>	
														<th>Name</th>
														<th width="8%">Date</th>
														<th width="10%">Time Stamp</th>
														<th width="6%">State</th>																			
														<th width="10%">Applied</th>
														<th width="20%">Reason/Remarks</th>
														<th width="7%">Status</th>
														<th width="5%"></th>
													</tr>
												</thead>
												<tbody id="dtr-missingLogs">
												</tbody>
											</table>
											</small>
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
				<button type="submit" class="btn btn-info" name="submit" id="submit"></button>
				</form>	
			</div>			
		</div>
	</div>
</div>
	
<script type="text/javascript">	
var monthYearString;
var month;
var year;
var id;

setTimeout(function(){preLoad();}, 1);

setTimeout(function(){
	$(function(){
		$('#modal-input').on('show.bs.modal', function(e){
			var actionType = $(e.relatedTarget).attr('data-type');
			var actionTitle = $(e.relatedTarget).attr('title');
			var id = $(e.relatedTarget).attr('rowID');
			var userFunc = '';
			
			if(actionType == 'processApplication'){
				$('#modal-size').addClass('modal-md');
				$('#modal-title').html(actionTitle+' #<span id="list-id">'+id+'</span>');
				$('#submit').html('Update');
				userFunc = "return confirm('Process application?') ? submitAction('"+actionType+"') : false;";
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
		url: 'employees/dtr/action.php',
		data: {data:data},	
		success: function(result){
			$('#dtr_monthyear').html(result);
			changeActiveMonthYear();
		}
	});
}

function loadEmployees(){
	var action = 'loadEmployees';
	
	var data = [action, 1];	
	$.ajax({
		type: 'POST',
		url: 'employees/dtr/action.php',
		data: {data:data},	
		success: function(result){
			$('#dtr_employees').html(result);
			$('#dtr_employees2').html(result);
		}
	});	
}

function changeActiveMonthYear(){
	monthYearString = $('#dtr_monthyear').val();
	year = monthYearString.substr(0,4);
	month = monthYearString.substr(4,2);
	id = $('#dtr_employees').val();
	
	var action = 'getMonth';
	
	var data = [action, month];
	$.ajax({
		type: 'POST',
		url: 'employees/dtr/action.php',
		data: {data:data},	
		success: function(result){
			$('#print-dtr').attr('onclick', "window.open('../reports/pdf_dtr.php?id="+id+"&year="+year+"&month="+month+"', 'newwindow', 'width=850, height=550'); return false;");
			$('#dtr-monthyear1').html('Current Logs for '+result[0]+', '+year);
			$('#dtr-monthyear2').html('Missing Logs for '+result[0]+', '+year);
			getLogs('0');
			getMissingLogs('0');
		}
	});
}

function getLogs(state){
	var action = 'getLogs';
	var USERID = $('#dtr_employees').val();
	id = $('#dtr_employees').val();
	
	var data;
	
	if(state == 0){
		data = [action, year, month, USERID, " AND USERID LIKE '"+USERID+"'", " ORDER BY CHECKTIME DESC LIMIT 50"];
	} else {
		data = [action, year, month, USERID, " AND USERID LIKE '"+USERID+"'", " ORDER BY CHECKTIME ASC"];
	}
	$.ajax({
		type: 'POST',
		url: 'employees/dtr/action.php',
		data: {data:data},	
		success: function(result){
			$('#dtr-currentLogs').html(result);
			$('#print-dtr').attr('onclick', "window.open('../reports/pdf_dtr.php?id="+id+"&year="+year+"&month="+month+"', 'newwindow', 'width=850, height=550'); return false;");
		}
	});	
}

function getMissingLogs(state){
	var action = 'getMissingLogs';
	var ml_userid = $('#dtr_employees2').val();
	var dtr_missingLogs_filter = $('#dtr_missingLogs_filter').val();
	var option;
	
	if(dtr_missingLogs_filter == '%'){
		option = " AND ml_approve_user_no LIKE '%' ";
	} else if (dtr_missingLogs_filter == '1'){
		option = " AND ml_approve_user_no > '0' ";
	} else if (dtr_missingLogs_filter == '-1'){
		option = " AND ml_approve_user_no < '0' ";
	} else if (dtr_missingLogs_filter == '0'){
		option = " AND ml_approve_user_no = '0' ";
	}
	
	var data;
	
	if(state == 0){
		data = [action, year, month, ml_userid, " AND ml_userid LIKE '"+ml_userid+"' "+option+"", " ORDER BY ml_checkdate ASC LIMIT 50"];
	} else {
		data = [action, year, month, ml_userid, " AND ml_userid LIKE '"+ml_userid+"' "+option+"", " ORDER BY ml_checkdate ASC "];
	}
	$.ajax({
		type: 'POST',
		url: 'employees/dtr/action.php',
		data: {data:data},	
		success: function(result){
			$('#dtr-missingLogs').html(result);
		}
	});	
}

function showAction(actionType, list_id){
	var action = 'showAction';
	
	if(actionType == 'processApplication'){
		var data = [action, actionType, list_id];
	}	
		
	$.ajax({
		type: 'POST',
		url: 'employees/dtr/action.php',
		data: {data:data},	
		success: function(result){
			$('#form-input').html(result);
		}
	});	
}

function submitAction(actionType){
	var action = 'submitAction';
	var list_id = $('#list-id').html();
	
	if(actionType == 'processApplication'){
		var ml_reason = $('#ml_reason').val();
		var ml_approve_user_no = $('input[name=ml_approve_user_no]:checked', '#form').val()		
		var ml_remarks = $('#ml_remarks').val();
		
		var data = [action, actionType, list_id, ml_reason, ml_approve_user_no, ml_remarks];
		if(data[4] == null){
			toastr.error('Invalid approval value.');
		} else if (data[5] == ''){
			toastr.error('Invalid remarks.');
		} else {
			$('#close1').attr('disabled', 'disabled');
			$('#close2').attr('disabled', 'disabled');
			$('#submit').attr('disabled', 'disabled');
			$('#submit').html('Validating...');
			
			$.ajax({
				type: 'POST',
				url: 'employees/dtr/action.php',
				data: {data:data},	
				success: function(result){
					if(result[0] == 1){
						setTimeout(function(){$('#submit').html('Processing...');}, 500);
						setTimeout(function(){$('#submit').html('Update');}, 1000);
						setTimeout(function(){toastr.success(result[1]);}, 1000);
						setTimeout(function(){getApplication();}, 1000);
						setTimeout(function(){$('#modal-input').modal('hide');}, 1500);	
						getMissingLogs('1');
						
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
	}	
}

function getApplication(){
	var action = 'getApplication';
	var list_id = $('#list-id').html();
	
	var data = [action, '', list_id]
	$.ajax({
		type: 'POST',
		url: 'employees/dtr/action.php',
		data: {data:data},	
		success: function(result){
			if(result[2].ml_approve_user_no > 0){
				saveToLogs(list_id, result[2].ml_userid, result[2].ml_checkdate, result[2].ml_checktime, result[2].ml_checktype);
			}
		}
	});		
	
}

function saveToLogs(ml_no, ml_userid, ml_checkdate, ml_checktime, ml_checktype){
	var action = 'saveToLogs';
	
	var data = [action, ml_no, ml_userid, ml_checkdate, ml_checktime, ml_checktype];
	$.ajax({
		type: 'POST',
		url: 'employees/dtr/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				toastr.success(result[1]);
			} else {
				toastr.error(result[1]);
			}
		}
	});		
}
</script>

