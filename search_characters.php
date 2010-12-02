<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>List of Characters</title>
<link rel = "stylesheet" type = "text/css" href = "style.css" />
</head>
<body>
<div id="wrap">
<?php include("header.php"); ?>
<h1>List of Characters</h1>
<?php
	include ("db_connect.php");
	$query = "SELECT * FROM usercharacters JOIN realms WHERE userRealm=realmName ORDER BY userChar ASC";
	$result = mysqli_query($db, $query)
		or die("Error: Cannot query characters.");
?>
	<table align=center>
		<th width=100><h4>User</h4></th>
		<th width=200><h4>Character - Realm</h4></th>
<?php
	while ($row = mysqli_fetch_assoc($result)) {
		$user = $row['userId'];
		$char = $row['userChar'];
		$realm = $row['userRealm'];
		$region = $row['region'];
		print "<tr><td><a href=personal_profile.php?character=".$char."&realm=".$realm."&region=".$region.">"
			."<span style=\"color:#ff6666\">$user</span></a></td>"
			."<td><a href=profile.php?character=".$char."&realm=".$realm."&region=".$region.">"
			."<span style=\"color:#ff6666\">$char - $realm</span></a></td>";

	}
?>
	</table>
<?php include("footer.html"); ?>
</div>
</body>
</html>
