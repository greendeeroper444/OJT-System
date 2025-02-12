<link rel="stylesheet" href="<?php echo PARENT_FOLDER ?>/public/css/header.admin.css">

<nav class="navbar align-items-start sidebar  accordion bg-gradient-primary p-0 navbar-dark" style="background: #084F08;">
    <div class="container-fluid d-flex flex-column p-0">
        <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">

            <div class="sidebar-brand-text mx-3"><img src="<?php echo PARENT_FOLDER ?>/public/img/pres%20header.png" style="height: 42px;">
            </div>
        </a>
        <hr class="sidebar-divider my-0">
        <ul class="navbar-nav text-light" id="accordionSidebar">
            <li class="nav-item page-link">
                <a class="nav-link " href="<?php echo PARENT_FOLDER ?>/admin/dashboard" id="dashboard">
                    <i class="fas fa-th" style="font-size: 25;"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item page-link">
                <a class="nav-link" href="<?php echo PARENT_FOLDER ?>/admin/request" id="request">
                    <i class="fas fa-file" style="height: 57;font-size: 20px;"></i>
                    <span>Request</span>
                </a>
            </li>
            <li class="nav-item page-link">
                <a class="nav-link" href="<?php echo PARENT_FOLDER ?>/admin/users" id="users">
                    <i class="fas fa-user"></i>
                    <span>Users</span>
                </a>

            </li>
            <li class="nav-item page-link">
                <a class="nav-link" href="<?php echo PARENT_FOLDER ?>/admin/reports" id="reports">
                    <i class="fas fa-file" style="height: 57;font-size: 20px;"></i>
                    <span>Report</span>
                </a>
            </li>
            <!-- <li class="nav-item"></li> -->
        </ul>
        <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
    </div>
</nav>

<script>
    var currentPageUrl = window.location.href;
    var navLinks = document.querySelectorAll('.sidebar .nav-link');

    navLinks.forEach(function(navLink) {
        var id = navLink.getAttribute('id');

        if (currentPageUrl.indexOf(id) !== -1) {
            navLink.classList.add('active');
        }
    });
</script>