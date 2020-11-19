<?php

class Answer{
	private $_id;
	private $_label;
	private $_isTrue;
	private $_question_ID;

	public function __construct($_id, $_label, $_isTrue, $_question_ID){
		$this->_id = $_id;
		$this->_label = $_label;
		$this->_isTrue = $_isTrue;
		$this->_question_ID = $_question_ID;
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

	public function getIsTrue(){
		return $this->_isTrue;
	}

	public function setIsTrue($_isTrue){
		$this->_isTrue = $_isTrue;
	}

	public function getQuestion_ID(){
		return $this->_question_ID;
	}

	public function setQuestion_ID($_question_ID){
		$this->_question_ID = $_question_ID;
	}

}
?>