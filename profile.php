<?php 

require_once('login_verification.php');
require_once('sessions.php');
require_once('models/profile.php');

$db = databaseConnection();

if (isset($_GET['id']) && (!userIDExists($_GET['id'], $db))) {
	header('Location: /profile.php?id='.getLoggedInUserID());
	exit();
}
else {
	require_once('views/profile.php');
	exit();
}
