<?php
session_start();
require_once("../config/dbconfig.php");
require_once("../config/settings.php");
require_once("../plugins/phptopdfapp/code128.php");

if(isset($_GET['id']) && isset($_GET['sy'])){
	$id = $_GET['id'];
	$sy = $_GET['sy'];
	$sem = $_GET['sem'];

	$result = $conn->query("SELECT * FROM section
		WHERE (section_no = '$id' 
		AND section_sy = '$sy ')");
	$row = $result->fetch_assoc();


	if($result->num_rows > 0) {
		header("Location: pdf_gsc.php?enrol_sy=".$sy."&classProfile=".$row['section_name']."&enrol_sem=".$sem);
	} 
}



$current_sy1=$_GET['enrol_sy'];
$current_sy2=$current_sy1+1;
$current_sem2=($_GET['enrol_sem']=="1"?"Sem 1":($_GET['enrol_sem']=="2"?"Sem 2":"Full Year"));

class PDF extends FPDF{
	function Header()
	{
		global $current_sy1;
		global $current_sy2;
		global $current_sem2;
		global $sch_name;
		global $sch_fulladdress;
		
		$this->Image('../assets/images/logo.png',8,8,10);
		$this->SetFont('Courier','B',8);
		$this->Cell(100,-4,"   ".$sch_name,0,1);
		$this->SetFont('Courier','',8);
		$this->Cell(100,10,"   ".$sch_fulladdress,0,1);
		$this->SetFont('Courier','B',10);
		$this->SetY(7);
		$this->Cell(190,8,"  "."Student Grade Slip",0,1,'R');		
		$this->Cell(190,1,"  "."SY ".$current_sy1."-".$current_sy2.", ".$current_sem2,0,0,'R');
		$this->Ln(5);
	}

	function GradeTable($header,$resultGrade,$stud_no)
	{
		global $current_sy1, $conn;
		$w = array(25,70,12,8,8,8,8,13,15,25);
		$this->SetFont('Courier','B',8);
		for($i=0;$i<count($header);$i++)
			$this->Cell($w[$i],4,$header[$i],0,0,'L');
		$this->Ln();
		
		$this->SetFont('Courier','',8);
		$countUnits=0;
		$aveQ1=0;
		$aveQ2=0;
		$aveQ3=0;
		$aveQ4=0;
		$aveQf=0;
		$gradedUnits1=0;
		$gradedUnits2=0;
		$gradedUnits3=0;
		$gradedUnits4=0;
		$gradedUnitsqf=0;
		while ($dataGrade = $resultGrade->fetch_assoc()){
			$aveQ1 += ($dataGrade['grade_q1']*$dataGrade['pros_unit']);
			$aveQ2 += ($dataGrade['grade_q2']*$dataGrade['pros_unit']);
			$aveQ3 += ($dataGrade['grade_q3']*$dataGrade['pros_unit']);
			$aveQ4 += ($dataGrade['grade_q4']*$dataGrade['pros_unit']);
			$aveQf += ($dataGrade['grade_final']*$dataGrade['pros_unit']);
			$countUnits+=$dataGrade['pros_unit'];
			if($dataGrade['grade_q1']<60){
				$gradedUnits1+=0;
			} else {
				$gradedUnits1+=$dataGrade['pros_unit'];
			}
			if($dataGrade['grade_q2']<60){
				$gradedUnits2+=0;
			}else {
				$gradedUnits2+=$dataGrade['pros_unit'];
			}
			if($dataGrade['grade_q3']<60){
				$gradedUnits3+=0;
			}else {
				$gradedUnits3+=$dataGrade['pros_unit'];
			}
			if($dataGrade['grade_q4']<60){
				$gradedUnits4+=0;
			}else {
				$gradedUnits4+=$dataGrade['pros_unit'];
			}
			if($dataGrade['grade_final']<60){
				$gradedUnitsqf+=0;
			}
			else {
				$gradedUnitsqf+=$dataGrade['pros_unit'];
			}
			$this->Cell($w[0],4,$dataGrade['pros_title'],0,'L');
			$this->Cell($w[1],4,substr($dataGrade['pros_desc'],0,37)."...",0,'L');
			$this->Cell($w[2],4,number_format($dataGrade['pros_unit'],2),0,0,'L');
			$this->Cell($w[3],4,($dataGrade['grade_q1']<60?".":$dataGrade['grade_q1']),0,0,'L');
			$this->Cell($w[4],4,($dataGrade['grade_q2']<60?".":$dataGrade['grade_q2']),0,0,'L');
			$this->Cell($w[5],4,($dataGrade['grade_q3']<60?".":$dataGrade['grade_q3']),0,0,'L');
			$this->Cell($w[6],4,($dataGrade['grade_q4']<60?".":$dataGrade['grade_q4']),0,0,'L');
			$this->Cell($w[7],4,($dataGrade['grade_final']<60 || $dataGrade['grade_q1']==0 || $dataGrade['grade_q2']==0?".":$dataGrade['grade_final']),0,0,'L');
			$this->Cell($w[8],4,($dataGrade['grade_q1']<60 || $dataGrade['grade_q2']<60 || $dataGrade['grade_q3']<60 || $dataGrade['grade_q4']<60?".":($dataGrade['grade_final']>=75?"PASSED":"FAILED")),0,0,'L');
			//$this->Cell($w[8],4,($dataGrade['grade_final']<60?".":($dataGrade['grade_final']>=75?"PASSED":"FAILED")),0,0,'L');
			$this->Cell($w[9],4,($dataGrade['class_user_name']=="1"?"TBA":mb_convert_encoding($dataGrade['teach_lname'].", ".substr($dataGrade['teach_fname'],0,1).".",'ISO-8859-1', 'UTF-8')),0,'L');
			$this->Ln();			
		}
		$this->Cell(0,3,"_______________________________________________________________________________________________________________",0,1,'C');
		$this->SetFont('Courier','B',8);
		$this->Cell($w[0],4,"",0,'L');
		$this->Cell($w[1],4,"Total Units / Gen. Ave.",0,0,'R');
		$this->Cell($w[2],4,round($countUnits,4),0,'L');
		if($countUnits==0){
			$countUnits=1;
		}
		$this->Cell($w[3],4,($countUnits!=$gradedUnits1?".":round($aveQ1/$countUnits,0)),0,'L');
		$this->Cell($w[4],4,($countUnits!=$gradedUnits2?".":round($aveQ2/$countUnits,0)),0,'L');
		$this->Cell($w[5],4,($countUnits!=$gradedUnits3?".":round($aveQ3/$countUnits,0)),0,'L');
		$this->Cell($w[6],4,($countUnits!=$gradedUnits4?".":round($aveQ4/$countUnits,0)),0,'L');
		$this->Cell($w[7],4,(($countUnits!=$gradedUnits1 || $countUnits!=$gradedUnits2)?".":round($aveQf/$countUnits,0)),0,'L');
		$resultEnrolInfo = $conn->query("SELECT * FROM studenroll WHERE (enrol_stud_no='".$stud_no."' AND enrol_sy='".$current_sy1."')");
		$dataEnrolInfo = $resultEnrolInfo->fetch_assoc();
		$this->Cell($w[8],4,$dataEnrolInfo['enrol_status2'],0,0,'L');
		$this->Cell($w[9],4,($dataEnrolInfo['enrol_status1'] == "PROMOTED" ? "" : ""),0,'L');
	}
	
	function AttendanceTable($header,$checkSchoolDays,$checkPresentDays)
	{
		global $current_sy1;
		$w = array(40,30,9,9,9,9,9,9,9,9,9,9,9,9,9);
		$this->SetFont('Courier','B',8);
		for($i=0;$i<count($header);$i++)
			$this->Cell($w[$i],4,$header[$i],0,0,'L');
		$this->Ln();
		
		$this->SetFont('Courier','',8);
		while ($schoolDays = $checkSchoolDays->fetch_assoc()){
			$this->Cell($w[0],4,"No. of School Days",0,'L');
			$this->Cell($w[1],4,($schoolDays['sch_firstday']==0?".":date('F d, Y', strtotime($schoolDays['sch_firstday']) + 8.0 * 3600)),0,'L');
			$this->Cell($w[2],4,($schoolDays['sch_m1']==0?".":number_format($schoolDays['sch_m1'],1)),0,'L');
			$this->Cell($w[3],4,($schoolDays['sch_m2']==0?".":number_format($schoolDays['sch_m2'],1)),0,'L');
			$this->Cell($w[4],4,($schoolDays['sch_m3']==0?".":number_format($schoolDays['sch_m3'],1)),0,'L');
			$this->Cell($w[5],4,($schoolDays['sch_m4']==0?".":number_format($schoolDays['sch_m4'],1)),0,'L');
			$this->Cell($w[6],4,($schoolDays['sch_m5']==0?".":number_format($schoolDays['sch_m5'],1)),0,'L');
			$this->Cell($w[7],4,($schoolDays['sch_m6']==0?".":number_format($schoolDays['sch_m6'],1)),0,'L');
			$this->Cell($w[8],4,($schoolDays['sch_m7']==0?".":number_format($schoolDays['sch_m7'],1)),0,'L');
			$this->Cell($w[9],4,($schoolDays['sch_m8']==0?".":number_format($schoolDays['sch_m8'],1)),0,'L');
			$this->Cell($w[10],4,($schoolDays['sch_m9']==0?".":number_format($schoolDays['sch_m9'],1)),0,'L');
			$this->Cell($w[11],4,($schoolDays['sch_m10']==0?".":number_format($schoolDays['sch_m10'],1)),0,'L');
			$this->Cell($w[12],4,($schoolDays['sch_m11']==0?".":number_format($schoolDays['sch_m11'],1)),0,'L');
			$this->Cell($w[13],4,($schoolDays['sch_m12']==0?".":number_format($schoolDays['sch_m12'],1)),0,'L');
			$total = $schoolDays['sch_m1'] + $schoolDays['sch_m2'] + $schoolDays['sch_m3'] + $schoolDays['sch_m4'] + $schoolDays['sch_m5'] +$schoolDays['sch_m6'] + $schoolDays['sch_m7'] + $schoolDays['sch_m8'] + $schoolDays['sch_m9'] + $schoolDays['sch_m10'] + $schoolDays['sch_m11'] + $schoolDays['sch_m12'];
			$this->Cell($w[14],4,($total==0?"-":number_format($total,1)),0,'L');
			$this->Ln();
		}
		while ($schoolDays = $checkPresentDays->fetch_assoc()){
			$this->Cell($w[0],4,"No. of Days Present",0,'L');
			$this->Cell($w[1],4,($schoolDays['sch_firstday']==0?".":date('F d, Y', strtotime($schoolDays['sch_firstday']) + 8.0 * 3600)),0,'L');
			$this->Cell($w[2],4,($schoolDays['sch_m1']==0?".":number_format($schoolDays['sch_m1'],1)),0,'L');
			$this->Cell($w[3],4,($schoolDays['sch_m2']==0?".":number_format($schoolDays['sch_m2'],1)),0,'L');
			$this->Cell($w[4],4,($schoolDays['sch_m3']==0?".":number_format($schoolDays['sch_m3'],1)),0,'L');
			$this->Cell($w[5],4,($schoolDays['sch_m4']==0?".":number_format($schoolDays['sch_m4'],1)),0,'L');
			$this->Cell($w[6],4,($schoolDays['sch_m5']==0?".":number_format($schoolDays['sch_m5'],1)),0,'L');
			$this->Cell($w[7],4,($schoolDays['sch_m6']==0?".":number_format($schoolDays['sch_m6'],1)),0,'L');
			$this->Cell($w[8],4,($schoolDays['sch_m7']==0?".":number_format($schoolDays['sch_m7'],1)),0,'L');
			$this->Cell($w[9],4,($schoolDays['sch_m8']==0?".":number_format($schoolDays['sch_m8'],1)),0,'L');
			$this->Cell($w[10],4,($schoolDays['sch_m9']==0?".":number_format($schoolDays['sch_m9'],1)),0,'L');
			$this->Cell($w[11],4,($schoolDays['sch_m10']==0?".":number_format($schoolDays['sch_m10'],1)),0,'L');
			$this->Cell($w[12],4,($schoolDays['sch_m11']==0?".":number_format($schoolDays['sch_m11'],1)),0,'L');
			$this->Cell($w[13],4,($schoolDays['sch_m12']==0?".":number_format($schoolDays['sch_m12'],1)),0,'L');
			$total = $schoolDays['sch_m1'] + $schoolDays['sch_m2'] + $schoolDays['sch_m3'] + $schoolDays['sch_m4'] + $schoolDays['sch_m5'] +$schoolDays['sch_m6'] + $schoolDays['sch_m7'] + $schoolDays['sch_m8'] + $schoolDays['sch_m9'] + $schoolDays['sch_m10'] + $schoolDays['sch_m11'] + $schoolDays['sch_m12'];
			$this->Cell($w[14],4,($total==0?"-":number_format($total,1)),0,'L');
		}
	}
}


$pdf = new PDF('P','mm','Letter');
$pdf->SetTitle('Grade Slips');
$pdf->SetMargins(12.70,12.70,12.70,12.70);
$pdf->AliasNbPages();

$checkStudent = $conn->query("SELECT * FROM studenroll inner join student on enrol_stud_no=stud_no inner join section on enrol_section=section_name WHERE (enrol_section='".$_GET['classProfile']."' AND enrol_sy='".$_GET['enrol_sy']."' AND section_sy='".$_GET['enrol_sy']."'  AND (enrol_status1='ENROLLED' or enrol_status1='PROMOTED')) order by stud_gender desc, stud_lname asc, stud_fname asc");
$CountStudent = $checkStudent->num_rows;
while($dataStudent = $checkStudent->fetch_assoc()){
	$pdf->AddPage();
	$pdf->Ln(5);
	$pdf->SetFont('Courier','B',8);
	$pdf->Cell(40,5,"Learner's Ref. No. (LRN):",0,0,'R');
	$pdf->SetFont('Courier','B',9);
	$pdf->Cell(5,5,$dataStudent['stud_lrn'],0,1,'L');
	$pdf->SetFont('Courier','',8);
	$pdf->Cell(40,2,"Student ID & Fullname:",0,0,'R');
	$pdf->SetFont('Courier','B',9);
	$pdf->Cell(5,2,mb_convert_encoding(strtoupper($dataStudent['stud_no']." - ".$dataStudent['stud_lname'].", ".$dataStudent['stud_fname']." ".$dataStudent['stud_xname']." ".$dataStudent['stud_mname']),'ISO-8859-1', 'UTF-8'),0,1,'L');
	$pdf->SetFont('Courier','',8);
	$pdf->Cell(160,-1,"Level / Section:",0,0,'R');
	$pdf->SetFont('Courier','B',9);
	$pdf->Cell(75,-1,$dataStudent['enrol_level']." / ".$dataStudent['enrol_section'],0,1,'L');
	$pdf->Ln(4);

	$sem=($dataStudent['enrol_level']<11?12:$_GET['enrol_sem']);
	
	if($sem<=2){
		$pdf->SetFont('Courier','',8);
		$pdf->Cell(40,0,"Track & Strand  (Combo):",0,0,'R');
		$pdf->SetFont('Courier','B',8);
		$pdf->Cell(10,0,$dataStudent['enrol_track']." - ".$dataStudent['enrol_strand']." (".$dataStudent['enrol_combo'].")",0,1,'L');
		$pdf->SetFont('Courier','',5);
		$pdf->Cell(0,5,"__________________________________________________________________________________________________________________________________________________________________________________________",0,1,'C');
	}

	$pdf->SetFont('Courier','B',8);
	$header = array('Code', 'Descriptive Title', 'Units', 'Q1', 'Q2', 'Q3', 'Q4', 'Finals', 'Remarks', 'Teacher');
	$resultGrade = $conn->query("SELECT * FROM grade INNER JOIN class ON grade.grade_class_no=class.class_no INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no inner join teacher on class_user_name=teach_no WHERE (grade.grade_stud_no='".$dataStudent['stud_no']."' and grade.grade_sy='".$_GET['enrol_sy']."' and class_sem='".$sem."') ORDER BY grade_sem ASC, pros_sort ASC");
	$pdf->GradeTable($header,$resultGrade,$dataStudent['stud_no']);
	$pdf->Ln(8);

	$pdf->SetFont('Courier','B',8);
	$pdf->Cell(0,4,"ATTENDANCE REPORT",1,1,'C');
	$checkSchoolDays = $conn->query("SELECT * FROM school_days WHERE (sch_sy='".$current_sy1."' AND sch_stud_no='".$current_sy1."')");
	$checkPresentDays = $conn->query("SELECT * FROM school_days WHERE (sch_sy='".$current_sy1."' AND sch_stud_no='".$dataStudent['stud_no']."')");
	$header = array('Summary', 'First Day', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Total');
	$pdf->AttendanceTable($header,$checkSchoolDays,$checkPresentDays);
	$pdf->Ln(11);

	$checkUser = $conn->query("SELECT * FROM users WHERE user_no='".$dataStudent['section_adviser']."'");
	$dataUser = $checkUser->fetch_assoc();
	$pdf->SetFont('Courier','',8);
	$pdf->Cell(95,4,"Prepared by:",0,0,'L');
	$pdf->Cell(95,4,"Received by:",0,1,'L');
	$pdf->SetFont('Courier','B',9);
	$pdf->Cell(95,4,mb_convert_encoding($dataUser['user_fullname'],'ISO-8859-1', 'UTF-8'),0,0,'C');
	$pdf->SetFont('Courier','',8);
	$pdf->Cell(95,4,"_______________________________",0,1,'C');
	$pdf->Cell(95,2,"Class Adviser",0,0,'C');
	$pdf->Cell(95,2,"Parent/Guardian",0,1,'C');
	$pdf->SetFont('Courier','',6);
	$pdf->Cell(0,6,"Print date: ".date("M d, Y - D / h:i:s A"),0,0,'L');
}

$pdf->Output();
?>
