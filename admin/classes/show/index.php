<?php
/*
 * Academics Visible Page
 *
 * This page is used to display a class based on the value of the GET variable in the URL. 
 * @author    	Fernando B. Enad
 * @license    	Public
 */
?>		<div class="content-wrapper">
		
			<section class="content-header">
				<div class="container">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1>Class</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="?p=my"><i class="fas fa-home"></i></a></li>
								<li class="breadcrumb-item"><a href="?p=classes">Classes</a></li>
								<li class="breadcrumb-item active">Class</li>
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
									<?php 
									if($_SESSION['eosy'] == true){
									?>
									<br>
									<div class="row bg-default">
										<div class="col-md-12">
											<div class="callout callout-info">
												<h5><i class="fas fa-info"></i> Note:</h5>
												<small>
												<p><strong>EOSY Updating</strong> is now open.</p>
												<p>Update only the enrolment status of learners who have been:</p>
												<ol>
													<li> retained in their current grade/year level </li>
													<li> no longer in school </li>
													<li> conditionally promoted </li>
												</ol>
												<p>(Refer to Section IV of DepEd Order No. 23, s.2017).</p>
												<p>Commit by clicking Finalize button that will appear once all EOSY enrolment conditions are met.</p>
												</small>
											</div>
										</div>
									</div>
									<?php
									}
									?>
									<br>
									<div class="row">
										<div class="col-md-8">
											<h1>Masterlist</h1>
										</div>
										<div class="col-md-4" >
											<span id="section_name"></span>
											<select class="form-control" onchange="changeAdvisory();" id="academics-myadvisories" title="Click to select section.">
											</select>
										</div>
									</div>
									<br>
									<div class="card card-default">
										<div class="card-header">
											<h3 class="card-title">Overview</h3>
											<div class="card-tools">
												<div class="btn-group">
													<button type="button" class="btn btn-tool dropdown-toggle bg-white" data-toggle="dropdown">Class Options</button>
													<div class="dropdown-menu dropdown-menu-right bg-white" role="menu">
														<a href="#" title="Display School Forms" class="dropdown-item" rowID="'.$row['enrol_no'].'"
															data-type="displaySchoolForms" data-toggle="modal" data-target="#modal-classForms" data-backdrop="static" 
															data-keyboard="false">School Forms
														</a>
														<div class="dropdown-divider"></div>
														<a href="#" title="Input Monthly Attendance" class="dropdown-item" rowID="'.$row['enrol_no'].'"
															data-type="inputAttendance" data-toggle="modal" data-target="#modal-inputForms" data-backdrop="static" 
															data-keyboard="false">Monthly Attendance
														</a>
														<a href="#" title="Input Core Values" class="dropdown-item" rowID="'.$row['enrol_no'].'"
															data-type="inputCoreValues" data-toggle="modal" data-target="#modal-inputForms" data-backdrop="static" 
															data-keyboard="false">Core Values
														</a>
														<!--
														<a href="#" title="Input Anecdotal Records" class="dropdown-item" rowID="'.$row['enrol_no'].'"
															data-type="inputAnecdotalRecords" data-toggle="modal" data-target="#modal-inputForms" data-backdrop="static" 
															data-keyboard="false">Anecdotal Records
														</a>
														-->
													</div>
												</div>
											</div>
										</div> 
										<div class="card-body p-0">
											<ul class="nav flex-column">
												<li class="nav-item" id="class-data">
												</li>
												<li class="nav-item" id="class-current">
												</li>
												<li class="nav-item" id="class-eosy">
												</li>
												<li class="nav-item" id="class-cu">
													<a href="javascript:void(0);" class="nav-link" onclick="showCU();">
													  Summary <span class="float-right badge bg-info" id="class-cu-count">{class-cu-count}</span>
													</a>
												</li>
												<li class="nav-item" id="class-to">
													<a href="javascript:void(0);" class="nav-link" onclick="showTO();">
													  Transferred out <span class="float-right badge bg-info" id="class-to-count">{class-to-count}</span>
													</a>
												</li>
												<!--
												<li class="nav-item" id="class-do">
													<a href="javascript:void(0);" class="nav-link" onclick="showDO();">
													  Dropped out <span class="float-right badge bg-info" id="class-do-count">{class-do-count}</span>
													</a>
												</li>
												-->
												<li class="nav-item" id="class-nls">
													<a href="javascript:void(0);" class="nav-link" onclick="showNLS();">
													  <span id="nls-label">No longer in school</span> <span class="float-right badge bg-info" id="class-nls-count">{class-nls-count}</span>
													</a>
												</li>
												<!--
												<li class="nav-item" id="class-rp">
													<a href="javascript:void(0);" class="nav-link" onclick="showRP();">
													  Repeater <span class="float-right badge bg-info" id="class-rp-count">{class-rp-count}</span>
													</a>
												</li>
												-->
											</ul>
										</div>
									</div>
									
									<div class="card card-default">
										<div class="card-header">
											<h3 class="card-title">Enrollment</h3>
										</div>
										<div class="card-body p-0">
											<div class="table-responsive" id="academics-myadvisory-enrollment">
												<table class="table table-bordered table-hover table-condensed table-striped" border="0">
													<thead>
														<tr style="line-height: 15px">
															<th width="5%">#</th>
															<th>Learner</th>
															<th width="7%">Gender</th>
															<th width="10%">Date of first Attendance</th>
															<th width="15%">Status <span class="float-right badge badge-info">GenAve</span></th>
															<th width="10%"></th>
														</tr>		
													</thead>
													<tbody id="section-list">
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

			</section>
		</div>


