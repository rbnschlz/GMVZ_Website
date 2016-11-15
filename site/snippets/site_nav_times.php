<div class="menu_times">
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
		// $artistlink = $artist->url();
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

		// Assemble Menu
		$activeUrl = $_SERVER['REQUEST_URI'];
		if(strpos($activeUrl, 'times') === false && strpos($url, 'artists') === false || strpos($activeUrl, 'times') === false ) {
			$output = " <a href='";
			$output .= $page->url().$filter.$url;
			$output .="' class='menu_time active";
			$output .="'>";
			$output .= $title;
			$output .= "<span class='comma'>";
			$output .= $i < $len ? ", " : "";	
			$output .= "</span>";
			$output .="</a>";
				
		} else {
			$output = " <a href='";
			$output .= $page->url().$filter.$url;
			$output .="' class='time_artist";
			$output .= $active;
			$output .="'>";
			$output .= $title;
			$output .= "<span class='comma'>";
			$output .= $i < $len ? ", " : "";	
			$output .= "</span>";
			$output .="</a>";
						
		}
		
		echo $output;
		
	endforeach; ?>
</div>