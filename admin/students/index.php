	<div class="content-wrapper">
	
		<section class="content-header">
			<div class="container">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Student Management</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="?p=my"><i class="fas fa-home"></i></a></li>
							<li class="breadcrumb-item active">Students</li>
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
								<h3 id="entity-count-1">{entity-count-1}</h3>
								<p>Total</p>
							</div>
							<div class="icon">
								<i class="nav-icon fas fa-user-plus"></i>
							</div>
							<a href="?p=students&new" class="small-box-footer" title="Add employee">
								Add Student <i class="fas fa-user-plus"></i>
							</a>
						</div>
					</div>
					<div class="col-lg-3 col-6">
						<div class="small-box bg-danger">
							<div class="inner">
								<h3 id="entity-count-2">{entity-count-2}</h3>
								<p>Male</p>
							</div>
							<div class="icon">
								<i class="nav-icon fas fa-mars"></i>
							</div>
							<a href="javascript:void(0);" onclick="getEntityList('<?php echo $_SESSION['current_sy'];?>', ' stud_gender LIKE \'MALE\' ');" class="small-box-footer">Toggle view <i class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>
					<div class="col-lg-3 col-6">
						<div class="small-box bg-success">
							<div class="inner">
								<h3 id="entity-count-3">{entity-count-3}</h3>
								<p>Female</p>
							</div>
							<div class="icon">
								<i class="nav-icon fas fa-venus"></i>
							</div>
							<a href="javascript:void(0);" onclick="getEntityList('<?php echo $_SESSION['current_sy'];?>', ' stud_gender LIKE \'FEMALE\' ');" class="small-box-footer">Toggle view <i class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>
					<div class="col-lg-3 col-6">
						<div class="small-box bg-secondary">
							<div class="inner">
								<h3 id="entity-count-4">{entity-count-4}</h3>
								<p>Not Enrolled</p>
							</div>
							<div class="icon">
								<i class="nav-icon fas fa-user-slash"></i>
							</div>
							<a href="javascript:void(0);" onclick="getEntityList('%', '  stud_gender LIKE \'%\' AND stud_no NOT IN (SELECT enrol_stud_no FROM studenroll WHERE enrol_sy = \'<?php echo $_SESSION['current_sy'];?>\') ');" class="small-box-footer">Toggle view <i class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">List <span id="entity-list-count"></span></h3>
								<div class="card-tools">
									<div class="input-group input-group-sm" style="width: 300px;">
										<div class="input-group-prepend">
											<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
												Filter
											</button>
											<ul class="dropdown-menu">
											  <li class="dropdown-item"><a href="javascript:void(0);" onclick="getEntityList('<?php echo $_SESSION['current_sy'];?>', ' stud_gender LIKE \'MALE\' ');">Male</a></li>
											  <li class="dropdown-item"><a href="javascript:void(0);" onclick="getEntityList('<?php echo $_SESSION['current_sy'];?>', ' stud_gender LIKE \'FEMALE\' ');">Female</a></li>
											  <li class="dropdown-item"><a href="javascript:void(0);" onclick="getEntityList('<?php echo $_SESSION['current_sy'];?>', ' stud_gender LIKE \'%\' ');">All Active</a></li>
											  <div class="dropdown-divider"></div>
											  <li class="dropdown-item"><a href="javascript:void(0);" onclick="getEntityList('%', '   stud_gender LIKE \'%\' AND stud_no NOT IN (SELECT enrol_stud_no FROM studenroll WHERE enrol_sy = \'<?php echo $_SESSION['current_sy'];?>\') ');">All Inactive</a></li>
											</ul>
										</div>
										<input type="text" name="table_search" class="form-control float-right" name="searchEntity" id="searchEntity" onkeyup="getEntityList('%', '');" placeholder="Search...">

										<div class="input-group-append">
											<button type="submit" class="btn btn-info" onclick="getEntityList('%', '  stud_gender LIKE \'%\' ');"><i class="fas fa-sync-alt"></i></button>
										</div>
									</div>
								</div>
							</div>
							<div class="card-body table-responsive p-0">
								<table class="table table-hover">
									<thead>
										<tr>
											<th width="8%">#</th>
											<th>Fullname</th>
											<th width="6%">Sex</th>
											<th width="15%">Current Class</th>						
											<th width="20%">Status (SY <?php echo $_SESSION['current_sy'];?>-<?php echo $_SESSION['current_sy']+1;?>)</th>
											<th width="5%"></th>
											</tr>
									</thead>
									<tbody id="entity-list">
									</tbody>
								</table>
							</div>
							<!--
							<div class="card-footer clearfix">
								<ul class="pagination pagination-sm m-0 float-right">
									<li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
									<li class="page-item"><a class="page-link" href="#">1</a></li>
									<li class="page-item"><a class="page-link" href="#">2</a></li>
									<li class="page-item"><a class="page-link" href="#">3</a></li>
									<li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
								</ul>
							</div>
							-->
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
				<div id="form-input">
				</div>
			</div>			
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-default" data-dismiss="modal" id="close2">Close</button>
				<button type="submit" class="btn btn-info" name="submit" id="submit"></button>
				</form>	
			</div>			
		</div>
	</div>