<div class="modal fade" id="modal-inputGrades">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">x</h4>
				<span id="class_no"></span> 
				<span id="level"></span>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form role="form" id="form1" method="post" onSubmit="return false;">
				<div class="card">
					<div class="card-body table-responsive p-0" id="grade-submit">
					</div>			
				</div>					
			</div>			
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary" name="submit" id="submit" onClick="return confirm('Are you sure?') ? submitGrades() : false;">Submit Grades</button>
				</form>	
			</div>			
		</div>
	</div>
</div>

<div class="modal fade" id="modal-updateStatus">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title2">Update Status (#<span id="enrollment-id">{enrollment-id}</span>)</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form role="form" id="form2" method="post" onSubmit="return false;">	
				<div id="status-submit">
			
				</div>	
			</div>	
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary" name="submit2" id="submit2" onClick="return confirm('Are you sure?') ? updateStatus() : false;">Update</button>
				</form>	
			</div>			
		</div>
	</div>
</div>


<div class="modal fade" id="modal-classForms">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title3">School Forms/Reports</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form role="form" id="form3" method="post" onSubmit="return false;">	
				<div id="class-forms">
			
				</div>	
			</div>			
			<div class="modal-footer">
				<!--<button type="button" class="btn btn-default" id="refresh3" onclick="getClassForms();"><i class="fas fa-recycle"></i></button>-->
				<button type="button" class="btn btn-default float-right" data-dismiss="modal">Close</button>
				</form>	
			</div>			
		</div>
	</div>
</div>

<div class="modal fade" id="modal-inputForms">
	<div class="modal-dialog modal-sm" id="modal-inputForms-size">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title4"></h4>
				<span id="section-id"></span>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form role="form" id="form4" method="post" onSubmit="return false;">	
				<div id="class-inputForms">
				</div>
			</div>			
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<!--<button type="button" class="btn btn-default" id="refresh4" onclick="showAction('inputAttendance');"><i class="fas fa-recycle"></i></button>-->
				<button type="submit" class="btn btn-primary" name="submit4" id="submit4">Update</button>
				</form>	
			</div>			
		</div>
	</div>
</div>

<script type="text/javascript">	
var id = <?php echo $_SESSION['user_no'];?>;
var currentSY = <?php echo $_GET['sy'];?>;
var currentSem = <?php echo $_SESSION['current_sem'];?>;
var sid = <?php echo $_GET['show'];?>;
var sname = 0;
var level = 0;
var sy = 0;
	
setTimeout(function(){preLoad();}, 1);

setTimeout(function(){
	$(function(){
		$('#modal-inputGrades').on('show.bs.modal', function(e){
			var rowId = $(e.relatedTarget).attr('rowID');
			$('#class_no').html(rowId);
			$('#class_no').hide();
			$('#level').hide();
			getClassInfo(rowId);						
			
		});
		
		$('#modal-inputGrades').on('hidden.bs.modal', function(){
			$('#form1').trigger('reset');
			$('#level').html('');
			$('#class_no').html('');
			$('#submit').removeAttr('disabled');
			document.getElementById('submit').innerHTML = 'Submit Grades';
			rowId = 0; 
		});
	});
}, 1);

setTimeout(function(){
	$(function(){
		$('#modal-updateStatus').on('show.bs.modal', function(e){
			var rowId = $(e.relatedTarget).attr('rowID');		
			$('#enrollment-id').html(rowId);
			$('#submit2').attr('disabled', 'disabled');
			getEnrollmentStatus(rowId);
			
		});
		
		$('#modal-updateStatus').on('hidden.bs.modal', function(){	
			$('#form2').trigger('reset');
			$('#enrollment-id').html('');
			$('#currentStatus').html('');
			$('#submit2').removeAttr('disabled');
			rowId = 0; 
		});
	});
}, 1);

setTimeout(function(){
	$(function(){
		$('#modal-classForms').on('show.bs.modal', function(e){
			$('#refresh3').hide();
			getClassForms();
		});
		
		$('#modal-classForms').on('hidden.bs.modal', function(){	
			$('#form3').trigger('reset');
		});
	});
}, 1);

setTimeout(function(){
	$(function(){
		$('#modal-inputForms').on('show.bs.modal', function(e){
			var type = $(e.relatedTarget).attr('data-type');
			var userFunc;
			if(type == 'inputAttendance'){
				$('#modal-inputForms-size').removeClass('modal-sm');
				$('#modal-inputForms-size').addClass('modal-xl');
				$('.modal-title4').html('Input Attendance');
				$('#refresh4').hide();
				userFunc = "return confirm('Are you sure?') ? inputAction('inputAttendance') : false;";
			} else if(type == 'inputCoreValues'){
				$('#modal-inputForms-size').removeClass('modal-sm');
				$('#modal-inputForms-size').addClass('modal-lg');
				$('.modal-title4').html('Input Core Values');
				userFunc = "return confirm('Are you sure?') ? inputAction('inputCoreValues') : false;";
			} else if(type == 'inputAnecdotalRecords'){
				$('#modal-inputForms-size').removeClass('modal-sm');
				$('#modal-inputForms-size').addClass('modal-lg');
				$('.modal-title4').html('Input Anecdotal Records');
				userFunc = "return confirm('Are you sure?') ? inputAction('inputAnecdotalRecords') : false;";
			}
			showAction(type);
			$('#section-id').html(sid);
			$('#section-id').hide();
			$('#submit4').attr('onclick', userFunc);
		});
		
		$('#modal-inputForms').on('hidden.bs.modal', function(){
			$('#modal-inputForms-size').removeClass('modal-xs');
			$('#modal-inputForms-size').removeClass('modal-sm');
			$('#modal-inputForms-size').removeClass('modal-md');
			$('#modal-inputForms-size').removeClass('modal-lg');
			$('#modal-inputForms-size').removeClass('modal-xl');
			$('#modal-inputForms-size').addClass('modal-sm');
			$('#section-id').html('');
			$('#submit4').attr('onclick', '');
			$('#form4').trigger('reset');
		});
	});
}, 1);

