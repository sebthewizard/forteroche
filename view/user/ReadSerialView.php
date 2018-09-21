<?php $title = 'Jean Forteroche épisode'; ?>


<?php ob_start(); ?>
<section>
	<div class="container" id="readSerial">
		<div class="row">
			<div class="col-lg-offset-1 col-lg-1"></div>
			<div class="col-lg-10">
				<h3 class="title-serial">épisode <?= $dataSerial['number'] ?>. <?= $dataSerial['title'] ?></h3>>
				<p class="date-serial">Par <strong><?= $pseudo ?></strong> <?= $dataSerial['crea_date'] ?> | Mise à jour <?= $dataSerial['la_upda_date'] ?></p>
				<div id="content-serial">
					<p><?= $dataSerial['content'] ?></p>
				</div>
			</div>
			<div class="col-lg-offset-1 col-lg-1"></div>
		</div>
	</div>
	<div class="container" id="sendComment">
		<div class="row">
			<div class="col-lg-offset-1 col-lg-1"></div>
			<div class="col-lg-10" id="send-comment">
				<form method="post" action="index.php?action=addcomment">
					<input type="hidden" id="serialId" name="serialId" value="<?= $serialId ?>" />
					<div class="form-group">
    					<label for="pseudo">Ajouter un commentaire</label>
    					<textarea class="form-control" rows="5" name="addComment" id="addComment"></textarea>
					</div>
					<button type="submit" class="btn btn-success">Commenter</button>
				</form>
			</div>
			<div class="col-lg-offset-1 col-lg-1"></div>
		</div>
	</div>
	<div class="container" id="showComment">
		<?php
		while ($data = $q->fetch()) {
		?>
		<div class='row'>
			<div class='col-lg-offset-1 col-lg-1'></div>
			<div class='col-lg-10'>
				<p class="user-comment">De <strong><?=$data['user_pseudo'] ?></strong> <?= $data['comment_date'] ?></p>
				<p class="comment-content"><?= $data['comment_content'] ?></p>
				<div class="d-flex justify-content-end">
					<?php if ($data['comment_validated'] == 0) { ?>
					<form method='post' action='index.php?action=signalcomment'>
						<input type='hidden' id='commentId' name='commentId' value="<?= $data['comment_id'] ?>" />
						<input type='hidden' id='commentSerialId' name='commentSerialId' value="<?= $serialId ?>" />
						<?php
						if ($data['comment_signaled'] == 0)
							echo "<button type='submit' class='btn btn-outline-success btn-sm'>Signaler</button>";
						else
							echo "<button type='submit' class='btn btn-outline-success btn-sm' disabled>Signaler</button>";
						?>
					</form>
					<?php } 
					else echo "<p class='text-success'>Commentaire validé</p>"; 
					?>
				</div>
			</div>
			<div class='col-lg-offset-1 col-lg-1'></div>
		</div>
		<?php
		}
		$q->closeCursor();
		?>
	</div>
<?php if ($numberOfPages != 0) { ?>
<ul class="pagination pagination-sm justify-content-center m-2">
	<?php if ($pageNum == 1) { ?>
  		<li class="page-item disabled"><a class="page-link" href="#">Précédent</a></li>
	<?php } else { $pagePrec = $pageNum-1; ?>
		<li class="page-item">
			<a class="page-link" href="index.php?action=readserial&amp;serialId=<?= $serialId ?>&amp;pageNum=<?= $pagePrec ?>">Précédent</a>
		</li>
	<?php } ?>
	<?php for ($i=1;$i<=$numberOfPages;$i++) { ?>
	<?php if ($i == $pageNum) { ?>
  		<li class="page-item active">
	<?php } else { ?>
		<li class="page-item">
	<?php } ?>
	  	<a class="page-link" href="index.php?action=readserial&amp;serialId=<?= $serialId ?>&amp;pageNum=<?= $i ?>"><?= $i ?></a>
	</li>
	<?php } ?>
	<?php if ($pageNum == $numberOfPages) { ?>
  		<li class="page-item disabled"><a class="page-link" href="#">Suivant</a></li>
	<?php } else { $pageSuiv = $pageNum+1; ?>
		<li class="page-item">
			<a class="page-link" href="index.php?action=readserial&amp;serialId=<?= $serialId ?>&amp;pageNum=<?= $pageSuiv?>">Suivant</a>
		</li>
	<?php } ?>
</ul>
<?php } ?>
</section>
<?php $sectionMainContent = ob_get_clean(); ?>

<?php require('UserTemplateView.php'); ?>