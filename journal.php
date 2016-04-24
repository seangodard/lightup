<?php 

// Start the session
session_start();

require_once('constants.php');
require_once('models/users.php');
require_once('models/projects.php');
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

	// TODO : Change to redirect to project main public page : Tue 19 Apr 2016 09:51:39 AM EDT 
	// Redirect users that are not part of the project
	if (!isMember(getLoggedInUserID($db), $project_id, $db)) {
		header('Location: profile.php');
		exit();
	}
	
	// ------------------------------------------------------------------
	// Get the project journal requested by the user to view via GET
	// 	example: /journal.php?id=1
	// ------------------------------------------------------------------
	require_once('views/journal.php');
}
// TODO : Change this to redirect to project search page : Tue 19 Apr 2016 09:50:07 AM EDT 
// Send them back to the home page
else {
	header('Location: profile.php');
	exit();
}
