<?php 

class Session {
    //Login crendentials
    private $signed_in = false;
    public $user_id;
    public $message;
    public $visitor_count;
   

    public function __construct() {
        //Automatically instatiated
        session_start();
        $this->check_login();
        $this->check_message();
        $this->visitor_count();
    }

    public function visitor_count() {
        if(isset($_SESSION['count'])) {
            return $this->visitor_count = $_SESSION['count']++;
        } else {
            return $_SESSION['count'] = 1;
        }
    }
    
    //Check if user is signed in
    public function is_signed_in() {
        return $this->signed_in;
    }
    //Check user login credentials
    public function login($user) {
        
        if($user) {
            $this->user_id = $_SESSION['user_id'] = $user->id;//This user id if from User class
            $this->signed_in = true;
        }
        
    }

    public function logout() {
        
        unset($_SESSION['user_id']);
        unset($this->user_id);
        $this->signed_in = false;
    }

    //Check user login
    private function check_login() {

        if(isset($_SESSION['user_id'])) {
            $this->user_id = $_SESSION['user_id'];
            $this->signed_in = true;
        } else {
            unset($this->user_id);
            $this->signed_in = false;
        }
    }
    // Error messages

    public function message($msg="") {

        if(!empty($msg)) {
            $_SESSION['message'] = $msg;
        } else {
            return $this->message;
        }
    }

    private function check_message() {

        if(isset($_SESSION['message'])) {
            $this->message = $_SESSION['message'];
            unset($_SESSION['message']);
        } else {
            $this->message = "";
        }
    }
}

//Instatiate the class
$session = new Session;
$message = $session->message();

?>