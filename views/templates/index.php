<h1><?= htmlspecialchars($this->title) ?></h1>

<?php foreach ($this->templates as $template) : ?>
    <div>
        <img title="<?= htmlspecialchars($template['name']) ?>" class="template-img"
            src="<?= BASE_HOST ?>/content/images/templates/<?= $template['file_name'] ?>"/>
    </div>
<?php endforeach ?>