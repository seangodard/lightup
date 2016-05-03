//----------------------------------------------------------------------
// A javascript file for handling journal entry retrieval and adding of
// 	entries
//----------------------------------------------------------------------

// TODO : This : Mon 25 Apr 2016 06:57:52 PM EDT 
//----------------------------------------------------------------------
// Set up the journal summary buttons to retrieve and fill in the body
// 	below the project title
//----------------------------------------------------------------------
function entryRetrieval() {
	// Get the project_id and the entry_id
	var project_id = $('#project_id').attr('value');
	var entry_id = $(this).children('.entry_id').attr('value');
	var posting_user_id = $(this).children('.entry_user_id').attr('value');

	// TODO : Only allow the owner to edit the entry in the php : Wed 27 Apr 2016 10:51:45 AM EDT 
	// Set the toolbar to have an add button and an edit if the logged in user is the owner
	// TODO : How to find out if this is the owner by using session data that is not accessible by the user...? : Wed 27 Apr 2016 11:04:56 AM EDT 
	
	// Remove old entry or add form 
	$('#add_form').remove();
	$('#full_entry').remove();

	// Send in the request to get the entry data; show add form if none returned
	$.post('get_entry.php', {project_id : project_id, entry_id : entry_id}, function(response) {
		// Make sure that the entry was retrieved properly (should be an empty object if not allowed/non-existent)
		if (response){

			// display the entry content with the posting users profile link 
			$('#main_body').append(
				'<div id="full_entry">'
					+'<h3>'+response.title+'</h3>'
					+'<h4><a href=/profile.php?id='
						+response.posting_user_id+'>'+response.poster_username+'</a> '+response.entry_time+'</h4>'
					+'<section>'+response.body+'</section>'
					+'<input type="hidden" value="'+response.entry_id+'">'
				+'</div>'
			);

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
	// Remove old entry or add forms 
	$('#add_form').remove();
	$('#full_entry').remove();

	// Remove the tools from the toolbar
	$('#tool_bar').empty();

	// Show the form in the form
	$('#main_body').append(
			'<div id="add_form">'
				+'<div class=".formgroup">'
					+'<input type="text" placeholder="Title" id="entry_title" name="entry_title">'
				+'</div>'
				+'<textarea id="entry_body"></textarea>'
				+'<input type="submit" id="add_entry" value="Done">'
			+'</div>'
		+'</div>');

	// Enable the add action
	$('#add_entry').on('click', addEntry);
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
	
	// Attempt to add the journal entry 
	$.post('add_journal_entry.php', {project_id : project_id, title : entry_title, body : entry_body},
			function(response) {
				// Notify the user that the post was added and then clear out the fields
				if (response) {
					// TODO : Notify the user that the entry was added : Thu 28 Apr 2016 03:18:12 PM EDT 

					// Refresh the latest journal summaries
					getLatestEntrySummaries();
					
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
	var last_timestamp = $('#sidebar_content').children().first().children('.timestamp').text();

	// Request the latest entries
	if (last_timestamp != null && project_id != null) {
		$.post('get_entry_summaries.php', {project_id : project_id, timestamp : last_timestamp}, function(response) {
			console.log(response);
			
			// For each new summary create and add the button to the top of the list in the correct order
			$.each(response.reverse(), function() {
				console.log(this);
				var new_summary_button = $('<button class="entry_summary">'
											+'<input type="hidden" class="entry_id" value="'+this.entry_id+'">'
											+'<input type="hidden" class="entry_user_id" value="'+this.posting_user_id+'">'
											+'<div>'+this.title+' -- '+this.poster_username+'</div>'
											+'<div class="timestamp">'+this.entry_time+'</div>'
										+'</button>');

				// Add the listener to the new button 
				new_summary_button.on('click', entryRetrieval);

				// Add the button to the sidebar
				$('#sidebar_content').prepend(new_summary_button);
			});
		}, 'json');
	}
}

// TODO : Add a way for scrolling to load ~15 messages older than the last one and append to the list : Thu 28 Apr 2016 03:50:52 PM EDT 
// TODO : Only start with 15 loaded : Thu 28 Apr 2016 03:50:52 PM EDT 

//----------------------------------------------------------------------
// Set up the buttons for when the document finishes loading
//----------------------------------------------------------------------
$(document).ready(function() {
	// Setup AJAX on each of the buttons so that clicking them opens the full text
	$('.entry_summary').on('click', entryRetrieval);

	// Setup the add button to fill the main body with a form to add an entry
	$('#add').on('click', setAddForm);

	// Add the button action
	$('#add_entry').on('click', addEntry);

	// Auto refresh added entry summaries regularly
	setInterval(getLatestEntrySummaries, 1000);
});
