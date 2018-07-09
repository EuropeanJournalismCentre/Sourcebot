<?php

//Start Session
session_start();

if(isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $name = $_SESSION['name'];
    $permissions = $_SESSION['permissions'];
    $status = $_SESSION['status'];
}

if($name == "" || $email == "" || $status != "logged in")
{
    unset($_SESSION['name']);
    unset($_SESSION['status']);
    unset($_SESSION['email']);
    unset($_SESSION['permissions']);
    header("Location: ../index.php");
    exit();
}

unset($_SESSION['name']);
unset($_SESSION['status']);
unset($_SESSION['email']);
unset($_SESSION['permissions']);
header("Location: ../index.php");
exit();

?>