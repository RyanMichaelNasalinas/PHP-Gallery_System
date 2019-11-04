<?php
require "main_class.php";
//User class
class User extends Main {

    //Database Properties
    protected static $db_table = "users";
    protected static $db_table_fields = ['username','password','first_name','last_name','user_image','user_level'];
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;
    public $user_image;
    public $user_level;
    public $upload_directory = "images";
    public $image_placeholder = "images/user_image.png";
    public $errors = [];
    public $upload_errors_array = [
        UPLOAD_ERR_OK => "There is no error",
        UPLOAD_ERR_INI_SIZE => "The uploaded file exceeds the upload_max_filesize directory.",
        UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds the MAX_FILE_SIZE directive to the directory.",
        UPLOAD_ERR_PARTIAL => "The uploaded file was only partially uploaded.",
        UPLOAD_ERR_NO_FILE => "No file was uploaded.",
        UPLOAD_ERR_NO_TMP_DIR => "Missing temporary folder.",
        UPLOAD_ERR_CANT_WRITE => "Failed to write a file to disk.",
        UPLOAD_ERR_EXTENSION => "A PHP extension stopped the file upload."
  ]; //Upload error array

     //This is passing $_FILES['file_upload'] as an argument
     public function set_file($file) {

        if(empty($file) || !$file || !is_array($file)) {
            $this->errors[] = "There was no file uploaded here";
            return false; 
        } elseif($file['error'] != 0) {
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;
        } else {
            $this->user_image = basename($file['name']);
            $this->tmp_path = $file['tmp_name'];
            $this->type = $file['type'];
            $this->size = $file['size'];
        }
    }

    
    //For Edit User
    public function upload_photo() {
      
            if(!empty($this->errors)) {
                return false;
            }
             
            if(empty($this->user_image || empty($this->tmp_path))) {
                $this->errors[] = "The file was not available";
                return false;
            }

            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->user_image;

            if(file_exists($target_path)) {
                $this->errors[] = "The file {$this->user_image} already exists";
                return false;
            }

            if(move_uploaded_file($this->tmp_path, $target_path)) {
             
                    unset($this->tmp_path);
                    return true;
            } else {
                $this->errors[] = "File directory does not have permission";
                return false; 
            }
    }

    //Check if the user image is empty
    public function image_placeholder() {
        return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory.DS.$this->user_image;
    }

    //Verify login credential in login.php
    public static function verify_user($username,$password) {
    
        global $database;
        $stmt = $database->conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s",$username);
        $stmt->execute();
        $result = $stmt->get_result();
        $num_rows = $result->num_rows;

        if($num_rows > 0) {
        
            $row = $result->fetch_assoc();
    
            if(password_verify($password,$row['password'])) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['user_level'] = $row['user_level'];
                return true;
            } else {
                return false;
            }
        }
    } //End

        public function check_userlevel($user_level) {
            if($user_level === "admin") {
                return true;
            } else {
                return false;
            }
        }

    public function check_existing_username($username) {
        global $database;
        $stmt = $database->conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s",$username);
        $stmt->execute();
        $result = $stmt->get_result();
        $num_rows = $result->num_rows;

        if($num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function ajax_save_image($user_image, $user_id) {
       global $database;

       $user_image = $database->escape_string($user_image);
       $user_id = $database->escape_string($user_id);

       $this->user_image = $user_image;
       $this->id = $user_id;

       $sql = "UPDATE " . self::$db_table . " SET user_image = '{$this->user_image}' ";
       $sql .= " WHERE id = {$this->id} ";

       $update_image = $database->query($sql);

       echo $this->image_placeholder();
       
    }

   
    public function delete_photo() {
        
        if($this->delete()) {
            $target_path = SITE_ROOT.DS. 'admin' . DS . $this->upload_directory . DS . $this->user_image;

            return unlink($target_path) ? true : false;
        } else {
            return false;
        }
    }

}   //End User Class



?>