<?php 

//$profile_id = isset($_GET['id']) ? $_GET['id'] : getLoggedInUserID();

$search = isset($_GET['search']) ? $_GET['search'] : '';

?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Profile</title>
		<link rel="stylesheet" href="views/main.css">
		<meta name="viewport" content="width=device-width, height=device-height">
	</head>
	<body>
		Hello
<?php echo getLoggedInUserID(); ?>
	</body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="views/lib.js"></script>
	<script src="views/profile.js"></script>
</html>
