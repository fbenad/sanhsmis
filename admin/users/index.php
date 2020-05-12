	<div class="content-wrapper">
	
		<section class="content-header">
			<div class="container">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>User Management</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="?p=my"><i class="fas fa-home"></i></a></li>
							<li class="breadcrumb-item active">Users</li>
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
								<h3 id="users-total">{users-total}</h3>
								<p>Total</p>
							</div>
							<div class="icon">
								<i class="nav-icon fas fa-user-plus"></i>
							</div>
							<a href="javascript:void(0);" class="small-box-footer" title="Create user" 
									data-toggle="modal" data-target="#modal-input" rowID="0" data-type="addUser" data-backdrop="static" data-keyboard="false">
									Create User <i class="fas fa-user-plus"></i></a>
						</div>
					</div>
					<div class="col-lg-3 col-6">
						<div class="small-box bg-danger">
							<div class="inner">
								<h3 id="users-administrators">{users-administrators}</h3>
								<p>Administrators</p>
							</div>
							<div class="icon">
								<i class="nav-icon fas fa-user-cog"></i>
							</div>
							<a href="javascript:void(0);" onclick="searchUsers('1', ' AND user_role LIKE \'1\' ');" class="small-box-footer">Toggle view <i class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>
					<div class="col-lg-3 col-6">
						<div class="small-box bg-success">
							<div class="inner">
								<h3 id="users-employees">{users-employees}</h3>
								<p>Employees</p>
							</div>
							<div class="icon">
								<i class="nav-icon fas fa-user-tie"></i>
							</div>
							<a href="javascript:void(0);" onclick="searchUsers('1', ' AND user_role LIKE \'2\' ');" class="small-box-footer">Toggle view <i class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>
					<div class="col-lg-3 col-6">
						<div class="small-box bg-secondary">
							<div class="inner">
								<h3 id="users-students">{users-students}</h3>
								<p>Students</p>
							</div>
							<div class="icon">
								<i class="nav-icon fas fa-user-graduate"></i>
							</div>
							<a href="javascript:void(0);" onclick="searchUsers('1', ' AND user_role LIKE \'3\' ');" class="small-box-footer">Toggle view <i class="fas fa-arrow-circle-right"></i></a>
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
											  <li class="dropdown-item"><a href="javascript:void(0);" onclick="searchUsers('1', ' AND user_role LIKE \'1\' ');">Administrators</a></li>
											  <li class="dropdown-item"><a href="javascript:void(0);" onclick="searchUsers('1', ' AND user_role LIKE \'2\' ');">Employees</a></li>
											  <li class="dropdown-item"><a href="javascript:void(0);" onclick="searchUsers('1', ' AND user_role LIKE \'3\' ');">Students</a></li>
											  <li class="dropdown-item"><a href="javascript:void(0);" onclick="searchUsers('1', ' AND user_role LIKE \'%\' ');">All Active Users</a></li>
											  <div class="dropdown-divider"></div>											  
											  <li class="dropdown-item"><a href="javascript:void(0);" onclick="searchUsers('0', ' AND user_role LIKE \'%\' ');">All Inactive</a></li>
											  <li class="dropdown-item"><a href="javascript:void(0);" onclick="searchUsers('%', ' AND user_role LIKE \'%\' ');">All Users</a></li>											  
											</ul>
										</div>
										<input type="text" name="table_search" class="form-control float-right" name="searchUsers" id="searchUsers" onkeyup="searchUsers('%', '');" placeholder="Search...">

										<div class="input-group-append">
											<button type="submit" class="btn btn-info" onclick="searchUsers('%', ' AND user_role LIKE \'%\' ');"><i class="fas fa-sync-alt"></i></button>
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
											<th width="25%">Username</th>															
											<th width="10%">Role</th>
											<th width="15%">Module Access</th>
											<th width="10%">Status</th>
											<th width="6%"></th>
											</tr>
									</thead>
									<tbody id="users-list">
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
			
			if(actionType == 'addUser'){
				$('#form-modify').hide();
				$('#modal-size').addClass('modal-md');
				$('#modal-title').html('Create user');
				$('#submit').html('Submit');
				userFunc = "return confirm('Save user?') ? submitAction('addUser') : false;";
				$('#submit').attr('onclick', userFunc);
				
			} else if(actionType == 'modifyUser'){
				$('#modal-size').addClass('modal-md');
				$('#modal-title').html('Modify user #<span id="list-id">'+id+'</span>');
				$('#submit').html('Update');
				userFunc = "return confirm('Update user?') ? submitAction('modifyUser') : false;";
				$('#submit').attr('onclick', userFunc);
				
			} else if(actionType == 'viewAccess'){
				$('#modal-size').addClass('modal-md');
				$('#modal-title').html('View access for user #<span id="list-id">'+id+'</span>');
				$('#submit').html('Update');
				userFunc = "return confirm('Update user?') ? submitAction('"+actionType+"') : false;";
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
	var user_role = <?php echo $_SESSION['user_role'];?>;
	
	if(user_role != 1){
		window.location = '?p=denied';
	}
	
	getUsers('1');
	getUserCount();
}

