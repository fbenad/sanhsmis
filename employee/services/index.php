	<div class="content-wrapper">
	
		<section class="content-header">
			<div class="container">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Personnel Services</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="?p=my"><i class="fas fa-home"></i></a></li>
							<li class="breadcrumb-item active">Personnel Services</li>
						</ol>
					</div>
				</div>
			</div>
		</section>

		<section class="content">
			<div class="container">
				<div class="row">
			
					<div class="col-md-12">

						<div class="card card-default">
							<div class="card-body">
								<ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" id="custom-content-below-mydtr-tab" data-toggle="pill" href="#custom-content-below-mydtr" role="tab" aria-controls="custom-content-below-mydtr" aria-selected="true">My DTR</a>
									</li>	
									<li class="nav-item">
										<a class="nav-link" id="custom-content-below-saln-mysaln" data-toggle="pill" href="#custom-content-below-mysaln" role="tab" aria-controls="custom-content-below-mysaln" aria-selected="true">My SALN</a>
									</li>	
								</ul>
								<div class="tab-content" id="custom-content-below-tabContent">
									<div class="tab-pane fade show active" id="custom-content-below-mydtr" role="tabpanel" aria-labelledby="custom-content-below-mydtr-tab">
										<br>
										<div class="row">
											<div class="col-md-8">
												<h1>My DTR</h1>
											</div>
											<div class="col-md-4">
												<div class="form-group row">
													<label for="inputEmail3" class="col-md-4 col-form-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Month*</label>
													<div class="col-md-8">												
														<select class="form-control" onchange="changeActiveMonth();" id="services-mydtr-months">
														</select>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
													<li class="nav-item">
														<a class="nav-link active" id="custom-content-below-currentLogs-tab" data-toggle="pill" href="#custom-content-below-currentLogs" role="tab" aria-controls="custom-content-below-currentLogs" aria-selected="true">Current Logs</a>
													</li>	
													<li class="nav-item">
														<a class="nav-link" id="custom-content-below-missingLogs-tab" data-toggle="pill" href="#custom-content-below-missingLogs" role="tab" aria-controls="custom-content-below-missingLogs" aria-selected="true">Missing Logs</a>
													</li>	
												</ul>
												<div class="tab-content" id="custom-content-below-tabContent">
													<div class="tab-pane fade show active" id="custom-content-below-currentLogs" role="tabpanel" aria-labelledby="custom-content-below-currentLogs-tab">
														<br>
														<div class="card card-default">
															<div class="card-header">
																<h3 class="card-title" id="mydtr-monthyear1">{mydtr-monthyear}</h3>
																<div class="card-tools">
																	<a href="javascript:void(0);" class="float-right" title="Print DTR" id="print-dtr">
																		<i class="fas fa-print"></i>
																	</a>
																</div>
															</div>
															<div class="card-body table-responsive p-0">
																<table class="table table-bordered table-condensed table-hover table-striped">
																	<thead>
																		<tr>
																			<th width="6%">#</th>
																			<th width="10%">Date</th>
																			<th width="10%">Day</th>
																			<th width="13%">Time Stamp</th>
																			<th width="10%">State</th>
																			<th width="15%">Source</th>
																			<th>Remarks</th>
																		</tr>
																	</thead>
																	<tbody id="mydtr-currentLogs">
																	</tbody>
																</table>
															</div>
														</div>
													</div>
													<div class="tab-pane fade show" id="custom-content-below-missingLogs" role="tabpanel" aria-labelledby="custom-content-below-missingLogs-tab">
														<br>
														<div class="card card-default">
															<div class="card-header">
																<h3 class="card-title" id="mydtr-monthyear2">{mydtr-monthyear}</h3>
																<div class="card-tools">
																	<a href="javascript:void(0)" title="Apply a missing log" rowID="0" data-type="addMissingLog" 
																		data-toggle="modal" data-target="#modal-input" data-backdrop="static" data-keyboard="false">
																		<i class="fas fa-plus-square"></i>
																	</a>
																</div>
															</div>
															<div class="card-body table-responsive p-0">
																<table class="table table-bordered table-condensed table-hover table-striped">
																	<thead>
																		<tr>
																			<th width="6%">#</th>																			
																			<th width="8%">Date</th>
																			<th width="11%">Time Stamp</th>
																			<th width="6%">State</th>																			
																			<th width="12%">Applied</th>
																			<th>Reason/Remarks</th>
																			<th width="12%">Approver</th>
																			<th width="12%">Approved</th>
																			<th width="5%"></th>
																		</tr>
																	</thead>
																	<tbody id="mydtr-missingLogs">
																	</tbody>
																</table>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>									
									</div>
									<div class="tab-pane fade show" id="custom-content-below-mysaln" role="tabpanel" aria-labelledby="custom-content-below-mysaln-tab">
										<br>
										<div class="row">
											<div class="col-md-8">
												<h1>My SALN</h1>
											</div>
											<div class="col-md-4">
												<h3 id="services-mysaln-details-title"></h3>
											</div>
										</div>
										<div class="row" id="services-mysaln">
											<div class="col-md-12">
												<br>
												<div class="card card-default">
													<div class="card-header">
														<h3 class="card-title">List</h3>
														<div class="card-tools">
															<a href="javascript:void(0);"  title="File new SALN" rowID="0" data-type="addSALN" 
																data-toggle="modal" data-target="#modal-input" data-backdrop="static" data-keyboard="false">
																<i class="fas fa-plus-square"></i></a>
														</div>
													</div>
													<div class="card-body table-responsive p-0">
														<table class="table table-bordered table-condensed table-hover table-striped">
															<thead>
																<tr>
																	<th width="6%">#</th>																			
																	<th width="10%">Filing Year</th>
																	<th width="15%">Filing Type</th>
																	<th>Net Worth (Php)</th>
																	<th width="12%">Last Update</th>
																	<th width="15%">Processor</th>
																	<th width="12%">Status</th>
																	<th width="10%"></th>
																</tr>
															</thead>
															<tbody id="mysaln-list">
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
										<div class="row" id="services-mysaln-details">
											<div class="col-md-12">
												<br>
												<div class="card card-default">
													<div class="card-header">
														<h3 class="card-title">Filing Details</h3>
														<div class="card-tools">
															<a href="javascript:void(0);" type="button" class="btn btn-tool" title="Back to list" onClick="closeSALNDetails();">
																<i class="fas fa-reply"></i>
															</a>
														</div>
													</div>
													<div class="card-body table-responsive p-0" id="mysaln-filing-details">
														<!-- the SALN filing details shows here -->
													</div>
												</div>
											</div>
											<div class="col-md-12">
												<br>
												<div class="card card-default">
													<div class="card-header">
														<h3 class="card-title">Part I. Declarant's Information</h3>
													</div>
													<div class="card-body table-responsive p-0" id="mysaln-declarant-info">
														<!-- the SALN decalarant information shows here -->
													</div>
												</div>
											</div>
											<div class="col-md-12">
												<br>
												<div class="card card-default">
													<div class="card-header">
														<h3 class="card-title">Part II. Dependents</h3>
														<div class="card-tools">
															<a href="javascript:void(0);" class="btn btn-tool" id="add-button" title="Add dependent" rowID="0" data-type="addDependent" 
																data-toggle="modal" data-target="#modal-input" data-backdrop="static" data-keyboard="false">
																<i class="fas fa-plus-square"></i></a>
														</div>
													</div>
													<div class="card-body table-responsive p-0">
														<table class="table table-bordered table-condensed table-hover table-striped">
															<thead>
																<tr>
																	<td colspan="4">Unmarried Children Below Eighteen (18) Years of Age Living in Declarant's Household</td>
																</tr>
																<tr>
																	<th>Name</th>
																	<th width="20%">Date of Birth</th>
																	<th width="15%">Age</th>
																	<th width="5%"></th>
																</tr>
															</thead>
															<tbody id="mysaln-dependents">
																<!-- the SALN decalarant dependent shows here -->
															</tbody>
														</table>
													</div>
												</div>
											</div>
											<div class="col-md-12">
												<br>
												<div class="card card-default">
													<div class="card-header">
														<h3 class="card-title">Part III. Assets, Liabilities and Networth</h3>
													</div>
													<div class="card-body">
														<div class="card card-default">
															<div class="card-header">
																<h3 class="card-title">Assets: (a.) Real Properties</h3>
																<div class="card-tools">
																	<a href="javascript:void(0);" class="btn btn-tool" id="add-button" title="Add real property" rowID="0" data-type="addReal" 
																		data-toggle="modal" data-target="#modal-input" data-backdrop="static" data-keyboard="false">
																		<i class="fas fa-plus-square"></i></a>
																</div>
															</div>
															<div class="card-body table-responsive p-0">
																<table class="table table-bordered table-condensed table-hover table-striped">
																	<thead>
																		<tr>
																			<th width="5%">Description</th>
																			<th width="5%">Kind</th>
																			<th>Location</th>
																			<th width="13%">Assessed Value</th>
																			<th width="12%">Market Value</th>
																			<th width="5%">Year</th>
																			<th width="8%">Mode</th>
																			<th width="12%">Cost</th>
																			<th width="5%"></th>
																		</tr>
																	</thead>
																	<tbody id="mysaln-real-properties">
																		<!-- the SALN decalarant real properties shows here -->
																	</tbody>																	
																</table>
															</div>
														</div>
													</div>
													<div class="card-body" style="margin-top: -30px;">
														<div class="card card-default">
															<div class="card-header">
																<h3 class="card-title">Assets: (b.) Personal Properties</h3>
																<div class="card-tools">
																	<a href="javascript:void(0);" class="btn btn-tool" id="add-button" title="Add personal property" rowID="0" data-type="addPersonal" 
																		data-toggle="modal" data-target="#modal-input" data-backdrop="static" data-keyboard="false">
																		<i class="fas fa-plus-square"></i></a>
																</div>
															</div>
															<div class="card-body table-responsive p-0">
																<table class="table table-bordered table-condensed table-hover table-striped">
																	<thead>
																		<tr>
																			<th>Description</th>
																			<th width="15%">Year Acquired</th>
																			<th width="20%">Acquisition Cost / Amount</th>
																			<th width="5%"></th>
																		</tr>
																	</thead>
																	<tbody id="mysaln-personal-properties">
																		<!-- the SALN decalarant personal properties shows here -->
																	</tbody>
																</table>
															</div>
														</div>
													</div>
													<div class="card-body" style="margin-top: -30px;">
														<div class="card card-default">
															<div class="card-header">
																<h3 class="card-title">Liabilities</h3>
																<div class="card-tools">
																	<a href="javascript:void(0);" class="btn btn-tool" id="add-button" title="Add liability" rowID="0" data-type="addLiability" 
																		data-toggle="modal" data-target="#modal-input" data-backdrop="static" data-keyboard="false">
																		<i class="fas fa-plus-square"></i></a>
																</div>
															</div>
															<div class="card-body table-responsive p-0">
																<table class="table table-bordered table-condensed table-hover table-striped">
																	<thead>
																		<tr>
																			<th width="15%">Nature</th>
																			<th>Name of Creditors</th>
																			<th width="20%">Outstanding Balance</th>
																			<th width="5%"></th>
																		</tr>
																	</thead>
																	<tbody id="mysaln-liabilities">
																		<!-- the SALN decalarant liabilities shows here -->
																	</tbody>
																</table>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-12">
												<br>
												<div class="card card-default">
													<div class="card-header">
														<h3 class="card-title">Part IV. Business Interests and Financial Connections</h3>
														<div class="card-tools">
															<a href="javascript:void(0);" class="btn btn-tool" id="add-button" title="Add business interest" rowID="0" data-type="addInterest" 
																data-toggle="modal" data-target="#modal-input" data-backdrop="static" data-keyboard="false">
																<i class="fas fa-plus-square"></i></a>
														</div>
													</div>
													<div class="card-body table-responsive p-0">
														<table class="table table-bordered table-condensed table-hover table-striped">
															<thead>
																<tr>
																	<td colspan="5">(of Declarant /Declarant’s spouse/ Unmarried Children Below Eighteen (18) years of Age Living in Declarant’s Household)</td>
																</tr>
																<tr>
																	<th width="30%">Business Name</th>
																	<th>Address</th>
																	<th width="15%">Nature</th>
																	<th width="15%">Date of Acquisition</th>
																	<th width="5%"></th>
																</tr>
															</thead>
															<tbody id="mysaln-bifc">
																<!-- the SALN decalarant Business Interests and Financial Connections shows here -->
															</tbody>
														</table>													
													</div>
												</div>
											</div>
											<div class="col-md-12">
												<br>
												<div class="card card-default">
													<div class="card-header">
														<h3 class="card-title">Part V. Relatives in the Government Office</h3>
														<div class="card-tools">
															<a href="javascript:void(0);" class="btn btn-tool" id="add-button" title="Add relative" rowID="0" data-type="addRelative" 
																data-toggle="modal" data-target="#modal-input" data-backdrop="static" data-keyboard="false">
																<i class="fas fa-plus-square"></i></a>
														</div>
													</div>
													<div class="card-body table-responsive p-0">
														<table class="table table-bordered table-condensed table-hover table-striped">
															<thead>
																<tr>
																	<td colspan="5">Within the Fourth Degree of Consanguinity or Affinity. Include also Bilas, Balae and Inso</td>
																</tr>
																<tr>
																	<th width="30%">Name of Relative</th>
																	<th width="15%">Relationship</th>
																	<th width="15%">Position</th>
																	<th>Name of Agency / Address</th>
																	<th width="5%"></th>
																</tr>
															</thead>
															<tbody id="mysaln-relatives">
																<!-- the SALN decalarant relatives shows here -->
															</tbody>
														</table>
													</div>
												</div>
											</div>
											<div class="col-md-12">
												<div class="card-footer">
													<a href="#top" type="submit" class="btn btn-info float-right" id="saln_moveUp">Move up to finalize</a>
													<button type="submit" class="btn btn-default" onclick="closeSALNDetails();">Back</button>
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
	<div class="modal-dialog modal-sm" id="modal-size">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">x</h4>
				<span id="section-id"></span>
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
				<button type="button" class="btn btn-danger" name="delete" id="delete">Delete</button>
				<button type="submit" class="btn btn-primary" name="submit" id="submit">Update</button>
				</form>	
			</div>			
		</div>
	</div>
