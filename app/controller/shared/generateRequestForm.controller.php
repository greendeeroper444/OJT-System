<?php


class GenerateRequestFormController extends Controller{   
    private $data;

    public function __construct(){

        $this->data = [
       
        ];
    }

 
    public function generateFormRequestAction() {

    
        // $this->data['numberofPagesPIO'] = $this->numberOfPages($this->data,'pio');
        $request = new request();
        $this->data['request'] = $request->fetchRequestByID($_GET['type'], $_GET['id']);
        $requestData = $this->data['request'];
        
     
        include_once(ROOT . '/app/controller/src/generatePDF.php');

        $pdf = new PDF();
        $pdf->setData($requestData);
        $pdf->RequestForm();
        $pdf->Output();
    }

}
