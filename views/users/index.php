<h1><?= htmlspecialchars($this->title) ?></h1>

<table>
	<?php foreach ($this->users as $user) : ?>
		<tr>
			<td>
				<a href="<?= BASE_HOST ?>/users/view/<?= $user['id']?>">
					<?= htmlspecialchars($user['username'])?>
				</a>
			</td>
		</tr>
	<?php endforeach ?>
</table>
