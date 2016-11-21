<?php
	function umlaute($string) {
		$search = array("Ä", "Ö", "Ü", "ä", "ö", "ü", "ß", "´", "ó");
		$replace = array("Ae", "Oe", "Ue", "ae", "oe", "ue", "ss", "", "o");
		return str_replace($search, $replace, $string);
	}

		$shows = page('shows')->children();
		$artistsUrl = page('artists')->url();
		$artistsParent = page('artists');
		$artists = page('artists')->children()->visible();
		
?>

<div class="menu_wrapper">
<?php snippet('site_nav_menu'); ?>

	<div class="menu_artists">
		<?php 
		//Comma or not
		$i = 0;
		$len = count($artists);
		$artistspage = page("artists");
		//Foreach loop
		foreach($artists as $artist):
			$i++;
			$title = $artist->title();
			$titlelow = $title->lower();
			$titlelow = umlaute($titlelow); 
			$titlelow = str_replace(' ', '', $titlelow);
			$titlelow = str_replace('-', '', $titlelow);
			if($artist->hasImages()){
			$artistsImage = $artist->images()->sortBy('sort', 'asc')->first()->url();
			} else {
			$artistsImage = "";	
			}

			//Check if page title matches current page
			if ($title == $page->title() || $title == $page->parent()->title()) {
				$artistlink = $artistsUrl;
				$url = "";
				// if(!isset($_GET['artists'])) {
					$active = " active";
				// };
			} else {
				$artistlink = $artist->url();
				$active = "";
				$hide = "";
			};

			//Assemble Menu
			$output ="<li class='menu_artist nobr'>";
			$output .= "<a href='";
			$output .= $artistlink;
			$output .="'class='";
			$output .= $active;
			$output .="'>";
			$output .= $title;
			$output .="</a>";
			$output .= "<span class='comma'>";
			$output .= $i < $len ? ",&nbsp" : "";	
			$output .= "</span>";
			$output .="</li>";	
			
			echo $output;

		endforeach; ?>
	</div>

	<div class='menu_sub'>

	<?php

	if($page->isDescendantOf('artists')) {

		$biourl = $page->children()->first()->url();
		$selectedurl = $page->template() == "biography" ? $page->parent()->url() : $page->url();
		$active1 = $page->template() == "biography" ? "" : "active";
		$active2 = $page->template() == "biography" ? "active" : "";

	$output = "<span href='";
	$output .= $selectedurl;
	$output .= "' class='sub_menu_works ";
	// $output .= $active1;
	$output .= "'>Selected Works</span>,&nbsp";
	$output .= "<a href='";
	$output .= $biourl;
	$output .= "' class='sub_menu_biography ";
	$output .= $active2;
	$output .= "'>Biography</a>";

	echo $output;


	} ?>
	</div>


</div>