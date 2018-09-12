<?php $title = 'Jean Forteroche s\'inscrire'; ?>

<?php ob_start(); ?>

<section>
	<div class="container d-flex justify-content-center align-items-center" id="register">
		<div id="formRegister">
			<h2>Inscription</h2>
			<form method="post" action="index.php?action=registeruser">
				<div class="form-group">
    				<label for="pseudo">Pseudo</label>
    				<input type="text" class="form-control" id="pseudo" name="pseudo" required />
					<?php
					if ($errorCode == 3)
						echo "<span class='error'><strong>".$errorMessage."</strong></span>";
					?>
				</div>
				<div class="form-group">
    				<label for="password">Mot de Passe</label>
    				<input type="password" class="form-control" name="password" id="password" required />
					<?php
					if ($errorCode == 4)
						echo "<span class='error'><strong>".$errorMessage."</strong></span>";
					?>
  				</div>
				<div class="form-group">
    				<label for="password1">Retaper le mot de Passe</label>
    				<input type="password" class="form-control" name="password1" id="password1" required />
					<?php
					if ($errorCode == 4)
						echo "<span class='error'><strong>".$errorMessage."</strong></span>";
					?>
  				</div>
  				<div class="form-group">
    				<label for="email">Email</label>
    				<input type="email" class="form-control" name="email" id="email" required />
					<?php
					if ($errorCode == 5)
						echo "<span class='error'><strong>".$errorMessage."</strong></span>";
					?>
  				</div>
  				<div class="form-group form-check">
    				<label class="form-check-label">
      					<input class="form-check-input" type="checkbox" id="cookie" name="cookie" value="yes" />Se souvenir de moi
    				</label>
  				</div>
  				<button type="submit" class="btn btn-success">S'inscrire</button>
			</form>
		</div>
	</div>
</section>
<?php $sectionMainContent = ob_get_clean(); ?>


<?php require('UserTemplateView.php'); ?>	
