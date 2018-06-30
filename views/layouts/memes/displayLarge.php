<?php if (isset($this->memes) && count($this->memes) > 0) :?>
    <?php foreach ($this->memes as $meme): ?>
        <div class="meme-container-large">
            <img alt="<?= $meme['title'] ?>" class="large"
                src="<?= $this->memesPath . '/' . $meme['username'] . '/' . $meme['file_name'] ?>" />
            <div class="right-content">
                <div class="meme-title"><?= htmlspecialchars($meme['title']) ?></div>
                <div class="meme-userinfo">
                    <div>
                        <span>by </span>
                        <a href="<?= BASE_HOST . "/users/view/" . $meme['user_id'] ?>">
                            <?= htmlspecialchars($meme['username']) ?>
                        </a>
                    </div>

                    <?php 
                        $currentDate = new DateTime($meme['created_at']);
                        $formatedDate = $currentDate->format(CUSTOM_DATE_FORMAT);
                    ?>
                    <div>posted on <?= $formatedDate ?></div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

    <?php endforeach; ?>
<?php else: ?>
    <h3>No memes to show</h3>
<?php endif; ?>
