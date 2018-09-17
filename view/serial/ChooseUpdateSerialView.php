<?php $title = 'Jean Forteroche écriture'; ?>

<?php ob_start(); ?>
<section>
	<div class="container" id="adminUpdateSerial">
		<?php if (isset($_GET['update']) && $_GET['update'] == '1') { ?>
		<div class="row">
			<div class="col-lg-offset-1 col-lg-2"></div>
				<div class="col-lg-8">
					<div class="d-flex justify-content-center border border-success rounded p-2 m-4" id="updateSerialInfo">
						<p><strong>Episode mise à jour !</strong></p>
					</div>
				</div>
			<div class="col-lg-offset-1 col-lg-2"></div>
		</div>
		<?php } ?>
		<h2>modifier un épisode</h2>
		<div class="row">
			<div class="col-lg-offset-1 col-lg-1"></div>
			<div class="col-lg-10">
				<div class='d-flex flex-column border border-success rounded p-2'>
					<form class='d-flex flex-column' method='post' action='index.php?action=chooseserialtoupdate'>
						<div class="form-group align-self-center">
							<label for="serialId">Liste des épisodes</label><br>
    						<select name="serialId" id="serialId">
								<?php while ($data = $q->fetch()) { 
								if (isset($_POST['serialId']))
									if ($_POST['serialId'] == $data['serial_id']) {
										$content = $data['serial_content'];
										$title = $data['serial_title'];
										$num = $data['serial_number'];
									}
								?>
								<option value="<?= $data['serial_id'] ?>"><?= $data['serial_number'] ?> <?= $data['serial_title'] ?></option>
								<?php } ?>
							</select>
						</div>
						<button type='submit' class='btn btn-success align-self-center'>Sélectionner un épisode</button>
					</form>
					<?php if (isset($_POST['serialId'])) { ?>
					<div class='m-2' id='content-serial'>
						<form class='d-flex flex-column' method='post' action='index.php?action=serialupdate'>
							<input type='hidden' id='serialIdToUpdate' name='serialIdToUpdate' value="<?= $_POST['serialId'] ?>" />
							<strong>Episode <?= $num ?>: <?= $title ?></strong>
							<textarea rows="15" name="editserial" id="editserial"><?= $content ?></textarea>
							<button type='submit' class='btn btn-success align-self-center m-2'>Modifier l'épisode <?= $num ?></button>
						</form>
					</div>
					<?php } ?>
				</div>
			</div>
			<div class="col-lg-offset-1 col-lg-1"></div>
		</div>
	</div>
</section>
<?php $sectionMainContent = ob_get_clean(); ?>


<?php require('SerialTemplateView.php'); ?>	
