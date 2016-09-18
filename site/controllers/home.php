<?php

return function($site, $pages, $page) {

	// function returnDate($start, $end) {
 //    $start_date = explode(" ", date('j F Y', $start));
 //    $end_date = explode(" ", date('j F Y', $end));
 //    $start_day = $start_date[0];
 //    $end_day = $end_date[0];
 //    $start_month = $start_date[1];
 //    $end_month = $end_date[1];
 //    $start_year = $start_date[2];
 //    $end_year = $end_date[2];

 //    $date = "";
 //    $span = " – ";
 //    $date .= $start_day;
 //    if ($end) {
 //        if ($start_year == $end_year) {
 //            if ($start_month == $end_month) {
 //                if ($start_day == $end_day) {
 //                    $date .= " ".$start_month." ".$start_year;
 //                } else {
 //                    $date .= $span.$end_day." ".$start_month." ".$start_year;
 //                }
 //            } else {
 //                $date .= " ".$start_month.$span.$end_day." ".$end_month." ".$end_year;
 //            }
 //        } else {
 //            $date .= " ".$start_month." ".$start_year.$span.$end_day." ".$end_month." ".$end_year;
 //        }
 //    } else {
 //        $date .= " ".$start_month." ".$start_year;
 //    }
 //        return $date;
 //    }


		$shows = page('shows')->children();
		$artists = page('artists')->children()->visible();
		$collection = $shows;

 //    // Date
 //    $start = strtotime($first->startdate());
 //    $end = strtotime($first->enddate());
 //    $datestring = returnDate($start, $end);
 //    //Opening
 //    $open =  strtotime($first->openingstart());
 //    $openend =  strtotime($first->openingend());
 //    // Currently Open/Closed
 //    $current_date = strtotime(date('Y-m-d H:i:s'));

    return array(
        // 'start' => $start,
        // 'end' => $end,
        // 'firstend' => $firstend,
        // 'datestring' => $datestring,
        // 'open' => $open,
        // 'openend' => $openend,
        // 'current_date' => $current_date,
        'shows' => $shows,
        'artists' => $artists,
        'collection' => $collection,
    );

};

?>