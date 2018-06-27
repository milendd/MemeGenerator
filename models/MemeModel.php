<?php

class MemeModel extends BaseModel {
    public function getAll() {
        $statement = self::$db->query($this->mainQuery);
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getMemesByUser($userId) {
        $statement = self::$db->prepare("SELECT * from v_memes WHERE user_id = ?");
        $statement->bind_param("i", $userId);
        $statement->execute();
        $result = $statement->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