</div>
	
<script type="text/javascript">	
var user_no = <?php echo $_SESSION['user_no'];?>;
var bio_no = 0;
var currMonthYear = 0;
var saln_no = <?php echo(isset($_SESSION['saln_no']) && $_SESSION['saln_no'] != 0 ? $_SESSION['saln_no'] : 0);?>;

setTimeout(function(){preLoad();}, 1);

setTimeout(function(){
	$(function(){
		$('#modal-input').on('show.bs.modal', function(e){
			var type = $(e.relatedTarget).attr('data-type');
			var id = $(e.relatedTarget).attr('rowID');
			var userFunc;
			
			if(type == 'addMissingLog'){
				$('#modal-size').removeClass('modal-sm');
				$('#modal-size').addClass('modal-md');
				$('.modal-title').html('Apply a missing log');
				$('#delete').hide();				
				$('#submit').html('Apply');				
				func = "return confirm('Are you sure?') ? inputAction('addMissingLog') : false;";
				
			} else if(type == 'getMissingLog'){
				$('#modal-size').removeClass('modal-sm');
				$('#modal-size').addClass('modal-md');
				$('.modal-title').html('View missing log');
				$('#submit').html('Modify');				
				func = "return confirm('Are you sure?') ? inputAction('modifyMissingLog') : false;";
				
				var func2 = "return confirm('Are you sures?') ? deleteAction('modifyMissingLog') : false;";
				$('#delete').attr('onclick', func2);	
				
			} else if(type == 'addSALN'){
				$('#modal-size').removeClass('modal-sm');
				$('#modal-size').addClass('modal-md');
				$('.modal-title').html('Add new SALN');
				$('#delete').hide();				
				$('#submit').html('Submit');				
				func = "return confirm('Are you sure?') ? inputAction('addSALN') : false;";		
			
			} else if(type == 'addSpouse'){
				$('#modal-size').removeClass('modal-sm');
				$('#modal-size').addClass('modal-lg');
				$('.modal-title').html('Add spouse');
				$('#delete').hide();				
				$('#submit').html('Submit');				
				func = "return confirm('Are you sure?') ? inputAction('addSpouse') : false;";		
				
			} else if(type == 'modifySpouse'){
				$('#modal-size').removeClass('modal-sm');
				$('#modal-size').addClass('modal-lg');
				$('.modal-title').html('Modify spouse');				
				$('#submit').html('Modify');				
				func = "return confirm('Are you sure?') ? inputAction('modifySpouse') : false;";		
				
				var func2 = "return confirm('Are you sures?') ? deleteAction('modifySpouse') : false;";
				$('#delete').attr('onclick', func2);
				
			} else if(type == 'addDependent'){
				$('#modal-size').removeClass('modal-sm');
				$('#modal-size').addClass('modal-md');
				$('.modal-title').html('Add dependent');
				$('#delete').hide();				
				$('#submit').html('Submit');				
				func = "return confirm('Are you sure?') ? inputAction('addDependent') : false;";		
				
			} else if(type == 'modifyDependent'){
				$('#modal-size').removeClass('modal-sm');
				$('#modal-size').addClass('modal-md');
				$('.modal-title').html('Modify dependent');				
				$('#submit').html('Modify');				
				func = "return confirm('Are you sure?') ? inputAction('modifyDependent') : false;";		
				
				var func2 = "return confirm('Are you sures?') ? deleteAction('modifyDependent') : false;";
				$('#delete').attr('onclick', func2);
				
			} else if(type == 'addReal'){
				$('#modal-size').removeClass('modal-sm');
				$('#modal-size').addClass('modal-md');
				$('.modal-title').html('Add real property');
				$('#delete').hide();				
				$('#submit').html('Submit');				
				func = "return confirm('Are you sure?') ? inputAction('addReal') : false;";		
				
			} else if(type == 'modifyReal'){
				$('#modal-size').removeClass('modal-sm');
				$('#modal-size').addClass('modal-md');
				$('.modal-title').html('Modify real property');				
				$('#submit').html('Modify');				
				func = "return confirm('Are you sure?') ? inputAction('modifyReal') : false;";		
				
				var func2 = "return confirm('Are you sures?') ? deleteAction('modifyReal') : false;";
				$('#delete').attr('onclick', func2);
				
			} else if(type == 'addPersonal'){
				$('#modal-size').removeClass('modal-sm');
				$('#modal-size').addClass('modal-md');
				$('.modal-title').html('Add personal property');
				$('#delete').hide();				
				$('#submit').html('Submit');				
				func = "return confirm('Are you sure?') ? inputAction('addPersonal') : false;";		
				
			} else if(type == 'modifyPersonal'){
				$('#modal-size').removeClass('modal-sm');
				$('#modal-size').addClass('modal-md');
				$('.modal-title').html('Modify personal property');				
				$('#submit').html('Modify');				
				func = "return confirm('Are you sure?') ? inputAction('modifyPersonal') : false;";		
				
				var func2 = "return confirm('Are you sures?') ? deleteAction('modifyPersonal') : false;";
				$('#delete').attr('onclick', func2);
				
			} else if(type == 'addLiability'){
				$('#modal-size').removeClass('modal-sm');
				$('#modal-size').addClass('modal-md');
				$('.modal-title').html('Add liability');
				$('#delete').hide();				
				$('#submit').html('Submit');				
				func = "return confirm('Are you sure?') ? inputAction('addLiability') : false;";		
				
			} else if(type == 'modifyLiability'){
				$('#modal-size').removeClass('modal-sm');
				$('#modal-size').addClass('modal-md');
				$('.modal-title').html('Modify liability');				
				$('#submit').html('Modify');				
				func = "return confirm('Are you sure?') ? inputAction('modifyLiability') : false;";		
				
				var func2 = "return confirm('Are you sures?') ? deleteAction('modifyLiability') : false;";
				$('#delete').attr('onclick', func2);
				
			} else if(type == 'addInterest'){
				$('#modal-size').removeClass('modal-sm');
				$('#modal-size').addClass('modal-md');
				$('.modal-title').html('Add business interest');
				$('#delete').hide();				
				$('#submit').html('Submit');				
				func = "return confirm('Are you sure?') ? inputAction('addInterest') : false;";		
				
			} else if(type == 'modifyInterest'){
				$('#modal-size').removeClass('modal-sm');
				$('#modal-size').addClass('modal-md');
				$('.modal-title').html('Modify business interest');				
				$('#submit').html('Modify');				
				func = "return confirm('Are you sure?') ? inputAction('modifyInterest') : false;";		
				
				var func2 = "return confirm('Are you sures?') ? deleteAction('modifyInterest') : false;";
				$('#delete').attr('onclick', func2);
				
			} else if(type == 'addRelative'){
				$('#modal-size').removeClass('modal-sm');
				$('#modal-size').addClass('modal-md');
				$('.modal-title').html('Add relative');
				$('#delete').hide();				
				$('#submit').html('Submit');				
				func = "return confirm('Are you sure?') ? inputAction('addRelative') : false;";		
				
			} else if(type == 'modifyRelative'){
				$('#modal-size').removeClass('modal-sm');
				$('#modal-size').addClass('modal-md');
				$('.modal-title').html('Modify relative');				
				$('#submit').html('Modify');				
				func = "return confirm('Are you sure?') ? inputAction('modifyRelative') : false;";		
				
				var func2 = "return confirm('Are you sures?') ? deleteAction('modifyRelative') : false;";
				$('#delete').attr('onclick', func2);
				
			} else{
				
			}
			
			showAction(type, id);
			$('#submit').attr('onclick', func);
		});
		
		$('#modal-input').on('hidden.bs.modal', function(){
			$('#modal-size').removeClass('modal-xs');
			$('#modal-size').removeClass('modal-md');
			$('#modal-size').removeClass('modal-lg');
			$('#modal-size').removeClass('modal-xl');
			$('#modal-size').addClass('modal-sm');
			
			$('#form').trigger('reset');
			
			$('#close1').removeAttr('disabled');
			$('#close2').removeAttr('disabled');
			
			$('#delete').attr('onclick', '');
			$('#delete').show();
			$('#delete').removeAttr('disabled');
						
			$('#submit').attr('onclick', '');
			$('#submit').html('');	
			$('#submit').removeAttr('disabled');	
			
			$('#class-input').html('');
		});
	});
}, 1);

