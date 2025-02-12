<?php
include 'includesFile.php';

$router = new Router();
$url = '/' . $_GET['route'];

if(isset($_GET['fileDownload'])){
    $url = '..' . $url ;

    $filename = basename($url);
    header('Content-Type: application/octet-stream');
    header("Content-Transfer-Encoding: Binary");
    header("Content-disposition: attachment; filename=\"" . $filename . "\"");
    readfile($url);
    exit();
}

// ________________ Auth Section ________________ //
$router->addRoute('/', LoginController::class, 'show');
$router->addRoute('/login', LoginController::class, 'show');
$router->addRoute('/login/submit', LoginController::class, 'submit');
// -------------
$router->addRoute('/register', RegisterController::class, 'show');
$router->addRoute('/register/submit', RegisterController::class, 'submit');
// -------------
$router->addRoute('/logout', LogoutController::class, 'submit');


// ________________ Client Section ________________  //
$router->addRoute('/client/dashboard', ClientDashboardController::class, 'show');
// -------------
$router->addRoute('/client/request/category', ClientRequestAddController::class, 'show');
$router->addRoute('/client/request/category/submit', ClientRequestAddController::class, 'submitRequest');
// -------------
$router->addRoute('/client/request/view', RequestViewController::class, 'show');

// ________________ Admin Section ________________ //
$router->addRoute('/admin/dashboard', AdminDashboardController::class, 'show');
// -------------
$router->addRoute('/admin/request', AdminRequestController::class, 'show');
$router->addRoute('/admin/request/view', RequestViewController::class, 'show');
// -------------
$router->addRoute('/admin/users', UserController::class, 'show');
$router->addRoute('/admin/reports', AdminReportsController::class, 'show');
$router->addRoute('/admin/reports/generate', AdminReportsController::class, 'generateReport');


// ________________ Request Update Section ________________ //
$router->addRoute('/request/view/update', RequestViewController::class, 'update');
$router->addRoute('/request/view/update/status', RequestViewController::class, 'updateStatus');
$router->addRoute('/request/view/update/admin-output', RequestViewController::class, 'updateAdminOutput');
$router->addRoute('/request/view/update/client-output', RequestViewController::class, 'updateClientOutput');
$router->addRoute('/request/view/update/revision-request', RequestViewController::class, 'updateRevision');
$router->addRoute('/request/view/update/accept-request', RequestViewController::class, 'updateAccept');

// $router->addRoute('/request/view/update/revise-output', RequestViewController::class, 'updateReviseOutput');

// ________________ Notifaction Data ________________ //
$router->addRoute('/notification', NotificationController::class, 'fetch');

// ________________ Profile Section ________________ //
$router->addRoute('/profile', ProfileController::class, 'show');
$router->addRoute('/admin/users/profile', ProfileController::class, 'show');
$router->addRoute('/profile/update', ProfileController::class, 'update');
$router->addRoute('/profile/update/status', ProfileController::class, 'updateStatus');

//Request Form Genrate
$router->addRoute('/request/requestform/generate', GenerateRequestFormController::class, 'generateFormRequest');

if(!isset($_SESSION['user_id'])){

    if(($url == "/register") || ($url == "/register/submit")){
        $router->dispatch($url);
        exit();
    }
    if(($url != "/login") && ($url != "/") && ($url != "/login/submit")){
        header('Location: ' . PARENT_FOLDER . '/login');
    }

}

$router->dispatch($url);
