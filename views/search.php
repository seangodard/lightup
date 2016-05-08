<?php

$search = isset($_GET['search']) ? $_GET['search'] : '';

?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Search</title>
		<link rel="stylesheet" href="views/main.css">
		<meta name="viewport" content="width=device-width, height=device-height">
	</head>
	<body>
<?php require_once('top_bar.php'); ?>
			<div id="center_main_body">
				<div class="result_title">
					<h2>Results: <?php echo htmlentities($search, ENT_QUOTES, 'utf-8'); ?></h2><br>
				</div>
				<div class="results">
<?php if (getUsersLike($search, $db) == null): ?>
					<h3>No users were found</h3>
<?php else: ?>
					<h3>Users</h3>
	<?php foreach(getUsersLike($search, $db) as $row): ?>
					<div class="results_entry">
						<h4><a href="profile.php?id=<?php echo htmlentities($row['user_id'], ENT_QUOTES, 'utf-8'); ?>"><?php echo htmlentities(getUsername($row['user_id'], $db), ENT_QUOTES, 'utf-8'); ?></a></h4>
					</div>
	<?php endforeach; ?>
<?php endif; ?>
					<br>
					<br>
					
<?php if (getProjectsLike($search, $db) == null): ?>
					<h3>No projects were found</h3>
<?php else: ?>
					<h3>Projects</h3>
	<?php foreach(getProjectsLike($search, $db) as $row): ?>
					<div class="results_entry">
						<h4><a href="project.php?id=<?php echo htmlentities($row['project_id'], ENT_QUOTES, 'utf-8'); ?>"><?php echo htmlentities(getProjectName($row['project_id'], $db), ENT_QUOTES, 'utf-8'); ?></a></h4>
					</div>
	<?php endforeach; ?>
<?php endif; ?>

				</div>
			</div>
	</body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="views/lib.js"></script>
	<script src="views/profile.js"></script>
</html>
