<?php

class Transaction {
    private $db;
  
    public function __construct() {
        $this->db = new Database();
    }

    public function createTransaction($requestID,$userID,$requestType){
        $stmt = $this->db->prepare("INSERT INTO `transaction` (t_r_id, t_userID,t_r_type,t_datetimerequested,t_status) 
                                    VALUES (:t_r_id,:t_userID,:t_r_type,:t_datetimerequested,:t_status)"                              
                                  );

        $result = $stmt->execute([ 
                        $requestID,
                        $userID,
                        $requestType,
                        time(),
                        3
                      ]); 
        return $result;
    }


    //-----------------UPDATE SECTION-----------------//
    public function updateRequestStatus($POSTdata)
    {
        extract($POSTdata);
        
        $declineDetailsVal = (isset($declineDetails))?$declineDetails:'null';
        $forceCompleteDetailsVal = (isset($forceCompleteDetails))?$forceCompleteDetails:'null';
        $stmt = $this->db->prepare("UPDATE `transaction` SET `t_status`=:t_status, `t_output_status`=:t_output_status,`t_datemodified`=:t_datemodified,`t_declineDetails`=:t_declineDetails,`t_forceCompleteDetails`=:t_forceCompleteDetails WHERE `t_r_id`=:t_r_id AND t_r_type=:t_r_type");
        $stmt->execute([
                $status,
                $remarks,
                time(),
                $declineDetailsVal,
                $forceCompleteDetailsVal,
                $reqId,
                $type,  
        ]);
    }


    public function updateRequestOutput($POSTdata)
    {

        extract($POSTdata);
        if($userType == 'client'){ 
                $stmt = $this->db->prepare("UPDATE `request_posting` SET `r_content`=:r_content,`r_attachements`=:r_attachements WHERE `r_id`=:r_id "
                );

                $result = $stmt->execute([ 
                    $outputDetails,           
                    $attachments,
                    $reqId
                ]); 

                $stmt = $this->db->prepare("UPDATE `transaction` SET `t_output_status`=:t_output_status,`t_viewedClient`=:t_viewedClient  WHERE `t_r_id`=:t_r_id AND `t_r_type`=:t_r_type");
                $stmt->execute([
                    'For Admin Approval',
                    null,
                    $reqId,
                    $type
                ]);

        }

        if($userType == 'admin'){
            $stmt = $this->db->prepare("SELECT `t_messageResponse` FROM `transaction` WHERE `t_r_id`=:t_r_id AND `t_r_type`=:t_r_type");
            $stmt->execute([
                't_r_id' => $reqId,
                't_r_type' => $type
                ]);
    
                $messages = $stmt->fetchColumn();
                $existingData = json_decode($messages, true);
            
                if (!isset($existingData['conversation'])) {
                    $existingData['conversation'] = [];
                }
    
                $existingData['conversation'][] = [
                    'identifier' => 'PIO Office',
                    'text' => $outputDetails,
                    'time' => time(),
                    'attachement' => $attachments
                ];
    
                // Encode the updated data back to JSON
                $newMessage = json_encode($existingData);
            
                $stmt = $this->db->prepare("UPDATE `transaction` SET `t_messageResponse`=:t_messageResponse, `t_output_status`=:t_output_status,`t_viewedClient`=:t_viewedClient  WHERE `t_r_id`=:t_r_id AND `t_r_type`=:t_r_type");
                $stmt->execute([
                    $newMessage,
                    'Output for review',
                    null,
                    $reqId,
                    $type
                ]);
    
        }
 
    }

    //Revise Output
    public function updateReviseOutput($POSTdata)
    {
        extract($POSTdata);
        $stmt = $this->db->prepare("SELECT `t_messageResponse` FROM `transaction` WHERE `t_r_id`=:t_r_id AND `t_r_type`=:t_r_type");
        $stmt->execute([
            't_r_id' => $reqId,
            't_r_type' => $type
            ]);
            $messages = $stmt->fetchColumn();
            $existingData = json_decode($messages, true);
        
            if (!isset($existingData['conversation'])) {
                $existingData['conversation'] = [];
            }

            $existingData['conversation'][] = [
                'identifier' => (($userType == 'admin')?'PIO Office':($userType == 'client'))?'Requestor':'',
                'time' => time(),
                'text' => $revisionDetails
            ];

        // Encode the updated data back to JSON
        $newMessage = json_encode($existingData);
    
        $stmt = $this->db->prepare("UPDATE `transaction` SET `t_messageResponse`=:t_messageResponse,`t_output_status`=:t_output_approval_status, `t_viewedAdmin`=:t_viewedAdmin WHERE `t_r_id`=:t_r_id AND `t_r_type`=:t_r_type");
        $stmt->execute([
            $newMessage,
            'Output for Revision',
            null,
            $reqId,
            $type,
            
        ]);
    }

    //Accept Output
    public function updateAcceptOutput($POSTdata)
    {
        extract($POSTdata);

        $stmt = $this->db->prepare("UPDATE `transaction` SET `t_output_status`=:t_output_approval_status,`t_viewedClient`=:t_viewedClient,`t_viewedAdmin`=:t_viewedAdmin WHERE `t_r_id`=:t_r_id AND `t_r_type`=:t_r_type");
        $stmt->execute([
            'Output Accepted',
            null,
            null,
            $reqId,
            $type,
            
        ]);
    }

    //Update Request Complete Date
    public function updateDateComplete($POSTdata)
    {
        extract($POSTdata);
        $stmt = $this->db->prepare("UPDATE `transaction` SET `t_datecompleted`=:t_datecompleted WHERE `t_r_id`=:t_r_id AND `t_r_type`=:t_r_type");
        $stmt->execute([
            time(),
            $reqId,
            $type,     
        ]);
    }


    // public function updateRemarks($type,$id,$remarks)
    // {
       
    //     $stmt = $this->db->prepare("UPDATE `transaction` SET `t_output_status`=:t_output_approval_status, `t_viewedClient`=:t_viewedclient,`t_viewedAdmin`=:t_viewedAdmin WHERE `t_r_id`=:t_r_id AND `t_r_type`=:t_r_type");
    //     $stmt->execute([
    //         $remarks,
    //         null,
    //         null,
    //         $id,
    //         $type,
            
    //     ]);
    // }

    // public function updateDateModified($type,$id)
    // {
    
    //     $stmt = $this->db->prepare("UPDATE `transaction` SET `t_datemodified`=:t_datemodified WHERE `t_r_id`=:t_r_id AND `t_r_type`=:t_r_type");
    //     $stmt->execute([
    //         date("Y-m-d H:i:s"),
    //         $id,
    //         $type,
            
    //     ]);
    // }


    
    public function updateRequestViewStatus($type,$id,$userType)
    {   
    
        if($userType == 'admin'){
            $stmt = $this->db->prepare("UPDATE `transaction` SET `t_viewedAdmin`=:t_viewedAdmin WHERE `t_r_id`=:t_r_id AND `t_r_type`=:t_r_type");
            $stmt->execute([
                'Yes',
                $id,
                $type,
                
            ]);
        }

        if($userType == 'client'){
            $stmt = $this->db->prepare("UPDATE `transaction` SET `t_viewedClient`=:t_viewedClient WHERE `t_r_id`=:t_r_id AND `t_r_type`=:t_r_type");
            $stmt->execute([
                'Yes',
                $id,
                $type,
                
            ]);
        }
  
    }

}