<?php $title = 'Jean Forteroche épisode'; ?>


<?php ob_start(); ?>
<section>
	<div class="container" id="readSerial">
		<div class="row">
			<div class="col-lg-offset-1 col-lg-1"></div>
			<div class="col-lg-10">
				<p>EPISODE <?= $dataSerial['number'] ?></p>
				<p><?= $dataSerial['title'] ?></p>
				<p>Par <strong><?= $pseudo ?></strong> <?= $dataSerial['crea_date'] ?> | Mise à jour <?= $dataSerial['la_upda_date'] ?></p>
				<p><?= $dataSerial['content'] ?></p>
			</div>
			<div class="col-lg-offset-1 col-lg-1"></div>
		</div>
	</div>
	<div class="container" id="sendComment">
		<div class="row">
			<div class="col-lg-offset-1 col-lg-1"></div>
			<div class="col-lg-10">
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
			echo "<div class='row'>";
				echo "<div class='col-lg-offset-1 col-lg-1'></div>";
				echo "<div class='col-lg-10'>";
					echo "<p>De ".$data['user_pseudo']." ".$data['comment_date']."</p>";
					echo "<p>".$data['comment_content']."</p>";
					echo "<div>";
						echo "<form method='post' action='index.php?action=signalcomment'>";
								echo "<input type='hidden' id='commentlId' name='commentId' value=".$data['comment_id']." />";
								echo "<button type='submit' class='btn btn-success'>Signaler</button>";
						echo "</form>";
					echo "</div>";
				echo "</div>";
				echo "<div class='col-lg-offset-1 col-lg-1'></div>";
			echo "</div>";
		}
		$q->closeCursor();
		?>
	</div>
</section>
<?php $sectionMainContent = ob_get_clean(); ?>

<?php require('UserTemplateView.php'); ?>