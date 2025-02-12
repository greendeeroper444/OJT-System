<div class="container py-4">
    <div class="card shadow mb-4" style="border-radius: .5rem;overflow: hidden;">
        <div class="card-header text-start bg-primary d-flex align-items-center justify-content-md-start justify-content-lg-start justify-content-xl-start align-items-xl-center justify-content-center">
            <div class="text-dark d-flex d-sm-flex d-md-flex d-lg-flex align-items-md-center justify-content-lg-center fw-bold h6 mb-0"><i class="fas fa-qrcode fs-2" style="color: var(--bs-card-cap-bg);padding-right: .5rem;"></i><span class="text-center" style="font-size: 24px;font-family: Poppins, sans-serif;">
                    <span style="color: rgb(248, 249, 252); background-color: rgb(4, 105, 38);"><?php echo $data['request'][0]['r_request_code'] ?> </span>
                </span></div>
        </div>
        <div class="card-body">
            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-2 row-cols-xxl-2 ">
                <div class="col">
                    <div class="d-flex align-items-center p-3">
                        <div class="px-2"><small style="color: var(--bs-primary-text-emphasis);">Status</small>
                            <h6 class="mb-0 mt-1" style="font-size: 18px;">
                                <span style="text-decoration: underline; color: rgb(2, 42, 15);"><?php
                                                                                                    $statusCSS = (
                                                                                                        $data['request'][0]['t_status'] == 1 ? 'status-complete' : ($data['request'][0]['t_status'] == 2 ? 'status-approved' : ($data['request'][0]['t_status'] == 3 ? 'status-pending' : 'status-declined')));

                                                                                                    $statusText = (
                                                                                                        $data['request'][0]['t_status'] == 1 ? 'Complete' : ($data['request'][0]['t_status'] == 2 ? 'Approved' : ($data['request'][0]['t_status'] == 3 ? 'Pending' : ($data['request'][0]['t_status'] == 4 ? 'Canceled' : 'Decline'))));

                                                                                                    echo '<p class="' . $statusCSS . '">' . $statusText . '</p>'
                                                                                                    ?></span>
                            </h6>

                        </div>
                        <div class="px-2">
                            <?php

                            if ($data['request'][0]['t_output_status'] != '') {
                                echo '<small style="color: var(--bs-primary-text-emphasis);">Remarks</small>';

                                echo '      
                                                <h6 class="mb-0 mt-1" style="font-size: 18px;">
                                                
                                                    <span style="text-decoration: underline; color: rgb(2, 42, 15);">';
                                echo ($data['request'][0]['t_output_status'] == 'Output for review') ? '<p class="text-start" style="color:#cf8f10">' . $data['request'][0]['t_output_status'] . '</p>' : '';
                                echo ($data['request'][0]['t_output_status'] == 'Output for Revision') ? '<p class="text-start" style="color:red">' . $data['request'][0]['t_output_status'] . '</p>' : '';
                                echo ($data['request'][0]['t_output_status'] == 'Output Accepted') ? '<p class="text-start" style="color:#084F08">' . $data['request'][0]['t_output_status'] . '</p>' : '';
                                echo ($data['request'][0]['t_output_status'] == 'Request Completed') ? '<p class="text-start" style="color:#084F08">' . $data['request'][0]['t_output_status'] . '</p>' : '';
                                echo ($data['request'][0]['t_output_status'] == 'Request Has been Cancelled') ? '<p class="text-start" style="color:#bd2d2d">' . $data['request'][0]['t_output_status'] . '</p>' : '';
                                echo ($data['request'][0]['t_output_status'] == 'For Admin Approval') ? '<p class="text-start" style="color:#cf8f10">' . $data['request'][0]['t_output_status'] . '</p>' : '';
                                echo ($data['request'][0]['t_output_status'] == 'No Output') ? '<p class="text-start" style="color:#bd2d2d">' . $data['request'][0]['t_output_status'] . '</p>' : '';
                                echo ($data['request'][0]['t_output_status'] == 'Request Has been Declined') ? '<p class="text-start " style="color:#bd2d2d">' . $data['request'][0]['t_output_status'] . '</p>' : '';
                                echo ($data['request'][0]['t_output_status'] == 'Forced Completed') ? '<p class="text-start " style="color:#084F08">' . $data['request'][0]['t_output_status'] . '</p>' : '';

                                '</span>
                                                
                                                </h6>
                                            ';
                            }

                            ?>

                        </div>

                        <?php
                         if ($data['request'][0]['t_status'] == 1 || $data['request'][0]['t_status'] == 2) {
                            //Status Approved               
                            echo '
                            <a href="'. PARENT_FOLDER .'/request/requestform/generate?id='. $data['reqId'] . '&type=PIO" target="_blank">
                            <div class=""><button  type="button" class="btn btn-outline-success action">Generate Form</button></div>
                            </a> ';
                        }
                         
                        ?> 
                    </div>

                
                </div>
                
                <div class="col d-flex align-items-center justify-content-end">
                    <div class="btn-group d-flex align-items-center ">
                        <?php
                        if ($data['userType'] == 'client') {
                            if ($data['request'][0]['t_status'] != 1) {
                                //Status Approved               
                                echo '  
                                    <div class=""><button id="form-save-btn" type="submit" class="btn btn-outline-success action" style="display:none">Save</button></div>
                                    <div class=""><button id="form-edit-btn" type="button" class="btn btn-outline-succes action">Edit</button></div>            
                            
                                ';
                            }
                        }

                        if ($data['userType'] == 'admin') {

                            if ($data['request'][0]['t_status'] == 3) {
                     
                                echo '
                                            
                                <form action="' . PARENT_FOLDER . '/request/view/update/status" method="POST">
                                    <input type="hidden" name="type" value="PIO" >
                                    <input type="hidden" name="action" value="5">
                                    <input type="hidden" name="update" value="status">
                                    <input type="hidden" name="reqId" value="' . $data['reqId'] . '">
                                    <input type="hidden" id="declineDetails" name="declineDetails">
                                    <input type="hidden" name="pre-url" value="' . $_SERVER['REQUEST_URI'] . '">
                                    <div class=""><button id="form-decline-btn" type="button" class="btn btn-outline-danger action">Decline</button></div>          
                                </form>
                    
                                ';
                                
                            }

                            //Status Approved
                            if ($data['request'][0]['t_status'] == 2) {

                                if ($data['request'][0]['t_output_status'] == 'Output Accepted') {
                                    echo '
                                          
                                            <form action="' . PARENT_FOLDER . '/request/view/update/status" method="POST">
                                                <input type="hidden" name="type" value="PIO" >
                                                <input type="hidden" name="action" value="1">
                                                <input type="hidden" name="reqId" value="' . $data['reqId'] . '">
                                                <input type="hidden" name="pre-url" value="' . $_SERVER['REQUEST_URI'] . '">
                                                <input type="hidden" name="email" value="' . $data['request'][0]['user_email'] . '">

                                                    <input type="hidden" name="recipient" value="' .  $data['request'][0]['user_fn'] . " " .  $data['request'][0]['user_ln'] . '">
                                                <input type="hidden" name="eventName" value="' . $data['request'][0]['r_activityname'] . '">
                                                <input type="hidden" name="eventDuration" value="' . $data['request'][0]['r_duration'] . ' | ' . $data['request'][0]['r_durationStartTime'] . ' - ' . $data['request'][0]['r_durationEndTime'] . '">
                                                <input type="hidden" name="requestCreated" value="' . $data['request'][0]['t_dateRequested'] . '">    

                                                <div class=""><button  id="form-complete-btn"  type="button" class="btn btn-outline-success action">Complete</button></div> 
                                            </form> 
                                            ';
                                } else {
                                    echo '
                                            <form action="' . PARENT_FOLDER . '/request/view/update/admin-output" method="POST" enctype="multipart/form-data">
                                                <input type="hidden" name="type" value="PIO" >
                                                <input type="file" id="outputAttachment" name="adminAttachement[]" multiple hidden>
                                                <input type="hidden" id="outputDetails" name="adminDetails">
                                                <input type="hidden" name="reqId" value="' . $data['reqId'] . '">
                                                <input type="hidden" name="pre-url" value="' . $_SERVER['REQUEST_URI'] . '">
                                                <input type="hidden" name="email" value="' . $data['request'][0]['user_email'] . '">

                                                <input type="hidden" name="recipient" value="' .  $data['request'][0]['user_fn'] . " " .  $data['request'][0]['user_ln'] . '">
                                                <input type="hidden" name="eventName" value="' . $data['request'][0]['r_activityname'] . '">
                                                <input type="hidden" name="eventDuration" value="' . $data['request'][0]['r_duration'] . ' | ' . $data['request'][0]['r_durationStartTime'] . ' - ' . $data['request'][0]['r_durationEndTime'] . '">
                                                <input type="hidden" name="requestCreated" value="' . $data['request'][0]['t_dateRequested'] . '">    

                                                <div class=""><button id="add-output-btn" type="button" class="btn btn-outline-success action">Add Output</button></div> 
                                            </form> 
                                   
                                            ';
                                
                                echo '
                                    <form action="' . PARENT_FOLDER . '/request/view/update/status" method="POST">
                                        <input type="hidden" name="type" value="PIO" >
                                        <input type="hidden" name="action" value="1">
                                        <input type="hidden" name="reqId" value="' . $data['reqId'] . '">
                                        <input type="hidden" name="pre-url" value="' . $_SERVER['REQUEST_URI'] . '">
                                        <input type="hidden" name="email" value="' . $data['request'][0]['user_email'] . '">
                                        <input type="hidden" id="forceCompleteDetails" name="forceCompleteDetails">
                                        <input type="hidden" id="adminPassword" name="adminPassword">
                               
                                        <input type="hidden" name="recipient" value="' .  $data['request'][0]['user_fn'] . " " .  $data['request'][0]['user_ln'] . '">
                                        <input type="hidden" name="eventName" value="' . $data['request'][0]['r_activityname'] . '">
                                        <input type="hidden" name="eventDuration" value="' . $data['request'][0]['r_duration'] . ' | ' . $data['request'][0]['r_durationStartTime'] . ' - ' . $data['request'][0]['r_durationEndTime'] . '">
                                        <input type="hidden" name="requestCreated" value="' . $data['request'][0]['t_dateRequested'] . '">    

                                        <div class=""><button  id="form-force-complete-btn"  type="button" class="btn btn-outline-success action">Force Complete</button></div> 
                                    </form> 
                                    ';
                                }
                            }

                            //Status Pending
                            if ($data['request'][0]['t_status'] == 3) {
                                echo '
                                            <form action="' . PARENT_FOLDER . '/request/view/update/status" method="POST">
                                                <input type="hidden" name="type" value="PIO" >
                                                <input type="hidden" name="action" value="2">
                                                <input type="hidden" name="reqId" value="' . $data['reqId'] . '">
                                                <input type="hidden" name="email" value="' . $data['request'][0]['user_email'] . '">
                                                <input type="hidden" name="pre-url" value="' . $_SERVER['REQUEST_URI'] . '">
                                                
                                                <input type="hidden" name="recipient" value="' .  $data['request'][0]['user_fn'] . " " .  $data['request'][0]['user_ln'] . '">
                                                <input type="hidden" name="eventName" value="' . $data['request'][0]['r_activityname'] . '">
                                                <input type="hidden" name="eventDuration" value="' . $data['request'][0]['r_duration'] . ' | ' . $data['request'][0]['r_durationStartTime'] . ' - ' . $data['request'][0]['r_durationEndTime'] . '">
                                                <input type="hidden" name="requestCreated" value="' . $data['request'][0]['t_dateRequested'] . '">       

                                                <div class=""><button id="form-approve-btn" type="button" class="btn btn-outline-success action">Approve Request</button></div>                       
                                            </form>
                                            ';
                            }
                        }
                        ?>

                    </div>
                </div>
            
                <?php
                   
                        if ($data['request'][0]['t_status'] == 5) {             
                            echo '
                        <div class="col" style="width: 100%;">
                                <div class="d-flex flex-column p-3 mx-4 border" >
                                            <div class="px-2"><b>Reason</b></div>
                                        <div class="px-2 w-100">
                                        '.$data['request'][0]['t_declineDetails'] .'
                                        </div>
                                        </div>
                                </div>
                            ';
                        }


                        if (($data['request'][0]['t_output_status'] == 'Forced Completed')) {             
                            echo '
                        <div class="col" style="width: 100%;">
                                <div class="d-flex flex-column p-3 mx-4 border" >
                                            <div class="px-2"><b>Reason</b></div>
                                        <div class="px-2 w-100">
                                        '.$data['request'][0]['t_forceCompleteDetails'] .'
                                        </div>
                                        </div>
                                </div>
                            ';
                        }
                    
                ?>       
                            

            </div>


            <div class="col">
                <div class="d-flex align-items-center p-3">
                    <i class="fas fa-ellipsis-v fa-2x" style="color: var(--bs-primary);padding-right: .5rem;"></i>
                    <div class="px-2" style="width: 100%;">
                        <small>Event&nbsp;</small>
                        <h6 class="mb-0 mt-1">

                            <h4 contenteditable="false" class="editable titleEditable">
                                <input type="text" class="w-100" style="color: var(--bs-primary-text-emphasis); font-weight:bold;" name="activity-name" value="<?php echo $data['request'][0]['r_activityname'] ?>">

                            </h4>

                        </h6>
                    </div>
                </div>
            </div>



            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3">
                <div class="col">
                    <div class="d-flex align-items-center p-3"><i class="fas fa-calendar fa-2x" style="color: var(--bs-primary);padding-right: .5rem;"></i>
                        <div class="px-2"><small>Date of the Event&nbsp;</small>
                            <h6 class="mb-0 mt-1">
                                <span class="date-time" onbeforeinput="return false" style="color: rgb(2, 42, 15);">
                                    <!-- <div class="date-time" onbeforeinput="return false">
                                        <h6 id="date-view-page" class=" editable" contenteditable="false"><?php echo $data['request'][0]['r_duration'] . ' | ' . $data['request'][0]['r_durationStartTime'] . ' - ' . $data['request'][0]['r_durationEndTime'] ?></h6>
                                        <input readonly type="text" class=" " id="activity-Duration-viewpage" name="activity-Duration-viewpage" placeholder="" value="<?php echo $data['request'][0]['dateOrinalValue'] ?>">
                                    </div> -->
                                    <div class="date-time" onbeforeinput="return false">
                                        <h6 id="date-view-page" class="editable" contenteditable="false">
                                            <?php 
                                                if (!empty($data['request'][0]['r_durationStart']) && !empty($data['request'][0]['r_durationEnd'])) {
                                                    $formattedStart = date('F j, Y, h:i A', $data['request'][0]['r_durationStart']); 
                                                    $formattedEnd = date('F j, Y, h:i A', $data['request'][0]['r_durationEnd']); 
                                                    echo $formattedStart . ' - ' . $formattedEnd;
                                                } else {
                                                    echo '_________________________';
                                                }
                                            ?>
                                        </h6>
                                        <input readonly type="text" id="activity-Duration-viewpage" name="activity-Duration-viewpage" 
                                            placeholder="" value="<?php echo $data['request'][0]['dateOrinalValue'] ?>">
                                    </div>

                                </span>
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex align-items-center p-3"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-calendar-date-fill fs-2" style="color: var(--bs-primary);">
                            <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4zm5.402 9.746c.625 0 1.184-.484 1.184-1.18 0-.832-.527-1.23-1.16-1.23-.586 0-1.168.387-1.168 1.21 0 .817.543 1.2 1.144 1.2z"></path>
                            <path d="M16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2m-6.664-1.21c-1.11 0-1.656-.767-1.703-1.407h.683c.043.37.387.82 1.051.82.844 0 1.301-.848 1.305-2.164h-.027c-.153.414-.637.79-1.383.79-.852 0-1.676-.61-1.676-1.77 0-1.137.871-1.809 1.797-1.809 1.172 0 1.953.734 1.953 2.668 0 1.805-.742 2.871-2 2.871zm-2.89-5.435v5.332h6.77V8.079h-.012c-.29.156-.883.52-1.258.777V8.16a12.6 12.6 0 0 1 1.313-.805h.632z"></path>
                        </svg>
                        <div class="px-2"><small style="color: var(--bs-primary-text-emphasis);">Date Requested</small>
                            <h6 class="mb-0 mt-1" style="font-family: Poppins, sans-serif;color: var(--bs-emphasis-color);"><?php echo ($data['request'][0]['t_dateRequested'] != null) ? $data['request'][0]['t_dateRequested'] : '----------' ?></h6>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex align-items-center p-3"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-calendar-plus-fill fs-2" style="color: var(--bs-primary);">
                            <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2M8.5 8.5V10H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V11H6a.5.5 0 0 1 0-1h1.5V8.5a.5.5 0 0 1 1 0"></path>
                        </svg>
                        <div class="px-2"><small style="color: var(--bs-primary-text-emphasis);">Last Date Modified</small>
                            <h6 class="mb-0 mt-1" style="font-family: Poppins, sans-serif;color: var(--bs-emphasis-color);"><?php echo ($data['request'][0]['t_dateModified'] != null) ? $data['request'][0]['t_dateModified'] : '----------' ?></h6>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex align-items-center p-3"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-calendar-check-fill fs-2" style="color: var(--bs-primary);">
                            <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2m-5.146-5.146-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708.708z"></path>
                        </svg>
                        <div class="px-2"><small style="color: var(--bs-primary-text-emphasis);">Date
                                Completed</small>
                            <h6 class="mb-0 mt-1" style="font-family: Poppins, sans-serif;color: var(--bs-emphasis-color);"><?php echo ($data['request'][0]['t_datecompleted'] != null) ? $data['request'][0]['t_datecompleted'] : '----------' ?></h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3">
                <div class="col">
                    <div class="d-flex align-items-center p-3"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-house-door-fill fs-2" style="color: var(--bs-primary);">
                            <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5"></path>
                        </svg>
                        <div class="px-2"><small style="color: var(--bs-primary-text-emphasis);">Venue</small>
                            <h6 class="mb-0 mt-1" style="font-family: Poppins, sans-serif;color: var(--bs-emphasis-color);">
                                <ul contenteditable="false" class="custom-list editable">
                                    <li class="no-style">
                                        <input type="text" name="activity-venue" value="<?php echo $data['request'][0]['r_venue'] ?>">
                                    </li>
                                </ul>
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex align-items-center p-3"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-person-fill fs-2" style="color: var(--bs-primary);">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"></path>
                        </svg>
                        <div class="px-2"><small style="color: var(--bs-primary-text-emphasis);">Participants</small>
                            <h6 class="mb-0 mt-1" style="font-family: Poppins, sans-serif;color: var(--bs-emphasis-color);">
                                <ul contenteditable="false" class="custom-list editable">
                                    <li class="no-style"><input type="text" name="activity-participants" value="<?php echo $data['request'][0]['r_participants'] ?>"></li>
                                </ul>
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex align-items-center p-3"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-mic-fill fs-2" style="color: var(--bs-primary);">
                            <path d="M5 3a3 3 0 0 1 6 0v5a3 3 0 0 1-6 0z"></path>
                            <path d="M3.5 6.5A.5.5 0 0 1 4 7v1a4 4 0 0 0 8 0V7a.5.5 0 0 1 1 0v1a5 5 0 0 1-4.5 4.975V15h3a.5.5 0 0 1 0 1h-7a.5.5 0 0 1 0-1h3v-2.025A5 5 0 0 1 3 8V7a.5.5 0 0 1 .5-.5"></path>
                        </svg>
                        <div class="px-2"><small style="color: var(--bs-primary-text-emphasis);">Resource Speaker/Key Official</small>
                            <h6 class="mb-0 mt-1" style="font-family: Poppins, sans-serif;color: var(--bs-emphasis-color);">
                                <ul contenteditable="false" class="custom-list editable">
                                    <li class="no-style"><input type="text" name="activity-officials" value="<?php echo $data['request'][0]['r_keyofficials'] ?>"></li>
                                </ul>
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex align-items-center p-3"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-file-check-fill fs-2" style="color: var(--bs-primary);">
                            <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2m-1.146 6.854-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708.708z"></path>
                        </svg>
                        <div class="px-2"><small style="color: var(--bs-primary-text-emphasis);">Highlights</small>
                            <h6 class="mb-0 mt-1" style="font-family: Poppins, sans-serif;color: var(--bs-emphasis-color);">
                                <ul contenteditable="false" class="custom-list editable">
                                    <li class="no-style"><input type="text" name="activity-highlights" value="<?php echo $data['request'][0]['r_highlights'] ?>"></li>
                                </ul>
                            </h6>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="d-flex align-items-center p-3"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-person-fill fs-2" style="color: var(--bs-primary);">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"></path>
                        </svg>
                        <div class="px-2"><small style="color: var(--bs-primary-text-emphasis);">Requestor</small>
                            <h6 class="mb-0 mt-1" style="font-family: Poppins, sans-serif;color: var(--bs-emphasis-color);">
                                <?php echo $data['request'][0]['user_fn'] . " " . $data['request'][0]['user_ln'] ?>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col p-2">
                <div class="card">
                    <div id="services-requested-collection" class="card-body p-4">
                        <div class="d-flex align-items-center align-items-sm-center align-items-md-center align-items-lg-center align-items-xl-center align-items-xxl-center"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-pencil-fill fs-2" style="color: var(--bs-primary);">
                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"></path>
                            </svg>
                            <h4 style="font-family: Poppins, sans-serif;color: var(--bs-emphasis-color);margin-left: .5rem;">Service Requested</h4>
                        </div>
                        <ul style="color: var(--bs-primary-text-emphasis);">
                            <ul contenteditable="false" class="custom-list collection-hide">
                                <?php foreach (json_decode($data['request'][0]['r_services']) as $services) {
                                    echo "<li>" . $services . "</li>";
                                } ?>
                            </ul>
                            <div class=" collection-input" style="display:none">


                                <div>
                                    <input type="checkbox" class="custom-control-input" id="on-site" name="services[]" value="On-site Documentation">
                                    <label class="custom-control-label" for="on-site">
                                        On-site Documentation
                                    </label>
                                </div>
                                <div>
                                    <input type="checkbox" class="custom-control-input" id="article" name="services[]" value="Article Drafting">
                                    <label class="custom-control-label" for="article">
                                        Article Drafting
                                    </label>
                                </div>
                                <div>
                                    <input type="checkbox" class="custom-control-input" id="graphics" name="services[]" value="Graphics and Content Design">
                                    <label class="custom-control-label" for="graphics">
                                        Graphics and Content Design
                                    </label>
                                </div>
                                <div>
                                    <input type="checkbox" class="custom-control-input" id="website" name="services[]" value="Content Updating on the College Website">
                                    <label class="custom-control-label" for="website">
                                        Content Updating on the College Website
                                    </label>
                                </div>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col p-2">
                <div class="card">
                    <div id="platform-requested-collection" class="card-body p-4">
                        <div class="d-flex align-items-center align-items-sm-center align-items-md-center align-items-lg-center align-items-xl-center align-items-xxl-center"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-laptop-fill fs-2" style="color: var(--bs-primary);">
                                <path d="M2.5 2A1.5 1.5 0 0 0 1 3.5V12h14V3.5A1.5 1.5 0 0 0 13.5 2zM0 12.5h16a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 12.5"></path>
                            </svg>
                            <h4 style="font-family: Poppins, sans-serif;color: var(--bs-emphasis-color);margin-left: .5rem;">Preferred Platform/s</h4>
                        </div>
                        <ul style="color: var(--bs-primary-text-emphasis);">
                            <ul contenteditable="false" class="custom-list collection-hide">
                                <?php foreach (json_decode($data['request'][0]['r_platforms']) as $platforms) {
                                    echo "<li>" . $platforms . "</li>";
                                } ?>
                            </ul>
                            <div class="collection-input" style="display:none">
                                <div>
                                    <input type="checkbox" class="custom-control-input" id="college-website" name="platforms[]" value="College Website: dnsc.edu.ph">
                                    <label class="custom-control-label" for="college-website">
                                        College Website: dnsc.edu.ph
                                    </label>
                                </div>
                                <div>
                                    <input type="checkbox" class="custom-control-input" id="fb" name="platforms[]" value="Facebook: @officialDNSC">
                                    <label class="custom-control-label" for="fb">
                                        Facebook: @officialDNSC
                                    </label>
                                </div>
                                <div>
                                    <input type="checkbox" class="custom-control-input" id="fb" name="platforms[]" value="Instagram: @officialDNSC">
                                    <label class="custom-control-label" for="fb">
                                        Instagram: @officialDNSC
                                    </label>
                                </div>
                                <div>
                                    <input type="checkbox" class="custom-control-input" id="twitter" name="platforms[]" value="Twitter: @officialDNSC">
                                    <label class="custom-control-label" for="twitter">
                                        Twitter: @officialDNSC
                                    </label>
                                </div>
                                <div>
                                    <input type="checkbox" class="custom-control-input" id="yt" name="platforms[]" value="Youtube: @officialDNSC">
                                    <label class="custom-control-label" for="yt">
                                        Youtube: @officialDNSC
                                    </label>
                                </div>
                                <div>
                                    <input type="checkbox" class="custom-control-input" id="email" name="platforms[]" value="Email Blasting: pio@dnsc.edu.ph">
                                    <label class="custom-control-label" for="email">
                                        Email Blasting: pio@dnsc.edu.ph
                                    </label>
                                </div>
                                <div>
                                    <input type="checkbox" class="custom-control-input" id="entryway" name="platforms[]" value="College Entryway LED Board">
                                    <label class="custom-control-label" for="entryway">
                                        College Entryway LED Board
                                    </label>
                                </div>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col p-2">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center align-items-sm-center align-items-md-center align-items-lg-center align-items-xl-center align-items-xxl-start"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-plus-lg fs-2" style="font-family: Poppins, sans-serif;color: var(--bs-primary);">
                                <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h6a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h6v-5A.5.5 0 0 1 8 2"></path>
                            </svg>
                            <h4 style="font-family: Poppins, sans-serif;color: var(--bs-emphasis-color);margin-left: .5rem;">Contribution</h4>
                        </div>
                        <ul style="color: var(--bs-primary-text-emphasis);">
                            <li>
                                <div class=" mb-4">
                                    <!-- Render File Uploaded by client-->
                                    <?php
                                    if (json_decode($data['request'][0]['r_attachements'] != null)) {
                                        foreach (json_decode($data['request'][0]['r_attachements']) as $attachement) {
                                            $file =  $attachement;
                                            $attachement = explode("$-$-$", $attachement);
                                            $getExtention = explode('.', $attachement[1]);
                                            $fileIcon = ($getExtention[1] == 'pdf') ? 'bi-file-pdf-fill' : 'bi-file-earmark-word-fill';
                                            echo "
                                                    <a href='" . PARENT_FOLDER . '/public/storage/files/' . $file . "?fileDownload=1' download>
                                                    <button id='' type='button' class='btn  file mb-4'>
                                                        <i class='bi " . $fileIcon . " fs-4' style='margin-right:5px'></i>" . $attachement[1] . "
                                                    </button>
                                                    
                                                    </a>";
                                        }
                                    }
                                    ?>
                                    <!--------------------------->
                                </div>
                                <!-- <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile" name="attachement[]" style="display:none" multiple>
                                        </div> -->
                            </li>
                        </ul>

                        <div id="customFile" class="custom-file" style="display:none">

                            <div id="theWidget1" class="dnd-file-upload-widget">
                                <div class="form-group drop_zone">
                                    <span>Drag files here to attach</span>
                                    <span>or</span>
                                    <label class="btn btn-outline-success pb-2">
                                        Select files
                                        <input id="attachement" name="attachement[]" type="file" multiple="" />
                                    </label>
                                </div>

                                <div class="files-container"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="col p-2">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center align-items-sm-center align-items-md-center align-items-lg-center align-items-xl-center align-items-xxl-start"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-check-lg fs-2" style="font-family: Poppins, sans-serif;color: var(--bs-primary);">
                                <path d="M6.354 5.5H4a3 3 0 0 0 0 6h3a3 3 0 0 0 2.83-4H9q-.13 0-.25.031A2 2 0 0 1 7 10.5H4a2 2 0 1 1 0-4h1.535c.218-.376.495-.714.82-1z" />
                                <path d="M9 5.5a3 3 0 0 0-2.83 4h1.098A2 2 0 0 1 9 6.5h3a2 2 0 1 1 0 4h-1.535a4 4 0 0 1-.82 1H12a3 3 0 1 0 0-6z" />
                            </svg>

                            <h4 style="font-family: Poppins, sans-serif;color: var(--bs-emphasis-color);margin-left: .5rem; margin-bottom:.5rem;">Links</h4>
                        </div>

                        <ul style="color: var(--bs-primary-text-emphasis);">
                            <li>
                                <a href="<?php echo str_replace('"', "", $data['request'][0]['r_additionalInfo']); ?>" target="_blank" class='btn file mb-4'>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-link" viewBox="0 0 16 16">
                                        <path d="M6.354 5.5H4a3 3 0 0 0 0 6h3a3 3 0 0 0 2.83-4H9q-.13 0-.25.031A2 2 0 0 1 7 10.5H4a2 2 0 1 1 0-4h1.535c.218-.376.495-.714.82-1z" />
                                        <path d="M9 5.5a3 3 0 0 0-2.83 4h1.098A2 2 0 0 1 9 6.5h3a2 2 0 1 1 0 4h-1.535a4 4 0 0 1-.82 1H12a3 3 0 1 0 0-6z" />
                                    </svg>
                                    <?php echo str_replace('"', "", $data['request'][0]['r_additionalInfo']) ?>
                                </a>
                                <textarea <?php echo ($data['userType'] == 'admin') ? "readonly" : ""; ?> name="additional-info" id="" cols="30" rows="3" style="width:100%;text-align:start; padding:10px;border:none;display:none"><?php echo $data['request'][0]['r_additionalInfo'] ?></textarea>
                            </li>
                        </ul>

                    </div>

                </div>
            </div> -->
            <div class="col p-2">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="text-start d-flex align-items-center align-items-sm-center align-items-md-center align-items-lg-center align-items-xl-center align-items-xxl-start"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-plus-square-dotted fs-2" style="font-family: Poppins, sans-serif;color: var(--bs-primary);">
                                <path d="M2.5 0c-.166 0-.33.016-.487.048l.194.98A1.51 1.51 0 0 1 2.5 1h.458V0zm2.292 0h-.917v1h.917zm1.833 0h-.917v1h.917zm1.833 0h-.916v1h.916zm1.834 0h-.917v1h.917zm1.833 0h-.917v1h.917zM13.5 0h-.458v1h.458c.1 0 .199.01.293.029l.194-.981A2.51 2.51 0 0 0 13.5 0m2.079 1.11a2.511 2.511 0 0 0-.69-.689l-.556.831c.164.11.305.251.415.415l.83-.556zM1.11.421a2.511 2.511 0 0 0-.689.69l.831.556c.11-.164.251-.305.415-.415L1.11.422zM16 2.5c0-.166-.016-.33-.048-.487l-.98.194c.018.094.028.192.028.293v.458h1zM.048 2.013A2.51 2.51 0 0 0 0 2.5v.458h1V2.5c0-.1.01-.199.029-.293l-.981-.194zM0 3.875v.917h1v-.917zm16 .917v-.917h-1v.917zM0 5.708v.917h1v-.917zm16 .917v-.917h-1v.917zM0 7.542v.916h1v-.916zm15 .916h1v-.916h-1zM0 9.375v.917h1v-.917zm16 .917v-.917h-1v.917zm-16 .916v.917h1v-.917zm16 .917v-.917h-1v.917zm-16 .917v.458c0 .166.016.33.048.487l.98-.194A1.51 1.51 0 0 1 1 13.5v-.458zm16 .458v-.458h-1v.458c0 .1-.01.199-.029.293l.981.194c.032-.158.048-.32.048-.487M.421 14.89c.183.272.417.506.69.689l.556-.831a1.51 1.51 0 0 1-.415-.415l-.83.556zm14.469.689c.272-.183.506-.417.689-.69l-.831-.556c-.11.164-.251.305-.415.415l.556.83zm-12.877.373c.158.032.32.048.487.048h.458v-1H2.5c-.1 0-.199-.01-.293-.029zM13.5 16c.166 0 .33-.016.487-.048l-.194-.98A1.51 1.51 0 0 1 13.5 15h-.458v1zm-9.625 0h.917v-1h-.917zm1.833 0h.917v-1h-.917zm1.834-1v1h.916v-1zm1.833 1h.917v-1h-.917zm1.833 0h.917v-1h-.917zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"></path>
                            </svg>
                            <h4 style="font-family: Poppins, sans-serif;color: var(--bs-emphasis-color);margin-left: .5rem;">Additional Information</h4>
                        </div>
                        <ul style="color: var(--bs-primary-text-emphasis);">
                            <li><textarea name="additional-info" id="" cols="30" rows="3" style="width:100%;text-align:start; padding:10px;border:none;"><?php echo $data['request'][0]['r_additionalInfo'] ?></textarea></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col p-2">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center align-items-sm-center align-items-md-center align-items-lg-center align-items-xl-center align-items-xxl-start"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-check-lg fs-2" style="font-family: Poppins, sans-serif;color: var(--bs-primary);">
                                <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022"></path>
                            </svg>
                            <h4 style="font-family: Poppins, sans-serif;color: var(--bs-emphasis-color);margin-left: .5rem; margin-bottom:.5rem;">Output</h4>
                        </div>


                        <div class=" border-start-primary py-2" style="border-radius: 19.6px;">
                            <div class="card-body">
                                <!-- <button id="" type="button" class="btn  file mb-4">
                                            <i class="bi bi-file-pdf-fill fs-4" style='margin-right:5px'></i>Files.pdf
                                        </button> -->
                                <div class="row align-items-center no-gutters">
                                    <div class="col me-2">
                                        <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span style="font-weight: bold;color: rgb(0,0,0);">Comments</span></div>
                                        <hr>

                                        <?php
                                        if (!empty($data['request'][0]['t_messageResponse'])) {
                                            $messages = json_decode($data['request'][0]['t_messageResponse'], true);

                                            if ($messages !== null && is_array($messages)) {

                                                foreach ($messages['conversation'] as $message) {
                                                    echo '
                                                                        <span class="timedate">' . date("M d,Y h:i:s A", $message['time']). '</span>
                                                                <div class="text-dark fw-bold mb-0">
                                                                    <span style="font-weight: bold;color: rgb(0,0,0);">
                                                                        ' . $message['identifier'] . ': 
                                                                    </span>
                                                                    <span style="font-size: 14;">
                                                                        <span style="font-weight: normal !important; color: rgb(0, 0, 0);">&nbsp;
                                                                            ' . $message['text'] . '
                                                                        </span>
                                                                        <br><br>';

                                                    // Check if the message has an attachment
                                                    if (isset($message['attachement'])) {
                                                        $attachments = json_decode($message['attachement'], true);


                                                        foreach ($attachments as $attachment) {

                                                            $file = explode("$-$-$", $attachment);
                                                            $getExtention = explode('.', $file[1]);

                                                        
                                                            $fileIcon = ($getExtention[1] == 'pdf') ? 'bi-file-pdf-fill' : 'bi-file-earmark-word-fill';

                                                            echo '
                                                                            <a href="' . PARENT_FOLDER . '/public/storage/files/' . $attachment . '?fileDownload=1" download>
                                                                            <button id="" type="button" class="btn  file mb-4">
                                                                                <i class="bi ' . $fileIcon . ' fs-4" style="margin-right:5px"></i>' . $file[1] . '
                                                                            </button>
                                                                            </a>';
                                                        }
                                                    }
                                                    echo '
                                                                        <hr>
                                                                    </div>';
                                                }
                                            }


                                            if ($data['userType'] == 'client') {

                                                if ($data['request'][0]['t_status'] == 2 and $data['request'][0]['t_output_status'] == "Output for review") {
                                                    echo '
                                                                    <div class="d-flex justify-content-end">
                                                                        <form action="' . PARENT_FOLDER . '/request/view/update/accept-request" method="POST">
                                                                            <input type="hidden" name="type" value="PIO" >
                                                                            <input type="hidden" name="reqId" value="' . $data['reqId'] . '">
                                                                            <input type="hidden" name="pre-url" value="' . $_SERVER['REQUEST_URI'] . '">

                                                                            <input type="hidden" name="email" value="' . $data['request'][0]['user_email'] . '">
                                                                            <input type="hidden" name="pre-url" value="' . $_SERVER['REQUEST_URI'] . '">
                                                                            
                                                                            <input type="hidden" name="recipient" value="' .  $data['request'][0]['user_fn'] . " " .  $data['request'][0]['user_ln'] . '">
                                                                            <input type="hidden" name="eventName" value="' . $data['request'][0]['r_activityname'] . '">
                                                                            <input type="hidden" name="eventDuration" value="' . $data['request'][0]['r_duration'] . ' | ' . $data['request'][0]['r_durationStartTime'] . ' - ' . $data['request'][0]['r_durationEndTime'] . '">
                                                                            <input type="hidden" name="requestCreated" value="' . $data['request'][0]['t_dateRequested'] . '">       
                            
                                                                            <div class=""><button id="form-accept-btn" type="button" class="btn btn-outline-succes action">Accept</button></div>          
                                                                       
                                                                            </form>
                                                                        <form action="' . PARENT_FOLDER . '/request/view/update/revision-request" method="POST">
                                                                            <input type="hidden" name="type" value="PIO" >
                                                                            <input type="hidden" id="revisionDetails" name="revisionDetails">
                                                                            <input type="hidden" name="reqId" value="' . $data['reqId'] . '">
                                                                            <input type="hidden" name="pre-url" value="' . $_SERVER['REQUEST_URI'] . '">
                                                                            

                                                                            <input type="hidden" name="email" value="' . $data['request'][0]['user_email'] . '">
                                                                            <input type="hidden" name="pre-url" value="' . $_SERVER['REQUEST_URI'] . '">
                                                                            
                                                                            <input type="hidden" name="recipient" value="' .  $data['request'][0]['user_fn'] . " " .  $data['request'][0]['user_ln'] . '">
                                                                            <input type="hidden" name="eventName" value="' . $data['request'][0]['r_activityname'] . '">
                                                                            <input type="hidden" name="eventDuration" value="' . $data['request'][0]['r_duration'] . ' | ' . $data['request'][0]['r_durationStartTime'] . ' - ' . $data['request'][0]['r_durationEndTime'] . '">
                                                                            <input type="hidden" name="requestCreated" value="' . $data['request'][0]['t_dateRequested'] . '">       
                            
                                                                            <div class=""><button id="form-revise-btn" type="button" class="btn btn-outline-succes action">Revise</button></div>          
                                                                        </form>
                                                                    </div>
                                                            
                                                                ';
                                                }
                                            }
                                        }
                                        ?>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="d-flex justify-content-end">
                <?php

                if ($data['userType'] == 'client') {


                    if ($data['request'][0]['t_status'] == 2 || $data['request'][0]['t_status'] == 3) {
                        echo '
                                   
                        <form action="' . PARENT_FOLDER . '/request/view/update/status" method="POST">
                            <input type="hidden" name="type" value="PIO" >
                            <input type="hidden" name="action" value="4">
                            <input type="hidden" name="update" value="status">
                            <input type="hidden" name="reqId" value="' . $data['reqId'] . '">
                            <input type="hidden" name="pre-url" value="' . $_SERVER['REQUEST_URI'] . '">
                            <div class=""><button id="form-cancel-btn" type="button" class="btn btn-outline-danger ">Cancel Request</button></div>          
                        </form>
         
                        ';
                    }
                }
                ?>
            </div>-
        </div>
    </div>
