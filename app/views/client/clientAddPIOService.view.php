<link rel="stylesheet" href="<?php echo PARENT_FOLDER ?>/public/css/client/addRequest.css">

<div class="container-fluid d-flex justify-content-center flex-column">
    <div class="cust-margin d-flex justify-content-center">
        <h1 class="font-weight-bold text-center">Public Information Service Request Form</h1>
    </div>
    <form action="<?php echo PARENT_FOLDER ?>/client/request/category/submit?type=PIO" method="POST" enctype="multipart/form-data" id="addrequest">
        <div class="cust-margin d-flex justify-content-center">
            <div class="card shadow">
                <div class="card-header font-weight-bold d-flex flex-row ">
                    <h4>Activity Information</h4>
                </div>
                <div class="card-body activity-information-handler">
                    <div class=" justify-content-center">
                        <div class="form-group column">
                            <div class="form-floating">
                                <input type="text" class="form-control " id="activity-name" name="activity-name" placeholder="name@example.com">
                                <label for="activity-name">Name of the Activity : </label>
                            </div>
                        </div>

                        <div class="form-group column">
                            <div class="form-floating ">
                                <input readonly type="text" class="form-control " id="activity-Duration" name="activity-Duration" placeholder="name@example.com">
                                <label for="activity-Duration">Activity Duration : </label>
                            </div>
                        </div>

                        <div class="form-group column">
                            <div class="form-floating">
                                <input type="text" class="form-control " id="activity-venue" name="activity-venue" placeholder="name@example.com">
                                <label for="activity-venue">Venue/s : </label>
                            </div>

                        </div>
                        <div class="form-group column">
                            <div class="form-floating">
                                <input type="text" class="form-control " id="activity-participants" name="activity-participants" placeholder="name@example.com">
                                <label for="activity-participants">Participant/s : </label>
                            </div>

                        </div>
                        <div class="form-group column">
                            <div class="form-floating">
                                <input type="text" class="form-control " id="activity-officials" name="activity-officials" placeholder="name@example.com">
                                <label for="activity-officials">Resource Speaker/s or Key Official/s: </label>
                            </div>
                        </div>
                        <div class="form-group column">
                            <div class="form-floating">
                                <input type="text" class="form-control " id="activity-highlights" name="activity-highlights" placeholder="name@example.com">
                                <label for="activity-highlights">Highlight/s (if applicable): </label>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>


        <div class="cust-margin d-flex justify-content-center ">
            <div class="card shadow">
                <div class="card-header font-weight-bold d-flex flex-row">
                    <h4>Service Requested</h4>
                </div>
                <div class="card-body d-flex flex-column service-requested-handler">
                    <label for="" style="display:none; margin-bottom:10px">Required at least one service selected</label>

                    <div class="custom-control custom-checkbox mb-2 ">
                        <input type="checkbox" class="custom-control-input" id="on-site" name="services[]" value="On-site Documentation">
                        <label class="custom-control-label" for="on-site">
                            <strong>
                                On-site Documentation
                            </strong></label>
                        <br>
                        <label for="on-site">
                            <p for="on-site">Deliverables: Attendance at the Event, Edited Photos, Website, and Social Media Content</p>
                        </label>

                    </div>
                    <div class="custom-control custom-checkbox mb-2">
                        <input type="checkbox" class="custom-control-input" id="articleDrafting" name="services[]" value="Article Drafting">
                        <label class="custom-control-label" for="articleDrafting"><strong>
                                Article Drafting
                            </strong></label>
                        <br>
                        <label for="articleDrafting">
                            <p class="">Deliverables: Website and Social Media Content</p>
                        </label>

                    </div>
                    <div class="custom-control custom-checkbox mb-2">
                        <input type="checkbox" class="custom-control-input" id="graphics" name="services[]" value="Graphics and Content Design">
                        <label class="custom-control-label" for="graphics"><strong>
                                Graphics and Content Design
                            </strong></label>
                        <br>
                        <label for="graphics">
                            <p class="">Deliverables: Layout of Design and Content for Tarpaulins, Social Media Announcements, Infographics, Report Cover, etc.</p>
                        </label>

                    </div>
                    <div class="custom-control custom-checkbox mb-2">
                        <input type="checkbox" class="custom-control-input" id="website" name="services[]" value="Content Updating on the College Website">
                        <label class="custom-control-label" for="website"><strong>
                                Content Updating on the College Website
                            </strong></label><br>
                        <label for="website">
                            <p class="">Deliverables: Updating of Information, Text, Photo, Poster, or Feature on the Website</p>
                        </label>

                    </div>
                </div>

            </div>
        </div>

        <div class="cust-margin d-flex justify-content-center ">
            <div class="card shadow">
                <div class="card-header font-weight-bold d-flex flex-row">
                    <h4>Preferred Platforms</h4>
                </div>
                <div class="card-body d-flex flex-column platforms-requested-handler">
                    <label for="" class="" style="display:none; margin-bottom:10px">Required at least one platform selected</label>
                    <div class="custom-control custom-checkbox mb-2">
                        <input type="checkbox" class="custom-control-input" id="collegeWebsite" name="platforms[]" value="College Website: dnsc.edu.ph">
                        <label class="custom-control-label" for="collegeWebsite"><strong>
                                College Website: dnsc.edu.ph
                            </strong></label>
                        <br>
                        <label for="collegeWebsite">
                            <p class="">Recommended for articles and banners</p>
                        </label>
                    </div>
                    <div class="custom-control custom-checkbox  mb-2">
                        <input type="checkbox" class="custom-control-input" id="facebook" name="platforms[]" value="Facebook: @officialDNSC">
                        <label class="custom-control-label" for="facebook"><strong>
                                Facebook: @officialDNSC
                            </strong></label>
                        <br>
                        <label for="facebook">
                            <p class="">Recommended for announcements, posters, invitations, advisories, short videos, article links, photo album, live streaming</p>
                        </label>

                    </div>
                    <div class="custom-control custom-checkbox  mb-2">
                        <input type="checkbox" class="custom-control-input" id="instagram" name="platforms[]" value="Instagram: @officialDNSC">
                        <label class="custom-control-label" for="instagram"><strong>
                                Instagram: @officialDNSC
                            </strong></label>
                        <br>
                        <label for="facebook">
                            <p class="">Recommended for announcements, posters, invitations, advisories, short videos, article links, photo album, live streaming</p>
                        </label>

                    </div>
                    <div class="custom-control custom-checkbox  mb-2">
                        <input type="checkbox" class="custom-control-input" id="twitter" name="platforms[]" value="Twitter: @officialDNSC">
                        <label class="custom-control-label" for="twitter"><strong>
                                Twitter: @officialDNSC
                            </strong></label>
                        <br>
                        <label for="twitter">
                            <p class="">Recommended for announcements, posters, invitations, advisories, short videos, article links, few photos</p>
                        </label>
                    </div>
                    <div class="custom-control custom-checkbox  mb-2">
                        <input type="checkbox" class="custom-control-input" id="youtube" name="platforms[]" value="Youtube: @officialDNSC">
                        <label class="custom-control-label" for="youtube"><strong>
                                Youtube: @officialDNSC
                            </strong></label>
                        <br>
                        <label for="youtube">
                            <p class="">Recommended for videos and live streaming</p>
                        </label>
                    </div>
                    <div class="custom-control custom-checkbox  mb-2">
                        <input type="checkbox" class="custom-control-input" id="email" name="platforms[]" value="Email Blasting: pio@dnsc.edu.ph">
                        <label class="custom-control-label" for="email"><strong>
                                Email Blasting: pio@dnsc.edu.ph
                            </strong></label>
                        <br>
                        <label for="email">
                            <p class="">Recommended for targeted information dissemination to a specific directory</p>
                        </label>
                    </div>
                    <div class="custom-control custom-checkbox  mb-2">
                        <input type="checkbox" class="custom-control-input" id="entryway" name="platforms[]" value="College Entryway LED Board">
                        <label class="custom-control-label" for="entryway"><strong>
                                College Entryway LED Board
                            </strong></label>
                        <br>
                        <label for="entryway">
                            <p class="">Recommended for memoranda and announcements</p>
                        </label>
                    </div>
                    <div class="custom-control custom-checkbox mb-2">
                        <input type="checkbox" class="custom-control-input" id="noRequired" name="platforms[]" value="No Required Plaftorm">
                        <label class="custom-control-label" for="noRequired"><strong>
                                No Required Plaftorm
                            </strong></label>
                        <br>

                    </div>
                </div>

            </div>
        </div>

        <div class="cust-margin d-flex justify-content-center ">
            <div class="card shadow">
                <div class="card-header font-weight-bold d-flex flex-row">
                    <h4>Additional Information</h4>
                </div>
                <div class="card-body d-flex flex-column">
                    <div class="form-group">
                        <label for="customFile">Note: The requester can attach the activity design and the program flow to this request form to help the documenter and writer produce a more comprehensive and compelling article</label>
                    </div>

                    <div class="custom-file">

                        <div id="theWidget" class="dnd-file-upload-widget">
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
                    <br>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Provide more details and instructions.
                            <strong>
                                Note: You may also include a Google Drive link if you need to share multiple photos or additional relevant files.
                            </strong>
                        </label>
                        <textarea class="form-control rounded-input" id="exampleFormControlTextarea1" rows="5" name="additional-info"></textarea>
                    </div>

                </div>

            </div>
        </div>
        <div class="cust-margin d-flex justify-content-center">
            <div class="d-grid pb-2 ">
                <button type="button" class="btn btn-success btn-lg requestSubmitBtn">
                    Send Request
                </button>
            </div>
        </div>
        <br>
    </form>
</div>



<script src="<?php echo PARENT_FOLDER ?>/public/js/addRequestPIO.js"></script>

<?php
if (isset($_SESSION['page_Success'])) {
    $url = PARENT_FOLDER . '/client/dashboard';
    echo "
            <script> 
                Swal.fire({
                    text: 'Request Successfully Submitted!',
                    icon: 'success',
                    confirmButtonColor: '#0B790B',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                 if (result.isConfirmed) {
                    window.location.href = '" . $url . "';
                    }
                });
            </script>
            ";

     
}
unset($_SESSION['page_Success']);
?>
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