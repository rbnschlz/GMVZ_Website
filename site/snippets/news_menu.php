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
<?php snippet('site_nav'); ?>

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
			$output = " <a href='";
			$output .= $artistlink;
			$output .="' class='menu_artist nobr";
			$output .= $active;
			$output .="'";
			$output .=">";
			$output .= $title;
			$output .= "<span class='comma'>";
			$output .= $i < $len ? ", " : "";	
			$output .= "</span>";
			$output .="</a>";	
			
			echo $output;

		endforeach; ?>
	</div>


</div>