<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Profile</title>
	</head>
	<body>
		<div class="top_bar">
			<h1>Profile Page of: <?php echo htmlentities(getLoggedInUsername($db), ENT_QUOTES, 'utf-8'); ?></h1>
			<h1>With user id: <?php echo htmlentities(getLoggedInUserID(), ENT_QUOTES, 'utf-8'); ?></h1>
			<a href="../logout.php">Logout</a>
			<form action="edit_profile.php"><input type="image" src="views/images/settings.png" alt="settings" width="37" height="37"></form>
		</div>

		<div class="sidebar">
			<ul>
<?php foreach ((selectProjects(getLoggedInUserID(), $db)) as $row): ?>
				<li id="<?php echo htmlentities($row['project_id'], ENT_QUOTES, 'utf-8'); ?>">
					<form action="project.php" method="post">
						<button class="projects" name="project" type="submit" value="<?php echo htmlentities($row['project_id'], ENT_QUOTES, 'utf-8'); ?>">
							<?php echo htmlentities($row['project_name'], ENT_QUOTES, 'utf-8'); ?>
						</button>
					</form>
				</li>
<?php endforeach; ?>
			</ul>
		</div>

		<div class="main_body">
			<div class="about_me">
<?php if (notBlankContactAndBlurb('blurb', $db)): ?>
				<h2>About Me</h2>
				<p><?php echo htmlentities(getContactAndBlurb('blurb', $db), ENT_QUOTES, 'utf-8'); ?></p>
<?php endif; ?>
			</div>

			<div id="contact_info">
<?php if ((notBlankContactAndBlurb('city', $db)) || (notBlankContactAndBlurb('state', $db))|| (notBlankContactAndBlurb('country', $db))|| (notBlankContactAndBlurb('phone', $db)) || (notBlankContactAndBlurb('email', $db))): ?>
				<h2>Contact Info</h2>
				<ul>
<?php if (notBlankContactAndBlurb('city', $db)): ?>
					<li>
						City: <?php echo htmlentities(getContactAndBlurb('city', $db), ENT_QUOTES, 'utf-8'); ?>
					</li>
<?php endif; ?>
<?php if (notBlankContactAndBlurb('state', $db)): ?>
					<li>
						State: <?php echo htmlentities(getContactAndBlurb('state', $db), ENT_QUOTES, 'utf-8'); ?>
					</li>
<?php endif; ?>
<?php if (notBlankContactAndBlurb('country', $db)): ?>
					<li>
						Country: <?php echo htmlentities(getContactAndBlurb('country', $db), ENT_QUOTES, 'utf-8'); ?>
					</li>
<?php endif; ?>
<?php if (notBlankContactAndBlurb('phone', $db)): ?>
					<li>
						Phone: <?php echo htmlentities(getContactAndBlurb('phone', $db), ENT_QUOTES, 'utf-8'); ?>
					</li>
<?php endif; ?>
<?php if (notBlankContactAndBlurb('email', $db)): ?>
					<li>
						Email: <?php echo htmlentities(getContactAndBlurb('email', $db), ENT_QUOTES, 'utf-8'); ?>
					</li>
<?php endif; ?>
				</ul>
<?php endif; ?>
			</div>

			<div id="experiences">
				<h2>Experiences</h2>
				<ul>
<?php foreach ((selectExpSkillsHobbies(getLoggedInUserID(), "experiences", $db)) as $row): ?>
					<li id="<?php echo htmlentities($row['exp_id'], ENT_QUOTES, 'utf-8'); ?>">
						<?php echo htmlentities($row['experience'], ENT_QUOTES, 'utf-8'); ?>
					</li>
<?php endforeach; ?>
				</ul>
			</div>


			<div id="skills">
				<h2>Skills</h2>
				<ul>
<?php foreach (selectExpSkillsHobbies(getLoggedInUserID(), "skills", $db) as $row): ?>
					<li id="<?php echo htmlentities($row['skill_id'], ENT_QUOTES, 'utf-8'); ?>">
						<?php echo htmlentities($row['skill'], ENT_QUOTES, 'utf-8'); ?>
					</li>
<?php endforeach; ?>
				</ul>
			</div>

			<div id="hobbies">
				<h2>Hobbies</h2>
				<ul>
<?php foreach (selectExpSkillsHobbies(getLoggedInUserID(), "hobbies", $db) as $row): ?>
					<li id="<?php echo htmlentities($row['hobby_id'], ENT_QUOTES, 'utf-8'); ?>">
						<?php echo htmlentities($row['hobby'], ENT_QUOTES, 'utf-8'); ?>
					</li>
<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="views/lib.js"></script>
	<script src="views/profile.js"></script>
</html>
