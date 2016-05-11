<?php 

// ------------------------------------------------------------------
// Redirect users to login in if they are not already
// ------------------------------------------------------------------
@require_once('login_verification.php');

require_once('sessions.php');
require_once('models/profile.php');
require_once('models/projects.php');
require_once('models/images.php');

$db = databaseConnection();

if (isset($_POST['project_id']) && isset($_POST['project_title']) && isset($_POST['project_body'])) {
	// Verify that the project title is less than 30 characters
	if (strlen( $_POST['project_title']) <= 30) {
		$result = updateProjectInfo($_POST['project_id'], $_POST['project_title'], $_POST['project_body'], 
				getLoggedInUserID(), $db);
	}

	$project_info = getProjectPageInfo($_POST['project_id'], $db); 


	$user_id = getLoggedInUserID();

	$target_dir = "views/pictures/projects/";

	if (userOrDefaultImage($_FILES['new_project_picture']['tmp_name'], $db) == 1) {
		$file = 'project' . $user_id . $_FILES['new_project_picture']['name'];
		$target_file = $target_dir . basename($file);

		$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
		$file_size = $_FILES['new_project_picture']['size'];
		$temp = $_FILES['new_project_picture']['tmp_name'];

		$valid = validImage($temp); // valid image = 1
		$exists = imageDoesNotExists($target_file); // valid file path = 1
		$size = validFileSize($file_size); // valid size = 1
		$type = validFileType($imageFileType); // valid file type = 1
		$uploadOk = success($valid, $exists, $size, $type, $db); // all errors passed = 1

		if ($uploadOk) {
			$upload = uploadSuccess($uploadOk, $temp, $target_file, $db);
			updateProjectPicture($_POST['project_id'], $target_file, $user_id, $db);
		}
	}
	else {
		$target_file = getProjectPicture($project_id, $db);
	}

	

	header('Location: project.php?id='.$_POST['project_id']);
	exit();
}
else {
	header('Location: /');
	exit();
}
