<?php
function renderTable($type, $data)
{


    // remarks color
    // No Output = text-bg-danger
    // For Admin Approval = text-bg-warning
    // Output for review = text-bg-warning
    // Output for revision = text-bg-warning
    // Request Complete = text-bg-success

    if ($type == "PHOTO") {

        if (empty($data['PHOTOdata'])) {
            echo '
            <tr>
                <td colspan="7" class="text-center">No Request Photo</td>
            </tr>';
        } else {
            foreach ($data['PHOTOdata'] as $request) {

                $statusCss = ($request['t_status'] == 1 ? 'text-bg-primary' : ($request['t_status'] == 2 ? 'text-bg-success' : ($request['t_status'] == 3 ? 'text-bg-warning' : 'text-bg-danger')));
                $statusText = ($request['t_status'] == 1 ? 'Complete' : ($request['t_status'] == 2 ? 'Approved' : ($request['t_status'] == 3 ? 'Pending' :  ($request['t_status'] == 4 ? 'Cancelled' : 'Declined')))); //$duration = $request['r_durationStartDate'] == $request['r_durationEndDate'] ? $request['r_durationStartDate'] : $request['r_durationStartDate'] . ' - ' . $request['r_durationEndDate'];
                $statusRemarks = ($request['t_output_status'] == 'No Output' ? 'text-bg-danger' : ($request['t_output_status'] == 'For Admin Approval' ? 'text-bg-warning' : ($request['t_output_status'] == 'Output for review' ? 'text-bg-warning' : ($request['t_output_status'] == 'Output for revision' ? 'text-bg-warning' : ($request['t_output_status'] == 'Request Has been Declined' ? 'text-bg-danger' : ($request['t_output_status'] == 'Request Completed' ? 'text-bg-primary' : ($request['t_output_status'] == 'Output Accepted' ? 'text-bg-primary' : 'text-bg-danger')))))));
    
                echo '
                <tr class="text-center">
                <td class="align-middle ">' . ucwords(strtolower($request['user_fn'])) . " " . ucwords(strtolower($request['user_ln'])) . '</td>
                
                    <td class="align-middle  text-truncate" style="max-width: 100px;">' . $request['r_activityname'] . '</td>
                    <td class="align-middle ">' . $request['r_durationStartDate'] . ' - ' . $request['r_durationEndDate'] . '</td>
                    <td class="align-middle ">' . $request['t_dateRequested'] .  '</td>
                    <td class="align-middle">
                    <p class=" ">
                    <span style="color:white !important; " class="badge rounded-pill ' . $statusCss . ' ">' . $statusText  . '</span>
                    </p>
                </td>
                <td class="align-middle">
                    <p class="text-center">
                    <span style="color:white !important;" class="badge rounded-pill ' . $statusRemarks . ' ">' . $request['t_output_status']  . '</span>
                    </p>
                </td>
                    <td>
                        <a href="' . PARENT_FOLDER . '/' . $data['userType'] . '/request/view?id=' . $request['r_id'] . '&type=PHOTO">
                            <div class="d-flex justify-content-center"><button type="button" class="btn btn-outline-success action">View </button></div>
                        </a>
                    </td> 
                </tr>';
            }
        }
    }

    if ($type == "POSTING") {

        if (empty($data['POSTINGdata'])) {
            echo '
                <tr>
                    <td colspan="7" class="text-center">No Posting Approval</td>
                </tr>
            ';
        } else {
            foreach ($data['POSTINGdata'] as $request) {
                $statusCss = ($request['t_status'] == 1 ? 'text-bg-primary' : ($request['t_status'] == 2 ? 'text-bg-success' : ($request['t_status'] == 3 ? 'text-bg-warning' : 'text-bg-danger')));
                $statusText = ($request['t_status'] == 1 ? 'Complete' : ($request['t_status'] == 2 ? 'Approved' : ($request['t_status'] == 3 ? 'Pending' :  ($request['t_status'] == 4 ? 'Cancelled' : 'Declined')))); //$duration = $request['r_durationStartDate'] == $request['r_durationEndDate'] ? $request['r_durationStartDate'] : $request['r_durationStartDate'] . ' - ' . $request['r_durationEndDate'];
                //$duration = $request['r_durationStartDate'] == $request['r_durationEndDate'] ? $request['r_durationStartDate'] : $request['r_durationStartDate'] . ' - ' . $request['r_durationEndDate'];
                $statusRemarks = ($request['t_output_status'] == 'No Output' ? 'text-bg-danger' : ($request['t_output_status'] == 'For Admin Approval' ? 'text-bg-warning' : ($request['t_output_status'] == 'Output for review' ? 'text-bg-warning' : ($request['t_output_status'] == 'Output for revision' ? 'text-bg-warning' : ($request['t_output_status'] == 'Request Has been Declined' ? 'text-bg-danger' : ($request['t_output_status'] == 'Request Completed' ? 'text-bg-primary' : ($request['t_output_status'] == 'Output Accepted' ? 'text-bg-primary' : 'text-bg-danger')))))));
    
                echo '
                    <tr class="text-center">
                    
                    <td class="align-middle ">' . ucwords(strtolower($request['user_fn'])) . " " . ucwords(strtolower($request['user_ln'])) . '</td>
                    <td class="align-middle  text-truncate" style="max-width: 100px;">' . $request['r_title'] . '</td>
                    <td class="align-middle  text-truncate" style="max-width: 100px;">' . $request['r_content'] . '</td>
                    <td class="align-middle ">' . $request['t_dateRequested'] .  '</td>
                    <td class="align-middle">
                    <p class=" ">
                    <span style="color:white !important;" class="badge rounded-pill ' . $statusCss . ' ">' . $statusText  . '</span>
                    </p>
                </td>
                <td class="align-middle">
                    <p class="text-center">
                    <span style="color:white !important;" class="badge rounded-pill ' . $statusRemarks . ' ">' . $request['t_output_status']  . '</span>
                    </p>
                </td>
                    <td>
                        <a href="' . PARENT_FOLDER . '/' . $data['userType'] . '/request/view?id=' . $request['r_id'] . '&type=POSTING">
                            <div class="d-flex justify-content-center"><button type="button" class="btn btn-outline-success action">View </button></div>
                        </a>
                    </td> 
                </tr>';
            }
        }
    }

    if ($type == "PIO") {

        if (empty($data['PIOdata'])) {
            echo '
            <tr>
                <td colspan="7" class="text-center">No PIO Service Request</td>
            </tr>
            ';
        } else {
            foreach ($data['PIOdata'] as $request) {
                $statusCss = ($request['t_status'] == 1 ? 'text-bg-primary' : ($request['t_status'] == 2 ? 'text-bg-success' : ($request['t_status'] == 3 ? 'text-bg-warning' : 'text-bg-danger')));
    
                $statusText = ($request['t_status'] == 1 ? 'Complete' : ($request['t_status'] == 2 ? 'Approved' : ($request['t_status'] == 3 ? 'Pending' :  ($request['t_status'] == 4 ? 'Cancelled' : 'Declined')))); //$duration = $request['r_durationStartDate'] == $request['r_durationEndDate'] ? $request['r_durationStartDate'] : $request['r_durationStartDate'] . ' - ' . $request['r_durationEndDate'];
                //$duration = $request['r_durationStartDate'] == $request['r_durationEndDate'] ? $request['r_durationStartDate'] : $request['r_durationStartDate'] . ' - ' . $request['r_durationEndDate'];
                $statusRemarks = ($request['t_output_status'] == 'No Output' ? 'text-bg-danger' : 
                ($request['t_output_status'] == 'For Admin Approval' ? 'text-bg-warning' : 
                ($request['t_output_status'] == 'Output for review' ? 'text-bg-warning' : 
                ($request['t_output_status'] == 'Output for revision' ? 'text-bg-warning' : 
                ($request['t_output_status'] == 'Request Has been Declined' ? 'text-bg-danger' : 
                ($request['t_output_status'] == 'Request Completed' ? 'text-bg-primary' : 
                ($request['t_output_status'] == 'Output Accepted' ? 'text-bg-primary' : ($request['t_output_status'] == 'Forced Completed' ? 'text-bg-primary' : 'text-bg-danger'))))))));
    
                echo '
                <tr class="text-center">
                <td class="align-middle ">' . $request['r_request_code'] . '</td>
                <td class="align-middle ">' . ucwords(strtolower($request['user_fn'])) . " " . ucwords(strtolower($request['user_ln'])) . '</td>
                        
                    <td class="align-middle  text-truncate" style="max-width: 100px;">' . $request['r_activityname'] . '</td>
                    <td class="align-middle ">' . $request['r_durationStartDate'] . ' - ' . $request['r_durationEndDate'] . '</td>
                    <td class="align-middle ">' . $request['t_dateRequested'] .  '</td>
                    <td class="align-middle">
                        <p class=" ">
                        <span style="color:white !important;" class="badge rounded-pill ' . $statusCss . ' ">' . $statusText  . '</span>
                        </p>
                    </td>
                    <td class="align-middle">
                        <p class="text-center">
                        <span style="color:white !important;" class="badge rounded-pill ' . $statusRemarks . ' ">' . $request['t_output_status']  . '</span>
                        </p>
                    </td>
                    
                    <td>
                        <a href="' . PARENT_FOLDER . '/' . $data['userType'] . '/request/view?id=' . $request['r_id'] . '&type=PIO">
                            <div class="d-flex justify-content-center"><button type="button" class="btn btn-outline-success action">View </button></div>
                        </a>
                    </td> 
                </tr>';
            }
        }
    }


    if ($type == "PENDING") {

        foreach ($data['pendingRequest'] as $request) {
            $statusCss = ($request['t_status'] == 1 ? 'text-bg-primary' : ($request['t_status'] == 2 ? 'text-bg-success' : ($request['t_status'] == 3 ? 'text-bg-warning' : 'text-bg-danger')));
            $statusText = ($request['t_status'] == 1 ? 'Complete' : ($request['t_status'] == 2 ? 'Approved' : ($request['t_status'] == 3 ? 'Pending' : 'Declined')));
            //$duration = $request['r_durationStartDate'] == $request['r_durationEndDate'] ? $request['r_durationStartDate'] : $request['r_durationStartDate'] . ' - ' . $request['r_durationEndDate'];

            $requestType = "";
            if ($request['t_r_type'] == "PHOTO") {
                $requestType = "Request for Copies of Photo";
            } elseif ($request['t_r_type'] == "POSTING") {
                $requestType = "Posting Approval";
            } else {
                $requestType = "PIO Service Request";
            }
            echo '
            <tr class="text-center">
            <td class="align-middle ">' . $requestType . '</td>
            <td class="align-middle ">' . ucwords(strtolower($request['user_fn'])) . " " . ucwords(strtolower($request['user_ln'])) . '</td>
     
            <td class="align-middle">' . $request['t_dateRequested'] . '</td>
          

            <td class="align-middle">
                    <p class=" ">
                    <span style="color:white !important;" class="badge rounded-pill ' . $statusCss . ' ">' . $statusText  . '</span>
                    </p>
                </td>
                <td class="align-middle">
                    <p class="text-center">
                    <span style="color:white !important;" class="badge rounded-pill ' . $statusCss . ' ">' . $request['t_output_status']  . '</span>
                    </p>
                </td>
                <td>
                    <a href="' . PARENT_FOLDER . '/' . $data['userType'] . '/request/view?id=' . $request['t_r_id'] . '&type=' . $request['t_r_type'] . '">
                        <div class="d-flex justify-content-center"><button type="button" class="btn btn-outline-success action">View </button></div>
                    </a>
                </td> 
            </tr>';
        }
    }
}
