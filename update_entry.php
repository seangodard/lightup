<?php

// Start the session
session_start();

// ------------------------------------------------------------------
// Redirect users to login in if they are not already
// ------------------------------------------------------------------
@require_once('login_verification.php');

require_once('constants.php');
require_once('sessions.php');
require_once('models/projects.php');

// ------------------------------------------------------------
// Attempt to update the entry in the database for the logged in user
// @echo whether or not the update succeeded as a json object
// ------------------------------------------------------------
if (isset($_POST['entry_id']) && isset($_POST['title']) && isset($_POST['body'])) {
	// Attempt to connect to the database 
	$db = databaseConnection();

	$result = updateJournalEntry(getLoggedInUserID(), $_POST['entry_id'], 
		$_POST['title'], $_POST['body'], $db);
	echo json_encode($result);
	exit();
}
else {
	header('Location: /');
	exit();
}
