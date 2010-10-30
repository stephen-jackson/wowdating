<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Account Creation</title>
</head>
<body>
<h1>hello world</h1>
  <?php
  include "db_connect.php";
  include('armoryscraper.php');
  
  $name = $_POST['username'];
  $pw = $_POST['pw'];
  $charName = $_POST['charName'];
  $charRealm = $_POST['charRealm'];
  $region = $_POST['region'];
  
  $character = new armoryscraper("US",$charRealm,$charName);
  
  $lvl = $character->getLevel();
  $race = $character->getRaceId();
  $sex = $character->getGenderId();
  $class = $character->getClassId();
  $faction = $character->getFactionId();
  $HK = $character->getLifetimeHonorableKills();
  $query = "INSERT INTO characters (charName, charRealm, lvl, race, sex, charClass, Faction, HK) " . 
  		   "VALUES ('$charName', '$charRealm', '$lvl', '$race', '$class', '$faction', '$HK')";
  mysqli_query($db, $query);
  
  $result = mysqli_query($db, "SELECT * FROM characters");

while ($row = mysqli_fetch_assoc($result))
{
	//$street = $row['venueStreet'];
	//$city = $row['venueCity'];
	//$state = $row['venueState'];
	$jo=$row['charName'];
	$jon=$row['charRealm'];
	$zipcode=$row['lvl'];
	$description = $row['race'];
	$photo = $row['sex'];
	$map = $row['charClass'];
	$dollar = $row['Faction'];
	$hate = $row['HK'];
	echo $jo.$jon.$zipcode.$description.$photo.$map.$dollar.$hate;
}
  
  
  ?>