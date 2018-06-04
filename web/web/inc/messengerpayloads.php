<?php

/************************************************************* Message Payloads *****************************************************************************************************************************************************************/

/************************************************************* Send Message (Curl Handler) *****************************************************************************************************************************************************************/

	function send_message($access_token, $payload) {
		// Send/Recieve API
		$url = 'https://graph.facebook.com/v2.6/me/messages?access_token=' . $access_token;
		// Initiate the curl
		$ch = curl_init($url);
		// Set the curl to POST
		curl_setopt($ch, CURLOPT_POST, 1);
		// Add the json payload
		curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
		// Set the header type to application/json
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		// SSL Settings
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		// Send the request
		error_log("\nPayload: " . var_dump(json_decode($payload)) . "\n");
		$result  = curl_exec($ch);
		error_log("\nResult: " . $result . "\n");
		//Return the result
		return $result;
	}

/************************************************************* End of Send Message (Curl Handler) *****************************************************************************************************************************************************************/

/************************************************************ Send Text Message ******************************************************************************************************************************************************************/

function build_text_message_payload($sender, $message){
	// Build the json payload data
	$jsonData = '{
	    "recipient":{
	        "id":"' . $sender . '"
	    }, 
	    "message":{
	        "text": "'. $message .'"
	    }

	}';
	return $jsonData;
}

function send_text_message($sender, $message, $access_token){
	$jsonData = build_text_message_payload($sender, $message);
	$result = send_message($access_token, $jsonData);
	return $result;
}

/************************************************************ End of Send Text Message ******************************************************************************************************************************************************************/

/************************************************************ Send Typing Message ******************************************************************************************************************************************************************/

function build_typing_message_payload($sender){
	// Build the json payload data
	$jsonData = '{
		"recipient":{
			"id":"' . $sender . '"
		},
		"sender_action":"typing_on"
	}';
	return $jsonData;
}

function send_typing_message($sender, $access_token){
	$jsonData = build_typing_message_payload($sender);
	$result = send_message($access_token, $jsonData);
	return $result;
}

/************************************************************ End of Send Typing Message ******************************************************************************************************************************************************************/


/************************************************************ Send Image Message ******************************************************************************************************************************************************************/

function build_image_message_payload($sender, $image_url){
	// Build the json payload data
	$jsonData = '{
	    "recipient":{
	        "id":"' . $sender . '"
	    }, 
	    "message":{
	    	"text": "",
	        "attachment":{
		      "type":"image",
		      "payload":{
		        "url": "' . $image_url . '"
		      }
		    }
	    }
	}';
	return $jsonData;
}

function send_image_message($sender, $image_url, $access_token){
	$jsonData = build_image_message_payload($sender, $image_url);
	$result = send_message($access_token, $jsonData);
	return $result;
}

/************************************************************ End of Send Image Message ******************************************************************************************************************************************************************/

/************************************************************* Send One Quick Reply Message *****************************************************************************************************************************************************************/

function build_one_quick_reply_message_payload($sender, $text, $button1_title, $button1_payload){
	// Build the json payload data
	$jsonData = '{
	"recipient":{
		"id":"' . $sender . '"
	},
	"message":{
		"text":"' . $text . '",
		"quick_replies":[
		{
			"content_type":"text",
			"title":"'. $button1_title .'",
			"payload":"'. $button1_payload .'"
		}
		]
	}
	}';
	return $jsonData;
}

function send_one_quick_reply_message($sender, $text, $button1_title, $button1_payload, $access_token){
	$jsonData = build_one_quick_reply_message_payload($sender, $text, $button1_title, $button1_payload);
	$result = send_message($access_token, $jsonData);
	return $result;
}

/************************************************************ End of Send One Quick Reply Message ******************************************************************************************************************************************************************/

/************************************************************* Send Two Quick Reply Messages *****************************************************************************************************************************************************************/

function build_two_quick_reply_message_payload($sender, $text, $button1_title, $button1_payload, $button2_title, $button2_payload){
	// Build the json payload data
	$jsonData = '{
	"recipient":{
		"id":"' . $sender . '"
	},
	"message":{
		"text":"' . $text . '",
		"quick_replies":[
		{
			"content_type":"text",
			"title":"'. $button1_title .'",
			"payload":"'. $button1_payload .'"
		},
		{
			"content_type":"text",
			"title":"'. $button2_title .'",
			"payload":"'. $button2_payload .'"
		}
		]
	}
	}';
	return $jsonData;
}

