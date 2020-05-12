<?php
session_start();
require_once("../../config/dbconfig.php");
require_once("../../config/settings.php");
require_once("controller.php");

$controller = new Controller();

if(isset($_POST['data'])){	

	if($_POST['data']['0'] == "getEntityList"){
		$data = array_values($_POST);
		$result = $controller->getEntityList($data);
		
		$i = 1;
		if($result['0']== 1){ while($row = $result['2']->fetch_assoc()){
			$result2 = $controller->getCurrentEnrollment($row['stud_no'], $_SESSION['current_sy']);
			if($result2['0'] == 1){ $row2 = $result2['2'];
				$class = $row2['enrol_level']." - ".$row2['enrol_section'];
				$status = $row2['enrol_status2'];
			} else {
				$class = "N/A";
				$status = "Not enrolled";			
			}
			
			
			echo '
			<tr>
				<td>'.$i++.'</td>
				<td title="'.$row['stud_no'].'">'.strtoupper($row['stud_lname'].", ".$row['stud_fname'].($row['stud_xname'] == "" ? "" : ", ".$row['stud_xname']).", ".$row['stud_mname']).'</td>
				<td>'.substr($row['stud_gender'], 0, 1).'</td>
				<td>'.$class.'</td>
				<td>'.$status.'</td>
				<td><a href="?p=students&modify='.$row['stud_no'].'" title="View student #'.$row['stud_no'].'">
						<i class="fas fa-user"></i>
					</a>
				</td>
			</tr>';
		}} else {
			echo '<tr><td colspan="6">'.$result['1'].'</tr>';
		}
	
	} else if($_POST['data']['0'] == "getEntityCount"){
		$data = array_values($_POST);
		$result = $controller->getEntityCount($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();	
	}
}
?>