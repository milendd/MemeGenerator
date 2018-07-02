<?php

class HomeController extends BaseController {
    private $memeModel;

    public function onInit() {
        $this->title = "Home";
        $this->memeModel = new MemeModel();
    }

    public function index() {
        // TODO: paging
        $this->memes = $this->memeModel->getAll();
    }
}
