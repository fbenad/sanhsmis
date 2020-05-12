<?php
/*
 * Controller Class 
 * This class is used for Admin-Classes operations
 * @author    	Fernando B. Enad
 * @url        	n/a
 * @license    	n/a
 */
 
class Controller{
	
	function searchEntity($data){
		global $conn;
		$result = null;	
		$firstname = $data['0']['1'];
		$lastname = $data['0']['2'];

		$sql = "SELECT * FROM teacher 
			WHERE (teach_fname LIKE '%$firstname%'
				AND teach_lname LIKE '%$lastname%')
			ORDER BY teach_lname ASC, teach_fname ASC";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else if($rs->num_rows == 0){
			$result = array(0, "0 record(s) found.");
		} else {
			$result = array(1, $rs->num_rows . " record(s) found.", $rs, $rs->num_rows);
		}
		
		return $result;			
		
	}
	
	
	function getDropdowns($condition){
		global $conn;
		$result = null;	

		$sql = "SELECT * FROM dropdowns 
			WHERE ($condition)
			GROUP BY field_name
			ORDER BY field_name ASC";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else if($rs->num_rows == 0){
			$result = array(0, "0 record(s) found.");
		} else {
			$result = array(1, $rs->num_rows . " record(s) found.", $rs, $rs->num_rows);
		}
		
		return $result;		
	}
	
	
	function saveEntity($data){
		global $conn;
		$result = null;	
		$user_no = $_SESSION['user_no'];
		$teach_id = $data['0']['1'];
		$teach_fname = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['2'])));
		$teach_mname = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['3'])));
		$teach_lname = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['4'])));
		$teach_xname = $data['0']['5'];
		$teach_gender = $data['0']['6'];
		$teach_bdate = $data['0']['7'];
		$teach_residence = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['8'])));
		$teach_cstatus = $data['0']['9'];
		$teach_dialect = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['10'])));
		$teach_ethnicity = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['11'])));
		$teach_tin = $data['0']['12'];
		$teach_bio_no = $data['0']['13'];
		$teach_teacher = $data['0']['14'];
		$teach_status = $data['0']['15'];
		
	
		$sql = "INSERT INTO teacher(teach_id, teach_fname, teach_mname, teach_lname, teach_xname, teach_gender, teach_bdate, 
				teach_residence, teach_cstatus, teach_dialect, teach_ethnicity, teach_tin, teach_bio_no, teach_teacher, teach_status,
				teach_create_user_no, teach_cretedatetime, teach_lastmod_user_no, teach_lastmoddatetime)
			VALUES('$teach_id', '$teach_fname', '$teach_mname', '$teach_lname', '$teach_xname', '$teach_gender', '$teach_bdate', 
				'$teach_residence', '$teach_cstatus', '$teach_dialect', '$teach_ethnicity', '$teach_tin', '$teach_bio_no', '$teach_teacher', '$teach_status',
				'$user_no', NOW(), '$user_no', NOW())";		
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) added.", $conn->insert_id);
		}
		
		return $result;			
	}
	
	
	function checkUsername($data){
		global $conn;
		$result = null;	
		$user_name = trim($data['0']['1']);
		
		$sql = "SELECT * FROM users 
			WHERE (user_name = '$user_name')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else if($rs->num_rows == 0){
			$result = array(0, "0 record(s) found.");
		} else {
			$result = array(1, $rs->num_rows . " record(s) found.", $rs, $rs->num_rows);
		}
		
		return $result;				
	}
	
	
	function checkEntity($data){
		global $conn;
		$result = null;	
		$option = $data['0']['1'];
		
		$sql = "SELECT * FROM teacher 
			WHERE ($option)";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else if($rs->num_rows == 0){
			$result = array(0, "0 record(s) found.");
		} else {
			$result = array(1, $rs->num_rows . " record(s) found.", $rs, $rs->num_rows);
		}
		
		return $result;				
	}
	
	
	function addAppointment($data){
		global $conn;
		$result = null;	
		$teacherappointments_teach_no = $data['0']['1'];
		$teacherappointments_position = $data['0']['2'];
		$teacherappointments_item_no = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['3'])));
		$teacherappointments_date = $data['0']['4'];
		$teacherappointments_fdaydate = $data['0']['5'];
		$teacherappointments_status = $data['0']['6'];
		$teacherappointments_funding = $data['0']['7'];
		$teacherappointments_active = $data['0']['8'];		
	
		$sql = "INSERT INTO teacherappointments (teacherappointments_teach_no, teacherappointments_position, 
				teacherappointments_item_no, teacherappointments_date, teacherappointments_fdaydate, teacherappointments_status,
				teacherappointments_funding, teacherappointments_active)
			VALUES('$teacherappointments_teach_no', '$teacherappointments_position', 
				'$teacherappointments_item_no', '$teacherappointments_date', '$teacherappointments_fdaydate', '$teacherappointments_status',
				'$teacherappointments_funding', '$teacherappointments_active')";		
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) added.", $conn->insert_id);
		}
		
		return $result;			
	}
	
		
	function addUserAccess($data){
		global $conn;
		$result = null;	
		$user_no = $data['0']['1'];
		$user_fullname = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['2'])));
		$user_name = mysqli_real_escape_string($conn, trim($data['0']['3']));
		$user_pass = $data['0']['4'];
		$user_pass = MD5($user_pass);
		
		$sql = "INSERT INTO users (user_no, user_name, user_pass, user_fullname, user_role, user_status)
			VALUES('$user_no', '$user_name', '$user_pass', '$user_fullname', '2', '1')";		
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) added.", $conn->insert_id);
		}
		
		return $result;			
	}	
	
	
	function getBasic($data){
		global $conn;
		$result = null;	
		$teach_no = $data['0']['1'];
		
		$sql = "SELECT * FROM teacher 
			WHERE (teach_no = '$teach_no')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else if($rs->num_rows == 0){
			$result = array(0, "0 record(s) found.");
		} else {
			$result = array(1, $rs->num_rows . " record(s) found.", $rs->fetch_assoc(), $rs->num_rows);
		}
		
		return $result;				
	}
	
	
	function modifyEntity($data){
		global $conn;
		$result = null;	
		$user_no = $_SESSION['user_no'];
		$teach_id = $data['0']['1'];
		$teach_fname = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['2'])));
		$teach_mname = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['3'])));
		$teach_lname = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['4'])));
		$teach_xname = $data['0']['5'];
		$teach_gender = $data['0']['6'];
		$teach_bdate = $data['0']['7'];
		$teach_residence = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['8'])));
		$teach_cstatus = $data['0']['9'];
		$teach_dialect = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['10'])));
		$teach_ethnicity = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['11'])));
		$teach_tin = $data['0']['12'];
		$teach_bio_no = $data['0']['13'];
		$teach_no = $data['0']['14'];

		
		$sql = "UPDATE teacher
			SET teach_id = '$teach_id',
				teach_fname = '$teach_fname', 
				teach_mname = '$teach_mname', 
				teach_lname = '$teach_lname', 
				teach_xname = '$teach_xname', 
				teach_gender = '$teach_gender', 
				teach_bdate = '$teach_bdate', 
				teach_residence = '$teach_residence', 
				teach_cstatus = '$teach_cstatus', 
				teach_dialect = '$teach_dialect', 
				teach_ethnicity = '$teach_ethnicity', 
				teach_tin = '$teach_tin',
				teach_bio_no = '$teach_bio_no'
			WHERE (teach_no = '$teach_no')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) updated.");
		}
		
		return $result;			
	}
	
	
	function getFamily($data){
		global $conn;
		$result = null;	
		$teachCont_teach_no = $data['0']['1'];
		
		$sql = "SELECT * FROM teachercontacts 
			WHERE (teachCont_teach_no = '$teachCont_teach_no')
			ORDER  BY teachCont_type ASC";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else if($rs->num_rows == 0){
			$result = array(0, "0 record(s) found.");
		} else {
			$result = array(1, $rs->num_rows . " record(s) found.", $rs, $rs->num_rows);
		}
		
		return $result;				
	}	
	
	
	function getEducation($data){
		global $conn;
		$result = null;	
		$eback_teach_no = $data['0']['1'];
		
		$sql = "SELECT * FROM teacher_ebackground 
			WHERE (eback_teach_no = '$eback_teach_no')
			ORDER  BY eback_no ASC";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else if($rs->num_rows == 0){
			$result = array(0, "0 record(s) found.");
		} else {
			$result = array(1, $rs->num_rows . " record(s) found.", $rs, $rs->num_rows);
		}
		
		return $result;				
	}
	
	
	function getIDs($data){
		global $conn;
		$result = null;	
		$teacherids_teach_no = $data['0']['1'];
		
		$sql = "SELECT * FROM teacherids 
			WHERE (teacherids_teach_no = '$teacherids_teach_no')
			ORDER  BY teacherids_date_issued ASC";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else if($rs->num_rows == 0){
			$result = array(0, "0 record(s) found.");
		} else {
			$result = array(1, $rs->num_rows . " record(s) found.", $rs, $rs->num_rows);
		}
		
		return $result;				
	}
	
	
	function getAppointments($data, $option, $condition){
		global $conn;
		$result = null;	
		$teacherappointments_teach_no = $data['0']['1'];
		
		$sql = "SELECT * FROM teacherappointments
			$option
			WHERE (teacherappointments_teach_no = '$teacherappointments_teach_no'
				$condition)
			ORDER  BY teacherappointments_date DESC";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else if($rs->num_rows == 0){
			$result = array(0, "0 record(s) found.");
		} else {
			$result = array(1, $rs->num_rows . " record(s) found.", $rs, $rs->num_rows);
		}
		
		return $result;			
	}
	
	
	function addFamily($data){
		global $conn;
		$result = null;	
		$user_no = $_SESSION['user_no'];
		$teachCont_fname = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['2'])));
		$teachCont_mname = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['3'])));
		$teachCont_lname = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['4'])));
		$teachCont_xname = $data['0']['5'];
		$teachCont_type = $data['0']['6'];
		$teachCont_teach_no = $data['0']['7'];
		
		$sql = "INSERT INTO teachercontacts(teachCont_teach_no, teachCont_fname, teachCont_mname, teachCont_lname, 
				teachCont_xname, teachCont_type, teachCont_bdate, teachCont_position, teachCont_office, teachCont_offadd, 	
				teachCont_offcont, teachCont_govid, teachCont_idno, teachCont_issuedate, teachCont_moduser, teachCont_moddatetime)
			VALUES('$teachCont_teach_no', '$teachCont_fname', '$teachCont_mname', '$teachCont_lname', 
				'$teachCont_xname', '$teachCont_type', '0000-00-00', '-', '-', '-', 	
				'-', '-', '-', '0000-00-00', '$user_no', NOW())";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) added.", $conn->insert_id);
		}
		
		return $result;			
	}
	
	
	function addEducation($data){
		global $conn;
		$result = null;	
		$eback_level = $data['0']['2'];
		$eback_degree = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['3'])));
		$eback_major = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['4'])));
		$eback_minor = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['5'])));
		$eback_units = $data['0']['6'];
		$eback_teach_no = $data['0']['7'];

		$sql = "INSERT INTO teacher_ebackground(eback_teach_no, eback_level, eback_degree, eback_major, eback_minor, eback_units)
			VALUES('$eback_teach_no', '$eback_level', '$eback_degree', '$eback_major', 
				'$eback_minor', '$eback_units')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) added.", $conn->insert_id);
		}
		
		return $result;			
	}
	
	
	function addID($data){
		global $conn;
		$result = null;	
		$teacherids_id = $data['0']['2'];
		$teacherids_details = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['3'])));
		$teacherids_date_issued = $data['0']['4'];
		$teacherids_place_issued = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['5'])));
		$teacherids_teach_no = $data['0']['6'];

		$sql = "INSERT INTO teacherids(teacherids_teach_no, teacherids_id, teacherids_details, teacherids_date_issued, teacherids_place_issued)
			VALUES('$teacherids_teach_no', '$teacherids_id', '$teacherids_details', '$teacherids_date_issued', '$teacherids_place_issued')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) added.", $conn->insert_id);
		}
		
		return $result;			
	}
	

	function addAppointment2($data){
		global $conn;
		$result = null;	
		$teacherappointments_position = $data['0']['3'];
		$teacherappointments_item_no = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['4'])));
		$teacherappointments_date = $data['0']['5'];
		$teacherappointments_fdaydate = $data['0']['6'];
		$teacherappointments_status = $data['0']['7'];
		$teacherappointments_funding = $data['0']['8'];
		$teacherappointments_active = $data['0']['9'];
		$teacherappointments_teach_no = $data['0']['10'];
				
		$sql = "INSERT INTO teacherappointments (teacherappointments_teach_no, teacherappointments_position, teacherappointments_item_no, teacherappointments_date, 
				teacherappointments_fdaydate, teacherappointments_status, teacherappointments_funding, teacherappointments_active)
			VALUES('$teacherappointments_teach_no', '$teacherappointments_position', '$teacherappointments_item_no', '$teacherappointments_date', 
				'$teacherappointments_fdaydate', '$teacherappointments_status', '$teacherappointments_funding', '$teacherappointments_active')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) added.", $conn->insert_id);
		}
		
		return $result;			
	}
	 	
		
	function addDesignation($data){
		global $conn;
		$result = null;	
		$teacherappointments_position = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['2'])));
		$teacherappointments_date = $data['0']['3'];
		$teacherappointments_status = $data['0']['4'];
		$teacherappointments_funding = $data['0']['5'];
		$teacherappointments_teach_no = $data['0']['6'];
		
		$sql = "INSERT INTO teacherappointments (teacherappointments_teach_no, teacherappointments_position, teacherappointments_item_no, teacherappointments_date, 
				teacherappointments_fdaydate, teacherappointments_status, teacherappointments_funding, teacherappointments_active)
			VALUES('$teacherappointments_teach_no', '$teacherappointments_position', 'ANCILLARY', '$teacherappointments_date', 
				'0000-00-00', '$teacherappointments_status', '$teacherappointments_funding', '0')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) added.", $conn->insert_id);
		}
		
		return $result;			
	}	
	
	
	function updateTeacher($data){
		global $conn;
		$result = null;	
		$teach_no = $data['0']['1'];
		$teach_teacher = $data['0']['2'];
		
		$sql = "UPDATE teacher 
			SET teach_teacher = '$teach_teacher'
			WHERE (teach_no = '$teach_no')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) updated.");
		}
		
		return $result;				
	}
	
	
	function updateAppointment($data){
		global $conn;
		$result = null;	
		$teacherappointments_teach_no = $data['0']['1'];
		$teacherappointments_no = $data['0']['2'];
		
		$sql = "UPDATE teacherappointments 
			SET teacherappointments_active = '0'
			WHERE (teacherappointments_teach_no = '$teacherappointments_teach_no'
				AND teacherappointments_no != '$teacherappointments_no')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) updated.");
		}
		
		return $result;				
	}
	
	
	function deleteAction($data){
		global $conn;
		$result = null;	
		$table = $data['0']['1'];
		$condition = $data['0']['2'];
		
		$sql = "DELETE FROM $table 
			WHERE ($condition)";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) deleted.");
		}
		
		return $result;			
	}
	
	function getEntity($table, $condition){
		global $conn;
		$result = null;	
		
		$sql = "SELECT * FROM $table 
			WHERE ($condition)";
		$rs = $conn->query($sql);		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else if($rs->num_rows == 0){
			$result = array(0, "0 record(s) found.");
		} else {
			$result = array(1, $rs->num_rows . " record(s) found.", $rs->fetch_assoc(), $rs->num_rows);
		}
		
		return $result;			
	}
	
	
	function modifyFamily($data){
		global $conn;
		$result = null;	
		$user_no = $_SESSION['user_no'];
		$teachCont_fname = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['2'])));
		$teachCont_mname = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['3'])));
		$teachCont_lname = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['4'])));
		$teachCont_xname = $data['0']['5'];
		$teachCont_type = $data['0']['6'];
		$teachCont_no = $data['0']['7'];
		
		$sql = "UPDATE teachercontacts
			SET teachCont_fname = '$teachCont_fname',
				teachCont_mname = '$teachCont_mname',
				teachCont_lname = '$teachCont_lname',
				teachCont_xname = '$teachCont_xname',
				teachCont_type = '$teachCont_type',
				teachCont_moduser = '$user_no',
				teachCont_moddatetime = NOW()
			WHERE (teachCont_no = '$teachCont_no')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) updated.");
		}
		
		return $result;			
	}


	function modifyEducation($data){
		global $conn;
		$result = null;	
		$eback_level = $data['0']['2'];
		$eback_degree = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['3'])));
		$eback_major = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['4'])));
		$eback_minor = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['5'])));
		$eback_units = $data['0']['6'];
		$eback_no = $data['0']['7'];
		
		$sql = "UPDATE teacher_ebackground
			SET eback_level = '$eback_level',
				eback_degree = '$eback_degree',
				eback_major = '$eback_major',
				eback_minor = '$eback_minor',
				eback_units = '$eback_units'
			WHERE (eback_no = '$eback_no')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) updated.");
		}
		
		return $result;			
	}
	

	function modifyID($data){
		global $conn;
		$result = null;	
		$teacherids_id = $data['0']['2'];
		$teacherids_details = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['3'])));
		$teacherids_date_issued = $data['0']['4'];
		$teacherids_place_issued = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['5'])));
		$teacherids_no = $data['0']['6'];
		
		$sql = "UPDATE teacherids
			SET teacherids_id = '$teacherids_id',
				teacherids_details = '$teacherids_details',
				teacherids_date_issued = '$teacherids_date_issued',
				teacherids_place_issued = '$teacherids_place_issued'
			WHERE (teacherids_no = '$teacherids_no')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) updated.");
		}
		
		return $result;			
	}
	

	function modifyAppointment($data){
		global $conn;
		$result = null;	
		$teacherappointments_position = $data['0']['3'];
		$teacherappointments_item_no = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['4'])));
		$teacherappointments_date = $data['0']['5'];
		$teacherappointments_fdaydate = $data['0']['6'];
		$teacherappointments_status = $data['0']['7'];
		$teacherappointments_funding = $data['0']['8'];
		$teacherappointments_active = $data['0']['9'];
		$teacherappointments_no = $data['0']['10'];
		
		$sql = "UPDATE teacherappointments
			SET teacherappointments_position = '$teacherappointments_position',
				teacherappointments_item_no = '$teacherappointments_item_no',
				teacherappointments_date = '$teacherappointments_date',
				teacherappointments_fdaydate = '$teacherappointments_fdaydate',
				teacherappointments_status = '$teacherappointments_status',
				teacherappointments_funding = '$teacherappointments_funding',
				teacherappointments_active = '$teacherappointments_active'
			WHERE (teacherappointments_no = '$teacherappointments_no')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) updated.");
		}
		
		return $result;			
	}
	

	function modifyDesignation($data){
		global $conn;
		$result = null;	
		$teacherappointments_position = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['2'])));
		$teacherappointments_date = $data['0']['3'];
		$teacherappointments_status = $data['0']['4'];
		$teacherappointments_funding = $data['0']['5'];
		$teacherappointments_no = $data['0']['6'];
		
		$sql = "UPDATE teacherappointments
			SET teacherappointments_position = '$teacherappointments_position',
				teacherappointments_date = '$teacherappointments_date',
				teacherappointments_status = '$teacherappointments_status',
				teacherappointments_funding = '$teacherappointments_funding'
			WHERE (teacherappointments_no = '$teacherappointments_no')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) updated.");
		}
		
		return $result;			
	}
		
}
