<?php if (isset($this->memes) && count($this->memes) > 0) :?>
    <?php foreach ($this->memes as $meme): ?>
        <?php $currentMemePath = BASE_HOST . "/memes/view/" . $meme['meme_id'] ?>

        <div class="meme-container-small">
            <a href="<?= $currentMemePath ?>"> 
                <img alt="<?= $meme['title'] ?>" class="mini"
                    src="<?= $this->memesPath . '/' . $meme['username'] . '/' . $meme['file_name'] ?>" />
            </a>
        </div>

    <?php endforeach; ?>
<?php else: ?>
    <h3>No memes to show</h3>
<?php endif; ?>
