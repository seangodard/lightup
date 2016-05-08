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
			'<div id="edit_project" class="flex flex_grow">'
				+'<div class="formgroup flex_fit">'
					+'<input type="text" id="project_entry_title" class="title" name="project_entry_title" value="'+old_title+'">'
				+'</div>'
				+'<textarea id="project_entry_body" class="flex_grow">'+old_body+'</textarea>'
				+'<input type="submit" id="update_project" class="flex_fit" value="Done">'
			+'</div>');

	// Enable the update action
	$('#update_project').on('click', updateProject);

	// Populate the sidebar with the members queue
	fillWithMembersQueue();
}

//----------------------------------------------------------------------
// Send the data along to update the the projects info
//----------------------------------------------------------------------
function updateProject() {
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
		return;
	}
	
	// Make sure that the title length is not exceeded
	if (new_title.length > 30) {
		$('#project_entry_title').parent().append('<div class="feedback_message">Project title cannot exceed 30 characters!</div>');
		$('#project_entry_title').parent().addClass('has_error');
		return;
	}

	// Send the request to update the entry for the user
	$.post('update_project_info.php', {project_id : project_id, project_title : new_title, project_body : new_body},
		function(response) {
			// Fill in the body with the current project info/updated info
			// Remove old form
			$('#edit_project').remove();
			
			// Show the form with the old values filled in
			$('#main_body').append(
				'<div id="project_info">'
					+'<div id="heading" class="flex_fit">'
						+'<h2 id="project_title">'+response.project_name+'</h2>'
					+'</div>'
					+'<div id="descriptio" class="flex flex_grow">'
						+'<div id="project_body">'+response.description+'</div>'
					+'</div>'
				+'</div>');

			// Put the project members back in the sidebar
			fillWithMembers();

			// Put the edit button back
			var edit_button = $('<input type="image" id="edit" src="/views/images/edit.svg" alt="edit">');
			$(edit_button).on('click', setEditForm);
			$('#tool_bar').append(edit_button);
	}, 'json');
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
		$.each(response, function() {
			$('#sidebar_content').append(
				'<a href="profile.php?id='+this.user_id+'">'
					+'<button class="sidebar_entry">'+this.username+'</button>'
				+'</a>');
		});
	}, 'json');
}

//----------------------------------------------------------------------
// Set the sidebar to contain users that are members of the project
//----------------------------------------------------------------------
function fillWithMembers() {
	var project_id = $('#project_id').val();

	// Send the request to get the users that are in the members queue
	$.post('get_members.php', {project_id : project_id}, function(response) {
		// Remove the content from the sidebar and put new title
		$('#sidebar_content').children().remove();
		$('#sidebar_content').append('<div class="sidebar_title">Project Members</div>');
		
		// Add the buttons for each of the members in the queue
		$.each(response, function() {
			$('#sidebar_content').append(
				'<a href="profile.php?id='+this.user_id+'">'
					+'<button class="sidebar_entry">'+this.username+'</button>'
				+'</a>');
		});
	}, 'json');
}

//----------------------------------------------------------------------
// Set up the buttons for when the document finishes loading
//----------------------------------------------------------------------
$(document).ready(function() {
	// Setup the edit button to fill the main body with a form to edit the project info
	$('#edit').on('click', setEditForm);
});
