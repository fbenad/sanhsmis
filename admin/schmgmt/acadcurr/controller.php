<?php
/*
 * Controller Class 
 * This class is used for Admin-Classes operations
 * @author    	Fernando B. Enad
 * @url        	n/a
 * @license    	n/a
 */
 
class Controller{
	
	function loadCurrYears(){
		global $conn;
		$result = null;	
			
		$sql = "SELECT * FROM dropdowns
			WHERE (field_category = 'CURRICULUM')
			ORDER BY field_name DESC";
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
	
	
	function loadCurrPrograms($data, $option){
		global $conn;
		$result = null;	
					
		$sql = "SELECT * FROM dropdowns
			WHERE (field_category = 'TRACK'
				$option)
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
	
	
	function getCurrProgram($data, $condition){
		global $conn;
		$result = null;	
		$pros_curr = $data['0']['1'];
		$pros_track = $data['0']['2'];
		$pros_part = $data['0']['3'];
					
		$sql = "SELECT * FROM prospectus
			WHERE (pros_curr = '$pros_curr'
				AND pros_part LIKE '$pros_part'
				AND (pros_track LIKE '$pros_track'
					$condition))
			GROUP BY pros_level, pros_sem
			ORDER BY pros_level ASC, pros_sem ASC, pros_sort ASC";
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
	
	
	function getCourses($data, $pros_level, $pros_sem){
		global $conn;
		$result = null;	
		$pros_curr = $data['0']['1'];
		$pros_track = $data['0']['2'];
		$pros_part = $data['0']['3'];
		$condition = ($pros_level > 10 ? " OR pros_track LIKE 'SHS %' " : "");
					
		$sql = "SELECT * FROM prospectus
			WHERE (pros_curr = '$pros_curr'
				AND pros_part LIKE '$pros_part'
				AND (pros_track LIKE '$pros_track'
					$condition)
				AND pros_level = '$pros_level'
				AND pros_sem = '$pros_sem')
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


	function moveSort($data){
		global $conn;
		$result = null;	
		$pros_no = $data['0']['1'];
		$pros_sort = intval($data['0']['2']);
		$direction = intval($data['0']['3']);
		$pro_sort_new = ($pros_sort + $direction);
					
		$sql = "UPDATE prospectus
			SET pros_sort = '$pro_sort_new'
			WHERE (pros_no = '$pros_no')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) updated.");
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
	
	
	function addCurriculum($data){
		global $conn;
		$result = null;	
		$field_category = $data['0']['2'];
		$field_name = $data['0']['3'];
					
		$sql = "INSERT dropdowns(field_category, field_name, field_ext) 
			VALUES('$field_category', '$field_name', '-')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) added.");
		}	
		
		return $result;			
	}
	
	
	function checkSY($data){
		global $conn;
		$result = null;	
		$field_category = $data['0']['1'];
		$field_name = $data['0']['2'];
					
		$sql = "SELECT * FROM dropdowns
			WHERE (field_category = '$field_category'
				AND field_name = '$field_name')";
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
	
	
	function getDropdowns($option){
		global $conn;
		$result = null;	
					
		$sql = "SELECT * FROM dropdowns
			WHERE $option
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
	
	
	function checkFieldName($data){
		global $conn;
		$result = null;	
		$field_category = $data['0']['1'];
		$field_name = $data['0']['2'];
					
		$sql = "SELECT * FROM dropdowns
			WHERE (field_category = '$field_category'
				AND field_name = '$field_name')";
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
	
	
	function addProgram($data){
		global $conn;
		$result = null;	
		$field_category = $data['0']['2'];
		$field_name = $data['0']['6'].$data['0']['7'];
		$program_strand = $data['0']['4'];
		$program_combo = $data['0']['5'];
				
		$sql = "INSERT INTO dropdowns (field_category, field_name, field_ext)
			VALUES('TRACK', '$field_name', '-')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) added.");
		}		

		$sql = "INSERT INTO dropdowns (field_category, field_name, field_ext)
			VALUES('COMBO-$program_strand', '$program_combo', '-')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) added.");
		}		
		
		return $result;				
	}


	function updateSort($data){
		global $conn;
		$result = null;	
		$pros_level2 = $data['0']['1'];
		$pros_sem2 = $data['0']['2'];
		$pros_track2 = $data['0']['3'];
		$pros_curr = $data['0']['4'];
					
		$sql = "SELECT * FROM prospectus
			WHERE (pros_level = '$pros_level2'
				AND pros_sem = '$pros_sem2'
				AND pros_track = '$pros_track2'
				AND pros_curr = '$pros_curr')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else if($rs->num_rows == 0){
			$result = array(0, "0 record(s) found.", 0, 0);
		} else {
			$result = array(1, $rs->num_rows . " record(s) found.", $rs, $rs->num_rows);
		}		
		
		return $result;				
	}
	
	
	function addSubject($data){
		global $conn;
		$result = null;	
		$pros_level = $data['0']['2']; 
		$pros_sem = $data['0']['3'];
		$pros_track = $data['0']['4'];
		$pros_title = $data['0']['5'];
		$pros_desc = $data['0']['6'];
		$pros_unit = $data['0']['7'];
		$pros_hoursPerWk = $data['0']['8'];
		$pros_cutoff = $data['0']['9'];
		$pros_prereq = $data['0']['10'];
		$pros_curr = $data['0']['11'];
		$pros_sort = $data['0']['12'];
		$pros_part = $data['0']['13'];
				
		$sql = "INSERT INTO prospectus (pros_level, pros_sem, pros_track, pros_title, pros_desc, 
				pros_unit, pros_hoursPerWk, pros_cutoff, pros_prereq, pros_curr, pros_sort, pros_part)
			VALUES('$pros_level', '$pros_sem', '$pros_track', '$pros_title', '$pros_desc', 
				'$pros_unit', '$pros_hoursPerWk', '$pros_cutoff', '$pros_prereq', '$pros_curr', '$pros_sort', '$pros_part')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) added.");
		}		
		
		return $result;		
	}
	
	
	function checkSubjectCode($data){
		global $conn;
		$result = null;	
		$pros_title = $data['0']['1'];
		$pros_track2 = $data['0']['2'];
		$pros_curr = $data['0']['3'];
					
		$sql = "SELECT * FROM prospectus
			WHERE (pros_title = '$pros_title'
				AND pros_track = '$pros_track2'
				AND pros_curr = '$pros_curr')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else if($rs->num_rows == 0){
			$result = array(0, "0 record(s) found.", 0, 0);
		} else {
			$result = array(1, $rs->num_rows . " record(s) found.", $rs, $rs->num_rows);
		}		
		
		return $result;				
	}
	
	
	function getSubject($data){
		global $conn;
		$result = null;	
		$pros_no = $data['0']['2'];
					
		$sql = "SELECT * FROM prospectus
			WHERE (pros_no = '$pros_no')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else if($rs->num_rows == 0){
			$result = array(0, "0 record(s) found.", 0, 0);
		} else {
			$result = array(1, $rs->num_rows . " record(s) found.", $rs->fetch_assoc(), $rs->num_rows);
		}		
		
		return $result;				
	}
	
	
	function deleteSubject($data){
		global $conn;
		$result = null;	
		$pros_no = $data['0']['2'];
					
		$sql = "DELETE FROM prospectus
			WHERE (pros_no = '$pros_no')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) deleted.");
		}		

		return $result;
	}
	
	function modifySubject($data){
		global $conn;
		$result = null;	
		$pros_level = $data['0']['2']; 
		$pros_sem = $data['0']['3'];
		$pros_track = $data['0']['4'];
		$pros_title = $data['0']['5'];
		$pros_desc = $data['0']['6'];
		$pros_unit = $data['0']['7'];
		$pros_hoursPerWk = $data['0']['8'];
		$pros_cutoff = $data['0']['9'];
		$pros_prereq = $data['0']['10'];
		$pros_part = $data['0']['13'];
		$pros_no = $data['0']['14'];
				
		$sql = "UPDATE prospectus 
			SET pros_level = '$pros_level', 
				pros_sem = '$pros_sem', 
				pros_track = '$pros_track', 
				pros_title = '$pros_title', 
				pros_desc = '$pros_desc', 
				pros_unit = '$pros_unit', 
				pros_hoursPerWk = '$pros_hoursPerWk', 
				pros_cutoff = '$pros_cutoff', 
				pros_prereq = '$pros_prereq', 
				pros_part = '$pros_part'
			WHERE (pros_no = '$pros_no')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) updated.");
		}		
		
		return $result;			
	}
	
	
	function checkProspectusAssociation($data){
		global $conn;
		$result = null;	
		$pros_no = $data['0']['1'];
					
		$sql = "SELECT * FROM class
			WHERE (class_pros_no = '$pros_no')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else if($rs->num_rows == 0){
			$result = array(0, "0 record(s) found.", 0, 0);
		} else {
			$result = array(1, $rs->num_rows . " record(s) found.", $rs->fetch_assoc(), $rs->num_rows);
		}		
		
		return $result;				
	}
}
