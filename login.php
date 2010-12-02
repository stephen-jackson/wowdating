<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Login</title>
<link rel = "stylesheet" type = "text/css" href = "style.css" />
</head>
<body>
<div id="wrap">
<?php include("header.php"); ?>
<?php
	include ("db_connect.php");
	include ("recommender.php");
	
	$name = mysqli_real_escape_string($db, trim($_POST['username']));
	$pw = mysqli_real_escape_string($db, trim($_POST['pw']));
	
	/* Log in user */
	$query = "SELECT * FROM users WHERE userName='$name' AND password='$pw'";
    $result = mysqli_query($db, $query);

	$num_rows = mysqli_num_rows($result);
	if ($num_rows<1) {
		echo "<h1>Invalid login</h1>";
		echo "<a href=loginForm.php>Try Again</a>";
	}
	else {
	
		$_SESSION['currentUser'] = $name;
		echo "<h1>Welcome, ".$_SESSION['currentUser']."!</h1>";
		
		/* Grab user's character */
		$values_query = "SELECT * FROM userCharacters NATURAL JOIN characters WHERE userId = '$name'";
		$result = mysqli_query($db, $values_query)
			or die ("Query Error: Cannot find any character(s) associated with username $name.");
		
		echo "<h4>Character profiles:";
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
			if($prevCharName != $charName){
				echo " <a href=$linkUrl>$charName - $charRealm</a>";
			}
			$prevCharName = $charName;
		}
		echo ".</h4>";
		
		$userArray = array();
		array_push($userArray, $userName, $charName, $charRealm, $lvl, $race, $sex, $class, $faction, $guild, $primarySpec, $secondarySpec, $pvpAch, $dungeonAch, $reputationAch, $worldAch, $explorationAch, $questAch, $professionAch, $hk);
		
		/* Grab all other characters */
		$recommend = new recommender($userName, $charName, $charRealm, $lvl, $race, $sex, $class, $faction, $guild, $primarySpec, $secondarySpec, $pvpAch, $dungeonAch, $reputationAch, $worldAch, $explorationAch, $questAch, $professionAch, $hk);
		$query = "SELECT * FROM userCharacters NATURAL JOIN characters";
		$result = mysqli_query($db, $query)
			or die ("Query Error: No characters in database.");
		
		/* test */
		$num_rows = mysqli_num_rows($result);
		if ($num_rows<1) {
			echo "<h2>Error: No characters in database.</h2>";
		}
		
		while ($row = mysqli_fetch_assoc($result)) {
			if (strtolower($row['userId']) <> strtolower($name)) {
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
				$otherUserArray = array();
				array_push($otherUserArray, $userName, $charName, $charRealm, $lvl, $race, $sex, $class, $faction, $guild, $primarySpec, $secondarySpec, $pvpAch, $dungeonAch, $reputationAch, $worldAch, $explorationAch, $questAch, $professionAch, $hk);
				$recommend->recommend($otherUserArray);
			}
		}
		
		$bestUser = $recommend->getBestPersonUsername();
		$query_toon = "SELECT userChar, userRealm FROM usercharacters NATURAL JOIN characters WHERE userId = '$bestUser'";
		$query_result = mysqli_query($db, $query_toon)
			or die("Query Error: Cannot find a character for the closest user.");
		
		/* test */
		$num_rows = mysqli_num_rows($query_result);
		if ($num_rows<1) {
			echo "<h2>Error: No closest user.</h2>";
		}
		
		while ($row = mysqli_fetch_assoc($query_result)) {
			$toon = $row['userChar'];
			$toonRealm = $row['userRealm'];
			$toonRegion = "US";
		}
		$linkUrl = "profile.php?character=".$toon."&realm=".$toonRealm."&region=".$toonRegion ;
		//echo "<h4>The closest user to you is: <a href=$linkUrl>$toon - $toonRealm</a>.</h4>";
	}
	?>
	
	</div>
</body>
</html>