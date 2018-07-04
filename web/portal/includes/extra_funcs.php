<?php 

    function weekly_users() {
        $weekly_users = array();
        // $start_date = date("Y-m-d");
        // $end_date = date("Y-m-d",strtotime('-7 days', strtotime($start_date)));
        $i = 0;
        $j = 1;
        $k = 0;
        while ($k <= 3) {
            // $start_date = date("Y-m-d h:i:sa",strtotime('-'.$i.' days'));
            $weekly_users[] = weekly_messenger_users($i, $j, $db);
            $start_date = date("Y-m-d",strtotime('-7 days', strtotime($start_date)));
            $i++;
            $j++;
            $k++;
        }
        return json_encode($weekly_users);
    }