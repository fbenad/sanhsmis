	<div class="content-wrapper">
	
		<section class="content-header">
			<div class="container">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>New Employee</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="?p=my"><i class="fas fa-home"></i></a></li>
							<li class="breadcrumb-item"><a href="?p=employees">Employees</a></li>
							<li class="breadcrumb-item active">New Employee</li>
						</ol>
					</div>
				</div>
			</div>
		</section>

		<section class="content">
			<div class="container">
				<form role="form" id="form" method="post" onSubmit="return false;">	
				<div class="row" id="entity-new-part1">
				</div>
				<div class="row" id="entity-new-part2">		
				</div>
				</form>
			</div>
		</section>
	</div>		
	
<script type="text/javascript">	
setTimeout(function(){preLoad();}, 1);

function preLoad(){
	var part = <?php echo (isset($_GET['part']) ? $_GET['part'] : 1);?>;
	
	if(part == 1){
		getPart1();
	} else if(part == 2){
		getPart2();
	} else{
		window.location = "?p=employees";
	}
}

function getPart1(){
	var action = 'getPart1';

	var data = [action];
	$.ajax({
		type: 'POST',
		url: 'employees/show/action.php',
		data: {data:data},	
		success: function(result){
			$('#entity-new-part1').html(result);
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
		var data = [action, firstname, lastname];
		$.ajax({
			type: 'POST',
			url: 'employees/show/action.php',
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
		url: 'employees/show/action.php',
		data: {data:data},	
		success: function(result){
			window.location = '?p=employees&new&part=2';
		}
	});		
}

function getPart2(){
	var action = 'getPart2';
	$('#entity-new-part1').hide();

	var data = [action];
	$.ajax({
		type: 'POST',
		url: 'employees/show/action.php',
		data: {data:data},	
		success: function(result){
			$('#entity-new-part2').html(result);
			supplyUsername();
		}
	});	
}

function cancelSearch(){
	var action = 'cancelSearch';

	var data = [action];
	$.ajax({
		type: 'POST',
		url: 'employees/show/action.php',
		data: {data:data},	
		success: function(result){
			window.location = "?p=employees";
		}
	});		
}

function saveEntity(){
	var action = 'saveEntity';
	var teach_id = $('#teach_id').val();
	var teach_fname = $('#teach_fname').val();
	var teach_mname = $('#teach_mname').val();
	var teach_lname = $('#teach_lname').val();
	var teach_xname = $('#teach_xname').val();
	var teach_gender = $('#teach_gender').val();
	var teach_bdate = $('#teach_bdate').val();
	var teach_residence = $('#teach_residence').val();
	var teach_cstatus = $('#teach_cstatus').val();
	var teach_dialect = $('#teach_dialect').val();
	var teach_ethnicity = $('#teach_ethnicity').val();
	var teach_tin = $('#teach_tin').val();
	var teach_bio_no = $('#teach_bio_no').val();
	var teach_teacher = $('#teach_teacher').val();
	var teach_status = $('#teach_status').val();
	var teacherappointments_position = $('#teacherappointments_position').val();
	var teacherappointments_item_no = $('#teacherappointments_item_no').val();
	var teacherappointments_date = $('#teacherappointments_date').val();
	var teacherappointments_fdaydate = $('#teacherappointments_fdaydate').val();
	var teacherappointments_status = $('#teacherappointments_status').val();
	var teacherappointments_funding = $('#teacherappointments_funding').val();
	var teacherappointments_active = $('#teacherappointments_active').val();
	var user_fullname = $('#user_fullname').val();
	var user_name = $('#user_name').val();
	var user_pass = $('#user_pass').val();

	var data = [action, teach_id, teach_fname, teach_mname, teach_lname, teach_xname, teach_gender, teach_bdate, teach_residence, 
		teach_cstatus, teach_dialect, teach_ethnicity, teach_tin, teach_bio_no, teach_teacher, teach_status,
		teacherappointments_position, teacherappointments_item_no, teacherappointments_date, 
		teacherappointments_fdaydate, teacherappointments_status, teacherappointments_funding, 
		teacherappointments_active, user_fullname, user_name, user_pass];
		
	if(sanitizeSaveEntity(data) == true){
		$('#btnCancel').attr('disabled', 'disabled');
		$('#btnSubmit').attr('disabled', 'disabled');
		$('#btnSubmit').html('Validating...');
		
		$.ajax({
			type: 'POST',
			url: 'employees/show/action.php',
			data: {data:data},	
			success: function(result){
				if(result[0] == 1){
					addAppointment(data, result[2]);
					addUserAccess(data, result[2]);
					setTimeout(function(){$('#btnSubmit').html('Saving...');}, 500);
					setTimeout(function(){$('#btnSubmit').html('Submit');}, 1000);
					setTimeout(function(){toastr.success(result[1]);}, 2000);
					setTimeout(function(){window.location = '?p=employees&show='+result[2];}, 3000);
				} else {
					setTimeout(function(){$('#btnSubmit').html('Submit');}, 500);
					setTimeout(function(){$('#btnSubmit').removeAttr('disabled', 'disabled');}, 500);
					setTimeout(function(){$('#btncancel').removeAttr('disabled', 'disabled');}, 500);
					setTimeout(function(){toastr.error(result[1]);}, 500);
				}
			}
		});		
	} else {
		// error handling handled by the sanitizeSaveEntity() function
	}

}

function sanitizeSaveEntity(data){
	var result = true;

	if(data[1] == '' || data[1] < 100000 || data[1] > 999999999){
		result = false;
		toastr.error('Invalid employee number.');
	} else if(data[6] == ''){
		result = false;
		toastr.error('Invalid gender.');
	} else if(data[7] == '' || Date.parse(data[7]) < Date.parse('<?php echo date('Y-m-d', strtotime('-50 years'));?>') || Date.parse(data[7]) > Date.parse('<?php echo date('Y-m-d', strtotime('-18 years'));?>')){
		result = false;
		toastr.error('Invalid birth date.');
	} else if(data[8] == '' || data[8].length < 3){
		result = false;
		toastr.error('Invalid residence.');
	} else if(data[9] == ''){
		result = false;
		toastr.error('Invalid civil status.');
	} else if(data[10] == '' || data[10].length < 11){
		result = false;
		toastr.error('Invalid phone number.');
	} else if(data[11] == '' || data[10].length < 3){
		result = false;
		toastr.error('Invalid email.');
	} else if(data[12] == '' || data[12] < 100000000 || data[12] > 999999999){
		result = false;
		toastr.error('Invalid TIN.');
	} else if(data[13] == '' || data[13] < 1 || data[13] > 10000){
		result = false;
		toastr.error('Invalid fingeprint no.');
	} else if(data[15] == ''){
		result = false;
		toastr.error('Invalid appointment type.');
	} else if(data[16] == ''){
		result = false;
		toastr.error('Invalid position.');
	} else if(data[17] == '' || data[17].length < 3 || data[17].length > 50){
		result = false;
		toastr.error('Invalid item number.');
	} else if(data[18] == '' || Date.parse(data[18]) < Date.parse('<?php echo date('Y-m-d', strtotime('-1 month'));?>') || Date.parse(data[18]) > Date.parse('<?php echo date('Y-m-d');?>')){
		result = false;
		toastr.error('Invalid appointment date.');
	} else if(data[19] == '' || Date.parse(data[19]) < Date.parse('<?php echo date('Y-m-d', strtotime('-1 month'));?>') || Date.parse(data[19]) > Date.parse('<?php echo date('Y-m-d');?>')){
		result = false;
		toastr.error('Invalid first day.');
	} else if(data[20] == ''){
		result = false;
		toastr.error('Invalid apppointment status.');
	} else if(data[21] == ''){
		result = false;
		toastr.error('Invalid funding value.');
	} else if(data[24	] == ''){
		result = false;
		toastr.error('Invalid username.');
	} 
	
	return result;
}

function supplyUsername(){
	var action = 'checkUsername';
	var teach_fname = $('#teach_fname').val();
	var teach_lname = $('#teach_lname').val();	
	var user_name = teach_fname+'.'+teach_lname;
	 $('#user_name').val(user_name);	
	
	var data = [action, user_name];
	$.ajax({
		type: 'POST',
		url: 'employees/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				toastr.error('Username already taken. Append any single digit to make it unique.');
				$('#user_name').addClass('is-invalid');
				$('#btnSubmit').attr('disabled',  'disabled');
			} else {
				$('#user_name').removeClass('is-invalid');
				$('#btnSubmit').removeAttr('disabled',  'disabled');
			}
		}
	});	
}

function checkUsername(){
	var action = 'checkUsername';
	var user_name = $('#user_name').val();
	
	var data = [action, user_name];
	$.ajax({
		type: 'POST',
		url: 'employees/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				toastr.error('Username already taken.');
				$('#user_name').addClass('is-invalid');
				$('#btnSubmit').attr('disabled',  'disabled');
			} else {
				$('#user_name').removeClass('is-invalid');
				$('#btnSubmit').removeAttr('disabled',  'disabled');
			}
		}
	});	
}