function send_two_quick_reply_message($sender, $text, $button1_title, $button1_payload, $button2_title, $button2_payload, $access_token){
	$jsonData = build_two_quick_reply_message_payload($sender, $text, $button1_title, $button1_payload, $button2_title, $button2_payload);
	$result = send_message($access_token, $jsonData);
	return $result;
}

/************************************************************ End of Send Two Quick Reply Messages ******************************************************************************************************************************************************************/


/************************************************************* Send Three Quick Reply Messages *****************************************************************************************************************************************************************/

function build_quick_reply_message_payload($sender, $text, $button1_title, $button1_payload, $button2_title, $button2_payload, $button3_title, $button3_payload){
	// Build the json payload data
	$jsonData = '{
	"recipient":{
		"id":"' . $sender . '"
	},
	"message":{
		"text":"' . $text . '",
		"quick_replies":[
		{
			"content_type":"text",
			"title":"'. $button1_title .'",
			"payload":"'. $button1_payload .'"
		},
		{
			"content_type":"text",
			"title":"'. $button2_title .'",
			"payload":"'. $button2_payload .'"
		},
		{
			"content_type":"text",
			"title":"'. $button3_title .'",
			"payload":"'. $button3_payload .'"
		}
		]
	}
	}';
	return $jsonData;
}

function send_quick_reply_message($sender, $text, $button1_title, $button1_payload, $button2_title, $button2_payload, $button3_title, $button3_payload, $access_token){
	$jsonData = build_quick_reply_message_payload($sender, $text, $button1_title, $button1_payload, $button2_title, $button2_payload, $button3_title, $button3_payload);
	$result = send_message($access_token, $jsonData);
	return $result;
}

/************************************************************ End of Send Three Quick Reply Messages ******************************************************************************************************************************************************************/

/************************************************************* Send One Url Button Image Template*****************************************************************************************************************************************************************/

function build_one_url_button_image_template_message_payload($sender, $image_url, $title, $subtitle, $url){
	// Build the json payload data
	$jsonData = '{
	    "recipient":{
	        "id":"' . $sender . '"
	    },     
	    "message":{
	        "attachment":{
		      "type":"template",
		      "payload":{
		        "template_type":"generic",
		        "elements":[
		          {
		            "title":"' . $title . '",
		            "image_url":"' . $image_url . '",
		            "subtitle":"' . $subtitle . '",
		            "buttons":[
					  			{
		                "type":"web_url",
										"url":"' . $url . '",
										"title":"Open Site"
		              }         
		            ]
		          }
		        ]
		      }
		    }
	    }

	}';
	return $jsonData;
}

function send_one_url_button_image_template_message($sender, $image_url, $title, $subtitle, $url, $access_token){
	$jsonData = build_one_url_button_image_template_message_payload($sender, $image_url, $title, $subtitle, $url);
	$result = send_message($access_token, $jsonData);
	return $result;
}

/************************************************************* End of Send One Url Button Image Template*****************************************************************************************************************************************************************/


/************************************************************* Send Button Message *****************************************************************************************************************************************************************/

function build_button_template_message_payload($sender, $text, $button_title, $button_payload){
	// Build the json payload data
		$jsonData = '{
		"recipient":{
			"id":"' . $sender . '"
		},
		"message":{
			"attachment":{
				"type":"template",
				"payload":{
					"template_type":"button",
					"text":"' . $text . '",
					"buttons":[
					  {
		                "type":"postback",
						"title":"' . $button_title . '",
						"payload":"' . $button_payload . '"
		              }         
		            ]
				}		
			}
		}
	}';
	return $jsonData;
}

function send_button_template_message($sender, $text, $button_title, $button_payload, $access_token){
	$jsonData = build_button_template_message_payload($sender, $text, $button_title, $button_payload);
	$result = send_message($access_token, $jsonData);
	return $result;
}

/************************************************************* End of Send Button Message *****************************************************************************************************************************************************************/


