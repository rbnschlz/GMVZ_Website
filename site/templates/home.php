<?php 
	$featured = [];
	$img = "";
	$capt = "";
	$showsUrl = page("shows")->url();
	foreach($shows as $show) {
	    $start = strtotime($show->startdate());
	    $end = strtotime($show->enddate());

	    //Set Date variable
	    if ($end < $current_date) {
	        $featured[] = false;
	    } else if (($start < $current_date) && ($end > $current_date)) {
	        $featured[] = true;
	        $img = "style='background-image:url(".$show->images()->first()->url().")'";
	        $event = $show;
	    } else if ($start > $current_date) {
	        $featured[] = false;
	    };
	}

	if(in_array(true, $featured)) {
		snippet('header');
		echo "<div class='menu_wrapper'>";
		snippet('site_nav_menu');
		echo "</div>";

		$block = "<a href='{$showsUrl}'>";
		$block .= "<div class='home_background' ";
		$block .= $img;
		$block .= "></div>";
		$block .= "</a>";

		echo $block;

		$block = "<div class='home_caption'><span>Current exhibition: </span><a class='' href='";
		$block .= $event->url();
		$block .= "'>";
		$block .= $event->title();
		$block .= "</a>";
		// $block .= "<span>by ";
		// $block .= $event->artist();
		$block .= "</div>";

		echo $block;

		snippet('footer');

	} else { 
		go('/shows'); 
	}; 
?>
