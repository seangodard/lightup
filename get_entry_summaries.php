<?php 

// TODO : Do a check of what happens when these controllers are navigated to : Thu 28 Apr 2016 03:30:36 PM EDT 

// Start the session
session_start();

require_once('constants.php');
require_once('sessions.php');
require_once('models/projects.php');

// Retrieve all entry summaries with the timestamp greater than the one given
if (isset($_POST['project_id']) && isset($_POST['timestamp'])) {
	// Attempt to connect to the database 
	$db = databaseConnection();

	$result = getJournalSummariesFollowing(getLoggedInUserID(), $_POST['project_id'], $_POST['timestamp'], $db );
	if ($result !== null) {
		// Escape each entry summary before passing it back as json
		foreach($result as $key => $row) { 
			foreach($row as $attribute => $value) {
				$row[$attribute] = htmlentities($value, ENT_QUOTES, 'utf-8'); 
			}
		} 
		echo json_encode($result); 
	}
}
// TODO : Otherwise redirect to home page? : Wed 27 Apr 2016 04:31:06 PM EDT 
