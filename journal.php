<?php 

// Start the session
session_start();

require_once('constants.php');
require_once('models/users.php');
require_once('models/projects.php');
require_once('models/profile.php');
require_once('sessions.php');
require_once('models/db_connection.php');

// ------------------------------------------------------------------
// Redirect users to login in if they are not already
// ------------------------------------------------------------------
@require_once('login_verification.php');

// ------------------------------------------------------------------
// Redirect users to the projects main page if they are not a member
// ------------------------------------------------------------------
// Get the project id from the GET request 
// 	example: /journal.php?id=1
if (isset($_GET['id'])) {
	$project_id = $_GET['id'];

	$db = databaseConnection();

	// Redirect users that are not part of the project to the project main page
	if (!isMember(getLoggedInUserID($db), $project_id, $db)) {
		header('Location: project.php?id='.$project_id);
		exit();
	}
	
	// ------------------------------------------------------------------
	// Get the project journal requested by the user to view via GET
	// 	example: /journal.php?id=1
	// ------------------------------------------------------------------
	require_once('views/journal.php');
}
// Send them back to the home page
else {
	header('Location: profile.php');
	exit();
}