function supplyFullname(){
	var action = 'supplyFullname';
	var teach_fname = $('#teach_fname').val();
	var teach_mname = $('#teach_mname').val();
	var teach_lname = $('#teach_lname').val();
	var teach_xname = $('#teach_xname').val();
	var user_fullname = teach_fname+' '+teach_mname.substr(0, 1)+'. '+teach_lname+(teach_xname == '' ? '' : ', '+teach_xname);
	user_fullname = user_fullname.toUpperCase();
	
	$('#user_fullname').val(user_fullname);
}


function addAppointment(data, teacherappointments_teach_no){
	var action = 'addAppointment';
	
	var data = [action, teacherappointments_teach_no, data[16], data[17], data[18], data[19], data[20], data[21], data[22]];
	$.ajax({
		type: 'POST',
		url: 'employees/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				toastr.success('Appointment added.');
			} else {
				toastr.success(result[1]);
			}
		}
	});		
}

function addUserAccess(data, user_no){
	var action = 'addUserAccess';
	
	var data = [action, user_no, data[23], data[24], data[25]];
	$.ajax({
		type: 'POST',
		url: 'employees/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				toastr.success('User access added.');
			} else {
				toastr.success(result[1]);
			}
		}
	});			
}

function checkTeachID(){
	var action = 'checkEntity';
	var teach_id = $('#teach_id').val();
	
	var data = [action, " teach_id LIKE '"+teach_id+"' "];
	$.ajax({
		type: 'POST',
		url: 'employees/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				toastr.error('Teacher ID already used.');
				$('#teach_id').addClass('is-invalid');
				$('#btnSubmit').attr('disabled',  'disabled');
				
			} else {
				$('#teach_id').removeClass('is-invalid');
				$('#btnSubmit').removeAttr('disabled',  'disabled');
			}
		}
	});	
}

