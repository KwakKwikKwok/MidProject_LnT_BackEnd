<?php 
require_once 'Users.php';

class UserController extends Users {
    private $first_name;
    private $last_name;
    private $email;
    private $photo;
    private $bio;

    private function user($data) {
        $this->first_name = $data['firstName'];
        $this->last_name = $data['lastName'];
        $this->email = $data['email'];
        $this->bio = $data['bio'];
    }

    public function showUsers(){
        $results = $this->getAllUsers();
        return $results;
    }

    public function getOneUser($id) {
        $results = $this->getUser($id);
        return $results;
    }
    
    private function generateRandomPassword($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_+-=';
        $randomPassword = '';
        
        for ($i = 0; $i < $length; $i++) {
            $randomPassword .= $characters[random_int(0, strlen($characters) - 1)];
        }
        
        return $randomPassword;
    }

    private function hashPassword($password) {
        return md5($password); //func bawaan php buat hashing
    }

    public function createUser($data, $img) {
        $randomPassword = $this->generateRandomPassword();
        $hashedPassword = $this->hashPassword($randomPassword);

        $this->user($data);
        $this->photo = $img['name'];
        $result = $this->validateInput();


        if($result === true){
            move_uploaded_file($img['tmp_name'], '../Storage/' . $img['name']);

            $this->setUser(
                $this->first_name,
                $this->last_name,
                $this->email,
                $hashedPassword,
                $img['name'],
                $this->bio
            );
        }
    }

    public function updateUser($old_data, $data, $img) {
        $this->user($data);
        $this->photo = $old_data['photo'];
        $result = $this->validateInput(false); // Skip duplicate email validation
    
        if (empty($img['tmp_name']) === false) {
            $photoPath = realpath('../Storage/' . $old_data['photo']);
    
            if (file_exists($photoPath)) {
                unlink($photoPath);  // Delete foto sblm e
            }

            $destinationPath = '../Storage/' . $img['name'];
    
            move_uploaded_file($img['tmp_name'], '../Storage/'. $img['name']);
            
            $this->photo = $img['name'];
        }
    
        if ($result === true) {
            $this->update(
                $this->first_name,
                $this->last_name,
                $this->email,
                $this->photo,
                $this->bio,
                $old_data['id']
            );
        }
    }

    public function deleteUser($data) {
        $photoPath = realpath('../Storage/' . $data['photo']);
        
        if(file_exists($photoPath)){
            unlink($photoPath);
        }

        $this->delete($data['id']);
    }

    private function validateInput($checkDuplicate = true){
        if($this->isNotEmptyInput() === false){
            header("Location: Dashboard.php?error=empty");
            exit();
        }
        else if($this->isEmail() === false){
            header("Location: Dashboard.php?error=emailInvalid");
            exit();
        }
        else if($checkDuplicate && $this->duplicateEmail() === false){
            header("Location: Dashboard.php?error=duplicateEmail");
            exit();
        }
        else if($checkDuplicate && $this->duplicatePhoto() === false){
            header("Location: Dashboard.php?error=duplicatePhoto");
            exit();
        }
        else if($this->validLengthFirstName($this->first_name) === false){
            header("Location: Dashboard.php?error=FirstNameLengthInvalid");
            exit();
        }

        else if($this->validLengthLastName($this->last_name) === false){
            header("Location: Dashboard.php?error=LastNameLengthInvalid");
            exit();
        }

        return true;
    }

    private function duplicateEmail() {
        $result = true;
        $count = $this->getUserEmail($this->email);

        if(count($count)>0){
            $result = false;
        }

        return $result;

    }

    private function duplicatePhoto() {
        $result = true;
        $count = $this->getPhoto($this->photo);

        if(count($count)>0){
            $result = false;
        }

        return $result;

    }

    private function validLengthFirstName($first_name){
        $result = true;
        if(strlen($first_name)>225){
            $result = false;
        }

        return $result;
    }

    private function validLengthLastName($last_name){
        $result = true;
        if(strlen($last_name)>225){
            $result = false;
        }

        return $result;
    }


    private function isNotEmptyInput() {
         $results = true;
        if(empty($this->first_name) || empty($this->last_name) || empty($this->email) || empty($this->photo)){
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

