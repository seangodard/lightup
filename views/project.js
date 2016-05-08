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
					+'<input type="text" id="project_entry_title" name="project_entry_title" value="'+old_title+'">'
				+'</div>'
				+'<textarea id="project_entry_body" class="flex_grow">'+old_body+'</textarea>'
				+'<input type="submit" id="update_project" class="flex_fit" value="Done">'
			+'</div>');

	// Enable the update action
	$('#update_project').on('click', updateProject);
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

	// TODO : Here : Sun 08 May 2016 11:31:56 AM EDT 
	// Send the request to update the entry for the user
	$.post('update_project_info.php', {project_id : project_id, project_title : new_title, project_body : new_body},
		function(response) {
			// TODO : Remove : Sun 08 May 2016 11:57:39 AM EDT 
			console.log(response.project_name);
			console.log(response.description);

			// TODO : Here : Sun 08 May 2016 11:31:56 AM EDT 
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
			

			// Put the edit button back
			var edit_button = $('<input type="image" id="edit" src="/views/images/edit.svg" alt="edit">');
			$(edit_button).on('click', setEditForm);
			$('#tool_bar').append(edit_button);
	}, 'json');
}

//----------------------------------------------------------------------
// Set up the buttons for when the document finishes loading
//----------------------------------------------------------------------
$(document).ready(function() {
	// Setup the edit button to fill the main body with a form to edit the project info
	$('#edit').on('click', setEditForm);
});
