//----------------------------------------------------------------------
// A javascript file for handling journal entry retrieval and adding of
// 	entries
//----------------------------------------------------------------------
// TODO : When to notify the user?
// TODO : Fix the bug where you get double posts if you click between very fast : Fri 06 May 2016 02:36:55 PM EDT 

// ------------------------------------------------------------
// Set a button in the sidebar to trigger entry retrieval based
// 	on the values stored in the html
// ------------------------------------------------------------
function entryRetrievalButtonEvent() {
	var entry_id = $(this).children('.entry_id').attr('value');
	var posting_user_id = $(this).children('.entry_user_id').attr('value');
	entryRetrieval(entry_id, posting_user_id);
}

//----------------------------------------------------------------------
// Set up the journal summary buttons to retrieve and fill in the body
// 	below the project title
// @param entry_id the id of the entry to retrieve
// @param posting_user_id the id of the user that made the posting
//----------------------------------------------------------------------
function entryRetrieval(entry_id, posting_user_id) {
	// Get the project_id and the entry_id
	var project_id = $('#project_id').attr('value');

	// Remove old entry, add or update forms 
	$('#add_form').remove();
	$('#full_entry').remove();
	$('#update_form').remove();

	// Send in the request to get the entry data; show add form if none returned
	$.post('get_entry.php', {project_id : project_id, entry_id : entry_id}, function(response) {
		// Make sure that the entry was retrieved properly (should be an empty object if not allowed/non-existent)
		if (response){
			// display the entry content with the posting users profile link 
			$('#main_body').append(
				'<div id="full_entry">'
					+'<h3 id="visible_entry_title">'+response.title+'</h3>'
					+'<h4><a href=/profile.php?id='
						+response.posting_user_id+'>'+response.poster_username+'</a> '+response.entry_time+'</h4>'
					+'<section id="visible_entry_body" class="journal_entry">'+response.body+'</section>'
					+'<input type="hidden" id="visible_entry_id" value="'+response.entry_id+'">'
					+'<input type="hidden" id="visible_entry_user_id" value="'+response.posting_user_id+'">'
				+'</div>'
			);

			// Update the tools in the toolbar
			$('#tool_bar').empty();
			putAddButton();
			putEditButton();

			// Scroll to the top of the page
			window.scrollTo(0, 0);
		}
		else {
			// Something weird happened so just put the add form back
			setAddForm();
		}
	}, 'json');
};

//----------------------------------------------------------------------
// Set up the body of the journal page with a form to add an entry
//----------------------------------------------------------------------
function setAddForm() {
	// Remove old entry, add or update forms 
	$('#add_form').remove();
	$('#full_entry').remove();
	$('#update_form').remove();

	// Remove the tools from the toolbar
	$('#tool_bar').empty();

	// Show the form in the form
	$('#main_body').append(
			'<div id="add_form" class="flex flex_grow">'
				+'<div class="formgroup flex_fit">'
					+'<input type="text" placeholder="Title" id="entry_title" class="title" name="entry_title">'
				+'</div>'
				+'<textarea id="entry_body" class="flex_grow"></textarea>'
				+'<input type="submit" id="add_entry" class="flex_fit" value="Done">'
			+'</div>');

	// Enable the add action
	$('#add_entry').on('click', addEntry);
}

// Set up the body of the journal page with a form to edit the given entry
//----------------------------------------------------------------------
function setEditForm() {
	// Retrieve the old values to use
	var entry_id = $('#visible_entry_id').val();
	var current_title = $('#visible_entry_title').text();
	var current_body = $('#visible_entry_body').text();

	// Remove old entry, add or update forms 
	$('#add_form').remove();
	$('#full_entry').remove();
	$('#update_form').remove();

	// Update the tools in the toolbar
	$('#tool_bar').empty();
	putAddButton();

	// Show the form with the old values filled in
	$('#main_body').append(
			'<div id="update_form" class="flex flex_grow">'
				+'<div class="formgroup flex_fit">'
					+'<input type="text" id="entry_title" name="entry_title" class="title" value="'+current_title+'">'
				+'</div>'
				+'<textarea id="entry_body" class="flex_grow">'+current_body+'</textarea>'
				+'<input type="hidden" id="visible_entry_id" value="'+entry_id+'">'
				+'<input type="submit" id="update_entry" class="flex_fit" value="Done">'
			+'</div>');

	// Enable the update action
	$('#update_entry').on('click', updateEntry);
}

//----------------------------------------------------------------------
// Send the data along to update the entry
//----------------------------------------------------------------------
function updateEntry() {
	// Get the required fields
	var entry_title = $('#entry_title').val();
	var entry_body = $('#entry_body').val();
	var entry_id = $('#visible_entry_id').val();

	// Clear any previous error reports
	$('#entry_title').parent().removeClass('has_error');
	$('#entry_title').parent().children('.feedback_message').remove();

	// Make sure that there is a title and set error otherwise 
	if (!entry_title.length > 0) {
		$('#entry_title').parent().append('<div class="feedback_message">Please provide a title!</div>');
		$('#entry_title').parent().addClass('has_error');
		return;
	}
	
	// Make sure that the title length is not exceeded
	if (entry_title.length > 30) {
		$('#entry_title').parent().append('<div class="feedback_message">Title cannot exceed 30 characters!</div>');
		$('#entry_title').parent().addClass('has_error');
		return;
	}
	
	// Send the request to update the entry for the user
	$.post('update_entry.php', {entry_id : entry_id, title : entry_title, body : entry_body}, function(response) {
		if (response) {
			// Remove the old post with this entry id 
			$('#sidebar_content').children('.sidebar_entry').children('.entry_id[value="'+entry_id+'"]').parent().remove();
		}
		// TODO : Notify the user that nothing in the database has changed: Thu 28 Apr 2016 03:18:41 PM EDT 
		else {

		}
		// Open the possibly new edited version within the window
		var user_id = $('#logged_in_user_id').val();
		entryRetrieval(entry_id, user_id);
	}, 'json');
}

