// TODO : Check for security flaws : Fri 08 Apr 2016 08:21:26 PM EDT 
//----------------------------------------------------------------------
// A javascript file for handling login and registration AJAX requests
//----------------------------------------------------------------------
$(document).ready(function() {
	//----------------------------------------------------------------------
	// Setup for AJAX login handling
	//----------------------------------------------------------------------
	$('#login').on('click', function() {
		// TODO : This : Wed 06 Apr 2016 01:39:16 PM EDT 
	});

	// TODO : This : Wed 06 Apr 2016 01:40:10 PM EDT 
	// TODO : Add email support? : Fri 08 Apr 2016 07:54:52 PM EDT 
	// TODO : Add a limit to the maximum size of a username? : Sun 10 Apr 2016 10:02:49 AM EDT 
	//----------------------------------------------------------------------
	// Setup for AJAX registration handling
	//----------------------------------------------------------------------
	$('#register').on('click', function() {
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
						// TODO : Case where successfully registered : Sun 10 Apr 2016 01:44:28 PM EDT 
					}
					else {
						// TODO : Case where something went wrong (username taken or couldn't connect to db): Sun 10 Apr 2016 01:44:28 PM EDT 
					}
			}, 'json');
		}
	});
});
