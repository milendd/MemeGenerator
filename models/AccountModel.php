<?php

class AccountModel extends BaseModel {
    public function login($username, $password) {
        $statement = self::$db->prepare("SELECT username, pass_hash FROM users WHERE username = ?");
        $statement->bind_param("s", $username);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        
        if (password_verify($password, $result['pass_hash'])) {
            return true;
        }
        
        return false;
    }
    
    public function register($username, $password, $email) {
        if (!isset($username) || strlen($username) < 3 || strlen($email) < 5) {
            return false;
        }
    
        $statement = self::$db->prepare("SELECT COUNT(id) AS 'count' FROM users WHERE username = ?");
        $statement->bind_param("s", $username);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();

        var_dump($result);
        
        if ($result['count']) {
            return false;
        }
        
        $pass_hash = password_hash($password, PASSWORD_BCRYPT);
        
        $registerStatement = self::$db->prepare("INSERT INTO Users (username, pass_hash, email, is_admin) VALUES (?, ?, ?, 0)");
        $registerStatement->bind_param("sss", $username, $pass_hash, $email);
        $registerStatement->execute();
        
        return true;
    }
}
