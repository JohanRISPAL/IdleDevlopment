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

	public function getObjectVars(){
		return get_object_vars($this); 
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

	function createInformationDay(){
		$bdd = getConnexion();

		$query = $bdd->prepare("INSERT INTO informationday (label, dateOfDay) VALUES (?, ?);");
		$query->execute(array($_POST["label"], $_POST["date"]));
	}

	function updateInformationDay(){
		$bdd = getConnexion();

		$query = $bdd->prepare("UPDATE informationDay SET label = :label , dateOfDay = :dateDay  WHERE id = :id");
		$query->bindParam(':label', $_POST["label"], PDO::PARAM_STR);
		$query->bindParam(':dateDay', $_POST["date"], PDO::PARAM_STR);
		$query->bindParam(':id', $_POST["id"], PDO::PARAM_INT);
		$query->execute();
	}

	function deleteInformationDay(){
		$bdd = getConnexion();

		$query = $bdd->prepare("DELETE FROM informationDay WHERE id = :id");
		$query->bindParam(':id', $_POST["id"], PDO::PARAM_INT);
		$query->execute();		
	}

	function getInformationDay(){
		$bdd = getConnexion();

		$query = $bdd->prepare("SELECT * FROM informationDay");
		$query->execute();

		$queryResult = $query->fetchAll();

		$informationDays = array();

		foreach($queryResult as $q){
			$informationDay = new InformationDay($q["id"], $q["label"], $q["dateOfDay"]);
			$informationDayObjectVars = $informationDay->getObjectVars();
			array_push($informationDays, $informationDayObjectVars);
		}

		echo json_encode($informationDays);
	}

	function getInformationDayById(){
		$bdd = getConnexion();

		$query = $bdd->prepare("SELECT * FROM informationDay WHERE id = :id");
		$query->bindParam(':id', $_POST["informationDay_ID"], PDO::PARAM_INT);
		$query->execute();

		$queryResult = $query->fetchAll();

		$informationDays = array();

		foreach($queryResult as $q){
			$informationDay = new InformationDay($q["id"], $q["label"], $q["dateOfDay"]);
			$informationDayObjectVars = $informationDay->getObjectVars();
			array_push($informationDays, $informationDayObjectVars);
		}

		echo json_encode($informationDays);
	}

	function getOtherInformationDay(){
		$bdd = getConnexion();

		$query = $bdd->prepare("SELECT * FROM informationDay WHERE id != :id");
		$query->bindParam(':id', $_POST["informationDay_ID"], PDO::PARAM_INT);
		$query->execute();

		$queryResult = $query->fetchAll();

		$informationDays = array();

		foreach($queryResult as $q){
			$informationDay = new InformationDay($q["id"], $q["label"], $q["dateOfDay"]);
			$informationDayObjectVars = $informationDay->getObjectVars();
			array_push($informationDays, $informationDayObjectVars);
		}

		echo json_encode($informationDays);
	}
?>