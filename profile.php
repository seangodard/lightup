<?php 

require_once('sessions.php');
require_once('login_verification.php');
require_once('constants.php');
require_once('models/profile.php');

$db = databaseConnection();

foreach ($_POST as $key => $value) {
	if (strpos($key, 'exp') !== false)
		updateExpSkillsHobbies($value, 'experiences', substr($key, -1), $db);
	else if (strpos($key, 'skill') !== false)
		updateExpSkillsHobbies($value, 'skills', substr($key, -1), $db);
	else if (strpos($key, 'hobby') !== false)
		updateExpSkillsHobbies($value, 'hobbies', substr($key, -1), $db);
	else
		updateProfile($value, $key, $db);
}

require_once('views/profile.php');
