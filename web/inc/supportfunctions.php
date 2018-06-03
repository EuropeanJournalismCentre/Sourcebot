<?php

function log_messenger_message($db, $message){
    #logging the message to the message_log table in the database.
	$log_timestamp = date('Y-m-d H:i:s', time());
	$description = "Error";
	$type = "Messenger";
    create_messenger_message_log($message, $log_timestamp, $description, $type, $db);
    #logging the message to the message_log table in the database.
			$old_message = $message;
			$log_timestamp = date('Y-m-d H:i:s', time());
			$description = "Text";
			$type = "User";
			create_messenger_message_log($message, $log_timestamp, $description, $type, $db);
}

function log_messenger_error($db, $error){
    #logging the message to the message_log table in the database.
	$message = $error;
	$log_timestamp = date('Y-m-d H:i:s', time());
	$description = "Error";
    $type = "Messenger";
    create_messenger_error_log($message_id, $message, $timestamp, $description, $type, $db);
	create_messenger_message_log($message, $log_timestamp, $description, $type, $db);
}

?>