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
		$collection->add($page);
?>



<div class="menu_wrapper">
	<!-- <div class="menu_title">
		<?php 
		echo $site->title()->text();
		?>
	</div> -->

	<div class='menu_switch'>
		<a class="menu_switch_shows">Filter Shows</a>
		<label class="menu_switch_label">
			<input id="menu_switch_checkbox" type="checkbox">
			<div class="menu_switch_slider"></div>
		</label>
		<a class="menu_switch_artists">Show Artist Information</a>
	</div>

	<div class='menu_nav'>

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
				// Define vars if get is not set
				$active = "";

			//Check if page title matches current page
			if ($title == $page->title()) {
				$artistlink = "";
				$title = "Show All";
				$url = "";
			} else {
				$url = "?artists=$titlelow";
				$artistlink = $artist->url();

				//Check if variable is set
				if(isset($_GET['artists'])) {
					//Add space if variable is already defined
					if (!empty($params["artists"]) && strpos($params["artists"], $titlelow) === false) {
						$params["artists"] .= " ";
					}

					// If title is not yet added, add title
					if (strpos($params["artists"], $titlelow) === false) {
						$params["artists"] .= $titlelow;
						$active = "";

					} else if (trim($params["artists"]) == $titlelow) {
						unset($params["artists"]);
						$active = "active";

					//if title is added, remove title
					} else if (strpos($params["artists"], $titlelow) !== false && trim($params["artists"]) != '') {
						$params["artists"] = str_replace(" $titlelow", '', $params["artists"]);
						$params["artists"] = str_replace("$titlelow ", '', $params["artists"]);
						$params["artists"] = str_replace("$titlelow", '', $params["artists"]);
						$active = "active";
					}

					//Build query
					$url = http_build_query($params);
				}
			};

				//Add question mark if variable is set
				if (isset($params["artists"]) || isset($params["time"])) {
					$filter = "?";
				} else {
					$filter = "";
				}

			//Assemble Menu
			$output = " <a href='";
			$output .= $site->url();
			$output .= $filter;
			$output .= $url;
			$output .="' data-filter='";
			$output .= $artistlink;
			$output .= "' data-links='";
			$output .= $site->url();
			$output .= $filter;
			$output .= $url;
			$output .="' class='menu_artist ";
			$output .= $active;
			$output .="'>";
			$output .= $title;
			$output .= $i < $len ? "," : "";
			$output .="</a>";
			echo ($output);
		endforeach; ?>
	</div>

	<div class="menu_time">
		<?php $times = array("Upcoming", "Current", "Past");
		foreach($times as $time):
			$timelow = strtolower($time);
			$params = $_GET;
			$active = "";
			//Check if variable is set
			if(isset($_GET['time'])) {
				//Add space sign if variable is already defined
				if (!empty($params["time"]) && strpos($params["time"], $timelow) === false) {
					$params["time"] .= " ";
				}

				// If title is not yet added, add title
				if (strpos($params["time"], $timelow) === false) {
					$params["time"] .= $timelow;
					$active = "";

				} else if (trim($params["time"]) == $timelow) {
					unset($params["time"]);
					$active = "active";

				//if title is added, remove title
				} else if (strpos($params["time"], $timelow) !== false && trim($params["time"]) != '') {
					$params["time"] = str_replace(" $timelow", '', $params["time"]);
					$params["time"] = str_replace("$timelow ", '', $params["time"]);
					$params["time"] = str_replace("$timelow", '', $params["time"]);
					$active = "active";
				}
			}

			//Build query
			$url = http_build_query($params);

			//Add question mark if variable is set
			if (isset($params["time"]) || isset($params["artists"])) {
				$filter = "?";
			} else {
				$filter = "";
			}

			//Assemble Menu
			$output = " <a href='";
			$output .= $site->url();
			$output .= $filter;
			$output .= $url;
			$output .="' class='menu_time ";
			$output .= $active;
			$output .="'>";
			$output .= $time;
			$output .=",</a>";
			echo ($output);
		endforeach; ?>
			<a href='<?php echo $site->url(); ?>' class='menu_item'>Show All</a>
	</div>
</div>