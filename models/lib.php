<?php

require_once('models/db_connection.php');

/**
 * A file to hold library functions for working with the database.
 */

// TODO : Debug again : Sun 10 Apr 2016 10:19:44 PM EDT 
// ------------------------------------------------------------------
// Attempt to add the given user to the database with the hashed password and a salt.
// @param db a valid database connection
// @param username the pre-checked username to attempt to register for the user
// @param password the pre-checked password to hash and store in the database
// @return true if the username was registered successfully or false if the username is taken
// -------------------------------------------------------------------
function registerUser($username, $password, $db) {
	$salt_length = 10;
	
	// Check to make sure the username is not already taken 
	if (userExists()) { return false; }

	// Bind the parameters to add the user
	$add_user = $db->prepare('INSERT INTO users(username, salt, password) VALUES(:username, :salt, (SELECT SHA2(:saltedpass, 512)))');
	$add_user->bindParam(':username', $username);
	$salt = getSalt($salt_length);
	$add_user->bindParam(':salt', $salt);
	$salted_pass = $salt.$password;
	$add_user->bindParam(':saltedpass', $salted_pass);
	$add_user->execute();

	// Verify that the row was inserted to the database
	if ($add_user->rowCount() > 0) { return true; } 
	else { return false; }
}

// ------------------------------------------------------------------
// @param length the length of the string to generate
// @return a random string of the given length to use as a salt
// -------------------------------------------------------------------
function getSalt($length) {
	$alphabet = 'abcdefghijklmnopqrstuvwxyABCDEFGHIJKLMNOPQRSTUVWXY';
	$salt = '';

	// Continue to choose a random letter from the alphabet
	for ($i = 0; $i < $length; $i++) {
		$salt = $salt . $alphabet[rand(0, strlen($alphabet)-1)];
	}

	return $salt;
}

// TODO : Debug again : Sun 10 Apr 2016 10:23:47 PM EDT 
// ------------------------------------------------------------------
// Attempt to validate the user login credentials.
// @param db a valid database connection
// @param username the username of the user
// @param pass the password of the user
// @return whether or not the given credentials are valid
// -------------------------------------------------------------------
function validateCredentials($username, $pass, $db) {
	// Get the salt and hashed_pass for this username
	$salt_and_hashed = $db->prepare('SELECT salt, hashed_pass FROM users WHERE username = :username');
	$salt_and_hashed->bindParam(':username', $username);
	$salt_and_hashed->execute();
	$salt_and_hashed = $salt_and_hashed->fetchAll();

	// Handle case where the username doesn't exist in the database
	if (count($salt_and_hashed) == 0) { return false; }
   
	// Store the salt and hashed_pass that were stored in the DB for this user
	$salt = $salt_and_hashed[0]['salt'];
	$stored_hashed_pass = $salt_and_hashed[0]['hashed_pass'];

	// Re-salt and hash the given pass
	$this_hashed_pass = $db->prepare('SELECT SHA2(:saltedpass, 512) as hashed_pass');
	$this_pass_salted = $salt.$pass;
	$this_hashed_pass->bindParam(':saltedpass', $this_pass_salted);
	$this_hashed_pass->execute();
	$this_hashed_pass = $this_hashed_pass->fetchAll();
	$this_hashed_pass = $this_hashed_pass[0]['hashed_pass'];

	// Return wether or not they newly hashed pass matches the one stored
	if ($this_hashed_pass === $stored_hashed_pass) { return true; }
	else { return false; }
}

// TODO : Debug : Sun 10 Apr 2016 10:02:57 PM EDT 
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
