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
			<form action="profile.php" method="post">
				<h2>About Me</h2>
					<div class="about_me">
						<input type="text" name="aboutMe" value="<?php echo htmlentities(getContactAndBlurb('blurb', $db), ENT_QUOTES, 'utf-8'); ?>">
					</div>
				<input type="submit">
			</form>
		</div>
	</body>
</html>