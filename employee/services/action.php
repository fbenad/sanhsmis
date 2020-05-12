<?php
session_start();
require_once("../../config/dbconfig.php");
require_once("../../config/settings.php");
require_once("controller.php");

$controller = new Controller();

if(isset($_POST['data'])){	
	if($_POST['data']['0'] == "getBiometricID"){
		$data = array_values($_POST);		
		$result = $controller->getBiometricID($data);
				
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();
		
	} else if($_POST['data']['0'] == "getAttendanceMonths"){
		$data = array_values($_POST);		
		$result = $controller->getAttendanceMonths($data);
		
		if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
			echo '<option value="'.date('mY', strtotime($row['CHECKTIME'])).'">'.date('F, Y', strtotime($row['CHECKTIME'])).'</option>';
		}} else {
			echo '<option value="">'.$result['1'].'</option>';
		}
		
	} else if($_POST['data']['0'] == "changeActiveMonth"){
		$data = array_values($_POST);	

		if($data['0']['4'] == "getCurrentLogs"){
			$result = $controller->getCurrentLogs($data);
			
			$i = 1;
			if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
				$data2 = array(array("getRemarks", $row['teach_bio_no'], $row['CHECKTIME'], $row['CHECKTYPE']));
				$result2 = $controller->getRemarks($data2);
				
				if($result2['0'] == 1){ $row2 = $result2['2'];
					$remarks = $row2['ml_reason'];
				} else {
					$remarks = "";
				}
				
				echo '
				<tr>
					<td align="right">'.$i++.'</td>
					<td title="Log #'.$row['checkinout_no'].'">'.date('m/d/Y', strtotime($row['CHECKTIME'])).'</td>
					<td>'.date('D', strtotime($row['CHECKTIME'])).'</td>
					<td>'.date('h:i A', strtotime($row['CHECKTIME'])).'</td>
					<td><a href="javascript:void(0);" title="Toggle state In or Out" onclick="return confirm(\'Are you sure?\') ? toggleState('.$row['checkinout_no'].','.($row['CHECKTYPE'] == "I" ? 1 : 0).') : false;">
						<i class="fas fa-pen"></i>&nbsp;&nbsp;&nbsp; 
						</a>'.($row['CHECKTYPE'] == "I" ? "In" : "Out").'</td>
					<td>'.($row['sn'] == 0 ? "Web form" : "Machine").'</td>
					<td><p style="line-height: 0.7;"><small>'.($row['sn'] == 0 ? $remarks : "").'</small></p></td>
				</tr>';
			}} else {
				echo '<tr><td colspan="8">'.$result['1'].'</td></tr>';
			}
			
		} else if($data['0']['4'] == "getMissingLogs"){
			$result = $controller->getMissingLogs($data);
			
			$i = 1;
			if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
				$data2 = array(array("getApproverInfo", $row['ml_approve_user_no']));
				$result2 = $controller->getApproverInfo($data2);
				
				if($result2['0'] == 1){ $row2 = $result2['2'];
					$approver = $row2['teach_lname'].", ".substr($row2['teach_fname'], 0, 1).".";
					$approveDate = date('m/d/y h:i A', strtotime($row['ml_approve_regdatetime']));
				} else {
					$approver = ""; 
					$approveDate = ""; 
				}
				
				echo '
				<tr>
					<td align="right">'.$i++.'</td>
					<td title="'.$row['ml_no'].'">'.date('m/d/Y', strtotime($row['ml_checkdate'])).'</td>
					<td>'.date('h:i A', strtotime($row['ml_checktime'])).'</td>
					<td>'.($row['ml_checktype'] == "I" ? "In" : "Out").'</td>
					<td><small>'.date('m/d/y h:i A', strtotime($row['ml_apply_regdatetime'])).'</small></td>	
					<td><p style="line-height: 0.7;"><small>'.$row['ml_reason'].'</small></p></td>									
					<td><small>'.$approver.'</small></td>
					<td><small>'.$approveDate.'</small></td>
					<td><a href="javascript:void(0);" title="View missing log" rowID="'.$row['ml_no'].'" data-type="getMissingLog" 
						data-toggle="modal" data-target="#modal-input" data-backdrop="static" data-keyboard="false">
						<i class="fas fa-external-link-alt"></i></a>
					</td>
				</tr>';
			}} else {
				echo '<tr><td colspan="9">'.$result['1'].'</td></tr>';
			}			
		} 
		
	} else if($_POST['data']['0'] == "showAction"){
		$data = array_values($_POST);	
		
		if($data['0']['1'] == "addMissingLog"){
			?>
			<div class="form-group">
				<div class="row">
					<div class="col-md-4 col-form-label">
						<label>Date applied:</label>
					</div>
					<div class="col-md-8">
						<input type="date" class="form-control" id="ml_checkdate" name="ml_checkdate" placeholder="Enter applied date" min="<?php echo date('Y-m', strtotime('last month'))."-01";?>" max="<?php echo date('Y-m-d');?>" required autofocus>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-md-4 col-form-label">
						<label>Timestamp applied:</label>
					</div>
					<div class="col-md-8">
						<input type="time" class="form-control" id="ml_checktime" name="ml_checktime" placeholder="Enter applied time" min="<?php echo $office_timeIn;?>" max="<?php echo $office_timeOut;?>" required>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-md-4 col-form-label">
						<label>State:</label>
					</div>
					<div class="col-md-8">
						<select class="form-control" id="ml_checktype" name="ml_checktype" required>
							<option value="">Select state</option>
							<option value="I">In</option>
							<option value="O">Out</option>
						</select>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-md-4 col-form-label">
						<label>Reason:</label>
					</div>
					<div class="col-md-8">
					<textarea class="form-control" id="ml_reason" name="ml_reason" required></textarea>
					<input type="hidden" class="form-control" id="ml_no" name="ml_no">
					</div>
				</div>
			</div>
			<?php
			
		} else if($data['0']['1'] == "getMissingLog"){
			$result = $controller->getMissingLog($data);
			
			header("Content-Type: application/json");
			echo json_encode($result);

			exit();		
			
		} else if($data['0']['1'] == "addSALN"){
			?>
			<div class="form-group">
				<div class="row">
					<div class="col-md-12">
						<label>Filing Year *</label>
						<select class="form-control" id="teachSaln_issueyear" name="teachSaln_issueyear" required autofocus>
							<option value="">Select Filing Year</option>
							<?php
							$result = $controller->getFilingYear($data);
							
							if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
								echo '<option value="'.$row['settings_sy'].'">'.$row['settings_sy'].'</option>';
							}} else{
								echo '<option value="">'.$result['1'].'</option>';
							}
							?>
						</select>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-md-12">
						<label>Filing Type *</label>
						<select class="form-control" id="teachSaln_filetype" name="teachSaln_filetype" required>
							<option value="">Select Filing Type</option>
							<option value="1">Join (Both husband and wife are working in the goverment and files together)</option>
							<option value="2">Separate (Both husband and wife are working in the goverment but files separately)</option>
							<option value="3">Not applicable (Single or if spouse is not working in the government)</option>
						</select>
					</div>
				</div>
			</div>				
			<?php	
			
		} else if($data['0']['1'] == "addSpouse"){
			?>
			<div class="form-group">
				<div class="row">
					<div class="col-md-4">
						<label>Fistname *</label>
						<input type="text" class="form-control" id="teachCont_fname" name="teachCont_fname" placeholder="Juan" required autofocus>
					</div>
					<div class="col-md-3">
						<label>Middlename </label>
						<input type="text" class="form-control" id="teachCont_mname" name="teachCont_mname" placeholder="Mabini">
					</div>
					<div class="col-md-3">
						<label>Lastname *</label>
						<input type="text" class="form-control" id="teachCont_lname" name="teachCont_lname" placeholder="Dela Cruz" required>
					</div>
					<div class="col-md-2">
						<label>Ext. name </label>
						<select class="form-control" id="teachCont_xname" name="teachCont_xname">
							<option value="">N/A</option>
							<option value="JR">JR</option>
							<option value="SR">SR</option>
							<option value="II">II</option>
							<option value="III">III</option>
							<option value="IV">IV</option>
							<option value="V">V</option>
							<option value="VI">VI</option>
						</select>
					</div>
				</div>
			</div>		
			<div class="form-group">
				<div class="row">
					<div class="col-md-3">
						<label>Work Sector *</label>
						<select class="form-control" id="work_sector" name="work_sector" onchange="updateWorkSector();" required>
							<option value="">Select work sector</option>
							<option value="1">Public</option>
							<option value="2">Private</option>
						</select>
					</div>
					<div class="col-md-6">
						<label>Work Office / Agency</label>
						<input type="text" class="form-control" id="teachCont_office" name="teachCont_office" placeholder="<?php echo $sch_citymun;?> LGU" disabled>
					</div>					
					<div class="col-md-3">
						<label>Position</label>
						<input type="text" class="form-control" id="teachCont_position" name="teachCont_position" placeholder="Revenue Collector" disabled>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-md-12">
						<label>Work Address * <small>(Barangay, Municipality / City, Province)</small></label>
						<input type="text" class="form-control" id="teachCont_offadd" name="teachCont_offadd"placeholder="<?php echo $sch_address2.", ".$sch_citymun.", ".$sch_province;?>" disabled>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-md-4">
						<label>Gov't ID *</label>
						<input type="text" class="form-control" id="teachCont_govid" name="teachCont_govid" placeholder="GSIS" required>
					</div>
					<div class="col-md-4">
						<label>ID Number *</label>
						<input type="text" class="form-control" id="teachCont_idno" name="teachCont_idno" placeholder="0-61234567-8" required>
					</div>
					<div class="col-md-4">
						<label>Date Issued *</label>
						<input type="date" class="form-control" id="teachCont_issuedate" name="teachCont_issuedate" min="<?php echo date('Y-m-d', strtotime('-15 years'));?>" max="<?php echo date('Y-m-d');?>" required>
						<input type="hidden" class="form-control" id="teachCont_no" name="teachCont_no">
					</div>
				</div>
			</div>	
			<script type="text/javascript">	
				function updateWorkSector(){
					var sector = $('#work_sector').val();
					
					if(sector == "1"){
						$('#teachCont_office').removeAttr('disabled');
						$('#teachCont_position').removeAttr('disabled');
						$('#teachCont_offadd').removeAttr('disabled');	
						$('#teachCont_office').attr('required', 'required');
						$('#teachCont_position').attr('required', 'required');
						$('#teachCont_offadd').attr('required', 'required');						
					} else {
						$('#teachCont_office').attr('disabled', 'disabled');
						$('#teachCont_position').attr('disabled', 'disabled');
						$('#teachCont_offadd').attr('disabled', 'disabled');	
						$('#teachCont_office').removeAttr('required');
						$('#teachCont_position').removeAttr('required');
						$('#teachCont_offadd').removeAttr('required');	
					}
				}
			</script>
			<?php	
			
		} else if($data['0']['1'] == "getSpouse"){
			$result = $controller->getSpouse($data);
			
			header("Content-Type: application/json");
			echo json_encode($result);

			exit();		
			
		} else if($data['0']['1'] == "addDependent"){
			?>
			<div class="form-group">
				<div class="row">
					<div class="col-md-12">
						<label>Fistname *</label>
						<input type="text" class="form-control" id="teachCont_fname" name="teachCont_fname" placeholder="Juan" required autofocus>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-md-12">
						<label>Middlename </label>
						<input type="text" class="form-control" id="teachCont_mname" name="teachCont_mname" placeholder="Mabini">
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-md-12">
						<label>Lastname *</label>
						<input type="text" class="form-control" id="teachCont_lname" name="teachCont_lname" placeholder="Dela Cruz" required>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-md-6">
						<label>Ext. name </label>
						<select class="form-control" id="teachCont_xname" name="teachCont_xname">
							<option value="">N/A</option>
							<option value="JR">JR</option>
							<option value="SR">SR</option>
							<option value="II">II</option>
							<option value="III">III</option>
							<option value="IV">IV</option>
							<option value="V">V</option>
							<option value="VI">VI</option>
						</select>
					</div>
					<div class="col-md-6">
						<label>Birthday *</label>
						<input type="date" class="form-control" id="teachCont_bdate" name="teachCont_bdate" min="<?php echo date('Y-m-d', strtotime('-18 years'));?>" max="<?php echo date('Y-m-d');?>" required>
						<input type="hidden" class="form-control" id="teachCont_no" name="teachCont_no">
					</div>
				</div>
			</div>		
			<?php	
			
		} else if($data['0']['1'] == "getDependent"){
			$result = $controller->getDependent($data);
			
			header("Content-Type: application/json");
			echo json_encode($result);

			exit();		
			
		} else if($data['0']['1'] == "addReal"){
			?>
			<div class="form-group">
				<div class="row">
					<div class="col-md-6">
						<label>Description *</label>
						<select class="form-control" id="teachSalnDet_details0" name="teachSalnDet_details0" required autofocus>
							<option value="">Select description</option>
							<option value="CONDOMINIUM">CONDOMINIUM</option>
							<option value="HOUSE">HOUSE</option>
							<option value="IMPROVEMENTS">IMPROVEMENTS</option>
							<option value="LOT">LOT</option>
							<option value="TOWN HOUSES">TOWN HOUSES</option>
						</select>
					</div>
					<div class="col-md-6">
						<label>Kind *</label>
						<select class="form-control" id="teachSalnDet_details1" name="teachSalnDet_details1" required>
							<option value="">Select kind</option>
							<option value="RESIDENTIAL">RESIDENTIAL</option>
							<option value="COMMERCIAL">COMMERCIAL</option>
							<option value="INDUSTRIAL">INDUSTRIAL</option>
							<option value="AGRICULTURAL">AGRICULTURAL</option>
							<option value="MIXED USED">MIXED USED</option>
						</select>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-md-12">
						<label>Location * <small>(Barangay, Municipality, Province)</small></label>
						<input type="text" class="form-control" id="teachSalnDet_details2" name="teachSalnDet_details2" placeholder="<?php echo $sch_address2.", ".$sch_citymun.", ".$sch_province;?>" required>					
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-md-6">
						<label>Assessed Value **</label>
						<input type="number" step="0.01" class="form-control" id="teachSalnDet_details3" name="teachSalnDet_details3" min="0.00" placeholder="0.00" required>
						<label><small><small><small>** As reflected on the Tax Declaration of Real Property</small></small></small></label>
					</div>
					<div class="col-md-6">
						<label>Current Fair Market Value **</label>
						<input type="number" step="0.01" class="form-control" id="teachSalnDet_details4" name="teachSalnDet_details4" min="0.00" placeholder="0.00" required>
					</div>
				</div>
			</div>
			<div class="form-group" style="margin-top: -15px;">
				<div class="row">
					<div class="col-md-4">
						<label>Year of Acquisit'n *</label>
						<select class="form-control" id="teachSalnDet_details5" name="teachSalnDet_details5" required>
							<option value="">Select year</option>
							<?php
							$limit = date('Y');
							for($i = $limit; $i >= $limit-50; $i--){
								echo '<option value="'.$i.'">'.$i.'</option>';
							}
							?>
						</select>
					</div>
					<div class="col-md-4">
						<label>Mode of Acquisit'n *</label>
						<select class="form-control" id="teachSalnDet_details6" name="teachSalnDet_details6" required>
							<option value="">Select mode</option>
							<option value="DONATION">DONATION</option>
							<option value="INHERITANCE">INHERITANCE</option>
							<option value="PURCHASE">PURCHASE</option>
						</select>
					</div>
					<div class="col-md-4">
						<label>Acquisit'n Cost *</label>
						<input type="number" step="0.01" class="form-control" id="teachSalnDet_cost" name="teachSalnDet_cost" min="0" placeholder="0.00" required>
						<input type="hidden" class="form-control" id="teachSalnDet_no" name="teachSalnDet_no">
						<input type="hidden" class="form-control" id="teachSalnDet_teachSaln_no" name="teachSalnDet_teachSaln_no">
						<input type="hidden" class="form-control" id="teachSalnDet_type" name="teachSalnDet_type">
					</div>
				</div>
			</div>
			<?php		
			
		} else if($data['0']['1'] == "addPersonal"){
			?>
			<div class="form-group">
				<div class="row">
					<div class="col-md-12">
						<label>Description *</label>
						<input type="text" class="form-control" id="teachSalnDet_details0" name="teachSalnDet_details0" placeholder="Jewelries" required autofocus>					
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-md-6">
						<label>Year Acquired *</label>
						<select class="form-control" id="teachSalnDet_details1" name="teachSalnDet_details1" required>
							<option value="">Select year</option>
							<?php
							$limit = date('Y');
							for($i = $limit; $i >= $limit-50; $i--){
								echo '<option value="'.$i.'">'.$i.'</option>';
							}
							?>
						</select>
					</div>
					<div class="col-md-6">
						<label>Acquisit'n Cost *</label>
						<input type="number" step="0.01" class="form-control" id="teachSalnDet_cost" name="teachSalnDet_cost" min="0" placeholder="0.00" required>
						<input type="hidden" class="form-control" id="teachSalnDet_no" name="teachSalnDet_no">
						<input type="hidden" class="form-control" id="teachSalnDet_teachSaln_no" name="teachSalnDet_teachSaln_no">
						<input type="hidden" class="form-control" id="teachSalnDet_type" name="teachSalnDet_type">
					</div>
				</div>
			</div>
			<?php		
			
		} else if($data['0']['1'] == "addLiability"){
			?>
			<div class="form-group">
				<div class="row">
					<div class="col-md-12">
						<label>Nature *</label>
						<select class="form-control" id="teachSalnDet_details0" name="teachSalnDet_details0" required autofocus>	
							<option value="">Select nature of liability</option>
							<option value="CONTINGENT">CONTINGENT</option>
							<option value="LONG TERM">LONG TERM</option>
							<option value="SHORT TERM">SHORT TERM</option>
						</select>
						<label>
							<p style=" line-height: 0.7; ">
								<small><small>
								Short Term - payable within 1 year.<br>
								Long Term - payable more than 1 year.<br>
								Contingent - payable on the occurrence of some event or contingency.
								</small></small>
							</p>
						</label>
					</div>
				</div>
			</div>
			<div class="form-group" style="margin-top: -23px;">
				<div class="row">
					<div class="col-md-12">
						<label>Name of Creditor *</label>
						<input type="text" class="form-control" id="teachSalnDet_details1" name="teachSalnDet_details1" placeholder="First Consolidated Bank" required>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">			
					<div class="col-md-12">
						<label>Outstanding Balance *</label>
						<input type="number" step="0.01" class="form-control" id="teachSalnDet_cost" name="teachSalnDet_cost" min="1" placeholder="1.00" required>
						<input type="hidden" class="form-control" id="teachSalnDet_no" name="teachSalnDet_no">
						<input type="hidden" class="form-control" id="teachSalnDet_teachSaln_no" name="teachSalnDet_teachSaln_no">
						<input type="hidden" class="form-control" id="teachSalnDet_type" name="teachSalnDet_type">
					</div>
				</div>
			</div>
			<?php	
			
		} else if($data['0']['1'] == "addInterest"){
			?>
			<div class="form-group">
				<div class="row">
					<div class="col-md-12">
						<label>Name of Entity / Business Enterprise *</label>
						<input type="text" class="form-control" id="teachSalnDet_details0" name="teachSalnDet_details0" placeholder="Juan's Eatery" required autofocus>	
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-md-12">
						<label>Business Address * </label>
						<input type="text" class="form-control" id="teachSalnDet_details1" name="teachSalnDet_details1" placeholder="<?php echo $sch_citymun.", ".$sch_province;?>" required autofocus>	
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">			
					<div class="col-md-12">
						<label>Nature of Business Interest and/or Financial Connection*</label>
						<select type="text" class="form-control" id="teachSalnDet_details2" name="teachSalnDet_details2" required>
							<option value="">Select interest</option>
							<option value="CONSULTANT">CONSULTANT</option>
							<option value="CREDITOR">CREDITOR</option>
							<option value="EXECUTIVE">EXECUTIVE</option>
							<option value="INVESTOR">INVESTOR</option>
							<option value="LAWYER">LAWYER</option>
							<option value="MANAGING DIRECTOR">MANAGING DIRECTOR</option>
							<option value="OFFICER">OFFICER</option>
							<option value="PARTNER">PARTNER</option>
							<option value="PROMOTER">PROMOTER</option>
							<option value="PROPRIETOR">PROPRIETOR</option>
							<option value="SHAREHOLDER">SHAREHOLDER</option>
						</select>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-md-12">
						<label>Date of Acquisition on Interest or Connection *</label>
						<input type="date" class="form-control" id="teachSalnDet_details3" name="teachSalnDet_details3" min="<?php echo date('Y-m-d', strtotime('-50 years'));?>" max="<?php echo date('Y-m-d');?>" required>
						<input type="hidden" class="form-control" id="teachSalnDet_cost" name="teachSalnDet_cost">
						<input type="hidden" class="form-control" id="teachSalnDet_no" name="teachSalnDet_no">
						<input type="hidden" class="form-control" id="teachSalnDet_teachSaln_no" name="teachSalnDet_teachSaln_no">
						<input type="hidden" class="form-control" id="teachSalnDet_type" name="teachSalnDet_type">
					</div>
				</div>
			</div>
			<?php			
		} else if($data['0']['1'] == "addRelative"){
			?>
			<div class="form-group">
				<div class="row">
					<div class="col-md-12">
						<label>Name Relative *</label>
						<input type="text" class="form-control" id="teachSalnDet_details0" name="teachSalnDet_details0" placeholder="Juan M. Dela Cruz" required autofocus>	
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-md-6">
						<label>Relationship*</label>
						<select class="form-control" id="teachSalnDet_details1" name="teachSalnDet_details1" required>
							<option value="">Select relationship</option>
							<option value="CHILD">CHILD</option>
							<option value="PARENT">PARENT</option>
							<option value="GRANDCHILD">GRANDCHILD</option>
							<option value="BROTHER">BROTHER</option>
							<option value="SISTER">SISTER</option>
							<option value="GRANDPARENT">GRANDPARENT</option>
							<option value="GREAT GRANDCHILD">GREAT GRANDCHILD</option>
							<option value="NIECE">NIECE</option>
							<option value="NEPHEW">NEPHEW</option>
							<option value="AUNT">AUNT</option>
							<option value="UNCLE">UNCLE</option>
							<option value="GRAND NEPHEW">GRAND NEPHEW</option>
							<option value="GRAND NIECE">GRAND NIECE</option>
							<option value="FIRST COUSIN">FIRST COUSIN</option>
							<option value="GREAT UNCLE">GREAT UNCLE</option>
							<option value="GREAT AUNTIE">GREAT AUNTIE</option>
							<option value="GREAT GREAT GRANDPARENT">GREAT GREAT GRANDPARENT</option>
							<option value="SPOUSE">SPOUSE</option>
							<option value="PARENT-IN-LAW">PARENT-IN-LAW</option>
							<option value="DAUGHTER-IN-LAW">DAUGHTER-IN-LAW</option>
							<option value="SON-IN-LAW">SON-IN-LAW</option>
							<option value="GRANDPARENT-IN-LAW">GRANDPARENT-IN-LAW</option>
							<option value="BROTHER-IN-LAW">BROTHER-IN-LAW</option>
							<option value="SISTER-IN-LAW">SISTER-IN-LAW</option>
							<option value="GRANDCHILD-IN-LAW">GRANDCHILD-IN-LAW</option>
							<option value="GREAT GRANDPARENT-IN-LAW">GREAT GRANDPARENT-IN-LAW</option>
							<option value="UNCLE-IN-LAW">UNCLE-IN-LAW</option>
							<option value="FIRST COUSIN-IN-LAW">FIRST COUSIN-IN-LAW</option>
							<option value="NIECE-IN-LAW">NIECE-IN-LAW</option>
							<option value="NEPHEW-IN-LAW">NEPHEW-IN-LAW</option>
							<option value="GREAT GRANDCHILD-IN-LAW">GREAT GRANDCHILD-IN-LAW</option>
						</select>
					</div>
					<div class="col-md-6">
						<label>Position *</label>
						<input type="text" class="form-control" id="teachSalnDet_details2" name="teachSalnDet_details2" placeholder="Revenue Collector" required>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">			
					<div class="col-md-12">
						<label>Name / Address of Agency *</label>
						<input type="text" class="form-control" id="teachSalnDet_details3" name="teachSalnDet_details3" placeholder="<?php echo $sch_citymun;?> LGU / <?php echo $sch_citymun.", ".$sch_province;?>" required>
						<input type="hidden" class="form-control" id="teachSalnDet_cost" name="teachSalnDet_cost">
						<input type="hidden" class="form-control" id="teachSalnDet_no" name="teachSalnDet_no">
						<input type="hidden" class="form-control" id="teachSalnDet_teachSaln_no" name="teachSalnDet_teachSaln_no">
						<input type="hidden" class="form-control" id="teachSalnDet_type" name="teachSalnDet_type">
					</div>
				</div>
			</div>

			<?php	
			
		} else if($data['0']['1'] == "getSALNDetails"){
			$result = $controller->getSALNDetails($data);
			$result2 = array($result['0'], $result['1'], $result['2'], $result['3'], unserialize($result['2']['teachSalnDet_details']));
			
			header("Content-Type: application/json");
			echo json_encode($result2);

			exit();		
			
		}
		
	} else if($_POST['data']['0'] == "inputAction"){
		$data = array_values($_POST);	

		if($data['0']['1'] == "addMissingLog"){
			$result = $controller->addMissingLog($data);
			
			header("Content-Type: application/json");
			echo json_encode($result);

			exit();
			
		} else if($data['0']['1'] == "modifyMissingLog"){
			$result = $controller->modifyMissingLog($data);
			
			header("Content-Type: application/json");
			echo json_encode($result);

			exit();
			
		} else if($data['0']['1'] == "addSALN"){
			$result = $controller->addSALN($data);

			header("Content-Type: application/json");
			echo json_encode($result);

			exit();
			
		} else if($data['0']['1'] == "addSpouse"){
			$result = $controller->addSpouse($data);

			header("Content-Type: application/json");
			echo json_encode($result);
	
			exit();
			
		} else if($data['0']['1'] == "modifySpouse"){
			$result = $controller->modifySpouse($data);

			header("Content-Type: application/json");
			echo json_encode($result);
	
			exit();
			
		} else if($data['0']['1'] == "addDependent"){
			$result = $controller->addDependent($data);

			header("Content-Type: application/json");
			echo json_encode($result);
	
			exit();
			
		} else if($data['0']['1'] == "modifyDependent"){
			$result = $controller->modifyDependent($data);

			header("Content-Type: application/json");
			echo json_encode($result);
	
			exit();
			
		} else if($data['0']['1'] == "addReal" || $data['0']['1'] == "addPersonal" || $data['0']['1'] == "addLiability" || $data['0']['1'] == "addInterest" || $data['0']['1'] == "addRelative"){
			$result = $controller->addSALNDetails($data);

			header("Content-Type: application/json");
			echo json_encode($result);
	
			exit();
			
		} else if($data['0']['1'] == "modifyReal" || $data['0']['1'] == "modifyPersonal" || $data['0']['1'] == "modifyLiability" || $data['0']['1'] == "modifyInterest" || $data['0']['1'] == "modifyRelative"){
			$result = $controller->modifySALNDetails($data);

			header("Content-Type: application/json");
			echo json_encode($result);
	
			exit();
			
		}
		 
	} else if($_POST['data']['0'] == "deleteAction"){
		$data = array_values($_POST);	
		$result = $controller->deleteAction($data);

		header("Content-Type: application/json");
		echo json_encode($result);

		exit();
		
	} else if($_POST['data']['0'] == "toggleState"){
		$data = array_values($_POST);	
		$result = $controller->toggleState($data);

		header("Content-Type: application/json");
		echo json_encode($result);

		exit();
		
	} else if($_POST['data']['0'] == "getSALNs"){
		$data = array_values($_POST);	
		$result = $controller->getSALNs($data);
		
		$i = 1;
		if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
			$teachSaln_filetype = ($row['teachSaln_filetype'] == 1 ? "Joint" : ($row['teachSaln_filetype'] == 2 ? "Separate" : "Not Applicable"));
			$teachSaln_moduser = $row['teach_lname'].", ".substr($row['teach_fname'],0,1).".";
			$teachSaln_status = ($row['teachSaln_status'] == 1 ? "Open" : ($row['teachSaln_status'] == 2 ? "In progress" : "Completed"));
			echo'
			<tr>
				<td align="right">'.$i++.'</td>
				<td align="right" title="SALN #'.$row['teachSaln_no'].'">'.$row['teachSaln_issueyear'].'</td>
				<td>'.$teachSaln_filetype.'</td>
				<td align="right"><strong>'.($row['teachSaln_status'] == 3 ? number_format($row['teachSaln_networth'],2) : "-").'</strong></td>
				<td><small>'.date('m/d/y h:i A', strtotime($row['teachSaln_moddatetime'])).'</small></td>	
				<td><small>'.$teachSaln_moduser.'<small></td>
				<td>'.$teachSaln_status.'</td>
				<td><a href="javascript:void(0);" title="View SALN" onclick="showSALNDetails('.$row['teachSaln_no'].');">
					<i class="fas fa-external-link-alt"></i></a>';
					if($row['teachSaln_status'] == 3){					
						echo'
						&nbsp;<a href="javascript:void(0);" title="Print SALN" 
							onclick="window.open(\'../reports/pdf_saln.php?id='.$row['teachSaln_no'].'\', \'newwindow\', \'width=850, height=550\'); return false;">
							<i class="fas fa-print"></i>
						</a>';
					}
					echo '
				</td>
			</tr>';
		}} else {
			echo '<tr><td colspan="8">'.$result['1'].'</td></tr>';
		}
		
	} else if($_POST['data']['0'] == "showSALNDetails"){
		$data = array_values($_POST);	
		$result = $controller->showSALNDetails($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();
		
	} else if($_POST['data']['0'] == "displaySALNParts"){
		$data = array_values($_POST);
		
		if($data['0']['1'] == "showPart0"){
			?>
			<div class="card-body">
				<div class="row">
					<div class="col-md-3">
						<strong>Filing Type</strong>
						<p>
							<input type="radio" class="form-control-xs" id="teachSaln_filetype" name="teachSaln_filetype" onclick="updateSALNType(1);" value="1"> Joint<br>
							<input type="radio" class="form-control-xs" id="teachSaln_filetype" name="teachSaln_filetype" onclick="updateSALNType(2);" value="2"> Separate<br>
							<input type="radio" class="form-control-xs" id="teachSaln_filetype" name="teachSaln_filetype" onclick="updateSALNType(3);" value="3"> Not applicable<br>
						</p>
					</div>
					<div class="col-md-3">
						<strong>Filing Status</strong>
						<p>
							<input type="radio" class="form-control-xs" id="teachSaln_status" name="teachSaln_status" value="1" disabled> Open<br>
							<input type="radio" class="form-control-xs" id="teachSaln_status" name="teachSaln_status" value="2" disabled> In progress<br>
							<input type="radio" class="form-control-xs" id="teachSaln_status" name="teachSaln_status" value="3" disabled> Completed<br>
						</p>					
					</div>
					<div class="col-md-3">
						<!--
						<strong>Recycle Previous Year SALN</strong>
						<p>
							<button type="button" class="form-control btn-info" style="width: 20%;" id="saln_recycle" name="saln_recycle"> <i class="fas fa-recycle"></i></button>
						</p>	
						-->
					</div>
					<div class="col-md-3">
						<p><br>
							<button type="button" title="Finalize to lock SALN" class="btn btn-info btn-lg" style="width: 100%; color: white;" id="saln_finalize" name="saln_finalize" onclick="return confirm('Are you sure?') ? finalizeSALN(3) : false;">Finalize</button>
						</p>
					</div>
				</div>
			</div>
			<?php
		} else if($_POST['data']['1'] == "showPart1"){
			?>
			<div class="card-body">
				<div class="row">
					<div class="col-md-6">
						<strong>Declarant</strong>
						<p>
						<table>
							<tr>
								<td colspan="2">
									<strong><?php echo strtoupper($_POST['data']['2']['teach_lname'].", ".$_POST['data']['2']['teach_fname'].", ".($_POST['data']['2']['teach_xname'] == "" ? "" : $_POST['data']['2']['teach_xname'].",")." ".$_POST['data']['2']['teach_mname']);?></strong>
								</td></tr>
							<tr>
								<td valign="top"><i class="fas fa-map-marker-alt" title="Position"></i></td>
								<td><?php echo strtoupper($_POST['data']['2']['teach_residence']);?></td>
							</tr>
							<?php
							$data = array(array('getPosition',$_SESSION['user_no']));
							$result = $controller->getPosition($data);
							
							if($result['0'] == 1){ $row = $result['2']->fetch_assoc();
								$position = substr($row['field_ext'], 2);
							} else {
								$position = $result['1'];
							}
							?>
							<tr>
								<td valign="top"><i class="fas fa-briefcase" title="Position"></i></td>
								<td><?php  echo strtoupper($position);?></td>
							</tr>
							<tr>
								<td valign="top"><i class="fas fa-building" title="Office/Agency"></i></td>
								<td><?php echo strtoupper($sch_fullname);?></td>
							</tr>
							<tr>
								<td valign="top"><i class="fas fa-map-marked-alt" title="Office/Agency Address"></i></td>
								<td><?php echo strtoupper($sch_citymun.", ".$sch_province);?></td>
							</tr>
							<?php
							$data = array(array('getID',$_SESSION['user_no']));
							$result = $controller->getID($data);
							
							if($result['0'] == 1){ $row = $result['2']->fetch_assoc();
								$id = $row['teacherids_id']." / ".$row['teacherids_details']." / ".date('M d, Y', strtotime($row['teacherids_date_issued']));
							} else {
								$id = $result['1'];
							}
							?>
							<tr>
								<td valign="top"><i class="fas fa-id-badge" title="Submitted ID"></i></td>
								<td><?php echo $id;?></td>
							</tr>
						</table>
						</p>
					</div>
					<div class="col-md-6">
						<strong>Spouse</strong>
						<p>
							<?php
							$data = array(array('', '', $_SESSION['user_no'], 1));
							$result = $controller->showPart12($data);
							
							if($result['0'] == 1){ $row = $result['2']->fetch_assoc();
								echo'
								<table>
									<tr>
										<td colspan="2">
											<strong>'.strtoupper($row['teachCont_lname'].", ".$row['teachCont_fname'].($row['teachCont_xname'] == "" ? "" : ", ".$row['teachCont_xname']).", ".$row['teachCont_mname']).'</strong>
											&nbsp;<a href="javascript:void(0);" id="edit-button" title="Modify spouse" rowID="'.$row['teachCont_no'].'" data-type="modifySpouse" 
												data-toggle="modal" data-target="#modal-input" data-backdrop="static" data-keyboard="false">
												<i class="fas fa-pen"></i>
											</a>
										</td>
									</tr>';
									if($row['teachCont_position'] != "") {
									echo '
									<tr>
										<td valign="top"><i class="fas fa-briefcase" title="Position"></i></td> 
										<td>'.strtoupper($row['teachCont_position']).'</td>
									</tr>
									<tr>
										<td valign="top"><i class="fas fa-building" title="Office/Agency"></i></td>
										<td>'.strtoupper($row['teachCont_office']).'</td>
									</tr>
									<tr>
										<td valign="top"><i class="fas fa-map-marked-alt" title="Office/Agency Address"></i></td>
										<td>'.strtoupper($row['teachCont_offadd']).'</td>
									</tr>';
									}
									echo '
									<tr>
										<td valign="top"><i class="fas fa-id-badge" title="Submitted ID"></i></td>
										<td>'.strtoupper($row['teachCont_govid'])." / ".strtoupper($row['teachCont_idno'])." /  ".strtoupper($row['teachCont_issuedate']).'</td>
									</tr>
								</table>';
							} else {
								echo '
								<p>
									<a href="javascript:void(0);" id="add-button" title="Add spouse" rowID="0" data-type="addSpouse" 
										data-toggle="modal" data-target="#modal-input" data-backdrop="static" data-keyboard="false">
										<i class="fas fa-user-plus"></i>
									</a>
								</p>';
							}
							?>				
						</p>					
					</div>
				</div>
			</div>
			<?php			
		} else if($_POST['data']['1'] == "showPart2"){
			$result = $controller->showPart12($data);
			
			if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
				$diff = abs(strtotime(date('Y-m-d')) - strtotime($row['teachCont_bdate']));
				$age = floor($diff / (365*60*60*24));  
				echo '
				<tr>
					<td>'.strtoupper($row['teachCont_lname'].", ".$row['teachCont_fname'].($row['teachCont_xname'] == "" ? "" : ", ".$row['teachCont_xname']).", ".$row['teachCont_mname']).'</td>
					<td>'.date('M d, Y', strtotime($row['teachCont_bdate'])).'</td>
					<td>'.$age.'</td>
					<td><a href="javascript:void(0);" id="edit-button" title="Modify dependent #'.$row['teachCont_no'].'" rowID="'.$row['teachCont_no'].'" data-type="modifyDependent" 
							data-toggle="modal" data-target="#modal-input" data-backdrop="static" data-keyboard="false">
							<i class="fas fa-pen"></i></a>
					</td>
				</tr>';				
			}} else {
				echo '<tr><td colspan="4">'.$result['1'].'</td></tr>';
			}
			
		} else if($_POST['data']['1'] == "showPart3a"){
			$result = $controller->showPart345($data);
			
			if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
				$teachSalnDet_details = unserialize($row['teachSalnDet_details']);
				echo '
				<tr>
					<td>'.strtoupper($teachSalnDet_details['0']).'</td>
					<td>'.strtoupper($teachSalnDet_details['1']).'</td>
					<td><p style="line-height: 0.8;"><small>'.strtoupper($teachSalnDet_details['2']).'</small></p></td>
					<td align="right">'.number_format($teachSalnDet_details['3'], 2).'</td>
					<td align="right">'.number_format($teachSalnDet_details['4'], 2).'</td>
					<td>'.strtoupper($teachSalnDet_details['5']).'</td>
					<td>'.strtoupper($teachSalnDet_details['6']).'</td>
					<td align="right">'.number_format($row['teachSalnDet_cost'], 2).'</td>
					<td><a href="javascript:void(0);" id="edit-button" title="Modify real property #'.$row['teachSalnDet_no'].'" rowID="'.$row['teachSalnDet_no'].'" data-type="modifyReal" 
							data-toggle="modal" data-target="#modal-input" data-backdrop="static" data-keyboard="false">
							<i class="fas fa-pen"></i></a>
					</td>
				</tr>';
				$totalCostA += $row['teachSalnDet_cost'];
			}
				echo '
				<tr>
					<td colspan="7" align="right"><strong>Subtotal</strong></td>
					<td align="right"><strong>'.number_format($totalCostA, 2).'</strong></td>
					<td></td>
				</tr>';
			} else {
				echo '<tr><td colspan="9">'.$result['1'].'</td></tr>';
			}			
		
		} else if($_POST['data']['1'] == "showPart3b"){
			$result = $controller->showPart345($data);
			
			if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
				$teachSalnDet_details = unserialize($row['teachSalnDet_details']);
				echo '
				<tr>
					<td>'.strtoupper($teachSalnDet_details['0']).'</td>
					<td>'.strtoupper($teachSalnDet_details['1']).'</td>
					<td align="right">'.number_format($row['teachSalnDet_cost'], 2).'</td>
					<td><a href="javascript:void(0);" id="edit-button" title="Modify personal property #'.$row['teachSalnDet_no'].'" rowID="'.$row['teachSalnDet_no'].'" data-type="modifyPersonal" 
							data-toggle="modal" data-target="#modal-input" data-backdrop="static" data-keyboard="false">
							<i class="fas fa-pen"></i></a>
					</td>
				</tr>';
				$totalCostB += $row['teachSalnDet_cost'];
			}					
				echo '
				<tr>
					<td colspan="2" align="right"><strong>Subtotal</strong></td>
					<td align="right"><strong>'.number_format($totalCostB, 2).'</strong></td>
					<td></td>
				</tr>';
				
				$result2 = $controller->getTotalPartIII($data, 1);
				
				if($result2['0'] == 1){ $row2 = $result2['2'];
					$totalCostA = $row2['totalCost'];
				} else {
					$totalCostA = $result2['1'];
				}
				
				echo'
				<tr>
					<td colspan="2" align="right"><strong>TOTAL ASSETS (a+b)</strong></td>
					<td align="right"><strong>'.number_format($totalCostA + $totalCostB, 2).'</strong></td>
					<td></td>
				</tr>';
			} else {
				echo '<tr><td colspan="4">'.$result['1'].'</td></tr>';
			}	
			
		} else if($_POST['data']['1'] == "showPart3c"){
			$result = $controller->showPart345($data);
			
			if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
				$teachSalnDet_details = unserialize($row['teachSalnDet_details']);
				echo '
				<tr>
					<td>'.strtoupper($teachSalnDet_details['0']).'</td>
					<td>'.strtoupper($teachSalnDet_details['1']).'</td>
					<td align="right">'.number_format($row['teachSalnDet_cost'], 2).'</td>
					<td><a href="javascript:void(0);" id="edit-button" title="Modify liability #'.$row['teachSalnDet_no'].'" rowID="'.$row['teachSalnDet_no'].'" data-type="modifyLiability" 
							data-toggle="modal" data-target="#modal-input" data-backdrop="static" data-keyboard="false">
							<i class="fas fa-pen"></i></a>
					</td>
				</tr>';
				$totalCostC += $row['teachSalnDet_cost'];
			}	
				echo '
				<tr>
					<td colspan="2" align="right"><strong>Subtotal</strong></td>
					<td align="right"><strong>'.number_format($totalCostC, 2).'</strong></td>
					<td></td>
				</tr>';
				
				$result2 = $controller->getTotalPartIII($data, 1);
				
				if($result2['0'] == 1){ $row2 = $result2['2'];
					$totalCostA = $row2['totalCost'];
				} else {
					$totalCostA = $result2['1'];
				}	
				
				$result2 = $controller->getTotalPartIII($data, 2);
				
				if($result2['0'] == 1){ $row2 = $result2['2'];
					$totalCostB = $row2['totalCost'];
				} else {
					$totalCostB = $result2['1'];
				}					
				echo '
				<tr>
					<td colspan="2" align="right"><strong>NET WORTH: Total Assets less Total Liabilities</strong></td>
					<td align="right"><strong>'.number_format($totalCostA + $totalCostB - $totalCostC, 2).'</strong></td>
					<td></td>
				</tr>';			
			} else {
				echo '<tr><td colspan="4">'.$result['1'].'</td></tr>';
			}	
			
		} else if($_POST['data']['1'] == "showPart4"){
			$result = $controller->showPart345($data);

			if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
				$teachSalnDet_details = unserialize($row['teachSalnDet_details']);
				echo '
				<tr>
					<td>'.strtoupper($teachSalnDet_details['0']).'</td>
					<td>'.strtoupper($teachSalnDet_details['1']).'</td>
					<td>'.strtoupper($teachSalnDet_details['2']).'</td>
					<td>'.strtoupper($teachSalnDet_details['3']).'</td>
					<td><a href="javascript:void(0);" id="edit-button" title="Modify business interest #'.$row['teachSalnDet_no'].'" rowID="'.$row['teachSalnDet_no'].'" data-type="modifyInterest" 
							data-toggle="modal" data-target="#modal-input" data-backdrop="static" data-keyboard="false">
							<i class="fas fa-pen"></i></a>
					</td>
				</tr>';
			}} else {
				echo '<tr><td colspan="5">'.$result['1'].'</td></tr>';
			}	
			
		} else if($_POST['data']['1'] == "showPart5"){
			$result = $controller->showPart345($data);

			if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
				$teachSalnDet_details = unserialize($row['teachSalnDet_details']);
				echo '
				<tr>
					<td>'.strtoupper($teachSalnDet_details['0']).'</td>
					<td>'.strtoupper($teachSalnDet_details['1']).'</td>
					<td>'.strtoupper($teachSalnDet_details['2']).'</td>
					<td>'.strtoupper($teachSalnDet_details['3']).'</td>
					<td><a href="javascript:void(0);" id="edit-button" title="Modify relative #'.$row['teachSalnDet_no'].'" rowID="'.$row['teachSalnDet_no'].'" data-type="modifyRelative" 
							data-toggle="modal" data-target="#modal-input" data-backdrop="static" data-keyboard="false">
							<i class="fas fa-pen"></i></a>
					</td>
				</tr>';
			}} else {
				echo '<tr><td colspan="5">'.$result['1'].'</td></tr>';
			}				
		}
		
	} else if($_POST['data']['0'] == "updateSALNType"){
		$data = array_values($_POST);
		$result = $controller->updateSALNType($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();		
		
	} else if($_POST['data']['0'] == "setSession"){
		$_SESSION['saln_no'] =  $_POST['data']['1'];
		
	} else if($_POST['data']['0'] == "finalizeSALN"){
		$data = array_values($_POST);
		
		$resultA = $controller->getTotalPartIII($data, 1);
		
		if($resultA['0'] == 1){ $rowA = $resultA['2'];
			$totalCostA = $rowA['totalCost'];
		} else {
			$totalCostA = $resultA['1'];
		}
		
		$resultB = $controller->getTotalPartIII($data, 2);
		
		if($resultB['0'] == 1){ $rowB = $resultB['2'];
			$totalCostB = $rowB['totalCost'];
		} else {
			$totalCostB = $resultB['1'];
		}
		
		$resultC = $controller->getTotalPartIII($data, 3);
		
		if($resultC['0'] == 1){ $rowC = $resultC['2'];
			$totalCostC = $rowC['totalCost'];
		} else {
			$totalCostC = $resultC['1'];
		}
		
		$totalCost = $totalCostA + $totalCostB - $totalCostC;
		
		$result = $controller->finalizeSALN($data, $totalCost);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();		
		
	}
	
}
?>

