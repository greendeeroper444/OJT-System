<div class="container py-4">
    <div class="card shadow mb-4" style="border-radius: .5rem;overflow: hidden;">
        <div class="card-header text-start bg-primary d-flex align-items-center justify-content-md-start justify-content-lg-start justify-content-xl-start align-items-xl-center justify-content-center">
            <div class="text-dark d-flex d-sm-flex d-md-flex d-lg-flex align-items-md-center justify-content-lg-center fw-bold h6 mb-0"><span class="text-center" style="font-size: 24px;font-family: Poppins, sans-serif;"><span style="color: rgb(248, 249, 252); background-color: rgb(4, 105, 38);">Posting Information</span></span></div>
        </div>
        <div class="card-body">
            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-2 row-cols-xxl-2">
                <div class="col">
                    <div class="d-flex align-items-center p-3">
                        <div class="px-2"><small style="color: var(--bs-primary-text-emphasis);">Status</small>
                            <h6 class="mb-0 mt-1" style="font-size: 18px;"><strong><span style="text-decoration: underline; color: rgb(2, 42, 15);"><?php
                                                                                                                                                    $statusCSS = (
                                                                                                                                                        $data['request'][0]['t_status'] == 1 ? 'status-complete' : ($data['request'][0]['t_status'] == 2 ? 'status-approved' : ($data['request'][0]['t_status'] == 3 ? 'status-pending' : 'status-declined')));

                                                                                                                                                    $statusText = (
                                                                                                                                                        $data['request'][0]['t_status'] == 1 ? 'Complete' : ($data['request'][0]['t_status'] == 2 ? 'Approved' : ($data['request'][0]['t_status'] == 3 ? 'Pending' : 'Declined')));

                                                                                                                                                    echo '<p class="' . $statusCSS . '">' . $statusText . '</p>'
                                                                                                                                                    ?></span></strong></h6>

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

                                '</span>
                                                
                                                </h6>
                                            ';
                            }

                            ?>
                        </div>
                    </div>

                </div>
                <div class="col d-flex align-items-center justify-content-end">
                    <div class="btn-group d-flex align-items-center ">
                        <?php
                        if ($data['userType'] == 'client') {


                            if ($data['request'][0]['t_output_status'] == 'Output for Revision') {
                                echo '
                                    <form action="' . PARENT_FOLDER . '/request/view/update/client-output" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="type" value="POSTING" >
                                        <input type="file" id="outputAttachment" name="attachement[]" multiple hidden>
                                        <input type="hidden" id="outputDetails" name="details">
                                        <input type="hidden" name="reqId" value="' . $data['reqId'] . '">
                                        <input type="hidden" name="pre-url" value="' . $_SERVER['REQUEST_URI'] . '">
                                        <input type="hidden" name="email" value="' . $data['request'][0]['user_email'] . '">

                                                 
                                        <input type="hidden" name="email" value="' . $data['request'][0]['user_email'] . '">
                                        <input type="hidden" name="pre-url" value="' . $_SERVER['REQUEST_URI'] . '">
                                        
                                        <input type="hidden" name="recipient" value="' .  $data['request'][0]['user_fn'] . " " .  $data['request'][0]['user_ln'] . '">
                                        <input type="hidden" name="title" value="' . $data['request'][0]['r_title'] . '">
                                        <input type="hidden" name="requestCreated" value="' . $data['request'][0]['t_dateRequested'] . '">       

               
                                        <div class=""><button id="revise-output-btn" type="button" class="btn btn-outline-success action">Revise Output</button></div> 
                                    </form> 
                        
                                ';
                            }
                               
                            if ($data['request'][0]['t_status'] != 1){
                                //Status Approved               
                                    echo '  
                                    <div class=""><button id="form-save-btn" type="submit" class="btn btn-outline-success action" style="display:none">Save</button></div>
                                    <div class=""><button id="form-edit-btn" type="button" class="btn btn-outline-succes action">Edit</button></div>            
                            
                                ';
                            }



                    
                        }

                        if ($data['userType'] == 'admin') {
                            //Status Approved
                            if ($data['request'][0]['t_status'] == 2) {

                                if ($data['request'][0]['t_output_status'] == 'Output Accepted') {
                                    echo '
                                          
                                            <form action="' . PARENT_FOLDER . '/request/view/update/status" method="POST">
                                                <input type="hidden" name="type" value="POSTING" >
                                                <input type="hidden" name="action" value="1">
                                                <input type="hidden" name="reqId" value="' . $data['reqId'] . '">
                                                <input type="hidden" name="pre-url" value="' . $_SERVER['REQUEST_URI'] . '">
                                                <input type="hidden" name="email" value="' . $data['request'][0]['user_email'] . '">


                                                
                                                <div class=""><button  id="form-complete-btn"  type="button" class="btn btn-outline-success action">Complete</button></div> 
                                            </form> 
                                            ';
                                }
                            }


                            //Status Pending
                            // if ($data['request'][0]['t_status'] == 3) {
                            //     echo '
                            //                 <form action="' . PARENT_FOLDER . '/request/view/update/status" method="POST">
                            //                     <input type="hidden" name="type" value="POSTING" >
                            //                     <input type="hidden" name="action" value="2">
                            //                     <input type="hidden" name="reqId" value="' . $data['reqId'] . '">
                            //                     <input type="hidden" name="pre-url" value="' . $_SERVER['REQUEST_URI'] . '">
                            //                     <input type="hidden" name="email" value="' . $data['request'][0]['user_email'] . '">
                            //                     <div class=""><button id="form-approve-btn" type="button" class="btn btn-outline-success action">Approve Request</button></div>                       
                            //                 </form>
                            //                 ';
                            // }
                        }
                        ?>

                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col">
                    <div class="d-flex align-items-center p-3"><i class="fas fa-ellipsis-v fa-2x" style="color: var(--bs-primary);padding-right: .5rem;"></i>

                        <div class="px-2" style="width: 100%;"><small>Title&nbsp;</small>
                            <h6 class="mb-0 mt-1">
                                <span style="color: rgb(2, 42, 15);">
                                    <h4 contenteditable="false" class="editable titleEditable">
                                        <input type="text" style="color: var(--bs-primary-text-emphasis); font-weight:bold;" name="title-name" value="<?php echo $data['request'][0]['r_title'] ?>">
                                    </h4>
                                </span>
                            </h6>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row row-cols-s row-cols-md-1 row-cols-xl-3 d-flex">
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
                    <div id="platform-requested-collection" class="card-body p-4">
                        <div class="d-flex align-items-center align-items-sm-center align-items-md-center align-items-lg-center align-items-xl-center align-items-xxl-center"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-house-door-fill fs-2" style="color: var(--bs-primary);">
                            <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5"></path>
                        </svg>
                            <h4 style="font-family: Poppins, sans-serif;color: var(--bs-emphasis-color);margin-left: .5rem;">Platforms</h4>
                        </div>
                        <ul style="color: var(--bs-primary-text-emphasis);">
                            <ul contenteditable="false" class="custom-list collection-hide">
                                <?php
                                                                  
                                if ($data['request'][0]['r_platforms'] != 'null') {
                                    foreach (json_decode($data['request'][0]['r_platforms']) as $platforms) {
                                        echo "<li>" . $platforms . "</li>";
                                    }
                                }
                               ?>
                            </ul>
                            <div class="collection-input" style="display:none">
                                <div class="check">
                                    <input type="checkbox" class="custom-control-input" id="facebook" name="platforms[]" value="Facebook: @officialDNSC">
                                    <label class="custom-control-label" for="facebook"><strong>Facebook</strong></label>
                                </div>

                                <div class="check">
                                    <input type="checkbox" class="custom-control-input" id="youtube" name="platforms[]" value="YouTube: @officialDNSC">
                                    <label class="custom-control-label" for="youtube"><strong>YouTube</strong></label>
                                </div>
                                <div class="check">
                                    <input type="checkbox" class="custom-control-input" id="instagram" name="platforms[]" value="Instagram: @officialDNSC">
                                    <label class="custom-control-label" for="instagram"><strong>Instagram</strong></label>
                                </div>
                                <div class="check">
                                    <input type="checkbox" class="custom-control-input" id="info-board" name="platforms[]" value="Information board inside the campus">
                                    <label class="custom-control-label" for="info-board"><strong>Information board inside the campus</strong></label>
                                </div>
                                <div class="check">
                                    <input type="checkbox" class="custom-control-input" id="others-checkbox" name="platforms[]" value="Others">
                                    <label class="custom-control-label" for="others-checkbox"><strong>Others</strong></label>

                                    <input style="border-radius: 1rem;" type="text" class="form-control" id="others-input" name="others-input" placeholder="Please specify" disabled>
                                </div>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col p-2">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center align-items-sm-center align-items-md-center align-items-lg-center align-items-xl-center align-items-xxl-center"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-pencil-fill fs-2" style="color: var(--bs-primary);">
                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"></path>
                            </svg>
                            <h4 style="font-family: Poppins, sans-serif;color: var(--bs-emphasis-color);margin-left: .5rem;">Content</h4>
                        </div>
                        <ul style="color: var(--bs-primary-text-emphasis);">
                            <li><textarea <?php echo ($data['userType'] == 'admin') ? "readonly" : ""; ?> name="additional-info" id="" cols="30" rows="10" style="width:100%;text-align:start; padding:10px;border:none;"><?php echo $data['request'][0]['r_content'] ?></textarea></li>
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
                            <h4 style="font-family: Poppins, sans-serif;color: var(--bs-emphasis-color);margin-left: .5rem;">Output for Posting</h4>
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
                                            <a href='" . PARENT_FOLDER . '/public/storage/files/'. $file."?fileDownload=1' download>
                                            <button id='' type='button' class='btn  file mb-4'>
                                                <i class='bi " . $fileIcon . " fs-4' style='margin-right:5px'></i>" . $attachement[1] . "
                                            </button>
                                            
                                            </a>";
                                        }

                                        
                                        if ($data['userType'] == 'admin') {

                                            if ($data['request'][0]['t_status'] == 3 and $data['request'][0]['t_output_status'] == "For Admin Approval") {
                                                echo '
                                                                <div class="d-flex justify-content-end">
                                                                <form action="' . PARENT_FOLDER . '/request/view/update/status" method="POST">
                                                                    <input type="hidden" name="type" value="POSTING" >
                                                                    <input type="hidden" name="action" value="2">
                                                                    <input type="hidden" name="reqId" value="' . $data['reqId'] . '">
                                                                    <input type="hidden" name="pre-url" value="' . $_SERVER['REQUEST_URI'] . '">
                                                                    <input type="hidden" name="email" value="' . $data['request'][0]['user_email'] . '">

                                                                    
                                                                        
                                                                    <input type="hidden" name="email" value="' . $data['request'][0]['user_email'] . '">
                                                                    <input type="hidden" name="pre-url" value="' . $_SERVER['REQUEST_URI'] . '">
                                                                    
                                                                    <input type="hidden" name="recipient" value="' .  $data['request'][0]['user_fn'] . " " .  $data['request'][0]['user_ln'] . '">
                                                                    <input type="hidden" name="title" value="' . $data['request'][0]['r_title'] . '">
                                                                    <input type="hidden" name="requestCreated" value="' . $data['request'][0]['t_dateRequested'] . '">       
                    

                                                                    
                                                                    <div class=""><button id="form-approve-btn" type="button" class="btn btn-outline-success action">Approve </button></div>                       
                                                                </form>
                                                                    <form action="' . PARENT_FOLDER . '/request/view/update/revision-request" method="POST">
                                                                        <input type="hidden" name="type" value="POSTING" >
                                                                        <input type="hidden" id="revisionDetails" name="revisionDetails">
                                                                        <input type="hidden" name="reqId" value="' . $data['reqId'] . '">
                                                                        <input type="hidden" name="pre-url" value="' . $_SERVER['REQUEST_URI'] . '">

                                                                        
                                                                        <input type="hidden" name="email" value="' . $data['request'][0]['user_email'] . '">
                                                                        <input type="hidden" name="pre-url" value="' . $_SERVER['REQUEST_URI'] . '">
                                                                        
                                                                        <input type="hidden" name="recipient" value="' .  $data['request'][0]['user_fn'] . " " .  $data['request'][0]['user_ln'] . '">
                                                                        <input type="hidden" name="title" value="' . $data['request'][0]['r_title'] . '">
                                                                        <input type="hidden" name="requestCreated" value="' . $data['request'][0]['t_dateRequested'] . '">       
                        

                                                                        <div class=""><button id="form-revise-btn" type="button" class="btn btn-outline-succes action">Revise</button></div>          
                                                                    </form>
                                                                </div>
                                                        
                                                            ';
                                            }
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
            <div class="col p-2">
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

                            <a href="<?php echo  $data['request'][0]['r_link']; ?>" target="_blank" class='btn file mb-4'>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-link" viewBox="0 0 16 16">
                                        <path d="M6.354 5.5H4a3 3 0 0 0 0 6h3a3 3 0 0 0 2.83-4H9q-.13 0-.25.031A2 2 0 0 1 7 10.5H4a2 2 0 1 1 0-4h1.535c.218-.376.495-.714.82-1z" />
                                        <path d="M9 5.5a3 3 0 0 0-2.83 4h1.098A2 2 0 0 1 9 6.5h3a2 2 0 1 1 0 4h-1.535a4 4 0 0 1-.82 1H12a3 3 0 1 0 0-6z" />
                                    </svg>
                                    </i><?php echo $data['request'][0]['r_link'] ?>
                                    <input type="text" name="link" value="<?php echo $data['request'][0]['r_link'] ?>" hidden>
                                </a>
                            </li>
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
                            <h4 style="font-family: Poppins, sans-serif;color: var(--bs-emphasis-color);margin-left: .5rem; margin-bottom:.5rem;">Admin Comment</h4>
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
                                                                            <a href="' . PARENT_FOLDER . '/public/storage/files/'. $attachment.'?fileDownload=1" download>
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
                            <input type="hidden" name="type" value="PHOTO" >
                            <input type="hidden" name="action" value="4">
                            <input type="hidden" name="reqId" value="' . $data['reqId'] . '">
                            <input type="hidden" name="pre-url" value="' . $_SERVER['REQUEST_URI'] . '">
                            <div class=""><button id="form-cancel-btn" type="button" class="btn btn-outline-danger">Cancel Request</button></div>          
                        </form>
         
                        ';
                    }
                }
                ?>
            </div>
        </div>




    </div>
</div>

</div>

<form id="editForm" action="<?php echo  PARENT_FOLDER . '/request/view/update?type=POSTING&id=' . $data['reqId'] ?>" method="POST" enctype="multipart/form-data" hidden>
    <input type="hidden" name="pre-url" value="<?php echo  $_SERVER['REQUEST_URI'] ?>">

    <input type="text" name="oldTitle" value="<?php echo $data['request'][0]['r_title'] ?>" hidden>
    <input type="text" name="recipient" value="<?php echo $data['request'][0]['user_fn'] . " " .  $data['request'][0]['user_ln']  ?>"hidden>
    <input type="text" name="email" value="<?php echo $data['request'][0]['user_email'] ?>" hidden>
      
</form>

<script src="<?php echo PARENT_FOLDER ?>/public/js/editRequestPOSTING.js"></script>


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