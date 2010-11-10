<?php session_start(); ?>

	<div id="Navigation">
	<?php echo "<h1>Welcome ".$_SESSION['currentUser']."</h1>"; ?>
	<a href="index.php">Home</a>
	|
	<a href="loginForm.php">Login</a>
	|
	<a href="registerForm.php">Register</a>
	</div>