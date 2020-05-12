<?php
/*
 * Controller Class 
 * This class is used for Admin-Classes operations
 * @author    	Fernando B. Enad
 * @url        	n/a
 * @license    	n/a
 */
 
class Controller{
	
	function getStatus($data){
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
		

	function userModifyLogin($data){
		global $conn;
		$result = null;	
		$stud_no = $data['0']['1'];
		$option = $data['0']['2'];
		$modifier = $_SESSION['user_no'];

		$sql = "UPDATE student 
			SET $option , 
				stud_lastmod_user_id = '$modifier',
				stud_lastmoddatetime = NOW()
			WHERE (stud_no = '$stud_no')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) updated.");
		}
		
		return $result;		
	}
	
	
	function getBasic($data){
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
	
	
	function modifyEntity($data){
		global $conn;
		$result = null;
		$user_no = $_SESSION['user_no'];
		$stud_lrn = $data['0']['1'];
		$stud_fname = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['2'])));
		$stud_mname = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['3'])));
		$stud_lname = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['4'])));
		$stud_xname = $data['0']['5'];
		$stud_gender = $data['0']['6'];
		$stud_bdate = $data['0']['7'];
		$stud_residence = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['8'])));
		$stud_religion = $data['0']['9'];
		$stud_dialect = $data['0']['10'];
		$stud_ethnicity = $data['0']['11'];
		$stud_cct = $data['0']['12'];
		$stud_no = $data['0']['13'];
		
		$sql = "UPDATE student 
			SET stud_lrn = '$stud_lrn', 
				stud_fname = '$stud_fname', 
				stud_mname = '$stud_mname', 
				stud_lname = '$stud_lname', 
				stud_xname = '$stud_xname', 
				stud_gender = '$stud_gender', 
				stud_bdate = '$stud_bdate', 
				stud_residence = '$stud_residence', 
				stud_religion = '$stud_religion', 
				stud_dialect = '$stud_dialect', 
				stud_ethnicity = '$stud_ethnicity', 
				stud_cct = '$stud_cct',
				stud_lastmod_user_id = '$user_no',
				stud_lastmoddatetime = NOW()
			WHERE (stud_no = '$stud_no')";		
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
		$studCont_stud_no  = $data['0']['1'];
		
		$sql = "SELECT * FROM studcontacts 
			WHERE (studCont_stud_no  = '$studCont_stud_no ')";
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
	
	
	function checkLRN($data){
		global $conn;
		$result = null;	
		$stud_lrn = $data['0']['1'];
		
		$sql = "SELECT * FROM student 
			WHERE (stud_lrn = '$stud_lrn')";
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
	
	
	function getFamilyDetails($data){
		global $conn;
		$result = null;	
		$studCont_no = $data['0']['2'];
		
		$sql = "SELECT * FROM studcontacts 
			WHERE (studCont_no   = '$studCont_no')";
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
		$studCont_no = $data['0']['2'];
		$studCont_stud_ffname = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['3'])));
		$studCont_stud_fmname = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['4'])));
		$studCont_stud_flname = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['5'])));
		$studCont_stud_mfname = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['6'])));
		$studCont_stud_mmname = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['7'])));
		$studCont_stud_mlname = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['8'])));
		$studCont_stud_gfname = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['9'])));
		$studCont_stud_gmname = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['10'])));
		$studCont_stud_glname = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['11'])));
		$studCont_stud_grelation = $data['0']['12'];
		$studCont_stud_gcontact = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['13'])));
		
		$sql = "UPDATE studcontacts
			SET studCont_stud_ffname = '$studCont_stud_ffname', 
				studCont_stud_fmname = '$studCont_stud_fmname', 
				studCont_stud_flname = '$studCont_stud_flname', 
				studCont_stud_mfname = '$studCont_stud_mfname', 
				studCont_stud_mmname = '$studCont_stud_mmname', 
				studCont_stud_mlname = '$studCont_stud_mlname', 
				studCont_stud_gfname = '$studCont_stud_gfname', 
				studCont_stud_gmname = '$studCont_stud_gmname', 
				studCont_stud_glname = '$studCont_stud_glname', 
				studCont_stud_grelation = '$studCont_stud_grelation', 
				studCont_stud_gcontact = '$studCont_stud_gcontact'
			WHERE (studCont_no = '$studCont_no')";		
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) updated.");
		}
		
		return $result;			
	}
	
	
	function getSchedules($data, $tablejoin, $condition, $option){
		global $conn;
		$result = null;	
		$grade_stud_no = $data['0']['1'];
		$grade_sy = $data['0']['2'];

		$sql = "SELECT * FROM grade $tablejoin
			WHERE (grade_sy = '$grade_sy'
				AND grade_stud_no = '$grade_stud_no'
				$condition)
			$option";
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
	
	
	function getEnrollment($data){
		global $conn;
		$result = null;	
		$grade_no = $data['0']['2'];

		$sql = "SELECT * FROM grade 
			INNER JOIN class ON grade_class_no = class_no
			INNER JOIN section ON class_section_no = section_no
			INNER JOIN prospectus ON class_pros_no = pros_no
			INNER JOIN teacher ON class_user_name  = teach_no
			WHERE (grade_no = '$grade_no')";
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
	
	
	function getSubject($data, $condition){
		global $conn;
		$result = null;	
		$class_sy = $data['0']['3'];

		$sql = "SELECT * FROM class 
			INNER JOIN prospectus ON class_pros_no = pros_no
			INNER JOIN section ON class_section_no = section_no
			INNER JOIN teacher ON class_user_name  = teach_no
			WHERE (class_sy = '$class_sy'
				$condition)";
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
	
	
	function modifyEnrollment($data){
		global $conn;
		$result = null;	
		$grade_no = $data['0']['2'];
		$grade_class_no = $data['0']['3'];

		$sql = "UPDATE grade
			SET grade_class_no = '$grade_class_no'
			WHERE (grade_no = '$grade_no')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) updated.");
		}
		
		return $result;				
	}
	
	
	function getSubjects($data){
		global $conn;
		$result = null;	
		$grade_stud_no = $data['0']['2'];
		$grade_sy = $data['0']['3'];
		$grade_sem = $data['0']['4'];
		$pros_level = $data['0']['5'];
		$condition = ($pros_level > 10 ? " AND pros_level > 10 " : " AND pros_level  = '$pros_level' ");
		$grade_sem = ($pros_level > 10 ? $grade_sem : 12); 
		
		$sql = "SELECT * FROM class 
			INNER JOIN prospectus ON class_pros_no = pros_no
			INNER JOIN section ON class_section_no = section_no
			INNER JOIN teacher ON class_user_name  = teach_no
			WHERE (pros_no NOT IN (SELECT class_pros_no FROM grade
				INNER JOIN class on grade_class_no = class_no
				WHERE grade_stud_no = '$grade_stud_no'
					AND grade_sy ='$grade_sy'
					AND grade_sem = '$grade_sem')
				AND class_sy = '$grade_sy'
				AND class_sem = '$grade_sem'
				$condition)
			ORDER BY pros_title ASC";
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
	
	
	function addSubject($data){
		global $conn;
		$result = null;	
		$grade_stud_no = $data['0']['2'];
		$grade_class_no = $data['0']['3'];
		$grade_sy = $data['0']['4'];
		$grade_sem = $data['0']['5'];
		$level = $data['0']['6'];
		$grade_sem = ($level > 10 ? $grade_sem : 12);

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
	
	
	function deleteSubject($data){
		global $conn;
		$result = null;	
		$grade_no = $data['0']['2'];

		$sql = "DELETE FROM grade 
			WHERE (grade_no = '$grade_no')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) deleted.");
		}
		
		return $result;		
	}
	
	
	function getGrades($data, $tablejoin, $condition, $option){
		global $conn;
		$result = null;	
		$grade_stud_no = $data['0']['1'];

		$sql = "SELECT * FROM grade $tablejoin
			WHERE (grade_stud_no = '$grade_stud_no'
				$condition)
			$option";
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
	
	
	function getGrade($data){
		global $conn;
		$result = null;	
		$grade_no = $data['0']['2'];

		$sql = "SELECT * FROM grade
			INNER JOIN class ON grade_class_no = class_no
			INNER JOIN prospectus ON class_pros_no = pros_no
			INNER JOIN teacher ON class_user_name = teach_no
			INNER JOIN student ON grade_stud_no = stud_no
			WHERE (grade_no = '$grade_no')";
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
	
	
	function modifyGrade($data){
		global $conn;
		$result = null;	
		$user_no = $_SESSION['user_no'];
		$grade_no = $data['0']['2'];
		$grade_q1 = $data['0']['3'];
		$grade_q2 = $data['0']['4'];
		$grade_q3 = $data['0']['5'];
		$grade_q4 = $data['0']['6'];
		$grade_final = $data['0']['7'];
		$grade_remarks = $data['0']['8'];
		$grade_remedialgrade = $data['0']['9'];
		$grade_recomputedfinalgrade = $data['0']['10'];
		$grade_finalremarks = $data['0']['11'];
		$grade_notes = $data['0']['12'];

		$sql = "UPDATE grade 
			SET grade_q1 = '$grade_q1', 
				grade_q2 = '$grade_q2', 
				grade_q3 = '$grade_q3', 
				grade_q4 = '$grade_q4', 
				grade_final = '$grade_final', 
				grade_remarks = '$grade_remarks', 
				grade_remedialgrade = '$grade_remedialgrade', 
				grade_recomputedfinalgrade = '$grade_recomputedfinalgrade', 
				grade_finalremarks = '$grade_finalremarks', 
				grade_notes = '$grade_notes',
				grade_lastuser_no = '$user_no',
				grade_lastupdated = NOW()
			WHERE (grade_no = '$grade_no')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) updated.");
		}
		
		return $result;			
	}
	
	
	function getHistoricalSubjects($data){
		global $conn;
		$result = null;	
		$pros_sem = $data['0']['3'];
		$pros_level = $data['0']['4'];
		$grade_stud_no = $data['0']['5'];
		$condition = ($pros_level > 10 ? " pros_level > 10 " : " pros_level = '$pros_level' AND pros_sem = '$pros_sem' ");

		$sql = "SELECT * FROM prospectus
			WHERE ($condition AND pros_no NOT IN (SELECT class_pros_no FROM grade
					INNER JOIN class ON grade_class_no = class_no
					WHERE (grade_stud_no = '$grade_stud_no')))
			ORDER BY pros_track ASC, pros_level ASC, pros_title ASC";
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
	
	
	function addHistoricalSubject($data){
		global $conn;
		$result = null;	
		$class_sem = $data['0']['2'];
		$class_sy = $data['0']['3'];
		$class_pros_no = $data['0']['5'];

		$sql = "INSERT INTO class(class_sy, class_sem, class_pros_no, class_section_no, 
				class_timeslots, class_days, class_room, class_user_name)
			VALUES('$class_sy', '$class_sem', '$class_pros_no', '0', 
				'00:00-00:00', '-', '-', '1')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) added.", $conn->insert_id);
		}
		
		return $result;					
	}
	
	
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
	
	
	function saveEntity($data){
		global $conn, $default_pass;
		$result = null;	
		$user_no = $_SESSION['user_no'];
		$stud_lrn = $data['0']['1'];
		$stud_fname = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['2'])));
		$stud_mname = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['3'])));
		$stud_lname = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['4'])));
		$stud_xname = $data['0']['5'];
		$stud_gender = $data['0']['6'];
		$stud_bdate = $data['0']['7'];
		$stud_residence = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['8'])));
		$stud_cct  = $data['0']['9'];
		$stud_password = MD5($default_pass);
		
		$sql = "INSERT INTO student(stud_lrn, stud_fname, stud_mname, stud_lname, stud_xname, stud_gender, 
				stud_bdate, stud_residence, stud_cct, stud_religion, stud_dialect, stud_ethnicity, stud_username, stud_password,
				stud_create_user_id, stud_creaatedatetime, stud_lastmod_user_id, stud_lastmoddatetime, stud_status, stud_credentials)
			VALUES('$stud_lrn', '$stud_fname', '$stud_mname', '$stud_lname', '$stud_xname', '$stud_gender', 
				'$stud_bdate', '$stud_residence', '$stud_cct', '', '', '', '', '$stud_password',
				'$user_no', NOW(), '$user_no', NOW(), '1', ',')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) added.", $conn->insert_id);
		}
				
		return $result;				
	}
	
	
	function addContact($data){
		global $conn;
		$result = null;	
		$studCont_stud_no = $data['0']['1'];
		
		$sql = "INSERT INTO studcontacts(studCont_stud_no)
			VALUES('$studCont_stud_no')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) added.", $conn->insert_id);
		}
				
		return $result;				
	}
	
	
	function checkStudentDetails($data){
		global $conn;
		$result = null;	
		$stud_no = $data['0']['1'];

		$sql = "SELECT * FROM student 
			INNER JOIN studcontacts ON stud_no = studCont_stud_no 
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
	
	
	function checkEnrollmentHistory($data){
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
			$result = array(1, $rs->num_rows . " record(s) found.", $rs, $rs->num_rows);
		}
		
		return $result;			
	}
	
	
	function getSYs($data){
		global $conn;
		$result = null;	
		$enrol_stud_no = $data['0']['2'];
		$current_sy = $_SESSION['current_sy'];

		$sql = "SELECT * FROM settings
			WHERE (settings_sy NOT IN (SELECT enrol_sy FROM studenroll
				WHERE(enrol_stud_no = '$enrol_stud_no'))
				AND (settings_sy < '$current_sy'))
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
	
	
	function addHistory($data){
		global $conn;
		$result = null;	
		$user_no = $_SESSION['user_no'];
		$enrol_stud_no = $data['0']['2'];
		$enrol_sy = $data['0']['3'];
		$enrol_level = $data['0']['4'];
		$enrol_average = $data['0']['5'];
		$enrol_graddate = $data['0']['6'];
		$enrol_status2 = $data['0']['7'];
		$enrol_track2 = $data['0']['8'];
		$enrol_strand2 = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['9'])));
		$enrol_track = $data['0']['10'];
		$enrol_strand = $data['0']['11'];
		$enrol_combo = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['12'])));
		$enrol_school_0 = $data['0']['13'];
		$enrol_school_1 = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['14'])));
		$enrol_school_2 = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['15'])));
		$enrol_eligibility = $data['0']['16'];
		$enrol_section = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['17'])));
		$enrol_remarks = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['18'])));
		
		$enrol_school = serialize(array($enrol_school_0, $enrol_school_1, $enrol_school_2));

		
		if($enrol_level <= 10 ){
			$enrol_track = $enrol_track2;
			$enrol_strand = $enrol_strand2;
			$enrol_combo = "";
		}
		
		if($enrol_status2 == "PROMOTED" || $enrol_status2 == "IRREGULAR" || $enrol_status2 == "RETAINED"){
			$enrol_status1 = "PROMOTED";
		} else {
			$enrol_status1 = "INACTIVE";
		}
			
		
		$sql = "INSERT INTO studenroll (enrol_stud_no, enrol_sy, enrol_level, enrol_average, enrol_graddate, enrol_status1, enrol_status2, 
				enrol_track, enrol_strand, enrol_combo, enrol_eligibility, enrol_school, enrol_section, enrol_remarks,
				enrol_username, enrol_updatedate)
			VALUES('$enrol_stud_no', '$enrol_sy', '$enrol_level', '$enrol_average', '$enrol_graddate', '$enrol_status1', '$enrol_status2', 
				'$enrol_track', '$enrol_strand', '$enrol_combo', '$enrol_eligibility', '$enrol_school', '$enrol_section', '$enrol_remarks',
				'$user_no', NOW())";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) added.", $conn->insert_id);
		}
				
		return $result;			
	}
	
	
	function addSchooldays($data){
		global $conn;
		$result = null;	
		$sch_stud_no = $data['0']['1'];
		$sch_sy = $data['0']['2'];
		
		$sql = "INSERT INTO school_days (sch_stud_no, sch_sy)
			VALUES('$sch_stud_no', '$sch_sy')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) added.", $conn->insert_id);
		}
				
		return $result;			
	}
	
	
	function getHistory($data){
		global $conn;
		$result = null;	
		$enrol_no = $data['0']['2'];

		$sql = "SELECT * FROM studenroll
			WHERE (enrol_no = '$enrol_no')";
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
	
	
	function modifyHistory($data){
		global $conn;
		$result = null;	
		$user_no = $_SESSION['user_no'];
		$enrol_stud_no = $data['0']['2'];
		$enrol_sy = $data['0']['3'];
		$enrol_level = $data['0']['4'];
		$enrol_average = $data['0']['5'];
		$enrol_graddate = $data['0']['6'];
		$enrol_status2 = $data['0']['7'];
		$enrol_track2 = $data['0']['8'];
		$enrol_strand2 = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['9'])));
		$enrol_track = $data['0']['10'];
		$enrol_strand = $data['0']['11'];
		$enrol_combo = mysqli_real_escape_string($conn, trim($data['0']['12']));
		$enrol_school_0 = $data['0']['13'];
		$enrol_school_1 = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['14'])));
		$enrol_school_2 = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['15'])));
		$enrol_eligibility = $data['0']['16'];
		$enrol_section = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['17'])));
		$enrol_remarks = mysqli_real_escape_string($conn, strtoupper(trim($data['0']['18'])));
		$enrol_no = $data['0']['19'];
		
		$enrol_school = serialize(array($enrol_school_0, $enrol_school_1, $enrol_school_2));

		
		if($enrol_level <= 10 ){
			$enrol_track = $enrol_track2;
			$enrol_strand = $enrol_strand2;
			$enrol_combo = "";
		}
		
		if($enrol_status2 == "PROMOTED" || $enrol_status2 == "IRREGULAR" || $enrol_status2 == "RETAINED"){
			$enrol_status1 = "PROMOTED";
		} else {
			$enrol_status1 = "INACTIVE";
		}
			
		
		$sql = "UPDATE studenroll
			SET	enrol_level = '$enrol_level', 
				enrol_average = '$enrol_average', 
				enrol_graddate = '$enrol_graddate', 
				enrol_status1 = '$enrol_status1', 
				enrol_status2 = '$enrol_status2', 
				enrol_track = '$enrol_track', 
				enrol_strand = '$enrol_strand', 
				enrol_combo = '$enrol_combo', 
				enrol_eligibility = '$enrol_eligibility', 
				enrol_school = '$enrol_school', 
				enrol_section = '$enrol_section', 
				enrol_remarks = '$enrol_remarks',
				enrol_username = '$user_no', 
				enrol_updatedate = NOW()
			WHERE enrol_no = '$enrol_no'";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) updated.");
		}
				
		return $result;			
	}	
	
	
	function deleteHistory($data){
		global $conn;
		$result = null;	
		$enrol_no = $data['0']['2'];

		$sql = "DELETE FROM studenroll
			WHERE (enrol_no = '$enrol_no')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) deleted.");
		}
		
		return $result;		
	}
	
	
	function deleteSchoolDays($data){
		global $conn;
		$result = null;	
		$sch_sy = $data['0']['1'];
		$sch_stud_no = $data['0']['2'];

		$sql = "DELETE FROM school_days
			WHERE (sch_sy = '$sch_sy'
				AND sch_stud_no = '$sch_stud_no')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) deleted.");
		}
		
		return $result;		
	}


	function deleteCoreValues($data){
		global $conn;
		$result = null;	
		$coreval_enrol_sy = $data['0']['1'];
		$coreval_stud_no = $data['0']['2'];

		$sql = "DELETE FROM student_corevalues
			WHERE (coreval_enrol_sy = '$coreval_enrol_sy'
				AND coreval_stud_no = '$coreval_stud_no')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) deleted.");
		}
		
		return $result;		
	}
	
	
	function deleteSubjects($data){
		global $conn;
		$result = null;	
		$grade_sy = $data['0']['1'];
		$grade_stud_no = $data['0']['2'];

		$sql = "DELETE FROM grade
			WHERE (grade_sy = '$grade_sy'
				AND grade_stud_no = '$grade_stud_no')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) deleted.");
		}
		
		return $result;		
	}
	
	
	function checkAssociations($data){
		global $conn, $min_grade;
		$result = null;	
		$grade_sy = $data['0']['1'];
		$grade_stud_no = $data['0']['2'];

		$sql = "SELECT * FROM grade
			WHERE (grade_sy = '$grade_sy'
				AND grade_stud_no = '$grade_stud_no'
				AND (grade_q1 >= '$min_grade' 
					OR grade_q2 >= '$min_grade'
					OR grade_q3 >= '$min_grade'
					OR grade_q4 >= '$min_grade'))";
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
	
	
	function getSections($section_sy, $section_level){
		global $conn;
		$result = null;	

		$sql = "SELECT * FROM section
			WHERE (section_sy = '$section_sy'
				AND section_level LIKE '$section_level'
				AND section_bogus = '0')
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
	
	
	function getCurrent($data){
		global $conn;
		$result = null;	
		$enrol_no = $data['0']['2'];

		$sql = "SELECT * FROM studenroll
			WHERE (enrol_no = '$enrol_no')";
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
	
	
	function modifyCurrent($data){
		global $conn;
		$result = null;	
		$user_no = $_SESSION['user_no'];
		$enrol_sy = $data['0']['2'];
		$enrol_stud_no = $data['0']['3'];
		$enrol_level = $data['0']['4'];
		$enrol_section = $data['0']['5'];
		$enrol_remarks = mysqli_real_escape_string($conn, trim($data['0']['6']));
		$enrol_track = $data['0']['7'];
		$enrol_strand = $data['0']['8'];
		$enrol_combo  = $data['0']['9'];
		$enrol_no  = $data['0']['10'];

		
		$sql = "UPDATE studenroll
			SET enrol_level = '$enrol_level', 
				enrol_section = '$enrol_section', 
				enrol_remarks = '$enrol_remarks', 
				enrol_track = '$enrol_track', 
				enrol_strand = '$enrol_strand', 
				enrol_combo = '$enrol_combo', 
				enrol_username = '$user_no', 
				enrol_updatedate = NOW()
			WHERE (enrol_no = '$enrol_no')";		
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) updated.");
		}
		
		return $result;			
	}
	
	
	function getSemStatus($data, $condition){
		global $conn, $pass_grade;
		$result = null;	
		$grade_stud_no = $data['0']['2'];
		$grade_sy = $data['0']['3'];
		$grade_sem = $data['0']['4'];

		$sql = "SELECT * FROM grade
			WHERE (grade_stud_no = '$grade_stud_no'
				AND grade_sy = '$grade_sy'
				AND grade_sem = '$grade_sem'
				$condition )";
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
	
	
	function getOfferings($data){
		global $conn;
		$result = null;	
		$class_sy = $data['0']['3'];
		$class_sem = $data['0']['4'];
		$enrol_section = $data['0']['5'];

		$sql = "SELECT * FROM class 
			INNER JOIN prospectus ON class_pros_no = pros_no 
			INNER JOIN section ON class_section_no = section_no 
			WHERE (section_name LIKE '$enrol_section' 
				AND class_sy = '$class_sy' 
				AND class_sem = '$class_sem')
			ORDER BY class_timeslots ASC";			
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
	
	
	function getSubjectStatus($data, $class_pros_no){
		global $conn;
		$result = null;	
		$grade_stud_no = $data['0']['2'];
		$class_sy = $data['0']['3'];
		$class_sem = $data['0']['4'];
		$enrol_section = $data['0']['5'];

		$sql = "SELECT * FROM grade 
			INNER JOIN class ON grade_class_no = class_no
			INNER JOIN prospectus ON class_pros_no = pros_no 
			INNER JOIN section ON class_section_no = section_no 
			WHERE (class_pros_no = '$class_pros_no'
				AND grade_stud_no = '$grade_stud_no')
			ORDER BY class_timeslots ASC";			
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
	
	
	function enrollSem2($data, $class_no){
		global $conn;
		$result = null;	
		$grade_stud_no = $data['0']['2'];
		$grade_sy = $data['0']['3'];
		$grade_sem = $data['0']['4'];

		$sql = "INSERT INTO grade (grade_sy, grade_sem, grade_class_no, grade_stud_no)
			VALUES('$grade_sy', '$grade_sem', '$class_no', '$grade_stud_no')";			
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) added.", $conn->insert_id);
		}
		
		return $result;			
	}
	
	
	function deleteSem2($data){
		global $conn;
		$result = null;	
		$grade_stud_no = $data['0']['2'];
		$grade_sy = $data['0']['3'];
		$grade_sem = $data['0']['4'];

		$sql = "DELETE FROM grade 
			WHERE (grade_stud_no = '$grade_stud_no'
				AND grade_sy = '$grade_sy'
				AND grade_sem = '$grade_sem')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) added.", $conn->insert_id);
		}
		
		return $result;			
	}
	
	
	function updateStatus($data){
		global $conn;
		$result = null;	
		$enrol_no = $data['0']['2'];
		$enrol_status1 = $data['0']['3'];
		$enrol_status2 = $data['0']['4'];
		$enrol_gradawards = $data['0']['5'];
		$enrol_graddate = $data['0']['6'];
		$enrol_remarks = $data['0']['7'];


		$sql = "UPDATE studenroll
			SET enrol_status1 = '$enrol_status1',
				enrol_status2 = '$enrol_status2',
				enrol_gradawards = '$enrol_gradawards',
				enrol_graddate = '$enrol_graddate',
				enrol_remarks = '$enrol_remarks'
			WHERE (enrol_no = '$enrol_no')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) updated.");
		}
		
		return $result;				
	}
}

?>