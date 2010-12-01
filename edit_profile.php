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
<h2>Edit Profile</h2>
</div>
<?php
	include('profileClass.php');
	$name = $_REQUEST['character'];
	$realm = $_REQUEST['realm'];
	$realm = parseString($realm);
	$region = $_REQUEST['region'];
	$url = "profile.php?character=".$name."&realm=".$realm."&region=".$region."&edited=true";
	$profile = new profile($region, $realm, $name);
	$realName = $profile->getRealName();
	$age = $profile->getAge();
	$description = $profile->getDescription();
	$location = $profile->getLocation();
	$contactInfo = $profile->getContactInfo();
	$hobbies = $profile->getHobbies();
	$interests = $profile->getInterestedIn();
?>
<div id= "wrap" align= "center">
<form name="input" enctype="multipart/form-data" action="<?php print "personal_".$url;?>" method="post">
<table class ="pretty-table3">
<tr><td><th scope="row">Image - Specify a file:</th><tr><td> <th scope="row2"><input type="file" name="image" size="40">
<tr><td><th scope="row">Name:</th><tr><td> <th scope="row2"><input type="text" name="name" value="<?php print $realName;?>"/></th></td></tr>
<tr><td></td></tr>
<tr><td><th scope="row">Age:</th><tr><td> <th scope="row2"><input type="text" name="age" value="<?php print $age;?>"/></th></td></tr>
<tr><td></td></tr>
<tr><td><th scope="row">Description:</th><tr><td><th scope="row2"><input type="text" name="description" value="<?php print $description;?>"/></th></td></tr>
<tr><td></td></tr>
<tr><td><th scope="row">Location:</th><tr><td><th scope="row2"><input type="text" name="location" value="<?php print $location;?>"/></td></tr>
<tr><td></td></tr>
<tr><td><th scope="row">Contact Information:</th><tr><td><th scope="row2"><input type="text" name="contactInfo" value="<?php print $contactInfo;?>"/></th></td></tr>
<tr><td></td></tr>
<tr><td><th scope="row">Hobbies:</th><tr><td><th scope="row2"><input type="text" name="hobbies" value="<?php print $hobbies;?>"/></th></td></tr>
<tr><td></td></tr>
<tr><td><th scope="row">Interested in:</th><tr><td><th scope="row2"><input type="text" name="interests" value="<?php print $interests;?>"/></th></td></tr>
</table>
<input type="submit" value="Done" />
</form>
</div>
</body>
</html>