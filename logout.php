<?php // Controller for logging out

// Responsible for ending the session
// So grab the session and destroy it

// Pieces of a sessiona re stored in different places
session_start();

// End login session
$_SESSION = array(); // Assigning it to an empty array, destroys it
setcookie(session_name(), FALSE); // Delete the cookie for the session
session_destroy(); // Destroy the file since stored in the hard drive [cleans it completely]

// Return to login page
header('Location: ./');
exit();