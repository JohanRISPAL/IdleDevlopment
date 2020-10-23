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
		$recupInfo = $bdd->prepare("SELECT * FROM admin WHERE login = ? AND password = md5(?)");
		$recupInfo->execute(array($_POST["user"], $_POST["pass"]));

		$recupInfoData = $recupInfo->fetchAll();

		if ($recupInfo->rowCount() != 0)
		{
			$boolean = true;
			$_SESSION["user"] = $_POST["user"];
            $_SESSION["id"] = $recupInfoData[0]["id"];
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
		$recupInfo = $bdd->prepare("SELECT * FROM candidat WHERE login = ? AND password = md5(?)");
		$recupInfo->execute(array($_POST["user"], $_POST["pass"]));

		$recupInfoData = $recupInfo->fetchAll();

		if ($recupInfo->rowCount() != 0)
		{
			$boolean = true;
			$_SESSION["user"] = $_POST["user"];
            $_SESSION["id"] = $recupInfoData[0]["id"];
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
		$recupInfo = $bdd->prepare("SELECT * FROM projectManager WHERE login = ? AND password = md5(?)");
		$recupInfo->execute(array($_POST["user"], $_POST["pass"]));

		$recupInfoData = $recupInfo->fetchAll();

		if ($recupInfo->rowCount() != 0)
		{
			$boolean = true;
			$_SESSION["user"] = $_POST["user"];
            $_SESSION["id"] = $recupInfoData[0]["id"];
		}

		else 
		{
			$boolean = false;
		}
		

		echo json_encode($boolean);
	}
?>