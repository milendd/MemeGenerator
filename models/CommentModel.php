<?php

class CommentModel{
	public function getAll($memeID){
        $statement = self::$db->prepare("SELECT * FROM comments WHERE meme_id = ?");
        $statement->bind_param("i", $memeID);
        $statement->execute();

        return $statement->get_result()->fetch_assoc();
	}
}
