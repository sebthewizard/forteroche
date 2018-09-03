<?php
require_once("model/Manager.php");

class SerialsManager extends Manager {
	
	private $_db;
	
	public function __construct() {
		$this->setDb($this->dbConnect());
  	}
	
	// Setters
  	public function setDb(PDO $db) {
    	$this->_db = $db;
  	}

	public function add(Serial $newSerial) {
		$q = $this->_db->query('SELECT COUNT(*) AS nb FROM serials WHERE number = '.$newSerial->number()) or die(print_r($this->_db->errorInfo()));
		$data = $q->fetch();
		if ($data['nb'] > 0) return false;
		$q = $this->_db->prepare('INSERT INTO serials(id_user, content, number, title, creation_date, last_update_date) VALUES(:id_user, :content, :number, :title, NOW(), NOW())');
		$q->execute(array(
			'id_user' => $newSerial->idUser(),
			'content' => $newSerial->content(),
			'number' => $newSerial->number(),
			'title' => $newSerial->title()
		)) or die(print_r($this->_db->errorInfo()));
		$q->closeCursor();
		return true;
	}
	
	public function listSerials() {
		$q = $this->_db->query('SELECT * FROM serials') or die(print_r($this->_db->errorInfo()));
		return $q;
	}
	
	public function getSerial($id) {
		$q = $this->_db->query('SELECT * FROM serials WHERE id = '.$id) or die(print_r($this->_db->errorInfo()));
		$data = $q->fetch();
		$q->closeCursor();
		return $data;
	}
	
	public function updateSerial($id, $content) {
		$q = $this->_db->prepare('UPDATE serials SET content = :nvcontent, last_update_date = NOW() WHERE id = '.$id) or die(print_r($this->_db->errorInfo()));
		$q->execute(array('nvcontent' => $content)) or die(print_r($this->_db->errorInfo()));
	}
	
	public function deleteSerial($id) {
		$q = $this->_db->query('DELETE FROM serials WHERE id = '.$id) or die(print_r($this->_db->errorInfo()));
	}
}
