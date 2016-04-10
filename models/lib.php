<?php
require_once('models/db_connection.php');

/**
 * A file to hold library functions for working with the database.
 */

// ------------------------------------------------------------------
// Attempt to add the given user to the database with the hashed password and a salt.
// @param username the username to attempt to register for the user
// @param password the password to hash and store in the database
// @return an array of the form {stat => boolean, message => message} where stat is whether
// 	the function succeeded
// -------------------------------------------------------------------
function registerUser($username, $password) {
	$salt_length = 10;
	// Connect to the database and make sure the connection works before continuing
	$db = databaseConnection();
	if ($db === null) { return array('stat' => 'false', 'message' => 'Could not connect to the database'); }

	// Make sure that the username is the correct length
	if (strlen($_POST['username']) < MIN_USERNAME_LENGTH) {
		return array('stat'=> 'false', 'message' => 'Username taken');
	}

	// TODO : Add checks to double check that username and pass are not blank : Sun 10 Apr 2016 03:33:19 PM EDT 

	// Check to make sure the username is not already taken 
	$check_username = $db->prepare('SELECT username FROM users WHERE username = :username');
	$check_username->bindParam(':username', $username);
	$check_username->execute();
	$check_username = $check_username->fetchAll();
	if (count($check_username) > 0) {
		return array('stat'=> 'false', 'message' => 'Username taken');
	}

	// Bind the parameters to add the user
	$add_user = $db->prepare('INSERT INTO users(username, salt, password) VALUES(:username, :salt, (SELECT SHA2(:saltedpass, 512)))');
	$add_user->bindParam(':username', $username);
	$salt = getSalt($salt_length);
	$add_user->bindParam(':salt', $salt);
	$salted_pass = $salt.$password;
	$add_user->bindParam(':saltedpass', $salted_pass);
	$add_user->execute();

	// Verify that the row was inserted to the database
	if ($add_user->rowCount() > 0) {
		return array('stat'=> 'true', 'message' => 'User successfully registered.'); 
	}
	else { return array('stat'=> 'false', 'message' => 'Could not register the user.'); }
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

// ------------------------------------------------------------------
// Attempt to validate the user login credentials.
// @param username the username of the user
// @param pass the password of the user
// @return an array of the form {stat => boolean, message => message} where stat is whether
// 	the function succeeded
// -------------------------------------------------------------------
function validateLogin($username, $pass) {
	// Connect to the database and make sure the connection works before continuing
	$db = databaseConnection();
	if ($db === null) { return array('stat' => 'false', 'message' => 'Could not connect to the database'); }

	// TODO : Add checks to make sure that username and pass are not blank : Sun 10 Apr 2016 03:33:41 PM EDT 
	
	// Get the salt and hashed_pass for this username
	$salt_and_hashed = $db->prepare('SELECT salt, hashed_pass FROM users WHERE username = :username');
	$salt_and_hashed->bindParam(':username', $username);
	$salt_and_hashed->execute();
	$salt_and_hashed = $salt_and_hashed->fetchAll();

	// Handle case where the username doesn't exist in the database
	if (count($salt_and_hashed) == 0) {
		return array('stat' => 'false', 'message' => 'No user with the given username.');
	}
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
	if ($this_hashed_pass === $stored_hashed_pass) {
		return array('stat' => 'true', 'message' => 'Correct password.');
	}
	else {
		return array('stat' => 'false', 'message' => 'Incorrect password.');
	}
}
