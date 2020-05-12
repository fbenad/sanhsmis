	<div class="content-wrapper">
	
		<section class="content-header">
			<div class="container">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>User Access</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="?p=my"><i class="fas fa-home"></i></a></li>
							<li class="breadcrumb-item"><a href="?p=users">Users</a></li>
							<li class="breadcrumb-item active">Access</li>
						</ol>
					</div>
				</div>
			</div>
		</section>

		<section class="content">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">Access List</h3>
								<div class="card-tools">
									
									<div class="input-group input-group-sm" style="width: 350px;">
										<div class="input-group-prepend">
											<button class="btn btn-info btn-sm" href="javascript:void(0);" title="Assign access" 
												data-toggle="modal" data-target="#modal-input" rowID="0" 
												data-backdrop="static" data-keyboard="false" data-type="addAccess">
												Assign Access
											</button>
											
										</div>
										<select class="form-control" id="module-slug" onchange="changeSlug();">
										</select>
										<div class="input-group-append">
											<button class="btn btn-info btn-sm" href="javascript:void(0);" title="Add module slug" 
												data-toggle="modal" data-target="#modal-input" rowID="0" 
												data-backdrop="static" data-keyboard="false" data-type="addModule">
												<i class="fas fa-plus" title="New module"></i>
											</button>
											
										</div>
									</div>
								</div>
							</div>
							<div class="card-body  table-responsive p-0">
							<table class="table table-hover ">
								<thead>
									<tr>
										<th width="6%">#</th>
										<th>User</th>
										<th width="35%">Module</th>
										<th width="15%">Role</th>
										<th width="10%"></th>									
									</tr>
								</thead>
								<tbody id="entity-list">
								</tbody>
							</table>
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
			var actionTitle = $(e.relatedTarget).attr('title');
			var id = $(e.relatedTarget).attr('rowID');
			var userFunc;
			
			if(actionType == 'addModule'){
				$('#modal-size').addClass('modal-sm');
				$('#modal-title').html(actionTitle);
				$('#submit').html('Submit');
				userFunc = "return confirm('Save module?') ? submitAction('"+actionType+"') : false;";
				$('#submit').attr('onclick', userFunc);
				 
			} else if(actionType == 'addAccess'){
				$('#modal-size').addClass('modal-md');
				$('#modal-title').html(actionTitle);
				$('#submit').html('Submit');
				userFunc = "return confirm('Save access?') ? submitAction('"+actionType+"') : false;";
				$('#submit').attr('onclick', userFunc);
				
			} else if(actionType == 'modifyAccess'){
				$('#modal-size').addClass('modal-md');
				$('#modal-title').html(actionTitle+' #<span id="list-id">'+id+'</span>');
				$('#submit').html('Update');
				userFunc = "return confirm('Update access?') ? submitAction('"+actionType+"') : false;";
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
	getModules();
}

function getModules(){
	var action = 'getModules';
	
	var data = [action];
	$.ajax({
		type: 'POST',
		url: 'users/access/action.php',
		data: {data:data},	
		success: function(result){
			$('#module-slug').html(result);
			getAccessList();
		}
	});
}

function showAction(actionType, list_id){
	var action = 'showAction';
	
	if(actionType == 'addModule'){
		var data = [action, actionType];
		$.ajax({
			type: 'POST',
			url: 'users/access/action.php',
			data: {data:data},	
			success: function(result){
				$('#form-input').html(result);
			}
		});
		
	} else if(actionType == 'addAccess'){
		var data = [action, actionType];
		$.ajax({
			type: 'POST',
			url: 'users/access/action.php',
			data: {data:data},	
			success: function(result){
				$('#form-input').html(result);
			}
		});
		
	} else if(actionType == 'modifyAccess'){
		var data = [action, 'addAccess'];
		$.ajax({
			type: 'POST',
			url: 'users/access/action.php',
			data: {data:data},	
			success: function(result){
				$('#form-input').html(result);
				$('#form-delete').show();
			}
		});
		
		var data = [action, actionType, list_id];
		$.ajax({
			type: 'POST',
			url: 'users/access/action.php',
			data: {data:data},	
			success: function(result){
				if(result[0] == 1){
					$('#modacc_user_no').attr('disabled', 'disabled');
					$('#modacc_module_slug').attr('disabled', 'disabled');
					$('#modacc_user_no').val(result[2].modacc_user_no);
					$('#modacc_module_slug').val(result[2].modacc_module_slug);
					$('#modacc_role').val(result[2].modacc_role);
					
				} else {
					$('#modacc_user_no').attr('disabled', 'disabled');
					$('#modacc_module_slug').attr('disabled', 'disabled');
					$('#modacc_role').attr('disabled', 'disabled');
					$('#submit').attr('disabled', 'disabled');
					toastr.error(result[1]);
				}
			}
		});
	}
}

