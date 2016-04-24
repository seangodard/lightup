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
		<link rel="stylesheet" href="views/home.css">
		<meta name="viewport" content="width=device-width, height=device-height">
	</head>
	<body>
		<div id="header">
			<h1><?php echo $escaped_project_name; ?></h1>
			<input type="hidden" id="project_id" value="<?php echo $escaped_project_id; ?>">
		</div>
		<div id="main_body">
		</div>
		<div id="sidebar">
			<button id="add">Add</button>
<?php foreach($journal_summaries as $entry): ?>
			<div>
				<button class="entry_summary">
					<input type="hidden" value="<?php echo htmlentities($entry['entry_id'], ENT_QUOTES, 'utf-8'); ?>">
					<div><?php echo htmlentities($entry['title'], ENT_QUOTES, 'utf-8'); ?></div>
					<div><?php echo htmlentities($entry['poster_username'], ENT_QUOTES, 'utf-8') ?></div>
					<div><?php echo htmlentities($entry['entry_time'], ENT_QUOTES, 'utf-8') ?></div>
				</button>
		   </div>
<?php endforeach; ?>
		</div>
	</body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="views/get_entry.js"></script>
</html>	
