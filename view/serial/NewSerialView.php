<?php $title = 'Jean Forteroche écriture'; ?>

<?php ob_start(); ?>
<section>
	<div class="container" id="adminNewSerial">
		<?php
		if ($new == 1) {
		?>
		<div class="row">
			<div class="col-lg-offset-1 col-lg-2"></div>
				<div class="col-lg-8">
					<div class="d-flex justify-content-center border border-success rounded p-2 m-4" id="newSerialInfo">
						<p><strong>Nouvel épisode publié </strong></p>
					</div>
				</div>
			<div class="col-lg-offset-1 col-lg-2"></div>
		</div>
		<?php
		}
		?>
		<h2>écrire un épisode</h2>
		<div class="row">
			<div class="col-lg-offset-1 col-lg-1"></div>
			<div class="col-lg-10">
				<form class="d-flex flex-column border border-success rounded p-2" method="post" action="index.php?action=registerserial">
					<div class="form-group align-self-center">
    					<label for="numserial">Numéro de l'épisode</label>
    					<input type="number" class="form-control" id="numserial" name="numserial" required />
						<?php
						if ($errorCode == 101 || $errorCode == 103)
							echo "<span class='error'><strong>".$errorMessage."</strong></span>";
						?>
  					</div>
					<div class="form-group">
    					<label for="titleserial">Titre de l'épisode</label>
    					<input type="text" class="form-control" name="titleserial" id="titleserial" required />
						<?php
						if ($errorCode == 102)
							echo "<span class='error'><strong>".$errorMessage."</strong></span>";
						?>
  					</div>
					<div class="form-group flex-grow-1">
    					<label for="editserial">Rédaction de l'épisode</label><br>
    					<textarea rows="15" name="editserial" id="editserial"></textarea>
  					</div>
  					<button type="submit" class="btn btn-success align-self-center">Enregistrer</button>
				</form>
			</div>
			<div class="col-lg-offset-1 col-lg-1"></div>
		</div>
	</div>
</section>
<?php $sectionMainContent = ob_get_clean(); ?>


<?php require('SerialTemplateView.php'); ?>	
