<?php

class CommentModel extends BaseModel {
	public function getAll($memeID){
        $statement = self::$db->prepare("SELECT * FROM v_comments WHERE meme_id = ? ORDER BY id DESC");
        $statement->bind_param("i", $memeID);
        $statement->execute();

        return $statement->get_result()->fetch_all();
	}

	public function create($commentText, $memeID) {
		if ($commentText == '') {
            return false;
        }
        $statement = self::$db->prepare(
            "INSERT INTO comments (comment, meme_id, user_id) VALUES (?, ?, ?)"
        );
        
        $userID = $_SESSION['userID'];
        $statement->bind_param("sii", $commentText, $memeID, $userID);

        $statement->execute();
        return $statement->affected_rows > 0;
    }
}
