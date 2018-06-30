<?php

class MemeModel extends BaseModel {
    public function getAll() {
        $statement = self::$db->query("SELECT * from v_memes");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getMemesByUser($userId) {
        $statement = self::$db->prepare("SELECT * from v_memes WHERE user_id = ?");
        $statement->bind_param("i", $userId);
        $statement->execute();
        $result = $statement->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function find($id) {
        $statement = self::$db->prepare("SELECT * FROM v_memes WHERE meme_id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->get_result()->fetch_assoc();
    }
}
