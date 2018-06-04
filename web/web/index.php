<?php

include './config/conn.php';
include './inc/db_queries.php';
include './inc/graphapi.php';
include './inc/messengerpayloads.php';
include './inc/elasticsearchcalls.php';
include './inc/supportcalls.php';
include './inc/supportfunctions.php';

error_reporting(E_ALL & ~E_NOTICE);

$VERIFY_TOKEN = 'verify';
$PAGE_ACCESS_TOKEN = 'EAABxBl3ZATskBAGG8dW89qHBPUAFeCJNdxVxBhJGi62K1rB8wQeIyRksauMlZBIc1xm8saazhrrGanGCHRhZBlZBrmjkWFZA0UgrxyZAgmXa73NZCPZBrVFUH2pYrah3meqTXgd0cSZBohPnFvD1HFWIh1XRouhr3ZAdPIHUhwsqfd8wZDZD';

$challenge = $_REQUEST['hub_challenge'];
$verify_token = $_REQUEST['hub_verify_token'];
$old_message = "";
if ($verify_token === $VERIFY_TOKEN) {
  	//If the Verify token matches, return the challenge.
  	echo $challenge;
}else {
	$request_contents = file_get_contents('php://input');
	error_log("\nRequest: " . $request_contents . " .\n");
	$input = json_decode($request_contents, true);
	// Get the Senders Page Scoped ID
	$sender = $input['entry'][0]['messaging'][0]['sender']['id'];
	// Get the Senders Page Scoped ID
	$recipient = $input['entry'][0]['messaging'][0]['recipient']['id'];
	// Get the Message text sent
	$message = $input['entry'][0]['messaging'][0]['message']['text'];
	// Get the Postbacks sent
	$postback = $input['entry'][0]['messaging'][0]['postback']['payload'];
	// Get the Entity response
	//$entity = $input[entry][0]['messaging'][0]['entity']['value'];

	$greetings = array("hi", "hello", "hey", "olla", "bonjour");
	$help = array("help", "clue", "hint", "difficult", "hard", "i dont know");
	$about = array("about","info","411","rules","rule","law","how does this work","explain","describe");

	$count = 1;

	if(!empty($message)){

		$message = strtolower($message);
		if($message != $last_message)
		{
			log_messenger_message($db, $message);
			$last_message = $message;
			$count = 0;
		}

		if(0 < count(array_intersect(array_map('strtolower', explode(' ',$message)), $greetings))){
			log_messenger_message($db, $message);
			$obj =  retrieve_user_profile($sender, $PAGE_ACCESS_TOKEN);
			$name = $obj->first_name;
			$welcome_message = "Hi ". $name . "!";
			send_text_message($sender, $welcome_message, $PAGE_ACCESS_TOKEN);
			$help = "Sourcebot is an open source newsbot to help African news organisations" 
			. " deliver personalized news and engage more effectively via messaging platforms.";
			send_text_message($sender, $help, $PAGE_ACCESS_TOKEN);
			$features = "Features: You can search for a specific news topic by sending the topic" 
			. "as a message to the bot.";
			send_text_message($sender, $features, $PAGE_ACCESS_TOKEN);
			$features1 = "You can get the latest news by selecting the Latest News option in the menu.";
			send_text_message($sender, $features1, $PAGE_ACCESS_TOKEN);
			$features2 = "Alternatively you can search for articles from a specific date or month" 
			. " to do this simply follow the instructions under the Articles From section in the menu.";
			send_text_message($sender, $features2, $PAGE_ACCESS_TOKEN);
			send_share_button_template_message($sender, "", "", "", $PAGE_ACCESS_TOKEN);
		}elseif(0 < count(array_intersect(array_map('strtolower', explode(' ',$message)), $help))){
			log_messenger_message($db, $message);
			$help = "Sourcebot is an open source newsbot to help African news organisations" 
			. " deliver personalized news and engage more effectively via messaging platforms.";
			send_text_message($sender, $help, $PAGE_ACCESS_TOKEN);
			$features = "Features: You can search for a specific news topic by sending the topic" 
			. "as a message to the bot.";
			send_text_message($sender, $features, $PAGE_ACCESS_TOKEN);
			$features1 = "You can get the latest news by selecting the Latest News option in the menu.";
			send_text_message($sender, $features1, $PAGE_ACCESS_TOKEN);
			$features2 = "Alternatively you can search for articles from a specific date or month" 
			. " to do this simply follow the instructions under the Articles From section in the menu.";
			send_text_message($sender, $features2, $PAGE_ACCESS_TOKEN);
			send_share_button_template_message($sender, "", "", "", $PAGE_ACCESS_TOKEN);
		}elseif(0 < count(array_intersect(array_map('strtolower', explode(' ',$message)), $about))){
			log_messenger_message($db, $message);
			$help = "Sourcebot is an open source newsbot to help African news organisations" 
			. " deliver personalized news and engage more effectively via messaging platforms.";
			send_text_message($sender, $help, $PAGE_ACCESS_TOKEN);
			$features = "Features: You can search for a specific news topic by sending the topic" 
			. "as a message to the bot.";
			send_text_message($sender, $features, $PAGE_ACCESS_TOKEN);
			$features1 = "You can get the latest news by selecting the Latest News option in the menu.";
			send_text_message($sender, $features1, $PAGE_ACCESS_TOKEN);
			$features2 = "Alternatively you can search for articles from a specific date or month" 
			. " to do this simply follow the instructions under the Articles From section in the menu.";
			send_text_message($sender, $features2, $PAGE_ACCESS_TOKEN);
		}elseif($message == 'sound'){
			log_messenger_message($db, $message);
			$audio_url = 'https://sourcebotv0.herokuapp.com/sounds/sourcebot.mp3';
			send_audio_message($sender, $audio_url, $PAGE_ACCESS_TOKEN);			
		}elseif($message == 'quick'){
			log_messenger_message($db, $message);
			send_one_quick_reply_message($sender, "QUICK REPLY EXAMPLE", "QUICK REPLY", "QUICK", $PAGE_ACCESS_TOKEN);
		}elseif($message == 'video'){
			log_messenger_message($db, $message);
			$video_url = 'https://sourcebotv0.herokuapp.com/videos/test.mp4';
			send_video_message($sender, $video_url, $PAGE_ACCESS_TOKEN);
		}else{
			if (($pos = strpos($message, 'date:')) !== false) {
				log_messenger_message($db, $message);
				$date = substr($message, $pos+5);
				send_text_message($sender,  "date: " . $date, $PAGE_ACCESS_TOKEN);
				elasticsearch_by_date($sender, $date, $PAGE_ACCESS_TOKEN);
			}elseif(($pos = strpos($message, 'month:')) !== false){
				log_messenger_message($db, $message);
				$month = substr($message, $pos+6);
				send_text_message($sender, "month: " . $month, $PAGE_ACCESS_TOKEN);
				elasticsearch_by_month($sender, $month, $PAGE_ACCESS_TOKEN);
			}else{
				log_messenger_message($db, $message);
				send_typing_message($sender, $PAGE_ACCESS_TOKEN);	
				elasticsearch_article_query($sender, $message, $PAGE_ACCESS_TOKEN);
			}
		}
	}elseif(!empty($postback)){
		#logging the message to the message_log table in the database.
		$message = $postback;
		$log_timestamp = date('Y-m-d H:i:s', time());
		$description = "Postback";
		$type = "User";
		create_messenger_message_log($message, $log_timestamp, $description, $type, $db);

		if($postback == 'GET_STARTED'){

			$obj =  retrieve_user_profile($sender, $PAGE_ACCESS_TOKEN);
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

			$welcome_message = "Hi ". $name . "!";
			send_text_message($sender, $welcome_message, $PAGE_ACCESS_TOKEN);
			$help = "Sourcebot is an open source newsbot to help African news organisations" 
			. " deliver personalized news and engage more effectively via messaging platforms.";
			send_text_message($sender, $help, $PAGE_ACCESS_TOKEN);
			$features = "Features: You can search for a specific news topic by sending the topic" 
			. "as a message to the bot.";
			send_text_message($sender, $features, $PAGE_ACCESS_TOKEN);
			$features1 = "You can get the latest news by selecting the Latest News option in the menu.";
			send_text_message($sender, $features1, $PAGE_ACCESS_TOKEN);
			$features2 = "Alternatively you can search for articles from a specific date or month" 
			. " to do this simply follow the instructions under the Articles From section in the menu.";
			send_text_message($sender, $features2, $PAGE_ACCESS_TOKEN);
			send_share_button_template_message($sender, "", "", "", $PAGE_ACCESS_TOKEN);

		}elseif($postback == 'LATESTNEWS_PAYLOAD'){
			
			$obj =  retrieve_user_profile($sender, $PAGE_ACCESS_TOKEN);
			$name = $obj->first_name;
			$welcome_message = "Hi ". $name . "!";
			send_text_message($sender, $welcome_message, $PAGE_ACCESS_TOKEN);
			send_typing_message($sender, $PAGE_ACCESS_TOKEN);
			elasticsearch_latest_articles($sender, $PAGE_ACCESS_TOKEN);
		
		}elseif($postback == 'ARTICLESFROM_PAYLOAD'){
			
			$obj =  retrieve_user_profile($sender, $PAGE_ACCESS_TOKEN);
			$name = $obj->first_name;
			$welcome_message = "Hi ". $name . "!";
			send_text_message($sender, $welcome_message, $PAGE_ACCESS_TOKEN);
			$articlesfrommessage = "This feature allows you to search for articles from a specific" 
			. " month or date. To continue click the button below.";
			send_button_template_message($sender, $articlesfrommessage, "Continue", "ARTICLESFROM", $PAGE_ACCESS_TOKEN);

		}elseif($postback == 'ARTICLESFROM'){
			
			$articlesfrommonth = "To search for articles from a specific month send a message with" 
			. " the year and month in the following format month:yyyy-mm e.g. month:2015-04";
			$articlesfromdate =  "To search for articles from a specific date send a message with" 
			. " the year and month in the following format date:yyyy-mm-dd e.g. date:2015-04-02";
			send_text_message($sender, $articlesfrommonth, $PAGE_ACCESS_TOKEN);
			send_text_message($sender, $articlesfromdate, $PAGE_ACCESS_TOKEN);

		}elseif($postback == 'SHARE_PAYLOAD'){
			
			$about = "An open source newsbot to help African news organisations" 
			. " deliver personalized news and engage more effectively via messaging platforms.";
			send_text_message($sender, $about, $PAGE_ACCESS_TOKEN);
			send_share_button_template_message($sender, "", "", "", $PAGE_ACCESS_TOKEN);

		}elseif($postback == 'HELP_PAYLOAD'){
			
			$help = "Sourcebot is an open source newsbot to help African news organisations" 
			. " deliver personalized news and engage more effectively via messaging platforms.";
			send_text_message($sender, $help, $PAGE_ACCESS_TOKEN);
			$features = "Features: You can search for a specific news topic by sending the topic" 
			. "as a message to the bot.";
			send_text_message($sender, $features, $PAGE_ACCESS_TOKEN);
			$features1 = "You can get the latest news by selecting the Latest News option in the menu.";
			send_text_message($sender, $features1, $PAGE_ACCESS_TOKEN);
			$features2 = "Alternatively you can search for articles from a specific date or month" 
			. " to do this simply follow the instructions under the Articles From section in the menu.";
			send_text_message($sender, $features2, $PAGE_ACCESS_TOKEN);
			send_share_button_template_message($sender, "", "", "", $PAGE_ACCESS_TOKEN);

		}elseif($postback == 'ABOUT_PAYLOAD'){
			
			$about = "An open source newsbot to help African news organisations" 
			. " deliver personalized news and engage more effectively via messaging platforms.";
			send_text_message($sender, $about, $PAGE_ACCESS_TOKEN);
			send_share_button_template_message($sender, "", "", "", $PAGE_ACCESS_TOKEN);

		}else{

			if (($pos = strpos($postback, 'ID_')) !== false) {
				$id = substr($postback, $pos+3);
				send_typing_message($sender, $PAGE_ACCESS_TOKEN);
				elasticsearch_by_id($sender, $id, $PAGE_ACCESS_TOKEN);
			}else{
				send_text_message($sender, $postback, $PAGE_ACCESS_TOKEN);
			}

		}
	}else{
		$error = $input->error->message;
		if (!empty($error)){
			#logging the message to the message_log table in the database.
			$message = $error;
			$log_timestamp = date('Y-m-d H:i:s', time());
			$description = "Error";
			$type = "Messenger";
			create_messenger_message_log($message, $log_timestamp, $description, $type, $db);
		}
	}
}

?>
