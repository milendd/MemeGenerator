<?php

class MemesController extends BaseController {
    private $memeModel;
    private $commentModel;

    public function onInit() {
        $this->memeModel = new MemeModel();
        $this->commentModel = new CommentModel();
    }
    
    public function view($id = 0) {
        $this->selectedMeme = $this->memeModel->find($id);
        if (!isset($this->selectedMeme)) {
            $this->addErrorMessage("No such meme!");
            return;
        }
    }
}
