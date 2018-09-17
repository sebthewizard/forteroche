<?php $title = 'Jean Forteroche supprimer'; ?>

<?php ob_start(); ?>
<section>
	<div class="container" id="adminDeleteSerial">
		<?php if (isset($_GET['delete']) && $_GET['delete'] == '1') { ?>
		<div class="row">
			<div class="col-lg-offset-1 col-lg-2"></div>
				<div class="col-lg-8">
					<div class="d-flex justify-content-center border border-success rounded p-2 m-4" id="deleteSerialInfo">
						<p><strong>Episode et commentaires supprimés !</strong></p>
					</div>
				</div>
			<div class="col-lg-offset-1 col-lg-2"></div>
		</div>
		<?php } ?>
		<h2>supprimer un épisode</h2>
		<div class="row">
			<div class="col-lg-offset-1 col-lg-1"></div>
			<div class="col-lg-10">
				<div class='d-flex flex-column border border-success rounded p-2'>
					<form class='d-flex flex-column' method='post' action='index.php?action=chooseserialtodelete'>
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
						<p><strong>Episode <?= $num ?>: <?= $title ?></strong><?= $content ?></p>
					</div>
					<form class='d-flex flex-column' method='post' action='index.php?action=serialdelete'>
						<input type='hidden' id='serialIdToDelete' name='serialIdToDelete' value="<?= $_POST['serialId'] ?>" />
						<button type='submit' class='btn btn-success align-self-center'>Supprimer l'épisode <?= $num ?></button>
					</form>
					<?php } ?>
				</div>
			</div>
			<div class="col-lg-offset-1 col-lg-1"></div>
		</div>
	</div>
</section>
<?php $sectionMainContent = ob_get_clean(); ?>


<?php require('SerialTemplateView.php'); ?>	