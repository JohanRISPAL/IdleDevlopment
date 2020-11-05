<?php

class InformationDay{
	private $_id;
	private $_label;
	private $_dateOfTheDay;

	public function __construct($_id, $_label, $_dateOfTheDay){
		$this->_id = $_id;
		$this->_label = $_label;
		$this->_dateOfTheDay = $_dateOfTheDay;
	}

	public function getID(){
		return $this->_id;
	}

	public function setID($_id){
		$this->_id = $_id;
	}

	public function getLabel(){
		return $this->_label;
	}

	public function setLabel($_label){
		$this->_label = $_label;
	}

	public function getDateOfTheDay(){
		return $this->_dateOfTheDay;
	}

	public function setDateOfTheDay($_dateOfTheDay){
		$this->_dateOfTheDay = $_dateOfTheDay;
	}

	public function getInformationDay($bdd){
		$query = $bdd->prepare("SELECT * FROM informationday");
		$query->execute();
		$queryResult = $query->fetchAll();

		$informationDay = array();

		foreach ($queryResult as $q) {
			array_push($informationDay, New InformationDay($q["id"], $q["label"], $q["dateOfTheDay"]));
		}
		return $informationDay;
	}


}	
?>