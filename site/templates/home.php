<?php snippet('header') ?>

<div class="menu_wrapper">
	<div class="menu_artists">
		<?php foreach($artists as $artist):
			$title = $artist->title()->html();
			$titlelow = $title->lower();
			$titlelow = str_replace(' ', '', $titlelow);
			$titlelow = str_replace('-', '', $titlelow);
			// $titlelow = preg_replace('/\s*/', '', $titlelow);
			$params = $_GET;
			// print_r($params);
			if (!empty($params["artists"]) && strpos($params["artists"], $titlelow) === false) {
				$params["artists"] .= " ";
			}
			// if (!in_array($titlelow , $_GET)) {
			if (strpos($params["artists"], $titlelow) === false) {
				$params["artists"] .= $titlelow;
			// } else if (in_array($titlelow, $params)) {
			} else if (strpos($params["artists"], $titlelow) !== false) {
				$params["artists"] = str_replace($titlelow, '', $params["artists"]);

			}
			$params = str_replace('  ', ' ', $params);
			$params = str_replace('= ', '=', $params);
						$url = http_build_query($params);
			// $url = urldecode($url);
			if (isset($params["artists"])) {
				$filter="?";
			}


				$output = " <a href='";
				$output .= $site->url();
				$output .= $filter;
				$output .= $url;
				$output .="' class='menu_item ";
				// $output .= $active;
				$output .="'>";
				$output .= $title;
				$output .=",</a>";
				echo ($output);
				// print_r($params);


				endforeach;





















			// $active = (strpos($request, $titlelow) !== false ) ? 'active' : '';
			// $url = $_SERVER['REQUEST_URI'];
			// if (!isset($_GET["filter"])) {
			// 	$param = $url;
			// 	$param .= "?filter=";
			// } else if (isset($_GET["filter"]) && strpos($url, $titlelow) == false) {
			// 	$param = $url;
			// 	$param .= "&filter=";
			// } else if (isset($_GET["filter"]) && strpos($url, $titlelow) !== false) {
			// 	$param = str_replace('&filter', 'filter', $param);
			// 	$param = str_replace('?filter', 'filter', $param);
			// 	$param = str_replace($titlelow, '', $url);
			// 	// $param = (str_word_count($request) == 1) ? str_replace('?filter=', '', $param) : $param; 
			// };



			// if (strpos($request, $titlelow) == false) {
			// 	$filter = $titlelow;
			// } else {
			// 	$filter = "";
			// }










			// 	$output = " <a href='";
			// 	$output .= $param;
			// 	$output .= $filter;
			// 	$output .="' class='menu_item ";
			// 	// $output .= $active;
			// 	$output .="'>";
			// 	$output .= $title;
			// 	$output .=",</a>";
			// 	echo $output;
		 ?>
	</div>
<?php 
// 	class url extends url_Core {
	
// 	/* 
// 	 * Add a new variable to the query string
// 	 * or overwrites the value, if already exist
// 	 */
// 	public static function add_to_query_string($param, $new_value)
// 	{
// 		$parameters = input::instance()->get();
// 		$parameters[$param] = $new_value;
// 		return url::base().url::current().'?'.http_build_query($parameters);
// 	}
	
// 	/* 
// 	 * Remove a variable from the query string
// 	 */
// 	public static function remove_from_query_string($param)
// 	{
// 		$parameters = input::instance()->get();
// 		unset($parameters[$param]);
// 		return url::base().url::current().'?'.http_build_query($parameters);
// 	}
// }
?>










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