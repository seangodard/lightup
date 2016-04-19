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
<?php if (notBlank('blurb', $db)): ?>
			<h2>About Me</h2>
			<p><?php echo htmlentities(get('blurb', $db), ENT_QUOTES, 'utf-8'); ?></p>
<?php endif; ?>
		</div>

		<div>
<?php if ((notBlank('city', $db)) || (notBlank('state', $db))|| (notBlank('country', $db))|| (notBlank('phone', $db)) || (notBlank('email', $db))): ?>
			<h2>Contact Info</h2>
			<ul>
<?php if (notBlank('city', $db)): ?>
				<li>
					City: <?php echo htmlentities(get('city', $db), ENT_QUOTES, 'utf-8'); ?>
				</li>
<?php endif; ?>
<?php if (notBlank('state', $db)): ?>
				<li>
					State: <?php echo htmlentities(get('state', $db), ENT_QUOTES, 'utf-8'); ?>
				</li>
<?php endif; ?>
<?php if (notBlank('country', $db)): ?>
				<li>
					Country: <?php echo htmlentities(get('country', $db), ENT_QUOTES, 'utf-8'); ?>
				</li>
<?php endif; ?>
<?php if (notBlank('phone', $db)): ?>
				<li>
					Phone: <?php echo htmlentities(get('phone', $db), ENT_QUOTES, 'utf-8'); ?>
				</li>
<?php endif; ?>
<?php if (notBlank('email', $db)): ?>
				<li>
					Email: <?php echo htmlentities(get('email', $db), ENT_QUOTES, 'utf-8'); ?>
				</li>
<?php endif; ?>
			</ul>
<?php endif; ?>
		</div>

		<div>
<?php if (notBlank('experiences', $db)): ?>
			<h2>Experiences</h2>
			<p><?php echo htmlentities(get('experiences', $db), ENT_QUOTES, 'utf-8'); ?></p>
<?php endif; ?>
		</div>

		<div>
<?php if (notBlank('skills', $db)): ?>
			<h2>Skills</h2>
			<p><?php echo htmlentities(get('skills', $db), ENT_QUOTES, 'utf-8'); ?></p>
<?php endif; ?>
		</div>

		<div>
<?php if (notBlank('hobbies', $db)): ?>
			<h2>Hobbies</h2>
			<p><?php echo htmlentities(get('hobbies', $db), ENT_QUOTES, 'utf-8'); ?></p>
<?php endif; ?>
		</div>

	</body>	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="views/lib.js"></script>
	<script src="views/profile.js"></script>
</html>
