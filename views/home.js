//----------------------------------------------------------------------
// A javascript file for handling login and registration AJAX requests
//----------------------------------------------------------------------

// TODO : Refactor Copied Code : Sun 24 Apr 2016 10:18:46 PM EDT 
// TODO : Form group class needed? : Mon 25 Apr 2016 12:11:47 PM EDT 
// TODO : Add email and first/last name fields : Fri 08 Apr 2016 07:54:52 PM EDT 
// TODO : Add a limit to the maximum size of a username here and in php? : Sun 10 Apr 2016 10:02:49 AM EDT 
// TODO : Add constraint to password length : Mon 25 Apr 2016 06:16:17 PM EDT 
// TODO : Add auto focusing to html/ javascript for errors/ initial log in: Wed 27 Apr 2016 04:18:25 PM EDT 

//----------------------------------------------------------------------
// An AJAX function for registration handling
//----------------------------------------------------------------------
function validateRegister() {
	// Clear any previous error reports
	$('#register_container .form_group').removeClass('has_error');
	$('#register_container .feedback_message').remove();

	// Get the registration field values
	var username = $('#register_name input').val();
	var pass = $('#register_pass input').val();
	var confirm_pass = $('#register_cpass input').val();
	
	var valid_so_far = true;
	// Validate that the username has more than 3 characters and the passwords match
	if (pass !== confirm_pass) {
		$('#register_pass').append('<div class="feedback_message">Passwords do not match.</div>');
		$('#register_pass').addClass('has_error');
		$('#register_cpass').append('<div class="feedback_message">Passwords do not match.</div>');
		$('#register_cpass').addClass('has_error');
		valid_so_far = false;
	}
	if (username.length < 3) {
		$('#register_name').append('<div class="feedback_message">Username must be greater than 3 characters.</div>');
		$('#register_name').addClass('has_error');
		valid_so_far = false;
	}

	// Determine if the username is already taken 
	$.post('user_exists.php', {check_username : username},
			function(response) {
				if (response) {
					$('#register_name').append('<div class="feedback_message">Username is already taken.</div>');
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
	$('#login_container .form_group').removeClass('has_error');
	$('#login_container .feedback_message').remove();

	// Get the Login field values
	var username = $('#login_name input').val();
	var pass = $('#login_pass input').val();

	// Validate the username
	if (username == '') {
		$('#login_name').append('<div class="feedback_message">Username does not exist.</div>');
		$('#login_name').addClass('has_error');
	}
	else {
		// Verify that the username exists using AJAX
		$.post('user_exists.php', {check_username : username},
				function(response) {
					if (!response) {
						$('#login_name').append('<div class="feedback_message">Username does not exist.</div>');
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
// Determine if the username is already taken 
//----------------------------------------------------------------------
function checkRegisteredName() {
	// Clear any previous error reports
	$('#register_name').removeClass('has_error');
	$('#register_name .feedback_message').remove();

	var username = $('#register_name input').val();

	if (username.length < 3) {
		$('#register_name').append('<div class="feedback_message">Username must be greater than 3 characters.</div>');
		$('#register_name').addClass('has_error');
	}

	$.post('user_exists.php', {check_username : username},
			function(response) {
				if (response) {
					$('#register_name').append('<div class="feedback_message">Username is already taken.</div>');
					$('#register_name').addClass('has_error');
				}
	}, 'json');	
}

//----------------------------------------------------------------------
// Determine if the passwords match
//----------------------------------------------------------------------
function checkMatchingPasswords() {
	// Clear any previous error reports
	$('#register_pass').removeClass('has_error');
	$('#register_cpass').removeClass('has_error');
	$('#register_cpass .feedback_message').remove();

	var pass = $('#register_pass input').val();
	var confirm_pass = $('#register_cpass input').val();
	
	if (pass !== confirm_pass) {
		$('#register_pass').addClass('has_error');
		$('#register_cpass').append('<div class="feedback_message">Passwords do not match.</div>');
		$('#register_cpass').addClass('has_error');
	}
}

//----------------------------------------------------------------------
// Setup for AJAX after the page loads
//----------------------------------------------------------------------
$(document).ready(function() {
	//----------------------------------------------------------------------
	// Setup for AJAX login handling
	//----------------------------------------------------------------------
	$('#login').on('onClick', function(event) {
		// Delay the php event until AJAX finishes validation
		event.preventDefault();
		validateLogin();
	});
	
	//----------------------------------------------------------------------
	// Setup for AJAX registration handling 
	//----------------------------------------------------------------------
	$('#register_name').keyup(checkRegisteredName);
	$('#register_pass').keyup(checkMatchingPasswords);
	$('#register_cpass').keyup(checkMatchingPasswords);
	$('#register').on('click', function(event) {
		// Delay the php event until AJAX finishes validation
		event.preventDefault();
		validateRegister();
	});
});
