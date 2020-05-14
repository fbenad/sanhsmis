<?php
/*
 * Controller Class 
 *
 * This class is used to execute MySQL-related operations for Employee->Academics. 
 * Request such as the CRUD operations are executed here as requested through the action.php file.
 * @author    	Fernando B. Enad
 * @license    	Public
 */
 
class Controller{
	
	function getTerms($data){
		global $conn;
		$result = null;	
		$id = $data['0']['1'];
		
		$sql = "SELECT * FROM class 
			INNER JOIN prospectus ON class_pros_no = pros_no 
			INNER JOIN teacher ON class_user_name = teach_no
			WHERE (class_user_name = '$id') 
			GROUP BY class_sy
			ORDER BY class_sy DESC, class_sem DESC, class_timeslots ASC, pros_sort ASC";
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
	
	
	function getSchedules($data){
		global $conn;
		$result = null;	
		$id = $data['0']['1'];
		$selectedSY = $data['0']['2'];
		
		$sql = "SELECT * FROM class 
			INNER JOIN prospectus ON class_pros_no = pros_no 
			INNER JOIN teacher ON class_user_name = teach_no
			WHERE (class_user_name = '$id' 
				AND class_sy = '$selectedSY') 
			GROUP BY class_sem
			ORDER BY class_sem DESC, class_timeslots ASC, pros_sort ASC";
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
	
	
	function getSchedules2($data, $selectedSem){
		global $conn;
		$result = null;	
		$id = $data['0']['1'];
		$selectedSY = $data['0']['2'];
		
		$sql = "SELECT * FROM class 
			INNER JOIN prospectus ON class_pros_no = pros_no 
			INNER JOIN teacher ON class_user_name = teach_no
			INNER JOIN section ON class_section_no = section_no
			WHERE (class_user_name = '$id' 
				AND class_sy = '$selectedSY'
				AND class_sem = '$selectedSem') 
			ORDER BY class_timeslots ASC, pros_sort ASC";
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


	function getClassList($data, $sequence){
		global $conn;
		$result = null;	
		$id = $data['0']['1'];
		$gender = $data['0']['2'];
		
		$sql = "SELECT * FROM grade
			INNER JOIN class ON grade_class_no = class_no
			INNER JOIN prospectus ON class_pros_no = pros_no 
			INNER JOIN student ON grade_stud_no = stud_no
			WHERE (class_no = '$id'
				AND stud_gender LIKE '$gender') 
			ORDER BY $sequence stud_lname ASC, stud_fname ASC";
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
	
	
	function getClassInfo($data){
		global $conn;
		$result = null;	
		$id = $data['0']['1'];
		
		$sql = "SELECT * FROM class 
			INNER JOIN prospectus ON class_pros_no = pros_no 
			INNER JOIN teacher ON class_user_name = teach_no
			INNER JOIN section ON class_section_no = section_no
			WHERE (class_no = '$id')";
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
	
	
	function submitGrades($data){
		global $conn, $pass_grade;
		$result = null;	
		$grade_no = $data['0']['1'];
		$grade_q1 = $data['0']['2'];
		$grade_q2 = $data['0']['3'];
		$grade_q3 = $data['0']['4'];
		$grade_q4 = $data['0']['5'];
		$level = $data['0']['6'];
		$user_no = $data['0']['7'];
		
		for($i = 0; $i < sizeof($grade_no); $i++){
			$no = $grade_no[$i];
			$q1 = $grade_q1[$i];
			$q2 = $grade_q2[$i];
			$q3 = $grade_q3[$i];
			$q4 = $grade_q4[$i];
			$final = 0;
			$remarks = 0;
			
			if($level > 10){
				$final = ($q1 == 0 || $q2 == 0 ? 0 : round(($q1+$q2)/2,0));
				$remarks = ($final >= $pass_grade ? 1 : 0);
			} else {
				$final = ($q1 == 0 || $q2 == 0 || $q3 == 0 || $q4 == 0 ? 0 : round(($q1+$q2+$q3+$q4)/4,0));
				$remarks = ($final >= $pass_grade ? 1 : 0);
			}
			
			$sql = "UPDATE grade
				SET grade_q1 = '$q1',
					grade_q2 = '$q2',
					grade_q3 = '$q3',
					grade_q4 = '$q4',
					grade_final = '$final',
					grade_remarks = '$remarks',
					grade_lastuser_no = '$user_no',
					grade_lastupdated = NOW()
				WHERE (grade_no = '$no')";
			$rs = $conn->query($sql);
		
			if(!$rs){
				$result = array(-1,$conn->error);
				break;
			} else {
				$result = array(1,"Record(s) updated.");
			}
		}
		return $result;			
	}
	
	
	function getStatus($data){
		global $conn;
		$result = null;	
		$id = $data['0']['1'];
		$sy = $data['0']['2'];
		
		$sql = "SELECT * FROM studenroll
			WHERE (enrol_stud_no = '$id'
				AND enrol_sy = '$sy')";
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
	
	
	function checkAdvisorhsip($data){
		global $conn;
		$result = null;	
		$id = $data['0']['1'];
		$sy = $data['0']['2'];
		
		$sql = "SELECT * FROM section
			INNER JOIN teacher ON section_adviser = teach_no
			WHERE (section_adviser LIKE '$id'
				AND section_sy = '$sy')";
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
	
	
	function getSectionInfo($data){
		global $conn;
		$result = null;	
		$id = $data['0']['1'];
		
		$sql = "SELECT * FROM section
			INNER JOIN teacher ON section_adviser = teach_no
			WHERE (section_no = '$id')";
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
	
	
	function getSectionStatistics($data){
		global $conn;
		$result = null;	
		$id = $data['0']['1'];
		$sname = $data['0']['2'];
		$sy = $data['0']['3'];
		$gender = $data['0']['4'];
		$option = $data['0']['5'];
		
		$sql = "SELECT stud_no FROM studenroll
			INNER JOIN section ON enrol_section = section_name
			INNER JOIN student ON enrol_stud_no = stud_no
			WHERE (section_no = '$id'
				AND stud_gender LIKE '$gender'
				AND enrol_sy = '$sy'
				$option)";
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
	
	
	function getSectionList($data, $sequence){
		global $conn;
		$result = null;	
		$id = $data['0']['1'];
		$sname = $data['0']['2'];
		$gender = $data['0']['4'];
		$sy = $data['0']['5'];
		$type = $data['0']['6'];
		
		$sql = "SELECT * FROM studenroll
			INNER JOIN section ON enrol_section = section_name
			INNER JOIN student ON enrol_stud_no = stud_no
			INNER JOIN school_days ON enrol_stud_no = sch_stud_no
			WHERE (section_no = '$id'
				AND stud_gender LIKE '$gender'
				AND enrol_sy = '$sy'
				AND sch_sy = '$sy'
				$type
				)
			ORDER BY $sequence stud_lname ASC, stud_fname ASC";
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
	
	
	function getEnrollmentStatus($data){
		global $conn;
		$result = null;	
		$id = $data['0']['1'];
		
		$sql = "SELECT * FROM studenroll
			INNER JOIN student ON enrol_stud_no = stud_no
			WHERE (enrol_no = '$id')";
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
	
	
	function updateStatus($data){
		global $conn;
		$result = null;	
		$id = mysqli_real_escape_string($conn, $data['0']['1']);
		$enrol_eligibility = mysqli_real_escape_string($conn, $data['0']['2']);
		$enrol_status1 = mysqli_real_escape_string($conn, $data['0']['3']);
		$enrol_status2 = mysqli_real_escape_string($conn, $data['0']['4']);
		$enrol_remarks = mysqli_real_escape_string($conn, $data['0']['5']);
		$enrol_average = mysqli_real_escape_string($conn, $data['0']['6']);
		$enrol_graddate = mysqli_real_escape_string($conn, $data['0']['7']);
		$enrol_gradawards = mysqli_real_escape_string($conn, $data['0']['8']);
		$enrol_username = $_SESSION['user_no'];
		
		$sql = "UPDATE studenroll
			SET enrol_eligibility = '$enrol_eligibility',
				enrol_status1 = '$enrol_status1',
				enrol_status2 = '$enrol_status2',
				enrol_remarks = '$enrol_remarks',
				enrol_average = '$enrol_average',
				enrol_graddate = '$enrol_graddate',
				enrol_gradawards = '$enrol_gradawards',
				enrol_username = '$enrol_username',
				enrol_updatedate = NOW()
			WHERE (enrol_no = '$id')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1,"Record(s) updated.");
		}
		
		return $result;		
	}
	
	
	function checkAcademics($data){
		global $conn;
		$result = null;	
		$id = $data['0']['1'];
		$sy = $data['0']['2'];
		
		$sql = "SELECT * FROM grade
			INNER JOIN class ON grade_class_no = class_no
			INNER JOIN prospectus ON class_pros_no = pros_no 
			WHERE (grade_stud_no = '$id'
				AND grade_sy = '$sy')";
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
	
	
	function finalizeSection($data){
		global $conn;
		$result = null;	
		$id = $data['0']['1'];
		
		$sql = "UPDATE section 
			SET section_status = '1',
				section_updatedate = NOW()
			WHERE (section_no = '$id')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1,$conn->error);
		} else {
			$result = array(1,"Record(s) updated.");
		}
		
		return $result;	
	}
	
	
	function getSectionInputForm($data){
		global $conn;
		$result = null;	
		$id = $data['0']['1'];
		$sequence = $data['0']['2'];
		$gender = $data['0']['3'];
		$sy = $data['0']['4'];
		$option = $data['0']['5'];
		$condition = $data['0']['6'];
		
		$sql = "SELECT * FROM studenroll
			INNER JOIN section ON enrol_section = section_name
			INNER JOIN student ON enrol_stud_no = stud_no
			$option
			WHERE (enrol_sy = '$sy'
				AND section_no = '$id'
				AND section_sy = '$sy'
				AND stud_gender LIKE '$gender'
				$condition)
			ORDER BY $sequence stud_lname ASC, stud_fname ASC";
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
	
	
	function checkAttendanceLimit($data){
		global $conn;
		$result = null;	
		$id = $data['0']['1'];
		
		$sql = "SELECT * FROM school_days
			WHERE (sch_sy = '$id'
				AND sch_stud_no = '$id')";
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
	
	
	function inputAttendance($data){
		global $conn;
		$result = null;	
		$id = $data['0']['1'];
		$sch_firstday = $data['0']['2'];
		$sch_m1 = $data['0']['3'];
		$sch_m2 = $data['0']['4'];
		$sch_m3 = $data['0']['5'];
		$sch_m4 = $data['0']['6'];
		$sch_m5 = $data['0']['7'];
		$sch_m6 = $data['0']['8'];
		$sch_m7 = $data['0']['9'];
		$sch_m8 = $data['0']['10'];
		$sch_m9 = $data['0']['11'];
		$sch_m10 = $data['0']['12'];
		$sch_m11 = $data['0']['13'];
		$sch_m12 = $data['0']['14'];
		
		for($i = 0; $i < sizeof($id); $i++){
			$idd = $id[$i];
			$firstday = $sch_firstday[$i];
			$m1 = $sch_m1[$i];
			$m2 = $sch_m2[$i];
			$m3 = $sch_m3[$i];
			$m4 = $sch_m4[$i];
			$m5 = $sch_m5[$i];
			$m6 = $sch_m6[$i];
			$m7 = $sch_m7[$i];
			$m8 = $sch_m8[$i];
			$m9 = $sch_m9[$i];
			$m10 = $sch_m10[$i];
			$m11 = $sch_m11[$i];
			$m12 = $sch_m12[$i];	
			
			$sql = "UPDATE school_days
				SET sch_firstday = '$firstday',
					sch_m1 = '$m1',
					sch_m2 = '$m2',
					sch_m3 = '$m3',
					sch_m4 = '$m4',
					sch_m5 = '$m5',
					sch_m6 = '$m6',
					sch_m7 = '$m7',
					sch_m8 = '$m8',
					sch_m9 = '$m9',
					sch_m10 = '$m10',
					sch_m11 = '$m11',
					sch_m12 = '$m12'
				WHERE (sch_no = '$idd')";
			$rs = $conn->query($sql);
			
			if(!$rs){
				$result = array(-1, $conn->error);
			} else {
				$result = array(1, "Record(s) updated.");
			}
		}
		
		return $result;			
	}
	
	
	function showCoreValues($data){
		global $conn;
		$result = null;	
		$id = $data['0']['1'];
		$coreval_enrol_sy  = $data['0']['2'];
		
		$sql = "SELECT * FROM student_corevalues
			WHERE (coreval_enrol_sy  = '$coreval_enrol_sy '
				AND coreval_stud_no  = '$id')";
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
	
	
	function inputCoreValues($data){
		global $conn;
		$result = null;	
		$id = $data['0']['1'];
		$q1 = $data['0']['2'];
		$q1_r = serialize($q1);
		$q2 = $data['0']['3'];
		$q2_r = serialize($q2);
		$q3 = $data['0']['4'];
		$q3_r = serialize($q3);
		$q4 = $data['0']['5'];
		$q4_r = serialize($q4);
		$q5 = $data['0']['6'];
		$q5_r = serialize($q5);
		$q6 = $data['0']['7'];
		$q6_r = serialize($q6);
		$q7 = $data['0']['8'];
		$q7_r = serialize($q7);
		
		$sql = "UPDATE student_corevalues
			SET coreval_q1 = '$q1_r',
				coreval_q2 = '$q2_r',
				coreval_q3 = '$q3_r',
				coreval_q4 = '$q4_r',
				coreval_q5 = '$q5_r',
				coreval_q6 = '$q6_r',
				coreval_q7 = '$q7_r'
			WHERE (coreval_no = '$id')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) updated.");
		}	

		return $result;
	}
	
	
	function showAnecdotalRecords($data){
		
	}
}
?>