/************************************************************* Send Two Buttons Message *****************************************************************************************************************************************************************/

function build_two_button_template_message_payload($sender, $text, $button1_title, $button1_payload, $button2_title, $button2_payload){
	// Build the json payload data
	$jsonData = '{
		"recipient":{
			"id":"' . $sender . '"
		},
		"message":{
			"attachment":{
				"type":"template",
				"payload":{
					"template_type":"button",
					"text":"' . $text . '",
					"buttons":[
					  {
		                "type":"postback",
						"title":"' . $button1_title . '",
						"payload":"' . $button1_payload . '"
		              }, 
		              {
		                "type":"postback",
						"title":"' . $button2_title . '",
						"payload":"' . $button2_payload . '"
		              }          
		            ]
				}		
			}
		}
	}';
	return $jsonData;
}

function send_two_button_template_message($sender, $text, $button1_title, $button1_payload, $button2_title, $button2_payload, $access_token){
	$jsonData = build_two_button_template_message_payload($sender, $text, $button1_title, $button1_payload, $button2_title, $button2_payload);
	$result = send_message($access_token, $jsonData);
	return $result;
}

/************************************************************* End of Send Two Buttons Message*****************************************************************************************************************************************************************/

/************************************************************* Send Three Buttons Message *****************************************************************************************************************************************************************/

function build_three_button_template_message_payload($sender, $text, $button1_title, $button1_payload, $button2_title, $button2_payload, $button3_title, $button3_payload){
	// Build the json payload data
	$jsonData = '{
		"recipient":{
			"id":"' . $sender . '"
		},
		"message":{
			"attachment":{
				"type":"template",
				"payload":{
					"template_type":"button",
					"text":"' . $text . '",
					"buttons":[
					  {
		                "type":"postback",
						"title":"' . $button1_title . '",
						"payload":"' . $button1_payload . '"
		              }, 
		              {
		                "type":"postback",
						"title":"' . $button2_title . '",
						"payload":"' . $button2_payload . '"
		              }, 
		              {
		                "type":"postback",
						"title":"' . $button3_title . '",
						"payload":"' . $button3_payload . '"
		              }             
		            ]
				}		
			}
		}
	}';
	return $jsonData;
}

function send_three_button_template_message($sender, $text, $button1_title, $button1_payload, $button2_title, $button2_payload, $button3_title, $button3_payload, $access_token){
	$jsonData = build_three_button_template_message_payload($sender, $text, $button1_title, $button1_payload, $button2_title, $button2_payload, $button3_title, $button3_payload);
	$result = send_message($access_token, $jsonData);
	return $result;
}

/************************************************************* End of Send Three Buttons Message*****************************************************************************************************************************************************************/

/************************************************************* Send Share Button Message *****************************************************************************************************************************************************************/

function build_share_button_template_message_payload($sender, $text, $button_title, $button_payload){
// Build the json payload data
	$jsonData = '{
		"recipient":{
			"id":"' . $sender . '"
		},
  	"message":{
    	"attachment":{
      	"type":"template",
      	"payload":{
        	"template_type":"generic",
        	"elements":[
          	{
            	"title":"Share",
            	"subtitle":"Share Sourcebot.",
            	"image_url":"https://sourcebotv0.herokuapp.com/images/sourcebot_profile_pic.png",
            	"buttons":[
              	{
                	"type":"element_share"
								},				 
								{
									"type":"web_url",
									"url":"http://source.co.zw/",
									"title":"Daily Business News"
								}               
            	]
          	}
        	]
      	}
    	}
		}
	}';
	return $jsonData;
}

function send_share_button_template_message($sender, $text, $button_title, $button_payload, $access_token){
	$jsonData = build_share_button_template_message_payload($sender, $text, $button_title, $button_payload);
	$result = send_message($access_token, $jsonData);
	return $result;
}

/************************************************************* End of Send Share Button Message *****************************************************************************************************************************************************************/

/************************************************************* Send One Button Image Template*****************************************************************************************************************************************************************/

