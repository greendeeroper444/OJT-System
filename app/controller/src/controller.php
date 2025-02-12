<?php

class Controller{

    function runAction($action){
        $action .= "Action";
        if(method_exists($this,$action)){
            $this->$action();
        }else{
            //Direct To 404 page
            echo "Method Not Exist";
        }
    }

    function render($view,$data){
       extract($data);
       include ROOT . '/app/views/layout/main.view.php';
    }

    // public function modifyTable($requestListData,$tableType){

    //     if($tableType == "PHOTO" || $tableType == "PIO"){
    //         foreach($requestListData as &$request){
    //             $request['r_durationStartDate'] = date('F d, Y ', strtotime($request['r_durationStart']));
    //             $request['r_durationEndDate'] = date('F d, Y ', strtotime($request['r_durationEnd'])); 
    //             $request['r_durationStartTime'] = date('h:i A', strtotime($request['r_durationStart']));
    //             $request['r_durationEndTime'] = date('h:i A', strtotime($request['r_durationEnd']));
    
    //             $request['startDate'] = explode(' ' ,$request['r_durationStartDate']);
    //             $request['endDate'] = explode(' ' ,$request['r_durationEndDate']);
    //             $request['dateRequested'] = date('F d, Y ', strtotime($request['r_datetimerequested']));
    //             $request['datecompleted'] = ($request['t_datecompleted'] != null)? date('F d, Y ', strtotime($request['t_datecompleted'])): null;
    //             $request['dateModified'] = ($request['t_datemodified'] != null)?date('F d, Y ', strtotime($request['t_datemodified'])): null;
    //             $request['dateOrinalValue'] = date('F d, Y h:i A', strtotime($request['r_durationStart'])) .'-'. date('F d, Y h:i A', strtotime($request['r_durationEnd'])) ;
    //     // -------------------------- Month formatting ---------------------------
    //             if($request['startDate'][0] == $request['endDate'][0]){
    //                 if($request['startDate'][1] == $request['endDate'][1]){
    //                     $request['r_duration'] = $request['startDate'][0] . ' ' . $request['startDate'][1] . ' ' . $request['startDate'][2];
    //                 }
    //                 else{
    //                     $request['r_duration'] = $request['startDate'][0]
    //                                           . ' ' . str_replace(',', '', $request['startDate'][1])
    //                                           . '-' . str_replace(',', '', $request['endDate'][1])
    //                                           . ', ' . $request['startDate'][2];
    //                 }
    //             }
    //             else{
    //                 $request['r_duration'] = $request['r_durationStartDate'] . ' - ' . $request['r_durationEndDate'];
    //             }
    
    //         }
    //     }
        
    //     if($tableType == "POSTING" ){           
    //         foreach($requestListData as &$request){
    //             $request['dateRequested'] = date('F d, Y ', strtotime($request['t_datetimerequested']));
    //             $request['datecompleted'] = ($request['t_datecompleted'] != null)? date('F d, Y ', strtotime($request['t_datecompleted'])): null;
    //             $request['dateModified'] = ($request['t_datemodified'] != null)?date('F d, Y ', strtotime($request['t_datemodified'])): null;
    //         }
    //     }

    //     if($tableType == "All" ){           
    //         foreach($requestListData as &$request){
    //             $request['dateRequested'] = date('F d, Y ', strtotime($request['t_datetimerequested']));
    //             $request['dateEvent'] = date('F d, Y ', strtotime($request['t_datetimerequested']));
    //             $request['datecompleted'] = ($request['t_datecompleted'] != null)? date('F d, Y ', strtotime($request['t_datecompleted'])): null;
    //             $request['dateModified'] = ($request['t_datemodified'] != null)?date('F d, Y ', strtotime($request['t_datemodified'])): null;
    //         }
    //     }
     
