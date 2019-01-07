<?php if (isset($this->memes) && count($this->memes) > 0) :?>
	<?php foreach ($this->memes as $meme): ?>
		<?php $currentMemePath = BASE_HOST . "/memes/view/" . $meme['meme_id'] ?>

		<div class="meme-container-small">
			<a href="<?= $currentMemePath ?>"><img alt="<?= htmlspecialchars($meme['title']) ?>" class="mini"
				src="<?= $this->memesPath . '/' . htmlspecialchars($meme['username']) .
				'/' . htmlspecialchars($meme['file_name']) ?>" /></a>
			<?php if ($this->canRemoveMeme) :?>
				<button type="button" class="btn delete-meme" onclick="deleteMeme(<?= $meme['meme_id'] ?>)">Изтрий</button>
			<?php endif; ?>
		</div>
	<?php endforeach; ?>
	
	<form action="<?= BASE_HOST ?>/memes/delete" method="post" id="deleteMemeForm" style="visibility: hidden" >
		<input type="text" id="delete-id" name="id" />
	</form>
<?php else: ?>
	<div>Няма налични мемета</div>
<?php endif; ?>

<script>
	function deleteMeme(id) {
		$('#delete-id').val(id);
		$('#deleteMemeForm').submit();
	}
</script>