<?php // Controller for logging out

require_once('sessions.php');

// Responsible for ending the session
// So grab the session and destroy it

// Pieces of a session are stored in different places
session_start();

// End login session
logout();
session_destroy(); // Destroy the file since stored in the hard drive [cleans it completely]

// Return to login page
header('Location: /');
exit();
