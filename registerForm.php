<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Account Creation</title>
<link rel = "stylesheet" type = "text/css" href = "style.css" />
</head>
<body>
<div id="wrap">
<?php include("header.php") ?>
 <h1>Please create an account by filling in the required sections.</h1>
  <form method="post" action="register.php">
    <label for="username">*Username:</label>
    <input type="text" id="username" name="username" /><br />
    <label for="pw">*Password:</label>
    <input type="password" id="pw" name="pw" /><br />
    <label for="charName">*Character Name:</label>
    <input type="text" id="charName" name="charName" /><br />
	<label for="charRealm">*Realm:</label>
    <input type="text" id="charRealm" name="charRealm" /><br />
	<input type="radio" name="region" value="US" /> US<br />
	<input type="radio" name="region" value="EU" /> EU<br />
    <input type="submit" value="Create Account" name="submit" />
  </form>
  </div>
  </body>
  </html>