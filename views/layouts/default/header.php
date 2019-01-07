<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"></meta>
	<title>
		<?php if (isset($this->title)) echo htmlspecialchars($this->title) ?>
	</title>
	
	<link rel="stylesheet" type="text/css" href="<?= BASE_HOST ?>/content/styles/styles.css" />
	<link rel="stylesheet" type="text/css" href="<?= BASE_HOST ?>/content/styles/memes.css" />
	<script src="<?= BASE_HOST ?>/content/scripts/jquery-3.3.1.min.js"></script>
</head>
<body>
	<div id="nav">
		<a class="nav navbar-brand" href="<?= BASE_HOST ?>">Начална страница</a>
		<a class="nav navbar-nav btn" href="<?= BASE_HOST ?>/users">Потребители</a>
		<a class="nav navbar-nav btn" href="<?= BASE_HOST ?>/templates">Картинки</a>
		<a class="nav navbar-nav btn" href="<?= BASE_HOST ?>/memes/create">Създай меме</a>

		<div id="user-settings">
			<?php if ($this->isLoggedIn) :?>
				<strong><a href="<?= BASE_HOST ?>/users/profile"><?php echo htmlspecialchars($_SESSION['user']); ?></a></strong>
				<form action="<?= BASE_HOST ?>/account/logout" class="logout-form">
					<input type="submit" value="Изход" class="btn" />
				</form>
			<?php else: ?>
				<a class="nav navbar-nav btn" href="<?= BASE_HOST ?>/account/register">Регистрация</a>
				<a class="nav navbar-nav btn" href="<?= BASE_HOST ?>/account/login">Вход</a>
			<?php endif; ?>
		</div>

		<div class="clearfix"></div>
	</div>

	<main>
		<div style="position: absolute; left: 50%; bottom: 25px;">
			<div id="messages" style="position: relative; left: -50%; opacity: 0.7;">
				<?php include('messages.php'); ?>
			</div>
		</div>
