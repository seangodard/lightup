<?php


?><div id="header">
	<div id="lightup_logo">
		<h1 id="header_logo">LightUp</h1>
		<input type="hidden" id="logged_in_user_id" value="<?php echo getLoggedInUserID(); ?>">
	</div>
	<div id="logout">
		<a class="logout" href="../logout.php"><input type="image" src="views/images/logout.png" alt="logout" width="50" height="50"></a>
	</div>
</div>
