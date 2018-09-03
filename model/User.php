<?php

class User {
	
	private $_id,
			$_pseudo,
			$_passwd,
			$_admin,
			$_email;

	
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
	public function pseudo() {return $this->_pseudo;}
	public function passwd() {return $this->_passwd;}
	public function admin() {return $this->_admin;}
	public function email() {return $this->_email;}
	
	// Setters
	public function setPseudo($pseudo) {$this->_pseudo = $pseudo;}
	public function setPasswd($passwd) {$this->_passwd = $passwd;}
	public function setAdmin($admin) {$this->_admin = $admin;}
	public function setEmail($email) {$this->_email = $email;}
}
