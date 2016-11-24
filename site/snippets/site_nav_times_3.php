<div class="menu_sub">
	<?php $types = array("Publications", "Artworks");

	//Striketrough
	$featured = [];
	// $current_date = strtotime(date('Y-m-d H:i:s'));
	// foreach($page->children()->visible() as $matches) {
	// 		$start = strtotime($matches->startdate());
 //        	$end = strtotime($matches->enddate());

	// 		if ($end < $current_date) {
	// 			$featured[] = "Past";
	// 		} else if (($start < $current_date) && ($end > $current_date)) {
	// 			$featured[] = "Current";
	// 		} else if ($start > $current_date) {
	// 			$featured[] = "Upcoming";
	// 		};
	// }

	foreach($page->children()->visible() as $matches) {
	    //Set Type variable
		if ($matches->intendedTemplate() == "shopitem") {
			$featured[] = "Artworks";
		} else if ($matches->intendedTemplate() == "publication") {
			$featured[] = "Publications";
		}
	}

	//Comma or not
	$i = 0;
	$len = count($types);
	//Foreach loop
	foreach($types as $type) {
		$i++;
		$title = $type;
		$titlelow = strtolower($title);

		// GET parameter
		$params = $_GET;

		//Check if artists variable is set
		if(isset($_GET['artists'])) {
			$url = http_build_query($params);
			$url .= "&type=$titlelow";
		} else {
			$url = "?type=$titlelow";
		};
		// $artistlink = $artist->url();
		$active = "";
		$hide = "";

			//Check if variable is set
			if(isset($_GET['type'])) {
				//Add space if variable is already defined
				// If title is not yet added, add title
				if (strpos($params["type"], $titlelow) === false) {
					$params["type"] .= " ";
					$params["type"] .= $titlelow;
					$active = "";

				} else if (trim($params["type"]) === $titlelow) {
					unset($params["type"]);
					$active = "active";

				//if title is added, remove title
				} else if (strpos($params["type"], $titlelow) !== false) {
					$params["type"] = str_replace(" $titlelow", '', $params["type"]);
					$params["type"] = str_replace("$titlelow ", '', $params["type"]);
					$params["type"] = str_replace("$titlelow", '', $params["type"]);
					$active = "active";
				}

				//Build query
				$url = http_build_query($params);
			}

			//Add question mark if variable is set
			if (isset($params["type"]) || isset($params["artists"])) {
				$filter = "?";
			} else {
				$filter = "";
			}

		// Assemble Menu
		$activeUrl = $_SERVER['REQUEST_URI'];
		// if(strpos($activeUrl, 'times') === false && strpos($url, 'artists') === false || strpos($activeUrl, 'times') === false ) {
		// 	$output = " <a href='";
		// 	$output .= $page->url().$filter.$url;
		// 	$output .="' class='menu_time";
		// 	$output .="'>";
		// 	$output .= $title;
		// 	$output .= "<span class='comma'>";
		// 	$output .= $i < $len ? ", " : "";	
		// 	$output .= "</span>";
		// 	$output .="</a>";
				
		// } else {
			// $output = " <a href='";
			// $output .= $page->url().$filter.$url;
			// $output .="' class='time_artist";
			// $output .= $active;
			// $output .="'>";
			// $output .= $title;
			// $output .= "<span class='comma'>";
			// $output .= $i < $len ? ", " : "";	
			// $output .= "</span>";
			// $output .="</a>";

		$output ="<li class='menu_time nobr";
		$output .="'>";
		$output .= (in_array($title, $featured)) ? "<a href='" : "<span";
		$output .= (in_array($title, $featured)) ? $page->url().$filter.$url : "";
		$output .= (in_array($title, $featured)) ? "' class='" : " class='";
		$output .= (in_array($title, $featured)) ? "" : "strike";
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
		
	} ?>
</div>