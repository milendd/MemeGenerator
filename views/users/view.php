<?php if (isset($this->selectedUser)) :?>
	<h1><?= htmlspecialchars($this->title) ?></h1>
	<div><b>Потребителско име:</b> <?= htmlspecialchars($this->selectedUser['username']); ?></div>
	<div><b>Електронна поща:</b> <?= htmlspecialchars($this->selectedUser['email']); ?></div>

	<h2>Създадени мемета</h2>
	<?php include_once('views/layouts/memes/displaySmall.php'); ?>

<?php endif;?>
