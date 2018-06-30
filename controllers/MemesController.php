<?php

class MemesController extends BaseController {
    private $memeModel;

    public function onInit() {
        $this->memeModel = new MemeModel();
    }
    
    public function view($id = 0) {
        $this->selectedMeme = $this->memeModel->find($id);
        if (!isset($this->selectedMeme)) {
            $this->addErrorMessage("No such meme!");
            return;
        }
    }
}
