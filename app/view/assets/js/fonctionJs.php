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
			array_push($candidate, , New Candidate($q["id"], $q["login"], $q["password"], $q["name"], $q["firstname"], $q["birthday"], $q["poleEmploiNumber"], $q["docket_ID"]));
		}
		
		echo json_encode($candidate);
	}
?>