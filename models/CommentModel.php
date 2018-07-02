<?php

class CommentModel extends BaseModel {
	public function getAll($memeID){
        $statement = self::$db->prepare("SELECT * FROM v_comments WHERE meme_id = ?");
        $statement->bind_param("i", $memeID);
        $statement->execute();

        return $statement->get_result()->fetch_all();
	}

	public function create($commentText, $memeID) {
		if ($commentText == '') {
            return false;
        }
        $statement = self::$db->prepare(
            "INSERT INTO comments (`comment`, `meme_id`, `user_id`) VALUES(?, ?, ?)"
            );
        $statement->bind_param("s", $commentText);
        $statement->bind_param("i", $memeID);
        $userID = $_SESSION['userID']['id'];
        $statement->bind_param("i", $userID);

        $statement->execute();
        echo $statement->affected_rows > 0;
        return $statement->affected_rows > 0;
    }
}
