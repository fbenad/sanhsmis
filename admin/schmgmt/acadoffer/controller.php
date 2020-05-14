<?php
/*
 * Controller Class 
 * This class is used for Admin->Acdemic Offerings operations
 * @author    	Fernando B. Enad
 * @url        	n/a
 * @license    	n/a
 */
 
class Controller{
	
	function loadClassSYs(){
		global $conn;
		$result = null;	
			
		$sql = "SELECT settings_sy FROM settings 
			GROUP BY settings_sy
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
	
	
	function loadClassSections($data){
		global $conn;
		$result = null;	
		$section_sy = $data['0']['1'];
			
		$sql = "SELECT * FROM section 
			WHERE (section_sy = '$section_sy')
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
	
	
	function getTerms($data){
		global $conn;
		$result = null;	
		$class_section_no = $data['0']['2'];
			
		$sql = "SELECT class_sy, class_sem FROM class
			WHERE (class_section_no = '$class_section_no')
			GROUP BY class_sem
			ORDER BY class_sem ASC";
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
	
	
	function loadSectionCourses($data, $class_sem){
		global $conn;
		$result = null;	
		$class_sy = $data['0']['2'];
		$class_section_no = $data['0']['2'];
			
		$sql = "SELECT * FROM class
			INNER JOIN prospectus ON class_pros_no = pros_no
			INNER JOIN teacher ON class_user_name = teach_no
			WHERE (class_section_no = '$class_section_no'
				AND class_sem = '$class_sem')
			ORDER BY pros_sort ASC, pros_title ASC";
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
	
	
	function loadDashboardCounts($data){
		global $conn;
		$result = null;	
		$table = $data['0']['1'];
		$options = $data['0']['2'];
		$conditions = $data['0']['3'];
					
		$sql = "SELECT $table
			$options
			$conditions";
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
	
	
	function getSection($data){
		global $conn;
		$result = null;	
		$section_no = $data['0']['3'];
					
		$sql = "SELECT * FROM section	
			INNER JOIN settings ON section_sy = settings_sy
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
	
	
	function getSubjects($data, $pros_curr, $pros_track, $pros_level){
		global $conn;
		$result = null;	
		$class_sy = $data['0']['2'];
		$class_section_no = $data['0']['3'];
		$class_sem = $data['0']['4'];
		$option = ($pros_level > 10 ? " OR pros_track LIKE 'SHS %' " : "");
		$option2 = ($pros_level > 10 ? " AND pros_sem LIKE '$class_sem' " : "");
		
		$sql = "SELECT * FROM prospectus	
			WHERE (pros_curr = '$pros_curr'
				AND (pros_track LIKE '$pros_track' $option)
				AND pros_level = '$pros_level'				
				AND pros_part = '1'
				$option2)
			ORDER BY pros_sem ASC, pros_sort ASC";
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
	

	function getSubjects2($data, $option){
		global $conn;
		$result = null;	
		$class_sy = $data['0']['2'];
		$class_section_no = $data['0']['3'];
		$class_sem = $data['0']['4'];
		
		$sql = "SELECT * FROM prospectus	
			WHERE ( $option )
			ORDER BY pros_level ASC, pros_sem ASC, pros_title ASC";
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

	
	function checkSubjectStatus($data, $class_pros_no){
		global $conn;
		$result = null;	
		$class_sy = $data['0']['2'];
		$class_section_no = $data['0']['3'];
		
		$sql = "SELECT * FROM class	
			WHERE (class_sy = '$class_sy'
				AND class_section_no = '$class_section_no'
				AND class_pros_no = '$class_pros_no')";
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
		$class_sy = $data['0']['2'];
		$class_section_no = $data['0']['3'];
		$class_pros_no_r = $data['0']['4'];
		$class_sem_r = $data['0']['5'];
		
		for($i = 0; $i < sizeof($class_pros_no_r); $i++){
			$class_pros_no = $class_pros_no_r[$i];
			$class_sem = $class_sem_r[$i];
			
			$sql = "INSERT INTO class(class_sy, class_sem, class_pros_no, class_section_no, 
					class_timeslots, class_days, class_room, class_user_name)
				VALUES('$class_sy', '$class_sem', '$class_pros_no', '$class_section_no', 
					'00:00-00:00', 'MTWTHF', 'TBA', '1')";
			$rs = $conn->query($sql);
			
			if(!$rs){
				$result = array(-1, $conn->error);
				break;

			} else {
				$result = array(1, "Record(s) added.");
			}				
		}
	
		return $result;			
	}
	
	
	function getOffering($data){
		global $conn;
		$result = null;	
		$class_no = $data['0']['2'];
		
		$sql = "SELECT * FROM class	
			INNER JOIN prospectus ON class_pros_no = pros_no
			INNER JOIN section ON class_section_no = section_no
			INNER JOIN teacher ON class_user_name  = teach_no
			WHERE (class_no = '$class_no')";
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
	
	
	function getTeachers(){
		global $conn;
		$result = null;	
		
		$sql = "SELECT * FROM teacher
			WHERE (teach_status = '1'
				AND teach_teacher = '1')
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
	
	
	function getDropdowns($option){
		global $conn;
		$result = null;	
		
		$sql = "SELECT * FROM dropdowns
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
	
	
	function modifyOffering($data){
		global $conn;
		$result = null;	
		$class_no = $data['0']['2'];
		$class_timeslots = mysqli_real_escape_string($conn, trim($data['0']['3']));
		$class_days = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['4'])));
		$class_room = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['5'])));
		$class_sem = $data['0']['6'];
		$class_user_name = $data['0']['7'];
		
		$sql = "UPDATE class
			SET class_timeslots = '$class_timeslots', 
				class_days = '$class_days', 
				class_room = '$class_room', 
				class_sem = '$class_sem', 
				class_user_name = '$class_user_name'
			WHERE (class_no = '$class_no')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) found.");
		}		
		
		return $result;					
	}
	
	
	function deleteOffering($data){
		global $conn;
		$result = null;	
		$class_no = $data['0']['2'];
		
		$sql = "DELETE FROM class
			WHERE (class_no = '$class_no')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) deleted.");
		}		
		
		return $result;			
	}
	
	
	function checkAssociation($class_no){
		global $conn;
		$result = null;	
		
		$sql = "SELECT * FROM class
			INNER JOIN grade ON grade_class_no = class_no
			WHERE (class_no = '$class_no')";
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
	
	
	function addOffering($data){
		global $conn;
		$result = null;	
		$class_sy = $data['0']['2'];
		$class_section_no = $data['0']['3'];
		$class_sem = $data['0']['4'];
		$class_pros_no = $data['0']['5'];
		
		$sql = "INSERT INTO class(class_sy, class_sem, class_pros_no, class_section_no, 
					class_timeslots, class_days, class_room, class_user_name)
				VALUES('$class_sy', '$class_sem', '$class_pros_no', '$class_section_no', 
					'00:00-00:00', 'MTWTHF', 'TBA', '1')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);

		} else {
			$result = array(1, "Record(s) added.");
		}
		
		return $result;			
	}
}