function preLoad(){
	getBiometricID(user_no);
	getAttendanceMonths(user_no);
	$('#services-mysaln').show();
	$('#services-mysaln-details').hide();
	
	if(saln_no == 0){
		getSALNs(user_no);
		
	} else{
		showSALNDetails(saln_no);
	}
}

function getBiometricID(user_no){
	var action = 'getBiometricID';
	
	var data = [action, user_no];
	
	$.ajax({
		type: 'POST',
		url: 'services/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				bio_no = result[2].teach_bio_no;
			} else {
				bio_no = result[1];
			}		
		}
	});	
}

function getAttendanceMonths(user_no){
	var action = 'getAttendanceMonths';
	
	var data = [action, user_no];
	
	$.ajax({
		type: 'POST',
		url: 'services/action.php',
		data: {data:data},	
		success: function(result){
			$('#services-mydtr-months').html(result);
			changeActiveMonth();			
		}
	});
}

function changeActiveMonth(){
	currMonthYear = $('#services-mydtr-months').val();
	var month = currMonthYear.substr(0, 2);
	var year = currMonthYear.substr(2, 4);
	var action = 'changeActiveMonth';
	
	var data = [action, user_no, year, month, 'getCurrentLogs'];
	
	$('#mydtr-monthyear1').html('Logs for <strong>'+getMonth(month)+' '+year+'</strong>');
		
	$.ajax({
		type: 'POST',
		url: 'services/action.php',
		data: {data:data},	
		success: function(result){
			$('#mydtr-currentLogs').html(result);
			$('#print-dtr').attr('onclick', "window.open('../reports/pdf_dtr.php?id="+bio_no+"&year="+year+"&month="+month+"', 'newwindow', 'width=850, height=550'); return false;");
		}
	});
	
	var data = [action, user_no, year, month, 'getMissingLogs'];
	
	$('#mydtr-monthyear2').html('Applications for <strong>'+getMonth(month)+' '+year+'</strong>');
	$.ajax({
		type: 'POST',
		url: 'services/action.php',
		data: {data:data},	
		success: function(result){
			$('#mydtr-missingLogs').html(result);
		}
	});
	
}

function showSALNDetails(teachSaln_no){
	$('#services-mysaln').hide();
	$('#services-mysaln-details').show();
	$('#services-mysaln-details-title').show();
	
	var action = 'showSALNDetails';
	
	var data = [action, teachSaln_no];

	$.ajax({
		type: 'POST',
		url: 'services/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				$('#services-mysaln-details-title').html('<p align="right">Filing Year <strong>'+result[2].teachSaln_issueyear+'</strong></p>');
				saln_no = result[2].teachSaln_no;
				displaySALNParts(result[2]);
			} else {
				toastr.error(result[1]);			
			}
		}
	});	


	var action = 'setSession';
	
	var data = [action, teachSaln_no];
	
	$.ajax({
		type: 'POST',
		url: 'services/action.php',
		data: {data:data},	
		success: function(result){
		}
	});	

}

function closeSALNDetails(){
	$('#services-mysaln').show();
	$('#services-mysaln-details').hide();
	$('#services-mysaln-details-title').hide();
	
	var action = 'setSession';
	
	var data = [action, 0];
	
	$.ajax({
		type: 'POST',
		url: 'services/action.php',
		data: {data:data},	
		success: function(result){
		}
	});	
	
	getSALNs(user_no);
}

function getMonth(m){
	var month;
	
	switch(m){
		case '01': month = 'January'; break;
		case '02': month = 'February'; break;
		case '03': month = 'March'; break;
		case '04': month = 'April'; break;
		case '05': month = 'May'; break;
		case '06': month = 'June'; break;
		case '07': month = 'July'; break;
		case '08': month = 'August'; break;
		case '09': month = 'September'; break;
		case '10': month = 'October'; break;
		case '11': month = 'November'; break;
		case '12': month = 'December'; break;
		default:  month = 'Invalid month';
	}
	
	return month;
}

