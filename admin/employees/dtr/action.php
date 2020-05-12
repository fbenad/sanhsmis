<?php
session_start();
require_once("../../../config/dbconfig.php");
require_once("../../../config/settings.php");
require_once("controller.php");

$controller = new Controller();

if(isset($_POST['data'])){	

	if($_POST['data']['0'] == "loadSYs"){
		$data = array_values($_POST);
		$result = $controller->loadSYs();
		
		if($result['0'] == 1){while($row = $result['2']->fetch_assoc()){
			echo '<option value="'.date('Ym', strtotime($row['CHECKTIME'])).'">'.date('F, Y', strtotime($row['CHECKTIME'])).'</option>';
		}} else {
			echo '<option value="">'.$result['1'].'</option>';
		}		

	} else if($_POST['data']['0'] == "getLogs"){
		$data = array_values($_POST);
		$result = $controller->getLogs($data);
		
		$i = 1;
		if($result['0'] == 1){while($row = $result['2']->fetch_assoc()){
			echo '
			<tr>
				<td>'.$i++.'</td>
				<td title="'.$row['teach_no'].'">'.$row['teach_lname'].", ".$row['teach_fname'].($row['teach_xname'] == "" ? "" : ", ".$row['teach_xname']).", ".substr($row['teach_mname'], 0, 1).'.</td>
				<td>'.date('m/d', strtotime($row['CHECKTIME'])).'</td>
				<td>'.date('D', strtotime($row['CHECKTIME'])).'</td>
				<td>'.date('h:i A', strtotime($row['CHECKTIME'])).'</td>
				<td>'.($row['CHECKTYPE'] == "I" ? "In" : "Out").'</td>
				<td>'.($row['sn'] == "0" ? "Web Form" : "Machine").'</td>';
				
				$result2 = $controller->getRemarks($data, $row['CHECKTIME'], $row['CHECKTYPE']);
				
				if($result2['0'] == 1){ $row2 = $result2['2'];
					$remarks =  $row2['ml_reason'];
				} else {
					$remarks =  "N/A";
				}
				echo '<td>'.$remarks.'</td>

			</tr>';
		}} else {
			echo '<tr><td colspan="7"></td></tr>';
		}		

	} else if($_POST['data']['0'] == "getMissingLogs"){
		$data = array_values($_POST);
		$result = $controller->getMissingLogs($data);
		
		$i = 1;
		if($result['0'] == 1){while($row = $result['2']->fetch_assoc()){
			echo '
			<tr>
				<td>'.$i++.'</td>
				<td title="'.$row['teach_no'].'">'.$row['teach_lname'].", ".$row['teach_fname'].($row['teach_xname'] == "" ? "" : ", ".$row['teach_xname']).", ".substr($row['teach_mname'], 0, 1).'.</td>
				<td>'.date('m/d', strtotime($row['ml_checkdate'])).'</td>
				<td>'.date('h:i A', strtotime($row['ml_checktime'])).'</td>
				<td>'.($row['ml_checktype'] == "I" ? "In" : "Out").'</td>
				<td>'.date('m/d/Y', strtotime($row['ml_apply_regdatetime'])).'</td>
				<td>'.$row['ml_reason'].'</td>
				<td>'.($row['ml_approve_user_no'] == 0 ? "Pending" : ($row['ml_approve_user_no'] > 0 ? "Approved" : "Disapproved")).'</td>
				<td><a href="javascript:void(0);" class="float-right" title="Process application"
						data-toggle="modal" data-target="#modal-input" rowID="'.$row['ml_no'].'" data-type="processApplication" data-backdrop="static" data-keyboard="false">
						<i class="fas fa-external-link-alt"></i>
					</a>				
				</td>

			</tr>';
		}} else {
			echo '<tr><td colspan="7"></td></tr>';
		}		

	} else if($_POST['data']['0'] == "getMonth"){
		$data = array_values($_POST);
		$result = $controller->getMonth($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();	
		
	} else if($_POST['data']['0'] == "loadEmployees"){
		$data = array_values($_POST);
		$result = $controller->loadEmployees($data);
		
		echo '<option value="%">Select employee to view</option>';
		if($result['0'] == 1){while($row = $result['2']->fetch_assoc()){
			echo '<option value="'.$row['teach_bio_no'].'">'.$row['teach_lname'].", ".$row['teach_fname'].($row['teach_xname'] == "" ? "" : ", ".$row['teach_xname']).", ".substr($row['teach_mname'], 0, 1).'.</option>';
		}} else {
			echo '<option value="">'.$result['1'].'</option>';
		}		

	} else if($_POST['data']['0'] == "showAction"){
		$data = array_values($_POST);
		
		if($_POST['data']['1'] == "processApplication"){
			?>
			<div class="card-body table-responsive p-0">
				<small>
				<table class="table table-hover">
					<tr><th width="35%">Applicant</th><td><span id="ml_userid"></span></td></tr>
					<tr><th>Date of Application</th><td><span id="ml_apply_regdatetime"></span></td></tr>
					<tr><th>Date/Time/State</th><td><span id="ml_checkdate"></span> / <span id="ml_checktime"></span> / <span id="ml_checktype"></span></td></tr>
					<tr><th>Reason</th><td><textarea class="form-control" id="ml_reason" readonly></textarea></td></tr>
					<tr><th>Approved?</th><td><strong>Remarks</strong></td></tr>
					<tr>
						<th><input type="radio" class="form-control-xs" id="ml_approve_user_no_1" name="ml_approve_user_no" value="1" required> Yes 
							<input type="radio" class="form-control-xs" id="ml_approve_user_no_2" name="ml_approve_user_no" value="-1" required> No
						</th>
						<td><textarea class="form-control" id="ml_remarks" rows="1" placeholder="Remarks here..." required></textarea></td>
					</tr>
				</table>	
				</small>
			</div>
			<?php
			$result = $controller->getApplication($data);
			
			if($result['0'] == 1){$row = $result['2'];
				?>
				<script>
				$('#ml_userid').html('<?php echo $row['teach_lname'].", ".$row['teach_fname'].($row['teach_xname'] == "" ? "" : ", ".$row['teach_xname']).", ".substr($row['teach_mname'], 0, 1).".";?>');
				$('#ml_apply_regdatetime').html('<?php echo date('M d, Y h:i A', strtotime($row['ml_apply_regdatetime']));?>');
				$('#ml_checkdate').html('<?php echo date('F j, Y', strtotime($row['ml_checkdate']." 00:00:00"));?>');
				$('#ml_checktime').html('<?php echo date('h:m A', strtotime($row['ml_checkdate']." ".$row['ml_checktime']));?>');
				$('#ml_checktype').html('<?php echo ($row['ml_checktype'] == "I" ? "In" : "Out");?>');
				$('#ml_reason').html('<?php echo htmlentities($row['ml_reason']);?>');
				var approval = <?php echo $row['ml_approve_user_no'];?>;
				
				if(approval == 0){
					// nothing happens
				} else {
					if (approval > 0){
						$('#ml_approve_user_no_1').attr('checked', 'checked');
					} else {
						$('#ml_approve_user_no_2').attr('checked', 'checked');
					}
					
					$('#ml_approve_user_no_1').attr('disabled', 'disabled');
					$('#ml_approve_user_no_2').attr('disabled', 'disabled');
					$('#ml_remarks').attr('readonly', 'readonly');
					$('#submit').attr('disabled', 'disabled');
				}
				</script>
				<?php
			} else {
				echo '';
			}
		}
		
	} else if($_POST['data']['0'] == "submitAction"){
		$data = array_values($_POST);
		
		if($_POST['data']['1'] == "processApplication"){
			$result = $controller->processApplication($data);
		}
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();	
		
	} else if($_POST['data']['0'] == "getApplication"){
		$data = array_values($_POST);
		$result = $controller->getApplication($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();	
		
	} else if($_POST['data']['0'] == "saveToLogs"){
		$data = array_values($_POST);
		$result = $controller->saveToLogs($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();	
		
	}
	
}
?>

