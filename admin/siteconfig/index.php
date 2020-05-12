	<div class="content-wrapper">
	
		<section class="content-header">
			<div class="container">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Site Management</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="?p=my"><i class="fas fa-home"></i></a></li>
							<li class="breadcrumb-item active">Settings</li>
						</ol>
					</div>
				</div>
			</div>
		</section>

		<section class="content">
			<div class="container">
				<div class="row">
					<div class="col-md-3">
						<div class="info-box">
							<span class="info-box-icon bg-info elevation-1"><i class="fas fa-cogs"></i></span>
							<div class="info-box-content">
								<span class="info-box-text"><a href="javascript:void(0);" title="Change active school year via School Management > School Information > School Year Settings.">Active School Year</a></span>
								<span class="info-box-number" id="dashboard-label-1">0</span>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="info-box">
							<span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
							<div class="info-box-content">
								<span class="info-box-text"><a href="javascript:void(0);" title="Click to change active semester." 
									id="modify-settings"
									data-toggle="modal" data-target="#modal-input" rowID="<?php echo $_SESSION['current_sy'];?>" 
									data-backdrop="static" data-keyboard="false" data-type="modifySettings">Active Semester</a></span>
								<span class="info-box-number" id="dashboard-label-2">0</span>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="info-box">
							<span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-traffic-light"></i></span>
							<div class="info-box-content">
								<span class="info-box-text"><a href="javascript:void(0);"  title="Click to change early registration status."
									id="modify-settings" 
									data-toggle="modal" data-target="#modal-input" rowID="<?php echo $_SESSION['current_sy'];?>" 
									data-backdrop="static" data-keyboard="false" data-type="modifySettings">Early Regt'n Status</a></span>
								<span class="info-box-number" id="dashboard-label-3">0</span>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="info-box">
							<span class="info-box-icon bg-success elevation-1"><i class="fas fa-traffic-light"></i></span>
							<div class="info-box-content">
								<span class="info-box-text"><a href="javascript:void(0);"  title="Click to change active EOSY status."
									id="modify-settings"
									data-toggle="modal" data-target="#modal-input" rowID="<?php echo $_SESSION['current_sy'];?>" 
									data-backdrop="static" data-keyboard="false" data-type="modifySettings">EOSY Status</a></span>
								<span class="info-box-number" id="dashboard-label-4">0</span>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="card card-primary">
							<div class="card-body">
								<ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" id="custom-content-below-1-tab" data-toggle="pill" href="#custom-content-below-1" role="tab" aria-controls="custom-content-below-1" aria-selected="false">General</a>
									</li>	
									<li class="nav-item">
										<a class="nav-link" id="custom-content-below-2-tab" data-toggle="pill" href="#custom-content-below-2" role="tab" aria-controls="custom-content-below-2" aria-selected="false">Dropdown</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" id="custom-content-below-3-tab" data-toggle="pill" href="#custom-content-below-3" role="tab" aria-controls="custom-content-below-3" aria-selected="false">About</a>
									</li>
								</ul>
								<div class="tab-content" id="custom-content-below-tabContent">
									<div class="tab-pane fade show active" id="custom-content-below-1" role="tabpanel" aria-labelledby="custom-content-below-1-tab">
										<br>
										<small><a href="?p=schmgmt">Modify values via School Management > School Information > School Year Settings.</a></small><br><br>
										<div class="card">											
											<div class="table-responsive p-0">												
												<table class="table table-hover">
													<thead>
														<tr>
															<th width="30%">Field</th>
															<th>Details</th>
															<th></th>
														</tr>
													</thead>
													<tbody id="siteconfig-general"> 														
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<div class="tab-pane fade show" id="custom-content-below-2" role="tabpanel" aria-labelledby="custom-content-below-2-tab">
										<br>
										<div class="row">
											<div class="col-md-4">
											</div>
											<div class="col-md-4">
											</div>
											<div class="col-md-4">
												<select class="form-control" id="field_category" name="field_category" onChange="loadDropdownFieldNames();">
												</select>
											</div>
										</div>
										<br>
										<div class="card">
											<div class="table-responsive p-0">
												<table class="table table-hover">
													<thead>
														<tr>
															<th width="25%">Category</th>
															<th width="30%">Field</th>
															<th>Extension value</th>
															<th width="8%"><a href="javascript:void(0);" id="add-dropdown" title="Add dropdown" 
																	data-toggle="modal" data-target="#modal-input" rowID="0" 
																	data-backdrop="static" data-keyboard="false" data-type="addDropdown">
																	<i class="fas fa-plus-square float-right"></i>
																</a>
															</th>
														</tr>
													</thead>
													<tbody id="siteconfig-dropdowns"> 														
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<div class="tab-pane fade show" id="custom-content-below-3" role="tabpanel" aria-labelledby="custom-content-below-3-tab">
										<br>
										<div class="row">
											<div class="col-md-12">
											</div>
											<div class="col-md-12">
												<div class="card card-info">
													<div class="card-header bg-white">
														<h3 class="card-title"><?php echo $app_fullname;?></h3>
													</div>
													<div class="card-body">
														<small>
														<table width="100%">
															<tr><th width="15%">Version:</th><td><?php echo $app_version;?></td></tr>
															<tr><th>Update Date:</th><td><?php echo date('M d, Y', strtotime($app_lastdate));?></td></tr>
															<tr><th>Dev't Date:</th><td><?php echo date('M L, Y', strtotime($app_devtdate));?></td></tr>
															<tr><th>Copyright Year:</th><td><?php echo $app_copyyear;?></td></tr>
															<tr><th valign="top">Copyright Notice:</th><td><?php echo $app_copynotice;?></td></tr>	
															<tr><th>&nbsp;</th><td></td></tr>
															<tr><th>Author:</th><td><?php echo $app_author;?></td></tr>
															<tr><th>Email:</th><td><?php echo $app_authoremail;?></td></tr>
															<tr><th>Phone:</th><td><?php echo $app_authorphone;?></td></tr>
														</table>
														</small>
													</div>
												</div>
											</div>
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
				<button type="submit" class="btn btn-primary" name="submit" id="submit">Submit</button>
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
			
			if(actionType == 'modifySettings'){
				$('#modal-size').addClass('modal-lg');
				$('#modal-title').html('Modify school year settings #<span id="list-id">'+id+'</span>');
				$('#submit').html('Update');
				userFunc = "return confirm('Update school year settings?') ? submitAction('modifySettings') : false;";
				$('#submit').attr('onclick', userFunc);
				
			} else if(actionType == 'addDropdown'){
				$('#modal-size').addClass('modal-md');
				$('#modal-title').html('Add dropdown');
				$('#submit').html('Submit');
				userFunc = "return confirm('Save dropdown?') ? submitAction('addDropdown') : false;";
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
	$(document).Toasts('create', {
		class: 'bg-warning', 
		 position: 'bottomRight',
		icon: 'fas fa-flag',
        title: 'User Guide',
		autohide: true,
        delay: 10000,
        body: 'Click the links (Active Semester, Early Regt\'n Status, and EOSY Status on the control panel to change it\'s settings including login and admission messages. Hover to the active shool year panel to get tips on how to change it.'
     });
	loadGeneralSettings();
	getGeneralSettings();
	loadDropdownCategory();
}

