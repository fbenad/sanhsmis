<?php
session_start();
require_once("../../../config/dbconfig.php");
require_once("../../../config/settings.php");
require_once("controller.php");

$controller = new Controller();

if(isset($_POST['data'])){	

	if($_POST['data']['0'] == "getPart1"){
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
								<div class="card-body">
									<div class="row">
										<div class="col-md-12 col-form-label">
											<label>Firstname *</label>
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
		?>
		<div class="col-md-12">
			<div class="card">
				<form role="form" id="form" method="post" onSubmit="return false;">	
				<div class="card-body">
					<div class="row">
						<div class="col-md-7">
							<div class="card card-primary">
								<div class="card-header bg-white">
									<h3 class="card-title">Employee</h3>
								</div>
								<div class="card-body table-responsive p-0">
									<table class="table">
										<tbody>
											<tr><td>Employee # *</td><td><input type="number" class="form-control" id="teach_id" name="teach_id" min="100000" max="999999999" onkeyup="checkTeachID();"></td></tr>
											<tr><td>First name *</td><td><input type="text" class="form-control" id="teach_fname" name="teach_fname" minlength="3" value="<?php echo $_SESSION['search_firstname'];?>" readonly></td></tr>
											<tr><td>Middle name</td><td><input type="text" class="form-control" id="teach_mname" name="teach_mname" placeholder="MARANAN" onkeyup="supplyFullname();"></td></tr>
											<tr><td>Last name *</td><td><input type="text" class="form-control" id="teach_lname" name="teach_lname" minlength="3" value="<?php echo $_SESSION['search_lastname'];?>" readonly></td></tr>
											<tr><td>Ext. name</td><td><select class="form-control" id="teach_xname" name="teach_xname" onchange="supplyFullname();">
													<?php
													$result = $controller->getDropdowns(" field_category LIKE 'FIELD_EXT' ");
													
													if($result['0'] == 1){while($row = $result['2']->fetch_assoc()){
														echo '<option value="'.$row['field_name'].'">'.($row['field_name'] == "" ? "N/A" : $row['field_name']).'</option>';
													}} else {
														echo '<option value="">'.$result['1'].'</option>';
													}
													?>
													</select>
												</td>
											</tr>
											<tr><td>Sex *</td><td><select class="form-control" id="teach_gender" name="teach_gender" required>
													<?php
													$result = $controller->getDropdowns(" field_category LIKE 'GENDER' ");
													
													echo '<option value="">Select sex</option>';
													if($result['0'] == 1){while($row = $result['2']->fetch_assoc()){
														echo '<option value="'.$row['field_name'].'">'.$row['field_name'].'</option>';
													}} else {
														echo '<option value="">'.$result['1'].'</option>';
													}
													?>
													</select>
												</td>
											</tr>
											<tr><td>Birth date *</td><td><input type="date" class="form-control" id="teach_bdate" name="teach_bdate" min="<?php echo date('Y-m-d', strtotime('-50 years'));?>" max="<?php echo date('Y-m-d', strtotime('-18 years'));?>" required></td></tr>
											<tr><td>Residence *</td><td><input list="addresses" type="text" class="form-control" id="teach_residence" name="teach_residence" minlength="3" placeholder="<?php echo $sch_address2.", ".$sch_citymun.", ".$sch_province;?>" required>
													<datalist id="addresses">
													<?php
													$result = $controller->getDropdowns(" field_category LIKE 'RESIDENCE' ");
													
													if($result['0'] == 1){while($row = $result['2']->fetch_assoc()){
														echo '<option value="'.$row['field_name'].'">';
													}} else {
														// no error handling
													}
													?>	
													</datalist>
													<small><small><i>(Barangay, Municipality/City, Province)</i></small></small>
												</td>
											</tr>
											<tr><td>Civil status *</td><td><select class="form-control" id="teach_cstatus" name="teach_cstatus" required>
													<?php
													$result = $controller->getDropdowns(" field_category LIKE 'CSTATUS' ");
													
													echo '<option value="">Select civil status</option>';
													if($result['0'] == 1){while($row = $result['2']->fetch_assoc()){
														echo '<option value="'.$row['field_name'].'">'.$row['field_name'].'</option>';
													}} else {
														echo '<option value="">'.$result['1'].'</option>';
													}
													?>
													</select>
												</td>
											</tr>
											<tr><td>Phone *</td><td><input type="text" class="form-control" id="teach_dialect" name="teach_dialect" minlength="11"  maxlength="11"  placeholder="09201234567" onkeyup="checkPhone();" required></td></tr>
											<tr><td>Email *</td><td><input type="email" class="form-control" id="teach_ethnicity" name="teach_ethnicity" placeholder="<?php echo $sch_email;?>" onkeyup="checkEmail();" required></td></tr>	
											<tr><td>TIN *</td><td><input type="number" class="form-control" id="teach_tin" name="teach_tin" min="100000000" max="999999999" placeholder="123456789" onkeyup="checkTIN();" required></td></tr>											
										</tbody>												
									</table>
								</div>
							</div>
						</div>
						<div class="col-md-5">
							<div class="card card-primary">
								<div class="card-header bg-white">
									<h3 class="card-title">Biometrics</h3>
								</div>
								<div class="card-body table-responsive p-0">
									<table class="table">
										<tbody>
											<tr><td width="35%">Fingerprint # *</td><td>
													<input type="number" class="form-control" id="teach_bio_no" name="teach_bio_no" min="1"  max="10000" placeholder="24" onkeyup="checkBiometricID();" required>
													<input type="hidden" class="form-control" id="teach_status" name="teach_status" value="1">
												</td>
											</tr>											
										</tbody>												
									</table>
								</div>
							</div>
							<div class="card card-primary">
								<div class="card-header bg-white">
									<h3 class="card-title">Appointment *</h3>
								</div>
								<div class="card-body table-responsive p-0">
									<table class="table">
										<tbody>
											<tr><td width="35%">Type *</td><td>
													<select class="form-control" id="teach_teacher" name="teach_teacher" onchange="updatePosition();" required>
														<option value="">Select type</option>
														<option value="1">Teaching</option>
														<option value="0">Non-teaching</option>
													</select>
												</td>
											</tr>
											
											<tr><td>Position *</td><td>
													<select class="form-control" id="teacherappointments_position" name="teacherappointments_position" required>
													<?php
													$result = $controller->getDropdowns(" field_category LIKE 'POSITION' ");
													
													echo '<option value="">Select position</option>';
													if($result['0'] == 1){while($row = $result['2']->fetch_assoc()){
														echo '<option value="'.$row['field_name'].'">'.substr($row['field_ext'], 2).'</option>';
													}} else {
														echo '<option value="">'.$result['1'].'</option>';
													}
													?>
													</select>
												</td>
											</tr>
											<tr><td>Item # *</td><td><input type="text" class="form-control" id="teacherappointments_item_no" name="teacherappointments_item_no" minlength="3" maxlength="50" placeholder="TCH1-123456-2012" required></td></tr>
											<tr><td>Date *</td><td><input type="date" class="form-control" id="teacherappointments_date" name="teacherappointments_date" min="<?php echo date('Y-m-d', strtotime('-1 month'));?>" max="<?php echo date('Y-m-d');?>" required></td></tr>
											<tr><td>First Day *</td><td><input type="date" class="form-control" id="teacherappointments_fdaydate" name="teacherappointments_fdaydate" min="<?php echo date('Y-m-d', strtotime('-1 month'));?>" max="<?php echo date('Y-m-d');?>" required></td></tr>
											<tr><td>Status *</td><td>
													<select class="form-control" id="teacherappointments_status" name="teacherappointments_status" required>
													<?php
													$result = $controller->getDropdowns(" field_category LIKE 'STATUS' ");
													
													echo '<option value="">Select status</option>';
													if($result['0'] == 1){while($row = $result['2']->fetch_assoc()){
														echo '<option value="'.$row['field_name'].'">'.$row['field_name'].'</option>';
													}} else {
														echo '<option value="">'.$result['1'].'</option>';
													}
													?>
													</select>
												</td>
											</tr>
											<tr><td>Funding *</td><td>
													<select class="form-control" id="teacherappointments_funding" name="teacherappointments_funding" required>
													<?php
													$result = $controller->getDropdowns(" field_category LIKE 'FUNDING' ");
													
													echo '<option value="">Select funding</option>';
													if($result['0'] == 1){while($row = $result['2']->fetch_assoc()){
														echo '<option value="'.$row['field_name'].'">'.$row['field_name'].'</option>';
													}} else {
														echo '<option value="">'.$result['1'].'</option>';
													}
													?>
													</select>
													<input type="hidden" class="form-control" id="teacherappointments_active" name="teacherappointments_active" value="1" required>
												</td>
											</tr>
										</tbody>												
									</table>
								</div>
							</div>							
							<div class="card card-primary">
								<div class="card-header bg-white">
									<h3 class="card-title">User Access</h3>
								</div>
								<div class="card-body table-responsive p-0">
									<table class="table">
										<tbody>
											<tr><td width="35%">Fullname *</td><td><input type="text" class="form-control" id="user_fullname" name="user_fullname" minlength="8" maxlength="100" readonly></td></tr>
											<tr><td width="35%">Username *</td><td><input type="text" class="form-control" id="user_name" name="user_name" minlength="8" maxlength="25" onkeyup="checkUsername();" required></td></tr>
											<tr><td>Password*</td><td><input type="text" class="form-control" id="user_pass" name="user_pass" value="<?php echo $default_pass;?>" readonly required></td></tr>
										</tbody>												
									</table>
								</div>
							</div>										
						</div>
					</div>
				</div>
				<div class="card-footer clearfix">
					<div class="row">
						<div class="col-md-4">
							<button type="button" class="btn btn-default" id="btnCancel" name="btnCancel" onclick="window.location = '?p=employees&new';">Cancel</button>
						</div>
						<div class="col-md-4">
						</div>
						<div class="col-md-4">
							<button class="btn btn-info float-right" id="btnSubmit" name="btnSubmit" onclick="return confirm('Save employee?') ? saveEntity() : false;">Submit</button>
						</div>
					</div>
				</div>
			</div>
		</div>			
		<?php
		
	} else if($_POST['data']['0'] == "searchEntity"){
		$data = array_values($_POST);
		$result = $controller->searchEntity($data);
		
		$i = 1;
		if($result['0'] == 1){while($row = $result['2']->fetch_assoc()){
			echo '
			<tr>
				<td>'.$i++.'</td>
				<td title="'.$row['teach_no'].'">'.strtoupper($row['teach_lname'].", ".$row['teach_fname']."".($row['teach_xname'] == "" ? "" : ", ".$row['teach_xname']).", ".$row['teach_mname']).'</td>
				<td>'.$row['teach_gender'].'</td>
				<td>'.date('m/d/Y', strtotime($row['teach_bdate'])).'</td>
				<td><a href="?p=employees&show='.$row['teach_no'].'"><i class="fas fa-user-tie" title="View employee"></i></a></td>
			</tr>';
		}} else{
			echo '<tr><td colspan="5">'.$result['1'].'</td></tr>';
		}
		
		echo "<script>$('#entity-search-count').html(".$result['3']."+' record(s) found');</script>";
		
	} else if($_POST['data']['0'] == "gotoNext"){
		$data = array_values($_POST);
		$_SESSION['search_firstname'] = $data['0']['1'] ;
		$_SESSION['search_lastname'] = $data['0']['2'] ;
		
	} else if($_POST['data']['0'] == "cancelSearch"){
		$data = array_values($_POST);
		unset($_SESSION['search_firstname']);
		unset($_SESSION['search_lastname']);
	
	} else if($_POST['data']['0'] == "saveEntity"){
		$data = array_values($_POST);
		$result = $controller->saveEntity($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();	
		
	} else if($_POST['data']['0'] == "checkUsername"){
		$data = array_values($_POST);
		$result = $controller->checkUsername($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();	
		
	} else if($_POST['data']['0'] == "checkEntity"){
		$data = array_values($_POST);
		$result = $controller->checkEntity($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();	
		
	} else if($_POST['data']['0'] == "addAppointment"){
		$data = array_values($_POST);
		$result = $controller->addAppointment($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();	
		
	} else if($_POST['data']['0'] == "addUserAccess"){
		$data = array_values($_POST);
		$result = $controller->addUserAccess($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();	
		
	} else if($_POST['data']['0'] == "updatePosition"){
		$data = array_values($_POST);
		$result = $controller->getDropdowns(" field_category LIKE 'POSITION' AND field_ext LIKE '".$_POST['data']['1']."%'");
													
		echo '<option value="">Select position</option>';
		if($result['0'] == 1){while($row = $result['2']->fetch_assoc()){
			echo '<option value="'.$row['field_name'].'">'.substr($row['field_ext'], 2).'</option>';
		}} else {
			echo '<option value="">'.$result['1'].'</option>';
		}
		
	} else if($_POST['data']['0'] == "getBasic"){
		$data = array_values($_POST);
		$result = $controller->getBasic($data );

		echo '
		<table class="table">
			<thead>
				<tr>
					<th width="17%">Field</th>
					<th width="40%">Details</th>
					<td align="right"><a href="javascript:void(0);"  id="entity-edit-button" title="Modify employee"></a></td>
				</tr>
			</thead>
			<tbody>	';	

			if($result['0'] == 1){
				$row = $result['2'];
				$name = "<strong>".$row['teach_lname'].", ".$row['teach_fname'].($row['teach_xname'] == "" ? "" : ", ".$row['teach_xname']).", ".$row['teach_mname']."</strong><br><small>".$row['teach_id']."</small>";
				echo "<script>$('#entity-name').html('<h3>".$name."</h3>')</script>";
				$withImage = "../assets/images/teachers/".$row['teach_no'].".jpg";
				$noImage = "../assets/avatars/".$row['teach_gender'].".jpg";
				?>
				<tr>
					<td colspan="2">
						<div class="col-md-3">
							<img src="<?php echo (file_exists("../../".$withImage) ? $withImage : $noImage); ?>"
								alt="User profile picture"
								style="border: 1px solid #ddd; border-radius: 4px; padding: 5px; width: 98%;">
						</div>
					</td>
					<td></td>
				</tr>
				<tr>
					<th>Employee # *</th>
					<td><?php echo $row['teach_id'];?></td>
					<td><input type="number" class="form-control" id="teach_id" name="teach_id" value="<?php echo $row['teach_id'];?>" min="100000" max="999999999" onkeyup="checkTeachID();"></td>
				</tr>
				<tr>
					<th>First name *</th>
					<td><?php echo $row['teach_fname'];?></td>
					<td><input type="text" class="form-control" id="teach_fname" name="teach_fname" value="<?php echo $row['teach_fname'];?>" minlength="3" value=""></td>
				</tr>
				<tr>
					<th>Middle name</th>
					<td><?php echo $row['teach_mname'];?></td>
					<td><input type="text" class="form-control" id="teach_mname" name="teach_mname" value="<?php echo $row['teach_mname'];?>" placeholder="MARANAN"></td>
				</tr>
				<tr>
					<th>Last name *</th>
					<td><?php echo $row['teach_lname'];?></td>
					<td><input type="text" class="form-control" id="teach_lname" name="teach_lname" value="<?php echo $row['teach_lname'];?>" minlength="3" value=""></td>
				</tr>
				<tr>
					<th>Ext. name</th>
					<td><?php echo $row['teach_xname'];?></td>
					<td><select class="form-control" id="teach_xname" name="teach_xname">
						<?php
						$result = $controller->getDropdowns(" field_category LIKE 'FIELD_EXT' ");
						
						if($result['0'] == 1){while($row1 = $result['2']->fetch_assoc()){
							echo '<option value="'.$row1['field_name'].'">'.($row1['field_name'] == "" ? "N/A" : $row1['field_name']).'</option>';
						}} else {
							echo '<option value="">'.$result['1'].'</option>';
						}
						echo "<script>$('#teach_xname').val('".$row['teach_xname']."').change();</script>";
						?>
						</select>
					</td>
				</tr>
				<tr>
					<th>Sex *</th>
					<td><?php echo $row['teach_gender'];?></td>
					<td><select class="form-control" id="teach_gender" name="teach_gender" required>
						<?php
						$result = $controller->getDropdowns(" field_category LIKE 'GENDER' ");
						
						echo '<option value="">Select sex</option>';
						if($result['0'] == 1){while($row1 = $result['2']->fetch_assoc()){
							echo '<option value="'.$row1['field_name'].'">'.$row1['field_name'].'</option>';
						}} else {
							echo '<option value="">'.$result['1'].'</option>';
						}
						echo "<script>$('#teach_gender').val('".$row['teach_gender']."').change();</script>";
						?>
						</select>
					</td>
				</tr>
				<tr>
					<th>Birth date *</th>
					<td><?php echo date('F j, Y', strtotime($row['teach_bdate']));?></td>
					<td><input type="date" class="form-control" id="teach_bdate" name="teach_bdate" value="<?php echo $row['teach_bdate'];?>" min="<?php echo date('Y-m-d', strtotime('-50 years'));?>" max="<?php echo date('Y-m-d', strtotime('-18 years'));?>" required></td>
				</tr>
				<tr>
					<th>Residence *</th>
					<td><?php echo $row['teach_residence'];?></td>
					<td><input list="addresses" type="text" class="form-control" id="teach_residence" value="<?php echo $row['teach_residence'];?>" name="teach_residence" minlength="3" placeholder="<?php echo $sch_address2.", ".$sch_citymun.", ".$sch_province;?>" required>
						<datalist id="addresses">
						<?php
						$result = $controller->getDropdowns(" field_category LIKE 'RESIDENCE' ");
						
						if($result['0'] == 1){while($row1 = $result['2']->fetch_assoc()){
							echo '<option value="'.$row1['field_name'].'">';
						}} else {
							// no error handling
						}
						?>	
						</datalist>
						<small><small><i>(Barangay, Municipality/City, Province)</i></small></small>
					</td>
				</tr>
				<tr>
					<th>Civil status *</th>
					<td><?php echo $row['teach_cstatus'];?></td>
					<td><select class="form-control" id="teach_cstatus" name="teach_cstatus" required>
						<?php
						$result = $controller->getDropdowns(" field_category LIKE 'CSTATUS' ");
						
						echo '<option value="">Select civil status</option>';
						if($result['0'] == 1){while($row1 = $result['2']->fetch_assoc()){
							echo '<option value="'.$row1['field_name'].'">'.$row1['field_name'].'</option>';
						}} else {
							echo '<option value="">'.$result['1'].'</option>';
						}
						echo "<script>$('#teach_cstatus').val('".$row['teach_cstatus']."').change();</script>";
						?>
						</select>
					</td>
				</tr>
				<tr>
					<th>Phone *</th>
					<td><?php echo $row['teach_dialect'];?></td>
					<td><input type="text" class="form-control" id="teach_dialect" name="teach_dialect" value="<?php echo $row['teach_dialect'];?>" minlength="11"  maxlength="11"  placeholder="09201234567" onkeyup="checkPhone();" required></td>
				</tr>
				<tr>
					<th>Email *</th>
					<td><?php echo strtolower($row['teach_ethnicity']);?></td>
					<td><input type="email" class="form-control" id="teach_ethnicity" name="teach_ethnicity" value="<?php echo strtolower($row['teach_ethnicity']);?>" placeholder="<?php echo $sch_email;?>" onkeyup="checkEmail();" required></td>
				</tr>	
				<tr>
					<th>TIN *</th>
					<td><?php echo $row['teach_tin'];?></td>
					<td><input type="number" class="form-control" id="teach_tin" name="teach_tin" value="<?php echo $row['teach_tin'];?>" min="100000000" max="999999999" placeholder="123456789" onkeyup="checkTIN();" required></td>
				</tr>	
				<tr>
					<th>Biometrics ID *</th>
					<td><?php echo $row['teach_bio_no'];?></td>
					<td><input type="number" class="form-control" id="teach_bio_no" name="teach_bio_no" value="<?php echo $row['teach_bio_no'];?>" min="1" max="10000" placeholder="123456789" onkeyup="checkBiometricID();" required></td>
				</tr>				
				<?php
			} else {
				echo '<tr><td colspan="3">'.$result['1'].'</tr>';
			}
			
			echo '
			</tbody>												
		</table>';
		
	} else if($_POST['data']['0'] == "modifyEntity"){
		$data = array_values($_POST);
		$result = $controller->modifyEntity($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();	
		
	} else if($_POST['data']['0'] == "getOther1"){
		$data = array_values($_POST);
		?>
		<small>
		<table class="table">
			<thead>
				<tr>
					<th width="6%">#</th>
					<th>Name</th>
					<th width="30%">Relationship</th>
					<th width="10%">
						<a href="javascript:void(0);" class="float-right" title="Add family"
							data-toggle="modal" data-target="#modal-input" rowID="0" data-type="addFamily" data-backdrop="static" data-keyboard="false">
							<i class="fas fa-plus-square"></i>
						</a>
					</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$result = $controller->getFamily($data);
			
			$i = 1;
			if($result['0'] == 1){while($row = $result['2']->fetch_assoc()){
				echo '
				<tr>
					<td>'.$i++.'</td>
					<td>'.strtoupper($row['teachCont_lname'].", ".$row['teachCont_fname'].($row['teachCont_xname'] == "" ? "" : ", ".$row['teachCont_xname']).", ".$row['teachCont_mname']).'</td>
					<td>'.($row['teachCont_type'] == 1 ? "Husband/Wife" : "Child").'</td>
					<td><a href="javascript:void(0);" class="float-right" title="Modify family"
							data-toggle="modal" data-target="#modal-input" rowID="'.$row['teachCont_no'].'" data-type="modifyFamily" data-backdrop="static" data-keyboard="false">
							<i class="fas fa-external-link-alt"></i>
						</a>							
					</td>
				</tr>';
			}} else {
				echo '<tr><td colspan="4">'.$result['1'] .'</td></tr>';
			}
			?>
			</tbody>
		</table>
		</small>
		<?php
		
	} else if($_POST['data']['0'] == "getOther2"){
		$data = array_values($_POST);
		?>
		<small>
		<table class="table table-hover">
			<thead>
				<tr>
					<th width="6%">#</th>
					<th width="12%">Level</th>
					<th width="10%">Degree</th>
					<th>Major</th>
					<th width="15%">Minor</th>
					<th width="10%">Units</th>
					<th width="10%">
						<a href="javascript:void(0);" class="float-right" title="Add education"
							data-toggle="modal" data-target="#modal-input" rowID="0" data-type="addEducation" data-backdrop="static" data-keyboard="false">
							<i class="fas fa-plus-square"></i>
						</a>
					</th>				
				</tr>
			</thead>
			<tbody>
			<?php
			$result = $controller->getEducation($data);
			
			$i = 1;
			if($result['0'] == 1){while($row = $result['2']->fetch_assoc()){
				echo '
				<tr>
					<td>'.$i++.'</td>
					<td>'.$row['eback_level'].'</td>
					<td>'.strtoupper($row['eback_degree']).'</td>
					<td>'.strtoupper($row['eback_major']).'</td>
					<td>'.strtoupper($row['eback_minor']).'</td>
					<td>'.($row['eback_units'] == 100 ? "Graduated" : $row['eback_units']).'</td>
					<td><a href="javascript:void(0);" class="float-right" title="Modify education"
							data-toggle="modal" data-target="#modal-input" rowID="'.$row['eback_no'].'" data-type="modifyEducation" data-backdrop="static" data-keyboard="false">
							<i class="fas fa-external-link-alt"></i>
						</a>							
					</td>
				</tr>';
			}} else {
				echo '<tr><td colspan="7">'.$result['1'] .'</td></tr>';
			}
			?>
			</tbody>
		</table>
		<small>
		<?php
		
	} else if($_POST['data']['0'] == "getOther3"){
		$data = array_values($_POST);
		?>
		<small>
		<table class="table table-hover">
			<thead>
				<tr>
					<th width="6%">#</th>
					<th width="15%">ID Type</th>
					<th width="20%">ID Number</th>
					<th width="20%">Date Issued</th>
					<th>Place Issued</th>
					<th width="10%">
						<a href="javascript:void(0);" class="float-right" title="Add ID"
							data-toggle="modal" data-target="#modal-input" rowID="0" data-type="addID" data-backdrop="static" data-keyboard="false">
							<i class="fas fa-plus-square"></i>
						</a>
					</th>				
				</tr>
			</thead>
			<tbody>
			<?php
			$result = $controller->getIDs($data);
			
			$i = 1;
			if($result['0'] == 1){while($row = $result['2']->fetch_assoc()){
				echo '
				<tr>
					<td>'.$i++.'</td>
					<td>'.$row['teacherids_id'].'</td>
					<td>'.$row['teacherids_details'].'</td>
					<td>'.date('M j, Y', strtotime($row['teacherids_date_issued'])).'</td>
					<td>'.ucwords(strtolower($row['teacherids_place_issued'])).'</td>
					<td><a href="javascript:void(0);" class="float-right" title="Modify ID"
							data-toggle="modal" data-target="#modal-input" rowID="'.$row['teacherids_no'].'" data-type="modifyID" data-backdrop="static" data-keyboard="false">
							<i class="fas fa-external-link-alt"></i>
						</a>							
					</td>
				</tr>';
			}} else {
				echo '<tr><td colspan="6">'.$result['1'] .'</td></tr>';
			}
			?>
			</tbody>
		</table>
		</small>
		<?php
		
	} else if($_POST['data']['0'] == "getOther4"){
		$data = array_values($_POST);
		?>
		<div class="card">
			<div class="card-body table-responsive p-0" >
				<small>
				<table class="table">
					<thead>
						<tr>
							<th width="6%">#</th>
							<th width="20%">Appointment</th>
							<th>Plantilla Item #</th>
							<th width="19%">Date of Appointment</th>
							<th width="19%">First Day of Service</th>
							<th width="10%">
								<a href="javascript:void(0);" class="float-right" title="Add appointment"
									data-toggle="modal" data-target="#modal-input" rowID="0" data-type="addAppointment" data-backdrop="static" data-keyboard="false">
									<i class="fas fa-plus-square"></i>
								</a>
							</th>				
						</tr>
					</thead>
					<tbody>
					<?php
					$result = $controller->getAppointments($data, " INNER JOIN dropdowns ON teacherappointments_position = field_name ", " AND teacherappointments_item_no	NOT LIKE 'ANCILLARY' ");
					
					$i = 1;
					if($result['0'] == 1){while($row = $result['2']->fetch_assoc()){
						echo '
						<tr>
							<td>'.$i++.'</td>
							<td>'.strtoupper(substr($row['field_ext'], 2)).' '.($row['teacherappointments_active'] == 1 ? "<i class='fas fa-check'></i>" : "").'</td>
							<td>'.strtoupper($row['teacherappointments_item_no']).'</td>
							<td>'.date('M j, Y', strtotime($row['teacherappointments_date'])).'</td>
							<td>'.date('M j, Y', strtotime($row['teacherappointments_fdaydate'])).'</td>
							<td><a href="javascript:void(0);" class="float-right" title="Modify appointment"
									data-toggle="modal" data-target="#modal-input" rowID="'.$row['teacherappointments_no'].'" data-type="modifyAppointment" data-backdrop="static" data-keyboard="false">
									<i class="fas fa-external-link-alt"></i>
								</a>							
							</td>
						</tr>';
					}} else {
						echo '<tr><td colspan="6">'.$result['1'] .'</td></tr>';
					}
					?>
					</tbody>
				</table>
				</small>
			</div>
		</div>
		<br>
		<div class="card">
			<div class="card-body table-responsive p-0" >
				<small>
				<table class="table">
					<thead>
						<tr>
							<th width="6%">#</th>
							<th>Designation</th>
							<th width="20%">Date of Designation</th>
							<th width="10%">Start SY</th>
							<th width="15%">End SY</th>
							<th width="10%">
								<a href="javascript:void(0);" class="float-right" title="Add designation"
									data-toggle="modal" data-target="#modal-input" rowID="0" data-type="addDesignation" data-backdrop="static" data-keyboard="false">
									<i class="fas fa-plus-square"></i>
								</a>
							</th>				
						</tr>
					</thead>
					<tbody>
					<?php
					$result = $controller->getAppointments($data, "", " AND teacherappointments_item_no	LIKE 'ANCILLARY' ");
					
					$i = 1;
					if($result['0'] == 1){while($row = $result['2']->fetch_assoc()){
						echo '
						<tr>
							<td>'.$i++.'</td>
							<td>'.strtoupper($row['teacherappointments_position']).'</td>
							<td>'.date('M j, Y', strtotime($row['teacherappointments_date'])).'</td>
							<td>'.$row['teacherappointments_status'].'</td>
							<td>'.($row['teacherappointments_funding'] == 0 ? "until present" : $row['teacherappointments_funding']).'</td>
							<td><a href="javascript:void(0);" class="float-right" title="Modify designation"
									data-toggle="modal" data-target="#modal-input" rowID="'.$row['teacherappointments_no'].'" data-type="modifyDesignation" data-backdrop="static" data-keyboard="false">
									<i class="fas fa-external-link-alt"></i>
								</a>							
							</td>
						</tr>';
					}} else {
						echo '<tr><td colspan="6">'.$result['1'] .'</td></tr>';
					}
					?>
					</tbody>
				</table>
				</small>
			</div>
		</div>
		<?php
		
	} else if($_POST['data']['0'] == "showAction"){
		$data = array_values($_POST);
		
		if($_POST['data']['1'] == "addFamily"){
			?>
			<div class="row">
				<div class="col-md-3 col-form-label">
					<label>First name *</label>
				</div>
				<div class="col-md-9 col-form-label">
					<input type="text" class="form-control" id="teachCont_fname" name="teachCont_fname" placeholder="APOLINARIO" required autofocus>
				</div>
				<div class="col-md-3 col-form-label">
					<label>Middle name </label>
				</div>
				<div class="col-md-9 col-form-label">
					<input type="text" class="form-control" id="teachCont_mname" name="teachCont_mname" placeholder="MARANAN">
				</div>
				<div class="col-md-3 col-form-label">
					<label>Last name *</label>
				</div>
				<div class="col-md-9 col-form-label">
					<input type="text" class="form-control" id="teachCont_lname" name="teachCont_lname" placeholder="MABINI" required>
				</div>
				<div class="col-md-3 col-form-label">
					<label>Ext. name </label>
				</div>
				<div class="col-md-9 col-form-label">
					<select class="form-control" id="teachCont_xname" name="teachCont_xname">
					<?php
					$result = $controller->getDropdowns("field_category LIKE 'FIELD_EXT'");
					
					if($result['0'] == 1){while($row = $result['2']->fetch_assoc()){
						echo '<option value="'.$row['field_name'].'">'.($row['field_name'] == "" ? "N/A" : $row['field_name']).'</option>';
					}} else {
						echo '<option value="">'.$result['1'].'</option>';
					}
					?>
					</select>
				</div>
				<div class="col-md-3 col-form-label">
					<label>Relationship *</label>
				</div>
				<div class="col-md-9 col-form-label">
					<select class="form-control" id="teachCont_type" name="teachCont_type" required>
						<option value="">Select relationship</option>
						<option value="1">Husband/Wife</option>
						<option value="2">Child</option>
					</select>
				</div>
			</div>
			<?php
		} else if($_POST['data']['1'] == "addEducation"){
			?>
			<div class="row">
				<div class="col-md-3 col-form-label">
					<label>Educ'l Level *</label>
				</div>
				<div class="col-md-9 col-form-label">
					<select class="form-control" id="eback_level" name="eback_level" required>
					<?php
					$result = $controller->getDropdowns("field_category LIKE 'EDUCLEVEL'");
					
					echo '<option value="">Select level</option>';
					if($result['0'] == 1){while($row = $result['2']->fetch_assoc()){
						echo '<option value="'.$row['field_name'].'">'.$row['field_name'].'</option>';
					}} else {
						echo '<option value="">'.$result['1'].'</option>';
					}
					?>
					</select>
				</div>
				<div class="col-md-3 col-form-label">
					<label>Degree *</label>
				</div>
				<div class="col-md-9 col-form-label">
					<input type="text" class="form-control" id="eback_degree" name="eback_degree" placeholder="BSED" required>
				</div>
				<div class="col-md-3 col-form-label">
					<label>Major </label>
				</div>
				<div class="col-md-9 col-form-label">
					<input type="text" class="form-control" id="eback_major" name="eback_major" placeholder="Mathematics">
				</div>
				<div class="col-md-3 col-form-label">
					<label>Minor </label>
				</div>
				<div class="col-md-9 col-form-label">
					<input type="text" class="form-control" id="eback_minor" name="eback_minor" placeholder="Filipino">
				</div>
				<div class="col-md-3 col-form-label">
					<label>Units *</label>
				</div>
				<div class="col-md-9 col-form-label">
					<select class="form-control" id="eback_units" name="eback_units" required>
					<?php
					echo '<option value="">Select units obtained</option>';
					echo '<option value="100">GRADUATED</option>';
					for($i = 3; $i < 200; $i++){
						echo '<option value="'.$i.'">'.$i.' units</option>';
					}
					?>
					</select>
					<small><small>Select 'GRADUATED' if graduated.</small></small>
				</div>
			</div>
			<?php
		} else if($_POST['data']['1'] == "addID"){
			?>
			<div class="row">
				<div class="col-md-3 col-form-label">
					<label>ID Type *</label>
				</div>
				<div class="col-md-9 col-form-label">
					<select class="form-control" id="teacherids_id" name="teacherids_id" required>
					<?php
					$result = $controller->getDropdowns("field_category LIKE 'TEACHERIDS'");
					
					echo '<option value="">Select ID  type</option>';
					if($result['0'] == 1){while($row = $result['2']->fetch_assoc()){
						echo '<option value="'.$row['field_name'].'">'.$row['field_name'].'</option>';
					}} else {
						echo '<option value="">'.$result['1'].'</option>';
					}
					?>
					</select>
				</div>
				<div class="col-md-3 col-form-label">
					<label>ID # *</label>
				</div>
				<div class="col-md-9 col-form-label">
					<input type="text" class="form-control" id="teacherids_details" name="teacherids_details" placeholder="08-1234-5678-0" required>
				</div>
				<div class="col-md-3 col-form-label">
					<label>Date Issued </label>
				</div>
				<div class="col-md-9 col-form-label">
					<input type="date" class="form-control" id="teacherids_date_issued" name="teacherids_date_issued" min="<?php echo date('Y-m-d' ,strtotime('-25 years'));?>" max="<?php echo date('Y-m-d');?>" required>
				</div>
				<div class="col-md-3 col-form-label">
					<label>Place Issued </label>
				</div>
				<div class="col-md-9 col-form-label">
					<input type="text" class="form-control" id="teacherids_place_issued" name="teacherids_place_issued" placeholder="<?php echo $sch_citymun.", ".$sch_province;?>" required>
				</div>
			</div>
			<?php
		} else if($_POST['data']['1'] == "addAppointment"){
			?>
			<div class="row">
				<div class="col-md-3 col-form-label">
					<label>Type *</label>
				</div>
				<div class="col-md-9 col-form-label">
					<select class="form-control" id="employee_type" name="employee_type" onchange="updatePosition()" required>
						<option value="">Select employee type</option>
						<option value="1">Teaching</option>
						<option value="0">Non-teaching</option>
					</select>
				</div>
				<div class="col-md-3 col-form-label">
					<label>Position *</label>
				</div>
				<div class="col-md-9 col-form-label">
					<select class="form-control" id="teacherappointments_position" name="teacherappointments_position" required>
					<?php
					$result = $controller->getDropdowns("field_category LIKE 'POSITION'");
					
					echo '<option value="">Select position</option>';
					if($result['0'] == 1){while($row = $result['2']->fetch_assoc()){
						echo '<option value="'.$row['field_name'].'">'.substr($row['field_ext'], 2).'</option>';
					}} else {
						echo '<option value="">'.$result['1'].'</option>';
					}
					?>
					</select>
				</div>
				<div class="col-md-3 col-form-label">
					<label>Item # *</label>
				</div>
				<div class="col-md-9 col-form-label">
					<input type="text" class="form-control" id="teacherappointments_item_no" name="teacherappointments_item_no" placeholder="TCH1-123456-2012" required>
				</div>
				<div class="col-md-6 col-form-label">
					<label>Date *</label>
					<input type="date" class="form-control" id="teacherappointments_date" name="teacherappointments_date" min="<?php echo date('Y-m-d', strtotime('-25 years'));?>" max="<?php echo date('Y-m-d');?>" required>
				</div>
				<div class="col-md-6 col-form-label">
					<label>First day *</label>
					<input type="date" class="form-control" id="teacherappointments_fdaydate" name="teacherappointments_fdaydate" min="<?php echo date('Y-m-d', strtotime('-25 years'));?>" max="<?php echo date('Y-m-d');?>" required>
				</div>
				<div class="col-md-6 col-form-label">
					<label>Status *</label>
					<select class="form-control" id="teacherappointments_status" name="teacherappointments_status" required>
					<?php
					$result = $controller->getDropdowns("field_category LIKE 'STATUS'");
					
					echo '<option value="">Select status</option>';
					if($result['0'] == 1){while($row = $result['2']->fetch_assoc()){
						echo '<option value="'.$row['field_name'].'">'.$row['field_name'].'</option>';
					}} else {
						echo '<option value="">'.$result['1'].'</option>';
					}
					?>
					</select>
				</div>
				<div class="col-md-6 col-form-label">
					<label>Funding *</label>
					<select class="form-control" id="teacherappointments_funding" name="teacherappointments_funding" required>
					<?php
					$result = $controller->getDropdowns("field_category LIKE 'FUNDING'");
					
					echo '<option value="">Select funding</option>';
					if($result['0'] == 1){while($row = $result['2']->fetch_assoc()){
						echo '<option value="'.$row['field_name'].'">'.$row['field_name'].'</option>';
					}} else {
						echo '<option value="">'.$result['1'].'</option>';
					}
					?>
					</select>
				</div>
				<div class="col-md-2 col-form-label">
					<label>Active *</label>
				</div>
				<div class="col-md-2 col-form-label">
					<input type="checkbox" class="form-control" id="teacherappointments_active" name="teacherappointments_active">
				</div>
			</div>
			<?php
		} else if($_POST['data']['1'] == "addDesignation"){
			?>
			<div class="row">
				<div class="col-md-4 col-form-label">
					<label>Designation *</label>
				</div>
				<div class="col-md-8 col-form-label">
					<input type="text" class="form-control" id="teacherappointments_position" name="teacherappointments_position" placeholder="ICT Coordinator" required>
				</div>
				<div class="col-md-4 col-form-label">
					<label>Date *</label>
				</div>
				<div class="col-md-8 col-form-label">
					<input type="date" class="form-control" id="teacherappointments_date" name="teacherappointments_date"  min="<?php echo date('Y-m-d', strtotime('-25 years'));?>" max="<?php echo date('Y-m-d');?>" required>
				</div>
				<div class="col-md-6 col-form-label">
					<label>Effective SY *</label>
					<select class="form-control" id="teacherappointments_status" name="teacherappointments_status" required>
						<option value="">Select effective SY</option>
					<?php
					for($i = date('Y'); $i > date('Y') - 25; $i--){
						echo '<option value="'.$i.'">'.$i.'</option>';
					}
					?>
					</select>
				</div>
				<div class="col-md-6 col-form-label">
					<label>End SY *</label>
					<select class="form-control" id="teacherappointments_funding" name="teacherappointments_funding" required>
						<option value="">Select end SY</option>
						<option value="0">Current</option>
					<?php
					for($i = date('Y'); $i > date('Y') - 25; $i--){
						echo '<option value="'.$i.'">'.$i.'</option>';
					}
					?>
					</select>
				</div>
			</div>
			<?php			
		} else if($_POST['data']['1'] == "modifyFamily"){
			$result = $controller->getEntity("teachercontacts", " teachCont_no = '".$data['0']['2']."'");
			
			if($result['0'] == 1) {
				$row1 = $result['2'];
			} else {
				$row1 = $result['1'];
			}
			?>
			<div class="row">
				<div class="col-md-3 col-form-label">
					<label>First name *</label>
				</div>
				<div class="col-md-9 col-form-label">
					<input type="text" class="form-control" id="teachCont_fname" name="teachCont_fname" placeholder="APOLINARIO" required autofocus>
				</div>
				<div class="col-md-3 col-form-label">
					<label>Middle name </label>
				</div>
				<div class="col-md-9 col-form-label">
					<input type="text" class="form-control" id="teachCont_mname" name="teachCont_mname" placeholder="MARANAN">
				</div>
				<div class="col-md-3 col-form-label">
					<label>Last name *</label>
				</div>
				<div class="col-md-9 col-form-label">
					<input type="text" class="form-control" id="teachCont_lname" name="teachCont_lname" placeholder="MABINI" required>
				</div>
				<div class="col-md-3 col-form-label">
					<label>Ext. name </label>
				</div>
				<div class="col-md-9 col-form-label">
					<select class="form-control" id="teachCont_xname" name="teachCont_xname">
					<?php
					$result = $controller->getDropdowns("field_category LIKE 'FIELD_EXT'");
					
					if($result['0'] == 1){while($row = $result['2']->fetch_assoc()){
						echo '<option value="'.$row['field_name'].'">'.($row['field_name'] == "" ? "N/A" : $row['field_name']).'</option>';
					}} else {
						echo '<option value="">'.$result['1'].'</option>';
					}
					?>
					</select>
				</div>
				<div class="col-md-3 col-form-label">
					<label>Relationship *</label>
				</div>
				<div class="col-md-9 col-form-label">
					<select class="form-control" id="teachCont_type" name="teachCont_type" required>
						<option value="">Select relationship</option>
						<option value="1">Husband/Wife</option>
						<option value="2">Child</option>
					</select>
				</div>
				<div class="col-md-12 col-form-label">
					<button  type="button" class="btn btn-danger float-right" title="Delete family" id="btnDelete" onclick="return confirm('Delete family?') ? deleteAction('deleteFamily') : false;"><i class="fas fa-trash"></i></button>
				</div>
			</div>
			<script>
			$('#teachCont_fname').val('<?php echo $row1['teachCont_fname'];?>');
			$('#teachCont_mname').val('<?php echo $row1['teachCont_mname'];?>');
			$('#teachCont_lname').val('<?php echo $row1['teachCont_lname'];?>');
			$('#teachCont_xname').val('<?php echo $row1['teachCont_xname'];?>');
			$('#teachCont_type').val('<?php echo $row1['teachCont_type'];?>');
			</script>
			<script>
			setTimeout(function(){disableDelete();}, 100);
			function disableDelete(){
				if(modacc_role == 2){ 
					$('#btnDelete').hide(); 
				} else{ 
					$('#btnDelete').show();
				}
			}
			</script>
			<?php			
		} else if($_POST['data']['1'] == "modifyEducation"){
			$result = $controller->getEntity("teacher_ebackground", " eback_no = '".$data['0']['2']."'");
			
			if($result['0'] == 1) {
				$row1 = $result['2'];
			} else {
				$row1 = $result['1'];
			}
			?>
			<div class="row">
				<div class="col-md-3 col-form-label">
					<label>Educ'l Level *</label>
				</div>
				<div class="col-md-9 col-form-label">
					<select class="form-control" id="eback_level" name="eback_level" required>
					<?php
					$result = $controller->getDropdowns("field_category LIKE 'EDUCLEVEL'");
					
					echo '<option value="">Select level</option>';
					if($result['0'] == 1){while($row = $result['2']->fetch_assoc()){
						echo '<option value="'.$row['field_name'].'">'.$row['field_name'].'</option>';
					}} else {
						echo '<option value="">'.$result['1'].'</option>';
					}
					?>
					</select>
				</div>
				<div class="col-md-3 col-form-label">
					<label>Degree *</label>
				</div>
				<div class="col-md-9 col-form-label">
					<input type="text" class="form-control" id="eback_degree" name="eback_degree" placeholder="BSED" required>
				</div>
				<div class="col-md-3 col-form-label">
					<label>Major </label>
				</div>
				<div class="col-md-9 col-form-label">
					<input type="text" class="form-control" id="eback_major" name="eback_major" placeholder="Mathematics">
				</div>
				<div class="col-md-3 col-form-label">
					<label>Minor </label>
				</div>
				<div class="col-md-9 col-form-label">
					<input type="text" class="form-control" id="eback_minor" name="eback_minoreback_minor" placeholder="Filipino">
				</div>
				<div class="col-md-3 col-form-label">
					<label>Units *</label>
				</div>
				<div class="col-md-9 col-form-label">
					<select class="form-control" id="eback_units" name="eback_units" required>
					<?php
					echo '<option value="">Select units obtained</option>';
					echo '<option value="100">GRADUATED</option>';
					for($i = 3; $i < 200; $i++){
						echo '<option value="'.$i.'">'.$i.' units</option>';
					}
					?>
					</select>
					<small><small>Select 'GRADUATED' if graduated.</small></small>
				</div>
				<div class="col-md-12 col-form-label">
					<button  type="button" class="btn btn-danger float-right" title="Delete education" id="btnDelete" onclick="return confirm('Delete education?') ? deleteAction('deleteEducation') : false;"><i class="fas fa-trash"></i></button>
				</div>
			</div>
			<script>
			$('#eback_level').val('<?php echo $row1['eback_level'];?>');
			$('#eback_degree').val('<?php echo $row1['eback_degree'];?>');
			$('#eback_major').val('<?php echo $row1['eback_major'];?>');
			$('#eback_minor').val('<?php echo $row1['eback_minor'];?>');
			$('#eback_minor').val('<?php echo $row1['eback_minor'];?>');
			$('#eback_units').val('<?php echo $row1['eback_units'];?>');
			</script>
			<script>
			setTimeout(function(){disableDelete();}, 100);
			function disableDelete(){
				if(modacc_role == 2){ 
					$('#btnDelete').hide(); 
				} else{ 
					$('#btnDelete').show();
				}
			}
			</script>
			<?php			
		} else if($_POST['data']['1'] == "modifyID"){
			$result = $controller->getEntity("teacherids", " teacherids_no = '".$data['0']['2']."'");
			
			if($result['0'] == 1) {
				$row1 = $result['2'];
			} else {
				$row1 = $result['1'];
			}
			?>
			<div class="row">
				<div class="col-md-3 col-form-label">
					<label>ID Type *</label>
				</div>
				<div class="col-md-9 col-form-label">
					<select class="form-control" id="teacherids_id" name="teacherids_id" required>
					<?php
					$result = $controller->getDropdowns("field_category LIKE 'TEACHERIDS'");
					
					echo '<option value="">Select ID  type</option>';
					if($result['0'] == 1){while($row = $result['2']->fetch_assoc()){
						echo '<option value="'.$row['field_name'].'">'.$row['field_name'].'</option>';
					}} else {
						echo '<option value="">'.$result['1'].'</option>';
					}
					?>
					</select>
				</div>
				<div class="col-md-3 col-form-label">
					<label>ID # *</label>
				</div>
				<div class="col-md-9 col-form-label">
					<input type="text" class="form-control" id="teacherids_details" name="teacherids_details" placeholder="08-1234-5678-0" required>
				</div>
				<div class="col-md-3 col-form-label">
					<label>Date Issued </label>
				</div>
				<div class="col-md-9 col-form-label">
					<input type="date" class="form-control" id="teacherids_date_issued" name="teacherids_date_issued" min="<?php echo date('Y-m-d' ,strtotime('-25 years'));?>" max="<?php echo date('Y-m-d');?>" required>
				</div>
				<div class="col-md-3 col-form-label">
					<label>Place Issued </label>
				</div>
				<div class="col-md-9 col-form-label">
					<input type="text" class="form-control" id="teacherids_place_issued" name="teacherids_place_issued" placeholder="<?php echo $sch_citymun.", ".$sch_province;?>" required>
				</div>
				<div class="col-md-12 col-form-label">
					<button  type="button" class="btn btn-danger float-right" title="Delete ID" id="btnDelete" onclick="return confirm('Delete ID?') ? deleteAction('deleteID') : false;"><i class="fas fa-trash"></i></button>
				</div>
			</div>
			<script>
			$('#teacherids_id').val('<?php echo $row1['teacherids_id'];?>');
			$('#teacherids_details').val('<?php echo $row1['teacherids_details'];?>');
			$('#teacherids_date_issued').val('<?php echo $row1['teacherids_date_issued'];?>');
			$('#teacherids_place_issued').val('<?php echo $row1['teacherids_place_issued'];?>');
			</script>
			<script>
			setTimeout(function(){disableDelete();}, 100);
			function disableDelete(){
				if(modacc_role == 2){ 
					$('#btnDelete').hide(); 
				} else{ 
					$('#btnDelete').show();
				}
			}
			</script>
			<?php			
		} else if($_POST['data']['1'] == "modifyAppointment"){
			$result = $controller->getEntity("teacherappointments INNER JOIN dropdowns ON teacherappointments_position = field_name ", " teacherappointments_no = '".$data['0']['2']."' AND field_category LIKE 'POSITION'");
			
			if($result['0'] == 1) {
				$row1 = $result['2'];
			} else {
				$row1 = $result['1'];
			}
			?>
			<div class="row">
				<div class="col-md-3 col-form-label">
					<label>Type *</label>
				</div>
				<div class="col-md-9 col-form-label">
					<select class="form-control" id="employee_type" name="employee_type" onchange="updatePosition()" required>
						<option value="">Select employee type</option>
						<option value="1">Teaching</option>
						<option value="0">Non-teaching</option>
					</select>
				</div>
				<div class="col-md-3 col-form-label">
					<label>Position *</label>
				</div>
				<div class="col-md-9 col-form-label">
					<select class="form-control" id="teacherappointments_position" name="teacherappointments_position"  required>
					<?php
					$result = $controller->getDropdowns("field_category LIKE 'POSITION'");
					
					echo '<option value="">Select position</option>';
					if($result['0'] == 1){while($row = $result['2']->fetch_assoc()){
						echo '<option value="'.$row['field_name'].'">'.substr($row['field_ext'], 2).'</option>';
					}} else {
						echo '<option value="">'.$result['1'].'</option>';
					}
					?>
					</select>
				</div>
				<div class="col-md-3 col-form-label">
					<label>Item # *</label>
				</div>
				<div class="col-md-9 col-form-label">
					<input type="text" class="form-control" id="teacherappointments_item_no" name="teacherappointments_item_no" placeholder="TCH1-123456-2012" required>
				</div>
				<div class="col-md-6 col-form-label">
					<label>Date *</label>
					<input type="date" class="form-control" id="teacherappointments_date" name="teacherappointments_date" min="<?php echo date('Y-m-d', strtotime('-25 years'));?>" max="<?php echo date('Y-m-d');?>" required>
				</div>
				<div class="col-md-6 col-form-label">
					<label>First day *</label>
					<input type="date" class="form-control" id="teacherappointments_fdaydate" name="teacherappointments_fdaydate" min="<?php echo date('Y-m-d', strtotime('-25 years'));?>" max="<?php echo date('Y-m-d');?>" required>
				</div>
				<div class="col-md-6 col-form-label">
					<label>Status *</label>
					<select class="form-control" id="teacherappointments_status" name="teacherappointments_status" required>
					<?php
					$result = $controller->getDropdowns("field_category LIKE 'STATUS'");
					
					echo '<option value="">Select status</option>';
					if($result['0'] == 1){while($row = $result['2']->fetch_assoc()){
						echo '<option value="'.$row['field_name'].'">'.$row['field_name'].'</option>';
					}} else {
						echo '<option value="">'.$result['1'].'</option>';
					}
					?>
					</select>
				</div>
				<div class="col-md-6 col-form-label">
					<label>Funding *</label>
					<select class="form-control" id="teacherappointments_funding" name="teacherappointments_funding" required>
					<?php
					$result = $controller->getDropdowns("field_category LIKE 'FUNDING'");
					
					echo '<option value="">Select funding</option>';
					if($result['0'] == 1){while($row = $result['2']->fetch_assoc()){
						echo '<option value="'.$row['field_name'].'">'.$row['field_name'].'</option>';
					}} else {
						echo '<option value="">'.$result['1'].'</option>';
					}
					?>
					</select>
				</div>
				<div class="col-md-2 col-form-label">
					<label>Active *</label>
				</div>
				<div class="col-md-2 col-form-label">
					<input type="checkbox" class="form-control" id="teacherappointments_active" name="teacherappointments_active">
				</div>
				<div class="col-md-8 col-form-label">
					<button  type="button" class="btn btn-danger float-right" title="Delete appointment" id="btnDelete" onclick="return confirm('Delete appointment?') ? deleteAction('deleteAppointment') : false;"><i class="fas fa-trash"></i></button>
				</div>
			</div>
			<script>
			var employee_type = '<?php echo $row1['field_ext'];?>';
			$('#employee_type').val(employee_type.substr(0,1));
			$('#teacherappointments_position').val('<?php echo $row1['teacherappointments_position'];?>');
			$('#teacherappointments_item_no').val('<?php echo $row1['teacherappointments_item_no'];?>');
			$('#teacherappointments_date').val('<?php echo $row1['teacherappointments_date'];?>');
			$('#teacherappointments_fdaydate').val('<?php echo $row1['teacherappointments_fdaydate'];?>');
			$('#teacherappointments_status').val('<?php echo $row1['teacherappointments_status'];?>');
			$('#teacherappointments_funding').val('<?php echo $row1['teacherappointments_funding'];?>');
			var status = <?php echo $row1['teacherappointments_active'];?>;
			status == 1 ? $('#btnDelete').attr('disabled', 'disabled') :  $('#btnDelete').removeAttr('disabled') ;
			status == 1 ? $('#teacherappointments_active').attr('checked', 'checked') :  $('#teacherappointments_active').removeAttr('checked') ;
			status == 1 ? $('#teacherappointments_active').attr('disabled', 'disabled') :  $('#teacherappointments_active').removeAttr('disabled') ;
			
			</script>
			<script>
			setTimeout(function(){disableDelete();}, 100);
			function disableDelete(){
				if(modacc_role == 2){ 
					$('#btnDelete').hide(); 
				} else{ 
					$('#btnDelete').show();
				}
			}
			</script>
			<?php			
		} else if($_POST['data']['1'] == "modifyDesignation"){
			$result = $controller->getEntity("teacherappointments", " teacherappointments_no = '".$data['0']['2']."'");
			
			if($result['0'] == 1) {
				$row1 = $result['2'];
			} else {
				$row1 = $result['1'];
			}
			?>
			<div class="row">
				<div class="col-md-4 col-form-label">
					<label>Designation *</label>
				</div>
				<div class="col-md-8 col-form-label">
					<input type="text" class="form-control" id="teacherappointments_position" name="teacherappointments_position" placeholder="ICT Coordinator" required>
				</div>
				<div class="col-md-4 col-form-label">
					<label>Date *</label>
				</div>
				<div class="col-md-8 col-form-label">
					<input type="date" class="form-control" id="teacherappointments_date" name="teacherappointments_date"  min="<?php echo date('Y-m-d', strtotime('-25 years'));?>" max="<?php echo date('Y-m-d');?>" required>
				</div>
				<div class="col-md-6 col-form-label">
					<label>Effective SY *</label>
					<select class="form-control" id="teacherappointments_status" name="teacherappointments_status" required>
						<option value="">Select effective SY</option>
					<?php
					for($i = date('Y'); $i > date('Y') - 25; $i--){
						echo '<option value="'.$i.'">'.$i.'</option>';
					}
					?>
					</select>
				</div>
				<div class="col-md-6 col-form-label">
					<label>End SY *</label>
					<select class="form-control" id="teacherappointments_funding" name="teacherappointments_funding" required>
						<option value="">Select end SY</option>
						<option value="0">Current</option>
					<?php
					for($i = date('Y'); $i > date('Y') - 25; $i--){
						echo '<option value="'.$i.'">'.$i.'</option>';
					}
					?>
					</select>
				</div>
				<div class="col-md-12 col-form-label">
					<button  type="button" class="btn btn-danger float-right" title="Delete designation" id="btnDelete" onclick="return confirm('Delete designation?') ? deleteAction('deleteDesignation') : false;"><i class="fas fa-trash"></i></button>
				</div>
			</div>
			<script>
			$('#teacherappointments_position').val('<?php echo $row1['teacherappointments_position'];?>');
			$('#teacherappointments_date').val('<?php echo $row1['teacherappointments_date'];?>');
			$('#teacherappointments_status').val('<?php echo $row1['teacherappointments_status'];?>');
			$('#teacherappointments_funding').val('<?php echo $row1['teacherappointments_funding'];?>');
			</script>
			<script>
			setTimeout(function(){disableDelete();}, 100);
			function disableDelete(){
				if(modacc_role == 2){ 
					$('#btnDelete').hide(); 
				} else{ 
					$('#btnDelete').show();
				}
			}
			</script>
			<?php				
		}
		
	} else if($_POST['data']['0'] == "submitAction"){
		$data = array_values($_POST);
		
		if($_POST['data']['1'] == "addFamily"){
			$result = $controller->addFamily($data);
			
			header("Content-Type: application/json");
			echo json_encode($result);

			exit();	
			
		} else if($_POST['data']['1'] == "addEducation"){
			$result = $controller->addEducation($data);
			
			header("Content-Type: application/json");
			echo json_encode($result);

			exit();	
			
		} else if($_POST['data']['1'] == "addID"){
			$result = $controller->addID($data);
			
			header("Content-Type: application/json");
			echo json_encode($result);

			exit();	
			
		} else if($_POST['data']['1'] == "addAppointment"){
			$result = $controller->addAppointment2($data);
			
			header("Content-Type: application/json");
			echo json_encode($result);

			exit();	
			
		} else if($_POST['data']['1'] == "addDesignation"){
			$result = $controller->addDesignation($data);
			
			header("Content-Type: application/json");
			echo json_encode($result);

			exit();	
			
		} else if($_POST['data']['1'] == "modifyFamily"){
			$result = $controller->modifyFamily($data);
			
			header("Content-Type: application/json");
			echo json_encode($result);

			exit();	
			
		} else if($_POST['data']['1'] == "modifyEducation"){
			$result = $controller->modifyEducation($data);
			
			header("Content-Type: application/json");
			echo json_encode($result);

			exit();	
			
		} else if($_POST['data']['1'] == "modifyID"){
			$result = $controller->modifyID($data);
			
			header("Content-Type: application/json");
			echo json_encode($result);

			exit();	
			
		} else if($_POST['data']['1'] == "modifyAppointment"){
			$result = $controller->modifyAppointment($data);
			
			header("Content-Type: application/json");
			echo json_encode($result);

			exit();	
			
		} else if($_POST['data']['1'] == "modifyDesignation"){
			$result = $controller->modifyDesignation($data);
			
			header("Content-Type: application/json");
			echo json_encode($result);

			exit();	
		}	
		
	} else if($_POST['data']['0'] == "updatePosition"){
		$result = $controller->getDropdowns("field_category LIKE 'POSITION' AND field_ext LIKE '".$_POST['data']['1']."%'");
		
		echo '<option value="">Select position</option>';
		if($result['0'] == 1){while($row = $result['2']->fetch_assoc()){
			echo '<option value="'.$row['field_ext'].'">'.substr($row['field_ext'], 2).'</option>';
		}} else {
			echo '<option value="">'.$result['1'].'</option>';
		}
		
	} else if($_POST['data']['0'] == "updateTeacher"){
		$data = array_values($_POST);
		$result = $controller->updateTeacher($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();	
		
	} else if($_POST['data']['0'] == "updateAppointment"){
		$data = array_values($_POST);
		$result = $controller->updateAppointment($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();	
		
	} else if($_POST['data']['0'] == "deleteAction"){
		$data = array_values($_POST);
		$result = $controller->deleteAction($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();	
		
	}
}
?>