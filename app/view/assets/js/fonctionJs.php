<?php
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

	function getAdmin()
	{
		$bdd = getConnexion();
		$query = $bdd->prepare("SELECT * FROM admin WHERE login = ? AND password = md5(?)");
		$query->execute(array($_POST["user"], $_POST["pass"]));

		$queryResult = $query->fetchAll();

		if ($query->rowCount() != 0)
		{
			$boolean = true;
			$_SESSION["user"] = $_POST["user"];
            $_SESSION["id"] = $queryResult[0]["id"];
		}

		else 
		{
			$boolean = false;
		}
		

		echo json_encode($boolean);
	}

	function getCandidat()
	{
		$bdd = getConnexion();
		$query = $bdd->prepare("SELECT * FROM candidat WHERE login = ? AND password = md5(?)");
		$query->execute(array($_POST["user"], $_POST["pass"]));

		$queryResult = $query->fetchAll();

		if ($query->rowCount() != 0)
		{
			$boolean = true;
			$_SESSION["user"] = $_POST["user"];
            $_SESSION["id"] = $queryResult[0]["id"];
		}

		else 
		{
			$boolean = false;
		}
		

		echo json_encode($boolean);
	}

	function getProjectManager()
	{
		$bdd = getConnexion();
		$query = $bdd->prepare("SELECT * FROM projectManager WHERE login = ? AND password = md5(?)");
		$query->execute(array($_POST["user"], $_POST["pass"]));

		$queryResult = $query->fetchAll();

		if ($query->rowCount() != 0)
		{
			$boolean = true;
			$_SESSION["user"] = $_POST["user"];
            $_SESSION["id"] = $queryResult[0]["id"];
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

	function getCandidateByInformationDay(){
		$bdd = getConnexion();
		$query = $bdd->prepare("SELECT * FROM `candidate` INNER JOIN candidate_informationday ON candidate.id = candidate_informationday.candidate_ID WHERE candidate_informationday.informationday_ID = :informationDay_ID ");
		$query->bindParam(':informationDay_ID', $_POST["informationDay_ID"], PDO::PARAM_INT);
		$query->execute();

		$queryResult = $query->fetchAll();

		$candidate = array();

		foreach ($queryResult as $q) {
			array_push($candidate, [$q["id"], $q["firstname"]]);
		}

		echo json_encode($candidate);
	}

	function deleteCandidateInformationDay(){
		$bdd = getConnexion();

		$query = $bdd->prepare("DELETE FROM candidate_informationDay WHERE id = :id");
		$query->bindParam(':id', $_POST["id"], PDO::PARAM_INT);
		$query->execute();
	}

	function addCandidateInformationDay(){
		$bdd = getConnexion();

		$query = $bdd->prepare("INSERT INTO candidate_informationDay (candidate_ID, informationDay_ID) VALUES (:candidate_ID, :informationday_ID");
		$query->bindParam(':candidate_ID', $_POST["candidate_ID"], PDO::PARAM_INT);
		$query->bindParam(':informationday_ID', $_POST[":informationday_ID"], PDO::PARAM_INT);
		$query->execute();
	}

	function getCandidateNotInInformationDay(){
		$bdd = getConnexion();
		$query = $bdd->prepare("SELECT candidate.id, candidate.name, candidate.firstname FROM candidate EXCEPT SELECT candidate.id, candidate.name, candidate.firstname FROM candidate INNER JOIN candidate_informationday on candidate_informationday.candidate_ID = candidate.id WHERE candidate_informationday.candidate_ID = candidate.id AND candidate_informationday.informationday_ID = :id");
		$query->bindParam(':id', $_POST["informationday_ID"], PDO::PARAM_INT);
		$query->execute();

		$queryResult = $query->fetchAll();

		$candidate = array();

		foreach ($queryResult as $q) {
			array_push($candidate, [$q["id"],$q["name"], $q["firstname"]]);
		}

		echo json_encode($candidate);
	}

	function addCandidateInInformationDay(){
		$bdd = getConnexion();
		$query = $bdd->prepare("INSERT INTO candidate_informationday (candidate_ID, informationday_ID) VALUES (:candidate_ID, :informationDay_ID)");
		$query->bindParam(':candidate_ID', $_POST["candidate_ID"], PDO::PARAM_INT);
		$query->bindParam(':informationDay_ID', $_POST["informationDay_ID"], PDO::PARAM_INT);
		$query->execute();
	}

	function getPlaningOfInformationDay(){
		$bdd = getConnexion();
		$query = $bdd->prepare("SELECT * FROM planing INNER JOIN informationday ON informationday.id = planing.informationDay_ID WHERE informationday.id = :informationDay_ID");
		$query->bindParam(':informationDay_ID', $_POST["informationDay_ID"], PDO::PARAM_INT);
		$query->execute();

		$queryResult = $query->fetchAll();

		$planing = array();

		foreach ($queryResult as $q) {
			array_push($planing, [$q["id"], $q["label"]]);
		}

		echo json_encode($planing);
	}

	function getCandidateOfPlaning(){
		$bdd = getConnexion();
		$query = $bdd->prepare("SELECT candidate.id, candidate.name, candidate.firstname, hour.label FROM candidate INNER JOIN planing_hour ON planing_hour.candidate_ID = candidate.id INNER JOIN planing ON planing.id = planing_hour.planing_ID INNER JOIN projectmanager ON projectmanager.id = planing_hour.projectManager_ID INNER JOIN hour ON hour.id = planing_hour.hour_ID INNER JOIN informationday ON informationday.id = planing.informationDay_ID WHERE informationday.id = :informationDay_ID AND planing.id = :planing_ID ORDER BY planing_hour.hour_ID");
		$query->bindParam(':informationDay_ID', $_POST["informationDay_ID"], PDO::PARAM_INT);
		$query->bindParam(':planing_ID', $_POST["informationDay_ID"], PDO::PARAM_INT);
		$query->execute();

		$queryResult = $query->fetchAll();

		$planing = array();

		foreach ($queryResult as $q) {
			array_push($planing, [$q["id"], $q["name"], $q["firstname"], $q["label"]]);
		}

		echo json_encode($planing);
	}

	function getProjectManagerOfPlaning(){
		$bdd = getConnexion();
		$query = $bdd->prepare("SELECT projectmanager.id, projectmanager.name, projectmanager.firstname FROM projectmanager INNER JOIN planing_hour ON planing_hour.projectManager_ID = projectmanager.id INNER JOIN planing ON planing.id = planing_hour.planing_ID WHERE planing.id = :planing_ID");
		$query->bindParam(':planing_ID', $_POST["planing_ID"], PDO::PARAM_INT);
		$query->execute();

		$queryResult = $query->fetchAll();

		$projectmanager = array();

		foreach ($queryResult as $q) {
			array_push($projectmanager, $q["id"], $q["name"], $q["firstname"]);
		}

		echo json_encode($projectmanager);
	}

	function getEmptyHourInPlaning(){
		$bdd = getConnexion();
		$query = $bdd->prepare("SELECT hour.id, hour.label FROM `hour` EXCEPT SELECT hour.id, hour.label FROM hour INNER JOIN planing_hour ON planing_hour.hour_ID = hour.id WHERE planing_ID = :planing_ID ");
		$query->bindParam(':planing_ID', $_POST["planing_ID"], PDO::PARAM_INT);
		$query->execute();

		$queryResult = $query->fetchAll();

		$hour = array();

		foreach ($queryResult as $q) {
			array_push($hour, [$q["id"], $q["label"]]);
		}

		echo json_encode($hour);
	}

	function getCandidateNotInPlaning(){
		$bdd = getConnexion();
		$query = $bdd->prepare("SELECT candidate.id, candidate.name, candidate.firstname FROM `candidate` EXCEPT SELECT candidate.id, candidate.name, candidate.firstname FROM candidate INNER JOIN planing_hour ON planing_hour.candidate_ID = candidate.id WHERE planing_ID = :planing_ID");
		$query->bindParam(':planing_ID', $_POST["planing_ID"], PDO::PARAM_INT);
		$query->execute();

		$queryResult = $query->fetchAll();

		$candidate = array();

		foreach ($queryResult as $q) {
			array_push($candidate, [$q["id"], $q["name"], $q["firstname"]]);
		}

		echo json_encode($candidate);
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

	function createDomain(){
		$bdd = getConnexion();
		$query = $bdd->prepare("INSERT INTO domain (label) VALUES (:label)");
		$query->bindParam(':label', $_POST["label"], PDO::PARAM_STR);
		$query->execute();
	}

	function updateDomain(){
		$bdd = getConnexion();
		$query = $bdd->prepare("UPDATE domain SET domain.label = :label WHERE domain.id = :domain_ID");
		$query->bindParam(':label', $_POST["label"], PDO::PARAM_STR);
		$query->bindParam(':domain_ID', $_POST["domain_ID"], PDO::PARAM_INT);
		$query->execute();
	}

	function deleteDomain(){
		$bdd = getConnexion();
		$query = $bdd->prepare("DELETE FROM domain WHERE domain.id = :domain_ID");
		$query->bindParam(':domain_ID', $_POST["domain_ID"], PDO::PARAM_INT);
		$query->execute();
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

	function getAllDomain(){
		$bdd = getConnexion();
		$query = $bdd->prepare("SELECT * FROM domain");
		$query->execute();

		$queryResult = $query->fetchAll();

		$domains = array();

		foreach($queryResult as $q){
			array_push($domains, [$q["id"], $q["label"]]);
		}

		echo json_encode($domains);
	}

	function getAllLevel(){
		$bdd = getConnexion();
		$query = $bdd->prepare("SELECT * FROM level");
		$query->execute();

		$queryResult = $query->fetchAll();

		$levels = array();

		foreach($queryResult as $q){
			array_push($levels, [$q["id"], $q["label"]]);
		}

		echo json_encode($levels);
	}

	function createQuestion(){
		$bdd = getConnexion();
		$query = $bdd->prepare("INSERT INTO question (label, isEliminatory, level_ID, domain_ID, test_ID) VALUES (:label, :isEliminatory, :level_ID, :domain_ID, null)");
		$query->bindParam(':label', $_POST["label"], PDO::PARAM_STR);
		$query->bindParam(':isEliminatory', $_POST["isEliminatory"], PDO::PARAM_INT);
		$query->bindParam(':level_ID', $_POST["level_ID"], PDO::PARAM_INT);
		$query->bindParam(':domain_ID', $_POST["domain_ID"], PDO::PARAM_INT);
		$query->execute();
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

	function getInformationDay(){
		$bdd = getConnexion();

		$query = $bdd->prepare("SELECT * FROM informationDay");
		$query->execute();

		$queryResult = $query->fetchAll();

		$informationDays = array();

		foreach($queryResult as $q){
			array_push($informationDays, [$q["id"], $q["label"], $q["dateOfDay"]]);
		}

		echo json_encode($informationDays);
	}

	function createTest(){
		$bdd = getConnexion();

		$query = $bdd->prepare("INSERT INTO test (label, informationDay_ID) VALUES (:label, :informationDay_ID)");
		$query->bindParam(':label', $_POST["label"], PDO::PARAM_STR);
		$query->bindParam(':informationDay_ID', $_POST["informationDay_ID"], PDO::PARAM_INT);
		$query->execute();
	}

	function getTestByID(){
		$bdd = getConnexion();

		$query = $bdd->prepare("SELECT * FROM test WHERE id = :id");
		$query->bindParam(':id', $_POST["test_ID"], PDO::PARAM_INT);
		$query->execute();

		$queryResult = $query->fetchAll();

		$test = array();

		foreach($queryResult as $q){
			array_push($test, [$q["id"], $q["label"], $q["informationDay_ID"]]);
		}

		echo json_encode($test);
	}

	function getInformationDayById(){
		$bdd = getConnexion();

		$query = $bdd->prepare("SELECT * FROM informationDay WHERE id = :id");
		$query->bindParam(':id', $_POST["informationDay_ID"], PDO::PARAM_INT);
		$query->execute();

		$queryResult = $query->fetchAll();

		$informationDays = array();

		foreach($queryResult as $q){
			array_push($informationDays, [$q["id"], $q["label"], $q["dateOfDay"]]);
		}

		echo json_encode($informationDays);
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

	function getQuestion(){
		$bdd = getConnexion();

		$query = $bdd->prepare("SELECT * FROM question WHERE test_ID IS NULL");
		$query->execute();

		$queryResult = $query->fetchAll();

		$questions = array();

		foreach($queryResult as $q){
			array_push($questions, [$q["id"], $q["label"]]);
		}

		echo json_encode($questions);
	}

	function putQuestionInTest(){
		$bdd = getConnexion();

		$query = $bdd->prepare("UPDATE question SET test_ID = :test_ID WHERE id = :id");
		$query->bindParam(":test_ID", $_POST["test_ID"], PDO::PARAM_STR);
		$query->bindParam(":id", $_POST["id"], PDO::PARAM_INT);
		$query->execute();
	}

	function getQuestionByTest(){
		$bdd = getConnexion();
		
		$query = $bdd->prepare("SELECT * FROM question WHERE test_ID = :test_ID");
		$query->bindParam(":test_ID", $_POST["test_ID"], PDO::PARAM_INT);
		$query->execute();
		$queryResult = $query->fetchAll();

		$questions = array();

		foreach($queryResult as $q){
			array_push($questions, [$q["id"], $q["label"], $q["isEliminatory"], $q["level_ID"], $q["domain_ID"], $q["test_ID"]]);
		}

		echo json_encode($questions);
	}

	function removeQuestionTest(){
		$bdd = getConnexion();
		
		$query = $bdd->prepare("UPDATE question SET test_ID = NULL WHERE id = :id");
		$query->bindParam(":id", $_POST["id"], PDO::PARAM_INT);
		$query->execute();
	}
?>