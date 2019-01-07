<?php

class TemplatesController extends BaseController {
	public function onInit() {
		$this->title = "Картинки";
	}
	
	public function index() {
		$this->templates = $this->dbGetAllTemplates();
	}

	public function add() {
		$target_dir = "";
		$largestNumber = $this->dbGetLastTemplateID();
		$extention = pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION);
		$target_file = $target_dir . ($largestNumber + 1) . '.' . $extention;

		if ($this->isOfAllowedFormat($extention) && 
			$this->isOfAllowedSize() && 
			$this->isImage()) {

			$upload_dir = 'content/images/templates/';
			$full_path = $upload_dir . $target_file;

			$texts = $_POST["texts"];
			$xarray = $_POST["xarray"];
			$yarray = $_POST["yarray"];
			
			$result = "";
			$len = sizeof($texts);
			for ($i = 0; $i < $len; $i++) {
				$result = 
					$result . '{"text":"' . $texts[$i] . 
					'","x":' . $xarray[$i] . 
					',"y":' . $yarray[$i] . '}';
				if ($i != $len - 1) {
					$result = $result . ",";
				}
			}

			$positions = '{"data":[' . $result . ']}';

			if (is_dir($upload_dir) && is_writable($upload_dir)) {
				if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $full_path)) {
					$this->dbAddTemplate($_POST["meme-name"], $target_file, $positions);
					
					$this->addSuccessMessage("Картинката ". basename( $_FILES["fileToUpload"]["name"]). " беше качена успешно.");
				} 
				else {
					$this->addErrorMessage("Неуспешно качване!");
				}
			} 
			else {
				$this->addErrorMessage("Не съществува директорията или няма права за писане!");
			}
		} 
		
		// Reload page
		header("Refresh:0");
	}

	private function isImage() {
		if (isset($_POST["submit"])) {
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if ($check !== false) {
				return true;
			} 

			$this->addErrorMessage("Файлът не е картинка!");
			return false;
		}
	}

	private function isOfAllowedSize() {
		if ($_FILES["fileToUpload"]["size"] > 1200000) {
			$this->addErrorMessage("Файлът е прекалено голям!");
			return false;
		}

		return true;
	}

	private function isOfAllowedFormat($extention) {
		if ($extention != "jpg" && $extention != "png" && $extention != "jpeg" && $extention != "gif" ) {
			$this->addErrorMessage("Позволени са само jpg, png, jpeg и gif формати!");
			return false;
		}

		return true;
	}
}
