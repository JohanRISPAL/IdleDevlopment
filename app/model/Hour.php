<?php

class Hour{
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

	function getEmptyHourInPlaning(){
		$bdd = getConnexion();
		$query = $bdd->prepare("SELECT hour.id, hour.label FROM `hour` EXCEPT SELECT hour.id, hour.label FROM hour INNER JOIN planing_hour ON planing_hour.hour_ID = hour.id WHERE planing_ID = :planing_ID ");
		$query->bindParam(':planing_ID', $_POST["planing_ID"], PDO::PARAM_INT);
		$query->execute();

		$queryResult = $query->fetchAll();

		$hours = array();

		foreach ($queryResult as $q) {
			$hour = New Hour($q["id"], $q["label"]);
			$hourObjectVars = $hour->getObjectVars();
			array_push($hours, $hourObjectVars);
		}

		echo json_encode($hours);
	}
?>