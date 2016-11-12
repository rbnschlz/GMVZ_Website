<?php snippet('header'); snippet('artists_menu'); snippet('side_nav') ?>
<!-- 
<div class='artists_wrap'>
	<?php $artists = $page->children()->visible() ?>
	<?php foreach($artists as $artist): ?>
				<a class="artists_wrap_link" href="<?php echo $artist->url()?>">
					<?php echo $artist->title()?>
				</a>
	<?php endforeach ?>
</div>
 -->
<?php snippet('footer') ?>