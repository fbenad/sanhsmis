<?php
session_start();
require_once("../config/dbconfig.php");
require_once("../config/settings.php");

$checkStudent = $conn->query("SELECT * FROM student INNER JOIN studenroll on student.stud_no=studenroll.enrol_stud_no WHERE (student.stud_no='".$_GET['id']."' AND enrol_sy='".$_GET['sy']."')");

if($checkStudent->num_rows > 0){
	$dataStudent = $checkStudent->fetch_assoc();
	?>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Learner's Class Schedule</title>
		<style>
		table {
		
		}
		
		th{
			height: 10px;
			text-decoration: none;
			font-family: Tahoma, "Times New Roman", serif; 
			font-size: 0.6em;
		} 
		
		td {
			height: 10px;
			text-decoration: none;
			font-family: Tahoma, "Times New Roman", serif; 
			font-size: 0.6em;		
		}

		@media print {
		  #printPageButton {
			display: none;
		  }
		}
		</style>
	</head>	
	<p align="right"><button id="printPageButton" style="background-color:green; color: white;" onClick="window.print();">Print</button></p>
	<table border="0" cellspacing="0" cellpadding="0" width="800" style="margin-top: -10px;">
		<tr>
			<td width="60" valign="top"><img src="../assets/images/logo.png" width="50"></td>
			<td align="left" valign="top">
			<strong><?php echo $sch_fullname;?></strong><br>
			<?php echo $sch_fulladdress;?>
			<h4>Student Class Schedule / Admission Slip<br>
			School Year <?php echo $_GET['sy'];?>-<?php echo $_GET['sy']+1;?>, <?php echo ($_GET['sem']=="1"?"First Semester":($_GET['sem']=="2"?"Second Semester":"Full Year"));?> 
			</h4>
			</td>
			<td align="right">
				<?php
					$student_image = "../assets/images/students/".$_GET['id'].".jpg";
					$no_image = "./assets/images/noimage.jpg";
				?>
				<img src="<?php echo (file_exists($student_image) ? $student_image : $no_image); ?>" width="75" alt="" style="max-width:143px" />
			
			</td>
			<td align="center"><img src="../plugins/barcodeapp/barcode.php?text=<?php echo $_GET['id']; ?>" alt="testing" /><br>Student No.: <?php echo $_GET['id']; ?>
			</td>
		</tr>
	</table>	
	<table border="0" cellspacing="2	" cellpadding="0" width="800">
		<tr>
			<td width="16%" align="right">Learner's Ref. No. (LRN):</td>
			<td> <b><?php echo $dataStudent['stud_lrn'];?></td>
			<td width="12%" align="right"></td>
			<td width="15%"></td>
		</tr>
		<tr>
			<td align="right">Student Fullname:</td>
			<td> <b><?php echo strtoupper($dataStudent['stud_lname']);?>, <?php echo strtoupper($dataStudent['stud_fname']);?> <?php echo strtoupper($dataStudent['stud_xname']);?> <?php echo strtoupper($dataStudent['stud_mname']);?></td>
			<td align="right">Level / Section:</td>
			<td align="left"> <b><?php echo $dataStudent['enrol_level'];?> / <?php echo $dataStudent['enrol_section'];?></td>
		</tr>	
		<?php
		if($dataStudent['enrol_level']>10){
		?>
		<tr>
			<td align="right">Track/Strand & Combo: </td>
			<td> <b><?php echo strtoupper($dataStudent['enrol_track']);?> / <?php echo strtoupper($dataStudent['enrol_strand']);?> - <?php echo strtoupper($dataStudent['enrol_combo']);?></td>
			<td align="right"></td>
			<td align="left"> </td>
		</tr>
		<?php
		}
		?>
	</table>	
	<hr>
	<?php
	$resultEnrol = $conn->query("SELECT * FROM studenroll WHERE (enrol_sy='".$_GET['sy']."' AND enrol_stud_no='".$_GET['id']."')");
	$dataEnroll = $resultEnrol->fetch_assoc();
	$resultSectionName = $conn->query("SELECT * FROM section WHERE (section_name='".$dataEnroll['enrol_section']."' AND section_sy='".$_GET['sy']."')");
	$dataSectionName = $resultSectionName->fetch_assoc();
	$checkUser = $conn->query("SELECT * FROM users WHERE user_no='".$dataSectionName['section_adviser']."'");
	$dataUser = $checkUser->fetch_assoc();
	?>
	<div class="table-responsive">
		<table width="800" class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
			<thead>
				<tr>
					<th align="left" width="20%"><u>Code</th>
					<th align="left"><u>Descriptive Title</th>
					<th align="left" width="3%"><u>Units</th>
					<th align="left" width="8%"><u>Time</th>
					<th align="left" width="7%"><u>Days</th>
					<th align="left" width="13%"><u>Room</th>
					<th align="left" width="13%"><u>Teacher</th>
					<th align="center" width="10%"><u>Signature</th>
				</tr>
			</thead>
			<tbody> 
				<!--
				<tr>
					<td>###</td>
					<td>Morning Ceremonies / Supervisory Activities</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<?php
					$checkTeacher = $conn->query("SELECT * FROM teacher WHERE teach_no='".$dataSectionName['section_adviser']."'");
					$dataTeacher = $checkTeacher->fetch_assoc();
					?>
					<td><?php echo ($dataSectionName['section_adviser']=="1"?"TBA":strtoupper($dataTeacher['teach_lname'].", ".substr($dataTeacher['teach_fname'],0,1).".")); ?></td>
					<td>________________</td>
				</tr>
				-->
			<?php
			if($dataSectionName['section_level']>10){
				if($_GET['sem'] == 1){
					$active_sem = 1;
				}
				else{
					$active_sem = 2;
				}
			}
			else {
				$active_sem = 12;
			}
			$resultGrade = $conn->query("SELECT * FROM grade INNER JOIN class ON grade.grade_class_no=class.class_no INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no WHERE (grade.grade_stud_no='".$_GET['id']."' and grade.grade_sy='".$_GET['sy']."' and grade_sem='".$active_sem."') ORDER BY class_timeslots ASC, pros_sort ASC");
			$countUnits=0;
			while($dataGrade = $resultGrade->fetch_assoc()){
			//if(substr($dataGrade['pros_title'],0,3)!="***"){
			?>													
				<tr>
					<?php
						$resultClassName = $conn->query("select * from section where (section_no='".$dataGrade['class_section_no']."')");
						$dataClassName = $resultClassName->fetch_assoc();
					?>
					<td><?php echo $dataGrade['pros_title']; ?> (<?php echo $dataClassName['section_name']; ?>)</td>
					<td><?php echo substr(ucwords(strtolower($dataGrade['pros_desc'])),0,40); ?>...</td>
					<td><?php echo number_format($dataGrade['pros_unit'],2); ?></td>
					<td bgcolor="lightgray"><?php echo $dataGrade['class_timeslots']; ?></td>
					<td><?php echo $dataGrade['class_days']; ?></td>
					<td><?php echo $dataGrade['class_room']; ?></td>
					<?php
					$checkTeacher = $conn->query("SELECT * FROM teacher WHERE teach_no='".$dataGrade['class_user_name']."'");
					$dataTeacher = $checkTeacher->fetch_assoc();
					?>
					<td><?php echo ($dataGrade['class_user_name']=="1"?"TBA":strtoupper($dataTeacher['teach_lname'].", ".substr($dataTeacher['teach_fname'],0,1).".")); ?></td>
					<td>________________</td>
				</tr>
				<?php 
				$countUnits+=$dataGrade['pros_unit'];
				} 
				//}
				?>	
				<?php
					if($dataStudent['enrol_level']<11){
				?>
				<tr>
					<td>###</td>
					<td>Remedial / Homeroom</td>
					<td>-</td>
					<td>-</td>
					
					
					<?php
					$checkTeacher = $conn->query("SELECT * FROM users WHERE user_no='".$dataGrade['class_user_name']."'");
					$dataTeacher = $checkTeacher->fetch_assoc();
					$resultGrade = $conn->query("SELECT * FROM grade INNER JOIN class ON grade.grade_class_no=class.class_no INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no WHERE (grade.grade_stud_no='".$_GET['id']."' and pros_title LIKE '%SCI%' and grade.grade_sy='".$_GET['sy']."') ORDER BY class_timeslots ASC, pros_sort ASC");
					$dataGrade = $resultGrade->fetch_assoc();
					?>
					<td>MTWThF</td>
					<td><?php echo $dataSectionName['section_name'];?></td>
					<?php
					$checkTeacher = $conn->query("SELECT * FROM teacher WHERE teach_no='".$dataSectionName['section_adviser']."'");
					$dataTeacher = $checkTeacher->fetch_assoc();
					?>
					<td><?php echo ($dataGrade['class_user_name']=="1"?"TBA":strtoupper($dataTeacher['teach_lname'].", ".substr($dataTeacher['teach_fname'],0,1).".")); ?></td>
					<td>________________</td>
				</tr>
				<?php
				}
				?>
				<tr>
					<td></td>
					<td align="right"><b>Total Units</b></td>
					<td><b><?php echo number_format($countUnits,2);?></b></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="8">
					<b><font color="red" size=> 
					<?php 
					/*
					if($dataStudent['enrol_level']<=10){
						echo "Lacking credentials: ";
						echo (strpos($dataStudent['stud_credentials'],"jhsEnv")==0?"Envelop, ":"");
						echo (strpos($dataStudent['stud_credentials'],"jhsPho")==0?"Photo, ":"");
						echo (strpos($dataStudent['stud_credentials'],"jhsNso")==0?"NSO, ":"");
						echo (strpos($dataStudent['stud_credentials'],"jhsBir")==0?"Birth Cert, ":"");
						echo (strpos($dataStudent['stud_credentials'],"jhsDip")==0?"Diploma, ":"");
						echo (strpos($dataStudent['stud_credentials'],"jhsGoo")==0?"Good Moral Character Cert, ":"");
						echo (strpos($dataStudent['stud_credentials'],"jhs138")==0?"Form 138, ":"");
						echo (strpos($dataStudent['stud_credentials'],"jhs137")==0?"Form 137":"");
					}
					else {
						echo "Lacking credentials: ";
						echo (strpos($dataStudent['stud_credentials'],"shsEnv")==0?"Envelop, ":"");
						echo (strpos($dataStudent['stud_credentials'],"shsPho")==0?"Photo, ":"");
						echo (strpos($dataStudent['stud_credentials'],"shsNso")==0?"NSO, ":"");
						echo (strpos($dataStudent['stud_credentials'],"shsBir")==0?"Birth Cert, ":"");
						echo (strpos($dataStudent['stud_credentials'],"shsDip")==0?"Diploma, ":"");
						echo (strpos($dataStudent['stud_credentials'],"shsGoo")==0?"Good Moral Character Cert, ":"");
						echo (strpos($dataStudent['stud_credentials'],"shs138")==0?"Form 138, ":"");
						echo (strpos($dataStudent['stud_credentials'],"shs137")==0?"Form 137, ":"");
						echo (strpos($dataStudent['stud_credentials'],"shsNca")==0?"NCAE":"");	
					}
					*/
					?>
					</b></font><br>
	<hr>		
			</td>
				</tr>
			</tbody>
		</table>
	</div>
	<table border="0" cellspacing="0" cellpadding="0" width="800">
		<tr>
			<td width="33%" >Encoded/Printed By:<br><br><br></td>
			<td width="33%">Confirmed by: <br><br><br></td>
			<td>First Day of Attendance Confirmation:<br><br><br></td>
			
		</tr>
		<tr>
			<?php
			$checkUser = $conn->query("SELECT * FROM users WHERE user_name='".$_SESSION["user_name"]."'");
			$dataUser = $checkUser->fetch_assoc( );
			?>
			<td align="center"><b><?php echo strtoupper($dataUser['user_fullname']);?></b> <br>EDP In-Charge<br><i><?php echo date("M d, Y - D / h:i:s A");?></i></td>
			<td align="center"><b><?php echo strtoupper($current_registrar);?></b><br>School Registrar<br><i> Date: ________________</i></td>
			<?php
			$checkUser = $conn->query("SELECT * FROM users WHERE user_no='".$dataSectionName['section_adviser']."'");
			$dataUser = $checkUser->fetch_assoc();
			?>		
			<td align="center"><b><?php echo strtoupper($dataUser['user_fullname']);?></b><br>Class Adviser<br><i> Date: ________________</i></td>
			
		</tr>	
		
		<tr>
			<td colspan="3"><br><br><i><font color="red"><?php echo $admission_message;?></font></i>
			</td>
		</tr>		
	</table>	
<?php
} else {
	echo "Student is not enrolled for the selected semester. Instead print from the individual school year or term.";
	echo "<script>setTimeout(function(){window.close();}, 5000);</script>";
} 
?>

