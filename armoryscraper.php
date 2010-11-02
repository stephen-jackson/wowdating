<?php
/**
 Author: Heather Martin (edited class constructor code from Giacomo Furlan)
 Date: 11/1/2010
 Description: This class acceses information about specific wow characters from the
			  world of warcraft armory
**/
class armoryscraper {
	private $general_xml;
	private $achiev_xml;
	private $rep_xml;
	private $statistics_xml;
	private $region;
	private $char_url;
	private $achiev_url;
	private $rep_url;
	private $statistics_url;
	
	/**
	  Constructor of the class.
	  @param $region EU or US
	  @param $server The server's name
	  @param $name The character's name
	  @param $force_cache TRUE: new data will be downloaded; FALSE: new data will be downloaded only if the cache one is outdated (3 days)
	*/
	function __construct($region,$server,$name, $force_cache = false) {
		
		$server = ucfirst(strtolower($server));
		//usfirst capitalizes the first letter of server and strtolower makes all other characters lower case
		$name = urlencode($name);
		$fileurl = "characters/$region/$server/$name/general.xml";
		$achievementfileurl = "characters/$region/$server/$name/achievemnts.xml";
		$reputationfileurl = "characters/$region/$server/$name/reputation.xml";
		$statisticsfileurl = "characters/$region/$server/$name/statistics.xml";
		//encodes the string name to be used in a query
		$this->region = $region;
		@mkdir("characters/$region/$server/$name/",0777,true); 
		//bool mkdir ( string $pathname [, int $mode = 0777 [, bool $recursive = false [, resource $context ]]] ) 
		//this is creating a directory specified by the pathname
		//makes a character folder, then a new folder depending on the region, server, and character name
		
		if($force_cache === true
		|| !file_exists($fileurl)
		|| time() - filemtime($fileurl) > 259200 /* 3 days*/ ) {
			switch($region) {
				case EU:
					$this->char_url = "http://eu.wowarmory.com/character-sheet.xml?";
					$this->achiev_url = "http://eu.wowarmory.com/character-achievements.xml?";
					$this->rep_url = "http://eu.wowarmory.com/character-reputation.xml?";
					$this->statistics_url = "http://eu.wowarmory.com/character-statistics.xml?";
					break;
				case US:
					$this->char_url = "http://www.wowarmory.com/character-sheet.xml?";
					$this->achiev_url = "http://www.wowarmory.com/character-achievements.xml?";
					$this->rep_url = "http://www.wowarmory.com/character-reputation.xml?";
					$this->statistics_url = "http://www.wowarmory.com/character-statistics.xml?";

					break;
				default:
					die("No valid region selected.\n");
			}
			/**********************************************************************
			  creates a curl session that accesses the character's general info xml file
			  from wowarmory and then saves the xml in file
			**********************************************************************/
			$g_string = $this->char_url."r=$server&n=$name";		
			$ch = curl_init();
			$useragent="Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10.5;" .
            			" it; rv:1.9.0.10) Gecko/2009042315 Firefox/3.0.10";
			curl_setopt ($ch, CURLOPT_URL, $g_string);
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt ($ch, CURLOPT_USERAGENT, $useragent); 
			$file_stream = curl_exec($ch);
			//$file_stream is storing the current curl session
			curl_close($ch);
			//curl session is closed
			$file = fopen($fileurl,'w');
			//$file is a variable which contains $fileurl as bounded to a stream
			fwrite($file,$file_stream);
			//writes the conents of the current curl session to the file
			fclose($file);
			
			/**********************************************************************
			  creates a curl session that accesses the character's achievment xml file
			  from wowarmory and then saves the xml in file2
			**********************************************************************/
			
			$a_string = $this->achiev_url."r=$server&n=$name";		
			$ch = curl_init();
			$useragent="Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10.5;" .
            			" it; rv:1.9.0.10) Gecko/2009042315 Firefox/3.0.10";
			curl_setopt ($ch, CURLOPT_URL, $a_string);
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt ($ch, CURLOPT_USERAGENT, $useragent); 
			$file_stream2 = curl_exec($ch);
			//$file_stream is storing the current curl session
			curl_close($ch);
			//curl session is closed
			$file2 = fopen($achievementfileurl,'w');
			//$file is a variable which contains $fileurl as bounded to a stream
			fwrite($file2,$file_stream2);
			//writes the conents of the current curl session to the file
			fclose($file2);
			
			/**********************************************************************
			  creates a curl session that accesses the character's reputation xml file
			  from wowarmory and then saves the xml in file3
			**********************************************************************/
			$r_string = $this->rep_url."r=$server&n=$name";		
			$ch = curl_init();
			$useragent="Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10.5;" .
            			" it; rv:1.9.0.10) Gecko/2009042315 Firefox/3.0.10";
			curl_setopt ($ch, CURLOPT_URL, $r_string);
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt ($ch, CURLOPT_USERAGENT, $useragent); 
			$file_stream3 = curl_exec($ch);
			curl_close($ch);
			$file3 = fopen($reputationfileurl,'w');
			fwrite($file3,$file_stream3);
			fclose($file3);
			
			/**********************************************************************
			  creates a curl session that accesses the character's reputation xml file
			  from wowarmory and then saves the xml in file3
			**********************************************************************/
			$s_string = $this->statistics_url."r=$server&n=$name";		
			$ch = curl_init();
			$useragent="Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10.5;" .
            			" it; rv:1.9.0.10) Gecko/2009042315 Firefox/3.0.10";
			curl_setopt ($ch, CURLOPT_URL, $s_string);
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt ($ch, CURLOPT_USERAGENT, $useragent); 
			$file_stream4 = curl_exec($ch);
			curl_close($ch);
			$file4 = fopen($statisticsfileurl,'w');
			fwrite($file4,$file_stream4);
			fclose($file4);
		}
		/**
		  assigns the private variables general_xml, achiev_xml, rep_xml as the files
		  obtained from the curl sessions
		*/
		$this->general_xml = simplexml_load_file(rawurlencode($fileurl));
		$this->achiev_xml = simplexml_load_file(rawurlencode($achievementfileurl));
		$this->rep_xml = simplexml_load_file(rawurlencode($reputationfileurl));
		$this->statistics_xml = simplexml_load_file(rawurlencode($statisticsfileurl));
	}
	
