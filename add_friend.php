<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Add Friend</title>
<link rel = "stylesheet" type = "text/css" href = "style.css" />
</head>
<body>
<div id="wrap">
<?php include("header.php"); ?>
<h1>Add Friend</h1>
<?php
	include ("db_connect.php");
	$charName = $_GET['character'];
	$realm = $_GET['realm'];
	$region = $_GET['region'];
	$currentUser = $_SESSION['currentUser'];
	
	$query = "SELECT * FROM usercharacters JOIN realms WHERE userRealm=realmName AND userChar='$charName' AND userRealm='$realm' AND region='$region'";
	$result = mysqli_query($db, $query)
		or die ("Error: Character query failed.");
	
	if (mysqli_num_rows($result) == 0) {
		print "<h2><span style=\"color:red\">Error</span>: Cannot find user for that character.</h2>";
	} else {
		while ($row = mysqli_fetch_assoc($result)) {
			$userName = $row['userId'];
		}
		
		$query = "SELECT * FROM friends WHERE userOne='$currentUser' AND userTwo='$userName'";
		$result = mysqli_query($db, $query)
			or die ("Error: Could not check database to see if friendship existed.");
			
		if (mysqli_num_rows($result) > 0) {
			print "<h4><span style=\"color:red\">Error</span>: Friendship already exists.</h4>";
		} else {
			$query = "INSERT INTO friends(userOne, userTwo) VALUES ('$currentUser', '$userName')";
			$result = mysqli_query($db, $query)
				or die ("Error: Could not add friend.");
			$query = "INSERT INTO friends(userOne, userTwo) VALUES ('$userName', '$currentUser')";
			$result = mysqli_query($db, $query)
				or die ("Error: Could not add friend.");
			print "<p>Success! <span style=\"color:#ff6666\">$charName - $realm</span> is now your friend.</p>";
		}
	}
?>
<?php include("footer.html"); ?>
</div>
</body>
</html>