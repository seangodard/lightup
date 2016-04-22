<?php 

require_once('sessions.php');
require_once('login_verification.php');
require_once('constants.php');
require_once('models/profile.php');

$db = databaseConnection();

if (isset($_POST['aboutMe'])) {
	updateAboutMe($_POST['aboutMe'], $db);
}

require_once('views/profile.php');
