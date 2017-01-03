<?php

return function($site, $pages, $page) {

	function returnDate($start, $end) {
    $start_date = explode(" ", date('j M Y', $start));
    $end_date = explode(" ", date('j M Y', $end));
    $start_day = $start_date[0];
    $end_day = $end_date[0];
    $start_month = $start_date[1];
    $end_month = $end_date[1];
    $start_year = $start_date[2];
    $end_year = $end_date[2];

    $date = "";
    $span = " – ";
    $date .= $start_day;
    if ($end) {
        if ($start_year == $end_year) {
            if ($start_month == $end_month) {
                if ($start_day == $end_day) {
                    $date .= " ".$start_month." ".$start_year;
                } else {
                    $date .= $span.$end_day." ".$start_month." ".$start_year;
                }
            } else {
                $date .= " ".$start_month.$span.$end_day." ".$end_month." ".$end_year;
            }
        } else {
            $date .= " ".$start_month." ".$start_year.$span.$end_day." ".$end_month." ".$end_year;
        }
    } else {
        $date .= " ".$start_month." ".$start_year;
    }
        return $date;
    }

    function openingTime1($openingtime) {
    $openingtime = $openingtime;
    $fullopenhour = $openingtime;
    $openhour = explode(":", $openingtime);
        
    $openhour_hour = $openhour[0];
    $openhour_rest = explode(" ", $openhour[1]);
    $openhour_minute = $openhour_rest[0];
    $openhour_period =  $openhour_rest[1];

    if($openhour_minute == "00") {
        $hour = $openhour_hour;
    } else {
        $hour = $openhour_hour.":".$openhour_minute;
    }
        return $hour;
    }

    function openingTime2($openingtime) {
    $openingtime = $openingtime;
    $fullopenhour = $openingtime;
    $openhour = explode(":", $openingtime);
        
    $openhour_hour = $openhour[0];
    $openhour_rest = explode(" ", $openhour[1]);
    $openhour_minute = $openhour_rest[0];
    $openhour_period =  $openhour_rest[1];

    if($openhour_minute == "00") {
        $hour = $openhour_hour.$openhour_period;
    } else {
        $hour = $openhour_hour.":".$openhour_minute.$openhour_period;
    }
        return $hour;
    }

    function closingTime($closingtime) {
    $closingtime = $closingtime;
    $fullclosinghour = $closingtime;
    $closinghour = explode(":", $closingtime);
        
    $closinghour_hour = $closinghour[0];
    $closinghour_rest = explode(" ", $closinghour[1]);
    $closinghour_minute = $closinghour_rest[0];
    $closinghour_period =  $closinghour_rest[1];

    if($closinghour_minute == "00") {
        $hour = $closinghour_hour.$closinghour_period;
    } else {
        $hour = $closinghour_hour.":".$closinghour_minute.$closinghour_period;
    }
        return $hour;
    }
      

	$shows = page('shows')->children()->sortBy('startdate', 'desc', 'enddate', 'asc')->visible();
    $current_date = strtotime(date('Y-m-d H:i:s'));

    return array(
        'current_date' => $current_date,
        'shows' => $shows,
    );

};

?>