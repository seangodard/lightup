<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>LightUp: Login/Register</title>
	</head>
	<body>
		<h1>LightUp</h1>
		<div class="sidebar">
			<h2>Login</h2>
			<form action="login.php" method="post" id="login_form">
				<div id="login_name" class="form_group">
					<input type="text" placeholder="Username" name="login_name"
						class="<?php if (hasMessage('login_name')) {echo 'has_error';} ?>">
					<?php if (hasMessage('login_name')) {echo getFeedbackMessage('login_name');} ?>
				</div>
				<div id="login_pass" class="form_group">
					<input type="password" placeholder="Password" name="login_pass"
						class="<?php if (hasMessage('login_pass')) {echo 'has_error';} ?>">
					<?php if (hasMessage('login_pass')) {echo getFeedbackMessage('login_pass');} ?>
				</div>
				<input type="submit" value="Login" id="login">
			</form>
			<h2>Register</h2>
			<form action="register.php" method="post" id="register_form">
				<div id="register_name" class="form_group">
					<input type="text" placeholder="Username" name="register_name"
						class="<?php if (hasMessage('register_name')) {echo 'has_error';} ?>">
					<?php if (hasMessage('register_name')) {echo getFeedbackMessage('register_name');} ?>
				</div>
				<div id="register_pass" class="form_group">
					<input type="password" placeholder="Password" name="register_pass">
				</div>
				<div id="register_cpass" class="form_group">
					<input type="password" placeholder="Confirm Password" name="register_cpass">
				</div>
				<input type="submit" value="Register" id="register">
			</form>
		</div>
		<div class="main_body">
			<h1></h1>
			<img src="views/images/lightup.svg" alt="tree"/>
			<p>
				Welcome to LightUp! Have you ever had an idea but never believed that anyone would be interested 
				in it or wondered if maybe someone was already working on it and you just want to join in? Before
				LightUp, we were suffering from the same problem......  
			</p>
		</div>
	</body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="views/lib.js"></script>
	<script src="views/home.js"></script>
</html>