function submitAction(actionType){
	var action = 'submitAction';
	var list_id = $('#list-id').html();
	
	if(actionType == 'addModule'){
		var module_slug = $('#module_slug').val();
		var module_name = $('#module_name').val();
		
		var data = [action, actionType, module_slug, module_name];
		
		if(data[2] == ''){
			toastr.error('Invalid slug.');
		} else {
			$('#close1').attr('disabled', 'disabled');
			$('#close2').attr('disabled', 'disabled');
			$('#submit').attr('disabled', 'disabled');
			$('#submit').html('Validating...');
			
			$.ajax({
				type: 'POST',
				url: 'users/access/action.php',
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
						setTimeout(function(){$('#submit').html('Submit');}, 500);						
						setTimeout(function(){toastr.error(result[1]);}, 500);							
					}
				}
			});
		}
		
	} else if(actionType == 'addAccess'){
		var modacc_user_no = $('#modacc_user_no').val();
		var modacc_module_slug = $('#modacc_module_slug').val();
		var modacc_role = $('#modacc_role').val();
		
		var data = [action, actionType, modacc_user_no, modacc_module_slug, modacc_role];
		
		if(data[2] == ''){
			toastr.error('Invalid user.');
		} else if(data[3] == ''){
			toastr.error('Invalid module.');
		} else if(data[4] == ''){
			toastr.error('Invalid role.');
		} else {
			$('#close1').attr('disabled', 'disabled');
			$('#close2').attr('disabled', 'disabled');
			$('#submit').attr('disabled', 'disabled');
			$('#submit').html('Validating...');
			
			$.ajax({
				type: 'POST',
				url: 'users/access/action.php',
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
						setTimeout(function(){$('#submit').html('Submit');}, 500);						
						setTimeout(function(){toastr.error(result[1]);}, 500);							
					}
				}
			});
		}
		
	} else if(actionType == 'modifyAccess'){
		var modacc_role = $('#modacc_role').val();
		
		var data = [action, actionType, modacc_role, list_id];
		
		if(data[3] == ''){
			toastr.error('Invalid role.');
		} else {
			$('#close1').attr('disabled', 'disabled');
			$('#close2').attr('disabled', 'disabled');
			$('#delete').attr('disabled', 'disabled');
			$('#submit').attr('disabled', 'disabled');
			$('#submit').html('Validating...');
			
			$.ajax({
				type: 'POST',
				url: 'users/access/action.php',
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
						setTimeout(function(){$('#delete').removeAttr('disabled');}, 500);						
						setTimeout(function(){$('#submit').removeAttr('disabled');}, 500);						
						setTimeout(function(){$('#submit').html('Submit');}, 500);						
						setTimeout(function(){toastr.error(result[1]);}, 500);							
					}
				}
			});
		}
		
	} else if(actionType == 'deleteAccess'){
	
		var data = [action, actionType, list_id];
		$('#close1').attr('disabled', 'disabled');
		$('#close2').attr('disabled', 'disabled');
		$('#delete').attr('disabled', 'disabled');
		$('#submit').attr('disabled', 'disabled');
		$('#submit').html('Validating...');
		
		$.ajax({
			type: 'POST',
			url: 'users/access/action.php',
			data: {data:data},	
			success: function(result){
				if(result[0] == 1){
					setTimeout(function(){$('#submit').html('Deleting...');}, 500);
					setTimeout(function(){$('#submit').html('Update');}, 1000);
					setTimeout(function(){toastr.success(result[1]);}, 1000);
					setTimeout(function(){$('#modal-input').modal('hide');}, 1500);	
					preLoad();
				} else {
					setTimeout(function(){$('#close1').removeAttr('disabled');}, 500);
					setTimeout(function(){$('#close2').removeAttr('disabled');}, 500);	
					setTimeout(function(){$('#delete').removeAttr('disabled');}, 500);						
					setTimeout(function(){$('#submit').removeAttr('disabled');}, 500);						
					setTimeout(function(){$('#submit').html('Update');}, 500);						
					setTimeout(function(){toastr.error(result[1]);}, 500);							
				}
			}
		});
	}
}

function checkSlug(){
	var action = 'checkSlug';
	var module_slug = $('#module_slug').val();
	
	var data = [action, module_slug];
	$.ajax({
		type: 'POST',
		url: 'users/access/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				$('#submit').attr('disabled', 'disabled');
				toastr.error('Slug already exist.');
			} else {
				$('#submit').removeAttr('disabled');
				
			}
		}
	});	
}

function getAccessList(){
	var action = 'getAccessList';
	var module_slug = $('#module-slug').val();
	
	var data = [action, module_slug];
	$.ajax({
		type: 'POST',
		url: 'users/access/action.php',
		data: {data:data},	
		success: function(result){
			$('#entity-list').html(result);
		}
	});		
}

function changeSlug(){
	getAccessList();
}

function updateModule(){
	var action = 'updateModule';
	var modacc_user_no = $('#modacc_user_no').val();
	
	var data = [action, modacc_user_no];
	$.ajax({
		type: 'POST',
		url: 'users/access/action.php',
		data: {data:data},	
		success: function(result){
			$('#modacc_module_slug').html(result);
		}
	});		
	
}
</script>	