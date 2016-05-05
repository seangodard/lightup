<?php

// TODO : this : Wed 27 Apr 2016 04:25:10 PM EDT 

// Start the session
session_start();

require_once('constants.php');
require_once('sessions.php');
require_once('models/projects.php');

// ------------------------------------------------------------
// Attempt to add the entry to the database for the logged in user
// @echo whether or not the add succeeded as a json object
// ------------------------------------------------------------
if (isset($_POST['project_id']) && isset($_POST['title']) && isset($_POST['body'])) {
	// Attempt to connect to the database 
	$db = databaseConnection();

	// TODO : Here : Wed 27 Apr 2016 04:32:50 PM EDT 
	$result = addJournalEntry(getLoggedInUserID(), $_POST['project_id'], $_POST['title'], $_POST['body'], $db);
	echo json_encode($result);
	exit();
}
// TODO : Otherwise redirect to home page? : Wed 27 Apr 2016 04:31:06 PM EDT 
