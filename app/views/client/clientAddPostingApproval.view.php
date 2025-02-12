<link rel="stylesheet" href="<?php echo PARENT_FOLDER ?>/public/css/client/addRequest.css">

<div class="container-fluid d-flex justify-content-center flex-column">
    <div class="cust-margin d-flex justify-content-center">
        <h1 class="font-weight-bold text-center">Posting Approval</h1>
    </div>
    <form action="<?php echo PARENT_FOLDER ?>/client/request/category/submit?type=POSTING" method="POST" enctype="multipart/form-data" id="addrequest">

        <div class="cust-margin d-flex justify-content-center">
            <div class="card shadow">
                <div class="card-header font-weight-bold d-flex flex-row ">
                    <h4>Posting Information</h4>
                </div>
                <div class="card-body activity-information-handler">
                    <div class=" justify-content-center">
                        <div class="form-group column">
                            <div class="form-floating">
                                <input type="text" class="form-control " id="post-title" name="post-title" placeholder="name@example.com">
                                <label for="activity-name">Title of the Post : </label>
                            </div>
                        </div>

                        <div class="form-group column">
                            <div class="form-floating">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Content</label>
                                    <textarea class="form-control rounded-input" id="post-content" rows="5" name="post-content"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group column"> <label for="">Note: You may also include a Google Drive link if you need to share multiple photos or additional relevant files.</label>
                            <div class="form-floating">
                                <input type="text" class="form-control " id="post-link" name="post-link" placeholder="name@example.com">
                                <label for="activity-name">Link:</label>
                            </div>
                        </div>
                        <div class="custom-file">
                            <div id="theWidget" class="dnd-file-upload-widget">
                                <div class="form-group drop_zone">
                                    <span>Drag files here to attach</span>
                                    <span>or</span>
                                    <label class="btn btn-outline-success pb-2">
                                        Select files
                                        <input type="file" multiple="" id="attachement" name="attachement[]" />
                                    </label>
                                </div>
                                <div class="files-container"></div>
                            </div>
                        </div>
                        <div class="form-group"> <label for="activity-name">Social Media Platform</label>
                            <div class=" d-flex flex-column platforms-requested-handler">
                                <div class="box">
                                    <div class="custom-control custom-checkbox mb-2">
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
                                </div>
                            </div>

                        </div>
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

<script src="<?php echo PARENT_FOLDER ?>/public/js/addRequestPOSTING.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const othersCheckbox = document.getElementById('others-checkbox');
        const othersInput = document.getElementById('others-input');

        othersCheckbox.addEventListener('change', function() {
            if (othersCheckbox.checked) {
                othersInput.disabled = false;
            } else {
                othersInput.disabled = true;
                othersInput.value = ''; // Clear the input if checkbox is unchecked
            }
        });
    });
</script>
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