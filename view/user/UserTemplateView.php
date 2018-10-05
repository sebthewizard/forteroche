<!doctype html>
<html lang="fr" prefix="og: http://ogp.me/ns#">

<head>
	<title><?= $title ?></title>
    <meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" />
	<link rel="stylesheet" href="public/css/styles.css" />
	<link rel="icon" type="image/png" href="public/images/feather.png" />
</head>

<body>
	
	<header class="sticky-top">
		<?php if (isset($_SESSION['id'])) { ?>
		<div class="jumbotron jumbotron-fluid jumbotron-header-img">
 			<div class="container d-flex justify-content-center align-items-center flex-column">
				<div id="textJumbotron">
    				<h1>Jean Forteroche</h1> 
    				<h3>Billet simple pour l'Alaska</h3>
				</div>
  			</div>
		</div>
		<?php } ?>
		<nav class="navbar navbar-expand-md bg-dark navbar-dark">
			<div class="container">
				<a class="navbar-brand" href="index.php">
					<img src="public/images/feather.png" alt="feather logo">
					<span>
					<?php if (isset($_SESSION['pseudo'])) echo $_SESSION['pseudo'];?>
					</span>
				</a>
			<button class="navbar-toggler navbar-light" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    			<span class="navbar-toggler-icon"></span>
  			</button>
				<div class="collapse navbar-collapse" id="collapsibleNavbar">
  					<ul class="navbar-nav">
    					<li class="nav-item">
							<?php
							if (isset($_SESSION['pseudo']))
								echo "<a class='nav-link' href='index.php?action=disconnection'>Déconnexion</a>";
							else
								echo "<a class='nav-link' href='index.php?action=connection'>Se connecter</a>";
							?>
    					</li>
    					<li class="nav-item">
      						<a class="nav-link" href="index.php?action=register">S'inscrire</a>
    					</li>
						<?php
						if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
							echo "<li class='nav-item'>";
								echo "<a class='nav-link' href='index.php?action=admin'>Administrer</a>";
							echo "</li>";
						}
						?>
  					</ul>
				</div>
			</div>
		</nav>
	</header>
	
	<?= $sectionMainContent ?>
	
	<footer>
		<?php require('view/FooterView.php'); ?>
	</footer>
	
	<!-- tinymce -->
	<script src="vendor/tinymce/js/tinymce/tinymce.min.js"></script>
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <script src="public/js/script.js"></script>
</body>

</html>			
