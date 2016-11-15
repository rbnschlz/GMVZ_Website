<?php snippet('header'); ?>

<div class="menu_wrapper">
	<?php 
		snippet('site_nav_menu'); 
		snippet('site_nav_filter'); 
		snippet('site_nav_times');
	?>
</div>


<div class="main_wrapper">

<div class='artfairs_wrapper'>
	<?php 
		$artists = kirby()->request()->get('artists');
		$params = $_GET;
		$when = "";
		// Run through array of artfairs
		$output = [];
		$allyears = [];


		foreach($fairs as $fair) {
			// Exhibition dates
			$start = strtotime($fair->startdate());
        	$end = strtotime($fair->enddate());
        	$startyear = date('Y', $start);
        	
        	$datestring = returnDate($start, $end);

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

			//Filter by times
			if (isset($_GET['times'])){
				if (strpos($params["times"], $when) === false) {
					continue;
				} else {
					$output[] = "added";
				}
			};
			

			//Build Block and display

			$block = "<li class='artfairs_entry'>";
			$block .= $fair->title();
			$block .= ($fair->location()) ? ", ".$fair->location() : "";
			$block .= "</li>";
			
			echo $block;

		}

	if((isset($_GET['times']) || isset($_GET['artists'])) && !in_array("added", $output)) {
		echo "<div class='no_match'>No matches found. Please redefine your selection.</div>";
	}
	?>

</div>
</div>

<?php snippet('footer') ?>

<?php snippet('footer') ?>