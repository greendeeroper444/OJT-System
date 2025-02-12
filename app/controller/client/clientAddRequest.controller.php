<?php

class AddRequest extends Controller {
    
    public function showAction() {
        $data = [
            'userType' => 'client',
        ];

        $this->render('client/clientAddRequest',$data);
        
    }

    public function submitAction() {

        $userID = $_SESSION['user_id'];

        //Activity
        $activityName = $_POST['activity-name'];
        $activityDuration = explode('-',$_POST['activity-Duration']);

        $activityVenue = $_POST['activity-venue'];
        $activityParticipants = $_POST['activity-participants'];
        $activityOfficials = $_POST['activity-officials'];
        $activityHighlights = $_POST['activity-highlights'];
      
        //Services
        $serviceDocumentation =  isset($_POST['service-1']) ? 1 : 0;      
        $serviceArticle =  isset($_POST['service-2']) ? 1 : 0;
        $serviceContentdesign = isset($_POST['service-3']) ? 1 : 0;
        $serviceContentupdate =  isset($_POST['service-4']) ? 1 : 0;

        //Platform
        $platformWebsite =  isset($_POST['platform-1']) ? 1 : 0;  
        $platforFacebook =  isset($_POST['platform-2']) ? 1 : 0;
        $platformTwitter =  isset($_POST['platform-3']) ? 1 : 0;
        $platformYoutube =  isset($_POST['platform-4']) ? 1 : 0;
        $platformEmail =  isset($_POST['platform-5']) ? 1 : 0;
        $platformCeIb =  isset($_POST['platform-6']) ? 1 : 0;

        $request = new request();
        $result = $request->createRequest($userID,$activityName,$activityDuration[0],$activityDuration[1],$activityVenue,$activityParticipants,$activityOfficials,$activityHighlights,
                                        $serviceDocumentation,$serviceArticle,$serviceContentdesign,$serviceContentupdate,$platformWebsite,$platforFacebook,
                                        $platformTwitter,$platformYoutube,$platformEmail,$platformCeIb
                                          );
    
        $_SESSION['page_Success'] = 'Successfully Added';
        $this->showAction();
        exit();
        

       
    }
}
    