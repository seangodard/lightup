<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>LightUp: Login/Register</title>
		<link rel="stylesheet" href="views/home.css">
		<meta name="viewport" content="width=device-width, height=device-height">
	</head>
	<body>
		<div id="main_body">
			<img src="views/images/lightup.svg" alt="LightUp" id="central_image"/>
			<h1>LightUp</h1>
			<p>
				Welcome to LightUp! Have you ever had an idea but never believed that anyone would be interested 
				in it? Or perhaps wondered if maybe someone was already working on it and you just want to join in? Well you've
				come to the right place! Welcome to LightUp, the place where ideas are meant to be shared!
			</p>
		</div>
		<div id="sidebar">
			<div id="sidebar_content">
				<div id="login_container">
					<h2>Login</h2>
					<form action="login.php" method="post" id="login_form">
						<div id="login_name" class="form_group<?php if (hasMessage('login_name')) {echo ' has_error';} ?>">
							<input type="text" placeholder="Username" name="login_name"
								value="<?php if (isAttemptedUsername()) { echo getAttemptedUsername(); } ?>">
							<?php if (hasMessage('login_name')) {echo getFeedbackMessage('login_name');} ?>
						</div>
						<div id="login_pass" class="form_group<?php if (hasMessage('login_pass')) {echo ' has_error';} ?>">
							<input type="password" placeholder="Password" name="login_pass"
								class="<?php if (hasMessage('login_pass')) {echo 'has_error';} ?>">
							<?php if (hasMessage('login_pass')) {echo getFeedbackMessage('login_pass');} ?>
						</div>
						<input type="submit" value="Login" id="login" class="submit">
					</form>
				</div>
				<div id="register_container">
					<h2>Register</h2>
					<form action="register.php" method="post" id="register_form">
						<div id="register_name" class="form_group<?php if (hasMessage('register_name')) {echo ' has_error';} ?>">
							<input type="text" placeholder="Username" name="register_name">
							<?php if (hasMessage('register_name')) {echo getFeedbackMessage('register_name');} ?>
						</div>
						<div id="register_pass" class="form_group">
							<input type="password" placeholder="Password" name="register_pass">
						</div>
						<div id="register_cpass" class="form_group">
							<input type="password" placeholder="Confirm Password" name="register_cpass">
						</div>
						<input type="submit" value="Register" id="register" class="submit">
					</form>
				</div>
			</div>
		</div>
	</body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="views/lib.js"></script>
	<script src="views/home.js"></script>
</html>