	/**
	  (String) Battle Group's name.
	*/
	function getBattleGroup() {
		return $this->general_xml->characterInfo->character["battleGroup"];
	}
	
	/**
	  (String) Armory's URL of the character.
	*/
	function getCharUrl() {
		return $this->char_url.$this->general_xml->characterInfo->character["charUrl"];
	}
	
	/**
	  (String) Name.
	*/
	function getName() {
		return utf8_decode($this->general_xml->characterInfo->character["name"]);
	}
	
	/**
	  (String) Class.
	*/
	function getClass() {
		return $this->general_xml->characterInfo->character["class"];
	}
	
	/**
	  (Integer) Class' ID.
	*/
	function getClassId() {
		return $this->general_xml->characterInfo->character["classId"];
	}
	
	/**
	  (String) Faction.
	*/
	function getFaction() {
		return $this->general_xml->characterInfo->character["faction"];
	}
	
	/**
	  (Integer) Faction's ID.
	*/
	function getFactionId() {
		return $this->general_xml->characterInfo->character["factionId"];
	}
	
	/**
	  (String) Gender.
	*/
	function getGender() {
		return $this->general_xml->characterInfo->character["gender"];
	}
	
	/**
	  (Integer) Gender's ID.
	*/
	function getGenderId() {
		return $this->general_xml->characterInfo->character["genderId"];
	}
	
	/**
	  (String) Guild name.
	*/
	function getGuildName() {
		return $this->general_xml->characterInfo->character["guildName"];
	}
	
	/**
	  (Integer) Level.
	*/
	function getLevel() {
		return $this->general_xml->characterInfo->character["level"];
	}
	
	/**
	  (String) Achievement total points.
	*/
	function getAchievementPoints() {
		return $this->general_xml->characterInfo->character["points"];
	}
	
	/**
	  (String) Race.
	*/
	function getRace() {
		return $this->general_xml->characterInfo->character["race"];
	}
	
	/**
	  (Integer) Race's ID.
	*/
	function getRaceId() {
		return $this->general_xml->characterInfo->character["raceId"];
	}
	
