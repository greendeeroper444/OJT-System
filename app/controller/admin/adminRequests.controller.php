<?php
class AdminRequestController extends Controller
{

    private $data;

    public function __construct()
    {
        $_searchInput = json_decode(file_get_contents("php://input"), true);
        $this->data = [
            'userType' => 'admin',
            'requestCategory' => $_POST['request-cat'] ?? null,
            'dateRange' => $_POST['date-range'] ?? 'Select Date Range',
            'requestID' => $_GET['view'] ?? null,
            'actionRequest' => $_GET['action'] ?? null,
            'currActive' => $_POST['currActiveTable']??'table1', 

            //Searchbar Axios
            'searchedData' => $_searchInput ?? null,

            //Pagination Values
            'itemPerPagePIO'=> $_POST['number-rowspio']??'5',
            'pagePIO'=> $_POST['pageNumberPIO']??'1',


            

            'itemPerPagePHOTO'=> $_POST['number-rowsphoto']??'5',
            'pagePHOTO'=> $_POST['pageNumberPHOTO']??'1',

            'itemPerPagePOSTING'=> $_POST['number-rowsposting']??'5',
            'pagePOSTING'=> $_POST['pageNumberPOSTING']??'1',
        ];
    }


    public function showAction(){

        if ($this->data['searchedData'] !== null) {
            // var_dump($this->data['searchedData']);
            $this->filterTable($this->data);
         
            exit();
        }
        $request = new request();
        $PIOdata = $request->fetchRequest(
                                            '`transaction`.t_userid',
                                            $this->data['requestCategory'],
                                            $this->data['dateRange'],
                                            $this->data['searchedData'],
                                            $this->data['pagePIO'],
                                            $this->data['itemPerPagePIO'],
                                            'pio'
                                            
                                            );

                                            
        $this->data['numberofPagesPIO'] = $this->numberOfPages($this->data,'pio');
        
    
        $PHOTOdata = $request->fetchRequest(
                                                '`transaction`.t_userid',
                                                
                                                $this->data['requestCategory'],
                                                $this->data['dateRange'],
                                                $this->data['searchedData'],
                                                $this->data['pagePHOTO'],
                                                $this->data['itemPerPagePHOTO'],
                                                'photo'
                                             );
                                            
        $this->data['numberofPagesPHOTO'] = $this->numberOfPages($this->data,'photo');                                       
        $POSTINGdata = $request->fetchRequest(
                                                '`transaction`.t_userid',                               
                                                $this->data['requestCategory'],
                                                $this->data['dateRange'],
                                                $this->data['searchedData'],
                                                $this->data['pagePOSTING'],
                                                $this->data['itemPerPagePOSTING'],
                                                'posting'
                                            );
        $this->data['numberofPagesPOSTING'] = $this->numberOfPages($this->data,'posting'); 
                                            
        
                                            
                            
        $this->data['PIOdata'] = $this->modifyTable($PIOdata,"pio");
        $this->data['PHOTOdata'] = $this->modifyTable($PHOTOdata,'photo');
        $this->data['POSTINGdata'] = $this->modifyTable($POSTINGdata,'posting');
        
       

        $this->render('admin/adminRequest', $this->data);
    }
}
