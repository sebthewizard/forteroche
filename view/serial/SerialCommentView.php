<?php $title = 'Jean Forteroche commentaires'; ?>

<?php ob_start(); ?>
<section>
	<div class="container" id="adminCommentSerial">
		<h2>Gérer les commentaires</h2>
	</div>
</section>
<?php $sectionMainContent = ob_get_clean(); ?>

<?php require('SerialTemplateView.php'); ?>	