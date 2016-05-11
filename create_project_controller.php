<?php 

require_once('models/users.php');
require_once('models/projects.php');
require_once('sessions.php');
require_once('models/profile.php');
require_once('models/db_connection.php');

// ------------------------------------------------------------------
// Redirect users to login in if they are not already
// ------------------------------------------------------------------
@require_once('login_verification.php');

$db = databaseConnection();

require_once('views/create_project.php');
