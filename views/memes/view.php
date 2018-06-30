<?php if (isset($this->selectedMeme)) :?>
    <div class="meme-container-large">
        <div class="meme-title center"><?= htmlspecialchars($this->selectedMeme['title']) ?></div>
        <img alt="<?= $this->selectedMeme['title'] ?>" style="display: block; margin: 0 auto;"
            src="<?= $this->memesPath . '/' . $this->selectedMeme['username'] . '/' . $this->selectedMeme['file_name'] ?>" />
        
        <div class="meme-userinfo">
            <div>
                <span>by </span>
                <a href="<?= BASE_HOST . "/users/view/" . $this->selectedMeme['user_id'] ?>">
                    <?= htmlspecialchars($this->selectedMeme['username']) ?>
                </a>
            </div>

            <?php 
                $currentDate = new DateTime($this->selectedMeme['created_at']);
                $formatedDate = $currentDate->format(CUSTOM_DATE_FORMAT);
            ?>
            <div>posted on <?= $formatedDate ?></div>
        </div>

        <div class="comment-section">
            <?php if (isset($this->comments) && count($this->comments) > 0):
                    foreach ($this->comments as $comment): ?>
                        <div class="comment">
                            <div class="comment-text">
                                <?= htmlspecialchars($comment[1]) ?>
                            </div>
                            <div class="comment-author">
                                <?= htmlspecialchars($comment[5]) ?>
                            </div>
                        </div>
                    <?php endforeach;
                    else:
                        echo "Kill me";
                    endif;
                ?>
        </div>
    </div>

<?php endif;?>
