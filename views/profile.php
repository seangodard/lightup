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
<?php if (isset(selecProfileInfo($_SESSION['username'], $db)['blurb']) && (selecProfileInfo($_SESSION['username'], $db)['blurb']) !== ''): ?>
			<h2>About Me</h2>
			<p><?php echo htmlentities(selecProfileInfo($_SESSION['username'], $db)['blurb'], ENT_QUOTES, 'utf-8'); ?></p>
<?php endif; ?>
		</div>

		<div>
<?php if ((isset(selecProfileInfo($_SESSION['username'], $db)['city'])) && 
			((selecProfileInfo($_SESSION['username'], $db)['city']) !== '') ||
			(isset(selecProfileInfo($_SESSION['username'], $db)['state'])) && 
			((selecProfileInfo($_SESSION['username'], $db)['state']) !== '')||
			(isset(selecProfileInfo($_SESSION['username'], $db)['country'])) && 
			((selecProfileInfo($_SESSION['username'], $db)['country']) !== '')||
			(isset(selecProfileInfo($_SESSION['username'], $db)['phone'])) && 
			((selecProfileInfo($_SESSION['username'], $db)['phone']) !== '') ||
			(isset(selecProfileInfo($_SESSION['username'], $db)['email'])) && 
			((selecProfileInfo($_SESSION['username'], $db)['email']) !== '')): ?>
			<h2>Contact Info</h2>
			<ul>
<?php if (isset(selecProfileInfo($_SESSION['username'], $db)['city']) && (selecProfileInfo($_SESSION['username'], $db)['city']) !== ''): ?>
				<li>
					City: <?php echo htmlentities(selecProfileInfo($_SESSION['username'], $db)['city'], ENT_QUOTES, 'utf-8'); ?>
				</li>
<?php endif; ?>
<?php if (isset(selecProfileInfo($_SESSION['username'], $db)['state']) && (selecProfileInfo($_SESSION['username'], $db)['state']) !== ''): ?>
				<li>
					State: <?php echo htmlentities(selecProfileInfo($_SESSION['username'], $db)['state'], ENT_QUOTES, 'utf-8'); ?>
				</li>
<?php endif; ?>
<?php if (isset(selecProfileInfo($_SESSION['username'], $db)['country']) && (selecProfileInfo($_SESSION['username'], $db)['country']) !== ''): ?>
				<li>
					Country: <?php echo htmlentities(selecProfileInfo($_SESSION['username'], $db)['country'], ENT_QUOTES, 'utf-8'); ?>
				</li>
<?php endif; ?>
<?php if (isset(selecProfileInfo($_SESSION['username'], $db)['phone']) && (selecProfileInfo($_SESSION['username'], $db)['phone']) !== ''): ?>
				<li>
					Phone: <?php echo htmlentities(selecProfileInfo($_SESSION['username'], $db)['phone'], ENT_QUOTES, 'utf-8'); ?>
				</li>
<?php endif; ?>
<?php if (isset(selecProfileInfo($_SESSION['username'], $db)['email']) && (selecProfileInfo($_SESSION['username'], $db)['email']) !== ''): ?>
				<li>
					Email: <?php echo htmlentities(selecProfileInfo($_SESSION['username'], $db)['email'], ENT_QUOTES, 'utf-8'); ?>
				</li>
<?php endif; ?>
			</ul>
<?php endif; ?>
		</div>

		<div>
<?php if (isset(selecProfileInfo($_SESSION['username'], $db)['experiences']) && (selecProfileInfo($_SESSION['username'], $db)['experiences']) !== ''): ?>
			<h2>Experiences</h2>
			<p><?php echo htmlentities(selecProfileInfo($_SESSION['username'], $db)['experiences'], ENT_QUOTES, 'utf-8'); ?></p>
<?php endif; ?>
		</div>

		<div>
<?php if (isset(selecProfileInfo($_SESSION['username'], $db)['skills']) && (selecProfileInfo($_SESSION['username'], $db)['skills']) !== ''): ?>
			<h2>Skills</h2>
			<p><?php echo htmlentities(selecProfileInfo($_SESSION['username'], $db)['skills'], ENT_QUOTES, 'utf-8'); ?></p>
<?php endif; ?>
		</div>

		<div>
<?php if (isset(selecProfileInfo($_SESSION['username'], $db)['hobbies']) && (selecProfileInfo($_SESSION['username'], $db)['hobbies']) !== ''): ?>
			<h2>Hobbies</h2>
			<p><?php echo htmlentities(selecProfileInfo($_SESSION['username'], $db)['hobbies'], ENT_QUOTES, 'utf-8'); ?></p>
<?php endif; ?>
		</div>

	</body>	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="views/lib.js"></script>
	<script src="views/profile.js"></script>
</html>
