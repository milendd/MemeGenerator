<?php

class HomeController extends BaseController {
	public function onInit() {
		$this->title = "Начало";
	}

	public function index() {
		$this->memes = $this->dbGetAllMemes();
	}
}
