<?php
/*
 * Script Handler
 *
 * This page is used to process the request from the visible page of the Student->My feature. 
 * Request such as the CRUD operations are queued here and executed by Controller (controller.php) class.
 * @author    	Fernando B. Enad
 * @license    	Public
 */

session_start();
require_once("../../config/dbconfig.php");
require_once("../../config/settings.php");
require_once("controller.php");

$controller = new Controller();

if(isset($_POST['data'])){	
	if($_POST['data']['0'] == "getProfile"){
		$data = array_values($_POST);
		$result = $controller->getProfile($data);
		
		if($result['0'] == 1){ $row = $result['2']->fetch_assoc();
			$withImage = "../assets/images/students/".$row['stud_no'].".jpg";
			$noImage = "../assets/avatars/".$row['stud_gender'].".jpg";
			?>
			<div class="col-md-3">
				<img src="<?php echo (file_exists("../".$withImage) ? $withImage : $noImage); ?>"
					alt="User profile picture"
					style="border: 1px solid #ddd; border-radius: 4px; padding: 5px; width: 98%;">
			</div>
			<div class="col-md-8">
				<h2 class="profile-username text-left">
					<?php echo ucwords(strtolower($row['stud_fname'] ." ". $row['stud_mname'] ." ". $row['stud_lname'] ." ". $row['stud_xname']));?> 
					[<?php echo $row['stud_no'];?>]<br>
					<small id="my-course">{my-course}</small>
				</h2>
				<p class="text-muted text-left">
					<table width="100%" style="margin-top: -10px">
						<tr><td width="3%"><i class="fas fa-id-card"></i></td><td><?php echo $row['stud_lrn'];?></td></tr>
						<tr><td ><i class="fas fa-cross"></i></td><td><?php echo $row['stud_religion'];?></td></tr>
						<tr><td><i class="fas fa-map-marker-alt"></i></td><td><?php echo $row['stud_residence'];?></td></tr>
						<tr><td><i class="fas fa-phone-volume"></i></td><td><?php echo $row['stud_username'];?></td></tr>	
					</table>										 
				</p>
			</div>
			<?php
		} else { echo $result['1']; } 
			
	} else if($_POST['data']['0'] == "getCourse"){	
		$data = array_values($_POST);
		$result = $controller->getHistory($data);
		
		if($result['0'] == 1){ $row = $result['2']->fetch_assoc(); 
			printf("Grade %s - %s %s", $row['enrol_level'], $row['enrol_track'], $row['enrol_strand']);
		} else { echo 'Enrollment: '.$result['1']; }
			
	} else if($_POST['data']['0'] == "getProfileFull"){	
		$data = array_values($_POST);
		$result = $controller->getProfile($data);
		
		if($result['0'] == 1){ $row = $result['2']->fetch_assoc(); 
			?>
			<tr>
				<td>Student #</td>
				<td><?php echo $row['stud_no'];?></td>
			</tr>														
			<tr>
				<td>LRN</td>
				<td><?php echo strtoupper($row['stud_lrn']);?></td>
			</tr>
			<tr>
				<td>Last name</td>
				<td><?php echo strtoupper($row['stud_lname']);?></td>
			</tr>
			<tr>
				<td>First name</td>
				<td><?php echo strtoupper($row['stud_fname']);?></td>
			</tr>
			<tr>
				<td>Middle name</td>
				<td><?php echo strtoupper($row['stud_mname']);?></td>
			</tr>
			<tr>
				<td>Ext. name</td>
				<td><?php echo $row['stud_xname'];?></td>
			</tr>
			<tr>
				<td>Gender</td>
				<td><?php echo $row['stud_gender'];?></td>
			</tr>
			<tr>
				<td>Birth date</td>
				<td>
				<?php 
				$phpdate = strtotime($row['stud_bdate']);
				echo $mysqldate = date('F d, Y', $phpdate);
				$date1 = strtotime(date("Y-m-d"));
				$date2 = strtotime($row['stud_bdate']);
				$time_difference = $date1 - $date2;
				$seconds_per_year = 60*60*24*365;
				$years = (int) ($time_difference / $seconds_per_year);
				echo " <small>($years years old)</small>";
				?>													
				</td>
			</tr>
			<tr>
				<td>Religion</td>
				<td><?php echo $row['stud_religion'];?></td>
			</tr>
			<tr>
				<td>Mother tongue / dialect</td>
				<td><?php echo $row['stud_dialect'];?></td>
			</tr>
			<tr>
				<td>Ethnicity</td>
				<td><?php echo $row['stud_ethnicity'];?></td>
			</tr>
			<?php
		} else { echo $result['1']; }
			
	} else if($_POST['data']['0'] == "getProfileAddresses"){	
		$data = array_values($_POST);
		$result = $controller->getProfile($data);
		
		if($result['0'] == 1){ $row = $result['2']->fetch_assoc(); 
			?>
			<tr>
				<td>Current Address</td>
				<td><?php echo strtoupper($row['stud_residence']);?></td>
			</tr>	
			<!--
			<tr>
				<td>Permanent Address</td>
				<td></td>
			</tr>				
			<tr>
				<td>Birth Place</td>
				<td></td>
			</tr>	
			-->
			<?php
		} else { echo $result['1']; }
			
	} else if($_POST['data']['0'] == "getParents"){	
		$data = array_values($_POST);
		$result = $controller->getContact($data);
		
		if($result['0'] == 1){ $row = $result['2']->fetch_assoc(); 
			?>
			<tr>
				<td>Mother's maiden name</td>
				<td><?php echo strtoupper($row['studCont_stud_mfname'] ." ". $row['studCont_stud_mmname'] ." ". $row['studCont_stud_mlname']); ?></td>
			</tr>	
			<tr>
				<td>Father's name</td>
				<td><?php echo strtoupper($row['studCont_stud_ffname'] ." ". $row['studCont_stud_fmname'] ." ". $row['studCont_stud_flname']); ?></td>
			</tr>
			<?php
		} else { echo $result['1']; }
			
	} else if($_POST['data']['0'] == "getGuardian"){
		$data = array_values($_POST);		
		$result = $controller->getContact($data);
		
		if($result['0'] == 1){ $row = $result['2']->fetch_assoc(); 
			?>
			<tr>
				<td>Guardian's name</td>
				<td><?php echo ($row['studCont_stud_grelation'] == "PARENT" ? "PARENT" : strtoupper($row['studCont_stud_gfname'] ." ". $row['studCont_stud_gmname'] ." ". $row['studCont_stud_glname'])); ?></td>
			</tr>	
			<tr>
				<td>Guardian's contact number</td>
				<td><?php echo $row['studCont_stud_gcontact']; ?></td>
			</tr>	
			<?php
		} else { echo $result['1']; }
			
	} else if($_POST['data']['0'] == "getHistory"){	
		$data = array_values($_POST);
		$result = $controller->getHistory($data);
		
		if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){; 
			$enrolSchool = unserialize($row['enrol_school']);
			?>
			<tr>	
				<td><?php printf("%d-%d",$row['enrol_sy'],($row['enrol_sy']+1));?></td>
				<td><?php printf("%s (%d)<br><small>%s</small>", strtoupper($enrolSchool['1']), $enrolSchool['0'], ucwords(strtolower($enrolSchool['2'])));?></td>	
				<td><?php echo $row['enrol_level'];?></td>
				<td><?php echo $row['enrol_section'];?></td>
				<td><?php echo $row['enrol_status2'];?></td>
			</tr>
			<?php 
		}} else { echo $result['1']; }
			
	} else if($_POST['data']['0'] == "getScheduleTerms"){
		$data = array_values($_POST);		
		$result = $controller->getTerms($data);
		
		if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
			?>
			<option value="<?php echo $row['grade_sy'].$row['grade_sem'];?>"><?php echo ($row['grade_sem'] == "12" ? "" : "Sem ".$row['grade_sem'].", ");?>SY <?php echo $row['grade_sy'];?>-<?php echo $row['grade_sy']+1;?></option>
			<?php 
		}} else { 
			echo '<option value="">'.$result['1'].'</option>';
		}
			
	} else if($_POST['data']['0'] == "getSchedules"){	
		$data = array_values($_POST);
		$result = $controller->getSchedules($data);		
		$getSchool = $controller->getSchool($data);
		$totalUnits = 0;
			
		if($getSchool['0'] == 1){ $getSchoolRow = $getSchool['2']->fetch_assoc();
		} else { echo $getSchoolRow = $getSchool['1']; }
		
		if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
			?>
			<tr >
				<td><small><?php echo $row['pros_title'];?><small></td>
				<td><small><?php echo $row['pros_desc'];?></small></td>
				<td><small><?php echo ($getSchoolRow['enrol_level'] > 10?number_format($row['pros_unit'],2):"");?><small></td>
				<td><small><?php echo $row['class_timeslots'];?></small></td>
				<td><small><?php echo $row['class_days'];?><small></td>
				<td><small><?php echo $row['class_room'];?><small></td>
				<td><small><?php printf("%s, %s", $row['teach_lname'], substr($row['teach_fname'], 0,1));?>.<small></td>
			</tr>
			<?php
			$totalUnits += $row['pros_unit'];
			}
			if($getSchoolRow['enrol_level'] > 10){
				echo '<tr><td></td><td align="right">Total Units</td><td><strong>'.$totalUnits.'</strong></td><td></td><td></td><td></td><td></td></tr>';
			} else {}
			
		} else { 
				echo '<tr style="line-height: 12px;"><td colspan="7">'.$result['1'].'</td></td></tr>';
		}
			
	} else if($_POST['data']['0'] == "getGradeTerms"){	
		$data = array_values($_POST);
		$result = $controller->getTerms($data);	
		
		echo '<p><small><strong>Note:</strong> <i>Recent grades are found on top most.</i></small></p>';
		// echo 'Failed courses or courses with no final grades yet are highlighted in red.</i></small></p>';
		echo '<hr>';
		if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
			$schoolData = array(array("", $row['grade_stud_no'], $row['grade_sy']));
			$getSchool = $controller->getSchool($schoolData);
			?>
			<div class="card card-info">
				<div class="card-header bg-white">
					<h3 class="card-title">
						<?php
						if($getSchool['0'] == 1) { $getSchoolRow = $getSchool['2']->fetch_assoc();
							$enrol_school = unserialize($getSchoolRow['enrol_school']); 
							printf("<strong>%s, SY %d-%d | %s</strong><br>", ($row['grade_sem'] == 12 ? "Full Year" : "Sem ".$row['grade_sem']), $row['grade_sy'], ($row['grade_sy']+1), $enrol_school['1']); 
							if($getSchoolRow['enrol_level'] > 10){
								printf("<small>Grade %d <i>(%s",  $getSchoolRow['enrol_level'], $getSchoolRow['enrol_track']."-".$getSchoolRow['enrol_strand']); 
								printf("%s</i></small><br>", ($getSchoolRow['enrol_track'] == ""?"" : ": ".$getSchoolRow['enrol_combo'].")"));
							} else {
								printf("<small>Grade %d <i>(%s)</i>",  $getSchoolRow['enrol_level'], $getSchoolRow['enrol_track']); 							
							}
										
						} else { echo $getSchool['1']; }
						?>
					</h3>
				</div>
				<div class="card-body table-responsive p-0">
					<table class="table table-hover table-striped">
						<thead>
							<tr>
								<th width="15%">Course Code</th>
								<th>Descriptive Title</th>
								<th width="3%"></th>
								<th width="3%"><?php echo ($getSchoolRow['enrol_level'] > 10 ? "Mid" : "Q1");?></th>
								<th width="3%"><?php echo ($getSchoolRow['enrol_level'] > 10 ? "Fin" : "Q2");?></th>
								<th width="3%"><?php echo ($getSchoolRow['enrol_level'] > 10 ? "" : "Q3");?></th>
								<th width="3%"><?php echo ($getSchoolRow['enrol_level'] > 10 ? "" : "Q4");?></th>
								<th width="8%">Ave</th>
								<th width="15%">Teacher</th>
							</tr>		
						</thead>
						<tbody> 
					<?php
					$gradeData = array(array("",$row['grade_stud_no'], $row['grade_sy'], $row['grade_sem']));
					$getGrades = $controller->getGrades($gradeData);
					
					$totalUnits = 0;	
					$gradedUnits = 0;
					$aveQf = 0;
					if($getGrades['0'] == 1){ while($getGradesRow = $getGrades['2']->fetch_assoc()){
						?>
						<tr style="line-height: 12px;">
							<td><small><?php echo $getGradesRow['pros_title'];?><small></td>
							<td><small><?php echo $getGradesRow['pros_desc'];?></small></td>
							<td><small><?php echo ($getSchoolRow['enrol_level'] > 10 ? number_format($getGradesRow['pros_unit'],2) : "");?><small></td>
							<td><small><?php echo ($getGradesRow['grade_q1'] < 60 ? "" : $getGradesRow['grade_q1']);?></small></td>
							<td><small><?php echo ($getGradesRow['grade_q2'] < 60 ? "" : $getGradesRow['grade_q2']);?></small></td>
							<td><small><?php echo ($getGradesRow['grade_q3'] < 60 ? "" : $getGradesRow['grade_q3']);?></small></td>
							<td><small><?php echo ($getGradesRow['grade_q4'] < 60 ? "" : $getGradesRow['grade_q4']);?></small></td>
							<td><small><?php echo ($getSchoolRow['enrol_level'] > 10 ? 
								($getGradesRow['grade_q1'] < 60 || $getGradesRow['grade_q2'] < 60 ? "" : $getGradesRow['grade_final']) : 
								($getGradesRow['grade_q1'] < 60 || $getGradesRow['grade_q2'] < 60 || $getGradesRow['grade_q3'] < 60 || 
									$getGradesRow['grade_q4'] < 60? "" : $getGradesRow['grade_final']));?></small></td>
							<td><small><?php printf("%s, %s", $getGradesRow['teach_lname'], substr($getGradesRow['teach_fname'], 0,1));?>.<small></td>
						</tr>
						<?php
						$aveQf += ($getGradesRow['pros_unit'] == 0 ? 0 : ($getGradesRow['pros_unit'] * $getGradesRow['grade_final'])); 
						$totalUnits += $getGradesRow['pros_unit'];
						if($getSchoolRow['enrol_level'] > 10){
							$gradedUnits += ($getGradesRow['grade_q1'] < 60 || $getGradesRow['grade_q2'] < 60 ? 0 : $getGradesRow['pros_unit']);
						} else {
							$gradedUnits += ($getGradesRow['grade_q1'] < 60 || $getGradesRow['grade_q2'] < 60 || $getGradesRow['grade_q3'] < 60 || $getGradesRow['grade_q4'] < 60 ? 0 : $getGradesRow['pros_unit']);
						}
						}
						
						if($getSchoolRow['enrol_level'] > 10){
							echo '<tr><td></td><td align="right">Total Units</td><td><strong>'.$totalUnits.'</strong></td><td colspan="4" align="right">General Average</td><td><strong>'.($totalUnits == $gradedUnits ? number_format($aveQf / $totalUnits, 0) : "").'</strong></td><td></td></tr>';
						} else {
							echo '<tr><td></td><td align="right"></td><td></td><td colspan="4" align="right">General Average</td><td><strong>'.($totalUnits == $gradedUnits ? number_format($aveQf / $totalUnits, 0) : "").'</strong></td><td></td></tr>';
						}
						
					} else { 
							echo '<tr><td colspan="7">'.$result['1'].'</td></td></tr>';
					}
					?>
						</tbody>
					</table>
				</div>
			</div>
			<br>			
			<?php			
		}} else { 
			echo '<tr style="line-height: 12px;"><td colspan="7">'.$result['1'].'</td></td></tr>';
		}
			
	} else if($_POST['data']['0'] == "verifyPassword"){
		$data = array_values($_POST);
		$status = 1;
		$message = "";
		$authenticateLogin = $controller->authenticateLogin($data);
		
		if($authenticateLogin['0'] == 1){
			$changePassword = $controller->changePassword($data);
			
			if($changePassword['0'] == 1){
				$message = $changePassword['1'];
				$status = 1;
			} else {
				$message = $changePassword['1'];
				$status = -1;
			}
		} else {
			$message = "Old password is incorrect.";
			$status = -1;
		}
		
		$result = array($status, $message);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();
	
	} else if($_POST['data']['0'] == "getPhone"){
		$data = array_values($_POST);		
		$getPhone = $controller->getPhone($data);
		
		if($getPhone['0'] == 1){ $row = $getPhone['2']->fetch_assoc();
			$result = array($getPhone['0'], $getPhone['1'], $row['stud_username']);
		} else {
			$result = array($getPhone['0'], $getPhone['1']);
		}
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();
	
	} else if($_POST['data']['0'] == "submitPhoneForm"){
		$data = array_values($_POST);		
		$result = $controller->savePhone($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();
	
	} else if($_POST['data']['0'] == "getLogs"){
		$data = array_values($_POST);		
		$result = $controller->getLogs($data);
		
		if($result['0'] == 1) { while($row = $result['2']->fetch_assoc()){
			?>
			<tr style="line-height: 1px;">
				<td><small><small><?php echo $row['ip'];?></small></small></td>
				<td><small><small><?php echo date('M d, Y h:iA', strtotime($row['timestamp']));?></small></small></td>
			</tr>	
			<?php
			
		}} else {
			echo '<tr><td colspan="2">'.$result['1'].'</td></td></tr>';
		}
	} else if($_POST['data']['0'] == "getProspectus"){
		$data = array_values($_POST);
		
		$level = $controller->getEnrollmentDetails($data);
		
		if($level['0'] == 1) { $row = $level['2'];
			$enrol_level = $row['enrol_level'];
			$section_track = $row['section_track'];
			
		} else {
			$enrol_level = $level['1'];
			$section_track = $level['1'];
		}
		
		$data2 = array(array($enrol_level, $section_track));
		$condition = "";
		$option = " GROUP BY pros_level, pros_sem ";
		
		$result = $controller->getProspectus($data, $data2, $condition, $option);
		
		if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
			?>
			<div class="card card-info">
				<div class="card-header bg-white">
					<h3 class="card-title">
						<?php
							echo 'Grade '.$row['pros_level'].($row['pros_level'] > 10 ? ' - Sem '.$row['pros_sem'] : '').' ';
						?>
					</h3>
				</div>
				<div class="card-body table-responsive p-0">
					<table class="table table-hover table-striped">
						<thead>
							<tr>
								<th width="20%">Course Code</th>
								<th>Descriptive Title</th>
								<th width="10%"><?php echo ($row['pros_level'] > 10 ? 'Units' : '');?></th>
								
							</tr>		
						</thead>
						<tbody> 
							<?php
								$condition = " AND pros_level = '".$row['pros_level']."' AND pros_sem = '".$row['pros_sem']."' ";
								$option = " ";
								$result2 = $controller->getProspectus($data, $data2, $condition, $option);
								
								if($result2['0'] == 1){ while($row2 = $result2['2']->fetch_assoc()){
									echo '
									<tr>
										<td>'.strtoupper($row2['pros_title']).'</td>
										<td>'.$row2['pros_desc'].'</td>
										<td>'.($row2['pros_level'] > 10 ? number_format($row2['pros_unit'], 2) : "").'</td>
									</tr>';
								}} else {
									echo '<tr><td colspan="3">'.$result2['1'].'</td></tr>';
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
			<br>				
			<?php
		}} else {
			echo $result['1'];
		}
		
	} else if($_POST['data']['0'] == "getProspectusHistory"){
		$data = array_values($_POST);
		
		$level = $controller->getEnrollmentDetails($data);
		
		if($level['0'] == 1) { $row = $level['2'];
			$enrol_level = $row['enrol_level'];
			$enrol_status1 = $row['enrol_status1'];
			$section_track = $row['section_track'];
			
		} else {
			$enrol_level = $level['1'];
			$enrol_status1 = $level['1'];
			$section_track = $level['1'];
		}
		
		$data2 = array(array($enrol_level, $section_track));
		$condition = "";
		$option = " GROUP BY pros_level, pros_sem ";
		
		$result = $controller->getProspectus($data, $data2, $condition, $option);
		
		if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
			?>
			<div class="card card-info">
				<div class="card-header bg-white">
					<h3 class="card-title">
						<?php
							echo 'Grade '.$row['pros_level'].($row['pros_level'] > 10 ? ' - Sem '.$row['pros_sem'] : '').' ';
						?>
					</h3>
				</div>
				<div class="card-body table-responsive p-0">
					<table class="table table-hover table-striped">
						<thead>
							<tr>
								<th width="20%">Course Code</th>
								<th>Descriptive Title</th>
								<th width="15%">No. of Retakes</th>
								<th width="8%"><?php echo ($row['pros_level'] > 10 ? 'Units' : '');?></th>
								<th width="8%">Grade</th>
							</tr>		
						</thead>
						<tbody> 
							<?php
								$condition = " AND pros_level = '".$row['pros_level']."' AND pros_sem = '".$row['pros_sem']."' ";
								$option = " ";
								$result2 = $controller->getProspectus($data, $data2, $condition, $option);
								
								if($result2['0'] == 1){ while($row2 = $result2['2']->fetch_assoc()){
									echo '
									<tr>
										<td>'.strtoupper($row2['pros_title']).'</td>
										<td>'.$row2['pros_desc'].'</td>';
										
										$result3 = $controller->getSubjectCount($data['0']['1'], $row2['pros_no']);
										
										if($result3['0'] == 1){ $row3 = $result3['2'];
											$retakes = $row3['countProsNo'];
										} else {
											$retakes = $result3['1'];
										}
										echo '
										<td>'.($retakes == 0 ? 0 : --$retakes).'</td>
										<td>'.($row2['pros_level'] > 10 ? number_format($row2['pros_unit'], 2) : "").'</td>';
									
										$result3 = $controller->getFinalGrade($data['0']['1'], $row2['pros_no']);
										
										if($result3['0'] == 1){ $row3 = $result3['2'];
											$grade = $row3['grade_final'];
										} else {
											$grade = $result3['1'];
										}
										echo '<td>'.($enrol_status1 == 'PROMOTED' ? $grade : "").'</td>
									</tr>';
								}} else {
									echo '<tr><td colspan="3">'.$result2['1'].'</td></tr>';
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
			<br>				
			<?php
		}} else {
			echo $result['1'];
		}
	}
}
?>