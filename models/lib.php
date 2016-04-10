<?php
require_once('models/db_connection.php');

/**
 * A file to hold library functions for working with the database.
 */

// ------------------------------------------------------------------
// Attempt to add the given user to the database with the hashed password and a salt
// @param username the username to attempt to register for the user
// @param password the password to hash and store in the database
// @return an array of the form {stat => boolean, message => message} 
// -------------------------------------------------------------------
function registerUser($username, $password) {
	$salt_length = 10;
	// Connect to the database and make sure the connection works before continuing
	$db = databaseConnection();
	if ($db === null) { return array('stat' => false, 'message' => 'Could not connect to the database'); }

	// Make sure that the username is the correct length
	if (strlen($_POST['username']) < MIN_USERNAME_LENGTH) {
		return array('stat'=> 'false', 'message' => 'Username taken');
	}

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
