<?php 

//Main Class
class Main {

    //Find all data in the database using this query
    public static function find_all() {
        $result = static::find_by_query("SELECT * FROM ". static::$db_table ." ");
        return $result; //Use static keyword for late static binding
    } //End

    //Find the id by this method
    public static function find_by_id($id) {
        $result = static::find_by_query("SELECT * FROM ". static::$db_table ." WHERE id = $id LIMIT 1");
        return !empty($result) ? array_shift($result) : false;
    } //End

      //Global method for finding each queries
    public static function find_by_query($sql) {
        global $database;
        $result = $database->query($sql);
        $object_array = []; //Empty array

        while($row = $result->fetch_array()) {
            $object_array[] = static::instatiation($row);
        }
        return $object_array;
    } //End


    
    //Automatically instatiate all the class
    public static function instatiation($user_record) {
        $called_class = get_called_class(); //For late static binding
        $user_object = new $called_class;
        //$user_object->parameter = $user_record['value']
        foreach($user_record as $attribute => $value) {
            if($user_object->check_attribute($attribute)) {
                $user_object->$attribute = $value;
            }
        }
        return $user_object;
    } //End

    //Automatically loop all the attributes
    private function check_attribute($attribute) {
        $object_properties = get_object_vars($this); //get object attributes
        return array_key_exists($attribute, $object_properties);
    } //End

    //Loop all properties dynamically
    protected function properties() {
        //Return all the object properties
        $properties = [];

        foreach(static::$db_table_fields as $db_field) {
            if(property_exists($this, $db_field)) {
                $properties[$db_field] = $this->$db_field; //$this->$db_field - is a dynamic variable
            }
        }
        return $properties;    
    } //End
    

       //Escape all the properties in this class
    protected function escape_properties() {
        //Escape all the properties from the loop, or abstraction we created for create and update
        global $database;

        $escape_properties = [];
        foreach($this->properties() as $key => $value) {
            $escape_properties[$key] = $database->escape_string($value);
        }
        return $escape_properties;  
    } //End

     //CRUD Functionalities
     public function save() {
        //Check if the user is in the database
        return isset($this->id) ? $this->update() : $this->create();
    }

    public function create() {
        //Create or insert data`s in the database
        global $database;
        $properties = $this->escape_properties();

        $sql = "INSERT into " . static::$db_table . "(". implode(",", array_keys($properties)) .")";
        $sql .= "VALUES ('". implode("','", array_values($properties)) ."')";
       
        if($database->query($sql)) {
            
            $this->id = $database->insert_id();
                return true;
            } else {
                return false;
            }
    } // End Create method

    public function update() {
        //Update data`s in  the database
        global $database;

        $properties = $this->escape_properties();

        $properties_pairs = [];

        foreach($properties as $key => $value) {
            $properties_pairs[] = "{$key}='{$value}'";
        }

        $sql = "UPDATE ". static::$db_table ." SET ";
        $sql .= implode(", ", $properties_pairs);
        $sql .=" WHERE id= " . $database->escape_string($this->id);
        
        $database->query($sql);
        return ($database->conn->affected_rows == 1) ? true : false;
    } // End Update method

    public function delete() {
        //Delete data`s in the database
        global $database;
        $sql = "DELETE FROM ". static::$db_table ." ";
        $sql .= "WHERE id=" . $database->escape_string($this->id);
        $sql .= " LIMIT 1";

        $database->query($sql);
        return ($database->conn->affected_rows == 1) ? true : false;

    } //End Delete Method

    //End of CRUD functionalities

    public function count_all() {
        global $database;

        $sql = "SELECT COUNT(*) FROM " .static::$db_table;
        $result = $database->query($sql);
        $row = $result->fetch_array();

        return array_shift($row);
    }

   
} //End of Main class





?>