<?php 

require_once('login_verification.php');
require_once('constants.php');
require_once('sessions.php');
require_once('models/profile.php');
require_once('models/projects.php');

$db = databaseConnection();

if (isset($_POST['project_id']) && isset($_POST['project_title']) && isset($_POST['project_body'])) {
	// Verify that the project title is less than 30 characters
	if (strlen( $_POST['project_title']) <= 30) {
		$result = updateProjectInfo($_POST['project_id'], $_POST['project_title'], $_POST['project_body'], 
				getLoggedInUserID(), $db);
	}

	$project_info = getProjectPageInfo($_POST['project_id'], $db); 
	echo json_encode($project_info);
}
else {
	header('Location: /');
	exit();
}
