<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"></meta>
    <title>
        <?php if (isset($this->title)) echo htmlspecialchars($this->title) ?>
    </title>
    
    <link rel="stylesheet" type="text/css" href="<?= BASE_HOST . CSS_PATH ?>/styles.css" />
    <link rel="stylesheet" type="text/css" href="<?= BASE_HOST . CSS_PATH ?>/memes.css" />
    <script src="<?= BASE_HOST . SCRIPTS_PATH ?>/jquery-3.2.1.slim.min.js"></script>
</head>
<body>
    <div id="nav">
        <a class="nav navbar-brand" href="<?= BASE_HOST ?>">Meme generator</a>
        <a class="nav navbar-nav" href="<?= BASE_HOST ?>/users">Users</a>
        <a class="nav navbar-nav" href="<?= BASE_HOST ?>/templates">Templates</a>
        <a class="nav navbar-nav" href="<?= BASE_HOST ?>/memes/create">Create</a>

        <div id="user-settings">
            <?php if ($this->isLoggedIn) :?>
                <strong>Hello, <?php echo htmlspecialchars($_SESSION['user']); ?>!</strong>
                <form action="<?= BASE_HOST ?>/account/logout" class="logout-form">
                    <input type="submit" value="Logout" class="btn" />
                </form>
            <?php else: ?>
                <a class="btn" href="<?= BASE_HOST ?>/account/login">Login</a>
                <a class="btn" href="<?= BASE_HOST ?>/account/register">Register</a>
            <?php endif; ?>
        </div>

        <div class="clearfix"></div>
    </div>

    <main>
        <div id="messages">
            <?php include('messages.php'); ?>
        </div>
