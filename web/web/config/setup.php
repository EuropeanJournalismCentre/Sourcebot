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
        password VARCHAR(100) 			NOT NULL,
        permissions int 				NOT NULL,
        last_login TIMESTAMP 			NOT NULL,
        sign_up_timestamp TIMESTAMP 	NOT NULL
    );";
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