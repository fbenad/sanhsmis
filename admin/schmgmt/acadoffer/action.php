<?php
session_start();
require_once("../../../config/dbconfig.php");
require_once("../../../config/settings.php");
require_once("controller.php");

$controller = new Controller();

if(isset($_POST['data'])){	

	if($_POST['data']['0'] == "loadClassSYs"){
		$data = array_values($_POST);
		$result = $controller->loadClassSYs();
		
		if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
			echo '<option value="'.$row['settings_sy'].'">SY '.$row['settings_sy'].'-'.($row['settings_sy']+1).'</option>';
		}} else {
			echo '<option value="">'.$result['1'].'</option>';
		}
		
	} else if($_POST['data']['0'] == "loadClassSections"){
		$data = array_values($_POST);
		$result = $controller->loadClassSections($data);
		
		if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
			$data2 = array(array("", " class_no FROM class ", " WHERE class_section_no = '".$row['section_no']."' ",""));
			$result2 = $controller->loadDashboardCounts($data2);
			echo '<option value="'.$row['section_no'].'">Grade '.$row['section_level'].' - '.($row['section_bogus'] == "1" ? "BOGUS:" : "").$row['section_name'].($result2['3'] == 0 ? " (No assignments)" : " (".$result2['3']." subjects)").'</option>';
		}} else {
			echo '<option value="">'.$result['1'].'</option>';
		}
		
	} else if($_POST['data']['0'] == "loadSectionCourses"){
		$data = array_values($_POST);
		$result = $controller->getTerms($data);
				
		if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
			echo '
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">'.($row['class_sem'] == 12 ? "" : "Sem ".$row['class_sem'].", ").'SY '.$row['class_sy']."-".($row['class_sy']+1).' Offerings <span id="entity-list-count"></span></h3>
							<div class="card-tools">
								<a href="javascript:void(0);" id="add-offering" title="Add offering" 
									data-toggle="modal" data-target="#modal-input" rowID="0" 
									data-backdrop="static" data-keyboard="false" data-type="addOffering">
									<i class="fas fa-plus-square"></i>
								</a>
							</div>
						</div>
						<div class="card-body  table-responsive p-0">
							<small>
							<table class="table table-hover ">
								<thead>
									<tr>
										<th width="8%">#</th>
										<th width="13%">Course Code</th>
										<th>Desc Title</th>	
										<th width="10%">Time</th>
										<th width="10%">Days</th>					
										<th width="13%">Room</th>
										<th width="13%">Teacher</th>
										<th width="6%"></th>
									</tr>
								</thead>
								<tbody id="users-list">';
								
								$result2 = $controller->loadSectionCourses($data, $row['class_sem']);
								
								$i = 1;
								if($result2['0'] == 1){ while($row2 = $result2['2']->fetch_assoc()){
									echo '
									<tr>
										<td>'.$i++.'</td>
										<td title="'.$row2['class_no'].'">'.$row2['pros_title'].'</td>
										<td>'.$row2['pros_desc'].'</td>
										<td>'.$row2['class_timeslots'].'</td>
										<td>'.$row2['class_days'].'</td>
										<td>'.$row2['class_room'].'</td>
										<td>'.$row2['teach_lname'].", ".substr($row2['teach_fname'], 0, 1).".".'</td>
										<td><a href="javascript:void(0);" id="modify-offering" title="Modify offering" 
												data-toggle="modal" data-target="#modal-input" rowID="'.$row2['class_no'].'" 
												data-backdrop="static" data-keyboard="false" data-type="modifyOffering">
												<i class="fas fa-external-link-alt"></i>
											</a>
										</td>
									</tr>';
								}} else {
									echo '<tr><td colspan="8">'.$result2['1'].'</td>';
								}
								echo '
								</tbody>
							</table>
							</small>
						</div>
					</div>
				</div>
			</div>';	
		}} else {
			echo '
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">'.$result['1'].'</h3>
					<div class="card-tools">
						<a href="javascript:void(0);" id="add-offering" title="Add offering" 
							data-toggle="modal" data-target="#modal-input" rowID="0" 
							data-backdrop="static" data-keyboard="false" data-type="addOffering">
							<i class="fas fa-plus-square"></i>
						</a>
					</div>
				</div>
			</div>';
		}
		
	} else if($_POST['data']['0'] == "loadDashboardCounts"){
		$data = array_values($_POST);
		$result = $controller->loadDashboardCounts($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();	
		
	} else if($_POST['data']['0'] == "showAction"){
		$data = array_values($_POST);
		
		if($_POST['data']['1'] == "getSection"){
			$result = $controller->getSection($data);
			
			header("Content-Type: application/json");
			echo json_encode($result);

			exit();		
			
		} else if($_POST['data']['1'] == "addSubjects"){
			$result = $controller->getSection($data);
			
			if($result['0'] == 1){ $row = $result['2'];
				$section_name = $row['section_name'];
				$pros_curr = $row['settings_pros'];
				$pros_track = $row['section_track'];
				$pros_level = $row['section_level'];
				$section_bogus = $row['section_bogus'];
			} else {
				$section_name = $result['1'];
				$pros_curr = $result['1'];
				$pros_track = $result['1'];
				$pros_level = $result['1'];
				$section_bogus = $result['1'];
			}
			?>
			<div class="row">
				<div class="col-12">
					<div class="card">	
						<div class="card-header">
							<h3 class="card-title">Grade <?php echo $pros_level." - ".$section_name;?> (<?php echo $pros_track;?>)</h3>
							<div class="card-tools">
								<?php echo $pros_curr;?> Curriculum Year
							</div>
						</div>
						<div class="card-body table-responsive p-0">
							<small>
							<table class="table table-hover">
								<thead>
									<tr>
										<th width="5%"></th>
										<th width="5%">#</th>										
										<th width="20%">Subject Code</th>
										<th>Description</th>
										<th width="5%"></th>
									</tr>
								</thead>
								<tbody id="list-subjects">
								<?php
								$result = $controller->getSubjects($data, $pros_curr, $pros_track, $pros_level);
								
								$i = 1;
								$assocCounter = 0;
								if($result['0'] == 1){ while( $row = $result['2']->fetch_assoc()){
									$result2 = $controller->checkSubjectStatus($data, $row['pros_no']);
									$assocCounter += $result2['0'];
									
									echo '
									<tr style="line-height: .6">
										<td><input type="checkbox" id="pros_no" name="pros_no" value="'.$row['pros_no'].'" '.($result2['0'] == 0 ? "checked title='To be added'" : "disabled title='Already added' ").'></td>
										<td>'.$i++.'</td>										
										<td title="'.$row['pros_no'].'">'.$row['pros_title'].'</td>
										<td>'.$row['pros_desc'].'</td>
										<td><input type="hidden" id="pros_sem" name="pros_sem" style="width: 25px;" value="'.$row['pros_sem'].'" readonly '.($result2['0'] == 0 ? "" : "disabled").'></td>
									</tr>';

								}} else{
									echo '<tr><td colspan="5">'.$result['1'].'</td></tr>';
								}
								
								if(--$i == $assocCounter){
									echo "<script>$('#submit').attr('disabled', 'disabled');</script>";
								} else {
									echo "<script>$('#submit').removeAttr('disabled');</script>";
								}
 								?>
									<tr><td colspan="5">Note: <br>
										1) De-select subjects that should be excluded. Already added subjects will appear disabled. <br>
										2) You cannot add subjects to a bogus section through the "Assign offerings" button. Use the plus icon instead.<br>
										3) Make sure that the correct semester option (from the this dashboard) is correct to properly display semestral subjects.</td></tr>
								</tbody>
							</table>
							</small>
						</div>
					</div>
				</div>
			</div>
			<?php
			
		} else if($_POST['data']['1'] == "modifyOffering"){
			$result = $controller->getOffering($data);
			
			echo '
			<div class="row">
					<div class="col-12">
						<div class="card">';
						if($result['0'] == 1){ $row = $result['2'];
							?>
							<div class="card-header">
								<h3 class="card-title"><?php echo $row['pros_title'];?></h3>
								<div class="card-tools">
									Grade <?php echo $row['section_level']." - ".$row['section_name'];?>
								</div>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-md-7 col-form-label">
										<input type="hidden" class="form-control" id="class_no2" name="class_no2" value="<?php echo $row['class_no'];?>">
										<label>Timeslot(s)* <small>(Military Time)</small></label>										
										<input list="class_timeslots3" class="form-control" id="class_timeslots2" name="class_timeslots2" placeholder="13:00-14:00" value="<?php echo $row['class_timeslots'];?>" required>
										<datalist id="class_timeslots3">
											<?php
											$result3 = $controller->getDropdowns(" field_category = 'TIMELSLOTS' ");
											
											if($result3['0'] == 1){ while($row3 = $result3['2']->fetch_assoc()){
												echo '<option value="'.$row3['field_name'].'">';
											}} else {
												echo '<option value="'.$result3['1'].'">';
											}
											?>											
										</datalist>
										<small><small>(Separated by " / " for multiple timeslots)</small></small>										
									</div>
									<div class="col-md-5 col-form-label">
										<label>Days *</label>
										<input type="text" class="form-control" id="class_days2" name="class_days2" placeholder="MTWTHF" value="<?php echo $row['class_days'];?>" required>
										<small><small>(Same " / " as timeslots)</small></small>
									</div>
									<div class="col-md-7 col-form-label">
										<label>Classroom *</label>
										<input type="text" class="form-control" id="class_room2" name="class_room2" placeholder="Onyx" value="<?php echo ($row['class_room'] == "TBA" ? $row['section_name'] : $row['class_room']);?>" required>
									</div>
									<div class="col-md-5 col-form-label">
										<label>Semester to Offer *</label>
										<select class="form-control" id="class_sem2" name="class_sem2" required>
											<option value="">Select semester</option>
										<?php if($row['section_level'] > 10){ ?>
											<option value="1">Sem 1</option>
											<option value="2">Sem 2</option>
										<?php } else {?>
											<option value="12">Full Year</option>
										<?php } ?>
										</select>
									</div>
									<div class="col-md-10 col-form-label">
										<label>Teacher *</label>
										<select class="form-control" id="class_user_name2" name="class_user_name2" required>
											<option value="">Select teacher</option>
											<option value="1">*** To be assigned</option>
											<?php
											$result2 = $controller->getTeachers();
											
											if($result2['0'] == 1){ while($row2 = $result2['2']->fetch_assoc()){
												echo '<option value="'.$row2['teach_no'].'">'.$row2['teach_lname'].", ".$row2['teach_fname'].($row2['teach_xname'] == "" ? "" : ", ".$row2['teach_xname']).", ".$row2['teach_mname'].'</option>';
											}} else {
												echo '<option value="">'.$result2['1'].'</option>';
											}
											?>
										</select>
									</div>
									<div class="col-md-2 col-form-label">
										<label>Delete?</label>
										<button type="button" class="btn btn-danger float-right" id="delete" name="delete" onclick="return confirm('Delete offering?') ? submitAction('deleteOffering') : false;">
											<i class="fas fa-trash-alt"></i>
										</button>
									</div>
								</div>
							</div>
							<?php
							echo "<script>$('#class_sem2').val(".$row['class_sem'].").change();</script>";
							echo "<script>$('#class_user_name2').val(".$row['class_user_name'].").change();</script>";
							
							$result4 = $controller->checkAssociation($row['class_no']);
							
							if($result4['0'] == 1){
								echo "<script>$('#delete').attr('disabled', 'disabled')</script>";
							} else {
								echo "<script>$('#delete').removeAttr('disabled')</script>";
							}	
							
						} else {
							echo $result['1'];
						}
			echo '
						</div>
					</div>
			</div>';
			
		} else if($_POST['data']['1'] == "addOffering"){
			$result = $controller->getSection($data);
			
			if($result['0'] == 1){ $row = $result['2'];
				$section_name = $row['section_name'];
				$pros_curr = $row['settings_pros'];
				$pros_track = $row['section_track'];
				$pros_level = $row['section_level'];
				$section_bogus = $row['section_bogus'];
			} else {
				$section_name = $result['1'];
				$pros_curr = $result['1'];
				$pros_track = $result['1'];
				$pros_level = $result['1'];
				$section_bogus = $result['1'];
			}		

			if($section_bogus == 1){
				?>
				<div class="row">
					<div class="col-md-12 col-form-label">
						<label>Subject to Offer *</label>
						<select class="form-control" id="class_pros_no2" name="class_pros_no2" required>
							<option value="">Subject to offer</option>
							<?php
							if($pros_level > 10){
								$result = $controller->getSubjects2($data, " pros_curr LIKE '$pros_curr' AND pros_track LIKE 'SHS%' ");
							} else {
								$result = $controller->getSubjects2($data, " pros_curr LIKE '$pros_curr' AND pros_level = '$pros_level' AND pros_title LIKE 'TLE%' ");
							}
							
							if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
								echo '<option value="'.$row['pros_no'].'">'.$row['pros_title'].' - '.$row['pros_desc'].'</option>';
							}} else {
								echo '<option value="">'.$result['1'].'</option>';
							}
							?>
						</select>
					</div>
					<div class="col-md-12 col-form-label">
						<label>Semester to Offer *</label>
						<select class="form-control" id="class_sem2" name="class_sem2" required>
							<option value="">Select semester</option>
							<?php if($pros_level > 10){ ?>
								<option value="1">Sem 1</option>
								<option value="2">Sem 2</option>
							<?php } else {?>
								<option value="12">Full Year</option>
							<?php } ?>

						</select>
					</div>

				</div>		
				<?php	
			} else {
				echo '
				<div class="row">
					<div class="col-md-12 col-form-label">
						<label>You can only use this option for bogus sections. Use the "Assign offerings" option (from the dashboard) instead.</label>
					</div>
				</div>';
				echo "<script>$('#submit').attr('disabled', 'disabled')</script>";
			}
		} 
		
	} else if($_POST['data']['0'] == "submitAction"){
		$data = array_values($_POST);
		
		if($_POST['data']['1'] == "addSubjects"){
			$result = $controller->addSubjects($data);
		
			header("Content-Type: application/json");
			echo json_encode($result);

			exit();	
			
		} else if($_POST['data']['1'] == "modifyOffering"){
			$result = $controller->modifyOffering($data);
		
			header("Content-Type: application/json");
			echo json_encode($result);

			exit();		
			
		} else if($_POST['data']['1'] == "deleteOffering"){
			$result = $controller->deleteOffering($data);
		
			header("Content-Type: application/json");
			echo json_encode($result);

			exit();		
			
		} else if($_POST['data']['1'] == "addOffering"){
			$result = $controller->addOffering($data);
		
			header("Content-Type: application/json");
			echo json_encode($result);

			exit();				
		}
	}

}
?>