<?php

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
