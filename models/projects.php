<?php

require_once('models/db_connection.php');

/**
 * A collection of functions for accessing and manipulating the teams journal.
 * 	Note: the user needs to be a member of the projects in order to perform
 * 	any of these operations.
 */

// TODO : Debug : Sat 16 Apr 2016 11:18:35 AM EDT 
// ------------------------------------------------------------------
// A function to get the project_id based on the project name.
// @param project the project name to get the id for
// @param db a valid database connection
// @return the project_id for the project or -1 if no id exists for that project
// ------------------------------------------------------------------
function getProjectId($project, $db) {
	$get_id = $db->prepare('SELECT project_id FROM projects WHERE project_name = :project');
	$get_id->bindParam(':project', $project);
	$get_id->execute();
	$get_id = $get_id->fetch();

	if (count($get_id) > 0) { return $get_id['project_id']; }
	else { return -1; }
}

// ------------------------------------------------------------------
// A function to get the project name based on the project id.
// @param project_id the project id to get the name for
// @param db a valid database connection
// @return the project name for the project or null if no id exists for that project
// ------------------------------------------------------------------
function getProjectName($project_id, $db) {
	$get_name = $db->prepare('SELECT project_name FROM projects WHERE project_id = :project_id');
	$get_name->bindParam(':project_id', $project_id);
	$get_name->execute();
	$get_name = $get_name->fetch();

	if (count($get_name) > 0) { return $get_name['project_name']; }
	else { return -1; }
}

// ------------------------------------------------------------------
// A function that returns if the user is a member of the project.
// @param user_id the id of the user to check membership of
// @param project_id the id of the project to verify membership in
// @param db a valid database connection
// @return whether or not the user is a member of the project
// ------------------------------------------------------------------
function isMember($user_id, $project_id, $db) {
	$check_membership = $db->prepare('SELECT user_id, project_id FROM projects_member WHERE project_id = :project_id AND user_id = :user_id');
	$check_membership->bindParam(':user_id', $user_id);
	$check_membership->bindParam(':project_id', $project_id);
	$check_membership->execute();
	// TODO : using fetch versus fetch all here? : Sat 16 Apr 2016 11:23:38 AM EDT 
	$check_membership = $check_membership->fetchAll();

	if (count($check_membership) > 0) { return true; }
	else { return false; }
}

// TODO : Debug : Sat 16 Apr 2016 04:59:16 PM EDT 
// ------------------------------------------------------------------
// Retreive the sorted summaries of the teams journal which contains
// 	only the timestamp, posting user, and brief title.
// @param user_id the user_id of the user making the request
// @param project_id the id for the project the user wants entries for
// @param db a valid database connection
// @return an array with keys [entry_id, poster_username, title, entry_time, posting_user_id]
// 	or null if there are no entries or the user is not a member of the project
// ------------------------------------------------------------------
function getJournalSummaries($user_id, $project_id, $db) {
	return getJournalSummariesFollowing($user_id, $project_id, 0, $db);
}

// TODO : Debug : Sat 16 Apr 2016 04:59:16 PM EDT 
// ------------------------------------------------------------------
// Retreive the sorted summaries of the teams journal following the given timestamp
// 	in a format which contains only the timestamp, posting user, and brief title.
// @param user_id the user_id of the user making the request
// @param project_id the id for the project the user wants entries for
// @param timestamp the timestamp after which to retrieve new entry summaries
// @param db a valid database connection
// @return an array with keys [entry_id, poster_username, title, entry_time, posting_user_id]
// 	or null if there are no entries or the user is not a member of the project
// ------------------------------------------------------------------
function getJournalSummariesFollowing($user_id, $project_id, $timestamp, $db) {
	// Verify that the user is a member of the project and then retrieve journal if memeber
	if (isMember($user_id, $project_id, $db)) {
		// TODO : Speed up query : Thu 21 Apr 2016 08:26:43 PM EDT 
		$journal_summary = $db->prepare('SELECT entry_id, username as poster_username, title, entry_time, user_id as posting_user_id
												FROM 
											(SELECT entry_id, posting_user_id as user_id, title,
											entry_time FROM project_journal WHERE project_id = :project_id AND entry_time > :entry_time) as t1 
												NATURAL JOIN 
											(SELECT user_id, username FROM users) as t2 ORDER BY entry_time DESC;');
		$journal_summary->bindParam(':project_id', $project_id);
		$journal_summary->bindParam(':entry_time', $timestamp);
		$journal_summary->execute();
		$journal_summary = $journal_summary->fetchAll(PDO::FETCH_ASSOC);

		if (count($journal_summary) > 0) { return $journal_summary; }
		else { return null; }
	}
	else { return null; }
}

// ------------------------------------------------------------------
// Retreive all information on the given entry if the user is a part of
// 	project that the entry belongs to.
// @param user_id the id of the user making the request
// @param entry_id the id of the entry
// @param db a valid database connection
// @return an array containing info on the entry if it exists in the
// 	form [entry_id, username as poster_username, posting_user_id, title, body, entry_time]
// 	or null if no entry exists with that id that the user has access to
// ------------------------------------------------------------------
function getJournalEntryData($user_id, $project_id, $entry_id, $db) {
	// Verify that the user is a member of the project and then retrieve journal if memeber
	if (isMember($user_id, $project_id, $db)) {
		// TODO : Speed up query : Thu 21 Apr 2016 08:26:43 PM EDT 
		$journal_entry = $db->prepare('SELECT entry_id, username as poster_username, user_id AS posting_user_id, title, 
													body, entry_time
												FROM 
													(SELECT entry_id, posting_user_id as user_id, title, entry_time, body
													FROM project_journal WHERE project_id = :project_id AND entry_id = :entry_id) AS t1
												NATURAL JOIN 
													(SELECT user_id, username FROM users) AS t2');
		$journal_entry->bindParam(':project_id', $project_id);
		$journal_entry->bindParam(':entry_id', $entry_id);
		$journal_entry->execute();
		$journal_entry = $journal_entry->fetch(PDO::FETCH_ASSOC);

		if (count($journal_entry) > 0) { return $journal_entry; }
		else { return null; }
	}
	else { return null; }
}

// ------------------------------------------------------------------
// Attempts to add the given entry to the given project under the given
// 	user_id
// 	@param user_id the user id of the posting user
// 	@param project_id the project id the user would like to add an entry to
// 	@param title the title of the entry
// 	@param body the content of the entry
// 	@param db a valid database connection
// 	@return whether or not the entry was added to the database
// ------------------------------------------------------------------
function addJournalEntry($user_id, $project_id, $title, $body, $db) {
	// Verify that the user is a member of the project before adding the post
	if (isMember($user_id, $project_id, $db)) {
		$insert = $db->prepare('INSERT INTO project_journal(posting_user_id, project_id, title, body)
		   	values (:posting_user_id, :project_id, :title, :body)');
		$insert->bindParam(':posting_user_id', $user_id);
		$insert->bindParam(':project_id', $project_id);
		$insert->bindParam(':title', $title);
		$insert->bindParam(':body', $body);
		$insert->execute();

		if ($insert->rowCount() > 0) { return true; }
		else { return false; }	
	}
	else { return false; }	
}

// TODO : Edit an entry. Must own the entry. : Sat 16 Apr 2016 10:49:22 AM EDT 
