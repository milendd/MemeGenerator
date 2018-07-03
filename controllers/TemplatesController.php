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

    public function add($memeName, $memeFileName) {
    	return $this->templateModel->add($memeName, $memeFileName);
    }
}
