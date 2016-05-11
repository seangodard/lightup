<?php 

// Start the session
session_start();

// ------------------------------------------------------------------
// Redirect users to login in if they are not already
// ------------------------------------------------------------------
@require_once('login_verification.php');

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
else {
	header('Location: /');
	exit();
}
