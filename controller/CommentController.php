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
	require('view/serial/SerialCommentView.php');
}