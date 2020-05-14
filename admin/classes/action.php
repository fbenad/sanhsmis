<?php
/*
 * Script Handler
 *
 * This page is used to process the request from the visible page of the Admin->Classes feature. 
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

	if($_POST['data']['0'] == "getClassTab0"){
		$data = array_values($_POST);
		?>
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Overall</h3>
					<div class="card-tools">
						<a href="javascript:void(0);" class="btn btn-tool" title="View current per section details" onclick="getClassTab0a();">
							<i class="fas fa-cog"></i> <span class="d-none d-md-inline">Show advanced </span>
						</a>						
					</div>
				</div>
				<div class="card-body table-responsive p-0" style="height: 250px;">
					<table class="table table-head-fixed">
						<thead>
							<tr>
								<th></th>
								<th colspan="3">BOSY</th>
								<th colspan="3">Current</th>
								<th colspan="3">Transferred Out</th>
								<th colspan="3"><?php echo($_SESSION['eosy'] == true ? "Dropped Out" : "No Longer in School");?></th>
							</tr>
							<tr>
								<th>Level</th>
								<th>M</th>
								<th>F</th>
								<th>T</th>
								<th>M</th>
								<th>F</th>
								<th>T</th>
								<th>M</th>
								<th>F</th>
								<th>T</th>
								<th>M</th>
								<th>F</th>
								<th>T</th>
							</tr>
						</thead>
						<tbody>
							<!--
							<?php
							$min_level = 0;
							$max_level = 6;
							?>
							<tr>
								<td>Elementary School</td>
								<td>100</td>
								<td>100</td>
								<td><strong>100</strong></td>
								<td>100</td>
								<td>100</td>
								<td><strong>100</strong></td>
								<td>100</td>
								<td>100</td>
								<td><strong>100</strong></td>
								<td>100</td>
								<td>100</td>
								<td><strong>100</strong></td>
							</tr>
							-->
							<?php
							$min_level = 7;
							$max_level = 10;
							?>
							<tr>
								<td>Junior High School</td>
								<?php
								$result = $controller->getLevelCount($data, $min_level, $max_level, "MALE", " AND enrol_section != '' ");
								
								if($result['0'] == 1){ $row = $result['2'];
									$count = $result['3'];
								} else {
									$count = $result['1'];
								}
								?>
								<td><?php echo $count;?></td>
								<?php
								$result = $controller->getLevelCount($data, $min_level, $max_level, "FEMALE", " AND enrol_section != '' ");
								
								if($result['0'] == 1){ $row = $result['2'];
									$count = $result['3'];
								} else {
									$count = $result['1'];
								}
								?>
								<td><?php echo $count;?></td>
								<?php
								$result = $controller->getLevelCount($data, $min_level, $max_level, "%", " AND enrol_section != '' ");
								
								if($result['0'] == 1){ $row = $result['2'];
									$count = $result['3'];
								} else {
									$count = $result['1'];
								}
								?>
								<td><strong><?php echo $count;?></strong></td>
								
								<?php
								$result = $controller->getLevelCount($data, $min_level, $max_level, "MALE", " AND enrol_section != '' AND (enrol_status1 = 'ENROLLED' OR enrol_status1 = 'PROMOTED') ");
								
								if($result['0'] == 1){ $row = $result['2'];
									$count = $result['3'];
								} else {
									$count = $result['1'];
								}
								?>
								<td><?php echo $count;?></td>
								<?php
								$result = $controller->getLevelCount($data, $min_level, $max_level, "FEMALE", " AND enrol_section != '' AND (enrol_status1 = 'ENROLLED' OR enrol_status1 = 'PROMOTED') ");
								
								if($result['0'] == 1){ $row = $result['2'];
									$count = $result['3'];
								} else {
									$count = $result['1'];
								}
								?>
								<td><?php echo $count;?></td>
								<?php
								$result = $controller->getLevelCount($data, $min_level, $max_level, "%", " AND enrol_section != '' AND (enrol_status1 = 'ENROLLED' OR enrol_status1 = 'PROMOTED') ");
								
								if($result['0'] == 1){ $row = $result['2'];
									$count = $result['3'];
								} else {
									$count = $result['1'];
								}
								?>
								<td><strong><?php echo $count;?></strong></td>
								
								<?php
								$result = $controller->getLevelCount($data, $min_level, $max_level, "MALE", " AND enrol_section != '' AND enrol_status2 = 'TRANSFERRED OUT' ");
								
								if($result['0'] == 1){ $row = $result['2'];
									$count = $result['3'];
								} else {
									$count = $result['1'];
								}
								?>
								<td><?php echo $count;?></td>
								<?php
								$result = $controller->getLevelCount($data, $min_level, $max_level, "FEMALE", " AND enrol_section != '' AND enrol_status2 = 'TRANSFERRED OUT' ");
								
								if($result['0'] == 1){ $row = $result['2'];
									$count = $result['3'];
								} else {
									$count = $result['1'];
								}
								?>
								<td><?php echo $count;?></td>
								<?php
								$result = $controller->getLevelCount($data, $min_level, $max_level, "%", " AND enrol_section != '' AND enrol_status2 = 'TRANSFERRED OUT' ");
								
								if($result['0'] == 1){ $row = $result['2'];
									$count = $result['3'];
								} else {
									$count = $result['1'];
								}
								?>
								<td><strong><?php echo $count;?></strong></td>
								
								<?php
								$result = $controller->getLevelCount($data, $min_level, $max_level, "MALE", " AND enrol_section != '' AND enrol_status2 = 'DROPPED OUT' ");
								
								if($result['0'] == 1){ $row = $result['2'];
									$count = $result['3'];
								} else {
									$count = $result['1'];
								}
								?>
								<td><?php echo $count;?></td>
								<?php
								$result = $controller->getLevelCount($data, $min_level, $max_level, "FEMALE", " AND enrol_section != '' AND enrol_status2 = 'DROPPED OUT' ");
								
								if($result['0'] == 1){ $row = $result['2'];
									$count = $result['3'];
								} else {
									$count = $result['1'];
								}
								?>
								<td><?php echo $count;?></td>
								<?php
								$result = $controller->getLevelCount($data, $min_level, $max_level, "%", " AND enrol_section != '' AND enrol_status2 = 'DROPPED OUT' ");
								
								if($result['0'] == 1){ $row = $result['2'];
									$count = $result['3'];
								} else {
									$count = $result['1'];
								}
								?>
								<td><strong><?php echo $count;?></strong></td>
							</tr>
							<?php
							$min_level = 11;
							$max_level = 12;
							?>
							<tr>
								<td>Senior High School</td>
								<?php
								$result = $controller->getLevelCount($data, $min_level, $max_level, "MALE", " AND enrol_section != '' ");
								
								if($result['0'] == 1){ $row = $result['2'];
									$count = $result['3'];
								} else {
									$count = $result['1'];
								}
								?>
								<td><?php echo $count;?></td>
								<?php
								$result = $controller->getLevelCount($data, $min_level, $max_level, "FEMALE", " AND enrol_section != '' ");
								
								if($result['0'] == 1){ $row = $result['2'];
									$count = $result['3'];
								} else {
									$count = $result['1'];
								}
								?>
								<td><?php echo $count;?></td>
								<?php
								$result = $controller->getLevelCount($data, $min_level, $max_level, "%", " AND enrol_section != '' ");
								
								if($result['0'] == 1){ $row = $result['2'];
									$count = $result['3'];
								} else {
									$count = $result['1'];
								}
								?>
								<td><strong><?php echo $count;?></strong></td>
								
								<?php
								$result = $controller->getLevelCount($data, $min_level, $max_level, "MALE", " AND enrol_section != '' AND (enrol_status1 = 'ENROLLED' OR enrol_status1 = 'PROMOTED') ");
								
								if($result['0'] == 1){ $row = $result['2'];
									$count = $result['3'];
								} else {
									$count = $result['1'];
								}
								?>
								<td><?php echo $count;?></td>
								<?php
								$result = $controller->getLevelCount($data, $min_level, $max_level, "FEMALE", " AND enrol_section != '' AND (enrol_status1 = 'ENROLLED' OR enrol_status1 = 'PROMOTED') ");
								
								if($result['0'] == 1){ $row = $result['2'];
									$count = $result['3'];
								} else {
									$count = $result['1'];
								}
								?>
								<td><?php echo $count;?></td>
								<?php
								$result = $controller->getLevelCount($data, $min_level, $max_level, "%", " AND enrol_section != '' AND (enrol_status1 = 'ENROLLED' OR enrol_status1 = 'PROMOTED') ");
								
								if($result['0'] == 1){ $row = $result['2'];
									$count = $result['3'];
								} else {
									$count = $result['1'];
								}
								?>
								<td><strong><?php echo $count;?></strong></td>
								
								<?php
								$result = $controller->getLevelCount($data, $min_level, $max_level, "MALE", " AND enrol_section != '' AND enrol_status2 = 'TRANSFERRED OUT' ");
								
								if($result['0'] == 1){ $row = $result['2'];
									$count = $result['3'];
								} else {
									$count = $result['1'];
								}
								?>
								<td><?php echo $count;?></td>
								<?php
								$result = $controller->getLevelCount($data, $min_level, $max_level, "FEMALE", " AND enrol_section != '' AND enrol_status2 = 'TRANSFERRED OUT' ");
								
								if($result['0'] == 1){ $row = $result['2'];
									$count = $result['3'];
								} else {
									$count = $result['1'];
								}
								?>
								<td><?php echo $count;?></td>
								<?php
								$result = $controller->getLevelCount($data, $min_level, $max_level, "%", " AND enrol_section != '' AND enrol_status2 = 'TRANSFERRED OUT' ");
								
								if($result['0'] == 1){ $row = $result['2'];
									$count = $result['3'];
								} else {
									$count = $result['1'];
								}
								?>
								<td><strong><?php echo $count;?></strong></td>
								
								<?php
								$result = $controller->getLevelCount($data, $min_level, $max_level, "MALE", " AND enrol_section != '' AND enrol_status2 = 'DROPPED OUT' ");
								
								if($result['0'] == 1){ $row = $result['2'];
									$count = $result['3'];
								} else {
									$count = $result['1'];
								}
								?>
								<td><?php echo $count;?></td>
								<?php
								$result = $controller->getLevelCount($data, $min_level, $max_level, "FEMALE", " AND enrol_section != '' AND enrol_status2 = 'DROPPED OUT' ");
								
								if($result['0'] == 1){ $row = $result['2'];
									$count = $result['3'];
								} else {
									$count = $result['1'];
								}
								?>
								<td><?php echo $count;?></td>
								<?php
								$result = $controller->getLevelCount($data, $min_level, $max_level, "%", " AND enrol_section != '' AND enrol_status2 = 'DROPPED OUT' ");
								
								if($result['0'] == 1){ $row = $result['2'];
									$count = $result['3'];
								} else {
									$count = $result['1'];
								}
								?>
								<td><strong><?php echo $count;?></strong></td>
							</tr>
							<?php
							$min_level = 7;
							$max_level = 12;
							?>
							<tr>
								<td><strong>Overall</strong></td>
								<?php
								$result = $controller->getLevelCount($data, $min_level, $max_level, "MALE", " AND enrol_section != '' ");
								
								if($result['0'] == 1){ $row = $result['2'];
									$count = $result['3'];
								} else {
									$count = $result['1'];
								}
								?>
								<td><?php echo $count;?></td>
								<?php
								$result = $controller->getLevelCount($data, $min_level, $max_level, "FEMALE", " AND enrol_section != '' ");
								
								if($result['0'] == 1){ $row = $result['2'];
									$count = $result['3'];
								} else {
									$count = $result['1'];
								}
								?>
								<td><?php echo $count;?></td>
								<?php
								$result = $controller->getLevelCount($data, $min_level, $max_level, "%", " AND enrol_section != '' ");
								
								if($result['0'] == 1){ $row = $result['2'];
									$count = $result['3'];
								} else {
									$count = $result['1'];
								}
								?>
								<td><strong><?php echo $count;?></strong></td>
								
								<?php
								$result = $controller->getLevelCount($data, $min_level, $max_level, "MALE", " AND enrol_section != '' AND (enrol_status1 = 'ENROLLED' OR enrol_status1 = 'PROMOTED') ");
								
								if($result['0'] == 1){ $row = $result['2'];
									$count = $result['3'];
								} else {
									$count = $result['1'];
								}
								?>
								<td><?php echo $count;?></td>
								<?php
								$result = $controller->getLevelCount($data, $min_level, $max_level, "FEMALE", " AND enrol_section != '' AND (enrol_status1 = 'ENROLLED' OR enrol_status1 = 'PROMOTED') ");
								
								if($result['0'] == 1){ $row = $result['2'];
									$count = $result['3'];
								} else {
									$count = $result['1'];
								}
								?>
								<td><?php echo $count;?></td>
								<?php
								$result = $controller->getLevelCount($data, $min_level, $max_level, "%", " AND enrol_section != '' AND (enrol_status1 = 'ENROLLED' OR enrol_status1 = 'PROMOTED') ");
								
								if($result['0'] == 1){ $row = $result['2'];
									$count = $result['3'];
								} else {
									$count = $result['1'];
								}
								?>
								<td><strong><?php echo $count;?></strong></td>
								
								<?php
								$result = $controller->getLevelCount($data, $min_level, $max_level, "MALE", " AND enrol_section != '' AND enrol_status2 = 'TRANSFERRED OUT' ");
								
								if($result['0'] == 1){ $row = $result['2'];
									$count = $result['3'];
								} else {
									$count = $result['1'];
								}
								?>
								<td><?php echo $count;?></td>
								<?php
								$result = $controller->getLevelCount($data, $min_level, $max_level, "FEMALE", " AND enrol_section != '' AND enrol_status2 = 'TRANSFERRED OUT' ");
								
								if($result['0'] == 1){ $row = $result['2'];
									$count = $result['3'];
								} else {
									$count = $result['1'];
								}
								?>
								<td><?php echo $count;?></td>
								<?php
								$result = $controller->getLevelCount($data, $min_level, $max_level, "%", " AND enrol_section != '' AND enrol_status2 = 'TRANSFERRED OUT' ");
								
								if($result['0'] == 1){ $row = $result['2'];
									$count = $result['3'];
								} else {
									$count = $result['1'];
								}
								?>
								<td><strong><?php echo $count;?></strong></td>
								
								<?php
								$result = $controller->getLevelCount($data, 7, 12, "MALE", " AND enrol_section != '' AND enrol_status2 = 'DROPPED OUT' ");
								
								if($result['0'] == 1){ $row = $result['2'];
									$count = $result['3'];
								} else {
									$count = $result['1'];
								}
								?>
								<td><?php echo $count;?></td>
								<?php
								$result = $controller->getLevelCount($data, 7, 12, "FEMALE", " AND enrol_section != '' AND enrol_status2 = 'DROPPED OUT' ");
								
								if($result['0'] == 1){ $row = $result['2'];
									$count = $result['3'];
								} else {
									$count = $result['1'];
								}
								?>
								<td><?php echo $count;?></td>
								<?php
								$result = $controller->getLevelCount($data, 7, 12, "%", " AND enrol_section != '' AND enrol_status2 = 'DROPPED OUT' ");
								
								if($result['0'] == 1){ $row = $result['2'];
									$count = $result['3'];
								} else {
									$count = $result['1'];
								}
								?>
								<td><strong><?php echo $count;?></strong></td>
							</tr>
						</tbody>
					</table>
				</div>
            </div>
        </div>	
		<?php
		
	} if($_POST['data']['0'] == "getClassTab0a"){
		$data = array_values($_POST);
		$min_level = $data['0']['2'];
		$max_level = $data['0']['3'];
		?>
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Per Level</h3>
					<div class="card-tools">
						<a href="javascript:void(0);" class="btn btn-tool" title="Close per section details" onclick="closeClassTab0a();">
							<i class="fas fa-times"></i>
							<span class="d-none d-md-inline"> Close  advanced </span>
						</a>					
					</div>
				</div>
				<div class="card-body table-responsive p-0" style="height: 300px;">
					<table class="table table-head-fixed">
						<thead>
							<tr>
								<th></th>
								<th colspan="3">BOSY</th>
								<th colspan="3">Current</th>
								<th colspan="3">Transferred Out</th>
								<th colspan="3"><?php echo($_SESSION['eosy'] == true ? "Dropped Out" : "No Longer in School");?></th>
							</tr>
							<?php
							
							?>
							<tr>
								<th>Level</th>
								<th>M</th>
								<th>F</th>
								<th>T</th>
								<th>M</th>
								<th>F</th>
								<th>T</th>
								<th>M</th>
								<th>F</th>
								<th>T</th>
								<th>M</th>
								<th>F</th>
								<th>T</th>
							</tr>
						</thead>
						<tbody>
							<!--
							<tr>
								<td>Elementary School</td>
								<td>100</td>
								<td>100</td>
								<td><strong>100</strong></td>
								<td>100</td>
								<td>100</td>
								<td><strong>100</strong></td>
								<td>100</td>
								<td>100</td>
								<td><strong>100</strong></td>
								<td>100</td>
								<td>100</td>
								<td><strong>100</strong></td>
							</tr>
							-->
							<?php
							for($i = $min_level; $i <= $max_level; $i++){
							?>
							<tr>
								<td>Grade <?php echo $i;?></td>
								<?php
								$result = $controller->getLevelCount($data, $i, $i, "MALE", " AND enrol_section != '' ");
								
								if($result['0'] == 1){ $row = $result['2'];
									$count = $result['3'];
								} else {
									$count = ($result['0'] == 0 ? 0 : $result['3']);
								}
								?>
								<td><?php echo $count;?></td>
								<?php
								$result = $controller->getLevelCount($data, $i, $i, "FEMALE", " AND enrol_section != '' ");
								
								if($result['0'] == 1){ $row = $result['2'];
									$count = $result['3'];
								} else {
									$count = ($result['0'] == 0 ? 0 : $result['3']);
								}
								?>
								<td><?php echo $count;?></td>
								<?php
								$result = $controller->getLevelCount($data, $i, $i, "%", " AND enrol_section != '' ");
								
								if($result['0'] == 1){ $row = $result['2'];
									$count = $result['3'];
								} else {
									$count = ($result['0'] == 0 ? 0 : $result['3']);
								}
								?>
								<td><strong><?php echo $count;?></strong></td>
								
								<?php
								$result = $controller->getLevelCount($data, $i, $i, "MALE", " AND enrol_section != '' AND (enrol_status1 = 'ENROLLED' OR enrol_status1 = 'PROMOTED') ");
								
								if($result['0'] == 1){ $row = $result['2'];
									$count = $result['3'];
								} else {
									$count = ($result['0'] == 0 ? 0 : $result['3']);
								}
								?>
								<td><?php echo $count;?></td>
								<?php
								$result = $controller->getLevelCount($data, $i, $i, "FEMALE", " AND enrol_section != '' AND (enrol_status1 = 'ENROLLED' OR enrol_status1 = 'PROMOTED') ");
								
								if($result['0'] == 1){ $row = $result['2'];
									$count = $result['3'];
								} else {
									$count = ($result['0'] == 0 ? 0 : $result['3']);
								}
								?>
								<td><?php echo $count;?></td>
								<?php
								$result = $controller->getLevelCount($data, $i, $i, "%", " AND enrol_section != '' AND (enrol_status1 = 'ENROLLED' OR enrol_status1 = 'PROMOTED') ");
								
								if($result['0'] == 1){ $row = $result['2'];
									$count = $result['3'];
								} else {
									$count = ($result['0'] == 0 ? 0 : $result['3']);
								}
								?>
								<td><strong><?php echo $count;?></strong></td>
								
								<?php
								$result = $controller->getLevelCount($data, $i, $i, "MALE", " AND enrol_section != '' AND enrol_status2 = 'TRANSFERRED OUT' ");
								
								if($result['0'] == 1){ $row = $result['2'];
									$count = $result['3'];
								} else {
									$count = ($result['0'] == 0 ? 0 : $result['3']);
								}
								?>
								<td><?php echo $count;?></td>
								<?php
								$result = $controller->getLevelCount($data, $i, $i, "FEMALE", " AND enrol_section != '' AND enrol_status2 = 'TRANSFERRED OUT' ");
								
								if($result['0'] == 1){ $row = $result['2'];
									$count = $result['3'];
								} else {
									$count = ($result['0'] == 0 ? 0 : $result['3']);
								}
								?>
								<td><?php echo $count;?></td>
								<?php
								$result = $controller->getLevelCount($data, $i, $i, "%", " AND enrol_section != '' AND enrol_status2 = 'TRANSFERRED OUT' ");
								
								if($result['0'] == 1){ $row = $result['2'];
									$count = $result['3'];
								} else {
									$count = ($result['0'] == 0 ? 0 : $result['3']);
								}
								?>
								<td><strong><?php echo $count;?></strong></td>
								
								<?php
								$result = $controller->getLevelCount($data, $i, $i, "MALE", " AND enrol_section != '' AND enrol_status2 = 'DROPPED OUT' ");
								
								if($result['0'] == 1){ $row = $result['2'];
									$count = $result['3'];
								} else {
									$count = ($result['0'] == 0 ? 0 : $result['3']);
								}
								?>
								<td><?php echo $count;?></td>
								<?php
								$result = $controller->getLevelCount($data, $i, $i, "FEMALE", " AND enrol_section != '' AND enrol_status2 = 'DROPPED OUT' ");
								
								if($result['0'] == 1){ $row = $result['2'];
									$count = $result['3'];
								} else {
									$count = ($result['0'] == 0 ? 0 : $result['3']);
								}
								?>
								<td><?php echo $count;?></td>
								<?php
								$result = $controller->getLevelCount($data, $i, $i, "%", " AND enrol_section != '' AND enrol_status2 = 'DROPPED OUT' ");
								
								if($result['0'] == 1){ $row = $result['2'];
									$count = $result['3'];
								} else {
									$count = ($result['0'] == 0 ? 0 : $result['3']);
								}
								?>
								<td><strong><?php echo $count;?></strong></td>
							</tr>
							<?php
							}
							?>
						</tbody>
					</table>
				</div>
            </div>
        </div>	
		
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Per Class</h3>
					<div class="card-tools">
						<a href="javascript:void(0);" class="btn btn-tool" title="Close per section details" onclick="closeClassTab0a();">
							<i class="fas fa-times"></i> 
							<span class="d-none d-md-inline"> Close  advanced </span>
						</a>							
					</div>
				</div>
				<div class="card-body table-responsive p-0" style="height: 500px;">
					<table class="table table-head-fixed">
						<thead>
							<tr>
								<th></th>
								<th colspan="3">BOSY</th>
								<th colspan="3">Current</th>
								<th colspan="3">Transferred Out</th>
								<th colspan="3"><?php echo($_SESSION['eosy'] == true ? "Dropped Out" : "No Longer in School");?></th>
							</tr>
							<?php
							
							?>
							<tr>
								<th>Level</th>
								<th>M</th>
								<th>F</th>
								<th>T</th>
								<th>M</th>
								<th>F</th>
								<th>T</th>
								<th>M</th>
								<th>F</th>
								<th>T</th>
								<th>M</th>
								<th>F</th>
								<th>T</th>
							</tr>
						</thead>
						<tbody>
							<!--
							<tr>
								<td>Elementary School</td>
								<td>100</td>
								<td>100</td>
								<td><strong>100</strong></td>
								<td>100</td>
								<td>100</td>
								<td><strong>100</strong></td>
								<td>100</td>
								<td>100</td>
								<td><strong>100</strong></td>
								<td>100</td>
								<td>100</td>
								<td><strong>100</strong></td>
							</tr>
							-->
							<?php
							$min_level = $data['0']['2'];
							$max_level =  $data['0']['3'];
							$result2 = $controller->getClassTab($data, " AND section_level >= $min_level AND section_level <= $max_level ", "");

							if($result2['0'] == 1){while($row2 = $result2['2']->fetch_assoc()){
								$enrol_section = $row2['section_name'];
								?>
								<tr>
									<td><?php echo $row2['section_name'];?></td>
									<?php
									$result = $controller->getLevelCount($data, $row2['section_level'], $row2['section_level'], "MALE", " AND enrol_section = '$enrol_section' ");
									
									if($result['0'] == 1){ $row = $result['2'];
										$count = $result['3'];
									} else {
										$count = ($result['0'] == 0 ? 0 : $result['3']);
									}
									?>
									<td><?php echo $count;?></td>
									<?php
									$result = $controller->getLevelCount($data, $row2['section_level'], $row2['section_level'], "FEMALE", " AND enrol_section = '$enrol_section' ");
									
									if($result['0'] == 1){ $row = $result['2'];
										$count = $result['3'];
									} else {
										$count = ($result['0'] == 0 ? 0 : $result['3']);
									}
									?>
									<td><?php echo $count;?></td>
									<?php
									$result = $controller->getLevelCount($data, $row2['section_level'], $row2['section_level'], "%", " AND enrol_section = '$enrol_section' ");
									
									if($result['0'] == 1){ $row = $result['2'];
										$count = $result['3'];
									} else {
										$count = ($result['0'] == 0 ? 0 : $result['3']);
									}
									?>
									<td><strong><?php echo $count;?></strong></td>
									
									<?php
									$result = $controller->getLevelCount($data, $row2['section_level'], $row2['section_level'], "MALE", " AND enrol_section = '$enrol_section' AND (enrol_status1 = 'ENROLLED' OR enrol_status1 = 'PROMOTED') ");
									
									if($result['0'] == 1){ $row = $result['2'];
										$count = $result['3'];
									} else {
										$count = ($result['0'] == 0 ? 0 : $result['3']);
									}
									?>
									<td><?php echo $count;?></td>
									<?php
									$result = $controller->getLevelCount($data, $row2['section_level'], $row2['section_level'], "FEMALE", " AND enrol_section = '$enrol_section' AND (enrol_status1 = 'ENROLLED' OR enrol_status1 = 'PROMOTED') ");
									
									if($result['0'] == 1){ $row = $result['2'];
										$count = $result['3'];
									} else {
										$count = ($result['0'] == 0 ? 0 : $result['3']);
									}
									?>
									<td><?php echo $count;?></td>
									<?php
									$result = $controller->getLevelCount($data, $row2['section_level'], $row2['section_level'], "%", " AND enrol_section = '$enrol_section' AND (enrol_status1 = 'ENROLLED' OR enrol_status1 = 'PROMOTED') ");
									
									if($result['0'] == 1){ $row = $result['2'];
										$count = $result['3'];
									} else {
										$count = ($result['0'] == 0 ? 0 : $result['3']);
									}
									?>
									<td><strong><?php echo $count;?></strong></td>
									
									<?php
									$result = $controller->getLevelCount($data, $row2['section_level'], $row2['section_level'], "MALE", " AND enrol_section = '$enrol_section' AND enrol_status2 = 'TRANSFERRED OUT' ");
									
									if($result['0'] == 1){ $row = $result['2'];
										$count = $result['3'];
									} else {
										$count = ($result['0'] == 0 ? 0 : $result['3']);
									}
									?>
									<td><?php echo $count;?></td>
									<?php
									$result = $controller->getLevelCount($data, $row2['section_level'], $row2['section_level'], "FEMALE", " AND enrol_section = '$enrol_section' AND enrol_status2 = 'TRANSFERRED OUT' ");
									
									if($result['0'] == 1){ $row = $result['2'];
										$count = $result['3'];
									} else {
										$count = ($result['0'] == 0 ? 0 : $result['3']);
									}
									?>
									<td><?php echo $count;?></td>
									<?php
									$result = $controller->getLevelCount($data, $row2['section_level'], $row2['section_level'], "%", " AND enrol_section = '$enrol_section' AND enrol_status2 = 'TRANSFERRED OUT' ");
									
									if($result['0'] == 1){ $row = $result['2'];
										$count = $result['3'];
									} else {
										$count = ($result['0'] == 0 ? 0 : $result['3']);
									}
									?>
									<td><strong><?php echo $count;?></strong></td>
									
									<?php
									$result = $controller->getLevelCount($data, $row2['section_level'], $row2['section_level'], "MALE", " AND enrol_section = '$enrol_section' AND enrol_status2 = 'DROPPED OUT' ");
									
									if($result['0'] == 1){ $row = $result['2'];
										$count = $result['3'];
									} else {
										$count = ($result['0'] == 0 ? 0 : $result['3']);
									}
									?>
									<td><?php echo $count;?></td>
									<?php
									$result = $controller->getLevelCount($data, $row2['section_level'], $row2['section_level'], "FEMALE", " AND enrol_section = '$enrol_section' AND enrol_status2 = 'DROPPED OUT' ");
									
									if($result['0'] == 1){ $row = $result['2'];
										$count = $result['3'];
									} else {
										$count = ($result['0'] == 0 ? 0 : $result['3']);
									}
									?>
									<td><?php echo $count;?></td>
									<?php
									$result = $controller->getLevelCount($data, $row2['section_level'], $row2['section_level'], "%", " AND enrol_section = '$enrol_section' AND enrol_status2 = 'DROPPED OUT' ");
									
									if($result['0'] == 1){ $row = $result['2'];
										$count = $result['3'];
									} else {
										$count = ($result['0'] == 0 ? 0 : $result['3']);
									}
									?>
									<td><strong><?php echo $count;?></strong></td>
								</tr>
							<?php
							}} else {
								echo '<tr><td colspan="13">'.$result['1'].'</td></tr>';
							}
							?>
						</tbody>
					</table>
				</div>
            </div>
        </div>
		<?php
		
	} elseif($_POST['data']['0'] == "getClassTab0b"){
		$data = array_values($_POST);
		$result = $controller->getLevelCount($data, $min_level, $max_level, "MALE", " AND enrol_section != '' AND (enrol_status1 = 'ENROLLED' OR enrol_status1 = 'PROMOTED' ) ");
		
		if($result['0'] == 1){ $row = $result['2'];
			$countM = $result['3'];
		} else {
			$countM = ($result['0'] == 0 ? 0 : $result['3']);
		}
		
		$result = $controller->getLevelCount($data, $min_level, $max_level, "FEMALE", " AND enrol_section != '' AND (enrol_status1 = 'ENROLLED' OR enrol_status1 = 'PROMOTED' ) ");
		
		if($result['0'] == 1){ $row = $result['2'];
			$countF = $result['3'];
		} else {
			$countF = ($result['0'] == 0 ? 0 : $result['3']);
		}
		
		$result = $controller->getLevelCount($data, $min_level, $max_level, "%", " AND enrol_section != '' AND enrol_status1 = 'INACTIVE' ");
		
		if($result['0'] == 1){ $row = $result['2'];
			$countI = $result['3'];
		} else {
			$countI = ($result['0'] == 0 ? 0 : $result['3']);
		}
		?>
		<div class="col-md-6">
            <div class="card">
				<div class="card-header">
					<h3 class="card-title">Current Enrollment</h3>
				</div>
				<div class="card-body">
					<canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
					
					<h1 align="center"><?php echo number_format($countM + $countF, 0);?> Students</h1>
				</div>
			</div>
		</div>
		<script type="text/javascript">	
		 $(function () {
			var pieData = {
			  labels: [
				  'Male', 
				  'Female',
				  'Inactive (TO / NLS)',
			  ],
			  datasets: [
				{
				  data: [<?php echo $countM;?>,<?php echo $countF;?>,<?php echo $countI;?>],
				  backgroundColor : ['#f56954', '#00a65a', '#f39c12'],
				}
			  ]
			}

			var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
			var pieData        = pieData;
			var pieOptions     = {
			  maintainAspectRatio : false,
			  responsive : true,
			}
			
			var pieChart = new Chart(pieChartCanvas, {
			  type: 'pie',
			  data: pieData,
			  options: pieOptions      
			})
		})		
		</script>		
		<div class="col-md-6">
			<div class="row">
				<?php
				$result = $controller->getStatusCount($data, '0');
				
				if($result['0'] == 1){ $activeSections = $result['3']; 
				} else { $activeSections = $result['1'];}
				
				$result = $controller->getStatusCount($data, '1');
				
				if($result['0'] == 1){ $inactiveSections = $result['3']; 
				} else { $inactiveSections = $result['1'];}
				?>
				<div class="col-md-6">
					<div class="info-box">
						<span class="info-box-icon bg-success elevation-1"><i class="fas fa-chalkboard-teacher"></i></span>
						<div class="info-box-content">
							<span class="info-box-text">Active Sections</span>
							<span class="info-box-number" id="dashboard-label-2"><?php echo $activeSections;?></span>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="info-box">
						<span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-chalkboard-teacher"></i></span>
						<div class="info-box-content">
							<span class="info-box-text">Bogus Sections</span>
							<span class="info-box-number" id="dashboard-label-2"><?php echo $inactiveSections;?></span>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Bogus sections</h3>
						</div>
						<div class="card-body table-responsive p-0">
							<table class="table table-head-fixed">
								<thead>
									<tr>
										<th>#</th>
										<th>Section</th>
										<th>Subject Association</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
								<?php
								$result = $controller->getStatusCount($data, '1');
								
								$i = 1;
								if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
								?>
									<tr>
										<td><?php echo $i++;?></td>
										<td><?php echo ($row['section_name']);?></td>
										<?php
										$data2 = array(array('getSectionAssociation', $row['section_sy'], $row['section_no']));
										$result2 = $controller->getSectionAssociation($data2);
										
										if($result2['0'] == 1){$row2 = $result2['2'];
											$associationCount = $row2['associationCount'];
										} else {
											$associationCount = 0;
										}
										?>
										<td><?php echo $associationCount;?> subject(s)</td>
										<td><a type="button" title="Modify class settings"
												data-toggle="modal" href="#modal-input" rowID="<?php echo $row['section_no'];?>" data-type="modifyClass">
												<small><i class="fas fa-cog"></i></small>
											</a></td>

									</tr>
								<?php
								}} else {
									echo '<tr><td colspan="3">'.$result['1'].'</td></tr>';
								}
								?>
								</tbody>
							</table>
						</div>
					</div>		
				</div>		
			</div>		
		</div>	
		
		<?php
	} else if($_POST['data']['0'] == "getClassTab"){
		$data = array_values($_POST);
		$min_level = $data['0']['2'];
		$max_level =  $data['0']['3'];
		$result = $controller->getClassTab($data, " AND section_level >= $min_level AND section_level <= $max_level ", " GROUP BY section_level ");
		
		if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
			?>
			<div class="col-md-<?php echo($max_level == 12 ? "6" : "3");?>">
				<div class="card card-default">
					<div class="card-header">
						<h3 class="card-title">Grade <?php echo $row['section_level'];?></h3>
					</div>
					<div class="card-body p-0">
						<table class="table">
							<tbody>
							<?php
							$section_level = $row['section_level'];
							$result2 = $controller->getClassTab($data, " AND section_level = $section_level ", " ");
							
							if($result2['0'] == 1){ while($row2 = $result2['2']->fetch_assoc()){
								?>
								<tr>
									<td>
										<?php
										$result3 = $controller->getSectionCount($data, $row2['section_name'], " AND (enrol_status1 = 'ENROLLED'OR enrol_status1 = 'PROMOTED') ");
										
										if($result3['0'] == 1){ $row3 = $result3['2']; 
											$sectionCount = $row3['sectionCount'];
										} else {
											$sectionCount = $result3['1'];
										}
										?>
										<span class="badge bg-secondary float-right"><?php echo $sectionCount;?></span>
										<strong><?php echo $row2['section_name'];?></strong><br>
										<div class="btn-group float-right">
											<?php 
											if($_SESSION['eosy'] == true && $_SESSION['current_sy'] == $row2['section_sy']){ 
												if($row2['section_status'] == 1){ 
													?>
													<div class="btn-group">
														<button type="button" class="btn btn-default" title="Unfinalize class" 
															data-toggle="modal" data-target="#modal-input" rowID="<?php echo $row2['section_no'];?>" 
															data-backdrop="static" data-keyboard="false" data-type="unfinalizeClass">
															<small><i class="fas fa-lock"></i></small>
														</button>
														<a type="button" href="?p=classes&show=<?php echo $row2['section_no'];?>&sy=<?php echo $row2['section_sy'];?>" class="btn btn-default" title="View Enrollment">
															<small>View Enrollment</small>
														</a>
													</div>
													<?php
												} else {
													?>
													<div class="btn-group">
														<a type="button" href="?p=classes&show=<?php echo $row2['section_no'];?>&sy=<?php echo $row2['section_sy'];?>" class="btn btn-info" title="Review & Finalize">
															<small>Review & Finalize</small>
														</a>
														<button type="button" class="btn btn-default" title="Modify class settings"
															data-toggle="modal" data-target="#modal-input" rowID="<?php echo $row2['section_no'];?>" 
															data-backdrop="static" data-keyboard="false" data-type="modifyClass">
															<small><i class="fas fa-cog"></i></small>
														</button>
													</div>
													<?php
												}
												
											} else if($_SESSION['eosy'] == false && $_SESSION['current_sy'] == $row2['section_sy']){
												if($row2['section_status'] == 1){ 
													?>
													<a type="button" href="?p=classes&show=<?php echo $row2['section_no'];?>&sy=<?php echo $row2['section_sy'];?>" class="btn btn-default" title="View Enrollment">
														<small>View Enrollment</small>
													</a>
													<?php	
												} else {
													?>
													<div class="btn-group">
														<a type="button" href="?p=classes&show=<?php echo $row2['section_no'];?>&sy=<?php echo $row2['section_sy'];?>" class="btn btn-default" title="Review & Finalize">
															<small>View Enrollment</small>
														</a>
														<button type="button" class="btn btn-default" title="Modify class settings"
															data-toggle="modal" data-target="#modal-input" rowID="<?php echo $row2['section_no'];?>" 
															data-backdrop="static" data-keyboard="false" data-type="modifyClass">
															<small><i class="fas fa-cog"></i></small>
														</button>
													</div>													
													<?php
												}
												
											} else {
												?>
												<a type="button" href="?p=classes&show=<?php echo $row2['section_no'];?>&sy=<?php echo $row2['section_sy'];?>" class="btn btn-default" title="View Enrollment">
													<small>View Enrollment</small>
												</a>
												<?php
											}
											?>
										</div>
									</td>
								</tr>
								<?php
							}} else {
								echo '
								<br>
								<div class="col-12">
									<div class="callout callout-danger">
										<h5><i class="fas fa-info"></i> Note:</h5>
										'.$result['1'].'
									</div>
								</div>';
							}
							?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<?php
		}} else {
			echo '
			<div class="col-12">
				<div class="callout callout-danger">
					<h5><i class="fas fa-info"></i> Note:</h5>
					'.$result['1'].'
				</div>
			</div>';
			
		}
		
	} else if($_POST['data']['0'] == "getSYs"){
		$data = array_values($_POST);

		$result = $controller->getSYs($data);
		
		if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
			echo '<option value="'.$row['settings_sy'].'">SY '.$row['settings_sy'].'-'.($row['settings_sy']+1).'</option>';
		}} else {
			echo '<option value="">'.$result['1'].'</option>';
			
		}
		
	} else if($_POST['data']['0'] == "showAction"){
		$data = array_values($_POST);
		
		if($data['0']['1'] == "addClass"){
			?>
			<div class="row">
				<div class="col-md-7 col-form-label">
					<label>Name *</label>
					<input type="text" class="form-control" id="section_name" name="section_name" minlength="3" placeholder="Onyx" onchange="checkDuplicateName();" required autofocus>
				</div>
				<div class="col-md-5 col-form-label">
					<label>Bogus Section? *</label>
					<select class="form-control" id="section_bogus" name="section_bogus" onchange="updateSectionType();" required>
						<option value="0">No</option>
						<option value="1">Yes</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-md-7 col-form-label">
					<label>Level *</label>
					<select class="form-control" id="section_level" name="section_level" onchange="updateClassType();" required>
						<option value="">Select level</option>
						<?php 
						for($i = $min_level; $i <= $max_level; $i++){ 	
							echo '<option value="'.$i.'">Grade '.$i.'</option>';
						} 
						?>
					</select>
				</div>
				<div class="col-md-5 col-form-label">
					<label>Capacity *</label>
					<input type="number" class="form-control" id="section_cap" name="section_cap" min="0" placeholder="45" required>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-form-label">
					<label>Class type *</label>
					<select class="form-control" id="section_track" name="section_track" required>
						<option value="">Select class type</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-form-label">
					<label>Class Adviser *</label>
					<select class="form-control" id="section_adviser" name="section_adviser" required>
					<?php
					$result = $controller->getUsers(" AND user_role = '2' AND teach_teacher = '1' ");
					
					echo '<option value="">Select class adviser</option>';
					echo '<option value="1">*** To be assigned</option>';
					if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
						echo '<option value="'.$row['user_no'].'">'.$row['user_fullname'].'</option>';
					}} else{
						echo '<option value="">'.$result['1'].'</option>';
					}
					?>
					</select>
					<input type="hidden" class="form-control" id="section_sy" name="section_sy">
					<input type="hidden" class="form-control" id="section_no" name="section_no">					
				</div>
			</div>
			<script type="text/javascript">	
			function updateSectionType(){
				var section_bogus = $('#section_bogus').val();
				
				if(section_bogus == "1"){
					$('#section_track').attr('disabled', 'disabled');
					$('#section_adviser').attr('disabled', 'disabled');
				} else {
					$('#section_track').removeAttr('disabled');
					$('#section_adviser').removeAttr('disabled');					
				}
			}
			</script>
			<?php
			
		} else if($data['0']['1'] == "modifyClass"){
			$result = $controller->getSection($data);
			
			header("Content-Type: application/json");
			echo json_encode($result);

			exit();	
			
		} else if($data['0']['1'] == "unfinalizeClass"){
			$result = $controller->getSection($data);
			
			if($result['0'] == 1) { $row = $result['2'];
				?>
				<div class="card card-default">
					<div class="card-header">
						<h3 class="card-title"><?php echo "Grade ".$row['section_level']." - ".$row['section_name']." / SY ".$row['section_sy']."-".($row['section_sy']+1);?></h3>
					</div>
					<div class="card-body">
						<strong>Finalized on</strong> <?php echo date('F j, Y h:i A', strtotime($row['section_updatedate']));?>
						<input type="hidden" class="form-control" id="section_no" name="section_no" value="<?php echo $row['section_no'];?>">
					</div>
				</div>
				<?php
			} else {
				echo $result['1'];
			}	
			
		} 
		
	} else if($_POST['data']['0'] == "updateClassType"){
		$data = array_values($_POST);
		
		if($data['0']['1'] <= ""){
			$condition = " AND field_name LIKE '1%' ";
		} else if($data['0']['1'] <= 6){
			$condition = " AND field_name LIKE 'ES%' ";
		} else if($data['0']['1'] <= 10){
			$condition = " AND field_name LIKE 'JHS%' ";
		} else if($data['0']['1'] <= 12){
			$condition = " AND field_name LIKE 'SHS%' ";
		} 
		$result = $controller->getDropdowns($data, "TRACK", $condition);
		
		echo '<option value="">Select class type</option>';
		if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
			echo '<option value="'.$row['field_name'].'">'.$row['field_name'].'</option>';
		}} else{
			echo '<option value="">'.$result['1'].'</option>';
		}
		
	} else if($_POST['data']['0'] == "submitAction"){
		$data = array_values($_POST);
		
		if($_POST['data']['1'] == "addClass"){
			$result = $controller->addClass($data);
		} else if($_POST['data']['1'] == "modifyClass"){
			$result = $controller->modifyClass($data);
		} else if($_POST['data']['1'] == "deleteClass"){
			$result = $controller->deleteClass($data);
		} else if($_POST['data']['1'] == "unfinalizeClass"){
			$result = $controller->unfinalizeClass($data);
		}
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();	
		
	} else if($_POST['data']['0'] == "checkDuplicateName"){
		$data = array_values($_POST);
		$result = $controller->checkDuplicateName($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();	
		
	} else if($_POST['data']['0'] == "getSectionCount"){
		$data = array_values($_POST);
		$result = $controller->getSectionCount($data, $data['0']['2'], "");
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();	
		
	} else if($_POST['data']['0'] == "getSectionAssociation"){
		$data = array_values($_POST);
		$result = $controller->getSectionAssociation($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();	
	}

}
?>