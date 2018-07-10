<?php

$BONSAI_URL = getenv('BONSAI_URL');
$PROFILE_PIC_URL = getenv('PROFILE_PIC_URL');
$WEBSITE_URL = getenv('WEBSITE_URL');

/******************************************************************** Elasticsearch Article Calls ******************************************************************************************************************************************************************/

/******************************************************************** Elasticsearch Article Search *****************************************************************************************************************************************************************/

function elasticsearch_article_query($sender, $message, $PAGE_ACCESS_TOKEN){		
	// Build the json payload data
	send_text_message($sender, "You searched for: " . $message, $PAGE_ACCESS_TOKEN);
	// Build the json payload data
	$url =  getenv('BONSAI_URL') 
	. "/_search/?source_content_type=application/json&source={%20%22query%22:%20{%20%22match%22:%20{%20%22post_content%22:%20%22" . $message . "%22%20}%20}%20}";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL, $url);
	$result = curl_exec($ch);
	curl_close($ch);
			
	$obj = json_decode($result);
	$i = 0;
    error_log("\nResult for search by query: " . $result . " .\n");
	foreach($obj->hits->hits as $data) {
		error_log("\nArticle Search Result - \n" . $i);
		$title = $data->_source->post_title;
		$id = $data->_source->post_id;
		$content = $data->_source->post_content;
		$date = $data->_source->post_date;
		$url = $data->_source->permalink;
		$postback = "ID_" . $id;
		$title = html_entity_decode($title);
		$content = html_entity_decode($content);
		for ($j = 0; $j < 7; $j++) {
			if ($j == 0){
				$article[$i][$j] = $title;
			}
			if ($j == 1){
				$article[$i][$j] = $id;
			}
			if ($j == 2){
				$article[$i][$j] = $title . " - " . $date;
			}
			if ($j == 3){
				$article[$i][$j] = $date;
			}
			if ($j == 4){
				$article[$i][$j] = $url;
			}
			if ($j == 5){
				$article[$i][$j] = $postback;
			}
			if ($j == 6){
				$image_url = getenv('WEBSITE_URL') . "wp-json/wp/v2/posts/" . $id . "?_embed";
				/*
				$ci = curl_init();
				curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ci, CURLOPT_URL, $image_url);
				$response = curl_exec($ci);    
				curl_close($ci);
				$image_obj = json_decode($response, true);
				$image = $image_obj["_embedded"]["wp:featuredmedia"][0]["source_url"];
				*/
				
                /*
                $response = file_get_contents($image_url);
                $image_obj = json_decode($response, true);
				$image = $image_obj["_embedded"]["wp:featuredmedia"][0]["source_url"];
                if ($image = ""){
                    $image = 'https://sourcebotv0.herokuapp.com/images/sourcebot_profile_pic.png';
				}
				*/

				error_log("\nProfile Pic Latest Articles:" . getenv('PROFILE_PIC_URL') . "\n");
                $image = getenv('PROFILE_PIC_URL');
                $article[$i][$j] = $image;
			}
		}
		$i = $i + 1;
	}
	send_array_carousel_template_message($sender, $i, $article, $PAGE_ACCESS_TOKEN);
}

/**************************************************************** End of Elasticsearch Article Search ***************************************************************************************************************************************************************/    

/******************************************************************** Elasticsearch By Month ******************************************************************************************************************************************************************/

function elasticsearch_by_month($sender, $month, $PAGE_ACCESS_TOKEN){
	// Build the json payload data
	send_text_message($sender, "Heres the News From: " . $month, $PAGE_ACCESS_TOKEN);
	// Build the json payload data
	$url =  getenv('BONSAI_URL') 
	. '/_search/?source_content_type=application/json&source={%20"query"%20:%20{%20"constant_score":%20{%20"filter":%20{%20"range"%20:%20{%20"post_date"%20:%20{%20"gte":%20"' . $month . '",%20"format":%20"yyyy-MM"%20}%20}%20}%20}%20}%20}';
    
    $ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL, $url);
	$result = curl_exec($ch);
	curl_close($ch);
	
    error_log("\nResult for search by month: " . $result . " .\n");
	$obj = json_decode($result);
	$i = 0;
	foreach($obj->hits->hits as $data) {
		$title = $data->_source->post_title;
		$id = $data->_source->post_id;
		$content = $data->_source->post_content;
		$date = $data->_source->post_date;
		$url = $data->_source->permalink;
		$postback = "ID_" . $id;
		$title = html_entity_decode($title);
		$content = html_entity_decode($content);
		for ($j = 0; $j < 7; $j++) {
			if ($j == 0){
				$article[$i][$j] = $title;
			}
			if ($j == 1){
				$article[$i][$j] = $id;
			}
			if ($j == 2){
				$article[$i][$j] = $content;
			}
			if ($j == 3){
				$article[$i][$j] = $date;
			}
			if ($j == 4){
				$article[$i][$j] = $url;
			}
			if ($j == 5){
				$article[$i][$j] = $postback;
			}
			if ($j == 6){
				/*$image_url = getenv('WEBSITE_URL') . "wp-json/wp/v2/posts/" . $id . "?_embed";
				$ci = curl_init();
				curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ci, CURLOPT_URL, $image_url);
				$response = curl_exec($ci);    
				curl_close($ci);
				$image_obj = json_decode($response, true);
				$image = $image_obj["_embedded"]["wp:featuredmedia"][0]["source_url"];*/
				$image = getenv(PROFILE_PIC_URL);
				error_log("\nProfile Pic Search By Month:" . $image. "\n");
				$article[$i][$j] = $image;
			}
		}
		$i = $i + 1;
	}
    send_array_carousel_template_message($sender, $i, $article, $PAGE_ACCESS_TOKEN);
}

