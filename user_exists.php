<?php 

require_once('models/users.php');

// --------------------------------------------------------------
// Determine if the given username has been registered.
// --------------------------------------------------------------
if (isset($_POST['check_username'])) {
	// Attempt to connect to the database 
	$db = databaseConnection();

	echo json_encode(userExists($_POST['check_username'], $db));
}
