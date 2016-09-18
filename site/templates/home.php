<?php snippet('header') ?>

<div class="menu_wrapper">
<div class="menu_artists">
	<?php foreach($artists as $artist):
		$title = $artist->title()->html();
		$titlelow = $title->lower()->htm();
		$titlelow = preg_replace('/\s*/', '', $titlelow);
		$request = kirby()->request()->query('artists');
		$active = (strpos($request, $titlelow) !== false ) ? 'active' : '';
			$output = " <a href='?artists=";
			$output .= $titlelow;
			$output .="' class='menu_item ";
			$output .= $active;
			$output .="'>";
			$output .= $title;
			$output .=",</a>";
			echo $output;
	endforeach ?>
</div>
	<div class="menu_time">
	<?php 
	$times = array("Upcoming", "Current", "Past");
	foreach($times as $time):
		$timelow = strtolower($time);
		$request = kirby()->request()->query('time');
		$active = (strpos($request, $timelow) !== false ) ? 'active' : '';
			$output = " <a href='?time=";
			$output .= $timelow;
			$output .="' class='menu_item ";
			$output .= $active;
			$output .="'>";
			$output .= $time;
			$output .=",</a>";
			echo $output;
	endforeach ?>
	</div>
</div>

<div class="main_wrapper">




	<?php 
		foreach($collection as $item):
			$filtered = array();
						foreach($item->title()->html() as $filter){
				if(!in_array($filter, $filtered)){
					$filtered[]=$filter;
				};
			};
			// $var_artist = kirby()->request()->get('artist');
			$$var_artist = "test";

			if(!in_array($var_artist, $filtered)):
			    continue;
			endif;
	?>
	<div style="width: 100px; height: 100px; float: left; background: green;"></div>


	<?php endforeach; ?>
</div>

























<?php snippet('footer') ?>