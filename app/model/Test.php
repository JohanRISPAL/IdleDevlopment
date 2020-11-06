<?php

class Test{
	private $_id;
	private $_label;
	private $_informationDay_ID;

	public function __construct($_id, $_label, $_informationDay_ID){
		$this->_id = $_id;
		$this->_label = $_label;
		$this->_informationDay_ID = $_informationDay_ID;
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

	public function getInformationDay_ID(){
		return $this->_informationDay_ID;
	}

	public function setInformationDay_ID($_informationDay_ID){
		$this->_informationDay_ID = $_informationDay_ID;
	}
}
?>