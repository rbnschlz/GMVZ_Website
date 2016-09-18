<?php snippet('header') ?>

<div class="menu_wrapper">
<div class="menu_artists">
	<?php foreach($artists as $artist): ?>
		<a class="menu_item" href=""><?php echo $artist->title()->html(); ?></a>
	<? endforeach ?>
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