function getUsers(user_status){
	var action = 'getUsers';
	
	var data = [action, user_status, ''];
	$.ajax({
		type: 'POST',
		url: 'users/action.php',
		data: {data:data},	
		success: function(result){
			$('#users-list').html(result);
		}
	});	
}

function searchUsers(user_status, condition){
	var action = 'getUsers';
	var searchUsers = $('#searchUsers').val();
	
	if(condition == ''){
		condition = " AND (user_fullname LIKE '%"+searchUsers+"%' OR user_name LIKE '%"+searchUsers+"%' OR user_no LIKE '%"+searchUsers+"%')  ";
	} 
	
	var data = [action, user_status, condition];
	$.ajax({
		type: 'POST',
		url: 'users/action.php',
		data: {data:data},	
		success: function(result){
			$('#users-list').html(result);
		}
	});		
}

function getUserCount(){
	var action = 'getUserCount';
	
	var data = [action, '%', " AND user_status = '1' "];
	$.ajax({
		type: 'POST',
		url: 'users/action.php',
		data: {data:data},	
		success: function(result){
			$('#users-total').html(result[2].userCount);
		}
	});	

	var data = [action, '1', " AND user_status = '1' "];
	$.ajax({
		type: 'POST',
		url: 'users/action.php',
		data: {data:data},	
		success: function(result){
			$('#users-administrators').html(result[2].userCount);
		}
	});
	
	var data = [action, '2', " AND user_status = '1' "];
	$.ajax({
		type: 'POST',
		url: 'users/action.php',
		data: {data:data},	
		success: function(result){
			$('#users-employees').html(result[2].userCount);
		}
	});
	
	var data = [action, '3', " AND user_status = '1' "];
	$.ajax({
		type: 'POST',
		url: 'users/action.php',
		data: {data:data},	
		success: function(result){
			$('#users-students').html(result[2].userCount);
		}
	});
}

function showAction(actionType, list_id){
	var action = 'showAction';
	
	if(actionType == 'addUser'){
		var data = [action, actionType];
		$.ajax({
			type: 'POST',
			url: 'users/action.php',
			data: {data:data},	
			success: function(result){
				$('#form-input').html(result);
			}
		});
		
	} else if(actionType == 'modifyUser'){
		var data = [action, actionType];
		$.ajax({
			type: 'POST',
			url: 'users/action.php',
			data: {data:data},	
			success: function(result){
				$('#form-input').html(result);	
			}
		});
		
		var user_no = $('#list-id').html();
		var data = [action, 'getUser', user_no];
		$.ajax({
			type: 'POST',
			url: 'users/action.php',
			data: {data:data},	
			success: function(result){
				if(result[0] == 1){
					$('#user_role').val(result[2].user_role).change();
					$('#user_fullname').val(result[2].user_fullname).text();
					$('#user_name').val(result[2].user_name);
					if(result[2].user_status == '0'){
						$('#user-disabled').attr('disabled', 'disabled');					
					} else {
						$('#user-disabled').removeAttr('disabled');
					}
				} else {
					toastr.error(result[1]);
				}
			}
		});
		
	} else if(actionType == 'viewAccess'){
		var data = [action, actionType, list_id];
		$.ajax({
			type: 'POST',
			url: 'users/action.php',
			data: {data:data},	
			success: function(result){
				$('#form-input').html(result);
				$('#submit').hide();
			}
		});
		
	}
}

