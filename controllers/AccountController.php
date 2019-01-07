<?php

class AccountController extends BaseController {
	public function register() {
		if (isset($_SESSION['userID'])) {
			$this->redirect("home");
		}
		else {
			if ($this->isPost()) {
				$username = $_POST['username'];
				$password = $_POST['password'];
				$email = $_POST['email'];
	
				$msg = $this->dbRegister($username, $password, $email);
				
				if (strlen($msg) == 0) {
					$user = $this->dbGetID($username);
					$_SESSION['user'] = $username;
					$_SESSION['userID'] = (int) $user['id'];
					$this->addSuccessMessage("Успешна регистрация!");
					$this->redirect("home");
				}
				else {
					$this->addErrorMessage($msg);
				}
			}
		}
	}
	
	public function login() {
		if (isset($_SESSION['userID'])) {
			$this->redirect("home");
		}
		else {
			if ($this->isPost()) {
				$username = $_POST['username'];
				$password = $_POST['password'];
				
				if ($this->dbLogin($username, $password)) {
					$user = $this->dbGetID($username);
					$_SESSION['user'] = $username;
					$_SESSION['userID'] = (int) $user['id'];
					$this->addSuccessMessage("Успешен вход!");
					$this->redirect("home");
				}
				else {
					$this->addErrorMessage("Невалидно потребителско име или парола!");
				}
			}
		}
	}
	
	public function logout() {
		unset($_SESSION['user']);
		unset($_SESSION['userID']);
		$this->isLoggedIn = false;
		$this->addSuccessMessage("Успешен изход!");
		$this->redirect("home");
	}
}
