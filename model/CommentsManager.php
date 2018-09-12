<?php
require_once("model/Manager.php");

class CommentsManager extends Manager {
	
	private $_db;
	
	public function __construct() {
		$this->setDb($this->dbConnect());
  	}
	
	// Setters
  	public function setDb(PDO $db) {
    	$this->_db = $db;
  	}
	
	public function add(Comment $newComment) {
		$q = $this->_db->prepare('INSERT INTO comments(id_user, id_serial, creation_date, content) VALUES(:id_user, :id_serial, NOW(), :content)');
		$q->execute(array(
			'id_user' => $newComment->idUser(),
			'id_serial' => $newComment->idSerial(),
			'content' => $newComment->content()
		)) or die(print_r($this->_db->errorInfo()));
	}
	
	public function getFromSerial($serialId) {
		$q = $this->_db->prepare('SELECT us.pseudo user_pseudo,
										co.id comment_id,
										DATE_FORMAT(co.creation_date, "le %d/%m/%Y à %Hh%imin%ss") comment_date,
										co.content comment_content
								FROM comments co
								INNER JOIN users us
								ON us.id = co.id_user
								WHERE co.id_serial = :id_serial
								ORDER BY comment_date DESC');
		$q->execute(array('id_serial' => $serialId)) or die(print_r($this->_db->errorInfo()));
		return $q;
	}
}