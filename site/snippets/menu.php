<?php
	function umlaute($string) {
		$search = array("Ä", "Ö", "Ü", "ä", "ö", "ü", "ß", "´", "ó");
		$replace = array("Ae", "Oe", "Ue", "ae", "oe", "ue", "ss", "", "o");
		return str_replace($search, $replace, $string);
	}

		$shows = page('shows')->children();
		$artists = page('artists')->children()->visible();
		$collection = pages();
		$collection->add($artists);
		// $collection->add($page);
?>



<div class="menu_wrapper">

	<div class='menu_switch'>
	<?php $checked = $page->parent()->title() == "Artists"? "checked" : ""; ?>
		<a class="menu_switch_shows">Filter Shows</a>
		<label class="menu_switch_label">
			<input id="menu_switch_checkbox" <?php echo $checked ?> type="checkbox">
			<div class="menu_switch_slider"></div>
		</label>
		<a class="menu_switch_artists">Artist Information</a>
	</div>

	<div class="menu_artists">
		<?php 
		//Comma or not
		$i = 0;
		$len = count($collection);
		//Foreach loop
		foreach($collection as $artist):
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
			$output .= $page->parent() == page("Artists") ? $site->url().$filter.$url : $artistlink;
			$output .="' data-links='";
			$output .= $artistlink;
			$output .= "' data-filter='";
			$output .= $site->url().$filter.$url;
			$output .="' class='menu_artist";
			$output .= $active.$hide;
			$output .="'>";
			$output .= $title;
			$output .= $i < $len ? "," : "";
			$output .="</a>";
			echo $output;
		endforeach; ?>
	</div>

<?php //if($page->parent() == page("Artists")): ?>

	<div class="menu_time">
		<?php $times = array("Upcoming", "Current", "Past");
		//Comma or not
		$i = 0;
		$len = count($times);
		//Foreach loop
		foreach($times as $time):
			$i++;
			$title = $time;
			$titlelow = strtolower($title);

			// GET parameter
			$params = $_GET;

			//Check if artists variable is set
			if(isset($_GET['artists'])) {
				$url = http_build_query($params);
				$url .= "&times=$titlelow";
			} else {
				$url = "?times=$titlelow";
			};
			$artistlink = $artist->url();
			$active = "";
			$hide = "";

				//Check if variable is set
				if(isset($_GET['times'])) {
					//Add space if variable is already defined
					// If title is not yet added, add title
					if (strpos($params["times"], $titlelow) === false) {
						$params["times"] .= " ";
						$params["times"] .= $titlelow;
						$active = "";

					} else if (trim($params["times"]) === $titlelow) {
						unset($params["times"]);
						$active = " active";

					//if title is added, remove title
					} else if (strpos($params["times"], $titlelow) !== false) {
						$params["times"] = str_replace(" $titlelow", '', $params["times"]);
						$params["times"] = str_replace("$titlelow ", '', $params["times"]);
						$params["times"] = str_replace("$titlelow", '', $params["times"]);
						$active = " active";
					}

					//Build query
					$url = http_build_query($params);
				}

				//Add question mark if variable is set
				if (isset($params["times"]) || isset($params["artists"])) {
					$filter = "?";
				} else {
					$filter = "";
				}

			//Assemble Menu
			$output = " <a href='";
			$output .= $site->url().$filter.$url;
			$output .="' class='menu_artist";
			$output .= $active;
			$output .="'>";
			$output .= $title;
			$output .= $i < $len ? "," : "";
			$output .="</a>";
			echo $output;
		endforeach; ?>
	</div>
<?php //endif; ?>

	<a href="<?php echo $page->url() ?>" class='menu_reset'>Reset</a>


</div>