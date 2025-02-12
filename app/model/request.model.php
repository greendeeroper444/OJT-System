<?php

class Request extends controller
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }


    //-----------------INSERT SECTION-----------------//
    public function createRequestPIO($POSTdata)
    {
        extract($POSTdata);


       

        $stmt = $this->db->prepare("SELECT * FROM `request_pio` ORDER BY `r_ID` DESC LIMIT 1 ");
        $stmt->execute();
        $result = $stmt->fetchAll();

        $requestCode = explode('-',$result[0]['r_request_code']);
        

        $dataYear = (int)$requestCode[2 ];
        $currentYear = (int)date('Y');


        if(($currentYear - $dataYear) != 0){
            $newRequestCodeNumber = 0;
        }else{
            $newRequestCodeNumber = (int)$requestCode[3] + 1;
        }

        $newRequestCodeNumber = (int)$requestCode[3] + 1;

        
        $stmt = $this->db->prepare("INSERT INTO `request_pio` ( r_activityname, r_durationStart,r_durationEnd, r_venue, r_participants, r_keyofficials, r_highlights,
            r_services, r_platforms, r_attachements,r_additionalInfo,r_request_code
        ) 
        VALUES  (:r_activityname, :r_durationStart,:r_durationEnd, :r_venue,:r_participants, :r_keyofficials, :r_highlights,
                :r_services, :r_platforms, :r_attachements, :r_additionalInfo,:r_request_code
            )"
        );

        $durationEnd =   strtotime( $durationEnd );
        $durationStart = strtotime( $durationStart );
        $additionalInfo = str_replace("\/","/",$additionalInfo);
        $additionalInfo = str_replace(['\n', '\r'],"&#10",$additionalInfo);
        $additionalInfo = str_replace('"', "",$additionalInfo);
        $result = $stmt->execute([ 
            $activityName,
            $durationStart,
            $durationEnd,
            $activityVenue,
            $activityParticipants,
            $activityOfficials,
            $activityHighlights,                          
            $services,
            $platforms,
            $attachments,
            $additionalInfo,
            'DNSC-PIO-'.$currentYear.'-'. $newRequestCodeNumber
        ]); 

     
        $lastInsertedPrimary = $this->db->lastInsertId();
        $transaction = new Transaction();
        $transaction->createTransaction($lastInsertedPrimary, $userID, "PIO");
    }

    public function createRequestPosting($POSTdata)
    {
        extract($POSTdata);

        $stmt = $this->db->prepare(
            "INSERT INTO `request_posting` ( `r_title`, `r_content`, `r_attachements`,`r_link`,`r_platforms`) 
                                                        
            VALUES  (:r_title,:r_content,:r_attachements,:r_link,:r_platforms)"

        );

        $postContent = str_replace("\/","/",$postContent);
        $postContent = str_replace(['\n', '\r'],"&#10",$postContent);
        $postContent = str_replace('"', "",$postContent);

        $postLink = str_replace("\/","/",$postLink);
        $postLink = str_replace(['\n', '\r'],"&#10",$postLink);
        $postLink = str_replace('"', "",$postLink);

        $result = $stmt->execute([
            $postTitle,
            $postContent,
            $attachments,
            $postLink,
            $platforms
        ]);

        $transaction = new Transaction();
        $transaction->createTransaction($this->db->lastInsertId(), $userID, 'POSTING');
    }

    public function createRequestPhoto($POSTdata)
    {
        extract($POSTdata);

        $stmt = $this->db->prepare(
            "INSERT INTO `request_photo` (`r_activityname`, `r_durationStart`, `r_durationEnd`, `r_purpose`) 
                                                        
            VALUES  (:r_activityname, :r_durationStart,:r_durationEnd, :r_purpose)"

        );

        $durationEnd =   strtotime($durationEnd);
        $durationStart = strtotime($durationStart);

        $result = $stmt->execute([
            $activityName,
            $durationStart,
            $durationEnd,
            $activityPurpose,
        ]);

        $transaction = new Transaction();
        $transaction->createTransaction($this->db->lastInsertId(), $userID, 'PHOTO');
    }



    //-----------------UPDATE SECTION-----------------//

    public function updateRequestPIO($POSTdata)
    {
        extract($POSTdata);


        $stmt = $this->db->prepare("SELECT `r_attachements` FROM `request_pio` WHERE `r_id`=:r_id ");
        $stmt->execute([
            'r_id' => $reqId,
        ]);

        $attachementOriginal = $stmt->fetchColumn();
        $existingData = json_decode($attachementOriginal, true);
        $newData = json_decode($attachments, true);
        $combinedArray = array_merge($existingData, $newData);
        $newAttachmentData = json_encode($combinedArray);

        $stmt = $this->db->prepare(
            "UPDATE `request_pio` SET `r_activityname`=:r_activityname,`r_durationStart`=:r_durationStart,`r_durationEnd`=:r_durationEnd,
        
            `r_venue`=:r_venue,`r_highlights`=:r_highlights, `r_participants`=:r_participants,`r_keyofficials`=:r_keyofficials,`r_additionalInfo`=:r_additionalInfo,

            `r_services`=:r_services,`r_platforms`=:r_platforms,
            
            `r_attachements`=:r_attachements WHERE `r_id`=:r_id "
        );

        $durationEnd =   strtotime($durationEnd);
        $durationStart = strtotime($durationStart);
        $result = $stmt->execute([
            $activityName,
            $durationStart,
            $durationEnd,
            $activityVenue,
            $activityHighlights,
            $activityParticipants,
            $activityOfficials,
            $additionalInfo,
            $services,
            $platforms,
            $newAttachmentData,
            $reqId
        ]);
    }

    public function updateRequestPOSTING($POSTdata)
    {
        extract($POSTdata);

        $stmt = $this->db->prepare("SELECT `r_attachements` FROM `request_posting` WHERE `r_id`=:r_id ");
        $stmt->execute([
            'r_id' => $reqId,
        ]);

        $attachementOriginal = $stmt->fetchColumn();
        $existingData = json_decode($attachementOriginal, true);
        $newData = json_decode($attachement, true);


        $combinedArray = array_merge($existingData, $newData);
        $newAttachmentData = json_encode($combinedArray);

        $stmt = $this->db->prepare(
            "UPDATE `request_posting` SET `r_title`=:r_title,`r_link`=:r_link,`r_content`=:r_content,`r_platforms`=:r_platforms,            
                                    `r_attachements`=:r_attachements WHERE `r_id`=:r_id "
        );

        $result = $stmt->execute([
            $title,
            $link,
            $content,
            $platform,
            $newAttachmentData,
            $reqId
        ]);
    }


    public function updateRequestPHOTO($POSTdata)
    {
        extract($POSTdata);
        $stmt = $this->db->prepare(
            "UPDATE `request_photo` SET `r_activityname`=:r_activityname,`r_durationStart`=:r_durationStart,`r_durationEnd`=:r_durationEnd,`r_purpose`=:r_purpose WHERE `r_id`=:r_id "
        );

        $durationEnd =   strtotime($durationEnd);
        $durationStart = strtotime($durationStart);

        $result = $stmt->execute([
            $activityName,
            $durationStart,
            $durationEnd,
            $purposeInfo,
            $reqId
        ]);
    }


    public function updateOutputContent($POSTdata) {
        extract($POSTdata);

        $stmt = $this->db->prepare(
            "UPDATE 'request_'.$type SET `r_activityname`=:r_activityname,`r_durationStart`=:r_durationStart,`r_durationEnd`=:r_durationEnd,`r_purpose`=:r_purpose WHERE `r_id`=:r_id "
        );


        $durationEnd =   date('Y-m-d H:i:s ', strtotime($durationEnd));
        $durationStart = date('Y-m-d H:i:s ', strtotime($durationStart));

        $result = $stmt->execute([
            $activityName,
            $durationStart,
            $durationEnd,
            $purposeInfo,
            $requestID
        ]);
    }



    //-----------------FETCH SECTION-----------------//

    public function fetchRequest($userID, $requestCategory, $dateRange, $searchedWord, $offset, $numberOfitems, $type)
    {
        $reqTable = 'request_' . $type;

        if ($type == 'pio' || $type == 'photo') {
            $sqlStatement = (
                "
                SELECT * FROM `" . $reqTable . "` as tr
                INNER JOIN `transaction` ON `tr`.r_id = `transaction`.t_r_id    
                INNER JOIN `user` ON `transaction`.t_userID = `user`.user_id                    
                WHERE `transaction`.t_userid = " . $userID . " AND `transaction`.t_r_type = '" . $type . "'                   "
            );
        }

        if ($type == 'posting') {
            $sqlStatement = (
                "
                SELECT * FROM `" . $reqTable . "` as tr
                INNER JOIN `transaction` ON `tr`.r_id = `transaction`.t_r_id     
                INNER JOIN `user` ON `transaction`.t_userID = `user`.user_id       
                WHERE `transaction`.t_userid = " . $userID . " AND `transaction`.t_r_type = '" . $type . "'                    "
            );
        }

        if ($type == 'pio' || $type == 'pending') {
            $sqlStatement = (
                "
                SELECT * FROM `" . $reqTable . "` as tr
                INNER JOIN `transaction` ON `tr`.r_id = `transaction`.t_r_id    
                INNER JOIN `user` ON `transaction`.t_userID = `user`.user_id                    
                WHERE `transaction`.t_userid = " . $userID . " AND `transaction`.t_r_type = '" . $type . "'                   "
            );
        }

        if ($type == 'pio' || $type == 'photo') {
            if ($dateRange !== "Select Date Range") {
                $dateRange = explode(' - ', $dateRange);
                $sqlStatement = $sqlStatement . "   
                    AND `tr`.r_durationStart BETWEEN '" . date('Y-m-d', strtotime($dateRange[0])) . "' AND '" . date('Y-m-d', strtotime($dateRange[1])) . "'                       
                ";
            }

            if ($searchedWord !== null) {
                $sqlStatement = $sqlStatement . "   
                    AND `tr`.r_activityname LIKE '%" . $searchedWord . "%'                 
                ";
            }
        }


        if ($type == 'posting') {
            if ($dateRange !== "Select Date Range") {
                $dateRange = explode(' - ', $dateRange);
                $sqlStatement = $sqlStatement . "   
                    AND `transaction`.t_datetimerequested BETWEEN '" . date('Y-m-d', strtotime($dateRange[0])) . "' AND '" . date('Y-m-d', strtotime($dateRange[1])) . "'                       
                ";
            }


            if ($searchedWord !== null) {
                $sqlStatement = $sqlStatement . "   
                    AND `transaction`.r_title LIKE '%" . $searchedWord . "%'                 
                ";
            }
        }



       
        if ($requestCategory !== null) {
            $sqlStatement = $sqlStatement . "   
                AND ($requestCategory IS NULL or `transaction`.t_status = " . $requestCategory . " )                
            ";
        }
        $sqlStatement =  $sqlStatement . " ORDER BY `transaction`.t_id desc ";

        if (($numberOfitems !== null) or ($offset !== null)) {
            $sqlStatement = $sqlStatement . "LIMIT " . ((intval($offset) - 1) * $numberOfitems) . ", " . intval($numberOfitems) . "";
        }

        $stmt = $this->db->prepare($sqlStatement);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function fetchDataForReports($dateRange,$searchedWord,$numberOfitems,$offset){
        $sqlStatement = (
            "
            SELECT * FROM `transaction` as tr
            LEFT  JOIN `request_pio` ON `tr`.t_r_id = `request_pio`.r_id    
            INNER JOIN `user` ON `tr`.t_userID = `user`.user_id                
            WHERE `tr`.t_status = '1' AND tr.t_r_type= 'PIO'"
        );

        if ($dateRange !== "Select Date Range") {
            $dateRange = explode(' - ', $dateRange);
            $sqlStatement = $sqlStatement . "   
                AND `tr`.t_datetimerequested BETWEEN '" . date('Y-m-d', strtotime($dateRange[0])) . "' AND '" . date('Y-m-d', strtotime($dateRange[1])) . "'                       
            ";
        }

        if ($searchedWord !== null) {
            $sqlStatement = $sqlStatement . "   
                AND `request_pio`.r_activityname LIKE '%" . $searchedWord . "%'                 
            ";
        }
        
        $sqlStatement =  $sqlStatement . " ORDER   BY `tr`.t_id desc ";

        if (($numberOfitems !== null) or ($offset !== null)) {
            $sqlStatement = $sqlStatement . "LIMIT " . ((intval($offset) - 1) * $numberOfitems) . ", " . intval($numberOfitems) . "";
        }

        $stmt = $this->db->prepare($sqlStatement);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function fetchRequestAllPending($requestCategory, $dateRange, $searchedWord, $offset, $numberOfitems)
    {
        $sqlStatement = (
            "
            SELECT * FROM `transaction` as tr
            LEFT  JOIN `request_pio` ON `tr`.t_r_id = `request_pio`.r_id   
            LEFT  JOIN `request_photo` ON `tr`.t_r_id = `request_photo`.r_id 
            LEFT  JOIN `request_posting` ON `tr`.t_r_id = `request_posting`.r_id  
            INNER JOIN `user` ON `tr`.t_userID = `user`.user_id                
            WHERE `tr`.t_status = '3' "
        );

        if ($dateRange !== "Select Date Range") {
            $dateRange = explode(' - ', $dateRange);
            $sqlStatement = $sqlStatement . "   
                AND `tr`.t_datetimerequested BETWEEN '" . date('Y-m-d', strtotime($dateRange[0])) . "' AND '" . date('Y-m-d', strtotime($dateRange[1])) . "'                       
            ";
        }

        if ($searchedWord !== null) {
            // Ensure to escape the input to prevent SQL injection
            $sqlStatement .= "   
                AND (`user`.`user_fn` LIKE '%" . $searchedWord . "%' OR `user`.`user_ln` LIKE '%" . $searchedWord . "%')              
            ";
        }

        $sqlStatement =  $sqlStatement . " ORDER BY `tr`.t_id desc ";

        
        if (($numberOfitems !== null) or ($offset !== null)) {
            $sqlStatement = $sqlStatement . "LIMIT " . ((intval($offset) - 1) * $numberOfitems) . ", " . intval($numberOfitems) . "";
        }

        $stmt = $this->db->prepare($sqlStatement);
        $stmt->execute();
        return $stmt->fetchAll();
    }


    public function fetchPendingAndApproved($requestCategory, $dateRange, $searchedWord, $offset, $numberOfitems)
    {
        $sqlStatement = (
            "
            SELECT * FROM `transaction` as tr
            LEFT  JOIN `request_pio` ON `tr`.t_r_id = `request_pio`.r_id   
            LEFT  JOIN `request_photo` ON `tr`.t_r_id = `request_photo`.r_id 
            LEFT  JOIN `request_posting` ON `tr`.t_r_id = `request_posting`.r_id  
            INNER JOIN `user` ON `tr`.t_userID = `user`.user_id                
            WHERE `tr`.t_status = '3' OR `tr`.t_status = '2'"
        );


        if (($numberOfitems !== null) or ($offset !== null)) {
            $sqlStatement = $sqlStatement . "LIMIT " . ((intval($offset) - 1) * $numberOfitems) . ", " . intval($numberOfitems) . "";
        }

        $stmt = $this->db->prepare($sqlStatement);
        $stmt->execute();
        return $stmt->fetchAll();
    }



    //-----------------OTHER SECTION-----------------//
    public function fetchRequestByID($type, $id)
    {

        $reqTable = 'request_' . strtolower($type);


        $stmt = $this->db->prepare(
            "
            SELECT * FROM `" . $reqTable . "` as tr
            INNER JOIN `transaction` ON `tr`.r_id = transaction.t_r_id  
            INNER JOIN `user` ON `transaction`.t_userID = user.user_id                               
            WHERE `transaction`.t_r_id =' " . $id . "' AND `transaction`.t_r_type = '" . $type . "'"
        );
        $stmt->execute();
        $result = $this->modifyTable($stmt->fetchAll(), strtolower($type));


        return $result;
    }

    public function fetchPending($type, $status, $userID)
    {

        $reqTable = 'request_' . $type;
        $stmt = $this->db->prepare(
            "
            SELECT * FROM `" . $reqTable . "` as tr
            INNER JOIN `transaction` ON `tr`.r_id = transaction.t_r_id                                  
            WHERE `transaction`.t_status =' " . $status . "' AND `transaction`.t_r_type = '" . $type . "' AND `transaction`.t_userID = '" . $userID . "'"
        );
        $stmt->execute();
        $result = $stmt->rowCount();


        return $result;
    }


    public function fetchPendingAll($type, $status)
    {

        $reqTable = 'request_' . $type;
        $stmt = $this->db->prepare(
            "
            SELECT * FROM `" . $reqTable . "` as tr
            INNER JOIN `transaction` ON `tr`.r_id = transaction.t_r_id                                  
            WHERE `transaction`.t_status =' " . $status . "' AND `transaction`.t_r_type = '" . $type . "'"
        );
        $stmt->execute();
        $result = $stmt->rowCount();


        return $result;
    }

    public function fetchApproved()
    {
        $stmt = $this->db->prepare(
            "
            SELECT * FROM `transaction` as tr
            left JOIN `request_pio` ON `tr`.t_r_id = `request_pio`.r_id   
            WHERE `tr`.t_status = '2'"
        );
        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }


    public function fetchApprovedRequest($userID)
    {
        $stmt = $this->db->prepare(
            "
        SELECT * FROM `transaction` as tr
        left JOIN `request_pio` ON `tr`.t_r_id = `request_pio`.r_id   
        left JOIN `request_posting` ON `tr`.t_r_id = `request_posting`.r_id  
        left JOIN `request_photo` ON `tr`.t_r_id = `request_photo`.r_id 
        INNER JOIN `user` ON `tr`.t_userID = `user`.user_id                
        WHERE `tr`.t_status = '2' AND `tr`.t_userID=" . $userID . ""
        );
        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }


    public function fetchUserRequestStatistic($userID)
    {

        $Statlist = [];


        //Count POSTING
        $stmt = $this->db->prepare(
            "
            SELECT * FROM `transaction` as tr                               
            WHERE `tr`.t_userID =' " . $userID . "'AND `tr`.t_r_type = 'PIO'"
        );

        $stmt->execute();
        $result = $stmt->rowCount();

        $Statlist['PIO'] = $result;

        //Count POSTING
        $stmt = $this->db->prepare(
            "
        SELECT * FROM `transaction` as tr                               
        WHERE `tr`.t_userID =' " . $userID . "'AND `tr`.t_r_type = 'POSTING'"
        );

        $stmt->execute();
        $result = $stmt->rowCount();
        $Statlist['POSTING'] = $result;

        $Statlist['POSTING'] = $result;
        //Count POSTING
        $stmt = $this->db->prepare(
            "
          SELECT * FROM `transaction` as tr                               
          WHERE `tr`.t_userID =' " . $userID . "'AND `tr`.t_r_type = 'PHOTO'"
        );

        $stmt->execute();
        $result = $stmt->rowCount();

        $Statlist['PHOTO'] = $result;
        $total = $Statlist['PHOTO'] + $Statlist['PIO'] + $Statlist['POSTING'];



        // Calculate percentages
        $photoPercent = ($Statlist['PHOTO'] != 0) ? ($Statlist['PHOTO'] / $total) * 100 : 0;
        $pioPercent = ($Statlist['PIO'] != 0) ? ($Statlist['PIO'] / $total) * 100 : 0;
        $postingPercent = ($Statlist['POSTING'] != 0) ? ($Statlist['POSTING'] / $total) * 100 : 0;

        $Statlist['requestTotal'] =   $total;
        $Statlist['PHOTOpercent'] =   floor($photoPercent);
        $Statlist['PIOpercent'] =   floor($pioPercent);
        $Statlist['POSTINGpercent'] =   floor($postingPercent);



        //Count Reqeust status
        $stmt = $this->db->prepare(
            "
          SELECT * FROM `transaction` as tr                               
          WHERE `tr`.t_userID =' " . $userID . "'AND `tr`.t_status = '3'"
        );

        $stmt->execute();
        $result = $stmt->rowCount();
        $Statlist['pending'] = $result;

        $stmt = $this->db->prepare(
            "
        SELECT * FROM `transaction` as tr                               
        WHERE `tr`.t_userID =' " . $userID . "'AND `tr`.t_status = '2'"
        );

        $stmt->execute();
        $result = $stmt->rowCount();
        $Statlist['approved'] = $result;


        $stmt = $this->db->prepare(
            "
        SELECT * FROM `transaction` as tr                               
        WHERE `tr`.t_userID =' " . $userID . "'AND `tr`.t_status = '1'"
        );

        $stmt->execute();
        $result = $stmt->rowCount();
        $Statlist['complete'] = $result;


        return $Statlist;
    }
}
