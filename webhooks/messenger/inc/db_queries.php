<?php

/************************************************************ Database Functions ******************************************************************************************************************************************************************/

function create_messenger_user($name, $sender_id, $last_message, $profile_pic_url, $locale, $timezone, $gender, $sign_up_timestamp,
    $last_message_timestamp, $db) {
    //Check to see if the user is in the Database. If not add them to the db.
    $query = "SELECT name FROM messenger_users WHERE facebook_id= '" . $sender_id . "'";
    $result = pg_query($db, $query);

    if (pg_num_rows($result) > 0) {
        $name = pg_fetch_result($result, 0, 0);
    } else {
        $query = "INSERT INTO messenger_users (id, name, facebook_id, profile_pic_url, locale, timezone, gender, last_message, sign_up_timestamp,
			last_message_timestamp) VALUES (DEFAULT, '" . $name . "','" . $sender_id . "', '" . $profile_pic_url . "', '" . $locale . "', '" . $timezone . "'
			, '" . $gender . "', '" . $last_message . "', '" . $sign_up_timestamp . "', '" . $sign_up_timestamp . "')";
        $result = pg_query($db, $query);
    }

}

function create_messenger_message_log($message, $sender_id, $log_timestamp, $description, $type, $db)
{
    $query = "INSERT INTO messenger_message_log (id, message, facebook_id, log_timestamp, description, type)
	VALUES (DEFAULT, '" . $message . "', '" . $sender_id . "', '" . $log_timestamp . "', '" . $description . "', '" . $type . "')";
    $result = pg_query($db, $query);
}

function create_messenger_error_log($message, $error_code, $error_subcode, $error_type, $error_timestamp, $fbtrace_id, $db)
{
    $query = "INSERT INTO messenger_error_log (id, message, error_code, error_subcode, error_type, error_timestamp, fbtrace_id)
	VALUES (DEFAULT, '" . $message . "', " . $error_code . ", " . $error_subcode . ", '" . $error_type . "', '" . $error_timestamp . "', '" . $fbtrace_id . "')";
    $result = pg_query($db, $query);
}

function create_admin_user($name, $password, $permissions, $last_login, $sign_up_timestamp)
{
    //Check to see if the user is in the Database. If not add them to the db.
    $query = "SELECT name FROM admin_users WHERE id= '" . $admin_id . "'";
    $result = pg_query($db, $query);

    if (pg_num_rows($result) > 0) {
        $name = pg_fetch_result($result, 0, 0);
    } else {
        $query = "INSERT INTO admin_users (name, password, permissions, last_login)
		VALUES ('" . $name . "','" . $password . "', '" . $permissions . "',
		'" . $last_login . "', '" . $sign_up_timestamp . "')";
        $result = pg_query($db, $query);
    }
}

function create_admin_user_log($admin_id, $admin_name, $admin_action, $permissions_level, $admin_action_timestamp, $db)
{
    if ($admin_id && $admin_name && $admin_action && $permissions_level && $admin_action_timestamp && $db) {
        $query = "INSERT INTO admin_action_log (admin_id, admin_name, admin_action, permissions_level,
		admin_action_timestamp)
		VALUES ('" . $admin_id . "','" . $admin_name . "', '" . $admin_action . "', '" . $permissions_level . "',
		'" . $admin_action_timestamp . "')";
        $result = pg_query($db, $query);
    }
}

function retrieve_bot_messages($db){
	$query = "SELECT * FROM bot_messages";
	$result = pg_query($db, $query);
	if (pg_num_rows($result) > 0){
		$bot_messages = pg_fetch_all($result);
	}else {
		$bot_messages = "No Results";
	}
	return $bot_messages;
}

/************************************************************* End of Database Functions *****************************************************************************************************************************************************************/
