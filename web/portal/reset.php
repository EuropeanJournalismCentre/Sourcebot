<?php

include './config/conn.php';
include './includes/mailer.php';

//Start Session
session_start();

function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

if (!empty($_SESSION['name'])) {
    if (isset($_SESSION['email'])) {
        $name = $_SESSION['name'];
        $email = $_SESSION['email'];
        $status = $_SESSION['status'];
        if ($email != "" && $status == "logged in") {
            header("Location: dashboard.php");
            exit();
        }
    }
}

// check Login request
if (!empty($_POST['btnReset'])) {
    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    if ($email == "") {
        $reset_error_message = 'Email is required!';
        $_SESSION['msg'] = $reset_error_message;
    } else {
        $password = hash('sha256', $password);
        //select query
        $query = "SELECT * FROM admin_users WHERE email = '"
            . $email .
            "' AND permissions != 0;";
        error_log($query . "\n");
        $result = pg_query($db, $query);

        if (pg_num_rows($result) > 0) {
            $name = pg_fetch_result($result, 0, 1);
            $permissions = pg_fetch_result($result, 0, 4);
            $time = date('Y-m-d H:i:s', time());

            $password = randomPassword();          
            $enc_password = hash('sha256', $password);

            $update_user = "UPDATE admin_users SET password= '" 
            . $enc_password . "' WHERE email = '" . $email 
            . "';";
            $result = pg_query($db, $update_user);

            send_mail($email,
            "Hi " 
            . $name
            . "<br /><p> You have requested a Password reset. Your new password is <br /><b>" 
            . $password 
            . "</b><br /> If you have not requested a password reset please notify your Admin immediately! </p><br />"
            . "Regards <br />Team Sourcebot"
            , "Password Reset!");
            $_SESSION['msg'] = "Password Reset!";
        } else {
            $_SESSION['msg'] = "Incorrect user email, please try again!";
        }
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
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-color="azure" data-image="assets/img/sidebar.png">
            <!--
                    Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
                    Tip 2: you can also add an image using data-image tag
                -->
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="./index.php" class="simple-text">
                        Sourcebot
                    </a>
                </div>
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
                        <a class="navbar-brand" href="./index.php">Dashboard</a>
                    </div>
                    <div class="collapse navbar-collapse">
                    </div>
                </div>
            </nav>
            <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="header">
                                        <h4 class="title">Reset Password</h4>
                                    </div>
                                    <div class="content">
                                        <form action="reset.php" method="post">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="text" name="email" placeholder="Email" required/>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="submit" name="btnReset" class="btn btn-info btn-fill pull-right" value="Reset"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            <footer class="footer">
                <div class="container-fluid">
                    <nav class="pull-left">
                        <ul>
                            <li>
                                <a href="#">
                                    Privacy
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Terms
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    FAQ
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <p class="copyright pull-right">
                        &copy;
                        <script>
                            document.write(new Date().getFullYear())
                        </script>
                        <a href="#">Sourcebot</a>
                    </p>
                </div>
            </footer>

        </div>
    </div>


</body>

<!--   Core JS Files   -->
<script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

<!--  Charts Plugin -->
<script src="assets/js/chartist.min.js"></script>

<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>

<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>

<?php
if (!empty($_SESSION['msg'])) 
{
    $msg = $_SESSION['msg'];
    unset($_SESSION['msg']);
}
else
{
    $msg = "Reset your password.";
}
echo '<script type="text/javascript">';
echo '   $(document).ready(function () {';
echo '       demo.initChartist();';
echo '       $.notify({';
echo '           icon: "pe-7s-edit",';
echo '           message:"' . $msg . '"';
echo '       }, {';
echo '           type: "info",';
echo '           timer: 4000';
echo '       });';
echo '   });';
echo '</script>';
?>

</html>
