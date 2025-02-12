<?php
//call the autoload
require ROOT .'/public/vendor/autoload.php';

//load phpspreadsheet class using namespaces
use PhpOffice\PhpSpreadsheet\Spreadsheet;
//call iofactory instead of xlsx writer
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

//styling arrays
//table head style
$tableHead = [
	'font'=>[
		'color'=>[
			'rgb'=>'FFFFFF'
		],
		'bold'=>true,
		'size'=>11
	],
	'fill'=>[
		'fillType' => Fill::FILL_SOLID,
		'startColor' => [
			'rgb' => '32CD32'
		]
	],
];
//even row
$evenRow = [
	'fill'=>[
		'fillType' => Fill::FILL_SOLID,
		'startColor' => [
			'rgb' => '00BDFF'
		]
	]
];
//odd row
$oddRow = [
	'fill'=>[
		'fillType' => Fill::FILL_SOLID,
		'startColor' => [
			'rgb' => '00EAFF'
		]
	]
];

//styling arrays end

//make a new spreadsheet object
$spreadsheet = new Spreadsheet();
//get current active sheet (first sheet)
$sheet = $spreadsheet->getActiveSheet();

//set default font
$spreadsheet->getDefaultStyle()
	->getFont()
	->setName('Arial')
	->setSize(10);

//heading
$spreadsheet->getActiveSheet()
	->setCellValue('A1',"Public Information Office");
$spreadsheet->getActiveSheet()
->setCellValue('A5',"Fiscal Year 2024");
$spreadsheet->getActiveSheet()
->setCellValue('A6',"Summary Accomplishment");


//merge heading
$spreadsheet->getActiveSheet()->mergeCells("A1:F1");
$spreadsheet->getActiveSheet()->mergeCells("A2:F1");
$spreadsheet->getActiveSheet()->mergeCells("A3:F1");
// set font style
$spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);

// set cell alignment
$spreadsheet->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

//setting column width
$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(10);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(5);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(30);
$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(30);
$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(30);
$spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(30);
$spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(30);
$spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(30);


$spreadsheet->getActiveSheet()->getStyle('C')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

// $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
foreach (range('A', 'K') as $columnID) {
    // $spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
    // $spreadsheet->getActiveSheet()->getStyle($columnID)->getAlignment()->setHorizontal('center');
    // $spreadsheet->getActiveSheet()->getStyle($columnID)->getAlignment()->setVertical('center');
	$spreadsheet->getActiveSheet()->getStyle($columnID)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
	$spreadsheet->getActiveSheet()->getStyle($columnID)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
}

//header text
$spreadsheet->getActiveSheet()
	->setCellValue('A8',"Quarter")
	->setCellValue('B8',"NO.")
	->setCellValue('C8',"Type of Service/s")
	->setCellValue('D8',"Date Requested")
	->setCellValue('E8',"Date Accomplished")
	->setCellValue('F8',"No. of Days Acted Upon")
	->setCellValue('G8',"NAME OF EVENT")
	->setCellValue('H8',"Requesting Office")
	->setCellValue('I8',"Status")
	->setCellValue('J8',"Control Number")
	->setCellValue('K8',"Remarks");

//set font style and background color
// $spreadsheet->getActiveSheet()->getStyle('A8:K8')->applyFromArray($tableHead);

// //the content
// //read the json file
// $file = file_get_contents('student-data.json');
// $studentData = json_decode($file,true);

// //loop through the data
// //current row

function activityList($services){
	$serviceString = "";
	foreach(json_decode($services) as $service){
		$serviceString = $serviceString . $service . " \n ";
	}
	
	return $serviceString;
}

function getDateDifference($dateStart,$datEnd){
	$dateFrom = new DateTime($dateStart);
	$dateTo   = new DateTime($datEnd); // Add 1s so period includes last day.

	$period   = new DatePeriod( $dateFrom, new DateInterval( 'P1D' ), $dateTo );
	$days     = 0;

	foreach ( $period as $date ) {

		$day = $date->format( 'l' );

		if ( 'Saturday' !== $day && 'Sunday' !== $day ) {
			$days ++;
		}
	}

return $days; // 23
}

$row=10;

foreach($reportData as $data){
	$spreadsheet->getActiveSheet()
		->setCellValue('A'.$row , '')
		->setCellValue('B'.$row , $row - 9)
		->setCellValue('C'.$row , activityList($data['r_services']))
		->setCellValue('D'.$row , $data['t_dateRequested'])
		->setCellValue('E'.$row , $data['t_datecompleted'])
		->setCellValue('F'.$row , getDateDifference($data['t_dateRequested'],$data['t_datecompleted']))
		->setCellValue('G'.$row , $data['r_activityname']);
	
	// //set row style
	// if( $row % 2 == 0 ){
	// 	//even row
	// 	$spreadsheet->getActiveSheet()->getStyle('A'.$row.':F'.$row)->applyFromArray($evenRow);
	// }else{
	// 	//odd row
	// 	$spreadsheet->getActiveSheet()->getStyle('A'.$row.':F'.$row)->applyFromArray($oddRow);
	// }
	//increment row
	$row++;
}

//autofilter
//define first row and last row
// $firstRow=2;
// $lastRow=$row-1;
// //set the autofilter
// $spreadsheet->getActiveSheet()->setAutoFilter("A".$firstRow.":G".$lastRow);


//set the header first, so the result will be treated as an xlsx file.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

//make it an attachment so we can define filename
header('Content-Disposition: attachment;filename="result.xlsx"');

//create IOFactory object
$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
//save into php output
$writer->save('php://output');
