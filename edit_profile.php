<?php 

require_once('login_verification.php');
require_once('constants.php');
require_once('sessions.php');
require_once('models/profile.php');

$db = databaseConnection();

// Checking if receiving an AJAX request for deleting
if (isset($_POST['dropSection'])) {
	$sections = explode('_', $_POST['dropSection'], 2);
	$section = $sections[0];
	$section_id = $sections[1];

	if (isset($db)) {
		if ($section === 'project')
			$delete = $db->prepare('DELETE FROM projects_member WHERE user_id=:user_id AND project_id=:section_id');
		elseif ($section === 'exp')
			$delete = $db->prepare('DELETE FROM experiences WHERE user_id=:user_id AND exp_id=:section_id');
		elseif ($section === 'skill')
			$delete = $db->prepare('DELETE FROM skills WHERE user_id=:user_id AND skill_id=:section_id');
		elseif ($section === 'hobby')
			$delete = $db->prepare('DELETE FROM hobbies WHERE user_id=:user_id AND hobby_id=:section_id');
		$delete->bindParam(':user_id', getLoggedInUserID(), PDO::PARAM_INT);
		$delete->bindParam(':section_id', $section_id, PDO::PARAM_STR);
		echo $delete->execute();
	}
	exit();
}

// Checking if receiving an AJAX request for adding input field to a certain section
if (isset($_POST['addSection'])) {
	$section = $_POST['addSection'];

	if (isset($db)) {
		$blank = '';

		if ($section === 'experiences')
			$insert = $db->prepare('INSERT INTO experiences(user_id,experience) VALUES(:user_id, :section)');
		elseif ($section === 'skills')
			$insert = $db->prepare('INSERT INTO skills(user_id,skill) VALUES(:user_id, :section)');
		if ($section === 'hobbies')
			$insert = $db->prepare('INSERT INTO hobbies(user_id,hobby) VALUES(:user_id, :section)');

		$insert->bindParam(':user_id', getLoggedInUserID(), PDO::PARAM_INT);
		$insert->bindParam(':section', $blank, PDO::PARAM_STR);
		$insert->execute();

		echo json_encode(array( "id" => $db->lastInsertId(), "user_id" => getLoggedInUserID(), $section => $blank));
	exit();
	}
}

require_once('views/edit_profile.php');