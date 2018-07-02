<h1><?= htmlspecialchars($this->title) ?></h1>

<form method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" class="btn" value="Upload Image" name="submit">
</form>

<?php
if ($this->isPost()) {
    $target_dir = "";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } 
        else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && 
        $imageFileType != "png" && 
        $imageFileType != "jpeg" && 
        $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } 
    else {
        // if everything is ok, try to upload file
        $upload_dir = ltrim(IMAGE_PATH, '/') . '/templates/';
        $full_path = $upload_dir . $target_file;

        if (is_dir($upload_dir) && is_writable($upload_dir)) {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $full_path)) {
                echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            } 
            else {
                echo "Sorry, there was an error uploading your file.";
            }
        } 
        else {
            echo 'Upload directory is not writable, or does not exist.';
        }
    }
}
?>



<?php foreach ($this->templates as $template) : ?>
    <div>
        <img title="<?= htmlspecialchars($template['name']) ?>" class="template-img"
            src="<?= $this->templatesPath . '/' . $template['file_name'] ?>"/>
    </div>
<?php endforeach ?>
