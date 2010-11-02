<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Login</title>
<link rel = "stylesheet" type = "text/css" href = "style.css" />
</head>
<body>
<div id="wrap">
<?php 
	include("header.php"); 
	include("db_connect.php");
?>
<h1>Log In</h1>
<?php
	$name = mysqli_real_escape_string($db, trim($_POST['username']));
	$pw = mysqli_real_escape_string($db, trim($_POST['pw']));
	
    $query = "SELECT * FROM users WHERE userName='$name' AND password='$pw'";
    $result = mysqli_query($db, $query);

	$num = mysqli_num_rows($result);
	
	if($num < 1){
		echo "<br>Error: username and password incorrect.";
	}
	else{
		echo "<br>Welcome, $name!";
	}
?>
<?php include("footer.html"); ?>
</div>
</body>
</html>