<?php
session_start();
require_once("../../config/dbconfig.php");
require_once("../../config/settings.php");
require_once("controller.php");

$controller = new Controller();

if(isset($_POST['data'])){	

	if($_POST['data']['0'] == "loadGeneralSettings"){
		$data = array_values($_POST);
		$result = $controller->loadGeneralSettings();
		
		if($result['0'] == 1){ $row = $result['2'];
			echo'
			<tr>
				<th>Current School Year</th>
				<td title="'.$row['settings_no'].'">'.$row['settings_sy']."-".($row['settings_sy']+1).'</td>
				<td></td>
			</tr>
			<tr>
				<th>Current Semester</th>
				<td>'.($row['settings_sem'] == 1 ? "Firs" : "Second").' Semester</td>
				<td></td>
			</tr>
			<tr>
				<th>Current Month</th>
				<td>'.$controller->getMonthName($_SESSION['current_sy'], substr($row['settings_month'],5)).'</td>
				<td></td>
			</tr>
			<tr>
				<th>Current Curriculum</th>
				<td>'.$row['settings_pros'].'</td>
				<td></td>
			</tr>
			<tr>
				<th>Beginning of School Year</th>
				<td>'.date('m/d/Y', strtotime($row['settings_bosy'])).'</td>
				<td></td>
			</tr>
			<tr>
				<th>End of School Year</th>
				<td>'.date('m/d/Y', strtotime($row['settings_eosy'])).'</td>
				<td></td>
			</tr>
			<tr>
				<th>Late Enrollment Date (Sem 1)</th>
				<td>'.date('m/d/Y', strtotime($row['settings_late1'])).'</td>
				<td></td>
			</tr>
			<tr>
				<th>Late Enrollment Date (Sem 2)</th>
				<td>'.date('m/d/Y', strtotime($row['settings_late2'])).'</td>
				<td></td>
			</tr>
			<tr>
				<th>Closing Data</th>
				<td>'.date('m/d/Y', strtotime($row['settings_eosy'])).'</td>
				<td></td>
			</tr>
			<tr>
				<th>Early Registration Status</th>
				<td>'.($row['settings_earlyreg'] == 0 ? "Not active" : "Active").'</td>
				<td></td>
			</tr>
			<tr>
				<th>End of School Year Status</th>
				<td>'.($row['settings_eosynow'] == 0 ? "Not active" : "Active").'</td>
				<td></td>
			</tr>
			<tr>
				<th>Login Message</th>
				<td>'.$row['settings_loginmessage'].'</td>
				<td></td>
			</tr>
			<tr>
				<th>Admission Slip Message</th>
				<td>'.$row['settings_admissionmessage'].'</td>
				<td></td>
			</tr>';
		} else {
			echo $result['1'];
		}

	} else if($_POST['data']['0'] == "loadDropdownCategory"){
		$data = array_values($_POST);
		$result = $controller->loadDropdownCategory();
		
			echo '<option value="*">Select category</option>';
		if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
			echo '<option value="'.$row['field_category'].'">'.$row['field_category'].'</option>';
		}} else {
			echo '<option value="">'.$result['1'].'</option>';
		}
		
	} else if($_POST['data']['0'] == "loadDropdownFieldNames"){
		$data = array_values($_POST);
		$result = $controller->loadDropdownFieldNames($data);
		
		if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
			echo '
			<tr>
				<td>'.$row['field_category'].'</td>
				<td>'.$row['field_name'].'</td>
				<td>'.$row['field_ext'].'</td>
				<td></td>
			</tr>
			';
		}} else {
			echo '<tr><td colspan="4">'.$result['1'].'</td>';
		}
		
	} else if($_POST['data']['0'] == "getGeneralSettings"){
		$data = array_values($_POST);
		$result = $controller->loadGeneralSettings($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();	
		
	} else if($_POST['data']['0'] == "getDropdownCategory"){
		$data = array_values($_POST);
		$result = $controller->loadDropdownCategory($data);
		
		if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
			echo '
			<tr>
				<td><a href="javascript:void(0);" onclick="changeCategory(\''.$row['field_category'].'\');">'.$row['field_category'].'</a></td>
				<td>-</td>
				<td>-</td>
				<td></td>
			</tr>
			';
		}} else {
			echo '<tr><td colspan="4">'.$result['1'].'</td>';
		}
		
	} else if($_POST['data']['0'] == "showAction"){
		$data = array_values($_POST);
		$result = $controller->loadGeneralSettings($data);
		
		if($_POST['data']['1'] == "modifySettings"){
			if($result['0'] == 1){ $row = $result['2'];
				?>
				<div class="row">
					<div class="col-md-3 col-form-label">
						<label>Active Semester *</label>
						<select class="form-control" id="settings_sem" name="settings_sem" required>
							<option value="">Select semester</option>
							<option value="1" <?php echo ($row['settings_sem'] == 1 ? "selected" : "");?>>First Semester</option>
							<option value="2" <?php echo ($row['settings_sem'] == 2 ? "selected" : "");?>>Second Semester</option>
							<option value="3"></option>
						</select>
					</div>
					<div class="col-md-3 col-form-label">
						<label>Active Month *</label>
						<select class="form-control" id="settings_month" name="settings_month" required>
							<option value="">Select month</option>
							<option value="sch_m1" <?php echo ($row['settings_month'] == "sch_m1" ? "selected" : "");?>>June</option>
							<option value="sch_m2" <?php echo ($row['settings_month'] == "sch_m2" ? "selected" : "");?>>July</option>
							<option value="sch_m3" <?php echo ($row['settings_month'] == "sch_m3" ? "selected" : "");?>>August</option>
							<option value="sch_m4" <?php echo ($row['settings_month'] == "sch_m4" ? "selected" : "");?>>September</option>
							<option value="sch_m5" <?php echo ($row['settings_month'] == "sch_m5" ? "selected" : "");?>>October</option>
							<option value="sch_m6" <?php echo ($row['settings_month'] == "sch_m6" ? "selected" : "");?>>November</option>
							<option value="sch_m7" <?php echo ($row['settings_month'] == "sch_m7" ? "selected" : "");?>>December</option>
							<option value="sch_m8" <?php echo ($row['settings_month'] == "sch_m8" ? "selected" : "");?>>January</option>
							<option value="sch_m9" <?php echo ($row['settings_month'] == "sch_m9" ? "selected" : "");?>>February</option>
							<option value="sch_m10" <?php echo ($row['settings_month'] == "sch_m10" ? "selected" : "");?>>March</option>
							<option value="sch_m11" <?php echo ($row['settings_month'] == "sch_m11" ? "selected" : "");?>>April</option>
							<option value="sch_m12" <?php echo ($row['settings_month'] == "sch_m12" ? "selected" : "");?>>May</option>
						</select>
					</div>
					<div class="col-md-3 col-form-label">
						<label>Early Regt'n Status *</label>
						<select class="form-control" id="settings_earlyreg" name="settings_earlyreg" required>
							<option value="">Select ER status</option>
							<option value="0" <?php echo ($row['settings_earlyreg'] == 0 ? "selected" : "");?>>Not active</option>
							<option value="1" <?php echo ($row['settings_earlyreg'] == 1 ? "selected" : "");?>>Active</option>
						</select>
					</div>
					<div class="col-md-3 col-form-label">
						<label>EOSY Status *</label>
						<select class="form-control" id="settings_eosynow" name="settings_eosynow"  required>
							<option value="">Select EOSY status</option>
							<option value="0" <?php echo ($row['settings_eosynow'] == 0 ? "selected" : "");?>>Not active</option>
							<option value="1" <?php echo ($row['settings_eosynow'] == 1 ? "selected" : "");?>>Active</option>
						</select>
					</div>
					<div class="col-md-6 col-form-label">
						<label>Login Message *</label>
						<textarea class="form-control" id="settings_loginmessage" name="settings_loginmessage"  required><?php echo $row['settings_loginmessage'];?></textarea>
					</div>
					<div class="col-md-6 col-form-label">
						<label>Admission Slip Message *</label>
						<textarea class="form-control" id="settings_admissionmessage" name="settings_admissionmessage"  required><?php echo $row['settings_admissionmessage'];?></textarea>
					</div>
				</div>
				<?php			
			} else {
				echo $result['1'];
			}
		} else if($_POST['data']['1'] == "addDropdown"){
			?>
			<div class="row">
				<div class="col-md-12 col-form-label">
					<label>Dropdown Category *</label>
					<select class="form-control" id="field_category2" name="field_category2" required>
						<?php
						$result = $controller->loadDropdownCategory();
						
						echo '<option value="">Select category</option>';
						if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
							echo '<option value="'.$row['field_category'].'">'.$row['field_category'].'</option>';
						}} else {
							echo '<option value="">'.$result['1'].'</option>';
						}
						?>
					</select>
				</div>
				<div class="col-md-6 col-form-label">
					<label>Field value *</label>
					<input type="text" class="form-control" id="field_name" name="field_name" placeholder="Field value" required>
				</div>
				<div class="col-md-6 col-form-label">
					<label>Extension value *</label>
					<input type="text" class="form-control" id="field_ext" name="field_ext" placeholder="Input dash (-) if not applicable" required>
				</div>
			</div>
			<?php			
		}
		
	} else if($_POST['data']['0'] == "submitAction"){
		$data = array_values($_POST);
		
		if($_POST['data']['1'] == "modifySettings"){
			$result = $controller->modifySettings($data);
			
			header("Content-Type: application/json");
			echo json_encode($result);

			exit();		
			
		} else if($_POST['data']['1'] == "addDropdown"){
			$result = $controller->addDropdown($data);
			
			header("Content-Type: application/json");
			echo json_encode($result);

			exit();		
			
		}		
	}
}
?>