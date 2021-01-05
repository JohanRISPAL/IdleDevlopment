<?php

class Answer{
	private $_id;
	private $_label;
	private $_isTrue;
	private $_question_ID;

	public function __construct($_id, $_label, $_isTrue, $_question_ID){
		$this->_id = $_id;
		$this->_label = $_label;
		$this->_isTrue = $_isTrue;
		$this->_question_ID = $_question_ID;
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

	public function getIsTrue(){
		return $this->_isTrue;
	}

	public function setIsTrue($_isTrue){
		$this->_isTrue = $_isTrue;
	}

	public function getQuestion_ID(){
		return $this->_question_ID;
	}

	public function setQuestion_ID($_question_ID){
		$this->_question_ID = $_question_ID;
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

	function createAnswer(){
		$bdd = getConnexion();

		$question = $bdd->prepare("SELECT id FROM question ORDER BY id DESC LIMIT 0, 1 ");
		$question->execute();
		$question_ID = $question->fetch();

		$query = $bdd->prepare("INSERT INTO answer (label, isTrue, question_ID) VALUES (:label, :isTrue, :question_ID)");
		$query->bindParam(':label', $_POST["label"], PDO::PARAM_STR);
		$query->bindParam(':isTrue', $_POST["isTrue"], PDO::PARAM_INT);
		$query->bindParam(':question_ID', $question_ID[0], PDO::PARAM_INT);
		$query->execute();
	}

	function getAnswerByQuestion(){
		$bdd = getConnexion();

		$query = $bdd->prepare("SELECT * FROM answer WHERE question_ID = :question_ID");
		$query->bindParam(":question_ID", $_POST["question_ID"], PDO::PARAM_INT);
		$query->execute();
		$queryResult = $query->fetchAll();

		$answers = array();

		foreach($queryResult as $q){
			$answer = new Answer($q["id"], $q["label"], $q["isTrue"], $q["question_ID"]);
			$answerObjectVars = $answer->getObjectVars();
			array_push($answers, $answerObjectVars);
		}

		echo json_encode($answers);
	}

	function updateAnswer(){
		$bdd = getConnexion();

		$query = $bdd->prepare("UPDATE answer SET label = :label, isTrue = :isTrue WHERE id = :id");
		$query->bindParam(":label", $_POST["label"], PDO::PARAM_STR);
		$query->bindParam(":isTrue", $_POST["isTrue"], PDO::PARAM_INT);
		$query->bindParam(":id", $_POST["id"], PDO::PARAM_INT);
		$query->execute();
	}

	function deleteAnswer(){
		$bdd = getConnexion();

		$query = $bdd->prepare("DELETE FROM answer WHERE question_ID = :id");
		$query->bindParam(":id", $_POST["id"], PDO::PARAM_INT);
		$query->execute();
	}
?>