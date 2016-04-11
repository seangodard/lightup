// TODO : Check for security flaws : Fri 08 Apr 2016 08:21:26 PM EDT 
//----------------------------------------------------------------------
// A javascript file for handling login and registration AJAX requests
//----------------------------------------------------------------------

// TODO : Add some sort of preventing from submitting if there are blanks : Sun 10 Apr 2016 03:23:21 PM EDT 
// TODO : Add email and first/last name fields : Fri 08 Apr 2016 07:54:52 PM EDT 
// TODO : Add a limit to the maximum size of a username? : Sun 10 Apr 2016 10:02:49 AM EDT 
//----------------------------------------------------------------------
// An AJAX function for registration handling
//----------------------------------------------------------------------
function register() {
	// Get the registration field values
	var username = $('#register_name').val();
	var pass = $('#register_pass').val();
	var confirm_pass = $('#register_cpass').val();

	var valid = true;
	// Validate that the username has more than 3 characters and the passwords match
	if (pass !== confirm_pass) {
		// TODO : Notify the user : Fri 08 Apr 2016 08:07:20 PM EDT 
		// TODO : delete this : Fri 08 Apr 2016 08:07:11 PM EDT 
		console.log('passwords do not match');
		valid = false;
	}
	if (username.length < MIN_USERNAME_LENGTH) {
		// TODO : Notify the user : Fri 08 Apr 2016 08:07:20 PM EDT 
		// TODO : delete this : Fri 08 Apr 2016 08:07:11 PM EDT 
		console.log('username too short');
		valid = false;
	}

	// If inputs are valid, try to register the user. Response format: {stat : boolean, message: message}
	if (valid) {
		$.post('register.php', 
			{username : username, pass : pass}, 
			function(response) {
				console.log(response.message);
				if (response.stat) {
					console.log('success');
					// TODO : Case where successfully registered : Sun 10 Apr 2016 01:44:28 PM EDT 
				}
				else {
					// TODO : Case where something went wrong (username taken or couldn't connect to db): Sun 10 Apr 2016 01:44:28 PM EDT 
				}
		}, 'json');
	}
}

// TODO : Add some sort of preventing from submitting if there are blanks : Sun 10 Apr 2016 03:23:21 PM EDT 
// TODO : This : Sun 10 Apr 2016 03:23:33 PM EDT 
//----------------------------------------------------------------------
// An AJAX function for login handling
//----------------------------------------------------------------------
function login() {
	// Get the Login field values
	var username = $('#login_name').val();
	var pass = $('#login_pass').val();
	// TODO : Here : Wed 06 Apr 2016 01:39:16 PM EDT 
	
	$.post('login.php', 
		{username : username, pass : pass}, 
		function(response) {
			console.log(response);
			console.log(response.message);
			if (response.stat) {
				// TODO : Case where successfully registered : Sun 10 Apr 2016 01:44:28 PM EDT 
			}
			else {
				// TODO : Case where something went wrong (username taken or couldn't connect to db): Sun 10 Apr 2016 01:44:28 PM EDT 
			}
	});
}

// TODO : Add general function for enter events and calling other functions : Sun 10 Apr 2016 05:48:49 PM EDT 
//----------------------------------------------------------------------
// Setup for AJAX after the page loads
//----------------------------------------------------------------------
$(document).ready(function() {
	//----------------------------------------------------------------------
	// Setup for AJAX login handling on all login fields on enter and for the button
	//----------------------------------------------------------------------
	$('#login').on('click', login());
	$('#login_pass').keyup(function(event) {
		if (event.keyCode == 13) {
			login();
		}
	});
	$('#login_name').keyup(function(event) {
		if (event.keyCode == 13) {
			login();
		}
	});
	
	//----------------------------------------------------------------------
	// Setup for AJAX registration handling on all login fields on enter and for the button
	//----------------------------------------------------------------------
	$('#register').on('click', register());
	$('#register_name').keyup(function(event) {
		if (event.keyCode == 13) {
			register();
		}
	});
	$('#register_pass').keyup(function(event) {
		if (event.keyCode == 13) {
			register();
		}
	});
	$('#register_cpass').keyup(function(event) {
		if (event.keyCode == 13) {
			register();
		}
	});
});
