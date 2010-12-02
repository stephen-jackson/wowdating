<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>WoW Dating: Search</title>
<link rel = "stylesheet" type = "text/css" href = "style.css" />
</head>
<body>
<div id="wrap">
<?php include("header.php"); ?>
<?php
	include ("db_connect.php");
	$name = $_SESSION['currentUser'];
	echo "<h1>$name's Characters</h1>";
	$values_query = "SELECT * FROM userCharacters JOIN characters WHERE userId = '$name' AND userChar = charName";
	$result = mysqli_query($db, $values_query)
		or die ("Query Error: Cannot find any character(s) associated with username $name.");
	
	echo "<h4>";
	while ($row = mysqli_fetch_assoc($result)) {
		$userName = $row['userId'];
		$charName = $row['userChar'];
		$charRealm = $row['userRealm'];
		$lvl = $row['lvl'];
		$race = $row['race'];
		$sex = $row['sex'];
		$class = $row['charClass'];
		$faction = $row['Faction'];
		$guild = $row['guild'];
		$primarySpec = $row['primarySpec'];
		$secondarySpec = $row['secondarySpec'];
		$pvpAch = $row['pvpAch'];
		$dungeonAch = $row['dungeonAch'];
		$reputationAch = $row['reputationAch'];
		$worldAch = $row['worldAch'];
		$explorationAch = $row['explorationAch'];
		$questAch = $row['questAch'];
		$professionAch = $row['professionAch'];	
		$hk = $row['HK'];
		$region = "US";
		$linkUrl = "profile.php?character=$charName&realm=$charRealm&region=$region";
		echo " <a href=$linkUrl>$charName - $charRealm</a></h4><h4>";
	}
	echo "</h4>";
	
	
?>
</body>
</html>