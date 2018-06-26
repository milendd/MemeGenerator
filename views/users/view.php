<?php if (isset($this->selectedUser)) :?>
    <h1><?= htmlspecialchars($this->title) ?></h1>
    <div>Username: <?= htmlspecialchars($this->selectedUser['username']); ?></div>
    <div>Email: <?= htmlspecialchars($this->selectedUser['email']); ?></div>

    <h2>Memes</h2>
    <?php include_once('views/layouts/memes.php'); ?>

<?php endif;?>
