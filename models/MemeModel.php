<?php

class MemeModel extends BaseModel {
    private $mainQuery = 
        "SELECT m.id AS meme_id, m.file_name, m.title, m.created_at, u.id AS user_id, u.username
        FROM memes m
        JOIN users u ON m.user_id = u.id";

    public function getAll() {
        $statement = self::$db->query($this->mainQuery);
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getMemesByUser($userId) {
        $statement = self::$db->prepare($this->mainQuery . ' WHERE u.id = ?');
        $statement->bind_param("i", $userId);
        $statement->execute();
        $result = $statement->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
