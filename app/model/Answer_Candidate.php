<?php

class Answer_Candidate{
	private $_id;
	private $_answerCandidate;
	private $_candidate_ID;
	private $_question_ID;
	private $_test_ID;

	public function __construct($_id, $_answerCandidate, $_candidate_ID, $_question_ID, $_test_ID){
		$this->_id = $_id;
		$this->_answerCandidate = $_answerCandidate;
		$this->_candidate_ID = $_candidate_ID;
		$this->_question_ID = $_question_ID;
		$this->_test_ID = $_test_ID;
	}

	public function getID(){
		return $this->_id;
	}

	public function setID($_id){
		$this->_id = $_id;
	}

	public function getAnswerCandidate(){
		return $this->_answerCandidate;
	}

	public function setAnswerCandidate($_answerCandidate){
		$this->_answerCandidate = $_answerCandidate;
	}

	public function getCandidate_ID(){
		return $this->_candidate_ID;
	}

	public function setCandidate_ID($_candidate_ID){
		$this->_candidate_ID = $_candidate_ID;
	}

	public function getQuestion_ID(){
		return $this->_question_ID;
	}

	public function setQuestion_ID($_question_ID){
		$this->_question_ID = $_question_ID;
	}

	public function getTest_ID(){
		return $this->_test_ID;
	}

	public function setTest_ID($_test_ID){
		$this->_test_ID = $_test_ID;
	}

}
?>