function submitAction(actionType){
	var action = 'submitAction';

	if(actionType == 'addUser'){
		var user_role = $('#user_role').val();
		var user_no = $('#user_no').val();
		var user_name = $('#user_name').val();
		var user_pass = $('#user_pass').val();
		var user_fullname = $('#user_fullname').val();
		
		var data = [action, actionType, user_role, user_no, user_name, user_pass, user_fullname];
		if(sanitizeForm(data) == true){
			$('#close1').attr('disabled', 'disabled');
			$('#close2').attr('disabled', 'disabled');
			$('#submit').attr('disabled', 'disabled');
			$('#submit').html('Validating...');
			
			$.ajax({
				type: 'POST',
				url: 'users/action.php',
				data: {data:data},	
				success: function(result){
					if(result[0] == 1){
						setTimeout(function(){$('#submit').html('Saving...');}, 500);
						setTimeout(function(){$('#submit').html('Submit');}, 1000);
						setTimeout(function(){toastr.success(result[1]);}, 1000);
						setTimeout(function(){$('#modal-input').modal('hide');}, 1500);	
						preLoad();
						
					} else {
						setTimeout(function(){$('#close1').removeAttr('disabled');}, 500);
						setTimeout(function(){$('#close2').removeAttr('disabled');}, 500);	
						setTimeout(function(){$('#submit').removeAttr('disabled');}, 500);						
						setTimeout(function(){$('#submit').html('Unfinalize');}, 500);						
						setTimeout(function(){toastr.error(result[1]);}, 500);						
					}
				}
			});			
		}
		
	} else if(actionType == 'modifyUser'){
		var user_role = $('#user_role').val();
		var user_no = $('#list-id').html();		
		var user_name = $('#user_name').val();
		var user_fullname = $('#user_fullname').val();
		
		var data = [action, actionType, user_role, user_no, user_name, user_fullname];
		if(sanitizeForm(data) == true){
			$('#close1').attr('disabled', 'disabled');
			$('#close2').attr('disabled', 'disabled');
			$('#submit').attr('disabled', 'disabled');
			$('#submit').html('Validating...');

			$.ajax({
				type: 'POST',
				url: 'users/action.php',
				data: {data:data},	
				success: function(result){
					if(result[0] == 1){
						setTimeout(function(){$('#submit').html('Updating...');}, 500);
						setTimeout(function(){$('#submit').html('Update');}, 1000);
						setTimeout(function(){toastr.success(result[1]);}, 1000);
						setTimeout(function(){$('#modal-input').modal('hide');}, 1500);	
						preLoad();
						
					} else {
						setTimeout(function(){$('#close1').removeAttr('disabled');}, 500);
						setTimeout(function(){$('#close2').removeAttr('disabled');}, 500);	
						setTimeout(function(){$('#submit').removeAttr('disabled');}, 500);						
						setTimeout(function(){$('#submit').html('Update');}, 500);						
						setTimeout(function(){toastr.error(result[1]);}, 500);						
					}
				}
			});	
		} 
		
	} 
	
}

function sanitizeForm(data){$('input[name="name_of_your_radiobutton"]:checked').val();
	var result = true;

	if(data[1] == 'addUser'){
		if(data[2] == ''){
			result = false;
			toastr.error('Invalid user type.');
		} else if(data[3] == ''){
			result = false;
			toastr.error('Invalid name.');
		} else if(data[4] == ''){
			result = false;
			toastr.error('Invalid username.');
		}
		
	} else if(data[1] == 'modifyUser'){
		if(data[2] == ''){
			result = false;
			toastr.error('Invalid user type.');
		} else if(data[4] == ''){
			result = false;
			toastr.error('Invalid username.');
		} else if(data[5] == ''){
			result = false;
			toastr.error('Invalid name.');
		}
	}
	
	return result;
}

function updateUserNo(){
	var action = 'updateUserNo';
	var user_role = $('#user_role').val();
	
	if(user_role == "1" || user_role == "2"){
		var data = [action, 'teacher'];
	} else {
		var data = [action, 'student'];
	}
	
	$.ajax({
		type: 'POST',
		url: 'users/action.php',
		data: {data:data},	
		success: function(result){
			$('#user_no').html(result);
			$('#user_name').val('');
			$('#user_fullname').val('');
			$('#user_name').removeClass('is-invalid');
			$('#for-username-error').hide();
		}
	});
}

function updateUsername(){
	var userFullName = $("#user_no option:selected").text();
	$("#user_name").val('');
	var username = userFullName.split(',');
	var user_lname = username[0].trim();
	var user_fname = username[1].trim();
	var user_mname = username[2].trim();
	
	user_mname = user_mname.substr(0, 1)+'.';
	var user_fullname = user_fname+' '+user_mname+' '+user_lname;
	
	var user_name = user_fname+'.'+user_lname;
	
	
	
	user_name = user_name.toLowerCase();
	user_name = user_name.replace(/\s+/g, '');
	
	user_fullname = user_fullname.trim();

	$('#user_name').val(user_name);
	$('#user_fullname').val(user_fullname);
	$('#user_name').focus();
	
}

function checkUsername(){
	var action = 'checkUsername';
	var user_name = $('#user_name').val();

	var data = [action, user_name];
	$.ajax({
		type: 'POST',
		url: 'users/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				$('#user_name').addClass('is-invalid');
				$('#submit').attr('disabled', 'disabled');
				$('#for-username-error').show();
			} else {
				$('#user_name').removeClass('is-invalid');
				$('#submit').removeAttr('disabled');
				$('#for-username-error').hide();
			}
		}
	});	
}	

function resetUser(user_status){
	var action = 'resetUser';
	var user_no = $('#list-id').html();	

	var data = [action, user_status, user_no];
	$.ajax({
		type: 'POST',
		url: 'users/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				toastr.success(result[1]);
				showAction('modifyUser', user_no);
				preLoad();
			} else {
				toastr.error(result[1]);
			}
		}
	});		
}
</script>	