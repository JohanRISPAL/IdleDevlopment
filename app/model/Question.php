<?php

class Question{
	private $_id;
	private $_label;
	private $_isEliminatory;
	private $_level_ID;
	private $_domain_ID;
	private $_test_ID;

	public function __construct($_id, $_label, $_isEliminatory, $_level_ID, $_domain_ID, $_test_ID){
		$this->_id = $_id;
		$this->_label = $_label;
		$this->_isEliminatory = $_isEliminatory;
		$this->_level_ID = $_level_ID;
		$this->_domain_ID = $_domain_ID;
		$this->_test_ID = $_test_ID;
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

	public function getIsEliminatory(){
		return $this->_isEliminatory;
	}

	public function setIsEliminatory($_isEliminatory){
		$this->_isEliminatory = $_isEliminatory;
	}

	public function getLevel_ID(){
		return $this->_level_ID;
	}

	public function setLevel_ID($_level){
		$this->_level_ID = $_level_ID;
	}

	public function getDomain_ID(){
		return $this->_domain_ID;
	}

	public function setDomain_ID($_domain){
		$this->_domain_ID = $_domain_ID;
	}

	public function getTest_ID(){
		return $this->_test_ID;
	}

	public function setTest_ID($_test){
		$this->_test_ID = $_test_ID;
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

	function getQuestion(){
		$bdd = getConnexion();

		$query = $bdd->prepare("SELECT * FROM question");
		$query->execute();

		$queryResult = $query->fetchAll();

		$questions = array();

		foreach($queryResult as $q){
			$question = New Question($q["id"], $q["label"], $q["isEliminatory"], $q["level_ID"], $q["domain_ID"], $q["test_ID"]);
			$questionObjectVars = $question->getObjectVars();
			array_push($questions, $questionObjectVars);
		}

		echo json_encode($questions);
	}

	function getQuestionById(){
		$bdd = getConnexion();

		$query = $bdd->prepare("SELECT * FROM question WHERE id = :id");
		$query->bindParam(':id', $_POST["id"], PDO::PARAM_INT);
		$query->execute();

		$queryResult = $query->fetchAll();

		$questions = array();

		foreach($queryResult as $q){
			$question = New Question($q["id"], $q["label"], $q["isEliminatory"], $q["level_ID"], $q["domain_ID"], $q["test_ID"]);
			$questionObjectVars = $question->getObjectVars();
			array_push($questions, $questionObjectVars);
		}

		echo json_encode($questions);
	}

	function createQuestion(){
		$bdd = getConnexion();
		$query = $bdd->prepare("INSERT INTO question (label, isEliminatory, level_ID, domain_ID, test_ID) VALUES (:label, :isEliminatory, :level_ID, :domain_ID, null)");
		$query->bindParam(':label', $_POST["label"], PDO::PARAM_STR);
		$query->bindParam(':isEliminatory', $_POST["isEliminatory"], PDO::PARAM_INT);
		$query->bindParam(':level_ID', $_POST["level_ID"], PDO::PARAM_INT);
		$query->bindParam(':domain_ID', $_POST["domain_ID"], PDO::PARAM_INT);
		$query->execute();

		$query2 = $bdd->prepare("SELECT * FROM question ORDER BY id DESC LIMIT 1");
		$query2->execute();

		$query2Result = $query2->fetchAll();

		$question = New Question($query2Result[0]["id"], $query2Result[0]["label"], $query2Result[0]["isEliminatory"], $query2Result[0]["level_ID"], $query2Result[0]["domain_ID"], $query2Result[0]["test_ID"]);
		$questionObjectVars = $question->getObjectVars();

		echo json_encode($questionObjectVars);
	}

	function getQuestionWithoutTest(){
		$bdd = getConnexion();

		$query = $bdd->prepare("SELECT * FROM `question` WHERE test_ID IS NULL ");
		$query->execute();

		$queryResult = $query->fetchAll();

		$questions = array();

		foreach($queryResult as $q){
			$question = New Question($q["id"], $q["label"], $q["isEliminatory"], $q["level_ID"], $q["domain_ID"], $q["test_ID"]);
			$questionObjectVars = $question->getObjectVars();
			array_push($questions, $questionObjectVars);
		}

		echo json_encode($questions);
	}

	function putQuestionInTest(){
		$bdd = getConnexion();

		$query = $bdd->prepare("UPDATE question SET test_ID = :test_ID WHERE id = :id");
		$query->bindParam(":test_ID", $_POST["test_ID"], PDO::PARAM_INT);
		$query->bindParam(":id", $_POST["id"], PDO::PARAM_INT);
		$query->execute();
		

		$query2 = $bdd->prepare("SELECT * FROM question WHERE test_ID = :id ");
		$query2->bindParam(":id", $_POST["test_ID"], PDO::PARAM_INT);
		$query2->execute();

		$query2Result = $query2->fetchAll();

		$questions = array();

		foreach($query2Result as $q){
			$question = New Question($q["id"], $q["label"], $q["isEliminatory"], $q["level_ID"], $q["domain_ID"], $q["test_ID"]);
			$questionObjectVars = $question->getObjectVars();
			array_push($questions, $questionObjectVars);
		}

		echo json_encode($questions);
	}

	function removeQuestionTest(){
		$bdd = getConnexion();
		
		$query = $bdd->prepare("UPDATE question SET test_ID = NULL WHERE id = :id");
		$query->bindParam(":id", $_POST["id"], PDO::PARAM_INT);
		$query->execute();
	}

	function getQuestionByTest(){
		$bdd = getConnexion();

		$query = $bdd->prepare("SELECT question.id, question.label, question.isEliminatory, question.level_ID, question.domain_ID, question.test_ID FROM question INNER JOIN test ON test.id = question.test_ID WHERE test.id = :test_ID");
		$query->bindParam(":test_ID", $_POST["test_ID"], PDO::PARAM_INT);
		$query->execute();
		$queryResult = $query->fetchAll();

		$questions = array();

		foreach($queryResult as $q){
			$question = New Question($q["id"], $q["label"], $q["isEliminatory"], $q["level_ID"], $q["domain_ID"], $q["test_ID"]);
			$questionObjectVars = $question->getObjectVars();
			array_push($questions, $questionObjectVars);
		}

		echo json_encode($questions);
	}

	function updateQuestion(){
		$bdd = getConnexion();

		$query = $bdd->prepare("UPDATE question SET label = :label, isEliminatory = :isEliminatory, level_ID = :level_ID, domain_ID = :domain_ID WHERE id = :id");
		$query->bindParam(":label", $_POST["label"], PDO::PARAM_STR);
		$query->bindParam(":isEliminatory", $_POST["isEliminatory"], PDO::PARAM_INT);
		$query->bindParam(":level_ID", $_POST["level_ID"], PDO::PARAM_INT);
		$query->bindParam(":domain_ID", $_POST["domain_ID"], PDO::PARAM_INT);
		$query->bindParam(":id", $_POST["id"], PDO::PARAM_INT);
		$query->execute();
	}

	function deleteQuestion(){
		$bdd = getConnexion();

		$query = $bdd->prepare("DELETE FROM question WHERE id = :id");
		$query->bindParam(":id", $_POST["id"], PDO::PARAM_INT);
		$query->execute();
	}
?>