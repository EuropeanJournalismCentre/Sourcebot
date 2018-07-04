<?php

/************************************************************ Database Functions ******************************************************************************************************************************************************************/

/*
* Queries for Messenger users
*/
function create_messenger_user($name, $sender_id, $last_message, $profile_pic_url, $locale, $timezone, $gender, $sign_up_timestamp,
	$last_message_timestamp, $db){
	//Check to see if the user is in the Database. If not add them to the db. 
	$query = "SELECT name FROM messenger_users WHERE facebook_id= '" . $sender_id . "'";
	$result = pg_query($db, $query);

	if (pg_num_rows($result) > 0){
		$name = pg_fetch_result($result, 0, 0);
	}else{
		$query = "INSERT INTO messenger_users (id, name, facebook_id, profile_pic_url, locale, timezone, gender, last_message, sign_up_timestamp,
			last_message_timestamp) VALUES (DEFAULT, '" . $name . "','" . $sender_id . "', '" . $profile_pic_url . "', '" . $locale . "', '" . $timezone . "'
			, '" . $gender . "', '" . $last_message . "', '" . $sign_up_timestamp . "', '" . $sign_up_timestamp . "')";
		$result = pg_query($db, $query);
	}

}

function retrieve_messenger_users($db){
	//Check to see if the user is in the Database. If so retrieve No. of failed allempts. If not add them to it the db and retrive No. of failed attempts 
	$query = "SELECT * FROM messenger_users";
	$result = pg_query($db, $query);
	if (pg_num_rows($result) > 0){
		$users = pg_fetch_all($result);
	}else {
		$users = "No Results";
	}
	return $users;
}
function retrieve_messenger_user($facebook_id, $db){
	//Check to see if the user is in the Database. If so retrieve No. of failed allempts. If not add them to it the db and retrive No. of failed attempts 
	$query = "SELECT * FROM messenger_users WHERE facebook_id = '" . $facebook_id . "'";
	$result = pg_query($db, $query);
	$name = pg_fetch_row($result);
	return $name;
}

function retrieve_messenger_messages($facebook_id, $db){
	$query = "SELECT * FROM messenger_message_log WHERE facebook_id = '".$facebook_id."' ORDER BY id DESC";
	$result = pg_query($db, $query);
	$name = pg_fetch_all($result);
	return $name;
}

/*
* Queries for error log
*/
function create_messenger_error_log($message, $timestamp, $description, $type, $db){
	$query = "INSERT INTO messenger_error_log (id, message, timestamp, description, type) 
	VALUES ('" . $message . "', '" . $timestamp . "', '" . $description . "', 
	'" . $type . "')";
	$result = pg_query($db, $query);
}

function retrieve_messenger_error_log($db){
	$query = "SELECT * FROM messenger_error_log";
	$result = pg_query($db, $query);
	$errors = pg_fetch_all($result);
	return $errors;
}

/*
* Queries for Admin users
*/
function create_admin_user($name, $email, $password, $permissions, $last_login, $sign_up_timestamp,$db){
	//Check to see if the user is in the Database. If not add them to the db. 
	$query = "SELECT name FROM admin_users WHERE email = '" . $email . "'";
	$result = pg_query($db, $query);

	if (pg_num_rows($result) > 0){
		$data = ['message' => 'User already exists'];
	}else{
		$query = "INSERT INTO admin_users (id, name, email, password, permissions, last_login, sign_up_timestamp) 
			VALUES (DEFAULT, '" . $name . "','" . $email . "', '" . $password . "', '" . $permissions . "', '" . $last_login. "'
			, '" . $sign_up_timestamp . "')";
		$result = pg_query($db, $query);
	}
}

function update_admin_user($name, $email, $permissions, $id, $db){
	//Check to see if the user is in the Database. If not add them to the db. 
	$query = "UPDATE admin_users SET name = '".$name."', email = '".$email."', permissions = '". $permissions ."' WHERE id = '". $id ."'";
	$result = pg_query($db, $query);
}

function update_admin_role($id, $permissions, $db){
	$query = "UPDATE admin_users SET permissions = '". $permissions ."' where id = '". $id ."'";
	$result = pg_query($db, $query);
}

