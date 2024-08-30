$("#forgotAlert").hide();
$("#loginAlert").hide();
$("#regAlert").hide();
$(document).ready(function(){
	$("#register-link").click(function(){
		$("#login-box").hide();
		$("#register-box").show();
	});
	$("#login-link").click(function(){
		$("#register-box").hide();
		$("#login-box").show();
	});
	$("#forgot-link").click(function(){
		$("#login-box").hide();
		$("#forgot-box").show();
	});
	$("#back-link").click(function(){
		$("#forgot-box").hide();
		$("#login-box").show();
	});
 
	//Register Ajax Request
	$("#register-btn").click(function(e){
		
			e.preventDefault();
$("#regAlert").hide();
			$("#passError").text('');
			$("#emailError").text('');
			$("#captchaError").text('');
			$("#cpassError").text('');
			$("#nameError").text('');
			var name=document.getElementById('name').value;
			var remail=document.getElementById('remail').value;
			var rpassword=document.getElementById('rpassword').value;
			var cpassword=document.getElementById('cpassword').value;
			var captcha=document.getElementById('captcha').value;
			var ocaptcha=document.getElementById('ocaptcha').value;
			var isYes = 0;
			
			$("#register-spinner").show();

			if(rpassword == ""){
				$("#passError").text('* Password is required.');
				$("#register-spinner").hide();
				isYes = 1;
			}
			if(rpassword != "" && rpassword.length < 6){
				$("#passError").text('* Password must have atleast 6 characters.');
				$("#register-spinner").hide();
				isYes = 1;
			}
			if(rpassword != cpassword){
				$("#cpassError").text('* Password did not match.');
				$("#register-spinner").hide();
				isYes = 1;
			}
			if(captcha == ""){
				$("#captchaError").text('* Captcha is required.');
				$("#register-spinner").hide();
				isYes = 1;
			}
			if(captcha != ocaptcha){
				$("#captchaError").text('* Captcha does not match!');
				$("#register-spinner").hide();
				isYes = 1;
			}
			if(remail == ""){
				$("#emailError").text('* Email is required.');
				$("#register-spinner").hide();
				isYes = 1;
			}
			if(name == ""){
				$("#nameError").text('* Full Name is required.');
				$("#register-spinner").hide();
				isYes = 1;
			}
			
			
			
			if(isYes == 0){
				$("#passError").text('');
				$("#emailError").text('');
				$("#cpassError").text('');
				$("#nameError").text('');
				$("#captchaError").text('');
				$.ajax({
					url: 'action.php',
					method: 'post',
					data: 'name='+name+'&email='+remail+'&password='+rpassword+'&captcha='+captcha+'&ocaptcha='+ocaptcha+'&action=register',
					success: function(response){
						$("#register-spinner").hide();
						if (response === 'register') {
							window.location = 'login.php?success';
						} else {
							$("#regAlert").show();
							$("#regAlert").html(response);
						}
					}
				});
			}
		
	});

	//Login Ajax Request
	$("#login-btn").click(function(e){
			e.preventDefault();
			$("#lpassError").text('');
			$("#lemailError").text('');
			$("#lcaptchaError").text('');
$("#loginAlert").hide();
			var email=document.getElementById('email').value;
			var password=document.getElementById('password').value;
			var captcha=document.getElementById('lcaptcha').value;
			var ocaptcha=document.getElementById('locaptcha').value;
			var isYes = 0;
			$("#login-spinner").show();

			if(password == ""){
				$("#lpassError").text('* Password is required.');
				$("#login-spinner").hide();
				isYes = 1;
			}
			if(email == ""){
				$("#lemailError").text('* Email is required.');
				$("#login-spinner").hide();
				isYes = 1;
			}
				if(captcha == ""){
				$("#lcaptchaError").text('* Captcha is required.');
				$("#login-spinner").hide();
				isYes = 1;
			}
			if(captcha != ocaptcha){
				$("#lcaptchaError").text('* Captcha does not match!');
				$("#login-spinner").hide();
				isYes = 1;
			}
			
			if(isYes == 0){
				$("#lpassError").text('');
			$("#lemailError").text('');
			$("#lcaptchaError").text('');
			$.ajax({
				url: 'action.php',
				method: 'post',
				data: 'email='+email+'&password='+password+'&captcha='+captcha+'&ocaptcha='+ocaptcha+'&action=login',
				success: function(response){
					$("#login-spinner").hide();
					if (response === 'login') {
					     
						window.location = 'account/';
					} else {
					
$("#loginAlert").show();
						$("#loginAlert").html(response);
					}
				}
			});	
		}
		
	});

	//Forgot Password Ajax Request
    $("#forgot-btn").click(function(e) {
            e.preventDefault();
			$("#forgotAlert").hide();
			$("#femailError").text('');
			var email=document.getElementById('femail').value;
			var isYes = 0;

			 $("#forgot-spinner").show();
			if(email == ""){
				$("#femailError").text('* Email is required.');
				$("#forgot-spinner").hide();
				isYes = 1;
			}
           if(isYes == 0){
			$("#femailError").text('');
            $.ajax({
                url: 'action.php',
                method: 'post',
                data: 'email='+email+'&action=forgot',
                success: function (response) {
                	$("#forgot-spinner").hide();
                	$("#forgot-form")[0].reset();
					$("#forgotAlert").show();
                	$("#forgotAlert").html(response);
                }
            });

		}
        
    });
});