<!DOCTYPE html>
<html lang="en" data-bs-scheme="light">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?php echo PARENT_FOLDER ?>/public/reset.css">


    <!-- For bootstrap -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- For bootstrap -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script> -->

    <!-- For Axios  -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


    <!-- For Date Picker -->
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" /> -->

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


    <link rel="stylesheet" href="<?php echo PARENT_FOLDER ?>/public/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <link rel="stylesheet" href="<?php echo PARENT_FOLDER ?>/public/css/bs-theme-overrides.css">
    <link rel="stylesheet" href="<?php echo PARENT_FOLDER ?>/public/global.css">
</head>


<title>PReS - Public Information Office Request Management System</title>
<link rel="icon" type="image/x-icon" href="<?php echo PARENT_FOLDER ?>/public/img/DNSC-LOGOPNG.png">


<body id="page-top" data-bs-scheme="light">
    <div id="wrapper">

        <?php
        if (isset($userType)) {

            if ($userType == 'admin') {
                include 'admin.sidebar.view.php';
            }
        }
        ?>

        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <?php

                
                if (isset($userType)) {
                    if ($userType == 'client') {
                        include 'client.header.view.php';
                    }
                }
                ?>
                <?php
                if (isset($userType)) {
                    if ($userType == 'admin') {
                        include 'admin.header.view.php';
                    }
                }
                ?>
                <div class="<?php if (isset($userType)) {
                                if ($userType == 'admin') {
                                    echo "container-fluid";
                                }
                            } ?>">
                    <?php include  ROOT . '/app/views/' . $view . '.view.php' ?>
                </div>
            </div>
   
        </div>
    </div>

</body>


</html>


<!-- Main custom js -->
<script src="<?php echo PARENT_FOLDER ?>/public/global.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>     
<script src="<?php echo PARENT_FOLDER ?>/public/js/theme.js"></script>