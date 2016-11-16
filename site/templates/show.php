<?php snippet('header'); ?>

<div class="menu_wrapper">
	<?snippet('site_nav') ?>
</div>	

<div class="show_wrapper">

<div class="show_info">	
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


		$block = "<div class='show_info_title'>";
		$block .= $title;
		$block .= "</div>";


		if($page->artist()->isNotEmpty() && $page->extartist()->isNotEmpty() ){
			$block .= "<div class='show_info_artists'>";		
			// $block .= "<br>";
			foreach ($artists as $artist) {	
				$block .= "<span>";
				$block .= $artist;
				$block .= ", ";
				$block .= "</span>";
				$block .= " ";
			}
			foreach ($page->extartist()->artistname()->toStructure() as $exhartist) {
			$i++;
				$block .= "<span>";
				$block .= $exhartist;
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
			foreach ($page->extartist()->artistname()->toStructure() as $exhartist) {
			$i++;	
				$block .= "<span>";
				$block .= $exhartist;
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
		echo $block;
	?>

</div>

<?php if($page->images()->count() > 1): ?>
	<!-- <div class="show_description_button">
		Press Release
	</div> -->
	
	<div class="show_thumb">
	<?php $images = $page->images();?>	
	<?php foreach($images->sortBy('sort', 'asc') as $image): ?>
		<div class="show_thumb_image">
			<img class='show_thumb_img zoomable' src="<?php echo $image->resize(1400)->url() ?>">
			<span class='show_thumb_caption'><?php echo $image->caption()->kirbytext()?></span>
		</div>
	<?php endforeach ?>
	</div>

	<div class="artist_overlay_wrapper">
	<?php $images = $page->images();?>		
		<div class="overlay_slide">
			<?php foreach($images->sortBy('sort', 'asc') as $image): $url = $image->resize(1400)->url(); $caption = $image->caption()->text(); ?>
				<div class="overlay_slide_s" >
					<div class="overlay_slide_s_img" data-style="background-image: url('<?php echo $url ?>')"></div>
					<div class="overlay_slide_s_caption"><?php echo $caption?></div>
				</div>
			<?php endforeach ?>
		</div>
	</div>
<?php endif ?>

<?php if($page->description()->isNotEmpty()): ?>
  	<div class="show_description">
  		<div class="show_description_title">Press Release</div>
	  	<?php
	  		echo $page->description()->kirbytext();
	  	?>
	  </div>
<?php endif ?>


</div>

<?php snippet('footer') ?>