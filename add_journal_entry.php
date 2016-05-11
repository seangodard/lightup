<?php

// Start the session
session_start();

// ------------------------------------------------------------------
// Redirect users to login in if they are not already
// ------------------------------------------------------------------
@require_once('login_verification.php');

require_once('sessions.php');
require_once('models/projects.php');

// ------------------------------------------------------------
// Attempt to add the entry to the database for the logged in user
// @echo whether or not the add succeeded as a json object
// ------------------------------------------------------------
if (isset($_POST['project_id']) && isset($_POST['title']) && isset($_POST['body'])) {
	if (strlen($_POST['title']) <= 30) {
		// Attempt to connect to the database 
		$db = databaseConnection();

		$result = addJournalEntry(getLoggedInUserID(), $_POST['project_id'], $_POST['title'], $_POST['body'], $db);
		echo json_encode($result);
		exit();
	}
	else {

	}
}
else {
	header('Location: /');
	exit();
}
