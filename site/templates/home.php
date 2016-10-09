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
		$i = 0;
		foreach($shows as $show):
			$start = strtotime($show->startdate());
        	$end = strtotime($show->enddate());
        	$datestring = returnDate($start, $end);
        	$output = true;
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
			//Set src
			$img = "";
			if ($show->hasImages()) {
				$img = "src='".$show->images()->first()->url()."'";
			}

			// Add image orientation
			$orientation = $show->images()->first()->orientation() == 'landscape' ? "landscape" : "portrait";

			// if($artist->isNotEmpty()){
			// 	$artistlow = $artist->lower();
			// 	$artistlow = umlaute($artistlow);
			// 	$artistlow = str_replace(' ', '', $artistlow);
			// 	$artistlow = str_replace('-', '', $artistlow);
			// 	$artistarray = explode(',', $artistlow);
			// } else {
			// 	$artistarray = " ";
			// };

			//Filter by Artist
			if(isset($_GET['artists'])) {
				if (count($artistarray) < 1 || !preg_match('/'.implode('|', $artistarray).'/', $params["artists"], $matches)) {
					continue;
					$output = false;
				} else {
					$output = true;
				}
			};

			//Filter by times
			if (isset($_GET['times'])){
				if (strpos($params["times"], $when) === false) {
					continue;
					$output = false;
				} else {
					$output = true;
				}
			};
	?>
	 	<div class='home_show <?php echo $orientation?>'>
			<img <?php echo $img ?>></img>
			<div class='home_show_caption'>
				<?php echo $show->title();?>
				<?php echo $datestring;?>
			</div>
		</div>
	<?php endforeach; ?>
	<?php if($output === true): ?>
		<div>No match found. Please change your selection</div>
	<?php endif; ?>

</div>

























<?php snippet('footer') ?>