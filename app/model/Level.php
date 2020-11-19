<?php

class Level{
	private $_id;
	private $_label;

	public function __construct($_id, $_label){
		$this->_id = $_id;
		$this->_label = $_label;
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

	public function getLevel($bdd){
		$query = $bdd->prepare("SELECT * FROM level");
		$query->execute();
		$queryResult = $query->fetchAll();

		$level = array();

		foreach ($queryResult as $q) {
			array_push($level, New Level($q["id"], $q["label"]));
		}
		return $level;
	}
}
?>