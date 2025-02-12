<link rel="stylesheet" href="<?php echo PARENT_FOLDER ?>/public/CSS/header.css">
<nav class="navbar navbar-expand-lg navbar-dark bg-light">
    <div class="container-fluid margin2">
        <a class="navbar-brand " href="#">
            <img src="<?php echo PARENT_FOLDER ?>/Public/img/pres header.png" alt="" width="130px" height="auto" class="d-inline-block align-text-top">
        </a>

        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ">
                <a class="nav-link active" aria-current="page" href="<?php echo PARENT_FOLDER ?>/client/dashboard">My Request</a>
                <a class="nav-link active" href="<?php echo PARENT_FOLDER ?>/client/addRequest">Add Request</a>
            </div>
        </div><button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="btn-group">
            <a href="#" class="d-flex align-items-center justify-content-center p-3 link-light text-decoration-none " id="dropdownUser3" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-bell-fill fs-3"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end text-small shadow" aria-labelledby="dropdownUser3">
                <li><a class="dropdown-item" href="#"><strong>Request Approved :</strong> Sample Activity 1</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#"><strong>Request Approved :</strong> Sample Activity 2

                    </a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#"><strong>Request Approved :</strong> Sample Activity 3</a></li>
            </ul>
        </div>
        <div class="dropdown ">
            <a href="#" class="d-flex align-items-center justify-content-center p-3 link-light text-decoration-none dropdown-toggle" id="dropdownUser3" data-bs-toggle="dropdown" aria-expanded="false">
                <!-- <img src="" alt="mdo" width="36" height="36" class="rounded-circle"> -->
                <i class="bi bi-person-circle fs-3"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end text-small shadow" aria-labelledby="dropdownUser3">
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="<?php echo PARENT_FOLDER ?>/logout">Sign out</a></li>
            </ul>
        </div>

    </div>
</nav>