<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Account Creation</title>
<link rel = "stylesheet" type = "text/css" href = "style.css" />
</head>
<body>
<div id="wrap">
<?php
	include("header.php");
	include("db_connect.php");
	include('armoryscraper.php');
?>
<h1>Creating Account</h1>
<body>
<?php
	$name = $_POST['username'];
	$pw = $_POST['pw'];
	$charName = $_POST['charName'];
	$charRealm = $_POST['charRealm'];
	$region = $_POST['region'];
  
	$character = new armoryscraper($region,$charRealm,$charName);

	$lvl = $character->getLevel();
	$guild = $character->getGuildName();
	$primarySpec = $character->getPrimarySpec();
	$secondarySpec = $character->getSecondarySpec();
	$pvpAch = $character->getPvpAchievementPoints();
	$dungeonAch = $character->getDungeonAchievementPoints();
	$reputationAch = $character->getReputationAchievementPoints();
	$worldAch = $character->getWorldAchievementPoints();
	$explorationAch = $character->getExplorationAchievementPoints();
	$questAch = $character->getQuestAchievementPoints();
	$professionAch = $character->getProfessionAchievementPoints();
	$race = $character->getRaceId();
	$sex = $character->getGenderId();
	$class = $character->getClassId();
	$faction = $character->getFactionId();
	$HK = $character->getLifetimeHonorableKills();
	$battleGroup = $character->getBattleGroup();
  
	
	$query = "SELECT * FROM users WHERE userName='$name' AND password='$pw'";
    $result = mysqli_query($db, $query);
	$userExists = mysqli_num_rows($result);
	
	$query = "SELECT * FROM characters WHERE charName='$charName' AND charRealm='$charRealm'";
	$result = mysqli_query($db, $query);
	$charExists = mysqli_num_rows($result);
	if($userExists<1 and $charExists<1){
		$query = "INSERT INTO users(userName, password) VALUES ('$name', '$pw')";
		$result = mysqli_query($db, $query)
			or die("<br>Error adding user.<br />");	
		echo "<h4>User created.</h4>";
	
		$query = "INSERT INTO characters(charName, charRealm, lvl, race, sex, charClass, Faction, guild, primarySpec, secondarySpec, pvpAch, dungeonAch, reputationAch, worldAch, explorationAch, questAch, professionAch, HK) VALUES ('$charName','$charRealm','$lvl','$race','$sex','$class','$faction', '$guild', '$primarySpec', '$secondarySpec', '$pvpAch', '$dungeonAch', '$reputationAch', '$worldAch', '$explorationAch', '$questAch', '$professionAch', '$HK')";
		$result = mysqli_query($db, $query)
			or die("Error inserting character into database.");
		echo "<h4>Character added to database.</h4>";
   
		$query = "INSERT INTO userCharacters(userId, userChar, userRealm) VALUES ('$name', '$charName', '$charRealm')";
		$result = mysqli_query($db, $query)
			or die("Error adding user and character to join table.");
			
		$query = "INSERT INTO realms(realmName, region, battlegroup) VALUES ('$charRealm', '$region', '$battleGroup')";
		$result = mysqli_query($db, $query);
	}
	else{
		if($userExists > 0){
			echo "<p>Error: User already exists.</p>";
		}
		if($charExists > 0){
			echo "<p>Error: Character already exists.</p>";
		}
	}
  ?>
<?php include("footer.html"); ?>
 </div>
 </body>
 </html>