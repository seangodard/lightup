<?php

// Start the session
session_start();

require_once('sessions.php');
require_once('models/projects.php');
require_once('models/users.php');

// Attempts to add the looged in user to the project members queue if they are not a member or already on it
if (isset( $_POST['project_id'])) {
	$db = databaseConnection();

	$result = addToMembersQueue(getLoggedInUserID(), $_POST['project_id'], $db);	
	echo json_encode($result);
}
else {
	header('Location: index.php');
	exit();
}
