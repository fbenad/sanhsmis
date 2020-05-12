	<div class="content-wrapper">
	
		<section class="content-header">
			<div class="container">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Admissions</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="?p=my"><i class="fas fa-home"></i></a></li>
							<li class="breadcrumb-item"><a href="?p=classes">Classes</a></li>
							<li class="breadcrumb-item active">Admission</li>
						</ol>
					</div>
				</div>
			</div>
		</section>

		<section class="content">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div id="admissions-p1">	
						</div>
						<div id="admissions-p2">	
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>		
	
<script type="text/javascript">	
var stud_no = <?php echo (isset($_GET['enrol']) ? $_GET['enrol'] : 0);?>;
var section_no = <?php echo (isset($_GET['section']) ? $_GET['section'] : 0);?>;
var current_sy = <?php echo $_SESSION['current_sy'];?>;
var current_sem = <?php echo $_SESSION['current_sem'];?>;
var currentCurrYear = <?php echo $_SESSION['current_currYear'];?>;
	
setTimeout(function(){preLoad();}, 1);

function preLoad(){
	var part = <?php echo (isset($_GET['enrol']) ? $_GET['enrol'] : 1);?>;
	
	if(part == 1){
		getPart1();
	} else{
		if(modacc_role == 1 || user_role == 1){
			getPart2B();
		} else {
			getPart2();
		}
	}
}


function getPart1(){
	var action = 'getPart1';
	
	var data = [action, stud_no, section_no, current_sy];
	$.ajax({
		type: 'POST',
		url: 'classes/admissions/action.php',
		data: {data:data},	
		success: function(result){
			$('#admissions-p1').html(result);
			$('#entity-new-part1-search-result').hide();
		}
	});	
}

function searchEntity(){
	var action = 'searchEntity';
	var firstname = $('#firstname').val();
	var lastname = $('#lastname').val();
	 
	if(firstname == ''){
		// error handling done by form defaults
	} else if(lastname == ''){
		// error handling done by form defaults
	} else {
		var data = [action, firstname, lastname, section_no];
		$.ajax({
			type: 'POST',
			url: 'classes/admissions/action.php',
			data: {data:data},	
			success: function(result){
				$('#entity-new-part1-search-result').show();
				$('#entity-search-result').html(result);
				$('#entity-search-count').html(result);
			}
		});	
	}	
}

function gotoNext(){
	var action = 'gotoNext';
	var firstname = $('#firstname').val();
	var lastname = $('#lastname').val();	
	
	var data = [action, firstname, lastname];
	$.ajax({
		type: 'POST',
		url: 'students/show/action.php',
		data: {data:data},	
		success: function(result){
			window.location = '?p=students&new&part=2';
		}
	});		
}

function getPart2(){
	var action = 'getPart2';
	$('#entity-new-part1').hide();

	var data = [action, stud_no, section_no, current_sy];
	$.ajax({
		type: 'POST',
		url: 'classes/admissions/action.php',
		data: {data:data},	
		success: function(result){
			$('#admissions-p2').html(result);
			getStudentInformation(stud_no);
			getCurrentEnrollment(stud_no);
		}
	});	
}

function getPart2B(){
	var action = 'getPart2B';
	$('#entity-new-part1').hide();

	var data = [action, stud_no, section_no, current_sy];
	$.ajax({
		type: 'POST',
		url: 'classes/admissions/action.php',
		data: {data:data},	
		success: function(result){
			$('#admissions-p2').html(result);
			getStudentInformation(stud_no);
			getCurrentEnrollmentB(stud_no);
		}
	});	
}

function cancelSearch(){
	var action = 'cancelSearch';

	var data = [action];
	$.ajax({
		type: 'POST',
		url: 'classes/admissions/action.php',
		data: {data:data},	
		success: function(result){
			window.location = "?p=admissions";
		}
	});		
}

function updateSection(track, option){
	var action = 'updateSection';
	var enrol_level = $('#enrol_level').val();

	var data = [action, enrol_level, track, option];
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
			var condition = 'SHS-'+$('#enrol_track1').val()+'-'+$('#enrol_strand').val();
			updateSection(condition+'%');
		}
	});		
}

