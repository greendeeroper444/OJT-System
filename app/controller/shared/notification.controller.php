<?php

class NotificationController extends Controller
{
    private $data;

    public function __construct()
    {
        $_notifFetch = json_decode(file_get_contents("php://input"), true);
        $this->data = [
            'notif' => $_notifFetch??null, 
            'userType' => $_SESSION['user_type'],
        ];
    }

    public function fetchAction()
    {

        if($this->data['notif']['type'] == 'admin'){

            $request = new request();
            $pendingAndApprovedRequest = $request->fetchPendingAndApproved(
                null,
                null,
                null,
                null,
                null,                                         
            );    
    
            $data['request'] =   $this->modifyTable($pendingAndApprovedRequest,"All");          
            $data['id']  = $_SESSION['user_id'];                  
            $responseJson = json_encode($data);
            echo $responseJson;
        }

        
        if($this->data['notif']['type'] == 'client'){

            $request = new request();
            $approvedRequest = $request->fetchApprovedRequest($_SESSION['user_id']);
                
            $data['request'] =  $this->modifyTable($approvedRequest,"All"); 
            
           
            $responseJson = json_encode($data);
            echo $responseJson;
        }

      
    }

}
