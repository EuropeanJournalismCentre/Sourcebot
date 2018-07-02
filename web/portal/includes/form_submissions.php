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
        } elseif(isset($_POST["update_admin"])){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $permissions = $_POST['role'];
            $id = $_POST['id'];
            update_admin_user($name, $email, $permissions, $id, $db);
            header('Location: ' . $_SERVER["HTTP_REFERER"] );
            exit;
        } elseif(isset($_POST["bot_messages"])){
            $help = $_POST['help'];
            $about = $_POST['about'];
            $big_feature_0 = $_POST['bf0'];
            $big_feature_1 = $_POST['bf1'];
            $big_feature_2 = $_POST['bf2'];
            $article_month = $_POST['article_month'];
            $article_date = $_POST['article_date'];
            $time = date('Y-m-d H:i:s', time());
            update_bot_messages("HELP", $help, $time, "1", $db);
            update_bot_messages("ABOUT", $about, $time, "2", $db);
            update_bot_messages("FEATURE0", $big_feature_0, $time, "3", $db);
            update_bot_message("FEATURE1", $big_feature_1, $time, "4", $db);
            update_bot_messages("FEATURE2", $big_feature_2, $time, "5", $db);
            update_bot_message("ARTICLEMONTH", $article_month, $time, "6", $db);
            update_bot_messages("ARTICLEDATE", $article_date, $time, "7", $db);
            header('Location: ' . $_SERVER["HTTP_REFERER"] );
            exit;
    }elseif($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (isset($_GET['permission'])) {
            update_admin_role($_GET['id'], $_GET['permission'], $db);
            header('Location: ' . $_SERVER["HTTP_REFERER"] );
            exit;
        }
    }
}