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
		</div>

		<div class="sidebar">
			<ul>
<?php foreach ((selectProjects(getLoggedInUserID(), $db)) as $row): ?>
				<li id="project_<?php echo htmlentities($row['project_id'], ENT_QUOTES, 'utf-8'); ?>">
					<?php echo htmlentities($row['project_name'], ENT_QUOTES, 'utf-8'); ?>
					<input type="image" class="drop" src="views/images/red_cross.svg" alt="drop" width="20" height="20">
				</li>
<?php endforeach; ?>
			</ul>
		</div>

		<div class="main_body">
			<form action="edit_profile_request.php" method="post">
			<div class="about_me">
				<h2>About Me</h2>
				<input type="text" name="blurb" value="<?php echo htmlentities(getContactAndBlurb(getLoggedInUserID(), 'blurb', $db), ENT_QUOTES, 'utf-8'); ?>">
			</div>

			<div id="contact_info">
				<h2>Contact Info</h2>
				<ul>
					<li>
					City: <input type="text" name="city" value="<?php echo htmlentities(getContactAndBlurb(getLoggedInUserID(), 'city', $db), ENT_QUOTES, 'utf-8'); ?>">
					</li>
					<li>
					State: <input type="text" name="state" value="<?php echo htmlentities(getContactAndBlurb(getLoggedInUserID(), 'state', $db), ENT_QUOTES, 'utf-8'); ?>">
					</li>
					<li>
					Country: <input type="text" name="country" value="<?php echo htmlentities(getContactAndBlurb(getLoggedInUserID(), 'country', $db), ENT_QUOTES, 'utf-8'); ?>">
					</li>
					<li>
					Phone: <input type="text" name="phone" value="<?php echo htmlentities(getContactAndBlurb(getLoggedInUserID(), 'phone', $db), ENT_QUOTES, 'utf-8'); ?>">
					</li>
					<li>
					Email: <input type="text" name="email" value="<?php echo htmlentities(getContactAndBlurb(getLoggedInUserID(), 'email', $db), ENT_QUOTES, 'utf-8'); ?>">
					</li>
				</ul>
			</div>

			<div id="experiences">
				<h2>Experiences</h2>
				<ul>
<?php foreach ((selectExpSkillsHobbies(getLoggedInUserID(), "experiences", $db)) as $row): ?>
					<li id="exp_<?php echo htmlentities($row['exp_id'], ENT_QUOTES, 'utf-8'); ?>">
						<input type="text" name="exp_<?php echo htmlentities($row['exp_id'], ENT_QUOTES, 'utf-8'); ?>" value="<?php echo htmlentities($row['experience'], ENT_QUOTES, 'utf-8'); ?>">
						<input type="image" class="drop" src="views/images/red_cross.svg" alt="drop" width="20" height="20">
					</li>
<?php endforeach; ?>
				</ul>
				<input type="image" class="add" src="views/images/add.svg" alt="drop" width="20" height="20">
			</div>

			<div id="skills">
				<h2>Skills</h2>
				<ul>
<?php foreach ((selectExpSkillsHobbies(getLoggedInUserID(), "skills", $db)) as $row): ?>
					<li id="skill_<?php echo htmlentities($row['skill_id'], ENT_QUOTES, 'utf-8'); ?>">
						<input type="text" name="skill_<?php echo htmlentities($row['skill_id'], ENT_QUOTES, 'utf-8'); ?>" value="<?php echo htmlentities($row['skill'], ENT_QUOTES, 'utf-8'); ?>">
						<input type="image" class="drop" src="views/images/red_cross.svg" alt="drop" width="20" height="20">
					</li>
<?php endforeach; ?>
				</ul>
				<input type="image" class="add" src="views/images/add.svg" alt="drop" width="20" height="20">
			</div>

			<div id="hobbies">
				<h2>Hobbies</h2>
				<ul>
<?php foreach ((selectExpSkillsHobbies(getLoggedInUserID(), "hobbies", $db)) as $row): ?>
					<li id="hobby_<?php echo htmlentities($row['hobby_id'], ENT_QUOTES, 'utf-8'); ?>">
						<input type="text" name="hobby_<?php echo htmlentities($row['hobby_id'], ENT_QUOTES, 'utf-8'); ?>" value="<?php echo htmlentities($row['hobby'], ENT_QUOTES, 'utf-8'); ?>">
						<input type="image" class="drop" src="views/images/red_cross.svg" alt="drop" width="20" height="20">
					</li>
<?php endforeach; ?>
				</ul>
				<input type="image" class="add" src="views/images/add.svg" alt="drop" width="20" height="20">
			</div>
			
			<input type="submit" value="Save">
			</form>
		</div>
	</body>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="views/profile_delete.js"></script>
	<script src="views/profile_add.js"></script>	
	<script src="views/lib.js"></script>
	<script src="views/profile.js"></script>
</html>