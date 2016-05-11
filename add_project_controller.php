<?php

// Start the session
session_start();

require_once('sessions.php');
require_once('models/projects.php');
require_once('models/images.php');

// ------------------------------------------------------------
// Attempt to add an image to the database for the logged in user
// @echo whether or not the add succeeded as a json object
// ------------------------------------------------------------
if (isset($_POST['project_name']) && isset($_POST['description'])) {
	if (strlen($_POST['project_name']) <= 30) {
		// Attempt to connect to the database 
		$db = databaseConnection();

		$user_id = getLoggedInUserID();

		$target_dir = "views/pictures/projects/";

		if (userOrDefaultImage($_FILES['fileToUpload']['tmp_name'], $db) == 1) {
			$file = 'project' . $user_id . $_FILES['fileToUpload']['name'];
			$target_file = $target_dir . basename($file);

			$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
			$file_size = $_FILES['fileToUpload']['size'];
			$temp = $_FILES['fileToUpload']['tmp_name'];

			$valid = validImage($temp); // valid image = 1
			$exists = imageDoesNotExists($target_file); // valid file path = 1
			$size = validFileSize($file_size); // valid size = 1
			$type = validFileType($imageFileType); // valid file type = 1
			$uploadOk = success($valid, $exists, $size, $type, $db); // all errors passed = 1

			if ($uploadOk) {
				$upload = uploadSuccess($uploadOk, $temp, $target_file, $db);
			}
		}
		else {
			$file = 'default_project.svg';
			$target_file = $target_dir . $file;
		}
		$added = addProject($_POST['project_name'], $_POST['description'], $target_file, $user_id, $db);
		if ($added == 1) {
			$project_id = getProjectID($_POST['project_name'], $db);
			header('Location: project.php?id='.$project_id);
			exit();
		}
	}
}
else {
	header('Location: /');
	exit();
}
