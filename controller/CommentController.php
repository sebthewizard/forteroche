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
		$manager->addComment($comment);
		}
	header("Location: index.php?action=readserial&comment&serialId=".$_POST['serialId']);
}

function signalComment($commentId, $serialId) {
	$manager = new CommentsManager();
	$manager->changeCommentToSignaled($commentId);
	header("Location: index.php?action=readserial&signal&pageNum=".$_GET['pageNum']."&serialId=".$serialId);
}

function manageComment() {
	if (isset($_GET['sort']))
			$_POST['sortComment'] = $_GET['sort'];
	if (isset($_POST['sortComment']) && $_POST['sortComment'] == 1) {
		$manager = new CommentsManager();
		$q = $manager->getAllCommentsNotValidated(0,0);
	}
	if (isset($_POST['sortComment']) && $_POST['sortComment'] == 2) {
		$manager = new CommentsManager();
		$q = $manager->getAllCommentsSignaledAndNotValidated(0,0);
	}
	if (isset($_POST['sortComment']) && $_POST['sortComment'] == 3) {
		$manager = new CommentsManager();
		$q = $manager->getAllCommentsNotValidatedOrderBySerial(0,0);
	}
	if (isset($_POST['sortComment']) && $_POST['sortComment'] == 4) {
		$manager = new CommentsManager();
		$q = $manager->getAllCommentsSignaledAndNotValidatedOrderBySerial(0,0);
	}
	if (isset($_POST['sortComment'])) {
		if (isset($_GET['pageNum'])) {
    		$pageNum = $_GET['pageNum'];
    	} else {
    		$pageNum = 1;
    	}
		$commentsPerPage = 7;
		$numberOfPages = ceil($q->rowCount() / $commentsPerPage);
		if ($pageNum > $numberOfPages) { $pageNum = $numberOfPages;}
		$offset = ($pageNum-1) * $commentsPerPage;
		if ($_POST['sortComment'] == 1) {
			$q = $manager->getAllCommentsNotValidated($offset,$commentsPerPage);
		}
		if ($_POST['sortComment'] == 2) {
			$q = $manager->getAllCommentsSignaledAndNotValidated($offset,$commentsPerPage);
		}
		if ($_POST['sortComment'] == 3) {
			$q = $manager->getAllCommentsNotValidatedOrderBySerial($offset,$commentsPerPage);
		}
		if ($_POST['sortComment'] == 4) {
			$q = $manager->getAllCommentsSignaledAndNotValidatedOrderBySerial($offset,$commentsPerPage);
		}
	}
	else $numberOfPages = 0;
	require('view/serial/SerialCommentView.php');
}

function deleteComment() {
	$manager = new CommentsManager();
	$manager->deleteComment($_POST['deleteComment']);
	header("Location: index.php?action=serialcomment&sort=".$_GET['sort']."&pageNum=".$_GET['pageNum']);
}

function validateComment() {
	$manager = new CommentsManager();
	$manager->changeCommentToValidated($_POST['validateComment']);
	header("Location: index.php?action=serialcomment&sort=".$_GET['sort']."&pageNum=".$_GET['pageNum']);
}