function showAction(type, id){
	var action = 'showAction';
	
	if(type == 'addMissingLog'){		
		var data = [action, type, id];
		
		$.ajax({
			type: 'POST',
			url: 'services/action.php',
			data: {data:data},	
			success: function(result){
				$('#class-input').html(result);
			}
		});
		
	} else if(type == 'getMissingLog'){		
		var data = [action, 'addMissingLog', id];
		
		$.ajax({
			type: 'POST',
			url: 'services/action.php',
			data: {data:data},	
			success: function(result){
				$('#class-input').html(result);
			}
		});
		
		var data = [action, type, id];
		
		$.ajax({
			type: 'POST',
			url: 'services/action.php',
			data: {data:data},	
			success: function(result){
				if(result[0] == 1){
					$('#ml_no').val(result[2].ml_no);
					$('#ml_checkdate').val(result[2].ml_checkdate);
					$('#ml_checktime').val(result[2].ml_checktime);
					$('#ml_checktype').val(result[2].ml_checktype).change();
					$('#ml_reason').val(result[2].ml_reason);	
					if(result[2].ml_approve_user_no	!= 0){
						toastr.error('Any action is no longer allowed.');
						$('#ml_checkdate').attr('readonly', 'readonly')
						$('#ml_checktime').attr('readonly', 'readonly')
						$('#ml_checktype').attr('disabled', 'disabled')
						$('#ml_reason').attr('readonly', 'readonly');	
						$('#delete').attr('disabled', 'disabled');
						$('#submit').attr('disabled', 'disabled');
					}		
				} else {
					toastr.error(result[1]);
				}
			}
		});
		
	} else if(type == 'addSALN'){		
		var data = [action, type, user_no];
		
		$.ajax({
			type: 'POST',
			url: 'services/action.php',
			data: {data:data},	
			success: function(result){
				$('#class-input').html(result);
			}
		});
		
	} else if(type == 'addSpouse'){		
		var data = [action, type];
		
		$.ajax({
			type: 'POST',
			url: 'services/action.php',
			data: {data:data},	
			success: function(result){
				$('#class-input').html(result);
			}
		});
		
	} else if(type == 'modifySpouse'){		
		var data = [action, 'addSpouse', id];
		
		$.ajax({
			type: 'POST',
			url: 'services/action.php',
			data: {data:data},	
			success: function(result){
				$('#class-input').html(result);
			}
		});
		
		var data = [action, 'getSpouse', id];
		
		$.ajax({
			type: 'POST',
			url: 'services/action.php',
			data: {data:data},	
			success: function(result){
				if(result[0] == 1){
					$('#teachCont_no').val(result[2].teachCont_no);
					$('#teachCont_fname').val(result[2].teachCont_fname);
					$('#teachCont_mname').val(result[2].teachCont_mname);
					$('#teachCont_lname').val(result[2].teachCont_lname);
					$('#teachCont_xname').val(result[2].teachCont_xname).change();
					$('#teachCont_position').val(result[2].teachCont_position);
					$('#teachCont_office').val(result[2].teachCont_office);
					$('#teachCont_offadd').val(result[2].teachCont_offadd);
					$('#teachCont_govid').val(result[2].teachCont_govid);
					$('#teachCont_idno').val(result[2].teachCont_idno);
					$('#teachCont_issuedate').val(result[2].teachCont_issuedate);
					$('#work_sector').val(result[2].teachCont_position != '' ? '1' : '2').change();
				} else {
					toastr.error(result[1]);
				}
			}
		});
		
	} else if(type == 'addDependent'){		
		var data = [action, type];
		
		$.ajax({
			type: 'POST',
			url: 'services/action.php',
			data: {data:data},	
			success: function(result){
				$('#class-input').html(result);
			}
		});
		
	} else if(type == 'modifyDependent'){		
		var data = [action, 'addDependent', id];
		
		$.ajax({
			type: 'POST',
			url: 'services/action.php',
			data: {data:data},	
			success: function(result){
				$('#class-input').html(result);
			}
		});
		
		var data = [action, 'getDependent', id];
		
		$.ajax({
			type: 'POST',
			url: 'services/action.php',
			data: {data:data},	
			success: function(result){
				if(result[0] == 1){
					$('#teachCont_no').val(result[2].teachCont_no);
					$('#teachCont_fname').val(result[2].teachCont_fname);
					$('#teachCont_mname').val(result[2].teachCont_mname);
					$('#teachCont_lname').val(result[2].teachCont_lname);
					$('#teachCont_xname').val(result[2].teachCont_xname).change();
					$('#teachCont_bdate').val(result[2].teachCont_bdate);
				} else {
					toastr.error(result[1]);
				}
			}
		});
		
	} else if(type == 'addReal'){		
		var data = [action, type];
		
		$.ajax({
			type: 'POST',
			url: 'services/action.php',
			data: {data:data},	
			success: function(result){
				$('#class-input').html(result);
			}
		});
		
	} else if(type == 'modifyReal'){		
		var data = [action, 'addReal', id];
		
		$.ajax({
			type: 'POST',
			url: 'services/action.php',
			data: {data:data},	
			success: function(result){
				$('#class-input').html(result);
			}
		});
		
		var data = [action, 'getSALNDetails', id];
		
		$.ajax({
			type: 'POST',
			url: 'services/action.php',
			data: {data:data},	
			success: function(result){
				if(result[0] == 1){		
					$('#teachSalnDet_details0').val(result[4][0]).change();
					$('#teachSalnDet_details1').val(result[4][1]).change();
					$('#teachSalnDet_details2').val(result[4][2]);
					$('#teachSalnDet_details3').val(result[4][3]);
					$('#teachSalnDet_details4').val(result[4][4]);
					$('#teachSalnDet_details5').val(result[4][5]).change();
					$('#teachSalnDet_details6').val(result[4][6]).change();					
					$('#teachSalnDet_cost').val(result[2].teachSalnDet_cost);
					
					$('#teachSalnDet_no').val(result[2].teachSalnDet_no);
					$('#teachSalnDet_teachSaln_no').val(result[2].teachSalnDet_teachSaln_no);
					$('#teachSalnDet_type').val(result[2].teachSalnDet_type);
				} else {
					toastr.error(result[1]);
				}
			}
		});
		
	} else if(type == 'addPersonal'){		
		var data = [action, type];
		
		$.ajax({
			type: 'POST',
			url: 'services/action.php',
			data: {data:data},	
			success: function(result){
				$('#class-input').html(result);
			}
		});	
		
	} else if(type == 'modifyPersonal'){		
		var data = [action, 'addPersonal', id];
		
		$.ajax({
			type: 'POST',
			url: 'services/action.php',
			data: {data:data},	
			success: function(result){
				$('#class-input').html(result);
			}
		});
		
		var data = [action, 'getSALNDetails', id];
		
		$.ajax({
			type: 'POST',
			url: 'services/action.php',
			data: {data:data},	
			success: function(result){
				if(result[0] == 1){		
					$('#teachSalnDet_details0').val(result[4][0]);
					$('#teachSalnDet_details1').val(result[4][1]).change();			
					$('#teachSalnDet_cost').val(result[2].teachSalnDet_cost);
					
					$('#teachSalnDet_no').val(result[2].teachSalnDet_no);
					$('#teachSalnDet_teachSaln_no').val(result[2].teachSalnDet_teachSaln_no);
					$('#teachSalnDet_type').val(result[2].teachSalnDet_type);
				} else {
					toastr.error(result[1]);
				}
			}
		});	
		
	} else if(type == 'addLiability'){		
		var data = [action, type];
		
		$.ajax({
			type: 'POST',
			url: 'services/action.php',
			data: {data:data},	
			success: function(result){
				$('#class-input').html(result);
			}
		});
		
	} else if(type == 'modifyLiability'){		
		var data = [action, 'addLiability', id];
		
		$.ajax({
			type: 'POST',
			url: 'services/action.php',
			data: {data:data},	
			success: function(result){
				$('#class-input').html(result);
			}
		});
		
		var data = [action, 'getSALNDetails', id];
		
		$.ajax({
			type: 'POST',
			url: 'services/action.php',
			data: {data:data},	
			success: function(result){
				if(result[0] == 1){		
					$('#teachSalnDet_details0').val(result[4][0]).change();
					$('#teachSalnDet_details1').val(result[4][1]);					
					$('#teachSalnDet_cost').val(result[2].teachSalnDet_cost);
					
					$('#teachSalnDet_no').val(result[2].teachSalnDet_no);
					$('#teachSalnDet_teachSaln_no').val(result[2].teachSalnDet_teachSaln_no);
					$('#teachSalnDet_type').val(result[2].teachSalnDet_type);
				} else {
					toastr.error(result[1]);
				}
			}
		});
		
	} else if(type == 'addInterest'){		
		var data = [action, type];
		
		$.ajax({
			type: 'POST',
			url: 'services/action.php',
			data: {data:data},	
			success: function(result){
				$('#class-input').html(result);
			}
		});
		
	} else if(type == 'modifyInterest'){		
		var data = [action, 'addInterest', id];
		
		$.ajax({
			type: 'POST',
			url: 'services/action.php',
			data: {data:data},	
			success: function(result){
				$('#class-input').html(result);
			}
		});
		
		var data = [action, 'getSALNDetails', id];
		
		$.ajax({
			type: 'POST',
			url: 'services/action.php',
			data: {data:data},	
			success: function(result){
				if(result[0] == 1){		
					$('#teachSalnDet_details0').val(result[4][0]);
					$('#teachSalnDet_details1').val(result[4][1]);
					$('#teachSalnDet_details2').val(result[4][2]).change();
					$('#teachSalnDet_details3').val(result[4][3]);
				
					$('#teachSalnDet_cost').val(result[2].teachSalnDet_cost);					
					$('#teachSalnDet_no').val(result[2].teachSalnDet_no);
					$('#teachSalnDet_teachSaln_no').val(result[2].teachSalnDet_teachSaln_no);
					$('#teachSalnDet_type').val(result[2].teachSalnDet_type);
				} else {
					toastr.error(result[1]);
				}
			}
		});
		
	} else if(type == 'addRelative'){		
		var data = [action, type];
		
		$.ajax({
			type: 'POST',
			url: 'services/action.php',
			data: {data:data},	
			success: function(result){
				$('#class-input').html(result);
			}
		});
		
	} else if(type == 'modifyRelative'){		
		var data = [action, 'addRelative', id];
		
		$.ajax({
			type: 'POST',
			url: 'services/action.php',
			data: {data:data},	
			success: function(result){
				$('#class-input').html(result);
			}
		});
		
		var data = [action, 'getSALNDetails', id];
		
		$.ajax({
			type: 'POST',
			url: 'services/action.php',
			data: {data:data},	
			success: function(result){
				if(result[0] == 1){		
					$('#teachSalnDet_details0').val(result[4][0]);
					$('#teachSalnDet_details1').val(result[4][1]).change();
					$('#teachSalnDet_details2').val(result[4][2]);
					$('#teachSalnDet_details3').val(result[4][3]);
				
					$('#teachSalnDet_cost').val(result[2].teachSalnDet_cost);					
					$('#teachSalnDet_no').val(result[2].teachSalnDet_no);
					$('#teachSalnDet_teachSaln_no').val(result[2].teachSalnDet_teachSaln_no);
					$('#teachSalnDet_type').val(result[2].teachSalnDet_type);
				} else {
					toastr.error(result[1]);
				}
			}
		});
		
	} else {
		// intentional blank to clean-slate modal contents
	} 
}

