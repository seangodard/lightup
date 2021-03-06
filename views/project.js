//----------------------------------------------------------------------
// A javascript file for handling modifying info on the project page and
// 	the members of the project
//----------------------------------------------------------------------

//----------------------------------------------------------------------
// Set up the body of the project page to edit the project info
//----------------------------------------------------------------------
function setEditForm() {
	// Retrieve the old values to use
	var old_title = $('#project_title').text();
	var old_body = $('#project_body').text();

	// Remove old info from being displayed
	$('#project_info').remove();

	// Update the tools in the toolbar
	$('#tool_bar').empty();

	// Show the form with the old values filled in
	$('#main_body').append(
			'<form id="edit_project" class="flex flex_grow" method="post" action="update_project_info.php" enctype="multipart/form-data">'
				+'<div id="upload_project_picture" class="flex_fit">'
					+ '<p>File size should not exceed 500 kB.</p>'
					+'<input type="file" name="new_project_picture" id="new_project_picture" class="file_upload">'
				+'</div>'
				+'<div class="formgroup flex_fit">'
					+'<input type="text" id="project_entry_title" class="title" name="project_title" value="'+old_title+'">'
				+'</div>'
				+'<textarea id="project_entry_body" name="project_body" class="flex_grow">'+old_body+'</textarea>'
				+'<input type="hidden" name="project_id" value="'+$('#project_id').val()+'">'
				+'<input type="submit" id="update_project" class="flex_fit" value="Done">'
			+'</form>');
	// Enable the update action
	$('#update_project').on('click', updateProject);

	// Populate the sidebar with the members queue
	fillWithMembersQueue();
}

//----------------------------------------------------------------------
// Send the data along to update the the projects info
//----------------------------------------------------------------------
function updateProject() {
	var valid = true;

	// Get the required fields
	var new_title = $('#project_entry_title').val();
	var new_body = $('#project_entry_body').val();
	var project_id = $('#project_id').val();

	// Clear any previous error reports
	$('#project_entry_title').parent().removeClass('has_error');
	$('#project_entry_title').parent().children('.feedback_message').remove();

	// Make sure that there is a title and set error otherwise 
	if (!new_title.length > 0) {
		$('#project_entry_title').parent().append('<div class="feedback_message">Please provide a project title!</div>');
		$('#project_entry_title').parent().addClass('has_error');
		valid = false;
	}
	
	// Make sure that the title length is not exceeded
	if (new_title.length > 30) {
		$('#project_entry_title').parent().append('<div class="feedback_message">Project title cannot exceed 30 characters!</div>');
		$('#project_entry_title').parent().addClass('has_error');
		valid = false;
	}

	// Don't send if forms aren't valid
	if (!valid) {
		event.preventDefault();
	}
}

//----------------------------------------------------------------------
// Set the sidebar to contain users that are in the projects members queue
//----------------------------------------------------------------------
function fillWithMembersQueue() {
	var project_id = $('#project_id').val();

	// Send the request to get the users that are in the members queue
	$.post('get_member_queue.php', {project_id : project_id}, function(response) {
		// Remove the content from the sidebar and put new title
		$('#sidebar_content').children().remove();
		$('#sidebar_content').append('<div class="sidebar_title">Members Queue</div>');
		
		// Add the buttons for each of the members in the queue
		if (response) {
			$.each(response, function() {
				$('#sidebar_content').append(
					'<div class="sidebar_entry unpadded">'
						+'<a href="profile.php?id='+this.user_id+'">'
							+'<div class="button1">'
								+this.username
							+'</div>'
						+'</a>'
						+'<div class="button2 add_button">'
							+'<button class="add_member">'+'+'+'</button>'
						+'</div>'
						+'<input type="hidden" class="queued_member_id" value="'+this.user_id+'">'
					+'</div>');
			});

			$('.add_member').on('click', addMember);
		}
	}, 'json');
}

//----------------------------------------------------------------------
// Attempt to add the given user in the projects queue to the project
// 	as a member
//----------------------------------------------------------------------
function addMember() {
	var user_id = $(this).parent().parent().children('.queued_member_id').val();
	var project_id = $('#project_id').val();
	var pressed_button = $(this).parent().parent();

	// Send the request to add the given member to the project
	$.post('add_project_member.php', {user_id : user_id, project_id : project_id}, function(response) {
		if (response) {
			// Remove the button for the user from the sidebar on success 
			pressed_button.remove();
		}
	}, 'json');
}

//----------------------------------------------------------------------
// Set up the side request button to enable a user to click to request 
// 	to join
//----------------------------------------------------------------------
function requestJoin() {
	var project_id = $('#project_id').val();

	// Send the request to join the project and update the button if you are put on 
	// 	the queue
	$.post('request_membership.php', {project_id : project_id}, function(response) {
		// Notify user if it worked by updating the button
		if (response) {
			$('#join_bar').empty();
			$('#join_bar').append('<button class="side_large_button pressed">You\'re on the list!</button>');
		}
	}, 'json');
}

//----------------------------------------------------------------------
// Set up the buttons for when the document finishes loading
//----------------------------------------------------------------------
$(document).ready(function() {
	// Setup the edit button to fill the main body with a form to edit the project info
	$('#edit').on('click', setEditForm);

	// Setup the request button to add the user to the project queue
	$('#request_join').on('click', requestJoin);
});
