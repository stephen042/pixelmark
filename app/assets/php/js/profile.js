$(document).ready(function(){
	
	//Profile Update Ajax Request
	$("#profile-update-form").submit(function(e){
		e.preventDefault();
		$("#edit-profile-spinner").show();
		$.ajax({
			url: 'assets/php/process.php',
			method: 'post',
			processData: false,
			contentType: false,
			cache: false,
			data: new FormData(this),
			success: function(response){
				$("#edit-profile-spinner").hide();
				location.reload();
			}
		});
	});

	//Change password Ajax Request
	$("#changePassBtn").click(function(e){
		if($("#change-pass-form")[0].checkValidity()){
			e.preventDefault();
			$("#change-pass-spinner").show();
			$.ajax({
				url: 'assets/php/process.php',
				method: 'post',
				data: $("#change-pass-form").serialize()+'&action=change_pass',
				success: function(response){
					$("#changePassError").html(response);
					$("#change-pass-spinner").hide();
					$("#change-pass-form")[0].reset();
				}
			});
		}
	});

	//Verify email ajax request
	$("#verify-email").click(function(e){
		e.preventDefault();
		$(this).text('Please Wait');
		$.ajax({
			url: 'assets/php/process.php',
			method: 'post',
			data: { action: 'verify_email' },
			success: function(response){
				$("#verifyEmailAlert").html(response);
				$("#verify-email").text('Verify Now!');
			}
		});
	});
	
	checkNotification();
	
	function checkNotification() {
		$.ajax({
			url: 'assets/php/process.php',
			method: 'post',
			data: { action: 'checkNotification' },
			success: function(response) {
				$("#checkNotification").html(response);
			}
		});
	}
});