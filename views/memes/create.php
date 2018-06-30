<h1><?= htmlspecialchars($this->title) ?></h1>

<div>
    <div class="left-template-container">
        <canvas id="create-canvas"></canvas>

        <form method="post" action="TODO:/categories/create">
            Category title: <br>
            <input type="text" name="title" /> <br>
            <input type="submit" value="Create">
            <a href="/categories">Cancel</a>
        </form>
    </div>

    <div class="right-template-container">
        <?php foreach ($this->templates as $template) : ?>
            <img title="<?= htmlspecialchars($template['name']) ?>" class="template-select"
                src="<?= $this->templatesPath . '/' . $template['file_name'] ?>"/>
        <?php endforeach ?>
    </div>

    <div class="clearfix"></div>

</div>

<script>
    var TemplatesPath = '<?= $this->templatesPath ?>';
</script>
<script src="<?= BASE_HOST . SCRIPTS_PATH ?>/createMeme.js"></script>
