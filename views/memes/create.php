<h1><?= htmlspecialchars($this->title) ?></h1>

<div>
    <div class="left-template-container">
        <canvas id="create-canvas"></canvas>
    </div>

    <div class="right-template-container">
        <?php foreach ($this->templates as $template) : ?>
            <span>
                <img title="<?= htmlspecialchars($template['name']) ?>" class="template-select"
                    src="<?= $this->templatesPath . '/' . $template['file_name'] ?>"/>
                <input type="hidden" class="template-positions" value='<?= ($template['positions']); ?>' />
            </span>
        <?php endforeach ?>

        <form method="post" id="meme-form" action="<?= BASE_HOST ?>/memes/create">
            Title:
            <div>
                <input type="text" class="custom-input" name="title" />
            </div>
            <div class="positions-container"></div>
            <input type="hidden" id="imgBase64" name="imgBase64" />
            <input type="button" id="submit-meme" value="Create meme" class="btn" style="margin-top:10px;" />
        </form>
        
    </div>


    <div class="clearfix"></div>

</div>

<script>
    var TemplatesPath = '<?= $this->templatesPath ?>';
</script>
<script src="<?= BASE_HOST . SCRIPTS_PATH ?>/createMeme.js"></script>
