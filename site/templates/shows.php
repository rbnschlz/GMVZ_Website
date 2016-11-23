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

		foreach($shows as $show) {
			// Exhibition dates
			$start = strtotime($show->startdate());
        	$end = strtotime($show->enddate());
        	$startyear = date('Y', $start);
        	
        	$datestring = returnDate($start, $end);

        	// Opening date/time
        	$opening = strtotime($show->openingstart());
        	$closing = strtotime($show->openingend());
        	$openingdate = date('j M Y', $opening);
        	$openingtime = date('H:i', $opening);
        	$closingtime = date('H:i', $closing);
        	$time = "{$openingtime}–{$closingtime}";

        	$openingstring = "{$openingdate}";

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
				$img = "style='background-image:url(".$show->images()->sortBy('sort', 'asc')->first()->url().")'";
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
			$artistHover = "activeArtist";
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
			$artistHover = "activeArtist";
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
			$artistHover = "activeArtist";
			} else {
				$artistSummery = "";
				$artistHover = "";
			}


			// Add artist attr
			// $Extartist = $show->Extartist();
			// $Extartist =  preg_replace("/\r|\n/", '', $Extartist);
			// $Extartist = strtr($Extartist, array('-' => '', '   ' => '', 'artistname: ' => ", "));
			// $Extartist = trim($Extartist,",");
			// $Extartist = trim($Extartist," ");
			// if($artist->isNotEmpty() && $show->Extartist()->isNotEmpty()){			
			// 	$artisttag = $artist.', '.$Extartist;
			// } else if ($show->Extartist()->isNotEmpty()){
			// 	$artisttag = $Extartist;
			// } else if ($artist->isNotEmpty()) {
			// 	$artisttag = $artist;
			// } else {
			// 	$artisttag = '   ';
			// }

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
				$block .= " {$startyear}";
				$block .= "</div>";
				
				echo $block;
				$allyears[] = $startyear;
			}

			//url
			if($show->images()->count() > 1 ||  $show->description()->isNotEmpty()) {
				$urlStart = "<a href='{$show->url()}'>";
				$urlEnd = "</a>";
			} else {
				$urlStart = "";
				$urlEnd = "";
			}
			


			//Build Block and display

			$block = "<div class='shows_block'>";
			$block .= $urlStart;
			$block .= "<span class='shows_block_thumb {$when}' {$img} zoom-image={$zoomImg} data-time='{$when}'></span>";
			$block .= $urlEnd;
			$block .= "<span class='shows_block_caption $artistHover'>";
				$block .= "<span class='shows_block_title'>";
				$block .= $show->title();
				$block .= "</span>";
				$block .= ", ";
				
				$block .= "<span class='shows_block_date'>";
				$block .= $datestring;
				$block .= "</span>";

				if (!empty($artistSummery)) {
			    $block .= $artistSummery;
				}
			$block .= "</span>";
			$block .= "</div>";
			
			echo $block;
		}

		if( (isset($_GET['times']) || isset($_GET['artists'])) && !in_array("added", $output)) {
			echo "<div class='no_match'>No matches found. Please redefine your selection.</div>";
		}
		?>

	</div>

	<div class="shows_lenghtIndicatior hide">More bellow<br>&#8595;</div>

</div>

<?php snippet('footer') ?>