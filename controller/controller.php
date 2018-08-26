<?php

//autoload
function loadClasse($classname) {
  require 'model/'.$classname.'.php';
}

spl_autoload_register('loadClasse');

function notConnectedHome() {
    require('view/notConnectedHomeView.php');
}

function register() {
    require('view/registerView.php');
}

function addUser() {
	if (!isset($_POST['pseudo'])) throw new Exception('Pseudo inconnu');
	else $ps = htmlspecialchars(trim($_POST['pseudo']));
	if (empty($ps)) throw new Exception('Pseudo invalide');
	if (!isset($_POST['password'])) throw new Exception('Mot de passe inconnu');
	else $pa = htmlspecialchars(trim($_POST['password']));
	if (empty($pa)) throw new Exception('Mot de passe invalide');
	if (!isset($_POST['password1'])) throw new Exception('Mot de passe inconnu');
	else $pa1 = htmlspecialchars(trim($_POST['password1']));
	if (empty($pa1)) throw new Exception('Mot de passe invalide');
	if (!isset($_POST['email'])) throw new Exception('Email inconnu');
	else $em = htmlspecialchars(trim($_POST['email']));
	if (empty($em)) throw new Exception('Email invalide');
	if (!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $em)) throw new Exception('Email invalide');
	if ($pa != $pa1) throw new Exception('Les mots de passe ne sont pas indentiques');
	$pa = password_hash($pa, PASSWORD_DEFAULT);
	$data = array(
		'pseudo' => $ps,
		'passwd' => $pa,
		'email' => $em);
	$user = new User($data);
	$manager = new UsersManager();
	$id = $manager->add($user);
	$_SESSION['id'] = $id;
	$_SESSION['pseudo'] = $manager->getPseudo($id);
	$_SESSION['admin'] = $manager->getAdmin($id);
	if (isset($_POST['cookie']) && $_POST['cookie'] == 'yes') setcookie('userid', $_SESSION['id'], time() + 365*24*3600, null, null, false, true);
	header('Location: index.php');
}

function connexion() {
    require('view/connexionView.php');
}

function connectUser() {
	if (!isset($_POST['pseudo'])) throw new Exception('Pseudo inconnu');
	else $ps = htmlspecialchars(trim($_POST['pseudo']));
	if (empty($ps)) throw new Exception('Pseudo invalide');
	if (!isset($_POST['password'])) throw new Exception('Mot de passe inconnu');
	else $pa = htmlspecialchars(trim($_POST['password']));
	if (empty($pa)) throw new Exception('Mot de passe invalide');
	$manager = new UsersManager();
	$id = $manager->getId($ps);
	$pah = $manager->getPass($ps);
	$isPasswordOk = password_verify($pa, $pah);
	if ($isPasswordOk) {
		$_SESSION['id'] = $id;
		$_SESSION['pseudo'] = $ps;
		$_SESSION['admin'] = $manager->getAdmin($id);
	}
	else throw new Exception('Mot de passe invalide');
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













