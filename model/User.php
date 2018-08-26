<?php
require_once("model/Manager.php");

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
	public function setId($id) {
		$id = (int) $id;
    	if ($id > 0) {$this->_id = $id;}
		else throw new Exception('Id utilisateur non valide');
  	}

	public function setPseudo($pseudo) {
    	if (is_string($pseudo)) {$this->_pseudo = $pseudo;}
		else throw new Exception('Votre pseudo doit être une chaîne de caractères');
  	}
	
	public function setPasswd($passwd) {
    	if (is_string($passwd)) {$this->_passwd = $passwd;}
		else throw new Exception('Votre mot de passe doit être une chaîne de caractères');
  	}

	public function setAdmin($admin) {
		$admin = (int) $admin;
    	if ($admin >= 0) {$this->_admin = $admin;}
  	}
	
	public function setEmail($email) {
    	$this->_email = $email;
  	}
	
}