function inputAction(type){
	var action = 'inputAction';
	
	if(type == 'addMissingLog'){
		
		if(sanitizeInput(type) == true){
			var ml_checkdate = $('#ml_checkdate').val();
			var ml_checktime = $('#ml_checktime').val();
			var ml_checktype = $('#ml_checktype').val();
			var ml_reason = $('#ml_reason').val();
			
			var data = [action, type, bio_no, ml_checkdate, ml_checktime, ml_checktype, ml_reason, user_no];
			
			$('#close1').attr('disabled', 'disabled');
			$('#close2').attr('disabled', 'disabled');
			$('#submit').attr('disabled', 'disabled');
			$('#submit').html('Validating...');
			
			$.ajax({
				type: 'POST',
				url: 'services/action.php',
				data: {data:data},	
				success: function(result){
					if(result[0] == 1){
						setTimeout(function(){$('#submit').html('Saving...');}, 1000);
						setTimeout(function(){$('#submit').html('Apply');}, 2000);
						setTimeout(function(){$('#submit').removeAttr('disabled');}, 3000);
						setTimeout(function(){$('#close1').removeAttr('disabled');}, 3000);
						setTimeout(function(){$('#close2').removeAttr('disabled');}, 3000);
						setTimeout(function(){toastr.success(result[1]);}, 3000);

						changeActiveMonth();
						
						$('#form').trigger('reset');
					} else {
						setTimeout(function(){$('#submit').html('Apply');}, 1000);
						setTimeout(function(){$('#submit').removeAttr('disabled');}, 2000);
						setTimeout(function(){$('#close1').removeAttr('disabled');}, 2000);
						setTimeout(function(){$('#close2').removeAttr('disabled');}, 2000);
						setTimeout(function(){toastr.error(result[1]);}, 2000);
					}
					
					
				}
			});
			
		} else { 
			// error handling performed by the sanitizeInput() function
		}
		
	} else if(type == 'modifyMissingLog'){
		
		if(sanitizeInput(type) == true){
			var ml_checkdate = $('#ml_checkdate').val();
			var ml_checktime = $('#ml_checktime').val();
			var ml_checktype = $('#ml_checktype').val();
			var ml_reason = $('#ml_reason').val();
			var ml_no = $('#ml_no').val();
			
			var data = [action, type, bio_no, ml_checkdate, ml_checktime, ml_checktype, ml_reason, ml_no];
			
			$('#close1').attr('disabled', 'disabled');
			$('#close2').attr('disabled', 'disabled');
			$('#delete').attr('disabled', 'disabled');
			$('#submit').attr('disabled', 'disabled');
			$('#submit').html('Validating...');
			
			$.ajax({
				type: 'POST',
				url: 'services/action.php',
				data: {data:data},	
				success: function(result){
					if(result[0] == 1){
						setTimeout(function(){$('#submit').html('Updating...');}, 1000);
						setTimeout(function(){$('#submit').html('Modify');}, 2000);
						setTimeout(function(){toastr.success(result[1]);}, 2000);
						setTimeout(function(){$('#modal-input').modal('hide');}, 3000);
						changeActiveMonth();
						
					} else {
						setTimeout(function(){$('#submit').html('Modify');}, 1000);
						setTimeout(function(){$('#submit').removeAttr('disabled');}, 2000);
						setTimeout(function(){$('#close1').removeAttr('disabled');}, 2000);
						setTimeout(function(){$('#close2').removeAttr('disabled');}, 2000);
						setTimeout(function(){$('#delete').removeAttr('disabled');}, 2000);
						setTimeout(function(){toastr.error(result[1]);}, 2000);
					}
				}
			});
			
		} else { 
			// error handling performed by the sanitizeInput() function
		}
		
	} else if(type == 'addSALN'){
		
		if(sanitizeInput(type) == true){
			var teachSaln_issueyear = $('#teachSaln_issueyear').val();
			var teachSaln_filetype = $('#teachSaln_filetype').val();
			
			var data = [action, type, user_no, teachSaln_issueyear, teachSaln_filetype];
			
			$('#close1').attr('disabled', 'disabled');
			$('#close2').attr('disabled', 'disabled');
			$('#submit').attr('disabled', 'disabled');
			$('#submit').html('Validating...');
			
			$.ajax({
				type: 'POST',
				url: 'services/action.php',
				data: {data:data},	
				success: function(result){
					if(result[0] == 1){
						setTimeout(function(){$('#submit').html('Saving...');}, 1000);
						setTimeout(function(){$('#submit').html('Submit');}, 2000);
						setTimeout(function(){$('#modal-input').modal('hide');}, 3000);
						setTimeout(function(){toastr.success(result[1]);}, 3000);
						
						showSALNDetails(result[2]);					
					} else {
						setTimeout(function(){$('#submit').html('Submit');}, 1000);
						setTimeout(function(){$('#submit').removeAttr('disabled');}, 2000);
						setTimeout(function(){$('#close1').removeAttr('disabled');}, 2000);
						setTimeout(function(){$('#close2').removeAttr('disabled');}, 2000);
						setTimeout(function(){toastr.error(result[1]);}, 2000);
					}
				}
			});	
			
		} else {
			// error handling performed by the sanitizeInput() function
		}
		
	} else if(type == 'addSpouse'){
		
		if(sanitizeInput(type) == true){
			var teachCont_fname = $('#teachCont_fname').val();
			var teachCont_mname = $('#teachCont_mname').val();
			var teachCont_lname = $('#teachCont_lname').val();
			var teachCont_xname = $('#teachCont_xname').val();
			var work_sector = $('#work_sector').val();
			var teachCont_office = work_sector == '1' ? $('#teachCont_office').val() : '';
			var teachCont_position = work_sector == '1' ?  $('#teachCont_position').val() : '';
			var teachCont_offadd = work_sector == '1' ?  $('#teachCont_offadd').val() : '';
			var teachCont_govid = $('#teachCont_govid').val();
			var teachCont_idno = $('#teachCont_idno').val();
			var teachCont_issuedate = $('#teachCont_issuedate').val();
			
			var data = [action, type, user_no, teachCont_fname, teachCont_mname, teachCont_lname, teachCont_xname, teachCont_office, teachCont_position, teachCont_offadd, teachCont_govid, teachCont_idno, teachCont_issuedate];
			
			$('#close1').attr('disabled', 'disabled');
			$('#close2').attr('disabled', 'disabled');
			$('#submit').attr('disabled', 'disabled');
			$('#submit').html('Validating...');
			
			$.ajax({
				type: 'POST',
				url: 'services/action.php',
				data: {data:data},	
				success: function(result){
					if(result[0] == 1){
						setTimeout(function(){$('#submit').html('Saving...');}, 1000);
						setTimeout(function(){$('#submit').html('Submit');}, 2000);
						setTimeout(function(){$('#modal-input').modal('hide');}, 3000);
						setTimeout(function(){toastr.success(result[1]);}, 3000);
						
						showSALNDetails(saln_no);
					} else {
						setTimeout(function(){$('#submit').html('Submit');}, 1000);
						setTimeout(function(){$('#submit').removeAttr('disabled');}, 2000);
						setTimeout(function(){$('#close1').removeAttr('disabled');}, 2000);
						setTimeout(function(){$('#close2').removeAttr('disabled');}, 2000);
						setTimeout(function(){toastr.error(result[1]);}, 2000);
					}
				}
			});	
			
		} else {
			// error handling performed by the sanitizeInput() function
		}
		
	} else if(type == 'modifySpouse'){
		
		if(sanitizeInput(type) == true){
			var teachCont_fname = $('#teachCont_fname').val();
			var teachCont_mname = $('#teachCont_mname').val();
			var teachCont_lname = $('#teachCont_lname').val();
			var teachCont_xname = $('#teachCont_xname').val();
			var work_sector = $('#work_sector').val();
			var teachCont_office = work_sector == '1' ? $('#teachCont_office').val() : '';
			var teachCont_position = work_sector == '1' ?  $('#teachCont_position').val() : '';
			var teachCont_offadd = work_sector == '1' ?  $('#teachCont_offadd').val() : '';
			var teachCont_govid = $('#teachCont_govid').val();
			var teachCont_idno = $('#teachCont_idno').val();
			var teachCont_issuedate = $('#teachCont_issuedate').val();
			var teachCont_no = $('#teachCont_no').val();
			
			var data = [action, type, user_no, teachCont_fname, teachCont_mname, teachCont_lname, teachCont_xname, teachCont_office, teachCont_position, teachCont_offadd, teachCont_govid, teachCont_idno, teachCont_issuedate, teachCont_no];
			
			$('#close1').attr('disabled', 'disabled');
			$('#close2').attr('disabled', 'disabled');
			$('#delete').attr('disabled', 'disabled');
			$('#submit').attr('disabled', 'disabled');
			$('#submit').html('Validating...');
			
			$.ajax({
				type: 'POST',
				url: 'services/action.php',
				data: {data:data},	
				success: function(result){
					if(result[0] == 1){
						setTimeout(function(){$('#submit').html('Saving...');}, 1000);
						setTimeout(function(){$('#submit').html('Modify');}, 2000);
						setTimeout(function(){$('#modal-input').modal('hide');}, 3000);
						setTimeout(function(){toastr.success(result[1]);}, 3000);
						
						showSALNDetails(saln_no);
					} else {
						setTimeout(function(){$('#submit').html('Modify');}, 1000);
						setTimeout(function(){$('#submit').removeAttr('disabled');}, 2000);
						setTimeout(function(){$('#delete').removeAttr('disabled');}, 2000);
						setTimeout(function(){$('#close1').removeAttr('disabled');}, 2000);
						setTimeout(function(){$('#close2').removeAttr('disabled');}, 2000);
						setTimeout(function(){toastr.error(result[1]);}, 2000);
					}
				}
			});	
			
		} else {
			// error handling performed by the sanitizeInput() function
		}
		
	} else if(type == 'addDependent'){
		
		if(sanitizeInput(type) == true){
			var teachCont_fname = $('#teachCont_fname').val();
			var teachCont_mname = $('#teachCont_mname').val();
			var teachCont_lname = $('#teachCont_lname').val();
			var teachCont_xname = $('#teachCont_xname').val();
			var teachCont_bdate = $('#teachCont_bdate').val();
			
			var data = [action, type, user_no, teachCont_fname, teachCont_mname, teachCont_lname, teachCont_xname, teachCont_bdate];
			
			$('#close1').attr('disabled', 'disabled');
			$('#close2').attr('disabled', 'disabled');
			$('#submit').attr('disabled', 'disabled');
			$('#submit').html('Validating...');
			
			$.ajax({
				type: 'POST',
				url: 'services/action.php',
				data: {data:data},	
				success: function(result){
					if(result[0] == 1){
						setTimeout(function(){$('#submit').html('Saving...');}, 1000);
						setTimeout(function(){$('#submit').html('Submit');}, 2000);
						setTimeout(function(){$('#modal-input').modal('hide');}, 3000);
						setTimeout(function(){toastr.success(result[1]);}, 3000);
						
						showSALNDetails(saln_no);
					} else {
						setTimeout(function(){$('#submit').html('Submit');}, 1000);
						setTimeout(function(){$('#submit').removeAttr('disabled');}, 2000);
						setTimeout(function(){$('#close1').removeAttr('disabled');}, 2000);
						setTimeout(function(){$('#close2').removeAttr('disabled');}, 2000);
						setTimeout(function(){toastr.error(result[1]);}, 2000);
					}
				}
			});		
			
		} else {
			// error handling performed by the sanitizeInput() function
		}
		
	} else if(type == 'modifyDependent'){
		
		if(sanitizeInput(type) == true){
			var teachCont_fname = $('#teachCont_fname').val();
			var teachCont_mname = $('#teachCont_mname').val();
			var teachCont_lname = $('#teachCont_lname').val();
			var teachCont_xname = $('#teachCont_xname').val();
			var teachCont_bdate = $('#teachCont_bdate').val();
			var teachCont_no = $('#teachCont_no').val();
			
			var data = [action, type, user_no, teachCont_fname, teachCont_mname, teachCont_lname, teachCont_xname, teachCont_bdate, teachCont_no];
			
			$('#close1').attr('disabled', 'disabled');
			$('#close2').attr('disabled', 'disabled');
			$('#delete').attr('disabled', 'disabled');
			$('#submit').attr('disabled', 'disabled');
			$('#submit').html('Validating...');
			
			$.ajax({
				type: 'POST',
				url: 'services/action.php',
				data: {data:data},	
				success: function(result){
					if(result[0] == 1){
						setTimeout(function(){$('#submit').html('Saving...');}, 1000);
						setTimeout(function(){$('#submit').html('Modify');}, 2000);
						setTimeout(function(){$('#modal-input').modal('hide');}, 3000);
						setTimeout(function(){toastr.success(result[1]);}, 3000);
						
						showSALNDetails(saln_no);
					} else {
						setTimeout(function(){$('#submit').html('Modify');}, 1000);
						setTimeout(function(){$('#submit').removeAttr('disabled');}, 2000);
						setTimeout(function(){$('#delete').removeAttr('disabled');}, 2000);
						setTimeout(function(){$('#close1').removeAttr('disabled');}, 2000);
						setTimeout(function(){$('#close2').removeAttr('disabled');}, 2000);
						setTimeout(function(){toastr.error(result[1]);}, 2000);
					}
				}
			});	
			
		} else {
			// error handling performed by the sanitizeInput() function
		}
		
	} else if(type == 'addReal' || type == 'addPersonal' || type == 'addLiability' || type == 'addInterest' || type == 'addRelative'){
		
		if(sanitizeInput(type) == true){			
			var teachSalnDet_type;
		
			if(type == 'addReal'){
				teachSalnDet_type = '1';
				var teachSalnDet_details0 = $('#teachSalnDet_details0').val();
				var teachSalnDet_details1 = $('#teachSalnDet_details1').val();
				var teachSalnDet_details2 = $('#teachSalnDet_details2').val();
				var teachSalnDet_details3 = $('#teachSalnDet_details3').val();
				var teachSalnDet_details4 = $('#teachSalnDet_details4').val();
				var teachSalnDet_details5 = $('#teachSalnDet_details5').val();
				var teachSalnDet_details6 = $('#teachSalnDet_details6').val();
				var teachSalnDet_cost = $('#teachSalnDet_cost').val();
			} else if (type == 'addPersonal'){
				teachSalnDet_type = '2'; 
				var teachSalnDet_details0 = $('#teachSalnDet_details0').val();
				var teachSalnDet_details1 = $('#teachSalnDet_details1').val();
				var teachSalnDet_details2 = '';
				var teachSalnDet_details3 = '';
				var teachSalnDet_details4 = '';
				var teachSalnDet_details5 = '';
				var teachSalnDet_details6 = '';
				var teachSalnDet_cost = $('#teachSalnDet_cost').val();				
			} else if (type == 'addLiability'){
				teachSalnDet_type = '3';
				var teachSalnDet_details0 = $('#teachSalnDet_details0').val();
				var teachSalnDet_details1 = $('#teachSalnDet_details1').val();
				var teachSalnDet_details2 = '';
				var teachSalnDet_details3 = '';
				var teachSalnDet_details4 = '';
				var teachSalnDet_details5 = '';
				var teachSalnDet_details6 = '';
				var teachSalnDet_cost = $('#teachSalnDet_cost').val();				
			} else if (type == 'addInterest'){
				teachSalnDet_type = '4';
				var teachSalnDet_details0 = $('#teachSalnDet_details0').val();
				var teachSalnDet_details1 = $('#teachSalnDet_details1').val();
				var teachSalnDet_details2 = $('#teachSalnDet_details2').val();
				var teachSalnDet_details3 = $('#teachSalnDet_details3').val();
				var teachSalnDet_details4 = $('#teachSalnDet_details4').val();
				var teachSalnDet_details5 = '';
				var teachSalnDet_details6 = '';
				var teachSalnDet_cost = $('#teachSalnDet_cost').val();				
			} else if (type == 'addRelative'){
				teachSalnDet_type = '5';
				var teachSalnDet_details0 = $('#teachSalnDet_details0').val();
				var teachSalnDet_details1 = $('#teachSalnDet_details1').val();
				var teachSalnDet_details2 = $('#teachSalnDet_details2').val();
				var teachSalnDet_details3 = $('#teachSalnDet_details3').val();
				var teachSalnDet_details4 = '';
				var teachSalnDet_details5 = '';
				var teachSalnDet_details6 = '';
				var teachSalnDet_cost = $('#teachSalnDet_cost').val();				
			}
		
			var data = [action, type, user_no, saln_no, teachSalnDet_type, teachSalnDet_details0, teachSalnDet_details1, teachSalnDet_details2, teachSalnDet_details3, teachSalnDet_details4, teachSalnDet_details5, teachSalnDet_details6, teachSalnDet_cost];
			
			$('#close1').attr('disabled', 'disabled');
			$('#close2').attr('disabled', 'disabled');
			$('#submit').attr('disabled', 'disabled');
			$('#submit').html('Validating...');
			
			$.ajax({
				type: 'POST',
				url: 'services/action.php',
				data: {data:data},	
				success: function(result){
					if(result[0] == 1){
						setTimeout(function(){$('#submit').html('Saving...');}, 1000);
						setTimeout(function(){$('#submit').html('Submit');}, 2000);
						setTimeout(function(){$('#modal-input').modal('hide');}, 3000);
						setTimeout(function(){toastr.success(result[1]);}, 3000);
						
						showSALNDetails(saln_no);
					} else {
						setTimeout(function(){$('#submit').html('Submit');}, 1000);
						setTimeout(function(){$('#submit').removeAttr('disabled');}, 2000);
						setTimeout(function(){$('#close1').removeAttr('disabled');}, 2000);
						setTimeout(function(){$('#close2').removeAttr('disabled');}, 2000);
						setTimeout(function(){toastr.error(result[1]);}, 2000);
					}
				}
			});		
			
		} else {
			// error handling performed by the sanitizeInput() function
		}
		
	} else if(type == 'modifyReal' || type == 'modifyPersonal' || type == 'modifyLiability' || type == 'modifyInterest' || type == 'modifyRelative'){
		
		if(sanitizeInput(type) == true){			
			var teachSalnDet_type;
		
			if(type == 'modifyReal'){
				teachSalnDet_type = '1';
				var teachSalnDet_details0 = $('#teachSalnDet_details0').val();
				var teachSalnDet_details1 = $('#teachSalnDet_details1').val();
				var teachSalnDet_details2 = $('#teachSalnDet_details2').val();
				var teachSalnDet_details3 = $('#teachSalnDet_details3').val();
				var teachSalnDet_details4 = $('#teachSalnDet_details4').val();
				var teachSalnDet_details5 = $('#teachSalnDet_details5').val();
				var teachSalnDet_details6 = $('#teachSalnDet_details6').val();
				var teachSalnDet_cost = $('#teachSalnDet_cost').val();
			} else if (type == 'modifyPersonal'){
				teachSalnDet_type = '2'; 
				var teachSalnDet_details0 = $('#teachSalnDet_details0').val();
				var teachSalnDet_details1 = $('#teachSalnDet_details1').val();
				var teachSalnDet_details2 = '';
				var teachSalnDet_details3 = '';
				var teachSalnDet_details4 = '';
				var teachSalnDet_details5 = '';
				var teachSalnDet_details6 = '';
				var teachSalnDet_cost = $('#teachSalnDet_cost').val();				
			} else if (type == 'modifyLiability'){
				teachSalnDet_type = '3';
				var teachSalnDet_details0 = $('#teachSalnDet_details0').val();
				var teachSalnDet_details1 = $('#teachSalnDet_details1').val();
				var teachSalnDet_details2 = '';
				var teachSalnDet_details3 = '';
				var teachSalnDet_details4 = '';
				var teachSalnDet_details5 = '';
				var teachSalnDet_details6 = '';
				var teachSalnDet_cost = $('#teachSalnDet_cost').val();				
			} else if (type == 'modifyInterest'){
				teachSalnDet_type = '4';
				var teachSalnDet_details0 = $('#teachSalnDet_details0').val();
				var teachSalnDet_details1 = $('#teachSalnDet_details1').val();
				var teachSalnDet_details2 = $('#teachSalnDet_details2').val();
				var teachSalnDet_details3 = $('#teachSalnDet_details3').val();
				var teachSalnDet_details4 = $('#teachSalnDet_details4').val();
				var teachSalnDet_details5 = '';
				var teachSalnDet_details6 = '';
				var teachSalnDet_cost = $('#teachSalnDet_cost').val();				
			} else if (type == 'modifyRelative'){
				teachSalnDet_type = '5';
				var teachSalnDet_details0 = $('#teachSalnDet_details0').val();
				var teachSalnDet_details1 = $('#teachSalnDet_details1').val();
				var teachSalnDet_details2 = $('#teachSalnDet_details2').val();
				var teachSalnDet_details3 = $('#teachSalnDet_details3').val();
				var teachSalnDet_details4 = '';
				var teachSalnDet_details5 = '';
				var teachSalnDet_details6 = '';
				var teachSalnDet_cost = $('#teachSalnDet_cost').val();				
			}
			
			var teachSalnDet_no = $('#teachSalnDet_no').val();
			var teachSalnDet_teachSaln_no = $('#teachSalnDet_teachSaln_no').val();
			var teachSalnDet_type = $('#teachSalnDet_type').val();
		
			var data = [action, type, user_no, saln_no, teachSalnDet_type, teachSalnDet_details0, teachSalnDet_details1, teachSalnDet_details2, teachSalnDet_details3, teachSalnDet_details4, teachSalnDet_details5, teachSalnDet_details6, teachSalnDet_cost, teachSalnDet_no];
			
			$('#close1').attr('disabled', 'disabled');
			$('#close2').attr('disabled', 'disabled');
			$('#delete').attr('disabled', 'disabled');
			$('#submit').attr('disabled', 'disabled');
			$('#submit').html('Validating...');
			
			$.ajax({
				type: 'POST',
				url: 'services/action.php',
				data: {data:data},	
				success: function(result){
					if(result[0] == 1){
						setTimeout(function(){$('#submit').html('Saving...');}, 1000);
						setTimeout(function(){$('#submit').html('Submit');}, 2000);
						setTimeout(function(){$('#modal-input').modal('hide');}, 3000);
						setTimeout(function(){toastr.success(result[1]);}, 3000);
						
						showSALNDetails(saln_no);
					} else {
						setTimeout(function(){$('#submit').html('Submit');}, 1000);
						setTimeout(function(){$('#delete').removeAttr('disabled');}, 2000);
						setTimeout(function(){$('#submit').removeAttr('disabled');}, 2000);
						setTimeout(function(){$('#close1').removeAttr('disabled');}, 2000);
						setTimeout(function(){$('#close2').removeAttr('disabled');}, 2000);
						setTimeout(function(){toastr.error(result[1]);}, 2000);
					}
				}
			});		
			
		} else {
			// error handling performed by the sanitizeInput() function
		}
		
	} else {
		// intentional blank to clean-slate modal contents
	}
}

