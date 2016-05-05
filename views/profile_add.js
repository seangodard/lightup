//----------------------------------------------------------------------------------
// A javascript file for handling addition of items in a profile's various section
//----------------------------------------------------------------------------------
$(document).ready(function() {
	// Add			
	$('.add').on('click', function() {
		// Prevent the page from reloading to allow user to finish updating profile
		event.preventDefault();

		// Get the section to add an input to
		var section = $(this).parent().attr('id');

		// Send an AJAX request to add an input box and respond accordinly in HTML
		$.post('profile_add_box.php', {addSection:section}, function(response) {
			if (section === 'experiences') {
				var new_item = '<li id="exp_'+response.id+'">' +
							'<input type="text" name="exp_'+response.id+'" value="'+response.experiences+'"> ' +
							'<input type="image" class="drop" src="views/images/red_cross.svg" alt="drop" width="20" height="20">' +
							'</li>';
				$('#experiences ul').append(new_item);
			}
			else if (section === 'skills') {
				var new_item = '<li id="skill_'+response.id+'">' +
							'<input type="text" name="skill_'+response.id+'" value="'+response.skills+'"> ' +
							'<input type="image" class="drop" src="views/images/red_cross.svg" alt="drop" width="20" height="20">' +
							'</li>';
				$('#skills ul').append(new_item);
			}
			else if (section === 'hobbies') {
				var new_item = '<li id="hobby_'+response.id+'">' +
							'<input type="text" name="hobby_'+response.id+'" value="'+response.hobbies+'"> ' +
							'<input type="image" class="drop" src="views/images/red_cross.svg" alt="drop" width="20" height="20">' +
							'</li>';
				$('#hobbies ul').append(new_item);
			}
		}, 'json');
	});
});