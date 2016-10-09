<?php
	function umlaute($string) {
		$search = array("Ä", "Ö", "Ü", "ä", "ö", "ü", "ß", "´", "ó");
		$replace = array("Ae", "Oe", "Ue", "ae", "oe", "ue", "ss", "", "o");
		return str_replace($search, $replace, $string);
	}

		$shows = page('shows')->children();
		$artists = page('artists')->children()->visible();
?>



<div class="menu_wrapper">
	<div class='menu_switch'>
		<a href="/">Shows</a>, <a class="active" href="/artists">Artists</a>
	</div>

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

			//Check if page title matches current page
			if ($title == $page->title()) {
				$artistlink = "";
				$url = "";
				if(!isset($_GET['artists'])) {
					$active = " active";
				};
				$hide = " hidethis";
			} else {
				$artistlink = $artist->url();
				$active = "";
				$hide = "";
			};

			//Assemble Menu
			$output = " <a href='";
			$output .= $artistlink;
			$output .="' class='menu_artist nobr";
			$output .= $active.$hide;
			$output .="'>";
			$output .= $title;
			$output .="</a>";
			$output .= $i < $len ? "," : "";
			echo $output;
		endforeach; ?>
	</div>


</div>