<?php
session_start();
require_once("../../../config/dbconfig.php");
require_once("../../../config/settings.php");
require_once("controller.php");

$controller = new Controller();

if(isset($_POST['data'])){	

	if($_POST['data']['0'] == "getModules"){
		$data = array_values($_POST);
		$result = $controller->getModules();
		
		echo '<option value="%">Select module name</option>';
		if($result['0'] == 1){while($row = $result['2']->fetch_assoc()){
			echo '<option value="'.$row['module_slug'].'">'.$row['module_name'].'</option>';
		}} else {
			echo '<option value="">'.$result['1'].'</option>';
		}
		
	} else if($_POST['data']['0'] == "showAction"){
		$data = array_values($_POST);
		
		if($data['0']['1'] == "addModule"){
			echo '
			<div class="row">
				<div class="col-md-12 col-form-label">
					<label>Slug name *</label>
					<input type="text" class="form-control" id="module_slug" onkeyup="checkSlug();" required>
				</div>
				<div class="col-md-12 col-form-label">
					<label>Module name *</label>
					<input type="text" class="form-control" id="module_name" required>
				</div>
			</div>';
			
		} else if($data['0']['1'] == "addAccess"){
			$result = $controller->getUsers();
			$result2 = $controller->getModules();
			echo '
			<div class="row">
				<div class="col-md-12 col-form-label">
					<label>User *</label>
					<select class="form-control" id="modacc_user_no" required onchange="updateModule();">';
						echo '<option value="">Select user</option>';
						if($result['0'] == 1){while($row = $result['2']->fetch_assoc()){
							echo '<option value="'.$row['user_no'].'">'.$row['user_fullname'].'</option>';
						}} else {
							echo '<option value="">'.$result['1'].'</option>';
						}
			echo'
					</select>
				</div>
				<div class="col-md-12 col-form-label">
					<label>Module name *</label>
					<select class="form-control" id="modacc_module_slug" required>';
						echo '<option value="">Select module</option>';
						if($result2['0'] == 1){while($row = $result2['2']->fetch_assoc()){
							echo '<option value="'.$row['module_slug'].'">'.$row['module_name'].'</option>';
						}} else {
							echo '<option value="">'.$result['1'].'</option>';
						}
			echo '
					</select>
				</div>
				<div class="col-md-12 col-form-label">
					<label>Role *</label>
					<select class="form-control" id="modacc_role" required>
						<option value="">Select role</option>
						<option value="1">Manager</option>
						<option value="2">Staff</option>
					</select>
				</div>
				<div class="col-md-12 col-form-label" id="form-delete">
					<button type="button" class="btn btn-danger float-right" id="delete" title="Delete access"
						onclick="return confirm(\'Delete access?\') ? submitAction(\'deleteAccess\') : false;">
						<i class="fas fa-trash"></i>
					</button>
				</div>
			</div>';
			echo "<script>$('#form-delete').hide()</script>";
			
		} else if($data['0']['1'] == "modifyAccess"){
			$result = $controller->getAccess($data);
			
			header("Content-Type: application/json");
			echo json_encode($result);

			exit();	
		}
		
	} else if($_POST['data']['0'] == "submitAction"){
		$data = array_values($_POST);
		
		if($data['0']['1'] == "addModule"){
			$data = array_values($_POST);
			$result = $controller->addModule($data);
			
			header("Content-Type: application/json");
			echo json_encode($result);

			exit();	
			
		} else if($data['0']['1'] == "addAccess"){
			$data = array_values($_POST);
			$result = $controller->addAccess($data);
			
			header("Content-Type: application/json");
			echo json_encode($result);

			exit();	
			
		} else if($data['0']['1'] == "modifyAccess"){
			$data = array_values($_POST);
			$result = $controller->modifyAccess($data);
			
			header("Content-Type: application/json");
			echo json_encode($result);

			exit();	
			
		} else if($data['0']['1'] == "deleteAccess"){
			$data = array_values($_POST);
			$result = $controller->deleteAccess($data);
			
			header("Content-Type: application/json");
			echo json_encode($result);

			exit();	
			
		}
		
	} else if($_POST['data']['0'] == "checkSlug"){
		$data = array_values($_POST);
		$result = $controller->checkSlug($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();		
		
	} else if($_POST['data']['0'] == "getAccessList"){
		$data = array_values($_POST);
		$result = $controller->getAccessList($data);
		
		$i = 1;
		if($result['0'] == 1){while($row = $result['2']->fetch_assoc()){
			echo'
			<tr>
				<td>'.$i++.'</td>
				<td>'.$row['user_fullname'].'</td>
				<td>'.$row['module_name'].'</td>
				<td>'.($row['modacc_role'] == 1 ? "Manager" : "Staff").'</td>
				<td><a href="javascript:void(0);" title="Modify access" 
						data-toggle="modal" data-target="#modal-input" rowID="'.$row['modacc_no'].'" 
						data-backdrop="static" data-keyboard="false" data-type="modifyAccess">
						<i class="fas fa-external-link-alt"></i>
					</a>
				</td>
			</tr>';
		}} else {
			echo '<tr><td colspan="5">'.$result['1'].'</td></tr>';
		}
		
	} else if($_POST['data']['0'] == "updateModule"){
		$data = array_values($_POST);
		$result = $controller->updateModule($data);
		
		echo '<option value="%">Select module name</option>';
		if($result['0'] == 1){while($row = $result['2']->fetch_assoc()){
			echo '<option value="'.$row['module_slug'].'">'.$row['module_name'].'</option>';
		}} else {
			echo '<option value="">'.$result['1'].'</option>';
		}
		
	} else if($_POST['data']['0'] == "checkAccess"){
		$data = array_values($_POST);
		$result = $controller->checkAccess($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();	
	}
}
?>