<?php

class LoginController extends Controller
{
    private $data = [];

    public function showAction()
    {

        //Direct to dashboard
        if (isset($_SESSION['user_id'])) {

            if ($_SESSION['user_type'] == 1) {
                $url = PARENT_FOLDER . '/admin/dashboard';
                header('Location: ' . $url);
                exit();
            }
            if ($_SESSION['user_type'] == 2) {
                $url = PARENT_FOLDER . '/client/dashboard';
                header('Location: ' . $url);
                exit();
            }
        }

        $this->render('authentication/login', $this->data);
    }

    public function submitAction()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (!isset($_POST['submit'])) {
            return $this->showAction();
        }

        //Email validation
        if (!($this->EmailValidation($email))) {
            $_SESSION['page_error'] = 'Invalid Email Address';
            $this->showAction();
            exit();
        }

        //Check empty field
        if (empty($email) || empty($password)) {
            if (!empty($email)) {
                $this->data['email'] = $email;
            }
            $_SESSION['page_error'] = 'Empty field, please fill all fields';
            $this->showAction();
            exit();
        }

        //Search user 
        $user = new User();
        $result = $user->getUserByEmail($email);

        //Search empty
        if (!$result) {
            $_SESSION['page_error'] = 'User does not exist.';
            $this->showAction();
            exit();
        }

        //Check password match
        $passVerify = $this->verifyPassword($result['hash_salt'], $result['pass_hash'], $password);

        if ($passVerify) {
            $_SESSION['page_error'] = 'Password does not match.';
            $this->showAction();
            exit();
        };

        if ($result['user_status'] == 2) {
            $_SESSION['page_error'] = "Your account is still pending for approval.";
            $this->showAction();
            exit();
        }
        if ($result['user_status'] == 3) {
            $_SESSION['page_error'] = "Your account has been declined.";
            $this->showAction();
            exit();
        }
        //User authenticated
        //Save user id on session
        $_SESSION['user_id'] = $result['user_id'];
        $_SESSION['user_type'] = $result['user_type'];
        $this->showAction();
    }

    function EmailValidation($email)
    {
        return strpos($email, '@');
    }
}
