//----------------------------------------------------------------------
// A javascript file for handling login and registration AJAX requests
//----------------------------------------------------------------------

// TODO : Add email and first/last name fields : Fri 08 Apr 2016 07:54:52 PM EDT 
// TODO : Add a limit to the maximum size of a username here and in php? : Sun 10 Apr 2016 10:02:49 AM EDT 
// TODO : Handle the event of pressing enter or leaving the field differently : Mon 11 Apr 2016 07:41:37 PM EDT 
//----------------------------------------------------------------------
// An AJAX function for registration handling
//----------------------------------------------------------------------
function validateRegister() {
	// TODO : Make this a javascript lib function : Mon 11 Apr 2016 07:43:09 PM EDT 
	// Clear any previous error reports
	$('.form_group').removeClass('has_error');
	$('.feedback_message').remove();

	// Get the registration field values
	var username = $('#register_name input').val();
	var pass = $('#register_pass input').val();
	var confirm_pass = $('#register_cpass input').val();
	
	var valid_so_far = true;
	// Validate that the username has more than 3 characters and the passwords match
	if (pass !== confirm_pass) {
		$('#register_pass').append('<span class="feedback_message">Passwords do not match.</span>');
		$('#register_pass').addClass('has_error');
		$('#register_cpass').append('<span class="feedback_message">Passwords do not match.</span>');
		$('#register_cpass').addClass('has_error');
		valid_so_far = false;
	}
	if (username.length == 0) {
		// TODO : Make these a javascript lib function : Mon 11 Apr 2016 07:43:09 PM EDT 
		$('#register_name').append('<span class="feedback_message">Username cannot be blank.</span>');
		$('#register_name').addClass('has_error');
		valid_so_far = false;
	}

	// Determine if the username is already taken 
	$.post('user_exists.php', {check_username : username},
			function(response) {
				if (response) {
					$('#register_name').append('<span class="feedback_message">Username is already taken.</span>');
					$('#register_name').addClass('has_error');
				}
				else if (valid_so_far) {
					// Send in the registration form
					$('#register_form').submit();
				}
	}, 'json');	
}

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
		$('#login_name').addclass('has_error');
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
		validateLogin();
	});
	
	//----------------------------------------------------------------------
	// Setup for AJAX registration handling 
	//----------------------------------------------------------------------
	$('#register').on('click', function(event) {
		// Delay the php event until AJAX finishes validation
		event.preventDefault();
		validateRegister();
	});
});
