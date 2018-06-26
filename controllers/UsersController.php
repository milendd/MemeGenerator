<?php

class UsersController extends BaseController {
    private $userModel;
    private $memeModel;

    public function onInit() {
        $this->userModel = new UserModel();
        $this->memeModel = new MemeModel();
        $this->title = "Users";
    }
    
    public function index() {
        $this->users = $this->userModel->getAll();
    }
    
    public function view($id = 0) {
        $this->title = "Profile";
        $this->selectedUser = $this->userModel->find($id);
        if (!isset($this->selectedUser)) {
            $this->addErrorMessage("No such user!");
            return;
        }
        
        $this->memes = $this->memeModel->getMemesByUser($id);
    }
}
