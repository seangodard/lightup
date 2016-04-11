<?php 

// Start the session
session_start();

// TODO : Debug : Sun 10 Apr 2016 06:29:47 PM EDT 
// -----------------------------------------------------------------------
// Makes sure that the user is logged in, otherwise redirects to homepage
// -----------------------------------------------------------------------
if (!isset($_SESSION['username'])) {
	header('Location: index.php');
	exit();
}