/******************************************************************* End of Elasticsearch By Month ***************************************************************************************************************************************************************/    

/******************************************************************** Elasticsearch By Date ******************************************************************************************************************************************************************/

function elasticsearch_by_date($sender, $date, $PAGE_ACCESS_TOKEN){
	// Build the json payload data
	send_text_message($sender, "Heres the News From: " . $date, $PAGE_ACCESS_TOKEN);
	// Build the json payload data
	$url =  getenv('BONSAI_URL') 
	. '/_search/?source_content_type=application/json&source={%20"query"%20:%20{%20"constant_score":%20{%20"filter":%20{%20"range"%20:%20{%20"post_date"%20:%20{%20"gte":%20"' . $date . '",%20"lte":%20"' . $date . '",%20"format":%20"yyyy-MM-dd"%20}%20}%20}%20}%20}%20}';
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL, $url);
	$result = curl_exec($ch);
	curl_close($ch);
	
    error_log("\nResult for search by date: " . $result . " .\n");
	$obj = json_decode($result);
	$i = 0;
	foreach($obj->hits->hits as $data) {
		$title = $data->_source->post_title;
		$id = $data->_source->post_id;
		$content = $data->_source->post_content;
		$date = $data->_source->post_date;
		$url = $data->_source->permalink;
		$postback = "ID_" . $id;
		$title = html_entity_decode($title);
		$content = html_entity_decode($content);
		for ($j = 0; $j < 7; $j++) {
			if ($j == 0){
				$article[$i][$j] = $title;
			}
			if ($j == 1){
				$article[$i][$j] = $id;
			}
			if ($j == 2){
				$article[$i][$j] =  $date . " - " . $title;
			}
			if ($j == 3){
				$article[$i][$j] = $date;
			}
			if ($j == 4){
				$article[$i][$j] = $url;
			}
			if ($j == 5){
				$article[$i][$j] = $postback;
			}
			if ($j == 6){
				/*$image_url = getenv('WEBSITE_URL') . "wp-json/wp/v2/posts/" . $id . "?_embed";
				$ci = curl_init();
				curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ci, CURLOPT_URL, $image_url);
				$response = curl_exec($ci);    
				curl_close($ci);
				$image_obj = json_decode($response, true);
				$image = $image_obj["_embedded"]["wp:featuredmedia"][0]["source_url"];*/
				$image = getenv(PROFILE_PIC_URL);
				error_log("\nProfile Pic for Search By Date:" . getenv('PROFILE_PIC_URL') . "\n");
				$article[$i][$j] = $image;
			}
		}
		$i = $i + 1;
	}
    send_array_carousel_template_message($sender, $i, $article, $PAGE_ACCESS_TOKEN);
}

/********************************************************************* End of Elasticsearch By Date ***************************************************************************************************************************************************************/    

/******************************************************************** Elasticsearch Latest Articles ******************************************************************************************************************************************************************/

