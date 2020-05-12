<?php
session_start();
require_once("../../config/dbconfig.php");
require_once("../../config/settings.php");
require_once("controller.php");

$controller = new Controller();

if(isset($_POST['data'])){	
	if($_POST['data']['0'] == "getProfile"){
		$data = array_values($_POST);
		$result = $controller->getProfile($data);
		
		if($result['0'] == 1){ $row = $result['2']->fetch_assoc();
			$withImage = "../assets/images/teachers/".$row['teach_no'].".jpg";
			$noImage = "../assets/avatars/".$row['teach_gender'].".jpg";
			?>
			<div class="col-md-3">
				<img src="<?php echo (file_exists("../".$withImage) ? $withImage : $noImage); ?>"
					alt="User profile picture"
					style="border: 1px solid #ddd; border-radius: 4px; padding: 5px; width: 98%;">
			</div>
			<div class="col-md-8">
				<h2 class="profile-username text-left">
					<?php echo ucwords(strtolower($row['teach_fname'] ." ". $row['teach_mname'] ." ". $row['teach_lname'] ." ". $row['teach_xname']));?> 
					[<?php echo $row['teach_no'];?>]<br>
					<small id="profile-position">{profile-position}</small>
				</h2>
				<p class="text-muted text-left">
					<table width="100%" style="margin-top: -10px">
						<tr><td width="3%"><i class="fas fa-id-card"></i></td><td><?php echo $row['teach_id'];?></td></tr>
						<tr><td><i class="fas fa-map-marker-alt"></i></td><td><?php echo ucwords(strtolower($row['teach_residence']));?></td></tr>
						<tr><td><i class="fas fa-phone-volume"></i></td><td><?php echo $row['teach_dialect'];?></td></tr>	
						<tr><td><i class="fas fa-envelope-open-text"></i></td><td><?php echo strtolower($row['teach_ethnicity']);?></td></tr>	
					</table>										 
				</p>
			</div>
			<?php
		} else { echo $result['1']; } 
			
	} else if($_POST['data']['0'] == "getCurrentPosition"){	
		$data = array_values($_POST);
		$result = $controller->getCurrentPosition($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();
			
	} else if($_POST['data']['0'] == "getProfileFull"){	
		$data = array_values($_POST);
		$result = $controller->getProfile($data);
		
		if($result['0'] == 1){ $row = $result['2']->fetch_assoc(); 
			?>
			<tr>
				<td>Teacher #</td>
				<td><?php echo $row['teach_no'];?></td>
			</tr>														
			<tr>
				<td>DepEd ID</td>
				<td><?php echo strtoupper($row['teach_id']);?></td>
			</tr>
			<tr>
				<td>Last name</td>
				<td><?php echo strtoupper($row['teach_lname']);?></td>
			</tr>
			<tr>
				<td>First name</td>
				<td><?php echo strtoupper($row['teach_fname']);?></td>
			</tr>
			<tr>
				<td>Middle name</td>
				<td><?php echo strtoupper($row['teach_mname']);?></td>
			</tr>
			<tr>
				<td>Ext. name</td>
				<td><?php echo $row['teach_xname'];?></td>
			</tr>
			<tr>
				<td>Gender</td>
				<td><?php echo $row['teach_gender'];?></td>
			</tr>
			<tr>
				<td>Birth date</td>
				<td>
				<?php 
				$phpdate = strtotime($row['teach_bdate']);
				echo $mysqldate = date('F d, Y', $phpdate);
				$date1 = strtotime(date("Y-m-d"));
				$date2 = strtotime($row['teach_bdate']);
				$time_difference = $date1 - $date2;
				$seconds_per_year = 60*60*24*365;
				$years = (int) ($time_difference / $seconds_per_year);
				echo " <small>($years years old)</small>";
				?>													
				</td>
			</tr>
			<tr>
				<td>Civil Status</td>
				<td><?php echo $row['teach_cstatus'];?></td>
			</tr>
			<tr>
				<td>Contact No.</td>
				<td><?php echo $row['teach_dialect'];?></td>
			</tr>
			<tr>
				<td>Email</td>
				<td><?php echo strtolower($row['teach_ethnicity']);?></td>
			</tr>
			<?php
		} else { echo $result['1']; }
			
	} else if($_POST['data']['0'] == "getProfileAddresses"){	
		$data = array_values($_POST);
		$result = $controller->getProfile($data);
		
		if($result['0'] == 1){ $row = $result['2']->fetch_assoc(); 
			?>
			<tr>
				<td>Current Address</td>
				<td><?php echo strtoupper($row['teach_residence']);?></td>
			</tr>
			<!--
			<tr>
				<td>Permanent Address</td>
				<td></td>
			</tr>				
			<tr>
				<td>Birth Place</td>
				<td></td>
			</tr>	
			-->
			<?php
		} else { echo $result['1']; }
			
	} else if($_POST['data']['0'] == "verifyPassword"){
		$data = array_values($_POST);
		$status = 1;
		$message = "";
		$authenticateLogin = $controller->authenticateLogin($data);
		
		if($authenticateLogin['0'] == 1){
			$changePassword = $controller->changePassword($data);
			
			if($changePassword['0'] == 1){
				$message = $changePassword['1'];
				$status = 1;
			} else {
				$message = $changePassword['1'];
				$status = -1;
			}
		} else {
			$message = "Old password is incorrect.";
			$status = -1;
		}
		
		$result = array($status, $message);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();
	
	} else if($_POST['data']['0'] == "getPhone"){
		$data = array_values($_POST);		
		$getPhone = $controller->getPhone($data);
		
		if($getPhone['0'] == 1){ $row = $getPhone['2']->fetch_assoc();
			$result = array($getPhone['0'], $getPhone['1'], $row['teach_dialect']);
		} else {
			$result = array($getPhone['0'], $getPhone['1']);
		}
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();
	
	} else if($_POST['data']['0'] == "submitPhoneForm"){
		$data = array_values($_POST);		
		$result = $controller->savePhone($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();
	
	} else if($_POST['data']['0'] == "getLogs"){
		$data = array_values($_POST);		
		$result = $controller->getLogs($data);
		
		if($result['0'] == 1) { while($row = $result['2']->fetch_assoc()){
			?>
			<tr style="line-height: 1px;">
				<td><small><small><?php echo $row['ip'];?></small></small></td>
				<td><small><small><?php echo date('M d, Y h:iA', strtotime($row['timestamp']));?></small></small></td>
			</tr>	
			<?php
			
		}} else {
			echo '<tr><td colspan="2">'.$result['1'].'</td></td></tr>';
		}
		
	} else if ($_POST['data']['0'] == "getFamily"){
		$data = array_values($_POST);

		$result = $controller->getFamily($data);
		
		if($result['0'] == 1) { while($row = $result['2']->fetch_assoc()){
			?>
			<tr>
				<td><?php echo strtoupper($row['teachCont_lname'].", ".$row['teachCont_fname'].($row['teachCont_xname'] == "" ? "" : ", ".$row['teachCont_xname']).", ".$row['teachCont_mname']);?></td>
				<td><?php echo ($row['teachCont_type'] == 1 ? "HUSBAND" : "CHILD");?></td>
			</tr>
			<?php
		}} else {
			echo '<tr><td colspan="2">'.$result['1'].'</td></td></tr>';
		}	
		
	} else if ($_POST['data']['0'] == "getEducation"){
		$data = array_values($_POST);

		$result = $controller->getEducation($data);
		
		if($result['0'] == 1) { while($row = $result['2']->fetch_assoc()){
			?>
			<tr>
				<td><?php echo strtoupper($row['eback_level']);?></td>
				<td><?php echo strtoupper($row['eback_degree']);?></td>
				<td><?php echo strtoupper($row['eback_major']);?></td>
				<td><?php echo strtoupper($row['eback_minor']);?></td>
				<td><?php echo strtoupper($row['eback_units']);?></td>
			</tr>
			<?php
		}} else {
			echo '<tr><td colspan="5">'.$result['1'].'</td></td></tr>';
		}	
		
	} else if ($_POST['data']['0'] == "getIDs"){
		$data = array_values($_POST);

		$result = $controller->getBiometricID($data);
		
		if($result['0'] == 1) { $row = $result['2'];
			?>
			<tr>
				<td>Biometric ID</td>
				<td><?php echo $row['teach_bio_no'];?></td>
				<td><?php echo date('M d, Y', strtotime($row['teach_cretedatetime']));?></td>
				<td><?php echo $sch_address2.", ".$sch_citymun.", ".$sch_province;?></td>
			</tr>
			<?php
		} else {
			//echo '<tr><td colspan="4">'.$result['1'].'</td></td></tr>';
		}
		
		$result = $controller->getIDs($data);
		
		if($result['0'] == 1) { while($row = $result['2']->fetch_assoc()){
			?>
			<tr>
				<td><?php echo strtoupper($row['teacherids_id']);?></td>
				<td><?php echo strtoupper($row['teacherids_details']);?></td>
				<td><?php echo date('M d, Y', strtotime($row['teacherids_date_issued']));?></td>
				<td><?php echo strtoupper($row['teacherids_place_issued']);?></td>
			</tr>
			<?php
		}} else {
			//echo '<tr><td colspan="4">'.$result['1'].'</td></td></tr>';
		}	
		
	} else if ($_POST['data']['0'] == "getAppointment"){
		$data = array_values($_POST);

		$result = $controller->getAppointment($data);
		
		if($result['0'] == 1) { while($row = $result['2']->fetch_assoc()){
			?>
			<tr>
				<td><?php echo strtoupper(substr($row['field_ext'], 2));?></td>
				<td><?php echo strtoupper($row['teacherappointments_item_no']);?></td>
				<td><?php echo date('M d, Y', strtotime($row['teacherappointments_date']));?></td>
				<td><?php echo date('M d, Y', strtotime($row['teacherappointments_fdaydate']));?></td>
			</tr>
			<?php
		}} else {
			echo '<tr><td colspan="4">'.$result['1'].'</td></td></tr>';
		}	
		
	} else if ($_POST['data']['0'] == "getDesignation"){
		$data = array_values($_POST);

		$result = $controller->getDesignation($data);
		
		if($result['0'] == 1) { while($row = $result['2']->fetch_assoc()){
			?>
			<tr>
				<td><?php echo strtoupper($row['teacherappointments_position']);?></td>
				<td><?php echo date('M d, Y', strtotime($row['teacherappointments_date']));?></td>
				<td><?php echo $row['teacherappointments_status'];?></td>
				<td><?php echo ($row['teacherappointments_funding'] == 0 ? "until present" : $row['teacherappointments_funding']);?></td>
			</tr>
			<?php
		}} else {
			echo '<tr><td colspan="4">'.$result['1'].'</td></td></tr>';
		}		
	}
}
?>