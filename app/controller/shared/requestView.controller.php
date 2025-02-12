<?php

class RequestViewController extends Controller
{
    private $data;

    public function __construct()
    {
        $this->data = [
            'userType' => $_SESSION['user_type'],
            'viewType' => $_GET['type']??null,
            'reqId' => $_GET['id']??null,
        ];

     
        ($this->data['userType'] == 1) ? $this->data['userType'] = 'admin' : $this->data['userType'] = 'client';
    }

    // ---------------- Render Actions ---------------- //
    public function showAction()
    {
        $request = new request();
        $this->data['request'] = $request->fetchRequestByID($_GET['type'], $_GET['id']);


        $request = new transaction();
        $request->updateRequestViewStatus($_GET['type'], $_GET['id'], $this->data['userType']);
        $this->render($this->data['userType'] . '/' . $this->data['userType'] . 'ViewRequest', $this->data);
    }

    // ---------------- Update Actions ---------------- //
    public function updateStatusAction()
    {
        //Complete request by admin
        if ($_POST['action'] == '1') {



            if(isset($_POST['forceCompleteDetails'])){

                $user = new user();
                $user->verifyAdminPassword($_POST['adminPassword'],$_SESSION['user_id'],$_POST['pre-url']);
                $POSTdata = [
                    'type' => $_POST['type'],
                    'recipient' =>  $_POST['recipient'],
                    'eventName' => $_POST['eventName'],
                    'eventDuration' => $_POST['eventDuration'],
                    'requestCreated' =>  $_POST['requestCreated'],
                    'forceCompleteDetails' =>  $_POST['forceCompleteDetails'],
                    'email' =>  $_POST['email'],
                    'reqId' =>  $_POST['reqId'],
                    'subject' => "Request Completed: Your Request ".$_POST['eventName']." Has Been Completed",
                    'statusText' => 'Completed', 
                    'remarks' => 'Forced Completed',
                    'status' => $_POST['action']
                ];
            }else{
                $POSTdata = [
                    'type' => $_POST['type'],
                    'recipient' =>  $_POST['recipient'],
                    'eventName' => $_POST['eventName'],
                    'eventDuration' => $_POST['eventDuration'],
                    'requestCreated' =>  $_POST['requestCreated'],
                    'email' =>  $_POST['email'],
                    'reqId' =>  $_POST['reqId'],
                    'subject' => "Request Completed: Your Request ".$_POST['eventName']." Has Been Completed",
                    'statusText' => 'Completed', 
                    'remarks' => 'Request Completed',
                    'status' => $_POST['action']
                ];
            }



            $request = new transaction();
            $request->updateRequestStatus($POSTdata);
            $request = new transaction();
            $request->updateDateComplete($POSTdata);

            $email = new emailController(); 
            $email->sendEmail($POSTdata);
        }

        //Approved request by admin
        if ($_POST['action'] == '2') {
        
            $POSTdata = [
                'type' => $_POST['type'],
                'recipient' =>  $_POST['recipient'],
                'eventName' => $_POST['eventName']??null,
                'eventDuration' => $_POST['eventDuration']??null,
                'requestCreated' =>  $_POST['requestCreated'],
                'email' =>  $_POST['email'],
                'reqId' =>  $_POST['reqId'],
                'title' => $_POST['title']??null,
                'subject' => ($_POST['type'] == 'POSTING')?"Posting Approved by DNSC PIO: ".$_POST['title']." ":"Request Approved: Your Request ".$_POST['eventName']." Has Been Approved",
                'statusText' => 'Approved', 
                'remarks' => ($_POST['type'] == 'POSTING')?'Request Completed':'No Output',
                'status' =>  ($_POST['type'] == 'POSTING')?1:$_POST['action']
            ];

            $email = new emailController(); 
            $email->sendEmail($POSTdata);
            $request = new transaction();
            $request->updateRequestStatus($POSTdata);
        }

        // Cancel request
        if ($_POST['action'] == '4') {

            $POSTdata = [
                'type' => $_POST['type'],
                'reqId' =>  $_POST['reqId'],
                'remarks' => 'Request Has been Cancelled',
                'status' => $_POST['action']
            ];

            $request = new transaction();
            $request->updateRequestStatus($POSTdata);
        }
        
           // Decline request
           if ($_POST['action'] == '5') {

            $POSTdata = [
                'type' => $_POST['type'],
                'reqId' =>  $_POST['reqId'],
                'remarks' => 'Request Has been Declined',
                'status' => $_POST['action'],
                'declineDetails' => $_POST['declineDetails']
            ];

        

            $request = new transaction();
            $request->updateRequestStatus($POSTdata);
        }

        header("Location:" . $_POST['pre-url']);
    }