function loadGeneralSettings(){
	var action = 'loadGeneralSettings';
	
	var data = [action];
	$.ajax({
		type: 'POST',
		url: 'siteconfig/action.php',
		data: {data:data},	
		success: function(result){
			$('#siteconfig-general').html(result);
		}
	});		
}

function loadDropdownCategory(){
	var action = 'loadDropdownCategory';
	
	var data = [action];
	$.ajax({
		type: 'POST',
		url: 'siteconfig/action.php',
		data: {data:data},	
		success: function(result){
			$('#field_category').html(result);
			loadDropdownFieldNames();
		}
	});			
}

function loadDropdownFieldNames(){
	var action = 'loadDropdownFieldNames';
	var field_category = $('#field_category').val();
	
	if(field_category == '*'){		
		var data = ['getDropdownCategory', field_category];
		$.ajax({
			type: 'POST',
			url: 'siteconfig/action.php',
			data: {data:data},	
			success: function(result){
				$('#siteconfig-dropdowns').html(result);
			}
		});				
	} else {
		var data = [action, field_category];
		$.ajax({
			type: 'POST',
			url: 'siteconfig/action.php',
			data: {data:data},	
			success: function(result){
				$('#siteconfig-dropdowns').html(result);
			}
		});		
	}
}

function getGeneralSettings(){
	var action = 'getGeneralSettings';
	
	var data = [action];
	$.ajax({
		type: 'POST',
		url: 'siteconfig/action.php',
		data: {data:data},	
		success: function(result){
			$('#dashboard-label-1').html('SY '+result[2].settings_sy+'-'+(parseInt(result[2].settings_sy)+1));
			$('#dashboard-label-2').html('Sem '+result[2].settings_sem);
			$('#dashboard-label-3').html(result[2].settings_earlyreg == '1' ? 'Active' : 'Not active');
			$('#dashboard-label-4').html(result[2].settings_eosynow == '1' ? 'Active' : 'Not active');
		}
	});		
}

