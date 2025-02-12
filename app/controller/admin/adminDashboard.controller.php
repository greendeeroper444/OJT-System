<?php


class AdminDashboardController extends Controller{   
    private $data;

    public function __construct(){
        $_searchInput = json_decode(file_get_contents("php://input"), true);
        $this->data = [
            'userType' => 'admin',
            'userID' => 'request.user_id',
            'requestCategory' => 2,
            'dateRange' => $_POST['date-range']??'Select Date Range',  

            //Searchbar Axios
            'searchedData' => $_searchInput??null, 

            //Pagination Values
            'itemPerPagePENDING'=> $_POST['number-rowsPENDING']??'5',
            'pagePENDING'=> $_POST['pageNumberPENDING']??'1',
        ];


        // $this->data['numberofPages'] = $this->numberOfPages($this->data,'PIO');
    }


    public function showAction() {
        if ($this->data['searchedData'] !== null) {
            $this->filterTablePENDING($this->data);
            exit();
        }
        $request = new request();
        $pendingRequest = $request->fetchRequestAllPending(
            $this->data['requestCategory'],
            $this->data['dateRange'],
            $this->data['searchedData'],
            $this->data['pagePENDING'],
            $this->data['itemPerPagePENDING'],                                         
        );        
   
        $this->data['numberofPagesPENDING'] = $this->numberOfPages($this->data,'pending');    
    
                                                      
        
        $this->data['PIOpending'] =  $request->fetchPendingAll('pio',3,'`transaction`.t_userID');        
        $this->data['PHOTOpending'] =  $request->fetchPendingAll('photo',3,'`transaction`.t_userID');  
        $this->data['POSTINGpending'] =  $request->fetchPendingAll('posting',3,'`transaction`.t_userID');  
        $this->data['approvedRequest'] =  $request->fetchApproved();   


                                                  
        $this->data['pendingRequest'] = $this->modifyTable($pendingRequest,'all');
        $this->render('admin/adminDashboard', $this->data);


        
    }

}
