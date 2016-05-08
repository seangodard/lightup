<?php // Controller for logging out

// Responsible for ending the session
// So grab the session and destroy it

// Pieces of a session are stored in different places
session_start();

// ------------------------------------------------------------------
// Redirect users to login in if they are not already
// ------------------------------------------------------------------
@require_once('login_verification.php');

require_once('sessions.php');

// End login session
logout();
session_destroy(); // Destroy the file since stored in the hard drive [cleans it completely]

// Return to login page
header('Location: /');
exit();
