<?php

class ClientRequestAddController extends Controller {
    private $data;
        
    public function __construct() {
        $this->data = [
            'userType' => 'client',
        ];
    }

    public function showAction() {
        !(isset($_GET['type'])) ? $this->showCategoryPage(): $this->renderRequestType();
    }

    // ---------------- Render Actions ---------------- //
    public function showCategoryPage() {
        $this->render('client/clientRequestType',$this->data);
    }
    
    public function renderRequestType() {
        $this->render('client/'.$_GET['type'],$this->data);
    }

    public function submitRequestAction() {
        ($_GET['type']=='PIO') ? $this->addPioRequest():'';
        ($_GET['type']=='PHOTO') ? $this->addPhotoRequest():'';
        ($_GET['type']=='POSTING') ? $this->addPostingRequest():'';
    }

    public function addPioRequest()
    {
        $activityDuration = explode('-', $_POST['activity-Duration']);

        
        $user = new User();
        $result= $user->getUserById($_SESSION['user_id']);

        $url = PARENT_FOLDER."/client/request/category?type=clientAddPIOService";
       
        $POSTdata = [
            'userID' => $_SESSION['user_id'],
            'activityName' => $_POST['activity-name'],
            'activityDuration' => $_POST['activity-Duration'],  
            'durationStart' =>  $activityDuration[0],
            'durationEnd' => $activityDuration[1], 
            'activityVenue' => $_POST['activity-venue'],
            'activityParticipants' => $_POST['activity-participants'],
            'activityOfficials' => $_POST['activity-officials'],
            'activityHighlights' => $_POST['activity-highlights'],
            'services' => json_encode($_POST['services']),
            'platforms' => json_encode($_POST['platforms']),
            'attachments' => json_encode($this->handleAttachment($_FILES['attachement'], $url )),
            'additionalInfo' => json_encode($_POST['additional-info']),


            'subject' => "New Request Received: " .$_GET['type'],
            'statusText' => 'Add Request', 
            'type' => $_GET['type'],
            'userType' =>  $this->data['userType'],
            'recipient' => $result['user_fn'] .' '. $result['user_ln'],
            'Submitted' => date('F d, Y h:i A', time()),
            'email' =>   $result['user_email'],
        ];

        $request = new request();
        $request->createRequestPIO($POSTdata);

        
        $email = new emailController(); 
        $email->sendEmail($POSTdata);

        $_SESSION['page_Success'] = 'Successfully Added';
        header("Location: ".PARENT_FOLDER."/client/request/category?type=clientAddPIOService");
    }


    public function addPostingRequest()
    {
    
        $user = new User();
        $result= $user->getUserById($_SESSION['user_id']);
        $url = PARENT_FOLDER."/client/request/category?type=clientAddPostingApproval";
  
        $POSTdata = [
            'userID' => $_SESSION['user_id'],
            'postTitle' => $_POST['post-title'],
            'postLink' => $_POST['post-link'],
            'platforms' => json_encode($_POST['platforms']),
            'attachments' => json_encode($this->handleAttachment($_FILES['attachement'],$url)),
            'postContent' => json_encode($_POST['post-content']),


            'type' => $_GET['type'],
            'subject' => "New Request Received: " .$_GET['type'],
            'statusText' => 'Add Request', 
            'userType' =>  $this->data['userType'],
            'recipient' => $result['user_fn'] .' '. $result['user_ln'],
            'Submitted' => date('F d, Y h:i A', time()),
            'email' =>   $result['user_email'],
        ];

       
        $request = new request();
        $result = $request->createRequestPosting($POSTdata);

        $email = new emailController(); 
        $email->sendEmail($POSTdata);

        $_SESSION['page_Success'] = 'Successfully Added';
        header("Location: ".PARENT_FOLDER."/client/request/category?type=clientAddPostingApproval");
  
    }

    public function addPhotoRequest()
    {

        $activityDuration = explode('-', $_POST['activity-Duration']);
  
        $user = new User();
        $result= $user->getUserById($_SESSION['user_id']);
        
      
        $POSTdata = [
            'userID' => $_SESSION['user_id'],
            'activityName' => $_POST['activity-name'],
            'activityDuration' => $_POST['activity-Duration'],  
            'activityPurpose' => $_POST['activity-purpose'],
            'durationStart' =>  $activityDuration[0],
            'durationEnd' => $activityDuration[1], 


            'type' => $_GET['type'],
            'subject' => "New Request Received: " .$_GET['type'],
            'statusText' => 'Add Request', 
            'userType' =>  $this->data['userType'],
            'recipient' => $result['user_fn'] .' '. $result['user_ln'],
            'Submitted' => date('F d, Y h:i A', time()),
            'email' =>   $result['user_email'],
        ];

        $request = new request();
        $result = $request->createRequestPhoto($POSTdata);

        
        $email = new emailController(); 
        $email->sendEmail($POSTdata);

        $_SESSION['page_Success'] = 'Successfully Added';
        header("Location: ".PARENT_FOLDER."/client/request/category?type=clientAddPhotoRequest");
    }



}
    