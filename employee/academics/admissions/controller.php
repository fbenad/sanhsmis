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

		$sql = "SELECT * FROM student 
			WHERE (stud_fname LIKE '%$firstname%'
				AND stud_lname LIKE '%$lastname%')
			ORDER BY stud_lname ASC, stud_fname ASC";
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
	
	
	function getSections($section_sy, $section_level, $section_track, $option){
		global $conn;
		$result = null;	

		$sql = "SELECT * FROM section
			WHERE (section_sy = '$section_sy'
				AND section_level LIKE '$section_level'
				AND section_track LIKE '$section_track'
				AND section_bogus = '0'
				$option)
			ORDER BY section_level ASC, section_name ASC";
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
	
	
	function getEnrollmentCount($enrol_sy, $enrol_level, $enrol_section){
		global $conn;
		$result = null;	

		$sql = "SELECT * FROM studenroll
			WHERE (enrol_sy = '$enrol_sy'
				AND enrol_level LIKE '$enrol_level'
				AND enrol_section LIKE '$enrol_section')";
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
	
	
	function getStudentInformation($data){
		global $conn;
		$result = null;	
		$stud_no = $data['0']['1'];

		$sql = "SELECT * FROM student
			WHERE (stud_no = '$stud_no')";			
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
	
	
	function getCurrentEnrollment($data){
		global $conn;
		$result = null;	
		$enrol_stud_no = $data['0']['1'];

		$sql = "SELECT * FROM studenroll
			WHERE (enrol_stud_no = '$enrol_stud_no')
			ORDER BY enrol_sy DESC";			
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
	
	
	function enrollStudent($data){
		global $conn, $sch_fullname, $sch_citymun, $sch_province, $sch_code;
		$result = null;	
		$user_no = $_SESSION['user_no'];
		$enrol_sy = $data['0']['1'];
		$enrol_stud_no = $data['0']['2'];
		$enrol_level = $data['0']['3'];
		$enrol_section = $data['0']['4'];
		$enrol_remarks = mysqli_real_escape_string($conn, trim($data['0']['5']));
		$enrol_track = $data['0']['6'];
		$enrol_strand = $data['0']['7'];
		$enrol_combo  = $data['0']['8'];
		$enrol_ti  = $data['0']['9'];
		$enrol_gradawards = $data['0']['10'];
		$enrol_school = serialize(array($sch_code, $sch_fullname, $sch_citymun.", ".$sch_province));
		$enrol_status1 = "ENROLLED";
		$enrol_status2 = "REGULAR";
		$enrol_remarks = ($enrol_ti == 1 ? "T/I: ".$enrol_remarks : $enrol_remarks);
		
		$sql = "INSERT INTO studenroll(enrol_stud_no, enrol_sy, enrol_school, enrol_level, enrol_section, 
				enrol_status1, enrol_status2, enrol_remarks, enrol_track, enrol_strand, enrol_combo, 
				enrol_admitdate, enrol_username, enrol_updatedate, enrol_ti, enrol_gradawards)
			VALUES('$enrol_stud_no', '$enrol_sy', '$enrol_school', '$enrol_level','$enrol_section', 
				'$enrol_status1', '$enrol_status2', '$enrol_remarks', '$enrol_track', '$enrol_strand', '$enrol_combo', 
				NOW(), '$user_no', NOW(), '$enrol_ti', '$enrol_gradawards')";		
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) added.", $conn->insert_id);
		}
		
		return $result;			
	}
	
	
	function addSchoolDays($data){
		global $conn;
		$result = null;	
		$sch_stud_no = $data['0']['1'];
		$sch_sy = $data['0']['2'];

		$sql = "INSERT INTO school_days(sch_stud_no, sch_sy)
			VALUES('$sch_stud_no', '$sch_sy')";		
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) added.", $conn->insert_id);
		}
		
		return $result;			
	}
	
	
	function addCoreValues($data){
		global $conn;
		$result = null;	
		$coreval_stud_no = $data['0']['1'];
		$coreval_enrol_sy = $data['0']['2'];

		$sql = "INSERT INTO student_corevalues(coreval_stud_no, coreval_enrol_sy)
			VALUES('$coreval_stud_no', '$coreval_enrol_sy')";		
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) added.", $conn->insert_id);
		}
		
		return $result;			
	}
	
	
	function getOffering($data){
		global $conn;
		$result = null;	
		$class_sy = $data['0']['2'];
		$class_sem = $data['0']['3'];
		$enrol_level = $data['0']['4'];
		$enrol_section = $data['0']['5'];
		$class_sem = ($enrol_level > 10 ? $class_sem : 12);

		$sql = "SELECT * FROM class 
			INNER JOIN prospectus ON class_pros_no = pros_no 
			INNER JOIN section ON class_section_no = section_no 
			WHERE section_name LIKE '$enrol_section' 
				AND class_sy = '$class_sy' 
				AND class_sem = '$class_sem'";			
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
	
	
	function addSubjects($data){
		global $conn;
		$result = null;	
		$grade_sy = $data['0']['0'];
		$grade_sem = $data['0']['1'];
		$grade_class_no = $data['0']['2'];
		$grade_stud_no = $data['0']['3'];

		$sql = "INSERT INTO grade(grade_sy, grade_sem, grade_class_no, grade_stud_no)
			VALUES('$grade_sy', '$grade_sem', '$grade_class_no', '$grade_stud_no')";		
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) added.", $conn->insert_id);
		}
		
		return $result;			
	}
}