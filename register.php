<?php 

require_once('constants.php');
require_once('models/lib.php');

// TODO : Set up session once logged in/ registered : Fri 08 Apr 2016 08:19:57 PM EDT 
// TODO : Note that a registered user is automatically logged in : Fri 08 Apr 2016 08:19:57 PM EDT 
// ------------------------------------------------------------------
// Attempt to register the user with the given username and password
// 	returns a JSON object of the form {stat : boolean, message : message}
// ------------------------------------------------------------------
if (isset($_POST['username']) && isset($_POST['pass'])) {
	echo json_encode(registerUser($_POST['username'], $_POST['pass']));
}
else {
	echo json_encode(array('stat' => 'false', 'message' => 'Blank entries are not allowed.'));
}
