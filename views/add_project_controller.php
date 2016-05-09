<?php

// Start the session
session_start();

require_once('constants.php');
require_once('sessions.php');
require_once('models/projects.php');

$target_dir = "pictures/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// ------------------------------------------------------------
// Attempt to add the entry to the database for the logged in user
// @echo whether or not the add succeeded as a json object
// ------------------------------------------------------------
if (isset($_POST['project_name']) && isset($_POST['description'])) {
	if (strlen($_POST['project_name']) <= 30) {
		// Attempt to connect to the database 
		$db = databaseConnection();

		$target_dir .= "profiles/";
		$target_file = isset($_FILES['fileToUpload']) ? $target_dir . basename($_FILES["fileToUpload"]["name"]) : $target_dir . basename('default_project.png');

		$file_size = $_FILES["fileToUpload"]["size"];
		$temp = $_FILES["fileToUpload"]["tmp_name"];
		$valid = validImage($temp, $db); // valid image = 1
		$exists = imageDoesNotExists($target_file, $db); // valid file path = 1
		$size = validFileSize($file_size, $db); // valid size = 1
		$type = validFileType($imageFileType, $db); // valid file type = 1
		/*$result = addJournalEntry(getLoggedInUserID(), $_POST['project_id'], $_POST['title'], $_POST['body'], $db);
		echo json_encode($result);
		exit();*/
	}
	// TODO : Pass back an error on the field that the title should be less than 30 chars : Fri 06 May 2016 03:04:51 PM EDT 
	else {

	}
}
else {
	header('Location: /');
	exit();
}
