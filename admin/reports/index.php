	<div class="content-wrapper">
	
		<section class="content-header">
			<div class="container">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Reports Management</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="?p=my"><i class="fas fa-home"></i></a></li>
							<li class="breadcrumb-item active">Report</li>
						</ol>
					</div>
				</div>
			</div>
		</section>

		<section class="content">
			<div class="container">
				<div class="row">
				
					<div class="col-md-12">

						<div class="card">
							<div class="card-body">							
								<ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" id="custom-content-below-0-tab" data-toggle="pill" href="#custom-content-below-0" role="tab" aria-controls="custom-content-below-0" aria-selected="true">School Performance</a>
									</li>
									<li class="nav-item">
										<a class="nav-link " id="custom-content-below-2-tab" data-toggle="pill" href="#custom-content-below-2" role="tab" aria-controls="custom-content-below-2" aria-selected="true">Curriculum</a>
									</li>								
								</ul>
								<div class="tab-content" id="custom-content-below-tabContent">
									<div class="tab-pane fade show active" id="custom-content-below-0" role="tabpanel" aria-labelledby="custom-content-below-0-tab">	
										<br>	
										<div class="row" id="classes-tab-0"></div>	
									</div>
									<div class="tab-pane fade show " id="custom-content-below-2" role="tabpanel" aria-labelledby="custom-content-below-2-tab">
										<br>
										<div class="row">
											<div class="col-md-8"></div>
											<div class="col-md-4">
												<select class="form-control float-right" id="pros-level" onchange="getCurriculumPerformance();"></select>
											</div>
										</div>
										<br>
										<div class="row" id="classes-tab-2"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>			
			</div>
		</section>
	</div>		
	
<div class="modal fade" id="modal-input">
	<div class="modal-dialog" id="modal-size">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="modal-title">x</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close1">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form role="form" id="form" method="post" onSubmit="return false;">	
				<div id="class-input">
				</div>
			</div>			
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-default" data-dismiss="modal" id="close2">Close</button>
				<button type="submit" class="btn btn-info" name="submit" id="submit">Submit</button>
				<div class="btn-group" id="form-modify">
					<button type="button" class="btn btn-danger" name="delete" id="delete">Delete</button>
					<button type="submit" class="btn btn-info" name="update" id="update">Update</button>
				</div>
				</form>	
			</div>			
		</div>
	</div>
</div>
	
<script type="text/javascript">	
setTimeout(function(){preLoad();}, 1);

function preLoad(){
	getSchoolPerformance();	
	loadLevels();

}

function getSchoolPerformance(){
	var action = 'getSchoolPerformance';
	
	var data = [action];
	$.ajax({
		type: 'POST',
		url: 'reports/action.php',
		data: {data:data},	
		success: function(result){
			$('#classes-tab-0').html(result);
		}
	});		
}

function loadLevels(){
	var action = 'loadLevels';
	
	var data = [action];
	$.ajax({
		type: 'POST',
		url: 'reports/action.php',
		data: {data:data},	
		success: function(result){
			$('#pros-level').html(result);
			getCurriculumPerformance();
		}
	});		
}

function getCurriculumPerformance(){
	var action = 'getCurriculumPerformance';
	var pros_level = $('#pros-level').val();
	
	var data = [action, pros_level];
	$.ajax({
		type: 'POST',
		url: 'reports/action.php',
		data: {data:data},	
		success: function(result){
			$('#classes-tab-2').html(result);
			
		}
	});		
}

</script>	