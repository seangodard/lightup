<?php 

require_once('login_verification.php');
require_once('constants.php');
require_once('sessions.php');
require_once('models/profile.php');

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