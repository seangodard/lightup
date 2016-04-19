<?php 

session_start();

require_once('sessions.php');
// -----------------------------------------------------------------------
// Makes sure that the user is logged in, otherwise redirects to homepage.
// -----------------------------------------------------------------------
if (!isLoggedIn()) {
	header('Location: index.php');
	exit();
}