function build_one_button_image_template_message_payload($sender, $image_url, $title, $subtitle, $button1_title, $button1_payload){
	// Build the json payload data
	$jsonData = '{
	    "recipient":{
	        "id":"' . $sender . '"
	    },     
	    "message":{
	        "attachment":{
		      "type":"template",
		      "payload":{
		        "template_type":"generic",
		        "elements":[
		          {
		            "title":"' . $title . '",
		            "image_url":"' . $image_url . '",
		            "subtitle":"' . $subtitle . '",
		            "buttons":[
					  {
		                "type":"postback",
						"title":"' . $button1_title . '",
						"payload":"' . $button1_payload . '"
		              }         
		            ]
		          }
		        ]
		      }
		    }
	    }

	}';
	return $jsonData;
}

function send_one_button_image_template_message($sender, $image_url, $title, $subtitle, $button1_title, $button1_payload, $access_token){
	$jsonData = build_one_button_image_template_message_payload($sender, $image_url, $title, $subtitle, $button1_title, $button1_payload);
	$result = send_message($access_token, $jsonData);
	return $result;
}

/************************************************************* End of Send One Button Image Template*****************************************************************************************************************************************************************/


/************************************************************* Send Two Button Image Template*****************************************************************************************************************************************************************/

function build_two_button_image_template_message_payload($sender, $image_url, $title, $subtitle, $button1_title, $button1_payload, $button2_title, $button2_payload){
	// Build the json payload data
	$jsonData = '{
	    "recipient":{
	        "id":"' . $sender . '"
	    },     
	    "message":{
	        "attachment":{
		      "type":"template",
		      "payload":{
		        "template_type":"generic",
		        "elements":[
		          {
		            "title":"' . $title . '",
		            "image_url":"' . $image_url . '",
		            "subtitle":"' . $subtitle . '",
		            "buttons":[
					  {
		                "type":"postback",
						"title":"' . $button1_title . '",
						"payload":"' . $button1_payload . '"
		              }, 
		              {
		                "type":"postback",
						"title":"' . $button2_title . '",
						"payload":"' . $button2_payload . '"
		              }          
		            ]
		          }
		        ]
		      }
		    }
	    }

	}';
	return $jsonData;
}

function send_two_button_image_template_message($sender, $image_url, $title, $subtitle, $button1_title, $button1_payload, $button2_title, $button2_payload, $access_token){
	$jsonData = build_two_button_image_template_message_payload($sender, $image_url, $title, $subtitle, $button1_title, $button1_payload, $button2_title, $button2_payload);
	$result = send_message($access_token, $jsonData);
	return $result;
}

/************************************************************* End of Send Two Button Image Template*****************************************************************************************************************************************************************/


/*************************************************************Send Video Message*****************************************************************************************************************************************************************/

function build_video_message_payload($sender, $video_url){
	// Build the json payload data
	$jsonData = '{
  "recipient":{
    "id":"' . $sender . '"
  },
  "message":{
    "attachment":{
      "type":"video",
      "payload":{
        "url":"' . $video_url . '"
      }
    }
  }
}';
	return $jsonData;
}

function send_video_message($sender, $video_url, $access_token){
	$jsonData = build_video_message_payload($sender, $video_url);
	$result = send_message($access_token, $jsonData);
	return $result;
}

/*************************************************************End of Send Video Message*****************************************************************************************************************************************************************/


/*************************************************************Send File Message*****************************************************************************************************************************************************************/

function build_file_message_payload($sender, $file_url){
	// Build the json payload data
	$jsonData = '{
  "recipient":{
    "id":"' . $sender . '"
  },
  "message":{
    "attachment":{
      "type":"file",
      "payload":{
        "url":"' . $file_url . '"
      }
    }
  }
}';
	return $jsonData;
}

function send_file_message($sender, $file_url, $access_token){
	$jsonData = build_file_message_payload($sender, $file_url);
	$result = send_message($access_token, $jsonData);
	return $result;
}

/*************************************************************End of Send File Message*****************************************************************************************************************************************************************/


/************************************************************Send Image Template Message ******************************************************************************************************************************************************************/

