<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Profile Page</title>
<link rel = "stylesheet" type = "text/css" href = "style.css" />
</head>
<body>
<div id="wrap">
<?php include("header.php"); ?>
<h1>Profile Page</h1>
</div>
<?php 
	include ("db_connect.php");
	include('profileClass.php');
	$name = $_REQUEST['character'];
	$realm = $_REQUEST['realm'];
	$region = $_REQUEST['region'];
	$profile = new profile($region, $realm, $name);
	$character = $profile->getCharacter();
	$src = $profile->getSrc();
	$url = $profile->getUrl();
	/* Grab user's character */
	$query = "SELECT * FROM usercharacters NATURAL JOIN characters WHERE userChar='$name' AND userRealm='$realm'";
	$result = mysqli_query($db, $query)
		or die ("Query Error: Cannot query character.");
	
	while ($row = mysqli_fetch_assoc($result)) {
		$userName = $row['userId'];
	}
?>
<?php if(isset($_SESSION['currentUser']) && $_SESSION['currentUser'] == $userName){ ?>	
<div id= "wrap">
<a href=<?php print "personal_".$url; ?>>Personal Information</a>
|
<a href=<?php print $url; ?>>Character Statistics</a>
|
<a href=<?php print "recommend_me_a_".$url; ?>>Recommendation Preferences</a>
</div>
<?php } else { ?>
<div id= "wrap">
<a href=<?php print "personal_".$url; ?>>Personal Information</a>
|
<a href=<?php print $url; ?>>Character Statistics</a>
<?php 
	$currentUser = $_SESSION['currentUser'];
	$query = "SELECT * FROM friends WHERE userOne='$currentUser'";
	$result = mysqli_query($db, $query)
		or die("Error: Could not query friendships.");
	if(mysqli_num_rows($result) == 0) {
		print "|<a href=add_friend.php?character=".$name."&realm=".$realm."&region=".$region.">Add Friend</a>";
	}
?>
</div>
<?php } ?>
<div id = "picture">
<br><iframe src=<?php print $src; ?> scrolling="no" height="588" width="321" frameborder="0"></iframe><br />
</div>
<div id = "wrap2" align = "right">
<table class ="pretty-table">
<tr><td><th scope="row">Name:</th></td><td><th scope="row2"><?php print $character->getName();?></th></td></tr>
<tr><td><th scope="row">Realm:</th></td><td><th scope="row2"><?php print $character->getRealm();?></th></td></tr>
<tr><td><th scope="row">Battlegroup:</th></td><td><th scope="row2"><?php print $character->getBattleGroup();?></th></td></tr>
<tr><td><th scope="row">Faction:</th></td><td><th scope="row2"><?php print $character->getFaction();?></th></td></tr>
<tr><td><th scope="row">Guild:</th></td><td><th scope="row2"><?php print $character->getGuildName();?></th></td></tr>
<tr><td><th scope="row">Class:</th></td><td><th scope="row2"><?php print $character->getClass();?></th></td></tr>
<tr><td><th scope="row">Primary Spec:</th></td><td><th scope="row2"><?php print $character->getPrimarySpec();?></th></td></tr>
<tr><td><th scope="row">Secondary Spec:</th></td><td><th scope="row2"><?php print $character->getSecondarySpec();?></th></td></tr>
<tr><td><th scope="row">Level:</th></td><td><th scope="row2"><?php print $character->getLevel();?></th></td></tr>
<tr><td><th scope="row">Gender:</th></td><td><th scope="row2"><?php print $character->getGender();?></th></td></tr>
<tr><td><th scope="row">Race:</th></td><td><th scope="row2"><?php print $character->getRace();?></th></td></tr>
<tr><td><th scope="row">Honorable Kills:</th></td><td><th scope="row2"><?php print $character->getLifetimeHonorableKills();?></th></td></tr>
<tr><td><th scope="row">Pvp Achievments Completed:</th></td><td><th scope="row2"><?php print $character->getPvpAchievementPoints()."%";?></th></td></tr>
<tr><td><th scope="row">Dungeon Achievments Completed:</th></td><td><th scope="row2"><?php print $character->getDungeonAchievementPoints()."%";?></th></td></tr>
<tr><td><th scope="row">Reputation Achievments Completed:</th></td><td><th scope="row2"><?php print $character->getReputationAchievementPoints()."%";?></th></td></tr>
<tr><td><th scope="row">World Achievments Completed:</th></td><td><th scope="row2"><?php print $character->getWorldAchievementPoints()."%";?></th></td></tr>
<tr><td><th scope="row">Exploration Achievments Completed:</th></td><td><th scope="row2"><?php print $character->getExplorationAchievementPoints()."%";?></th></td></tr>
<tr><td><th scope="row">Quest Achievments Completed:</th></td><td><th scope="row2"><?php print $character->getQuestAchievementPoints()."%";?></th></td></tr>
<tr><td><th scope="row">Profession Achievments Completed:</th></td><td><th scope="row2"><?php print $character->getProfessionAchievementPoints()."%";?></th></td></tr>
<tr><td><th scope="row">Primary Professions:</th></td><td><th scope="row2"><?php print printArray($character->getPrimaryProfessions());?></th></td></tr>
<tr><td><th scope="row">Secondary Professions:</th></td><td><th scope="row2"><?php print printArray($character->getSecondaryProfessions());?></th></td></tr>
<tr><td><th scope="row">Miscellaneous:</th></td><td><th scope="row2"><?php print printArray($character->getStatistics());?></th></td></tr>
</table>
</div>
<?php include("footer.html"); ?>
</body>
</html>