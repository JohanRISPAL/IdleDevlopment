<?php

class Question{
	private $_id;
	private $_label;
	private $_isEliminatory;
	private $_urlMedia;
	private $_level_ID;
	private $_domain_ID;
	private $_test_ID;

	public function __construct($_id, $_label, $_isEliminatory, $_urlMedia, $_level_ID, $_domain_ID, $_test_ID){
		$this->_id = $_id;
		$this->_label = $_label;
		$this->_isEliminatory = $_isEliminatory;
		$this->_urlMedia = $_urlMedia;
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

	public function getUrlMedia(){
		return $this->_urlMedia;
	}

	public function setUrlMedia($_urlMedia){
		$this->_urlMedia = $_urlMedia;
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
}
?>