function build_image_template_message_payload($sender, $image_url, $title, $subtitle){
	// Build the json payload data
	$jsonData = '{
	    "recipient":{
	        "id":"' . $sender . '"
	    },     
	    "message":{
	        "attachment":{
		      "type":"template",
		      "payload":{
		        "template_type":"generic",
		        "elements":[
		          {
		            "title":"' . $title . '",
		            "image_url":"' . $image_url . '",
		            "subtitle":"' . $subtitle . '",
					"buttons":[
		              {
		                "type":"web_url",
		                "url":"' . $image_url . '",
		                "title":"View Image"
		              }          
		            ]
		          }
		        ]
		      }
		    }
	    }

}';
	return $jsonData;
}

function send_image_template_message($sender, $image_url, $title, $subtitle, $access_token){
	$jsonData = build_image_template_message_payload($sender, $image_url, $title, $subtitle);
	$result = send_message($access_token, $jsonData);
	return $result;
}

/************************************************************End of Send Image Template Message******************************************************************************************************************************************************************/

/************************************************************Send Image One Button Template Message******************************************************************************************************************************************************************/

function build_image_template_one_button_message_payload($sender, $image_url, $title, $subtitle, $site_url){
	// Build the json payload data
	$jsonData = '{
	    "recipient":{
	        "id":"' . $sender . '"
	    },     
	    "message":{
	        "attachment":{
		      "type":"template",
		      "payload":{
		        "template_type":"generic",
		        "elements":[
		          {
		            "title":"' . $title . '",
		            "image_url":"' . $image_url . '",
		            "subtitle":"' . $subtitle . '",
		            "buttons":[
		              {
		                "type":"web_url",
		                "url":"' . $site_url . '",
		                "title":"View Website"
		              }          
		            ]
		          }
		        ]
		      }
		    }
	    }

}';
	return $jsonData;
}

function send_image_template_one_button_message($sender, $image_url, $title, $subtitle, $site_url, $access_token){
	$jsonData = build_image_template_one_button_message_payload($sender, $image_url, $title, $subtitle, $site_url);
	$result = send_message($access_token, $jsonData);
	return $result;
}

/************************************************************End of Send Image One Button Template Message******************************************************************************************************************************************************************/


/************************************************************Send Audio Message ******************************************************************************************************************************************************************/

function build_audio_message_payload($sender, $audio_url){
	// Build the json payload data
	$jsonData = '{
  "recipient":{
    "id":"' . $sender . '"
  },
  "message":{
    "attachment":{
      "type":"audio",
      "payload":{
        "url":"' . $audio_url . '"
      }
    }
  }
}';
	return $jsonData;
}

function send_audio_message($sender, $audio_url, $access_token){
	$jsonData = build_audio_message_payload($sender, $audio_url);
	$result = send_message($access_token, $jsonData);
	return $result;
}

/************************************************************End of Send Audio Message ******************************************************************************************************************************************************************/

/************************************************************* Carousel Template*****************************************************************************************************************************************************************/

