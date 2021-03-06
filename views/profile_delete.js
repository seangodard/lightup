//----------------------------------------------------------------------------------
// A javascript file for handling deletion of items in a profile's various section
//----------------------------------------------------------------------------------
$(document).ready(function() {
	// Delete
	$('.drop').on('click', function() {
		// Prevent the page from reloading to allow user to finish updating profile
		event.preventDefault();

		var section = $(this).parent();
		var section_id = section.attr('id');
		
		// Send an AJAX request to delete section & remove section from HTML
		$.post('profile_add_drop_box.php', {dropSection:section_id}, function(response) {
			console.log('Response: '+response);
			if (response) {
				section.remove();
			}
		});
	});
});	