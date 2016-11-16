<?php snippet('header'); ?>

<div class="menu_wrapper">
	<?php 
		snippet('site_nav_menu'); 
		snippet('site_nav_filter_2'); 
		snippet('site_nav_times_2'); 
	?>
</div>

<div class="main_wrapper">
<div class='news_wrapper'>
	<?php 
		$artists = kirby()->request()->get('artists');
		$params = $_GET;
		$item = $page->items();
		$when = "";
		// Run through array of artnews
		$output = [];
		$allyears = [];
		$when = "";
		
		$count = count($item->toStructure());

		foreach($item->toStructure()->sortBy('startdate', 'desc') as $news) {
			// Exhibition dates
			$start = strtotime($news->startdate());
        	$end = strtotime($news->enddate());
        	$startyear = date('Y', $start);
        	
        	$datestring = returnDate($start, $end);

        	$newsNumber = $count--;

        	// Opening date/time
        	$opening = strtotime($news->openingstart());
        	$closing = strtotime($news->openingend());

			//Set Artist variable
			$artist = $news->artist();
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
			if($news->external->isNotEmpty()) {
				$urlStart = "<a href='{$news->external()}' target='_blank'>";
				$urlEnd = "</a>";
			} else {
				$urlStart = "";
				$urlEnd = "";
			}


			// Artists
			$i_artist = 0;
			if ($artist->isNotEmpty()){
			$artists = explode(",", $artist);
			$artistcount = count($artists);
				
				foreach ($artist->toStructure() as $artist) {
				$i_artist++;	
					$artistsummary = "<span>";
					$artistsummary .= $artist;
					$artistsummary .= $i_artist > $artistcount ? ", " : "";
					$artistsummary .= "</span>";
				}
			} 



			//Build Block and display

			$block = "<ol class='news_entry'>";
				$block .= "<li class='news_entry_number'>";
				$block .= $newsNumber;
				$block .= "</li>";
				$block .= $urlStart;
				$block .= "<li class='news_entry_item'>";
				$block .= $news->title();
				if(!empty($artistsummary)) {
				$block .= ", ";
				$block .= $artistsummary;
				}
				if($news->location()->isNotEmpty()){
				$block .= "<br>";
				$block .= $news->location();
				}
				if($news->startdate()->isNotEmpty()){
					if($news->startdate()->isNotEmpty() && $news->location()->isNotEmpty()) {
						$block .= ", ";
					} else { 
						$block .= "<br>";
					}
				$block .= "<span class='news_entry_date'>{$datestring}</span>";
				}
				$block .= "</li>";
				$block .= $urlEnd;	
			$block .= "</ol>";
			
			echo $block;

		}

	if((isset($_GET['times']) || isset($_GET['artists'])) && !in_array("added", $output)) {
		echo "<div class='no_match'>No matches found. Please redefine your selection.</div>";
	}
	?>

</div>
</div>

<?php snippet('footer') ?>