//----------------------------------------------------------------------
// Send the data to add an entry to the project
//----------------------------------------------------------------------
function addEntry() {
	// Get the form data 
	var entry_title = $('#entry_title').val();
	var entry_body = $('#entry_body').val();
	var project_id = $('#project_id').val();

	// Clear any previous error reports
	$('#entry_title').parent().removeClass('has_error');
	$('#entry_title').parent().children('.feedback_message').remove();

	// Make sure that there is a title and set error otherwise 
	if (!entry_title.length > 0) {
		$('#entry_title').parent().append('<div class="feedback_message">Please provide a title!</div>');
		$('#entry_title').parent().addClass('has_error');
		return;
	}
	
	// Make sure that the title length is not exceeded
	if (entry_title.length > 30) {
		$('#entry_title').parent().append('<div class="feedback_message">Title cannot exceed 30 characters!</div>');
		$('#entry_title').parent().addClass('has_error');
		return;
	}
	
	// Attempt to add the journal entry 
	$.post('add_journal_entry.php', {project_id : project_id, title : entry_title, body : entry_body},
			function(response) {
				// Notify the user that the post was added and then clear out the fields
				if (response) {
					// Clear the fields
					var entry_title = $('#entry_title').val('');
					var entry_body = $('#entry_body').val('');
				}
				// TODO : Notify the user that their request failed : Thu 28 Apr 2016 03:18:41 PM EDT 
				else {

				}
	}, 'json');	
}

// ------------------------------------------------------------
// Attempt to retrieve the latests journal entry summaries that 
// 	the user doesn't currently have
// ------------------------------------------------------------
function getLatestEntrySummaries() {
	//if (isset($_POST['project_id']) && isset($_POST['timestamp'])) {
	var project_id = $('#project_id').val();
	var last_timestamp = $('#sidebar_content').children(':nth-child(2)').children('.timestamp').text();

	// Request the latest entries
	if (last_timestamp != null && project_id != null) {
		$.post('get_entry_summaries.php', {project_id : project_id, timestamp : last_timestamp}, function(response) {
			
			// For each new summary create and add the button to the top of the list in the correct order
			$.each(response.reverse(), function() {
				var new_summary_button = $('<button class="sidebar_entry">'
											+'<input type="hidden" class="entry_id" value="'+this.entry_id+'">'
											+'<input type="hidden" class="entry_user_id" value="'+this.posting_user_id+'">'
											+'<div>'+this.title+' : '+this.poster_username+'</div>'
											+'<div class="timestamp">'+this.entry_time+'</div>'
										+'</button>');

				// Add the listener to the new button 
				new_summary_button.on('click', entryRetrievalButtonEvent);

				// Add the button to the sidebar
				$('#sidebar_content').children(':nth-child(1)').after(new_summary_button);
			});
		}, 'json');
	}
}

// ------------------------------------------------------------
// Add a button to add an entry to the toolbar
// ------------------------------------------------------------
function putAddButton() {
	var add_button = $('<input type="image" id="add" src="/views/images/add.svg" alt="add">');
	$(add_button).on('click', setAddForm);
	$('#tool_bar').append(add_button);
}

// ------------------------------------------------------------
// Add a button to edit an entry to the toolbar only if the user
// 	owns the post
// ------------------------------------------------------------
function putEditButton() {
	var entry_user_id = $('#visible_entry_user_id').val();
	var logged_in_user_id = $('#logged_in_user_id').val();

	// Verify that the logged in user owns the post
	if (entry_user_id == logged_in_user_id) {
		var edit_button = $('<input type="image" id="edit" src="/views/images/edit.svg" alt="edit">');
		$(edit_button).on('click', setEditForm);
		$('#tool_bar').append(edit_button);
	}
}

// TODO : Add a way for scrolling to load ~15 messages older than the last one and append to the list : Thu 28 Apr 2016 03:50:52 PM EDT 
// TODO : Only start with 15 loaded : Thu 28 Apr 2016 03:50:52 PM EDT 

//----------------------------------------------------------------------
// Set up the buttons for when the document finishes loading
//----------------------------------------------------------------------
$(document).ready(function() {
	// Setup AJAX on each of the buttons so that clicking them opens the full text
	$('.sidebar_entry').on('click', entryRetrievalButtonEvent);

	// Setup the add button to fill the main body with a form to add an entry
	$('#add').on('click', setAddForm);

	// Setup the edit button to fill the main body with a form to edit an entry
	$('#edit').on('click', setEditForm);

	// Add the button action
	$('#add_entry').on('click', addEntry);

	// Auto refresh added entry summaries regularly
	setInterval(getLatestEntrySummaries, 1000);
});
