$(document).ready(function() {
	// Setup AJAX on each of the buttons so that clicking them opens the full text
	$('.entry_summary').on('click', function() {
		// Get the project_id and the entry_id
		var project_id = $('#project_id').attr('value');
		var entry_id = $(this).children('input').attr('value');

		// TODO : Here : Thu 21 Apr 2016 09:00:18 PM EDT 
		// TODO : Have the journal entry show an add form if there are no entries being shown : Thu 21 Apr 2016 09:30:12 PM EDT 
		// Send in the request to get the entry data
		$.post('get_entry.php', {project_id : project_id, entry_id : entry_id}, function(response) {
			// Make sure that the entry was retrieved properly (should be an empty object if not allowed/non-existant)
			if (response){
				// empty out the body of its current content
				$('#main_body').empty();

				// TODO : Finish this up : Sun 24 Apr 2016 10:15:45 AM EDT 
				// display the entry content with the posting users profile picture and link to their profile
				$('#main_body').append('<h2>'+response.title+'</h2>');
				$('#main_body').append('<h3><a href=/profile.php?id='+
					response.posting_user_id+'>'+response.poster_username+'</a> '+response.entry_time+'</h3>');
				$('#main_body').append('<section>'+response.body+'</section>');
				$('#main_body').append('<input type="hidden" value="'+response.entry_id+'">');
			}
			else {
				// Fill in the space with an error if something went wrong
				$('#main_body').empty();
				$('#main_body').append('<h2>Something went wrong with your request!</h2>');
			}
		}, 'json');
	});
});
