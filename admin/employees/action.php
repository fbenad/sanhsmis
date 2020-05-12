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
			echo '
			<tr>
				<td>'.$i++.'</td>
				<td title="'.$row['teach_no'].'">'.strtoupper($row['teach_lname'].", ".$row['teach_fname'].($row['teach_xname'] == "" ? "" : ", ".$row['teach_xname']).", ".$row['teach_mname']).'</td>
				<td>'.substr($row['teach_gender'], 0, 1).'</td>
				<td>'.($row['teach_teacher'] == 1 ? "Teaching" : "Non-teaching").'</td>';
				$result2 = $controller->getPosition($row['teach_no']);
				
				if($result2['0'] == 1){ $row2 = $result2['2'];
					$position = substr($row2['field_ext'], 2);
				} else {
					$position = $result2['1'];
				}
				echo'
				<td><small>'.$position.'</small></td>
				<td>'.($row['teach_status'] == 1 ? "Active" : "Inactive").'</td>
				<td><a href="?p=employees&modify='.$row['teach_no'].'" title="View employee #'.$row['teach_no'].'">
						<i class="fas fa-user-tie"></i>
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