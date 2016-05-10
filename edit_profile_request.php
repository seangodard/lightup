<?php 

require_once('login_verification.php');

require_once('constants.php');
require_once('sessions.php');
require_once('models/profile.php');
require_once('models/images.php');

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

$user_id = getLoggedInUserID();
$target_dir = "views/pictures/profiles/";

if (userOrDefaultImage($_FILES['new_profile_picture']['tmp_name'], $db) == 1) {
	$file = $_FILES['new_profile_picture']['name'];
	$target_file = $target_dir . basename($file);

	$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
	$file_size = $_FILES['new_profile_picture']['size'];
	$temp = $_FILES['new_profile_picture']['tmp_name'];

	$valid = validImage($temp); // valid image = 1
	$exists = imageDoesNotExists($target_file); // valid file path = 1
	$size = validFileSize($file_size); // valid size = 1
	$type = validFileType($imageFileType); // valid file type = 1
	$uploadOk = success($valid, $exists, $size, $type, $db); // all errors passed = 1
	if ($uploadOk) {
		$upload = uploadSuccess($uploadOk, $temp, $target_file, $db);
	}
	else {
		$target_file = getProfilePicture($user_id, $db);
	}
	updateProfilePicture($user_id, $target_file, $db);
}

header('Location: profile.php');
exit();
