<link rel="stylesheet" href="<?php echo PARENT_FOLDER ?>/public/CSS/header.admin.css">



<!-- <div class="main-container d-flex">
    <div class="sidebar" id="side_nav">
        <div class="header-box px-2 pt-3 pb-4 d-flex justify-content-between">
            <h1 class="fs-4"><span class="bg-white text-dark rounded shadow px-2 me-2">CL</span> <span class="text-white">Coding League</span></h1>
            <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i class="fal fa-stream"></i></button>
        </div>

        <ul class="list-unstyled px-2">
            <li class="active"><a href="#" class="text-decoration-none px-3 py-2 d-block"><i class="fal fa-home"></i> Dashboard</a></li>
            <li class=""><a href="#" class="text-decoration-none px-3 py-2 d-block"><i class="fal fa-list"></i>
                    Projects</a></li>
            <li class=""><a href="#" class="text-decoration-none px-3 py-2 d-block d-flex justify-content-between">
                    <span><i class="fal fa-comment"></i> Messages</span>
                    <span class="bg-dark rounded-pill text-white py-0 px-2">02</span>
                </a>
            </li>
            <li class=""><a href="#" class="text-decoration-none px-3 py-2 d-block"><i class="fal fa-envelope-open-text"></i> Services</a></li>
            <li class=""><a href="#" class="text-decoration-none px-3 py-2 d-block"><i class="fal fa-users"></i>
                    Customers</a></li>
        </ul>
        <hr class="h-color mx-2">

        <ul class="list-unstyled px-2">
            <li class=""><a href="#" class="text-decoration-none px-3 py-2 d-block"><i class="fal fa-bars"></i>
                    Settings</a></li>
            <li class=""><a href="#" class="text-decoration-none px-3 py-2 d-block"><i class="fal fa-bell"></i>
                    Notifications</a></li>

        </ul>

    </div>
    <div class="content">
        <nav class="navbar navbar-expand-md navbar-light bg-light">
            <div class="container-fluid">
                <div class="d-flex justify-content-between d-md-none d-block">
                    <button class="btn px-1 py-0 open-btn me-2"><i class="fal fa-stream"></i></button>
                    <a class="navbar-brand fs-4" href="#"><span class="bg-dark rounded px-2 py-0 text-white">CL</span></a>

                </div>
                <button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fal fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Profile</a>
                        </li>

                    </ul>

                </div>
            </div>
        </nav>

        <div class="dashboard-content px-3 pt-4">
            <h2 class="fs-5"> Dashboard</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum, totam? Sequi alias eveniet ut quas
                ullam delectus et quasi incidunt rem deserunt asperiores reiciendis assumenda doloremque provident,
                dolores aspernatur neque.</p>
        </div>
    </div>
</div> -->

<header class="sticky-top navbar navbar-expand-lg navbar-dark bg-light flex-md-nowrap p-0 ">
    <div class="container-fluid margin2">
        <a class="navbar-brand " href="#">
            <img src="<?php echo PARENT_FOLDER ?>/Public/img/pres header.png" alt="" width="130px" height="auto" class="d-inline-block align-text-top">
        </a>

        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ">
                <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>
    </div>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="btn-group">
        <a href="#" class="d-flex align-items-center justify-content-center p-3 link-light text-decoration-none " id="dropdownUser3" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-bell-fill fs-3"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-end text-small shadow" aria-labelledby="dropdownUser3">
            <li><a class="dropdown-item" href="#"><strong>New Request :</strong> Sample Activity 1</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="#"><strong>New Request :</strong> Sample Activity 2

                </a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="#"><strong>New Request :</strong> Sample Activity 3</a></li>
        </ul>
    </div>
    <div class="dropdown ">
        <a href="#" class="d-flex align-items-center justify-content-center p-3 link-light text-decoration-none dropdown-toggle" id="dropdownUser3" data-bs-toggle="dropdown" aria-expanded="false">
            <!-- <img src="" alt="mdo" width="36" height="36" class="rounded-circle"> -->
            <i class="bi bi-person-circle fs-3"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-end text-small shadow" aria-labelledby="dropdownUser3">

            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="<?php echo PARENT_FOLDER ?>/logout">Sign out</a></li>
        </ul>
    </div>

</header>




<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-1 col-lg-1 d-md-block bg-light sidebar collapse">
            <div class=" pt-5">
                <ul class="nav flex-column">
                    <li class="nav-item ">

                        <a class="nav-link  d-flex justify-content-center" title="Dashboard" aria-current="page" href="<?php echo PARENT_FOLDER ?>/admin/dashboard">
                            <span data-feather="dashboard" class="d-flex flex-row align-items-center">
                                <i class="bi bi-list-task fs-2"></i>
                            </span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link d-flex justify-content-center" title="Requests" href="<?php echo PARENT_FOLDER ?>/admin/requests">
                            <span data-feather="request"></span>
                            <i class="bi bi-file-earmark-fill fs-2"></i>
                            <!-- Requests -->
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex justify-content-center" title="Users" href="<?php echo PARENT_FOLDER ?>/admin/users">
                            <span data-feather="user"></span>
                            <i class="bi bi-person-fill fs-2"></i>
                            <!-- Users -->
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex justify-content-center " title="Reports" href="<?php echo PARENT_FOLDER ?>/admin/reports">
                            <span data-feather="users"></span>
                            <i class="bi bi-folder-fill fs-2"></i>

                            <!-- Reports -->
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex justify-content-center" title="Settings" href="<?php echo PARENT_FOLDER ?>/admin/settings">
                            <span data-feather="users"></span>
                            <i class="bi bi-gear-fill fs-2"></i>
                            <!-- Settings -->
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>