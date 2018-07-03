<?php

class TemplateModel extends BaseModel {
    public function getAll() {
        $statement = self::$db->query("SELECT id, name, file_name, positions FROM templates");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getLastID() {
	    $rowSQL = self::$db->query("SELECT max(id) AS max FROM templates");
	    $row = mysqli_fetch_array( $rowSQL );

	    return $row['max'];
    }

    public function add($memeName, $memeFileName) {
        // TODO: $defaultPositionData;
        $statement = self::$db->prepare(
            "INSERT INTO templates (name, file_name) VALUES (?, ?)"
        );
        
        $userID = $_SESSION['userID'];
        if (empty($memeName)) {
            $memeName = "Unnamed and lonely meme";
        }
        $statement->bind_param("ss", $memeName, $memeFileName);

        $statement->execute();
        return $statement->affected_rows > 0;
    }
}
