<?php

$user_id = getLoggedInUserID();
$profile_picture = getProfilePicture($user_id, $db);

?><div id="header">
	<div class="header header2">
		<h1 id="header_logo">LightUp</h1>
		<input type="hidden" id="logged_in_user_id" value="<?php echo htmlentities($user_id, ENT_QUOTES, 'utf-8'); ?>">
	</div>
	<div class="header header1">
		<div id="profile_logout">
			<a class="prof" href="profile.php?id=<?php echo htmlentities($user_id, ENT_QUOTES, 'utf-8'); ?>">
				<img class="profile" src="<?php echo htmlentities($profile_picture, ENT_QUOTES, 'utf-8'); ?>" alt="profile">
			</a>
			<a class="logout" href="logout.php"><img src="views/images/logout.svg" alt="logout"></a>
		</div>
<?php if (!isset($is_search_page)): ?>
		<div>
			<form action="search.php" method="get">
				<input id="search_box" type="search" placeholder="Search" name="search">
			</form>
			<a id="button_search" href="search.php">
				<img src="views/images/search.svg" alt="search">
			</a>
		</div>
<?php endif; ?>
	</div>
</div>
