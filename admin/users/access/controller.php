<?php
/*
 * Controller Class 
 * This class is used for Admin-Classes operations
 * @author    	Fernando B. Enad
 * @url        	n/a
 * @license    	n/a
 */
 
class Controller{
	
	function getModules(){
		global $conn;
		$result = null;	
			
		$sql = "SELECT * FROM module
			ORDER BY module_name ASC";
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
	
	
	function checkSlug($data){
		global $conn;
		$result = null;	
		$module_slug = $data['0']['1'];
			
		$sql = "SELECT * FROM module
			WHERE (module_slug LIKE '$module_slug')";
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
	
	
	function addModule($data){
		global $conn;
		$result = null;	
		$module_slug = mysqli_real_escape_string($conn, trim($data['0']['2']));
		$module_name = mysqli_real_escape_string($conn, trim($data['0']['3']));
			
		$sql = "INSERT INTO module (module_slug, module_name)
			VALUES ('$module_slug', '$module_name')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) added.", $rs, $conn->insert_id);
		}	
		
		return $result;				
	}
	
	
	function getAccessList($data){
		global $conn;
		$result = null;	
		$modacc_module_slug = $data['0']['1'];
			
		$sql = "SELECT * FROM module_access
			INNER JOIN users ON modacc_user_no = user_no
			INNER JOIN module ON modacc_module_slug = module_slug
			WHERE (modacc_module_slug LIKE '$modacc_module_slug')";
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
	
	
	function getUsers(){
		global $conn;
		$result = null;	
			
		$sql = "SELECT * FROM users
			WHERE (user_status = '1'
				AND user_role != '1')
			ORDER BY user_fullname ASC";
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
	
	
	function updateModule($data){
		global $conn;
		$result = null;	
		$modacc_user_no = $data['0']['1'];
			
		$sql = "SELECT * FROM module
			WHERE (module_slug NOT IN (SELECT modacc_module_slug FROM module_access
				WHERE (modacc_user_no = '$modacc_user_no')))";
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
	
	
	function addAccess($data){
		global $conn;
		$result = null;	
		$modacc_user_no = $data['0']['2'];
		$modacc_module_slug = $data['0']['3'];
		$modacc_role = $data['0']['4'];
			
		$sql = "INSERT INTO module_access (modacc_user_no, modacc_module_slug, modacc_role)
			VALUES ('$modacc_user_no', '$modacc_module_slug', '$modacc_role')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) added.", $rs, $conn->insert_id);
		}	
		
		return $result;			
	}
	
	
	function getAccess($data){
		global $conn;
		$result = null;	
		$modacc_no  = $data['0']['2'];
			
		$sql = "SELECT * FROM module_access 
			WHERE (modacc_no = '$modacc_no ')";
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
	
	
	function modifyAccess($data){
		global $conn;
		$result = null;	
		$modacc_role = $data['0']['2'];
		$modacc_no = $data['0']['3'];

			
		$sql = "UPDATE module_access
			SET modacc_role = '$modacc_role'
			WHERE (modacc_no = '$modacc_no')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) deleted.");
		}	
		
		return $result;			
	}
	
	
	function deleteAccess($data){
		global $conn;
		$result = null;	
		$modacc_no  = $data['0']['2'];

			
		$sql = "DELETE FROM  module_access
			WHERE(modacc_no = '$modacc_no')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) deleted.");
		}	
		
		return $result;			
	}
	
	
	function checkAccess($data){
		global $conn;
		$result = null;	
		$modacc_user_no  = $data['0']['1'];
		$modacc_module_slug  = $data['0']['2'];
			
		$sql = "SELECT * FROM module_access 
			WHERE (modacc_user_no = '$modacc_user_no'
				AND modacc_module_slug = '$modacc_module_slug')";
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
}