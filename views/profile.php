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
	</head>
	<body>
		<div class="top_bar">
			<h1>Profile Page of: <?php echo htmlentities(getUsername($profile_id, $db), ENT_QUOTES, 'utf-8'); ?></h1>
			<h1>With user id: <?php echo htmlentities($profile_id, ENT_QUOTES, 'utf-8'); ?></h1>
			<a href="../logout.php">Logout</a>
<?php if (getLoggedInUserID() === $profile_id): ?>
			<a href="edit_profile.php"><input type="image" src="views/images/settings.png" alt="settings" width="37" height="37"></a>
<?php endif; ?>
		</div>

		<div class="sidebar">
			<ul>
<?php foreach ((selectProjects($profile_id, $db)) as $row): ?>
				<li id="project_<?php echo htmlentities($row['project_id'], ENT_QUOTES, 'utf-8'); ?>">
					<form action="project.php" method="post">
						<button class="projects" name="project" type="submit" value="project_<?php echo htmlentities($row['project_id'], ENT_QUOTES, 'utf-8'); ?>">
							<?php echo htmlentities($row['project_name'], ENT_QUOTES, 'utf-8'); ?>
						</button>
					</form>
				</li>
<?php endforeach; ?>
			</ul>
		</div>

		<div class="main_body">
			<div class="about_me">
<?php if (notBlankContactAndBlurb($profile_id, 'blurb', $db)): ?>
				<h2>About Me</h2>
				<p><?php echo htmlentities(getContactAndBlurb($profile_id, 'blurb', $db), ENT_QUOTES, 'utf-8'); ?></p>
<?php endif; ?>
			</div>

			<div id="contact_info">
<?php if ((notBlankContactAndBlurb($profile_id, 'city', $db)) || (notBlankContactAndBlurb($profile_id, 'state', $db))|| (notBlankContactAndBlurb($profile_id, 'country', $db))|| (notBlankContactAndBlurb($profile_id, 'phone', $db)) || (notBlankContactAndBlurb($profile_id, 'email', $db))): ?>
				<h2>Contact Info</h2>
				<ul>
<?php if (notBlankContactAndBlurb($profile_id, 'city', $db)): ?>
					<li>
						City: <?php echo htmlentities(getContactAndBlurb($profile_id, 'city', $db), ENT_QUOTES, 'utf-8'); ?>
					</li>
<?php endif; ?>
<?php if (notBlankContactAndBlurb($profile_id, 'state', $db)): ?>
					<li>
						State: <?php echo htmlentities(getContactAndBlurb($profile_id, 'state', $db), ENT_QUOTES, 'utf-8'); ?>
					</li>
<?php endif; ?>
<?php if (notBlankContactAndBlurb($profile_id, 'country', $db)): ?>
					<li>
						Country: <?php echo htmlentities(getContactAndBlurb($profile_id, 'country', $db), ENT_QUOTES, 'utf-8'); ?>
					</li>
<?php endif; ?>
<?php if (notBlankContactAndBlurb($profile_id, 'phone', $db)): ?>
					<li>
						Phone: <?php echo htmlentities(getContactAndBlurb($profile_id, 'phone', $db), ENT_QUOTES, 'utf-8'); ?>
					</li>
<?php endif; ?>
<?php if (notBlankContactAndBlurb($profile_id, 'email', $db)): ?>
					<li>
						Email: <?php echo htmlentities(getContactAndBlurb($profile_id, 'email', $db), ENT_QUOTES, 'utf-8'); ?>
					</li>
<?php endif; ?>
				</ul>
<?php endif; ?>
			</div>

			<div id="experiences">
<?php if (notBlankExpSkillsHobbies($profile_id, "experiences", $db)): ?>
				<h2>Experiences</h2>
				<ul>
<?php foreach ((selectExpSkillsHobbies($profile_id, "experiences", $db)) as $row): ?>
<?php if ($row['experience'] !== ''): ?>
					<li id="exp_<?php echo htmlentities($row['exp_id'], ENT_QUOTES, 'utf-8'); ?>">
						<?php echo htmlentities($row['experience'], ENT_QUOTES, 'utf-8'); ?>
					</li>
<?php endif; ?>
<?php endforeach; ?>
				</ul>
<?php endif; ?>
			</div>

			<div id="skills">
<?php if (notBlankExpSkillsHobbies($profile_id, "skills", $db)): ?>
				<h2>Skills</h2>
				<ul>
<?php foreach (selectExpSkillsHobbies($profile_id, "skills", $db) as $row): ?>
<?php if ($row['skill'] !== ''): ?>
					<li id="skill_<?php echo htmlentities($row['skill_id'], ENT_QUOTES, 'utf-8'); ?>">
						<?php echo htmlentities($row['skill'], ENT_QUOTES, 'utf-8'); ?>
					</li>
<?php endif; ?>
<?php endforeach; ?>
				</ul>
<?php endif; ?>
			</div>

			<div id="hobbies">
<?php if (notBlankExpSkillsHobbies($profile_id, "hobbies", $db)): ?>
				<h2>Hobbies</h2>
				<ul>
<?php foreach (selectExpSkillsHobbies($profile_id, "hobbies", $db) as $row): ?>
<?php if ($row['hobby'] !== ''): ?>
					<li id="hobby_<?php echo htmlentities($row['hobby_id'], ENT_QUOTES, 'utf-8'); ?>">
						<?php echo htmlentities($row['hobby'], ENT_QUOTES, 'utf-8'); ?>
					</li>
<?php endif; ?>
<?php endforeach; ?>
				</ul>
<?php endif; ?>
			</div>
		</div>
	</body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="views/lib.js"></script>
	<script src="views/profile.js"></script>
</html>
