	<div class="content-wrapper">
	
		<section class="content-header">
			<div class="container">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Administrative Landing Page</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="?p=home"><i class="fas fa-home"></i></a></li>
							<li class="breadcrumb-item active">Welcome</li>
						</ol>
					</div>
				</div>
			</div>
		</section>

		<section class="content">
			<div class="error-page">
				<h2 class="headline text-success"> <?php echo $app_acronym;?></h2>
				<div class="error-content">
					<h3>
						<i class="fas fa-door-open text-info"></i> 
						Admin&trade;
					</h3>
					<br><br><br><br>
					<p style="line-height: 1.1">
						Access to this system is provided by <?php echo $sch_fullname;?> solely for authorized business. 
						Thus, by logging in, you are signifying your consent to these conditions and may be monitored for regulatory reasons.
						<br><br>
						Your access is based on the provisions provided by the System Administrator and thus will appear in the menu. 
						Should you have access-related issues, please reach out to the previously-mentioned in-charge.
						<br><br>
						&copy;<?php echo $app_acronym ;?>. All rights reserved.
					</p>
				</div>
			</div>
		</section>
	</div>		