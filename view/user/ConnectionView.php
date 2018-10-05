<?php $title = 'Jean Forteroche se connecter'; ?>

<?php ob_start(); ?>
<section>
	<div class="container d-flex justify-content-center align-items-center" id="connect">
		<div id="formConnect">
			<h2>Connection</h2>
			<form method="post" action="index.php?action=connectuser">
				<div class="form-group">
    				<label for="pseudo">Pseudo</label>
    				<input type="text" class="form-control" id="pseudo" name="pseudo" required />
					<?php
					if ($errorCode == 1)
						echo "<span class='error'><strong>".$errorMessage."</strong></span>";
					?>
  				</div>
				<div class="form-group">
    				<label for="password">Mot de Passe</label>
    				<input type="password" class="form-control" name="password" id="password" required />
					<?php
					if ($errorCode == 2)
						echo "<span class='error'><strong>".$errorMessage."</strong></span>";
					?>
  				</div>
  				<div class="form-group form-check">
    				<label class="form-check-label">
      					<input class="form-check-input" type="checkbox" id="cookie" name="cookie" value="yes" />Se souvenir de moi
    				</label>
  				</div>
  				<button type="submit" class="btn btn-success">Se connecter</button>
			</form>
		</div>
	</div>
</section>
<?php $sectionMainContent = ob_get_clean(); ?>


<?php require('UserTemplateView.php'); ?>	
