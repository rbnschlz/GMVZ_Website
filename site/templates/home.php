<?php 
	$featured = [];
	$current = [];
	$upcoming = [];
	$img = "";
	$capt = "";
	$showsUrl = page("shows")->url();
	$i = 0;

	//Check what events are currently on
	foreach($shows as $show) {
	    $start = strtotime($show->startdate());
	    $end = strtotime($show->enddate());

	    //Set Date variable
	    if ($end < $current_date) {
	        $featured[] = false;
	        continue;
	    } else if (($start < $current_date) && ($end > $current_date)) {
	        $featured[] = true;
	        $current[] = true;
	        $event = $show;
	    } else if ($start > $current_date) {
	        $featured[] = true;
	        $upcoming[] = true;
	        $i++;
	    };
	}


	//If any events are on, show page
	if(in_array(true, $featured)) {
		snippet('header');
		echo "<div class='menu_wrapper'>";
		snippet('site_nav_menu');
		echo "</div>";

		//If current and upcoming
		if(in_array(true, $current) && in_array(true, $upcoming)) {

			foreach($shows as $show) {
				$start = strtotime($show->startdate());
				$end = strtotime($show->enddate());
				$img = "style='background-image:url(".$show->images()->first()->url().")'";
				if (($start < $current_date) && ($end > $current_date)) {
					$block = "<a class='home_link_wrapper_curr_d' href='{$showsUrl}'>";
					$block .= "<div class='home_background' ";
					$block .= $img;
					$block .= "></div>";
					$block .= "</a>";

					echo $block;
				} else if ($start > $current_date) {
					$block2 = "<a class='home_link_wrapper_upc_d href='{$showsUrl}'>";
					$block2 .= "<div class='home_background' ";
					$block2 .= $img;
					$block2 .= "></div>";
					$block2 .= "</a>";

					echo $block2;
				}
			}

		//If only current
		} else if(in_array(true, $current)) {
			$block = "<a class='home_link_wrapper_curr_s href='{$showsUrl}'>";
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
			$block .= "</div>";

			echo $block;

		// If only upcoming
		} else if(in_array(true, $upcoming)) {
			foreach($shows as $show) {
				$start = strtotime($show->startdate());
				$end = strtotime($show->enddate());
				$img = "style='background-image:url(".$show->images()->first()->url().")'";
				if ($start > $current_date) {
					$block2 = "<a class='";
					$block2 .= $i >= 2 ? "home_link_wrapper_upc_d" : "home_link_wrapper_upc_s";
					$block2 .= "' href='{$showsUrl}'>";
					$block2 .= "<div class='home_background' ";
					$block2 .= $img;
					$block2 .= "></div>";
					$block2 .= "</a>";
					echo $block2;
				}
			}
		};

		snippet('footer');

	} else { 
		go('/shows'); 
	}; 
?>
