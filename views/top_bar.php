<?php


?><div id="header">
	<div class="header header2">
		<h1 id="header_logo">LightUp</h1>
		<input type="hidden" id="logged_in_user_id" value="<?php echo htmlentities(getLoggedInUserID(), ENT_QUOTES, 'utf-8'); ?>">
	</div>
	<div class="header header1">
		<div id="profile_logout">
			<a class="profile" href="profile.php?id=<?php echo htmlentities(getLoggedInUserID(), ENT_QUOTES, 'utf-8'); ?>"><input type="image" src="views/images/profile.jpg" alt="profile" width="50" height="50"></a>
			<a class="logout" href="../logout.php"><input type="image" src="views/images/logout.png" alt="logout" width="50" height="50"></a>
		</div>
		<div id="search_box">
			<form action="search.php" method="get">
				<input type="search" placeholder="Search" name="search">
			</form>
		</div>
	</div>
</div>
