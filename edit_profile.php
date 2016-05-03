<?php 

require_once('login_verification.php');
require_once('constants.php');
require_once('sessions.php');
require_once('models/profile.php');

$db = databaseConnection();

// Checking if receiving an AJAX request
if (isset($_POST['dropProject'])) {
	$project_id = $_POST['dropProject'];

	if (isset($db)) {
		$delete = $db->prepare("DELETE FROM projects_member WHERE user_id=:user_id AND project_id=:project_id");
		$delete->bindParam("user_id", getLoggedInUserID(), PDO::PARAM_STR);
		$delete->bindParam("project_id", $project_id, PDO::PARAM_STR);
		echo json_encode($delete->execute());
	}
	exit();
}

require_once('views/edit_profile.php');