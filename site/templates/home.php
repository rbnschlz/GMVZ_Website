<?php snippet('header') ?>










<div class="main_wrapper">

<div class='home_show_wrap'>
	<?php 
		$artists = kirby()->request()->get('artists');
		$artists = "";
		$params = $_GET;
		$past = false;
		$current = false;
		$upcoming = false;
		$when = "";
		// Run through array of shows
		foreach($shows as $show):
			$start = strtotime($show->startdate());
        	$end = strtotime($show->enddate());
        	$datestring = returnDate($start, $end);
        	//Set Date variable
			if ($end < $current_date) {
				$when = "past";
			} else if (($start < $current_date) && ($end > $current_date)) {
				$when = "current";
			} else if ($start > $current_date) {
				$when = "upcoming";
			};
			//Set Artist variable
			$artist = $show->artist();
			$artist = $artist->toArray();
			$img = "";
			if ($show->hasImages()) {
				$img = "src='".$show->images()->first()->url()."'";
			}

			//Convert Artist variable to lowercase
			if($artist->isNotEmpty()){
				$artistlow = $artist->lower();
				$artistlow = umlaute($artistlow);
				$artistlow = str_replace(' ', '', $artistlow);
				$artistlow = str_replace('-', '', $artistlow);
				$artistarray = explode(',', $artistlow);
			} else {
				$artistlow = " ";
			};

			// 	if ($show->images()->first()->orientation() == 'landscape') {
			// 		$imgOrientation = "landscape";
			// 	} else {
			// 		$imgOrientation = "portrait";
			// 	}
			// }	

		if($artist->isNotEmpty()){
			$artistlow = $artist->lower();
			$artistlow = umlaute($artistlow);
			$artistlow = str_replace(' ', '', $artistlow);
			$artistlow = str_replace('-', '', $artistlow);
			$artistarray = explode(',', $artistlow);
		} else {
			$artistlow = " ";
		};

		//Filter by Artist
		if(isset($_GET['artists'])) {
			if (!preg_match('/'.implode('|', $artistarray).'/', $params["artists"], $matches)) {
				continue;
			}
		};
		//Filter by times
		if (isset($_GET['times'])){
			if (strpos($params["times"], $when) === false) {
				continue;
			}
		};
	?>
	
	<div class='home_show <?php echo $imgOrientation?>'>
	<img <?php echo $img ?>></img>
	<?php 
	echo $show->title();
	?>
	</div>
	<?php endforeach; ?>

</div>

























<?php snippet('footer') ?>