function getStudentInformation(stud_no){
	var action = 'getStudentInformation';

	var data = [action, stud_no];
	$.ajax({
		type: 'POST',
		url: 'classes/admissions/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				$('#enrol-lrn').html('<strong><a href="?p=students&modify='+stud_no+'">'+result[2].stud_lrn+'</a></strong>');
				$('#enrol-fullname').html('<strong>'+result[2].stud_lname+', '+result[2].stud_fname+' '+result[2].stud_xname+', '+result[2].stud_mname+'</strong>');
				
			} else {
				$('#enrol-lrn').html('Not found!');
				$('#enrol-fullname').html('Not found!');

			}
		}
	});		
}

function getCurrentEnrollment(stud_no){
	var action = 'getCurrentEnrollment';

	var data = [action, stud_no];
	$.ajax({
		type: 'POST',
		url: 'classes/admissions/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				if(result[2].enrol_status2 == 'PROMOTED' && result[2].enrol_sy == (<?php echo ($_SESSION['current_sy']-1);?>)){
					$('#enrollment-error').hide();
					$('#enrollment-details').show();
					
					var new_level = parseInt(result[2].enrol_level)+1;
					$('#enrol_level').html('<option value="'+new_level+'">Grade '+new_level+'</option>');
					$('#enrol_level').val(new_level).change();
					
					if(new_level > 10 && result[2].enrol_level == 10){
						$('#enrol_track1').val('');
						$('#enrol_strand').val('');
						$('#enrol_combo').val('');
						$('#enrol_track1').removeAttr('disabled');
						$('#enrol_strand').removeAttr('disabled');
						$('#enrol_combo').removeAttr('disabled');
						
						setTimeout(function(){
							var condition = 'SHS-'+$('#enrol_track1').val()+'-'+$('#enrol_strand').val();
							updateSection(condition+'%');
						}, 500);
						
					} else if(new_level > 10){
						$('#enrol_track1').val(result[2].enrol_track).change();
						setTimeout(function(){$('#enrol_strand').val(result[2].enrol_strand).change();}, 300);						
						setTimeout(function(){$('#enrol_combo').val(result[2].enrol_combo);}, 400);			
						
						setTimeout(function(){
							if($('#enrol_combo').val() != result[2].enrol_combo){
								$('#enrol_combo').removeAttr('disabled');
								$('#enrol_combo').val('');
							} else {
								$('#enrol_combo').attr('disabled', 'disabled');
							}
						}, 450);
						
						setTimeout(function(){
							var condition = 'SHS-'+$('#enrol_track1').val()+'-'+$('#enrol_strand').val();
							updateSection(condition+'%', "  AND section_track NOT LIKE 'JHS STE%' ");
						}, 500);
						
					} else {
						$('#enrol_track2').val(result[2].enrol_track);
						
						if($('#enrol_track2').val() == 'JHS STE'){
							$('#enrollment-warning').html('<div class="callout callout-warning"><h5>Enrollment Warning</h5><p>Refer JHS-STE students to the School Registrar.</p></div>');
							$('#btnSubmit').attr('disabled', 'disabled');
							
						} else {
							$('#btnSubmit').removeAttr('disabled');
							
						}
						
						if(new_level > 6 && result[2].enrol_level == 6){
							$('#enrol_track2').val('');
							$('#enrol_track2').removeAttr('disabled');
							
							setTimeout(function(){
								var condition = $('#enrol_track2').val();
								updateSection('%', "  AND section_track NOT LIKE 'JHS STE%' ");
							}, 200);
						}
					}
					
				} else {
					$('#enrollment-error').show();
					$('#enrollment-details').hide();
					$('#btnSubmit').attr('disabled', 'disabled');	
					
				}	
				
			} else {
				$('#enrollment-error').show();
				$('#enrollment-details').hide();
				$('#btnSubmit').attr('disabled', 'disabled');
				
			}
			
			var next_year = parseInt(result[2].enrol_sy)+1;
			$('#status-sy').html(result[2].enrol_sy+'-'+next_year);
			$('#status-level').html(result[2].enrol_level);
			$('#status-section').html(result[2].enrol_section);
			$('#status-track').html(result[2].enrol_track);
			$('#status-eosy').html(result[2].enrol_status2);	
			

		}
	});
	
}

