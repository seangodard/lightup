<?php

// ----------------------------------------------------------------------------------------------------
// Return a PDO connection
// ----------------------------------------------------------------------------------------------------
function databaseConnection() {
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
		header('Location: index.php');
		exit();
   	}
}
// ----------------------------------------------------------------------------------------------------
