<?php
session_start();
require_once("../../config/dbconfig.php");
require_once("../../config/settings.php");
require_once("controller.php");

$controller = new Controller();

if(isset($_POST['data'])){	
	if($_POST['data']['0'] == "getScheduleTerms"){
		$data = array_values($_POST);		
		$result = $controller->getTerms($data);
		
		if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
			?>
			<option value="<?php echo $row['class_sy'];?>">SY <?php echo $row['class_sy'];?>-<?php echo $row['class_sy']+1;?></option>
			<?php 
		}} else { 
			echo '<option value="">'.$result['1'].'</option>';
		}	
		
	} else if($_POST['data']['0'] == "getSchedules"){	
		$data = array_values($_POST);
		$terms = $controller->getSchedules($data);	
		
		echo '<p><small><strong>Note:</strong> <i>Click on the Course Code to print the draft ECR and on the Section to submit grades.</i></small></p>';
		if($terms['0'] == 1){ while($termsRow = $terms['2']->fetch_assoc()){
			?>
			<div class="card card-default">
				<div class="card-header bg-white">
					<h3 class="card-title"><?php echo ($termsRow['class_sem'] == "12" ? "Full Year" : "Sem ".$termsRow['class_sem']);?></h3>
				</div>
				<div class="card-body table-responsive p-0">
					<table class="table table-bordered table-condensed table-hover table-striped">
						<thead>
							<tr>
								<th width="12%">Code</th>
								<th width="12%">Section</th>
								<th width="4%"></th>
								<th>Descriptive Title</th>
								<th width="3%">Units</th>
								<th width="15%">Time</th>
								<th width="10%">Days</th>
								<th width="13%">Room</th>
							</tr>		
						</thead>
						<tbody> 
						<?php
						$result = $controller->getSchedules2($data, $termsRow['class_sem']);
						
						if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
							$data2 = array(array('getClassList', $row['class_no'], '%'));
							$getClassList = $controller->getClassList($data2, '');
							?>
							<tr>
								<td>
									<small>
										<a href="javascript:void(0);" title="Print ECR" target="_blank" onclick="window.open('../reports/pdf_ecr.php?id=<?php echo $row['class_no'];?>', 'newwindow', 'width=850, height=550'); return false;">
											<?php echo $row['pros_title'];?>
										</a>
									</small>
								</td>
								<td>
									<small>
										<a href="<?php echo $row['class_no'];?>" title="Submit Grade" rowID="<?php echo $row['class_no']; ?>" 
											data-type="edit" data-toggle="modal" data-target="#modal-inputGrades" data-backdrop="static" 
											data-keyboard="false"> <span><?php echo $row['section_name'];?>
										</a> 
										(<?php echo ($getClassList['0'] == 1 ? $getClassList['3'] : $getClassList['1']);?>)</span>
									</small>
								</td>
								<td><a href="javascript:void(0);" title="Print Grade Sheet" target="_blank" onclick="window.open('../reports/pdf_gs.php?id=<?php echo $row['class_no'];?>', 'newwindow', 'width=850, height=550'); return false;">
										<i class="fas fa-print pull-right"></i>
									</a>
								</td>
								<td><small><?php echo $row['pros_desc'];?></small></td>
								<td><small><?php echo $row['pros_unit'];?><small></td>
								<td><small><?php echo $row['class_timeslots'];?></small></td>
								<td><small><?php echo $row['class_days'];?><small></td>
								<td><small><?php echo $row['class_room'];?><small></td>
							</tr>
							<?php
						}} else {
							echo '<tr><td colspan=6">'.$result['1'].'</td></td></tr>';		
						}
						?>
						</tbody> 
					</table>
				</div>
			</div>
			<br>	
			<?php			
		}} else { 
			echo '<tr><td colspan="7">'.$terms['1'].'</td></td></tr>';
		}
			
	} else if($_POST['data']['0'] == "getClassInfo"){
		$data = array_values($_POST);		
		$result = $controller->getClassInfo($data);
		
		header("Content-Type: application/json");
		echo json_encode($result['2']->fetch_assoc());

		exit();
		
	} else if($_POST['data']['0'] == "getClassList"){
		$data = array_values($_POST);		
		$result = $controller->getClassList($data, ($data['0']['3'] > 10 ? "" : " stud_gender DESC, "));
		$resultMale = $controller->getClassList(array(array($data['0']['0'], $data['0']['1'], 'MALE')), '');
		
		echo '<table class="table table-bordered table-hover table-condensed table-striped" border="0">
			<thead>
				<tr>
					<th width="5%">#</th>
					<th>Learner</th>
					<th width="10%">'.($data['0']['3'] <= 10 ? "Q1" : "Midterm").'</th>
					<th width="10%">'.($data['0']['3'] <= 10 ? "Q2" : "Final").'</th>
					<th width="10%">'.($data['0']['3'] <= 10 ? "Q3" : "").'</th>
					<th width="10%">'.($data['0']['3'] <= 10 ? "Q4" : "").'</th>
					<th width="10%">Status</th>
				</tr>		
			</thead>
			<tbody >';
		$i = 1;
		if($result['0'] == 1) {	while($row = $result['2']->fetch_assoc()){
			$getStatusData = array(array('getStatus', $row['grade_stud_no'], $row['grade_sy']));
			$getStatus = $controller->getStatus($getStatusData);
			if($getStatus['0'] == 1){ $getStatusRow = $getStatus['2']->fetch_assoc();
				$getStatusLabel = $getStatusRow['enrol_status1'];
			} else {
				$getStatusLabel = $getStatus['1']; 
			}
			?>
			<tr>
				<td valign="middle"><?php echo $i;?></td>
				<input type="hidden" id="grade_no[]" name="grade_no[]" value="<?php echo $row['grade_no'];?>">
				<td valign="middle"><?php echo $row['stud_lname'].", ".$row['stud_fname']." ".$row['stud_xname']." ".($row['stud_mname'] == "-" ? $row['stud_mname'] : substr($row['stud_mname'],0,1).".");?></td>
				<td><input <?php echo ($getStatusLabel == "INACTIVE" || $getStatusLabel == "PROMOTED" ? "readonly" : "");?> type="number" tabindex="1" class="form-control form-control-sm" style="width: 55px; height=10px;" max="<?php echo $max_grade;?>" min="<?php echo $min_grade;?>" <?php echo ($row['grade_q1'] >= $min_grade ? "readonly" : "" )?> id="grade_q1[]" name="grade_q1[]" value="<?php echo ($row['grade_q1'] < $min_grade ? "" : $row['grade_q1']);?>" autofocus></td>
				<td><input <?php echo ($getStatusLabel == "INACTIVE" || $getStatusLabel == "PROMOTED" ? "readonly" : "");?> type="number" tabindex="2" class="form-control form-control-sm" style="width: 55px; height=10px;" max="<?php echo $max_grade;?>" min="<?php echo $min_grade;?>" <?php echo ( $row['grade_q2'] >= $min_grade ? "readonly" : "" )?> id="grade_q2[]" name="grade_q2[]" value="<?php echo ($row['grade_q2'] < $min_grade ? "" : $row['grade_q2']);?>"></td>
				<td><input <?php echo ($getStatusLabel == "INACTIVE" || $getStatusLabel == "PROMOTED" ? "readonly" : "");?> type="<?php echo ($data['0']['3'] <= 10 ? "number" : "hidden");?>" tabindex="3" class="form-control form-control-sm" style="width: 55px; height=10px;" max="<?php echo $max_grade;?>" min="<?php echo $min_grade;?>" <?php echo ($row['grade_q3'] >= $min_grade ? "readonly" : "" )?> id="grade_q3[]" name="grade_q3[]" value="<?php echo ($row['grade_q3'] < $min_grade ? "" : $row['grade_q3']);?>"></td>
				<td><input <?php echo ($getStatusLabel == "INACTIVE" || $getStatusLabel == "PROMOTED" ? "readonly" : "");?> type="<?php echo ($data['0']['3'] <= 10 ? "number" : "hidden");?>" tabindex="4" class="form-control form-control-sm" style="width: 55px; height=10px;" max="<?php echo $max_grade;?>" min="<?php echo $min_grade;?>" <?php echo ($row['grade_q4'] >= $min_grade ? "readonly" : "" )?> id="grade_q4[]" name="grade_q4[]" value="<?php echo ($row['grade_q4'] < $min_grade ? "" : $row['grade_q4']);?>"></td>
				<td><small><?php echo $getStatusLabel;?></small></td>
			</tr>	
			<?php
			if($data['0']['3'] <= 10 && $i == $resultMale['3']){
				$i = 1;
				$resultMale['3'] = 0;
				echo '<tr><td colspan="7"></td></tr>';
			} else {
				$i++;
			}
		}} else {
			echo '<tr><td colspan="7">'.$result['1'].'</td></tr>';
		}
		
		echo '</tbody>
		</table>';
		
	} else if($_POST['data']['0'] == "submitGrades"){
		$data = array_values($_POST);		
		$result = $controller->submitGrades($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();
		
	} else if($_POST['data']['0'] == "getClassData"){
		echo '
		<div class="card-body" style="margin-top: -10px; margin-bottom: -10px">
			<strong>Adviser:</strong> <span id="class-adviser">{class-adviser}</span>
			<span class="float-right" id="class-label">{class-label}</span>
		</div>';
		
	} else if($_POST['data']['0'] == "getClassCurrent"){
		echo '
		<div class="card-body" style="margin-top: -12px;">
			<h3 class="card-title">Summary</h3>
			<br>
			<div class="row">
				<div class="col-md-4">
					<p align="center">
						<strong>No of learners</strong><br>
						<small>	'.($_SESSION['eosy'] == true ? "as of EOSY" : "as of ".date('M d, Y')).'</small>
						<h1 align="center" style="margin-top: -20px; ">
							<strong id="class-total-all">{class-total-all}</strong>
						</h1>
						<div class="row">
							<div class="col-md-3"></div>
							<div class="col-md-3 border-right">
								<div class="description-block">
								  <h5 class="description-header">Male</h5>
								  <span class="description-text" id="class-male-count">{class-male-count}</span>
								</div>
							</div>
							<div class="col-md-3">
								<div class="description-block">
								  <h5 class="description-header">Female</h5>
								  <span class="description-text" id="class-female-count">{class-female-count}</span>
								</div>
							</div>
							<div class="col-md-3"></div>
						</div>
					</p>
				</div>
				<div class="col-md-4" id="class-status1">
					<small>
						<table class="table table-condensed" border="0">
							<thead>
								<tr style="line-height: 1px">
									<th></th>
									<th width="15%">Male</th>
									<th width="15%">Female</th>
									<th width="15%">Total</th>
								</tr>		
							</thead>
							<tbody>
								<tr style="line-height: 1px">
									<td>Transfer-in</td>
									<td align="right" id="class-ti-m">{m}</td>
									<td align="right" id="class-ti-f">{f}</td>
									<td align="right" id="class-ti-t">{t}</td>
								</tr>';
								/*
								<tr style="line-height: 1px">
									<td>Balik-aral</td>
									<td align="right" id="class-ba-m">{m}</td>
									<td align="right" id="class-ba-f">{f}</td>
									<td align="right" id="class-ba-t">{t}</td>
								</tr>
								<tr style="line-height: 1px">
									<td>Repeater</td>
									<td align="right" id="class-rp-m">{m}</td>
									<td align="right" id="class-rp-f">{f}</td>
									<td align="right" id="class-rp-t">{t}</td>
								</tr>
								*/
							echo '	
							</tbody>
						</table>
					</small>
				</div>
				<div class="col-md-4" id="class-status2">
					<small>
						<table class="table table-condensed" border="0">
							<thead>
								<tr style="line-height: 1px">
									<th></th>
									<th width="15%">Male</th>
									<th width="15%">Female</th>
									<th width="15%">Total</th>
								</tr>		
							</thead>
							<tbody>
								<tr style="line-height: 12px">
									<td>CCT Recipient</td>
									<td align="right" id="class-cct-m">{m}</td>
									<td align="right" id="class-cct-f">{f}</td>
									<td align="right" id="class-cct-t">{t}</td>
								</tr>';
								/*
								<tr style="line-height: 1px">
									<td>ALIVE</td>
									<td align="right" id="class-al-m">{m}</td>
									<td align="right" id="class-al-f">{f}</td>
									<td align="right" id="class-al-t">{t}</td>
								</tr>
								<tr style="line-height: 1px">
									<td>ADM</td>
									<td align="right" id="class-ad-m">{m}</td>
									<td align="right" id="class-ad-f">{f}</td>
									<td align="right" id="class-ad-t">{t}</td>
								</tr>
								*/
							echo '
							</tbody>
						</table>
					</small>
				</div>
			</div>
		</div>';		
		
	} else if($_POST['data']['0'] == "getClassEOSY" && $_SESSION['eosy'] == true){
		echo '
		<div class="card-body" style="margin-top: -12px;">	
			<h3 class="card-title">End of School Year</h3>
			<br>
			<div class="row">
				<div class="col-md-4" id="class-eosy">
					<p align="center">
						<br>
						<br>
						<span id="class-finalize-label"></span>
						<button type="button" class="btn btn-info btn-lg" id="class-finalize" onclick="return confirm(\'Are you sure?\') ? finalize() : false;">Finalize</button>
					</p>
				</div>
				<div class="col-md-4" id="class-promotion1">
					<small>
						<table class="table table-condensed" border="0">
							<thead>
								<tr style="line-height: 1px">
									<th></th>
									<th width="15%">Male</th>
									<th width="15%">Female</th>
									<th width="15%">Total</th>
								</tr>		
							</thead>
							<tbody>
								<tr style="line-height: 1px">
									<td>No status</td>
									<td align="right" id="class-ns-m">{m}</td>
									<td align="right" id="class-ns-f">{f}</td>
									<td align="right" id="class-ns-t">{t}</td>
								</tr>
								<tr style="line-height: 1px">
									<td>Promoted</td>
									<td align="right" id="class-pr-m">{m}</td>
									<td align="right" id="class-pr-f">{f}</td>
									<td align="right" id="class-pr-t">{t}</td>
								</tr>
								<tr style="line-height: 12px">
									<td>Conditionally Promoted</td>
									<td align="right" id="class-cp-m">{m}</td>
									<td align="right" id="class-cp-f">{f}</td>
									<td align="right" id="class-cp-t">{t}</td>
								</tr>
								<tr style="line-height: 1px">
									<td>Retained</td>
									<td align="right" id="class-rt-m">{m}</td>
									<td align="right" id="class-rt-f">{f}</td>
									<td align="right" id="class-rt-t">{t}</td>
								</tr>																	
							</tbody>
						</table>
					</small>															
				</div>
				<div class="col-md-4" id="class-promotion2">
					<small>
						<table class="table table-condensed" border="0">
							<thead>
								<tr style="line-height: 1px">
									<th></th>
									<th width="15%">Male</th>
									<th width="15%">Female</th>
									<th width="15%">Total</th>
								</tr>		
							</thead>
							<tbody>
								<tr style="line-height: 12px">
									<td>Transferred out</td>
									<td align="right" id="class-to-m">{m}</td>
									<td align="right" id="class-to-f">{f}</td>
									<td align="right" id="class-to-t">{t}</td>
								</tr>
								<tr style="line-height: 12px" id="class-dropped-out">
									<td>Dropped out</td>
									<td align="right" id="class-do-m">{m}</td>
									<td align="right" id="class-do-f">{f}</td>
									<td align="right" id="class-do-t">{t}</td>
								</tr>
							</tbody>
						</table>
					</small>
				</div>
			</div>
		</div>';		
		
	} else if($_POST['data']['0'] == "checkAdvisorhsip"){
		$data = array_values($_POST);		
		$result = $controller->checkAdvisorhsip($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();
		
	} else if($_POST['data']['0'] == "getAdvisory"){
		$data = array_values($_POST);		
		$result = $controller->checkAdvisorhsip($data);
		
		if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
			echo '<option value="'.$row['section_no'].'">Grade '.$row['section_level'].' - '.$row['section_name'].'</option>';			
		}} else {
			echo '<option value="">'.$result['0'].'</option>';
		}
		
	} else if($_POST['data']['0'] == "getSectionInfo"){
		$data = array_values($_POST);		
		$result = $controller->getSectionInfo($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();
		
	} else if($_POST['data']['0'] == "getSectionStatistics"){
		$data = array_values($_POST);		
		$result = $controller->getSectionStatistics($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();
		
	} else if($_POST['data']['0'] == "getSectionList"){
		$data = array_values($_POST);		
		$result = $controller->getSectionList($data, ($data['0']['3'] > 10 ? "" : " stud_gender DESC, "));
		$resultMale = $controller->getSectionList(array(array($data['0']['0'], $data['0']['1'], $data['0']['2'], $data['0']['3'], 'MALE', $data['0']['5'], $data['0']['6'])), '');
		
		$i = 1;
		if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
			echo '															
			<tr>
				<td align="right">'.$i.'</td>
				<td><font face="courier new" title="Student #'.$row['stud_no'].'">'.$row['stud_lrn'].'</font> '.strtoupper($row['stud_lname']).', '.strtoupper($row['stud_fname']).', '.($row['stud_xname'] == "" ? "" : strtoupper($row['stud_xname']).",").' '.strtoupper($row['stud_mname']).'</td>
				<td>'.substr($row['stud_gender'], 0,1).'</td>
				<td align="center">
					<small>'.date('m/d/y', strtotime($row['sch_firstday'])).'</small>
				</td>
				<td>';
				if($_SESSION['eosy'] == true){			
					if($row['enrol_status1'] == "INACTIVE"){
						echo '<small>';
						echo "as of ".date('m/d/y', strtotime($row['enrol_graddate']));
						echo '</small>';
					} else {
						echo '<a href="#" title="Update Status" class="" rowID="'.$row['enrol_no'].'"
							data-type="edit" data-toggle="modal" data-target="#modal-updateStatus" data-backdrop="static" 
							data-keyboard="false"><i class="fas fa-pencil-alt"></i>
							</a>&nbsp;&nbsp;';
							
						if($row['enrol_status1'] == "PROMOTED"){	
							echo '<span class="float-right badge badge-default">'.round($row['enrol_average'],0).'</span>';
							echo '<p style="line-height: 0.7;"><small>';
							echo ucwords(strtolower(($row['enrol_status2'] == "IRREGULAR" && $row['enrol_level'] <= 10 ? "CONDITIONAL" : $row['enrol_status2'])));
							echo ($row['enrol_gradawards'] != "-" ? " ".ucwords(strtolower($row['enrol_gradawards'])) : "");
							echo '</small></p>';
							
						} else 	if ($row['enrol_status1'] == "ENROLLED"){
							echo '<small>';
							echo 'No Status';
							echo '</small>';
						}
					}
				} else {			
					if($row['enrol_status1'] == "INACTIVE"){
						echo '<small>';
						echo "as of ".date('m/d/y', strtotime($row['enrol_graddate']));
						echo '</small>';
					} else {
						echo '<a href="#" title="Update Status" class="" rowID="'.$row['enrol_no'].'"
							data-type="edit" data-toggle="modal" data-target="#modal-updateStatus" data-backdrop="static" 
							data-keyboard="false"><i class="fas fa-pencil-alt"></i>
							</a>&nbsp;&nbsp;';
							
						if($row['enrol_status1'] == "PROMOTED"){
							echo '<span class="float-right badge badge-default">'.round($row['enrol_average'],0).'</span>';
							echo '<small>';							
							echo ucwords(strtolower(($row['enrol_status2'] == "IRREGULAR" && $row['enrol_level'] <= 10 ? "CONDITIONAL" : $row['enrol_status2'])));
							echo ($row['enrol_gradawards'] != "-" ? " ".ucwords(strtolower($row['enrol_gradawards'])) : "");
							echo '</small>';
						} else 	if ($row['enrol_status1'] == "ENROLLED"){
							echo '<small>';	
							echo ucwords(strtolower(($row['enrol_status2'] == "IRREGULAR" && $row['enrol_level'] <= 10 ? "CONDITIONAL" : $row['enrol_status2'])));
							echo ($row['enrol_gradawards'] != "-" ? " ".ucwords(strtolower($row['enrol_gradawards'])) : "");
							echo '</small>';
						}
					}
				}	
			echo'
				</td>
				<td><a class="btn btn-info btn-xs" href="?p=academics&show='.$row['stud_no'].'">Profile</button></a>
			</tr>';
			
			if($data['0']['3'] <= 10 && $i == $resultMale['3']){
				$i = 1;
				$resultMale['3'] = 0;
				echo '<tr><td colspan="7"></td></tr>';
			} else {
				$i++;
			}
		}} else {
			echo '<tr><td colspan="6">'.$result['1'].'</td></tr>';
		}
		
	} else if($_POST['data']['0'] == "getEnrollmentStatus"){
		$data = array_values($_POST);		
		$result = $controller->getEnrollmentStatus($data);
		
		if($result['0'] == 1) { $row = $result['2']->fetch_assoc();
			echo '<font face="Courier New">'.$row['stud_lrn'].'</font> ';
			echo strtoupper($row['stud_lname']).', '.strtoupper($row['stud_fname']).($row['stud_xname'] == "" ? "" : ", ".strtoupper($row['stud_xname'])).', '.strtoupper($row['stud_mname'].'<br>');
			echo '<div style="margin-top: -8px;">';
			if($row['enrol_level'] > 10) {
				echo '<small>'.$row['enrol_track'].' - '.$row['enrol_strand'].' ';
				echo '('.$row['enrol_combo'].')</small>';
			} else {
				echo '<small>'.$row['enrol_combo'].'</small>';
			}
			echo '</div>';
			echo '<span id="currentStatus">'.$row['enrol_status1'].'</span>';
			?>		
			<div class="col-md-12">
				<label for="inputEmail3" class="col-form-label">Status</label>
				<select class="form-control" id="enrol_status1" name="enrol_status1" onchange="changeForms();" required>
					<?php if($_SESSION['eosy'] == true){?>
						<option value="ENROLLED">No status</option>
						<option value="INACTIVE">No longer in school</option>
						<option value="PROMOTED">EOSY update</option>					
					<?php } else {?>
						<option value="ENROLLED"><?php echo ucwords(strtolower($row['enrol_status1']));?></option>
						<option value="INACTIVE">No longer in school</option>
					<?php } ?>
				</select>
			</div>
			<div class="col-md-12" id="status-forms">
			</div>		
			<?php
		} else {
			echo $result['1'];
		}
		
	} else if($_POST['data']['0'] == "changeForms"){
		$data = array_values($_POST);		
		$result = $controller->getEnrollmentStatus($data);
		
		if($result['0'] == 1){ $row = $result['2']->fetch_assoc();
			$array = serialize(array("enrol_status1" => $row['enrol_status1'], 
				"enrol_status2" => $row['enrol_status2'], 
				"enrol_remarks" => $row['enrol_remarks'], 
				"enrol_average" => $row['enrol_average'], 
				"enrol_graddate" => $row['enrol_graddate'], 
				"enrol_gradawards" => $row['enrol_gradawards']));

		} else {
			$array = serialize(array("enrol_status1" => $result['1'], 
				"enrol_status2" => $result['1'], 
				"enrol_remarks" => $result['1'], 
				"enrol_average" => $result['1'], 
				"enrol_graddate" => $result['1'], 
				"enrol_gradawards" => $result['1']));
		}
		
		if($data['0']['2'] == "INACTIVE"){
			?>
			<input type="hidden" class="form-control" id="enrol_no" name="enrol_no" value="<?php echo $data['0']['1'];?>">
			<textarea class="form-control" id="enrol_eligibility" name="enrol_eligibility"><?php echo $array;?></textarea>
			<input type="hidden" class="form-control" id="enrol_status1" name="enrol_status1" value="INACTIVE">
			<input type="hidden" class="form-control" id="enrol_status2" name="enrol_status2" value="DROPPED OUT">
			<input type="hidden" class="form-control" id="enrol_remarks" name="enrol_remarks" value="-">
			<input type="hidden" class="form-control" id="enrol_average" name="enrol_average" value="0">
			<input type="hidden" class="form-control" id="enrol_gradawards" name="enrol_gradawards" value="-">
						
			<label for="inputEmail3" class="col-form-label">Reason</label>
			<select class="form-control" id="enrol_gradawards" name="enrol_gradawards" required>
				<option value="">--- select ---</option>
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
			
			<label for="inputEmail3" class="col-form-label">Effective at</label>
			<input type="date" class="form-control" id="enrol_graddate" name="enrol_graddate" placeholder="Date" min="<?php echo $_SESSION['bosy_date'];?>" max="<?php echo $_SESSION['today_date'];?>" required>
			
			<?php
		} else if($data['0']['2'] == "PROMOTED"){
			$array_u = unserialize($array);
			$data2 = array(array("checkAcademics", $row['enrol_stud_no'], $row['enrol_sy']));
			$result2 = $controller->checkAcademics($data2);
			
			$totalUnits = 0;	
			$gradedUnits = 0;
			$aveQf = 0;
			$failCount = 0;
			$failedSubjects = "";
			$awards = "";
			$genAve = 0;
			$status2 = "";
			if($result2['0'] == 1){ while($row2 = $result2['2']->fetch_assoc()){
				//echo $row2['pros_title']."-".$row2['grade_q1']."/".$row2['grade_q2']."/".$row2['grade_q3']."/".$row2['grade_q4']."/".$row2['grade_final']."<br>";
				if($row['enrol_level'] > 10){
					$aveQf += ($row2['grade_q1'] < $min_grade || $row2['grade_q2'] < $min_grade  || $row2['pros_unit'] == 0 ? 0 : $row2['grade_final']);
					$gradedUnits += ($row2['grade_q1'] < $min_grade || $row2['grade_q2'] < $min_grade  || $row2['pros_unit'] == 0 ? 0 : $row2['pros_unit']);
					$totalUnits += $row2['pros_unit'];
					$failCount += ($row2['grade_q1'] < $min_grade || $row2['grade_q2'] < $min_grade ? 0 : ($row2['grade_final'] < $pass_grade ? 1 : 0));
					$failedSubjects .= ($row2['grade_q1'] < $min_grade || $row2['grade_q2'] < $min_grade ? "" : ($row2['grade_final'] < $pass_grade ? $row2['pros_title'].", " : ""));
					
				} else {
					$aveQf += ($row2['grade_q1'] < $min_grade || $row2['grade_q2'] < $min_grade || $row2['grade_q3'] < $min_grade || $row2['grade_q4'] < $min_grade || $row2['pros_unit'] == 0 ? 0 : $row2['grade_final']);
					$gradedUnits += ($row2['grade_q1'] < $min_grade || $row2['grade_q2'] < $min_grade || $row2['grade_q3'] < $min_grade || $row2['grade_q4'] < $min_grade || $row2['pros_unit'] == 0 ? 0 : $row2['pros_unit']);
					$totalUnits += $row2['pros_unit'];
					$failCount += ($row2['grade_q1'] < $min_grade || $row2['grade_q2'] < $min_grade || $row2['grade_q3'] < $min_grade || $row2['grade_q4'] < $min_grade ? 0 : ($row2['grade_final'] < $pass_grade ? 1 : 0));
					$failedSubjects .= ($row2['grade_q1'] < $min_grade || $row2['grade_q2'] < $min_grade || $row2['grade_q3'] < $min_grade || $row2['grade_q4'] < $min_grade ? "" : ($row2['grade_final'] < $pass_grade ? $row2['pros_title']."," : ""));
					
				}
			}} else {
				
			}
			$aveQf;
			//echo "/".$gradedUnits;
			//echo "/".$totalUnits;
			$genAve = ($totalUnits == $gradedUnits ? number_format($aveQf / $gradedUnits, 3) : "");
			//echo "/".$genAve;
			//echo "/".$failCount;
			$failedSubjects = substr($failedSubjects, 0, strlen($failedSubjects)-1);
			$failedSubjects = ($failedSubjects == "" ? "-" : $failedSubjects);
			//echo "/".$failedSubjects;
			?>
			<?php
			if($failCount == 0){
				if($genAve >= $tier1_grade){
					$awards = "WITH HIGHEST HONORS";
				} else if ($genAve >= $tier2_grade){
					$awards = "WITH HIGH HONORS";
				} else if ($genAve >= $tier3_grade){
					$awards = "WITH HONORS";
				} else {
					$awards = "-";
				}
			} else {
				$awards = "-";
			}
			
			if($row['enrol_level'] > 10 ){
				if($failCount > 0 && $genAve != 0){
					$status2 = "IRREGULAR";
				} else if($failCount == 0 && $genAve != 0){
					$status2 = "PROMOTED";				
				} else {
					$status2 = "";
				}					
			} else {
				if($failCount >= $retained_status2 && $genAve != 0){
					$status2 = "RETAINED";
				} else if($failCount >= $conditional_status2 && $genAve != 0){
					$status2 = "IRREGULAR";
				} else if($failCount >= $promo_status2 && $genAve != 0){
					$status2 = "PROMOTED";				
				} else {
					$status2 = "";
				}	
			}			
			?>
			<br>
			<input type="hidden" class="form-control" id="enrol_no" name="enrol_no" value="<?php echo $data['0']['1'];?>">
			<textarea class="form-control" id="enrol_eligibility" name="enrol_eligibility"><?php echo $array;?></textarea>
			<input type="hidden" class="form-control" id="enrol_status1" name="enrol_status1" value="PROMOTED">
			
			<table width="100%">
				<tr><td width="30%">Fail Count</td><td><input type="text" style="width: 100%; outline: none; border: 0px; font-weight: bold;" name="failCount" id="failCount" value="<?php echo $failCount;?>" readonly></td></tr>
				<tr><td>Failed Subjects</td><td><input type="text" style="width: 100%; outline: none; border: 0px; font-weight: bold;" name="enrol_remarks" id="enrol_remarks" value="<?php echo ($array_u['enrol_status1'] == "PROMOTED" ? $array_u['enrol_remarks'] : $failedSubjects);?>" readonly></td></tr>
				<tr><td>Academic Award</td><td><input type="text" style="width: 100%; outline: none; border: 0px; font-weight: bold;" name="enrol_gradawards" id="enrol_gradawards" value="<?php echo ($array_u['enrol_status1'] == "PROMOTED" ? $array_u['enrol_gradawards'] : $awards);?>" readonly></td></tr>
				<tr><td>General Ave</td><td><input type="text" style="width: 100%; outline: none; border: 0px; font-weight: bold;" name="enrol_average" id="enrol_average" value="<?php echo ($array_u['enrol_status1'] == "PROMOTED" ? $array_u['enrol_average'] : $genAve);?>" readonly></td></tr>
				<tr><td>EOSY Status</td><td><input type="text" style="width: 100%; outline: none; border: 0px; font-weight: bold;" name="enrol_status2" id="enrol_status2" value="<?php echo ($array_u['enrol_status1'] == "PROMOTED" ? $array_u['enrol_status2'] : $status2);?>" readonly></td></tr>
			</table>
			<?php
		}
		
	} else if($_POST['data']['0'] == "updateStatus"){
		$data = array_values($_POST);		
		$result = $controller->updateStatus($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();
		
	} else if($_POST['data']['0'] == "finalizeSection"){
		$data = array_values($_POST);		
		$result = $controller->finalizeSection($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();
		
	} else if($_POST['data']['0'] == "getClassForms"){
		$data = array_values($_POST);		
		?>
		<div class="card">
            <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed">
					<tbody>
						<tr>
							<td><small>Class List</small></td>
							<td align="right">
								<button class="btn btn-default btn-sm" href="javascript:void(0);" title="Print Class List" target="_blank" 
									onclick="window.open('../reports/pdf_cl.php?id=<?php echo $data['0']['1'];?>&sy=<?php echo $_SESSION['current_sy'];?>', 'newwindow', 'width=850, height=550'); return false;">
									<i class="fas fa-arrow-alt-circle-down"></i>
								</button>
							</td>
						</tr>
						<tr>
							<td><small>Class Program</small></td>
							<td align="right">
								<button class="btn btn-default btn-sm" href="javascript:void(0);" title="Print Class Program" target="_blank" 
									onclick="window.open('../reports/pdf_cp.php?id=<?php echo $data['0']['1'];?>&sy=<?php echo $_SESSION['current_sy'];?>&sem=<?php echo $_SESSION['current_sem'];?>', 'newwindow', 'width=850, height=550'); return false;">
									<i class="fas fa-arrow-alt-circle-down"></i>
								</button>
							</td>
						</tr>
						<tr>
							<td><small>School Form 1 - School Register</small></td>
								<td align="right">
								<button class="btn btn-default btn-sm" href="javascript:void(0);" title="Print Class SF1" target="_blank" 
									onclick="window.open('../reports/pdf_sf1.php?id=<?php echo $data['0']['1'];?>&sy=<?php echo $_SESSION['current_sy'];?>', 'newwindow', 'width=1175, height=550'); return false;">
									<i class="fas fa-arrow-alt-circle-down"></i>
								</button>
							</td>
						</tr>
						<tr>
							<td><small>School Form 2 - Daily Attendance Report of Learners</small></td>
							<td align="right">
								<button class="btn btn-default btn-sm" href="javascript:void(0);" title="Print Class SF2" target="_blank" 
									onclick="window.open('../reports/pdf_sf2.php?id=<?php echo $data['0']['1'];?>&sy=<?php echo $_SESSION['current_sy'];?>', 'newwindow', 'width=1175, height=550'); return false;">
									<i class="fas fa-arrow-alt-circle-down"></i>
								</button>
							</td>
						</tr>
						<tr>
							<td><small>School Form 3 - Books Issued and Returned</small></td>
							<td align="right">
								<button class="btn btn-default btn-sm" href="javascript:void(0);" title="Print Class SF3" target="_blank" 
									onclick="window.open('../reports/pdf_sf3.php?id=<?php echo $data['0']['1'];?>&sy=<?php echo $_SESSION['current_sy'];?>', 'newwindow', 'width=1175, height=550'); return false;">
									<i class="fas fa-arrow-alt-circle-down"></i>
								</button>
							</td>
						</tr>
						<?php if($_SESSION['eosy'] == true){?>
						<?php if($data['0']['2'] > 10){ ?>
						<tr>
							<td><small>School Form 5A - Report on Promotion and Level of Proficiency</small></td>
							<td align="right">
								<button class="btn btn-default btn-sm" href="javascript:void(0);" title="Print Class SF5" target="_blank" 
									onclick="window.open('../reports/pdf_sf5.php?id=<?php echo $data['0']['1'];?>&sy=<?php echo $_SESSION['current_sy'];?>', 'newwindow', 'width=1175, height=550'); return false;">
									<i class="fas fa-arrow-alt-circle-down"></i>
								</button>
							</td>
						</tr>
						<tr>
							<td><small>School Form 5B - List of Learners  with Complete SHS Requirements</small></td>
							<td align="right">
								<button class="btn btn-default btn-sm" href="javascript:void(0);" title="Print Class SF5" target="_blank" 
									onclick="window.open('../reports/pdf_sf5.php?id=<?php echo $data['0']['1'];?>&sy=<?php echo $_SESSION['current_sy'];?>&b', 'newwindow', 'width=1175, height=550'); return false;">
									<i class="fas fa-arrow-alt-circle-down"></i>
								</button>
							</td>
						</tr>
						<?php } else {?>
						<tr>
							<td><small>School Form 5 - Report on Promotion and Level of Proficiency</small></td>
							<td align="right">
								<button class="btn btn-default btn-sm" href="javascript:void(0);" title="Print Class SF5" target="_blank" 
									onclick="window.open('../reports/pdf_sf5.php?id=<?php echo $data['0']['1'];?>&sy=<?php echo $_SESSION['current_sy'];?>', 'newwindow', 'width=1175, height=550'); return false;">
									<i class="fas fa-arrow-alt-circle-down"></i>
								</button>
							</td>
						</tr>
						<?php }} ?>
						<!--
						<tr>
							<td><small>School Form 8 - Learner’s Basic Health and Nutrition Report</small></td>
							<td align="right">
								<button class="btn btn-default btn-sm" href="javascript:void(0);" title="Print Class SF8" target="_blank" 
									onclick="window.open('../reports/pdf_sf8.php?id=<?php echo $data['0']['1'];?>&sy=<?php echo $_SESSION['current_sy'];?>', 'newwindow', 'width=850, height=550'); return false;">
									<i class="fas fa-arrow-alt-circle-down"></i>
								</button>
							</td>
						</tr>
						-->
						<tr>
							<td><small>Grade Slips</small></td>
							<td align="right">
								<button class="btn btn-default btn-sm" href="javascript:void(0);" title="Print Class Grade Slips" target="_blank" 
									onclick="window.open('../reports/pdf_gsc.php?id=<?php echo $data['0']['1'];?>&sy=<?php echo $_SESSION['current_sy'];?>&sem=<?php echo $_SESSION['current_sem'];?>', 'newwindow', 'width=850, height=550'); return false;">
									<i class="fas fa-arrow-alt-circle-down"></i>
								</button>
							</td>
						</tr>
						<!--
						<tr>
							<td><small>School Form 9 - Learner's Progress Report Card (Front)</small></td>
							<td align="right">
								<button class="btn btn-default btn-sm" href="javascript:void(0);" title="Print Class SF9 Front" target="_blank" 
									onclick="window.open('../reports/pdf_sf9f.php?id=<?php echo $data['0']['1'];?>&sy=<?php echo $_SESSION['current_sy'];?>', 'newwindow', 'width=1024, height=550'); return false;">
									<i class="fas fa-arrow-alt-circle-down"></i>
								</button>
							</td>
						</tr>
						<tr>
							<td><small>School Form 9 - Learner's Progress Report Card (Back)</small></td>
							<td align="right">
								<button class="btn btn-default btn-sm" href="javascript:void(0);" title="Print Class SF 9 Back" target="_blank" 
									onclick="window.open('../reports/pdf_sf9b.php?id=<?php echo $data['0']['1'];?>&sy=<?php echo $_SESSION['current_sy'];?>', 'newwindow', 'width=1024, height=550'); return false;">
									<i class="fas fa-arrow-alt-circle-down"></i>
								</button>
							</td>
						</tr>
						<tr>
							<td><small>School Form 10 - Learner’s Permanent Academic Record (Front)</small></td>
							<td align="right">
								<button class="btn btn-default btn-sm" href="javascript:void(0);" title="Print Class SF10 Front" target="_blank" 
									onclick="window.open('../reports/pdf_sf10f.php?id=<?php echo $data['0']['1'];?>&sy=<?php echo $_SESSION['current_sy'];?>', 'newwindow', 'width=850, height=550'); return false;">
									<i class="fas fa-arrow-alt-circle-down"></i>
								</button>
							</td>
						</tr>
						<tr>
							<td><small>School Form 10 - Learner’s Permanent Academic Record (Back)</small></td>
							<td align="right">
								<button class="btn btn-default btn-sm" href="javascript:void(0);" title="Print Class SF10 Back" target="_blank" 
									onclick="window.open('../reports/pdf_sf10b.php?id=<?php echo $data['0']['1'];?>&sy=<?php echo $_SESSION['current_sy'];?>', 'newwindow', 'width=850, height=550'); return false;">
									<i class="fas fa-arrow-alt-circle-down"></i>
								</button>
							</td>
						</tr>
						-->
						<tr>
							<td><small>Class Summary</small></td>
							<td align="right">
								<button class="btn btn-default btn-sm" href="javascript:void(0);" title="Print Class Summary" target="_blank" 
									onclick="window.open('../reports/pdf_cs.php?id=<?php echo $data['0']['1'];?>&sy=<?php echo $_SESSION['current_sy'];?>', 'newwindow', 'width=850, height=550'); return false;">
									<i class="fas fa-arrow-alt-circle-down"></i>
								</button>
							</td>
						</tr>
					</tbody>
				</table>
            </div>
		</div>
		<?php		
	} else if($_POST['data']['0'] == "showAction"){
		$data = array_values($_POST);		
		$result = $controller->getSectionInfo($data);
	
		if($result['0'] == 1){ $row = $result['2'];
			$section_no = $row['section_no'];
			$section_name = $row['section_name'];
			$section_level = $row['section_level'];
			$section_sy = $row['section_sy'];
			$section_status = $row['section_status'];
		} else {
			$section_no = $result['1'];
			$section_name = $result['1'];
			$section_level = $result['1'];
			$section_sy = $result['1'];
			$section_status = $result['1'];
		}

		if($data['0']['2'] == "inputAttendance"){
			$data2 = array(array($data['0']['0'], $data['0']['1'], ($section_level > 10 ? "" : " stud_gender DESC, "), 
				'%', $section_sy, " INNER JOIN school_days ON enrol_stud_no = sch_stud_no ", " AND sch_sy = '$section_sy' "));
			$result2 = $controller->getSectionInputForm($data2);
			$data3 = array(array($data['0']['0'], $data['0']['1'], ($section_level > 10 ? "" : " stud_gender DESC, "), 
				'MALE', $section_sy, " INNER JOIN school_days ON enrol_stud_no = sch_stud_no ", " AND sch_sy = '$section_sy' "));
			$result3 = $controller->getSectionInputForm($data3);
			$data4 = array(array($data['0']['0'], $section_sy));
			$result4 = $controller->checkAttendanceLimit($data4 );
		
			if($result4['0'] == 1){ $row4 = $result4['2'];
				$sch_m1 = $row4['sch_m1'];
				$sch_m2 = $row4['sch_m2'];
				$sch_m3 = $row4['sch_m3'];
				$sch_m4 = $row4['sch_m4'];
				$sch_m5 = $row4['sch_m5'];
				$sch_m6 = $row4['sch_m6'];
				$sch_m7 = $row4['sch_m7'];
				$sch_m8 = $row4['sch_m8'];
				$sch_m9 = $row4['sch_m9'];
				$sch_m10 = $row4['sch_m10'];
				$sch_m11 = $row4['sch_m11'];
				$sch_m12 = $row4['sch_m12'];
				
			} else {
				$sch_m1 = $result4['1'];
				$sch_m2 = $result4['1'];
				$sch_m3 = $result4['1'];
				$sch_m4 = $result4['1'];
				$sch_m5 = $result4['1'];
				$sch_m6 = $result4['1'];
				$sch_m7 = $result4['1'];
				$sch_m8 = $result4['1'];
				$sch_m9 = $result4['1'];
				$sch_m10 = $result4['1'];
				$sch_m11 = $result4['1'];
				$sch_m12 = $result4['1'];			
			}
			
						
			echo '
			<div class="card">
				<div class="card-body p-0">
					<div class="table-responsive">
						<small>
						<table class="table table-bordered table-hover table-condensed table-striped" cellspacing="0" cellpadding="0" border="0">
							<thead>
								<tr style="line-height: 15px">
									<th width="1%">#</th>
									<th width="20%">Learner</th>
									<th width="1%">Gender</th>
									<th width="">Date of first Attendance<br> <small>('.date('m/d/Y', strtotime($_SESSION['bosy_date'])).')</small></th>
									<th width="1%">Jun<br> (<small id="sch_m1_max">'.$sch_m1.'</small>)</th>
									<th width="1%">Jul<br> (<small id="sch_m2_max">'.$sch_m2.'</small>)</th>
									<th width="1%">Aug<br> (<small id="sch_m3_max">'.$sch_m3.'</small>)</th>
									<th width="1%">Sep<br> (<small id="sch_m4_max">'.$sch_m4.'</small>)</th>
									<th width="1%">Oct<br> (<small id="sch_m5_max">'.$sch_m5.'</small>)</th>
									<th width="1%">Nov<br> (<small id="sch_m6_max">'.$sch_m6.'</small>)</th>
									<th width="1%">Dec<br> (<small id="sch_m7_max">'.$sch_m7.'</small>)</th>
									<th width="1%">Jan<br> (<small id="sch_m8_max">'.$sch_m8.'</small>)</th>
									<th width="1%">Feb<br> (<small id="sch_m9_max">'.$sch_m9.'</small>)</th>
									<th width="1%">Mar<br> (<small id="sch_m10_max">'.$sch_m10.'</small>)</th>
									<th width="1%">Apr<br> (<small id="sch_m11_max">'.$sch_m11.'</small>)<small id="sch_m12_max">'.$sch_m12.'</small</th>
									<script>$("#sch_m12_max").hide();</script>
								</tr>		
							</thead>
							<tbody>';
							$i = 1;
							if($result2['0'] == 1){ while($row2 = $result2['2']->fetch_assoc()){
								echo '<tr>';
									echo '<input type="hidden" class="form-control-xs" style="width: 38px;" name="sch_no[]" id="sch_no[]" value="'.$row2['sch_no'].'">';
									echo '<td>'.$i.'</td>';
									echo '<td>'.strtoupper($row2['stud_lname']).', '.strtoupper($row2['stud_fname']).', '.($row2['stud_xname'] == "" ? "" : strtoupper($row2['stud_xname']).",").' '.strtoupper($row2['stud_mname']).'</td>';
									echo '<td>'.substr($row2['stud_gender'], 0, 1).'</td>';
									echo '<td><input type="date" tabindex="1" class="form-control-xs" style="width: 113px;" name="sch_firstday[]" id="sch_firstday[]" value="'.$row2['sch_firstday'].'" min="'.$_SESSION['bosy_date'].'" max="'.$_SESSION['today_date'].'" required ></td>';
									echo '<td><input type="number" tabindex="2" class="form-control-xs" style="width: 41px;" name="sch_m1[]" id="sch_m1[]" value="'.$row2['sch_m1'].'" min="0" max="'.$sch_m1.'" step=".5"></td>';
									echo '<td><input type="number" tabindex="3" class="form-control-xs" style="width: 41px;" name="sch_m2[]" id="sch_m2[]" value="'.$row2['sch_m2'].'" min="0" max="'.$sch_m2.'" step=".5"></td>';
									echo '<td><input type="number" tabindex="4" class="form-control-xs" style="width: 41px;" name="sch_m3[]" id="sch_m3[]" value="'.$row2['sch_m3'].'" min="0" max="'.$sch_m3.'" step=".5"></td>';
									echo '<td><input type="number" tabindex="5" class="form-control-xs" style="width: 41px;" name="sch_m4[]" id="sch_m4[]" value="'.$row2['sch_m4'].'" min="0" max="'.$sch_m4.'" step=".5"></td>';
									echo '<td><input type="number" tabindex="6" class="form-control-xs" style="width: 41px;" name="sch_m5[]" id="sch_m5[]" value="'.$row2['sch_m5'].'" min="0" max="'.$sch_m5.'" step=".5"></td>';
									echo '<td><input type="number" tabindex="7" class="form-control-xs" style="width: 41px;" name="sch_m6[]" id="sch_m6[]" value="'.$row2['sch_m6'].'" min="0" max="'.$sch_m6.'" step=".5"></td>';
									echo '<td><input type="number" tabindex="8" class="form-control-xs" style="width: 41px;" name="sch_m7[]" id="sch_m7[]" value="'.$row2['sch_m7'].'" min="0" max="'.$sch_m7.'" step=".5"></td>';
									echo '<td><input type="number" tabindex="9" class="form-control-xs" style="width: 41px;" name="sch_m8[]" id="sch_m8[]" value="'.$row2['sch_m8'].'" min="0" max="'.$sch_m8.'" step=".5"></td>';
									echo '<td><input type="number" tabindex="10" class="form-control-xs" style="width: 41px;" name="sch_m9[]" id="sch_m9[]" value="'.$row2['sch_m9'].'" min="0" max="'.$sch_m9.'" step=".5"></td>';
									echo '<td><input type="number" tabindex="11" class="form-control-xs" style="width: 41px;" name="sch_m10[]" id="sch_m10[]" value="'.$row2['sch_m10'].'" min="0" max="'.$sch_m10.'" step=".5"></td>';
									echo '<td><input type="number" tabindex="12" class="form-control-xs" style="width: 35px;" name="sch_m11[]" id="sch_m11[]" value="'.$row2['sch_m11'].'" min="0" max="'.$sch_m11.'" step=".5"></td>';
									echo '<input type="hidden" class="form-control-xs" style="width: 41px;" name="sch_m12[]" id="sch_m12[]" value="'.$row2['sch_m12'].'" min="0" max="'.$sch_m12.'" step=".5">';
								echo '</tr>';

								if($section_level <= 10 && $i == $result3['3']){
									$i = 1;
									$result3['3'] = 0;
									echo '<tr><td colspan="16"></td></tr>';
								} else {
									$i++;
								}
							}} else{
								echo '<tr><td colspan="16">'.$result2['1'].'</td></tr>';
							}
						
						echo '
							</tbody>
						</table>
						</small>
					</div>	
				</div>	
			</div>';
		} else {
			$data2 = array(array($data['0']['0'], $data['0']['1'], ($section_level > 10 ? "" : " stud_gender DESC, "), 
				'%', $section_sy, "", ""));
			$result2 = $controller->getSectionInputForm($data2);
			$data3 = array(array($data['0']['0'], $data['0']['1'], ($section_level > 10 ? "" : " stud_gender DESC, "), 
				'MALE', $section_sy, "", ""));
			$result3 = $controller->getSectionInputForm($data3);	
			?>
			<div class="card-body">
				<div class="form-group row">
					<label for="inputEmail3" class="col-md-2 col-form-label">Student</label>
					<div class="col-md-10">
						<select class="form-control" id="stud_no" name="stud_no" onchange="showStudent('<?php echo $data['0']['2'];?>');" required>
							<?php 
							$i = 1;
							echo '<option value="">---select---</option>';
							if($result2['0'] == 1){ while($row2 = $result2['2']->fetch_assoc()){
								echo '<option value="'.$row2['stud_no'].'">'.strtoupper($row2['stud_lname']).', '.strtoupper($row2['stud_fname']).', '.($row2['stud_xname'] == "" ? "" : strtoupper($row2['stud_xname']).",").' '.strtoupper($row2['stud_mname']).'</option>';
								if($section_level <= 10 && $i == $result3['3']){
									$result3['3'] = 0;
									echo '<option value="">---</option>';
									$i = 1;
								} else {
									$i++;
								}
							}} else {
								echo '<option value="">'.$result2['1'].'</option>';
							}
							?>
						</select>
					</div>
				</div>
				<div class="form-group row" ID="class-inputForms2">
				</div>
			</div>
			<?php			
		}
					
	} else if($_POST['data']['0'] == "inputAttendance"){
		$data = array_values($_POST);		
		$result = $controller->inputAttendance($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();		
		
	} else if($_POST['data']['0'] == "showStudent"){
		$data = array_values($_POST);
		
		if($data['0']['3'] == "inputCoreValues"){
			$result = $controller->showCoreValues($data);
			
			if($result['0'] == 1){ $row = $result['2'];
				$q1 = unserialize($row['coreval_q1']);
				$q2 = unserialize($row['coreval_q2']);
				$q3 = unserialize($row['coreval_q3']);
				$q4 = unserialize($row['coreval_q4']);
				$q5 = unserialize($row['coreval_q5']);
				$q6 = unserialize($row['coreval_q6']);
				$q7 = unserialize($row['coreval_q7']);
				//var_dump($row);
				echo'
				<input type="hidden" class="form-control-sm" id="coreval_no" name="coreval_no" value="'.$row['coreval_no'].'">
				<div class="col-md-12">
					<small>
					<table width="100%" cellspacing="0n" border="1">
						<thead>
							<tr>
								<th rowspan="2" width="15%">Core Values</th>
								<th rowspan="2" width="45%">Behavior Statements</th>
								<td colspan="4" width="40%" align="center"><strong>Quarter</strong></td>
							</tr>
							<tr>
								<td width="10%" align="center"><strong>1</strong></td>
								<td width="10%" align="center"><strong>2</strong></td>
								<td width="10%" align="center"><strong>3</strong></td>
								<td width="10%" align="center"><strong>4</strong></td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td rowspan="2">1. Maka-Diyos</td>
								<td>Expresses one\'s spiritual beliefs while respecting the spiritual beliefs of others</td>
								<td align="center"><select tabindex="1" class="form-control-sm" id="coreval_q1q1" name="coreval_q1q1"><option value="">---</option><option value="AO">AO</option><option value="SO">SO</option><option value="RO">RO</option><option value="NO">NO</option></select></td>
								<td align="center"><select tabindex="2" class="form-control-sm" id="coreval_q1q2" name="coreval_q1q2"><option value="">---</option><option value="AO">AO</option><option value="SO">SO</option><option value="RO">RO</option><option value="NO">NO</option></select></td>
								<td align="center"><select tabindex="3" class="form-control-sm" id="coreval_q1q3" name="coreval_q1q3"><option value="">---</option><option value="AO">AO</option><option value="SO">SO</option><option value="RO">RO</option><option value="NO">NO</option></select></td>
								<td align="center"><select tabindex="4" class="form-control-sm" id="coreval_q1q4" name="coreval_q1q4"><option value="">---</option><option value="AO">AO</option><option value="SO">SO</option><option value="RO">RO</option><option value="NO">NO</option></select></td>
							</tr>
							<tr>
								<td>Shows adherence to ethical principles by upholding truth</td>
								<td align="center"><select tabindex="1" class="form-control-sm" id="coreval_q2q1" name="coreval_q2q1"><option value="">---</option><option value="AO">AO</option><option value="SO">SO</option><option value="RO">RO</option><option value="NO">NO</option></select></td>
								<td align="center"><select tabindex="2" class="form-control-sm" id="coreval_q2q2" name="coreval_q2q2"><option value="">---</option><option value="AO">AO</option><option value="SO">SO</option><option value="RO">RO</option><option value="NO">NO</option></select></td>
								<td align="center"><select tabindex="3" class="form-control-sm" id="coreval_q2q3" name="coreval_q2q3"><option value="">---</option><option value="AO">AO</option><option value="SO">SO</option><option value="RO">RO</option><option value="NO">NO</option></select></td>
								<td align="center"><select tabindex="4" class="form-control-sm" id="coreval_q2q4" name="coreval_q2q4"><option value="">---</option><option value="AO">AO</option><option value="SO">SO</option><option value="RO">RO</option><option value="NO">NO</option></select></td>
							</tr>
							<tr>
								<td rowspan="2">2. Makatao</td>
								<td>Is sensitive to individual, social, and cultural differences</td>
								<td align="center"><select tabindex="1" class="form-control-sm" id="coreval_q3q1" name="coreval_q3q1"><option value="">---</option><option value="AO">AO</option><option value="SO">SO</option><option value="RO">RO</option><option value="NO">NO</option></select></td>
								<td align="center"><select tabindex="2" class="form-control-sm" id="coreval_q3q2" name="coreval_q3q2"><option value="">---</option><option value="AO">AO</option><option value="SO">SO</option><option value="RO">RO</option><option value="NO">NO</option></select></td>
								<td align="center"><select tabindex="3" class="form-control-sm" id="coreval_q3q3" name="coreval_q3q3"><option value="">---</option><option value="AO">AO</option><option value="SO">SO</option><option value="RO">RO</option><option value="NO">NO</option></select></td>
								<td align="center"><select tabindex="4" class="form-control-sm" id="coreval_q3q4" name="coreval_q3q4"><option value="">---</option><option value="AO">AO</option><option value="SO">SO</option><option value="RO">RO</option><option value="NO">NO</option></select></td>
							</tr>
							<tr>
								<td>Demonstrates contributions toward solidarity</td>
								<td align="center"><select tabindex="1" class="form-control-sm" id="coreval_q4q1" name="coreval_q4q1"><option value="">---</option><option value="AO">AO</option><option value="SO">SO</option><option value="RO">RO</option><option value="NO">NO</option></select></td>
								<td align="center"><select tabindex="2" class="form-control-sm" id="coreval_q4q2" name="coreval_q4q2"><option value="">---</option><option value="AO">AO</option><option value="SO">SO</option><option value="RO">RO</option><option value="NO">NO</option></select></td>
								<td align="center"><select tabindex="3" class="form-control-sm" id="coreval_q4q3" name="coreval_q4q3"><option value="">---</option><option value="AO">AO</option><option value="SO">SO</option><option value="RO">RO</option><option value="NO">NO</option></select></td>
								<td align="center"><select tabindex="4" class="form-control-sm" id="coreval_q4q4" name="coreval_q4q4"><option value="">---</option><option value="AO">AO</option><option value="SO">SO</option><option value="RO">RO</option><option value="NO">NO</option></select></td>
							</tr>
							<tr>
								<td>3. Makakalikasan</td>
								<td>Cares for the environement and utilizes resources wisely, judiciously, and economically</td>
								<td align="center"><select tabindex="1" class="form-control-sm" id="coreval_q5q1" name="coreval_q5q1"><option value="">---</option><option value="AO">AO</option><option value="SO">SO</option><option value="RO">RO</option><option value="NO">NO</option></select></td>
								<td align="center"><select tabindex="2" class="form-control-sm" id="coreval_q5q2" name="coreval_q5q2"><option value="">---</option><option value="AO">AO</option><option value="SO">SO</option><option value="RO">RO</option><option value="NO">NO</option></select></td>
								<td align="center"><select tabindex="3" class="form-control-sm" id="coreval_q5q3" name="coreval_q5q3"><option value="">---</option><option value="AO">AO</option><option value="SO">SO</option><option value="RO">RO</option><option value="NO">NO</option></select></td>
								<td align="center"><select tabindex="4" class="form-control-sm" id="coreval_q5q4" name="coreval_q5q4"><option value="">---</option><option value="AO">AO</option><option value="SO">SO</option><option value="RO">RO</option><option value="NO">NO</option></select></td>
							</tr>
							<tr>
								<td rowspan="2">4. Makabansa</td>
								<td>Demonstrate pride in being a Filipino; exercises the rights and responsibilities of a Filipino citizen	</td>
								<td align="center"><select tabindex="1" class="form-control-sm" id="coreval_q6q1" name="coreval_q6q1"><option value="">---</option><option value="AO">AO</option><option value="SO">SO</option><option value="RO">RO</option><option value="NO">NO</option></select></td>
								<td align="center"><select tabindex="2" class="form-control-sm" id="coreval_q6q2" name="coreval_q6q2"><option value="">---</option><option value="AO">AO</option><option value="SO">SO</option><option value="RO">RO</option><option value="NO">NO</option></select></td>
								<td align="center"><select tabindex="3" class="form-control-sm" id="coreval_q6q3" name="coreval_q6q3"><option value="">---</option><option value="AO">AO</option><option value="SO">SO</option><option value="RO">RO</option><option value="NO">NO</option></select></td>
								<td align="center"><select tabindex="4" class="form-control-sm" id="coreval_q6q4" name="coreval_q6q4"><option value="">---</option><option value="AO">AO</option><option value="SO">SO</option><option value="RO">RO</option><option value="NO">NO</option></select></td>
							</tr>
							<tr>
								<td>Demonstrates appropriate behavior in carrying out activities in the school, community, and country	</td>
								<td align="center"><select tabindex="1" class="form-control-sm" id="coreval_q7q1" name="coreval_q7q1"><option value="">---</option><option value="AO">AO</option><option value="SO">SO</option><option value="RO">RO</option><option value="NO">NO</option></select></td>
								<td align="center"><select tabindex="2" class="form-control-sm" id="coreval_q7q2" name="coreval_q7q2"><option value="">---</option><option value="AO">AO</option><option value="SO">SO</option><option value="RO">RO</option><option value="NO">NO</option></select></td>
								<td align="center"><select tabindex="3" class="form-control-sm" id="coreval_q7q3" name="coreval_q7q3"><option value="">---</option><option value="AO">AO</option><option value="SO">SO</option><option value="RO">RO</option><option value="NO">NO</option></select></td>
								<td align="center"><select tabindex="4" class="form-control-sm" id="coreval_q7q4" name="coreval_q7q4"><option value="">---</option><option value="AO">AO</option><option value="SO">SO</option><option value="RO">RO</option><option value="NO">NO</option></select></td>
							</tr>
						</tbody>
					</table>
					</small>
				</div>';
				?>
				<script type="text/javascript">	
					setTimeout(function(){preFill();}, 1);

					function preFill(){
						var q1q1 = '<?php echo $q1['0'];?>';
						var q1q2 = '<?php echo $q1['1'];?>';
						var q1q3 = '<?php echo $q1['2'];?>';
						var q1q4 = '<?php echo $q1['3'];?>';
						
						var q2q1 = '<?php echo $q2['0'];?>';
						var q2q2 = '<?php echo $q2['1'];?>';
						var q2q3 = '<?php echo $q2['2'];?>';
						var q2q4 = '<?php echo $q2['3'];?>';
						
						var q3q1 = '<?php echo $q3['0'];?>';
						var q3q2 = '<?php echo $q3['1'];?>';
						var q3q3 = '<?php echo $q3['2'];?>';
						var q3q4 = '<?php echo $q3['3'];?>';
						
						var q4q1 = '<?php echo $q4['0'];?>';
						var q4q2 = '<?php echo $q4['1'];?>';
						var q4q3 = '<?php echo $q4['2'];?>';
						var q4q4 = '<?php echo $q4['3'];?>';
						
						var q5q1 = '<?php echo $q5['0'];?>';
						var q5q2 = '<?php echo $q5['1'];?>';
						var q5q3 = '<?php echo $q5['2'];?>';
						var q5q4 = '<?php echo $q5['3'];?>';
						
						var q5q1 = '<?php echo $q5['0'];?>';
						var q5q2 = '<?php echo $q5['1'];?>';
						var q5q3 = '<?php echo $q5['2'];?>';
						var q5q4 = '<?php echo $q5['3'];?>';
						
						var q6q1 = '<?php echo $q6['0'];?>';
						var q6q2 = '<?php echo $q6['1'];?>';
						var q6q3 = '<?php echo $q6['2'];?>';
						var q6q4 = '<?php echo $q6['3'];?>';
						
						var q7q1 = '<?php echo $q7['0'];?>';
						var q7q2 = '<?php echo $q7['1'];?>';
						var q7q3 = '<?php echo $q7['2'];?>';
						var q7q4 = '<?php echo $q7['3'];?>';
						
						$('#coreval_q1q1').val(q1q1).change();
						$('#coreval_q1q2').val(q1q2).change();
						$('#coreval_q1q3').val(q1q3).change();
						$('#coreval_q1q4').val(q1q4).change();
						
						$('#coreval_q2q1').val(q2q1).change();
						$('#coreval_q2q2').val(q2q2).change();
						$('#coreval_q2q3').val(q2q3).change();
						$('#coreval_q2q4').val(q2q4).change();
						
						$('#coreval_q3q1').val(q3q1).change();
						$('#coreval_q3q2').val(q3q2).change();
						$('#coreval_q3q3').val(q3q3).change();
						$('#coreval_q3q4').val(q3q4).change();
						
						$('#coreval_q4q1').val(q4q1).change();
						$('#coreval_q4q2').val(q4q2).change();
						$('#coreval_q4q3').val(q4q3).change();
						$('#coreval_q4q4').val(q4q4).change();
						
						$('#coreval_q5q1').val(q5q1).change();
						$('#coreval_q5q2').val(q5q2).change();
						$('#coreval_q5q3').val(q5q3).change();
						$('#coreval_q5q4').val(q5q4).change();
						
						$('#coreval_q6q1').val(q6q1).change();
						$('#coreval_q6q2').val(q6q2).change();
						$('#coreval_q6q3').val(q6q3).change();
						$('#coreval_q6q4').val(q6q4).change();
						
						$('#coreval_q7q1').val(q7q1).change();
						$('#coreval_q7q2').val(q7q2).change();
						$('#coreval_q7q3').val(q7q3).change();
						$('#coreval_q7q4').val(q7q4).change();
					}
				</script>
				<?php
			} else {
				echo $result['1'];
			}
		} else if($data['0']['3'] == "inputAnecdotalRecords"){
			$result = $controller->showAnecdotalRecords($data);
		}
		
	} else if($_POST['data']['0'] == "inputCoreValues"){
		$data = array_values($_POST);		
		$result = $controller->inputCoreValues($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();		
		
	}
}
?>