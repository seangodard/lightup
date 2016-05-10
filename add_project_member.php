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
		// add the given user_id to the project as a member only if they are a part of the members queue
		$result = addProjectMember(getLoggedInUserID(), $_POST['user_id'], $_POST['project_id'], $db);
		echo json_encode($result);
		exit();
	}
}
