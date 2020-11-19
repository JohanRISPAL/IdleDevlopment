<?php

class Admin{
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

	public function getAdmin($bdd){
		$query = $bdd->prepare("SELECT * FROM admin");
		$query->execute();
		$queryResult = $query->fetchAll();

		$admin = array();

		foreach ($queryResult as $q) {
			array_push($admin, New Admin($q["id"], $q["login"], $q["password"], $q["name"], $q["firstname"], $q["idRole"]));
		}
		return $admin;
	}

}
?>