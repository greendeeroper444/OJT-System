<?php
class ProfileController extends Controller
{
    private $data;

    public function __construct()
    {
        $this->data = [
            'userType' => $_SESSION['user_type'],
        ];
    }

    public function showAction()
    {
        ($this->data['userType'] == 1) ? $this->data['userType'] = 'admin' : $this->data['userType'] = 'client';

        if($this->data['userType'] == 'admin'){
            $request = new User();
            $user = $request->getUserById($_GET['id']);
            
            // if($_GET['type'] == 2){
            //     $request = new request();
            //     $statistic = $request->fetchUserRequestStatistic($_GET['id']);
        
            //     $this->data['requestStatic'] = $statistic;
            // }
            if (isset($_GET['type']) && $_GET['type'] == 2) {
                $request = new request();
                $statistic = $request->fetchUserRequestStatistic($_GET['id']);

                $this->data['requestStatic'] = $statistic;
            }
       
            $this->data['userInfo'] = $user;
            $this->render('layout/components/userView', $this->data);
        }
        
        if($this->data['userType'] == 'client'){
            $request = new User();
            $user = $request->getUserById($_SESSION['user_id']);
    
            $request = new request();
            $statistic = $request->fetchUserRequestStatistic($_SESSION['user_id']);
    
            $this->data['requestStatic'] = $statistic;
            $this->data['userInfo'] = $user;
            $this->render('layout/components/profile', $this->data);
        }
       
    }

    public function updateAction(){
    
        if($this->data['userType'] == 2){
            $userID = $_SESSION['user_id'];
            $email = $_POST['email'];
            $password =$_POST['password'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $assigned = $_POST['assigned'];
            $position = $_POST['position'];
            $conNum = $_POST['contact_number'];

       
            $request = new User();
            $user = $request->updateUSer($userID, $first_name, $last_name,$assigned,$position, $email, $password,$conNum);

            $_SESSION['page_Success'] = 'Profile Updated Successfully';    
            header("Location:" .$_POST['pre-url']);
        }


        if($this->data['userType'] == 1){

            $userID = $_GET['id'];
            $email = $_POST['email'];
            $password =$_POST['password'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $position = $_POST['position'];
            $assigned = $_POST['assigned'];
            $conNum = $_POST['contact_number'];

            $request = new User();
            $user = $request->updateUSer($userID, $first_name, $last_name,$assigned,$position, $email, $password,$conNum);

            $_SESSION['page_Success'] = 'Profile Updated Successfully';    
            header("Location:" .$_POST['pre-url']);
        }
    }


    public function updateStatusAction(){

        
        $POSTdata = [
            'userID' => $_GET['id'],
            'recipient'  => $_POST['recipient'], 
            'email' =>  $_POST['email'],
            'statusText' => 'Approve user',
            'subject' => "User Account Approved",

        ];
  
    
            $request = new User();
            $user = $request->approveUser($POSTdata);

            $email = new emailController(); 
            $email->sendEmail($POSTdata);

         

            $_SESSION['page_Success'] = 'Profile Updated Successfully';    
            header("Location:" .$_POST['pre-url']);
    
    }
}

                           