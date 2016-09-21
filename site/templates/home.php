<?php snippet('header') ?>










<div class="main_wrapper">

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
	<img <?php echo $img ?>" style="height: 300px; width: auto; display: inline-block; vertical-align: top; padding: 10px;"></img>
	<?php endforeach; ?>

</div>

<?php

// $out = "";
// $current_date = new DateTime("");
// $out .= "<div class='block_float_container'>";
// $current = false;
// $forthcoming = false;
// $past = false;
// foreach($shows as $exhibit) {
//         $prefix = "";
//         $opening_date = $start;
//         $closing_date = $end;

//         if ($closing_date < $current_date) {
//             // past
//             $filter = "ex_past";
//             $type = "past";
//             $past = true;
//         } else if ( ($opening_date < $current_date) && ($closing_date > $current_date) ) {
//             // current
//             $filter = "ex_cur";
//             $type = "current";
//             $current = true;
//             $prefix = "<em>Current:</em> ";
//         } else {
//             // forthcoming
//             $filter = "ex_up";
//             $type = "forthcoming";
//             $forthcoming = true;
//             $prefix = "<em>Forthcoming:</em> ";
//         }

//         $out .= "<div class='".$filter." block_float lazy'>";
//         $out .= "<a href='".$exhibit->url."'>";
//         $out .= "<div class='block_float_capt'>";
//         $out .= $prefix;
//         $out .= "<em>".$exhibit->title."</em>";
//         $out .= ",<br>".$datestring;
//         $out .= "</div></a></div>";

// }
// $out .= "</div>";


// echo $out;

?>

























<?php snippet('footer') ?>