    //     return $requestListData;
    // } 
    
    
    public function modifyTable($requestListData,$tableType){
        if($tableType == "photo" || $tableType == "pio" || $tableType == "reports"){
            foreach($requestListData as &$request){
                
            
                $request['r_durationStartDate'] = date('F d, Y', $request['r_durationStart']);
                $request['r_durationEndDate'] = date('F d, Y', $request['r_durationEnd']); 
                $request['r_durationStartTime'] = date('h:i A', strtotime($request['r_durationStart']));
                $request['r_durationEndTime'] = date('h:i A', strtotime($request['r_durationEnd']));
    
            
                $request['t_dateRequested'] = date('F d, Y h:i A', $request['t_datetimerequested']); 
                $request['t_datecompleted'] = ($request['t_datecompleted'] != null)? date('F d, Y h:i A', $request['t_datecompleted']): null;
                $request['t_dateModified'] = ($request['t_datemodified'] != null)?date('F d, Y ', $request['t_datemodified']): null;
                // var_dump(date('F d, Y h:i A', $request['t_datetimerequested']));
                // var_dump(date('F d, Y ', $request['t_datecompleted']));
                // exit();        
    
                //Formating For the
                $request['startDate'] = explode(' ' ,date('F d, Y ', strtotime($request['r_durationStart'])));
                $request['endDate'] = explode(' ' ,date('F d, Y ', strtotime($request['r_durationStartDate']))); 
                $request['dateOrinalValue'] = date('F d, Y h:i A', $request['r_durationStart']) .'-'. date('F d, Y h:i A', $request['r_durationEnd']) ;
                if($request['startDate'][0] == $request['endDate'][0]){
                        if($request['startDate'][1] == $request['endDate'][1]){
                            $request['r_duration'] = $request['startDate'][0] . ' ' . $request['startDate'][1] . ' ' . $request['startDate'][2];
                        }
                        else{
                            $request['r_duration'] = $request['startDate'][0]
                                                  . ' ' . str_replace(',', '', $request['startDate'][1])
                                                  . '-' . str_replace(',', '', $request['endDate'][1])
                                                  . ', ' . $request['startDate'][2];
                        }
                    }
                    else{
                        $request['r_duration'] = $request['r_durationStartDate'] . ' - ' . $request['r_durationEndDate'];
                    }
            
            }
        }
        
               
        if($tableType == "posting"  || $tableType == "all" ){           
            foreach($requestListData as &$request){
                $request['t_dateRequested'] = date('F d, Y h:i A', $request['t_datetimerequested']); 
                $request['t_datecompleted'] = ($request['t_datecompleted'] != null)? date('F d, Y ', $request['t_datecompleted']): null;
                $request['t_dateModified'] = ($request['t_datemodified'] != null)?date('F d, Y ', $request['t_datemodified']): null;
                          
            }
        }
        
    
        return $requestListData;
    }   

    public function numberOfPages($data,$tableType){
        $request = new request();
        if($tableType == 'pio'){
            $totalRequest =  $request->fetchRequest(
                (isset($data['userID'])?$data['userID']:'`transaction`.t_userid'),
                $data['requestCategory'],
                $data['dateRange'],
                null,
                null,
                null,
                $tableType
    
            
            );
            return ceil(count($totalRequest ) / intval($data['itemPerPagePIO']));
        } 

        if($tableType == 'photo'){
            $totalRequest =  $request->fetchRequest(
                (isset($data['userID'])?$data['userID']:'`transaction`.t_userid'),
                $data['requestCategory'],
                $data['dateRange'],
                null,
                null,
                null,
                $tableType
    
            
            );
            return ceil(count($totalRequest ) / intval($data['itemPerPagePHOTO']));
        } 
        

        if($tableType == 'posting'){
            $totalRequest =  $request->fetchRequest(
                (isset($data['userID'])?$data['userID']:'`transaction`.t_userid'),
                $data['requestCategory'],
                $data['dateRange'],
                null,
                null,
                null,
                $tableType
        
            );
            return ceil(count($totalRequest ) / intval($data['itemPerPagePOSTING']));
        } 

        if($tableType == 'all'){

            $totalRequest =  $request->fetchRequestAllPending(
                $data['requestCategory'],
                $data['dateRange'],
                null,
                null,
                null,
            
            );

            return ceil(count($totalRequest ) / intval($data['itemPerPage']));
        } 

 
        if($tableType == 'pending'){

    
            $totalRequest =  $request->fetchRequestAllPending(
                $data['requestCategory'],
                $data['dateRange'],
                null,
                null,
                null,
            
            );

            return ceil(count($totalRequest ) / intval($data['itemPerPagePENDING']));
        } 


        if($tableType == 'REPORTS'){
            $REPORTdata = $request->fetchDataForReports(                                                                      
                $data['dateRange'],
                $data['searchedData'],
                null,
                null,                                                                          
                );

            return ceil(count($REPORTdata ) / intval($data['itemPerPageREPORTS']));
        } 

        if($tableType == 'user'){
            $user = new user();
            $totalUSER = $user->getAllUser(                                                                      
                $data['searchedData'],
                null,
                null,                                                                          
                );

            return ceil(count($totalUSER ) / intval($data['itemPerPageUSER']));
        } 
        
      
    }


