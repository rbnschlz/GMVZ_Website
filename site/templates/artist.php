<?php snippet('header'); snippet('artists_menu'); ?>
<div class='loader'></div>
<!-- <div class="main_wrapper"> -->
	<div class="artist_artworks">
		<div class='artist_thumb_wrap hide'>
			<?php $thumbs = $page->images();
			foreach($thumbs->sortBy('sort', 'asc') as $thumb): $caption = $thumb->caption()->kirbytext(); ?>
				<div class="artist_thumb"><img class='main_thumb_img zoomable' src="<?php echo $thumb->resize(500)->url() ?>"><?php echo $caption?></div>
			<?php endforeach ?>
		</div>


		<div class="artist_artworks_container">
			<?php 
				$images = $page->images(); 
				$i = 0;
				$len = count($images);

				foreach($images->sortBy('sort', 'asc') as $image): 
				$url = $image->resize(1400)->url(); 
				$caption = $image->caption()->kirbytext();				
			?>

			<div class="artist_artworks_slide" >
				<div class="artist_artworks_image" style="background-image: url('<?php echo $url ?>')"></div>					
				
				<?php if ($image->caption()->isNotEmpty()):?>
					<div class="artist_artworks_caption"><?php echo $caption?></div>
				<?php endif ?>
			
				<?php if (!$i == 0): ?>
					<div class="artist_artworks_prev">&larr;</div>
				<?php endif ?>

				<?php if ($i < $len - 1):?>
					<div class="artist_artworks_next">&rarr;</div>
				<?php endif ?>
			</div>

			<?php 
				$i++; 
				endforeach 
			?>	
			<div class="artist_artworks_end">&#215;</div>	
		</div>
	

	
	</div>
<!-- </div> -->

<?php snippet('footer') ?>