<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
unset($_SESSION['page_error']);
unset($_SESSION['ui_error']);
date_default_timezone_set('Asia/Manila');
// Config file 
include_once('../config.php');

//Main Controller
include_once(ROOT . '/app/controller/src/controller.php');
include_once(ROOT . '/app/controller/src/router.php');
include_once(ROOT . '/app/controller/src/database.php');

//Authentication
include_once(ROOT . '/app/controller/authentication/login.controller.php');
include_once(ROOT . '/app/controller/authentication/register.controller.php');
include_once(ROOT . '/app/controller/authentication/logout.controller.php');

//Client
include_once(ROOT . '/app/controller/client/clientDashboard.controller.php');
include_once(ROOT . '/app/controller/client/clientRequestAdd.controller.php');

//Admin
include_once(ROOT . '/app/controller/admin/adminDashboard.controller.php');
include_once(ROOT . '/app/controller/admin/adminRequests.controller.php');
include_once(ROOT . '/app/controller/admin/adminReports.controller.php');

//Shared 
include_once(ROOT . '/app/controller/shared/users.controller.php');
include_once(ROOT . '/app/controller/shared/requestView.controller.php');
include_once(ROOT . '/app/controller/shared/profile.controller.php');
include_once(ROOT . '/app/controller/shared/notification.controller.php');
include_once(ROOT . '/app/controller/shared/emailHandler.controller.php');
include_once(ROOT . '/app/controller/shared/generateRequestForm.controller.php');

//Models
include_once(ROOT . '/app/model/user.model.php');
include_once(ROOT . '/app/model/request.model.php');
include_once(ROOT . '/app/model/transaction.model.php');