    public function filterTable($data){

        $request = new request();
        $requestListData = $request->fetchRequest(
                                                    (isset($data['userID'])?$data['userID']:'`transaction`.t_userid'),
                                                    $data['searchedData']['requestType'],
                                                    $data['searchedData']['dateRange'],
                                                    $data['searchedData']['searchWord'],
                                                    $data['searchedData']['pageNumber'],
                                                    $data['searchedData']['numbeRows'],
                                                    $data['searchedData']['tableType']
                                                );
                                            
        $data['request'] = $this->modifyTable($requestListData,$data['searchedData']['tableType']);                                 
        $responseJson = json_encode($data);
        echo $responseJson;
    }

    public function filterTablePENDING($data){

        $request = new request();

        $pendingRequest = $request->fetchRequestAllPending(
            $data['searchedData']['requestType'],
            $data['searchedData']['dateRange'],
            $data['searchedData']['searchWord'],
            $data['searchedData']['pageNumber'],
            $data['searchedData']['numbeRows'],                                       
            );     

        $data['request'] = $this->modifyTable($pendingRequest,'all');                                 
        $responseJson = json_encode($data);
        echo $responseJson;
    }
    public function filterTableReport($data){

        $request = new request();

        $requestListData = $request->fetchDataForReports(                                                                      
            $data['searchedData']['dateRange'],
            $data['searchedData']['searchWord'],
            $data['searchedData']['numbeRows'],   
            $data['searchedData']['pageNumber'],                                                                          
            );

        $data['request'] = $this->modifyTable($requestListData,$data['searchedData']['tableType']);                                 
        $responseJson = json_encode($data);
        echo $responseJson;
    }

    public function filterTableUSER($data){

        $request = new User();

        $data['request']= $request->getAllUser(                                                                      
            $data['searchedData']['searchWord'],
            $data['searchedData']['numbeRows'],   
            $data['searchedData']['pageNumber'],                                                                          
            );                               
        $responseJson = json_encode($data);
        echo $responseJson;
    }

    public function passwordHashing($salt, $password){
        $password .=  $salt;
        $hashedPass = hash('sha256', $password);
        
        return $hashedPass;
    }

    public function verifyPassword($salt, $hashedPass, $inputPass){
        $verifyPass = $this->passwordHashing($salt,$inputPass);
        if($verifyPass != $hashedPass){
            return true;
        }
        else{
            return false;
        }
    }

        
    function generateRandomString($length = 15)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    


    public function handleAttachment($attachments, $url) {
        $attachmentList = [];
     
        // Check if $attachments is empty
        if($attachments['name'][0] == "") {
          
            return $attachmentList;
        }

    
        $total_count = count($attachments['name']);
        

   
        for ($i = 0; $i < $total_count; $i++) {
            $tmpFilePath = $attachments['tmp_name'][$i];
            $originalFileName = $attachments['name'][$i];
            $fileType = strtolower(pathinfo($originalFileName, PATHINFO_EXTENSION));
            $fileSize = $attachments['size'][$i];
            
            // var_dump($fileSize);
            // exit();
            // Check if file type is allowed and file size is within limit
            if (in_array($fileType, ['pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png']) && $fileSize <= 10 * 1024 * 1024) {
                $newFileName = $this->generateRandomString() . '$-$-$' . $originalFileName;
                $newFilePath = ROOT . "/public/storage/files/" . $newFileName;

                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $attachmentList[] =  $newFileName;
                } else {
                    $_SESSION['page_error_form'] = 'Failed to upload File';
                    header("Location: ".$url."&fail=upload"); 
                    exit();                 
                }
            } else {
                $_SESSION['page_error_form'] = 'Invalid file type or size exceeds limit';
                header("Location: ".$url."&fail=type_limit");
                exit();
            }
        }

        return $attachmentList;
    }
    
    
    
    
}