    //Update Admin Output
    public function updateAdminOutputAction()
    {
      
        $POSTdata = [
            'attachments' => json_encode($this->handleAttachment($_FILES['adminAttachement'],$_POST['pre-url'])),
            'type' => $_POST['type'],
            'reqId' => $_POST['reqId'],
            'recipient' =>  $_POST['recipient'],
            'eventName' => $_POST['eventName'],
            'eventDuration' => $_POST['eventDuration'],
            'requestCreated' =>  $_POST['requestCreated'],
            'email' =>  $_POST['email'],
            'reqId' =>  $_POST['reqId'],
            'outputDetails' =>  $_POST['adminDetails'],
            'subject' => "Output Added for Your Request: ".$_POST['eventName']."",
            'statusText' => 'File Uploaded', 
            'status' => $_POST['action'],
            'userType' =>  $this->data['userType'],
        ];
        
   
        $request = new transaction();
        $request->updateRequestOutput($POSTdata);
        $email = new emailController(); 
        $email->sendEmail($POSTdata);

        header("Location:" . $_POST['pre-url']);
    }
    

    public function updateClientOutputAction()
    {

        $POSTdata = [
            'attachments' => json_encode($this->handleAttachment($_FILES['adminAttachement'],$_POST['pre-url'])),
            'type' => $_POST['type'],
            'reqId' => $_POST['reqId'],
            'recipient' =>  $_POST['recipient'],
            'title' => $_POST['title'],
            'requestCreated' =>  $_POST['requestCreated'],
            'email' =>  $_POST['email'],
            'outputDetails' =>  $_POST['details'],
            'subject' => "Output Added for the Request: ".$_POST['title']."",
            'statusText' => 'File Uploaded', 
            'status' => $_POST['action'],
            'userType' =>  $this->data['userType'],
        ];
 
        $request = new transaction();
        $request->updateRequestOutput($POSTdata);
        $email = new emailController(); 
        $email->sendEmail($POSTdata);

        header("Location:" . $_POST['pre-url']);
    }


    //Request for revision
    public function updateRevisionAction()
    {

        $POSTdata = [
            'type' => $_POST['type'],
            'reqId' => $_POST['reqId'],
            'recipient' =>  $_POST['recipient'],
            'userType' =>  $this->data['userType'],
            'eventName' => $_POST['eventName']??null,
            'title' => $_POST['title']??null,
            'eventDuration' => $_POST['eventDuration'],
            'requestCreated' =>  $_POST['requestCreated'],
            'email' =>  $_POST['email'],
            'reqId' =>  $_POST['reqId'],
            'revisionDetails' =>  $_POST['revisionDetails'],
            'subject' => "Request Revised by Client: ". $_POST['recipient']."",
            'subjectAdmin' => "Posting Revised by DNSC PIO: ".$_POST['title']."",
            'statusText' => 'Revision request', 
        ];

        $request = new transaction();
        $request->updateReviseOutput($POSTdata);

        $email = new emailController(); 
        $email->sendEmail($POSTdata);

        header("Location:" . $_POST['pre-url']);
    }

    public function updateAcceptAction()
    {

        $POSTdata = [
            'type' => $_POST['type'],
            'reqId' => $_POST['reqId'],
            'recipient' =>  $_POST['recipient'],
            'userType' =>  $this->data['userType'],
            'eventName' => $_POST['eventName'],
            'eventDuration' => $_POST['eventDuration'],
            'requestCreated' =>  $_POST['requestCreated'],
            'email' =>  $_POST['email'],
            'reqId' =>  $_POST['reqId'],
            'subject' => "Request Output Approved by Client: ". $_POST['recipient']."",
            'statusText' => 'Request Approved', 

        ];

        $request = new transaction();
        $request->updateAcceptOutput($POSTdata);

        $email = new emailController(); 
        $email->sendEmail($POSTdata);
        
        header("Location:" . $_POST['pre-url']);
    }

     public function updateReviseOutput()
    {
        $request = new request();
        $request->updateOutputContent($_GET['type'], $_GET['id'],);
        header("Location:" . $_POST['pre-url']);
    }

  


    public function updateAction()
    {
        ($_GET['type'] == 'PIO') ? $this->updatePIOcontent() : '';
        ($_GET['type'] == 'PHOTO') ? $this->updatePHOTOcontent() : '';
        ($_GET['type'] == 'POSTING') ? $this->updatePOSTINGcontent() : '';
    }


