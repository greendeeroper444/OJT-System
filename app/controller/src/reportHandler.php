<?php
require ROOT .'/app/controller/src/SimpleXLSXGen.php';
$data = [
    ['','','<style font-size="32"><b>Public Information Office<Center></b></style>'],
    [],
    ['<b>Fiscal Year 2024</b>'],
    ['<b>Summary Accomplishment<b>'],
    [],
    [
    '<style bgcolor="#32CD32" >Quarter</style>',
    '<style bgcolor="#32CD32" >NO.</style>',
    '<style bgcolor="#32CD32">Type of Service/s</style>',
    '<style bgcolor="#32CD32">Date Requested</style>',
    '<style bgcolor="#32CD32">Date Accomplished</style>',
    '<style bgcolor="#32CD32">No. of Days Acted Upon</style>',
    '<style bgcolor="#32CD32">NAME OF EVENT</style>',
    '<style bgcolor="#32CD32">Requesting Office</style>',
    '<style bgcolor="#32CD32">Status</style>',
    '<style bgcolor="#32CD32">Control Number</style>',
    '<style bgcolor="#32CD32">Remarks</style>']

];
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

$row = 1;
foreach($reportData as $report){
	$entry = [];

    $entry[] = '';
    $entry[] = $row;
    $entry[] = activityList($report['r_services']);
    $entry[] = "<center>" . $report['t_dateRequested'] . "</center>";
    $entry[] = "<center>" . $report['t_datecompleted'] ."</center>";
    $entry[] = "<center>" . getDateDifference($report['t_dateRequested'],$report['t_datecompleted']) ."</center>";
    $entry[] = "<center>" . $report['r_activityname'] ."</center>";
    $row++;
    $data[] = $entry;
    $entry = [];



}

$xlsx = \Shuchkin\SimpleXLSXGen::fromArray($data);

// Save the generated XLSX file to a temporary location
$filename = 'report_accomplishement.xlsx';
$xlsx->saveAs($filename);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Content-Length: ' . filesize($filename));
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate');
header('Pragma: public');
ob_clean();
flush();
readfile($filename);
// Delete the temporary file after download
unlink($filename);
?>