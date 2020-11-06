<?php

class Result{
	private $_id;
	private $_isPassed;
	private $_candidate_ID;

	public function __construct($_id, $_isPassed, $_candidate_ID){
		$this->_id = $_id;
		$this->_isPassed = $_isPassed;
		$this->_candidate_ID = $_candidate_ID;
	}

	public function getID(){
		return $this->_id;
	}

	public function setID($_id){
		$this->_id = $_id;
	}

	public function getIsPassed(){
		return $this->_isPassed;
	}

	public function setIsPassed($_isPassed){
		$this->_isPassed = $_isPassed;
	}

	public function getCandidate_ID(){
		return $this->_candidate_ID;
	}

	public function setCandidate_ID($_candidate_ID){
		$this->_candidate_ID = $_candidate_ID;
	}
}
?>