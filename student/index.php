<?php
session_start();

if (isset($_SESSION['SANHSMIS_Employee'])) {
    unset($_SESSION['SANHSMIS_Employee']);
}

require_once("../config/dbconfig.php");
require_once("../config/settings.php");

if(isset($_GET['p'])){
	if ($_GET['p'] == "auth"){
		if(isset($_SESSION['SANHSMIS_Student'])?header("Location: ?p=lock"):"");
		$title = "Login Form";
		require_once("_header.php");
		require_once("_navbar_auth.php");
		require_once("auth/index.php");
	} else if ($_GET['p'] == "lock"){
		if(!isset($_SESSION['SANHSMIS_Student'])?header("Location: ?p=auth"):"");
		$title = "Student | Locked";
		$_SESSION['SANHSMIS_Locked'] = true;
		require_once("_header.php");
		require_once("_navbar_auth.php");
		require_once("auth/lock.php");	
	} else if ($_GET['p'] == "initial"){
		if(!isset($_SESSION['SANHSMIS_Student'])?header("Location: ?p=auth"):"");
		$title = "Employee | Initial Login";
		require_once("_header.php");
		require_once("_navbar_auth.php");
		require_once("auth/initial.php");
	} else if ($_GET['p'] == "logout"){
		unset($_SESSION['SANHSMIS_Student']);
		unset($_SESSION['SANHSMIS_Employee']);
		unset($_SESSION['stud_no']);
		unset($_SESSION['stud_fullname']);
		echo '<script> window.location = "?p=auth"; </script>';	
	} else if ($_GET['p'] == "my"){
		if(isset($_SESSION['SANHSMIS_Student']) && $_SESSION['stud_password'] == MD5($default_pass) ? header("Location: ?p=initial"):"");
		if(!isset($_SESSION['SANHSMIS_Student'])?header("Location: ?p=auth"):"");
		if($_SESSION['SANHSMIS_Locked'] == true ?header("Location: ?p=lock"):"");
		$title = "Student | Dashboard";
		require_once("_header.php");
		require_once("_navbar_my.php");
		require_once("my/index.php");	
	} else if ($_GET['p'] == "academics"){
		if(isset($_SESSION['SANHSMIS_Student']) && $_SESSION['stud_password'] == MD5($default_pass) ? header("Location: ?p=initial"):"");
		if(!isset($_SESSION['SANHSMIS_Student'])?header("Location: ?p=auth"):"");
		if($_SESSION['SANHSMIS_Locked'] == true ?header("Location: ?p=lock"):"");
		$title = "Student | My Academics";
		require_once("_header.php");
		require_once("_navbar_my.php");
		require_once("my/academics.php");	
	}else if ($_GET['p'] == "prospectus"){
		if(isset($_SESSION['SANHSMIS_Student']) && $_SESSION['stud_password'] == MD5($default_pass) ? header("Location: ?p=initial"):"");
		if(!isset($_SESSION['SANHSMIS_Student'])?header("Location: ?p=auth"):"");
		if($_SESSION['SANHSMIS_Locked'] == true ?header("Location: ?p=lock"):"");
		$title = "Student | Prospectus";
		require_once("_header.php");
		require_once("_navbar_my.php");
		require_once("my/prospectus.php");	
	}else if ($_GET['p'] == "tools"){
		if(isset($_SESSION['SANHSMIS_Student']) && $_SESSION['stud_password'] == MD5($default_pass) ? header("Location: ?p=initial"):"");
		if(!isset($_SESSION['SANHSMIS_Student'])?header("Location: ?p=auth"):"");
		if($_SESSION['SANHSMIS_Locked'] == true ?header("Location: ?p=lock"):"");
		$title = "Student | Tools";
		require_once("_header.php");
		require_once("_navbar_my.php");
		require_once("my/tools.php");	
	}else {
		if(isset($_SESSION['SANHSMIS_Student']) && $_SESSION['stud_password'] == MD5($default_pass) ? header("Location: ?p=initial"):"");
		if(!isset($_SESSION['SANHSMIS_Student'])?header("Location: ?p=auth"):"");
		if($_SESSION['SANHSMIS_Locked'] == true ?header("Location: ?p=lock"):"");		
		$title = "Error 404";
		require_once("_header.php");
		require_once("_navbar_my.php");
		require_once("_404.php");		
	}
} else {
	echo '<script>window.location = "?p=auth";</script>';
}
?>
<a id="back-to-top" href="#" class="btn btn-secondary back-to-top" role="button" aria-label="Scroll to top">
	<i class="fas fa-chevron-up"></i>
</a>

<script type="text/javascript">	
	setTimeout(function(){window.location = '?p=lock';}, 1800000);
</script>
<?php
include("_footer.php");

?>