function checkBiometricID(){
	var action = 'checkEntity';
	var teach_bio_no = $('#teach_bio_no').val();
	
	var data = [action, " teach_bio_no LIKE '"+teach_bio_no+"' "];
	$.ajax({
		type: 'POST',
		url: 'employees/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				toastr.error('Biometric ID already used.');
				$('#teach_bio_no').addClass('is-invalid');
				$('#btnSubmit').attr('disabled',  'disabled');
				
			} else {
				$('#teach_bio_no').removeClass('is-invalid');
				$('#btnSubmit').removeAttr('disabled',  'disabled');
			}
		}
	});	
}

function checkPhone(){
	var action = 'checkEntity';
	var teach_dialect = $('#teach_dialect').val();
	
	var data = [action, " teach_dialect LIKE '"+teach_dialect+"' "];
	$.ajax({
		type: 'POST',
		url: 'employees/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				toastr.error('Phone already used.');
				$('#teach_dialect').addClass('is-invalid');
				$('#btnSubmit').attr('disabled',  'disabled');
				
			} else {
				$('#teach_dialect').removeClass('is-invalid');
				$('#btnSubmit').removeAttr('disabled',  'disabled');
			}
		}
	});		
}

function checkEmail(){
	var action = 'checkEntity';
	var teach_ethnicity = $('#teach_ethnicity').val();
	
	var data = [action, " teach_ethnicity LIKE '"+teach_ethnicity+"' "];
	$.ajax({
		type: 'POST',
		url: 'employees/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				toastr.error('Email already used.');
				$('#teach_ethnicity').addClass('is-invalid');
				$('#btnSubmit').attr('disabled',  'disabled');
				
			} else {
				$('#teach_ethnicity').removeClass('is-invalid');
				$('#btnSubmit').removeAttr('disabled',  'disabled');
			}
		}
	});		
}

function checkTIN(){
	var action = 'checkEntity';
	var teach_tin = $('#teach_tin').val();
	
	var data = [action, " teach_tin LIKE '"+teach_tin+"' "];
	$.ajax({
		type: 'POST',
		url: 'employees/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				toastr.error('TIN already used.');
				$('#teach_tin').addClass('is-invalid');
				$('#btnSubmit').attr('disabled',  'disabled');
				
			} else {
				$('#teach_tin').removeClass('is-invalid');
				$('#btnSubmit').removeAttr('disabled',  'disabled');
			}
		}
	});		
}

function updatePosition(){
	var action = 'updatePosition';
	var teach_teacher = $('#teach_teacher').val();
	
	var data = [action, teach_teacher];
	$.ajax({
		type: 'POST',
		url: 'employees/show/action.php',
		data: {data:data},	
		success: function(result){
			$('#teacherappointments_position').html(result);
		}
	});		
}
</script>	

