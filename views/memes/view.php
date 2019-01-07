<?php if (isset($this->selectedMeme)): ?>
	<div class="meme-container-large">
		<div class="meme-title center"><?= htmlspecialchars($this->selectedMeme['title']) ?></div>
		<img alt="<?= $this->selectedMeme['title'] ?>" style="display: block; margin: 0 auto; width: inherit;"
			src="<?= $this->memesPath . '/' . $this->selectedMeme['username'] . '/' . $this->selectedMeme['file_name'] ?>" />
		
		<div class="meme-userinfo">
			<div>
				<span>Качено от</span>
				<a href="<?= BASE_HOST . "/users/view/" . $this->selectedMeme['user_id'] ?>">
					<?= htmlspecialchars($this->selectedMeme['username']) ?>
				</a>
			</div>

			<?php 
				$currentDate = new DateTime($this->selectedMeme['created_at']);
				$formatedDate = $currentDate->format(MY_DATE_FORMAT);
			?>
			<div>Качено на <?= $formatedDate ?></div>
		</div>
	</div>

	<div class="comment-section">
		<div class="comment-section-title">
			<?php 
			if (is_string($this->comments)) {
				echo $this->comments;
			} 
			else {
				if (isset($this->comments) && count($this->comments) > 0) {
					echo count($this->comments);
					if (count($this->comments) == 1){
						echo " коментар";
					} else {
						echo " коментара";
					}
				}
			} ?>
		</div>
		
		<?php if (isset($this->comments) && count($this->comments) > 0): ?>
			<?php foreach ($this->comments as $comment): ?>
				<div class="comment">
					<div class="comment-text">
						<?= htmlspecialchars($comment[1]) ?>
					</div>
					<div>
						Качено от
						<a href="<?= BASE_HOST . "/users/view/" . $comment[4] ?>">
							<?= htmlspecialchars($comment[5]) ?>
						</a>
					</div>
					<?php 
						$currentDate = new DateTime($comment[2]);
						$formatedDate = $currentDate->format(MY_DATE_FORMAT);
					?>
					<div>Качено на <?= htmlspecialchars($formatedDate) ?></div>
				</div>
			<?php endforeach; ?>
		<?php else: ?>
			<span>Няма коментари</span>
		<?php endif; ?>

		<?php if ($this->isLoggedIn) :?>
			<form class="comment-write" method="post" action="<?= BASE_HOST ?>/memes/createComment">
				<textarea name="newComment" placeholder="Добавете коментар" style="margin-bottom:10px;"></textarea>
				<input type="hidden" name="memeId" value="<?= $this->selectedMeme['meme_id'] ?>" />
				<input type="submit" class="btn" value="Добави" />
			</form>
		<?php else: ?>
			<div class="msg warning">Не може да пишете коментари ако нямате акаунт!</div>
		<?php endif; ?>
	</div>

<?php endif; ?>
