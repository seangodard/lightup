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


	</body>	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="views/lib.js"></script>
	<script src="views/profile.js"></script>
</html>