function preLoad(){
	getAdvisory();
	getClassData();
	getClassCurrent();
	getClassEOSY();
	
}

function getClassData(){
	var action = 'getClassData';
	var data = [action];
	
	$.ajax({
		type: 'POST',
		url: 'classes/show/action.php',
		data: {data:data},	
		success: function(result){
			$('#class-data').html(result);
		}
	});		
}

function getClassCurrent(){
	var action = 'getClassCurrent';
	var data = [action];
	
	$.ajax({
		type: 'POST',
		url: 'classes/show/action.php',
		data: {data:data},	
		success: function(result){
			$('#class-current').html(result);
		}
	});		
}

function getClassEOSY(){
	var action = 'getClassEOSY';
	var data = [action];
	
	$.ajax({
		type: 'POST',
		url: 'classes/show/action.php',
		data: {data:data},	
		success: function(result){
			$('#class-eosy').html(result);
		}
	});		
}

function getAdvisory(){
	var action = 'getAdvisory';
	var data = [action, currentSY];
	
	$.ajax({
		type: 'POST',
		url: 'classes/show/action.php',
		data: {data:data},	
		success: function(result){
			$('#academics-myadvisories').html(result);
			$('#academics-myadvisories').val(sid);
			getSectionInfo(sid);
		}
	});
}

function changeAdvisory(){
	sid = $('#academics-myadvisories').val();
	window.location = '?p=classes&show='+sid+'&sy='+currentSY;
	//getSectionInfo(sid);
}

function getSectionInfo(sid){
	var action = 'getSectionInfo';
	var data = [action, sid];
	
	$.ajax({
		type: 'POST',
		url: 'classes/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				var classAdviser = result[2].teach_lname+', '+result[2].teach_fname+' '+result[2].teach_xname+' '+ (result[2].teach_mname == '-' ? '' : result[2].teach_mname.substring(0,1)+'.');
				var classLabel = '';
				
				$('#class-cu').hide();
				$('#class-to').removeClass('bg-secondary');
				$('#class-do').removeClass('bg-secondary');
				$('#class-nls').removeClass('bg-secondary');
				$('#class-rp').removeClass('bg-secondary');
				classLabel = 'Grade '+result[2].section_level+' - '+result[2].section_name+' / SY '+result[2].section_sy+'-'+(parseInt(result[2].section_sy)+1);
				
				setTimeout(function(){
					$('#class-adviser').html(classAdviser);
					$('#class-label').html(classLabel);
				}, 100);
				
				sname = result[2].section_name;
				level = result[2].section_level;
				sy = result[2].section_sy;
				
				if(result[2].section_status == 0){
					$('#class-dropped-out').hide();
					$('#class-finalize-label').hide();			
					$('#class-finalize').show();
					$('#nls-label').html('No longer in school');
				} else {
					$('#class-dropped-out').show();
					$('#nls-label').html('Dropped out');
					$('#class-finalize').hide();
					var date = new Date(result[2].section_updatedate);
					$('#class-finalize-label').html('<font color="green"><i class="fas fa-check"></i> Finalized '+parseInt(date.getMonth()+1)+'/'+date.getDate()+'/'+date.getFullYear()+'</font>');
					$('#class-finalize-label').show();	
				}

				getSectionStatistics(sid, sname, sy);	
				getSectionList(sid, sname, level, sy, " AND (enrol_status1 = 'ENROLLED' OR enrol_status1 = 'PROMOTED') ");				
			} else {
				toastr.error(result[1]+'');
			}
		}
	});	
}