function getCurrentEnrollmentB(stud_no){
	var action = 'getCurrentEnrollment';

	var data = [action, stud_no];
	$.ajax({
		type: 'POST',
		url: 'classes/admissions/action.php',
		data: {data:data},	
		success: function(result){			
			var next_year = parseInt(result[2].enrol_sy)+1;
			$('#status-sy').html(result[2].enrol_sy+'-'+next_year);
			$('#status-level').html(result[2].enrol_level);
			
			if(result[2].enrol_status2 == 'PROMOTED'){
				$('#enrol_level').val(parseInt(result[2].enrol_level)+1).change();
			} else {
				$('#enrol_level').val(result[2].enrol_level).change();
			}
			$('#status-section').html(result[2].enrol_section);
			$('#status-eosy').html(result[2].enrol_status2);	
			
			if(result[2].enrol_sy == current_sy){
				toastr.error('Student is already enrolled.');
				$('#btnSubmit').attr('disabled', 'disabled');
			}
		}
	});		
	
}

function enrollStudent(){
	var action = 'enrollStudent';
	var enrol_gradawards = $('#enrol_gradawards').is(":checked") ? '1' : '0';
	var enrol_ti = $('#enrol_ti').val();
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
	
	var data = [action, current_sy, stud_no, enrol_level, enrol_section, enrol_remarks, enrol_track, enrol_strand, enrol_combo, enrol_ti, enrol_gradawards];
	if(data[3] == ''){
		toastr.error('Invalid grade level.');
	} else if(data[4] == ''){
		toastr.error('Invalid section name.');
	} else if(data[6] == ''){
		toastr.error('Invalid track.');
	} else if(data[7] == ''){
		toastr.error('Invalid strand.');
	} else if(data[8] == ''){
		toastr.error('Invalid combo.');
	} else {
		$('#btnCancel').attr('disabled', 'disabled');
		$('#btnSubmit').attr('disabled', 'disabled');
		$('#btnSubmit').html('Validating...');
		
		$.ajax({
			type: 'POST',
			url: 'classes/admissions/action.php',
			data: {data:data},	
			success: function(result){
				if(result[0] == 1){
					setTimeout(function(){$('#btnSubmit').html('Saving...');}, 500);
					setTimeout(function(){$('#btnSubmit').html('Submit');}, 1000);
					setTimeout(function(){toastr.success(result[1]);}, 1500);
					setTimeout(function(){addSchoolDays(stud_no, current_sy);}, 2000);
					setTimeout(function(){addCoreValues(stud_no, current_sy);}, 2500);
					setTimeout(function(){addSubjects(stud_no, current_sy, current_sem, enrol_level, enrol_section);}, 3000);
					setTimeout(function(){window.location = '?p=students&modify='+stud_no+'&t=schedule';}, 3500);
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

function addSchoolDays(stud_no, current_sy){
	var action = 'addSchoolDays';
	
	var data = [action, stud_no, current_sy];
	$.ajax({
		type: 'POST',
		url: 'classes/admissions/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				toastr.success('School days added.');
			} else{
				toastr.error(result[1]);
			}
		}
	});		
}

function addCoreValues(stud_no, current_sy){
	var action = 'addCoreValues';
	
	var data = [action, stud_no, current_sy];
	$.ajax({
		type: 'POST',
		url: 'classes/admissions/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				toastr.success('Core values added.');
			} else{
				toastr.error(result[1]);
			}
		}
	});		
}

function addSubjects(stud_no, current_sy, current_sem, enrol_level, enrol_section){
	var action = 'addSubjects';
	
	var data = [action, stud_no, current_sy, current_sem, enrol_level, enrol_section];
	$.ajax({
		type: 'POST',
		url: 'classes/admissions/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				toastr.success('Subjects added.');
			} else{
				toastr.error(result[1]);
			}
		}
	});		
}

function requireRemarks(){
	var enrol_ti = $('#enrol_ti').val();

	if(enrol_ti == 1){
		$('#btnSubmit').attr('disabled', 'disabled');
		$('#enrol_remarks').attr('placeholder', 'Previous school name...');
		$('#enrol_remarks').addClass('is-invalid');
		
	} else{
		$('#btnSubmit').removeAttr('disabled');
		$('#enrol_remarks').attr('placeholder', '');
		$('#enrol_remarks').removeClass('is-invalid');
	}
}

function populateRemarks(){
	var enrol_remarks = $('#enrol_remarks').val();
	
	if(enrol_remarks.length < 10){
		// nothing happens
	} else {
		$('#btnSubmit').removeAttr('disabled');
		$('#enrol_remarks').attr('placeholder', '');
		$('#enrol_remarks').removeClass('is-invalid');		
	}
	
}
</script>	