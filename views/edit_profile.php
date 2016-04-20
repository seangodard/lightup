<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Edit Profile</title>
	</head>
	<body>
		<div class="top_bar">
			<h1>Edit Profile Page of: <?php echo htmlentities(getLoggedInUser(), ENT_QUOTES, 'utf-8'); ?></h1>
		</div>

		<div class="side_bar">
			<ul>
<?php foreach (selectProjects(getLoggedInUser(), $db) as $row): ?>
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
			<h2>About Me</h2>
		</div>
	</body>
</html>