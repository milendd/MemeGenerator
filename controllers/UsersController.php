<?php

class UsersController extends BaseController {

	public function onInit() {
		$this->title = "Потребители";
	}
	
	public function index() {
		$this->users = $this->dbGetAllUsers();
	}
	
	public function view($id = 0) {
		$this->title = "Потребител";
		$this->selectedUser = $this->dbFindUser($id);
		if (!isset($this->selectedUser)) {
			$this->addErrorMessage("Не съществува такъв потребител!");
			return;
		}
		
		$this->memes = $this->dbGetMemesByUser($id);
		$this->canRemoveMeme = false;
	}

	public function profile() {
		$this->authorize("Не сте влезнали в акаунта си за да гледате вашият профил");

		$this->title = "Профил";
		$id = $_SESSION["userID"];
		$this->selectedUser = $this->dbFindUser($id);
		if (!isset($this->selectedUser)) {
			$this->addErrorMessage("Не съществува такъв потребител!");
			return;
		}
		
		$this->memes = $this->dbGetMemesByUser($id);
		$this->canRemoveMeme = true;
		$this->renderView("view");
	}
}
