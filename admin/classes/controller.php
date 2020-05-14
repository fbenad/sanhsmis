<?php
/*
 * Controller Class 
 *
 * This class is used to execute MySQL-related operations for teh Admin->Class feature. 
 * Request such as the CRUD operations are executed here as requested through the action.php file.
 * @author    	Fernando B. Enad
 * @license    	Public
 */
 
class Controller{
	
	function getClassTab($data, $condition, $option){
		global $conn;
		$result = null;	
		$section_sy = $data['0']['1'];
			
		$sql = "SELECT * FROM section 
			WHERE (section_sy = '$section_sy'
				$condition
				AND section_bogus LIKE '0')
			$option
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
	
	
	function getSectionCount($data, $enrol_section, $condition){
		global $conn;
		$result = null;	
		$enrol_sy = $data['0']['1'];
			
		$sql = "SELECT COUNT(enrol_stud_no) AS sectionCount FROM studenroll 
			WHERE (enrol_sy = '$enrol_sy'
				AND enrol_section = '$enrol_section'
				$condition)";
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
	
	
	function getSYs($data){
		global $conn;
		$result = null;	
			
		$sql = "SELECT * FROM settings
			ORDER BY settings_sy DESC";
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
	
	
	function getSection($data){
		global $conn;
		$result = null;	
		$section_no = $data['0']['2'];
			
		$sql = "SELECT * FROM section
			WHERE (section_no = '$section_no')";
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
	
	
	function getDropdowns($data, $field_category, $condition){
		global $conn;
		$result = null;	
			
		$sql = "SELECT * FROM dropdowns
			WHERE (field_category = '$field_category'
				AND field_name NOT LIKE 'SHS %'
				$condition)
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
	
	
	function getUsers($condition){
		global $conn;
		$result = null;	
			
		$sql = "SELECT * FROM users
			INNER JOIN teacher ON user_no = teach_no
			WHERE (user_status = '1'
				$condition)
			ORDER BY user_role ASC, user_fullname ASC";
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
	
	
	function addClass($data){
		global $conn;
		$result = null;	
		$section_name = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['2'])));
		$section_bogus = $data['0']['3'];
		$section_level = $data['0']['4'];
		$section_cap = $data['0']['5'];
		$section_track = $data['0']['6'];
		$section_adviser = $data['0']['7'];
		$section_sy = $data['0']['8'];
			
		$sql = "INSERT INTO section(section_name, section_bogus, section_level, 
				section_cap, section_track, section_adviser, section_sy, section_status, section_updatedate)
			VALUES('$section_name', '$section_bogus', '$section_level', 
				'$section_cap', '$section_track', '$section_adviser', '$section_sy', '0', NOW())";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) added.", $conn->insert_id);
		}	
		
		return $result;			
	}
	
	
	function checkDuplicateName($data){
		global $conn;
		$result = null;	
		$section_name = strtoupper($data['0']['1']);
		$ection_sy = $data['0']['2'];
			
		$sql = "SELECT * FROM section
			WHERE (section_name = '$section_name'
				AND section_sy = '$ection_sy')";
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
	
	
	function deleteClass($data){
		global $conn;
		$result = null;	
		$section_no = $data['0']['2'];
			
		$sql = "DELETE FROM section
			WHERE (section_no = '$section_no')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) added.", $conn->insert_id);
		}	
		
		return $result;			
	}
	
	
	function modifyClass($data){
		global $conn;
		$result = null;	
		$section_bogus = $data['0']['3'];
		$section_level = $data['0']['4'];
		$section_cap = $data['0']['5'];
		$section_track = $data['0']['6'];
		$section_adviser = $data['0']['7'];
		$section_no = $data['0']['8'];
			
		$sql = "UPDATE section
			SET section_bogus = '$section_bogus',
				section_level = '$section_level',
				section_cap = '$section_cap',
				section_track = '$section_track',
				section_adviser = '$section_adviser',
				section_updatedate = NOW()
			WHERE (section_no = '$section_no')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) added.", $conn->insert_id);
		}	
		
		return $result;			
	}
	
	
	function getLevelCount($data, $min, $max, $gender, $condition){
		global $conn;
		$result = null;	
		$enrol_sy = strtoupper($data['0']['1']);
			
		$sql = "SELECT enrol_no FROM studenroll
			INNER JOIN student ON enrol_stud_no = stud_no
			WHERE (enrol_sy = '$enrol_sy' 
				AND enrol_level BETWEEN '$min' AND '$max'
				AND stud_gender LIKE '$gender'
				$condition)";
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
	
	
	function getStatusCount($data, $status){
		global $conn;
		$result = null;	
		$section_sy = $data['0']['1'];
			
		$sql = "SELECT * FROM section 
			WHERE (section_sy = '$section_sy'
				AND section_bogus LIKE '$status')
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
	
	
	function getSectionAssociation($data){
		global $conn;
		$result = null;	
		$class_sy = $data['0']['1'];
		$class_section_no = $data['0']['2'];
			
		$sql = "SELECT COUNT(*) AS associationCount FROM class 
			WHERE (class_section_no = '$class_section_no' 
				AND class_sy = '$class_sy')";
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
	
	
	function unfinalizeClass($data){
		global $conn;
		$result = null;	
		$section_no = $data['0']['2'];
			
		$sql = "UPDATE section
			SET section_status = '0',
				section_updatedate = NOW()
			WHERE (section_no = '$section_no')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) updated.");
		}	
		
		return $result;			
	}
}