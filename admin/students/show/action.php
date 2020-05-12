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
						<div class="col-md-12">
							<div class="card card-primary">
								<div class="card-body">
									<div class="row">
										<div class="col-md-3 col-form-label">
											<label>Student LRN *</label>
											<input type="text" class="form-control" id="stud_lrn" name="" minlength="12" maxlength="12" placeholder="<?php echo $sch_code."000000";?>" onkeyup="checkLRN();" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
										</div>
										<div class="col-md-8 col-form-label">
										</div>
										<div class="col-md-4 col-form-label">
											<label>First name *</label>
											<input type="text" class="form-control" id="stud_fname" minlength="3" value="<?php echo strtoupper($_SESSION['search_firstname']);?>" readonly placeholder="APOLINARIO" required>
										</div>
										<div class="col-md-3 col-form-label">
											<label>Middle name *</label>
											<input type="text" class="form-control" id="stud_mname" placeholder="MARANAN">
										</div>
										<div class="col-md-3 col-form-label">
											<label>Last name *</label>
											<input type="text" class="form-control" id="stud_lname" minlength="3" value="<?php echo strtoupper($_SESSION['search_lastname']);?>" readonly placeholder="MABINI" required>
										</div>
										<div class="col-md-2 col-form-label">
											<label>Ext. name *</label>
											<select class="form-control" id="stud_xname">
											<?php
											$result = $controller->getDropdowns(" field_category LIKE 'FIELD_EXT' ");
											
											if($result['0'] == 1){while($row = $result['2']->fetch_assoc()){
												echo '<option value="'.$row['field_name'].'">'.($row['field_name'] == "" ? "N/A" : $row['field_name']).'</option>';
											}} else {
												echo '<option value="">'.$result['1'].'</option>';
											}
											?>
											</select>
										</div>
										<div class="col-md-4 col-form-label">
											<label>Sex *</label>
											<select class="form-control" id="stud_gender" required>
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
										</div>
										<div class="col-md-4 col-form-label">
											<label>Date of birth *</label>
											<input type="date" class="form-control" id="stud_bdate" min="<?php echo date('Y-m-d', strtotime('-50 years'));?>"  max="<?php echo date('Y-m-d', strtotime('-4 years'));?>" required>
										</div>
										<div class="col-md-4 col-form-label">
											<label>CCT status *</label>
											<select class="form-control" id="stud_cct" required>
											<?php
											$result = $controller->getDropdowns(" field_category LIKE 'CCT' AND field_name NOT LIKE '%MCCV%' ");
											
											echo '<option value="">Select CCT status</option>';
											if($result['0'] == 1){while($row = $result['2']->fetch_assoc()){
												echo '<option value="'.$row['field_name'].'">'.$row['field_name'].'</option>';
											}} else {
												echo '<option value="">'.$result['1'].'</option>';
											}
											?>
											</select>
										</div>
										<div class="col-md-4 col-form-label">
											<label>Residence *</label>
											<small><small><i>(Barangay, Municipality/City, Province)</i></small></small>
										</div>
										<div class="col-md-8 col-form-label">
											<input list="addresses" type="text" class="form-control" id="stud_residence" minlength="12" placeholder="<?php echo $sch_address2.", ".$sch_citymun.", ".$sch_province;?>" required>
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
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer clearfix">
					<div class="row">
						<div class="col-md-4">
							<button type="button" class="btn btn-default" id="btnCancel" name="btnCancel" onclick="window.location = '?p=students&new';">Cancel</button>
						</div>
						<div class="col-md-4">
						</div>
						<div class="col-md-4">
							<button class="btn btn-info float-right" id="btnSubmit" name="btnSubmit" onclick="return confirm('Save student?') ? saveEntity() : false;">Submit</button>
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
				<td title="'.$row['stud_no'].'">'.strtoupper($row['stud_lname'].", ".$row['stud_fname']."".($row['stud_xname'] == "" ? "" : ", ".$row['stud_xname']).", ".$row['stud_mname']).'</td>
				<td>'.$row['stud_gender'].'</td>
				<td>'.date('m/d/Y', strtotime($row['stud_bdate'])).'</td>
				<td><a href="?p=students&modify='.$row['stud_no'].'"><i class="fas fa-user-tie" title="View student"></i></a></td>
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
		
	} else if($_POST['data']['0'] == "getStatus"){
		$data = array_values($_POST);
		$result = $controller->getStatus($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();	
		
	} else if($_POST['data']['0'] == "userModifyLogin"){
		$data = array_values($_POST);
		$result = $controller->userModifyLogin($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();	
		
	} else if($_POST['data']['0'] == "getBasic"){
		$data = array_values($_POST);
		$result = $controller->getBasic($data );
		
		
		echo '		
		<table class="table">
			<thead>
				<tr>
					<th width="17%">Field</th>
					<th width="40%">Details</th>
					<td align="right"><a href="javascript:void(0);" id="entity-edit-button" title="Modify student"></a></td>
				</tr>
			</thead>
			<tbody>	';	

			if($result['0'] == 1){
				$row = $result['2'];
				$name = "<strong>".$row['stud_lname'].", ".$row['stud_fname'].($row['stud_xname'] == "" ? "" : ", ".$row['stud_xname']).", ".$row['stud_mname']."</strong><br><small>".$row['stud_lrn']."</small>";
				echo "<script>$('#entity-name').html('<h3>".$name."</h3>')</script>";
				$withImage = "../assets/images/students/".$row['stud_no'].".jpg";
				$noImage = "../assets/avatars/".$row['stud_gender'].".jpg";
				?>
				<tr>
					<td colspan="2">
						<div class="col-md-3">
							<img src="<?php echo (file_exists("../../".$withImage) ? $withImage : $noImage); ?>"
								alt="User profile picture"
								style="border: 1px solid #ddd; border-radius: 4px; padding: 5px; width: 100%;">
						</div>
					</td>
					<td></td>
				</tr>
				<tr>
					<th>LRN *</th>
					<td><?php echo $row['stud_lrn'];?></td>
					<td><input type="number" class="form-control" id="stud_lrn" name="stud_lrn" value="<?php echo $row['stud_lrn'];?>" min="100000000000" max="999999999999" onkeyup="checkLRN();"></td>
				</tr>
				<tr>
					<th>First name *</th>
					<td><?php echo $row['stud_fname'];?></td>
					<td><input type="text" class="form-control" id="stud_fname" name="stud_fname" value="<?php echo $row['stud_fname'];?>" minlength="3" value=""></td>
				</tr>
				<tr>
					<th>Middle name</th>
					<td><?php echo $row['stud_mname'];?></td>
					<td><input type="text" class="form-control" id="stud_mname" name="stud_mname" value="<?php echo $row['stud_mname'];?>" placeholder="MARANAN"></td>
				</tr>
				<tr>
					<th>Last name *</th>
					<td><?php echo $row['stud_lname'];?></td>
					<td><input type="text" class="form-control" id="stud_lname" name="stud_lname" value="<?php echo $row['stud_lname'];?>" minlength="3" value=""></td>
				</tr>
				<tr>
					<th>Ext. name</th>
					<td><?php echo $row['stud_xname'];?></td>
					<td><select class="form-control" id="stud_xname" name="stud_xname">
						<?php
						$result1 = $controller->getDropdowns(" field_category LIKE 'FIELD_EXT' ");
						
						if($result1['0'] == 1){while($row1 = $result1['2']->fetch_assoc()){
							echo '<option value="'.$row1['field_name'].'">'.($row1['field_name'] == "" ? "N/A" : $row1['field_name']).'</option>';
						}} else {
							echo '<option value="">'.$result1['1'].'</option>';
						}
						echo "<script>$('#teach_xname').val('".$row['stud_xname']."').change();</script>";
						?>
						</select>
					</td>
				</tr>
				<tr>
					<th>Sex *</th>
					<td><?php echo $row['stud_gender'];?></td>
					<td><select class="form-control" id="stud_gender" name="stud_gender" required>
						<?php
						$result1 = $controller->getDropdowns(" field_category LIKE 'GENDER' ");
						
						echo '<option value="">Select sex</option>';
						if($result1['0'] == 1){while($row1 = $result1['2']->fetch_assoc()){
							echo '<option value="'.$row1['field_name'].'">'.$row1['field_name'].'</option>';
						}} else {
							echo '<option value="">'.$result1['1'].'</option>';
						}
						echo "<script>$('#stud_gender').val('".$row['stud_gender']."').change();</script>";
						?>
						</select>
					</td>
				</tr>
				<tr>
					<th>Birth date *</th>
					<td><?php echo date('F j, Y', strtotime($row['stud_bdate']));?></td>
					<td><input type="date" class="form-control" id="stud_bdate" name="stud_bdate" value="<?php echo $row['stud_bdate'];?>" min="<?php echo date('Y-m-d', strtotime('-50 years'));?>" max="<?php echo date('Y-m-d', strtotime('-4 years'));?>" required></td>
				</tr>
				<tr>
					<th>Residence *</th>
					<td><?php echo $row['stud_residence'];?></td>
					<td><input list="addresses" type="text" class="form-control" id="stud_residence" name="stud_residence" value="<?php echo $row['stud_residence'];?>"  minlength="3" placeholder="<?php echo $sch_address2.", ".$sch_citymun.", ".$sch_province;?>" required>
						<datalist id="addresses">
						<?php
						$result2 = $controller->getDropdowns(" field_category LIKE 'RESIDENCE' ");
						
						if($result2['0'] == 1){while($row1 = $result2['2']->fetch_assoc()){
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
					<th>Religion *</th>
					<td><?php echo $row['stud_religion'];?></td>
					<td><select class="form-control" id="stud_religion" name="stud_religion" required>
						<?php
						$result = $controller->getDropdowns(" field_category LIKE 'RELIGION' ");
						
						echo '<option value="">Select religion</option>';
						if($result['0'] == 1){while($row1 = $result['2']->fetch_assoc()){
							echo '<option value="'.$row1['field_name'].'">'.$row1['field_name'].'</option>';
						}} else {
							echo '<option value="">'.$result['1'].'</option>';
						}
						echo "<script>$('#stud_religion').val('".$row['stud_religion']."').change();</script>";
						?>
						</select>
					</td>
				</tr>
				<tr>
					<th>Dialect *</th>
					<td><?php echo $row['stud_dialect'];?></td>
					<td><select class="form-control" id="stud_dialect" name="stud_dialect" required>
						<?php
						$result = $controller->getDropdowns(" field_category LIKE 'DIALECT' ");
						
						echo '<option value="">Select ethnicity</option>';
						if($result['0'] == 1){while($row1 = $result['2']->fetch_assoc()){
							echo '<option value="'.$row1['field_name'].'">'.$row1['field_name'].'</option>';
						}} else {
							echo '<option value="">'.$result['1'].'</option>';
						}
						echo "<script>$('#stud_dialect').val('".$row['stud_dialect']."').change();</script>";
						?>
						</select>
				</tr>
				<tr>
					<th>Ethnicity *</th>
					<td><?php echo strtoupper($row['stud_ethnicity']);?></td>
					<td><select class="form-control" id="stud_ethnicity" name="stud_ethnicity" required>
						<?php
						$result = $controller->getDropdowns(" field_category LIKE 'ETHNICITY' ");
						
						echo '<option value="">Select ethnicity</option>';
						if($result['0'] == 1){while($row1 = $result['2']->fetch_assoc()){
							echo '<option value="'.$row1['field_name'].'">'.$row1['field_name'].'</option>';
						}} else {
							echo '<option value="">'.$result['1'].'</option>';
						}
						echo "<script>$('#stud_ethnicity').val('".$row['stud_ethnicity']."').change();</script>";
						?>
						</select>
					</td>
				</tr>
				<tr>
					<th>CCT *</th>
					<td><?php echo strtoupper($row['stud_cct']);?></td>
					<td><select class="form-control" id="stud_cct" name="stud_cct" required>
						<?php
						$result = $controller->getDropdowns(" field_category LIKE 'CCT' ");
						
						echo '<option value="">Select CCT status</option>';
						if($result['0'] == 1){while($row1 = $result['2']->fetch_assoc()){
							echo '<option value="'.$row1['field_name'].'">'.$row1['field_name'].'</option>';
						}} else {
							echo '<option value="">'.$result['1'].'</option>';
						}
						echo "<script>$('#stud_cct').val('".$row['stud_cct']."').change();</script>";
						?>
						</select>
					</td>
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
		
	} else if($_POST['data']['0'] == "getOther"){
		$data = array_values($_POST);
		$result = $controller->getFamily($data);
		
		if($result['0'] == 1){$row = $result['2'];
		?>
		<div class="card">
			<div class="card-body table-responsive p-0">									
				<table class="table">
					<thead>
						<tr>
							<th width="6%">#</th>
							<th>Parent(s)</th>
							<th width="30%"></th>
							<th width="10%"></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td><?php echo strtoupper($row['studCont_stud_flname'].", ".$row['studCont_stud_ffname'].", ".$row['studCont_stud_fmname']);?></td>
							<td>Father</td>
							<td><a href="javascript:void(0);" class="float-right" title="Modify family"
									data-toggle="modal" data-target="#modal-input" rowID="<?php echo $row['studCont_no'];?>" data-type="modifyFamily" data-backdrop="static" data-keyboard="false">
									<i class="fas fa-external-link-alt"></i>
								</a>
							</td>							
						</tr>
						<tr>
							<td>2</td>
							<td><?php echo strtoupper($row['studCont_stud_mlname'].", ".$row['studCont_stud_mfname'].", ".$row['studCont_stud_mmname']);?></td>
							<td>Mother</td>
							<td><a href="javascript:void(0);" class="float-right" title="Modify family"
									data-toggle="modal" data-target="#modal-input" rowID="<?php echo $row['studCont_no'];?>" data-type="modifyFamily" data-backdrop="static" data-keyboard="false">
									<i class="fas fa-external-link-alt"></i>
								</a>
							</td>							
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<br>
		<div class="card">
			<div class="card-body table-responsive p-0">									
				<table class="table">
					<thead>
						<tr>
							<th width="6%">#</th>
							<th>Guardian</th>
							<th width="30%">Relationship</th>
							<th width="30%">Contact #</th>
							<th width="10%"></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td><?php echo strtoupper($row['studCont_stud_glname'].", ".$row['studCont_stud_gfname'].", ".$row['studCont_stud_gmname']);?></td>
							<td><?php echo $row['studCont_stud_grelation'];?></td>							
							<td><?php echo $row['studCont_stud_gcontact'];?></td>							
							<td><a href="javascript:void(0);" class="float-right" title="Modify family"
									data-toggle="modal" data-target="#modal-input" rowID="<?php echo $row['studCont_no'];?>" data-type="modifyFamily" data-backdrop="static" data-keyboard="false">
									<i class="fas fa-external-link-alt"></i>
								</a>
							</td>							
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<?php
		} else {
			echo $result['1'];
		}
		
	} else if($_POST['data']['0'] == "showAction"){
		$data = array_values($_POST);
		
		if($_POST['data']['1'] == "modifyFamily"){
			$result = $controller->getFamilyDetails($data);
			
			if($result['0'] == 1){ $row = $result['2'];
				?>
				<div class="row">
					<div class="col-md-4 col-form-label">
						<label>Father First name & Ext. name</label>
						<input type="text" id="studCont_stud_ffname" value="<?php echo $row['studCont_stud_ffname'];?>" class="form-control" required>
					</div>
					<div class="col-md-4 col-form-label">
						<label>Father middle name</label>
						<input type="text" id="studCont_stud_fmname" value="<?php echo $row['studCont_stud_fmname'];?>" class="form-control" required>
					</div>
					<div class="col-md-4 col-form-label">
						<label>Father last name</label>
						<input type="text" id="studCont_stud_flname" value="<?php echo $row['studCont_stud_flname'];?>" class="form-control" required>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4 col-form-label">
						<label>Mother first name & ext. name</label>
						<input type="text" id="studCont_stud_mfname" value="<?php echo $row['studCont_stud_mfname'];?>" class="form-control" required>
					</div>
					<div class="col-md-4 col-form-label">
						<label>Mother maiden middle name</label>
						<input type="text" id="studCont_stud_mmname" value="<?php echo $row['studCont_stud_mmname'];?>" class="form-control" required>
					</div>
					<div class="col-md-4 col-form-label">
						<label>Mother maiden last name</label>
						<input type="text" id="studCont_stud_mlname" value="<?php echo $row['studCont_stud_mlname'];?>" class="form-control" required>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4 col-form-label">
						<label>Guardian first name & ext. name</label>
						<input type="text" id="studCont_stud_gfname" value="<?php echo $row['studCont_stud_gfname'];?>" class="form-control" required>
					</div>
					<div class="col-md-4 col-form-label">
						<label>Guardian middle name</label>
						<input type="text" id="studCont_stud_gmname" value="<?php echo $row['studCont_stud_gmname'];?>" class="form-control" required>
					</div>
					<div class="col-md-4 col-form-label">
						<label>Guardian last name</label>
						<input type="text" id="studCont_stud_glname" value="<?php echo $row['studCont_stud_glname'];?>" class="form-control" required>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-form-label">
						<label>Guardian relationship to student</label>
						<select id="studCont_stud_grelation" class="form-control" required>
						<?php
						$result = $controller->getDropdowns(" field_category LIKE 'RELATION' ");
						
						echo '<option value="">Select </option>';
						if($result['0'] == 1){while($row1 = $result['2']->fetch_assoc()){
							echo '<option value="'.$row1['field_name'].'">'.$row1['field_name'].'</option>';
						}} else {
							echo '<option value="">'.$result['1'].'</option>';
						}
						echo "<script>$('#studCont_stud_grelation').val('".$row['studCont_stud_grelation']."').change();</script>";
						?>
						</select>
					</div>
					<div class="col-md-6 col-form-label">
						<label>Parent/Guardian contact #</label>
						<input type="text" id="studCont_stud_gcontact" value="<?php echo $row['studCont_stud_gcontact'];?>" class="form-control"  required>
					</div>
				</div>
				<?php
			} else {
				echo $result['1'];
			}

		} else if($_POST['data']['1'] == "modifyEnrollment"){
			$result = $controller->getEnrollment($data);	
			
			if($result['0'] == 1){ $row = $result['2'];
				?>
				<div class="row">
					<div class="col-md-4 col-form-label">
						<label>Subject</label>
					</div>
					<div class="col-md-8 col-form-label">
						<label><?php echo $row['pros_title'];?></label>
						<div style="margin-top: -25px;"><small style="margin-top: -15px;"><br><?php echo $row['pros_desc'];?></small></div>
					</div>
					<div class="col-md-12 col-form-label">
						<label>Section</label>
						<select class="form-control" id="class_no" value="class_no" onchange="getSubject();" required>
						<?php
						$result2 = $controller->getSubject($data, " AND class_pros_no = '".$row['class_pros_no']."' ");
						
						echo '<option value="">Select new schedule/teacher</option>';
						if($result['0'] == 1){while($row2 = $result2['2']->fetch_assoc()){
							echo '<option value="'.$row2['class_no'].'">'.$row2['section_name']."; ".$row2['class_timeslots']."; ".$row2['class_days']."; ".$row2['teach_lname'].", ".substr($row2['teach_lname'], 0, 1).'.</option>';
							
						}} else {
							echo '<option value="">'.$result['1'].'</option>';
						}
						echo "<script>$('#class_no').val('".$row['class_no']."');</script>";
						?>
						</select>
					</div>
					<div class="col-md-4 col-form-label">
						<label>Schedule</label>
					</div>
					<div class="col-md-8 col-form-label">
						<small id="subject-details"><?php echo $row['section_name']."; ".$row['class_timeslots']."; ".$row['class_days'];?></small>
					</div>
					<div class="col-md-4 col-form-label" style="margin-top: -25px;">
						<label>Teacher</label>
					</div>
					<div class="col-md-8 col-form-label" style="margin-top: -25px;">
						<small id="subject-teacher"><?php echo $row['teach_lname'].", ".$row['teach_fname'].($row['teach_xname'] == "" ? "" : ", ".$row['teach_xname']).", ".$row['teach_mname'];?></small>
					</div>
					<div class="col-md-12 col-form-label">
						<button type="button" class="btn btn-danger float-right" <?php echo ($row['grade_q1'] != 0  || $row['grade_q2'] != 0 ||  $row['grade_q3'] != 0 || $row['grade_q4'] != 0? "disabled" : "");?> id="btnDelete" title="Delete subject" onclick="return confirm('Delete subject?') ? submitAction('deleteSubject') : false;">
							<i class="fas fa-trash"></i>
						</button>
					</div>
				</div>
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
			} else {
				echo $result['1'];
			}
			
		} else if($_POST['data']['1'] == "addSubject"){
			$result = $controller->getSubjects($data);	
			
			if($result['0'] == 1){ 
				?>
				<div class="row">
					<div class="col-md-12 col-form-label">
						<label>Section</label>
						<select class="form-control" id="class_no" value="class_no" onchange="getSubject();" required>
						<?php	
						echo '<option value="">Select subject</option>';
						while($row = $result['2']->fetch_assoc()){
							echo '<option value="'.$row['class_no'].'">'.$row['pros_title'].'/'.$row['section_name'].'</option>';
						}
						?>
						<script></script>
						</select>
					</div>
					<div class="col-md-3 col-form-label">
						<label>Description</label>
					</div>
					<div class="col-md-9 col-form-label">
						<small id="subject-description">*</small>
					</div>
					<div class="col-md-3 col-form-label" style="margin-top: -25px;">
						<label>Schedule</label>
					</div>
					<div class="col-md-9 col-form-label" style="margin-top: -25px;">
						<small id="subject-details">*</small>
					</div>
					<div class="col-md-3 col-form-label" style="margin-top: -25px;">
						<label>Teacher</label>
					</div>
					<div class="col-md-9 col-form-label" style="margin-top: -25px;">
						<small id="subject-teacher">*</small>
					</div>
				</div>
				<?php
			} else {
				echo $result['1'];
			}
			
		} else if($_POST['data']['1'] == "modifyGrade"){
			$result = $controller->getGrade($data);	
			
			if($result['0'] == 1){ $row = $result['2'];
				?>
				<div class="card">
					<div class="card-body table-responsive p-0">	
						<small>
						<table class="table">
							<thead>
								<tr>
									<th width="14%">Course Code</th>
									<th>Name</th>
									<th width="12%"><?php echo ($row['pros_level'] > 10 ? "Mid" : "Q1");?></th>
									<th width="12%"><?php echo ($row['pros_level'] > 10 ? "Fin" : "Q2");?></th>
									<th width="12%"><?php echo ($row['pros_level'] > 10 ? "" : "Q3");?></th>
									<th width="12%"><?php echo ($row['pros_level'] > 10 ? "" : "Q4");?></th>
									<th width="14%">Ave</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><?php echo $row['pros_title'];?></td>
									<td><?php echo strtoupper($row['stud_lname'].", ".$row['stud_fname'].($row['stud_xname'] == "" ? "" : ", ".$row['stud_xname']).", ".substr($row['stud_mname'], 0, 1));?>.</td>
									<td><input type="number" class="form-control" id="grade_q1" onkeyup="computeAve(<?php echo $row['pros_level'];?>);" value="<?php echo ($row['grade_q1'] < $min_grade ? "" : $row['grade_q1']);?>" min="<?php echo $min_grade;?>" max="<?php echo $max_grade;?>"></td>
									<td><input type="number" class="form-control" id="grade_q2" onkeyup="computeAve(<?php echo $row['pros_level'];?>);" value="<?php echo ($row['grade_q2'] < $min_grade ? "" : $row['grade_q2']);?>" max="<?php echo $max_grade;?>"></td>
									<?php if($row['pros_level'] > 10 ){ ?>
										<td></td>	
										<td></td>
									<?php } else { ?>
										<td><input type="number" class="form-control" id="grade_q3" onkeyup="computeAve(<?php echo $row['pros_level'];?>);" value="<?php echo ($row['grade_q3'] < $min_grade ? "" : $row['grade_q3']);?>" min="<?php echo $min_grade;?>" max="<?php echo $max_grade;?>"></td>
										<td><input type="number" class="form-control" id="grade_q4" onkeyup="computeAve(<?php echo $row['pros_level'];?>);" value="<?php echo ($row['grade_q4'] < $min_grade ? "" : $row['grade_q4']);?>" min="<?php echo $min_grade;?>" max="<?php echo $max_grade;?>"></td>									
									<?php } ?>
									<td><input type="number" class="form-control" id="grade_final" value="<?php echo $row['grade_final'];?>" min="<?php echo $min_grade;?>" max="<?php echo $max_grade;?>" readonly></td>
								</tr>
							</tbody>
						</table>
						</small>
					</div>
				</div>
				<span id="pros-level"><?php echo $row['pros_level'];?></span>
				<script>	
				$('#pros-level').hide();
				function computeAve(pros_level){
					var grade_q1 = $('#grade_q1').val();
					var grade_q2 = $('#grade_q2').val();
					var grade_q3 = $('#grade_q3').val();
					var grade_q4 = $('#grade_q4').val();
					var ave;
					if(pros_level > 10){
						ave = (parseInt(grade_q1) + parseInt(grade_q2)) / 2;
					} else {
						ave = (parseInt(grade_q1) + parseInt(grade_q2) + parseInt(grade_q3) + parseInt(grade_q4)) / 4;
					}
					
					$('#grade_final').val(Math.round(ave));
					
				}
				</script>
				<?php if($row['grade_final'] < $pass_grade && (($row['pros_level'] > 10 && $row['grade_q1'] >= $min_grade && $row['grade_q2'] >= $min_grade) || ($row['pros_level'] < 11 && $row['grade_q1'] >= $min_grade || $row['grade_q2'] >= $min_grade || $row['grade_q3'] >= $min_grade || $row['grade_q4'] >= $min_grade))) { ?>
				<div class="row">
					<div class="col-md-3 col-form-label">
						<label>Remedial Grade</label>
						<input type="number" class="form-control" id="grade_remedialgrade" value="<?php echo $row['grade_remedialgrade'];?>" min="<?php echo $min_grade;?>" max="<?php echo $max_grade;?>" onkeyup="updatedRFG();" required>
						<hr>
						<label>Recomputed Final Grade</label>
						<input type="number" class="form-control" id="grade_recomputedfinalgrade" value="<?php echo $row['grade_recomputedfinalgrade'];?>" readonly>
					</div>
					<div class="col-md-1 col-form-label">
						<?php
						$school_n = strpos($row['grade_notes'], "-");
						$school = trim(substr($row['grade_notes'], 0, $school_n));
						$address_n = strpos($row['grade_notes'], "From:");
						$address = trim(substr($row['grade_notes'], $school_n+1, $address_n-($school_n+1)));
						$from_n = strpos($row['grade_notes'], "From:");
						$from = trim(substr($row['grade_notes'], ($from_n+5), 10));
						$to_n = strpos($row['grade_notes'], "To:");
						$to = trim(substr($row['grade_notes'], ($to_n+3), 10));
						?>
					</div>
					<div class="col-md-8 col-form-label">
						<div class="row">
							<div class="col-md-6">
								<label>Remedial start date</label>
								<input type="date" id="rem_from" class="form-control" value="<?php echo $from;?>" required>
							</div>
							<div class="col-md-6">
								<label>Remedial end date</label>
								<input type="date" id="rem_to" class="form-control" value="<?php echo $to;?>" required>
							</div>
						</div>
						<label>Learning Institution</label>
						<input type="text" id="rem_li" class="form-control" value="<?php echo $school;?>" required>
						<label>Learning Institution Address</label>
						<input type="text" id="rem_liadd" class="form-control" value="<?php echo $address;?>" required>
					</div>
				</div>
				<script>
				function updatedRFG(){
					var grade_final = $('#grade_final').val();
					var grade_remedialgrade = $('#grade_remedialgrade').val();
					var ave = (parseInt(grade_final) + parseInt(grade_remedialgrade)) / 2;
					
					$('#grade_recomputedfinalgrade').val(Math.round(ave));
				}
				</script>				
				<?php
				} else {
					echo'
					<div class="col-md-12 col-form-label">
						<button type="button" id="btnDelete" class="btn btn-danger float-right" onclick="return confirm(\'Delete subject?\') ? submitAction(\'deleteSubject\') : false;"><i class="fas fa-trash"></i></button>
					</div>';
					if($row['grade_q1'] >= $min_grade || $row['grade_q2'] >= $min_grade || $row['grade_q3'] >= $min_grade || $row['grade_q4'] >= $min_grade){
						echo "<script>$('#btnDelete').attr('disabled', 'disabled');</script>";
					}
				}
				?>
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
			} else {
				echo $result['1'];
			}
			
		} else if($_POST['data']['1'] == "addHistoricalSubject"){
			$result = $controller->getHistoricalSubjects($data);	
			
			echo '<select class="form-control" id="pros_no" required>';
			echo '<option value="">Select historical subject</option>';
			if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
				echo '<option value="'.$row['pros_no'].'">'.$row['pros_title']." - ".$row['pros_desc'].'</option>';				
			}} else {
				echo '<option value="">'.$result['1'].'</option>';
			}
			echo '</select>';
			
		} else if($_POST['data']['1'] == "addHistory"){
			?>
			<div class="row">
				<div class="col-md-2 col-form-label">
					<label>School Year *</label>
					<select id="enrol_sy" class="form-control" required>
					<?php 
					$result2 = $controller->getSYs($data);
					
					echo '<option value="">Select SY</option>';
					if($result2['0'] == 1){ while($row2 = $result2['2']->fetch_assoc()){
						echo '<option value="'.$row2['settings_sy'].'">'.$row2['settings_sy']."-".($row2['settings_sy']+1).'</option>';
					}} else {
						echo '<option value="">'.$result2['1'].'</option>';
					}
					?>
					</select>
				</div>
				<div class="col-md-2 col-form-label">
					<label>Grade Level *</label>
					<select id="enrol_level" class="form-control" required onchange="updateGradeLevel();">
					<?php 
					$result2 = $controller->getSYs($data);
					
					echo '<option value="">Select GL (grade level)</option>';
					for($i = $min_level-1; $i <= $max_level; $i++){
						echo '<option value="'.$i.'">'.$i.'</option>';
					}			
					?>
					</select>
				</div>
				<div class="col-md-2 col-form-label">
					<label>Average *</label>
					<input type="number" id="enrol_average" class="form-control"  min="<?php echo $min_grade;?>" max="<?php echo $max_grade;?>" required>
				</div>
				<div class="col-md-3 col-form-label">
					<label>Date completed *</label>
					<input type="date" id="enrol_graddate" class="form-control" min="<?php echo date('Y-m-d', strtotime('-25 years'));?>" max="<?php echo date('Y-m-d');?>" required>
				</div>
				<div class="col-md-3 col-form-label">
					<label>EOSY status *</label>
					<select id="enrol_status2" class="form-control"  required>
						<option value="">Select status</option>
						<option value="PROMOTED">PROMOTED</option>
						<option value="IRREGULAR">CONDITIONAL</option>
						<option value="IRREGULAR">IRREGULAR</option>
						<option value="RETAINED">RETAINED</option>
						<option value="DROPPED OUT">DROPPED OUT</option>
					</select>
				</div>
				<div class="col-md-5 col-form-label" id="esjhs-1">
					<label>Program type *</label>
					<select id="enrol_track2" class="form-control" onchange="updateProgramName();" required>
					<?php
					$result2 = $controller->getDropdowns(" field_category LIKE 'TRACK' AND (field_name LIKE 'JHS%' OR field_name LIKE 'ES%') ");
					
					echo '<option value="">Select program type</option>';
					if($result2['0'] == 1){while($row2 = $result2['2']->fetch_assoc()){
						echo '<option value="'.$row2['field_name'].'">'.$row2['field_name'].'</option>';
					}} else {
						echo '<option value="">'.$result2['1'].'</option>';
					}
					?>
					</select>
				</div>
				<div class="col-md-7 col-form-label" id="esjhs-2">
					<label>Program Name *</label>
					<input type="text" id="enrol_strand2" class="form-control" placeholder="Regular" required>
				</div>
				<div class="col-md-3 col-form-label" id="shs-1">
					<label>Track *</label>
					<select id="enrol_track" class="form-control" required onchange="updateStrand();">
					<?php
					$result2 = $controller->getDropdowns(" field_category LIKE 'TRACKS' ");
					
					echo '<option value="">Select track</option>';
					if($result2['0'] == 1){while($row2 = $result2['2']->fetch_assoc()){
						echo '<option value="'.$row2['field_name'].'">'.$row2['field_ext'].'</option>';
					}} else {
						echo '<option value="">'.$result2['1'].'</option>';
					}
					?>
					</select>
				</div>
				<div class="col-md-3 col-form-label" id="shs-2">
					<label>Strand *</label>
					<select id="enrol_strand" class="form-control" required>
					<?php
					$result2 = $controller->getDropdowns(" field_category LIKE 'STRAND%' ");
					
					echo '<option value="">Select strand</option>';
					if($result2['0'] == 1){while($row2 = $result2['2']->fetch_assoc()){
						echo '<option value="'.$row2['field_name'].'">'.$row2['field_name'].'</option>';
					}} else {
						echo '<option value="">'.$result2['1'].'</option>';
					}
					?>
					</select>
				</div>
				<div class="col-md-6 col-form-label" id="shs-3">
					<label>Combination *</label>
					<input type="text" id="enrol_combo" class="form-control" placeholder="Bread & Pastry, Food & Beverage, Cookery" required>
				</div>
				<div class="col-md-2 col-form-label">
					<label>School ID *</label>
					<input type="number" id="enrol_school_0" class="form-control" min="111111" max="999999999" required>
				</div>
				<div class="col-md-5 col-form-label">
					<label>School / Learning institution name *</label>
					<input type="text" id="enrol_school_1" class="form-control" required>
				</div>
				<div class="col-md-5 col-form-label">
					<label>School / Learning institution address *</label>
					<input list="addresses" type="text" id="enrol_school_2" class="form-control" required>
						<datalist id="addresses">
						<?php
						$result = $controller->getDropdowns(" field_category LIKE 'RESIDENCE' ");
						
						if($result['0'] == 1){while($row = $result['2']->fetch_assoc()){
							echo '<option value="'.$row['field_name'].'">';
						}} else {
							// no error handling
						}
						?>
						</select>
				</div>
				<div class="col-md-5 col-form-label">
					<label>Admission Eligibility *</label>
					<select id="enrol_eligibility" class="form-control" required onchange="requireRemarks();">
						<option value="">Select eligibility</option>
						<option value="Transferee">Transferee</option>
						<option value="Old Curriculum High School Completer">Old Curriculum High School Completer</option>
						<option value="Elementary School Completer">Elementary School Completer</option>
						<option value="Junior High School Completer">Junior High School Completer</option>
						<option value="Philippine Education Placement Test Passer">Philippine Education Placement Test Passer</option>
						<option value="Alternative Learning System Passer">Alternative Learning System Passer</option>
						<option value="Others/Old Student">Others/Old Student</option>
					</select>
				</div>
				<div class="col-md-3 col-form-label">
					<label>Section *</label>
					<input type="text" id="enrol_section" class="form-control" placeholder="Onyx" required>
				</div>
				<div class="col-md-4 col-form-label">
					<label>Remarks *</label>
					<input type="text" id="enrol_remarks" class="form-control" value="OK" placeholder="ALS/PEPT Ref #" readonly required>
				</div>
			</div>
			<script>
			$('#esjhs-1').hide();
			$('#esjhs-2').hide();
			$('#shs-1').hide();
			$('#shs-2').hide();
			$('#shs-3').hide();
			</script>
			<?php	
			
		} else if($_POST['data']['1'] == "modifyHistory"){
			$result = $controller->getHistory($data);
			
			if($result['0'] == 1){ $row = $result['2'];
				$enrol_school = unserialize($row['enrol_school']);
			?>
				<div class="row">
					<div class="col-md-2 col-form-label">
						<label>School Year *</label>
						<select id="enrol_sy" class="form-control" disabled required>
						<?php 
						$result2 = $controller->getSYs($data);
						
						echo '<option value="">Select SY</option>';
						if($result2['0'] == 1){ while($row2 = $result2['2']->fetch_assoc()){
							echo '<option value="'.$row2['settings_sy'].'">'.$row2['settings_sy']."-".($row2['settings_sy']+1).'</option>';
						}} else {
							echo '<option value="">'.$result2['1'].'</option>';
						}
						?>
						</select>
					</div>
					<div class="col-md-2 col-form-label">
						<label>Grade Level *</label>
						<select id="enrol_level" class="form-control"  required onchange="updateGradeLevel();">
						<?php 
						$result2 = $controller->getSYs($data);
						
						echo '<option value="">Select GL (grade level)</option>';
						for($i = $min_level-1; $i <= $max_level; $i++){
							echo '<option value="'.$i.'">'.$i.'</option>';
						}
						$row1 = $row;
						?>
						</select>
					</div>
					<div class="col-md-2 col-form-label">
						<label>Average *</label>
						<input type="number" id="enrol_average" class="form-control" value="<?php echo $row['enrol_average'];?>" min="<?php echo $min_grade;?>" max="<?php echo $max_grade;?>" required>
					</div>
					<div class="col-md-3 col-form-label">
						<label>Date completed *</label>
						<input type="date" id="enrol_graddate" class="form-control" value="<?php echo $row['enrol_graddate'];?>" min="<?php echo date('Y-m-d', strtotime('-25 years'));?>" max="<?php echo date('Y-m-d');?>" required>
					</div>
					<div class="col-md-3 col-form-label">
						<label>EOSY status *</label>
						<select id="enrol_status2" class="form-control" required>
							<option value="">Select status</option>
							<option value="PROMOTED">PROMOTED</option>
							<option value="IRREGULAR">CONDITIONAL</option>
							<option value="IRREGULAR">IRREGULAR</option>
							<option value="RETAINED">RETAINED</option>
							<option value="DROPPED OUT">DROPPED OUT</option>
						</select>
					</div>
					<div class="col-md-5 col-form-label" id="esjhs-1">
						<label>Program type *</label>
						<select id="enrol_track2" class="form-control" onchange="updateProgramName();" required>
						<?php
						$result2 = $controller->getDropdowns(" field_category LIKE 'TRACK' AND field_name NOT LIKE 'SHS%' ");
						
						echo '<option value="">Select program type</option>';
						if($result2['0'] == 1){while($row2 = $result2['2']->fetch_assoc()){
							echo '<option value="'.$row2['field_name'].'">'.$row2['field_name'].'</option>';
						}} else {
							echo '<option value="">'.$result2['1'].'</option>';
						}
						?>
						</select>
					</div>
					<div class="col-md-7 col-form-label" id="esjhs-2">
						<label>Program Name *</label>
						<input type="text" id="enrol_strand2" class="form-control" required>
					</div>
					<div class="col-md-3 col-form-label" id="shs-1">
						<label>Track *</label>
						<select id="enrol_track" class="form-control" required onchange="updateStrand();">
						<?php
						$result2 = $controller->getDropdowns(" field_category LIKE 'TRACKS' ");
						
						echo '<option value="">Select track</option>';
						if($result2['0'] == 1){while($row2 = $result2['2']->fetch_assoc()){
							echo '<option value="'.$row2['field_name'].'">'.$row2['field_ext'].'</option>';
						}} else {
							echo '<option value="">'.$result2['1'].'</option>';
						}
						?>
						</select>
					</div>
					<div class="col-md-3 col-form-label" id="shs-2">
						<label>Strand *</label>
						<select id="enrol_strand" class="form-control" required>
						<?php
						$result2 = $controller->getDropdowns(" field_category LIKE 'STRAND%' ");
						
						echo '<option value="">Select strand</option>';
						if($result2['0'] == 1){while($row2 = $result2['2']->fetch_assoc()){
							echo '<option value="'.$row2['field_name'].'">'.$row2['field_name'].'</option>';
						}} else {
							echo '<option value="">'.$result2['1'].'</option>';
						}
						?>
						</select>
					</div>
					<div class="col-md-6 col-form-label" id="shs-3">
						<label>Combination *</label>
						<input type="text" id="enrol_combo" class="form-control" required>
					</div>
					<div class="col-md-2 col-form-label">
						<label>School ID *</label>
						<input type="number" id="enrol_school_0" class="form-control" min="111111" max="999999999" value="<?php echo $enrol_school['0'];?>" required>
					</div>
					<div class="col-md-5 col-form-label">
						<label>School / Learning institution name *</label>
						<input type="text" id="enrol_school_1" class="form-control" value="<?php echo $enrol_school['1'];?>" required>
					</div>
					<div class="col-md-5 col-form-label">
						<label>School / Learning institution address *</label>
						<input list="addresses" type="text" id="enrol_school_2" class="form-control" value="<?php echo $enrol_school['2'];?>" required>
							<datalist id="addresses">
							<?php
							$result = $controller->getDropdowns(" field_category LIKE 'RESIDENCE' ");
							
							if($result['0'] == 1){while($row = $result['2']->fetch_assoc()){
								echo '<option value="'.$row['field_name'].'">';
							}} 
							?>
							</select>
					</div>
					<div class="col-md-5 col-form-label">
						<label>Admission Eligibility *</label>
						<select id="enrol_eligibility" class="form-control" value="" required onchange="requireRemarks();">
							<option value="">Select eligibility</option>
							<option value="Transferee">Transferee</option>
							<option value="Old Curriculum High School Completer">Old Curriculum High School Completer</option>
							<option value="Elementary School Completer">Elementary School Completer</option>
							<option value="Junior High School Completer">Junior High School Completer</option>
							<option value="Philippine Education Placement Test Passer">Philippine Education Placement Test Passer</option>
							<option value="Alternative Learning System Passer">Alternative Learning System Passer</option>
							<option value="Others/Old Student">Others/Old Student</option>
						</select>
					</div>
					<div class="col-md-3 col-form-label">
						<label>Section *</label>
						<input type="text" id="enrol_section" class="form-control" value="<?php echo $row1['enrol_section'];?>" placeholder="Onyx" required>
					</div>
					<div class="col-md-4 col-form-label">
						<label>Remarks *</label>
						<input type="text" id="enrol_remarks" class="form-control" value="<?php echo $row1['enrol_remarks'];?>" placeholder="ALS/PEPT Ref #" readonly required>
					</div>
					<div class="col-md-11 col-form-label">
						<p style="color: green"><small>Note: If the delete button is disabled, it means this history has associated graded subjects. 
							Delete them first to enable this feature.</small></p>
					</div>
					<div class="col-md-1 col-form-label">
						<button type="button" id="btnDelete" class="btn btn-danger float-right" onclick="return confirm('Delete enrollment history including associated historical grades?') ? submitAction('deleteHistory') : false;"><i class="fas fa-trash"></i></button>
					</div>
				</div>
				<script>
				$('#enrol_sy').val('<?php echo $row1['enrol_sy'];?>');
				$('#enrol_level').val('<?php echo $row1['enrol_level'];?>').change();
				$('#enrol_status2').val('<?php echo $row1['enrol_status2'];?>');
				$('#enrol_track').val('<?php echo $row1['enrol_track'];?>');
				$('#enrol_strand').val('<?php echo $row1['enrol_strand'];?>');
				$('#enrol_combo').val('<?php echo $row1['enrol_combo'];?>');
				setTimeout(function(){$('#enrol_track2').val('<?php echo $row1['enrol_track'];?>').change();}, 100);
				$('#enrol_strand2').val('<?php echo $row1['enrol_strand'];?>');
				$('#enrol_eligibility').val('<?php echo $row1['enrol_eligibility'];?>');
				
				var enrol_level = $('#enrol_level').val(); 
				if(enrol_level > 10){
					$('#esjhs-1').hide();
					$('#esjhs-2').hide();				
					$('#shs-1').show();				
					$('#shs-2').show();				
					$('#shs-3').show();				
				} else {
					$('#esjhs-1').show();
					$('#esjhs-2').show();	
					$('#shs-1').hide();				
					$('#shs-2').hide();				
					$('#shs-3').hide();						
				}
				</script>
				<script>
				setTimeout(function(){disableDelete();}, 200);
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
			
		} else if($_POST['data']['1'] == "modifyCurrent"){ 
			$result = $controller->getCurrent($data);
			
			if($result['0'] == 1){ $row1 = $result['2'];
			?>
			<div class="row">
				<div class="col-md-3 col-form-label">
					<label>Grade Level *</label>
					<select class="form-control" id="enrol_level" onchange="updateSection();" required disabled>
						<?php
						echo '<option value="">Select level</option>';
						for($i = $min_level; $i <= $max_level; $i++){
							echo '<option value="'.$i.'">Grade '.$i.'</option>';
						}
						?>
					</select>
				</div>
				<div class="col-md-5 col-form-label">
					<label>Section *</label>
					<select class="form-control" id="enrol_section" required disabled>
						<?php
						$result = $controller->getSections($_SESSION['current_sy'], "%");
						
						echo '<option value="">Select section</option>';
						if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
							echo '<option value="'.$row['section_name'].'">'.$row['section_name'].'</option>';
						}} else{
							echo '<option value="">'.$result['1'].'</option>';
						}
						?>
					</select>
				</div>
				<div class="col-md-4 col-form-label">
					<label>Remarks/notes</label>
					<input type="text" class="form-control" id="enrol_remarks">
				</div>
			</div>
			<div class="row" id="track-esjhs">
				<div class="col-md-8 col-form-label" id="enrollment-warning">
				
				</div>	
				<div class="col-md-4 col-form-label">
					<label>Program type *</label>
					<select class="form-control" id="enrol_track2" required disabled>
						<?php
						$result = $controller->getDropdowns(" field_category = 'TRACK' AND field_name NOT LIKE 'SHS%' ");
						
						echo '<option value="">Select program type</option>';
						if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
							echo '<option value="'.$row['field_name'].'">'.$row['field_name'].'</option>';
						}} else{
							echo '<option value="">'.$result['1'].'</option>';
						}
						?>
					</select>
				</div>
			</div>
			<div class="row" id="track-shs">
				<div class="col-md-3 col-form-label">
					<label>Track *</label>
					<select class="form-control" id="enrol_track1" onchange="updateStrand();" required disabled>
						<?php
						$result = $controller->getDropdowns(" field_category = 'TRACKS' ");
						
						echo '<option value="">Select track</option>';
						if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
							echo '<option value="'.$row['field_name'].'">'.$row['field_name'].'</option>';
						}} else{
							echo '<option value="">'.$result['1'].'</option>';
						}
						?>
					</select>
				</div>
				<div class="col-md-3 col-form-label">
					<label>Strand *</label>
					<select class="form-control" id="enrol_strand" onchange="updateCombo();" required disabled>
						<?php
						$result = $controller->getDropdowns(" field_category LIKE 'STRAND%' ");
						
						echo '<option value="">Select strand</option>';
						if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
							echo '<option value="'.$row['field_name'].'">'.$row['field_name'].'</option>';
						}} else{
							echo '<option value="">'.$result['1'].'</option>';
						}
						?>
					</select>
				</div>			
				<div class="col-md-6 col-form-label">
					<label>Specialization combination * (TVL only)</label>
					<select class="form-control" id="enrol_combo" required disabled>
						<?php
						$result = $controller->getDropdowns(" field_category LIKE 'COMBO%' ");
						
						echo '<option value="">Select specialization combination</option>';
						if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
							echo '<option value="'.$row['field_name'].'">'.$row['field_name'].'</option>';
						}} else{
							echo '<option value="">'.$result['1'].'</option>';
						}
						?>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-md-11 col-form-label">
					<p align="left" style="color: green"><small>Note: (1) If need to modify grayed fields, un-enroll student and enroll again. 
					(2) Moreover, if the delete button is disabled, it means this history has associated graded subjects. Delete them first to enable this feature.
					</small></p>
				</div>
				<div class="col-md-1 col-form-label">
					<input type="hidden" class="form-control" id="enrol_sy">
					<button type="button" id="btnDelete" class="btn btn-danger float-right" onclick="return confirm('Delete current enrollment including associated grades?') ? submitAction('deleteHistory') : false;"><i class="fas fa-trash"></i></button>
				</div>
			</div>
			<script>
			setTimeout(function(){filloutCurrent();}, 100);
			
			function filloutCurrent(){
				$('#enrol_sy').val('<?php echo $row1['enrol_sy'];?>');
				$('#enrol_level').val('<?php echo $row1['enrol_level'];?>');
				$('#enrol_section').val('<?php echo $row1['enrol_section'];?>');
				$('#enrol_remarks').val('<?php echo $row1['enrol_remarks'];?>');
				$('#enrol_track2').val('<?php echo $row1['enrol_track'];?>');
				$('#enrol_track1').val('<?php echo $row1['enrol_track'];?>');
				$('#enrol_strand').val('<?php echo $row1['enrol_strand'];?>');
				$('#enrol_combo').val('<?php echo $row1['enrol_combo'];?>');
				
			}
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
			} else {
				echo $result['1'];
			}
			
		} else if($_POST['data']['1'] == "enrollSem2"){ 
			$result =  $controller->getOfferings($data);
			$data2 = array(array('', '', $data['0']['2'], $data['0']['3'], 1));
			$result2 = $controller->getSemStatus($data2, " AND (grade_remarks = '0' OR grade_remarks = '' OR grade_remarks IS NULL) ");
			$result3 =  $controller->getSemStatus($data, ""); 
			if($result2['0'] == 1){
				echo '
				<div class="callout callout-danger">
					<h5>Enrollment Error</h5>
					<p>Student has not complied the requirements of the First Semester. 
					Let student comply first to enable this feature.</p>
				</div>';
				echo "<script>$('#submit').attr('disabled', 'disabled');</script>";
			} else if($result3['0'] == 1) {
				echo '
				<div class="callout callout-danger">
					<h5>Enrollment Error</h5>
					<p>Student is already enrolled for the Second Semester. Click the trash button to un-enroll student from the second instead.
					<button type="button" class="btn btn-danger" id="btnDelete" onclick="return confirm(\'Un-enroll student from the Second Semester?\') ? submitAction(\'deleteSem2\') : false;"><i class="fas fa-trash"></i></button></p>
				</div>';
				$result5 = $controller->getSemStatus($data, " AND (grade_q1 >= '$min_grade' OR grade_q2 >= '$min_grade') ");
	
				if($result5['0'] == 1){ 
					echo "<script>$('#btnDelete').attr('disabled', 'disabled');</script>";
				} else {					
					echo "<script>$('#btnDelete').removeAttr('disabled');</script>"; 					
				}
				
				echo "<script>$('#submit').attr('disabled', 'disabled');</script>";
				?>
				<script>
				setTimeout(function(){disableDelete();}, 300);
				function disableDelete(){
					if(modacc_role == 2){ 
						$('#btnDelete').hide(); 
					} else{ 
						$('#btnDelete').show();
					}
				}
				</script>
				<?php
			} else if($result['0'] == 1) { 
				echo '
				<div class="card-body table-responsive p-0">
					<small>
					<h6>Student will be enrolled to the following subjets:</h6>
					<table width="100%">
						<thead>
							<tr>
								<th></th>
								<th>#</th>
								<th>Code</th>
								<th>Desc</th>
								<th>Schedule</th>
							</tr>
						</thead>
						<tbody>';
				 
				$i = 1;
				while($row = $result['2']->fetch_assoc()){
					$result4 = $controller->getSubjectStatus($data, $row['pros_no']);
					
					if($result4['0'] == 1){ $count = $result4['3'];} else { $count = 0;}
					
					echo'
                    <tr>
                      <td><input type="checkbox" id="class_no" name="class_no" value="'.$row['class_no'].'" '.($count == 0 ? "checked" : "disabled").'></td>
                      <td>'.$i++.'</td>
                      <td>'.$row['pros_title'].'</td>
                      <td title="'.$row['pros_desc'].'">'.substr($row['pros_desc'], 0, 20).'...</td>
                      <td>'.$row['class_timeslots']." / ".$row['class_days'].'</td>
                    </tr>';
				}
				
						echo '
						</tbody>
					</table>
					<small>
				</div>';
			} else {
				echo $result['1'];
			}
			
		} else if($_POST['data']['1'] == "updateStatus"){ 
			$result = $controller->getHistory($data);
			
			if($result['0'] == 1){ $row = $result['2'];
			?>
			<div class="row">
				<div class="col-md-7 col-form-label">
					<label>Enrollment Status</label>
					<select class="form-control" id="enrol_status2" onchange="updateRemarks();">
						<option value="REGULAR">Regular</option>
						<option value="IRREGULAR" <?php echo ($row['enrol_level'] < 11 ? "disabled" : "");?>>Irregular</option>
						<option value="TRANSFERRED OUT">Transferred out</option>
						<option value="DROPPED OUT">No longer in school</option>
					</select>
				</div>
				<div class="col-md-5 col-form-label">
					<label>Temporary Enrollment?</label>
					<select class="form-control" id="enrol_gradawards">
						<option value="0">No</option>
						<option value="1">Yes</option>
					</select>
				</div>
			</div>
			<div class="row" id="status-NLS">
				<div class="col-md-12 col-form-label">
					<label>Effective date *</label>
					<input type="date" class="form-control" id="enrol_graddate1" required>
				</div>
				<div class="col-md-12 col-form-label">
					<label>Reason for leaving *</label>
					<select class="form-control" id="enrol_remarks1" required>
						<option value="">Select reason</option>
						<option value="Had to take care of siblings">Had to take care of siblings</option>
						<option value="Early marriage/pregnancy">Early marriage/pregnancy</option>
						<option value="Parents’ attitude toward schooling">Parents’ attitude toward schooling</option>
						<option value="Family problems/feuds">Family problems/feuds</option>
						<option value="Illness">Illness</option>
						<option value="Overage">Overage</option>
						<option value="Death">Death</option>
						<option value="Drug Abuse">Drug Abuse</option>
						<option value="Poor academic performance">Poor academic performance</option>
						<option value="Lack of interest/Distractions">Lack of interest/Distractions</option>
						<option value="Hunger/Malnutrition">Hunger/Malnutrition</option>
						<option value="Teacher factor">Teacher factor</option>
						<option value="Physical conditions of classroom">Physical conditions of classroom</option>
						<option value="Peer Influences">Peer Influences</option>
						<option value="Distance between home and school">Distance between home and school</option>
						<option value="Armed conflict">Armed conflict</option>
						<option value="Calamities/Disasters">Calamities/Disasters</option>
						<option value="Child labor, work">Child labor, work</option>
						<option value="Transferred to ALS Program">Transferred to ALS Program</option>
						<option value="Transferred to School Abroad">Transferred to School Abroad</option>
						<option value="Transferred to International School">Transferred to International School</option>
						<option value="Acceleration (No longer attending class">Acceleration (No longer attending class)</option>
					</select>
				</div>
				
			</div>
			<div class="row" id="status-TO">
				<div class="col-md-12 col-form-label">
					<label>Effective date *</label>
					<input type="date" class="form-control" id="enrol_graddate2" required>
				</div>
				<div class="col-md-12 col-form-label">
					<label>School name to transfer to *</label>
					<input type="text" class="form-control" id="enrol_remarks2" required>
				</div>
				
			</div>
			
			<script>
			
			
			setTimeout(function(){filloutCurrent();}, 100);
				
			function filloutCurrent(){
				$('#enrol_status2').val('<?php echo ($row['enrol_status2']);?>').change();
				$('#enrol_gradawards').val('<?php echo $row['enrol_gradawards'];?>');
				$('#enrol_remarks1').val('<?php echo $row['enrol_remarks'];?>');
				$('#enrol_graddate1').val('<?php echo $row['enrol_graddate'];?>');
				$('#enrol_remarks2').val('<?php echo $row['enrol_remarks'];?>');
				$('#enrol_graddate2').val('<?php echo $row['enrol_graddate'];?>');
				updateRemarks();
				
			}	

			function updateRemarks(){
				var enrol_status2 = $('#enrol_status2').val();
				
				if(enrol_status2 == 'DROPPED OUT'){
					$('#status-NLS').show();
					$('#status-TO').hide();
				} else if(enrol_status2 == 'TRANSFERRED OUT'){
					$('#status-TO').show();
					$('#status-NLS').hide();
				} else {
					$('#status-NLS').hide();
					$('#status-TO').hide();
				}
				
			}
			</script>
			<?php
				if($row['enrol_status2'] == "PROMOTED" || $row['enrol_status2'] == "GRADUATED"){
					echo "<script>$('#enrol_status2').attr('disabled', 'disabled');</script>";
					echo "<script>$('#enrol_gradawards').attr('disabled', 'disabled');</script>";
					echo "<script>$('#submit').attr('disabled', 'disabled');</script>";
					echo "<script>toastr.error('EOSY status already been updated. No further actios allowed.');</script>";
				} else {
					echo "<script>$('#enrol_status2').removeAttr('disabled');</script>";
					echo "<script>$('#enrol_gradawards').removeAttr('disabled');</script>";
					echo "<script>$('#submit').attr('removeAttr');</script>";
				}
			
			} else {
				echo $result['1'];
			}
		}
		
	} else if($_POST['data']['0'] == "checkLRN"){
		$data = array_values($_POST);
		$result = $controller->checkLRN($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();	
		
	} else if($_POST['data']['0'] == "submitAction"){
		$data = array_values($_POST);
		
		if($_POST['data']['1'] == "modifyFamily"){
			$result = $controller->modifyFamily($data);
		} else if($_POST['data']['1'] == "modifyEnrollment"){
			$result = $controller->modifyEnrollment($data);
		} else if($_POST['data']['1'] == "addSubject"){
			$result = $controller->addSubject($data);
		} else if($_POST['data']['1'] == "deleteSubject"){
			$result = $controller->deleteSubject($data);
		} else if($_POST['data']['1'] == "modifyGrade"){
			$result = $controller->modifyGrade($data);
		} else if($_POST['data']['1'] == "addHistoricalSubject"){
			$result = $controller->addHistoricalSubject($data);
		} else if($_POST['data']['1'] == "addHistory"){
			$result = $controller->addHistory($data);
		} else if($_POST['data']['1'] == "modifyHistory"){
			$result = $controller->modifyHistory($data);
		} else if($_POST['data']['1'] == "deleteHistory"){
			$result = $controller->deleteHistory($data);
		} else if($_POST['data']['1'] == "modifyCurrent"){
			$result = $controller->modifyCurrent($data);
		} else if($_POST['data']['1'] == "enrollSem2"){
			$class_no = $data['0']['5'];
			
			$error = 0;
			for($i = 0; $i < sizeof($class_no); $i++){
				$result1 = $controller->enrollSem2($data, $class_no[$i]);
				
				if($result1['0'] != 1){ $error++;}
			}
			
			if($error == 0){
				$result = array(1, 'Record(s) added.');
			} else {
				$result = array(-1, 'Some or all record(s) are not added.');
			}
			
		} else if($_POST['data']['1'] == "deleteSem2"){
			$result = $controller->deleteSem2($data);
		} else if($_POST['data']['1'] == "updateStatus"){
			$result = $controller->updateStatus($data);
		}
				
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();	
		
	} else if($_POST['data']['0'] == "getSchedules"){
		$data = array_values($_POST);
		$result = $controller->getSchedules($data, "INNER JOIN class ON grade_class_no = class_no INNER JOIN prospectus ON class_pros_no = pros_no ", "", " GROUP BY grade_sem ORDER  BY grade_sem DESC ");
		
		if($result['0'] == 1){while($row = $result['2']->fetch_assoc()){
			?>
			<div class="card">
				<div class="card-header bg-white">
					<h3 class="card-title"><?php echo ($row['grade_sem'] == 12 ? "" : "Sem ".$row['grade_sem'].", ")." "."SY ".$row['grade_sy']."-".($row['grade_sy']+1);?></h3>
					<div class="card-tools">
						<a href="javascript:void(0);" 
							onclick="window.open('../reports/pdf_ss.php?id=<?php echo $row['grade_stud_no'];?>&sy=<?php echo $row['grade_sy'];?>&sem=<?php echo $row['grade_sem'];?>', 'newwindow', 'width=850, height=550'); return false;">
							<font color="blue"><i class="fas fa-print"></i></font></a>
						<?php if($row['grade_sem'] == $_SESSION['current_sem'] || $row['grade_sem'] == 12){ ?>
						<a href="javascript:void(0);"  title="Add subject"
							data-toggle="modal" data-target="#modal-input" rowID="<?php echo $row['pros_level'];?>" data-type="addSubject" data-backdrop="static" data-keyboard="false">
							<font color="blue"><i class="fas fa-plus-square"></i></font>
						</a>
						<?php } ?>
					</div>
				</div>
				<div class="card-body table-responsive p-0">	
					<small>
					<table class="table">
						<thead>
							<tr>
								<th width="6%">#</th>
								<th width="12%">Course Code</th>
								<th>Descriptive Title</th>
								<th width="6%"></th>
								<th width="6%">Time</th>
								<th width="6%">Days</th>
								<th width="12%">Room</th>
								<th width="15%">Teacher</th>
								<th width="6%"></th>
							</tr>
						</thead>
						<tbody>	
						<?php 
						$result2 = $controller->getSchedules($data, "INNER JOIN class ON grade_class_no = class_no INNER JOIN prospectus ON class_pros_no = pros_no 
							INNER JOIN teacher ON class_user_name = teach_no", " AND grade_sem ='".$row['grade_sem']."' ", " ORDER BY class_timeslots ASC ");
						
						$i = 1;
						if($result2['0'] == 1){while($row2 = $result2['2']->fetch_assoc()){
							echo '
							<tr>
								<td>'.$i++.'</td>
								<td title="'.$row2['grade_no'].'">'.$row2['pros_title'].'</td>
								<td title="'.$row2['pros_desc'].'">'.substr($row2['pros_desc'],0, 35).'...</td>
								<td>'.($row2['pros_level'] > 10 ? number_format($row2['pros_unit'], 2) : "").'</td>
								<td>'.$row2['class_timeslots'].'</td>
								<td>'.$row2['class_days'].'</td>
								<td>'.$row2['class_room'].'</td>
								<td>'.$row2['teach_lname'].", ".substr($row2['teach_fname'], 0, 1).'.</td>
								<td><a href="javascript:void(0);" class="float-right" title="Modify enrollment details"
										data-toggle="modal" data-target="#modal-input" rowID="'.$row2['grade_no'].'" data-type="modifyEnrollment" data-backdrop="static" data-keyboard="false">
										<i class="fas fa-external-link-alt"></i>
									</a>
								</td>
							</tr>';
						}} else {
							echo '<tr><td colspan="8"></td></tr>';
						}
						?>
						</tbody>
					</table>
					</small>
				</div>
			</div>
			<?php
		}} else {
			echo $result['1'];
		}
		
	} else if($_POST['data']['0'] == "getGrades"){
		$data = array_values($_POST);
		$result = $controller->getGrades($data, "INNER JOIN class ON grade_class_no = class_no INNER JOIN prospectus ON class_pros_no = pros_no ", "", " GROUP BY grade_sy, grade_sem ORDER  BY grade_sy DESC, grade_sem DESC ");
		
		if($result['0'] == 1){while($row = $result['2']->fetch_assoc()){
			?>
			<div class="card">
				<div class="card-header bg-white">
					<h3 class="card-title"><?php echo ($row['grade_sem'] == 12 ? "" : "Sem ".$row['grade_sem'].", ")." "."SY ".$row['grade_sy']."-".($row['grade_sy']+1);?></h3>
					<div class="card-tools">
						<a href="javascript:void(0);" 
							onclick="window.open('../reports/pdf_sf9.php?id=<?php echo $row['grade_stud_no'];?>&sy=<?php echo $row['grade_sy'];?>&sem=<?php echo $row['grade_sem'];?>', 'newwindow', 'width=1024, height=550'); return false;">
							<font color="blue"><i class="fas fa-print"></i></font></a>
						<?php if($row['grade_sy'] != $_SESSION['current_sy'] || $row['grade_sem'] != $_SESSION['current_sem']){ ?>
						<a href="javascript:void(0);"  title="Add historical subject"
							data-toggle="modal" data-target="#modal-input" rowID="<?php echo $row['grade_sy']."-".$row['grade_sem']."-".$row['pros_level'];?>" data-type="addHistoricalSubject" data-backdrop="static" data-keyboard="false">
							<font color="blue"><i class="fas fa-plus-square"></i></font>
						</a>
						<?php } ?>
					</div>
				</div>
				<div class="card-body table-responsive p-0">	
					<small>
					<table class="table">
						<thead>
							<tr>
								<th width="6%">#</th>
								<th width="12%">Course Code</th>
								<th>Descriptive Title</th>
								<th width="6%"></th>
								<th width="3%"><?php echo ($row['pros_level'] > 10 ? "Mid" : "Q1");?></th>
								<th width="3%"><?php echo ($row['pros_level'] > 10 ? "Fin" : "Q2");?></th>
								<th width="3%"><?php echo ($row['pros_level'] > 10 ? "" : "Q3");?></th>
								<th width="3%"><?php echo ($row['pros_level'] > 10 ? "" : "Q4");?></th>
								<th width="5%" title="Final grade">Ave</th>
								<th width="5%" title="Recomputed final grade">RFG</th>
								<th width="15%">Teacher</th>
								<th width="6%"></th>
							</tr>
						</thead>
						<tbody>	
						<?php 
						$result2 = $controller->getGrades($data, "INNER JOIN class ON grade_class_no = class_no INNER JOIN prospectus ON class_pros_no = pros_no 
							INNER JOIN teacher ON class_user_name = teach_no", " AND grade_sy = '".$row['grade_sy']."' AND grade_sem = '".$row['grade_sem']."' ", " ORDER BY pros_sort ASC ");
						
						$i = 1;
						if($result2['0'] == 1){while($row2 = $result2['2']->fetch_assoc()){
							echo '
							<tr>
								<td>'.$i++.'</td>
								<td title="'.$row2['grade_no'].'">'.$row2['pros_title'].'</td>
								<td title="'.$row2['pros_desc'].'">'.substr($row2['pros_desc'],0, 35).'...</td>
								<td>'.($row2['pros_level'] > 10 ? number_format($row2['pros_unit'], 2) : "").'</td>
								<td>'.($row2['grade_q1'] < $min_grade ? "" : $row2['grade_q1']).'</td>
								<td>'.($row2['grade_q2'] < $min_grade ? "" : $row2['grade_q2']).'</td>
								<td>'.($row['pros_level'] > 10 ? "" : ($row2['grade_q3'] < $min_grade ? "" : $row2['grade_q3'])).'</td>
								<td>'.($row['pros_level'] > 10 ? "" : ($row2['grade_q4'] < $min_grade ? "" : $row2['grade_q4'])).'</td>';
								if($row['pros_level'] > 10){
									echo '<td><strong>'.($row2['grade_q1'] < $min_grade || $row2['grade_q2'] < $min_grade ? "" : $row2['grade_final']).'</strong></td>';
								} else {
									echo '<td><strong>'.($row2['grade_q1'] < $min_grade || $row2['grade_q2'] < $min_grade || $row2['grade_q3'] < $min_grade || $row2['grade_q4'] < $min_grade? "" : $row2['grade_final']).'</strong></td>';
								}
								
								echo'<td title="Recomputed final grade"><font color="blue">'.($row2['grade_recomputedfinalgrade'] != 0 ? $row2['grade_recomputedfinalgrade'] : "").'</a></td>';
								echo'
								<td>'.$row2['teach_lname'].", ".substr($row2['teach_fname'], 0, 1).'.</td>
								<td><a href="javascript:void(0);" class="float-right" title="Modify grade details"
										data-toggle="modal" data-target="#modal-input" rowID="'.$row2['grade_no'].'" data-type="modifyGrade" data-backdrop="static" data-keyboard="false">
										<i class="fas fa-external-link-alt"></i>
									</a>
								</td>
							</tr>';
						}} else {
							echo '<tr><td colspan="8"></td></tr>';
						}
						?>
						</tbody>
					</table>
					</small>
				</div>
			</div>
			<?php
		}} else {
			echo $result['1'];
		}
		
	} else if($_POST['data']['0'] == "getHistory"){
		$data = array_values($_POST);
		$result = $controller->checkEnrollmentHistory($data);
		
		?>
		<div class="row">
			<div class="col-md-12">
				<a type="button" href="?p=admissions&enrol=<?php echo $_POST['data']['1'];?>" class="btn btn-info float-right" id="btnEnrol">Enrol Learner</a>
			</div>
		</div>
		<br>
		<div class="card">
			<div class="card-body table-responsive p-0">	
				<small>
				<table class="table">
					<thead>
						<tr>
							<th width="6%">#</th>
							<th width="12%">School Year</th>
							<th>School</th>
							<th width="5%">Level</th>
							<th width="14%">Section</th>
							<th width="5%">Ave</th>
							<th width="15%" title="* - Student is temporariy enrolled.">Status *</th>
							<th width="5%" title="Within school year transfer?">T/I</th>
							<th width="14%">
							<button href="javascript:void(0);" class="btn btn-info btn-xs float-right" title="Add enrollment history"
								data-toggle="modal" data-target="#modal-input" rowID="<?php echo $_GET['modify'];?>" data-type="addHistory" data-backdrop="static" data-keyboard="false">
								Add History
							</button>
							</th>
						</tr>
					</thead>
					<tbody>	
					<?php
					$i = 1;
					if($result['0'] == 1){while($row = $result['2']->fetch_assoc()){
						$enrol_school = unserialize($row['enrol_school']);
						echo'
						<tr>
							<td>'.$i++.'</td>
							<td><strong>'.$row['enrol_sy']."</strong>-".($row['enrol_sy']+1).'</td>
							<td><strong>'.strtoupper($enrol_school[1])." (".$enrol_school[0].")</strong><br>".ucwords(strtolower($enrol_school[2])).'</td>
							<td>'.$row['enrol_level'].'</td>
							<td>'.$row['enrol_section'].'</td>
							<td>'.($row['enrol_average'] < $min_grade ? "--" : number_format($row['enrol_average'])).'</td>
							<td>';
	
								if($row['enrol_sy'] == $_SESSION['current_sy']){
									echo '
									<a href="javascript:void(0);" title="Click to change status (eg. No longer in school, transfer out, etc)" 
										data-toggle="modal" data-target="#modal-input" rowID="'.$row['enrol_no'].'" 
										data-type="updateStatus" data-backdrop="static" data-keyboard="false">
										'.$row['enrol_status2'].'
									</a>';
								} else {
									echo $row['enrol_status2'];
								}
								
								echo ($row['enrol_gradawards'] == 1 ? "*" : "");
							echo '
							</td>
							<td>'.($row['enrol_ti'] == 1 ? "Yes" : "No").'</td>
							<td>';
								
								if($row['enrol_sy'] == $_SESSION['current_sy']){
									if($_SESSION['current_sem'] == 2 && $row['enrol_level'] > 10){ 	
										echo '
										<button class="btn btn-info btn-xs" href="javascript:void(0);" class="float-right" title="Enroll to second sem"
										data-toggle="modal" data-target="#modal-input" rowID="'.$row['enrol_section'].'" data-type="enrollSem2" data-backdrop="static" data-keyboard="false">
										Enroll Sem 2
										</button>';
									}
									
									echo'
									<a href="javascript:void(0);" class="float-right" title="Modify current enrollment"
										data-toggle="modal" data-target="#modal-input" rowID="'.$row['enrol_no'].'" data-type="modifyCurrent" data-backdrop="static" data-keyboard="false">
										<i class="fas fa-external-link-alt"></i>
									</a>';
								} else{
									echo'
									<a href="javascript:void(0);" class="float-right" title="Modify enrollment history"
										data-toggle="modal" data-target="#modal-input" rowID="'.$row['enrol_no'].'" data-type="modifyHistory" data-backdrop="static" data-keyboard="false">
										<i class="fas fa-external-link-alt"></i>
									</a>';
								}
							echo'
							</td>
						</tr>';
					}} else {
						echo '<tr><td colspan="8">'.$result['1'].'</td></tr>';
					}
					?>
					</tbody>
				</table>
				<?php
				$result = $controller->checkEnrollmentHistory($data);
				
				if($result['0'] == 1){ $row = $result['2']->fetch_assoc();
					if($row['enrol_sy'] != ($_SESSION['current_sy']-1)){
						echo "<script>$('#btnEnrol').fadeOut()</script>";
					}
				} else {
					echo "<script>$('#btnEnrol').fadeOut()</script>";
				}
				?>
				</small>
			</div>
		</div>
		<?php
		
	} else if($_POST['data']['0'] == "getSubject"){
		$data = array_values($_POST);
		$result = $controller->getSubject($data, " AND class_no LIKE '".$_POST['data']['4']."' ");
		$result2 = array($result['0'], $result['1'], $result['2']->fetch_assoc());
		
		header("Content-Type: application/json");
		echo json_encode($result2);

		exit();	
		
	} else if($_POST['data']['0'] == "addContact"){
		$data = array_values($_POST);
		$result = $controller->addContact($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();	
		
	} else if($_POST['data']['0'] == "checkStudentDetails"){
		$data = array_values($_POST);
		$result = $controller->checkStudentDetails($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();	
		
	} else if($_POST['data']['0'] == "checkEnrollmentHistory"){
		$data = array_values($_POST);
		$result = $controller->checkEnrollmentHistory($data);
		$result2 = array($result['0'], $result['1'], $result['2']->fetch_assoc(), $result['3']);
		
		header("Content-Type: application/json");
		echo json_encode($result2);

		exit();	
		
	} else if($_POST['data']['0'] == "setLevel"){
		$_SESSION['activeLevel'] = $_POST['data']['1'];		
		
	} else if($_POST['data']['0'] == "updateESJHSTrack"){
		$data = array_values($_POST);
		$result = $controller->getDropdowns($_POST['data']['1']);
		
		echo '<option value="">Select program type</option>';
		if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
			echo '<option value="'.$row['field_name'].'">'.$row['field_name'].'</option>';
		}} else {
			echo '<option value="">'.$result['1'].'</option>';
		}
		
	} else if($_POST['data']['0'] == "updateStrand"){
		$data = array_values($_POST);
		$result = $controller->getDropdowns($_POST['data']['1']);
		
		echo '<option value="">Select strand</option>';
		if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
			echo '<option value="'.$row['field_name'].'">'.$row['field_name'].'</option>';
		}} else {
			echo '<option value="">'.$result['1'].'</option>';
		}
		
	} else if($_POST['data']['0'] == "addSchooldays"){
		$data = array_values($_POST);
		$result = $controller->addSchooldays($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();	
		
	} else if($_POST['data']['0'] == "deleteSchoolDays"){
		$data = array_values($_POST);
		$result = $controller->deleteSchoolDays($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();	
		
	} else if($_POST['data']['0'] == "deleteCoreValues"){
		$data = array_values($_POST);
		$result = $controller->deleteCoreValues($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();	
		
	} else if($_POST['data']['0'] == "deleteSubjects"){
		$data = array_values($_POST);
		$result = $controller->deleteSubjects($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();	
		
	} else if($_POST['data']['0'] == "checkAssociations"){
		$data = array_values($_POST);
		$result = $controller->checkAssociations($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();	
		
	}	
}
?>