	/**
	  (String) Realm name.
	*/
	function getRealm() {
		return $this->general_xml->characterInfo->character["realm"];
	}
	
	/**
	  (Integer) Life-time honorable kills.
	*/
	function getLifetimeHonorableKills() {
		return $this->general_xml->characterInfo->characterTab->pvp->lifetimehonorablekills['value'];
	}
	
	/**
	  (String) Primary Spec Name.
	*/
	function getPrimarySpec() {
		foreach ($this->general_xml->characterInfo->characterTab->talentSpecs->talentSpec as $spec=>$data){
			if($data["group"] == 1){
				return $data["prim"];}
		}
	}
	
	/**
	  (String) Secondary Spec Name.
	*/
	function getSecondarySpec() {
		foreach ($this->general_xml->characterInfo->characterTab->talentSpecs->talentSpec as $spec=>$data){
			if($data["group"] == 2){
				return $data["prim"];}
		}
	}

	/**
	  (Integer) Percentage of PvP Achievements Earned
	*/
	function getPvpAchievementPoints() {
		$i = 0;
		//iterating over the array using foreach, assigning the current value to skill on each iteration
		foreach($this->general_xml->characterInfo->summary->category as $category => $data) {
			if ($data["name"] == "Player vs. Player"){
				$valuno = $data->c["earnedPoints"];
				$valdos = $data->c["totalPoints"];
				$val_one = intval($valuno);
				$val_two = intval($valdos);
				if ($val_one == 0){
					$average = 0;
					return $average;}
				else{
				$average = ($val_one / $val_two) * 100;
				return round($average);}
			}
		}
	}
	
	/**
	  (Integer) Percentage of Dungeon Achievements Earned
	*/
	function getDungeonAchievementPoints() {
		$i = 0;
		//iterating over the array using foreach, assigning the current value to skill on each iteration
		foreach($this->general_xml->characterInfo->summary->category as $category => $data) {
			if ($data["id"] == "168"){
				$valuno = $data->c["earnedPoints"];
				$valdos = $data->c["totalPoints"];
				$val_one = intval($valuno);
				$val_two = intval($valdos);
				if ($val_one == 0){
					$average = 0;
					return $average;}
				else{
				$average = ($val_one / $val_two) * 100;
				return round($average);}}
		}
	}
	
	/**
	  (Integer) Percentage of Profession Achievements Earned
	*/
	function getProfessionAchievementPoints() {
		$i = 0;
		//iterating over the array using foreach, assigning the current value to skill on each iteration
		foreach($this->general_xml->characterInfo->summary->category as $category => $data) {
			if ($data["name"] == "Professions"){
				$valuno = $data->c["earnedPoints"];
				$valdos = $data->c["totalPoints"];
				$val_one = intval($valuno);
				$val_two = intval($valdos);
				if ($val_one == 0){
					$average = 0;
					return $average;}
				else{
				$average = ($val_one / $val_two) * 100;
				return round($average);}}
		}
	}
	
	/**
	  (Integer) Percentage of Quest Achievements Earned
	*/
	function getQuestAchievementPoints() {
		$i = 0;
		//iterating over the array using foreach, assigning the current value to skill on each iteration
		foreach($this->general_xml->characterInfo->summary->category as $category => $data) {
			if ($data["name"] == "Quests"){
				$valuno = $data->c["earnedPoints"];
				$valdos = $data->c["totalPoints"];
				$val_one = intval($valuno);
				$val_two = intval($valdos);
				if ($val_one == 0){
					$average = 0;
					return $average;}
				else{
				$average = ($val_one / $val_two) * 100;
				return round($average);}}
		}
	}
	
	/**
	  (Integer) Percentage of Exploration Achievements Earned
	*/
	function getExplorationAchievementPoints() {
		$i = 0;
		//iterating over the array using foreach, assigning the current value to skill on each iteration
		foreach($this->general_xml->characterInfo->summary->category as $category => $data) {
			if ($data["name"] == "Exploration"){
				$valuno = $data->c["earnedPoints"];
				$valdos = $data->c["totalPoints"];
				$val_one = intval($valuno);
				$val_two = intval($valdos);
				if ($val_one == 0){
					$average = 0;
					return $average;}
				else{
				$average = ($val_one / $val_two) * 100;
				return round($average);}}
		}
	}
	
