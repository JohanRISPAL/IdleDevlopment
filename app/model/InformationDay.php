<?php

class InformationDay{
	private $_id;
	private $_label;
	private $_dateOfDay;

	public function __construct($_id, $_label, $_dateOfDay){
		$this->_id = $_id;
		$this->_label = $_label;
		$this->_dateOfDay = $_dateOfDay;
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

	public function getDateOfDay(){
		return $this->_dateOfDay;
	}

	public function setDateOfDay($_dateOfDay){
		$this->_dateOfDay = $_dateOfDay;
	}

	public function getInformationDay($bdd){
		$query = $bdd->prepare("SELECT * FROM informationday");
		$query->execute();
		$queryResult = $query->fetchAll();

		$informationDay = array();

		foreach ($queryResult as $q) {
			array_push($informationDay, New InformationDay($q["id"], $q["label"], $q["dateOfDay"]));
		}
		return $informationDay;
	}


}	
?>