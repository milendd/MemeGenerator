<h1><?= htmlspecialchars($this->title) ?></h1>

<form method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    Meme name:
    <input type="text" name="meme-name" id="meme-name">
    <input type="submit" class="btn" value="Upload Image" name="submit">
</form>

<?php
if ($this->isPost()) {
    $this->add();
}
?>



<?php foreach ($this->templates as $template) : ?>
    <div>
        <img title="<?= htmlspecialchars($template['name']) ?>" class="template-img"
            src="<?= $this->templatesPath . '/' . $template['file_name'] ?>"/>
    </div>
<?php endforeach ?>
