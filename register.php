<?php 

// Start the session
session_start();

require_once('constants.php');
require_once('models/register_login.php');
require_once('views/sessions.php');

// ------------------------------------------------------------------
// Attempt to register the user with the given username and password,
// 	redirects to profile if successful
// ------------------------------------------------------------------
if (isset($_POST['register_name']) && isset($_POST['register_pass'])) {
	// Attempt to connect to the database 
	$db = databaseConnection();

	$result = registerUser($_POST['register_name'], $_POST['register_pass'], $db);

	// Setup session if the user has been logged in
	// If the username is set then we know that the user is logged in
	if ($result) {
		login($_POST['register_name']);
		header('Location: profile.php');
		exit();
	}
	else {
		setSessionMessage('register_name', 'Username is already taken.');
		header('Location: index.php');
		exit();
	}
}
else {
	header('Location: index.php');
	exit();
}
