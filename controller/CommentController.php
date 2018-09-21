<?php

function addComment() {
	if (!isset($_POST['addComment'])) throw new Exception('Commentaire manquant',201);
	else $co = nl2br(htmlspecialchars($_POST['addComment']));
	if (!empty($co)) {
		$data = array(
			'idUser' => $_SESSION['id'],
			'idSerial' => $_POST['serialId'],
			'content' => $co);
		$comment = new Comment($data);
		$manager = new CommentsManager();
		$manager->add($comment);
		}
	header("Location: index.php?action=readserial&serialId=".$_POST['serialId']);
}

function signalComment($commentId, $serialId) {
	$manager = new CommentsManager();
	$manager->changeSignaled($commentId);
	header("Location: index.php?action=readserial&serialId=".$serialId);
}

function manageComment() {
	if (isset($_POST['sortComment']) && $_POST['sortComment'] == 1) {
		$manager = new CommentsManager();
		$q = $manager->getAllCommentsNotValidated();
	}
	if (isset($_POST['sortComment']) && $_POST['sortComment'] == 2) {
		$manager = new CommentsManager();
		$q = $manager->getAllCommentsSignaledAndNotValidated();
	}
	if (isset($_POST['sortComment']) && $_POST['sortComment'] == 3) {
		$manager = new CommentsManager();
		$q = $manager->getAllCommentsNotValidatedOrderBySerial();
	}
	if (isset($_POST['sortComment']) && $_POST['sortComment'] == 4) {
		$manager = new CommentsManager();
		$q = $manager->getAllCommentsSignaledAndNotValidatedOrderBySerial();
	}
	require('view/serial/SerialCommentView.php');
}

function deleteComment() {
	$manager = new CommentsManager();
	$manager->deleteComment($_POST['deleteComment']);
	header("Location: index.php?action=serialcomment&sort=".$_GET['sort']);
}

function validateComment() {
	$manager = new CommentsManager();
	$manager->changeCommentToValidated($_POST['validateComment']);
	header("Location: index.php?action=serialcomment&sort=".$_GET['sort']);
}