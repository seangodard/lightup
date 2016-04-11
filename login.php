<?php 

// Start the session
session_start();

require_once('constants.php');
require_once('models/lib.php');
require_once('views/lib.php');

// TODO : Make an optional button to keep the user logged in with cookies : Fri 08 Apr 2016 08:19:57 PM EDT 
// ------------------------------------------------------------------
// Attempt to login the user with the given username and password
// If there is an error then set the appropriate session data
// ------------------------------------------------------------------
if (isset($_POST['login_name']) && isset($_POST['login_pass'])) {
	// Connect to the database and make sure the connection works before continuing
	$db = databaseConnection();
	if ($db === null) {
		// TODO : Error since can't connect to database : Sun 10 Apr 2016 10:17:03 PM EDT 
		header('Location: index.php');
		exit();
   	}

	$valid = validateCredentials($_POST['login_name'], $_POST['login_pass'], $db);

	// Setup session with the username if the user has been logged in
	if ($valid) {
		$_SESSION['username'] = $_POST['login_name'];
		header('Location: profile.php');
		exit();
	}
	else {
		// TODO : Refactor so second query isn't needed : Mon 11 Apr 2016 02:36:00 PM EDT 
		// Set the error according to if it was an incorrect username or password
		if (userExists($_POST['username'], $db)) {
			setSessionMessage('login_name', 'Username has not yet been registered.');
		}
		else {
			setSessionMessage('login_pass', 'Incorrect password.');
		}
		header('Location: index.php');
		exit();
	}
}
// Send them back to the homepage if fields were not set for an odd reason
else {
	header('Location: index.php');
	exit();
}
