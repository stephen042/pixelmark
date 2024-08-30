$(document).ready(function(){

	fetchNotification();

	function fetchNotification() {
		$.ajax({
			url: 'assets/php/process.php',
			method: 'post',
			data: { action: 'fetchNotification' },
			success: function(response) {
				$("#showAllNotification").html(response);
			}
		});
	}

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

	$("body").on("click", ".close", function(e){
		e.preventDefault();
		notification_id = $(this).attr('id');
		$.ajax({
			url: 'assets/php/process.php',
			method: 'post',
			data: { notification_id: notification_id },
			success: function(response) {
				checkNotification();
				fetchNotification();
			}
		});
	});
});