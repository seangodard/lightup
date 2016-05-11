<?php

// Start the session
session_start();

require_once('sessions.php');
require_once('models/projects.php');
require_once('models/users.php');

// Returns: [user_id, username]
if (isset( $_POST['project_id'])) {
	$db = databaseConnection();

	// Verify that the requesting user is a member of the project
	if (isMember(getLoggedInUserID(), $_POST['project_id'], $db)) {
		$result = getProjectMembersQueue(getLoggedInUserID(), $_POST['project_id'], $db);

		echo json_encode($result);
		exit();
	}
}
else {
	header('Location: /');
	exit();
}
