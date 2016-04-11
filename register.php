<?php 

// Start the session
session_start();

require_once('constants.php');
require_once('models/lib.php');

// TODO : Perform better field validation here : Sun 10 Apr 2016 10:24:16 PM EDT 

// TODO : This : Sun 10 Apr 2016 10:28:53 PM EDT 
// TODO : Debug again : Sun 10 Apr 2016 10:28:57 PM EDT 
// TODO : Set up session once logged in/ registered : Fri 08 Apr 2016 08:19:57 PM EDT 
// TODO : Note that a registered user is automatically logged in : Fri 08 Apr 2016 08:19:57 PM EDT 
// ------------------------------------------------------------------
// Attempt to register the user with the given username and password
// 	returns a JSON object of the form {stat : boolean, message : message}
// ------------------------------------------------------------------
if (isset($_POST['register_name']) && isset($_POST['register_pass'])) {
	$result = registerUser($_POST['register_name'], $_POST['register_pass']);

	// TODO : Fix redirect not working : Sun 10 Apr 2016 06:40:43 PM EDT 
	// Setup session if the user has been logged in
	// If the username is set then we know that the user is logged in
	if ($result['stat'] == true) {
		$_SESSION['username'] = $_POST['register_name'];
		header('Location: profile.php');
		exit();
	}
	else {
		header('Location: index.php');
		echo json_encode($result);
		exit();
	}
}
else {
	header('Location: index.php');
	echo json_encode(array('stat' => false, 'message' => 'Blank entries are not allowed.'));
	exit();
}
