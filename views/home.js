// TODO : Check for security flaws : Fri 08 Apr 2016 08:21:26 PM EDT 
// TODO : How to remove old errors? : Mon 11 Apr 2016 11:23:40 AM EDT 
// TODO : Add error message for redirection back if anything fails : Mon 11 Apr 2016 11:37:03 AM EDT 
//----------------------------------------------------------------------
// A javascript file for handling login and registration AJAX requests
//----------------------------------------------------------------------

// TODO : Fix to use AJAX and php correctly : Sun 10 Apr 2016 09:08:36 PM EDT 
// TODO : Add some sort of preventing from submitting if there are blanks : Sun 10 Apr 2016 03:23:21 PM EDT 
// TODO : Add email and first/last name fields : Fri 08 Apr 2016 07:54:52 PM EDT 
// TODO : Add a limit to the maximum size of a username? : Sun 10 Apr 2016 10:02:49 AM EDT 
// TODO : This : Sun 10 Apr 2016 09:46:00 PM EDT 
//----------------------------------------------------------------------
// An AJAX function for registration handling
//----------------------------------------------------------------------
function validateRegister() {
	// Get the registration field values
	var username = $('#register_name').val();
	var pass = $('#register_pass').val();
	var confirm_pass = $('#register_cpass').val();

	// TODO : Add AJAX to see if the username is already taken : Sun 10 Apr 2016 09:45:25 PM EDT 

	// Validate that the username has more than 3 characters and the passwords match
	if (pass !== confirm_pass) {
		// TODO : Notify the user : Fri 08 Apr 2016 08:07:20 PM EDT 
		// TODO : delete this : Fri 08 Apr 2016 08:07:11 PM EDT 
		console.log('passwords do not match');
		return false;
	}
	if (username.length < MIN_USERNAME_LENGTH) {
		// TODO : Notify the user : Fri 08 Apr 2016 08:07:20 PM EDT 
		// TODO : delete this : Fri 08 Apr 2016 08:07:11 PM EDT 
		console.log('username too short');
		return false;
	}

	// Inputs must be valid
	return true;
}

// TODO : Here : Sun 10 Apr 2016 09:59:02 PM EDT 
// TODO : This : Sun 10 Apr 2016 03:23:33 PM EDT 
//----------------------------------------------------------------------
// An AJAX function for login validation and form submission handling
//----------------------------------------------------------------------
function validateLogin(button) {
	// Clear any previous error reports
	$('.form_group').removeClass('has_error');
	$('.feedback_message').remove();

	// Get the Login field values
	var username = $('#login_name input').val();
	var pass = $('#login_pass input').val();

	// Validate the username
	if (username == '') {
		$('#login_name').append('<span class="feedback_message">Username does not exist.</span>');
		$('#login_name').addClass('has_error');
	}
	else {
		// Verify that the username exists using AJAX
		$.post('user_exists.php', {check_username : username},
				function(response) {
					if (!response) {
						$('#login_name').append('<span class="feedback_message">Username does not exist.</span>');
						$('#login_name').addClass('has_error');
					}
					else {
						// Send in the login form
						$('#login_form').submit();
					}
		}, 'json');	
	}
}

// TODO : Fix bug of it not preventing default when not valid : Mon 11 Apr 2016 09:04:13 AM EDT 
//----------------------------------------------------------------------
// Setup for AJAX after the page loads
//----------------------------------------------------------------------
$(document).ready(function() {
	//----------------------------------------------------------------------
	// Setup for AJAX login handling
	//----------------------------------------------------------------------
	$('#login').on('click', function(event) {
		// Delay the php event until AJAX finishes validation
		event.preventDefault();
		validateLogin($(this));
	});
	
	//----------------------------------------------------------------------
	// Setup for AJAX registration handling 
	//----------------------------------------------------------------------
	$('#register').on('click', function(event) {
		if (!validateRegister()) {
			event.preventDefault();
		}
	});
});