	/**
	  (Integer) Percentage of World Achievements Earned
	*/
	function getWorldAchievementPoints() {
		$i = 0;
		//iterating over the array using foreach, assigning the current value to skill on each iteration
		foreach($this->general_xml->characterInfo->summary->category as $category => $data) {
			if ($data["name"] == "World Events"){
				$valuno = $data->c["earnedPoints"];
				$valdos = $data->c["totalPoints"];
				$val_one = intval($valuno);
				$val_two = intval($valdos);
				if ($val_one == 0){
					$average = 0;
					return $average;}
				else{
				$average = ($val_one / $val_two) * 100;
				return round($average);}}
		}
	}
	
	/**
	  (Integer) Percentage of Reputation Achievements Earned
	*/
	function getReputationAchievementPoints() {
		$i = 0;
		//iterating over the array using foreach, assigning the current value to skill on each iteration
		foreach($this->general_xml->characterInfo->summary->category as $category => $data) {
			if ($data["name"] == "Reputation"){
				$valuno = $data->c["earnedPoints"];
				$valdos = $data->c["totalPoints"];
				$val_one = intval($valuno);
				$val_two = intval($valdos);
				if ($val_one == 0){
					$average = 0;
					return $average;}
				else{
				$average = ($val_one / $val_two) * 100;
				return round($average);}}
		}
	}
	
	/**
	  (Array) Primary profesions: return[0/1] => ["name" (String)] = profession name, ["skill" (Integer)] skill value.
	*/
	function getStatistics() {
		$i = 0;
		$array = array();
		//iterating over the array using foreach, assigning the current value to skill on each iteration
		foreach($this->statistics_xml->statistics->summary->statistic as $statistic => $data) {
			$return[$i] = array(
				"name" => $data["name"],
				"quantity" => $data["quantity"]
			);
			$array[] = $return[$i];
		}
		return $array;
		
	}
	
	/**
	  (Array) Primary profesions: return[0/1] => ["name" (String)] = profession name, ["skill" (Integer)] skill value.
	*/
	function getPrimaryProfessions() {
		$i = 0;
		$array = array();
		//iterating over the array using foreach, assigning the current value to skill on each iteration
		foreach($this->general_xml->characterInfo->characterTab->professions->skill as $skill => $data) {
			$return[$i] = array(
				"name" => $data["name"],
				"skill" => $data["value"]
			);
			$array[] = $return[$i];
		}
		return $array;
		
	}
	
	/**
	  (Array) Secondary profesions: return[0/1] => ["name" (String)] = profession name, ["skill" (Integer)] skill value.
	*/
	function getSecondaryProfessions() {
		$i = 0;
		$array = array();
		//iterating over the array using foreach, assigning the current value to skill on each iteration
		foreach($this->general_xml->characterInfo->characterTab->secondaryProfessions->skill as $skill => $data) {
			$return[$i] = array(
				"name" => $data["name"],
				"skill" => $data["value"]
			);
			$array[] = $return[$i];
		}
		return $array;
	}

	/**
	  Saves a string of the characters name, realm, level, raceid, genderid, classid, factionid, HK
	  to a text file located in that character's file
	**/
	function toDatabase(){
		$region = $this->region;
		$server = $this->getRealm();
		$name = $this->getName();
		$fileurl = "characters/$region/$server/$name/data.txt";
		$contents = $this->getName().",".$this->getRealm().",".
		$this->getLevel().",".$this->getRaceId().",".$this->getGenderId().
		",".$this->getClassId().",".$this->getFactionId().",".$this->getLifetimeHonorableKills();
		$file = fopen($fileurl,'w');
		//$file is a variable which contains $fileurl as bounded to a stream
		fwrite($file,$contents);
		//writes the conents of the current curl session to the file
		fclose($file);
	}
}
	
/**
  prints the contents of a 2d array
*/
function printArray($a){
	foreach ($a as $v1 => $n1) {
		foreach($n1 as $v2=>$n2){
			echo "$v2 - $n2 <br/>";
		}
	}
}
?>