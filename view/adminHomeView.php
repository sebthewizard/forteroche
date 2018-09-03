<?php $title = 'Jean Forteroche ecriture'; ?>

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
      			<a class="nav-link" href="index.php?action=disconnection">Déconnection</a>
    		</li>
    		<li class="nav-item">
      			<a class="nav-link" href="index.php?action=serialnew">Nouveau</a>
    		</li>
    		<li class="nav-item">
      			<a class="nav-link" href="index.php?action=chooseserialupdate">Modifier</a>
    		</li>
			<li class="nav-item">
      			<a class="nav-link" href="index.php?action=chooseserialdelete">Supprimer</a>
    		</li>
			<li class="nav-item">
      			<a class="nav-link" href="index.php?action=serialcomment">Commentaires</a>
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
			<h2>Bonne ecriture <?= $_SESSION['pseudo']?></h2>
		</div>
	</div>
</section>



<?php $sectionMainContent = ob_get_clean(); ?>

<?php require('template.php'); ?>