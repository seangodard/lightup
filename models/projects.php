<?php

require_once('models/db_connection.php');

/**
 * A collection of functions for accessing and manipulating the teams journal.
 * 	Note: the user needs to be a member of the projects in order to perform
 * 	any of these operations.
 */

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
// A function to get the picture filepath of a project based on the project id.
// @param project_id the project id to get the picture for
// @param db a valid database connection
// @return the filepath for the project's picture
// ------------------------------------------------------------------
function getProjectPicture($project_id, $db) {
	$get_picture = $db->prepare('SELECT picture FROM projects WHERE project_id = :project_id');
	$get_picture->bindParam(':project_id', $project_id);
	$get_picture->execute();
	$get_picture = $get_picture->fetch();

	return $get_picture['picture'];
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
	$check_membership = $check_membership->fetchAll();

	if (count($check_membership) > 0) { return true; }
	else { return false; }
}

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

// ------------------------------------------------------------
// A helper to get the project_id of the given entry
// @param entry_id the entry_id that you would like to look up
// @param db a valid database connection
// @return the project_id of the entry or null if it doesn't exist
// ------------------------------------------------------------
function getEntryProjectID($entry_id, $db) {
	$find_project_id = $db->prepare('SELECT project_id FROM project_journal WHERE entry_id = :entry_id');
	$find_project_id->bindParam(':entry_id', $entry_id);
	$find_project_id->execute();
	$find_project_id = $find_project_id->fetch(PDO::FETCH_ASSOC);

	if (count($find_project_id > 0)) { return $find_project_id['project_id']; }
	else { return null; }
}

