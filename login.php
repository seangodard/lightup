<?php 

require_once('constants.php');
require_once('models/lib.php');

// TODO : Set up session once logged in/registered : Fri 08 Apr 2016 08:19:57 PM EDT 
// TODO : Make an optional button to keep the user logged in with cookies : Fri 08 Apr 2016 08:19:57 PM EDT 
// ------------------------------------------------------------------
// Attempt to login the user with the given username and password
// 	returns a JSON object of the form {stat : boolean, message : message}
// ------------------------------------------------------------------
if (isset($_POST['username']) && isset($_POST['pass'])) {
	echo json_encode(validateLogin($_POST['username'], $_POST['pass']));
}
else {
	echo json_encode(array('stat' => 'false', 'message' => 'Blank entries are not allowed.'));
}
