<?php

class Planing{
	private $_id;
	private $_label;
	private $_informationDay_ID;

	public function __construct($_id, $_label, $_informationDay_ID){
		$this->_id = $_id;
		$this->_label = $_label;
		$this->_informationDay_ID = $_informationDay_ID;

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

	public function getInformationDay_ID(){
		return $this->_informationDay_ID;
	}

	public function setInformationDay_ID($_informationDay_ID){
		$this->_informationDay_ID = $_informationDay_ID;
	}

	public function getObjectVars(){
		return get_object_vars($this); 
	}
}
	if (isset($_POST["method"]))
	{
		if (!empty($_POST["method"]))
		{
			echo $_POST["method"]();
		}
	}

	function getConnexion()
	{
		$bdd = new PDO('mysql:host=localhost;dbname=idledevlopment;charset=utf8', 'root', 'root');

		return $bdd;
	}
	

	function getPlaningOfInformationDay(){
		$bdd = getConnexion();
		$query = $bdd->prepare("SELECT * FROM planing INNER JOIN informationday ON informationday.id = planing.informationDay_ID WHERE informationday.id = :informationDay_ID");
		$query->bindParam(':informationDay_ID', $_POST["informationDay_ID"], PDO::PARAM_INT);
		$query->execute();

		$queryResult = $query->fetchAll();

		$planings = array();

		foreach ($queryResult as $q) {
			$planing = New Planing($q["id"], $q["label"]);
			$planingObjectVars = $planing->getObjectVars();
			array_push($planings, $planingObjectVars);
		}

		echo json_encode($planings);
	}
?>