<?php

require_once('models/users.php');

// Note: Returned data does not have html escaped

// -----------------------------------------------------------------
// @return whether or not a user is currently logged in
// -----------------------------------------------------------------
function isLoggedIn() {
	return isset($_SESSION['user_id']);
}

// -----------------------------------------------------------------
// @return the logged in username or null if no user is logged in
// -----------------------------------------------------------------
function getLoggedInUsername($db) {
	if (isset($_SESSION['user_id'])) { return getUsername($_SESSION['user_id'], $db); }
	else { return null; }
}

// -----------------------------------------------------------------
// @return the user_id of the logged in user
// -----------------------------------------------------------------
function getLoggedInUserID() {
	if (isset($_SESSION['user_id'])) {
		return $_SESSION['user_id'];
	}
	return null;
}

// -----------------------------------------------------------------
// Set the session information for user.
// Requires that the user has first been validated!
// -----------------------------------------------------------------
function login($user_id) {
	session_regenerate_id(true); // Create a new session for login
	$_SESSION['user_id'] = $user_id;
}

// -----------------------------------------------------------------
// Removes the session username (if one is set) so we know the user
// is no longer logged in.
// -----------------------------------------------------------------
function logout() {
	if (isset($_SESSION['user_id'])) {
		unset($_SESSION['user_id']);
	}
}

// -----------------------------------------------------------------
// Sets a message in the session for the particular html id
// @param tag_id the html id that the message pertains to
// @param message the message for the id
// -----------------------------------------------------------------
function setSessionMessage($tag_id, $message) {
	$_SESSION['message'] = array('id' => $tag_id, 'message' => $message);
}

// -----------------------------------------------------------------
// @param tag_id the message tag id
// @return if the given html id has a message
// -----------------------------------------------------------------
function hasMessage($tag_id) {
	if (isset($_SESSION['message'])) {
		if ($_SESSION['message']['id'] == $tag_id) {
			return true;
		}
	}
	else return false;
}

// -----------------------------------------------------------------
// Get any session messages applying to the field and clear the message
// @param tag_id the message tag id
// @return the message for the html with the given id or '' if there is none
// -----------------------------------------------------------------
function getMessage($tag_id) {
	if (isset($_SESSION['message'])) {
		if ($_SESSION['message']['id'] == $tag_id) {
			$message = $_SESSION['message']['message'];
			unset($_SESSION['message']);
			return $message;
		}
	}
	else return '';
}

// -----------------------------------------------------------------
// Get any session messages applying to the field wrapped in a span 
// and clear the message
// @param tag_id the message tag id
// @return the message for the id wrapped in a span of class feedback_message
// -----------------------------------------------------------------
function getFeedbackMessage($tag_id) {
	return '<span class="feedback_message">'.getMessage($tag_id).'</span>';
}
