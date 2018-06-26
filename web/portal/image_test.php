<?php

$url = file_get_contents("http://source.co.zw/wp-json/wp/v2/posts/7324?_embed");
$arr = json_decode($url,true);

var_dump($url._links);
die();