// ------------------------------------------------------------------
// Attempts to update the given entry
// 	@param user_id the user id of the user attempting the update
// 	@param entry_id the id of the entry that the user would like to modify 
// 	@param title the updated title of the entry
// 	@param body the updated content of the entry
// 	@param db a valid database connection
// 	@return whether or not the entry was updated in the database
// ------------------------------------------------------------------
function updateJournalEntry($user_id, $entry_id, $title, $body, $db) {
	// Verify that the user is a member of the project before updating the post
	$project_id = getEntryProjectID($entry_id, $db);
	if ($project_id != null) {
		if (isMember($user_id, $project_id, $db)) {

			// Attempt to update the post
			$insert = $db->prepare('UPDATE project_journal SET title=:title, body=:body WHERE
										entry_id=:entry_id AND posting_user_id=:user_id');
			$insert->bindParam(':user_id', $user_id);
			$insert->bindParam(':entry_id', $entry_id);
			$insert->bindParam(':title', $title);
			$insert->bindParam(':body', $body);
			$insert->execute();

			if ($insert->rowCount() > 0) { return true; }
			else { return false; }	
		}
		else { return false; }	
	}
}

// ------------------------------------------------------------------
//  Retrieve a project's information
// 	@param project_id the project id the user would like to retrieve information about
// 	@param db a valid database connection
// 	@return array with project's information or null if none was found
// ------------------------------------------------------------------
function getProjectPageInfo($project_id, $db) {
	$select = $db->prepare('SELECT project_id, project_name, description FROM projects WHERE project_id=:project_id');
	$select->bindParam(':project_id', $project_id);
	$select->execute();

	$select = $select->fetch(PDO::FETCH_ASSOC);

	if (count($select) > 0) {
		return $select;
	}
	else { return null; }
}

// ------------------------------------------------------------------
//  Retrieve the members of a project
// 	@param project_id the project id the user would like to retrieve information about
// 	@param db a valid database connection
// 	@return array with members of the project or null if none was found
// ------------------------------------------------------------------
function getProjectMembers($project_id, $db) {
	$select = $db->prepare('SELECT user_id, username FROM projects_member NATURAL JOIN users WHERE project_id=:project_id');
	$select->bindParam(':project_id', $project_id);
	$select->execute();

	$select = $select->fetchAll(PDO::FETCH_ASSOC);

	if (count($select) > 0) {
		return $select;
	}
	else { return null; }
}

// ------------------------------------------------------------------
//  Update a project's information
// 	@param project_id the project id the user would like to retrieve information about
// 	@param project_name the new project name
// 	@param project_description the new project description
// 	@param db a valid database connection
// 	@return whether or not the update was successful
// ------------------------------------------------------------------
function updateProjectInfo($project_id, $project_name, $project_description, $user_id, $db) {
	if (isMember($user_id, $project_id, $db)) {
		$update = $db->prepare('UPDATE projects SET project_name=:project_name,description=:description WHERE project_id=:project_id');
		$update->bindParam(':project_name', $project_name);
		$update->bindParam(':description', $project_description);
		$update->bindParam('project_id', $project_id);
		return $update->execute();
	}
	else {
		return false;
	}
}

// ------------------------------------------------------------------
// A function to get a list project names that match a certain pattern.
// @param pattern the pattern to match
// @param db a valid database connection
// @return an array of projects that match the pattern
// ------------------------------------------------------------------
function getProjectsLike($pattern, $db) {
	$pattern = '%' . $pattern . '%';
	$get_projects_like = $db->prepare('SELECT project_id FROM projects WHERE project_name like :name');
	$get_projects_like->bindParam(':name', $pattern);
	$get_projects_like->execute();

	if ($get_projects_like->rowCount() > 0) {
		return $get_projects_like;
	}
	else { return null; }
}

// TODO : Debug : Th 5 May 2016 9:28:00 AM EDT 
// ------------------------------------------------------------------
// Add a user to a project's member queue
// @param user_id the user's id to add
// @param project_id the project to add the user to
// @param db a valid database connection
// @return an array of projects that match the pattern
// ------------------------------------------------------------------
function addToMembersQueue($user_id, $project_id, $db) {
	$insert = $db->prepare('INSERT INTO projects_member(user_id, project_id) VALUES(:user_id,:project_id)');
	$insert->bindParam(':user_id', $user_id);
	$insert->bindParam(':project_id', $project_id);

	return $insert->execute();
}

// ------------------------------------------------------------------
// Retrieve the members of a project
// @param requesting_user_id the user requesting to join a project
// @param project_id the project to check the member's of
// @param db a valid database connection
// @return an array of project members or null if none
// ------------------------------------------------------------------
function getProjectMembersQueue($requesting_user_id, $project_id, $db) {
	if (isMember($requesting_user_id, $project_id, $db)) {
		$select = $db->prepare('SELECT user_id, username FROM members_queue NATURAL JOIN users WHERE project_id=:project_id');
		$select->bindParam(':project_id', $project_id);
		$select->execute();

		$select = $select->fetchAll(PDO::FETCH_ASSOC);

		if (count($select) > 0) { return $select; }
		else { return null; }
	}
	else {
		return null;
	}
}

// TODO : Debug : Th 5 May 2016 9:48:46 AM EDT 
// ------------------------------------------------------------------
// Add a member to a project
// @param requesting_user_id the user requesting to add a member to a project
// $param user_id the user to add to the project
// @param project_id the project to add a member to
// @param db a valid database connection
// @return whether or not the user was added
// ------------------------------------------------------------------
function addProjectMember($requesting_user_id, $user_id, $project_id, $db) {
	if (isMember($requesting_user_id, $project_id, $db)) {
		$insert = $db->prepare('INSERT INTO projects_member(user_id,project_id) VALUES(:user_id,:project_id)');
		$insert->bindParam(':user_id', $user_id);
		$insert->bindParam(':project_id', $project_id);

		return $insert->execute();
	}
	return false;
}

// TODO : Debug : Sat 07 May 2016 11:29:48 AM EDT 
// --------------------------------------------------------------
// Determine if the given project_id exits in the database.
// @param project_id the project_id to check existance of
// @param db a valid database connection
// @return whether or not a project with the given project_id exists
// --------------------------------------------------------------
function projectIDExists($project_id, $db) {
	$check_project = $db->prepare('SELECT project_id FROM projects WHERE project_id=:project_id');
	$check_project->bindParam(':project_id', $project_id);
	$check_project->execute();
	$check_project = $check_project->fetchAll();

	if (count($check_project) > 0) { return true; }
	else { return false; }
}

// TODO : Debug : Sat 07 May 2016 11:29:48 AM EDT 
// --------------------------------------------------------------
// Get the description of the project.
// @param project_id the project_id to get the description for
// @param db a valid database connection
// @return the description of the project or null if the project doesn't exist
// --------------------------------------------------------------
function getProjectDescription($project_id, $db) {
	$project_desc = $db->prepare('SELECT description FROM projects WHERE project_id=:project_id');
	$project_desc->bindParam(':project_id', $project_id);
	$project_desc->execute();
	$project_description = $project_desc->fetch();

	if ($project_desc->rowCount()) { return $project_description['description']; }
	else { return null; }
}

// --------------------------------------------------------------
// Add a new project and then add the user as a member
// @param project_name the project name
// @param description the project description
// @param picture the file path of the image
// @param user_id the user adding the project
// @param db a valid database connection
// @return whether or not adding a project was successful
// --------------------------------------------------------------
function addProject($project_name, $description, $picture, $user_id, $db) {
	$insert = $db->prepare('INSERT INTO projects(project_name,description,picture) VALUES(:project_name, :description,:picture)');
	$insert->bindParam(':project_name', $project_name);
	$insert->bindParam('description', $description);
	$insert->bindParam(':picture', $picture);
	$insert->execute();

	$project_id = $db->lastInsertId();

	$insert = $db->prepare('INSERT INTO projects_member(user_id,project_id) VALUES(:user_id,:project_id)');
	$insert->bindParam(':user_id', $user_id);
	$insert->bindParam(':project_id', $project_id);

	return $insert->execute();
}