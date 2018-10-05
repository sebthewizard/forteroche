<?php
require_once("model/Manager.php");

class UsersManager extends Manager {
	
	private $_db;
	
	public function __construct() {
		$this->setDb($this->dbConnect());
  	}
	
	// Setters
  	public function setDb(PDO $db) {
    	$this->_db = $db;
  	}
	
	public function addUser(User $newUser) {
		$q = $this->_db->query('SELECT COUNT(*) AS nb FROM users WHERE pseudo = '.'\''.$newUser->pseudo().'\'') or die(print_r($this->_db->errorInfo()));
		$data = $q->fetch();
		if ($data['nb'] > 0) return false;
		$q = $this->_db->prepare('INSERT INTO users(pseudo, passwd, email) VALUES(:pseudo, :passwd, :email)');
		$q->execute(array(
			'pseudo' => $newUser->pseudo(),
			'passwd' => $newUser->passwd(),
			'email' => $newUser->email()
		)) or die(print_r($this->_db->errorInfo()));
		$q->closeCursor();
		return $this->getId($newUser->pseudo());
	}
	
	public function getUserId($pseudo) {
		$q = $this->_db->query('SELECT COUNT(*) AS nb FROM users WHERE pseudo = '.'\''.$pseudo.'\'') or die(print_r($this->_db->errorInfo()));
		$data = $q->fetch();
		if ($data['nb'] == 0) return false;
		$q = $this->_db->query('SELECT id FROM users WHERE pseudo = '.'\''.$pseudo.'\'') or die(print_r($this->_db->errorInfo()));
		$data = $q->fetch();
		$q->closeCursor();
		return $data['id'];
	}
	
	public function getUserPseudo($id) {
		$q = $this->_db->query('SELECT pseudo FROM users WHERE id = '.$id) or die(print_r($this->_db->errorInfo()));
		$data = $q->fetch();
		$q->closeCursor();
		return $data['pseudo'];
	}
	
	public function getUserPass($pseudo) {
		$q = $this->_db->query('SELECT passwd FROM users WHERE pseudo = '.'\''.$pseudo.'\'') or die(print_r($this->_db->errorInfo()));
		$data = $q->fetch();
		$q->closeCursor();
		return $data['passwd'];
	}
	
	public function getUserAdmin($id) {
		$q = $this->_db->query('SELECT admin FROM users WHERE id = '.$id) or die(print_r($this->_db->errorInfo()));
		$data = $q->fetch();
		$q->closeCursor();
		return $data['admin'];
	}
}
