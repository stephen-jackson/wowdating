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
<h1>Profile Page</h1>
</div>
<?php 
	include ("db_connect.php");
	include('profileClass.php');
	$name = $_REQUEST['character'];
	$realm = $_REQUEST['realm'];
	$realm = parseString($realm);
	$region = $_REQUEST['region'];
	$url = "profile.php?character=".$name."&realm=".$realm."&region=".$region;
	$edited = $_REQUEST['edited'];
	$profile = new profile($region, $realm, $name);
	$img = $profile->getImage();
	if($edited == true){
		$imageUrl = $_FILES['image']['tmp_name'];
		$imageName = $_FILES['image']['name'];
		$realName = $_REQUEST['name'];
		$age = $_REQUEST['age'];
		$description = $_REQUEST['description'];
		$location = $_REQUEST['location'];
		$contactInfo = $_REQUEST['contactInfo'];
		$hobbies = $_REQUEST['hobbies'];
		$interests = $_REQUEST['interests'];
		if($imageUrl!= null){
			$profile->setImage($imageUrl, $imageName);
		}
		if($realName!= null){
			$profile->setRealName($realName);
		}
		if($age!= null){
			$profile->setAge($age);
		}
		if($description!= null){
			$profile->setDescription($description);
		}
		if($location!= null){
			$profile->setLocation($location);
		}
		if($contactInfo!= null){
			$profile->setContactInfo($contactInfo);
		}
		if($hobbies!= null){
			$profile->setHobbies($hobbies);
		}
		if($interests!= null){
			$profile->setInterestedIn($interests);
		}
	}
	$img = $profile->getImage();
	$realName = $profile->getRealName();
	$age = $profile->getAge();
	$description = $profile->getDescription();
	$location = $profile->getLocation();
	$contactInfo = $profile->getContactInfo();
	$hobbies = $profile->getHobbies();
	$interests = $profile->getInterestedIn();
	/* Grab user's character */
	$query = "SELECT * FROM usercharacters NATURAL JOIN characters WHERE userChar='$name' AND userRealm='$realm'";
	$result = mysqli_query($db, $query)
		or die ("Query Error: Cannot query character.");
	
	while ($row = mysqli_fetch_assoc($result)) {
		$userName = $row['userId'];
	}
?>
<?php if(isset($_SESSION['currentUser']) && $_SESSION['currentUser'] == $userName){ ?>	
<div id= "wrap">
<a href=<?php print "personal_".$url; ?>>Personal Information</a>
|
<a href=<?php print $url; ?>>Character Statistics</a>
|
<a href=<?php print "recommend_me_a_".$url; ?>>Recommendation Preferences</a>
</div>
<?php } else { ?>
<div id= "wrap">
<a href=<?php print "personal_".$url; ?>>Personal Information</a>
|
<a href=<?php print $url; ?>>Character Statistics</a>
<?php 
	$currentUser = $_SESSION['currentUser'];
	$query = "SELECT * FROM friends WHERE userOne='$currentUser' AND userTwo='$userName'";
	$result = mysqli_query($db, $query)
		or die("Error: Could not query friendships.");
	if(mysqli_num_rows($result) == 0) {
		print "| <a href=add_friend.php?character=".$name."&realm=".$realm."&region=".$region.">Add Friend</a>";
	}
?>
</div>
<?php } ?>
</div>
<div id = "wrap2" align = "left">
<img src="<?php print $img; ?>" alt = "Default Picture" width="200" height="200"/><br /><br />
<table class ="pretty-table">
<tr><td><th scope="row">Name:</th></td><td><th scope="row2"><?php print $realName;?></th></td></tr>
<tr><td><th scope="row">Age:</th></td><td><th scope="row2"><?php print $age;?></th></td></tr>
<tr><td><th scope="row">Description:</th></td><td><th scope="row2"><?php print $description;?></th></td></tr>
<tr><td><th scope="row">Location:</th></td><td><th scope="row2"><?php print $location;?></th></td></tr>
<tr><td><th scope="row">Contact Information:</th></td><td><th scope="row2"><?php print $contactInfo;?></th></td></tr>
<tr><td><th scope="row">Hobbies:</th></td><td><th scope="row2"><?php print $hobbies;?></th></td></tr>
<tr><td><th scope="row">Interests:</th></td><td><th scope="row2"><?php print $interests;?></th></td></tr>
</table>
<?php if($_SESSION['currentUser'] == $userName){ ?>	
<br />
<div align = "center">
<form>
<input type="BUTTON" value="Edit" onclick="window.location.href='<?php print "edit_".$url;?>'"> 
</form>
</div>
<?php } ?>
</div>
<?php include("footer.html"); ?>
</body>
</html>