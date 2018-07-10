<?php

include '../config/conn.php';

//Start Session
session_start();

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
if (!empty($_POST['btnLogin'])) {

    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);
    $password = trim($_POST['password']);
    $password = strip_tags($password);
    $password = htmlspecialchars($password);

    if ($email == "") {
        $login_error_message = 'Username is required!';
        echo $login_error_message . "<br>";
    } else if ($password == "") {
        $login_error_message = 'Password is required!';
        echo $login_error_message . "<br>";
    } else {
        $password = hash('sha256', $password);
        //select query
        $query = "SELECT * FROM admin_users WHERE email = '"
                  . $email .
                  "' AND password = '" .
                  $password . "';";
        error_log($query . "\n");
        $result = pg_query($db, $query);

        if (pg_num_rows($result) > 0) {
            $name = pg_fetch_result($result, 0, 1);
            $permissions = pg_fetch_result($result, 0, 4);
            $time = date('Y-m-d H:i:s', time());
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            $_SESSION['permissions'] = $permissions;
            $_SESSION['status'] = "logged in";
            $update_user = "UPDATE admin_users SET last_login= '" . $time . "' WHERE email = '" . $email ."';";
            $result = pg_query($db, $update_user);
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Incorrect user credentials, please try again!" . "<br>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Sourcebot - Sign In</title>
  <link rel="icon" type="image/png" href="./img/favicon.ico">
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:400,300'>
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="cotn_principal">
  <div class="cont_centrar">
    <div class="cont_login">
      <div class="cont_info_log_sign_up">
        <div class="col_md_login">
          <div class="cont_ba_opcitiy">      
            <h2>LOGIN</h2>  
            <p><h2>Login to your Bot's Dashboard.</h2></p> 
            <button class="btn_login" onclick="cambiar_login()">LOGIN</button>
          </div>
        </div>
        <div class="col_md_sign_up">
          <div class="cont_ba_no_opcitiy">
            <h2>Sourcebot</h2>
            <img src="./img/sourcebot_no_bg.png" width="50%" alt="Sourcebot Logo">
          </div>
        </div>
      </div>
      <div class="cont_back_info">
        <div class="cont_img_back_grey">
          <img src="./img/sourcebot_wide.png" alt="" />
        </div>
      </div>
      <div class="cont_forms" >
        <div class="cont_img_back_">
          <img src="./img/sourcebot_wide.png" alt="" />
        </div>
        <div class="cont_form_login">
          <a href="#" onclick="ocultar_login_sign_up()" ><i class="material-icons">&#xE5C4;</i></a>
          <h2>LOGIN</h2>
          <form action="index.php" method="post">
            <input type="text" name="email" placeholder="Email"/>
            <input type="password" name="password" placeholder="Password"/>
            <div class="form-group">
              <a href='./reset.php'>Forgotten Password</a>
            </div>
            <div class="form-group">
              <input type="submit" name="btnLogin" class="btn_login" value="Login"/>
            </div>
          </form>
        </div>
        <div class="cont_form_sign_up">
          <a href="#" onclick="ocultar_login_sign_up()"><i class="material-icons">&#xE5C4;</i></a>
          <h2>SIGN UP</h2>
          <input type="text" placeholder="Email" />
          <input type="text" placeholder="User" />
          <input type="password" placeholder="Password" />
          <input type="password" placeholder="Confirm Password" />
          <button class="btn_sign_up" onclick="cambiar_sign_up()">SIGN UP</button>
        </div>
      </div> 
    </div>
  </div>
</div>

<script  src="js/index.js"></script>
</body>
</html>