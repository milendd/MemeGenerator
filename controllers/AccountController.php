<?php

class AccountController extends BaseController {
    private $accountModel;

    public function onInit() {
        $this->accountModel = new AccountModel();
    }
    
    public function register() {
        if ($this->isPost()) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            
            if ($this->accountModel->register($username, $password, $email)) {
                $_SESSION['user'] = $username;
                $this->addSuccessMessage("Registration successfull!");
                $this->redirect("home");
            }
            else {
                $this->addErrorMessage("Register failed! The username length should be greater than 2, or username is already taken");
            }
        }
    }
    
    public function login() {
        if ($this->isPost()) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            
            if ($this->accountModel->login($username, $password)) {
                $_SESSION['user'] = $username;
                $this->addSuccessMessage("Login successfull!");
                $this->redirect("home");
            }
            else {
                $this->addErrorMessage("Login failed!");
            }
        }
    }
    
    public function logout() {
        unset($_SESSION['user']);
        $this->isLoggedIn = false;
        $this->addSuccessMessage("Logout successfull!");
        $this->redirect("home");
    }
}
