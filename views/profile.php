<?php 

$profile_id = isset($_GET['id']) ? $_GET['id'] : getLoggedInUserID();

//------------------------------------------------------------------
// Check that a certain column is not blank for a user's profile
// @param db a valid database connection
// @param section the column to check
// -------------------------------------------------------------------
function notBlankContactAndBlurb($user_id, $section, $db) {
	if (isset(selectContactAndBlurb($user_id, $db)[$section]) && (selectContactAndBlurb($user_id, $db)[$section]) !== '')
		return true;
	return false;
}

?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Profile</title>
		<link rel="stylesheet" href="views/main.css">
		<meta name="viewport" content="width=device-width, height=device-height">
	</head>
	<body>
		<?php require_once('views/top_bar.php') ?>
		<div id="content">
			<div id="main_body">
				<div id="heading" class="profile_title">
<?php if (getLoggedInUserID() === $profile_id): ?>
					<div id="tool_bar">
						<a href="edit_profile.php"><input type="image" id="edit" src="/views/images/edit.svg" alt="edit"></a>
					</div>
<?php endif; ?>
					<h2><?php echo htmlentities(getUsername($profile_id, $db), ENT_QUOTES, 'utf-8'); ?></h2>
				</div>


				<div class="shifted_body column_layout">
					<div class="column">
						<div class="about_me left_justified area">
<?php if (notBlankContactAndBlurb($profile_id, 'blurb', $db)): ?>
							<h3>About Me</h3>
							<p class="left_justified"><?php echo htmlentities(getContactAndBlurb($profile_id, 'blurb', $db), ENT_QUOTES, 'utf-8'); ?></p>
<?php endif; ?>
						</div>

					<div id="contact_info" class="left_justified area">
<?php if ((notBlankContactAndBlurb($profile_id, 'city', $db)) || (notBlankContactAndBlurb($profile_id, 'state', $db))|| (notBlankContactAndBlurb($profile_id, 'country', $db))|| (notBlankContactAndBlurb($profile_id, 'phone', $db)) || (notBlankContactAndBlurb($profile_id, 'email', $db))): ?>
						<h3>Contact Info</h3>
<?php if (notBlankContactAndBlurb($profile_id, 'city', $db)): ?>
						<div class="medium_justified">
							City: <?php echo htmlentities(getContactAndBlurb($profile_id, 'city', $db), ENT_QUOTES, 'utf-8'); ?>
						</div>
<?php endif; ?>
<?php if (notBlankContactAndBlurb($profile_id, 'state', $db)): ?>
						<div class="medium_justified">
							State: <?php echo htmlentities(getContactAndBlurb($profile_id, 'state', $db), ENT_QUOTES, 'utf-8'); ?>
						</div>
<?php endif; ?>
<?php if (notBlankContactAndBlurb($profile_id, 'country', $db)): ?>
						<div class="medium_justified">
							Country: <?php echo htmlentities(getContactAndBlurb($profile_id, 'country', $db), ENT_QUOTES, 'utf-8'); ?>
						</div>
<?php endif; ?>
<?php if (notBlankContactAndBlurb($profile_id, 'phone', $db)): ?>
						<div class="medium_justified">
							Phone: <?php echo htmlentities(getContactAndBlurb($profile_id, 'phone', $db), ENT_QUOTES, 'utf-8'); ?>
						</div>
<?php endif; ?>
<?php if (notBlankContactAndBlurb($profile_id, 'email', $db)): ?>
						<div class="medium_justified">
							Email: <?php echo htmlentities(getContactAndBlurb($profile_id, 'email', $db), ENT_QUOTES, 'utf-8'); ?>
						</div>
<?php endif; ?>
<?php endif; ?>
					</div>
				</div>
				
					<div class="column">
						<div id="experiences" class="left_justified area">
<?php if (notBlankExpSkillsHobbies($profile_id, "experiences", $db)): ?>
							<h3>Experiences</h3>
<?php foreach ((selectExpSkillsHobbies($profile_id, "experiences", $db)) as $row): ?>
<?php if ($row['experience'] !== ''): ?>
							<div class="medium_justified" id="exp_<?php echo htmlentities($row['exp_id'], ENT_QUOTES, 'utf-8'); ?>">
								<?php echo htmlentities($row['experience'], ENT_QUOTES, 'utf-8'); ?>
							</div>
<?php endif; ?>
<?php endforeach; ?>
<?php endif; ?>
						</div>

						<div id="skills" class="left_justified area">
<?php if (notBlankExpSkillsHobbies($profile_id, "skills", $db)): ?>
							<h3>Skills</h3>
<?php foreach (selectExpSkillsHobbies($profile_id, "skills", $db) as $row): ?>
<?php if ($row['skill'] !== ''): ?>
							<div class="medium_justified" id="skill_<?php echo htmlentities($row['skill_id'], ENT_QUOTES, 'utf-8'); ?>">
								<?php echo htmlentities($row['skill'], ENT_QUOTES, 'utf-8'); ?>
							</div>
<?php endif; ?>
<?php endforeach; ?>
<?php endif; ?>
						</div>

						<div id="hobbies" class="left_justified area">
<?php if (notBlankExpSkillsHobbies($profile_id, "hobbies", $db)): ?>
							<h3>Hobbies</h3>
<?php foreach (selectExpSkillsHobbies($profile_id, "hobbies", $db) as $row): ?>
<?php if ($row['hobby'] !== ''): ?>
							<div class="medium_justified" id="hobby_<?php echo htmlentities($row['hobby_id'], ENT_QUOTES, 'utf-8'); ?>">
								<?php echo htmlentities($row['hobby'], ENT_QUOTES, 'utf-8'); ?>
							</div>
<?php endif; ?>
<?php endforeach; ?>
<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>

	<div id="sidebar">
		<div id="sidebar_content">
<?php foreach ((selectProjects($profile_id, $db)) as $row): ?>
			<div id="project_<?php echo htmlentities($row['project_id'], ENT_QUOTES, 'utf-8'); ?>">
				<a href="journal.php?id=<?php echo htmlentities($row['project_id'], ENT_QUOTES, 'utf-8'); ?>">
					<button class="projects" name="project" type="submit" value="project_<?php echo htmlentities($row['project_id'], ENT_QUOTES, 'utf-8'); ?>">
						<?php echo htmlentities($row['project_name'], ENT_QUOTES, 'utf-8'); ?>
					</button>
				</a>
			</div>
<?php endforeach; ?>
		</div>
	</div>

	</body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="views/lib.js"></script>
	<script src="views/profile.js"></script>
</html>
