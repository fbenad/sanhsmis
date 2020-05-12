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
			echo '<option value="'.$row['teachSaln_issueyear'].'">Fiscal Year '.$row['teachSaln_issueyear'].'</option>';
		}} else{
			echo '<option value="">'.$result['1'].'</option>';
		}
		
	} else if($_POST['data']['0'] == "loadEmployees"){
		$data = array_values($_POST);
		$result = $controller->loadEmployees();
		
		echo '<option value="%">Select employee</option>';
		if($result['0'] == 1){while($row = $result['2']->fetch_assoc()){
			echo '<option value="'.$row['teach_no'].'">'.$row['teach_lname'].", ".$row['teach_fname'].($row['teach_xname'] == "" ? "" : ", ".$row['teach_xname']).", ".$row['teach_mname'].'</option>';
		}} else{
			echo '<option value="">'.$result['1'].'</option>';
		}
		
	} else if($_POST['data']['0'] == "loadList"){
		$data = array_values($_POST);
		$result = $controller->loadEmployees();
		
		$i = 1;
		if($result['0'] == 1){while($row = $result['2']->fetch_assoc()){
			$result2 = $controller->getDetails($data, $row['teach_no']);
			
			if($result2['0'] == 1){ $row2 = $result2['2'];
				$teachSaln_no = $row2['teachSaln_no'];
				$teachSaln_filetype = ($row2['teachSaln_filetype'] == 1 ? "Joint" : ($row2['teachSaln_filetype'] == 2 ? "Separate" : "Not applicable"));
				$teachSaln_networth = number_format($row2['teachSaln_networth'], 2);
				$teachSaln_moddatetime = date('m/d/Y h:iA', strtotime($row2['teachSaln_moddatetime']));
				$teachSaln_status = ($row2['teachSaln_status'] == 1 ? "Open" : ($row2['teachSaln_status'] == 2 ? "In progress" : "Completed"));
			} else{
				$teachSaln_no = 0;
				$teachSaln_filetype = "";
				$teachSaln_networth = "";
				$teachSaln_moddatetime = "";
				$teachSaln_status = "";
			}

			echo '
			<tr>
				<td>'.$i++.'</td>
				<td title="'.$row['teach_no'].'">'.$row['teach_lname'].", ".$row['teach_fname'].($row['teach_xname'] == "" ? "" : ", ".$row['teach_xname']).", ".substr($row['teach_mname'], 0, 1).'.</td>
				<td>'.$teachSaln_filetype.'</td>
				<td align="right">'.$teachSaln_networth.'</td>
				<td>'.$teachSaln_moddatetime.'</td>
				<td>'.$teachSaln_status.'</td>
				<td>';
				if($teachSaln_status == "Completed"){
					?>
					<a href="javascript:void(0);" title="Revert SALN status to in-progress"
						onclick="return confirm('Revert SALN status to in-progress?') ? revertSALNStatus('<?php echo $teachSaln_no;?>') :  false;">
						<i class="fas fa-sync-alt"></i>
					</a>
					&nbsp;&nbsp;
					<a href="javascript:void(0);" title="Print SALN" 
							onclick="window.open('../reports/pdf_saln.php?id=<?php echo $teachSaln_no;?>', 'newwindow', 'width=850, height=550'); return false;">
							<i class="fas fa-print"></i>
						</a>
					<?php
				}
				echo '
				</td>
			</tr>';
		}} else{
			echo '<tr><td colspan="7">'.$result['1'].'</td></tr>';
		}
	} else if($_POST['data']['0'] == "loadTeacherList"){
		$data = array_values($_POST);
		$result = $controller->loadTeacherList($data);
		
		$i = 1;
		if($result['0'] == 1){while($row = $result['2']->fetch_assoc()){
			echo '
			<tr>
				<td>'.$i++.'</td>
				<td title="'.$row['teach_no'].'">'.$row['teach_lname'].", ".$row['teach_fname'].($row['teach_xname'] == "" ? "" : ", ".$row['teach_xname']).", ".substr($row['teach_mname'], 0, 1).". (".$row['teachSaln_issueyear'].')</td>
				<td>'.($row['teachSaln_filetype'] == 1 ? "Joint" : ($row['teachSaln_filetype'] == 2 ? "Separate" : "Not applicable")).'</td>
				<td align="right">'.number_format($row['teachSaln_networth'], 2).'</td>
				<td>'.date('m/d/Y h:iA', strtotime($row['teachSaln_moddatetime'])).'</td>
				<td>'.($row['teachSaln_status'] == 1 ? "Open" : ($row['teachSaln_status'] == 2 ? "In progress" : "Completed")).'</td>
				<td>';
				if($row['teachSaln_status'] == 3){
					echo '<a href="javascript:void(0);" title="Print SALN">
							<i class="fas fa-print"></i>
						</a>';
				}
					
				echo '
				</td>
			</tr>';
		}} else{
			echo '<tr><td colspan="7">'.$result['1'].'</td></tr>';
		}
		
	} else if($_POST['data']['0'] == "loadCounts"){
		$data = array_values($_POST);
		$result = $controller->loadCounts($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();	
		
	} else if($_POST['data']['0'] == "revertSALNStatus"){
		$data = array_values($_POST);
		$result = $controller->revertSALNStatus($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();	
	}

}
?>