function sanitizeInput(type){
	var result = true;
	
	if(type == 'addMissingLog' || type == 'modifyMissingLog'){
		var minDate = Date.parse('<?php echo date('Y-m', strtotime('last month'))."-01";?>');
		var maxDate = Date.parse('<?php echo date('Y-m-d');?>');
		var minTime = Date.parse('<?php echo date('Y-m-d ').$office_timeIn;?>');
		var maxTime = Date.parse('<?php echo date('Y-m-d ').$office_timeOut;?>');

		var ml_checkdate =  Date.parse($('#ml_checkdate').val());
		var ml_checktime = Date.parse('<?php echo date('Y-m-d ');?>'+$('#ml_checktime').val());
		var ml_checktype = $('#ml_checktype').val();
		var ml_reason = $('#ml_reason').val();

		if(ml_checkdate == '' || ml_checkdate < minDate || ml_checkdate > maxDate){ 
			result = false;
			toastr.error('Invalid date.');
		} else if(ml_checktime == '' || ml_checktime < minTime || ml_checktime > maxTime){ 
			result = false;
			toastr.error('Invalid time.');
		} else if(ml_checktype == ''){
			result = false;
			toastr.error('Invalid status.');
		} else if(ml_reason == ''){
			result = false;
			toastr.error('Reason cannot be left blank.');
		}
		
	} else if(type == 'addSALN'){
		var teachSaln_issueyear = $('#teachSaln_issueyear').val();
		var teachSaln_filetype = $('#teachSaln_filetype').val();
		
		if(teachSaln_issueyear == ''){
			result = false;
			toastr.error('Invalid filing year.');			
		} else if(teachSaln_filetype == ''){
			result = false;
			toastr.error('Invalid filing type.');				
		}
		
	} else if(type == 'addSpouse' ||  type == 'modifySpouse'){
		var teachCont_fname = $('#teachCont_fname').val();
		var teachCont_lname = $('#teachCont_lname').val();
		var work_sector = $('#work_sector').val();
		var teachCont_office = $('#teachCont_office').val();
		var teachCont_position = $('#teachCont_position').val();
		var teachCont_offadd = $('#teachCont_offadd').val();
		var teachCont_govid = $('#teachCont_govid').val();
		var teachCont_idno = $('#teachCont_idno').val();
		var teachCont_issuedate = Date.parse($('#teachCont_issuedate').val());
		var maxDate = Date.parse('<?php echo date('Y-m-d');?>');
		var minDate = Date.parse('<?php echo date('Y-m-d', strtotime('-15 years'));?>');
		
		if(teachCont_fname == ''){
			result = false;
			toastr.error('Invalid firstname.');													
		} else if(teachCont_lname == ''){
			result = false;
			toastr.error('Invalid lastname.');				
		} else if(work_sector == ''){
			result = false;
			toastr.error('Invalid work sector.');
		} else if(work_sector == '1'){
			if(teachCont_office == ''){
				result = false;
				toastr.error('Invalid work office.');					
			} else if(teachCont_position == ''){
				result = false;
				toastr.error('Invalid position.');					
			} else if(teachCont_offadd == ''){
				result = false;
				toastr.error('Invalid office work address.');					
			} 
		} else if(teachCont_govid == ''){
			result = false;
			toastr.error('Invalid ID.');					
		} else if(teachCont_idno == ''){
			result = false;
			toastr.error('Invalid ID number.');					
		} else if(teachCont_issuedate == '' || teachCont_issuedate > maxDate || teachCont_issuedate < minDate){
			result = false;
			toastr.error('Invalid issue date.');					
		} 
		
	} else if(type == 'addDependent' || type == 'modifyDependent'){
		var teachCont_fname = $('#teachCont_fname').val();
		var teachCont_lname = $('#teachCont_lname').val();
		var teachCont_bdate = Date.parse($('#teachCont_bdate').val());
		var maxDate = Date.parse('<?php echo date('Y-m-d');?>');
		var minDate = Date.parse('<?php echo date('Y-m-d', strtotime('-18 years'));?>');
		
		if(teachCont_fname == ''){
			result = false;
			toastr.error('Invalid firstname.');													
		} else if(teachCont_lname == ''){
			result = false;
			toastr.error('Invalid lastname.');								
		} else if(teachCont_bdate == '' || teachCont_bdate > maxDate || teachCont_bdate < minDate){
			result = false;
			toastr.error('Invalid birth date.');					
		} 
		
	} else if (type == 'addReal' || type == 'modifyReal' || type == 'addPersonal' || type == 'modifyPersonal' || type == 'addLiability' || type == 'modifyLiability' || type == 'addInterest' || type == 'modifyInterest' || type == 'addRelative' || type == 'modifyRelative'){
			var teachSalnDet_details0 = $('#teachSalnDet_details0').val();
			var teachSalnDet_details1 = $('#teachSalnDet_details1').val();
			var teachSalnDet_details2 = $('#teachSalnDet_details2').val();
			var teachSalnDet_details3 = $('#teachSalnDet_details3').val();
			var teachSalnDet_details4 = $('#teachSalnDet_details4').val();
			var teachSalnDet_details5 = $('#teachSalnDet_details5').val();
			var teachSalnDet_details6 = $('#teachSalnDet_details6').val();
			var teachSalnDet_cost = $('#teachSalnDet_cost').val();			
			
			if(type == 'addReal' || type == 'modifyReal'){
				if(teachSalnDet_details0 == ''){
					result = false;
					toastr.error('Invalid description.');
				} else if(teachSalnDet_details1 == ''){
					result = false;
					toastr.error('Invalid kind.');
				} else if(teachSalnDet_details2 == ''){
					result = false;
					toastr.error('Invalid location.');
				} else if(teachSalnDet_details3 == '' || teachSalnDet_details3 < 0){
					result = false;
					toastr.error('Invalid assessed value.');
				} else if(teachSalnDet_details4 == '' || teachSalnDet_details4 < 0){
					result = false;
					toastr.error('Invalid current fair market value.')
				} else if(teachSalnDet_details5 == ''){
					result = false;
					toastr.error('Invalid year of acquisit\'n.')
				} else if(teachSalnDet_details6 == ''){
					result = false;
					toastr.error('Invalid mode of acquisit\'n.')
				} else if(teachSalnDet_cost == '' || teachSalnDet_cost < 0){
					result = false;
					toastr.error('Invalid acquisit\'n cost.')
				}
			} else if(type == 'addPersonal' || type == 'modifyPersonal'){
				if(teachSalnDet_details0 == ''){
					result = false;
					toastr.error('Invalid description.');
				} else if(teachSalnDet_details1 == ''){
					result = false;
					toastr.error('Invalid year acquired.');
				} else if(teachSalnDet_cost == '' || teachSalnDet_cost < 0){
					result = false;
					toastr.error('Invalid acquisit\'n cost.')
				}				
			} else if(type == 'addLiability' || type == 'modifyLiability'){
				if(teachSalnDet_details0 == ''){
					result = false;
					toastr.error('Invalid nature.');
				} else if(teachSalnDet_details1 == ''){
					result = false;
					toastr.error('Invalid name of creditor.');
				} else if(teachSalnDet_cost == '' || teachSalnDet_cost < 1){
					result = false;
					toastr.error('Invalid outstanding balance.')
				}				
			} else if(type == 'addInterest' || type == 'modifyInterest'){
				var maxDate = Date.parse('<?php echo date('Y-m-d');?>');
				var minDate = Date.parse('<?php echo date('Y-m-d', strtotime('-50 years'));?>');
				teachSalnDet_details3 = Date.parse(teachSalnDet_details3);
				
				if(teachSalnDet_details0 == ''){
					result = false;
					toastr.error('Invalid name of entity.');
				} else if(teachSalnDet_details1 == ''){
					result = false;
					toastr.error('Invalid business address.');
				} else if(teachSalnDet_details2 == ''){
					result = false;
					toastr.error('Invalid nature of business interest.');
				} else if(teachSalnDet_details3 == '' || teachSalnDet_details3 < minDate || teachSalnDet_details3 > maxDate){
					result = false;
					toastr.error('Invalid date of acquisition.');
				}				
			} else if(type == 'addRelative' || type == 'modifyRelative'){
				if(teachSalnDet_details0 == ''){
					result = false;
					toastr.error('Invalid name of relative.');
				} else if(teachSalnDet_details1 == ''){
					result = false;
					toastr.error('Invalid relationship.');
				} else if(teachSalnDet_details2 == ''){
					result = false;
					toastr.error('Invalid position.');
				} else if(teachSalnDet_details3 == ''){
					result = false;
					toastr.error('Invalid name of agency.');
				} else if(teachSalnDet_details4 == ''){
					result = false;
					toastr.error('Invalid address of agency.');
				}					
			}
	}

	return result;
}

