<?php
include __DIR__ . '/conn.php';
include __DIR__ . '/db_queries.php';

//Start Session
session_start();

$name = $_SESSION['name'];
$email = $_SESSION['email'];
$permissions = $_SESSION['permissions'];
$status = $_SESSION['status'];
error_log($name . "\n");
error_log($email . "\n");
error_log($permissions . "\n");
error_log($status . "\n");

if (empty($_SESSION['name'])) {
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
    $status = $_SESSION['status'];
    $permissions = $_SESSION['permissions'];
    if ($name == "" || $email == "" || $status != "logged in") {
        header("Location: ./index.php");
        exit();
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Sourcebot - Dashboard</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet" />
    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet" />
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
</head>

<body>
<div class="wrapper">
    <div class="sidebar" data-color="azure" data-image="assets/img/sidebar.png">
        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="#" class="simple-text">
                    Sourcebot
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="dashboard.php">
                        <i class="pe-7s-graph"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="bot_profile.php">
                        <i class="pe-7s-user"></i>
                        <p>Bot Profile</p>
                    </a>
                </li>
                <li>
                    <a href="users.php">
                        <i class="pe-7s-note2"></i>
                        <p>Users' Table</p>
                    </a>
                </li>
                <li>
                    <a href="admins.php">
                        <i class="pe-7s-note2"></i>
                        <p>Admins' Table</p>
                    </a>
                </li>
                <li>
                    <a href="diagnostics.php">
                        <i class="pe-7s-bell"></i>
                        <p>Diagnostics</p>
                    </a>
                </li>
                <li class="active-pro">
                    <a href="bot_profile.php">
                        <i class="pe-7s-config"></i>
                        <p>Settings</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Dashboard</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <p>
                                    Settings
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="bot_profile.php">Bot Profile</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="./includes/logout.php">
                                <p>Log out</p>
                            </a>
                        </li>
                        <li class="separator hidden-lg"></li>
                    </ul>
                </div>
            </div>
        </nav>
