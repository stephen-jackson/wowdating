<?php 
/**
  Author: Heather Martin
**/
class recommender{
	private $userArray;
	private $bestPerson;
	private $bestDistance;
	private $firstRun;
	private $user;
	
	/* Constructs a recommender. */
	function __construct($userName, $charName, $charRealm, $lvl, $race, $sex, $class, $faction, $guild, $primarySpec, $secondarySpec, $pvpAch, $dungeonAch, $reputationAch, $worldAch, $explorationAch, $questAch, $professionAch, $hk){
		$this->userArray = array();
		/* 								 1			2			3		 4	   5	 6 		7		  8		 9 */
		array_push($this->userArray, $userName, $charName, $charRealm, $lvl, $race, $sex, $class, $faction, $guild, $primarySpec, $secondarySpec, $pvpAch, $dungeonAch, $reputationAch, $worldAch, $explorationAch, $questAch, $professionAch, $hk);
		$this->user = $userName;
		$this->firstRun = true;
		$this->bestPerson = null;
		$this->bestDistance = 0;
		$this->hkNum = 9;
	}
	
	/* Determines the distance of a user. */
	function euclideanDistance($otherPerson){
		$loopOne = 1;
		foreach($this->userArray as $value_one) {
			/* Stops comparing userName, charName, charRealm*/
			if($loopOne > 3){
				$loopTwo = 1;
				foreach($otherPerson as $value_two){
					if($loopOne == $loopTwo){
						$distance += pow(($value_one - $value_two), 2);
						/* echo "$value_one::$value_two  $loopOne || "; */
					}
					$loopTwo = $loopTwo + 1;
				}
			}
			$loopOne = $loopOne + 1;
		}
		$distance = sqrt($distance);
		/* echo "<br>"; */
		return $distance;
	}

	/* Determines if a user is the closest.
	   If the user is the closest, it will replace the bestPerson. */
	function recommend($otherPerson){
		if($this->firstRun == true){
			$distance = $this->euclideanDistance($otherPerson);
			$this->bestPerson = $otherPerson;
			$this->bestDistance = $distance;
			$this->firstRun = false;
		}
		else{
			$distance = $this->euclideanDistance($otherPerson);
			if($distance < $this->bestDistance){
				$this->bestPerson = $otherPerson;
				$this->bestDistance = $distance;
			}
		}
	}
	
	/* Returns the best user. */
	function getBestUser(){
		return $this->bestPerson;
	}
	
	/* Returns current user. */
	function getUser(){
		return $this->user;
	}
	
	/* Returns the best distance. */
	function getBestDistance(){
		return $this->bestDistance;
	}
	
	/* Returns the best user name. */
	function getBestPersonUsername(){
		return $this->bestPerson[0];
	}
}
?>