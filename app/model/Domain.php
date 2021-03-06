<?php

class Domain{
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

	public function getDomain($bdd){
		$query = $bdd->prepare("SELECT * FROM domain");
		$query->execute();
		$queryResult = $query->fetchAll();

		$domain = array();

		foreach ($queryResult as $q) {
			array_push($domain, New Domain($q["id"], $q["label"]));
		}
		return $domain;
	}
}

	if (isset($_POST["method"]))
	{
		if (!empty($_POST["method"]))
		{
			echo $_POST["method"]();
		}

	}

	function getConnexion2()
	{
		$bdd = new PDO('mysql:host=localhost;dbname=idledevlopment;charset=utf8', 'root', 'root');

		return $bdd;
	}

	function createDomain(){
		$bdd = getConnexion2();
		$query = $bdd->prepare("INSERT INTO domain (label) VALUES (:label)");
		$query->bindParam(':label', $_POST["label"], PDO::PARAM_STR);
		$query->execute();

		$query2 = $bdd->prepare("SELECT * FROM domain ORDER BY id DESC LIMIT 1");
		$query2->execute();

		$query2Result = $query2->fetchAll();

		$domain = New Domain($query2Result[0]["id"], $query2Result[0]["label"]);
		$domainObjectVars = $domain->getObjectVars();

		echo json_encode($domainObjectVars);
	}

	function updateDomain(){
		$bdd = getConnexion2();
		$query = $bdd->prepare("UPDATE domain SET domain.label = :label WHERE domain.id = :domain_ID");
		$query->bindParam(':label', $_POST["label"], PDO::PARAM_STR);
		$query->bindParam(':domain_ID', $_POST["domain_ID"], PDO::PARAM_INT);
		$query->execute();
	}

	function deleteDomain(){
		$bdd = getConnexion2();
		$query = $bdd->prepare("DELETE FROM domain WHERE domain.id = :domain_ID");
		$query->bindParam(':domain_ID', $_POST["domain_ID"], PDO::PARAM_INT);
		$query->execute();
	}

	function getAllDomain(){
		$bdd = getConnexion2();
		$query = $bdd->prepare("SELECT * FROM domain");
		$query->execute();

		$queryResult = $query->fetchAll();

		$domains = array();

		foreach($queryResult as $q){
			$domain = New Domain($q["id"], $q["label"]);
			$domainObjectVars = $domain->getObjectVars();
			array_push($domains, $domainObjectVars);
		}

		echo json_encode($domains);
	}

	function getDomainById(){
		$bdd = getConnexion2();
		$query = $bdd->prepare("SELECT * FROM domain WHERE id = :id");
		$query->bindParam(':id', $_POST["id"], PDO::PARAM_INT);
		$query->execute();

		$queryResult = $query->fetchAll();

		$domains = array();

		foreach($queryResult as $q){
			$domain = New Domain($q["id"], $q["label"]);
			$domainObjectVars = $domain->getObjectVars();
			array_push($domains, $domainObjectVars);
		}

		echo json_encode($domains);
	}

	function getOtherDomain(){
		$bdd = getConnexion2();
		$query = $bdd->prepare("SELECT * FROM domain WHERE id != :id");
		$query->bindParam(':id', $_POST["id"], PDO::PARAM_INT);
		$query->execute();

		$queryResult = $query->fetchAll();

		$domains = array();

		foreach($queryResult as $q){
			$domain = New Domain($q["id"], $q["label"]);
			$domainObjectVars = $domain->getObjectVars();
			array_push($domains, $domainObjectVars);
		}

		echo json_encode($domains);
	}

?>