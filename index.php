<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>World of Warcraft Dating</title>
<link rel = "stylesheet" type = "text/css" href = "style.css" />
</head>
<body>
<div id="wrap">
<?php include("header.php"); ?>
<h1>Welcome to Romance in Azeroth!</h1>

<h4>Romance in Azeroth is a dating website dedicated to finding the perfect match for your World of Warcraft persona. We do this by finding the closest match among our users to your character's stats. These stats currently include realm, level, race, sex, class, faction and the number of honor killings. You don't have to do anything but register with a username, character name and realm and we do the rest!
</h4>
<font color = "505050"><table border = 1>
<tr><td>Project Demo #1: Created and connected to database, created working login and register forms, scraped character information from the WoW Armory API, created working recommender class that uses Euclidean distance 
<br>*Need to normalize recommender, create user profiles, allow for recommending a specific gender, make website pretty
</td></tr></table><h4>
Before we find your character's match, you should specify a few things below:</h4>
<form action = "recommender.php" method = "GET">
I want: <input type = "radio" name = "sex" value = "male" checked/> Male matches   
<input type = "radio" name = "sex" value = "female"> Female matches<br>
I want matches: <input type = "radio" name = "realm" value = "same"/> to be from my realm
<input type = "radio" name = "realm" value = "any" checked/> to be from any realm<br>
I want matches: <input type = "radio" name = "faction" value = "same"/> to be from my faction
<input type = "radio" name = "faction" value = "any" checked/> to be from any faction<br>
<input type = "submit" value = "Find My Match!"/>
</form></font>
<?php include("footer.html"); ?>
</div>
</body>
</html>