function changeCategory(field_category){
	$('#field_category').val(field_category).change();;
}

function showAction(actionType, list_id){
	var action = 'showAction';
	
	if(actionType == 'modifySettings'){
		var data = [action, actionType, list_id];
		$.ajax({
			type: 'POST',
			url: 'siteconfig/action.php',
			data: {data:data},	
			success: function(result){
				$('#form-input').html(result);
			}
		});	
		
	} else if (actionType == 'addDropdown'){
		var data = [action, actionType, list_id];
		$.ajax({
			type: 'POST',
			url: 'siteconfig/action.php',
			data: {data:data},	
			success: function(result){
				$('#form-input').html(result);
			}
		});			
	}
}

function submitAction(actionType){
	var action = 'submitAction';
	
	if(actionType == 'modifySettings'){
		var settings_sy = $('#list-id').html();
		var settings_sem = $('#settings_sem').val();
		var settings_earlyreg = $('#settings_earlyreg').val();
		var settings_eosynow = $('#settings_eosynow').val();
		var settings_loginmessage = $('#settings_loginmessage').val();
		var settings_admissionmessage = $('#settings_admissionmessage').val();
		var settings_month = $('#settings_month').val();
		
		var data = [action, actionType, settings_sy, settings_sem, settings_earlyreg, settings_eosynow, settings_loginmessage, settings_admissionmessage, settings_month];
		if(sanitizeForm(data) == true){
			$('#close1').attr('disabled', 'disabled');
			$('#close2').attr('disabled', 'disabled');
			$('#submit').attr('disabled', 'disabled');
			$('#submit').html('Validating...');
				
			$.ajax({
				type: 'POST',
				url: 'siteconfig/action.php',
				data: {data:data},	
				success: function(result){
					if(result[0] == 1){
						setTimeout(function(){$('#submit').html('Updating...');}, 500);
						setTimeout(function(){$('#submit').html('Submit');}, 1000);
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
		} else {
			// error handling performed by the sanitizeForm() function
		}
	} else if (actionType == 'addDropdown'){
		var field_category = $('#field_category2').val();
		var field_name = $('#field_name').val();
		var field_ext = $('#field_ext').val();
		
		var data = [action, actionType, field_category, field_name, field_ext];
		if(sanitizeForm(data) == true){
			$('#close1').attr('disabled', 'disabled');
			$('#close2').attr('disabled', 'disabled');
			$('#submit').attr('disabled', 'disabled');
			$('#submit').html('Validating...');
				
			$.ajax({
				type: 'POST',
				url: 'siteconfig/action.php',
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
		} else {
			// error handling performed by the sanitizeForm() function
		}		
	}
}

function sanitizeForm(data){
	var result = true;
	
	if(data[1] == 'modifySettings'){
		if(data[2] == ''){
			result = false;
			toastr.error('Invalid school year.');
		} else if(data[3] == ''){
			result = false;
			toastr.error('Invalid semester.');		
		} else if(data[4] == ''){
			result = false;
			toastr.error('Invalid early registration status.');		
		} else if(data[5] == ''){
			result = false;
			toastr.error('Invalid end of school year status.');		
		} else if(data[6] == ''){
			result = false;
			toastr.error('Invalid login message.');		
		} else if(data[7] == ''){
			result = false;
			toastr.error('Invalid admission slip message.');	
		} else if(data[8] == ''){
			result = false;
			toastr.error('Invalid month.');	
		}
		
	} else if(data[1] == 'addDropdown'){
		if(data[2] == ''){
			result = false;
			toastr.error('Invalid dropdown category.');
		} else if(data[3] == ''){
			result = false;
			toastr.error('Invalid field value.');		
		} else if(data[4] == ''){
			result = false;
			toastr.error('Invalid extension value.');		
		}		
	}
	
	return result;
}
</script>	