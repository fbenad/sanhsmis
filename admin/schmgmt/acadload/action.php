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
			echo '<option value="'.$row['class_sy'].'">SY '.$row['class_sy'].'-'.($row['class_sy']+1).'</option>';
		}} else {
			echo '<option value="">'.$result['1'].'</option>';
		}
		
	} else if($_POST['data']['0'] == "loadClassLoads"){
		$data = array_values($_POST);
		$result = $controller->loadClassLoads($data);
		
		if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
			echo '<option value="'.$row['class_pros_no'].'">Grade '.$row['pros_level'].' - '.$row['pros_title'].($row['class_sem'] == 12 ? "" : " (Sem ".$row['class_sem'].")").'</option>';
		}} else {
			echo '<option value="">'.$result['1'].'</option>';
		}
		
	} else if($_POST['data']['0'] == "loadAssignments"){
		$data = array_values($_POST);
		$result = $controller->getTerms($data);
				
		if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
			echo '
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">'.($row['class_sem'] == 12 ? "" : "Sem ".$row['class_sem'].", ").'SY '.$row['class_sy']."-".($row['class_sy']+1).' Assignments <span id="entity-list-count"></span></h3>
						</div>
						<div class="card-body  table-responsive p-0">
							<small>
							<table class="table table-hover ">
								<thead>
									<tr>
										<th width="5%">#</th>
										<th width="13%">Course Code</th>
										<th>Desc Title</th>	
										<th width="15%">Level & Section</th>
										<th width="10%">Time</th>
										<th width="8%">Days</th>
										<th width="8%">Room</th>
										<th width="13%">Teacher</th>
										<th width="6%"></th>
									</tr>
								</thead>
								<tbody id="users-list">';
								
								$result2 = $controller->loadAssignments($data);
								
								$i = 1;
								if($result2['0'] == 1){ while($row2 = $result2['2']->fetch_assoc()){
									echo '
									<tr>
										<td>'.$i++.'</td>
										<td title="'.$row2['class_no'].'">'.$row2['pros_title'].'</td>
										<td>'.$row2['pros_desc'].'</td>
										<td>'.$row2['pros_level'].' - '.$row2['section_name'].'</td>
										<td>'.$row2['class_timeslots'].'</td>
										<td>'.$row2['class_days'].'</td>
										<td>'.$row2['class_room'].'</td>
										<td>'.$row2['teach_lname'].', '.substr($row2['teach_fname'], 0, 1).'.'.'</td>
										<td><a href="javascript:void(0);" id="modify-offering" title="Modify offering" 
												data-toggle="modal" data-target="#modal-input" rowID="'.$row2['class_no'].'" 
												data-backdrop="static" data-keyboard="false" data-type="modifyOffering">
												<i class="fas fa-external-link-alt"></i>
											</a>										
										</td>
									</tr>';
								}} else {
									echo '<tr><td colspan="9">'.$result2['1'].'</td>';
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
			echo $result['1'];
		}
		
	} else if($_POST['data']['0'] == "loadDashboardCounts"){
		$data = array_values($_POST);
		$result = $controller->loadDashboardCounts($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();	
		
	} else if($_POST['data']['0'] == "loadTeachers"){
		$data = array_values($_POST);
		$result = $controller->loadTeachers();
		
		echo '<option value="">Select teacher</option>';
		if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
			echo '<option value="'.$row['teach_no'].'">'.$row['teach_lname'].", ".$row['teach_fname'].($row['teach_xname'] == "" ? "" : ", ".$row['teach_xname']).", ".substr($row['teach_mname'], 0, 1).'.</option>';
		}} else {
			echo '<option value="">'.$result['1'].'</option>';
		}
		
	} else if($_POST['data']['0'] == "loadAssignments2"){
		$data = array_values($_POST);
		$result = $controller->getTerms2($data);
				
		if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
			echo '
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">'.($row['class_sem'] == 12 ? "" : "Sem ".$row['class_sem'].", ").'SY '.$row['class_sy']."-".($row['class_sy']+1).' Assignments <span id="entity-list-count"></span></h3>
						</div>
						<div class="card-body  table-responsive p-0">
							<small>
							<table class="table table-hover ">
								<thead>
									<tr>
										<th width="5%">#</th>
										<th width="13%">Course Code</th>
										<th>Desc Title</th>	
										<th width="15%">Level & Section</th>
										<th width="10%">Time</th>
										<th width="8%">Days</th>
										<th width="8%">Room</th>
										<th width="13%">Teacher</th>
										<th width="6%"></th>
									</tr>
								</thead>
								<tbody id="users-list">';
								
								$result2 = $controller->loadAssignments2($data, $row['class_sem']);
								
								$i = 1;
								if($result2['0'] == 1){ while($row2 = $result2['2']->fetch_assoc()){
									echo '
									<tr>
										<td>'.$i++.'</td>
										<td title="'.$row2['class_no'].'">'.$row2['pros_title'].'</td>
										<td>'.$row2['pros_desc'].'</td>
										<td>'.$row2['pros_level'].' - '.$row2['section_name'].'</td>
										<td>'.$row2['class_timeslots'].'</td>
										<td>'.$row2['class_days'].'</td>
										<td>'.$row2['class_room'].'</td>
										<td>'.$row2['teach_lname'].', '.substr($row2['teach_fname'], 0, 1).'.'.'</td>
										<td><a href="javascript:void(0);" id="modify-offering" title="Modify offering" 
												data-toggle="modal" data-target="#modal-input" rowID="'.$row2['class_no'].'" 
												data-backdrop="static" data-keyboard="false" data-type="modifyOffering">
												<i class="fas fa-external-link-alt"></i>
											</a>										
										</td>
									</tr>';
								}} else {
									echo '<tr><td colspan="9">'.$result2['1'].'</td>';
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
			echo $result['1'];
		}
				
	}

}
?>