</div>




<script src="<?php echo PARENT_FOLDER ?>/public/js/editRequestPIO.js"></script>
<form id="editForm" action="<?php echo  PARENT_FOLDER . '/request/view/update?type=PIO&id=' . $data['reqId'] ?>" method="POST" enctype="multipart/form-data" hidden>
    <input type="hidden" name="pre-url" value="<?php echo  $_SERVER['REQUEST_URI'] ?>">

    <input type="text" name="oldEventName" value="<?php echo $data['request'][0]['r_activityname'] ?>" hidden>
    <input type="text" name="oldDate" value="<?php echo $data['request'][0]['dateOrinalValue'] ?>" hidden>
    <input type="text" name="recipient" value="<?php echo $data['request'][0]['user_fn'] . " " .  $data['request'][0]['user_ln']  ?>" hidden>
    <input type="text" name="eventDuration" value="<?php echo $data['request'][0]['r_duration'] . ' | ' . $data['request'][0]['r_durationStartTime'] . ' - ' . $data['request'][0]['r_durationEndTime']  ?>" hidden>
    <input type="text" name="email" value="<?php echo $data['request'][0]['user_email'] ?>" hidden>

</form>

<script>
    const requestBtn = document.querySelector('#requestOutput')

    requestBtn && requestBtn.addEventListener('click', sendRequest);

    function sendRequest() {
        Swal.fire({
            title: "Request Output?",
            // text: "You won't be able to revert this!",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#0B790B",
            cancelButtonColor: "#d33",
            confirmButtonText: "Send Request"
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Request Send!",
                    // text: "Your file has been deleted.",
                    confirmButtonColor: "#0B790B",
                    icon: "success",
                });
            }
        });
    }
</script>


<?php

if (isset($_SESSION['page_error_form'])) {
   
    echo "
            <script> 
                Swal.fire({
                    text: '".$_SESSION['page_error_form']."',
                    icon: 'error',
                    confirmButtonColor: '#0B790B',
                    confirmButtonText: 'Ok'
                })
            </script>
            ";
}
unset($_SESSION['page_error_form']);
?>


<?php
    if ($data['userType'] == 'client') {
        if ($data['request'][0]['t_status'] == 5) {             
            echo "
            <script> 
                Swal.fire({
                    text: 'Request Has been decline',
       
                    icon: 'error',
                    confirmButtonColor: '#0B790B',
                    confirmButtonText: 'Ok'
                })
            </script>
            ";
        }
    }
?>