	<div class="content-wrapper">
	
		<section class="content-header">
			<div class="container">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>New Student</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="?p=my"><i class="fas fa-home"></i></a></li>
							<li class="breadcrumb-item"><a href="?p=students">Students</a></li>
							<li class="breadcrumb-item active">New Student</li>
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
		window.location = "?p=student";
	}
}

function getPart1(){
	var action = 'getPart1';

	var data = [action];
	$.ajax({
		type: 'POST',
		url: 'students/show/action.php',
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
			url: 'students/show/action.php',
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

	var data = [action];
	$.ajax({
		type: 'POST',
		url: 'students/show/action.php',
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
		url: 'students/show/action.php',
		data: {data:data},	
		success: function(result){
			window.location = "?p=students";
		}
	});		
}

function saveEntity(){
	var action = 'saveEntity';
	var stud_lrn = $('#stud_lrn').val();
	var stud_fname = $('#stud_fname').val();
	var stud_mname = $('#stud_mname').val();
	var stud_lname = $('#stud_lname').val();
	var stud_xname = $('#stud_xname').val();
	var stud_gender = $('#stud_gender').val();
	var stud_bdate = $('#stud_bdate').val();
	var stud_residence = $('#stud_residence').val();
	var stud_cct = $('#stud_cct').val();

	var data = [action, stud_lrn, stud_fname, stud_mname, stud_lname, stud_xname, stud_gender, 
		stud_bdate, stud_residence, stud_cct];
	if(data[1] == '' || data[1].length < 12 || data[1].length > 12){
		toastr.error('Invalid LRN.');
	} else if(data[6] == ''){
		toastr.error('Invalid gender.');
	} else if(data[7] == ''){
		toastr.error('Invalid date of birth.');
	} else if(data[8] == '' || data[8] < 12){
		toastr.error('Invalid residential address.');
	} else if(data[9] == ''){
		toastr.error('Invalid CCT status value.');
	} else{
		$('#btnCancel').attr('disabled', 'disabled');
		$('#btnSubmit').attr('disabled', 'disabled');
		$('#btnSubmit').html('Validating...');
		
		$.ajax({
			type: 'POST',
			url: 'students/show/action.php',
			data: {data:data},	
			success: function(result){
				if(result[0] == 1){
					setTimeout(function(){$('#btnSubmit').html('Saving...');}, 500);
					setTimeout(function(){$('#btnSubmit').html('Submit');}, 1000);
					setTimeout(function(){toastr.success(result[1]);}, 2000);
					setTimeout(function(){addContact(result[2]);}, 2000);
					setTimeout(function(){window.location = '?p=students&modify='+result[2];}, 3000);
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

function checkLRN(){
	var action = 'checkLRN';
	var stud_lrn = $('#stud_lrn').val();
	
	if(stud_lrn.length == 12){
		var data = [action, stud_lrn];
		$.ajax({
			type: 'POST',
			url: 'students/show/action.php',
			data: {data:data},	
			success: function(result){
				if(result[0] == 1){
					toastr.error('LRN already used.');
					$('#stud_lrn').addClass('is-invalid');
					$('#btnSubmit').attr('disabled',  'disabled');
					
				} else {
					$('#stud_lrn').removeClass('is-invalid');
					$('#btnSubmit').removeAttr('disabled');
				}
			}
		});	
		
	} else{
		$('#stud_lrn').removeClass('is-invalid');
		$('#btnSubmit').removeAttr('disabled');
	}
}

function addContact(stud_no){
	var action = 'addContact';

	var data = [action, stud_no];
	$.ajax({
		type: 'POST',
		url: 'students/show/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				toastr.success('Contacts added.');
			} else {
				toastr.error(result[1]);
			}
		}
	});	
}
</script>	

