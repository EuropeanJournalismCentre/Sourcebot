<?php

ini_set('session.save_handler', 'memcached');
ini_set('session.save_path', 'PERSISTENT=pool ' . getenv('MEMCACHIER_SERVERS'));
ini_set('memcached.sess_binary', 1);
ini_set('memcached.sess_sasl_username', getenv('MEMCACHIER_USERNAME'));
ini_set('memcached.sess_sasl_password', getenv('MEMCACHIER_PASSWORD'));

$VERIFY_TOKEN = getenv('VERIFY_TOKEN');
$PAGE_ACCESS_TOKEN = getenv('ACCESS_TOKEN');
$PROFILE_PIC_URL = getenv('PROFILE_PIC_URL');
$WEBSITE_URL = getenv('WEBSITE_URL');

error_log("Verify Token: " . getenv('VERIFY_TOKEN'));
error_log("Page Access Token: " . getenv('ACCESS_TOKEN'));
error_log("Profile Pic Url: " . getenv('PROFILE_PIC_URL'));
error_log("Website Url: " . getenv('WEBSITE_URL'));

$payload = '{
                "get_started":{
                    "payload":"GET_STARTED"
                }
            }'
;

// Send/Recieve API
$url = "https://graph.facebook.com/v2.6/me/messenger_profile?access_token=" . getenv('ACCESS_TOKEN');
// Initiate the curl
$ch = curl_init($url);
// Set the curl to POST
curl_setopt($ch, CURLOPT_POST, 1);
// Add the json payload
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
// Set the header type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
// SSL Settings
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Send the request
$result = curl_exec($ch);
curl_close($ch);
error_log("Get Started: " . $result);

$payload = '{
    "persistent_menu":[
        {
        "locale":"default",
        "composer_input_disabled": true,
        "call_to_actions":[
            {
                "title":"Latest News",
                "type":"postback",
                "payload":"LATESTNEWS_PAYLOAD"
            },
            {
                "title":"Articles from",
                "type":"postback",
                "payload":"ARTICLESFROM_PAYLOAD"
            },
            {
                "title":"Options",
                "type":"nested",
                "call_to_actions":[
                    {
                        "title":"Share",
                        "type":"postback",
                        "payload":"SHARE_PAYLOAD"
                    },
                    {
                        "title":"Help",
                        "type":"postback",
                        "payload":"HELP_PAYLOAD"
                    },
                    {
                        "title":"About",
                        "type":"postback",
                        "payload":"ABOUT_PAYLOAD"
                    }
                ]
            }
        ]
        }
    ]
}'
;

// Send/Recieve API
$url = "https://graph.facebook.com/v2.6/me/messenger_profile?access_token=" . getenv('ACCESS_TOKEN');
// Initiate the curl
$ch = curl_init($url);
// Set the curl to POST
curl_setopt($ch, CURLOPT_POST, 1);
// Add the json payload
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
// Set the header type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
// SSL Settings
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Send the request
$result = curl_exec($ch);
curl_close($ch);
error_log("Persistent Menu: " . $result);

echo "Setting Up Database.\n" . '</br>';

include "conn.php";

//Setup database tables for dashboard.
$query = "CREATE TABLE IF NOT EXISTS messenger_users (
        id SERIAL PRIMARY KEY,
        name VARCHAR(100) 				NOT NULL,
        facebook_id VARCHAR(100) UNIQUE NOT NULL,
        profile_pic_url VARCHAR(1000) 			,
        locale VARCHAR(50) 						,
        timezone VARCHAR(50) 					,
        gender VARCHAR(50) 						,
		last_message VARCHAR(1000)				,
        sign_up_timestamp TIMESTAMP 	NOT NULL,
        last_message_timestamp TIMESTAMP NOT NULL
    );";

$result = pg_query($db, $query);

$query = "CREATE TABLE IF NOT EXISTS messenger_message_log(
        id SERIAL PRIMARY KEY,
        message VARCHAR(1000)                   ,
        facebook_id VARCHAR(100)                ,
        log_timestamp TIMESTAMP                 ,
        description VARCHAR(100)                ,
        type VARCHAR(100)
    );";
