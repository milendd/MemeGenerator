<?php

class TemplatesController extends BaseController {
    private $templateModel;

    public function onInit() {
        $this->templateModel = new TemplateModel();
        $this->title = "Templates";
    }
    
    public function index() {
        $this->templates = $this->templateModel->getAll();
    }

    public function getLastID() {
    	return $this->templateModel->getLastID();
    }

    public function add() {
	    $target_dir = "";
	    $largestNumber = $this->getLastID();
	    $extention = pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION);
	    $target_file = $target_dir . ($largestNumber + 1) . '.' . $extention;

	    if ($this->isOfAllowedFormat($extention) && 
	    	$this->isOfAllowedSize() && 
	    	$this->isImage()) {

	        $upload_dir = ltrim(IMAGE_PATH, '/') . '/templates/';
	        $full_path = $upload_dir . $target_file;

	        if (is_dir($upload_dir) && is_writable($upload_dir)) {
	            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $full_path)) {
	                $this->templateModel->add($_POST["meme-name"], $target_file);
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
	    else {
	        echo "Sorry, your file was not uploaded.";
	    }
    }

    private function isImage() {
	    if(isset($_POST["submit"])) {
	        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	        if($check !== false) {
	            return true;
	        } 
	        else {
	            echo "File is not an image.";
	            return false;
	        }
	    }
    }

    private function isOfAllowedSize() {
	    if ($_FILES["fileToUpload"]["size"] > 1200000) {
	        echo "Sorry, your file is too large.";
	        return false;
	    }
	    return true;
    }

    private function isOfAllowedFormat($extention) {
	    if ($extention != "jpg" && 
	        $extention != "png" && 
	        $extention != "jpeg" && 
	        $extention != "gif" ) {
	            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	            return false;
	    }
	    return true;
	}
}
