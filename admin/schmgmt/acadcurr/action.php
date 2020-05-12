<?php
session_start();
require_once("../../../config/dbconfig.php");
require_once("../../../config/settings.php");
require_once("controller.php");

$controller = new Controller();

if(isset($_POST['data'])){	

	if($_POST['data']['0'] == "loadCurrYears"){
		$data = array_values($_POST);
		$result = $controller->loadCurrYears();
		
		if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
			echo '<option value="'.$row['field_name'].'">'.$row['field_name'].' Curriculum Year</option>';			
		}} else {
			echo '<option value="">'.$result['1'].'</option>';
		}
		
	} else if($_POST['data']['0'] == "loadCurrPrograms"){
		$data = array_values($_POST);
		$result = $controller->loadCurrPrograms($data, " AND field_name NOT LIKE 'SHS %' ");
		
		if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
			echo '<option value="'.$row['field_name'].'">'.$row['field_name'].'</option>';			
		}} else {
			echo '<option value="">'.$result['1'].'</option>';
		}
		
	} else if($_POST['data']['0'] == "getCurrProgram"){
		$data = array_values($_POST);
		
		if(substr($_POST['data']['2'], 0, 3) == "SHS"){
			$condition = " OR pros_track LIKE 'SHS %'";
		} else {
			$condition = "";
		}
		$result = $controller->getCurrProgram($data, $condition);
		
		if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
			echo '
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Grade '.$row['pros_level'].($row['pros_sem'] == 12 ? "" : " - Sem ".$row['pros_sem']).' <span id="entity-list-count"></span></h3>
							<a href="javascript:void(0);" class="float-right" id="add-subject" title="Add subject" 
								data-toggle="modal" data-target="#modal-input" rowID="'.$row['pros_level'].'" 
								data-backdrop="static" data-keyboard="false" data-type="addSubject">
								<i class="fas fa-plus-square"></i>
							</a>
						</div>
						<div class="card-body  table-responsive p-0">
							<small>
							<table class="table table-hover ">
								<thead>
									<tr>
										<th width="8%">#</th>
										<th width="13%">Course Code</th>
										<th>Descriptive Title</th>	
										<th width="5%">'.($row['pros_level'] > 10 ? "Units" : "").'</th>
										<th width="13%">Cut-off Grade</th>					
										<th width="18%">Pre-requisites</th>
										<th width="6%" colspan="3"></th>
									</tr>
								</thead>
								<tbody id="users-list">';
								
								$result2 = $controller->getCourses($data, $row['pros_level'], $row['pros_sem']);
								
								$i = 1;
								if($result2['0'] == 1){ while($row2 = $result2['2']->fetch_assoc()){
									echo '
									<tr>
										<td>'.$i++.'</td>
										<td title="'.$row2['pros_no'].'">'.$row2['pros_title'].'</td>
										<td>'.$row2['pros_desc'].'</td>
										<td>'.($row2['pros_level'] > 10 ? number_format($row2['pros_unit'], 2) : "").'</td>
										<td>'.$row2['pros_cutoff'].'</td>
										<td>'.$row2['pros_prereq'].'</td>
										<td><a href="javascript:void(0);" class="float-right" id="modify-subject" title="Modify subject" 
												data-toggle="modal" data-target="#modal-input" rowID="'.$row2['pros_no'].'" 
												data-backdrop="static" data-keyboard="false" data-type="modifySubject">
												<i class="fas fa-external-link-alt"></i>
											</a>
										</td>
										<td title="'.$row2['pros_sort'].'">

											'.($row2['pros_sort'] < 2 ? "" : '<a href="javascript:void(0);" title="Move up" onclick="moveSort('.$row2['pros_no'].','.$row2['pros_sort'].',-1);"><i class="fas fa-arrow-up"></i>').'</td>
										<td><a href="javascript:void(0);" title="Move down" onclick="moveSort('.$row2['pros_no'].','.$row2['pros_sort'].',1);"><i class="fas fa-arrow-down"></i></td>
									</tr>
									';
								}} else {
									echo '<tr><td>'.$result2['1'].'</td></tr>';
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
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">'.$result['1'].'</h3>
							<a href="javascript:void(0);" class="float-right" id="add-subject" title="Add subject" 
								data-toggle="modal" data-target="#modal-input" rowID="0" 
								data-backdrop="static" data-keyboard="false" data-type="addSubject">
								<i class="fas fa-plus-square"></i>
							</a>
						</div>
					</div>
				</div>
			</div>';
		}

	} else if($_POST['data']['0'] == "moveSort"){
		$data = array_values($_POST);
		$result = $controller->moveSort($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();	
		
	} else if($_POST['data']['0'] == "loadDashboardCounts"){
		$data = array_values($_POST);
		$result = $controller->loadDashboardCounts($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();	
		
	} else if($_POST['data']['0'] == "showAction"){
		$data = array_values($_POST);
		
		if($_POST['data']['1'] == "addCurriculum"){
			?>
			<div class="row">
				<div class="col-md-12 col-form-label">
					<label>Curriculum Year *</label>
					<input type="number" class="form-control" id="field_name" name="field_name" min="<?php echo date('Y', strtotime('-1 year'));?>" max="<?php echo date('Y');?>" placeholder="" onkeyup="checkSY();" required>
					<input type="hidden" class="form-control" id="field_category" name="field_category" value="CURRICULUM">
					<small>The implementation year.</small>
				</div>
			</div>
			<?php
			
		} else if($_POST['data']['1'] == "addProgram"){
			?>
			<div class="row">
				<div class="col-md-12 col-form-label">
					<label>Class Type *</label>
					<select class="form-control" id="field_category" name="field_category" onchange="getPrefix();" required>
						<?php
						$result = $controller->getDropdowns(" (field_category LIKE 'CLASSTYPE') ");
						
						echo '<option value="">Select class type</option>';
						if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
							echo '<option value="'.$row['field_name'].'">'.$row['field_name'].'</option>';
						}} else {
							echo '<option value="">'.$result['1'].'</option>';
						}
						?>
					</select>
				</div>
				<div class="col-md-6 col-form-label" id="program-track">
					<label>Program Track *</label>
					<select class="form-control" id="program_track" name="program_track" onchange="changeStrands();" required>
						<option value="">Select track</option>
						<?php
						$result = $controller->getDropdowns(" field_category = 'TRACKS' ");
						
						if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
							echo '<option value="'.$row['field_name'].'">'.$row['field_ext'].'</Option>';
						}} else {
							echo '<option value="">'.$result['1'].'</Option>';
						}
						?>
					</select>
				</div>
				<div class="col-md-6 col-form-label" id="program-strand">
					<label>Program Strand *</label>
					<select class="form-control" id="program_strand" name="program_strand" onchange="chooseStrand();"required>
						<option value="">Select strand</option>
					</select>
				</div>
				<div class="col-md-12 col-form-label" id="program-combo">
					<label>Program Combo *</label>
					<input type="" class="form-control" id="program_combo" name="program_combo" required>
				</div>
				<div class="col-md-4 col-form-label" id="program-nameprefix">
					<label>Program Prefix *</label>
					<input type="text" class="form-control" id="field_nameprefix" name="field_nameprefix" readonly required>
				</div>
				<div class="col-md-8 col-form-label" id="program-fieldname">
					<label>Program Name *</label>
					<input type="text" class="form-control" id="field_name" name="field_name" placeholder="GENERAL" onkeyup="checkFieldName();" onfocus="checkFieldName();" required>
				</div>				
			</div>
			<script type="text/javascript">	
			setTimeout(function(){
				$('#program-track').hide();
				$('#program-strand').hide();
				$('#program-combo').hide();
				$('#program-nameprefix').hide();
				$('#program-fieldname').hide();		
			}, 1);
			
			function getPrefix(){
				var field_category = $('#field_category').val();
				
				if(field_category == 'Kindergarten'){
					$('#program-track').hide();
					$('#program-strand').hide();
					$('#program-combo').hide();
					$('#program-nameprefix').show();
					$('#program-fieldname').show();	
					$('#field_nameprefix').val('ES ');	
				}
				else if(field_category == 'Primary School'){	
					$('#program-track').hide();
					$('#program-strand').hide();
					$('#program-combo').hide();
					$('#program-nameprefix').show();
					$('#program-fieldname').show();	
					$('#field_nameprefix').val('ES ');					
				}
				else if(field_category == 'Junior High School'){
					$('#program-track').hide();
					$('#program-strand').hide();
					$('#program-combo').hide();
					$('#program-nameprefix').show();
					$('#program-fieldname').show();	
					$('#field_nameprefix').val('JHS ');	
				}
				else if(field_category == 'Senior High School'){
					$('#program-track').show();
					$('#program-strand').show();
					$('#program-nameprefix').show();
					$('#program-fieldname').show();	
					$('#field_nameprefix').val('SHS-');	
				}
			}
			</script>
			<?php	
			
		} else if($_POST['data']['1'] == "addSubject"){
			?>
			<div class="row">
				<div class="col-md-4 col-form-label">
					<label>Grade Level *</label>
					<select class="form-control" id="pros_level2" name="pros_level2" placeholder="" onchange="changeGradeLevel();" required>
						<option value="">Select grade level</option>
						<?php
						for($i = $min_level; $i <= $max_level; $i++){
							echo '<option value="'.$i.'">Grade '.$i.'</option>';
						}
						?>
					</select>
				</div>
				<div class="col-md-4 col-form-label">
					<label>Term *</label>
					<select class="form-control" id="pros_sem2" name="pros_sem2" placeholder="" onchange="updateSort();" required>
						<option value="">Select term</option>
						<option value="1">Sem 1</option>
						<option value="2">Sem 2</option>
						<option value="12">Full Year</option>
					</select>
				</div>
				<div class="col-md-4 col-form-label">				
					<label>Category *</label>
					<select class="form-control" id="pros_track2" name="pros_track2" placeholder="" onchange="updateSort();" required>
						<option value="" selected>Select category</option>
						<?php
						$result = $controller->loadCurrPrograms($data, "");
						
						if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
							echo '<option value="'.$row['field_name'].'">'.$row['field_name'].'</option>';
						}} else {
							echo '<option value="">'.$result['1'].'</option>';
						}
						?>
					</select>
				</div>
				
				<div class="col-md-4 col-form-label">
					<label>Subject Code *</label>
					<input type="text" class="form-control" id="pros_title2" name="pros_title2" placeholder="SCI 101" onkeyup="checkSubjectCode();" required>
				</div>
				<div class="col-md-8 col-form-label">
					<label>Subject Description *</label>
					<input type="text" class="form-control" id="pros_desc2" name="pros_desc2" placeholder="Introduction to Science" required>
				</div>
				<div class="col-md-2 col-form-label">
					<label>Unit(s) *</label>
					<input type="number" step=".01" min="0" max="20" class="form-control" id="pros_unit2" name="pros_unit2" placeholder="1.00" required>
				</div>
				<div class="col-md-2 col-form-label">
					<label>Hrs/Week *</label>
					<input type="number" step=".25" min="0" max="20" class="form-control" id="pros_hoursPerWk2" name="pros_hoursPerWk2" placeholder="4.00" required>
				</div>
				<div class="col-md-2 col-form-label">
					<label>Cut-off Grade *</label>
					<input type="number" min="50" max="80" class="form-control" id="pros_cutoff2" name="pros_cutoff2" placeholder="75.00" required>
				</div>
				<div class="col-md-6 col-form-label">
					<label>Pre-requisite(s) *</label>
					<input type="text" class="form-control" id="pros_prereq2" name="pros_prereq2" placeholder="SCI 100, MATH 100" required>
					<input type="hidden" class="form-control" id="pros_curr2" name="pros_curr2" placeholder="" required>
					<input type="hidden" class="form-control" id="pros_sort2" name="pros_sort2" placeholder="" required>
					<input type="hidden" class="form-control" id="pros_part2" name="pros_part2" placeholder="" value="1" required>
					
				</div>
			</div>
			<div class="row" id="modify-form">
				<div class="col-md-6 col-form-label">
				</div>
				<div class="col-md-3 col-form-label">
				</div>
				<div class="col-md-1 col-form-label">
					<label>Active?</label>
				</div>
				<div class="col-md-1 col-form-label">
					<input type="checkbox" class="form-control" id="pros_part3" name="pros_part3">
				</div>
				<div class="col-md-1 col-form-label">
					<button type="button" class="btn btn-danger" id="delete" name="delete" title="Delete subject" onclick="return confirm('Delete subject?') ? submitAction('deleteSubject') : false;"><i class="fas fa-trash-alt"></i></button>
				</div>
			</div>	
			<script type="text/javascript">	
				$('#modify-form').hide();
			</script>
			<?php
			
		} else if($_POST['data']['1'] == "modifySubject"){
			$result = $controller->getSubject($data);
			
			header("Content-Type: application/json");
			echo json_encode($result);

			exit();	
			
		}
		
	} else if($_POST['data']['0'] == "submitAction"){
		$data = array_values($_POST);
		
		if($_POST['data']['1'] == "addCurriculum"){
			$result = $controller->addCurriculum($data);
			
			header("Content-Type: application/json");
			echo json_encode($result);

			exit();	
			
		} else if($_POST['data']['1'] == "addProgram"){
			$result = $controller->addProgram($data);
			
			header("Content-Type: application/json");
			echo json_encode($result);

			exit();
			
		} else if($_POST['data']['1'] == "addSubject"){
			$result = $controller->addSubject($data);
			
			header("Content-Type: application/json");
			echo json_encode($result);

			exit();	
			
		} else if($_POST['data']['1'] == "modifySubject"){
			$result = $controller->modifySubject($data);
			
			header("Content-Type: application/json");
			echo json_encode($result);

			exit();	
			
		} else if($_POST['data']['1'] == "deleteSubject"){
			$result = $controller->deleteSubject($data);
			
			header("Content-Type: application/json");
			echo json_encode($result);

			exit();	
		}
		
	} else if($_POST['data']['0'] == "checkSY"){
		$data = array_values($_POST);
		$result = $controller->checkSY($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();		
		
	} else if($_POST['data']['0'] == "checkFieldName"){
		$data = array_values($_POST);
		$result = $controller->checkFieldName($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();		
		
	} else if($_POST['data']['0'] == "changeStrands"){
		$data = array_values($_POST);
		$program_track = $_POST['data']['1'];
		$result = $controller->getDropdowns(" field_category LIKE 'STRAND-$program_track%' ");
		
		echo '<option value="">Select strand</Option>';
		if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
			echo '<option value="'.$row['field_name'].'">'.$row['field_name'].'</Option>';
		}} else {
			echo '<option value="">'.$result['1'].'</Option>';
		}
		
	} else if($_POST['data']['0'] == "updateSort"){
		$data = array_values($_POST);
		$result = $controller->updateSort($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();		
		
	} else if($_POST['data']['0'] == "changeGradeLevel"){
		$data = array_values($_POST);
		$result = $controller->getDropdowns($data['0']['1']);
		
		echo '<option value="">Select category</Option>';
		if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
			echo '<option value="'.$row['field_name'].'">'.$row['field_name'].'</Option>';
		}} else {	
			echo '<option value="">'.$result['1'].'</Option>';
		}
		
	} else if($_POST['data']['0'] == "checkSubjectCode"){
		$data = array_values($_POST);
		$result = $controller->checkSubjectCode($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();		
		
	} else if($_POST['data']['0'] == "checkProspectusAssociation"){
		$data = array_values($_POST);
		$result = $controller->checkProspectusAssociation($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();		
		
	}
 
}
?>