function deleteAction(type){
	var action = 'deleteAction';
	var option;
	
	if(type == 'modifyMissingLog'){
		var ml_no =  $('#ml_no').val();
		option = ' missinglogs WHERE (ml_no = '+ml_no+')';
	} else if(type == 'modifySpouse' || type == 'modifyDependent'){
		var teachCont_no =  $('#teachCont_no').val();
		option = '  teachercontacts WHERE (teachCont_no = '+teachCont_no+')';
	} else if(type == 'modifyReal' || type == 'modifyPersonal' || type == 'modifyLiability' || type == 'modifyInterest' || type == 'modifyRelative'){
		var teachSalnDet_no =  $('#teachSalnDet_no').val();
		option = '  teachsalndetails WHERE (teachSalnDet_no = '+teachSalnDet_no+')';
	}
	
	var data = [action, option];

	$('#close1').attr('disabled', 'disabled');
	$('#close2').attr('disabled', 'disabled');
	$('#delete').attr('disabled', 'disabled');
	$('#delete').html('Validating...');
	$('#submit').attr('disabled', 'disabled');
	
	$.ajax({
		type: 'POST',
		url: 'services/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				setTimeout(function(){$('#delete').html('Deleting...');}, 1000);
				setTimeout(function(){$('#delete').html('Delete');}, 2000);
				setTimeout(function(){toastr.success(result[1]);}, 3000);
				setTimeout(function(){$('#modal-input').modal('hide');}, 3000);				
				changeActiveMonth();
				showSALNDetails(saln_no);
			} else {
				setTimeout(function(){$('#submit').removeAttr('disabled');}, 1000);
				setTimeout(function(){$('#close1').removeAttr('disabled');}, 1000);
				setTimeout(function(){$('#close2').removeAttr('disabled');}, 1000);
				setTimeout(function(){$('#delete').removeAttr('disabled');}, 1000);	
				setTimeout(function(){$('#delete').html('Delete...');}, 1000);	
				setTimeout(function(){toastr.error(result[1]);}, 1000);
			}
		}
	});	
}

