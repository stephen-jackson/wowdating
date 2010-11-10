<?php
include('armoryscraper.php');
class profile{
	private $name;
	private $realm;
	private $region;
	private $character;
	private $src;
	private $url;
	
	function __construct($r,$server,$n) {
		$this->name = $n;
		$this->region = $r;
		$this->realm = $server;
		$this->character = new armoryscraper($this->region,$this->realm,$this->name);
		$this->src = $this->character->characterModelUrl();
		$this->url = "profile.php?character=".$this->name."&realm=".$this->realm."&region=".$this->region;
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
}
?>