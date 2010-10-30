<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Account Creation</title>
</head>
<body>
<h1>hello world</h1>
  <?php
  include("db_connect.php");
  include('armoryscraper.php');
  
  $name = $_POST['username'];
  $pw = $_POST['pw'];
  $charName = $_POST['charName'];
  $charRealm = $_POST['charRealm'];
  $region = $_POST['region'];
  
  $character = new armoryscraper($region,$charRealm,$charName);
  
  $lvl = $character->getLevel();
  $race = $character->getRaceId();
  $sex = $character->getGenderId();
  $class = $character->getClassId();
  $faction = $character->getFactionId();
  $HK = $character->getLifetimeHonorableKills();
  
  $query = "INSERT INTO characters (charName, charRealm, lvl, race, sex, charClass, Faction, HK) VALUES ('$charName', '$charRealm', '$lvl', '$race', '$class', '$faction', '$HK')";
  $result = mysqli_query($db, $query)
   or die("Error Querying Database");
  
  ?>