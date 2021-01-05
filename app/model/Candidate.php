<?php

	session_start();

class Candidate{
	private $_id;
	private $_login;
	private $_password;
	private $_name;
	private $_firstname;
	private $_birthday;
	private $_poleEmploiNumber;
	private $_idRole;

	public function __construct($_id, $_login, $_password, $_name, $_firstname, $_birthday, $_poleEmploiNumber, $_idRole){
		$this->_id = $_id;
		$this->_login = $_login;
		$this->_password = $_password;
		$this->_name = $_name;
		$this->_firstname = $_firstname;
		$this->_birthday = $_birthday;
		$this->_poleEmploiNumber = $_poleEmploiNumber;
		$this->_idRole = $_idRole;
	}

	public function getID(){
		return $this->_id;
	}

	public function setID($_id){
		$this->_id = $_id;
	}

	public function getLogin(){
		return $this->_login;
	}

	public function setLogin($_login){
		$this->_login = $_login;
	}

	public function getPassword(){
		return $this->_password;
	}

	public function setPassword($_password){
		$this->_password = $_password;
	}

	public function getName(){
		return $this->_name;
	}

	public function setName($_name){
		$this->_name = $_name;
	}

	public function getFirstName(){
		return $this->_firstname;
	}

	public function setFirstName($_firstname){
		$this->_firstname = $_firstname;
	}

	public function getBirthday(){
		return $this->_birthday;
	}

	public function setBirthday($_birthday){
		$this->_birthday = $_birthday;
	}

	public function getPoleEmploiNumber(){
		return $this->_poleEmploiNumber;
	}

	public function setPoleEmploiNumber($_poleEmploiNumber){
		$this->_poleEmploiNumber = $_poleEmploiNumber;
	}

	public function getIdRole(){
		return $this->_idRole;
	}

	public function setIdRole($_idRole){
		$this->_idRole = $_idRole;
	}

	public function getObjectVars(){
		return get_object_vars($this); 
	}

