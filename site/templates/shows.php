<?php snippet('header'); snippet('home_menu'); ?>


<div class="main_wrapper">

<table class='home_show_wrap'>
	<?php 
		$artists = kirby()->request()->get('artists');
		$artists = "";
		$params = $_GET;
		$past = false;
		$current = false;
		$upcoming = false;
		$when = "";
		// Run through array of shows
		$output = [];
		$allyears = [];


		foreach($shows as $show) {
			// Exhibition dates
			$start = strtotime($show->startdate());
        	$end = strtotime($show->enddate());
        	$startyear = date('Y', $start);
        	
        	$datestring = returnDate($start, $end);

        	// Opening date/time
        	$opening = strtotime($show->openingstart());
        	$closing = strtotime($show->openingend());
        	$openingdate = date('j.m.Y', $opening);
        	$openingtime = date('H:i', $opening);
        	$closingtime = date('H:i', $closing);
        	$time = "{$openingtime}–{$closingtime}";

        	$openingstring = "{$openingdate}, {$time}h";

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
				$img = $show->images()->sortBy('sort', 'asc')->first()->url();
				// $img2 = "src='".$show->images()->sortBy('sort', 'asc')->first()->url()."'";
				// $img = "style='background-image:url(".$show->images()->sortBy('sort', 'asc')->first()->url().")'";
			}


			// Add artist attr
			$Extartist = $show->Extartist();
			$Extartist =  preg_replace("/\r|\n/", '', $Extartist);
			$Extartist = strtr($Extartist, array('-' => '', '   ' => '', 'artistname: ' => ", "));
			$Extartist = trim($Extartist,",");
			$Extartist = trim($Extartist," ");
			if($artist->isNotEmpty() && $show->Extartist()->isNotEmpty()){			
				$artisttag = $artist.', '.$Extartist;
			} else if ($show->Extartist()->isNotEmpty()){
				$artisttag = $Extartist;
			} else if ($artist->isNotEmpty()) {
				$artisttag = $artist;
			} else {
				$artisttag = '   ';
			}

			// Add image orientation
			$orientation = $show->images()->first()->orientation() == 'landscape' ? "landscape" : "portrait";

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
			$output[] = "added";

			// if(!in_array($startyear, $allyears)) {
			// 	if(!empty($allyears)) {
			// 		echo "</div>";
			// 	}
			// 	$block = "<div class='home_show_outer'>";
			// 	$block .= "<div class='home_show_year'>";
			// 	$block .= " {$startyear}";
			// 	$block .= "</div>";
				
			// 	echo $block;
			// 	$allyears[] = $startyear;
			// }

			// if(!in_array($startyear, $allyears)) {

			// 	$block = "<td class='home_show_year'>";
			// 	$block .= "<span>";
			// 		$block .= "{$startyear}";
			// 	$block .= "</span>";	
			// 	$block .= "</td>";
				
			// 	echo $block;
			// 	$allyears[] = $startyear;
			// }

			//url
			if($show->images()->count() > 1 ||  $show->description()->isNotEmpty()) {
				$urlStart = $show->url();
				$urlEnd = "</a>";
			} /*else if ($show->images()->count() < 2 && $show->description()->isNotEmpty() ) {
				$urlStart = "<div class='home_show_link' data-text='{$show->description()->kirbytext()}'>";
				$urlEnd = "</div>";
			}*/ else {
				$urlStart = "";
				$urlEnd = "";
			}
			


			//Build Block and display

			$block = "<tr class='home_show' data-href='{$urlStart}'>";
			
			// $block .= $urlStart;
			
			$block .= "<td class='home_show_title'>";
				$block .= "<span>{$show->title()}</span>";
			$block .= "</td>";
			
				
			$block .= "<td class='home_show_artist'>";
				$block .= "<span>{$artisttag}</span>";
			$block .= "</td>";

			$block .= "<td class='home_show_date'>";
				$block .= "<span>";
				$block .= "{$datestring}";
				if ($when === "upcoming") {
					$block .= "<br>";
					$block .= "Opening: {$openingstring}";
				}
				$block .= "</span>";
			$block .= "</td>";

			$block .= "<td class='home_show_thumb'>";
				$block .= "<span><img src='{$img}'></span>";
			$block .= "</td>";
		
			$block .= "</tr>";
			
			echo $block;

		}

	if((isset($_GET['times']) || isset($_GET['artists'])) && !in_array("added", $output)) {
		echo "<div class='no_match'>No matches found. Please redefine your selection.</div>";
	}
	?>

</table>
</div>

<?php snippet('footer') ?>