$result = pg_query($db, $query);

$query = "CREATE TABLE IF NOT EXISTS messenger_error_log (
        id SERIAL PRIMARY KEY,
        message                   VARCHAR(1000),
        error_code                 INT NOT NULL,
        error_subcode              INT NOT NULL,
        error_type                 VARCHAR(100),
        error_timestamp               TIMESTAMP,
        fbtrace_id                 VARCHAR(100)
    );";
$result = pg_query($db, $query);

$query = "CREATE TABLE IF NOT EXISTS admin_users (
        id SERIAL PRIMARY KEY,
        name VARCHAR(100) 				NOT NULL,
        email VARCHAR(100) 				NOT NULL,
        password VARCHAR(100) 			NOT NULL,
        permissions int 				NOT NULL,
        last_login TIMESTAMP 			NOT NULL,
        sign_up_timestamp TIMESTAMP 	NOT NULL
    );";
$result = pg_query($db, $query);

$name = "Admin";
$password = "NewBot123";
$password = hash('sha256', $password);
$time = date('Y-m-d H:i:s', time());

$query = "INSERT INTO admin_users (id, name, email, password, permissions, last_login, sign_up_timestamp)
            VALUES (DEFAULT, '" . $name . "','admin@sourcebot.com','" . $password . "', 2, '" . $time . "', '" . $time . "')";
$result = pg_query($db, $query);

$query = "CREATE TABLE IF NOT EXISTS bot_messages (
        id SERIAL PRIMARY KEY,
        name VARCHAR(100) 				NOT NULL,
        value text          			NOT NULL,
        last_update TIMESTAMP 			NOT NULL
    );";
$result = pg_query($db, $query);

$name = "HELP";
$value = "Sourcebot is an open source newsbot to help African news organisations deliver personalized news and engage more effectively via messaging platforms.";
$name1 = "ABOUT";
$value1 = "An open source newsbot to help African news organisations deliver personalized news and engage more effectively via messaging platforms.";
$name2 = "FEATURE0";
$value2 = "Features: You can search for a specific news topic by sending the topic as a message to the bot.";
$name3 = "FEATURE1";
$value3 = "You can get the latest news by selecting the Latest News option in the menu.";
$name4 = "FEATURE2";
$value4 = "Alternatively you can search for articles from a specific date or month to do this simply follow the instructions under the Articles From section in the menu.";
$name5 = "ARTICLEMONTH";
$value5 = "To search for articles from a specific month send a message with the year and month in the following format month:yyyy-mm e.g. month:2015-04";
$name6 = "ARTICLEDATE";
$value6 = "To search for articles from a specific date send a message with the year and month in the following format date:yyyy-mm-dd e.g. date:2015-04-02";

$time = date('Y-m-d H:i:s', time());

$query = "INSERT INTO bot_messages (id, name, value, last_update)
            VALUES
            (DEFAULT, '" . $name . "', '" . $value . "', '" . $time . "')," .
    "(DEFAULT, '" . $name1 . "', '" . $value1 . "', '" . $time . "')," .
    "(DEFAULT, '" . $name2 . "', '" . $value2 . "', '" . $time . "')," .
    "(DEFAULT, '" . $name3 . "', '" . $value3 . "', '" . $time . "')," .
    "(DEFAULT, '" . $name4 . "', '" . $value4 . "', '" . $time . "')," .
    "(DEFAULT, '" . $name5 . "', '" . $value5 . "', '" . $time . "')," .
    "(DEFAULT, '" . $name6 . "', '" . $value6 . "', '" . $time . "');";
$result = pg_query($db, $query);

$query = "CREATE TABLE admin_action_log (
        id SERIAL PRIMARY KEY,
        admin_id BIGINT		 			NOT NULL,
        admin_name VARCHAR(100) 		NOT NULL,
        admin_action VARCHAR(100) 		NOT NULL,
		permissions_level int 			NOT NULL,
        admin_action_timestamp TIMESTAMP NOT NULL
    );";
$result = pg_query($db, $query);

echo "Done.\n" . '</br>';
