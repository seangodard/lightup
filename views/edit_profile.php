<?php 

$profile_id = isset($_GET['id']) ? $_GET['id'] : getLoggedInUserID();

?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Profile</title>
		<link rel="stylesheet" href="views/main.css">
		<meta name="viewport" content="width=device-width, height=device-height">
	</head>
	<body>
		<?php require_once('views/top_bar.php') ?>
		<div id="content">
			<div id="main_body">
				<div id="heading" class="profile_title">
					<h2><?php echo htmlentities(getUsername($profile_id, $db), ENT_QUOTES, 'utf-8'); ?></h2>
				</div>

				
				<form action="edit_profile_request.php" method="post">
					<div class="shifted_body column_layout">
						<div class="column">
							<div id="about_me" class="left_justified area">
								<h3>About Me</h3>
								<textarea class="about_me" name="blurb" rows="6" cols="90"><?php echo htmlentities(getContactAndBlurb(getLoggedInUserID(), 'blurb', $db), ENT_QUOTES, 'utf-8'); ?></textarea>
							</div>

							<div id="contact_info" class="left_justified area">
								<h3>Contact Info</h3>
								<div class="medium_justified">
									City: <input type="text" name="city" value="<?php echo htmlentities(getContactAndBlurb(getLoggedInUserID(), 'city', $db), ENT_QUOTES, 'utf-8'); ?>">
								</div>
								<div class="medium_justified">
										State: <input type="text" name="state" value="<?php echo htmlentities(getContactAndBlurb(getLoggedInUserID(), 'state', $db), ENT_QUOTES, 'utf-8'); ?>">
								</div>
								<div class="medium_justified">
										Country: <input type="text" name="country" value="<?php echo htmlentities(getContactAndBlurb(getLoggedInUserID(), 'country', $db), ENT_QUOTES, 'utf-8'); ?>">
								</div>
								<div class="medium_justified">
										Phone: <input type="text" name="phone" value="<?php echo htmlentities(getContactAndBlurb(getLoggedInUserID(), 'phone', $db), ENT_QUOTES, 'utf-8'); ?>">
								</div>
								<div class="medium_justified">
										Email: <input type="text" name="email" value="<?php echo htmlentities(getContactAndBlurb(getLoggedInUserID(), 'email', $db), ENT_QUOTES, 'utf-8'); ?>">
								</div>
							</div> <!-- Done with contact-->
						</div> <!-- finish at contact me-->

						<div class="column">
							<div id="experiences" class="left_justified area">
								<h3>Experiences</h3>
<?php foreach ((selectExpSkillsHobbies(getLoggedInUserID(), "experiences", $db)) as $row): ?>
								<div id="exp_<?php echo htmlentities($row['exp_id'], ENT_QUOTES, 'utf-8'); ?>">
									<input type="text" name="exp_<?php echo htmlentities($row['exp_id'], ENT_QUOTES, 'utf-8'); ?>" value="<?php echo htmlentities($row['experience'], ENT_QUOTES, 'utf-8'); ?>">
									<input type="image" class="drop" src="views/images/red_cross.svg" alt="drop" width="25" height="25">
								</div>
<?php endforeach; ?>
								<input type="image" id="exp_add" class="add" src="views/images/add.svg" alt="drop" width="25" height="25">
							</div> <!-- Done with experiences -->

							<div id="skills" class="left_justified area">
								<h3>Skills</h3>
<?php foreach ((selectExpSkillsHobbies(getLoggedInUserID(), "skills", $db)) as $row): ?>
								<div id="skill_<?php echo htmlentities($row['skill_id'], ENT_QUOTES, 'utf-8'); ?>">
									<input type="text" name="skill_<?php echo htmlentities($row['skill_id'], ENT_QUOTES, 'utf-8'); ?>" value="<?php echo htmlentities($row['skill'], ENT_QUOTES, 'utf-8'); ?>">
									<input type="image" class="drop" src="views/images/red_cross.svg" alt="drop" width="25" height="25">
								</div>
<?php endforeach; ?>
								<input type="image" id="skill_add" class="add" src="views/images/add.svg" alt="drop" width="25" height="25">
							</div> <!-- Done with skills-->

							<div id="hobbies" class="left_justified area">
								<h3>Hobbies</h3>
<?php foreach ((selectExpSkillsHobbies(getLoggedInUserID(), "hobbies", $db)) as $row): ?>
								<div id="hobby_<?php echo htmlentities($row['hobby_id'], ENT_QUOTES, 'utf-8'); ?>">
									<input type="text" name="hobby_<?php echo htmlentities($row['hobby_id'], ENT_QUOTES, 'utf-8'); ?>" value="<?php echo htmlentities($row['hobby'], ENT_QUOTES, 'utf-8'); ?>">
									<input type="image" class="drop" src="views/images/red_cross.svg" alt="drop" width="25" height="25">
								</div>
<?php endforeach; ?>
								<input type="image" id="hobby_add" class="add" src="views/images/add.svg" alt="drop" width="25" height="25">
							</div> <!-- Done with hobbies-->
						</div> <!-- Done with columns -->
					</div>
					<input type="submit" class="save" value="Save">
				</form> <!-- When I get here, done with hobbies-->
			</div> <!-- Finished at hobbies -->
		</div> <!-- When I am here, I will be done with content -->

		<div id="sidebar">
			<div id="sidebar_content">
<?php foreach ((selectProjects(getLoggedInUserID(), $db)) as $row): ?>
				<div id="project_<?php echo htmlentities($row['project_id'], ENT_QUOTES, 'utf-8'); ?>">
					<a href="journal.php?id=<?php echo htmlentities($row['project_id'], ENT_QUOTES, 'utf-8'); ?>">
						<button class="projects" name="project" type="submit" value="project_<?php echo htmlentities($row['project_id'], ENT_QUOTES, 'utf-8'); ?>">
							<?php echo htmlentities($row['project_name'], ENT_QUOTES, 'utf-8'); ?>
							<input type="image" class="drop" src="views/images/red_cross.svg" alt="drop" width="25" height="25">
						</button>
					</a>
				</div>
<?php endforeach; ?>
			</div>
		</div>
	</body>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="views/profile_delete.js"></script>
	<script src="views/profile_add.js"></script>	
	<script src="views/lib.js"></script>
	<script src="views/profile.js"></script>
</html>