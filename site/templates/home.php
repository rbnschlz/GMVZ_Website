<?php snippet('header') ?>










<div class="main_wrapper">

	<?php 
		$artists = kirby()->request()->get('artists');
		$artists = "";
		$params = $_GET;
		foreach($shows as $show):
			$artist = $show->artist();
			$artist = $artist->toArray();
			$img = "";
			if ($show->hasImages()) {
				$img = "src='".$show->images()->first()->url()."'";
			}
		if($artist->isNotEmpty()){
			$artistlow = $artist->lower();
			$artistlow = umlaute($artistlow);
			$artistlow = str_replace(' ', '', $artistlow);
			$artistlow = str_replace('-', '', $artistlow);
			// $artistlow = str_replace(',', ', ', $artistlow);
			$artistarray = explode(',', $artistlow);
		} else {
			$artistlow = " ";
		};


		if(isset($_GET['artists'])) {
			if (!preg_match('/'.implode('|', $artistarray).'/', $params["artists"], $matches)) {
				continue;
			}
		};
	?>
	<img <?php echo $img ?>" style="height: 300px; width: auto; display: inline-block; vertical-align: top; padding: 10px;"></img>
	<?php endforeach; ?>

</div>

























<?php snippet('footer') ?>