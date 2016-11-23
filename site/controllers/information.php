<?php

return function($site, $pages, $page) {

	function returnTime($openhour, $closinghour) {
    $fullopenhour = $openhour;    
    $fullclosinghour = $closinghour;    
    $openhour = explode(":", $openhour);
    $closinghour = explode(":", $closinghour);
    $openhour_hour = $openhour[0];
    $openhour_minute = $openhour[1];
    $closinghour_hour = $closinghour[0];
    $closinghour_minute = $closinghour[1];
    $openhour_period =  date('a', strtotime($fullopenhour));
    $closinghour_period =  date('a', strtotime($fullclosinghour));

    $hour = "";


        if($openhour_minute == "00" && $closinghour_minute == "00") {
            $hour .= $openhour_hour.$openhour_period."—".$closinghour_hour.$closinghour_period;
        } else if ($openhour_minute != "00" && $closinghour_minute == "00") {
            $hour .= $openhour_hour.":".$openhour_minute.$openhour_period."—".$closinghour_hour.$closinghour_period;
        } else if ($openhour_minute == "00" && $closinghour_minute == "30") {
            $hour .= $openhour_hour.$openhour_period."—".$closinghour_hour.":".$closinghour_minute.$closinghour_period;
        } else {
            $hour .= $openhour_hour.":".$openhour_minute.$openhour_period."–".$closinghour_hour.":".$closinghour_minute.$closinghour_period;
        }

    return $hour;
    }

    function returnDays($daysopen) {
    $seperatedays = explode(", ", $daysopen);
    $daysstring = implode(", ", $seperatedays);
    $week = "Monday, Tuesday, Wednesday, Thursday, Friday, Saturday, Sunday";
    $days = "";

    if(strpos($week, $daysstring) !== false) {
        $days .= $seperatedays[0]." to ".end($seperatedays);
    } else {
        $days .= $daysstring;
    }

    

    return $days;
    }

	

};

?>