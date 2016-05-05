//----------------------------------------------------------------------------------
// A javascript file for handling deletion of items in a profile's various section
//----------------------------------------------------------------------------------
$(document).ready(function() {
	// Delete
	$('.drop').on('click', function() {
		// Prevent the page from reloading to allow user to finish updating profile
		event.preventDefault();

		// Get the section and its id to delete
		var section = $(this).parent();
		var section_id = section.attr('id');

		console.log('Delete: ' + section_id);
		// Send an AJAX request to delete section & remove section from HTML
		$.post('profile_add_box.php', {dropSection:section_id}, function(response) {
			console.log('Response: '+response);
			if (response) {
				section.remove();
			}
		});
	});
});	