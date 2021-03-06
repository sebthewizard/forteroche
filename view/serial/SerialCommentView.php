<?php $title = 'Jean Forteroche commentaires'; ?>

<?php ob_start(); ?>
<section>
	<div class="container" id="adminCommentSerial">
		<h2>Gérer les commentaires</h2>
		<div class="row">
			<div class="col-lg-offset-1 col-lg-1"></div>
			<div class="col-lg-10">
				<div class='d-flex flex-column border border-success rounded p-2'>
					<div class="d-flex justify-content-center text-white">
						<span>Choisissez le mode de classement des commentaires</span>
					</div>
					<div class='d-flex justify-content-center flex-wrap'>
						<form class="p-2" method='post' action='index.php?action=serialcomment'>
							<input type='hidden' id='sortComment' name='sortComment' value="1" />
							<button type='submit' class='btn btn-success'>Tous les nouveaux</button>
						</form>
						<form class="p-2" method='post' action='index.php?action=serialcomment'>
							<input type='hidden' id='sortComment' name='sortComment' value="2" />
							<button type='submit' class='btn btn-success'>Tous les signalés</button>
						</form>
						<form class="p-2" method='post' action='index.php?action=serialcomment'>
							<input type='hidden' id='sortComment' name='sortComment' value="3" />
							<button type='submit' class='btn btn-success'>Nouveaux par épisode</button>
						</form>
						<form class="p-2" method='post' action='index.php?action=serialcomment'>
							<input type='hidden' id='sortComment' name='sortComment' value="4" />
							<button type='submit' class='btn btn-success'>Nouveaux par épisode et signalés</button>
						</form>
					</div>
				</div>
			</div>
			<div class="col-lg-offset-1 col-lg-1"></div>
		</div>
		<?php if (isset($_POST['sortComment'])) { while ($data = $q->fetch()) { ?>
		<div class="row">
			<div class="col-lg-offset-1 col-lg-1"></div>
			<div class="col-lg-10">
				<p class="user-comment">De <strong><?= $data['user_pseudo'] ?></strong> <?= $data['comment_date'] ?>
				 pour l'épisode <?= $data['serial_number'] ?></p>
				<p class="comment-content"><?= $data['comment_content'] ?></p>
				<div class="d-flex justify-content-end flex-wrap">
					<form class="p-2" method='post' action='index.php?action=commentdelete&amp;sort=<?= $_POST['sortComment'] ?>&amp;pageNum=<?= $pageNum ?>'>
						<input type='hidden' id='deleteComment' name='deleteComment' value="<?= $data['comment_id'] ?>" />
						<button type='submit' class='btn btn-outline-success btn-sm'>Supprimer</button>
					</form>
					<form class="p-2" method='post' action='index.php?action=commentvalidate&amp;sort=<?= $_POST['sortComment'] ?>&amp;pageNum=<?= $pageNum ?>'>
						<input type='hidden' id='validateComment' name='validateComment' value="<?= $data['comment_id'] ?>" />
						<button type='submit' class='btn btn-outline-success btn-sm'>Valider</button>
					</form>
				</div>
			</div>
			<div class="col-lg-offset-1 col-lg-1"></div>
		</div>
		<?php } $q->closeCursor(); }?>
	</div>
<?php if ($numberOfPages != 0) { ?>
<ul class="pagination pagination-sm justify-content-center m-2">
	<?php if ($pageNum == 1) { ?>
  		<li class="page-item disabled"><a class="page-link" href="#">Précédent</a></li>
	<?php } else { $pagePrec = $pageNum-1; ?>
		<li class="page-item">
			<a class="page-link" href="index.php?action=serialcomment&amp;sort=<?= $_POST['sortComment'] ?>&amp;pageNum=<?= $pagePrec ?>">Précédent</a>
		</li>
	<?php } ?>
	<?php for ($i=1;$i<=$numberOfPages;$i++) { ?>
	<?php if ($i == $pageNum) { ?>
  		<li class="page-item active">
	<?php } else { ?>
		<li class="page-item">
	<?php } ?>
	  	<a class="page-link" href="index.php?action=serialcomment&amp;sort=<?= $_POST['sortComment'] ?>&amp;pageNum=<?= $i ?>"><?= $i ?></a>
	</li>
	<?php } ?>
	<?php if ($pageNum == $numberOfPages) { ?>
  		<li class="page-item disabled"><a class="page-link" href="#">Suivant</a></li>
	<?php } else { $pageSuiv = $pageNum+1; ?>
		<li class="page-item">
			<a class="page-link" href="index.php?action=serialcomment&amp;sort=<?= $_POST['sortComment'] ?>&amp;pageNum=<?= $pageSuiv ?>">Suivant</a>
		</li>
	<?php } ?>
</ul>
<?php } ?>
</section>
<?php $sectionMainContent = ob_get_clean(); ?>

<?php require('SerialTemplateView.php'); ?>	