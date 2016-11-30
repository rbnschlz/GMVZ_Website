<div class="overlay_wrapper">
	<div class="overlay_slide">
		<?php foreach($page->images()->sortBy('sort', 'asc') as $image): ?>
			<div class="overlay_slide_s">
				<div class="overlay_slide_s_img" data-style="background-image: url('<?php echo $image->resize(2000, 1500, 80)->url() ?>')"></div>
			</div>
		<?php endforeach ?>
	</div>
</div>