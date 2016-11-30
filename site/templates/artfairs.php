<?php snippet('header'); ?>

<div class="outer_wrapper">

	<div class="menu_wrapper">
		<?php 
			snippet('site_nav_menu'); 
			snippet('site_nav_filter_2'); 
			snippet('site_nav_times_2');
		?>
	</div>


	<div class='main_wrapper'>
		<?php 
			$artists = kirby()->request()->get('artists');
			$params = $_GET;
			$fairs = $page->items();
			$when = "";
			// Run through array of artfairs
			$output = [];
			$allyears = [];
			$when = "";
			$count = count($fairs->toStructure());

			foreach($fairs->toStructure()->sortBy('startdate', 'desc') as $fair) {
				// Exhibition dates
				$start = strtotime($fair->startdate());
	        	$end = strtotime($fair->enddate());
	        	$startyear = date('Y', $start);
	        	
	        	$datestring = returnDate($start, $end);

	        	$fairNumber = $count--;

	        	// Opening date/time
	        	$opening = strtotime($fair->openingstart());
	        	$closing = strtotime($fair->openingend());

				//Set Artist variable
				$artist = $fair->artist();
				$artist = $artist->toArray();

				//Convert Artist variable to lowercase
				if($artist->isNotEmpty()){
					$artistlow = $artist->lower();
					$artistlow = umlaute($artistlow);
					$artistlow = str_replace(' ', '', $artistlow);
					$artistlow = str_replace('-', '', $artistlow);
					$artistarray = explode(',', $artistlow);
				} else {
					$artistarray = [];
				};

				//Filter by Artist
				if(isset($_GET['artists'])) {
					if (count($artistarray) < 1 || !preg_match('/'.implode('|', $artistarray).'/', $params["artists"], $matches)) {
						continue;
					} else {
						$output[] = "added";
					}
					$output[] = "added";
				};

				//Set Date variable
				if ($end < $current_date) {
					$when = "past";
					// $sizing = "small_float";
				} else if (($start < $current_date) && ($end > $current_date)) {
					$when = "current";
					// $sizing = "big_float";
				} else if ($start > $current_date) {
					$when = "upcoming";
					// $sizing = "medium_float";
				};


				//Filter by times
				if (isset($_GET['times'])){
					if (strpos($params["times"], $when) === false) {
						continue;
					} else {
						$output[] = "added";
					}
				};
				
				//url
				if($fair->external->isNotEmpty()) {
					$urlStart = "<a href='{$fair->external()}' target='_blank'>";
					$urlEnd = "</a>";
				} else {
					$urlStart = "";
					$urlEnd = "";
				}

				if(!in_array($startyear, $allyears)) {
				if(!empty($allyears)) {
					echo "</div>";
				}
					$block = "<div class='artfairs_outer'>";
					$block .= "<div class='artfairs_year'><span>";
					$block .= " {$startyear}";
					$block .= "</span></div>";
					
					echo $block;
					$allyears[] = $startyear;
				}


				//Build Block and display

				$block = "<ol class='artfairs_entry'>";
					$block .= "<li class='artfairs_entry_number'>";
					$block .= $fairNumber;
					$block .= ".&nbsp";
					$block .= "</li>";
					$block .= $urlStart;
					$block .= "<li class='artfairs_entry_event'>";
					$block .= "<p>";
					$block .= $fair->title();
					$block .= "</p>";
					if($fair->location()->isNotEmpty()){
						$block .= ($fair->location()) ? ", ".$fair->location() : "";
					}
					if($fair->startdate()->isNotEmpty()){
						$block .= ($datestring) ? ", ".$datestring : "";
					}
					$block .= "</li>";
					$block .= $urlEnd;	
				$block .= "</ol>";
				
				echo $block;

			}

		if((isset($_GET['times']) || isset($_GET['artists'])) && !in_array("added", $output)) {
			echo "<div class='no_match'>No matches found. Please refine your selection.</div>";
		}
		?>
	</div>

</div>

<?php snippet('footer') ?>

<?php snippet('footer') ?>