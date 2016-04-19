<?php 

// Start up sessions
session_start();

require_once('sessions.php');

// Redirect the user to their profile page if they are already signed in 
if (isLoggedIn()) {
	header('Location: profile.php');
	exit();
}

require_once('constants.php');
require_once('sessions.php');
require_once('views/home.php');
