<?php
session_start();
require_once("../../config/dbconfig.php");
require_once("../../config/settings.php");
require_once("controller.php");

$controller = new Controller();

if(isset($_POST['data'])){	

	if($_POST['data']['0'] == "getSchoolYears"){
		$data = array_values($_POST);
		$result = $controller->getSchoolYears($data);
		
		$i = 1;
		if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
			echo '
			<tr>
				<td>'.$i++.'</td>
				<td title="'.$row['settings_no'].'">'.$row['settings_sy'].'-'.($row['settings_sy']+1).'
					&nbsp;
					<a href="javascript:void(0);" onclick="return confirm(\'Activate school year '.$row['settings_sy'].'?\') ? activateSY('.$row['settings_sy'].') : false;">
						<i class="fas fa-'.($row['activated'] == 1 ? "toggle-on" : "toggle-off").'"></i>
					</a>
				</td>
				<td>'.$row['settings_pros'].'</td>
				<td>'.date('m/d/Y', strtotime($row['settings_bosy'])).'</td>
				<td>'.date('m/d/Y', strtotime($row['settings_eosy'])).'</td>
				<td><a href="javascript:void(0);" id="modify-schooldays" title="Modify school days" 
						data-toggle="modal" data-target="#modal-input" rowID="'.$row['settings_sy'].'" 
						data-backdrop="static" data-keyboard="false" data-type="modifySchoolDays">
						<i class="fas fa-folder-open"></i>
					</a>
				</td>
				<td><a href="javascript:void(0);" id="modify-schoolyear" title="Modify school year" 
						data-toggle="modal" data-target="#modal-input" rowID="'.$row['settings_sy'].'" 
						data-backdrop="static" data-keyboard="false" data-type="modifySchoolYear">
						<i class="fas fa-external-link-alt"></i>
					</a>
				</td>
				
			</tr>';
		}} else {
			echo '<tr><td colspan="7">'.$result['1'].'</td></tr>';
		}
		
	} if($_POST['data']['0'] == "getSchoolInfo"){
		$data = array_values($_POST);
		$result = $controller->getSchoolInfo($data);
		
		if($result['0'] == 1){ $row = $result['2'];
			echo '
			<tr>
				<th>School Code</th>
				<td>'.$row['current_school_code'].'</td>
				<td><input type="number" class="form-control" id="current_school_code" name="current_school_code" value="'.$row['current_school_code'].'" required></td>
			</tr>
			<tr>
				<th>EBEIS School Name</th>
				<td>'.$row['current_school_name'].'</td>
				<td><input type="text" class="form-control" id="current_school_name" name="current_school_name" value="'.$row['current_school_name'].'" required></td>
			</tr>
			<tr>				
				<th>Full School Name</th>
				<td>'.$row['current_school_full'].'</td>
				<td><input type="text" class="form-control" id="current_school_full" name="current_school_full" value="'.$row['current_school_full'].'" required></td>
			</tr>
			<tr>				
				<th>Short School Name</th>
				<td>'.$row['current_school_short'].'</td>
				<td><input type="text" class="form-control" id="current_school_short" name="current_school_short" value="'.$row['current_school_short'].'" required></td>
			</tr>
			<tr>				
				<th>School Address</th>
				<td>'.$row['current_school_address'].'</td>
				<td><input type="text" class="form-control" id="current_school_address" name="current_school_address" value="'.$row['current_school_address'].'" required></td>
			</tr>
			<tr>				
				<th>Schools District</th>
				<td>'.$row['current_school_district'].'</td>
				<td><input type="text" class="form-control" id="current_school_district" name="current_school_district" value="'.$row['current_school_district'].'" required></td>
			</tr>
			<tr>				
				<th>Schools Division</th>
				<td>'.$row['current_school_division'].'</td>
				<td><input type="text" class="form-control" id="current_school_division" name="current_school_division" value="'.$row['current_school_division'].'" required></td>
			</tr>
			<tr>				
				<th>Schools Region</th>
				<td>'.$row['current_school_region'].'</td>
				<td><input type="text" class="form-control" id="current_school_region" name="current_school_region" value="'.$row['current_school_region'].'" required></td>
			</tr>
			<tr>				
				<th>Schools Region Code</th>
				<td>'.$row['current_school_reg_code'].'</td>
				<td><input type="number" class="form-control" id="current_school_reg_code" name="current_school_reg_code" value="'.$row['current_school_reg_code'].'" required></td>
			</tr>
			<tr>				
				<th>School Contact #</th>
				<td>'.$row['current_school_contact'].'</td>
				<td><input type="text" class="form-control" id="current_school_contact" name="current_school_contact" value="'.$row['current_school_contact'].'" required></td>
			</tr>
			<tr>				
				<th>School Email</th>
				<td>'.$row['current_school_email'].'</td>
				<td><input type="email" class="form-control" id="current_school_email" name="current_school_email" value="'.$row['current_school_email'].'"></td>
			</tr>
			<tr>				
				<th>Lowest Grade Level Offering</th>
				<td>'.$row['current_school_minlevel'].'</td>
				<td><input type="number" class="form-control" min="0" max="12" id="current_school_minlevel" name="current_school_minlevel" value="'.$row['current_school_minlevel'].'"></td>
			</tr>
			<tr>				
				<th>Highest Grade Level Offering</th>
				<td>'.$row['current_school_maxlevel'].'</td>
				<td><input type="number" class="form-control" min="0" max="12" id="current_school_maxlevel" name="current_school_maxlevel" value="'.$row['current_school_maxlevel'].'"></td>
			</tr>';
		} else {
			echo '<tr><td colspan="2">'.$result['1'].'</td></tr>';
		}
		
	} else if($_POST['data']['0'] == "modfySchInfo"){
		$data = array_values($_POST);
		$result = $controller->modfySchInfo($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();	
		
	} else if($_POST['data']['0'] == "activateSY"){
		$data = array_values($_POST);
		$result = $controller->activateSY($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();	
		
	} else if($_POST['data']['0'] == "showAction"){
		$data = array_values($_POST);
		
		if($_POST['data']['1'] == "addSchoolYear"){
			?>
			<div class="row">
				<div class="col-md-4 col-form-label">
					<label>School Year *</label>
					<select class="form-control" id="settings_sy" name="settings_sy" required>
						<option value="">Select school year</option>
						<?php
						for($i = $_SESSION['current_sy']+1; $i >= $_SESSION['current_sy']-50; $i--){
							$result = $controller->checkSY($i);
							
							if($result['0'] == 1){
								echo '<option value="'.$i.'" disabled>'.$i.' (already exists)</option>';
							} else{
								echo '<option value="'.$i.'">'.$i.'</option>';
							}
							
						}
						?>
					</select>
				</div>
				<div class="col-md-4 col-form-label">
					<label>Curriculum Year *</label>
					<select class="form-control" id="settings_pros" name="settings_pros" required autofocus>
						<option value="">Select curriculum year</option>
						<?php
						$result = $controller->checkCurrYears();
						
						if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
							echo '<option value="'.$row['pros_curr'].'">'.$row['pros_curr'].'</option>';
						}} else{
							echo '<option value="">'.$result['1'].'</option>';
						}							
						?>
					</select>
				</div>
				<div class="col-md-4 col-form-label">
					<label>School Registrar **</label>
					<input type="text" class="form-control" id="settings_registrar" name="settings_registrar" placeholder="APOLINARIO M. MABINI, JR." required>
				</div>
				<div class="col-md-4 col-form-label">
					<label>School Principal **</label>
					<input type="text" class="form-control" id="settings_principal" name="settings_principal" placeholder="ANDRES D. BONIFACIO" required>
				</div>
				<div class="col-md-4 col-form-label">
					<label>Public Schools District Supsvr **</label>
					<input type="text" class="form-control" id="settings_supervisor" name="settings_supervisor" placeholder="GREGORIO P. DEL PILAR" required>
				</div>
				<div class="col-md-4 col-form-label">
					<label>Schools Division Rep. **</label>
					<input type="text" class="form-control" id="settings_representative" name="settings_representative" placeholder="JOSE P. RIZAL, PhD" required>
				</div>
				<div class="col-md-4 col-form-label">
					<label>Schools Division Supt. **</label>
					<input type="text" class="form-control" id="settings_superintendent" name="settings_superintendent" placeholder="EMILIO F. AGUINALDO, EdD" required>
				</div>
				<div class="col-md-4 col-form-label">
					<label>BOSY Date *</label>
					<input type="date" class="form-control" id="settings_bosy" name="settings_bosy" min="<?php echo date('Y-m-d',  strtotime('-1 year'));?>" max="<?php echo date('Y-m-d', strtotime('+1 year'));?>" required>
				</div>
				<div class="col-md-4 col-form-label">
					<label>EOSY Date *</label>
					<input type="date" class="form-control" id="settings_eosy" name="settings_eosy" min="<?php echo date('Y-m-d',  strtotime('-1 year'));?>" max="<?php echo date('Y-m-d', strtotime('+1 year'));?>" required>
				</div>
				<div class="col-md-3 col-form-label">
					<label>Late Date (1st Sem) *</label>
					<input type="date" class="form-control" id="settings_late1" name="settings_late1" min="<?php echo date('Y-m-d',  strtotime('-1 year'));?>" max="<?php echo date('Y-m-d', strtotime('+1 year'));?>" required>
				</div>
				<div class="col-md-3 col-form-label">
					<label>Late Date (2nd Sem) *</label>
					<input type="date" class="form-control" id="settings_late2" name="settings_late2"  min="<?php echo date('Y-m-d',  strtotime('-1 year'));?>" max="<?php echo date('Y-m-d', strtotime('+1 year'));?>" required>
				</div>
				<div class="col-md-3 col-form-label">
					<label>Closing Date *</label>
					<input type="date" class="form-control" id="settings_closing" name="settings_closing" min="<?php echo date('Y-m-d',  strtotime('-1 year'));?>" max="<?php echo date('Y-m-d', strtotime('+1 year'));?>" required>
				</div>
				<div class="col-md-3 col-form-label">
					<label>Note</label>
					<p style="line-height: 0.7">
					<small><small>
					<strong>**</strong> Fill with "-" for uknown names.<br>
					<strong>BOSY</strong> - First day of classes.<br>
					<strong>EOSY</strong> - Last day of classes.<br>
					<strong>Closing Date</strong> - Commencement rite date.<br>
					</small></small>
					</p>
				</div>

			</div>
			<?php
			
		} else if($_POST['data']['1'] == "modifySchoolYear"){
			$data = array_values($_POST);
			$result = $controller->getSchoolYear($data);
			
			header("Content-Type: application/json");
			echo json_encode($result);

			exit();	
			
		} else if($_POST['data']['1'] == "modifySchoolDays"){
			$data = array_values($_POST);
			$result = $controller->getSchoolDays($data);
			
			if($result['0'] == 1){ $row = $result['2'];
				?>
				<div class="row">
					<div class="col-md-12 col-form-label">
						<label>Date of first day: </label> <a href="javascript:void(0);" title="Edit BOSY date of the edit school year to change date of first day."><?php echo date('F j, Y', strtotime($row['sch_firstday']));?></a>
					</div>
					<div class="col-md-3 col-form-label">
						<label>June *</label>
						<input type="number" class="form-control" id="sch_m1" name="sch_m1" placeholder="0" min="0" max="31" value="<?php echo $row['sch_m1'];?>" required>
					</div>
					<div class="col-md-3 col-form-label">
						<label>July *</label>
						<input type="number" class="form-control" id="sch_m2" name="sch_m2" placeholder="0" min="0" max="31" value="<?php echo $row['sch_m2'];?>" required>
					</div>
					<div class="col-md-3 col-form-label">
						<label>August *</label>
						<input type="number" class="form-control" id="sch_m3" name="sch_m3" placeholder="0" min="0" max="31" value="<?php echo $row['sch_m3'];?>" required>
					</div>
					<div class="col-md-3 col-form-label">
						<label>September *</label>
						<input type="number" class="form-control" id="sch_m4" name="sch_m4" placeholder="0" min="0" max="31" value="<?php echo $row['sch_m4'];?>" required>
					</div>
					<div class="col-md-3 col-form-label">
						<label>October *</label>
						<input type="number" class="form-control" id="sch_m5" name="sch_m5" placeholder="0" min="0" max="31" value="<?php echo $row['sch_m5'];?>" required>
					</div>
					<div class="col-md-3 col-form-label">
						<label>November *</label>
						<input type="number" class="form-control" id="sch_m6" name="sch_m6" placeholder="0" min="0" max="31" value="<?php echo $row['sch_m6'];?>" required>
					</div>
					<div class="col-md-3 col-form-label">
						<label>December *</label>
						<input type="number" class="form-control" id="sch_m7" name="sch_m7" placeholder="0" min="0" max="31" value="<?php echo $row['sch_m7'];?>" required>
					</div>
					<div class="col-md-3 col-form-label">
						<label>January *</label>
						<input type="number" class="form-control" id="sch_m8" name="sch_m8" placeholder="0" min="0" max="31" value="<?php echo $row['sch_m8'];?>" required>
					</div>
					<div class="col-md-3 col-form-label">
						<label>February *</label>
						<input type="number" class="form-control" id="sch_m9" name="sch_m9" placeholder="0" min="0" max="31" value="<?php echo $row['sch_m9'];?>" required>
					</div>
					<div class="col-md-3 col-form-label">
						<label>March *</label>
						<input type="number" class="form-control" id="sch_m10" name="sch_m10" placeholder="0" min="0" max="31" value="<?php echo $row['sch_m10'];?>" required>
					</div>
					<div class="col-md-3 col-form-label">
						<label>April *</label>
						<input type="number" class="form-control" id="sch_m11" name="sch_m11" placeholder="0" min="0" max="31" value="<?php echo $row['sch_m11'];?>" required>
					</div>
					<div class="col-md-3 col-form-label">
						<label>May *</label>
						<input type="number" class="form-control" id="sch_m12" name="sch_m12" placeholder="0" min="0" max="31" value="<?php echo $row['sch_m12'];?>" required>
					</div>
				</div>				
				<?php
			} else {
				echo $result['1'];
			}
		}
		
	} else if($_POST['data']['0'] == "submitAction"){
		$data = array_values($_POST);
		
		if($_POST['data']['1'] == "addSchoolYear"){
			$result = $controller->addSchoolYear($data);
			
			header("Content-Type: application/json");
			echo json_encode($result);

			exit();				
		} else if($_POST['data']['1'] == "modifySchoolYear"){
			$result = $controller->modifySchoolYear($data);
			
			header("Content-Type: application/json");
			echo json_encode($result);

			exit();	
			
		} else if($_POST['data']['1'] == "addSchoolDays"){
			$result = $controller->addSchoolDays($data);
			
			header("Content-Type: application/json");
			echo json_encode($result);

			exit();				
			
		} else if($_POST['data']['1'] == "modifyBOSY"){
			$result = $controller->modifyBOSY($data);
			
			header("Content-Type: application/json");
			echo json_encode($result);

			exit();				
			
		} else if($_POST['data']['1'] == "modifySchoolDays"){
			$result = $controller->modifySchoolDays($data);
			
			header("Content-Type: application/json");
			echo json_encode($result);

			exit();				
		}		
	}
}
?>