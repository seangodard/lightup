<?php

require_once('models/db_connection.php');

/**
 * A collection of functions for selecting and editting information
 * regarding for a registered and logged-in user.
 */

// ------------------------------------------------------------------
// Find the user_id based on username
// @param db a valid database connection
// @param username the registered and logged-in user (retrieved from session)
// -------------------------------------------------------------------
function findUserID($username, $db) {
	// Prepare the query to get the user_id
	$user_id = $db->prepare('SELECT user_id FROM users WHERE username=:username');

	// Bind the parameter to retrieve the user_id
	$user_id->bindParam(':username', $username, PDO::PARAM_STR);
	$user_id->execute();

	// Retrieve the user_id
	$user_id = $user_id->fetchAll(PDO::FETCH_ASSOC);
	return $user_id[0]['user_id'];
}

// ------------------------------------------------------------------
// Select the projects the user is a member of.
// @param db a valid database connection
// @param username the registered and logged-in user (retrieved from session)
// -------------------------------------------------------------------
function selectProjects($username, $db) {

	// Prepare the query to get the projects
	$projects = $db->prepare('SELECT project_id,project_name 
								FROM users NATURAL JOIN projects_member NATURAL JOIN projects
								WHERE user_id=:user_id');

	// Call function to retrieve user_id based on username
	$user_id = findUserID($username, $db);

	// Bind the parameters to retrieve projects
	$projects->bindParam(':user_id', $user_id, PDO::PARAM_STR);
	$projects->execute();

	// Return list of project names
	return $projects->fetchAll(PDO::FETCH_ASSOC);
}