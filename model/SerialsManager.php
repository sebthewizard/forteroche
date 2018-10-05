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

	public function addSerial(Serial $newSerial) {
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
	
	public function getAllSerials() {
		$q = $this->_db->query('SELECT se.id serial_id,
										us.pseudo user_pseudo,
										se.content serial_content,
										se.number serial_number,
										se.title serial_title,
										DATE_FORMAT(se.creation_date, "le %d/%m/%Y à %Hh%imin%ss") serial_creation_date,
										DATE_FORMAT(se.last_update_date, "le %d/%m/%Y à %Hh%imin%ss") serial_last_update_date
										FROM serials se
										INNER JOIN users us
										ON us.id = se.id_user
										ORDER BY se.creation_date DESC
										') or die(print_r($this->_db->errorInfo()));
		return $q;
	}
	
	public function getSerial($id) {
		$q = $this->_db->query('SELECT id, id_user, content, number, title,
										DATE_FORMAT(creation_date, "le %d/%m/%Y à %Hh%imin%ss") crea_date,
										DATE_FORMAT(last_update_date, "le %d/%m/%Y à %Hh%imin%ss") la_upda_date
										FROM serials WHERE id = '.$id) or die(print_r($this->_db->errorInfo()));
		$data = $q->fetch();
		$q->closeCursor();
		return $data;
	}
	
	public function updateSerial($id, $content) {
		$q = $this->_db->prepare('UPDATE serials SET content = :nvcontent, last_update_date = NOW() WHERE id = '.$id) or die(print_r($this->_db->errorInfo()));
		$q->execute(array('nvcontent' => $content)) or die(print_r($this->_db->errorInfo()));
	}
	
	public function deleteSerial($id) {
		$q = $this->_db->query('DELETE FROM comments WHERE id_serial = '.$id) or die(print_r($this->_db->errorInfo()));
		$q = $this->_db->query('DELETE FROM serials WHERE id = '.$id) or die(print_r($this->_db->errorInfo()));
	}
}
