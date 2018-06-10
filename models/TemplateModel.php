<?php

class TemplateModel extends BaseModel {
    public function getAll() {
        $statement = self::$db->query("SELECT id, name, file_name FROM templates");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }
}
