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
		connexion();
	}
	if (isset($_GET['action']) && $_GET['action'] == 'connectuser') {
		connectUser();
	}
	if (isset($_GET['action']) && $_GET['action'] == 'disconnection') {
		disconnectUser();
	}	
	if (isset($_GET['action']) && $_GET['action'] == 'register') {
		register();
	}
	if (isset($_GET['action']) && $_GET['action'] == 'registeruser') {
		addUser();
	}	
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}