function build_carousel_template_message_payload($sender){
	$title = "The Source";
	
	$image_url ='https://sourcebotv0.herokuapp.com/images/sourcebot_profile_pic.png';
	
	$subtitle = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.";
	
	$button_title = "Read More";
	
	$button_payload = "readmore";

	
	// Build the json payload data
	$jsonData = '{
	"recipient": {
		"id": "' . $sender . '"
	},
	"message": {
		"attachment": {
			"type": "template",
			"payload": {
				"template_type": "generic",
				"elements": [
				{
		            "title":"' . $title . '",
		            "image_url":"' . $image_url . '",
		            "subtitle":"' . $subtitle . '",
		            "buttons":[
					  {
		                "type":"postback",
						"title":"' . $button_title . '",
						"payload":"' . $button_payload . '"
		              }          
		            ]
		          }, 
				  {
		            "title":"' . $title . '",
		            "image_url":"' . $image_url . '",
		            "subtitle":"' . $subtitle . '",
		            "buttons":[
					  {
		                "type":"postback",
						"title":"' . $button_title . '",
						"payload":"' . $button_payload . '"
		              }         
		            ]
		          },
				  {
		            "title":"' . $title . '",
		            "image_url":"' . $image_url . '",
		            "subtitle":"' . $subtitle . '",
		            "buttons":[
					  {
		                "type":"postback",
						"title":"' . $button_title . '",
						"payload":"' . $button_payload . '"
		              }         
		            ]
		          }, 
				  {
		            "title":"' . $title . '",
		            "image_url":"' . $image_url . '",
		            "subtitle":"' . $subtitle . '",
		            "buttons":[
					  {
		                "type":"postback",
						"title":"' . $button_title . '",
						"payload":"' . $button_payload . '"
		              }         
		            ]
		          },
				  {
		            "title":"' . $title . '",
		            "image_url":"' . $image_url . '",
		            "subtitle":"' . $subtitle . '",
		            "buttons":[
					  {
		                "type":"postback",
						"title":"' . $button_title . '",
						"payload":"' . $button_payload . '"
		              }          
		            ]
		          }, 
				  {
		            "title":"' . $title . '",
		            "image_url":"' . $image_url . '",
		            "subtitle":"' . $subtitle . '",
		            "buttons":[
					  {
		                "type":"postback",
						"title":"' . $button_title . '",
						"payload":"' . $button_payload . '"
		              }         
		            ]
		          },
				  {
		            "title":"' . $title . '",
		            "image_url":"' . $image_url . '",
		            "subtitle":"' . $subtitle . '",
		            "buttons":[
					  {
		                "type":"postback",
						"title":"' . $button_title . '",
						"payload":"' . $button_payload . '"
		              }         
		            ]
		          }, 
				  {
		            "title":"' . $title . '",
		            "image_url":"' . $image_url . '",
		            "subtitle":"' . $subtitle . '",
		            "buttons":[
					  {
		                "type":"postback",
						"title":"' . $button_title . '",
						"payload":"' . $button_payload . '"
		              }         
		            ]
		          },
				  {
		            "title":"' . $title . '",
		            "image_url":"' . $image_url . '",
		            "subtitle":"' . $subtitle . '",
		            "buttons":[
					  {
		                "type":"postback",
						"title":"' . $button_title . '",
						"payload":"' . $button_payload . '"
		              }         
		            ]
		          }, 
				  {
		            "title":"' . $title . '",
		            "image_url":"' . $image_url . '",
		            "subtitle":"' . $subtitle . '",
		            "buttons":[
					  {
		                "type":"postback",
						"title":"' . $button_title . '",
						"payload":"' . $button_payload . '"
		              }         
		            ]
		          }
				  ]
			}
		}
	}
	}';

	return $jsonData;
}

function send_carousel_template_message($sender, $access_token){
	$jsonData = build_carousel_template_message_payload($sender);
	$result = send_message($access_token, $jsonData);
	return $result;
}

/************************************************************* End of Carousel Template*****************************************************************************************************************************************************************/

/************************************************************* Array Carousel Template*****************************************************************************************************************************************************************/

