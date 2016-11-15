<?php
	function umlaute($string) {
		$search = array("Ä", "Ö", "Ü", "ä", "ö", "ü", "ß", "´", "ó");
		$replace = array("Ae", "Oe", "Ue", "ae", "oe", "ue", "ss", "", "o");
		return str_replace($search, $replace, $string);
	}

		$shows = page('shows')->children();
		$artistsUrl = page('artists')->url();
		$artistsParent = page('artists');
		$artists = page('artists')->children()->visible();
		
?>

<div class="menu_wrapper">
<?php snippet('site_nav_menu'); ?>

	<div class="menu_artists">
		<?php 
		//Comma or not
		$i = 0;
		$len = count($artists);
		$artistspage = page("artists");
		//Foreach loop
		foreach($artists as $artist):
			$i++;
			$title = $artist->title();
			$titlelow = $title->lower();
			$titlelow = umlaute($titlelow); 
			$titlelow = str_replace(' ', '', $titlelow);
			$titlelow = str_replace('-', '', $titlelow);
			if($artist->hasImages()){
			$artistsImage = $artist->images()->sortBy('sort', 'asc')->first()->url();
			} else {
			$artistsImage = "";	
			}

			//Check if page title matches current page
			if ($title == $page->title()) {
				$artistlink = $artistsUrl;
				$url = "";
				if(!isset($_GET['artists'])) {
					$active = " active";
				};
			} else {
				$artistlink = $artist->url();
				$active = "";
				$hide = "";
			};

			//Assemble Menu
			$output ="<li class='menu_artist nobr";
			$output .= $active;
			$output .="'>";
			$output .= "<a href='";
			$output .= $artistlink;
			$output .="'>";
			$output .= $title;
			$output .="</a>";
			$output .= "<span class='comma'>";
			$output .= $i < $len ? ",&nbsp" : "";	
			$output .= "</span>";
			$output .="</li>";	
			
			echo $output;

		endforeach; ?>
	</div>

	<?php if($page->isChildOf(page($artistsParent))): ?>	
	<div class='menu_sub'>
		<span class='artist_work_button active'>Selected work</span>, <span class='artist_work_button'>Biography</span>
	</div>
	<?php endif ?>


</div>