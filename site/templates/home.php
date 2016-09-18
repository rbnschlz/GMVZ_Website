<?php snippet('header') ?>

<div class="menu_wrapper">
	<div class="menu_artists">
		<?php foreach($artists as $artist):
			$title = $artist->title()->html();
			$titlelow = $title->lower()->htm();
			$titlelow = str_replace(' ', '', $titlelow);
			$titlelow = str_replace('-', '', $titlelow);
			// $titlelow = preg_replace('/\s*/', '', $titlelow);
			$params = $_GET;

			//Add Plus sign if variable is already defined
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

			//Add question mark if variable is set
			if (isset($params["artists"])) {
				$filter = "?";
			} else {
				$filter = "";
			}

			//Assemble Menu
			$output = " <a href='";
			$output .= $site->url();
			$output .= $filter;
			$output .= $url;
			$output .="' class='menu_item ";
			$output .= $active;
			$output .="'>";
			$output .= $title;
			$output .=",</a>";
			echo ($output);
		endforeach; ?>
	</div>










<!-- 	<div class="menu_time">
		<?php ?>
	</div> -->

</div>










<div class="main_wrapper">




	<?php 
		foreach($collection as $item):
			$filtered = array();
						foreach($item->title()->html() as $filter){
				if(!in_array($filter, $filtered)){
					$filtered[]=$filter;
				};
			};
			// $var_artist = kirby()->request()->get('artist');
			$$var_artist = "test";

			if(!in_array($var_artist, $filtered)):
			    continue;
			endif;
	?>
	<div style="width: 100px; height: 100px; float: left; background: green;"></div>


	<?php endforeach; ?>
</div>

























<?php snippet('footer') ?>