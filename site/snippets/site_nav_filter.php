<?php
	function umlaute($string) {
		$search = array("Ä", "Ö", "Ü", "ä", "ö", "ü", "ß", "´", "ó");
		$replace = array("Ae", "Oe", "Ue", "ae", "oe", "ue", "ss", "", "o");
		return str_replace($search, $replace, $string);
	}

	$artists = page('artists')->children()->visible();
?>

<div class='menu_artists'>
	<!-- Build artist menu -->
	<?php
	//Comma or not
	$i = 0;
	$len = count($artists);
	$artistMenu = array();
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

		//Check if page title matches current page (OLD)
		// if ($title == $page->title()) {
			// $url = "";
			// if(!isset($_GET['artists'])) {
			// 	$active = " active";
			// };
			// $hide = " hidethis";
		// } else {

		//Check if times variable is set
		if(isset($_GET['times'])) {
			$url = http_build_query($params);
			$url .= "&artists=$titlelow";
		} else {
			$url = "?artists=$titlelow";
		};
		// $artistlink = $artist->url();
		$active = "";
		// $hide = "";

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
		};
		// };

			//Add question mark if variable is set
			if (isset($params["times"]) || isset($params["artists"])) {
				$filter = "?";
			} else {
				$filter = "";
			}

		//Assemble Menu
		$activeUrl = $_SERVER['REQUEST_URI'];
		// if(strpos($activeUrl, 'times') === false && strpos($url, 'artists') === false || strpos($activeUrl, 'artists') === false ) {
		// 	$output = " <a href='";
		// 	$output .= $page->url().$filter.$url;
		// 	$output .="' class='menu_artist nobr";
		// 	$output .= $active;
		// 	$output .="'>";
		// 	$output .= $title;
		// 	$output .= "<span class='comma'>";
		// 	$output .= $i < $len ? ", " : "";	
		// 	$output .= "</span>";
		// 	$output .="</a>";
		// } else {
			$output = " <a href='";
			$output .= $page->url().$filter.$url;
			$output .="' class='menu_artist nobr";
			$output .= $active;
			$output .="'>";
			$output .= $title;
			$output .= "<span class='comma'>";
			$output .= $i < $len ? ", " : "";	
			$output .= "</span>";
			$output .="</a>";					
		// }
		
			echo $output;
	endforeach; ?>
</div>	