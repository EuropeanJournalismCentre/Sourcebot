<?

/****************************************************************** User Info Graph Api ******************************************************************************************************************************************************************/

/************************************************************ Retrieve User Profile Graph Api ******************************************************************************************************************************************************************/

function retrieve_user_profile($sender, $PAGE_ACCESS_TOKEN){
    $url = "https://graph.facebook.com/v3.0/" . $sender . "?fields=first_name,last_name,profile_pic,locale,timezone,gender,email&access_token=" . $PAGE_ACCESS_TOKEN . "";
	
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    $result = curl_exec($ch);
    curl_close($ch);
    
    error_log("Access Token:\n" . getenv('ACCESS_TOKEN'));
    error_log("Graph API Call :\n" . $url);
    error_log("\nResult for retrieve user profile: " . $result . " .\n");
    $obj = json_decode($result);

    return $obj;
}

/************************************************************ End of Retrieve User Profile Graph Api ******************************************************************************************************************************************************************/

/************************************************************ Display User Profile Template Graph Api ******************************************************************************************************************************************************************/

function display_profile_template_message($sender, $PAGE_ACCESS_TOKEN){
    $obj = retrieve_user_profile($sender, $PAGE_ACCESS_TOKEN);
    $first_name = $obj->first_name;
    $last_name = $obj->last_name;
    $image_url = $obj->profile_pic;
    $locale = $obj->locale;
    $timezone = $obj->timezone;
    $gender = $obj->gender;
    $email = $obj->email;
    $title = $first_name . " " . $last_name;

    $subtitle = "Info: Locale = " . $locale . " Timezone = " . $timezone . " Gender = " . $gender;
    send_one_button_image_template_message($sender, $image_url, $title, $subtitle, "More", "User Info", $PAGE_ACCESS_TOKEN);
}

/************************************************************ End of Display User Profile Template Graph Api ******************************************************************************************************************************************************************/

/********************************************************************** End of User Info Graph Api ******************************************************************************************************************************************************************/

?>
