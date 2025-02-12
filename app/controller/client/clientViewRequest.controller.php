<?php

class ClientViewRequest extends Controller {
    private $data;
        
    public function __construct() {
        $this->data = [
            'userType' => 'client',
            'requestID' => $_GET['view'],
        ];
    
    }

    public function showAction() {
        
        $request = new request();
        $requestListData = $request->fetchRequestByID($this->data['requestID']);
        $this->data['request'] = $this->modifyTable($requestListData);
        $this->render('client/clientViewRequest',$this->data);
    }

    public function submitAction() {
        

        //Code When Login button is clicked
    }
}
    