<?php

require_once "config_new.php";
//Database Class
class Database  {
    
    public $conn;

    //Automatic instatiation
    public function __construct() {
        $this->database_connection();
    }

    public function database_connection() {
        $this->conn = new mysqli(DB[0],DB[1],DB[2],DB[3]);

        if($this->conn->connect_errno) {
            echo "Connection failed (".$this->conn->errno.")". $this->conn->connect_error;
        }
    }
    //Query
    public function query($sql) {

        $result = $this->conn->query($sql);
        $this->confirm_query($result);
        
        return $result;
    }

    private function confirm_query($result) {
        if(!$result) {
            die("Query failed" . $this->conn->error);
        }
    }
    //Escape string
    public function escape_string($string) {

        $escaped_string = $this->conn->escape_string($string);
        return $escaped_string;
    }
    //Insert ID
    public function insert_id() {
        
        return $this->conn->insert_id;
    }
    
}

//Instatiate the class
$database = new Database;
?>