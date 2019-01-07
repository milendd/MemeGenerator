<?php

class MemesController extends BaseController {
	public function onInit() {
		//tODO:
	}
	
	public function view($id = 0) {
		$this->selectedMeme = $this->dbFindMeme($id);
		if (!isset($this->selectedMeme)) {
			$this->addErrorMessage("Не съществува такова меме!");
			return;
		}

		$this->comments = $this->dbGetAllComments($id);
	}

	public function create() {
		$this->authorize('За да създадете меме трябва да се логнете в акаунта!');
		$this->title = 'Създаване на меме';

		if ($this->isPost()) {
			$base64 = $_POST['imgBase64'];

			list($type, $data) = explode(';', $base64);
			list(, $data)	  = explode(',', $base64);
			$data = base64_decode($data);

			$encoded = sha1($data);
			$filename = substr($encoded, 0, 10) . '.png';

			$username = $_SESSION['user'];
			$directoryPath = 'content/images/memes/' . $username;
			
			if (!file_exists($directoryPath) && !is_dir($directoryPath)) {
				mkdir($directoryPath);
			}

			$path = $directoryPath . '/' . $filename;
			file_put_contents($path, $data);

			$title = $_POST['title'];
			if ($this->dbCreateMeme($title, $filename)) {
				$this->addSuccessMessage('Мемето е създадено успешно.');
				$this->redirect('home');
			} 
			else {
				$this->addErrorMessage('Неуспешно създаване!');
			}
		}
		else {
			$this->templates = $this->dbGetAllTemplates();
		}
	}

	public function delete() {
		$this->authorize('За да изтриете меме трябва да се логнете в акаунта!');

		if ($this->isPost()) {
			$id = $_POST['id'];
			if ($this->dbDeleteMeme($id)) {
				$this->addSuccessMessage('Мемето е изтрито успешно.');
			} 
			else {
				$this->addErrorMessage('Неуспешно изтриване!');
			}
		}
		$this->redirect("users", "profile");
	}

	public function createComment() {
		$this->authorize('За да създадете коментар трябва да се логнете в акаунта!');
		if ($this->isPost()) {
			$commentText = $_POST['newComment'];
			$memeId = (int) $_POST['memeId'];

			if ($this->dbCreateComment($commentText, $memeId)) {
				$this->addSuccessMessage('Коментарът е създаден успешно.');
				$this->redirect('memes', 'view', [ $memeId ]);
			} 
			else {
				$this->addErrorMessage('Неуспешно създаване!');
			}
		}
	}
}
