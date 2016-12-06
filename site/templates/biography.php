<?php snippet('header');  ?>
<div class='main_wrapper'>	
	<div class="close_bt">
		<?php 
			$block = "<a href='";
			$block .= $page->parent()->url();
			$block .= "' class='show_backbt'>Close";

			$block .= "</a>";
			echo $block;
		?>
	</div>	
	<div class='artist_bio_info'>
		<?php 
		$artist = $page->parent();
		$title = $artist->title();
		$block = "<li class='artist_bio_info_section'>";
		$block .= "<span class='artist_bio_info_title '>";

		$block .= $title;
		$block .= "</span>";
		$block .= "</li>";

		echo $block;

		$block = "<li class='artist_bio_info_section'>";
		$block .= "<span class='artist_bio_info_year'>";
		$block .= $artist->yearBirth();
		$block .= "</span>";
		$block .= $artist->yearBirth()->isNotEmpty() && $artist->placeBirth()->isNotEmpty() ? ", " : "";
		$block .= "<span class='artist_bio_info_place'>";
		$block .= $artist->placeBirth();
		$block .= "</span>";
		$block .= "<span class='artist_bio_info_web'>";
		$block .= "<a href='".$artist->web()."' target='_blank'>";
		$block .=  url::short($artist->web());
		$block .= "</a></span>";
		$block .= "</li>";

		echo $block

		?>
	</div>
		
	<div class='artist_bio'>
		<?php foreach($page->children()->visible() as $category): ?>
			<section class="artist_bio_section">
				<div class="artist_bio_section_headline"><span><?php echo $category->title(); ?></span></div>
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
</div>
<?php snippet('footer');  ?>