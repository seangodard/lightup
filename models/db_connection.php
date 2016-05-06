<?php

// ----------------------------------------------------------------------------------------------------
// Return a PDO connection
// ----------------------------------------------------------------------------------------------------
function databaseConnection() {
	// TODO : Change back for submission? : Fri 08 Apr 2016 10:00:21 PM EDT 
    // connection parameters
    require_once('../lightup_mysql.php');

    // Attempt connection
    try {
        $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // For development only
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        return $db;
    }
    catch (PDOException $e) {
		// TODO : Change to a no-connection to DB webpage : Mon 11 Apr 2016 10:04:16 PM EDT 
		header('Location: index.php');
		exit();
   	}
}
// ----------------------------------------------------------------------------------------------------
