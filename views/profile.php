<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Profile</title>
	</head>
	<body>
		<div class="top_bar">
			<h1>Profile Page of: <?php echo htmlentities($_SESSION['username'], ENT_QUOTES, 'utf-8'); ?></h1>
			<a href="../logout.php">Logout</a>
			<form action="project.php"><input type="image" src="views/images/settings.png" alt="settings" width="37" height="37"></form>
		</div>

		<div class="sidebar">
			<ul>
<?php foreach (selectProjects($_SESSION['username'], $db) as $row): ?>
				<li id="<?php echo htmlentities($row['project_id'], ENT_QUOTES, 'utf-8'); ?>">
					<button class="projects"><?php echo htmlentities($row['project_name'], ENT_QUOTES, 'utf-8'); ?></button>
				</li>
<?php endforeach; ?>
			</ul>
		</div>

		<div>
			<h2>About Me</h2>
			<p><?php echo htmlentities(selecProfileInfo($_SESSION['username'], $db)['blurb'], ENT_QUOTES, 'utf-8'); ?></p>
		</div>

		<div>
			<h2>Contact Info</h2>
			<ul>
				<li>
					City: <?php echo htmlentities(selecProfileInfo($_SESSION['username'], $db)['city'], ENT_QUOTES, 'utf-8'); ?>
				</li>
				<li>
					State: <?php echo htmlentities(selecProfileInfo($_SESSION['username'], $db)['state'], ENT_QUOTES, 'utf-8'); ?>
					</li>
				<li>
					Country: <?php echo htmlentities(selecProfileInfo($_SESSION['username'], $db)['country'], ENT_QUOTES, 'utf-8'); ?>
				</li>
				<li>
					Phone: <?php echo htmlentities(selecProfileInfo($_SESSION['username'], $db)['phone'], ENT_QUOTES, 'utf-8'); ?>
				</li>
				<li>
					Email: <?php echo htmlentities(selecProfileInfo($_SESSION['username'], $db)['email'], ENT_QUOTES, 'utf-8'); ?>
				</li>
			</ul>
		</div>

		<div>
			<h2>Experiences</h2>
			<p><?php echo htmlentities(selecProfileInfo($_SESSION['username'], $db)['experience'], ENT_QUOTES, 'utf-8'); ?></p>
		</div>

		<div>
			<h2>Skills</h2>
			<p><?php echo htmlentities(selecProfileInfo($_SESSION['username'], $db)['skills'], ENT_QUOTES, 'utf-8'); ?></p>
		</div>

		<div>
			<h2>Hobbies</h2>
			<p><?php echo htmlentities(selecProfileInfo($_SESSION['username'], $db)['hobbies'], ENT_QUOTES, 'utf-8'); ?></p>
		</div>

	</body>	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="views/lib.js"></script>
	<script src="views/profile.js"></script>
</html>
