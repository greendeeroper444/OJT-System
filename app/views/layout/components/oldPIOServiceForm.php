<div class="card shadow">
    <div class="card-header font-weight-bold d-flex flex-row flex-wrap justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <i class="bi bi-list-ul" style="font-size:1.5rem; margin-right:5px"></i>
            <h4 contenteditable="false" class="activity-title editable">
                <input type="text" name="activity-name" value="<?php echo $data['request'][0]['r_activityname'] ?>">
            </h4>
        </div>
        <div class="d-flex align-items-center">
            <i class="bi bi-calendar-fill" style="font-size:1.25rem; margin-right:5px"></i>
            <div class="date-time" onbeforeinput="return false">

                <h5 id="date-view-page" class=" editable" contenteditable="false"><?php echo $data['request'][0]['r_duration'] . ' | ' . $data['request'][0]['r_durationStartTime'] . ' - ' . $data['request'][0]['r_durationEndTime'] ?></h5>
                <input readonly type="text" class="form-control " id="activity-Duration-viewpage" name="activity-Duration-viewpage" placeholder="" value="<?php echo $data['request'][0]['dateOrinalValue'] ?>">
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class=" justify-content-center">
            <div class="d-flex align-items-center flex-wrap">

                <div class="status-group">
                    <label for="name-activity" class="">Status: </label>
                    <?php
                    $statusCSS = (
                        $data['request'][0]['t_status'] == 1 ? 'status-complete' : ($data['request'][0]['t_status'] == 2 ? 'status-approved' : ($data['request'][0]['t_status'] == 3 ? 'status-pending' : 'status-declined')));

                    $statusText = (
                        $data['request'][0]['t_status'] == 1 ? 'Complete' : ($data['request'][0]['t_status'] == 2 ? 'Approved' : ($data['request'][0]['t_status'] == 3 ? 'Pending' : 'declined')));

                    echo '<p class="' . $statusCSS . '">' . $statusText . '</p>'
                    ?>
                </div>
                <div class="flex-grow-1"></div>
                <div class="btn-group align-items-center">
                    <?php
                    if ($data['userType'] == 'client') {
                        //Status Approved               
                        echo '  
                                        <div class=""><button id="form-save-btn" type="submit" class="btn btn-outline-success action" style="display:none">Save</button></div>
                                        <div class=""><button id="form-edit-btn" type="button" class="btn btn-outline-success action">Edit</button></div>            
                                        <form action="' . PARENT_FOLDER . '/client/request/view/update/status" method="POST">
                                            <input type="hidden" name="type" value="PIO" >
                                            <input type="hidden" name="reqId" value="' . $data['reqId'] . '">
                                            <input type="hidden" name="pre-url" value="' . $_SERVER['REQUEST_URI'] . '">
                                            <div class=""><button id="form-cancel-btn" type="button" class="btn btn-outline-succes action">Cancel Event</button></div>          
                                        </form>
                                
                                    ';
                    }

                    if ($data['userType'] == 'admin') {
                        //Status Approved
                        if ($data['request'][0]['t_status'] == 2) {
                            echo '
                                            <form action="' . PARENT_FOLDER . '/admin/request/view/update/add-output" method="POST" enctype="multipart/form-data">
                                                <input type="hidden" name="type" value="PIO" >
                                                <input type="file" id="outputAttachment" name="adminAttachement[]" multiple hidden>
                                                <input type="hidden" id="outputDetails" name="adminDetails">
                                                <input type="hidden" name="reqId" value="' . $data['reqId'] . '">
                                                <input type="hidden" name="pre-url" value="' . $_SERVER['REQUEST_URI'] . '">
                                                <div class=""><button id="add-output-btn" type="button" class="btn btn-outline-success action">Add Output</button></div> 
                                            </form> 
                                            <div class=""><button  type="button" class="btn btn-outline-success action">Complete</button></div> 
                                            ';
                        }
                        //Status Pending
                        if ($data['request'][0]['t_status'] == 3) {
                            echo '
                                            <form action="' . PARENT_FOLDER . '/admin/request/view/update/status" method="POST">
                                                <input type="hidden" name="type" value="PIO" >
                                                <input type="hidden" name="action" value="2">
                                                <input type="hidden" name="reqId" value="' . $data['reqId'] . '">
                                                <input type="hidden" name="pre-url" value="' . $_SERVER['REQUEST_URI'] . '">
                                                <div class=""><button id="form-approve-btn" type="button" class="btn btn-outline-success action">Approve Request</button></div>                       
                                            </form>
                                            ';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="additional-info">

            <?php echo ($data['request'][0]['t_output_status'] == 'Output for review') ? '<p class="text-start" style="color:yellow">' . $data['request'][0]['t_output_status'] . '</p>' : '' ?>
            <?php echo ($data['request'][0]['t_output_status'] == 'Output for Revision') ? '<p class="text-start" style="color:red">' . $data['request'][0]['t_output_status'] . '</p>' : '' ?>
            <?php echo ($data['request'][0]['t_output_status'] == 'Output Accepted') ? '<p class="text-start" style="green:yellow">' . $data['request'][0]['t_output_status'] . '</p>' : '' ?>


            <p class="text-start"><i class="bi bi-upc p-2 fs-2"></i>Request Code</p>
            <div class="box-body2">
                <ul contenteditable="false" class="custom-list">
                    <li>
                        <h4 class="fs-4"><?php echo $data['request'][0]['r_id'] ?> </h4>
                    </li>
                </ul>
            </div>
            <p class="text-start"><i class="bi bi-calendar-plus-fill p-2 fs-4"></i>Date Requested</p>
            <div class="box-body2">
                <ul contenteditable="false" class="custom-list">
                    <li><input disable type="text" value="<?php echo date('F d, Y ', strtotime($data['request'][0]['r_datetimerequested'])); ?>"></li>
                </ul>
            </div>
            <p class="text-start"><i class="bi bi-geo-alt-fill p-2 fs-4"></i> Venue</p>
            <div class="box-body2">

                <ul contenteditable="false" class="custom-list editable">
                    <li><input type="text" name="activity-venue" value="<?php echo $data['request'][0]['r_venue'] ?>"></li>
                </ul>
            </div>
            <p class="text-start"><i class="bi bi-people-fill p-2 fs-4"> </i>Participants</p>
            <div class="box-body2">
                <ul contenteditable="false" class="custom-list editable">
                    <li><input type="text" name="activity-participants" value="<?php echo $data['request'][0]['r_participants'] ?>"></li>
                </ul>
            </div>
            <p class="text-start"><i class="bi bi-mic-fill p-2 fs-4"> </i>Resource Speaker/s or Key Official/s</p>
            <div class="box-body2">

                <ul contenteditable="false" class="custom-list editable">
                    <li><input type="text" name="activity-officials" value="<?php echo $data['request'][0]['r_keyofficials'] ?>"></li>
                </ul>

            </div>
            <div class="group">
                <p class="text-start"><i class="bi bi-check-square-fill p-2 fs-4"> </i>Highlights</p>
                <div class="box-body2">
                    <ul contenteditable="false" class="custom-list editable">
                        <li><input type="text" name="activity-highlights" value="<?php echo $data['request'][0]['r_highlights'] ?>"></li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
    <!-- Card body  -->
    <div class="card-body">
        <!-- Row Start  -->
        <div class="row">
            <div class="group">
                <div class="box-header">
                    <p class="text-start"><i class="bi bi-pencil-fill p-2 fs-4"> </i>Service Requested</p>
                </div>
                <div id="services-requested-collection" class="box-body2">
                    <ul contenteditable="false" class="custom-list collection-hide">
                        <?php foreach (json_decode($data['request'][0]['r_services']) as $services) {
                            echo "<li>" . $services . "</li>";
                        } ?>
                    </ul>
                    <div class=" collection-input" style="display:none">


                        <div>
                            <input type="checkbox" class="custom-control-input" id="on-site" name="services[]" value="On-site Documentation">
                            <label class="custom-control-label" for="on-site">
                                <strong>On-site Documentation</strong>
                            </label>
                        </div>
                        <div>
                            <input type="checkbox" class="custom-control-input" id="article" name="services[]" value="Article Drafting">
                            <label class="custom-control-label" for="article">
                                <strong>Article Drafting</strong>
                            </label>
                        </div>
                        <div>
                            <input type="checkbox" class="custom-control-input" id="graphics" name="services[]" value="Graphics and Content Design">
                            <label class="custom-control-label" for="graphics">
                                <strong>Graphics and Content Design</strong>
                            </label>
                        </div>
                        <div>
                            <input type="checkbox" class="custom-control-input" id="website" name="services[]" value="Content Updating on the College Website">
                            <label class="custom-control-label" for="website">
                                <strong>Content Updating on the College Website</strong>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="group">
                <div class="box-header">
                    <p class="text-start"><i class="bi bi-laptop-fill p-2 fs-4"></i>Preferred Platform/s</p>
                </div>
                <div id="platform-requested-collection" class="box-body2">
                    <ul contenteditable="false" class="custom-list collection-hide">
                        <?php foreach (json_decode($data['request'][0]['r_platforms']) as $platforms) {
                            echo "<li>" . $platforms . "</li>";
                        } ?>
                    </ul>
                    <div class="collection-input" style="display:none">
                        <div>
                            <input type="checkbox" class="custom-control-input" id="college-website" name="platforms[]" value="College Website: dnsc.edu.ph">
                            <label class="custom-control-label" for="college-website">
                                <strong>College Website: dnsc.edu.ph</strong>
                            </label>
                        </div>
                        <div>
                            <input type="checkbox" class="custom-control-input" id="fb" name="platforms[]" value="Facebook: @officialDNSC">
                            <label class="custom-control-label" for="fb">
                                <strong>Facebook: @officialDNSC</strong>
                            </label>
                        </div>
                        <div>
                            <input type="checkbox" class="custom-control-input" id="twitter" name="platforms[]" value="Twitter: @officialDNSC">
                            <label class="custom-control-label" for="twitter">
                                <strong>Twitter: @officialDNSC</strong>
                            </label>
                        </div>
                        <div>
                            <input type="checkbox" class="custom-control-input" id="yt" name="platforms[]" value="Youtube: @officialDNSC">
                            <label class="custom-control-label" for="yt">
                                <strong>Youtube: @officialDNSC</strong>
                            </label>
                        </div>
                        <div>
                            <input type="checkbox" class="custom-control-input" id="email" name="platforms[]" value="Email Blasting: pio@dnsc.edu.ph">
                            <label class="custom-control-label" for="email">
                                <strong>Email Blasting: pio@dnsc.edu.ph</strong>
                            </label>
                        </div>
                        <div>
                            <input type="checkbox" class="custom-control-input" id="entryway" name="platforms[]" value="College Entryway LED Board">
                            <label class="custom-control-label" for="entryway">
                                <strong>College Entryway LED Board</strong>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="group">
                <div class="box-header">
                    <p class="text-start"><i class="bi bi-person-plus-fill p-2 fs-4"></i>Contributions</p>
                </div>
                <div class="box-body2">
                    <div class=" mb-4">
                        <!-- Render File Uploaded by client-->
                        <?php
                        if (json_decode($data['request'][0]['r_attachements'] != null)) {
                            foreach (json_decode($data['request'][0]['r_attachements']) as $attachement) {
                                $attachement = explode("***", $attachement);
                                $getExtention = explode('.', $attachement[1]);
                                $fileIcon = ($getExtention[1] == 'pdf') ? 'bi-file-pdf-fill' : 'bi-file-earmark-word-fill';
                                echo "
                                                <div class='d-flex align-items-center mb-2'><button class='remove-file' style='display:none'>X</button>
                                                    <i class='bi " . $fileIcon . " fs-4'style='margin-right:5px'></i>
                                                    <p>" . $attachement[1] . "</p>
                                                </div>";
                            }
                        }
                        ?>
                        <!--------------------------->
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile" name="attachement[]" style="display:none" multiple>
                    </div>
                </div>
            </div>

            <div class="group">
                <div class="box-header">
                    <p class="text-start"><i class="bi bi-file-earmark-plus-fill p-2 fs-4"></i>Additional Information</p>
                </div>
                <div class="box-body2">
                    <textarea <?php echo ($data['userType'] == 'admin') ? "readonly" : ""; ?> name="additional-info" id="" cols="30" rows="3" style="width:100%;text-align:start; padding:10px"><?php echo $data['request'][0]['r_additionalInfo'] ?></textarea>
                </div>
            </div>
            <div class="group">
                <div class="box-body2">
                    <ul contenteditable="false" class="custom-list">

                    </ul>
                </div>
            </div>

            <!-- Render  Output Response By admin  -->
            <?php
            if (!empty($data['request'][0]['t_messageResponse'])) {
                $messages = json_decode($data['request'][0]['t_messageResponse'], true);

                if ($messages !== null && is_array($messages)) {
                    echo '
                            <div class="group">
                                <div class="box-header">
                                    <p class="text-start"><i class="bi bi-file-earmark-plus-fill p-2 fs-4"></i>Admin Output</p>
                                </div>
                                <div class="box-body2">
                                    <div class="chat-box">
                                        <div style="margin-bottom:20px">Messages</div>';

                    foreach ($messages['conversation'] as $message) {
                        echo '
                                <div class="response">
                                    <p>' . $message['identifier'] . ':</p>
                                    <div>' . $message['text'] . '</div>
                                </div>';
                    }

                    echo '
                                    </div>
                                </div>
                            </div>';
                }
            }

            if (json_decode($data['request'][0]['t_adminAttachements'] != null)) {
                foreach (json_decode($data['request'][0]['t_adminAttachements']) as $attachement) {
                    $attachement = explode("***", $attachement);
                    $getExtention = explode('.', $attachement[1]);
                    $fileIcon = ($getExtention[1] == 'pdf') ? 'bi-file-pdf-fill' : 'bi-file-earmark-word-fill';
                    echo '                      
                                <div class="box-body2">
                                    <div style="margin-bottom:5px">Attachment:</div>
                                    <div class="file-list">
                                        <div>
                                            <i class="bi ' . $fileIcon . ' fs-4"></i>
                                            <p>' . $attachement[1] . '</p>
                                        </div>
                                    </div>
                                </div>
                                
                                ';
                }
            }
            if ($data['userType'] == 'client') {
                //Status Approved
                if ($data['request'][0]['t_status'] == 2 and $data['request'][0]['t_output_status'] == "Output for review") {
                    echo '

                            <div class="d-flex justify-content-end">
                                <form action="' . PARENT_FOLDER . '/client/request/view/update/accept" method="POST">
                                    <input type="hidden" name="type" value="PIO" >
                                    <input type="hidden" name="reqId" value="' . $data['reqId'] . '">
                                    <input type="hidden" name="pre-url" value="' . $_SERVER['REQUEST_URI'] . '">
                                    <div class=""><button id="form-accept-btn" type="button" class="btn btn-outline-succes action">Accept</button></div>          
                                </form>
                                <form action="' . PARENT_FOLDER . '/client/request/view/update/revise" method="POST">
                                    <input type="hidden" name="type" value="PIO" >
                                    <input type="hidden" id="revisionDetails" name="revisionDetails">
                                    <input type="hidden" name="reqId" value="' . $data['reqId'] . '">
                                    <input type="hidden" name="pre-url" value="' . $_SERVER['REQUEST_URI'] . '">
                                    <div class=""><button id="form-revise-btn" type="button" class="btn btn-outline-succes action">Revise</button></div>          
                                </form>
                            </div>
                            
                            ';
                }
            }
            ?>

        </div>
    </div> <!-- Card body end -->
</div>