function getSectionStatistics(sid, sname, sy){
	var action = 'getSectionStatistics';
	var data = [action, sid, sname, sy, '%'," AND (enrol_status1 = 'ENROLLED' OR enrol_status1 = 'PROMOTED') "];	
	$.ajax({
		type: 'POST',
		url: 'classes/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1 || result[0] == 0){
				$('#class-total-all').html(result[3] == null ? '0' : result[3]);
				$('#class-cu-count').html(result[3] == null ? '0' : result[3]);
			} else {
				toastr.error(result[1]+'');
			}
		}
	});	

	var data = [action, sid, sname, sy, 'MALE', " AND (enrol_status1 = 'ENROLLED' OR enrol_status1 = 'PROMOTED') "];	
	$.ajax({
		type: 'POST',
		url: 'classes/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1 || result[0] == 0){
				$('#class-male-count').html(result[3] == null ? '0' : result[3]);
			} else {
				toastr.error(result[1]+'');
			}
		}
	});	
	
	var data = [action, sid, sname, sy, 'FEMALE', " AND (enrol_status1 = 'ENROLLED' OR enrol_status1 = 'PROMOTED') "];	
	$.ajax({
		type: 'POST',
		url: 'classes/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1 || result[0] == 0){
				$('#class-female-count').html(result[3] == null ? '0' : result[3]);
			} else {
				toastr.error(result[1]+'');
			}
		}
	});
	
	var data = [action, sid, sname, sy, 'MALE', " AND (enrol_status1 = 'ENROLLED' OR enrol_status1 = 'PROMOTED') AND (enrol_ti = '1') "];	
	$.ajax({
		type: 'POST',
		url: 'classes/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1 || result[0] == 0){
				$('#class-ti-m').html(result[3] == null ? '0' : result[3]);
			} else {
				toastr.error(result[1]+'');
			}
		}
	});
	
	var data = [action, sid, sname, sy, 'FEMALE', " AND (enrol_status1 = 'ENROLLED' OR enrol_status1 = 'PROMOTED') AND (enrol_ti = '1') "];	
	$.ajax({
		type: 'POST',
		url: 'classes/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1 || result[0] == 0){
				$('#class-ti-f').html(result[3] == null ? '0' : result[3]);
			} else {
				toastr.error(result[1]+'');
			}
		}
	});
	
	var data = [action, sid, sname, sy, '%', " AND (enrol_status1 = 'ENROLLED' OR enrol_status1 = 'PROMOTED') AND (enrol_ti = '1') "];	
	$.ajax({
		type: 'POST',
		url: 'classes/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1 || result[0] == 0){
				$('#class-ti-t').html(result[3] == null ? '0' : result[3]);
			} else {
				toastr.error(result[1]+'');
			}
		}
	});
	
	$('#class-ba-m').html(0);
	$('#class-ba-f').html(0);
	$('#class-ba-t').html(0);
	
	$('#class-rp-m').html(0);
	$('#class-rp-f').html(0);
	$('#class-rp-t').html(0);

	var data = [action, sid, sname, sy, 'MALE', " AND (enrol_status1 = 'ENROLLED' OR enrol_status1 = 'PROMOTED') AND (stud_cct != 'NO') "];	
	$.ajax({
		type: 'POST',
		url: 'classes/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1 || result[0] == 0){
				$('#class-cct-m').html(result[3] == null ? '0' : result[3]);
			} else {
				toastr.error(result[1]+'');
			}
		}
	});
	
	var data = [action, sid, sname, sy, 'FEMALE', " AND (enrol_status1 = 'ENROLLED' OR enrol_status1 = 'PROMOTED') AND (stud_cct != 'NO') "];	
	$.ajax({
		type: 'POST',
		url: 'classes/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1 || result[0] == 0){
				$('#class-cct-f').html(result[3] == null ? '0' : result[3]);
			} else {
				toastr.error(result[1]+'');
			}
		}
	});
	
	var data = [action, sid, sname, sy, '%', " AND (enrol_status1 = 'ENROLLED' OR enrol_status1 = 'PROMOTED') AND (stud_cct != 'NO') "];	
	$.ajax({
		type: 'POST',
		url: 'classes/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1 || result[0] == 0){
				$('#class-cct-t').html(result[3] == null ? '0' : result[3]);
			} else {
				toastr.error(result[1]+'');
			}
		}
	});
	
	$('#class-al-m').html(0);
	$('#class-al-f').html(0);
	$('#class-al-t').html(0);
	
	$('#class-ad-m').html(0);
	$('#class-ad-f').html(0);
	$('#class-ad-t').html(0);
	
	var data = [action, sid, sname, sy, 'MALE', " AND (enrol_status1 = 'ENROLLED') "];	
	$.ajax({
		type: 'POST',
		url: 'classes/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1 || result[0] == 0){
				$('#class-ns-m').html(result[3] == null ? '0' : result[3]);
			} else {
				toastr.error(result[1]+'');
			}
		}
	});
	
	var data = [action, sid, sname, sy, 'FEMALE', " AND (enrol_status1 = 'ENROLLED') "];	
	$.ajax({
		type: 'POST',
		url: 'classes/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1 || result[0] == 0){
				$('#class-ns-f').html(result[3] == null ? '0' : result[3]);
			} else {
				toastr.error(result[1]+'');
			}
		}
	});
	
	var data = [action, sid, sname, sy, '%', " AND (enrol_status1 = 'ENROLLED') "];	
	$.ajax({
		type: 'POST',
		url: 'classes/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1 || result[0] == 0){
				$('#class-ns-t').html(result[3] == null ? '0' : result[3]);
			} else {
				toastr.error(result[1]+'');
			}
		}
	});
	
	var data = [action, sid, sname, sy, 'MALE', " AND (enrol_status2 = 'PROMOTED' OR enrol_status2 = 'GRADUATED') "];	
	$.ajax({
		type: 'POST',
		url: 'classes/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1 || result[0] == 0){
				$('#class-pr-m').html(result[3] == null ? '0' : result[3]);
			} else {
				toastr.error(result[1]+'');
			}
		}
	});
	
	var data = [action, sid, sname, sy, 'FEMALE', " AND (enrol_status2 = 'PROMOTED'  OR enrol_status2 = 'GRADUATED') "];	
	$.ajax({
		type: 'POST',
		url: 'classes/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1 || result[0] == 0){
				$('#class-pr-f').html(result[3] == null ? '0' : result[3]);
			} else {
				toastr.error(result[1]+'');
			}
		}
	});
	
	var data = [action, sid, sname, sy, '%', " AND (enrol_status2 = 'PROMOTED'  OR enrol_status2 = 'GRADUATED') "];	
	$.ajax({
		type: 'POST',
		url: 'classes/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1 || result[0] == 0){
				$('#class-pr-t').html(result[3] == null ? '0' : result[3]);
			} else {
				toastr.error(result[1]+'');
			}
		}
	});
	
	var data = [action, sid, sname, sy, 'MALE', " AND (enrol_status2 = 'IRREGULAR') "];	
	$.ajax({
		type: 'POST',
		url: 'classes/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1 || result[0] == 0){
				$('#class-cp-m').html(result[3] == null ? '0' : result[3]);
			} else {
				toastr.error(result[1]+'');
			}
		}
	});
	
	var data = [action, sid, sname, sy, 'FEMALE', " AND (enrol_status2 = 'IRREGULAR') "];	
	$.ajax({
		type: 'POST',
		url: 'classes/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1 || result[0] == 0){
				$('#class-cp-f').html(result[3] == null ? '0' : result[3]);
			} else {
				toastr.error(result[1]+'');
			}
		}
	});
	
	var data = [action, sid, sname, sy, '%', " AND (enrol_status2 = 'IRREGULAR') "];	
	$.ajax({
		type: 'POST',
		url: 'classes/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1 || result[0] == 0){
				$('#class-cp-t').html(result[3] == null ? '0' : result[3]);
			} else {
				toastr.error(result[1]+'');
			}
		}
	});
	
	var data = [action, sid, sname, sy, 'MALE', " AND (enrol_status2 = 'RETAINED') "];	
	$.ajax({
		type: 'POST',
		url: 'classes/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1 || result[0] == 0){
				$('#class-rt-m').html(result[3] == null ? '0' : result[3]);
			} else {
				toastr.error(result[1]+'');
			}
		}
	});
	
	var data = [action, sid, sname, sy, 'FEMALE', " AND (enrol_status2 = 'RETAINED') "];	
	$.ajax({
		type: 'POST',
		url: 'classes/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1 || result[0] == 0){
				$('#class-rt-f').html(result[3] == null ? '0' : result[3]);
			} else {
				toastr.error(result[1]+'');
			}
		}
	});
	
	var data = [action, sid, sname, sy, '%', " AND (enrol_status2 = 'RETAINED') "];	
	$.ajax({
		type: 'POST',
		url: 'classes/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1 || result[0] == 0){
				$('#class-rt-t').html(result[3] == null ? '0' : result[3]);
			} else {
				toastr.error(result[1]+'');
			}
		}
	});	
	
	var data = [action, sid, sname, sy, 'MALE', " AND (enrol_status2 = 'TRANSFERRED OUT') "];	
	$.ajax({
		type: 'POST',
		url: 'classes/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1 || result[0] == 0){
				$('#class-to-m').html(result[3] == null ? '0' : result[3]);
			} else {
				toastr.error(result[1]+'');
			}
		}
	});
	
	var data = [action, sid, sname, sy, 'FEMALE', " AND (enrol_status2 = 'TRANSFERRED OUT') "];	
	$.ajax({
		type: 'POST',
		url: 'classes/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1 || result[0] == 0){
				$('#class-to-f').html(result[3] == null ? '0' : result[3]);
			} else {
				toastr.error(result[1]+'');
			}
		}
	});
	
	var data = [action, sid, sname, sy, '%', " AND (enrol_status2 = 'TRANSFERRED OUT') "];	
	$.ajax({
		type: 'POST',
		url: 'classes/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1 || result[0] == 0){
				$('#class-to-t').html(result[3] == null ? '0' : result[3]);
				$('#class-to-count').html(result[3] == null ? '0' : result[3]);
			} else {
				toastr.error(result[1]+'');
			}
		}
	});	
	
	var data = [action, sid, sname, sy, 'MALE', " AND (enrol_status2 = 'DROPPED OUT') "];	
	$.ajax({
		type: 'POST',
		url: 'classes/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1 || result[0] == 0){
				$('#class-do-m').html(result[3] == null ? '0' : result[3]);
			} else {
				toastr.error(result[1]+'');
			}
		}
	});
	
	var data = [action, sid, sname, sy, 'FEMALE', " AND (enrol_status2 = 'DROPPED OUT') "];	
	$.ajax({
		type: 'POST',
		url: 'classes/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1 || result[0] == 0){
				$('#class-do-f').html(result[3] == null ? '0' : result[3]);
			} else {
				toastr.error(result[1]+'');
			}
		}
	});
	
	$('#class-do-count').html(0);
	
	var data = [action, sid, sname, sy, '%', " AND (enrol_status2 = 'DROPPED OUT') "];	
	$.ajax({
		type: 'POST',
		url: 'classes/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1 || result[0] == 0){
				$('#class-do-t').html(result[3] == null ? '0' : result[3]);
				$('#class-nls-count').html(result[3] == null ? '0' : result[3]);
			} else {
				toastr.error(result[1]+'');
			}
		}
	});	
		
	$('#class-rp-count').html(0);	
}

