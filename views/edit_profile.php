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
					<?php echo htmlentities($row['project_name'], ENT_QUOTES, 'utf-8'); ?>
					<input type="image" class="drop" src="views/images/drop.gif" alt="drop" width="20" height="20">
				</li>
<?php endforeach; ?>
			</ul>
		</div>

		<div class="main_body">
			<form action="profile.php" method="post">
				<div class="about_me">
					<h2>About Me</h2>
					<input type="text" name="blurb" value="<?php echo htmlentities(getContactAndBlurb('blurb', $db), ENT_QUOTES, 'utf-8'); ?>">
				</div>

				<div id="contact_info">
					<h2>Contact Info</h2>
					<ul>
						<li>
						City: <input type="text" name="city" value="<?php echo htmlentities(getContactAndBlurb('city', $db), ENT_QUOTES, 'utf-8'); ?>">
						</li>
						<li>
						State: <input type="text" name="state" value="<?php echo htmlentities(getContactAndBlurb('state', $db), ENT_QUOTES, 'utf-8'); ?>">
						</li>
						<li>
						Country: <input type="text" name="country" value="<?php echo htmlentities(getContactAndBlurb('country', $db), ENT_QUOTES, 'utf-8'); ?>">
						</li>
						<li>
						Phone: <input type="text" name="phone" value="<?php echo htmlentities(getContactAndBlurb('phone', $db), ENT_QUOTES, 'utf-8'); ?>">
						</li>
						<li>
						Email: <input type="text" name="email" value="<?php echo htmlentities(getContactAndBlurb('email', $db), ENT_QUOTES, 'utf-8'); ?>">
						</li>
					</ul>
				</div>

				<div id="experiences">
					<h2>Experiences</h2>
					<ul>
<?php foreach ((selectExpSkillsHobbies(getLoggedInUserID(), "experiences", $db)) as $row): ?>
						<li id="<?php echo htmlentities($row['exp_id'], ENT_QUOTES, 'utf-8'); ?>">
							<input type="text" name="exp_<?php echo htmlentities($row['exp_id'], ENT_QUOTES, 'utf-8'); ?>" value="<?php echo htmlentities($row['experience'], ENT_QUOTES, 'utf-8'); ?>">
						</li>
<?php endforeach; ?>
					</ul>
				</div>

				<div id="skills">
					<h2>Skills</h2>
					<ul>
<?php foreach ((selectExpSkillsHobbies(getLoggedInUserID(), "skills", $db)) as $row): ?>
						<li id="<?php echo htmlentities($row['skill_id'], ENT_QUOTES, 'utf-8'); ?>">
							<input type="text" name="skill_<?php echo htmlentities($row['skill_id'], ENT_QUOTES, 'utf-8'); ?>" value="<?php echo htmlentities($row['skill'], ENT_QUOTES, 'utf-8'); ?>">
						</li>
<?php endforeach; ?>
					</ul>
				</div>

				<div id="hobbies">
					<h2>Hobbies</h2>
					<ul>
<?php foreach ((selectExpSkillsHobbies(getLoggedInUserID(), "hobbies", $db)) as $row): ?>
						<li id="<?php echo htmlentities($row['hobby_id'], ENT_QUOTES, 'utf-8'); ?>">
							<input type="text" name="hobby_<?php echo htmlentities($row['hobby_id'], ENT_QUOTES, 'utf-8'); ?>" value="<?php echo htmlentities($row['hobby'], ENT_QUOTES, 'utf-8'); ?>">
						</li>
<?php endforeach; ?>
					</ul>
				</div>


				<input type="submit">
			</form>
		</div>
	</body>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script>
		// Start running code once the document is ready
		$(document).ready(function() {
			console.log('The document is ready.');

			$('.drop').on('click', function() {
				var project = $(this).parent();
				var project_id = project.attr('id');
				console.log("Project ID: " + project_id);

				// Send an AJAX request and respond
				$.post('edit_profile.php', {dropProject:project_id}, function(response) {
					console.log("Response: " + response);
					if (response) {
						project.remove();
					}
				}, 'json');
			});
		});		
	</script>	
	<script src="views/lib.js"></script>
	<script src="views/profile.js"></script>
</html>