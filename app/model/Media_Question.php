<?php

class Media_Question{
	private $_id;
	private $_question_ID;
	private $_media_ID;

	public function __construct($_id, $_question_ID, $_media_ID){
		$this->_id = $_id;
		$this->_question_ID = $_question_ID;
		$this->_media_ID = $_media_ID;
	}

	public function getID(){
		return $this->_id;
	}

	public function setID($_id){
		$this->_id = $_id;
	}

	public function getQuestion_ID(){
		return $this->_question_ID;
	}

	public function setQuestion_ID($_question_ID){
		$this->_question_ID = $_question_ID;
	}

	public function getMedia_ID(){
		return $this->_media_ID;
	}

	public function setMedia_ID($_media_ID){
		$this->_media_ID = $_media_ID;
	}
}
?>