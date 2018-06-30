<?php

class CommentModel extends BaseModel {
	public function getAll($memeID){
        $statement = self::$db->prepare("SELECT * FROM v_comments WHERE meme_id = 22");
        //$statement->bind_param("i", $memeID);
        $statement->execute();

        return $statement->get_result()->fetch_all();
	}
}