    // Edit Request 
    public function updatePIOcontent()
    {
        $activityDuration = explode('-', $_POST['activity-Duration-viewpage']);
        $POSTdata = [
            'userType' =>  $this->data['userType'],
            'userID' => $_SESSION['user_id'],
            'activityName' => $_POST['activity-name'],
            'reqId' => $_GET['id'],
            'type' => $_GET['type'],
            'status' => 3,
            'eventDuration' => $_POST['eventDuration'],
            'durationStart' =>  $activityDuration[0],
            'durationEnd' => $activityDuration[1], 
            'activityVenue' => $_POST['activity-venue'],
            'activityParticipants' => $_POST['activity-participants'],
            'activityOfficials' => $_POST['activity-officials'],
            'activityHighlights' => $_POST['activity-highlights'],
            'services' => $_POST['services'][0],
            'platforms' => $_POST['platforms'][0],
            'attachments' => json_encode($this->handleAttachment($_FILES['adminAttachement'],$_POST['pre-url'])),
            'additionalInfo' => $_POST['additional-info'],

            'subject' => "Request Edited by Client: ". $_POST['activity-name']."",
            'statusText' => 'Request Edited',
            'remarks' => 'For Admin Approval',
            'oldEventName' => $_POST['oldEventName'],
            'oldDate'  => $_POST['oldDate'], 
            'recipient'  => $_POST['recipient'], 
            'email' =>  $_POST['email'],
            'updateOn' => date('F d, Y h:i A', time())
        ];


        $request = new request();
        $request->updateRequestPIO($POSTdata);
        $request = new transaction();
        $request->updateRequestStatus($POSTdata);
      
        $email = new emailController(); 
        $email->sendEmail($POSTdata);
        
        $_SESSION['page_Success'] = 'Request Updated';
        header("Location:" . $_POST['pre-url']);
    }

   // Edit Request 
    public function updatePOSTINGcontent()
    {

      
        $POSTdata = [
            'userID' => $_SESSION['user_id'],
            'requestID' => $_GET['id'],
            'title' => $_POST['title-name'],
            'platform' =>  $_POST['platforms'][0],
            'content' =>  $_POST['additional-info'],
            'link' =>  $_POST['link'],
            'attachement' => json_encode($this->handleAttachment($_FILES['adminAttachement'],$_POST['pre-url'])),
            'reqId' => $_GET['id'],
            'type' => $_GET['type'],
            'status' => 3,
            'remarks' => 'For Admin Approval',



            'subject' => "Request Edited by Client: ". $_POST['activity-name']."",
            'statusText' => 'Request Edited',
            'remarks' => 'For Admin Approval',
            'oldTitle' => $_POST['oldTitle'],
            'recipient'  => $_POST['recipient'], 
            'email' =>  $_POST['email'],
            'updateOn' => date('F d, Y h:i A', time())

            
        ];
        
        $request = new request();
        $request->updateRequestPOSTING($POSTdata);
        $request = new transaction();
        $request->updateRequestStatus($POSTdata);
        $email = new emailController(); 
        $email->sendEmail($POSTdata);
        
        $_SESSION['page_Success'] = 'Request Updated';
        header("Location:" . $_POST['pre-url']);
    }

   // Edit Request 
    public function updatePHOTOcontent()
    {   

        $activityDuration = explode('-', $_POST['activity-Duration-viewpage']);
     
        $POSTdata = [
            'userID' => $_SESSION['user_id'],
            'requestID' => $_GET['id'],
            'activityName' => $_POST['activity-name'],
            'purposeInfo' => $_POST['purpose-info'],
            'durationStart' =>  $activityDuration[0],
            'durationEnd' => $activityDuration[1], 
            'reqId' => $_GET['id'],
            'type' => $_GET['type'],
            'status' => 3,
            'remarks' => 'For Admin Approval',


            'subject' => "Request Edited by Client: ". $_POST['activity-name']."",
            'statusText' => 'Request Edited',
            'remarks' => 'For Admin Approval',
            'oldEventName' => $_POST['oldEventName'],
            'oldDate'  => $_POST['oldDate'], 
            'recipient'  => $_POST['recipient'], 
            'email' =>  $_POST['email'],
            'updateOn' => date('F d, Y h:i A', time())
            
        ];
        
    
        $request = new request();
        $request->updateRequestPHOTO($POSTdata);
        $request = new transaction();
        $request->updateRequestStatus($POSTdata);

             
        $email = new emailController(); 
        $email->sendEmail($POSTdata);
        $_SESSION['page_Success'] = 'Request Updated';
        header("Location:" . $_POST['pre-url']);
    }
}
