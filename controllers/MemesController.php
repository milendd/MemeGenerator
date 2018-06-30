<?php

class MemesController extends BaseController {
    private $memeModel;
    private $commentModel;
    private $templateModel;

    public function onInit() {
        $this->memeModel = new MemeModel();
        $this->commentModel = new CommentModel();
        $this->templateModel = new TemplateModel();
    }
    
    public function view($id = 0) {
        $this->selectedMeme = $this->memeModel->find($id);
        if (!isset($this->selectedMeme)) {
            $this->addErrorMessage("No such meme!");
            return;
        }
    }

    public function create() {
        $this->authorize('You are not allowed to create memes! Login first!');
        $this->title = 'Create meme';

        $this->templates = $this->templateModel->getAll();
	
		if ($this->isPost()) {
            var_dump($_POST);
            // $title = $_POST['title'];
            // if ($this->categoriesModel->create($title)) {
            //     $this->addInfoMessage("category created.");
            //     $this->redirect("categories");
            // } 
			// else {
            //     $this->addErrorMessage("Could not create category! It should be non-empty or already exists!");
            // }
        }
	}
}
