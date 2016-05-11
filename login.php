<?php 

// Start the session
session_start();

require_once('models/users.php');
require_once('sessions.php');

// TODO : Make an optional button to keep the user logged in with cookies : Fri 08 Apr 2016 08:19:57 PM EDT 
// ------------------------------------------------------------------
// Attempt to login the user with the given username and password
// If there is an error then set the appropriate session data
// ------------------------------------------------------------------
if (isset($_POST['login_name']) && isset($_POST['login_pass'])) {
	// Attempt to connect to the database 
	$db = databaseConnection();

	$valid = validateCredentials($_POST['login_name'], $_POST['login_pass'], $db);

	// Setup session with the username if the users credentials have been verified
	if ($valid) {
		login(getUserId($_POST['login_name'], $db));
		header('Location: profile.php?id=' . getLoggedInUserID());
		exit();
	}
	else {
		// Set the error according to if it was an incorrect username or password
		if (!userExists($_POST['login_name'], $db)) {
			setSessionMessage('login_name', 'Username '.htmlentities($_POST['login_name'], ENT_QUOTES, 'utf-8').
				' has not yet been registered.');
		}
		else {
			setAttemptedUsername($_POST['login_name']);
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
