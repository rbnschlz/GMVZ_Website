<?php 
	$featured = [];
	$current = [];
	$upcoming = [];
	$img = "";
	$capt = "";
	$showsUrl = page("shows")->url();
	$i = 0;
	$clockwise = ['15', '40', '5', '10', '23'];
	$counterclockwise = ['-15', '-40', '-5', '-10', '-23'];


	//Check what events are currently on
	foreach($shows as $show) {
	    $start = strtotime($show->startdate());
	    $end = strtotime($show->enddate());

	    //Set Date variable
	    if ($end < $current_date) {
	        continue;
	    } else if (($start < $current_date) && ($end > $current_date)) {
	        $featured[] = true;
	        $current[] = true;
	        $event = $show;
	        $img = "style='background-image:url(".$show->images()->first()->url().")'";
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
					$number = $counterclockwise[mt_rand(0, count($counterclockwise) - 1)];
					$block = "<a class='home_link_wrapper_curr_d'";
					$block .= " style='transform: rotate(".$number."deg)' ";
					$block .= "href='{$showsUrl}'>";
					$block .= "<div class='home_background' ";
					$block .= $img;
					$block .= "></div>";
					$block .= "</a>";

					echo $block;
				} else if ($start > $current_date) {
					$number = $clockwise[mt_rand(0, count($clockwise) - 1)];
					$block2 = "<a class='home_link_wrapper_upc_d'";
					$block2 .= " style='transform: rotate(".$number."deg)' ";
					$block2 .= "href='{$showsUrl}'>";
					$block2 .= "<div class='home_background' ";
					$block2 .= $img;
					$block2 .= "></div>";
					$block2 .= "</a>";

					echo $block2;
				}
			}

			//Caption
			$block = "<div class='home_caption'><span>Current: <a class='' href='";
			$block .= $event->url();
			$block .= "'>";
			$block .= $event->title();
			$block .= "</a></span>";
			$block .= "<span>Upcoming: ";

			foreach($shows as $show) {
				$start = strtotime($show->startdate());
				if ($start > $current_date) {
				$block .= "<a class='' href='";
				$block .= $show->url();
				$block .= "'>";
				$block .= $show->title();
				$block .= "</a>";
				}
			}

			$block .= "</span></div>";
			echo $block;

		//If only current
		} else if(in_array(true, $current)) {
			$number = $counterclockwise[mt_rand(0, count($counterclockwise) - 1)];
			$block = "<a class='home_link_wrapper_curr_s'";
			$block .= " style='transform: rotate(".$number."deg)' ";
			$block .= "href='{$showsUrl}'>";
			$block .= "<div class='home_background' ";
			$block .= $img;
			$block .= "></div>";
			$block .= "</a>";

			echo $block;

			//Caption
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
					$number = $counterclockwise[mt_rand(0, count($counterclockwise) - 1)];
					$block = "<a class='";
					$block .= $i >= 2 ? "home_link_wrapper_upc_d'" : "home_link_wrapper_upc_s'";
					$block .= " style='transform: rotate(".$number."deg)' ";
					$block .= "href='{$showsUrl}'>";
					$block .= "<div class='home_background' ";
					$block .= $img;
					$block .= "></div>";
					$block .= "</a>";

					echo $block;
				}
			}

			//Caption
			$block = "<div class='home_caption'>";
			$block .= "<span>Upcoming: ";

			foreach($shows as $show) {
				$start = strtotime($show->startdate());
				if ($start > $current_date) {
				$block .= "<a class='' href='";
				$block .= $show->url();
				$block .= "'>";
				$block .= $show->title();
				$block .= "</a>";
				}
			}

			$block .= "</span></div>";
			echo $block;
		};

		snippet('footer');

	} else { 
		go('/shows'); 
	}; 
?>
