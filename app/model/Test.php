<?php

class Test{
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

	public function getTest($bdd){
		$query = $bdd->prepare("SELECT * FROM test");
		$query->execute();
		$queryResult = $query->fetchAll();

		$test = array();

		foreach ($queryResult as $q) {
			array_push($test, New Test($q["id"], $q["label"], $q["informationDay_ID"]));
		}
		return $test;
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


	function getTest(){
		$bdd = getConnexion();

		$query = $bdd->prepare("SELECT * FROM test");
		$query->execute();
		$queryResult = $query->fetchAll();

		$tests = array();

		foreach ($queryResult as $q) {
			$test = New Test($q["id"], $q["label"], $q["informationDay_ID"]);
			$testObjectVars = $test->getObjectVars();
			array_push($tests, $testObjectVars);
		}

		echo json_encode($tests);
	}

	function createTest(){
		$bdd = getConnexion();

		$query = $bdd->prepare("INSERT INTO test (label, informationDay_ID) VALUES (:label, :informationDay_ID)");
		$query->bindParam(':label', $_POST["label"], PDO::PARAM_STR);
		$query->bindParam(':informationDay_ID', $_POST["informationDay_ID"], PDO::PARAM_INT);
		$query->execute();

		$query2 = $bdd->prepare("SELECT * FROM test ORDER BY id DESC LIMIT 1");
		$query2->execute();
		$queryResult = $query2->fetchAll();

		$tests = array();

		foreach ($queryResult as $q) {
			$test = New Test($q["id"], $q["label"], $q["informationDay_ID"]);
			$testObjectVars = $test->getObjectVars();
			array_push($tests, $testObjectVars);
		}

		echo json_encode($tests);
	}

	function getTestByID(){
		$bdd = getConnexion();

		$query = $bdd->prepare("SELECT * FROM test WHERE id = :id");
		$query->bindParam(':id', $_POST["test_ID"], PDO::PARAM_INT);
		$query->execute();

		$queryResult = $query->fetchAll();

		$tests = array();

		foreach ($queryResult as $q) {
			$test = New Test($q["id"], $q["label"], $q["informationDay_ID"]);
			$testObjectVars = $test->getObjectVars();
			array_push($tests, $testObjectVars);
		}

		echo json_encode($tests);
	}

	function updateTest(){
		$bdd = getConnexion();

		$query = $bdd->prepare("UPDATE test SET label = :label, informationDay_ID = :informationDay_ID WHERE id = :id ");
		$query->bindParam(":label", $_POST["label"], PDO::PARAM_STR);
		$query->bindParam(":informationDay_ID", $_POST["informationDay_ID"], PDO::PARAM_INT);
		$query->bindParam(":id", $_POST["id"], PDO::PARAM_INT);
		$query->execute();
	}

	function deleteTest(){
		$bdd = getConnexion();

		$query = $bdd->prepare("DELETE FROM test WHERE id = :id");
		$query->bindParam(':id', $_POST["id"], PDO::PARAM_INT);
		$query->execute();
	}

	function getTestByCandidate(){
		$bdd = getConnexion();

		$query = $bdd->prepare("SELECT test.id, test.label, test.informationDay_ID FROM test INNER JOIN informationday ON informationday.id = test.informationDay_ID INNER JOIN candidate_informationday ON candidate_informationday.informationday_ID = informationday.id INNER JOIN candidate ON candidate.id = candidate_informationday.candidate_ID WHERE candidate.id = :id ");
		$query->bindParam(":id", $_POST["id"], PDO::PARAM_INT);
		$query->execute();
		$queryResult = $query->fetchAll();

		$tests = array();

		foreach ($queryResult as $q) {
			$test = New Test($q["id"], $q["label"], $q["informationDay_ID"]);
			$testObjectVars = $test->getObjectVars();
			array_push($tests, $testObjectVars);
		}

		echo json_encode($tests);
	}

?>