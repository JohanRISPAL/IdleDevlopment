<?php

class Media_Answer{
	private $_id;
	private $_answer_ID;
	private $_media_ID;

	public function __construct($_id, $_answer_ID, $_media_ID){
		$this->_id = $_id;
		$this->_answer_ID = $_answer_ID;
		$this->_media_ID = $_media_ID;
	}

	public function getID(){
		return $this->_id;
	}

	public function setID($_id){
		$this->_id = $_id;
	}

	public function getAnswer_ID(){
		return $this->_answer_ID;
	}

	public function setAnswer_ID($_answer_ID){
		$this->_answer_ID = $_answer_ID;
	}

	public function getMedia_ID(){
		return $this->_media_ID;
	}

	public function setMedia_ID($_media_ID){
		$this->_media_ID = $_media_ID;
	}
}
?>