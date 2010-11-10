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
	
	$query = "SELECT * FROM users WHERE userName='$name' AND password='$pw'";
    $result = mysqli_query($db, $query);

	$num_rows = mysqli_num_rows($result);
	
	If ($num_rows<1) {
		Echo "<h1>Invalid login</h1>";
		Echo "<a href=loginForm.php>Try Again</a>";
	}
	Else {
	
		$_SESSION['currentUser'] = $name;
		Echo "<h1>Welcome ".$_SESSION['currentUser']."</h1>";
		
		$values_query = "select * from userCharacters join characters where userId = '$name' and userChar = charName";
		$result = mysqli_query($db, $values_query)
		or die ("You inserted an incorrect username.");
		
		while ($row = mysqli_fetch_assoc($result)) {
			$userName = $row['userId'];
			$lvl = $row['lvl'];
			$race = $row['race'];
			$sex = $row['sex'];
			$class = $row['charClass'];
			$faction = $row['Faction'];
			$hk = $row['HK'];
			
		}
		
		$userArray = array();
		array_push($userArray, $userName, $lvl, $race, $sex, $class, $faction, $hk);
		
		$recommend = new recommender($userArray);
		$query = "select * from userCharacters join characters on userChar = charName";
		$result = mysqli_query($db, $query)
		or die ("No rows");
		
		while ($row = mysqli_fetch_assoc($result)) {
			if ($row['userId'] <> $name) {
				$userName = $row['userId'];
				$lvl = $row['lvl'];
				$race = $row['race'];
				$sex = $row['sex'];
				$class = $row['charClass'];
				$faction = $row['Faction'];
				$hk = $row['HK'];
				$otherUserArray = array();
				array_push($otherUserArray, $userName, $lvl, $race, $sex, $class, $faction, $hk);
				$recommend->recommend($otherUserArray);
			}
		}
		
		$bestUser = $recommend->getBestPersonUsername();
		
		echo "<h1>The following user is closest to you is</h1>";
		echo "<h1>$bestUser</h1>";
	}
	?>
	</div>
</body>
</html>