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
            truncate_bot_messages($db);
            update_bot_messages("HELP", $help, $time, $db);
            update_bot_messages("ABOUT", $about, $time,$db);
            update_bot_messages("FEATURE0", $big_feature_0, $time, $db);
            update_bot_messages("FEATURE1", $big_feature_1, $time, $db);
            update_bot_messages("FEATURE2", $big_feature_2, $time, $db);
            update_bot_messages("ARTICLEMONTH", $article_month, $time, $db);
            update_bot_messages("ARTICLEDATE", $article_date, $time, $db);
            header('Location: ' . $_SERVER["HTTP_REFERER"] );
            exit;
    }elseif($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (isset($_GET['permission'])) {
            var_dump("hey wassup");
            die();
            update_admin_role($_GET['id'], $_GET['permission'], $db);
            header('Location: ' . $_SERVER["HTTP_REFERER"] );
            exit;
        }
    }
}