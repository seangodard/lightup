<?php 

require_once('models/lib.php');

// --------------------------------------------------------------
// Determine if the given username has been registered.
// --------------------------------------------------------------
if (isset($_POST['check_username'])) {
	// Connect to the database and make sure the connection works before continuing
	$db = databaseConnection();
	if ($db === null) {
		// TODO : Error since can't connect to database : Sun 10 Apr 2016 10:17:03 PM EDT 
   	}

	echo json_encode(userExists($_POST['check_username'], $db));
}
