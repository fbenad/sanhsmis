<?php
/*
 * Controller Class 
 * This class is used for Employee-Services operations
 * @author    	Fernando B. Enad
 * @url        	n/a
 * @license    	n/a
 */
 
class Controller{
	
	function getBiometricID($data){
		global $conn;
		$result = null;	
		$teach_no = $data['0']['1'];
		
		$sql = "SELECT * FROM teacher
			WHERE (teach_no = '$teach_no')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1,$conn->error);
		} else if($rs->num_rows == 0){
			$result = array(0, "0 record(s) found.");
		} else {
			$result = array(1, $rs->num_rows . " record(s) found.", $rs->fetch_assoc(), $rs->num_rows);
		}	
		
		return $result;			
	}
	
	
	function getAttendanceMonths($data){
		global $conn;
		$result = null;	
		$teach_no = $data['0']['1'];
		
		$sql = "SELECT * FROM checkinout 
			INNER JOIN teacher ON USERID = teach_bio_no
			WHERE (teach_no = '$teach_no') 
			GROUP BY YEAR(CHECKTIME), MONTH(CHECKTIME)
			ORDER BY YEAR(CHECKTIME) DESC, MONTH(CHECKTIME) DESC";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1,$conn->error);
		} else if($rs->num_rows == 0){
			$result = array(0, "0 record(s) found.");
		} else {
			$result = array(1, $rs->num_rows . " record(s) found.", $rs, $rs->num_rows);
		}	
		
		return $result;			
	}
	
	
	function getCurrentLogs($data){
		global $conn;
		$result = null;	
		$teach_no = $data['0']['1'];
		$year = $data['0']['2'];
		$month = $data['0']['3'];		
		$lowerLimit = $year."-".$month."-00";
		$upperLimit	= $year."-".$month."-31";	
		
		$sql = "SELECT * FROM checkinout 
			INNER JOIN teacher ON USERID = teach_bio_no
			WHERE ((CHECKTIME BETWEEN '$lowerLimit' AND '$upperLimit')
				AND teach_no = '$teach_no') 
			ORDER BY CHECKTIME ASC";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1,$conn->error);
		} else if($rs->num_rows == 0){
			$result = array(0, "0 record(s) found.");
		} else {
			$result = array(1, $rs->num_rows . " record(s) found.", $rs, $rs->num_rows);
		}	
		
		return $result;			
	}
	
	
	function getMissingLogs($data){
		global $conn;
		$result = null;	
		$teach_no = $data['0']['1'];
		$year = $data['0']['2'];
		$month = $data['0']['3'];		
		$lowerLimit = $year."-".$month."-00";
		$upperLimit	= $year."-".$month."-31";	
		
		$sql = "SELECT * FROM missinglogs 
			INNER JOIN teacher ON ml_userid = teach_bio_no
			WHERE ((ml_checkdate BETWEEN '$lowerLimit' AND '$upperLimit')
				AND teach_no = '$teach_no') 
			ORDER BY ml_checkdate ASC, ml_checktime ASC";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1,$conn->error);
		} else if($rs->num_rows == 0){
			$result = array(0, "0 record(s) found.");
		} else {
			$result = array(1, $rs->num_rows . " record(s) found.", $rs, $rs->num_rows);
		}	
		
		return $result;			
	}
	
	
	function getRemarks($data){
		global $conn;
		$result = null;	
		$ml_userid = $data['0']['1'];
		$ml_checkdate = date('Y-m-d', strtotime($data['0']['2']));
		$ml_checktime = date('H:i:s', strtotime($data['0']['2']));
		$ml_checktype = $data['0']['3'];
		
		$sql = "SELECT * FROM missinglogs 
			WHERE (ml_userid = '$ml_userid'
				AND ml_checkdate = '$ml_checkdate'
				AND ml_checktime = '$ml_checktime'
				AND ml_checktype = '$ml_checktype')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1,$conn->error);
		} else if($rs->num_rows == 0){
			$result = array(0, "0 record(s) found.");
		} else {
			$result = array(1, $rs->num_rows . " record(s) found.", $rs->fetch_assoc(), $rs->num_rows);
		}	
		
		return $result;				
	}
	
	
	function getApproverInfo($data){
		global $conn;
		$result = null;	
		$teach_no = $data['0']['1'];
		
		$sql = "SELECT * FROM teacher 
			WHERE (teach_no = '$teach_no')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1,$conn->error);
		} else if($rs->num_rows == 0){
			$result = array(0, "0 record(s) found.");
		} else {
			$result = array(1, $rs->num_rows . " record(s) found.", $rs->fetch_assoc(), $rs->num_rows);
		}	
		
		return $result;				
	}
	
	
	function addMissingLog($data){
		global $conn;
		$result = null;	
		$ml_userid = $data['0']['2'];
		$ml_checkdate = $data['0']['3'];
		$ml_checktime = $data['0']['4'];
		$ml_checktype = $data['0']['5'];
		$ml_reason = mysqli_real_escape_string($conn, trim($data['0']['6']));
		$ml_approve_user_no = $data['0']['7'];

		$sql = "INSERT INTO missinglogs(ml_userid, ml_checkdate, ml_checktime, ml_checktype, ml_reason, ml_apply_user_no, ml_apply_regdatetime)
			VALUES('$ml_userid', '$ml_checkdate', '$ml_checktime', '$ml_checktype', '$ml_reason', '$ml_approve_user_no', NOW())";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1,$conn->error);
		} else {
			$result = array(1, "Record(s) added.");
		}	
		
		return $result;			
	}
	
	
	function getMissingLog($data){
		global $conn;
		$result = null;	
		$ml_no = $data['0']['2'];
		
		$sql = "SELECT * FROM missinglogs 
			WHERE (ml_no = '$ml_no')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1,$conn->error);
		} else if($rs->num_rows == 0){
			$result = array(0, "0 record(s) found.");
		} else {
			$result = array(1, $rs->num_rows . " record(s) found.", $rs->fetch_assoc(), $rs->num_rows);
		}	
		
		return $result;				
	}
	
	
	function modifyMissingLog($data){
		global $conn;
		$result = null;	
		$ml_checkdate = $data['0']['3'];
		$ml_checktime = $data['0']['4'];
		$ml_checktype = $data['0']['5'];
		$ml_reason = mysqli_real_escape_string($conn, trim($data['0']['6']));
		$ml_no = $data['0']['7'];

		$sql = "UPDATE missinglogs
			SET	ml_checkdate = '$ml_checkdate', 
				ml_checktime = '$ml_checktime', 
				ml_checktype = '$ml_checktype', 
				ml_reason = '$ml_reason'
			WHERE (ml_no = '$ml_no')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1,$conn->error);
		} else {
			$result = array(1, "Record(s) updated.");
		}	
		
		return $result;				
	}
	
	
	function deleteAction($data){
		global $conn;
		$result = null;	
		$option = $data['0']['1'];

		$sql = "DELETE FROM $option";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1,$conn->error);
		} else {
			$result = array(1, "Record(s) deleted.");
		}	
		
		return $result;			
	}
	
	
	function toggleState($data){
		global $conn;
		$result = null;	
		$checkinout_no  = $data['0']['1'];
		$CHECKTYPE  = $data['0']['2'];

		$sql = "UPDATE checkinout
			SET CHECKTYPE = '$CHECKTYPE'
			WHERE (checkinout_no = '$checkinout_no')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1,$conn->error);
		} else {
			$result = array(1, "Record(s) updated.");
		}	
		
		return $result;				
	}
	
	
	function getSALNs($data){
		global $conn;
		$result = null;	
		$teachSaln_teach_no = $data['0']['1'];
		
		$sql = "SELECT * FROM teachsaln 
			INNER JOIN teacher ON teachSaln_teach_no = teach_no
			WHERE (teachSaln_teach_no = '$teachSaln_teach_no')
			ORDER BY teachSaln_issueyear DESC";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1,$conn->error);
		} else if($rs->num_rows == 0){
			$result = array(0, "0 record(s) found.");
		} else {
			$result = array(1, $rs->num_rows . " record(s) found.", $rs, $rs->num_rows);
		}	
		
		return $result;				
	}
	
	
	function showSALNDetails($data){
		global $conn;
		$result = null;	
		$teachSaln_no = $data['0']['1'];
		
		$sql = "SELECT * FROM teachsaln 
			INNER JOIN teacher ON teachSaln_teach_no = teach_no
			WHERE (teachSaln_no = '$teachSaln_no')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1,$conn->error);
		} else if($rs->num_rows == 0){
			$result = array(0, "0 record(s) found.");
		} else {
			$result = array(1, $rs->num_rows . " record(s) found.", $rs->fetch_assoc(), $rs->num_rows);
		}	
		
		return $result;				
	}
	
	
	function updateSALNType($data){
		global $conn;
		$result = null;	
		$teachSaln_no = $data['0']['1'];
		$teachSaln_filetype = $data['0']['2'];
		$user_no = $data['0']['3'];
		
		$sql = "UPDATE teachsaln 
			SET teachSaln_filetype = '$teachSaln_filetype',
				teachSaln_moduser = '$user_no'
			WHERE (teachSaln_no = '$teachSaln_no')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1,$conn->error);
		} else {
			$result = array(1, "Record(s) updated.");
		}	
		
		return $result;			
	}


	function showPart12($data){
		global $conn;
		$result = null;	
		$teachCont_teach_no = $data['0']['2'];
		$teachCont_type = $data['0']['3'];
		
		$sql = "SELECT * FROM teachercontacts
			WHERE (teachCont_teach_no = '$teachCont_teach_no'
				AND teachCont_type = '$teachCont_type')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1,$conn->error);
		} else if($rs->num_rows == 0){
			$result = array(0, "0 record(s) found.");
		} else {
			$result = array(1, $rs->num_rows . " record(s) found.", $rs, $rs->num_rows);
		}	
		
		return $result;			
	}

	
	function showPart345($data){
		global $conn;
		$result = null;	
		$teachSalnDet_teachSaln_no = $data['0']['2'];
		$teachSalnDet_type = $data['0']['3'];
		
		$sql = "SELECT * FROM teachsalndetails
			WHERE (teachSalnDet_teachSaln_no = '$teachSalnDet_teachSaln_no'
				AND teachSalnDet_type = '$teachSalnDet_type')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1,$conn->error);
		} else if($rs->num_rows == 0){
			$result = array(0, "0 record(s) found.");
		} else {
			$result = array(1, $rs->num_rows . " record(s) found.", $rs, $rs->num_rows);
		}	
		
		return $result;			
	}
	
	
	function getPosition($data){
		global $conn;
		$result = null;	
		$teacherappointments_teach_no = $data['0']['1'];
		
		$sql = "SELECT * FROM teacherappointments
			INNER JOIN dropdowns ON teacherappointments_position = field_name
			WHERE (teacherappointments_teach_no = '$teacherappointments_teach_no'
				AND teacherappointments_active = '1')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1,$conn->error);
		} else if($rs->num_rows == 0){
			$result = array(0, "0 record(s) found.");
		} else {
			$result = array(1, $rs->num_rows . " record(s) found.", $rs, $rs->num_rows);
		}	
		
		return $result;				
	}
	
	
	function getID($data){
		global $conn;
		$result = null;	
		$teacherids_teach_no = $data['0']['1'];
		
		$sql = "SELECT * FROM teacherids
			WHERE (teacherids_teach_no = '$teacherids_teach_no'
				AND (teacherids_id LIKE '%'
					OR teacherids_id = 'GSIS'))
				ORDER BY teacherids_date_issued DESC";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1,$conn->error);
		} else if($rs->num_rows == 0){
			$result = array(0, "0 record(s) found.");
		} else {
			$result = array(1, $rs->num_rows . " record(s) found.", $rs, $rs->num_rows);
		}	
		
		return $result;				
	}
	
	
	function getTotalPartIII($data, $lookup){
		global $conn;
		$result = null;	
		$teachSalnDet_teachSaln_no = $data['0']['2'];
		
		$sql = "SELECT SUM(teachSalnDet_cost) AS totalCost FROM teachsalndetails
			WHERE (teachSalnDet_teachSaln_no = '$teachSalnDet_teachSaln_no'
				AND teachSalnDet_type = '$lookup')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1,$conn->error);
		} else if($rs->num_rows == 0){
			$result = array(0, "0 record(s) found.");
		} else {
			$result = array(1, $rs->num_rows . " record(s) found.", $rs->fetch_assoc(), $rs->num_rows);
		}	
		
		return $result;			
	}
	
	
	function getFilingYear($data){
		global $conn;
		$result = null;	
		$teachSaln_teach_no = $data['0']['2'];
		
		$sql = "SELECT * FROM settings
			WHERE (settings_sy NOT IN 
				(SELECT teachSaln_issueyear FROM teachsaln 
					WHERE teachSaln_teach_no = '$teachSaln_teach_no'))
			ORDER BY settings_sy DESC";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1,$conn->error);
		} else if($rs->num_rows == 0){
			$result = array(0, "0 record(s) found.");
		} else {
			$result = array(1, $rs->num_rows . " record(s) found.", $rs, $rs->num_rows);
		}	
		
		return $result;			
	}
	
	
	function addSALN($data){
		global $conn;
		$result = null;	
		$user_no = $data['0']['2'];
		$teachSaln_issueyear = $data['0']['3'];
		$teachSaln_filetype = $data['0']['4'];
		
		$sql = "INSERT INTO teachsaln(teachSaln_teach_no, teachSaln_filetype, teachSaln_issueyear, 
				teachSaln_networth, teachSaln_status, teachSaln_reguser, teachSaln_regdatetime, 
				teachSaln_moduser, teachSaln_moddatetime)
			VALUES('$user_no','$teachSaln_filetype', '$teachSaln_issueyear', '0', '2', '$user_no', NOW(), '$user_no', NOW())";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1,$conn->error);
		} else {
			$result = array(1, "Record(s) added.", $conn->insert_id);
		}	
		
		return $result;			
	}
	
	
	function addSpouse($data){
		global $conn;
		$result = null;	
		$user_no = $data['0']['2'];
		$teachCont_fname = strtoupper(mysqli_real_escape_string($conn, trim($data['0']['3'])));
		$teachCont_mname = strtoupper(mysqli_real_escape_string($conn, trim($data['0']['4'])));
		$teachCont_lname = strtoupper(mysqli_real_escape_string($conn, trim($data['0']['5'])));
		$teachCont_xname = strtoupper(mysqli_real_escape_string($conn, trim($data['0']['6'])));
		$teachCont_office = strtoupper(mysqli_real_escape_string($conn, trim($data['0']['7'])));
		$teachCont_position = strtoupper(mysqli_real_escape_string($conn, trim($data['0']['8'])));
		$teachCont_offadd = strtoupper(mysqli_real_escape_string($conn, trim($data['0']['9'])));
		$teachCont_govid = strtoupper(mysqli_real_escape_string($conn, trim($data['0']['10'])));
		$teachCont_idno = strtoupper(mysqli_real_escape_string($conn, trim($data['0']['11'])))	;
		$teachCont_issuedate = $data['0']['12'];
		
		$sql = "INSERT INTO teachercontacts(teachCont_teach_no, teachCont_type, teachCont_fname, 
				teachCont_mname, teachCont_lname, teachCont_xname, teachCont_bdate, teachCont_office, teachCont_position, 
				teachCont_offadd, teachCont_offcont, teachCont_govid, teachCont_idno, teachCont_issuedate, teachCont_moduser, teachCont_moddatetime)
			VALUES('$user_no', '1', '$teachCont_fname',
				'$teachCont_mname', '$teachCont_lname', '$teachCont_xname', '0000-00-00', '$teachCont_office', '$teachCont_position', 
				'$teachCont_offadd', '', '$teachCont_govid', '$teachCont_idno', '$teachCont_issuedate', '$user_no', NOW())";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1,$conn->error);
		} else {
			$result = array(1, "Record(s) added.", $conn->insert_id);
		}	
		
		return $result;			
	}
	
	
	function getSpouse($data){
		global $conn;
		$result = null;	
		$teachCont_no = $data['0']['2'];
		
		$sql = "SELECT * FROM teachercontacts
			WHERE (teachCont_no = '$teachCont_no')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1,$conn->error);
		} else if($rs->num_rows == 0){
			$result = array(0, "0 record(s) found.");
		} else {
			$result = array(1, $rs->num_rows . " record(s) found.", $rs->fetch_assoc(), $rs->num_rows);
		}	
		
		return $result;			
	}
	
	
	function modifySpouse($data){
		global $conn;
		$result = null;	
		$user_no = $data['0']['2'];
		$teachCont_fname = strtoupper(mysqli_real_escape_string($conn, trim($data['0']['3'])));
		$teachCont_mname = strtoupper(mysqli_real_escape_string($conn, trim($data['0']['4'])));
		$teachCont_lname = strtoupper(mysqli_real_escape_string($conn, trim($data['0']['5'])));
		$teachCont_xname = strtoupper(mysqli_real_escape_string($conn, trim($data['0']['6'])));
		$teachCont_office = strtoupper(mysqli_real_escape_string($conn, trim($data['0']['7'])));
		$teachCont_position = strtoupper(mysqli_real_escape_string($conn, trim($data['0']['8'])));
		$teachCont_offadd = strtoupper(mysqli_real_escape_string($conn, trim($data['0']['9'])));
		$teachCont_govid = strtoupper(mysqli_real_escape_string($conn, trim($data['0']['10'])));
		$teachCont_idno = strtoupper(mysqli_real_escape_string($conn, trim($data['0']['11'])))	;
		$teachCont_issuedate = $data['0']['12'];
		$teachCont_no  = $data['0']['13'];
		
		$sql = "UPDATE teachercontacts
			SET teachCont_fname = '$teachCont_fname', 
				teachCont_mname = '$teachCont_mname', 
				teachCont_lname = '$teachCont_lname', 
				teachCont_xname = '$teachCont_xname', 
				teachCont_office = '$teachCont_office', 
				teachCont_position = '$teachCont_position', 
				teachCont_offadd = '$teachCont_offadd', 
				teachCont_govid = '$teachCont_govid', 
				teachCont_idno = '$teachCont_idno', 
				teachCont_issuedate = '$teachCont_issuedate', 
				teachCont_moduser = '$user_no', 
				teachCont_moddatetime = NOW()
			WHERE (teachCont_no  = '$teachCont_no')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1,$conn->error);
		} else {
			$result = array(1, "Record(s) updated.");
		}	
		
		return $result;				
	}
	
	
	function addDependent($data){
		global $conn;
		$result = null;	
		$user_no = $data['0']['2'];
		$teachCont_fname = strtoupper(mysqli_real_escape_string($conn, trim($data['0']['3'])));
		$teachCont_mname = strtoupper(mysqli_real_escape_string($conn, trim($data['0']['4'])));
		$teachCont_lname = strtoupper(mysqli_real_escape_string($conn, trim($data['0']['5'])));
		$teachCont_xname = strtoupper(mysqli_real_escape_string($conn, trim($data['0']['6'])));
		$teachCont_bdate = $data['0']['7'];
		
		$sql = "INSERT INTO teachercontacts(teachCont_teach_no, teachCont_type, teachCont_fname, 
				teachCont_mname, teachCont_lname, teachCont_xname, teachCont_bdate, teachCont_office, teachCont_position, 
				teachCont_offadd, teachCont_offcont, teachCont_govid, teachCont_idno, teachCont_issuedate, teachCont_moduser, teachCont_moddatetime)
			VALUES('$user_no', '2', '$teachCont_fname',
				'$teachCont_mname', '$teachCont_lname', '$teachCont_xname', '$teachCont_bdate', '', '', 
				'', '', '', '', '', '$user_no', NOW())";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1,$conn->error);
		} else {
			$result = array(1, "Record(s) added.", $conn->insert_id);
		}	
		
		return $result;				
	}
	
	
	function getDependent($data){
		global $conn;
		$result = null;	
		$teachCont_no = $data['0']['2'];
		
		$sql = "SELECT * FROM teachercontacts
			WHERE (teachCont_no = '$teachCont_no')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1,$conn->error);
		} else if($rs->num_rows == 0){
			$result = array(0, "0 record(s) found.");
		} else {
			$result = array(1, $rs->num_rows . " record(s) found.", $rs->fetch_assoc(), $rs->num_rows);
		}	
		
		return $result;			
	}
	
	
	function modifyDependent($data){
		global $conn;
		$result = null;	
		$user_no = $data['0']['2'];
		$teachCont_fname = strtoupper(mysqli_real_escape_string($conn, trim($data['0']['3'])));
		$teachCont_mname = strtoupper(mysqli_real_escape_string($conn, trim($data['0']['4'])));
		$teachCont_lname = strtoupper(mysqli_real_escape_string($conn, trim($data['0']['5'])));
		$teachCont_xname = strtoupper(mysqli_real_escape_string($conn, trim($data['0']['6'])));
		$teachCont_bdate  = $data['0']['7'];
		$teachCont_no  = $data['0']['8'];
		
		$sql = "UPDATE teachercontacts
			SET teachCont_fname = '$teachCont_fname', 
				teachCont_mname = '$teachCont_mname', 
				teachCont_lname = '$teachCont_lname', 
				teachCont_xname = '$teachCont_xname', 
				teachCont_bdate = '$teachCont_bdate', 
				teachCont_moduser = '$user_no', 
				teachCont_moddatetime = NOW()
			WHERE (teachCont_no  = '$teachCont_no')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1,$conn->error);
		} else {
			$result = array(1, "Record(s) updated.");
		}	
		
		return $result;			
	}
	
	
	function addSALNDetails($data){
		global $conn;
		$result = null;			
		$teachSalnDet_teachSaln_no = $data['0']['3'];
		$teachSalnDet_type = $data['0']['4'];
		$teachSalnDet_details0 = strtoupper(trim($data['0']['5']));
		$teachSalnDet_details1 = strtoupper(trim($data['0']['6']));
		$teachSalnDet_details2 = strtoupper(trim($data['0']['7']));
		$teachSalnDet_details3 = strtoupper(trim($data['0']['8']));
		$teachSalnDet_details4 = strtoupper(trim($data['0']['9']));
		$teachSalnDet_details5 = strtoupper(trim($data['0']['10']));
		$teachSalnDet_details6 = strtoupper(trim($data['0']['11']));
		$teachSalnDet_details_r = array($teachSalnDet_details0, $teachSalnDet_details1, $teachSalnDet_details2, $teachSalnDet_details3, $teachSalnDet_details4, $teachSalnDet_details5, $teachSalnDet_details6);
		$teachSalnDet_details_s = serialize($teachSalnDet_details_r);
		$teachSalnDet_details =  mysqli_real_escape_string($conn, $teachSalnDet_details_s);
		$teachSalnDet_cost = $data['0']['12'];
		
		$sql = "INSERT INTO teachsalndetails(teachSalnDet_teachSaln_no, teachSalnDet_type, teachSalnDet_details, teachSalnDet_cost)
			VALUES('$teachSalnDet_teachSaln_no', '$teachSalnDet_type', '$teachSalnDet_details', '$teachSalnDet_cost')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1,$conn->error);
		} else {
			$result = array(1, "Record(s) added.", $conn->insert_id);
		}	
		
		return $result;			
	}	


	function getSALNDetails($data){
		global $conn;
		$result = null;	
		$teachSalnDet_no  = $data['0']['2'];
		
		$sql = "SELECT * FROM teachsalndetails
			WHERE (teachSalnDet_no  = '$teachSalnDet_no ')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1,$conn->error);
		} else if($rs->num_rows == 0){
			$result = array(0, "0 record(s) found.");
		} else {
			$result = array(1, $rs->num_rows . " record(s) found.", $rs->fetch_assoc(), $rs->num_rows);
		}	
		
		return $result;				
	}

	function modifySALNDetails($data){
		global $conn;
		$result = null;	
		$teachSalnDet_teachSaln_no = $data['0']['3'];
		$teachSalnDet_type = $data['0']['4'];
		$teachSalnDet_details0 = strtoupper(trim($data['0']['5']));
		$teachSalnDet_details1 = strtoupper(trim($data['0']['6']));
		$teachSalnDet_details2 = strtoupper(trim($data['0']['7']));
		$teachSalnDet_details3 = strtoupper(trim($data['0']['8']));
		$teachSalnDet_details4 = strtoupper(trim($data['0']['9']));
		$teachSalnDet_details5 = strtoupper(trim($data['0']['10']));
		$teachSalnDet_details6 = strtoupper(trim($data['0']['11']));
		$teachSalnDet_details_r = array($teachSalnDet_details0, $teachSalnDet_details1, $teachSalnDet_details2, $teachSalnDet_details3, $teachSalnDet_details4, $teachSalnDet_details5, $teachSalnDet_details6);
		$teachSalnDet_details_s = serialize($teachSalnDet_details_r);
		$teachSalnDet_details =  mysqli_real_escape_string($conn, $teachSalnDet_details_s);
		$teachSalnDet_cost = $data['0']['12'];
		$teachSalnDet_no = $data['0']['13'];
		
		$sql = "UPDATE teachsalndetails
			SET teachSalnDet_details = '$teachSalnDet_details', 
				teachSalnDet_cost = '$teachSalnDet_cost'
			WHERE (teachSalnDet_no = '$teachSalnDet_no')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1,$conn->error);
		} else {
			$result = array(1, "Record(s) updated.");
		}	
		
		return $result;			
	}
	
	
	function finalizeSALN($data, $totalCost){
		global $conn;
		$result = null;	
		$teachSaln_no = $data['0']['2'];
		$teachSaln_status = $data['0']['3'];
		$user_no = $data['0']['3'];
		
		$sql = "UPDATE teachsaln 
			SET teachSaln_networth = '$totalCost', 
				teachSaln_status = '$teachSaln_status',
				teachSaln_moduser = '$user_no',
				teachSaln_moddatetime = NOW()
			WHERE (teachSaln_no = '$teachSaln_no')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1,$conn->error);
		} else {
			$result = array(1, "Record(s) updated.");
		}	
		
		return $result;			
	}
}
?>