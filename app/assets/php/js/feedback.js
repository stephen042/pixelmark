$(document).ready(function(){
	
	//Send Feedback Ajax Request
	$("#feedbackBtn").click(function(e){
		if($("#feedback-form")[0].checkValidity()){
			e.preventDefault();
			$("#send-feedback-spinner").show();
			$.ajax({
				url: 'assets/php/process.php',
				method: 'post',
				data: $("#feedback-form").serialize()+'&action=feedback',
				success: function(response){
					$("#feedback-form")[0].reset();
					$("#send-feedback-spinner").hide();
					Swal.fire({
						title: 'Sent Successfully.',
						url: 'feedback.php',
						icon: 'success'
						
						
					});
				}
			});
		}
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