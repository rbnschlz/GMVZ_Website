<?php snippet('header'); snippet('menu'); snippet('sidenav') ?>

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
		$output = [];
		$allyears = [];


		foreach($shows as $show) {
			$start = strtotime($show->startdate());
        	$end = strtotime($show->enddate());
        	$startyear = date('Y', $start);

        	$datestring = returnDate($start, $end);
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
				$img = "style='background-image:url(".$show->images()->sortBy('sort', 'asc')->first()->url().")'";
				$img2 = "src='".$show->images()->sortBy('sort', 'asc')->first()->url()."'";
			}


			// Add artist attr
			$Extartist = $show->Extartist();
			$Extartist =  preg_replace("/\r|\n/", '', $Extartist);
			$Extartist = strtr($Extartist, array('-' => '', '   ' => '', 'artistname: ' => ", "));
			$Extartist = trim($Extartist,",");
			$Extartist = trim($Extartist," ");
			if($artist->isNotEmpty() && $show->Extartist()->isNotEmpty()){			
				$artisttag = $artist->lower().', '.$Extartist;
			} else if ($show->Extartist()->isNotEmpty()){
				$artisttag = $Extartist;
			} else if ($artist->isNotEmpty()) {
				$artisttag = $artist->lower();
			} else {
				$artisttag = '  ';
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

			if(!in_array($startyear, $allyears)) {
				if(!empty($allyears)) {
					echo "</div>";
				}
				$block = "<div class='home_show_outer'>";
				$block .= "<div class='home_show_year'>";
				$block .= " {$startyear}";
				$block .= "</div>";
				

				echo $block;
				$allyears[] = $startyear;
			}


			//Build Block and display
			if($show->images()->first()->orientation() == 'portrait') {
				$block = "<div class='home_show home_show_portrait";
				$block .= " {$orientation}' artist='{$artisttag}'>";
				$block .= "<div class='home_show_portrait_img img' {$img}></div>";
				$block .= "<div class='home_show_portrait_caption'>";
				$block .= "<span>{$show->title()}, </span>";
				$block .= "<span>{$datestring}</span>";
				$block .= "</div>";
				$block .= "</div>";
			} else {
				$block = "<div class='home_show home_show_landscape";
				$block .= " {$orientation}' artist='{$artisttag}'>";
				$block .= "<div class='home_show_landscape_img img' {$img}></div>";
				$block .= "<div class='home_show_landscape_caption'>";
				$block .= "<span>{$show->title()}, </span>";
				$block .= "<span>{$datestring}</span>";
				$block .= "</div>";
				$block .= "</div>";
			}
			echo $block;

		}

	if((isset($_GET['times']) || isset($_GET['artists'])) && !in_array("added", $output)) {
		echo "<div>No matches found. Please refine your selection.</div>";
	}
	?>

</div>


















<?php snippet('footer') ?>