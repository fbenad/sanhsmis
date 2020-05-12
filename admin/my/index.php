	<div class="content-wrapper">
	
		<section class="content-header">
			<div class="container">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Dashboard</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="?p=my"><i class="fas fa-home"></i></a></li>
							<li class="breadcrumb-item active">Dashboard</li>
						</ol>
					</div>
				</div>
			</div>
		</section>

		<section class="content">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-6">
						<div class="small-box bg-info">
							<div class="inner">
								<h3 id="total-1">{total-1}</h3>
								<p>Current Users</p>
							</div>
							<div class="icon">
								<i class="nav-icon fas fa-user-cog"></i>
							</div>
							<a href="./?p=users"  class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>
					<div class="col-lg-3 col-6">
						<div class="small-box bg-danger">
							<div class="inner">
								<h3 id="total-2">{total-2}</h3>
								<p>Current Employees</p>
							</div>
							<div class="icon">
								<i class="nav-icon fas fa-user-tie"></i>
							</div>
							<a href="./?p=employees"  class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>
					<div class="col-lg-3 col-6">
						<div class="small-box bg-success">
							<div class="inner">
								<h3 id="total-3">{total-3}</h3>
								<p>Current Students</p>
							</div>
							<div class="icon">
								<i class="nav-icon fas fa-user-graduate"></i>
							</div>
							<a href="./?p=students"  class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>
					<div class="col-lg-3 col-6">
						<div class="small-box bg-secondary">
							<div class="inner">
								<h3 id="total-4">{total-4}</h3>
								<p>Current Sections</p>
							</div>
							<div class="icon">
								<i class="nav-icon fas fa-chalkboard"></i>
							</div>
							<a href="./?p=classes"  class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>
				</div>
				<div id="dashboard-graph">
				</div>
			</div>
		</section>
	</div>		
	
<script type="text/javascript">	
setTimeout(function(){preLoad();}, 1);

function preLoad(){
	getTotals();
	getGraphs();
}


function getTotals(){
	var action = 'getTotals';
	
	var data = [action, 'users', '', " (user_status = '1' AND user_no > 10) "];
	$.ajax({
		type: 'POST',
		url: 'my/action.php',
		data: {data:data},	
		success: function(result){
			$('#total-1').html(result['2'].getTotals);
		}
	});	

	var data = [action, 'teacher', '', " (teach_status = '1') "];
	$.ajax({
		type: 'POST',
		url: 'my/action.php',
		data: {data:data},	
		success: function(result){
			$('#total-2').html(result['2'].getTotals);
		}
	});
	
	var data = [action, 'studenroll', '', " enrol_sy = '<?php echo $_SESSION['current_sy'];?>' AND (enrol_status1 = 'ENROLLED' OR enrol_status1 = 'PROMOTED') "];
	$.ajax({
		type: 'POST',
		url: 'my/action.php',
		data: {data:data},	
		success: function(result){
			$('#total-3').html(result[2].getTotals);
		}
	});
	
	var data = [action, 'section', '', " (section_sy = '<?php echo $_SESSION['current_sy'];?>' AND section_bogus = '0') "];
	$.ajax({
		type: 'POST',
		url: 'my/action.php',
		data: {data:data},	
		success: function(result){
			$('#total-4').html(result[2].getTotals);
		}
	});
}

function getGraphs(){
	var action = 'getGraphs';	
	
	var data = [action];
	$.ajax({
		type: 'POST',
		url: 'my/action.php',
		data: {data:data},	
		success: function(result){
			$('#dashboard-graph').html(result);
		}	
	});
}
</script>