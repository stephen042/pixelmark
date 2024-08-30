<?php
session_start();
// Include config file
include "conn.php";
include "config.php";
$msg = "";

if (isset($_GET['tkn']) && $_GET['tkn'] != "") {
	$token = $link->real_escape_string($_GET['tkn']);

	$sql1 = "SELECT * FROM users WHERE token = '$token' LIMIT 1";
	$result = mysqli_query($link, $sql1);
	if (mysqli_num_rows($result) > 0) {

		$row1 = mysqli_fetch_assoc($result);
		$uverify = $row1['verify'];

		if ($uverify == 0) {
			$sql1up = "UPDATE users SET verify = 1 WHERE token = '$token' LIMIT 1";
			mysqli_query($link, $sql1up);
			$msg = "E-mail has been successfully verified! Kindly login to your account.";
		} else {
			$msg = "E-mail has already been verified!";
		}
	} else {
		$msg = "Invalid Verification!";
	}
}


$token1 = '1234567890';
$token1 = str_shuffle($token1);
$token1 = substr($token1, 0, 6);
?>
<!DOCTYPE html>
<html lang="en">

<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<title>Login - Mintsea Space NFT Marketplace</title>

	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="../wp-content/themes/nerko/assets/img/logo/pixelverse.png">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">

	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">

	<!-- Main CSS -->
	<link rel="stylesheet" href="assets/css/style.css">

	<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->


	<script src="ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script type="text/javascript">
		$(window).load(function() {
			$("#loader").fadeOut(1000);
		});
	</script>

	<style>
		#loader {
			position: fixed;
			z-index: 9999999;
			left: 0px;
			top: 0px;
			width: 100%;
			/* border: #c10909; */
			height: 100%;
			background: url('assets/loader.gif') 50% 50% no-repeat #f9f9f9;
		}
	</style>



	<link rel="stylesheet" href="../cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

	<!-- live chat jivo -->
	<script src="//code.jivosite.com/widget/x7LmAshb0H" async></script>
</head>







