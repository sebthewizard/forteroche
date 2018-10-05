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
	
	public function addComment(Comment $newComment) {
		$q = $this->_db->prepare('INSERT INTO comments(id_user, id_serial, creation_date, content) VALUES(:id_user, :id_serial, NOW(), :content)');
		$q->execute(array(
			'id_user' => $newComment->idUser(),
			'id_serial' => $newComment->idSerial(),
			'content' => $newComment->content()
		)) or die(print_r($this->_db->errorInfo()));
	}
	
	public function deleteComment($id) {
		$q = $this->_db->query('DELETE FROM comments WHERE id = '.$id) or die(print_r($this->_db->errorInfo()));
	}
	
	public function getCommentsFromSerial($serialId, $offset, $commentsPerPage) {
		if ($commentsPerPage == 0) {
			$q = $this->_db->prepare('SELECT us.pseudo user_pseudo,
										co.id comment_id,
										co.signaled comment_signaled,
										co.validate comment_validated,
										DATE_FORMAT(co.creation_date, "le %d/%m/%Y à %Hh%imin%ss") comment_date,
										co.content comment_content
								FROM comments co
								INNER JOIN users us
								ON us.id = co.id_user
								WHERE co.id_serial = :id_serial
								ORDER BY co.creation_date DESC');
			$q->execute(array('id_serial' => $serialId)) or die(print_r($this->_db->errorInfo()));
		}
		else {
			$q = $this->_db->prepare('SELECT us.pseudo user_pseudo,
										co.id comment_id,
										co.signaled comment_signaled,
										co.validate comment_validated,
										DATE_FORMAT(co.creation_date, "le %d/%m/%Y à %Hh%imin%ss") comment_date,
										co.content comment_content
								FROM comments co
								INNER JOIN users us
								ON us.id = co.id_user
								WHERE co.id_serial = :id_serial
								ORDER BY co.creation_date DESC
								LIMIT :offset, :commentsPerPage');
			$q->bindValue('id_serial', $serialId, PDO::PARAM_INT);
			$q->bindValue('offset', $offset, PDO::PARAM_INT);
			$q->bindValue('commentsPerPage', $commentsPerPage, PDO::PARAM_INT);
			$q->execute() or die(print_r($this->_db->errorInfo()));
		}
		return $q;
	}
	
	public function changeCommentToSignaled($commentId) {
		$nvsignal = 1;
		$q = $this->_db->prepare('UPDATE comments SET signaled = :nvsignal WHERE id = :commentId');
		$q->execute(array('nvsignal' => $nvsignal, 'commentId' => $commentId)) or die(print_r($this->_db->errorInfo()));
	}

	public function changeCommentToValidated($commentId) {
		$nvvalidate = 1;
		$q = $this->_db->prepare('UPDATE comments SET validate = :nvvalidate WHERE id = :commentId');
		$q->execute(array('nvvalidate' => $nvvalidate, 'commentId' => $commentId)) or die(print_r($this->_db->errorInfo()));
	}
	
	
	public function getAllCommentsNotValidated($offset, $commentsPerPage) {
		if ($commentsPerPage == 0) {
			$q = $this->_db->query('SELECT us.pseudo user_pseudo,
										se.number serial_number,
										co.id comment_id,
										DATE_FORMAT(co.creation_date, "le %d/%m/%Y à %Hh%imin%ss") comment_date,
										co.content comment_content
								FROM comments co
								INNER JOIN users us
								ON us.id = co.id_user
								INNER JOIN serials se
								ON se.id = co.id_serial
								WHERE co.validate = 0
								ORDER BY co.creation_date DESC');
		}
		else {
			$q = $this->_db->prepare('SELECT us.pseudo user_pseudo,
										se.number serial_number,
										co.id comment_id,
										DATE_FORMAT(co.creation_date, "le %d/%m/%Y à %Hh%imin%ss") comment_date,
										co.content comment_content
								FROM comments co
								INNER JOIN users us
								ON us.id = co.id_user
								INNER JOIN serials se
								ON se.id = co.id_serial
								WHERE co.validate = 0
								ORDER BY co.creation_date DESC
								LIMIT :offset, :commentsPerPage');
			$q->bindValue('offset', $offset, PDO::PARAM_INT);
			$q->bindValue('commentsPerPage', $commentsPerPage, PDO::PARAM_INT);
			$q->execute() or die(print_r($this->_db->errorInfo()));
		}
		return $q;
	}
	
	public function getAllCommentsNotValidatedOrderBySerial($offset, $commentsPerPage) {
		if ($commentsPerPage == 0) {
			$q = $this->_db->query('SELECT us.pseudo user_pseudo,
										se.number serial_number,
										co.id comment_id,
										DATE_FORMAT(co.creation_date, "le %d/%m/%Y à %Hh%imin%ss") comment_date,
										co.content comment_content
								FROM comments co
								INNER JOIN users us
								ON us.id = co.id_user
								INNER JOIN serials se
								ON se.id = co.id_serial
								WHERE co.validate = 0
								ORDER BY serial_number DESC, co.creation_date DESC');
		}
		else {
			$q = $this->_db->prepare('SELECT us.pseudo user_pseudo,
										se.number serial_number,
										co.id comment_id,
										DATE_FORMAT(co.creation_date, "le %d/%m/%Y à %Hh%imin%ss") comment_date,
										co.content comment_content
								FROM comments co
								INNER JOIN users us
								ON us.id = co.id_user
								INNER JOIN serials se
								ON se.id = co.id_serial
								WHERE co.validate = 0
								ORDER BY serial_number DESC, co.creation_date DESC
								LIMIT :offset, :commentsPerPage');
			$q->bindValue('offset', $offset, PDO::PARAM_INT);
			$q->bindValue('commentsPerPage', $commentsPerPage, PDO::PARAM_INT);
			$q->execute() or die(print_r($this->_db->errorInfo()));
		}
		return $q;
	}
	
	
	public function getAllCommentsSignaledAndNotValidated($offset, $commentsPerPage) {
		if ($commentsPerPage == 0) {
			$q = $this->_db->query('SELECT us.pseudo user_pseudo,
										se.number serial_number,
										co.id comment_id,
										DATE_FORMAT(co.creation_date, "le %d/%m/%Y à %Hh%imin%ss") comment_date,
										co.content comment_content
								FROM comments co
								INNER JOIN users us
								ON us.id = co.id_user
								INNER JOIN serials se
								ON se.id = co.id_serial
								WHERE co.validate = 0 AND co.signaled = 1
								ORDER BY co.creation_date DESC');
		}
		else {
			$q = $this->_db->prepare('SELECT us.pseudo user_pseudo,
										se.number serial_number,
										co.id comment_id,
										DATE_FORMAT(co.creation_date, "le %d/%m/%Y à %Hh%imin%ss") comment_date,
										co.content comment_content
								FROM comments co
								INNER JOIN users us
								ON us.id = co.id_user
								INNER JOIN serials se
								ON se.id = co.id_serial
								WHERE co.validate = 0 AND co.signaled = 1
								ORDER BY co.creation_date DESC
								LIMIT :offset, :commentsPerPage');
			$q->bindValue('offset', $offset, PDO::PARAM_INT);
			$q->bindValue('commentsPerPage', $commentsPerPage, PDO::PARAM_INT);
			$q->execute() or die(print_r($this->_db->errorInfo()));
		}
		return $q;
	}
	
	public function getAllCommentsSignaledAndNotValidatedOrderBySerial($offset, $commentsPerPage) {
		if ($commentsPerPage == 0) {
			$q = $this->_db->query('SELECT us.pseudo user_pseudo,
										se.number serial_number,
										co.id comment_id,
										DATE_FORMAT(co.creation_date, "le %d/%m/%Y à %Hh%imin%ss") comment_date,
										co.content comment_content
								FROM comments co
								INNER JOIN users us
								ON us.id = co.id_user
								INNER JOIN serials se
								ON se.id = co.id_serial
								WHERE co.validate = 0 AND co.signaled = 1
								ORDER BY serial_number DESC, co.creation_date DESC');
		}
		else {
			$q = $this->_db->prepare('SELECT us.pseudo user_pseudo,
										se.number serial_number,
										co.id comment_id,
										DATE_FORMAT(co.creation_date, "le %d/%m/%Y à %Hh%imin%ss") comment_date,
										co.content comment_content
								FROM comments co
								INNER JOIN users us
								ON us.id = co.id_user
								INNER JOIN serials se
								ON se.id = co.id_serial
								WHERE co.validate = 0 AND co.signaled = 1
								ORDER BY serial_number DESC, co.creation_date DESC
								LIMIT :offset, :commentsPerPage');
			$q->bindValue('offset', $offset, PDO::PARAM_INT);
			$q->bindValue('commentsPerPage', $commentsPerPage, PDO::PARAM_INT);
			$q->execute() or die(print_r($this->_db->errorInfo()));
		}
		return $q;
	}
}