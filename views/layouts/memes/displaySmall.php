<?php if (isset($this->memes) && count($this->memes) > 0) :?>
    <?php foreach ($this->memes as $meme): ?>
        <div class="meme-container-small">
            <img alt="<?= $meme['title'] ?>" class="mini"
                src="<?= $this->memesPath . '/' . $meme['username'] . '/' . $meme['file_name'] ?>" />
        </div>

    <?php endforeach; ?>
<?php else: ?>
    <h3>No memes to show</h3>
<?php endif; ?>
