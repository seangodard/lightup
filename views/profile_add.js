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
		console.log('Section:'+section);

		// Send an AJAX request to add an input box and respond accordinly in HTML
		$.post('profile_add_drop_box.php', {addSection:section}, function(response) {
			if (section === 'experiences') {
				var new_item = '<div id="exp_'+response.id+'" class="info inputRow">' +
									'<input type="image" id="exp_'+response.id+'" class="drop inputRowButton" src="views/images/minus.svg" alt="drop" width="40" height="40">' +
									'<input class="rowInput" type="text" name="exp_'+response.id+'" value="'+response.experiences+'"> '+
								'</div>';
				$('#experiences').children('#exp_add').before(new_item);
			}
			else if (section === 'skills') {
				var new_item = '<div id="skill_'+response.id+'" class="info inputRow">' +
									'<input type="image" id="skill_'+response.id+'" class="drop inputRowButton" src="views/images/minus.svg" alt="drop" width="40" height="40">' +
									'<input class="rowInput" type="text" name="skill_'+response.id+'" value="'+response.skills+'"> '+
								'</div>';
				$('#skills').children('#skill_add').before(new_item);
			}
			else if (section === 'hobbies') {
				var new_item = '<div id="hobby_'+response.id+'" class="info inputRow">' +
									'<input type="image" id="hobby_'+response.id+'" class="drop inputRowButton" src="views/images/minus.svg" alt="drop" width="40" height="40">' +
									'<input class="rowInput" type="text" name="hobby_'+response.id+'" value="'+response.hobbies+'"> '+
								'</div>';
				$('#hobbies').children('#hobby_add').before(new_item);
			}
		}, 'json');
	});
});