function build_array_carousel_template_message_payload($data, $i, $sender){

	/*for ($k = 0; $k < $i; $k++) {
		$image_url = "http://source.co.zw/wp-json/wp/v2/posts/" . $data[$k][1] . "?_embed";
  	$ci = curl_init();
  	curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, false);
  	curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ci, CURLOPT_URL, $image_url);
		curl_setopt($ci, CURLOPT_TIMEOUT, 3);
  	$response = curl_exec($ci);    
  	curl_close($ci);
  	$image_obj = json_decode($response, true);
		$image = $image_obj["_embedded"]["wp:featuredmedia"][0]["source_url"];
		$data[$k][6] = $image;
	}

	for ($k = 0; $k < $i; $k++) {
    $parts=parse_url($url);
    $fp = fsockopen($parts[‘host’], 
        isset($parts[‘port’])?$parts[‘port’]:80, 
        $errno, $errstr, 30);
    pete_assert(($fp!=0), "Couldn’t open a socket to ".$url." (".$errstr.")");
    $out = "POST ".$parts[‘path’]." HTTP/1.1\r\n";
    $out.= "Host: ".$parts[‘host’]."\r\n";
    $out.= "Content-Type: application/x-www-form-urlencoded\r\n";
    $out.= "Content-Length: ".strlen($post_string)."\r\n";
    $out.= "Connection: Close\r\n\r\n";
    fwrite($fp, $out);
    fclose($fp);
	}*/

/*
$image_url = "http://source.co.zw/wp-json/wp/v2/posts/" . $data[0][1] . "?_embed";
$ci = curl_init();
curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ci, CURLOPT_URL, $image_url);
$response = curl_exec($ci);    
curl_close($ci);
$image_obj = json_decode($response, true);
$image = $image_obj["_embedded"]["wp:featuredmedia"][0]["source_url"];
$data[0][6] = $image;

$image_url = "http://source.co.zw/wp-json/wp/v2/posts/" . $data[1][1] . "?_embed";
$ci = curl_init();
curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ci, CURLOPT_URL, $image_url);
$response = curl_exec($ci);    
curl_close($ci);
$image_obj = json_decode($response, true);
$image = $image_obj["_embedded"]["wp:featuredmedia"][0]["source_url"];
$data[1][6] = $image;

$image_url = "http://source.co.zw/wp-json/wp/v2/posts/" . $data[2][1] . "?_embed";
$ci = curl_init();
curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ci, CURLOPT_URL, $image_url);
$response = curl_exec($ci);    
curl_close($ci);
$image_obj = json_decode($response, true);
$image = $image_obj["_embedded"]["wp:featuredmedia"][0]["source_url"];
$data[2][6] = $image;

$image_url = "http://source.co.zw/wp-json/wp/v2/posts/" . $data[3][1] . "?_embed";
$ci = curl_init();
curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ci, CURLOPT_URL, $image_url);
$response = curl_exec($ci);    
curl_close($ci);
$image_obj = json_decode($response, true);
$image = $image_obj["_embedded"]["wp:featuredmedia"][0]["source_url"];
$data[3][6] = $image;

$image_url = "http://source.co.zw/wp-json/wp/v2/posts/" . $data[4][1] . "?_embed";
$ci = curl_init();
curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ci, CURLOPT_URL, $image_url);
$response = curl_exec($ci);    
curl_close($ci);
$image_obj = json_decode($response, true);
$image = $image_obj["_embedded"]["wp:featuredmedia"][0]["source_url"];
$data[4][6] = $image;

$image_url = "http://source.co.zw/wp-json/wp/v2/posts/" . $data[5][1] . "?_embed";
$ci = curl_init();
curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ci, CURLOPT_URL, $image_url);
$response = curl_exec($ci);    
curl_close($ci);
$image_obj = json_decode($response, true);
$image = $image_obj["_embedded"]["wp:featuredmedia"][0]["source_url"];
$data[5][6] = $image;

$image_url = "http://source.co.zw/wp-json/wp/v2/posts/" . $data[6][1] . "?_embed";
$ci = curl_init();
curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ci, CURLOPT_URL, $image_url);
$response = curl_exec($ci);    
curl_close($ci);
$image_obj = json_decode($response, true);
$image = $image_obj["_embedded"]["wp:featuredmedia"][0]["source_url"];
$data[6][6] = $image;

$image_url = "http://source.co.zw/wp-json/wp/v2/posts/" . $data[7][1] . "?_embed";
$ci = curl_init();
curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ci, CURLOPT_URL, $image_url);
$response = curl_exec($ci);    
curl_close($ci);
$image_obj = json_decode($response, true);
$image = $image_obj["_embedded"]["wp:featuredmedia"][0]["source_url"];
$data[7][6] = $image;

$image_url = "http://source.co.zw/wp-json/wp/v2/posts/" . $data[8][1] . "?_embed";
$ci = curl_init();
curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ci, CURLOPT_URL, $image_url);
$response = curl_exec($ci);    
curl_close($ci);
$image_obj = json_decode($response, true);
$image = $image_obj["_embedded"]["wp:featuredmedia"][0]["source_url"];
$data[8][6] = $image;

$image_url = "http://source.co.zw/wp-json/wp/v2/posts/" . $data[9][1] . "?_embed";
$ci = curl_init();
curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ci, CURLOPT_URL, $image_url);
$response = curl_exec($ci);    
curl_close($ci);
$image_obj = json_decode($response, true);
$image = $image_obj["_embedded"]["wp:featuredmedia"][0]["source_url"];
$data[9][6] = $image;
*/

//curl_post_async($data, $i);

	$button_title = "Read More?";

	// Build the json payload data
	$jsonData = '{
	"recipient": {
		"id": "' . $sender . '"
	},
	"message": {
		"attachment": {
			"type": "template",
			"payload": {
				"template_type": "generic",
				"elements": [
				{
		            "title":"' . $data[0][0] . '",
		            "image_url":"' . $data[0][6] . '",
		            "subtitle":"' . $data[0][2] . '",
		            "buttons":[
					  {
		                "type":"postback",
						"title":"' . $button_title . '",
						"payload":"' . $data[0][5] . '"
		              }          
		            ]
		          }, 
							{
		            "title":"' . $data[1][0] . '",
		            "image_url":"' . $data[1][6] . '",
		            "subtitle":"' . $data[0][2] . '",
		            "buttons":[
					  {
		                "type":"postback",
						"title":"' . $button_title . '",
						"payload":"' . $data[1][5] . '"
		              }          
		            ]
		          },
							{
		            "title":"' . $data[2][0] . '",
		            "image_url":"' . $data[2][6] . '",
		            "subtitle":"' . $data[0][2] . '",
		            "buttons":[
					  	{
		            "type":"postback",
								"title":"' . $button_title . '",
								"payload":"' . $data[2][5] . '"
		          }          
		          ]
		          }, 
							{
		            "title":"' . $data[3][0] . '",
		            "image_url":"' . $data[3][6] . '",
		            "subtitle":"' . $data[0][2] . '",
		            "buttons":[
					  {
		                "type":"postback",
						"title":"' . $button_title . '",
						"payload":"' . $data[3][5] . '"
		              }          
		            ]
		          },
							{
		            "title":"' . $data[4][0] . '",
		            "image_url":"' . $data[4][6] . '",
		            "subtitle":"' . $data[0][2] . '",
		            "buttons":[
					  {
		                "type":"postback",
						"title":"' . $button_title . '",
						"payload":"' . $data[4][5] . '"
		              }          
		            ]
		          }, 
							{
		            "title":"' . $data[5][0] . '",
		            "image_url":"' . $data[5][6] . '",
		            "subtitle":"' . $data[0][2] . '",
		            "buttons":[
					  {
		                "type":"postback",
						"title":"' . $button_title . '",
						"payload":"' . $data[5][5] . '"
		              }          
		            ]
		          },
							{
		            "title":"' . $data[6][0] . '",
		            "image_url":"' . $data[6][6] . '",
		            "subtitle":"' . $data[0][2] . '",
		            "buttons":[
					  {
		                "type":"postback",
						"title":"' . $button_title . '",
						"payload":"' . $data[6][5] . '"
		              }          
		            ]
		          }, 
							{
		            "title":"' . $data[7][0] . '",
		            "image_url":"' . $data[7][6] . '",
		            "subtitle":"' . $data[0][2] . '",
		            "buttons":[
					  {
		                "type":"postback",
						"title":"' . $button_title . '",
						"payload":"' . $data[7][5] . '"
		              }          
		            ]
		          },
							{
		            "title":"' . $data[8][0] . '",
		            "image_url":"' . $data[8][6] . '",
		            "subtitle":"' . $data[0][2] . '",
		            "buttons":[
					  {
		                "type":"postback",
						"title":"' . $button_title . '",
						"payload":"' . $data[8][5] . '"
		              }          
		            ]
		          }, 
							{
		            "title":"' . $data[9][0] . '",
		            "image_url":"' . $data[9][6] . '",
		            "subtitle":"' . $data[0][2] . '",
		            "buttons":[
					  			{
		                "type":"postback",
										"title":"' . $button_title . '",
										"payload":"' . $data[9][5] . '"
		              }          
		            ]
		          },
				  ]
			}
		}
	}
	}';
	return $jsonData;
}

function send_array_carousel_template_message($sender, $i, $data, $access_token){
	$jsonData = build_array_carousel_template_message_payload($data, $i, $sender);
	$result = send_message($access_token, $jsonData);
	return $result;
}

/************************************************************* End of Array Carousel Template*****************************************************************************************************************************************************************/

/************************************************************ End of Rules List Template ******************************************************************************************************************************************************************/
/************************************************************* End of Message Payloads *****************************************************************************************************************************************************************/

?>