<?php

//User class
class Comment extends Main {

    //Database Properties
    protected static $db_table = "comments";
    protected static $db_table_fields = ['id','photo_id','author','body'];
    public $id;
    public $photo_id;
    public $author;
    public $body;

    //Comment CRUD
    public static function create_comment(int $photo_id,$author ="John", $body="") {
        if(!empty($photo_id) && !empty($author) && !empty($body)) {
            //Automatically instantiate class if the properties are not empty
            $comment = new Comment;

            $comment->photo_id = $photo_id;
            $comment->author = $author;
            $comment->body = $body;

            return $comment;
        } else {
            return false;
        }
    }

    //Find all comments
    public static function find_comments(int $photo_id = 0) {
        global $database;

        $sql ="SELECT * FROM ". self::$db_table;
        $sql.= " WHERE photo_id = ". $database->escape_string($photo_id);
        $sql.= " ORDER BY photo_id ASC";

        return self::find_by_query($sql);
    }
}   //End Comment Class

?>