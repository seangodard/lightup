<?php 
	// Get information on the project
	$project_id = $_GET['id'];
	$escaped_project_id = htmlentities($project_id, ENT_QUOTES, 'utf-8');
	$project_name = getProjectName($project_id, $db);
	$escaped_project_name = htmlentities($project_name, ENT_QUOTES, 'utf-8');

	// Get info on the journal summaries 
	$journal_summaries = getJournalSummaries(getLoggedInUserID(), $project_id, $db);
?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo $escaped_project_name.' - LightUp'; ?></title>
		<link rel="stylesheet" href="views/main.css">
		<meta name="viewport" content="width=device-width, height=device-height">
	</head>
	<body>
		<div id="header">
			<h1>LightUp</h1>
		</div>
		<div id="main_body">
			<div id="heading">
				<h2><?php echo 'Journal of: '.$escaped_project_name; ?></h2>
				<input type="hidden" id="project_id" value="<?php echo $escaped_project_id; ?>">
			</div>
			<div id="tools">
				<input type="image" id="edit" src="/views/images/edit.svg" alt="edit">
				<input type="image" id="add" src="/views/images/add.svg" alt="add">
			</div>
			<div id="add_form">
				<div class=".form_group">
					<input type="text" placeholder="Title" id="entry_title" name="entry_title">
				</div>
				<textarea id="entry_body"></textarea>
				<input type="submit" id="add_entry" value="Done">
			</div>
		</div>
		<div id="sidebar">
			<div id="sidebar_content">
<?php if ($journal_summaries != null): ?>
	<?php foreach($journal_summaries as $entry): ?>
				<button class="entry_summary">
					<input type="hidden" class="entry_id" value="<?php echo htmlentities($entry['entry_id'], ENT_QUOTES, 'utf-8'); ?>">
					<input type="hidden" class="entry_user_id" value="<?php echo htmlentities($entry['posting_user_id'], ENT_QUOTES, 'utf-8'); ?>">
					<div><?php echo htmlentities($entry['title'], ENT_QUOTES, 'utf-8').' -- '.
						htmlentities($entry['poster_username'], ENT_QUOTES, 'utf-8') ?></div>
					<div class="timestamp"><?php echo htmlentities($entry['entry_time'], ENT_QUOTES, 'utf-8') ?></div>
				</button>
	<?php endforeach; ?>
<?php endif; ?>
			</div>
		</div>
	</body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="views/journal.js"></script>
</html>	
