<?php 
/**
  Author: Heather Martin
**/
class recommender{
	private $bestPerson;
	private $bestDistance;
	private $firstRun;
	private $user;
	
	function __construct($user){
		$this->user = $user;
		$this->firstRun = true;
		$this->bestPerson = null;
		$this->bestDistance = 100;
	}
	function euclideanDistance($otherPerson){
		foreach($this->user as $value_one) {
			foreach($otherPerson as $value_two){
				$distance += pow(($value_one - $value_two), 2);
			}
		}
		$distance = sqrt($distance);
		return $distance;
	}

	function recommend($otherPerson){
		if($this->firstRun == true){
			$this->bestPerson = $otherPerson;
			$this->firstRun = false;
		}
		$distance = $this->euclideanDistance($otherPerson);
		if($distance < $this->bestDistance){
			$this->bestPerson = $otherPerson;
			$this->bestDistance = $distance;
		}
	}
	
	function getBestUser(){
		return $this->bestPerson;
	}
	
	function getUser(){
		return $this->user;
	}
	
	function getBestDistance(){
		return $this->bestDistance;
	}
	
	function getBestPersonUsername(){
		return $this->bestPerson[0];
	}
}
?>
	
	
		