function getSectionList(sid, sname, level, sy, type){
	var action = 'getSectionList';
	var data = [action, sid, sname, level, '%', sy, type];

	$.ajax({
		type: 'POST',
		url: 'classes/show/action.php',
		data: {data:data},	
		success: function(result){
			$('#section-list').html(result);	
		}
	});	
}

function showCU(){
	$('#class-cu').hide();
	$('#class-to').removeClass('bg-secondary');
	$('#class-do').removeClass('bg-secondary');
	$('#class-nls').removeClass('bg-secondary');
	$('#class-rp').removeClass('bg-secondary');
	getSectionList(sid, sname, level, sy, " AND (enrol_status1 = 'ENROLLED' OR enrol_status1 = 'PROMOTED') ");
}

function showTO(){
	$('#class-cu').show();
	$('#class-to').addClass('bg-secondary');
	$('#class-do').removeClass('bg-secondary');
	$('#class-nls').removeClass('bg-secondary');
	$('#class-rp').removeClass('bg-secondary');
	getSectionList(sid, sname, level, sy, " AND (enrol_status2 = 'TRANSFERRED OUT') ");
}

function showDO(){
	$('#class-cu').show();
	$('#class-to').removeClass('bg-secondary');
	$('#class-do').addClass('bg-secondary');
	$('#class-nls').removeClass('bg-secondary');
	$('#class-rp').removeClass('bg-secondary');
	getSectionList(sid, sname, level, sy, " AND (enrol_status2 = 'DROPPED OUT') ");
}

