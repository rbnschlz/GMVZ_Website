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

<!-- 	<div class='menu_switch'>
	<?php 
	$checked = $page->parent()->title() == "Artists"? "checked" : ""; 
	// $gohome = $page->parent()->title() == "Artists"? "gohome" : "";
	?>
		<a class="menu_switch_shows">Shows</a>
		<label class="menu_switch_label">
			<input id="menu_switch_checkbox" class="<?php //echo $gohome ?>" <?php echo $checked ?> type="checkbox">
			<div class="menu_switch_slider"></div>
		</label>
		<a class="menu_switch_artists">Artists</a>
	</div> -->

	<div class='menu_switch'>
		<a href="/">Shows</a>
		<a href="/artists">Artists</a>
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

			// GET parameter
			$params = $_GET;

			//Check if page title matches current page
			if ($title == $page->title()) {
				$artistlink = "";
				// $title = "Show All";
				$url = "";
				if(!isset($_GET['artists'])) {
					$active = " active";
				};
				$hide = " hidethis";
			} else {
				//Check if times variable is set
				if(isset($_GET['times'])) {
					$url = http_build_query($params);
					$url .= "&artists=$titlelow";
				} else {
					$url = "?artists=$titlelow";
				};
				$artistlink = $artist->url();
				$active = "";
				$hide = "";

				//Check if variable is set
				if(isset($_GET['artists'])) {
					//Add space if variable is already defined
					// If title is not yet added, add title
					if (strpos($params["artists"], $titlelow) === false) {
						$params["artists"] .= " ";
						$params["artists"] .= $titlelow;
						$active = "";

					} else if (trim($params["artists"]) === $titlelow) {
						unset($params["artists"]);
						$params = str_replace('&', '', $params);
						$active = " active";

					//if title is added, remove title
					} else if (strpos($params["artists"], $titlelow) !== false) {
						$params["artists"] = str_replace(" $titlelow", '', $params["artists"]);
						$params["artists"] = str_replace("$titlelow ", '', $params["artists"]);
						$params["artists"] = str_replace("$titlelow", '', $params["artists"]);
						$active = " active";
					}

					//Build query
					$url = http_build_query($params);
				}
			};

				//Add question mark if variable is set
				if (isset($params["times"]) || isset($params["artists"])) {
					$filter = "?";
				} else {
					$filter = "";
				}

			//Assemble Menu
			$output = " <a href='";
			$output .= !$page->isChildOf($artistspage) ? $site->url().$filter.$url : $artistlink;
			$output .="' data-links='";
			$output .= $artistlink;
			$output .= "' data-filter='";
			$output .= $site->url().$filter.$url;
			$output .="' class='menu_artist nobr";
			$output .= $active.$hide;
			$output .="'>";
			$output .= $title;
			$output .= $i < $len ? "," : "";
			$output .="</a>";
			echo $output;
		endforeach; ?>
	</div>


</div>