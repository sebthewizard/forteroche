<?php

class Serial {
	
	private $_id,
			$_idUser,
			$_content,
			$_number,
			$_title,
			$_creationDate,
			$_lastUpdateDate;

	
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
	public function content() {return $this->_content;}
	public function number() {return $this->_number;}
	public function title() {return $this->_title;}
	public function creationDate() {return $this->_creationDate;}
	public function lastUpdateDate() {return $this->_lastUpdateDate;}
	
	// Setters
	public function setIdUser($idUser) {$this->_idUser = $idUser;}
	public function setContent($content) {$this->_content = $content;}
	public function setNumber($number) {$this->_number = $number;}
	public function setTitle($title) {$this->_title = $title;}
	public function setCreationDate($creationDate) {$this->_creationDate = $creationDate;}
	public function setLastUpdateDate($lastUpdateDate) {$this->_lastUpdateDate = $lastUpdateDate;}
}
