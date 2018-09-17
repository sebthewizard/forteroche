<?php $title = 'Jean Forteroche présentation'; ?>

<?php ob_start(); ?>
<section>
	<div class="container d-flex justify-content-center align-items-center" id="notConnectedHome">
		<div id="textNotConnectedHome">
			<h1>Jean Forteroche</h1>
			<p>Bienvenue sur mon blog</p>
			<p>Cette année j'ai décidé de vous faire</p>
			<p>partager mon nouveau roman par épisode</p>
			<h4>Billet simple pour l'Alaska</h4>
			<p>Pour le suivre il suffit de vous inscrire</p>
			<p>Bonne lecture à toutes et à tous !</p>
		</div>
	</div>
</section>
<?php $sectionMainContent = ob_get_clean(); ?>


<?php require('UserTemplateView.php'); ?>