<?php

// Start the session
session_start();

require_once('constants.php');
require_once('sessions.php');
require_once('models/projects.php');
require_once('models/users.php');

if (isset( $_POST['project_id']) && isset($_POST['user_id'])) {
	$db = databaseConnection();

	// Verify that the requesting user is a member of the project
	if (isMember(getLoggedInUserID(), $_POST['project_id'], $db)) {

		// TODO : here : Mon 09 May 2016 12:30:44 PM EDT 
		// add the given user_id to the project as a member only if they are a part of the members queue

		// Remove the user from the projects members queue



		$result = true;

		echo json_encode($result);
		exit();
	}
}
