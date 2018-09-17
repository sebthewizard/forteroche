<?php
session_start();
require('controller/UserController.php');
require('controller/SerialController.php');
require('controller/CommentController.php');


try {
	
	// User
	// if no action, choose wich home page use if user got a cookie userid or not
	if (count($_GET) == 0 && count($_POST) == 0) {
		if (!isset($_COOKIE['userid'])) {
			if (isset($_SESSION['id'])) {connectedHome();}
			else {notConnectedHome();}
		}
		else {connectedHome();}
	}
	
	if (isset($_GET['action']) && $_GET['action'] == 'connexion') {
		connexion('',0);
	}
	
	if (isset($_GET['action']) && $_GET['action'] == 'connectuser') {
		connectUser();
	}
	
	if (isset($_GET['action']) && $_GET['action'] == 'disconnection') {
		disconnectUser();
	}
	
	if (isset($_GET['action']) && $_GET['action'] == 'register') {
		register('',0);
	}
	
	if (isset($_GET['action']) && $_GET['action'] == 'registeruser') {
		addUser();
	}
	
	if (isset($_GET['action']) && $_GET['action'] == 'admin') {
		adminHome();
	}
	
	if (isset($_GET['action']) && $_GET['action'] == 'readserial') {
		if (isset($_GET['serialId']))
			readSerial($_GET['serialId']);
		else
			readSerial($_POST['serialId']);
	}
	
	
	// Serial
	if (isset($_GET['action']) && $_GET['action'] == 'serialnew') {
		if (isset($_GET['new']) && $_GET['new'] == '1')
			newSerial('',0,1);
		else
			newSerial('',0,0);
	}
	
	if (isset($_GET['action']) && $_GET['action'] == 'registerserial') {
		addSerial();
	}
	
	if (isset($_GET['action']) && $_GET['action'] == 'chooseserialtoupdate') {
		chooseSerialToUpdate();
	}
	
	if (isset($_GET['action']) && $_GET['action'] == 'serialupdate') {
		updateSerial();
	}
	if (isset($_GET['action']) && $_GET['action'] == 'chooseserialtodelete') {
		chooseSerialToDelete();
	}
	if (isset($_GET['action']) && $_GET['action'] == 'serialdelete') {
		deleteSerial();
	}
	
	// Comment
	if (isset($_GET['action']) && $_GET['action'] == 'addcomment') {
		addComment();
	}
	
	if (isset($_GET['action']) && $_GET['action'] == 'signalcomment') {
		signalComment($_POST['commentId'], $_POST['commentSerialId']);
	}
	
	if (isset($_GET['action']) && $_GET['action'] == 'serialcomment') {
		manageComment();
	}
	
}

catch(Exception $e) {
	switch ($e->getCode()) {
		case 1: case 2:
			connexion($e->getMessage(), $e->getCode());
			break;
		case 3: case 4: case 5:
			register($e->getMessage(), $e->getCode());
			break;
		case 101: case 102: case 103:
			newSerial($e->getMessage(), $e->getCode(),0);
			break;
		case 201:
			echo $e->getMessage();
			break;
	}
}

// index des erreurs
// 1 : pseudo inconnu ou invalide lors de la connection
// 2 : mot de passe invalide ou ne correspond pas au pseudo lors de la connection
// 3 : pseudo inconnu ou invalide ou déja utilisé lors de l'enregistrement d'un nouvel utilisateur
// 4 : mot de passe invalide ou différents lors de l'enregistrement d'un nouvel utilisateur
// 5 : email invalide lors de l'enregistrement d'un nouvel utilisateur
// 101 : numéro d'épisode inconnu ou invalide ou déja utilisé lors de l'enregistrement d'un nouvel épisode
// 102 : titre d'épisode inconnu ou invalide lord de l'enregistrement d'un nouvel épisode
// 201 : Le commentaire à ajouter n'existe pas



