<?php


class AdminReportsController extends Controller{   
    private $data;

    public function __construct(){
        $_searchInput = json_decode(file_get_contents("php://input"), true);
        $this->data = [
            'userType' => 'admin',
            'itemPerPageREPORTS'=> $_POST['number-rowsREPORTS']??'5',
            'pageREPORTS'=> $_POST['pageNumberREPORTS']??'1',
            'dateRange' => $_POST['date-range'] ?? 'Select Date Range',

            //Searchbar Axios
            'searchedData' => $_searchInput ?? null,
        ];
    }

    public function showAction() {
        if ($this->data['searchedData'] !== null) {
            // var_dump($this->data['searchedData']);
            $this->filterTableReport($this->data);
            exit();
        }
        $request = new request();
        $REPORTdata = $request->fetchDataForReports(                                                                      
                                            $this->data['dateRange'],
                                            $this->data['searchedData'],
                                            $this->data['itemPerPageREPORTS'],   
                                            $this->data['pageREPORTS'],                                                                           
                                            );
        $this->data['numberofPagesREPORTS'] = $this->numberOfPages($this->data,'REPORTS');


        $this->data['REPORTdata'] = $this->modifyTable($REPORTdata,"reports");

     
        $this->render('admin/adminReports', $this->data);
    }

    public function generateReportAction() {
        $request = new request();
        $REPORTdata = $request->fetchDataForReports(                                                                      
                                            $this->data['dateRange'],
                                            $this->data['searchedData'],
                                            $this->data['itemPerPageREPORTS'],   
                                            $this->data['pageREPORTS'],                                                                              
                                            );
        // $this->data['numberofPagesPIO'] = $this->numberOfPages($this->data,'pio');


        $reportData = $this->modifyTable($REPORTdata,"reports");
                                  
        include_once(ROOT . '/app/controller/src/reportHandler.php');

    }

}
