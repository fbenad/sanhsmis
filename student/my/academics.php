	<div class="content-wrapper">
	
		<section class="content-header">
			<div class="container">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>My Academics</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="?p=my"><i class="fas fa-home"></i></a></li>
							<li class="breadcrumb-item"><a href="#">Academics</a></li>
							<li class="breadcrumb-item active">My Academics</li>
						</ol>
					</div>
				</div>
			</div>
		</section>

		<section class="content">
			<div class="container">
				<div class="row">
			
					<div class="col-md-12">

						<div class="card card-primary">
							<div class="card-body">
								<ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" id="custom-content-below-schedule-tab" data-toggle="pill" href="#custom-content-below-schedule" role="tab" aria-controls="custom-content-below-schedule" aria-selected="true">Schedule</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" id="custom-content-below-grades-tab" data-toggle="pill" href="#custom-content-below-grades" role="tab" aria-controls="custom-content-below-grades" aria-selected="true">Grades</a>
									</li>
									<li class="nav-item dropdown">
										<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Prospectus</a>
										<div class="dropdown-menu">
											<a class="dropdown-item" id="custom-content-below-myprospectus-tab" data-toggle="pill" href="#custom-content-below-myprospectus" role="tab" aria-controls="custom-content-below-myprospectus" aria-selected="true">My Prospectus</a>
											<a class="dropdown-item" id="custom-content-below-historicalprospectus-tab" data-toggle="pill" href="#custom-content-below-historicalprospectus" role="tab" aria-controls="custom-content-below-historicalprospectus" aria-selected="true">Prospectus History</a>
										</div>
									</li>
								</ul>
								<div class="tab-content" id="custom-content-below-tabContent">
									<div class="tab-pane fade show active" id="custom-content-below-schedule" role="tabpanel" aria-labelledby="custom-content-below-schedule-tab">
										<br>
										<div class="row">
											<div class="col-md-8">
												<!--<a href="#">Download Class Schedule as PDF <i class="fas fa-download"></i></a>-->
											</div>
											<div class="col-md-4">
												<select class="form-control" onchange="changeTerm();" id="myacademics-myterms">

												</select><br>
											</div>
										</div>
										
										<div class="card">
											<div class="card-body table-responsive p-0">
												<table class="table table-hover table-striped">
													<thead>
														<tr>
															<th width="15%">Course Code</th>
															<th>Descriptive Title</th>
															<th width="3%"></th>
															<th width="15%">Time</th>
															<th width="8%">Days</th>
															<th width="10%">Room</th>
															<th width="15%">Teacher</th>
														</tr>		
													</thead>
													<tbody id="myacademics-schedule"> 
					
													</tbody>
												</table>
											</div>	
										</div>	
									</div>
									<div class="tab-pane fade" id="custom-content-below-grades" role="tabpanel" aria-labelledby="custom-content-below-grades-tab">
										<br>
										<div id="myacademics-grade">									

										</div>
									</div>
									<div class="tab-pane fade show" id="custom-content-below-myprospectus" role="tabpanel" aria-labelledby="custom-content-below-myprospectus-tab">
										<br>
										<div id="myacademics-myprospectus">
										</div>									
									</div>
									<div class="tab-pane fade show" id="custom-content-below-historicalprospectus" role="tabpanel" aria-labelledby="custom-content-below-historicalprospectus-tab">
										<br>
										<div id="myacademics-prospectushistory">
										</div>									
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>

<script type="text/javascript">	
var id = <?php echo $_SESSION['stud_no'];?>;
var currentSY = <?php echo $_SESSION['current_sy'];?>;
var currentSem = <?php echo $_SESSION['current_sem'];?>;
var currentCurrYear = <?php echo $_SESSION['current_currYear'];?>;
	
setTimeout(function(){preLoad();}, 1);

function preLoad(){
	getScheduleTerms();
	getGradeTerms();
	getSchedules();
	getProspectus();
	getProspectusHistory();
}

function getScheduleTerms(){
	var action = 'getScheduleTerms';
	var data = [action, id];
	
	$.ajax({
		type: 'POST',
		url: 'my/action.php',
		data: {data:data},	
		success: function(result){
			$('#myacademics-myterms').html(result);
		}
	});	
}

function getSchedules(){
	var action = 'getSchedules';
	var data = [action, id, currentSY, currentSem];
	
	$.ajax({
		type: 'POST',
		url: 'my/action.php',
		data: {data:data},	
		success: function(result){
			$('#myacademics-schedule').html(result);
			//$('#myacademics-myterms').val(currentSY+''+currentSem).change();
		}
	});	
}

function changeTerm(){
	currentSY = $('#myacademics-myterms').val().substring(0,4);
	currentSem = $('#myacademics-myterms').val().substring(4);
	getSchedules();
}

function getGradeTerms(){
	var action = 'getGradeTerms';
	var data = [action, id];
	
	$.ajax({
		type: 'POST',
		url: 'my/action.php',
		data: {data:data},	
		success: function(result){
			$('#myacademics-grade').html(result);
		}
	});	
}

function getProspectus(){
	var action = 'getProspectus';
	var data = [action, id, currentSY, currentCurrYear];
	
	$.ajax({
		type: 'POST',
		url: 'my/action.php',
		data: {data:data},	
		success: function(result){
			$('#myacademics-myprospectus').html(result);
		}
	});	
}

function getProspectusHistory(){
	var action = 'getProspectusHistory';
	var data = [action, id, currentSY, currentCurrYear];
	
	$.ajax({
		type: 'POST',
		url: 'my/action.php',
		data: {data:data},	
		success: function(result){
			$('#myacademics-prospectushistory').html(result);
		}
	});	
}
</script>