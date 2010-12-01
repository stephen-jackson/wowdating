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
<a href=<?php print "recommend_me_a_".$url; ?>>Recommendation Preferences</a>
</div>
<div id = "wrap3" align = "center">
<form action = "search.php" method = "GET">
<table class ="pretty-table2">
<input type = "hidden" name = "charName" value = <?php print $name; ?>>
<input type = "hidden" name = "charRealm" value = <?php print $realm; ?>>
<tr><td><th scope="row">I want:</th></td><td><th scope="row2"><input type = "radio" name = "sex" value = "male" checked/>male matches<br> 
<input type = "radio" name = "sex" value = "female">female matches</th></td></tr>
<tr><td></td></tr>
<tr><td><th scope="row">I want matches:</th></td><td><th scope="row2"><input type = "radio" name = "realm" value = "same"/>from my realm<br>
<input type = "radio" name = "realm" value = "any" checked/>from any realm</th></td></tr>
<tr><td></td></tr>
<tr><td><th scope="row">I want matches:</th></td><td><th scope="row2"><input type = "radio" name = "faction" value = "same"/>from my faction<br>
<input type = "radio" name = "faction" value = "any" checked/>from any faction</th></td></tr>
</table>
<input type = "submit" value = "Make Recommendation"/>
</form></font>
</div>
<?php include("footer.html"); ?>
</body>
</html>