<?php
session_start();
require('controller/controller.php');


try {
	// if no action, choose wich home page use if user got a cookie userid or not
	if (count($_GET) == 0 && count($_POST) == 0) {
		if (!isset($_COOKIE['userid'])) {
			if (isset($_SESSION['id'])) {ConnectedHome();}
			else {notConnectedHome();}
		}
		else {ConnectedHome();}
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
}
catch(Exception $e) {
	switch ($e->getCode()) {
		case 1: case 2:
			connexion($e->getMessage(), $e->getCode());
			break;
		case 3: case 4: case 5:
			register($e->getMessage(), $e->getCode());
			break;
	}
}

// index des erreurs
// 1 : pseudo inconnu ou invalide lors de la connection
// 2 : mot de passe invalide ou ne correspond pas au pseudo lors de la connection
// 3 : pseudo inconnu ou invalide ou déja utilisé lors de l'enregistrement d'un nouvel utilisateur
// 4 : mot de passe invalide ou différents lors de l'enregistrement d'un nouvel utilisateur
// 5 : email invalide lors de l'enregistrement d'un nouvel utilisateur