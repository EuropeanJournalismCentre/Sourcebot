<?php

include './config/conn.php';
include './inc/db_queries.php';
include './inc/graphapi.php';
include './inc/messengerpayloads.php';
include './inc/elasticsearchcalls.php';
include './inc/supportcalls.php';
include './inc/supportfunctions.php';

$bot_messages = retrieve_bot_messages($db);

/*
 * Start Const variables
 */
define("HELP", $bot_messages[0]['value']);
define("ABOUT", $bot_messages[1]['value']);
define("FEATURE0", $bot_messages[2]['value']);
define("FEATURE1", $bot_messages[3]['value']);
define("FEATURE2", $bot_messages[4]['value']);
define("ARTICLEMONTH", $bot_messages[5]['value']);
define("ARTICLEDATE", $bot_messages[6]['value']);
/*
 * End Const Variables
 */

error_reporting(E_ALL & ~E_NOTICE);

//Retrieving our Environment Variable Values
$VERIFY_TOKEN = getenv('VERIFY_TOKEN');
$PAGE_ACCESS_TOKEN = getenv('ACCESS_TOKEN');
$PROFILE_PIC_URL = getenv('PROFILE_PIC_URL');
$WEBSITE_URL = getenv('WEBSITE_URL');

$challenge = $_REQUEST['hub_challenge'];
$verify_token = $_REQUEST['hub_verify_token'];
error_log($challenge);
$old_message = "";
if ($verify_token === $VERIFY_TOKEN) {
    //If the Verify token matches, return the challenge.
    error_log($challenge);
} else {
    $request_contents = file_get_contents('php://input');
    error_log("\nResponse: " . $request_contents . " .\n");
    $input = json_decode($request_contents, true);
    // Get error message
    $error = $input['error']['message'];
    // Get the Senders Page Scoped ID
    $sender = $input['entry'][0]['messaging'][0]['sender']['id'];
    // Get the Recipient Page Scoped ID
    $recipient = $input['entry'][0]['messaging'][0]['recipient']['id'];
    // Get the Message text sent
    $message = $input['entry'][0]['messaging'][0]['message']['text'];
    // Get the Postbacks sent
    $postback = $input['entry'][0]['messaging'][0]['postback']['payload'];
    // Get the Entity response
    //$entity = $input[entry][0]['messaging'][0]['entity']['value'];

    $greetings = array("hi", "hello", "hey", "olla", "bonjour");
    $help = array("help", "clue", "hint", "difficult", "hard", "i dont know");
    $about = array("about", "info", "411", "rules", "rule", "law", "how does this work", "explain", "describe");

    $count = 1;

    $VERIFY_TOKEN = getenv('VERIFY_TOKEN');
    $PAGE_ACCESS_TOKEN = getenv('ACCESS_TOKEN');
    $PROFILE_PIC_URL = getenv('PROFILE_PIC_URL');
    $WEBSITE_URL = getenv('WEBSITE_URL');

    if (!empty($message)) {

        $description = "User typed text.";
        $type = "User";
        $log_timestamp = date('Y-m-d H:i:s', time());
        create_messenger_message_log($message, $sender, $log_timestamp, $description, $type, $db);
        $message = strtolower($message);

        if (0 < count(array_intersect(array_map('strtolower', explode(' ', $message)), $greetings))) {
            $obj = retrieve_user_profile($sender, $PAGE_ACCESS_TOKEN);
            $name = $obj->first_name;
            $welcome_message = "Hi " . $name . "!";
            send_text_message($sender, $welcome_message, $PAGE_ACCESS_TOKEN);
            $help = HELP;
            send_text_message($sender, $help, $PAGE_ACCESS_TOKEN);
            $features = FEATURE0;
            send_text_message($sender, $features, $PAGE_ACCESS_TOKEN);
            $features1 = FEATURE1;
            send_text_message($sender, $features1, $PAGE_ACCESS_TOKEN);
            $features2 = FEATURE2;
            send_text_message($sender, $features2, $PAGE_ACCESS_TOKEN);
            send_share_button_template_message($sender, "", "", "", $PAGE_ACCESS_TOKEN, $PROFILE_PIC_URL, $WEBSITE_URL);
        } elseif (0 < count(array_intersect(array_map('strtolower', explode(' ', $message)), $help))) {
            $help = HELP;
            send_text_message($sender, $help, $PAGE_ACCESS_TOKEN);
            $features = FEATURE0;
            send_text_message($sender, $features, $PAGE_ACCESS_TOKEN);
            $features1 = FEATURE1;
            send_text_message($sender, $features1, $PAGE_ACCESS_TOKEN);
            $features2 = FEATURE2;
            send_text_message($sender, $features2, $PAGE_ACCESS_TOKEN);
            send_share_button_template_message($sender, "", "", "", $PAGE_ACCESS_TOKEN, $PROFILE_PIC_URL, $WEBSITE_URL);
        } elseif (0 < count(array_intersect(array_map('strtolower', explode(' ', $message)), $about))) {
            $help = HELP;
            send_text_message($sender, $help, $PAGE_ACCESS_TOKEN);
            $features = FEATURE0;
            send_text_message($sender, $features, $PAGE_ACCESS_TOKEN);
            $features1 = FEATURE1;
            send_text_message($sender, $features1, $PAGE_ACCESS_TOKEN);
            $features2 = FEATURE2;
            send_text_message($sender, $features2, $PAGE_ACCESS_TOKEN);
        } else {
            if (($pos = strpos($message, 'date:')) !== false) {
                $date = substr($message, $pos + 5);
                send_text_message($sender, "date: " . $date, $PAGE_ACCESS_TOKEN);
                elasticsearch_by_date($sender, $date, $PAGE_ACCESS_TOKEN);
            } elseif (($pos = strpos($message, 'month:')) !== false) {
                $month = substr($message, $pos + 6);
                send_text_message($sender, "month: " . $month, $PAGE_ACCESS_TOKEN);
                elasticsearch_by_month($sender, $month, $PAGE_ACCESS_TOKEN);
            } else {
                error_log("\nSearch: " . $message . "\n");
                send_typing_message($sender, $PAGE_ACCESS_TOKEN);
                elasticsearch_article_query($sender, $message, $PAGE_ACCESS_TOKEN);
            }
        }
    } elseif (!empty($postback)) {
        #logging the message to the message_log table in the database.
        $log_timestamp = date('Y-m-d H:i:s', time());
        $description = "Postback";
        $type = "User";
        create_messenger_message_log($postback, $sender, $log_timestamp, $description, $type, $db);

        if ($postback == 'GET_STARTED') {

            $obj = retrieve_user_profile($sender, $PAGE_ACCESS_TOKEN);
            $first_name = $obj->first_name;
            $last_name = $obj->last_name;
            $image_url = $obj->profile_pic;
            $locale = $obj->locale;
            $timezone = $obj->timezone;
            $gender = $obj->gender;
            $email = $obj->email;
            $name = $first_name . " " . $last_name;
            $sign_up_timestamp = date('Y-m-d H:i:s', time());
            $last_message_timestamp = date('Y-m-d H:i:s', time());
            $last_message = $postback;

            #Adding a user to our messenger_users table in the database.
            create_messenger_user($name, $sender, $last_message, $image_url, $locale, $timezone, $gender, $sign_up_timestamp,
                $last_message_timestamp, $db);

            $welcome_message = "Hi " . $name . "!";
            send_text_message($sender, $welcome_message, $PAGE_ACCESS_TOKEN);
            $help = HELP;
            send_text_message($sender, $help, $PAGE_ACCESS_TOKEN);
            $features = FEATURE0;
            send_text_message($sender, $features, $PAGE_ACCESS_TOKEN);
            $features1 = FEATURE1;
            send_text_message($sender, $features1, $PAGE_ACCESS_TOKEN);
            $features2 = FEATURE2;
            send_text_message($sender, $features2, $PAGE_ACCESS_TOKEN);
            send_share_button_template_message($sender, "", "", "", $PAGE_ACCESS_TOKEN, $PROFILE_PIC_URL, $WEBSITE_URL);

        } elseif ($postback == 'LATESTNEWS_PAYLOAD') {

            $obj = retrieve_user_profile($sender, $PAGE_ACCESS_TOKEN);
            $name = $obj->first_name;
            $welcome_message = "Hi " . $name . "!";
            send_text_message($sender, $welcome_message, $PAGE_ACCESS_TOKEN);
            send_typing_message($sender, $PAGE_ACCESS_TOKEN);
            elasticsearch_latest_articles($sender, $PAGE_ACCESS_TOKEN);

        } elseif ($postback == 'ARTICLESFROM_PAYLOAD') {

            $obj = retrieve_user_profile($sender, $PAGE_ACCESS_TOKEN);
            $name = $obj->first_name;
            $welcome_message = "Hi " . $name . "!";
            send_text_message($sender, $welcome_message, $PAGE_ACCESS_TOKEN);
            $articlesfrommessage = "This feature allows you to search for articles from a specific"
                . " month or date. To continue click the button below.";
            send_button_template_message($sender, $articlesfrommessage, "Continue", "ARTICLESFROM", $PAGE_ACCESS_TOKEN);

        } elseif ($postback == 'ARTICLESFROM') {

            $articlesfrommonth = "To search for articles from a specific month send a message with"
                . " the year and month in the following format month:yyyy-mm e.g. month:2015-04";
            $articlesfromdate = "To search for articles from a specific date send a message with"
                . " the year and month in the following format date:yyyy-mm-dd e.g. date:2015-04-02";
            send_text_message($sender, $articlesfrommonth, $PAGE_ACCESS_TOKEN);
            send_text_message($sender, $articlesfromdate, $PAGE_ACCESS_TOKEN);

        } elseif ($postback == 'SHARE_PAYLOAD') {

            $about = ABOUT;
            send_text_message($sender, $about, $PAGE_ACCESS_TOKEN);
            send_share_button_template_message($sender, "", "", "", $PAGE_ACCESS_TOKEN, $PROFILE_PIC_URL, $WEBSITE_URL);

        } elseif ($postback == 'HELP_PAYLOAD') {

            $help = HELP;
            send_text_message($sender, $help, $PAGE_ACCESS_TOKEN);
            $features = FEATURE0;
            send_text_message($sender, $features, $PAGE_ACCESS_TOKEN);
            $features1 = FEATURE1;
            send_text_message($sender, $features1, $PAGE_ACCESS_TOKEN);
            $features2 = FEATURE2;
            send_text_message($sender, $features2, $PAGE_ACCESS_TOKEN);
            send_share_button_template_message($sender, "", "", "", $PAGE_ACCESS_TOKEN, $PROFILE_PIC_URL, $WEBSITE_URL);

        } elseif ($postback == 'ABOUT_PAYLOAD') {

            $about = ABOUT;
            send_text_message($sender, $about, $PAGE_ACCESS_TOKEN);
            send_share_button_template_message($sender, "", "", "", $PAGE_ACCESS_TOKEN, $PROFILE_PIC_URL, $WEBSITE_URL);

        } else {

            if (($pos = strpos($postback, 'ID_')) !== false) {
                $id = substr($postback, $pos + 3);
                send_typing_message($sender, $PAGE_ACCESS_TOKEN);
                elasticsearch_by_id($sender, $id, $PAGE_ACCESS_TOKEN);
            } else {
                send_text_message($sender, $postback, $PAGE_ACCESS_TOKEN);
            }

        }
    } elseif (!empty($error)) {
        //Example Error Message
        //{"error":{"message":"(#100) The parameter recipient is required","type":"OAuthException","code":100,"fbtrace_id":"EckcOFDoLZQ"}}
        #logging the error to the error_log table in the database.
        $error_type = $input['error']['type'];
        $error_code = $input['error']['code'];
        $error_subcode = $input['error']['error_subcode'] + 0;
        $error_fbtrace_id = $input['error']['fbtrace_id'];
        $error_timestamp = date('Y-m-d H:i:s', time());
        error_log("\nError Message: " . $error . " .\n");
        error_log("\nError Message: Type - " . $error_type . " Code - " . $error_code . " Subcode - " . $error_subcode . " fbtrace_id - " . $error_fbtrace_id . " Timestamp - " . $error_timestamp . ".\n");
        create_messenger_error_log($error, $error_code, $error_subcode, $error_type, $error_timestamp, $error_fbtrace_id, $db);
    }
}
