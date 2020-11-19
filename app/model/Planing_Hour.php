<?php

class Planing_Hour{
	private $_id;
	private $_planing;
	private $_hour_ID;
	private $_candidate_ID;
	private $_projectManager_ID

	public function __construct($_id, $_planing, $_hour_ID, $_candidate_ID, $_projectManager_ID){
		$this->_id = $_id;
		$this->_planing = $_planing;
		$this->_hour_ID = $_hour_ID;
		$this->_candidate_ID = $_candidate_ID;
		$this->_projectManager_ID = $_projectManager_ID;
	}

	public function getID(){
		return $this->_id;
	}

	public function setID($_id){
		$this->_id = $_id;
	}

	public function getPlaning(){
		return $this->_planing;
	}

	public function setPlaning($_planing){
		$this->_planing = $_planing;
	}

	public function getHour_ID(){
		return $this->_hour_ID;
	}

	public function setHour_ID($_hour_ID){
		$this->_hour_ID = $_hour_ID;
	}

	public function getCandidate_ID(){
		return $this->_candidate_ID;
	}

	public function setCandidate_ID($_candidate_ID){
		$this->_candidate_ID = $_candidate_ID;
	}

	public function getProjectManager_ID(){
		return $this->_projectManager_ID;
	}

	public function setProjectManager_ID($_projectManager_ID){
		$this->_projectManager_ID = $_projectManager_ID;
	}
}
?>