function retrieve_admin_users($db){
	$query = "SELECT * FROM admin_users";
	$result = pg_query($db, $query);
	if (pg_num_rows($result) > 0){
		$name = pg_fetch_all($result);
	}else {
		$name = "No Results";
	}
	return $name;

}

function retrieve_admin_user($id, $db){
	$query = "SELECT * FROM admin_users where id = '" . $id . "'";
	$result = pg_query($db, $query);
	if (pg_num_rows($result) > 0){
		$name = pg_fetch_row($result);
	}else {
		$name = "No Results";
	}
	return $name;

}

/*
* Bot Messages queries
*/
function retrieve_bot_messages($db){
	$query = "SELECT * FROM bot_messages";
	$result = pg_query($db, $query);
	if (pg_num_rows($result) > 0){
		$messages = pg_fetch_all($result);
	}else {
		$messages = "No Results";
	}
	return $messages;

}

function truncate_bot_messages($db) {
	$query = "TRUNCATE TABLE bot_messages";
	$result = pg_query($db, $query);
}

function update_bot_messages($name, $value, $last_update, $db) {
	$query = "INSERT INTO bot_messages (name, value, last_update) VALUES('". $name ."', '".$value."', '".$last_update."')";
	$result = pg_query($db, $query);
}

/*
* Dashboard charts queries
*/
function weekly_messenger_users($start_date, $end_date, $db) {
	$query = "SELECT * FROM messenger_users WHERE sign_up_timestamp <= now() - interval '".$start_date."' day AND sign_up_timestamp >= now() - interval '".$end_date."' day";
	$result = pg_query($db, $query);
	return pg_num_rows($result);
}

function monthly_messenger_users($start_date, $end_date, $db) {
	$query = "SELECT * FROM messenger_users WHERE sign_up_timestamp <= now() - interval '".$start_date."' day AND sign_up_timestamp >= now() - interval '".$end_date."' day";
	var_dump($query);
	$result = pg_query($db, $query);
	return pg_num_rows($result);
}

function weekly_messenger_messages($start_date, $end_date, $db) {
	$query = "SELECT * FROM messenger_message_log WHERE sign_up_timestamp <= now() - interval '".$start_date."' day AND sign_up_timestamp >= now() - interval '".$end_date."' day";
	$result = pg_query($db, $query);
	return pg_num_rows($result);
}

function monthly_messenger_messages($start_date, $end_date, $db) {
	$query = "SELECT * FROM messenger_message_log WHERE sign_up_timestamp <= now() - interval '".$start_date."' day AND sign_up_timestamp >= now() - interval '".$end_date."' day";
	var_dump($query);
	$result = pg_query($db, $query);
	return pg_num_rows($result);
}

/*
* Unused Queries
*/
function retrieve_name($sender, $db){
	//Check to see if the user is in the Database. If so retrieve No. of failed allempts. If not add them to it the db and retrive No. of failed attempts 
	$query = "SELECT name FROM users WHERE id= '" . $sender . "'";
	$result = pg_query($db, $query);

	if (pg_num_rows($result) > 0){
		$name = pg_fetch_result($result, 0, 0);
	}
	return $name;
}

function retrieve_last_message($sender, $db){
	//Check to see if the user is in the Database. If so retrieve No. of failed allempts. If not add them to it the db and retrive No. of failed attempts 
	$query = "SELECT last_message FROM users WHERE id= '" . $sender . "'";
	$result = pg_query($db, $query);

	if (pg_num_rows($result) > 0){
		$last_message = pg_fetch_result($result, 0, 0);
	}else{
		update_last_message($sender, "0", $db);
		$last_message = "0";
	}
	return $last_message;
}

function update_name($sender, $name, $db){
	$query = "UPDATE users SET name = '". $name ."' WHERE id = '". $sender ."'";
	$result = pg_query($db, $query);
}

function update_last_message($sender, $last_message, $db){
	$query = "UPDATE users SET last_message = '". $last_message ."' WHERE id = '". $sender ."'";
	$result = pg_query($db, $query);
}

function update_state($sender, $state, $db){
		$query = "UPDATE users SET state = '". $state ."' WHERE id = '". $sender ."'";
		$result = pg_query($db, $query);
}

/************************************************************* End of Database Functions *****************************************************************************************************************************************************************/

?>