<?php $title = 'Jean Forteroche s\'enregistrer'; ?>

<?php ob_start(); ?>
<nav class="navbar navbar-expand-md bg-light fixed-top">
	<a class="navbar-brand d-flex" href="index.php">
    	<img src="public/images/feather.png" alt="feather logo">
		<h1 class="align-self-center" id="title">Jean Forteroche</h1>
  	</a>
	<button class="navbar-toggler navbar-light" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    	<span class="navbar-toggler-icon"></span>
  	</button>
	<div class="collapse navbar-collapse" id="collapsibleNavbar">
  		<ul class="navbar-nav">
    		<li class="nav-item">
      			<a class="nav-link" href="index.php?action=connexion">Se connecter</a>
    		</li>
    		<li class="nav-item">
      			<a class="nav-link" href="index.php?action=register">S'inscrire</a>
    		</li>
  		</ul>
	</div>
</nav>
<?php $headerContent = ob_get_clean(); ?>

<?php ob_start(); ?>
<section id="hello-register">
	<img src="public/images/home.jpg" class="img-fluid" alt="home image">
	<div id="hello-register-container">
		<div id="hello-register-content">
			<h2>S'inscrire pour lire</h2>
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
  				<button type="submit" class="btn btn-success">Inscription</button>
			</form>
		</div>
	</div>
</section>
<?php $sectionMainContent = ob_get_clean(); ?>


<?php require('template.php'); ?>	
