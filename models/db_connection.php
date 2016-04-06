<?php

// ----------------------------------------------------------------------------------------------------
// Return a PDO connection
// ----------------------------------------------------------------------------------------------------
function databaseConnection() {
    
    // connection parameters
    require_once('../mysql.php');

    // Attempt connection
    try {
        $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // For development only
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        return $db;
    }
    
    // If it doesn't work
    catch (PDOException $e) {
		header('Location: view/no_connection.html');
		exit();
    }
}
// ----------------------------------------------------------------------------------------------------
