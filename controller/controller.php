<?php

//autoload
function loadClasse($classname) {
  require 'model/'.$classname.'.php';
}

spl_autoload_register('loadClasse');

function notConnectedHome() {
    require('view/notConnectedHomeView.php');
}

function register($errorMessage, $errorCode) {
    require('view/registerView.php');
}

function addUser() {
	if (!isset($_POST['pseudo'])) throw new Exception('Pseudo inconnu',3);
	else $ps = htmlspecialchars(trim($_POST['pseudo']));
	if (empty($ps)) throw new Exception('Pseudo invalide',3);
	if (!isset($_POST['password'])) throw new Exception('Mot de passe inconnu',4);
	else $pa = htmlspecialchars(trim($_POST['password']));
	if (empty($pa)) throw new Exception('Mot de passe invalide',4);
	if (!isset($_POST['password1'])) throw new Exception('Mot de passe inconnu',4);
	else $pa1 = htmlspecialchars(trim($_POST['password1']));
	if (empty($pa1)) throw new Exception('Mot de passe invalide',4);
	if (!isset($_POST['email'])) throw new Exception('Email inconnu',5);
	else $em = htmlspecialchars(trim($_POST['email']));
	if (empty($em)) throw new Exception('Email invalide',5);
	if (!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $em)) throw new Exception('Email invalide',5);
	if ($pa != $pa1) throw new Exception('Mots de passe différents',4);
	$pa = password_hash($pa, PASSWORD_DEFAULT);
	$data = array(
		'pseudo' => $ps,
		'passwd' => $pa,
		'email' => $em);
	$user = new User($data);
	$manager = new UsersManager();
	$id = $manager->add($user);
	if ($id == false) throw new Exception('Pseudo déja utilisé',3);
	$_SESSION['id'] = $id;
	$_SESSION['pseudo'] = $manager->getPseudo($id);
	$_SESSION['admin'] = $manager->getAdmin($id);
	if (isset($_POST['cookie']) && $_POST['cookie'] == 'yes') setcookie('userid', $_SESSION['id'], time() + 365*24*3600, null, null, false, true);
	header('Location: index.php');
}

function connexion($errorMessage, $errorCode) {
    require('view/connexionView.php');
}

function connectUser() {
	if (!isset($_POST['pseudo'])) throw new Exception('Pseudo inconnu',1);
	else $ps = htmlspecialchars(trim($_POST['pseudo']));
	if (empty($ps)) throw new Exception('Pseudo invalide',1);
	if (!isset($_POST['password'])) throw new Exception('Mot de passe inconnu',2);
	else $pa = htmlspecialchars(trim($_POST['password']));
	if (empty($pa)) throw new Exception('Mot de passe invalide',2);
	$manager = new UsersManager();
	$id = $manager->getId($ps);
	if ($id == false) throw new Exception('Pseudo inconnu',1);
	$pah = $manager->getPass($ps);
	$isPasswordOk = password_verify($pa, $pah);
	if ($isPasswordOk) {
		$_SESSION['id'] = $id;
		$_SESSION['pseudo'] = $ps;
		$_SESSION['admin'] = $manager->getAdmin($id);
	}
	else throw new Exception('Mot de passe invalide',2);
	if (isset($_POST['cookie']) && $_POST['cookie'] == 'yes') setcookie('userid', $_SESSION['id'], time() + 365*24*3600, null, null, false, true);
	header('Location: index.php');
}

function disconnectUser() {
	setcookie('userid');
	unset($_COOKIE['userid']);
	$_SESSION = array();
	header('Location: index.php');
}

function connectedHome() {
    require('view/ConnectedHomeView.php');
}