function showNLS(){
	$('#class-cu').show();
	$('#class-to').removeClass('bg-secondary');
	$('#class-do').removeClass('bg-secondary');
	$('#class-nls').addClass('bg-secondary');
	$('#class-rp').removeClass('bg-secondary');
	getSectionList(sid, sname, level, sy, " AND (enrol_status2 = 'DROPPED OUT') ");
}

function showRP(){
	$('#class-cu').show();
	$('#class-to').removeClass('bg-secondary');
	$('#class-do').removeClass('bg-secondary');
	$('#class-nls').removeClass('bg-secondary');
	$('#class-rp').addClass('bg-secondary');
	getSectionList(sid, sname, level, sy, " AND (enrol_status2 = 'REPEATER') ");
}

function getEnrollmentStatus(eid){
	var action = 'getEnrollmentStatus';
	var data = [action, eid];
	
	$.ajax({
		type: 'POST',
		url: 'classes/show/action.php',
		data: {data:data},	
		success: function(result){
			$('#status-submit').html(result);
			$('#currentStatus').hide();
			if($('#currentStatus').html() == 'PROMOTED'){
				$('#enrol_status1').append('<option value="PROMOTED">EOSY update</option>');
			} 
			$('#enrol_status1').val($('#currentStatus').html()).change();
		}
	});	
}

function changeForms(){
	var action = 'changeForms';
	var enrol_status1 = $('#enrol_status1').val();
	var eid = $('#enrollment-id').html();
	var data = [action, eid, enrol_status1];
	
	$.ajax({
		type: 'POST',
		url: 'classes/show/action.php',
		data: {data:data},	
		success: function(result){
			if($('#currentStatus').html() == 'ENROLLED'){
				if($('#currentStatus').html() != enrol_status1){
					$('#submit2').removeAttr('disabled');
				} else {
					$('#submit2').attr('disabled', 'disabled');
				}
				$('#enrol_status1').removeAttr('disabled');
			} else {
				$('#submit2').attr('disabled', 'disabled');
				$('#enrol_status1').attr('disabled', 'disabled');
			}
			
			$('#status-forms').html(result);	
			$('#enrol_eligibility').hide();	
		}
	});	
}

function updateStatus(){
	var action = 'updateStatus';
	var enrol_no = $('#enrol_no').val();
	var enrol_eligibility = $('#enrol_eligibility').val();
	var enrol_status1 = $('#enrol_status1').val();
	var enrol_status2 = $('#enrol_status2').val();
	var enrol_remarks = $('#enrol_remarks').val();
	var enrol_average = $('#enrol_average').val();
	var enrol_graddate = $('#enrol_graddate').val();
	var enrol_gradawards = $('#enrol_gradawards').val();
	var data = [action, enrol_no, enrol_eligibility, enrol_status1, enrol_status2, enrol_remarks, enrol_average, enrol_graddate, enrol_gradawards, id];
	
	$('#submit2').attr('disabled', 'disabled');
	document.getElementById('submit2').innerHTML = 'Updating...';
	
	if(sanitizeForm2() == true){
		$.ajax({
			type: 'POST',
			url: 'classes/show/action.php',
			data: {data:data},	
			success: function(result){				
				if(result[0] == 1){
					toastr.success(result[1]+'');
					setTimeout(function(){$('#modal-updateStatus').modal('hide');}, 1000);
					// getAdvisory();
					getSectionInfo($('#academics-myadvisories').val());
				} else {
					toastr.error(result[1]+'');
				}
				
				setTimeout(function(){document.getElementById('submit2').innerHTML = result[1];}, 1000);
				setTimeout(function(){document.getElementById('submit2').innerHTML = 'Update';}, 2000);
				//setTimeout(function(){$('#submit2').removeAttr('disabled');}, 3000);
			}
		});
	} else {
		setTimeout(function(){document.getElementById('submit2').innerHTML = 'Update';}, 1000);
		$('#submit2').removeAttr('disabled');
	}
}

