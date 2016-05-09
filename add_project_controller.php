<?php

// Start the session
session_start();

require_once('constants.php');
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
			$file = $_FILES['fileToUpload']['name'];
			$target_file = $target_dir . basename($file);

			$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
			$file_size = $_FILES['fileToUpload']['size'];
			$temp = $_FILES['fileToUpload']['tmp_name'];

			$valid = validImage($temp, $db); // valid image = 1
			$exists = imageDoesNotExists($target_file, $db); // valid file path = 1
			$size = validFileSize($file_size, $db); // valid size = 1
			$type = validFileType($imageFileType, $db); // valid file type = 1
			$uploadOk = success($valid, $exists, $size, $type, $db); // all errors passed = 1
			
			$upload = uploadSuccess($uploadOk, $temp, $target_file, $db);
		}
		else {
			$file = 'default_project.png';
			$target_file = $target_dir . $file;
		}

		$added = addProject($_POST['project_name'], $_POST['description'], $target_file, $user_id, $db);
		if ($added == 1) {
			$project_id = getProjectID($_POST['project_name'], $db);
			header('Location: project.php?id='.$project_id);
			exit();
		}
	}
	// TODO : Pass back an error on the field that the title should be less than 30 chars : Fri 06 May 2016 03:04:51 PM EDT 
	else {

	}
}
else {
	header('Location: /');
	exit();
}