
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
<?php snippet('site_nav'); ?>


<!-- 	<div class='menu_switch'>
	<a class="active" href="/">Shows</a>, <a href="/artists">Artists</a>
	</div> -->

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

		//Check if page title matches current page
		if ($title == $page->title()) {
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
			// $artistlink = $artist->url();
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

		//Assemble Menu//Assemble Menu
		$activeUrl = $_SERVER['REQUEST_URI'];
		if(strpos($activeUrl, 'times') === false && strpos($url, 'artists') === false || strpos($activeUrl, 'artists') === false ) {
			$output = " <a href='";
			$output .= $site->url().$filter.$url;
			$output .="' class='menu_artist nobr active";
			$output .= $active.$hide;
			$output .="'>";
			$output .= $title;
			$output .= "<span class='comma'>";
			$output .= $i < $len ? ", " : "";	
			$output .= "</span>";
			$output .="</a>";
		} else {
			$output = " <a href='";
			$output .= $site->url().$filter.$url;
			$output .="' class='menu_artist nobr";
			$output .= $active.$hide;
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

			// Assemble Menu
			$activeUrl = $_SERVER['REQUEST_URI'];
			if(strpos($activeUrl, 'times') === false && strpos($url, 'artists') === false || strpos($activeUrl, 'times') === false ) {
				$output = " <a href='";
				$output .= $site->url().$filter.$url;
				$output .="' class='menu_time active";
				$output .="'>";
				$output .= $title;
				$output .= "<span class='comma'>";
				$output .= $i < $len ? ", " : "";	
				$output .= "</span>";
				$output .="</a>";
					
			} else {
				$output = " <a href='";
				$output .= $site->url().$filter.$url;
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

	


</div>