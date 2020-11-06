<?php

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
?>