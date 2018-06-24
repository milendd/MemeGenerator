<?php if (isset($this->selectedUser)) :?>
    <h1><?= htmlspecialchars($this->title) ?></h1>
    <div>Username: <?= htmlspecialchars($this->selectedUser['username']); ?></div>
    <div>Email: <?= htmlspecialchars($this->selectedUser['email']); ?></div>
<?php endif;?>
