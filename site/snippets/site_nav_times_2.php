<div class="menu_sub">
	<?php $times = array("Upcoming", "Current", "Past");

	//Striketrough
	$featured = [];
	$current_date = strtotime(date('Y-m-d H:i:s'));
	foreach($page->items()->toStructure() as $matches) {
			$start = strtotime($matches->startdate());
        	$end = strtotime($matches->enddate());

			if ($end < $current_date) {
				$featured[] = "Past";
			} else if (($start < $current_date) && ($end > $current_date)) {
				$featured[] = "Current";
			} else if ($start > $current_date) {
				$featured[] = "Upcoming";
			};
	}

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
				//PJAX Fix
				$url = str_replace('&_pjax=%23pjax_wrapper', '', $url);
				$url = str_replace('_pjax=%23pjax_wrapper', '', $url);
			}

			//Add question mark if variable is set
			if (isset($params["times"]) || isset($params["artists"])) {
				$filter = "?";
			} else {
				$filter = "";
			}

		// Assemble Menu
		$activeUrl = $_SERVER['REQUEST_URI'];

		$output ="<li class='menu_time nobr";
		$output .="'>";
		$output .= (in_array($title, $featured)) ? "<a href='" : "<span";
		$output .= (in_array($title, $featured)) ? $page->url().$filter.$url : "";
		$output .= (in_array($title, $featured)) ? "' class='pjax " : " class='pjax ";
		$output .= (in_array($title, $featured)) ? "" : " strike";
		$output .= $active;
		$output .= "'>";
		$output .= $title;
		$output .= (in_array($title, $featured)) ? "</a>" : "</span>";
		$output .= "<span class='comma'>";
		$output .= $i < $len ? ",&nbsp" : "";	
		$output .= "</span>";
		$output .= "</li>";	
		
						
		// }
		
		echo $output;
		
	endforeach; ?>
</div>