<?php

class Comment {
	
	private $_id,
			$_idUser,
			$_idSerial,
			$_signaled,
			$_creationDate,
			$_content;

	
	public function __construct(array $data) {
    	$this->hydrate($data);
  	}
	
	public function hydrate(array $data) {
  		foreach ($data as $key => $value) {
    		// On récupère le nom du setter correspondant à l'attribut.
    		$method = 'set'.ucfirst($key);
        	// Si le setter correspondant existe.
    		if (method_exists($this, $method)) {
      			// On appelle le setter.
      			$this->$method($value);
    		}
  		}
	}
	
	// Getters
	public function id() {return $this->_id;}
	public function idUser() {return $this->_idUser;}
	public function idSerial() {return $this->_idSerial;}
	public function signaled() {return $this->_signaled;}
	public function creationDate() {return $this->_creationDate;}
	public function content() {return $this->_content;}
	
	// Setters
	public function setIdUser($idUser) {$this->_idUser = $idUser;}
	public function setIdSerial($idSerial) {$this->_idSerial = $idSerial;}
	public function setSignaled($signaled) {$this->_signaled = $signaled;}
	public function setCreationDate($creationDate) {$this->_creationDate = $creationDate;}
	public function setContent($content) {$this->_content = $content;}
}