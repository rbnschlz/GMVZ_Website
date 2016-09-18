<?php snippet('header') ?>

<div class="menu_wrapper">
<div class="menu_artists">
	<?php foreach($artists as $artist):
		$title = $artist->title()->html();
		$titlelow = $title->lower()->htm();
		$titlelow = preg_replace('/\s*/', '', $titlelow);
		$request = kirby()->request()->get('artist');
		$active = (strpos($request, $titlelow) !== false ) ? 'italic' : '';
					$output = " <a class='menu_item' href='?artist=";
					$output .= $titlelow;
					$output .="' class='";
					$output .= $active;
					$output .="'>";
					$output .= $title;
					$output .=",</a>";
					echo $output;
	endforeach ?>
</div>
	<div class="menu_time">
	<a class="menu_item">Upcoming</a>
	<a class="menu_item">Current</a>
	<a class="menu_item">Past</a>
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