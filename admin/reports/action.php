<?php
session_start();
require_once("../../config/dbconfig.php");
require_once("../../config/settings.php");
require_once("controller.php");

$controller = new Controller();

if(isset($_POST['data'])){	

	if($_POST['data']['0'] == "getSchoolPerformance"){
		$data = array_values($_POST);
		$result = $controller->getSYs();
		?>
		<div class="col-md-12">
			<div class="card">
				<div class="table-responsive p-0">
					<small>
					<table class="table table-hover">
						<thead>
							<tr>
								<th width="6%">#</th>
								<th>School Year</th>
								<th>BOSY Enrollment</th>
								<th>EOSY Enrollment</th>
								<th>Promoted</th>
								<th>Irregular</th>
								<th>Retained</th>
								<th>Dropped Out</th>
								<th>Transferred Out</th>
							</tr>
						</thead>
						<tbody> 
						<?php
						$i = 1;
						if($result['0'] == 1){while($row = $result['2']->fetch_assoc()){
							echo '<tr>';
								echo '<td>'.$i++.'</td>';
								echo '<td><strong>'.$row['settings_sy']."</strong>-".($row['settings_sy']+1).'</td>';
								$result2 = $controller->getStatusCount($row['settings_sy'], " AND enrol_admitdate <= '".$row['settings_bosy']."' ");
								$count = ($result2['0'] == 1 ? $result2['3'] : 0);	
								echo '<td align="right">'.($count == 0 ? "" : number_format($count, 0)).'</td>';
								$result2 = $controller->getStatusCount($row['settings_sy'], " AND enrol_status1 = 'PROMOTED'");
								$count = ($result2['0'] == 1 ? $result2['3'] : 0);	
								echo '<td align="right">'.($count == 0 ? "" : number_format($count, 0)).'</td>';
								$result2 = $controller->getStatusCount($row['settings_sy'], " AND enrol_status1 = 'PROMOTED' AND (enrol_status2 = 'PROMOTED' OR enrol_status2 = 'GRADUATED')");
								$count = ($result2['0'] == 1 ? $result2['3'] : 0);	
								echo '<td align="right" style="color: green">'.($count == 0 ? "" : number_format($count, 0)).'</td>';
								$result2 = $controller->getStatusCount($row['settings_sy'], " AND enrol_status1 = 'PROMOTED' AND enrol_status2 = 'IRREGULAR'");
								$count = ($result2['0'] == 1 ? $result2['3'] : 0);	
								echo '<td align="right" style="color: orange">'.($count == 0 ? "" : number_format($count, 0)).'</td>';
								$result2 = $controller->getStatusCount($row['settings_sy'], " AND enrol_status1 = 'PROMOTED' AND enrol_status2 = 'RETAINED'");
								$count = ($result2['0'] == 1 ? $result2['3'] : 0);	
								echo '<td align="right" style="color: red">'.($count == 0 ? "" : number_format($count, 0)).'</td>';
								$result2 = $controller->getStatusCount($row['settings_sy'], " AND enrol_status1 = 'INACTIVE' AND enrol_status2 = 'DROPPED OUT'");
								$count = ($result2['0'] == 1 ? $result2['3'] : 0);	
								echo '<td align="right" style="color: red">'.($count == 0 ? "" : number_format($count, 0)).'</td>';								
								$result2 = $controller->getStatusCount($row['settings_sy'], " AND enrol_status1 = 'INACTIVE' AND enrol_status2 = 'TRANSFERRED OUT'");
								$count = ($result2['0'] == 1 ? $result2['3'] : 0);	
								echo '<td align="right">'.($count == 0 ? "" : number_format($count, 0)).'</td>';
							echo '</tr>';
						}} else {
							echo '<tr><td colspan="9">'.$result['1'].'</tr>';
						}
						?>
						</tbody>
					</table>
					</small>
				</div>
			</div>
		</div>
		<?php

	} else if($_POST['data']['0'] == "getCurriculumPerformance"){
		$data = array_values($_POST);
		$result = $controller->getCurriculumPerformance($data, "", " GROUP BY class_sem ");

		if($result['0']  == 1){while($row = $result['2']->fetch_assoc()){
		?>
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Grade <?php echo $row['section_level'];?> <?php echo ($row['class_sem'] != 12 ? ", Sem ".$row['class_sem'] : "");?></h>
				</div>
				<div class="card-body table-responsive p-0">
					<small>
					<table class="table table-hover">
						<thead>
							<tr>
								<th width="5%" rowspan="2">#</th>
								<th rowspan="2">Learning Area</th>
								<th rowspan="2" title="Head count or the number of students enrolled.">HC</th>
								<th colspan="3"><?php echo ($row['section_level'] > 10 ? "Midterm" : "Q1");?></th>
								<th colspan="3"><?php echo ($row['section_level'] > 10 ? "Final" : "Q2");?></th>
								<?php if($row['section_level'] > 10){} else { ?>
									<th colspan="3">Q3</th>
									<th colspan="3">Q4</th>
								<?php } ?>
								<th colspan="3">Ave</th>
							</tr>
							<tr>
								<th><?php echo ($row['section_level'] > 10 ? "Pass" : "Pass");?></th>
								<th><?php echo ($row['section_level'] > 10 ? "Fail" : "Fail");?></th>
								<th><?php echo ($row['section_level'] > 10 ? "NG" : "NG");?></th>
								<th><?php echo ($row['section_level'] > 10 ? "Pass" : "Pass");?></th>
								<th><?php echo ($row['section_level'] > 10 ? "Fail" : "Fail");?></th>
								<th><?php echo ($row['section_level'] > 10 ? "NG" : "NG");?></th>
								<?php if($row['section_level'] > 10){} else { ?>
									<th>Pass</th>
									<th>Fail</th>
									<th>NG</th>
									<th>Pass</th>
									<th>Fail</th>
									<th>NG</th>
								<?php } ?>
								<th>Pass</th>
								<th>Fail</th>
								<th>NG</th>
							</tr>
						</thead>
						<tbody> 
						</tbody>
						<?php
						$result2 = $controller->getCurriculumPerformance($data, " AND class_sem = '".$row['class_sem']."' ", " GROUP BY pros_title ");
						$i = 1;
						if($result2['0']  == 1){while($row2 = $result2['2']->fetch_assoc()){
							echo'<tr>';
								echo '<td>'.$i++.'</td>';
								echo '<td>'.$row2['pros_desc'].'</td>';
								$result3 = $controller->getProsStatusCount($data, " AND pros_no = '".$row2['pros_no']."' ", "");
								$count = ($result3['0'] == 1 ? $result3['3'] : 0);	
								echo '<td><strong>'.$count.'</strong></td>';
								$result3 = $controller->getProsStatusCount($data, " AND pros_no = '".$row2['pros_no']."' AND grade_q1 >= '75' ", "");
								$count = ($result3['0'] == 1 ? $result3['3'] : 0);
								echo '<td align="right" style="color: green">'.$count.'</td>';
								$result3 = $controller->getProsStatusCount($data, " AND pros_no = '".$row2['pros_no']."' AND grade_q1 < '75' ", "");
								$count = ($result3['0'] == 1 ? $result3['3'] : 0);
								echo '<td align="right" style="color: red">'.$count.'</td>';
								$result3 = $controller->getProsStatusCount($data, " AND pros_no = '".$row2['pros_no']."' AND grade_q1 = '' ", "");
								$count = ($result3['0'] == 1 ? $result3['3'] : 0);
								echo '<td align="right">'.$count.'</td>';
								$result3 = $controller->getProsStatusCount($data, " AND pros_no = '".$row2['pros_no']."' AND grade_q2 >= '75' ", "");
								$count = ($result3['0'] == 1 ? $result3['3'] : 0);
								echo '<td align="right" style="color: green">'.$count.'</td>';
								$result3 = $controller->getProsStatusCount($data, " AND pros_no = '".$row2['pros_no']."' AND grade_q2 < '75' ", "");
								$count = ($result3['0'] == 1 ? $result3['3'] : 0);
								echo '<td align="right" style="color: red">'.$count.'</td>';
								$result3 = $controller->getProsStatusCount($data, " AND pros_no = '".$row2['pros_no']."' AND grade_q2 = '' ", "");
								$count = ($result3['0'] == 1 ? $result3['3'] : 0);
								echo '<td align="right">'.$count.'</td>';
								if($row['section_level'] > 10){} else {
									$result3 = $controller->getProsStatusCount($data, " AND pros_no = '".$row2['pros_no']."' AND grade_q3 >= '75' ", "");
									$count = ($result3['0'] == 1 ? $result3['3'] : 0);
									echo '<td align="right" style="color: green">'.$count.'</td>';
									$result3 = $controller->getProsStatusCount($data, " AND pros_no = '".$row2['pros_no']."' AND grade_q3 < '75' ", "");
									$count = ($result3['0'] == 1 ? $result3['3'] : 0);
									echo '<td align="right" style="color: red">'.$count.'</td>';
									$result3 = $controller->getProsStatusCount($data, " AND pros_no = '".$row2['pros_no']."' AND grade_q3 = '' ", "");
									$count = ($result3['0'] == 1 ? $result3['3'] : 0);
									echo '<td align="right">'.$count.'</td>';
									$result3 = $controller->getProsStatusCount($data, " AND pros_no = '".$row2['pros_no']."' AND grade_q4 >= '75' ", "");
									$count = ($result3['0'] == 1 ? $result3['3'] : 0);
									echo '<td align="right" style="color: green">'.$count.'</td>';
									$result3 = $controller->getProsStatusCount($data, " AND pros_no = '".$row2['pros_no']."' AND grade_q4 < '75' ", "");
									$count = ($result3['0'] == 1 ? $result3['3'] : 0);
									echo '<td align="right" style="color: red">'.$count.'</td>';
									$result3 = $controller->getProsStatusCount($data, " AND pros_no = '".$row2['pros_no']."' AND grade_q4 = '' ", "");
									$count = ($result3['0'] == 1 ? $result3['3'] : 0);
									echo '<td align="right">'.$count.'</td>';
								}
								$result3 = $controller->getProsStatusCount($data, " AND pros_no = '".$row2['pros_no']."' AND grade_final >= '75' ", "");
								$count = ($result3['0'] == 1 ? $result3['3'] : 0);
								echo '<td align="right" style="color: green">'.$count.'</td>';
								$result3 = $controller->getProsStatusCount($data, " AND pros_no = '".$row2['pros_no']."' AND grade_final < '75' ", "");
								$count = ($result3['0'] == 1 ? $result3['3'] : 0);
								echo '<td align="right" style="color: red">'.$count.'</td>';
								$result3 = $controller->getProsStatusCount($data, " AND pros_no = '".$row2['pros_no']."' AND grade_final = '' ", "");
								$count = ($result3['0'] == 1 ? $result3['3'] : 0);
								echo '<td align="right">'.$count.'</td>';
							echo '</tr>';
						}} else {
							echo '<tr><td colspan="4">'.$result['1'].'</td></tr>';
						}	
						?>
					</table>
					</small>
				</div>
			</div>
		</div>
		<?php
		}}

	} else if($_POST['data']['0'] == "loadLevels"){
		$data = array_values($_POST);
		
		for($i = $min_level; $i <= $max_level; $i++){
			echo '<option value="'.$i.'">Grade '.$i.'</option>';
		}

	} 
}
?>