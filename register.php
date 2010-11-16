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
	/* Remove region option until supported.
	$region = $_POST['region']; 
	*/
	$region = "US";
  
	$character = new armoryscraper($region,$charRealm,$charName);

	$lvl = $character->getLevel();
	$race = $character->getRaceId();
	$sex = $character->getGenderId();
	$class = $character->getClassId();
	$faction = $character->getFactionId();
	$HK = $character->getLifetimeHonorableKills();
  
	
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
		
		/*
		echo "
		<table>
		<tr><td>Character</td> <td>$charName</td></tr>
		<tr><td>Realm</td> <td>$charRealm</td></tr>
		<tr><td>Level</td> <td>$lvl</td></tr>
		<tr><td>Race</td> <td>$race</td></tr>
		<tr><td>Sex</td> <td>$sex</td></tr>
		<tr><td>Class</td> <td>$class</td></tr>
		<tr><td>Faction</td> <td>$faction</td></tr>
		<tr><td>HK</td> <td>$HK</td></tr>
		</table>";
		*/
	
		$query = "INSERT INTO characters(charName, charRealm, lvl, race, sex, charClass, Faction, HK) VALUES ('$charName','$charRealm','$lvl','$race','$sex','$class','$faction','$HK')";
		$result = mysqli_query($db, $query)
			or die("Error inserting character into database.");
		echo "<h4>Character added to database.</h4>";
   
		$query = "INSERT INTO userCharacters(userName, charName, charRealm) VALUES ('$name', '$charName', '$charRealm')";
		$result = mysqli_query($db, $query)
			or die("Error adding user and character to join table.");
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