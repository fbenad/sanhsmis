<?php
/*
 * Auth Visible Page
 *
 * This page is the screen lock handler of the app. 
 * @author    	Fernando B. Enad
 * @license    	Public
 */
?>
	<div class="content-wrapper">

		<section class="content">
			<div class="container">
				<div class="row">
					<div class="lockscreen-wrapper">
						<div class="lockscreen-logo">
							<img src="../assets/images/lock.png" style="width: 80px;">
						</div>
						
						<div class="lockscreen-name text-center"><strong><?php echo $_SESSION['user_fullname'];?></strong></div>

						<div class="lockscreen-item">
							<div class="lockscreen-image">
								<?php
								if($_SESSION['user_role'] == 3){
									$withImage = "../assets/images/students/".$_SESSION['user_no'].".jpg";
									$noImage = "../assets/avatars/".$_SESSION['user_gender'].".jpg";									
								} else{
									$withImage = "../assets/images/teachers/".$_SESSION['user_no'].".jpg";
									$noImage = "../assets/avatars/".$_SESSION['user_gender'].".jpg";
								}
								?>
								<img src="<?php echo (file_exists($withImage) ? $withImage : $noImage); ?>" alt="User Image">
							</div>

							<form class="lockscreen-credentials" role="form" method="post" onsubmit="return false;">
								<div class="input-group">
									<input type="hidden" class="form-control" placeholder="Username" name="user_name" id="user_name" value="<?php echo $_SESSION['user_name'];?>">
									<input type="password" class="form-control" placeholder="Password" name="pass_word" id="pass_word" autofocus>
									<div class="input-group-append">
										<button type="submit" class="btn" name="submit" id="submit" onClick="reAuthenticate();"><i class="fas fa-arrow-right text-muted"></i></button>
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
							
							<a href="../">Or go back to the sign-on dashboard</a>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
		
<script type="text/javascript">	
function reAuthenticate(){
	var action = 'reAuthenticate';
	var user_name = $('#user_name').val();
	var pass_word = $('#pass_word').val();
	
	var data = [action, user_name, pass_word];
	
	$('#submit').attr('disabled', 'disabled');
		
	$.ajax({
		type: 'POST',
		url: 'auth/action.php',
		data: {data:data},		
		success: function(result){
			if(result[0] == 1){
				//toastr.success(result[1]);	
				window.location = '<?php echo $_SESSION['prev_url'];?>';
			} else {
				$('#pass_word').val('');
				setTimeout(function(){$('#submit').removeAttr('disabled');}, 1000);
				toastr.error(result[1]);	
			}
		}
	});
}
</script>			