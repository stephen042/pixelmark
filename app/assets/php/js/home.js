$(document).ready(function(){

	//Add New Note Ajax Request
	$("#addNoteBtn").click(function(e){
		if ($("#add-note-form")[0].checkValidity()) {
			e.preventDefault();
			$("#add-note-spinner").show();
			$.ajax({
				url: 'assets/php/process.php',
				method: 'post',
				data: $("#add-note-form").serialize()+'&action=add_note',
				success: function(response){
					$("#add-note-spinner").hide();
					$("#add-note-form")[0].reset();
					$("#addNoteModal").modal('hide');
					Swal.fire({
						title: 'Note Added Successfully.',
					    icon: 'success'
					});

					displayAllNotes();
				}
			});
		}
	});

	//Edit note of an user Ajax Request
	$("body").on("click", ".editBtn", function(e){
		e.preventDefault();
		edit_id = $(this).attr('id');
		$.ajax({
			url: 'assets/php/process.php',
			method: 'post',
			data: { edit_id: edit_id },
			success: function(response){
				data = JSON.parse(response);
				$("#id").val(data.id);
				$("#title").val(data.title);
				$("#note").val(data.note);
			}
		});
	});

	//Update Note of an user Ajax Request
	$("#editNoteBtn").click(function(e){
		if ($("#edit-note-form")[0].checkValidity()) {
			e.preventDefault();
			$("#edit-note-spinner").show();
			$.ajax({
				url: 'assets/php/process.php',
				method: 'post',
				data: $("#edit-note-form").serialize()+'&action=update_note',
				success: function(response){
					$("#edit-note-spinner").hide();
					$("#edit-note-form")[0].reset();
					$("#editNoteModal").modal('hide');
					Swal.fire({
						title: 'Note Edited Successfully.',
					    icon: 'success'
					});

					displayAllNotes();
				}
			});
		}
	});

	//Delete note of an user
	$("body").on("click", ".deleteBtn", function(e){
		e.preventDefault();
		delete_id = $(this).attr('id');
		Swal.fire({
		title: 'Are you sure?',
		text: "You won't be able to revert this!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					url: 'assets/php/process.php',
					method: 'post',
					data: { delete_id: delete_id },
					success: function(response){
				    	Swal.fire(
				    		'Deleted!',
				    		'Note Deleted Successfully.',
				    		'success'
				    	)

				    	displayAllNotes();
					}
				});
			}
		});
	});

	//Display note of an user
	$("body").on("click", ".infoBtn", function(e){
		e.preventDefault();
		info_id = $(this).attr('id');
		$.ajax({
			url: 'assets/php/process.php',
			method: 'post',
			data: { info_id: info_id },
			success: function(response){
				data = JSON.parse(response);
				Swal.fire({
					title: '<strong>Note : ID('+data.id+')</strong>',
					icon: 'info',
					html: '<b>Title: </b>'+data.title+'<br><br><b>Note: </b>'+data.note+'<br><br><b>Written on: </b>'+data.created_at+'<br><br><b>Updated on: </b>'+data.updated_at,
					showCloseButton: true
				});
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


	displayAllNotes();

	function displayAllNotes() {
		$.ajax({
			url: 'assets/php/process.php',
			method: 'post',
			data: { action: 'display_notes' },
			success: function(response) {
				$("#showNote").html(response);
				if ($('.datatable').length > 0) {
			        $('.datatable').DataTable({
			            "bFilter": true,
			            "order": [[ 0, "desc" ]]
			        });
			    }
			}
		});
	}

	//Checking user logged in or not
	$.ajax({
		url: 'assets/php/action.php',
		method: 'post',
		data: { action: 'checkUser' },
		success: function(response){
			if (response === 'bye') {
				window.location = 'index.php';
			}
		}
	});
});