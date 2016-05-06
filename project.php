<?php 

require_once('login_verification.php');
require_once('constants.php');
require_once('sessions.php');
require_once('models/projects.php');

$db = databaseConnection();

$project_info = explode('_', $_POST['project'], 2);
$project_id = $project_info[1];

header('Location: /journal.php?id='. $project_id);
exit();