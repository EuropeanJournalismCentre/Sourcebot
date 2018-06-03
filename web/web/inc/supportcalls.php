<?php

function curl_post_async($data, $i)
{

    for ($k = 0; $k < $i; $k++) {
        $image_url = "http://source.co.zw/wp-json/wp/v2/posts/" . $data[$k][1] . "?_embed";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $image_url);
        //curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, ‘curl’);
        curl_setopt($ch, CURLOPT_TIMEOUT, 1);
        $result = curl_exec($ch);
        curl_close($ch);
        $image_obj = json_decode($result, true);
		$image = $image_obj["_embedded"]["wp:featuredmedia"][0]["source_url"];
		$data[$k][6] = $image;
    }

}

?>