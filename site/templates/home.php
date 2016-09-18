<?php snippet('header') ?>

<div class="menu_wrapper">
	<div class="menu_artists">
		<?php foreach($artists as $artist):
			$title = $artist->title()->html();
			$titlelow = $title->lower()->htm();
			$titlelow = preg_replace('/\s*/', '', $titlelow);
			$request = kirby()->request()->query('filter');
			$active = (strpos($request, $titlelow) !== false ) ? 'active' : '';
			$url = $_SERVER['REQUEST_URI'];
			if (!isset($_GET["filter"])) {
				$param = " <a href='";
				$param .= $url;
				$param .= "?filter=";
			} else if (isset($_GET["filter"]) && strpos($request, $titlelow) == false) {
				$param = " <a href='";
				$param .= $url;
				$param .= ",";
			} else if (isset($_GET["filter"]) && strpos($request, $titlelow) !== false) {
				$param = " <a href='";
				$param .= str_replace($titlelow, '', $url);
				$param = str_replace(',,', ',', $param);
				$param = str_replace('=,', '=', $param);
				// $param = (str_word_count($request) > 1) ? str_replace('?filter=', '', $param) : $param; 
			};



			if (strpos($request, $titlelow) == false) {
				$filter = $titlelow;
			} else {
				$filter = "";
			}











				$output = $param;
				$output .= $filter;
				$output .="' class='menu_item ";
				$output .= $active;
				$output .="'>";
				$output .= $title;
				$output .=",</a>";
				echo $output;
		endforeach ?>
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