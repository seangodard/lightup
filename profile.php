<?php 

require_once('sessions.php');
require_once('login_verification.php');
require_once('constants.php');
require_once('sessions.php');
require_once('models/profile.php');

$db = databaseConnection();

require_once('views/profile.php');
