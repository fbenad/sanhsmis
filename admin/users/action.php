<?php
session_start();
require_once("../../config/dbconfig.php");
require_once("../../config/settings.php");
require_once("controller.php");

$controller = new Controller();

if(isset($_POST['data'])){	

	if($_POST['data']['0'] == "getUsers"){
		$data = array_values($_POST);
		$result = $controller->getUsers($data);
		
		$i = 1;
		if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
			$result2 = $controller->checkAccess($row['user_no'], '');
			
			echo '
			<tr>
				<td>'.$i++.'</td>
				<td title="'.$row['user_no'].'">'.$row['user_fullname'].'</td>
				<td>'.$row['user_name'].'</td>				
				<td>'.($row['user_role'] == 1 || $row['user_role'] == 2 ? "Employee" : "Student").'</td>
				<td>';
					if($result2['0'] == 1){
						echo '
						<a href="javascript:void(0);" title="View access for user #'.$row['user_no'].'"
							data-toggle="modal" data-target="#modal-input" 
							rowID="'.$row['user_no'].'" data-type="viewAccess">
							<i class="fas fa-user-lock"></i>
						</a>';
					} else if ($row['user_role'] == 1){
						echo 'All modules';
					}
				echo'	
				</td>	
				<td>'.($row['user_status'] == 1 ? "Active" : "Inactive").'</td>
				<td><button class="btn btn-info btn-xs" href="javascript:void(0);" title="Modify user #'.$row['user_no'].'"
						data-toggle="modal" data-target="#modal-input" 
						rowID="'.$row['user_no'].'" data-type="modifyUser">
						<i class="fas fa-user-edit"></i>
					</button>
				</td>
			</tr>';
			echo "<script>$('#entity-list-count').html(' ('+$result[3]+') ');</script>";
			
		}} else {
			echo '<tr><td colspan="5">'.$result['1'].'</td></tr>';
		}
		
	} else if($_POST['data']['0'] == "getUserCount"){
		$data = array_values($_POST);
		$result = $controller->getUserCount($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();	
		
	} else if($_POST['data']['0'] == "showAction"){
		$data = array_values($_POST);
		
		if($_POST['data']['1'] == "addUser"){
			?>
			<div class="row">
				<div class="col-md-12 col-form-label">
					<label>User source *</label>
					<select class="form-control" id="user_role" name="user_role" onchange="updateUserNo();" required autofocus>
						<option value="">Select user type</option>
						<option value="2">Employee</option>
						<option value="3">Student</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-form-label">
					<label>Name *</label>
					<select class="form-control" id="user_no" name="user_no" onchange="updateUsername();" required>
						<option value="">Select name</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-form-label">
					<label>Username *</label>
					<input type="text" class="form-control" id="user_name" name="user_name" onfocus="checkUsername();" onkeyup="checkUsername();" required>
					<label id="for-username-error"><font color="red"><small><small>Username is no longer available. Modify username by appending any single digit number.</small></small></font></label>
					<script>$('#for-username-error').hide();</script>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-form-label">
					<label id="for-user-pass">Password </label>
					<input type="text" class="form-control" id="user_pass" name="user_pass" value="<?php echo $default_pass;?>" readonly>
					<input type="hidden" class="form-control" id="user_fullname" name="user_fullname">
				</div>
			</div>
			<?php
			
		} else if($_POST['data']['1'] == "modifyUser"){
			?>
			<div class="row">
				<div class="col-md-12 col-form-label">
					<label>Name *</label>
					<input type="text" class="form-control" id="user_fullname" name="user_fullname" required>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-form-label">
					<label>Username *</label>
					<input type="text" class="form-control" id="user_name" name="user_name" onkeyup="checkUsername();" required>
					<label id="for-username-error"><font color="red"><small><small>Username is no longer available. Modify username by appending any single digit number.</small></small></font></label>
					<script>$('#for-username-error').hide();</script>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-form-label">
					<label>User type *</label>
					<select class="form-control" id="user_role" name="user_role" required autofocus>
						<option value="">Select user type</option>
						<option value="2">Employee</option>
						<option value="3">Student</option>
						<option value="1">Administrator</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-form-label">
					<label>Actions *</label><br>
					<div class="btn-group">
						<button type="button" class="btn btn-danger" id="user-disabled" title="Disable/lock user" onclick="return confirm('Disable user?') ? resetUser(0) : false;"><i class="fas fa-user-slash"></i></button>
						<button type="button" class="btn btn-success" id="user-reset" title="Delete reset account/password" onclick="return confirm('Reset user/password? If yes, password will be reset to P@ssw0rd.') ? resetUser(1) : false;"><i class="fas fa-sync"></i></button>
					</div>
				</div>
			</div>				
			<?php
			
		} else if($_POST['data']['1'] == "getUser"){
			$result = $controller->getUser($data);
			
			header("Content-Type: application/json");
			echo json_encode($result);

			exit();	
			
		} else if($_POST['data']['1'] == "viewAccess"){
			$result = $controller->loadModules();
			
			echo '
			<div class="card-body  table-responsive p-0">
				<small>
				<table class="table-bordered table-hover"width="100%">
					<tr>
						<th>#</th>
						<th>Module name</th>
						<th colspan="2">Role</th>
					</tr>';
			$i = 1;
			if($result['0'] == 1){while($row = $result['2']->fetch_assoc()){
				$result2 = $controller->checkAccess($data['0']['2'], " AND modacc_module_slug = '".$row['module_slug']."' ");
				
				if($result2['0'] == 1){ $row2 = $result2['2'];
					$role = $row2['modacc_role'];
				} else {
					$role = "0";
				}
				
				echo 
				'<tr>
					<td>'.$i++.'</td>
					<td>'.$row['module_name'].'
						<input type="hidden" id="modacc_module_slug" value="'.$row['module_slug'].'">
					</td>
					<td align="center"><input type="radio" id="modacc_role" name="modacc_role'.$i.'" disabled '.($role == 1 ? "checked" : "").' value="1"> Manager</td>
					<td align="center"><input type="radio" id="modacc_role" name="modacc_role'.$i.'" disabled '.($role == 2 ? "checked" : "").' value="2"> Staff</td>
				</tr>';
			}} else {
				echo $result['1'];
			}
			echo '
				</table>
				</small>
			</div>'; 			
		}
		
	} else if($_POST['data']['0'] == "submitAction"){
		$data = array_values($_POST);
		
		if($_POST['data']['1'] == "addUser"){
			$result = $controller->addUser($data);
			
			header("Content-Type: application/json");
			echo json_encode($result);

			exit();
			
		} else if($_POST['data']['1'] == "modifyUser"){
			$result = $controller->modifyUser($data);
			
			header("Content-Type: application/json");
			echo json_encode($result);

			exit();
		}
		
	} else if($_POST['data']['0'] == "updateUserNo"){
		$data = array_values($_POST);
		$result = $controller->updateUserNo($data);
		
		echo '<option value="">Select name</option>';
		if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
			echo '<option value="'.$row['u_no'].'">'.$row['u_lname'].", ".$row['u_fname'].($row['u_xname'] == "" ? "" : ", ".$row['u_xname']).", ".$row['u_mname'].'</option>';
		}} else {
			echo '<option value="">'.$result['1'].'</option>';
		}
		
	} else if($_POST['data']['0'] == "checkUsername"){
		$data = array_values($_POST);
		$result = $controller->checkUsername($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();	
		
	} else if($_POST['data']['0'] == "resetUser"){
		$data = array_values($_POST);
		$result = $controller->resetUser($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();	
		
	}

}
?>