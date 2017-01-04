<?php snippet('header'); ?>

<div class="main_wrapper">

	<div class="close_bt">
		<?php 
			$block = "<a href='";
			$block .= $page->parent()->url();

			$block .= "' class='pjax show_backbt'>Close";
			$block .= "</a>";
			echo $block;
		?>
	</div>

	<div class='show_info'>
		<?php
			$title = $page->title();
			$start = strtotime($page->startdate());
	    	$end = strtotime($page->enddate());
	    	$startyear = date('Y', $start);
	    	$datestring = returnDate($start, $end);
			
			$artists = $page->artist();
			$artists = explode(",", $artists);
			$i = 0;
			$len = count($page->extartist()->artistname()->toStructure());
			$artistcount = count($artists);

			$block = "<li class='show_info_section'>";
			$block .= "<span class='show_info_title'>";

			$block .= "<span>";
			$block .= $title;
			$block .= "</span>";
			$block .= "</span>";
			$block .= "</li>";

			$block .= "<li class='show_info_section'>";
			if($page->artist()->isNotEmpty() && $page->extartist()->isNotEmpty() ){
				$block .= "<div class='show_info_artists'>";		
				foreach ($artists as $artist) {	
					$block .= "<span>";
					$block .= $artist;
					$block .= ", ";
					$block .= "</span>";
					$block .= " ";
				}
				foreach ($page->extartist()->artistname()->toStructure() as $extartist) {
					$i++;
					$block .= "<span>";
					$block .= $extartist;
					$block .= $i < $len ? ", " : "";
					$block .= "</span>";
					$block .= " ";
				}	
				$block .= "</div>";
			} else if ($page->artist()->isNotEmpty()){
				$block .= "<div class='show_info_artists'>";
				foreach ($artists as $artist) {
					$i++;	
					$block .= "<span>";
					$block .= $artist;
					$block .= $i < $artistcount ? ", " : "";
					$block .= "</span>";
					$block .= " ";
				}
				$block .= "</div>";
			} else if ($page->extartist()->isNotEmpty()){
				$block .= "<div class='show_info_artists'>";
				$i = 0;
				foreach ($page->extartist()->artistname()->toStructure() as $extartist) {
				$i++;	
					$block .= "<span>";
					$block .= $extartist;
					$block .= $i < $len ? ", " : "";
					$block .= "</span>";
					$block .= " ";
				}	
				$block .= "</div>";
			}


			if($page->startdate()->isNotEmpty()) {
				$block .= "<div class='show_info_date'>";
				$block .= $datestring;
				$block .= "</div>";
			}
			$block .= "</li>";

			echo $block; ?>
	</div>

	<div class="show_images">
		<?php if($page->hasImages()) {
				foreach($page->images()->sortBy('sort', 'asc') as $image) {
					$orientation = $image->orientation() == 'landscape' ? "landscape" : "portrait";
					$caption = $image->caption()->kirbytext();

					$block = "<img class='show_images_img zoomable fader' src='";
					$block .= $image->url();
					$block .= "'></img>";

					echo $block;

				}
			}
		?>
	</div>

	<?php if($page->description()->isNotEmpty()):?>
	<div class="show_description">
		<div class="show_description_title">Press release</div>
		<?php echo $page->description()->kirbytext(); ?>
	</div>	
	<?php endif ?>


</div>

<?php snippet("overlay") ?>
<?php snippet('footer') ?>