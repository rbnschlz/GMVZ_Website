<?php snippet('header');  ?>
<div class='artist_bio_wrapper'>
		
		<div class='artist_bio_info'>
			<div>
				<?php echo html($page->parent()->title()) ?>
			</div>
			
			<?php if($page->parent()->yearBirth()->isNotEmpty() && $page->parent()->placeBirth()->isNotEmpty()): ?>
				<div>
					<?php echo html($page->parent()->yearBirth()) ?>, <?php echo html($page->parent()->placeBirth()) ?>	
				</div>  
			<?php elseif($page->parent()->yearBirth()->isNotEmpty()): ?>
				<div>
					<?php echo html($page->parent()->yearBirth()) ?>	
				</div> 	
			<?php endif ?>		

			<?php if($page->parent()->web()->isNotEmpty()): ?>
				<div class='artist_bio_info_web'>
					<a href='<?php echo html($page->parent()->web())?>' target="_blank"><?php echo html($page->parent()->web())?></a>
				</div> 	
			<?php endif ?>

		</div>
		
		<?php foreach($page->children()->visible() as $category): ?>
			<section class="artist_bio_section">
				<div class="artist_bio_section_headline"><?php echo $category->title(); ?></div>
				<?php foreach($category->entries()->toStructure() as $entry) {
					$year1 = $entry->year1();
					$year2 = $entry->year2();
					$fact = $entry->fact();

					$output = "<div class='artist_bio_section_entry'>";
					$output .= ($year1->isNotEmpty()) ? $year1 : "";
					$output .= ($year2->isNotEmpty()) ? " – " : "";
					$output .= ($year2->isNotEmpty()) ? $year2 : "";
					$output .= ($year1->isNotEmpty() || $year2->isNotEmpty()) ? ",&nbsp" : "";
					$output .= ($fact->isNotEmpty()) ? $fact : "";
					$output .= "</div>";

					echo $output;
				}

				?>
			</section>
		<?php endforeach ?>
	</div>