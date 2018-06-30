<?php if (isset($this->memes) && count($this->memes) > 0) :?>
    <?php foreach ($this->memes as $meme): ?>
        <?php $currentMemePath = BASE_HOST . "/memes/view/" . $meme['meme_id'] ?>

        <div class="meme-container-large fixed-container">
            <a href="<?= $currentMemePath ?>"> 
                <img alt="<?= $meme['title'] ?>" class="large"
                    src="<?= $this->memesPath . '/' . $meme['username'] . '/' . $meme['file_name'] ?>" />
            </a>
            <div class="right-content">
                <div class="meme-title">
                    <a href="<?= $currentMemePath ?>"><?= htmlspecialchars($meme['title']) ?></a>
                </div>
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
