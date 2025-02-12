<link rel="stylesheet" href="<?php echo PARENT_FOLDER ?>/public/css/client/addRequest.css">

<div class="container-fluid d-flex justify-content-center flex-column">
    <div class="cust-margin d-flex justify-content-center">
        <h1 class="font-weight-bold text-center">Request for Copies of Photos</h1>
    </div>
    <form action="<?php echo PARENT_FOLDER ?>/client/request/category/submit?type=PHOTO" method="POST" enctype="multipart/form-data" id="addrequest">

        <div class="cust-margin d-flex justify-content-center">
            <div class="card shadow">
                <div class="card-header font-weight-bold d-flex flex-row ">
                    <h4>Request Photo Information</h4>
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
                                <label for="activity-Duration">Date of the Activity : </label>
                            </div>
                        </div>
                        <div class="form-group column">
                            <div class="form-floating">
                                <input type="text" class="form-control " id="purpose" name="activity-purpose" placeholder="name@example.com">
                                <label for="purpose">Purpose of Request: </label>
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

<script src="<?php echo PARENT_FOLDER ?>/public/js/addRequestPhoto.js"></script>
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