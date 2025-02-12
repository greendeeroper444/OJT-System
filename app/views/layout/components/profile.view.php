<link rel="stylesheet" href="<?php echo PARENT_FOLDER ?>/public/css/client/profileview.css">

<div class="content">

    <div class="">
        <div class=" d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class=" title-page">
                <?php echo $data['userInfo']['user_fn'] . " " . $data['userInfo']['user_ln'] ?>
            </h1>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-lg-4">
            <div class="card mb-3">
                <div class="card-body text-center shadow"><img class="rounded-circle mb-3 mt-4" src="<?php echo PARENT_FOLDER ?>/public/img/avatars/default.jpeg" width="160" height="160">
                    <div class="mb-3">
                        <!-- <button class="btn btn-primary btn-sm" type="button">Change Photo</button> -->
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">

                    <h5 class="card-title fw-bold">Request</h5>
                    <!-- <h6 class="text-primary fw-bold m-0">Request</h6> -->
                </div>

                <div class="card-body">
                    <h4 class="small fw-bold">PIO Request Service<span class="float-end"><?php echo $data['requestStatic']['PIOpercent'] . '%' ?></span></h4>
                    <div class="progress progress-sm mb-3">
                        <div class="progress-bar bg-danger" aria-valuenow="<?php echo $data['requestStatic']['PIOpercent'] ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $data['requestStatic']['PIOpercent'] . '%' ?>;"><span class="visually-hidden"><?php echo $data['requestStatic']['PIOpercent'] . '%' ?></span></div>
                    </div>
                    <h4 class="small fw-bold">Photo Requested<span class="float-end"><?php echo $data['requestStatic']['PHOTOpercent'] . '%' ?></span></h4>
                    <div class="progress progress-sm mb-3">
                        <div class="progress-bar bg-warning" aria-valuenow="<?php echo $data['requestStatic']['PIOpercent'] ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $data['requestStatic']['PHOTOpercent'] . '%' ?>;"><span class="visually-hidden"><?php echo $data['requestStatic']['PHOTOpercent'] . '%' ?></span></div>
                    </div>
                    <h4 class="small fw-bold">Posting Approval<span class="float-end"><?php echo $data['requestStatic']['POSTINGpercent'] . '%' ?></span></h4>
                    <div class="progress progress-sm mb-3">
                        <div class="progress-bar bg-primary" aria-valuenow="<?php echo $data['requestStatic']['POSTINGpercent'] ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $data['requestStatic']['POSTINGpercent'] . '%' ?>;"><span class="visually-hidden"><?php echo $data['requestStatic']['POSTINGpercent'] . '%' ?></span></div>
                    </div>
                    <h4 class="small fw-bold">Total Request<span class="float-end"><?php echo $data['requestStatic']['requestTotal'] ?></span></h4>
                    <div class="progress progress-sm mb-3">
                        <div class="progress-bar bg-info" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"><span class="visually-hidden">80%</span></div>
                    </div>
                    <hr>
                    <h4 class="small fw-bold pb-2">Pending<span class="float-end"><?php echo $data['requestStatic']['pending'] ?></span></h4>

                    <h4 class="small fw-bold pb-2">Approved<span class="float-end"><?php echo $data['requestStatic']['approved'] ?></span></h4>

                    <h4 class="small fw-bold pb-2">Completed<span class="float-end"><?php echo $data['requestStatic']['complete'] ?></span></h4>

                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="row mb-3 d-none">
                <div class="col">
                    <div class="card text-white bg-primary shadow">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col">
                                    <p class="m-0">Peformance</p>
                                    <p class="m-0"><strong>65.2%</strong></p>
                                </div>
                                <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                            </div>
                            <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5% since last month</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-white bg-success shadow">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col">
                                    <p class="m-0">Peformance</p>
                                    <p class="m-0"><strong>65.2%</strong></p>
                                </div>
                                <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                            </div>
                            <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5% since last month</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card shadow mb-3">
                        <div class="card-header py-3">
                            <h5 class="card-title fw-bold">User Settings</h5>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo PARENT_FOLDER ?>/profile/update" method="POST">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3"><label class="form-label" for="email"><strong>Email</strong></label><input class="form-control" type="email" id="email" placeholder="<?php echo $data['userInfo']['user_email'] ?>" name="email" value="<?php echo $data['userInfo']['user_email'] ?>"></div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3"><label class="form-label" for="password"><strong>Password</strong></label><input class="form-control" type="text" id="password" placeholder="Type new password" name="password" value=""></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3"><label class="form-label" for="first_name"><strong>First Name</strong></label><input class="form-control" type="text" id="first_name" placeholder="<?php echo $data['userInfo']['user_fn'] ?>" name="first_name" value="<?php echo $data['userInfo']['user_fn'] ?>"></div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3"><label class="form-label" for="last_name"><strong>Last Name</strong></label><input class="form-control" type="text" id="last_name" placeholder="<?php echo $data['userInfo']['user_ln'] ?>" name="last_name" value="<?php echo $data['userInfo']['user_ln'] ?>"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3"><label class="form-label" for="contact_number"><strong>Contact Number</strong></label><input class="form-control" type="text" id="contact_number" placeholder="09123456789" name="contact_number" value="<?php echo $data['userInfo']['user_contact'] ?>"></div>
                                    </div>
                                    <div class="col">
                                    </div>
                                </div>
                                <div class="mb-3"><button class="btn btn-primary btn-sm" type="submit">Save Settings</button></div>
                        </div>
                    </div>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <h5 class="card-title fw-bold">Office Assignment</h5>
                        </div>
                        <div class="card-body">

                            <div class="mb-3"><label class="form-label" for="assigned"><strong>Office Assigned</strong></label><input class="form-control" type="text" id="assigned" name="assigned" placeholder="<?php echo $data['userInfo']['user_office'] ?>" value="<?php echo $data['userInfo']['user_office'] ?>"></div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3"><label class="form-label" for="position"><strong>Position</strong></label><input class="form-control" type="text" id="position" name="position" placeholder="<?php echo $data['userInfo']['user_position'] ?>" value="<?php echo $data['userInfo']['user_position'] ?>"></div>
                                </div>

                            </div>
                            <input type="hidden" name="pre-url" value="<?php echo $_SERVER['REQUEST_URI'] ?>" hidden>
                            <div class="mb-3"><button class="btn btn-primary btn-sm" type="submit">Save&nbsp;Settings</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php

if (isset($_SESSION['page_Success'])) {
    $url = PARENT_FOLDER . '/client/dashboard';
    echo "
            <script> 
                Swal.fire({
                    text: '" . $_SESSION['page_Success'] . "',
                    icon: 'success',
                    confirmButtonColor: '#0B790B',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                   
                });
            </script>
            ";
}
unset($_SESSION['page_Success']);


?>