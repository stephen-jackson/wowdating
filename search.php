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
	include ("recommender.php");
	
	$aCharName = $_GET['charName'];
	$aCharRealm = $_GET['charRealm'];
	
	echo "<h2>Searching for a <span style=\"color:#ff6666\">";
	/* male, female */
	if($_GET['sex'] == "male"){
		$addressSex = 0;
		echo "male";
	}
	if($_GET['sex'] == "female"){
		$addressSex = 1;
		echo "female";
	}
	/* same, any */
	$addressRealm = $_GET['realm'];
	/* same, any */
	$addressFaction = $_GET['faction'];
	echo "</span> in <span style=\"color:#ff6666\">$addressFaction faction</span> on <span style=\"color:#ff6666\">$addressRealm realm</span>...</h2>";
	
	/* Grab user's character */
	$query = "SELECT * FROM usercharacters NATURAL JOIN characters WHERE userChar='$aCharName' AND userRealm='$aCharRealm'";
	$result = mysqli_query($db, $query)
		or die ("Query Error: Cannot query character.");
	
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
	}
	
	$userArray = array();
	array_push($userArray, $userName, $charName, $charRealm, $lvl, $race, $sex, $class, $faction, $guild, $primarySpec, $secondarySpec, $pvpAch, $dungeonAch, $reputationAch, $worldAch, $explorationAch, $questAch, $professionAch, $hk);
	
	/* Grab all other characters */
	$recommend = new recommender($userName, $charName, $charRealm, $lvl, $race, $sex, $class, $faction, $guild, $primarySpec, $secondarySpec, $pvpAch, $dungeonAch, $reputationAch, $worldAch, $explorationAch, $questAch, $professionAch, $hk);
	$query = "SELECT * FROM userCharacters JOIN characters WHERE charName = userChar AND sex=$addressSex";
	$add = "";
	if($addressRealm = "same") {
		$add = $add." AND userRealm='$charRealm'";
	}
	if($addressFaction = "same") {
		$add = $add." AND faction=$faction";
	}
	$query = $query.$add;
	$result = mysqli_query($db, $query)
		or die ("Query Error: No characters in database.");
	
	/* test */
	$num_rows = mysqli_num_rows($result);
	if ($num_rows<1) {
		echo "<h2>There are no current suggestions for you.</h2>";
	}
	
	while ($row = mysqli_fetch_assoc($result)) {
		if ($row['userChar'] <> $aCharName) {
			$userName = $row['userId'];
			$charName = $row['userChar'];
			$charRealm = $row['userRealm'];
			$lvl = $row['lvl'];
			$race = $row['race'];
			$sex = $row['sex'];
			$class = $row['charClass'];
			$faction = $row['Faction'];
			$hk = $row['HK'];
			$otherUserArray = array();
			array_push($otherUserArray, $userName, $charName, $charRealm, $lvl, $race, $sex, $class, $faction, $guild, $primarySpec, $secondarySpec, $pvpAch, $dungeonAch, $reputationAch, $worldAch, $explorationAch, $questAch, $professionAch, $hk);
			$recommend->recommend($otherUserArray);
		}
	}
	
	$bestUser = $recommend->getBestPersonUsername();
	$query_toon = "SELECT userChar, userRealm FROM usercharacters JOIN characters WHERE userId = '$bestUser' AND userChar = charName";
	$query_result = mysqli_query($db, $query_toon)
		or die("Query Error: Cannot find a character for the closest user.");
	
	/* test */
	$num_rows = mysqli_num_rows($query_result);
	if ($num_rows<1) {
		echo "<h2>No current users match your criteria.</h2>";
	}
	
	while ($row = mysqli_fetch_assoc($query_result)) {
		$toon = $row['userChar'];
		$toonRealm = $row['userRealm'];
		$toonRegion = "US";
	}
	$charLinkUrl = "profile.php?character=$aCharName&realm=$aCharRealm&region=$toonRegion";
	$toonLinkUrl = "profile.php?character=$toon&realm=$toonRealm&region=$toonRegion";
	if(!$toon == null){
		echo "<h3>Recommending <a href=$toonLinkUrl><span style=\"color:#ff6666\">$toon - $toonRealm</span></a></h3>";	
		echo "<h4>for <a href=$charLinkUrl>$aCharName - $aCharRealm</a>.</h4>";
	}
?>

</body>
</html>