</div>
	
<script type="text/javascript">	
setTimeout(function(){preLoad();}, 1);

setTimeout(function(){
	$(function(){
		$('#modal-input').on('show.bs.modal', function(e){
			var actionType = $(e.relatedTarget).attr('data-type');
			var id = $(e.relatedTarget).attr('rowID');
			var userFunc;
			
			if(actionType == 'addEmployee'){
				$('#form-modify').hide();
				$('#modal-size').addClass('modal-md');
				$('#modal-title').html('Create employee');
				$('#submit').html('Submit');
				userFunc = "return confirm('Save employee?') ? submitAction('addEmplpyee') : false;";
				$('#submit').attr('onclick', userFunc);
				
			} else if(actionType == 'modifyEmployee'){
				$('#modal-size').addClass('modal-md');
				$('#modal-title').html('Modify employee #<span id="list-id">'+id+'</span>');
				$('#submit').html('Update');
				userFunc = "return confirm('Update employee?') ? submitAction('modifyEmployee') : false;";
				$('#submit').attr('onclick', userFunc);
			} 
			
			showAction(actionType, $('#list-id').html());
		});
		
		$('#modal-input').on('hidden.bs.modal', function(){
			$('#modal-size').removeClass('modal-xs');
			$('#modal-size').removeClass('modal-sm');
			$('#modal-size').removeClass('modal-md');
			$('#modal-size').removeClass('modal-lg');
			$('#modal-size').removeClass('modal-xl');
			$('#form').trigger('reset');
			$('#form-input').html('');
			
			$('#submit').html('');
			$('#submit').removeAttr('disabled');
			
			$('#close1').removeAttr('disabled');
			$('#close2').removeAttr('disabled');						
		});
	});
}, 1);


function preLoad(){
	getEntityList('<?php echo $_SESSION['current_sy'];?>', '');
	getEntityCount();
}

function getEntityList(enrol_sy, condition){
	var action = 'getEntityList';
	var searchEntity = $('#searchEntity').val();
	var tableJoin;
	if(condition == ''){
		condition = "  (CONCAT(stud_lname,', ',stud_fname)  LIKE '%"+searchEntity+"%' OR stud_fname LIKE '%"+searchEntity+"%' OR stud_lname LIKE '%"+searchEntity+"%' OR stud_lrn LIKE '%"+searchEntity+"%' OR stud_no LIKE '%"+searchEntity+"%') ";
		tableJoin = '';
	} else {
		tableJoin = ' INNER JOIN studenroll ON stud_no = enrol_stud_no ';	
		condition = condition + " AND enrol_sy LIKE '"+enrol_sy+"'  ";
	}
	
	var data = [action, tableJoin, condition];
	$.ajax({
		type: 'POST',
		url: 'students/action.php',
		data: {data:data},	
		success: function(result){
			$('#entity-list').html(result);
		}
	});	
	
}

function getEntityCount(){
	var action = 'getEntityCount';

	var data = [action, '%', " AND enrol_sy = '<?php echo $_SESSION['current_sy'];?>' "];
	$.ajax({
		type: 'POST',
		url: 'students/action.php',
		data: {data:data},	
		success: function(result){
			$('#entity-count-1').html(result[2].entityCount);
		}
	});	

	var data = [action, 'MALE', " AND enrol_sy = '<?php echo $_SESSION['current_sy'];?>' "];
	$.ajax({
		type: 'POST',
		url: 'students/action.php',
		data: {data:data},	
		success: function(result){
			$('#entity-count-2').html(result[2].entityCount);
		}
	});	
	
	var data = [action, 'FEMALE', " AND enrol_sy = '<?php echo $_SESSION['current_sy'];?>' "];
	$.ajax({
		type: 'POST',
		url: 'students/action.php',
		data: {data:data},	
		success: function(result){
			$('#entity-count-3').html(result[2].entityCount);
		}
	});	
	
	var data = [action, '%', " AND stud_no NOT IN (SELECT enrol_stud_no FROM studenroll WHERE enrol_sy = '<?php echo $_SESSION['current_sy'];?>') "];
	$.ajax({
		type: 'POST',
		url: 'students/action.php',
		data: {data:data},	
		success: function(result){
			$('#entity-count-4').html(result[2].entityCount);
		}
	});
}
</script>	