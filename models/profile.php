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
	$rowCount = $profile->rowCount();
	return $profile->fetchAll(PDO::FETCH_ASSOC);
}

// ------------------------------------------------------------------
// Update a certain section of the user's profile
// @param db a valid database connection
// @param $data the data for a section of the profile
// @param $section the section to update
// -------------------------------------------------------------------
function updateProfile($data, $section, $db) {
	$data = escapeSingleQuotes($data);
	$query = "UPDATE profiles SET " . $section . "='" . $data . "' WHERE user_id=" . getLoggedInUserID();
	$update = $db->prepare($query);
	return $update->execute();
}

// ------------------------------------------------------------------
// Update a user's experience, skills, or hobbies
// @param db a valid database connection
// @param $data the data for a section of the profile
// @param $section the section to update
// @param $index the id of the experience, skill, or hobby
// -------------------------------------------------------------------
function updateExpSkillsHobbies($data, $section, $index, $db) {
	if ($section === 'experiences') {
		$update = $db->prepare('UPDATE experiences SET experience=:data WHERE user_id=:user_id AND exp_id=:exp_id');
		$update->bindParam(':exp_id', $index, PDO::PARAM_STR);
	}
	elseif ($section === 'skills') {
		$update = $db->prepare('UPDATE skills SET skill=:data WHERE user_id=:user_id AND skill_id=:skill_id');
		$update->bindParam(':skill_id', $index, PDO::PARAM_STR);
	}
	elseif ($section === 'hobbies') {
		$update = $db->prepare('UPDATE hobbies SET hobby=:data WHERE user_id=:user_id AND hobby_id=:hobby_id');
		$update->bindParam(':hobby_id', $index, PDO::PARAM_STR);
	}
	$update->bindParam(':data', $data, PDO::PARAM_STR);
	$update->bindParam(':user_id', getLoggedInUserID(), PDO::PARAM_STR);
	return $update->execute();
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