function sanitizeForm2(){
	var upperLimit = Date.parse('<?php echo $_SESSION['today_date'];?>');
	var lowerLimit = Date.parse('<?php echo $_SESSION['bosy_date'];?>');
	var enrol_graddate = Date.parse($('#enrol_graddate').val());
	var enrol_average = $('#enrol_average').val();
	var success = false;
	
	if(enrol_graddate > upperLimit) {
		toastr.error('Effective date cannot be beyond today.');
		success = false;
	} else if(enrol_graddate < lowerLimit) {
		toastr.error('Effective date cannot be before BOSY date.');
		success = false;
	} else if(enrol_average == ""){
		toastr.error('Missing grade(s) found.');
		success = false;
	} else {
		success = true;
	}
	
	return(success);
}

function finalize(){
	var classSize = parseInt($('#class-total-all').html());
	var classUpdated = parseInt($('#class-pr-t').html()) + parseInt($('#class-cp-t').html()) + parseInt($('#class-rt-t').html());
	
	if(classSize == classUpdated){
		var action = 'finalizeSection';
		var data = [action, sid, sname];
		
		$.ajax({
			type: 'POST',
			url: 'classes/show/action.php',
			data: {data:data},	
			success: function(result){
				if(result[0] == 1){
					toastr.success(result[1]+'');
					getSectionInfo(sid);	
				} else {
					toastr.error(result[1]+'');
				}
				
			}
		});	
	} else {
		toastr.error('Update all students\' status first.');
	}
}

function getClassForms(){
	var action = 'getClassForms';
	var data = [action, sid, level];
	
	$.ajax({
		type: 'POST',
		url: '../employee/academics/action.php',
		data: {data:data},	
		success: function(result){
			$('#class-forms').html(result);
		}
	});
}

function showAction(actionType){
	var action = 'showAction';
	var data = [action, sid, actionType];
	
	$.ajax({
		type: 'POST',
		url: 'classes/show/action.php',
		data: {data:data},	
		success: function(result){
			$('#class-inputForms').html(result);
		}
	});
}

