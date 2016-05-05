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

		// Send an AJAX request to delete section & remove section from HTML
		$.post('edit_profile.php', {dropSection:section_id}, function(response) {
			if (response) {
				section.remove();
			}
		});
	});
});	