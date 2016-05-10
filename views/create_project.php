<?php

$search = isset($_GET['search']) ? $_GET['search'] : '';

?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Create Project</title>
		<link rel="stylesheet" href="views/main.css">
		<meta name="viewport" content="width=device-width, height=device-height">
	</head>
	<body>
<?php require_once('top_bar.php'); ?>
		<div id="center_main_body" class="create_project">
			<form action="add_project_controller.php" method="post" enctype="multipart/form-data">
				<div>
					<input type="text" placeholder="Project Name" id="project_name" class="title" name="project_name" size="90">
				</div>
				<div id="description">
					<textarea name="description" class="flex_grow" placeholder="Description"></textarea>
				</div>
				<div id="picture">
					<input type="file" name="fileToUpload" id="fileToUpload" class="file_upload">
				</div> 
				 <input type="submit" class="save" value="Create!">
			</form>
		</div>
	</body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="views/lib.js"></script>
	<script src="views/profile.js"></script>
</html>
