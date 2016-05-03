<?php 

// Start the session
session_start();

require_once('constants.php');
require_once('sessions.php');
require_once('models/projects.php');

// ------------------------------------------------------------
// Attempts to retrieve all the information for the journal entry
// ------------------------------------------------------------
if (isset($_POST['project_id']) && isset($_POST['entry_id'])) {
	// Attempt to connect to the database 
	$db = databaseConnection();

	// Attempt to retrieve the entry info and encode it in JSON
	$result = getJournalEntryData(getLoggedInUserID(), $_POST['project_id'], $_POST['entry_id'], $db);
	if ($result == null) { echo json_encode(json_decode("{}")); }
	else { 
		// Escape each entry of the array before passing it back as json
		foreach($result as $key => $value) { $result[$key] = htmlentities($value, ENT_QUOTES, 'utf-8'); } 
		echo json_encode($result); 
	}
}
// TODO : Otherwise redirect to home page? : Wed 27 Apr 2016 04:31:06 PM EDT 

