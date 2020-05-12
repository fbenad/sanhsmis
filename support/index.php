<?php
session_start();

require_once("../config/dbconfig.php");
require_once("../config/settings.php");

if(isset($_GET['p'])){
	if ($_GET['p'] == "home"){
		$title = "Home | Support Page";
		require_once("_header.php");
		require_once("_navbar_auth.php");
		require_once("my/index.php");
	} else {
		$title = "Error 404";
		require_once("_header.php");
		require_once("_navbar_auth.php");
		require_once("_404.php");	
	} 
} else {
	echo '<script>window.location = "?p=home";</script>';
}


?>
<a id="back-to-top" href="#" class="btn btn-secondary back-to-top" role="button" aria-label="Scroll to top">
	<i class="fas fa-chevron-up"></i>
</a>
<?php
include("_footer.php");
?>