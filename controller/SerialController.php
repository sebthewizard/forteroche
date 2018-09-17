<?php

function newSerial($errorMessage, $errorCode, $new) {
	require('view/serial/NewSerialView.php');
}

function addSerial() {
	if (!isset($_POST['numserial'])) throw new Exception('Numéro d\'épisode manquant',101);
	else $ne = (int)$_POST['numserial'];
	if ($ne <= 0) throw new Exception('Numéro d\'épisode invalide',101);
	if (!isset($_POST['titleserial'])) throw new Exception('Titre de l\'épisode manquant',102);
	else $ts = htmlspecialchars(trim($_POST['titleserial']));
	if (empty($ts)) throw new Exception('Titre de l\'épisode invalide',102);
	$data = array(
		'idUser' => $_SESSION['id'],
		'content' => $_POST['editserial'],
		'number' => $ne,
		'title' => $ts);
	$serial = new Serial($data);
	$manager = new SerialsManager();
	$num = $manager->add($serial);
	if ($num == false) throw new Exception('Numéro épisode déja utilisé',103);
	header('Location: index.php?action=serialnew&new=1');
}

function chooseSerialToUpdate() {
	$manager = new SerialsManager();
	$q = $manager->all();
	require('view/serial/ChooseUpdateSerialView.php');
}

function updateSerial() {
	$manager = new SerialsManager();
	$manager->update($_POST['serialIdToUpdate'],$_POST['editserial']);
	header('Location: index.php?action=chooseserialtoupdate&update=1');
}

function chooseSerialToDelete() {
	$manager = new SerialsManager();
	$q = $manager->all();
	require('view/serial/ChooseDeleteSerialView.php');
}

function deleteSerial() {
	$manager = new SerialsManager();
	$manager->delete($_POST['serialIdToDelete']);
	header('Location: index.php?action=chooseserialtodelete&delete=1');
}
