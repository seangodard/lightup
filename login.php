<?php 

// Start the session
session_start();

require_once('constants.php');
require_once('models/lib.php');

// TODO : Perform better field validation here : Sun 10 Apr 2016 10:24:16 PM EDT 

// TODO : Here : Sun 10 Apr 2016 10:34:26 PM EDT 

// TODO : This : Sun 10 Apr 2016 10:28:53 PM EDT 
// TODO : Debug again : Sun 10 Apr 2016 10:28:57 PM EDT 
// TODO : Set up session once logged in/registered : Fri 08 Apr 2016 08:19:57 PM EDT 
// TODO : Make an optional button to keep the user logged in with cookies : Fri 08 Apr 2016 08:19:57 PM EDT 
// ------------------------------------------------------------------
// Attempt to login the user with the given username and password
// 	returns a JSON object of the form {stat : boolean, message : message}
// ------------------------------------------------------------------
if (isset($_POST['login_name']) && isset($_POST['login_pass'])) {
	// Connect to the database and make sure the connection works before continuing
	$db = databaseConnection();
	if ($db === null) {
		// TODO : Error since can't connect to database : Sun 10 Apr 2016 10:17:03 PM EDT 
   	}

	$valid = validateCredentials($_POST['login_name'], $_POST['login_pass'], $db);

	// Setup session with the username if the user has been logged in
	if ($valid) {
		$_SESSION['username'] = $_POST['login_name'];
		header('Location: profile.php');
		exit();
	}
	else {
		// TODO : Error since the credentials were invalid : Sun 10 Apr 2016 10:17:03 PM EDT 

	}
}
else {
	// TODO : Error since a field was not filled : Sun 10 Apr 2016 10:17:03 PM EDT 
}
