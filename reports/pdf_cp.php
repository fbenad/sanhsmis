<?php
session_start();
require_once("../config/dbconfig.php");
require_once("../config/settings.php");

if(isset($_GET['id']) && isset($_GET['sy'])){
	$id = $_GET['id'];
	$sy = $_GET['sy'];
	$sem = $_GET['sem'];

	$result = $conn->query("SELECT * FROM section
		WHERE (section_no = '$id' 
		AND section_sy = '$sy ')");
	$row = $result->fetch_assoc();


	if($result->num_rows > 0) {
		header("Location: pdf_cp.php?enrol_sy=".$sy."&classProfile=".$row['section_name']."&enrol_sem=".$sem);
	} 
}

$checkSection = $conn->query("SELECT * FROM section INNER JOIN users ON section_adviser=user_no WHERE (section_name='".$_GET['classProfile']."' AND section_sy='".$_GET['enrol_sy']."')");
$dataSection = $checkSection->fetch_assoc();
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Class Program</title>
	<style>
	table {
	
	}
	
	th{
		height: 10px;
		text-decoration: none;
		font-family: Tahoma, "Times New Roman", serif; 
		font-size: 0.9em;
	} 
	
	td {
		height: 10px;
		text-decoration: none;
		font-family: Tahoma, "Times New Roman", serif; 
		font-size: 0.7em;		
	}

	@media print {
	  #printPageButton {
		display: none;
	  }
	}
	</style>
</head>
<p align="right"><button id="printPageButton" style="background-color:green; color: white;" onClick="window.print();">Print</button></p>
<table border="0" cellspacing="0" cellpadding="0" width="800">
	<tr>
		<td width="60" valign="top"><img src="../assets/images/deped_logo.png" width="80"></td>
		<td align="center" valign="top">
		Republic of the Philippines<br>
		Department of Education<br>
		<?php echo $sch_regionname;?><br>
		<strong>Division of <?php echo $sch_division;?></strong><br>
		<strong>DISTRICT OF <?php echo strtoupper($sch_district);?></strong><br><br>
		<strong><?php echo $sch_name;?></strong><br>
		<i><?php echo $sch_fulladdress;?></i><br>
		<h2>CLASS PROGRAM </h2>
		School Year <?php echo $_GET['enrol_sy'];?>-<?php echo $_GET['enrol_sy']+1;?>, Sem <?php echo ($_GET['enrol_sem']);?><br>
		<u><h1><?php echo $_GET['classProfile'];?></h1></u>
		</td>
		<td align="right">

		
		</td>
		<td width="60" valign="top"><img src="../assets/images/logo.png" width="80"></td>
	</tr>
</table>	
<table border="0" cellspacing="2	" cellpadding="0" width="800">
	<tr>
		<td width="16%" align="right">Grade Level: </td>
		<td> <b><?php echo $dataSection['section_level'];?></td>
		<td width="12%" align="right"></td>
		<td width="15%"></td>
	</tr>
	<tr>
		<td align="right">Class Adviser:</td>
		<td> <b><?php echo strtoupper($dataSection['user_fullname']);?></td>
		<td align="right"></td>
		<td align="left"> <b><?php //echo $dataStudent['enrol_level'];?>  <?php //echo $dataStudent['enrol_section'];?></td>
	</tr>	
</table>	
<hr>

