<?php

class User extends Controller{
    private $db;
    public $name;
    public $email;

    public function __construct() {
        $this->db = new Database();
        
    }

    public function getUserById($id) {
        $stmt = $this->db->prepare("SELECT * FROM user WHERE user_id=?");
        $stmt->execute([$id]); 
        return $stmt->fetch();
    }

    public function getUserByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM user WHERE user_email=?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function getAllUser($searchedWord,$numberOfitems,$offset) {

        $sqlStatement = (
            "
            SELECT * FROM user WHERE 1 "
        );

        if ($searchedWord !== null) {
            // Ensure to escape the input to prevent SQL injection
            $sqlStatement .= "   
                AND (`user`.`user_fn` LIKE '%" . $searchedWord . "%' OR `user`.`user_ln` LIKE '%" . $searchedWord . "%')              
            ";
        }
        
        if (($numberOfitems !== null) or ($offset !== null)) {
            $sqlStatement = $sqlStatement . "LIMIT " . ((intval($offset) - 1) * $numberOfitems) . ", " . intval($numberOfitems) . "";
        }

        $stmt = $this->db->prepare($sqlStatement);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function addUser($utype, $fname, $mname, $lname, $office, $position, $email,$contact, $password, $hashedPass, $salt){
        $stmt = $this->db->prepare("INSERT INTO user
            (user_fn, user_mn, user_ln, user_office, user_position, user_email, user_password, pass_hash, hash_salt, user_type, user_status,user_contact) 
        VALUES
            (:user_fn, :user_mn, :user_ln, :user_office, :user_position, :user_email, :user_password, :pass_hash, :hash_salt, :user_type, :user_status , :user_contact)");
        $result = $stmt->execute([
            $fname,
            $mname,
            $lname,
            $office,
            $position,
            $email,
            $password,
            $hashedPass,
            $salt,
            $utype,
            2,
            $contact,
        ]);


        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function updateUSer($userID, $fname, $lname,$assigned, $position, $email, $password,$conNum){


        if($password == ""){
            $stmt = $this->db->prepare("UPDATE `user` SET `user_fn`=:user_fn,`user_ln`=:user_ln,`user_office`=:user_office,`user_position`=:user_position, 
                `user_email`=:user_email ,`user_contact`=:user_contact
                
                    WHERE `user_id`=:user_id"
            );
    
            $result = $stmt->execute([
                $fname,
                $lname,
                $assigned,
                $position,
                $email,
                $conNum,
                $userID,
            ]);
    
        }else{
            $salt = hash('sha256', rand());
            $hashedPass = $this->passwordHashing($salt, $password);
    
            $stmt = $this->db->prepare("UPDATE `user` SET `user_fn`=:user_fn,`user_ln`=:user_ln,`user_office`=:user_office,`user_position`=:user_position,
                `user_email`=:user_email,`user_password`=:user_password,`pass_hash`=:pass_hash,`hash_salt`=:hash_salt
                
                    WHERE `user_id`=:user_id"
            );
    
            $result = $stmt->execute([
                $fname,
                $lname,
                $assigned,
                $position,
                $email,
                $password,
                $hashedPass,
                $salt,
                $userID,
            ]);
    
        }
       

    }

    public function approveUser($POSTdata){
            extract($POSTdata);
    
            $stmt = $this->db->prepare("UPDATE `user` SET `user_status`=:user_status
                                         WHERE `user_id`=:user_id"
            );
    
            $result = $stmt->execute([
                1,
                $userID
            ]);

    }

    
    public function verifyAdminPassword($password,$id,$url){
       
       $result = $this->getUserById($id);
       $passVerify = $this->verifyPassword($result['hash_salt'], $result['pass_hash'], $password);

       if ($passVerify) {
           $_SESSION['page_error_form'] = 'Incorrect Password';
           header("Location:" . $url);
           exit();
       };
        
       return $result;
    }
}