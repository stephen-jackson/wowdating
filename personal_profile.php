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
	include('armoryscraper.php');
	$name = $_REQUEST['character'];
	$realm = $_REQUEST['realm'];
	$realm = parseString($realm);
	$region = $_REQUEST['region'];
	$url = "profile.php?character=".$name."&realm=".$realm."&region=".$region;
?>
<div id= "wrap">
<a href=<?php print "personal_".$url; ?>>Personal Information</a>
|
<a href=<?php print $url; ?>>Character Statistics</a>
</div>
<div id = "wrap" align = "left">
<img src="defaultPic.jpg" alt = "Default Picture"/><br/>
Name: <br/>
Age: <br/>
Description: <br/>
Location: <br/>
Contact Information: <br/>
Hobbies: <br/>
Interested in: <br/>
</div>
<?php include("footer.html"); ?>
</body>
</html>