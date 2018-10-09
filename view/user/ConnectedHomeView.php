<?php $title = 'Jean Forteroche accueil'; ?>

<?php ob_start(); ?>
<section>
	<div class="container" id="listSerial">
		<?php
		while ($data = $q->fetch()) {
		?>
			<div class="row">
				<div class="col-lg-offset-1 col-lg-1"></div>
				<div class="col-lg-4">
					<div class="d-flex flex-column container-serial">
						<h3 class="title-serial"><?= $data['serial_number'] ?>. <?= $data['serial_title'] ?></h3>
						<p class="date-serial">Par <strong><?= $data['user_pseudo'] ?></strong> <?= $data['serial_creation_date'] ?></p>
						<p class="update-date-serial">Mise à jour <?= $data['serial_last_update_date'] ?></p>
						<div class="content-serial">
							<p><?= $data['serial_content'] ?></p>
						</div>
						<div class="plus-serial">
							<form method="post" action="index.php?action=readserial">
								<input type="hidden" class="serialId" name="serialId" value="<?= $data['serial_id'] ?>" />
								<button type="submit" class="btn btn-success">En lire plus</button>
							</form>
						</div>
					</div>
				</div>
				<?php
				if ($data = $q->fetch()) {
				?>
				<div class="col-lg-offset-2 col-lg-2"></div>
				<div class="col-lg-4">
					<div class="d-flex flex-column container-serial">
						<h3 class="title-serial"><?= $data['serial_number'] ?>. <?= $data['serial_title'] ?></h3>
						<p class="date-serial">Par <strong><?= $data['user_pseudo'] ?></strong> <?= $data['serial_creation_date'] ?></p>
						<p class="update-date-serial">Mise à jour <?= $data['serial_last_update_date'] ?></p>
						<div class="content-serial">
							<p><?= $data['serial_content'] ?></p>
						</div>
						<div class="plus-serial">
							<form method="post" action="index.php?action=readserial">
								<input type="hidden" class="serialId" name="serialId" value="<?= $data['serial_id'] ?>" />
								<button type="submit" class="btn btn-success">En lire plus</button>
							</form>
						</div>
					</div>
				</div>
				<div class="col-lg-offset-1 col-lg-1"></div>
			</div>
		<?php
				}
			else {
				echo "<div class='col-lg-offset-7 col-lg-7'></div>";
				echo "</div>";
			}
		} 
		$q->closeCursor();
		?>
	</div>
</section>
<?php $sectionMainContent = ob_get_clean(); ?>




<?php require('UserTemplateView.php'); ?>