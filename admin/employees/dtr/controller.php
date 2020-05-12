<?php
/*
 * Controller Class 
 * This class is used for Employee-Services operations
 * @author    	Fernando B. Enad
 * @url        	n/a
 * @license    	n/a
 */
 
class Controller{
	
	function loadSYs(){
		global $conn;
		$result = null;	

		$sql = "SELECT * FROM checkinout  
			GROUP BY YEAR(CHECKTIME), MONTH(CHECKTIME)
			ORDER BY CHECKTIME DESC
			LIMIT 25";
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
	
	
	function getLogs($data){
		global $conn;
		$result = null;	
		$year = $data['0']['1'];
		$month = $data['0']['2'];
		$USERID = $data['0']['3'];
		$condition = $data['0']['4'];
		$option = $data['0']['5'];
		$min_date = $year."-".$month."-01";
		$max_date = $year."-".$month."-31";

		$sql = "SELECT * FROM checkinout 
			INNER JOIN teacher ON USERID = teach_bio_no
			WHERE (CHECKTIME BETWEEN '$min_date' AND '$max_date'
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
	
	
	function getMonth($data){
		$result = null;		
		$month = $data['0']['1'];
		$monthText = "";
		
		switch($month){
			case "01": $monthText = "January"; break;
			case "02": $monthText = "February"; break;
			case "03": $monthText = "March"; break;
			case "04": $monthText = "April"; break;
			case "05": $monthText = "May"; break;
			case "06": $monthText = "June"; break;
			case "07": $monthText = "July"; break;
			case "08": $monthText = "August"; break;
			case "09": $monthText = "September"; break;
			case "10": $monthText = "October"; break;
			case "11": $monthText = "November"; break;
			case "12": $monthText = "December"; break;
			default:  $monthText = "Month unknown";
		}
		
		$result = array($monthText);
		
		return $result ;
	}
	
	
	function loadEmployees($data){
		global $conn;
		$result = null;	
		$teach_status = $data['0']['1'];

		$sql = "SELECT * FROM teacher  
			WHERE (teach_status LIKE '$teach_status')
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
	
	
	function getRemarks($data, $CHECKTIME, $ml_checktype){
		global $conn;
		$result = null;	
		$year = $data['0']['1'];
		$month = $data['0']['2'];
		$ml_userid = $data['0']['3'];
		$ml_checkdate = date('Y-m-d', strtotime($CHECKTIME));
		$ml_checktime = date('H:i:s', strtotime($CHECKTIME));
		

		$sql = "SELECT * FROM missinglogs 
			WHERE (ml_userid = '$ml_userid'
				AND ml_checkdate LIKE '$ml_checkdate'
				AND ml_checktime LIKE '$ml_checktime'
				AND ml_checktype LIKE '$ml_checktype'
				AND ml_approve_user_no != '0')";
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
	
	
	function getMissingLogs($data){
		global $conn;
		$result = null;	
		$year = $data['0']['1'];
		$month = $data['0']['2'];
		$ml_userid = $data['0']['3'];
		$condition = $data['0']['4'];
		$option = $data['0']['5'];
		$min_date = $year."-".$month."-01";
		$max_date = $year."-".$month."-31";

		$sql = "SELECT * FROM missinglogs 
			INNER JOIN teacher ON ml_userid = teach_bio_no
			WHERE (ml_checkdate BETWEEN '$min_date' AND '$max_date'
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
	
	
	function getApplication($data){
		global $conn;
		$result = null;	
		$ml_no = $data['0']['2'];

		$sql = "SELECT * FROM missinglogs 
			INNER JOIN teacher ON ml_userid = teach_bio_no
			WHERE (ml_no = '$ml_no')";
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
	
	
	function processApplication($data){
		global $conn;
		$result = null;	
		$ml_no = $data['0']['2'];
		$ml_reason = $data['0']['3'];
		$ml_approve_user_no = $data['0']['4'];
		$ml_remarks = $data['0']['5'];
		
		$ml_reason .= " // ".$ml_remarks." (".date('m/d/Y h:m A')." GMT)";
		$ml_approve_user_no = ($ml_approve_user_no > 0 ? ($ml_approve_user_no * $_SESSION['user_no']) : ($ml_approve_user_no * $_SESSION['user_no']));

		$sql = "UPDATE missinglogs 
			SET ml_reason = '$ml_reason',
				ml_approve_user_no = '$ml_approve_user_no',
				ml_approve_regdatetime = NOW()
			WHERE (ml_no = '$ml_no')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) updated.");
		}
		
		return $result;			
	}
	
	
	function saveToLogs($data){
		global $conn;
		$result = null;	
		$USERID = $data['0']['2'];
		$CHECKTIME = $data['0']['3']." ".$data['0']['4'];
		$CHECKTYPE = $data['0']['5'];

		$sql = "INSERT checkinout(USERID, CHECKTIME, CHECKTYPE, VERIFYCODE, 
				SENDORID, Memoinfo, WorkCode, sn, UserExtFmt) 
			VALUES('$USERID', '$CHECKTIME', '$CHECKTYPE', '0', 
				'0', '0', '0', '0', '0')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) added.", $conn->insert_id);
		}
		
		return $result;			
	}
}
?>