<?php 
require_once 'Users.php';

class LoginController extends Users {
    private $email;
    private $password;


    private function user($data) {
        $this->email = $data['email'];
        $this->password = $data['pass'];
    }
    
    public function login($data){
        $this->user($data);

        $result = $this->validateInput();

        if($result === true){
            if(isset($data['remember'])){
                setcookie("email", $data['email'], time()+1800, "/"); //30 menit
                setcookie("pass", $data['pass'], time()+1800, "/"); //30 menit
            }

            session_start();
            $_SESSION['login'] = true;
            $user = $this->getUserEmail($this->email);
            $user = $user[0];
            $_SESSION['name'] = $user['first_Name'];

            header("Location: Dashboard.php");
            exit();
        }
    }

    public function logout(){
        session_start();
        session_unset();
        session_destroy();

        header("Location: Login.php");
        exit();
    }

    private function validateInput($checkDuplicate = true){
        if($this->isNotEmptyInput() === false){
            header("Location: Login.php?error=empty");
            exit();
        }
        else if($this->isEmail() === false){
            header("Location: Login.php?error=emailInvalid");
            exit();
        }

        $user = $this->getUserEmail($this->email);

        if(!$user || count($user)==0){ // user not found
            header("Location: Login.php?error=UserInvalid");
            exit();
        }
        
        $hashedInputPassword = md5($this->password);
        if($user[0]['pass'] !== $hashedInputPassword){
            header("Location: Login.php?error=passwordInvalid");
            exit();
        }

        return true;
    }

    private function isNotEmptyInput() {
         $results = true;
        if(empty($this->email) || empty($this->password) ){
            $results = false;
        }
        
        return $results;
    }

    private function isEmail() {
        $result = true;
        if(filter_var($this->email, FILTER_VALIDATE_EMAIL) === false){
            $result = false;
        }
        return $result;
    }
}