	public function getCandidate($bdd){
		$query = $bdd->prepare("SELECT * FROM candidate");
		$query->execute();
		$queryResult = $query->fetchAll();

		$candidat = array();

		foreach ($queryResult as $q) {
			array_push($candidat, New Candidate($q["id"], $q["login"], $q["password"], $q["name"], $q["firstname"], $q["birthday"], $q["poleEmploiNumber"], $q["docket_ID"]));
		}
		return $candidat;
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

	function getCandidate()
	{
		$bdd = getConnexion();
		$query = $bdd->prepare("SELECT * FROM candidate WHERE login = ? AND password = md5(?)");
		$query->execute(array($_POST["user"], $_POST["pass"]));

		$queryResult = $query->fetch();

		if ($query->rowCount() != 0)
		{
			$boolean = true;
			$_SESSION["user"] = $_POST["user"];
            $_SESSION["id"] = $queryResult["id"];
		}

		else 
		{
			$boolean = false;
		}
		
		echo json_encode($boolean);
	}

	function createCandidate(){
		$bdd = getConnexion();

		$login = substr($_POST["firstName"], 0, 1). $_POST["name"];
		$password = substr($_POST["name"], 0, 1). $_POST["firstName"];

		$query = $bdd->prepare("INSERT INTO candidate (login, password, name, firstname, birthday, poleEmploiNumber, docket_ID) VALUES (?, md5(?), ?, ?, ?, ?, ?);");
		$query->execute(array($login, $password, $_POST["name"], $_POST["firstName"], $_POST["birthday"], $_POST["poleEmploiNumber"], 1));
	}

	function updateCandidate(){
		$bdd = getConnexion();
		$login = substr($_POST["firstName"], 0, 1). $_POST["name"];
		$password = substr($_POST["name"], 0, 1). $_POST["firstName"];

		$query = $bdd->prepare("UPDATE candidate SET login = :login, password = md5(:password), name = :name, firstname = :firstname, birthday = :birthday, poleEmploiNumber = :poleEmploiNumber  WHERE id = :id");
		$query->bindParam(':login', $login, PDO::PARAM_STR);
		$query->bindParam(':password', $password, PDO::PARAM_STR);
		$query->bindParam(':name', $_POST["name"], PDO::PARAM_STR);
		$query->bindParam(':firstname', $_POST["firstName"], PDO::PARAM_STR);
		$query->bindParam(':birthday', $_POST["birthday"], PDO::PARAM_STR);
		$query->bindParam(':poleEmploiNumber', $_POST["poleEmploiNumber"], PDO::PARAM_STR);
		$query->bindParam(':id', $_POST["id"], PDO::PARAM_INT);
		$query->execute();
	}

	function deleteCandidate(){
		$bdd = getConnexion();

		$query = $bdd->prepare("DELETE FROM candidate WHERE id = :id");
		$query->bindParam(':id', $_POST["id"], PDO::PARAM_INT);
		$query->execute();		
	}

	function getCandidateByInformationDay(){
		$bdd = getConnexion();
		$query = $bdd->prepare("SELECT * FROM `candidate` INNER JOIN candidate_informationday ON candidate.id = candidate_informationday.candidate_ID WHERE candidate_informationday.informationday_ID = :informationDay_ID ");
		$query->bindParam(':informationDay_ID', $_POST["informationDay_ID"], PDO::PARAM_INT);
		$query->execute();

		$queryResult = $query->fetchAll();

		$candidates = array();

		foreach ($queryResult as $q) {
			$candidate = New Candidate($q["id"], $q["login"], $q["password"], $q["name"], $q["firstname"], $q["birthday"], $q["poleEmploiNumber"], $q["docket_ID"]);
			$candidateObjectVars = $candidate->getObjectVars();
			array_push($candidates, $candidateObjectVars);
		}

		echo json_encode($candidates);
	}

	function deleteCandidateInformationDay(){
		$bdd = getConnexion();

		$query = $bdd->prepare("DELETE FROM candidate_informationDay WHERE id = :id");
		$query->bindParam(':id', $_POST["id"], PDO::PARAM_INT);
		$query->execute();
	}

	function getCandidateNotInInformationDay(){
		$bdd = getConnexion();
		$query = $bdd->prepare("SELECT candidate.id, candidate.name, candidate.firstname FROM candidate EXCEPT SELECT candidate.id, candidate.name, candidate.firstname FROM candidate INNER JOIN candidate_informationday on candidate_informationday.candidate_ID = candidate.id WHERE candidate_informationday.candidate_ID = candidate.id AND candidate_informationday.informationday_ID = :id");
		$query->bindParam(':id', $_POST["informationday_ID"], PDO::PARAM_INT);
		$query->execute();

		$queryResult = $query->fetchAll();

		$candidates = array();

		foreach ($queryResult as $q) {
			$candidate = New Candidate($q["id"], $q["login"], $q["password"], $q["name"], $q["firstname"], $q["birthday"], $q["poleEmploiNumber"], $q["docket_ID"]);
			$candidateObjectVars = $candidate->getObjectVars();
			array_push($candidates, $candidateObjectVars);
		}

		echo json_encode($candidates);
	}

	function addCandidateInInformationDay(){
		$bdd = getConnexion();
		$query = $bdd->prepare("INSERT INTO candidate_informationday (candidate_ID, informationday_ID) VALUES (:candidate_ID, :informationDay_ID)");
		$query->bindParam(':candidate_ID', $_POST["candidate_ID"], PDO::PARAM_INT);
		$query->bindParam(':informationDay_ID', $_POST["informationDay_ID"], PDO::PARAM_INT);
		$query->execute();
	}

	function getCandidateOfPlaning(){
		$bdd = getConnexion();
		$query = $bdd->prepare("SELECT *, hour.label FROM candidate INNER JOIN planing_hour ON planing_hour.candidate_ID = candidate.id INNER JOIN planing ON planing.id = planing_hour.planing_ID INNER JOIN projectmanager ON projectmanager.id = planing_hour.projectManager_ID INNER JOIN hour ON hour.id = planing_hour.hour_ID INNER JOIN informationday ON informationday.id = planing.informationDay_ID WHERE informationday.id = :informationDay_ID AND planing.id = :planing_ID ORDER BY planing_hour.hour_ID");
		$query->bindParam(':informationDay_ID', $_POST["informationDay_ID"], PDO::PARAM_INT);
		$query->bindParam(':planing_ID', $_POST["informationDay_ID"], PDO::PARAM_INT);
		$query->execute();

		$queryResult = $query->fetchAll();

		$candidates = array();

		foreach ($queryResult as $q) {
			$candidate = New Candidate($q["id"], $q["login"], $q["password"], $q["name"], $q["firstname"], $q["birthday"], $q["poleEmploiNumber"], $q["docket_ID"]);
			$candidateObjectVars = $candidate->getObjectVars();
			array_push($candidates, $candidateObjectVars);
			array_push($candidates, $q["label"]);
		}

		echo json_encode($candidates);
	}

	function getCandidateNotInPlaning(){
		$bdd = getConnexion();
		$query = $bdd->prepare("SELECT * FROM `candidate` EXCEPT SELECT * FROM candidate INNER JOIN planing_hour ON planing_hour.candidate_ID = candidate.id WHERE planing_ID = :planing_ID");
		$query->bindParam(':planing_ID', $_POST["planing_ID"], PDO::PARAM_INT);
		$query->execute();

		$queryResult = $query->fetchAll();

		$candidates = array();

		foreach ($queryResult as $q) {
			$candidate = New Candidate($q["id"], $q["login"], $q["password"], $q["name"], $q["firstname"], $q["birthday"], $q["poleEmploiNumber"], $q["docket_ID"]);
			$candidateObjectVars = $candidate->getObjectVars();
			array_push($candidates, $candidateObjectVars);
		}

		echo json_encode($candidates);
	}

	function addCandidateInPlaning(){
		$bdd = getConnexion();
		$query = $bdd->prepare("INSERT INTO planing_hour (planing_hour.candidate_ID, planing_hour.hour_ID, planing_hour.planing_ID, planing_hour.projectManager_ID) VALUES (:candidate_ID, :hour_ID, :planing_ID, :projectManager_ID)");
		$query->bindParam(':candidate_ID', $_POST["candidate_ID"], PDO::PARAM_INT);
		$query->bindParam(':hour_ID', $_POST["hour_ID"], PDO::PARAM_INT);
		$query->bindParam(':planing_ID', $_POST["planing_ID"], PDO::PARAM_INT);
		$query->bindParam(':projectManager_ID', $_POST["projectManager_ID"], PDO::PARAM_INT);
		$query->execute();
	}

	function deleteCandidateInPlaning(){
		$bdd = getConnexion();
		$query = $bdd->prepare("DELETE FROM planing_hour WHERE candidate_ID = :candidate_ID AND planing_ID = :planing_ID");
		$query->bindParam(':candidate_ID', $_POST["candidate_ID"], PDO::PARAM_INT);
		$query->bindParam(':planing_ID', $_POST["planing_ID"], PDO::PARAM_INT);
		$query->execute();
	}

	function insertCandidateAnswer(){
		$bdd = getConnexion();

		$query = $bdd->prepare("INSERT INTO answer_candidate (answerCandidate, candidate_ID, question_ID, test_ID) VALUES (:answerCandidate, :candidate_ID, :question_ID, :test_ID)");
		$query->bindParam(":answerCandidate", $_POST["answerCandidate"], PDO::PARAM_INT);
		$query->bindParam(":candidate_ID", $_POST["candidate_ID"], PDO::PARAM_INT);
		$query->bindParam(":question_ID", $_POST["question_ID"], PDO::PARAM_INT);
		$query->bindParam(":test_ID", $_POST["test_ID"], PDO::PARAM_INT);
		$query->execute();
	}
?>