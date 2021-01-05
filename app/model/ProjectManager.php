<?php

	session_start();
	
class ProjectManager{
	private $_id;
	private $_login;
	private $_password;
	private $_name;
	private $_firstname;
	private $_idRole;

	public function __construct($_id, $_login, $_password, $_name, $_firstname, $_idRole){
		$this->_id = $_id;
		$this->_login = $_login;
		$this->_password = $_password;
		$this->_name = $_name;
		$this->_firstname = $_firstname;
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

	public function getIdRole(){
		return $this->_idRole;
	}

	public function setIdRole($_idRole){
		$this->_idRole = $_idRole;
	}

	public function getObjectVars(){
		return get_object_vars($this); 
	}

	public function getProjectManager($bdd){
		$query = $bdd->prepare("SELECT * FROM projectmanager");
		$query->execute();
		$queryResult = $query->fetchAll();

		$projectManager = array();

		foreach ($queryResult as $q) {
			array_push($projectManager, New ProjectMaager($q["id"], $q["login"], $q["password"], $q["name"], $q["firstname"], $q["idRole"]));
		}
		return $projectManager;
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

	function getProjectManager()
	{
		$bdd = getConnexion();
		$query = $bdd->prepare("SELECT * FROM projectManager WHERE login = ? AND password = md5(?)");
		$query->bindParam(':login', $login, PDO::PARAM_STR);
		$query->bindParam(':password', $password, PDO::PARAM_STR);
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

	function getProjectManagerOfPlaning()
	{
		$bdd = getConnexion();
		$query = $bdd->prepare("SELECT * FROM projectmanager INNER JOIN planing_hour ON planing_hour.projectManager_ID = projectmanager.id INNER JOIN planing ON planing.id = planing_hour.planing_ID WHERE planing.id = :planing_ID");
		$query->bindParam(':planing_ID', $_POST["planing_ID"], PDO::PARAM_INT);
		$query->execute();

		$queryResult = $query->fetchAll();

		$projectManagers = array();

		foreach ($queryResult as $q) {
			$projectManager = New ProjectManager($q["id"], $q["login"], $q["password"], $q["name"], $q["firstname"], $q["docket_ID"]);
			$projectManagerObjectVars = $projectManager->getObjectVars();
			array_push($projectManagers, $projectManagerObjectVars);
		}

		echo json_encode($projectManagers);
	}
?>