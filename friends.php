<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Your Friends</title>
<link rel = "stylesheet" type = "text/css" href = "style.css" />
</head>
<body>
<div id="wrap">
<?php include("header.php"); ?>
<h1>Friends</h1>
<?php
	include ("db_connect.php");
	$currentUser = $_SESSION['currentUser'];
	$query = "SELECT * FROM friends JOIN usercharacters JOIN realms WHERE userOne='$currentUser' AND userTwo=userId AND userRealm=realmName";
	$result = mysqli_query($db, $query)
		or die ("Error: Could not query database for friends.");
?>
	<table align=center>
		<th width=100><h4>User</h4></th>
		<th width=200><h4>Character - Realm</h4></th>
		<th width=80><h4>Remove</h4></th>
<?php
	while ($row = mysqli_fetch_assoc($result)) {
		$userName = $row['userId'];
		$charName = $row['userChar'];
		$realm = $row['userRealm'];
		$region = $row['region'];
		print "<tr><td><a href=personal_profile.php?character=".$charName."&realm=".$realm."&region=".$region.">"
			."<span style=\"color:#ff6666\">$userName</span></a></td>"
			."<td><a href=profile.php?character=".$charName."&realm=".$realm."&region=".$region.">"
			."<span style=\"color:#ff6666\">$charName - $realm</span></a></td>"
			."<td><a href=remove_friend.php?character=".$charName."&realm=".$realm."&region=".$region.">remove</a></td></tr>";
	}
?>
	</table>
<?php include("footer.html"); ?>
</div>
</body>
</html>