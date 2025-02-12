<?php
class ClientDashboardController extends Controller
{
    private $data;
   
    public function __construct(){
        $_searchInput = json_decode(file_get_contents("php://input"), true);
        $this->data = [
            'userType' => 'client',
            'userID' => $_SESSION['user_id'],
            'requestCategory' => $_POST['request-cat']??null,
            'dateRange' => $_POST['date-range']??'Select Date Range',  
            'currActive' => $_POST['currActiveTable']??'table1', 

            //Searchbar Axios
            'searchedData' => $_searchInput??null, 

            //Pagination Values
            'itemPerPagePIO'=> $_POST['number-rowsPIO']??'5',
            'pagePIO'=> $_POST['pageNumberPIO']??'1',

            'itemPerPagePHOTO'=> $_POST['number-rowsPHOTO']??'5',
            'pagePHOTO'=> $_POST['pageNumberPHOTO']??'1',

            'itemPerPagePOSTING'=> $_POST['number-rowsPOSTING']??'5',
            'pagePOSTING'=> $_POST['pageNumberPOSTING']??'1',
        ];
    }

    public function showAction(){

        
        if ($this->data['searchedData'] !== null) {
            $this->filterTable($this->data);
            exit();
        }

        $request = new request();
        $PIOdata = $request->fetchRequest(

                                                $this->data['userID'],
                                                $this->data['requestCategory'],
                                                $this->data['dateRange'],
                                                $this->data['searchedData'],
                                                $this->data['pagePIO'],
                                                $this->data['itemPerPagePIO'],
                                                'pio'
                                            
                                            );
        $this->data['numberofPagesPIO'] = $this->numberOfPages($this->data,'pio');

        $PHOTOdata = $request->fetchRequest(

                                                $this->data['userID'],
                                                $this->data['requestCategory'],
                                                $this->data['dateRange'],
                                                $this->data['searchedData'],
                                                $this->data['pagePHOTO'],
                                                $this->data['itemPerPagePHOTO'],
                                                'photo'
                                             );

        $this->data['numberofPagesPHOTO'] = $this->numberOfPages($this->data,'photo');                                    
        $POSTINGdata = $request->fetchRequest(

                                                $this->data['userID'],
                                                $this->data['requestCategory'],
                                                'Select Date Range',
                                                $this->data['searchedData'],
                                                $this->data['pagePOSTING'],
                                                $this->data['itemPerPagePOSTING'],
                                                'posting'
                                            );
        $this->data['numberofPagesPOSTING'] = $this->numberOfPages($this->data,'posting'); 

                                   
        $this->data['PIOdata'] = $this->modifyTable($PIOdata,"pio");
        $this->data['PHOTOdata'] = $this->modifyTable($PHOTOdata,'photo');
        $this->data['POSTINGdata'] = $this->modifyTable($POSTINGdata,'posting');

        $this->data['PIOpending'] =  $request->fetchPending('pio',3,$this->data['userID']);        
        $this->data['PHOTOpending'] =  $request->fetchPending('photo',3,$this->data['userID']);  
        $this->data['POSTINGpending'] =  $request->fetchPending('posting',3,$this->data['userID']);  
                                         

        $request = new user();
        $user = $request->getUserById($this->data['userID']);
        
        $this->data['userName'] = $user['user_fn'] .' '.$user['user_ln'] ;    

        $this->render('client/clientDashboard', $this->data);
    }


}
