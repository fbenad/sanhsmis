<?php
session_start();
require_once("../../config/dbconfig.php");
require_once("../../config/settings.php");
require_once("controller.php");

$controller = new Controller();

if(isset($_POST['data'])){	

	if($_POST['data']['0'] == "getTotals"){
		$data = array_values($_POST);
		$result = $controller->getTotals($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();	
		
	} else if($_POST['data']['0'] == "getGraphs"){
		$data = array_values($_POST);
		$result = $controller->getYears();
		
		$years = array();
		if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
			array_push($years, $row['settings_sy']);
		}} else {
			echo result['1'];
		}
		
		asort($years);	
		?>
		<div class="row">
			<div class="col-md-6">
				<div class="card card-info">
					<div class="card-header">
						<h3 class="card-title">Enrollment</h3>
						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
							</button>
							<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
						</div>
					</div>
					<div class="card-body">
						<div class="chart">
							<canvas id="lineChart1" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
						</div>
					</div>
					<?php
					$sorted_year = implode(',', $years);
					
					$enrollment = array();
					for($i = sizeof($years)-1; $i >= 0; $i--){
					  $result = $controller->getCount($years[$i], " INNER JOIN student ON enrol_stud_no = stud_no ", " stud_gender = 'MALE' AND enrol_sy = '$years[$i]' AND enrol_section != '' ");
					  
					  if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
						  array_push($enrollment, $row['criteriaCount']);
					  }}
					}
					$sorted_enrollmentM = implode(',', $enrollment);

					$enrollment = array();
					for($i = sizeof($years)-1; $i >= 0; $i--){
					  $result = $controller->getCount($years[$i], " INNER JOIN student ON enrol_stud_no = stud_no ", " stud_gender = 'FEMALE' AND enrol_sy = '$years[$i]' AND enrol_section != '' ");
					  
					  if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
						  array_push($enrollment, $row['criteriaCount']);
					  }}
					}
					$sorted_enrollmentF = implode(',', $enrollment);				
					?>
					<script type="text/javascript">	
					setTimeout(function(){
					  $(function () {
						var lineChartCanvas = $('#lineChart1').get(0).getContext('2d')
						
						var lineChartData = {
						  labels  : [<?php echo $sorted_year;?>],
						  datasets: [
							{
							  label               : 'Male',
							  backgroundColor     : 'rgba(60,141,188,0.9)',
							  borderColor         : 'rgba(60,141,188,0.8)',
							  pointRadius          : false,
							  pointColor          : '#3b8bba',
							  pointStrokeColor    : 'rgba(60,141,188,1)',
							  pointHighlightFill  : '#fff',
							  pointHighlightStroke: 'rgba(60,141,188,1)',
							  data                : [<?php echo $sorted_enrollmentM;?>]
							},
							{
							  label               : 'Female',
							  backgroundColor     : 'rgba(210, 214, 222, 1)',
							  borderColor         : 'rgba(210, 214, 222, 1)',
							  pointRadius         : false,
							  pointColor          : 'rgba(210, 214, 222, 1)',
							  pointStrokeColor    : '#c1c7d1',
							  pointHighlightFill  : '#fff',
							  pointHighlightStroke: 'rgba(220,220,220,1)',
							  data                : [<?php echo $sorted_enrollmentF;?>]
							},
						  ]
						}
						
						var lineChartOptions = {
						  maintainAspectRatio : false,
						  responsive : true,
						  legend: {
							display: true
						  },
						  scales: {
							xAxes: [{
							  gridLines : {
								display : false,
							  }
							}],
							yAxes: [{
							  gridLines : {
								display : false,
							  }
							}]
						  }
						}
						
						var lineChartOptions = jQuery.extend(true, {}, lineChartOptions)
						var lineChartData = jQuery.extend(true, {}, lineChartData)
						lineChartData.datasets[0].fill = false;
						lineChartData.datasets[1].fill = false;
						lineChartOptions.datasetFill = false

						var lineChart = new Chart(lineChartCanvas, { 
						  type: 'line',
						  data: lineChartData, 
						  options: lineChartOptions
						})
					  })
					}, 1);
					</script>
				</div>
			</div>	
			<div class="col-md-6">
				<div class="card card-info">
					<div class="card-header">
						<h3 class="card-title">Promotion</h3>
						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
							</button>
							<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
						</div>
					</div>
					<div class="card-body">
						<div class="chart">
							<canvas id="lineChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
						</div>
					</div>
					<?php
					$sorted_year = implode(',', $years);
					
					$enrollment = array();
					for($i = sizeof($years)-1; $i >= 0; $i--){
					  $result = $controller->getCount($years[$i], " INNER JOIN student ON enrol_stud_no = stud_no ", " stud_gender = 'MALE' AND enrol_sy = '$years[$i]' AND enrol_section != '' AND (enrol_status2 = 'PROMOTED' OR enrol_status2 = 'GRADUATED') ");
					  
					  if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
						  array_push($enrollment, $row['criteriaCount']);
					  }}
					}
					$sorted_enrollmentM = implode(',', $enrollment);

					$enrollment = array();
					for($i = sizeof($years)-1; $i >= 0; $i--){
					  $result = $controller->getCount($years[$i], " INNER JOIN student ON enrol_stud_no = stud_no ", " stud_gender = 'FEMALE' AND enrol_sy = '$years[$i]' AND enrol_section != '' AND (enrol_status2 = 'PROMOTED' OR enrol_status2 = 'GRADUATED') ");
					  
					  if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
						  array_push($enrollment, $row['criteriaCount']);
					  }}
					}
					$sorted_enrollmentF = implode(',', $enrollment);				
					?>
					<script type="text/javascript">	
					setTimeout(function(){
					  $(function () {
						var lineChartCanvas = $('#lineChart2').get(0).getContext('2d')
						
						var lineChartData = {
						  labels  : [<?php echo $sorted_year;?>],
						  datasets: [
							{
							  label               : 'Male',
							  backgroundColor     : 'rgba(60,141,188,0.9)',
							  borderColor         : 'rgba(60,141,188,0.8)',
							  pointRadius          : false,
							  pointColor          : '#3b8bba',
							  pointStrokeColor    : 'rgba(60,141,188,1)',
							  pointHighlightFill  : '#fff',
							  pointHighlightStroke: 'rgba(60,141,188,1)',
							  data                : [<?php echo $sorted_enrollmentM;?>]
							},
							{
							  label               : 'Female',
							  backgroundColor     : 'rgba(210, 214, 222, 1)',
							  borderColor         : 'rgba(210, 214, 222, 1)',
							  pointRadius         : false,
							  pointColor          : 'rgba(210, 214, 222, 1)',
							  pointStrokeColor    : '#c1c7d1',
							  pointHighlightFill  : '#fff',
							  pointHighlightStroke: 'rgba(220,220,220,1)',
							  data                : [<?php echo $sorted_enrollmentF;?>]
							},
						  ]
						}
						
						var lineChartOptions = {
						  maintainAspectRatio : false,
						  responsive : true,
						  legend: {
							display: true
						  },
						  scales: {
							xAxes: [{
							  gridLines : {
								display : false,
							  }
							}],
							yAxes: [{
							  gridLines : {
								display : false,
							  }
							}]
						  }
						}
						
						var lineChartOptions = jQuery.extend(true, {}, lineChartOptions)
						var lineChartData = jQuery.extend(true, {}, lineChartData)
						lineChartData.datasets[0].fill = false;
						lineChartData.datasets[1].fill = false;
						lineChartOptions.datasetFill = false

						var lineChart = new Chart(lineChartCanvas, { 
						  type: 'line',
						  data: lineChartData, 
						  options: lineChartOptions
						})
					  })
					}, 1);
					</script>
				</div>
			</div>
			</div>
			<div class="row">
			<div class="col-md-6">
				<div class="card card-info">
					<div class="card-header">
						<h3 class="card-title">Drop-out</h3>
						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
							</button>
							<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
						</div>
					</div>
					<div class="card-body">
						<div class="chart">
							<canvas id="lineChart3" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
						</div>
					</div>
					<?php
					$sorted_year = implode(',', $years);
					
					$enrollment = array();
					for($i = sizeof($years)-1; $i >= 0; $i--){
					  $result = $controller->getCount($years[$i], " INNER JOIN student ON enrol_stud_no = stud_no ", " stud_gender = 'MALE' AND enrol_sy = '$years[$i]' AND enrol_section != '' AND enrol_status2 = 'DROPPED OUT' ");
					  
					  if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
						  array_push($enrollment, $row['criteriaCount']);
					  }}
					}
					$sorted_enrollmentM = implode(',', $enrollment);

					$enrollment = array();
					for($i = sizeof($years)-1; $i >= 0; $i--){
					  $result = $controller->getCount($years[$i], " INNER JOIN student ON enrol_stud_no = stud_no ", " stud_gender = 'FEMALE' AND enrol_sy = '$years[$i]' AND enrol_section != '' AND enrol_status2 = 'DROPPED OUT' ");
					  
					  if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
						  array_push($enrollment, $row['criteriaCount']);
					  }}
					}
					$sorted_enrollmentF = implode(',', $enrollment);				
					?>					
					<script type="text/javascript">	
					setTimeout(function(){
					  $(function () {
						var lineChartCanvas = $('#lineChart3').get(0).getContext('2d')
						
						var lineChartData = {
						  labels  : [<?php echo $sorted_year;?>],
						  datasets: [
							{
							  label               : 'Male',
							  backgroundColor     : 'rgba(60,141,188,0.9)',
							  borderColor         : 'rgba(60,141,188,0.8)',
							  pointRadius          : false,
							  pointColor          : '#3b8bba',
							  pointStrokeColor    : 'rgba(60,141,188,1)',
							  pointHighlightFill  : '#fff',
							  pointHighlightStroke: 'rgba(60,141,188,1)',
							  data                : [<?php echo $sorted_enrollmentM;?>]
							},
							{
							  label               : 'Female',
							  backgroundColor     : 'rgba(210, 214, 222, 1)',
							  borderColor         : 'rgba(210, 214, 222, 1)',
							  pointRadius         : false,
							  pointColor          : 'rgba(210, 214, 222, 1)',
							  pointStrokeColor    : '#c1c7d1',
							  pointHighlightFill  : '#fff',
							  pointHighlightStroke: 'rgba(220,220,220,1)',
							  data                : [<?php echo $sorted_enrollmentF;?>]
							},
						  ]
						}
						
						var lineChartOptions = {
						  maintainAspectRatio : false,
						  responsive : true,
						  legend: {
							display: true
						  },
						  scales: {
							xAxes: [{
							  gridLines : {
								display : false,
							  }
							}],
							yAxes: [{
							  gridLines : {
								display : false,
							  }
							}]
						  }
						}
						
						var lineChartOptions = jQuery.extend(true, {}, lineChartOptions)
						var lineChartData = jQuery.extend(true, {}, lineChartData)
						lineChartData.datasets[0].fill = false;
						lineChartData.datasets[1].fill = false;
						lineChartOptions.datasetFill = false

						var lineChart = new Chart(lineChartCanvas, { 
						  type: 'line',
						  data: lineChartData, 
						  options: lineChartOptions
						})
					  })
					}, 1);
					</script>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card card-info">
					<div class="card-header">
						<h3 class="card-title">Retention</h3>
						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
							</button>
							<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
						</div>
					</div>
					<div class="card-body">
						<div class="chart">
							<canvas id="lineChart4" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
						</div>
					</div>
					<?php
					$sorted_year = implode(',', $years);
					
					$enrollment = array();
					for($i = sizeof($years)-1; $i >= 0; $i--){
					  $result = $controller->getCount($years[$i], " INNER JOIN student ON enrol_stud_no = stud_no ", " stud_gender = 'MALE' AND enrol_sy = '$years[$i]' AND enrol_section != '' AND enrol_status2 = 'RETAINED' ");
					  
					  if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
						  array_push($enrollment, $row['criteriaCount']);
					  }}
					}
					$sorted_enrollmentM = implode(',', $enrollment);

					$enrollment = array();
					for($i = sizeof($years)-1; $i >= 0; $i--){
					  $result = $controller->getCount($years[$i], " INNER JOIN student ON enrol_stud_no = stud_no ", " stud_gender = 'FEMALE' AND enrol_sy = '$years[$i]' AND enrol_section != '' AND enrol_status2 = 'RETAINED' ");
					  
					  if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
						  array_push($enrollment, $row['criteriaCount']);
					  }}
					}
					$sorted_enrollmentF = implode(',', $enrollment);				
					?>
					<script type="text/javascript">	
					setTimeout(function(){
					  $(function () {
						var lineChartCanvas = $('#lineChart4').get(0).getContext('2d')
						
						var lineChartData = {
						  labels  : [<?php echo $sorted_year;?>],
						  datasets: [
							{
							  label               : 'Male',
							  backgroundColor     : 'rgba(60,141,188,0.9)',
							  borderColor         : 'rgba(60,141,188,0.8)',
							  pointRadius          : false,
							  pointColor          : '#3b8bba',
							  pointStrokeColor    : 'rgba(60,141,188,1)',
							  pointHighlightFill  : '#fff',
							  pointHighlightStroke: 'rgba(60,141,188,1)',
							  data                : [<?php echo $sorted_enrollmentM;?>]
							},
							{
							  label               : 'Female',
							  backgroundColor     : 'rgba(210, 214, 222, 1)',
							  borderColor         : 'rgba(210, 214, 222, 1)',
							  pointRadius         : false,
							  pointColor          : 'rgba(210, 214, 222, 1)',
							  pointStrokeColor    : '#c1c7d1',
							  pointHighlightFill  : '#fff',
							  pointHighlightStroke: 'rgba(220,220,220,1)',
							  data                : [<?php echo $sorted_enrollmentF;?>]
							},
						  ]
						}
						
						var lineChartOptions = {
						  maintainAspectRatio : false,
						  responsive : true,
						  legend: {
							display: true
						  },
						  scales: {
							xAxes: [{
							  gridLines : {
								display : false,
							  }
							}],
							yAxes: [{
							  gridLines : {
								display : false,
							  }
							}]
						  }
						}
						
						var lineChartOptions = jQuery.extend(true, {}, lineChartOptions)
						var lineChartData = jQuery.extend(true, {}, lineChartData)
						lineChartData.datasets[0].fill = false;
						lineChartData.datasets[1].fill = false;
						lineChartOptions.datasetFill = false

						var lineChart = new Chart(lineChartCanvas, { 
						  type: 'line',
						  data: lineChartData, 
						  options: lineChartOptions
						})
					  })
					}, 1);
					</script>
				</div>
			</div>					
		</div>
		<?php
	}

}
?>