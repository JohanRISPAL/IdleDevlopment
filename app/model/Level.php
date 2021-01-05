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

	public function getObjectVars(){
		return get_object_vars($this); 
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

	function createLevel(){
		$bdd = getConnexion();
		$query = $bdd->prepare("INSERT INTO level (label) VALUES (:level)");
		$query->bindParam(':level', $_POST["level"], PDO::PARAM_STR);
		$query->execute();
	}

	function updateLevel(){
		$bdd = getConnexion();
		$query = $bdd->prepare("UPDATE level SET level.label = :level WHERE level.id = :level_ID");
		$query->bindParam(':level', $_POST["level"], PDO::PARAM_STR);
		$query->bindParam(':level_ID', $_POST["level_ID"], PDO::PARAM_INT);
		$query->execute();
	}

	function deleteLevel(){
		$bdd = getConnexion();
		$query = $bdd->prepare("DELETE FROM level WHERE level.id = :level_ID");
		$query->bindParam(':level_ID', $_POST["level_ID"], PDO::PARAM_INT);
		$query->execute();
	}

	function getAllLevel(){
		$bdd = getConnexion();
		$query = $bdd->prepare("SELECT * FROM level");
		$query->execute();

		$queryResult = $query->fetchAll();

		$levels = array();

		foreach($queryResult as $q){
			$level = New Level($q["id"], $q["label"]);
			$levelObjectVars = $level->getObjectVars();
			array_push($levels, $levelObjectVars);
		}

		echo json_encode($levels);
	}

	function getLevelById(){
		$bdd = getConnexion();
		$query = $bdd->prepare("SELECT * FROM level WHERE id = :id");
		$query->bindParam(':id', $_POST["id"], PDO::PARAM_STR);
		$query->execute();

		$queryResult = $query->fetchAll();

		$levels = array();

		foreach($queryResult as $q){
			$level = New Level($q["id"], $q["label"]);
			$levelObjectVars = $level->getObjectVars();
			array_push($levels, $levelObjectVars);
		}

		echo json_encode($levels);
	}
?>