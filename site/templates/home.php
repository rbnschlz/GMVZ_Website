<?php snippet('header') ?>










<div class="main_wrapper">

	<?php 
		$artists = kirby()->request()->get('artists');
		$artists = "";
		$params = $_GET;
		foreach($shows as $show):
			$artist = $show->artist();
		if($artist->isNotEmpty()){
			$artistlow = $artist->lower();
			$artistlow = umlaute($artistlow);
			$artistlow = str_replace(' ', '', $artistlow);
			$artistlow = str_replace('-', '', $artistlow);
			$artistlow = str_replace(', ', '+', $artistlow);
		} else {
			$artistlow = " ";
		}

		if(isset($_GET['artists'])) {
			if(strpos($params["artists"], $artistlow) === false):
			    continue;
			endif;
		};
	?>
	<img src="<?php //echo $show->images()->first()->url()?>" style="height: 300px; width: auto; display: inline-block; vertical-align: top; padding: 10px;">
	<?php endforeach; ?>

</div>

























<?php snippet('footer') ?>