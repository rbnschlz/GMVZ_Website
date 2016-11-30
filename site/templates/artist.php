<?php snippet('header'); ?>
<?php snippet('artists_menu'); ?>

<div class="main_wrapper">
	<div class="artist_artworks">
		<div class='artist_thumb_wrap'>
			<?php $thumbs = $page->images();
			foreach($thumbs->sortBy('sort', 'asc') as $thumb): $caption = $thumb->caption()->html(); ?>
<<<<<<< HEAD
				<div class="artist_thumb"><img class='artist_thumb_img zoomable' src="<?php echo $thumb->resize(500)->url() ?>">
				<!-- <?php echo $caption?> -->
				</div>
=======
				<div class="artist_thumb"><img class='artist_thumb_img zoomable' src="<?php echo $thumb->resize(500)->url() ?>"><?php echo $caption?></div>
>>>>>>> origin/master
			<?php endforeach ?>
		</div>
	</div>
</div>

<?php 
snippet("overlay"); 
snippet('footer');#
?>