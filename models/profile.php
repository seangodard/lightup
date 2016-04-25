<?php

require_once('models/db_connection.php');

/**
 * A collection of functions for selecting and editting information
 * regarding for a registered and logged-in user.
 */

// ------------------------------------------------------------------
// Select the projects the user is a member of.
// @param db a valid database connection
// @param username the registered and logged-in user (retrieved from session)
// -------------------------------------------------------------------
function selectProjects($user_id, $db) {
	if (!(isset($user_id))) {
		return null;
	}

	// Prepare the query to get the projects
	$projects = $db->prepare('SELECT project_id,project_name 
								FROM users NATURAL JOIN projects_member NATURAL JOIN projects
								WHERE user_id=:user_id');

	// Bind the parameters to retrieve projects
	$projects->bindParam(':user_id', $user_id, PDO::PARAM_STR);
	$projects->execute();

	// Return list of project names
	return $projects->fetchAll(PDO::FETCH_ASSOC);
}

// ------------------------------------------------------------------
// Select the username's profile blurb and contact
// @param db a valid database connection
// @param username the registered and logged-in user (retrieved from session)
// -------------------------------------------------------------------
function selectContactAndBlurb($user_id, $db) {
	if ((!(isset($user_id))) || $user_id == '') {
		return null;
	}
	
	// Prepare the query to get the user's profile
	$profile = $db->prepare('SELECT * FROM profiles WHERE user_id=:user_id');

	// Bind the parameters to retrieve projects
	$profile->bindParam(':user_id', $user_id, PDO::PARAM_STR);
	$profile->execute();
	$profile = $profile->fetchAll(PDO::FETCH_ASSOC);
	if (isset($profile[0])) {
		return $profile[0];
	}
	return null;
}

// ------------------------------------------------------------------
// Check that a certain column is not blank for a user's profile
// @param db a valid database connection
// @param section the column to check
// -------------------------------------------------------------------
function notBlankContactAndBlurb($section, $db) {
	if (isset(selectContactAndBlurb(getLoggedInUserID(), $db)[$section]) && (selectContactAndBlurb(getLoggedInUserID(), $db)[$section]) !== '')
		return true;
	return false;
}

// ------------------------------------------------------------------
// Return the data is a specified column
// @param db a valid database connection
// @param section the column to check
// -------------------------------------------------------------------
function getContactAndBlurb($section, $db) {
	return selectContactAndBlurb(getLoggedInUserID(), $db)[$section];
}

// ------------------------------------------------------------------
// Select the username's profile experiences, skills, and hobbies
// @param db a valid database connection
// @param username the registered and logged-in user (retrieved from session)
// -------------------------------------------------------------------
function selectExpSkillsHobbies($user_id, $section, $db) {
	if ((!(isset($user_id))) || $user_id == '') {
		return null;
	}
	
	// Prepare the query to get the user's profile
	if ($section === 'experiences')
		$profile = $db->prepare('SELECT * FROM profiles NATURAL JOIN experiences WHERE user_id=:user_id');
	elseif ($section === 'skills')
		$profile = $db->prepare('SELECT * FROM profiles NATURAL JOIN skills WHERE user_id=:user_id');
	elseif ($section === 'hobbies')
		$profile = $db->prepare('SELECT * FROM profiles NATURAL JOIN hobbies WHERE user_id=:user_id');

	// Bind the parameters to retrieve projects
	$profile->bindParam(':user_id', $user_id, PDO::PARAM_STR);
	$profile->execute();
	return $profile->fetchAll(PDO::FETCH_ASSOC);
}

// ------------------------------------------------------------------
// Update the user's profile blurb
// @param db a valid database connection
// @param $aboutMe the new profile blurb
// -------------------------------------------------------------------
function updateAboutMe($aboutMe, $db) {
	$aboutMe = escapeSingleQuotes($aboutMe);
	$query = "UPDATE profiles SET blurb='" . $aboutMe . "' WHERE user_id=" . getLoggedInUserID();
	if ($db->query($query) == true)
		echo 'Update successful';
	else
		echo 'Error updating';
}

// ------------------------------------------------------------------
// Escape single quotes
// @param $str the string to escape single quotes of
// -------------------------------------------------------------------
function escapeSingleQuotes($str) {
	$new_str = "";
	$str_length = strlen($str);
	for ($i = 0; $i < $str_length; $i++) {
		$char = substr($str, $i, 1);
		if ($char === "'") {
			$new_str .= "\\" . $char;
		}
		else {
			$new_str .= $char;
		}
	}
	return $new_str;
}