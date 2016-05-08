<?php 

require_once('login_verification.php');

require_once('constants.php');
require_once('sessions.php');
require_once('models/profile.php');

$db = databaseConnection();

foreach ($_POST as $key => $value) {
	$section = explode('_', $key, 2);

	if (isset($section[1])) {
		$section_id = $section[1];
		if (strpos($key, 'exp') !== false) {
			updateExpSkillsHobbies($value, 'experiences', $section_id, $db);
		}
		else if (strpos($key, 'skill') !== false) {
			updateExpSkillsHobbies($value, 'skills', $section_id, $db);
		}
		else if (strpos($key, 'hobby') !== false)
			updateExpSkillsHobbies($value, 'hobbies', $section_id, $db);
	}
	else {
		updateProfile($value, $key, $db);
	}
}

header('Location: profile.php');
exit();
