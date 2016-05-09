<?php 

	// TODO : Where to escape these values : Sat 07 May 2016 01:10:24 PM EDT 
	// Get information on the project
	$project_id = $_GET['id'];
	$project_name = htmlentities(getProjectName($project_id, $db), ENT_QUOTES, 'utf-8');
	$project_description = htmlentities(getProjectDescription($project_id, $db), ENT_QUOTES, 'utf-8'); 
	$raw_project_members = getProjectMembers($project_id, $db);

?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo $project_name.' - LightUp'; ?></title>
		<link rel="stylesheet" href="views/main.css">
		<meta name="viewport" content="width=device-width, height=device-height">
	</head>
	<body>
		<?php require_once('views/top_bar.php') ?>
		<div id="content">
			<div id="nav_links">
<?php if (isMember(getLoggedInUserID(), $project_id, $db)): ?>
				<a href="journal.php?id=<?php echo $project_id?>"><div class="button">Journal</div></a>
<?php endif; ?>
				<a href="project.php?id=<?php echo $project_id?>"><div class="button current_page">Project Page</div></a>
			</div>
			<div id="main_body" class="flex">
				<div id="profile_image">
					<img src="<?php echo htmlentities(getProjectPicture($project_id, $db), ENT_QUOTES, 'utf-8'); ?>" alt="$project_id" width="75" height="75">
				</div>
				<input type="hidden" id="project_id" value="<?php echo $project_id?>">
<?php if(isMember(getLoggedInUserID(), $project_id, $db)): ?>
				<div id="tool_bar" class="flex_fit">
					<input type="image" id="edit" src="/views/images/edit.svg" alt="edit">
				</div>
<?php endif; ?>
				<div id="project_info">
					<div id="heading" class="flex_fit">
						<h2 id="project_title"><?php echo $project_name; ?></h2>
					</div>
					<div id="descriptio" class="flex flex_grow">
						<div id="project_body"><?php echo $project_description; ?></div>
					</div>
				</div>
			</div>
		</div>
		<div id="sidebar">
			<div id="sidebar_content">
				<div class="sidebar_title">Project Members</div>
<?php if ($raw_project_members != null): ?>
	<?php foreach($raw_project_members as $member): ?>
				<a href="profile.php?id=<?php echo htmlentities($member['user_id'], ENT_QUOTES, 'utf-8'); ?>">
					<button class="sidebar_entry">
						<?php echo htmlentities($member['username'], ENT_QUOTES, 'utf-8'); ?>
					</button>
				</a>
	<?php endforeach; ?>
<?php endif; ?>
			</div>
		</div>
	</body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="views/project.js"></script>
</html>	
