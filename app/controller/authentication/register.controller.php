<?php

class RegisterController extends Controller {
    
    public function showAction() {
        $data = [];
        // unset($_SESSION['page_error']);
        $this->render('authentication/register',$data);
    }

    public function submitAction() {
        $utype = 2;
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $office = $_POST['office'];
        $position = $_POST['position'];
        $email = $_POST['email'];
        $password = $_POST['pass'];
        $cpassword = $_POST['cpass'];
        $contact = $_POST['contact'];

        $user = new User();
        $verifiedEmail = $user->getUserByEmail($email);

        if($mname == ''){
            $mname = 'N/A';
        }

        //Check if input fields are blank
        if(empty($fname) ||
           empty($lname) ||
           empty($office) ||
           empty($position) ||
           empty($email) ||
           empty($password) ||
           empty($cpassword) ||
           empty($contact))
        {
            $_SESSION['page_error'] = "Required input fields must not be empty.";
            $_SESSION['ui_error'] = 'required';
            $this->showAction();
            exit();
        }

        //Check password
        if(!($password == $cpassword)){
            $_SESSION['page_error'] = "Password does not match.";
            $_SESSION['ui_error'] = 'password';
            $this->showAction();
            exit();
        }

        //Check email
        if($verifiedEmail){
            $_SESSION['page_error'] = 'Email is already in use.';
            $_SESSION['ui_error'] = 'email';
            $this->showAction();
            exit();
        }
        
        $salt = hash('sha256', rand());
        $hashedPass = $this->passwordHashing($salt, $password);


        $result = $user->addUser($utype, $fname, $mname, $lname, $office, $position, $email,$contact, $password, $hashedPass, $salt);
        

        if($result){
            $_SESSION['success'] = 'Registration was successful.';
            $this->showAction();
            exit();
        }else{
            $_SESSION['page_error'] = 'Registration was unsuccessful.';
            $this->showAction();
            exit();
        }



    }
}
