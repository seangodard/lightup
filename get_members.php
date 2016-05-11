<?php

// Start the session
session_start();

// ------------------------------------------------------------------
// Redirect users to login in if they are not already
// ------------------------------------------------------------------
@require_once('login_verification.php');

require_once('sessions.php');
require_once('models/projects.php');
require_once('models/users.php');

if (isset( $_POST['project_id'])) {
	$db = databaseConnection();

	$result = getProjectMembers($_POST['project_id'], $db);
	echo json_encode($result);
}
else {
	header('Location: /');
	exit();
}
