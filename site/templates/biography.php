<?php snippet('header'); snippet('artists_menu'); ?>
<div class="main_wrapper">
	<div class='artist_bio_wrapper'>
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