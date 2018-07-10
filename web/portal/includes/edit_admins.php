<?php
    include __DIR__ . '/conn.php';
    include __DIR__ . '/db_queries.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST["bot_profile"])){
            $response = array('bot_name' => $_POST['bot_name'], 'bot_image' => $_POST['bot_image'], 'help' => $_POST['help'], 'about' => $_POST['about']);
            $fp = fopen('../bot_details.json', 'w');
            fwrite($fp, json_encode($response, JSON_PRETTY_PRINT));
            fclose($fp);
            header('Location: ' . $_SERVER["HTTP_REFERER"] );
            exit;
        } elseif(isset($_POST["add_admin"])){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $permissions = $_POST['role'];
            $password = hash('sha256', $_POST['password']);
            $time = date('Y-m-d H:i:s', time());
            create_admin_user($name, $email, $password, $permissions, $time, $time, $db);
            header('Location: ' . $_SERVER["HTTP_REFERER"] );
            exit;
        }
    }elseif($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (isset($_GET['permissions'])) {
            update_admin_role($_GET['id'], $_GET['permissions'], $db);
        }
    }