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
<h2>Profile Page</h2>
</div>
<?php 
	include('profileClass.php');
	$name = $_REQUEST['character'];
	$realm = $_REQUEST['realm'];
	$region = $_REQUEST['region'];
	$profile = new profile($region, $realm, $name);
	$character = $profile->getCharacter();
	$src = $profile->getSrc();
	$url = $profile->getUrl();
	/*
	$character = new armoryscraper($region,$realm,$name);
	$src = $character->characterModelUrl();
	$url = "personal_profile.php?character=".$name."&realm=".$realm."&region=".$region;
	*/
?>
<div id= "wrap">
<a href=<?php print "personal_".$url; ?>>Personal Information</a>
|
<a href=<?php print $url; ?>>Character Statistics</a>
|
<button type="button">Make Recommendation!</button>
</div>
<div id = "picture">
<h2 align = "center">Character Picture</h2>
<br><iframe src=<?php print $src; ?> scrolling="no" height="588" width="321" frameborder="0"></iframe><br />
</div>
<div id ="wrap" align = "left"> 
<h2>Statistics</h2>
<?php
	printGeneralInfo($character);
	$array = $character->getPrimaryProfessions();
	echo "Primary Professions: "."<br/>";
	printArray($array)."<br/>";
	$array = $character->getSecondaryProfessions();
	echo "<br/>";
	echo "Secondary Professions: "."<br/>";
	printArray($array)."<br/>";
	$array = $character->getStatistics();
	echo "<br/>";
	echo "Miscellaneous: "."<br/>";
	printArray($array)."<br/>";
?>
</div>
<?php include("footer.html"); ?>
</body>
</html>

