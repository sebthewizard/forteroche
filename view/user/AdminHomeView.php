<?php $title = 'Jean Forteroche administration'; ?>

<?php ob_start(); ?>
<section>
	<div class="container" id="adminHome">
		<h2>ACCUEIL ADMINISTRATION</h2>
		<div class="row">
			<div class="col-lg-offset-1 col-lg-1"></div>
			<div class="col-lg-4">
				<div class="d-flex flex-column align-items-center border border-success rounded p-2 m-2">
					<form method="post" action="index.php?action=serialnew">
						<button type="submit" class="btn btn-success submit-button"><h4>Nouveau</h4></button>
					</form>
					<p>Rédiger un nouvel épisode</p>
				</div>
			</div>
			<div class="col-lg-offset-2 col-lg-2"></div>
			<div class="col-lg-4">
				<div class="d-flex flex-column align-items-center border border-success rounded p-2 m-2">
					<form method="post" action="index.php?action=chooseserialtoupdate">
						<button type="submit" class="btn btn-success submit-button"><h4>Modifier</h4></button>
					</form>
					<p>Apporter des changements à un épisode</p>
				</div>
			</div>
			<div class="col-lg-offset-1 col-lg-1"></div>
		</div>
		<div class="row">
			<div class="col-lg-offset-1 col-lg-1"></div>
			<div class="col-lg-4">
				<div class="d-flex flex-column align-items-center border border-success rounded p-2 m-2">
					<form method="post" action="index.php?action=chooseserialtodelete">
						<button type="submit" class="btn btn-success submit-button"><h4>Supprimer</h4></button>
					</form>
					<p>Supprimer un épisode</p>
				</div>
			</div>
			<div class="col-lg-offset-2 col-lg-2"></div>
			<div class="col-lg-4">
				<div class="d-flex flex-column align-items-center border border-success rounded p-2 m-2">
					<form method="post" action="index.php?action=serialcomment">
						<button type="submit" class="btn btn-success submit-button"><h4>Commentaires</h4></button>
					</form>
					<p>Gérer les commentaires</p>
				</div>
			</div>
			<div class="col-lg-offset-1 col-lg-1"></div>
		</div>
	</div>
</section>
<?php $sectionMainContent = ob_get_clean(); ?>

<?php require('view/serial/SerialTemplateView.php'); ?>