function toggleState(checkinout_no, CHECKTYPE){
	var action = 'toggleState';

	var data = [action, checkinout_no, CHECKTYPE == 1 ? 'O' : 'I'];
	
	$.ajax({
		type: 'POST',
		url: 'services/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				toastr.success(result[1]);
				changeActiveMonth();
			} else {
				toastr.error(result[1]);			
			}
		}
	});		

}

function getSALNs(teachSaln_teach_no){
	var action = 'getSALNs';
	
	var data = [action, teachSaln_teach_no];
	
	$.ajax({
		type: 'POST',
		url: 'services/action.php',
		data: {data:data},	
		success: function(result){
			$('#mysaln-list').html(result);
		}
	});	
	
}

function displaySALNParts(teachsaln){
	var action = 'displaySALNParts';
	var type;
	var data;
	

	//Part 1
	type = 'showPart1';
	data = [action, type, teachsaln];
	$.ajax({
		type: 'POST',
		url: 'services/action.php',
		data: {data:data},	
		success: function(result){
			$('#mysaln-declarant-info').html(result);
		}
	});	
	
	//Part 2
	type = 'showPart2';
	data = [action, type, user_no, 2];
	
	$.ajax({
		type: 'POST',
		url: 'services/action.php',
		data: {data:data},	
		success: function(result){
			$('#mysaln-dependents').html(result);
		}
	});
	
	//Part 3a
	type = 'showPart3a';
	data = [action, type, saln_no, 1];
	
	$.ajax({
		type: 'POST',
		url: 'services/action.php',
		data: {data:data},	
		success: function(result){
			$('#mysaln-real-properties').html(result);
		}
	});
	
	//Part 3b
	type = 'showPart3b';
	data = [action, type, saln_no, 2];
	
	$.ajax({
		type: 'POST',
		url: 'services/action.php',
		data: {data:data},	
		success: function(result){
			$('#mysaln-personal-properties').html(result);
		}
	});
	
	//Part 3c
	type = 'showPart3c';
	data = [action, type, saln_no, 3];
	
	$.ajax({
		type: 'POST',
		url: 'services/action.php',
		data: {data:data},	
		success: function(result){
			$('#mysaln-liabilities').html(result);
		}
	});
	
	//Part 4
	type = 'showPart4';
	data = [action, type, saln_no, 4];
	
	$.ajax({
		type: 'POST',
		url: 'services/action.php',
		data: {data:data},	
		success: function(result){
			$('#mysaln-bifc').html(result);
		}
	});
	
	//Part 5
	type = 'showPart5';
	data = [action, type, saln_no, 5];
	
	$.ajax({
		type: 'POST',
		url: 'services/action.php',
		data: {data:data},	
		success: function(result){
			$('#mysaln-relatives').html(result);
		}
	});
	
	//Part 0
	type = 'showPart0';
	data = [action, type];
	
	$.ajax({
		type: 'POST',
		url: 'services/action.php',
		data: {data:data},	
		success: function(result){
			$('#mysaln-filing-details').html(result);
			$("input[name=teachSaln_status][value=" + teachsaln.teachSaln_status + "]").attr('checked', 'checked');
			$("input[name=teachSaln_filetype][value=" + teachsaln.teachSaln_filetype + "]").attr('checked', 'checked');
			
			if(teachsaln.teachSaln_status == 3){
				$('#saln_finalize').attr('disabled', 'disabled');
				toastr.error('Any action is no longer allowed.');

				$('input[id=teachSaln_filetype]').each(function(){
				   $(this).attr('disabled', 'disabled');
				});
				
				$('a[id=add-button]').each(function(){
				   $(this).hide();
				});
				
				$('a[id=edit-button]').each(function(){
				   $(this).hide();
				});
				
				
			} else {
				//setTimeout(function(){toastr.success('Click the finalize button once done.');}, 5000);
				$('input[id=teachSaln_filetype]').each(function(){
				   $(this).removeAttr('disabled');
				});
				
				$('a[id=add-button]').each(function(){
				   $(this).show();
				});
				
				$('a[id=edit-button]').each(function(){
				   $(this).show();
				});				
			}
		}
	});	
}

function updateSALNType(teachSaln_filetype){
	var action = 'updateSALNType';
	
	var data = [action, saln_no, teachSaln_filetype, user_no];

	$.ajax({
		type: 'POST',
		url: 'services/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				toastr.success(result[1]);
			} else {
				toastr.error(result[1]);
			}
		}
	});	
}

function finalizeSALN(teachSaln_status){
	var action = 'finalizeSALN';
		
	var data = [action, '', saln_no, teachSaln_status, user_no];
	
	$.ajax({
		type: 'POST',
		url: 'services/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				toastr.success(result[1]);
				closeSALNDetails();
			} else {
				toastr.error(result[1]);
			}
		}
	});	
}
</script>