<div class="table-responsive">
	<table width="800" border="1" cellspacing="0" class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
		<thead>
			<tr height="28" bgcolor="gray">
				<th align="left" width="12%"><u>Code</th>
				<th align="left"><u>Descriptive Title</th>
				<th align="left" width="10%"><u>Time</th>
				<th align="left" width="8%"><u>Days</th>
				<th align="left" width="15%"><u>Room</th>
				<th align="left" width="22%"><u>Teacher</th>
			</tr>
		</thead>
		<tbody> 
		
			<tr height="26" bgcolor="lightgray">
				<td>###</td>
				<td>Morning Ceremonies / Supervisory Activities</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td><?php echo strtoupper($dataSection['user_fullname']); ?></td>
			</tr>
		<?php
		if($dataSection['section_level']<11){
			$resultGrade = $conn->query("SELECT * FROM class INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no WHERE (class_section_no='".$dataSection['section_no']."' and class_sy='".$_GET['enrol_sy']."') ORDER BY pros_sem ASC, class_timeslots ASC, pros_sort ASC");
		}
		else {
			$term = $_GET['enrol_sem'];
			$resultGrade = $conn->query("SELECT * FROM class INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no WHERE (class_section_no='".$dataSection['section_no']."' and class_sy='".$_GET['enrol_sy']."' and class_sem='".$term."') ORDER BY class_sem ASC, class_timeslots ASC, pros_sort ASC");
		}
		while($dataGrade = $resultGrade->fetch_assoc()){
		if(substr($dataGrade['pros_title'],0,3)!="***"){
		
		?>													
			<tr height="26">
				<td><?php echo $dataGrade['pros_title']; ?>
				</td>
				<td><?php echo ucwords(strtolower($dataGrade['pros_desc'])); ?></td>
				<td><?php echo $dataGrade['class_timeslots']; ?></td>
				<td><?php echo $dataGrade['class_days']; ?></td>
				<td><?php echo $dataGrade['class_room']; ?></td>
				<?php
				$checkTeacher = $conn->query("SELECT * FROM users WHERE user_no='".$dataGrade['class_user_name']."'");
				$dataTeacher = $checkTeacher->fetch_assoc();
				?>
				<td><?php echo ($dataGrade['class_user_name']==1?"TBA":strtoupper($dataTeacher['user_fullname'])); ?></td>
			</tr>
		<?php } }?>	
			<?php
				if($dataSection['section_level']<11){
			?>
			<!--
			<tr bgcolor="pink" height="25">
				<td>###</td>
				<td>Remedial / Homeroom</td>
				<td>16:00-17:00</td>
				
				
				<?php
				$resultGrade = $conn->query("SELECT * FROM class INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no WHERE (class_section_no='".$dataSection['section_no']."' and pros_title LIKE '%SCI%' and class_sy='".$_GET['enrol_sy']."') ORDER BY class_timeslots ASC, pros_sort ASC");
				$dataGrade = $resultGrade->fetch_assoc();
				?>
				<td><?php echo $dataGrade['class_days'];?></td>
				<td><?php echo $dataSection['section_name'];?></td>
				
				<td><?php echo strtoupper($dataSection['user_fullname']); ?></td>
			</tr>
			-->
			<?php
			}
			?>
		</tbody>
	</table>
</div><hr>
<table border="0" cellspacing="0" cellpadding="0" width="800">
	<tr>
		<td width="30%"></td>
		<td></td>
		<td width="30%">Prepared by:<br><br><br></td>
	</tr>
	<tr>
		<?php
		$checkUser = $conn->query("SELECT * FROM users WHERE user_no='".$dataSection['section_adviser']."'");
		$dataUser = $checkUser->fetch_assoc();
		?>
		<td align="center"></td>
		<td align="center"></td>
		<td align="center"><b><?php echo strtoupper($dataSection['user_fullname']);?></b><br>Class Adviser</td>
		
	</tr>	
	<tr>
		<td width="30%">Approval Recommended:<br><br><br></td>
		<td></td>
		<td width="30%"><br><br></td>
	</tr>	
	<?php
		$checkDetails = $conn->query("select * from settings where settings_sy='".$_GET['enrol_sy']."'");
		$dataDetails = $checkDetails->fetch_assoc();
	?>
	<tr>
		<td align="center"><b><?php echo strtoupper($dataDetails['settings_principal']);?></b><br>School Principal</td>
		<td align="center"></td>
		<td align="center"></td>
		
	</tr>	
	<tr>
		<td width="30%"><br><br><br>Contents Noted:<br><br><br></td>
		<td></td>
		<td width="30%"><br><br><br>Approved:<br><br><br></td>
	</tr>	
	<tr>
		<td align="center"><b><?php echo strtoupper($dataDetails['settings_supervisor']);?></b><br>Public Schools District Supervisor</td>
		<td align="center"></td>
		<td align="center"><b><?php echo strtoupper($dataDetails['settings_superintendent']);?></b><br>Schools Division Superintendent</td>
		
	</tr>	
	<tr>
		<?php
		$checkUser = $conn->query("SELECT * FROM users WHERE user_name='".$_SESSION["user_name"]."'");
		$dataUser = $checkUser->fetch_assoc();
		?>
		<td colspan="3"></td>
	</tr>			
</table>	