<body style="background-image: url(front/images/bg1.jpg);">
	<div id="loader"></div>
	<!--Login Main Wrapper -->
	<div class="main-wrapper login-body" id="login-box">
		<div class="login-wrapper">
			<div class="container">
				<div class="loginbox">
					<div class="login-left">


						<img class="img-fluid" src="front/assets/images/banner/banner-img.png" alt="Logo">
					</div>
					<div class="login-right">
						<div class="login-right-wrap">
							<a href="../index.html"><img class="img-fluid" src="../wp-content/themes/nerko/assets/img/logo/pixelverse.png" alt="Logo" width="150"></a>
							<hr>
							<h1 class="mb-4">NFT Login</h1>
							<p style="color:red;">Login to purchase NFT</p>
							<!-- Form -->
							<form action="#" method="post" id="login-form">
								<?php if ($msg != "") echo "<div style='padding:20px;background-color:#dce8f7;color:black'> $msg</div class='btn btn-success'>" . "";  ?>
								<?php if (isset($_GET['success']) && $msg == "") echo "<div style='padding:20px;background-color:#dce8f7;color:black'> You have successfully registered. Please Login with your credentials</div class='btn btn-success'>" . "";  ?>
								<div id="loginAlert" style="background: #c10909;color: #fff;padding: 10px;margin-bottom: 6px;"></div>
								<div class="form-group">
									<input class="form-control" type="email" name="email" id="email" placeholder="Email" required value="">
									<div id="lemailError" class="text-center text-danger font-weight-bold"></div>
								</div>
								<div class="form-group">
									<input class="form-control" type="password" name="password" id="password" placeholder="Password" required minlength="6" value="">
									<div id="lpassError" class="text-center text-danger font-weight-bold"></div>
								</div>
								<div style="height: 46px;line-height: 46px; width:100%;text-align: center;background-color: #3b3f4c;color: #FFFFFF!important;font-size: 26px;font-weight: bold;letter-spacing: 20px;font-family: 'Henny Penny', cursive;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;display: none;justify-content: center;     margin-bottom: 9px;" class="captcha">
									<span style="    float:left;     -webkit-transform: rotate(3deg);"><?php echo $token1; ?></span>
								</div>
								<input type="hidden" name="ocaptcha" id="locaptcha" value="<?php echo $token1; ?>" required>
								<div class="form-group">
									<input class="form-control" type="hidden" value="<?php echo $token1; ?>" name="captcha" id="lcaptcha" placeholder="Enter code" minlength="6">
									<div id="lcaptchaError" class="text-center text-danger font-weight-bold"></div>
								</div>
								<div class="form-group">
									<div class="checkbox float-left">
										<label>
											<input type="checkbox" name="rem"> Remember Me
										</label>
									</div>
									<div class="float-right forgotpass"><a href="#" id="forgot-link">Forgot Password?</a></div>
								</div>
								<div class="form-group">
									<button class="btn btn-primary btn-block" type="submit" id="login-btn">Login&nbsp;
										<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;" id="login-spinner"></span></button>
								</div>
							</form>
							<!-- /Form -->

							<div class="login-or">
								<span class="or-line"></span>
								<span class="span-or">or</span>
							</div>

							<div class="text-center dont-have">Don’t have an account? <a href="#" id="register-link">Register</a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Login Main Wrapper -->

	<!--Register Main Wrapper -->
	<div class="main-wrapper login-body" id="register-box" style="display: none;">
		<div class="login-wrapper">
			<div class="container">
				<div class="loginbox">
					<div class="login-left">
						<img class="img-fluid" src="front/assets/images/banner/banner-img.png" alt="Logo">
					</div>
					<div class="login-right">
						<div class="login-right-wrap">
							<a href="../index.html"><img class="img-fluid" src="../wp-content/themes/nerko/assets/img/logo/pixelverse.png" alt="Logo" width="150"></a>
							<hr>
							<h1 class="mb-4">NFT Register</h1>

							<!-- Form -->
							<form action="#" method="post" id="register-form">
								<div id="regAlert" style="background: #c10909;color: #fff;padding: 10px;margin-bottom: 6px;"></div>
								<div class="form-group">
									<input class="form-control" type="text" name="name" id="name" placeholder="Full Name" required>
									<div id="nameError" class="text-center text-danger font-weight-bold"></div>
								</div>
								<div class="form-group">
									<input class="form-control" name="email" id="remail" type="email" placeholder="Email" required>
									<div id="emailError" class="text-center text-danger font-weight-bold"></div>
								</div>
								<div class="form-group">
									<input class="form-control" type="password" name="password" id="rpassword" placeholder="Password" minlength="6" required>
									<div id="passError" class="text-center text-danger font-weight-bold"></div>
								</div>
								<div class="form-group">
									<input class="form-control" type="password" name="cpassword" id="cpassword" placeholder="Confirm Password" minlength="6" required>
									<div id="cpassError" class="text-center text-danger font-weight-bold"></div>
								</div>

								<div style="height: 46px;line-height: 46px; width:100%;text-align: center;background-color: #3b3f4c;color: #FFFFFF!important;font-size: 26px;font-weight: bold;letter-spacing: 20px;font-family: 'Henny Penny', cursive;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;display: none;justify-content: center;     margin-bottom: 9px;" class="captcha">
									<span style="    float:left;     -webkit-transform: rotate(3deg);"><?php echo $token1; ?></span>
								</div>
								<input type="hidden" name="ocaptcha" id="ocaptcha" value="<?php echo $token1; ?>" required>
								<div class="form-group">
									<input class="form-control" value="<?php echo $token1; ?>" type="hidden" name="captcha" id="captcha" placeholder="Enter code" minlength="6" >
									<div id="captchaError" class="text-center text-danger font-weight-bold"></div>
								</div>
								<div class="form-group mb-0">
									<button class="btn btn-primary btn-block" type="submit" id="register-btn">Register&nbsp;
										<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;" id="register-spinner"></span></button>
								</div>
							</form>
							<!-- /Form -->

							<div class="login-or">
								<span class="or-line"></span>
								<span class="span-or">or</span>
							</div>

							<div class="text-center dont-have">Already have an account? <a href="#" id="login-link">Login</a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Register Main Wrapper -->

	<!--Forgot Main Wrapper -->
	<div class="main-wrapper login-body" id="forgot-box" style="display: none;">
		<div class="login-wrapper">
			<div class="container">
				<div class="loginbox">
					<div class="login-left">
						<img class="img-fluid" src="front/assets/images/banner/banner-img.png" alt="Logo">
					</div>
					<div class="login-right">
						<div class="login-right-wrap">
							<a href="../index.html"><img class="img-fluid" src="../wp-content/themes/nerko/assets/img/logo/pixelverse.png" alt="Logo" width="150"></a>
							<hr>
							<h1>Forgot Password?</h1>
							<p class="account-subtitle">Enter your NFT email to get a password reset link</p>

							<!-- Form -->
							<form action="#" method="post" id="forgot-form">
								<div id="forgotAlert" style="background: #c10909;color: #fff;padding: 10px;margin-bottom: 6px;"></div>
								<div class="form-group">
									<input class="form-control" type="email" name="email" id="femail" placeholder="Email" required>
									<div id="femailError" class="text-center text-danger font-weight-bold"></div>
								</div>
								<div class="form-group mb-0">
									<button class="btn btn-primary btn-block" type="submit" id="forgot-btn">Reset Passowrd&nbsp;
										<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;" id="forgot-spinner"></span></button>
								</div>
							</form>
							<!-- /Form -->

							<div class="login-or">
								<span class="or-line"></span>
								<span class="span-or">or</span>
							</div>

							<div class="text-center dont-have">Go back to <a href="#" id="back-link">Login</a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Forgot Main Wrapper -->

	<!-- jQuery -->
	<script src="assets/js/jquery-3.2.1.min.js"></script>

	<!-- Bootstrap Core JS -->
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>

	<!-- Form Validation JS -->
	<script src="assets/js/form-validation.js"></script>

	<!-- Custom JS -->
	<script src="assets/js/script.js"></script>

	<script src="assets/php/js/index.js"></script>

</body>


</html>