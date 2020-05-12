	<div class="content-wrapper">

		<section class="content">
			<div class="container">
				<div class="row">
					<div class="lockscreen-wrapper">
						<div class="lockscreen-logo">
							<img src="../assets/images/lock.png" style="width: 80px;">
						</div>
						
						<div class="lockscreen-name text-center"><strong><?php echo $_SESSION['stud_fullname'];?></strong></div>

						<div class="lockscreen-item">
							<div class="lockscreen-image">
								<?php
								$withImage = "../assets/images/students/".$_SESSION['stud_no'].".jpg";
								$noImage = "../assets/avatars/".$_SESSION['stud_gender'].".jpg";
								?>
								<img src="<?php echo (file_exists($withImage) ? $withImage : $noImage); ?>" alt="User Image">
							</div>

							<form class="lockscreen-credentials" role="form" method="post">
								<div class="input-group">
									<input type="hidden" class="form-control" placeholder="Username" name="username" id="username" value="<?php echo $_SESSION['stud_no'];?>">
									<input type="password" class="form-control" placeholder="Password" name="password" id="password" autofocus>
									<div class="input-group-append">
										<button type="submit" name="submit" id="submit" class="btn" onClick="reAuthenticate();"><i class="fas fa-arrow-right text-muted"></i></button>
									</div>
								</div>
							</form>
						</div>
						<div class="text-center">
							<div id="demo"></div>
						</div>
						<div class="help-block text-center">
							Enter your password to retrieve your session
						</div>
					
						<div class="text-center">
							
							<a href="?p=logout" onClick="return confirm('Are you sure you want to switch user?');">Or sign in as a different user</a>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
	
<script type="text/javascript">	
function reAuthenticate(){
	var action = 'reAuthenticate';
	var username = $('#username').val();
	var password = $('#password').val();
	
	var data = [action, username, password];
	
	$('#submit').attr('disabled', 'disabled');
		
	$.ajax({
		type: 'POST',
		url: 'auth/action.php',
		data: {data:data},		
		cache: false,
		success: function(result){
			if(result[0] == 1){
				window.location = '<?php echo $_SESSION['prev_url'];?>';
			} else {
				toastr.error(result[1]+'');	
				$('#password').val('');
				setTimeout(function(){$('#submit').removeAttr('disabled');}, 1000);
			}
		}
	});
}
</script>			