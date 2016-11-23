<?php snippet('header'); ?>

<!-- <div class="menu_wrapper">
	<?snippet('site_nav') ?>
</div>	 -->

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
			if($page->description()->isNotEmpty() && $page->images()->count() > 1) {
				$block .= ", ";
				$block .= "<div class='show_info_button'>Press Release</div>";
			}
		$block .= "</div>";
		}
	?>


	

<?php if($page->description()->isNotEmpty() && $page->images()->count() > 1 || $page->images()->count() > 1 ): ?>
<div class="show_wrapper">
	<div class="show_info">	
		<?php echo $block; ?>
	</div>	

  	<div class="show_thumb_wrapper">
		<?php $images = $page->images();?>	
		<?php foreach($images->shuffle() as $image): 
			$orientation = $image->orientation() == 'landscape' ? "landscape" : "portrait";
			$caption = $image->caption()->kirbytext();
		?>
			<div class="show_thumb zoomable">
				<img class='show_thumb_image' src="<?php echo $image->resize(1400)->url() ?>">
			</div>
		<?php endforeach ?>
	</div>

	<div class="overlay_wrapper">
		<?php $images = $page->images();?>		
			<div class="overlay_slide">
				<?php foreach($images->sortBy('sort', 'asc') as $image): 
					$url = $image->resize(1400)->url(); 
					$caption = $image->caption()->text(); 
				?>
					<div class="overlay_slide_s" >
						<div class="overlay_slide_s_img" data-style="background-image: url('<?php echo $url ?>')"></div>
						<div class="overlay_slide_s_caption"><?php echo $caption?></div>
					</div>
				<?php endforeach ?>
			</div>
		</div>
	</div>	

	<div class="show_description_overlay"><?php echo $page->description()->kirbytext(); ?></div>
</div>	


<!-- if page has no images -->
<?php elseif($page->description()->isNotEmpty()): ?>	
	<div class="show_wrapper">
		<div class="show_info">	
			<?php echo $block; ?> 
		</div> 
		
		<div class="show_description"><?php echo $page->description()->kirbytext(); ?></div>

	</div>
<?php endif ?>



</div>

<?php snippet('footer') ?>