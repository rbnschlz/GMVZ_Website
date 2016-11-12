<?php snippet('header'); snippet('artists_menu'); ?>
<div class="main_wrapper">
<div class='artist_wrap'>

	<div class='artist_biography hide'>
	<?php
	$allyears = [];

	foreach($page->builder()->toStructure() as $section) {
		$title = $section->title();


		if($section->_fieldset() == 'dateSummary') {
		$block = "<div class='artist_biography_section'>";
		$block .= "<div class='artist_section_title'>{$title}</div>";

			$input = $section->text()->text();
			$input = explode("\n", $input);			
			
			$property_types = array();
			foreach ($input as $section) {
				$line = explode(" ", $section);
				$date = $line[0];

				if (!in_array($date, $property_types) ) {
			    $date = $line[0];
			    } else {
			    $date = " ";
			    }
			    
				$info = array_slice($line, 1);
				$info = implode(" ", $info);

				$section_block = "<div class='artist_section'>";
		 		$section_block .= "<div class='artist_section_date'>{$date}</div>";
				$section_block .= "<div class='artist_section_info'>{$info}</div>";
				$section_block .= "</div>";
				
				$block .= $section_block;

				$property_types[] = $date;
			}
		$block .= "</div>";
		
		} else if($section->_fieldset() == 'doubleDateSummary') {
		$block = "<div class='artist_biography_section'>";
		$block .= "<div class='artist_section_title'>{$title}</div>";

			$input = $section->text();
			$input = explode("\n", $input);

			foreach ($input as $section) {
				$line = explode(" ", $section);
				$date = $line[0];
				$info = array_slice($line, 1);
				$info = implode(" ", $info);

				$section_block = "<div class='artist_section'>";
		 		$section_block .= "<div class='artist_section_date'>{$date}</div>";
				$section_block .= "<div class='artist_section_info'>{$info}</div>";
				$section_block .= "</div>";
				
				$block .= $section_block;
			}

		$block .= "</div>";	

		} else if($section->_fieldset() == 'textSummary') {
		$block = "<div class='artist_biography_section'>";
		$block .= "<div class='artist_section_title'>{$title}</div>";

			$input = $section->text()->text();
			$input = explode("\n", $input);

			$block .= "<div class='artist_summary_wrap>";
			foreach ($input as $section) {
				$block .= "<div class='artist_section_info' style='display: block'>{$section}</div>";
			}

		$block .= "</div>";
		}	

		echo $block;
	}
	?>
	</div>

	<div class='artist_thumb_wrap'>
	<?php $thumbs = $page->images();?>	
		<?php foreach($thumbs->sortBy('sort', 'asc') as $thumb): ?>
					<div class="artist_thumb"><img class='main_thumb_img zoomable' src="<?php echo $thumb->resize(500)->url() ?>"></div>
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


</div>
</div>

<?php snippet('footer') ?>