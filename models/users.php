<?php

require_once('models/db_connection.php');

/**
 * A collection of functions for manipulating and retreiving user information.
 */

// ------------------------------------------------------------------
// Attempt to add the given user to the database with the hashed password and a salt.
// @param db a valid database connection
// @param username the pre-checked username to attempt to register for the user
// @param password the pre-checked password to hash and store in the database
// @return true if the username was registered successfully or false if the username is taken
// -------------------------------------------------------------------
function registerUser($username, $password, $db) {
	// Check to make sure the username is not already taken 
	if (userExists($username, $db)) { return false; }

	// Salt and hash the users password with a slow cryptographic hashing function
	$hashed_pass = password_hash($password, PASSWORD_DEFAULT);

	$default_profile_picture = 'views/pictures/profiles/default_profile.jpg';
	// Bind the parameters to add the user
	$add_user = $db->prepare('INSERT INTO users(username, picture, hashed_pass) VALUES(:username, :picture, :hashed_pass)');
	$add_user->bindParam(':username', $username);
	$add_user->bindParam(':picture', $default_profile_picture);
	$add_user->bindParam(':hashed_pass', $hashed_pass);
	$add_user->execute();

	// Verify that the row was inserted to the database
	if ($add_user->rowCount() > 0) { return true; } 
	else { return false; }
}

// ------------------------------------------------------------------
// Attempt to validate the user login credentials.
// @param db a valid database connection
// @param username the username of the user
// @param pass the password of the user
// @return whether or not the given credentials are valid
// -------------------------------------------------------------------
function validateCredentials($username, $pass, $db) {
	// Get the stored hashed password
	$stored_hashed_pass = $db->prepare('SELECT hashed_pass FROM users WHERE username = :username');
	$stored_hashed_pass->bindParam(':username', $username);
	$stored_hashed_pass->execute();
	$stored_hashed_pass = $stored_hashed_pass->fetch();

	// Handle case where the username doesn't exist in the database
	if (count($stored_hashed_pass) == 0) { return false; }
   
	// Return whether or not the password matches the one that is stored 
	if (password_verify($pass, $stored_hashed_pass['hashed_pass'])) { return true; }
	else { return false; }
}

// --------------------------------------------------------------
// Determine if the given username has been registered.
// @param db a valid database connection
// @param username the username to check existance of
// @return whether or not the given username already exists
// --------------------------------------------------------------
function userExists($username, $db) {
	$check_username = $db->prepare('SELECT username FROM users WHERE username = :username');
	$check_username->bindParam(':username', $username);
	$check_username->execute();
	$check_username = $check_username->fetchAll();

	if (count($check_username) > 0) { return true; }
	else { return false; }
}

// --------------------------------------------------------------
// Determine if the given user_id has been registered.
// @param db a valid database connection
// @param user_id the user_id to check existance of
// @return whether or not the given user_id already exists
// --------------------------------------------------------------
function userIDExists($user_id, $db) {
	$check_user = $db->prepare('SELECT user_id FROM users WHERE user_id= :user_id');
	$check_user->bindParam(':user_id', $user_id);
	$check_user->execute();
	// TODO : using fetch versus fetch all here? : Sat 16 Apr 2016 11:23:38 AM EDT 
	$check_user = $check_user->fetchAll();

	if (count($check_user) > 0) { return true; }
	else { return false; }
}

// ------------------------------------------------------------------
// A function to get the user_id based on the username.
// @param username the username to get the id for
// @param db a valid database connection
// @return the user_id for the user or -1 if no id exists for that user
// ------------------------------------------------------------------
function getUserId($username, $db) {
	$get_id = $db->prepare('SELECT user_id FROM users WHERE username = :username');
	$get_id->bindParam(':username', $username);
	$get_id->execute();
	$get_id = $get_id->fetch();

	if (count($get_id) > 0) { return $get_id['user_id']; }
	else { return -1; }
}

// ------------------------------------------------------------------
// A function to get the username based on the user_id.
// @param user_id the user_id to get the username for
// @param db a valid database connection
// @return the username for the user or null if no user has that id
// ------------------------------------------------------------------
function getUsername($user_id, $db) {
	$get_username = $db->prepare('SELECT username FROM users WHERE user_id = :user_id');
	$get_username->bindParam(':user_id', $user_id);
	$get_username->execute();
	$get_username = $get_username->fetch();

	if (count($get_username) > 0) { return $get_username['username']; }
	else { return null; }
}

// ------------------------------------------------------------------
// A function to get a list usernames that match a certain pattern.
// @param pattern the pattern to match
// @param db a valid database connection
// @return the an array of usernames that match the pattern
// ------------------------------------------------------------------
function getUsersLike($pattern, $db) {
	$pattern = '%' . $pattern . '%';
	$get_username_like = $db->prepare('SELECT user_id FROM users WHERE username like :name');
	$get_username_like->bindParam(':name', $pattern);
	$get_username_like->execute();

	if ($get_username_like->rowCount() > 0) {
		return $get_username_like;
	}

	else { return null; }
}
