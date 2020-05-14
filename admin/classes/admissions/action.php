<?php
/*
 * Script Handler
 *
 * This page is used to process the request from the visible page of the Admin->Admissions feature. 
 * Request such as the CRUD operations are queued here and executed by Controller (controller.php) class.
 * @author    	Fernando B. Enad
 * @license    	Public
 */
session_start();
require_once("../../../config/dbconfig.php");
require_once("../../../config/settings.php");
require_once("controller.php");

$controller = new Controller();

if(isset($_POST['data'])){	

	if($_POST['data']['0'] == "getPart1"){
		$data = array_values($_POST);
		?>
		<div class="col-md-12">
			<div class="card card-primary">
				<div class="card-body">
					<div class="row">
						<div class="col-md-4">
							<div class="card card-info">
								<div class="card-header">
									<h3 class="card-title">Search Parameters</h3>
								</div>
								<form role="form" id="form" method="post" onSubmit="return false;">	
								<div class="card-body">
									<div class="row">
										<div class="col-md-12 col-form-label">
											<label>Firstname * </label>
											<input type="text" class="form-control" id="firstname" name="firstname" placeholder="APOLINARIO" value="<?php echo (isset($_SESSION['search_firstname']) ? $_SESSION['search_firstname'] : "");?>" required>
										</div>
										<div class="col-md-12 col-form-label">
											<label>Lastname *</label>
											<input type="text" class="form-control" id="lastname" name="lastname" placeholder="MABINI" value="<?php echo (isset($_SESSION['search_lastname']) ? $_SESSION['search_lastname'] : "");?>" required>
										</div>
										<div class="col-md-12 col-form-label">
											<button type="button" class="btn btn-default btn-sm" id="entity-search" name="entity-search" onclick="cancelSearch();">Cancel</button>
											<button class="btn btn-info btn-sm float-right" id="entity-search" name="entity-search" onclick="searchEntity();">Search</button>
										</div>
									</div>
								</div>
								</form>
							</div>
						</div>
						<div class="col-md-8">
							<div class="card card-default" id="entity-new-part1-search-result">
								<div class="card-header bg-white">
									<h3 class="card-title">Search Result</h3>
								</div>
								<div class="card-body table-responsive p-0">
									<small>
									<table class="table table-hover">
										<thead>
											<tr>
												<th>#</th>
												<th>Name</th>
												<th>Gender</th>
												<th>Birthdate</th>
												<th></th>
											</tr>
										</thead>
										<tbody id="entity-search-result">
										</tbody>
									</table>
									</small>
								</div>
								<div class="card-footer clearfix">
									<div class="row">
										<div class="col-md-4">
											<small id="entity-search-count">{Record(s) found}</small>
										</div>
										<div class="col-md-4">
										</div>
										<div class="col-md-4">
											<button class="btn btn-info btn-xs float-right" onclick="gotoNext();">Not listed? Create new record.</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>		
		<?php
		
	} else if($_POST['data']['0'] == "getPart2"){
		$data = array_values($_POST);
		?>
		<div class="col-md-12">
			<div class="card">
				<form role="form" id="form" method="post" onSubmit="return false;">	
				<div class="card-header">
					<h3 class="card-title">
						<span id="enrol-lrn">{enrol-lrn}</span> - <span id="enrol-fullname">{enrol-fullname}</span>
					</h3>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-3">
									<div class="card card-info">
										<form role="form" id="form" method="post" onSubmit="return false;">	
										<div class="card-header">
											<h3 class="card-title">Current Info</h3>
										</div>
										<div class="card-body">
											<div class="row">
												<div class="col-md-12">
													<small>
													<p>
														<strong>School Year</strong><br>
														<span id="status-sy">{status-sy}</span>
													</p>
													<p>
														<strong>Grade Level / Section</strong><br>
														<span id="status-level">{status-level}</span> / <span id="status-section">{status-section}</span> / <span id="status-track">{status-track}</span>
													</p>
													<p>
														<strong>Status</strong><br>
														<span id="status-eosy">{status-eosy}</span>
													</p>
													</small>
												</div>
											</div>
										</div>
									</div>
								</div>	
								<div class="col-md-9">
									<div class="card" id="enrollment-details">
										<form role="form" id="form" method="post" onSubmit="return false;">	
										<div class="card-header">
											<h3 class="card-title">
												<span id="enrol_lrn">Enrollment Details for <strong>School Year <?php echo $_SESSION['current_sy']."-".($_SESSION['current_sy']+1);?></strong></span>
											</h3>
											<div class="card-tools">
												<input type="checkbox" id="enrol_gradawards" value="1" title="Click to check if temporary enrollment"><small> Temporary</small>
											</div>
										</div>
										<div class="card-body">
											<div class="row">
												
												<div class="col-md-3 col-form-label">
													<label>Grade Level *</label>
													<input type="hidden" class="form-control" id="enrol_ti" value="0">
													<select class="form-control" id="enrol_level" onchange="updateSection('%', '');" required>
														<?php
														echo '<option value="">Select level</option>';
														for($i = $min_level; $i <= $max_level; $i++){
															echo '<option value="'.$i.'">Grade '.$i.'</option>';
														}
														?>
													</select>
												</div>
												<div class="col-md-4 col-form-label">
													<label>Section *</label>
													<select class="form-control" id="enrol_section" required>
														<?php
														$result = $controller->getSections($_SESSION['current_sy'], "%", "%", " AND section_track NOT LIKE 'JHS STE%' ");
														
														echo '<option value="">Select section</option>';
														if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
															echo '<option value="'.$row['section_name'].'">'.$row['section_name'].'</option>';
														}} else{
															echo '<option value="">'.$result['1'].'</option>';
														}
														?>
													</select>
												</div>
												<div class="col-md-5 col-form-label">
													<label>Remarks/notes</label>
													<input type="text" class="form-control" id="enrol_remarks">
												</div>
											</div>
											<div class="row" id="track-esjhs">
												<div class="col-md-8 col-form-label" id="enrollment-warning">
												
												</div>	
												<div class="col-md-4 col-form-label">
													<label>Program type *</label>
													<select class="form-control" id="enrol_track2" required disabled>
														<?php
														$result = $controller->getDropdowns(" field_category = 'TRACK' AND field_name LIKE 'JHS GENERAL' ");
														
														echo '<option value="">Select program type</option>';
														if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
															echo '<option value="'.$row['field_name'].'" '.($row['field_name'] == "JHS STE" || $row['field_name'] == "ES GENERAL"? "disabled" : "").'>'.$row['field_name'].'</option>';
														}} else{
															echo '<option value="">'.$result['1'].'</option>';
														}
														?>
													</select>
												</div>
											</div>
											<div class="row" id="track-shs">
												<div class="col-md-3 col-form-label">
													<label>Track *</label>
													<select class="form-control" id="enrol_track1" onchange="updateStrand();" required disabled>
														<?php
														$result = $controller->getDropdowns(" field_category = 'TRACKS' ");
														
														echo '<option value="">Select track</option>';
														if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
															echo '<option value="'.$row['field_name'].'">'.$row['field_name'].'</option>';
														}} else{
															echo '<option value="">'.$result['1'].'</option>';
														}
														?>
													</select>
												</div>
												<div class="col-md-3 col-form-label">
													<label>Strand *</label>
													<select class="form-control" id="enrol_strand" onchange="updateCombo();" required disabled>
														<?php
														$result = $controller->getDropdowns(" field_category LIKE 'STRAND%' ");
														
														echo '<option value="">Select strand</option>';
														if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
															echo '<option value="'.$row['field_name'].'">'.$row['field_name'].'</option>';
														}} else{
															echo '<option value="">'.$result['1'].'</option>';
														}
														?>
													</select>
												</div>	
												<div class="col-md-6 col-form-label">
													<label>Specialization combination * (TVL only)</label>
													<select class="form-control" id="enrol_combo" required disabled>
														<?php
														$result = $controller->getDropdowns(" field_category LIKE 'COMBO%' ");
														
														echo '<option value="">Select specialization combination</option>';
														if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
															echo '<option value="'.$row['field_name'].'">'.$row['field_name'].'</option>';
														}} else{
															echo '<option value="">'.$result['1'].'</option>';
														}
														?>
													</select>
												</div>												
											</div>
										</div>
									</div>
									<div class="card-body" id="enrollment-error">
										<div class="callout callout-danger">
										  <h5>Enrollment Error</h5>
										  <p>Either the student has no history or the historical record(s) status blocked the enrollment process workflow. 
										  It is also possible that the student has already been enrolled.<br><br>
										  Refer student to the School Registrar.</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer clearfix">
					<div class="row">
						<div class="col-md-4">
							<button type="button" class="btn btn-default" id="btnCancel" name="btnCancel" onclick="window.location = '?p=admissions';">Cancel</button>
						</div>
						<div class="col-md-4">
						</div>
						<div class="col-md-4">
							<button class="btn btn-info float-right" id="btnSubmit" name="btnSubmit" onclick="return confirm('Enroll student?') ? enrollStudent() : false;">Enrol Learner</button>
						</div>
					</div>
				</div>
			</div>
		</div>	
		<script> $('#track-esjhs').hide(); $('#track-shs').hide(); </script>
		<?php
		
	} else if($_POST['data']['0'] == "getPart2B"){
		$data = array_values($_POST);
		?>
		<div class="col-md-12">
			<div class="card">
				<form role="form" id="form" method="post" onSubmit="return false;">	
				<div class="card-header">
					<h3 class="card-title">
						<span id="enrol-lrn">{enrol-lrn}</span> - <span id="enrol-fullname">{enrol-fullname}</span>
					</h3>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-3">
									<div class="card card-info">
										<form role="form" id="form" method="post" onSubmit="return false;">	
										<div class="card-header">
											<h3 class="card-title">Current Info</h3>
										</div>
										<div class="card-body">
											<div class="row">
												<div class="col-md-12">
													<small>
													<p>
														<strong>School Year</strong><br>
														<span id="status-sy">{status-sy}</span>
													</p>
													<p>
														<strong>Grade Level / Section</strong><br>
														<span id="status-level">{status-level}</span> / <span id="status-section">{status-section}</span>
													</p>
													<p>
														<strong>Status</strong><br>
														<span id="status-eosy">{status-eosy}</span>
													</p>
													</small>
												</div>
											</div>
										</div>
									</div>
								</div>	
								<div class="col-md-9">
									<div class="card" id="enrollment-details">
										<form role="form" id="form" method="post" onSubmit="return false;">	
										<div class="card-header">
											<h3 class="card-title">
												<span id="enrol_lrn">Enrollment Details for <strong>School Year <?php echo $_SESSION['current_sy']."-".($_SESSION['current_sy']+1);?></strong></span>
											</h3>
											<div class="card-tools">
												<input type="checkbox" id="enrol_gradawards" value="1" title="Click to check if temporary enrollment"><small> Temporary</small>
											</div>
										</div>
										<div class="card-body">
											<div class="row">
												<div class="col-md-2 col-form-label">
													<label title="Within school year transfer?">Trans-In *</label>
													<select class="form-control" id="enrol_ti" onchange="requireRemarks();" required>
														<option value="0">No</option>
														<option value="1">Yes</option>
													</select>
												</div>
												<div class="col-md-3 col-form-label">
													<label>Grade Level *</label>
													<select class="form-control" id="enrol_level" onchange="updateSection('%', '');" required>
														<?php
														echo '<option value="">Select level</option>';
														for($i = $min_level; $i <= $max_level; $i++){
															echo '<option value="'.$i.'">Grade '.$i.'</option>';
														}
														?>
													</select>
												</div>
												<div class="col-md-3 col-form-label">
													<label>Section *</label>
													<select class="form-control" id="enrol_section" required>
														<?php
														$result = $controller->getSections($_SESSION['current_sy'], "%", "%", "");
														
														echo '<option value="">Select section</option>';
														if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
															echo '<option value="'.$row['section_name'].'">'.$row['section_name'].'</option>';
														}} else{
															echo '<option value="">'.$result['1'].'</option>';
														}
														?>
													</select>
												</div>
												<div class="col-md-4 col-form-label">
													<label>Remarks/notes</label>
													<input type="text" class="form-control" id="enrol_remarks" onkeyup="populateRemarks();">
												</div>
											</div>
											<div class="row" id="track-esjhs">
												<div class="col-md-8 col-form-label" id="enrollment-warning">
												
												</div>	
												<div class="col-md-4 col-form-label">
													<label>Program type *</label>
													<select class="form-control" id="enrol_track2" required>
														<?php
														$result = $controller->getDropdowns(" field_category = 'TRACK' AND field_name NOT LIKE 'SHS%' ");
														
														echo '<option value="">Select program type</option>';
														if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
															echo '<option value="'.$row['field_name'].'">'.$row['field_name'].'</option>';
														}} else{
															echo '<option value="">'.$result['1'].'</option>';
														}
														?>
													</select>
												</div>
											</div>
											<div class="row" id="track-shs">
												<div class="col-md-3 col-form-label">
													<label>Track *</label>
													<select class="form-control" id="enrol_track1" onchange="updateStrand();" required>
														<?php
														$result = $controller->getDropdowns(" field_category = 'TRACKS' ");
														
														echo '<option value="">Select track</option>';
														if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
															echo '<option value="'.$row['field_name'].'">'.$row['field_name'].'</option>';
														}} else{
															echo '<option value="">'.$result['1'].'</option>';
														}
														?>
													</select>
												</div>
												<div class="col-md-3 col-form-label">
													<label>Strand *</label>
													<select class="form-control" id="enrol_strand" onchange="updateCombo();" required>
														<?php
														$result = $controller->getDropdowns(" field_category LIKE 'STRAND%' ");
														
														echo '<option value="">Select strand</option>';
														if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
															echo '<option value="'.$row['field_name'].'">'.$row['field_name'].'</option>';
														}} else{
															echo '<option value="">'.$result['1'].'</option>';
														}
														?>
													</select>
												</div>	
												<div class="col-md-6 col-form-label">
													<label>Specialization combination * (TVL only)</label>
													<select class="form-control" id="enrol_combo" required>
														<?php
														$result = $controller->getDropdowns(" field_category LIKE 'COMBO%' ");
														
														echo '<option value="">Select specialization combination</option>';
														if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
															echo '<option value="'.$row['field_name'].'">'.$row['field_name'].'</option>';
														}} else{
															echo '<option value="">'.$result['1'].'</option>';
														}
														?>
													</select>
												</div>												
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer clearfix">
					<div class="row">
						<div class="col-md-4">
							<button type="button" class="btn btn-default" id="btnCancel" name="btnCancel" onclick="window.location = '?p=admissions';">Cancel</button>
						</div>
						<div class="col-md-4">
						</div>
						<div class="col-md-4">
							<button class="btn btn-info float-right" id="btnSubmit" name="btnSubmit" onclick="return confirm('Enroll student?') ? enrollStudent() : false;">Enrol Learner</button>
						</div>
					</div>
				</div>
			</div>
		</div>	
		<script> $('#track-esjhs').hide(); $('#track-shs').hide(); </script>
		<?php
		
	} else if($_POST['data']['0'] == "searchEntity"){
		$data = array_values($_POST);
		$result = $controller->searchEntity($data);
		
		$i = 1;
		if($result['0'] == 1){while($row = $result['2']->fetch_assoc()){
			echo '
			<tr>
				<td>'.$i++.'</td>
				<td title="'.$row['stud_no'].'">'.strtoupper($row['stud_lname'].", ".$row['stud_fname']."".($row['stud_xname'] == "" ? "" : ", ".$row['stud_xname']).", ".$row['stud_mname']).'</td>
				<td>'.$row['stud_gender'].'</td>
				<td>'.date('m/d/Y', strtotime($row['stud_bdate'])).'</td>
				<td><a href="?p=admissions&section='.$data['0']['3'].'&enrol='.$row['stud_no'].'"><i class="fas fa-user-tie" title="Enroll student"></i></a></td>
			</tr>';
		}} else{
			echo '<tr><td colspan="5">'.$result['1'].'</td></tr>';
		}
		
		echo "<script>$('#entity-search-count').html(".$result['3']."+' record(s) found');</script>";
		$_SESSION['search_firstname'] = $data['0']['1'] ;
		$_SESSION['search_lastname'] = $data['0']['2'] ;
		
	} else if($_POST['data']['0'] == "cancelSearch"){
		$data = array_values($_POST);
		unset($_SESSION['search_firstname']);
		unset($_SESSION['search_lastname']);
	
	} else if($_POST['data']['0'] == "updateSection"){
		$data = array_values($_POST);
		$result = $controller->getSections($_SESSION['current_sy'], $data['0']['1'], $data['0']['2'], $data['0']['3']);
		
		echo '<option value="">Select section</option>';
		if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
			$result2 = $controller->getEnrollmentCount($row['section_sy'], $row['section_level'], $row['section_name']);
			$data2 = array(array("", "", $row['section_sy'], 1, $row['section_level'], $row['section_name']));
			$result3 = $controller->getOffering($data2);
			echo '<option value="'.$row['section_name'].'" '.($result2[3] >= $row['section_cap'] ? "disabled" : "" ).' '.($result3['3'] > 0 ? "" : "disabled").'>'.$row['section_name'].' ('.($result2['3'] == '' ? 0 : $result2['3']).'/'.$row['section_cap'].')</option>';
		}} else{
			echo '<option value="">'.$result['1'].'</option>';
		}
		
	} else if($_POST['data']['0'] == "getStudentInformation"){
		$data = array_values($_POST);
		$result = $controller->getStudentInformation($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();	
		
	} else if($_POST['data']['0'] == "getCurrentEnrollment"){
		$data = array_values($_POST);
		$result = $controller->getCurrentEnrollment($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();	
		
	} else if($_POST['data']['0'] == "updateStrand"){
		$data = array_values($_POST);
		$result = $controller->getDropdowns(" field_category LIKE 'STRAND-".$data['0']['1']."%' ");
		
		echo '<option value="">Select strand</option>';
		if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
			echo '<option value="'.$row['field_name'].'">'.$row['field_name'].'</option>';
		}} else{
			echo '<option value="">'.$result['1'].'</option>';
		}

	} else if($_POST['data']['0'] == "updateCombo"){
		$data = array_values($_POST);
		$result = $controller->getDropdowns(" field_category LIKE 'COMBO-".$data['0']['1']."%' ");
		
		echo '<option value="">Select specialization combination</option>';
		if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
			echo '<option value="'.$row['field_name'].'">'.$row['field_name'].'</option>';
		}} else{
			echo '<option value="">'.$result['1'].'</option>';
		}

	} else if($_POST['data']['0'] == "enrollStudent"){
		$data = array_values($_POST);
		$result = $controller->enrollStudent($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();	
		
	} else if($_POST['data']['0'] == "addSchoolDays"){
		$data = array_values($_POST);
		$result = $controller->addSchoolDays($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();	
		
	} else if($_POST['data']['0'] == "addCoreValues"){
		$data = array_values($_POST);
		$result = $controller->addCoreValues($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();	
		
	} else if($_POST['data']['0'] == "addSubjects"){
		$data = array_values($_POST);
		$result = $controller->getOffering($data);
		
		if($result['0'] == 1){while($row = $result['2']->fetch_assoc()){
			$data2 = array(array($row['class_sy'], $row['class_sem'], $row['class_no'], $data['0']['1']));
			$result2 = $controller->addSubjects($data2);
			$reply_0 = $result2['0'];
			$reply_1 = $result2['1'];
		}} else{
			echo $result['1'];
			$reply_0 = $result2['0'];
			$reply_1 = $result2['1'];
		}
		
		$output = array($reply_0, $reply_1);
		
		header("Content-Type: application/json");
		echo json_encode($output);

		exit();	
	}
}
?>