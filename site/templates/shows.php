<?php snippet('header'); ?>
<div class="menu_wrapper">
	<?php 
		snippet('site_nav_menu'); 
		snippet('site_nav_filter'); 
		snippet('site_nav_times');
	?>
</div>

<div class="main_wrapper">
	<div class='shows_wrap'>
	<?php 
		$artists = "";
		$params = $_GET;
		$past = false;
		$current = false;
		$upcoming = false;
		$when = "";
		// Run through array of shows
		$output = [];
		$allyears = [];

		//Rotation
		foreach($shows as $show) {
			// Rotation
			if($show->rotateangle()->isNotEmpty()) {
				$rotationval = $show->rotateangle();
			} else {
				$rotationval = "";
			}

			// Exhibition dates
			$start = strtotime($show->startdate());
        	$end = strtotime($show->enddate());
        	$startyear = date('Y', $start);
        	
        	$datestring = returnDate($start, $end);

        	// Opening date/time
        	$opening = strtotime($show->openingstart());
        	$closing = strtotime($show->openingend());
        	$openingdate = date('j M Y', $opening);
        	$openingtime = date('g:i a', $opening);
        	$closingtime = date('g:i a', $closing);
        	
        	$openingtime = $show->openingend()->isNotEmpty() && date('a', $opening) === date('a', $closing) ? openingTime1($openingtime) : openingTime2($openingtime);
        	$closingtime = closingTime($closingtime);

        	$closingtime = $show->openingend()->isNotEmpty() ? " – 	".$closingtime : "";

        	$openingstring = "Opening&nbsp;".$openingdate.", &nbsp;".$openingtime.$closingtime;

        	//Set Date variable
			if ($end < $current_date) {
				$when = "past";
				$rotation = "";
			} else if (($start < $current_date) && ($end > $current_date)) {
				$when = "current";
				// $number = $clockwise[mt_rand(0, count($clockwise) - 1)];
				$number = $rotationval;
				$rotation = "style='transform: rotate(".$number."deg)' ";
			} else if ($start > $current_date) {
				$when = "upcoming";
				// $number = $counterclockwise[mt_rand(0, count($counterclockwise) - 1)];
				$number = $rotationval;
				$rotation = "style='transform: rotate(".$number."deg)' ";
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
				// $img = "style='background-image:url(".$show->images()->sortBy('sort', 'asc')->first()->url().");".$rotation."'";
				$img = "data-src='".$show->images()->sortBy('sort', 'asc')->first()->resize(450)->url()."'";
				$zoomImg = $show->images()->sortBy('sort', 'asc')->first()->width(1000)->url();
			}

			// Set artists
			$artists = $show->artist();
			$artists = explode(",", $artists);
			
			$len = count($show->extartist()->artistname()->toStructure());
			$artistcount = count($artists);
			$artistsExtCount = count($show->extartist()->artistname()->toStructure());

			if($show->artist()->isNotEmpty() && $show->extartist()->isNotEmpty() ){
			$artistSummery = "<span class='shows_block_artists hide'>";	
				$i = 0;
				foreach ($artists as $artist) {	
					$artistSummery .= "<span>";
					$artistSummery .= $artist;
					$artistSummery .= ", ";
					$artistSummery .= "</span>";
					$artistSummery .= " ";
				}
				
				foreach ($show->extartist()->artistname()->toStructure() as $exhartist) {
				$i++;
					$artistSummery .= "<span>";
					$artistSummery .= $exhartist;
					$artistSummery .= $i < $len ? ", " : "";
					$artistSummery .= "</span>";
					$artistSummery .= " ";
				}	
			$artistSummery .= "</span>";
			$artistClickable = "clickable";
			} else if ($show->artist()->isNotEmpty()){
			$artistSummery = "<span class='shows_block_artists hide'>";
				$i = 0;
				foreach ($artists as $artist) {
				$i++;	
					$artistSummery .= "<span class='";
					$artistSummery .= $artistcount == 1 ? "single" : "";
					$artistSummery .= "'>";
					$artistSummery .= $artist;
					$artistSummery .= $i < $artistcount ? ", " : "";
					$artistSummery .= "</span>";
					$artistSummery .= " ";
				}
			$artistSummery .= "</span>";
			$artistClickable = "clickable";
			} else if ($show->extartist()->isNotEmpty()){
			$artistSummery = "<span class='shows_block_artists single hide'>";
				$i = 0;
				foreach ($show->extartist()->artistname()->toStructure() as $exhartist) {
				$i++;	
					$artistSummery .= "<span>";
					$artistSummery .= $exhartist;
					$artistSummery .= $i < $len ? ", " : "";
					$artistSummery .= "</span>";
					$artistSummery .= " ";
				}	
			$artistSummery .= "</span>";
			$artistClickable = "clickable";
			} else {
				$artistSummery = "";
				$artistClickable = "";
			}

			// Add image orientation
			$orientation = $show->images()->first()->orientation() == 'landscape' ? "landscape" : "portrait";

			//Filter by times and artist (Neccessary for the output[] part to work correct)
			if (isset($_GET['times']) && isset($_GET['artists'])) {
				if (count($artistarray) < 1 || !preg_match('/'.implode('|', $artistarray).'/', $params["artists"], $matches) || strpos($params["times"], $when) === false) {
					continue;
				} else {
					$output[] = "added";
				}
			}

			//Filter by Artist
			else if(isset($_GET['artists'])) {
				if (count($artistarray) < 1 || !preg_match('/'.implode('|', $artistarray).'/', $params["artists"], $matches)) {
					continue;
				} else {
					$output[] = "added";
				}
			}

			//Filter by times
			else if (isset($_GET['times'])){
				if (strpos($params["times"], $when) === false) {
					continue;
				} else {
					$output[] = "added";
				}
			}

			if(!in_array($startyear, $allyears)) {
				if(!empty($allyears)) {
					echo "</div>";
				}
				$block = "<div class='shows_outer'>";
				$block .= "<div class='shows_year'>";
				$block .= "<span>";
				$block .= $startyear;
				$block .= "</span></div>";
				
				echo $block;
				$allyears[] = $startyear;
			}

			//url
			$urlStart = "<a href='{$show->url()}'>";
			$urlEnd = "</a>";
			
			//date display
			$date = $when === "upcoming" && $show->openingstart()->isNotEmpty() ? $openingstring : $datestring;

			//Build Block and display
			$block = "<div class='shows_block lazy'>";
			$block .= $urlStart;
			$block .= "<span class='";
			$block .= s::get('device_class') == 'mobile' || s::get('device_class') == 'tablet' ? "" : "zoomthis ";
			$block .= "shows_block_thumb ".$when."' ".$img." ".$rotation." zoom-image=".$zoomImg." data-time='".$when."'></span>";
			$block .= $urlEnd;
			$block .= "<span class='shows_block_caption ".$artistClickable."'>";
				$block .= "<span class='shows_block_title'>";
				$block .= $show->title();
				$block .= "</span>";
				$block .= ", ";
				
				$block .= "<span class='shows_block_date'>";
				$block .= $date;
				$block .= "</span>";

				if (!empty($artistSummery)) {
			    $block .= $artistSummery;
				}
			$block .= "</span>";
			$block .= "</div>";
			
			echo $block;
		}

		if( (isset($_GET['times']) || isset($_GET['artists'])) && !in_array("added", $output)) {
			echo "<div class='no_match'>No matches found. Please refine your selection.</div>";
		}
		?>

	</div>

</div>

<?php snippet('footer') ?>