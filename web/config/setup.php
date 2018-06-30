<?php

echo "Setting Up Database.\n" . '</br>';

include "conn.php";

	//Setup database tables for dashboard.
    $query = "CREATE TABLE messenger_users (
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
    
	$query = "CREATE TABLE messenger_message_log(
        id SERIAL PRIMARY KEY,
        message VARCHAR(1000)                   ,
        log_timestamp TIMESTAMP                 ,
        description VARCHAR(100)                ,
        type VARCHAR(100) 				        
    );";
	$result = pg_query($db, $query);

	$query = "CREATE TABLE messenger_error_log (
        id SERIAL PRIMARY KEY,
        message                   VARCHAR(1000),
        error_code                 INT NOT NULL,
        error_subcode              INT NOT NULL,
        error_type                 VARCHAR(100),
        error_timestamp               TIMESTAMP,
        fbtrace_id                 VARCHAR(100)			
    );";
    $result = pg_query($db, $query);

	$query = "CREATE TABLE admin_users (
        id SERIAL PRIMARY KEY,
        name VARCHAR(100) 				NOT NULL,
        email VARCHAR(100) 			    NOT NULL,
        password VARCHAR(100) 			NOT NULL,
        permissions int 				NOT NULL,
        last_login TIMESTAMP 			NOT NULL,
        sign_up_timestamp TIMESTAMP 	NOT NULL
    );";
	$result = pg_query($db, $query);

    
    $name = "Kuzi";
    $password = "NewBot123";
    $password = hash('sha256', $password);
    $time= date('Y-m-d H:i:s', time());

    $query = "INSERT INTO admin_users (id, name, email, password, permissions, last_login, sign_up_timestamp) 
            VALUES (DEFAULT, '" . $name . "','admin@sourcebot.com','" . $password . "', 1, '" . $time . "', '" . $time . "')";
	$result = pg_query($db, $query);

    $query = "CREATE TABLE bot_messages (
        id SERIAL PRIMARY KEY,
        name VARCHAR(100) 				NOT NULL,
        value text          			NOT NULL,
        last_update TIMESTAMP 			NOT NULL
    );";
    $result = pg_query($db, $query);    

    $name   = "HELP";
    $value  = "Sourcebot is an open source newsbot to help African news organisations deliver personalized news and engage more effectively via messaging platforms.";
    $name1  = "ABOUT";
    $value1 = "An open source newsbot to help African news organisations deliver personalized news and engage more effectively via messaging platforms.";
    $name2  = "FEATURE0";
    $value2 = "Features: You can search for a specific news topic by sending the topic as a message to the bot.";
    $name3  = "FEATURE1";
    $value3 = "You can get the latest news by selecting the Latest News option in the menu.";
    $name4  = "FEATURE2";
    $value4 = "Alternatively you can search for articles from a specific date or month to do this simply follow the instructions under the Articles From section in the menu.";
    $name5  = "ARTICLEMONTH";
    $value5 = "To search for articles from a specific month send a message with the year and month in the following format month:yyyy-mm e.g. month:2015-04";
    $name6  = "ARTICLEDATE";
    $value6 = "To search for articles from a specific date send a message with the year and month in the following format date:yyyy-mm-dd e.g. date:2015-04-02";

    $time   = date('Y-m-d H:i:s', time());

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

?>