function inputAction(actionType){
	if(actionType == "inputAttendance"){
		var action = actionType;
		var min, max;
		var success = true;
		
		var sch_no = new Array();
		$('input[name^="sch_no"]').each(function() { sch_no.push($(this).val()); });
		
		min = Date.parse('<?php echo $_SESSION['bosy_date'];?>');
		max = Date.parse('<?php echo $_SESSION['today_date'];?>');
		var sch_firstday = new Array();
		$('input[name^="sch_firstday"]').each(function() { sanitizeForm4(Date.parse($(this).val()), min, max) == true ? sch_firstday.push($(this).val()) : success = false; });
		
		max = parseInt($('#sch_m1_max').html());
		var sch_m1 = new Array();
		$('input[name^="sch_m1[]"]').each(function() { sanitizeForm4($(this).val(), 0, max) == true ? sch_m1.push($(this).val()) : success = false; });
		
		max = parseInt($('#sch_m2_max').html());
		var sch_m2 = new Array();
		$('input[name^="sch_m2"]').each(function() { sanitizeForm4($(this).val(), 0, max) == true ? sch_m2.push($(this).val()) : success = false; });
		
		max = parseInt($('#sch_m3_max').html());
		var sch_m3 = new Array();
		$('input[name^="sch_m3"]').each(function() { sanitizeForm4($(this).val(), 0, max) == true ? sch_m3.push($(this).val()) : success = false; });
		
		max = parseInt($('#sch_m4_max').html());
		var sch_m4 = new Array();
		$('input[name^="sch_m4"]').each(function() { sanitizeForm4($(this).val(), 0, max) == true ? sch_m4.push($(this).val()) : success = false; });
		
		max = parseInt($('#sch_m5_max').html());
		var sch_m5 = new Array();
		$('input[name^="sch_m5"]').each(function() { sanitizeForm4($(this).val(), 0, max) == true ? sch_m5.push($(this).val()) : success = false; });
		
		max = parseInt($('#sch_m6_max').html());
		var sch_m6 = new Array();
		$('input[name^="sch_m6"]').each(function() { sanitizeForm4($(this).val(), 0, max) == true ? sch_m6.push($(this).val()) : success = false; });
		
		max = parseInt($('#sch_m7_max').html());
		var sch_m7 = new Array();
		$('input[name^="sch_m7"]').each(function() { sanitizeForm4($(this).val(), 0, max) == true ? sch_m7.push($(this).val()) : success = false; });
		
		max = parseInt($('#sch_m8_max').html());
		var sch_m8 = new Array();
		$('input[name^="sch_m8"]').each(function() { sanitizeForm4($(this).val(), 0, max) == true ? sch_m8.push($(this).val()) : success = false; });
		
		max = parseInt($('#sch_m9_max').html());
		var sch_m9 = new Array();
		$('input[name^="sch_m9"]').each(function() { sanitizeForm4($(this).val(), 0, max) == true ? sch_m9.push($(this).val()) : success = false; });
		
		max = parseInt($('#sch_m10_max').html());
		var sch_m10 = new Array();
		$('input[name^="sch_m10"]').each(function() { sanitizeForm4($(this).val(), 0, max) == true ? sch_m10.push($(this).val()) : success = false; });
		
		max = parseInt($('#sch_m11_max').html());
		var sch_m11 = new Array();
		$('input[name^="sch_m11"]').each(function() { sanitizeForm4($(this).val(), 0, max) == true ? sch_m11.push($(this).val()) : success = false; });
		
		max = parseInt($('#sch_m12_max').html());
		var sch_m12 = new Array();
		$('input[name^="sch_m12"]').each(function() { sanitizeForm4($(this).val(), 0, max) == true ? sch_m12.push($(this).val()) : success = false; });
		
		var data = [action, sch_no, sch_firstday, sch_m1, sch_m2, sch_m3, sch_m4, sch_m5, sch_m6, sch_m7, sch_m8, sch_m9, sch_m10, sch_m11, sch_m12];	
		
		if(success == true){
			$('#submit4').attr('disabled', 'disabled');
			document.getElementById('submit4').innerHTML = 'Updating...';
		
			$.ajax({
				type: 'POST',
				url: 'classes/show/action.php',
				data: {data:data},	
				success: function(result){
					if(result[0] == 1){
						toastr.success(result[1]+'');
						showAction(actionType)
					} else {
						toastr.error(result[1]+'');
					}
					
					setTimeout(function(){document.getElementById('submit4').innerHTML = result[1];}, 1000);
					setTimeout(function(){document.getElementById('submit4').innerHTML = 'Update';}, 2000);
					setTimeout(function(){$('#submit4').removeAttr('disabled');}, 3000);
				}
			});
		} else {
			toastr.error('Input value is out of the limits.');
		}
		
	} else if(actionType == "inputCoreValues"){
		var cvid = $('#coreval_no').val();
		var action = actionType; 
				
		var q1q1 = $('#coreval_q1q1').val();
		var q1q2 = $('#coreval_q1q2').val();
		var q1q3 = $('#coreval_q1q3').val();
		var q1q4 = $('#coreval_q1q4').val();
		var q1 = [q1q1, q1q2, q1q3, q1q4];
		
		var q2q1 = $('#coreval_q2q1').val();
		var q2q2 = $('#coreval_q2q2').val();
		var q2q3 = $('#coreval_q2q3').val();
		var q2q4 = $('#coreval_q2q4').val();
		var q2 = [q2q1, q2q2, q2q3, q2q4];
		
		var q3q1 = $('#coreval_q3q1').val();
		var q3q2 = $('#coreval_q3q2').val();
		var q3q3 = $('#coreval_q3q3').val();
		var q3q4 = $('#coreval_q3q4').val();
		var q3 = [q3q1, q3q2, q3q3, q3q4];
		
		var q4q1 = $('#coreval_q4q1').val();
		var q4q2 = $('#coreval_q4q2').val();
		var q4q3 = $('#coreval_q4q3').val();
		var q4q4 = $('#coreval_q4q4').val();
		var q4 = [q4q1, q4q2, q4q3, q4q4];
		
		var q5q1 = $('#coreval_q5q1').val();
		var q5q2 = $('#coreval_q5q2').val();
		var q5q3 = $('#coreval_q5q3').val();
		var q5q4 = $('#coreval_q5q4').val();
		var q5 = [q5q1, q5q2, q5q3, q5q4];
		
		var q6q1 = $('#coreval_q6q1').val();
		var q6q2 = $('#coreval_q6q2').val();
		var q6q3 = $('#coreval_q6q3').val();
		var q6q4 = $('#coreval_q6q4').val();
		var q6 = [q6q1, q6q2, q6q3, q6q4];
		
		var q7q1 = $('#coreval_q7q1').val();
		var q7q2 = $('#coreval_q7q2').val();
		var q7q3 = $('#coreval_q7q3').val();
		var q7q4 = $('#coreval_q7q4').val();
		var q7 = [q7q1, q7q2, q7q3, q7q4];
		
		var data = [action, cvid, q1, q2, q3, q4, q5, q6, q7];
			
		if(cvid != null){
			$('#submit4').attr('disabled', 'disabled');
			document.getElementById('submit4').innerHTML = 'Updating...';
			
			$.ajax({
				type: 'POST',
				url: 'classes/show/action.php',
				data: {data:data},	
				success: function(result){
					if(result[0] == 1){
						toastr.success(result[1]+'');
					} else {
						toastr.error(result[1]+'');
					}
					
					setTimeout(function(){document.getElementById('submit4').innerHTML = result[1];}, 1000);
					setTimeout(function(){document.getElementById('submit4').innerHTML = 'Update';}, 2000);
					setTimeout(function(){$('#submit4').removeAttr('disabled');}, 3000);
				}
			});
		} else {
			toastr.error('Select a student to continue.');
		}
	} else if(actionType == "inputAnecdotalRecords"){
		
	}
}

function sanitizeForm4(value, min, max){
	var success = true;
	
	if(value < min || value > max){
		success = false;
	}
	
	return success;
}

function showStudent(actionType){
	var action = 'showStudent';
	var lid = $('#stud_no').val();
	var data = [action, lid, sy, actionType];
	
	if(lid != ''){
		$.ajax({
			type: 'POST',
			url: 'classes/show/action.php',
			data: {data:data},	
			success: function(result){
				$('#class-inputForms2').html(result);
			}
		});
	} else {
		$('#class-inputForms2').html('');
	}
}

function enrolLearner(){
	window.location = '?p=admissions&section='+<?php echo $_GET['show'];?>;
}
</script>