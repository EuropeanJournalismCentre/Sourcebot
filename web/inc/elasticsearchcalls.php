<?php

/******************************************************************** Elasticsearch Article calls ******************************************************************************************************************************************************************/

/******************************************************************** Elasticsearch Article Search *****************************************************************************************************************************************************************/

function elasticsearch_article_query($sender, $message, $PAGE_ACCESS_TOKEN){		
	// Build the json payload data
	send_text_message($sender, "You searched for: " . $message, $PAGE_ACCESS_TOKEN);
	$image_url = 'https://sourcebotv0.herokuapp.com/images/sourcebot_profile_pic.png';
	// Build the json payload data
	$url =  "https://x9gqrh4cdv:ek9q8fj83i@sourcebotv0-9272788185.eu-west-1.bonsaisearch.net/sourcecozw-1/post/_search?source={%20%22query%22:%20{%20%22match%22:%20{%20%22post_content%22:%20%22" . $message . "%22%20}%20}%20}";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL, $url);
	$result = curl_exec($ch);
	curl_close($ch);
			
	$obj = json_decode($result);
	$i = 0;
	error_log($result);
	foreach($obj->hits->hits as $data) {
		error_log("\nHit\n");
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
				$image_url = "http://source.co.zw/wp-json/wp/v2/posts/" . $id . "?_embed";
				/*$ci = curl_init();
				curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ci, CURLOPT_URL, $image_url);
				$response = curl_exec($ci);    
				curl_close($ci);
				$image_obj = json_decode($response, true);
                $image = $image_obj["_embedded"]["wp:featuredmedia"][0]["source_url"];
                
                $response = file_get_contents($image_url);
                $image_obj = json_decode($response, true);
				$image = $image_obj["_embedded"]["wp:featuredmedia"][0]["source_url"];
                if ($image = ""){
                    $image = 'https://sourcebotv0.herokuapp.com/images/sourcebot_profile_pic.png';
                }*/
                $image = 'https://sourcebotv0.herokuapp.com/images/sourcebot_profile_pic.png';
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
	$url =  'https://x9gqrh4cdv:ek9q8fj83i@sourcebotv0-9272788185.eu-west-1.bonsaisearch.net/sourcecozw-1/post/_search?source={%20"query"%20:%20{%20"constant_score":%20{%20"filter":%20{%20"range"%20:%20{%20"post_date"%20:%20{%20"gte":%20"' . $month . '",%20"format":%20"yyyy-MM"%20}%20}%20}%20}%20}%20}';
    
    $ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL, $url);
	$result = curl_exec($ch);
	curl_close($ch);
			
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
				/*$image_url = "http://source.co.zw/wp-json/wp/v2/posts/" . $id . "?_embed";
				$ci = curl_init();
				curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ci, CURLOPT_URL, $image_url);
				$response = curl_exec($ci);    
				curl_close($ci);
				$image_obj = json_decode($response, true);
				$image = $image_obj["_embedded"]["wp:featuredmedia"][0]["source_url"];*/
				$image = 'https://sourcebotv0.herokuapp.com/images/sourcebot_profile_pic.png';
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
	$url =  'https://x9gqrh4cdv:ek9q8fj83i@sourcebotv0-9272788185.eu-west-1.bonsaisearch.net/sourcecozw-1/post/_search?source={%20"query"%20:%20{%20"constant_score":%20{%20"filter":%20{%20"range"%20:%20{%20"post_date"%20:%20{%20"gte":%20"' . $date . '",%20"lte":%20"' . $date . '",%20"format":%20"yyyy-MM-dd"%20}%20}%20}%20}%20}%20}';
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL, $url);
	$result = curl_exec($ch);
	curl_close($ch);
			
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
				/*$image_url = "http://source.co.zw/wp-json/wp/v2/posts/" . $id . "?_embed";
				$ci = curl_init();
				curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ci, CURLOPT_URL, $image_url);
				$response = curl_exec($ci);    
				curl_close($ci);
				$image_obj = json_decode($response, true);
				$image = $image_obj["_embedded"]["wp:featuredmedia"][0]["source_url"];*/
				$image = 'https://sourcebotv0.herokuapp.com/images/sourcebot_profile_pic.png';
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
	$url =  'https://x9gqrh4cdv:ek9q8fj83i@sourcebotv0-9272788185.eu-west-1.bonsaisearch.net/sourcecozw-1/post/_search?source={%20"sort"%20:%20[%20{%20"post_date"%20:%20{"order"%20:%20"desc"}},%20"_score"%20]%20}';
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL, $url);
	$result = curl_exec($ch);
    curl_close($ch);
    
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
				/*$image_url = "http://source.co.zw/wp-json/wp/v2/posts/" . $id . "?_embed";
				$ci = curl_init();
				curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ci, CURLOPT_URL, $image_url);
				$response = curl_exec($ci);    
				curl_close($ci);
				$image_obj = json_decode($response, true);
				$image = $image_obj["_embedded"]["wp:featuredmedia"][0]["source_url"];*/
				$image = 'https://sourcebotv0.herokuapp.com/images/sourcebot_profile_pic.png';
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
	$url = "https://x9gqrh4cdv:ek9q8fj83i@sourcebotv0-9272788185.eu-west-1.bonsaisearch.net/sourcecozw-1/post/_search?source={%20%22query%22:%20{%20%22match%22:%20{%20%22_id%22:%20%22" . $id . "%22%20}%20}%20}";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL, $url);
	$result = curl_exec($ch);
	curl_close($ch);
    
    $obj = json_decode($result);
	
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

	$image_url = "http://source.co.zw/wp-json/wp/v2/posts/" . $id . "?_embed";
    $ci = curl_init();
    curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ci, CURLOPT_URL, $image_url);
    $response = curl_exec($ci);    
    curl_close($ci);
    $image_obj = json_decode($response, true);
    $image = $image_obj["_embedded"]["wp:featuredmedia"][0]["source_url"];

    //send_one_button_image_template_message($sender, $image, $title, $content, "Read More?", $postback, $PAGE_ACCESS_TOKEN);
    send_one_url_button_image_template_message($sender, $image, $title, $content, $url, $PAGE_ACCESS_TOKEN);
	send_image_message($sender, $image, $PAGE_ACCESS_TOKEN);
	$max_len = 640;
    // this regular expression will split $long_string on any sub-string of
    // 1-or-more non-word characters (spaces or punctuation)
    if(preg_match_all("/.{1,{$max_len}}(?=\W+)/", $content, $lines) !== False) {
    	// $lines now contains an array of sub-strings, each will be approx.
    	// $max_len characters - depending on where the last word ended and
    	// the number of 'non-word' characters found after the last word
    	for ($i=0; $i < count($lines[0]); $i++) {
    		$post = $lines[0][$i];
			send_text_message($sender, $post, $PAGE_ACCESS_TOKEN);
        }
    }
}

/**************************************************************** End of Elasticsearch Article By Id *************************************************************************************************************************************************************/

/**************************************************************** End of Elasticsearch Article calls ***************************************************************************************************************************************************************/    

?>