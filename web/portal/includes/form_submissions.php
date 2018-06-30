<?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST["bot_profile"])){
            $response = array('bot_name' => $_POST['bot_name'], 'bot_image' => $_POST['bot_image'], 'help' => $_POST['help'], 'about' => $_POST['about']);
            $fp = fopen('../bot_details.json', 'w');
            fwrite($fp, json_encode($response, JSON_PRETTY_PRINT));
            fclose($fp);
            header('Location: ' . $_SERVER["HTTP_REFERER"] );
            exit;
        } elseif(isset($_POST["admin_user"])){
            $data = array('name'=>$_POST['name'], 'email' => $_POST['email']);
        }
    }