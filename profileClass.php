<?php
include('armoryscraper.php');
class profile{
	private $name;
	private $realm;
	private $region;
	private $character;
	private $src;
	private $url;
	private $realName;
	private $age;
	private $description;
	private $location;
	private $contactInfo;
	private $hobbies;
	private $interestedIn;
	private $profileFile;
	private $image;
	
	function __construct($r,$server,$n) {
		$this->name = $n;
		$this->region = $r;
		$this->realm = $server;
		$this->character = new armoryscraper($this->region,$this->realm,$this->name);
		$this->src = $this->character->characterModelUrl();
		$this->url = "profile.php?character=".$this->name."&realm=".$this->realm."&region=".$this->region;
		@mkdir("profiles/$n",0777,true);
		$userName = $this->name;
		$this->profileFile = "profiles/$n/$n.txt";
		$this->image = "profiles/$n/$n.jpg";
		if(!file_exists($this->profileFile)){
			$newFile = copy("defaultPic.jpg",$this->image);
			$this->image = "profiles/$n/$n.jpg";
			$this->realName = "none";
			$this->age = "none";
			$this->description = "none";
			$this->location = "none";
			$this->contactInfo = "none";
			$this->hobbies = "none";
			$this->interestedIn = "none";
			$toWrite = $this->realName."\n".$this->age."\n".$this->description."\n".$this->location."\n".$this->contactInfo."\n".$this->hobbies."\n".$this->interestedIn."\n".$this->image;
			$file = fopen($this->profileFile,'w');
			fwrite($file,$toWrite);
			fclose($file);
		}
		$file = file($this->profileFile);
		$this->realName = $file[0];
		$this->age = $file[1];
		$this->description = $file[2];
		$this->location = $file[3];
		$this->contactInfo = $file[4];
		$this->hobbies = $file[5];
		$this->interestedIn = $file[6];
		$this->image = $file[7];
		
	}
	
	function getCharacterModel(){
		return $this->src;
	}
	
	function getUrl(){
		return $this->url;
	}
	
	function getCharacter(){
		return $this->character;
	}
	
	function getSrc(){
		return $this->src;
	}
	
	function getName(){
		return $this->name;
	}
	
	function getRealm(){
		return $this->realm;
	}
	
	function getRegion(){
		return $this->region;
	}
	
	function getRealName(){
		$file = file($this->profileFile);
		$realName = $file[0];
		return $realName;
	}
	
	function getAge(){
		$file = file($this->profileFile);
		$age = $file[1];
		return $age;
	}
	
	function getDescription(){
		$file = file($this->profileFile);
		$description = $file[2];
		return $description;
	}
	
	function getLocation(){
		$file = file($this->profileFile);
		$location = $file[3];
		return $location;
	}
	
	function getContactInfo(){
		$file = file($this->profileFile);
		$contactInfo = $file[4];
		return $contactInfo;
	}
	
	function getHobbies(){
		$file = file($this->profileFile);
		$hobbies = $file[5];
		return $hobbies;
	}
	
	function getInterestedIn(){
		$file = file($this->profileFile);
		$interestedIn = $file[6];
		return $interestedIn;
	}
	
	function getImage(){
		$file = file($this->profileFile);
		$interestedIn = $file[7];
		return $interestedIn;
	}
	
	function setImage($p, $n){
		copy($p,$this->image);
		$toWrite = $this->realName."\n".$this->age."\n".$this->description."\n".$this->location."\n".$this->contactInfo."\n".$this->hobbies."\n".$this->interestedIn."\n".$this->image;
		$file = fopen($this->profileFile,'w');
		fwrite($file,$toWrite);
		fclose($file);
	}
	function setRealName($p){
		$this->realName = $p;
		$toWrite = $this->realName."\n".$this->age."\n".$this->description."\n".$this->location."\n".$this->contactInfo."\n".$this->hobbies."\n".$this->interestedIn."\n".$this->image;
		$file = fopen($this->profileFile,'w');
		fwrite($file,$toWrite);
		fclose($file);
	}
	
	function setAge($p){
		$this->age = $p;
		$toWrite = $this->realName."\n".$this->age."\n".$this->description."\n".$this->location."\n".$this->contactInfo."\n".$this->hobbies."\n".$this->interestedIn."\n".$this->image;
		$file = fopen($this->profileFile,'w');
		fwrite($file,$toWrite);
		fclose($file);
	}
	
	function setDescription($p){
		$this->description = $p;
		$toWrite = $this->realName."\n".$this->age."\n".$this->description."\n".$this->location."\n".$this->contactInfo."\n".$this->hobbies."\n".$this->interestedIn."\n".$this->image;
		$file = fopen($this->profileFile,'w');
		fwrite($file,$toWrite);
		fclose($file);
	}
	
	function setLocation($p){
		$this->location = $p;
		$toWrite = $this->realName."\n".$this->age."\n".$this->description."\n".$this->location."\n".$this->contactInfo."\n".$this->hobbies."\n".$this->interestedIn."\n".$this->image;
		$file = fopen($this->profileFile,'w');
		fwrite($file,$toWrite);
		fclose($file);
	}
	
	function setContactInfo($p){
		$this->contactInfo = $p;
		$toWrite = $this->realName."\n".$this->age."\n".$this->description."\n".$this->location."\n".$this->contactInfo."\n".$this->hobbies."\n".$this->interestedIn."\n".$this->image;
		$file = fopen($this->profileFile,'w');
		fwrite($file,$toWrite);
		fclose($file);
	}
	
	function setHobbies($p){
		$this->hobbies = $p;
		$toWrite = $this->realName."\n".$this->age."\n".$this->description."\n".$this->location."\n".$this->contactInfo."\n".$this->hobbies."\n".$this->interestedIn."\n".$this->image;
		$file = fopen($this->profileFile,'w');
		fwrite($file,$toWrite);
		fclose($file);
	}
	
	function setInterestedIn($p){
		$this->interestedIn = $p;
		$toWrite = $this->realName."\n".$this->age."\n".$this->description."\n".$this->location."\n".$this->contactInfo."\n".$this->hobbies."\n".$this->interestedIn."\n".$this->image;
		$file = fopen($this->profileFile,'w');
		fwrite($file,$toWrite);
		fclose($file);
	}
	
	function printProfile(){
		return  $this->realName."\n".$this->age."\n".$this->description."\n".$this->location."\n".$this->contactInfo."\n".$this->hobbies."\n".$this->interestedIn."\n".$this->image;
	}
}
?>