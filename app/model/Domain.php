<?php

class Domain{
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

	public function getDomain($bdd){
		$query = $bdd->prepare("SELECT * FROM domain");
		$query->execute();
		$queryResult = $query->fetchAll();

		$domain = array();

		foreach ($queryResult as $q) {
			array_push($domain, New Domain($q["id"], $q["label"]));
		}
		return $domain;
	}
}
?>