<?php snippet('header'); snippet('artists_menu'); ?>

<div class="main_wrapper">
	<div class="artist_artworks"
		<div class='artist_thumb_wrap'>
			<?php $thumbs = $page->images();
			foreach($thumbs->sortBy('sort', 'asc') as $thumb): ?>
				<div class="artist_thumb"><img class='main_thumb_img zoomable' src="<?php echo $thumb->resize(500)->url() ?>"></div>
			<?php endforeach ?>
		</div>

		<div class="artist_overlay_wrapper">
			<?php $images = $page->images(); ?>		
			<div class="overlay_slide">
				<?php foreach($images->sortBy('sort', 'asc') as $image): $url = $image->resize(1400)->url(); $caption = $image->caption()->text(); ?>
					<div class="overlay_slide_s" >
						<div class="overlay_slide_s_img" data-style="background-image: url('<?php echo $url ?>')"></div>
						<div class="overlay_slide_s_caption"><?php echo $caption?></div>
					</div>
				<?php endforeach ?>
			</div>
		</div>
	</div>
</div>

<?php snippet('footer') ?>