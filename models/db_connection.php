<?php

// ----------------------------------------------------------------------------------------------------
// Return a PDO connection
// ----------------------------------------------------------------------------------------------------
function databaseConnection() {
    // connection parameters
	// TODO : Change back for submission? : Fri 08 Apr 2016 10:00:21 PM EDT 
    require_once('../lightup_mysql.php');

    // Attempt connection
    try {
        $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // For development only
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        return $db;
    }
	// TODO : What to do if it could not connect to the database? : Fri 08 Apr 2016 08:43:44 PM EDT 
    catch (PDOException $e) {
		return null;
    }
}
// ----------------------------------------------------------------------------------------------------