function elasticsearch_latest_articles($sender, $PAGE_ACCESS_TOKEN){
	send_text_message($sender, "Heres the Latest News: ", $PAGE_ACCESS_TOKEN);
	// Build the json payload data
	$url =  getenv('BONSAI_URL') 
	. '/_search/?source_content_type=application/json&source={%20"sort"%20:%20[%20{%20"post_date"%20:%20{"order"%20:%20"desc"}},%20"_score"%20]%20}';
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL, $url);
	$result = curl_exec($ch);
    curl_close($ch);
    
    error_log("\nResult for latest articles search: " . $result . " .\n");
	$obj = json_decode($result);
	$i = 0;
	foreach($obj->hits->hits as $data) {
		$title = $data->_source->post_title;
		$id = $data->_source->post_id;
		$content = $data->_source->post_content;
		$date = $data->_source->post_date;
		$url = $data->_source->permalink;
		$postback = "ID_" . $id;
		$title = html_entity_decode($title);
		$content = html_entity_decode($content);
		for ($j = 0; $j < 7; $j++) {
			if ($j == 0){
				$article[$i][$j] = $title;
			}
			if ($j == 1){
				$article[$i][$j] = $id;
			}
			if ($j == 2){
				$article[$i][$j] = $title . " - " . $date;
			}
			if ($j == 3){
				$article[$i][$j] = $date;
			}
			if ($j == 4){
				$article[$i][$j] = $url;
			}
			if ($j == 5){
				$article[$i][$j] = $postback;
			}
			if ($j == 6){
				/*$image_url = getenv('WEBSITE_URL') . "wp-json/wp/v2/posts/" . $id . "?_embed";
				$ci = curl_init();
				curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ci, CURLOPT_URL, $image_url);
				$response = curl_exec($ci);    
				curl_close($ci);
				$image_obj = json_decode($response, true);
				$image = $image_obj["_embedded"]["wp:featuredmedia"][0]["source_url"];*/
				$image = getenv('PROFILE_PIC_URL');
				error_log("\nProfile Pic Latest Articles:" . $image . "\n");
				$article[$i][$j] = $image;
			}
		}
		$i = $i + 1;
	}
    send_array_carousel_template_message($sender, $i, $article, $PAGE_ACCESS_TOKEN);
}

/**************************************************************** End of Elasticsearch Latest Articles ***************************************************************************************************************************************************************/

/******************************************************************** Elasticsearch Article By Id ******************************************************************************************************************************************************************/

function elasticsearch_by_id($sender, $id, $PAGE_ACCESS_TOKEN){
	$url = getenv('BONSAI_URL') 
	. "/_search/?source_content_type=application/json&source={%20%22query%22:%20{%20%22match%22:%20{%20%22_id%22:%20%22" . $id . "%22%20}%20}%20}";
	$ch = curl_init();
	error_log("\n elasticsearch_by_id url: " . $url . "\n");
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL, $url);
	$result = curl_exec($ch);
	curl_close($ch);
    error_log("\nResult for search by id: " . $result . " .\n");

    $obj = json_decode($result);
	error_log("\nId: " . $id . "\n");
	foreach($obj->hits->hits as $data) {
		$title = $data->_source->post_title;
		$id = $data->_source->post_id;
		$content = $data->_source->post_content;
		$date = $data->_source->post_date;
		$url = $data->_source->permalink;
	
		$title = html_entity_decode($title);
		$content = html_entity_decode($content);
		$postback = "ID_" . $id;
	}
	//error_log("\nContent: " . $content . "\n");

	$image_url = getenv('WEBSITE_URL') . "wp-json/wp/v2/posts/" . $id . "?_embed";
    $ci = curl_init();
	error_log("\nImage: " . $image_url . "\n");
    curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ci, CURLOPT_URL, $image_url);
    $response = curl_exec($ci);    
    curl_close($ci);
    $image_obj = json_decode($response, true);
    $image = $image_obj["_embedded"]["wp:featuredmedia"][0]["source_url"];

    //send_one_button_image_template_message($sender, $image, $title, $content, "Read More?", $postback, $PAGE_ACCESS_TOKEN);
	send_one_url_button_image_template_message($sender, $image, $title, $date . ": " . $title, $url, $PAGE_ACCESS_TOKEN);
	send_image_message($sender, $image, $PAGE_ACCESS_TOKEN);
	error_log("\nArticle By Id Content: " . $content . "\n");

	$max_len = 600;
    // this regular expression will split $long_string on any sub-string of
    // 1-or-more non-word characters (spaces or punctuation)
    if(preg_match_all("/.{1,{$max_len}}(?=\W+)/", $content, $lines) !== False) {
    	// $lines now contains an array of sub-strings, each will be approx.
    	// $max_len characters - depending on where the last word ended and
		// the number of 'non-word' characters found after the last word
		$content = trim(preg_replace('/\t+/', ' ', $content));
		error_log( print_r($lines, TRUE) );
    	for ($i=0; $i < count($lines[0]); $i++) {
			$lines[0][$i] = strip_tags($lines[0][$i]);
			//error_log("\n i: " . $i . "\n");
			//error_log("\nArticle By Id Post: " . $post . "\n");
			error_log("\nArticle By Id Lines: " . $lines[0][$i] . "\n");
			if(!(strlen($lines[0][$i]) > 0 && strlen(trim($lines[0][$i])) == 0))
				send_text_message($sender, $lines[0][$i], $PAGE_ACCESS_TOKEN);
		}
		error_log("\nArticle: Image - " . $image . " Title - " . $title . " Link - " . $link . " date - " . $date . "\n");
	}
}

/**************************************************************** End of Elasticsearch Article By Id *************************************************************************************************************************************************************/

/**************************************************************** End of Elasticsearch Article calls ***************************************************************************************************************************************************************/    

?>