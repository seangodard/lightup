<?php 

// Start the session
session_start();

require_once('constants.php');
require_once('models/users.php');
require_once('models/projects.php');
require_once('sessions.php');
require_once('models/db_connection.php');

// ------------------------------------------------------------------
// Redirect users to login in if they are not already logged in
// ------------------------------------------------------------------
@require_once('login_verification.php');

// ------------------------------------------------------------------
// Redirect to the search page if the project doesn't exist but the user is logged in
// ------------------------------------------------------------------
if (isLoggedIn()) {
	// Get the project id from the GET request 
	// 	example: /journal.php?id=1
	if (isset($_GET['id'])) {
		$project_id = $_GET['id'];

		$db = databaseConnection();

		// ------------------------------------------------------------------
		// Get the project page requested by the user to view via GET
		// 	example: /project.php?id=1
		// ------------------------------------------------------------------
		if (projectIDExists($_GET['id'], $db)) {
			require_once('views/project.php');
		}
		// Send them back to the search page since the request was invalid
		else {
			header('Location: search.php');
			exit();
		}
	}
	// Send them back to the search page since the request was invalid
	else {
		header('Location: search.php');
		exit();
	}
}
// The user is not logged in send them to the homepage to log in
else {
	header('Location: /');
	exit();
}
