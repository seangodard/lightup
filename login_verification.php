<?php 

// Start the session
session_start();

// -----------------------------------------------------------------------
// Makes sure that the user is logged in, otherwise redirects to homepage.
// -----------------------------------------------------------------------
if (!isset($_SESSION['username'])) {
	header('Location: index.php');
	exit();
}
