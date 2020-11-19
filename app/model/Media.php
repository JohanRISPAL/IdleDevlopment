<?php

class Media{
	private $_id;
	private $_url;

	public function __construct($_id, $_url){
		$this->_id = $_id;
		$this->_url = $_url;
	}

	public function getID(){
		return $this->_id;
	}

	public function setID($_id){
		$this->_id = $_id;
	}

	public function getUrl(){
		return $this->_url;
	}

	public function setUrl($_url){
		$this->_url = $_url;
	}
}
?>