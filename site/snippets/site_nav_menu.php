<?php 
$shows  = $site->url();
$artistsUrl = page('artists')->url();
$artists = page('artists')->children()->visible();
?>

<div class="sitenav_wrapper">
<ol class="sitenav_left">
<?
$items = $site->children()->visible();
$first = $items->first();
$items = $items->not($first);

foreach($items as $child) {
	$parent = $child->parent();
	$menutitle = $child->title();
	if ($menutitle == "Information") {
		$menutitle = "Martin van Zomeren";
	};
	$menulower = $child->title()->lower();
	$menulink = $child->url();

	$block = "<li class='sitenav_nav sitenav_";
	$block .= $menulower;
	$block .= "'>";
	$block .= "<a href='";
	$block .= $menulink."' class='";
	$block .= ($child == $page || $page->parent() == $child) ? " active" : "";
	$block .= "'>";
	$block .= $menutitle;

	$block .= "</a>";
	$block .= "</li>";

	echo $block;

}?>
</ol>












	<!-- <ol class="sitenav_left">
		<li class="sitenav_nav sitenav_title">Martin van Zomeren</li>
		<li class="sitenav_nav sitenav_shows"><a href="<?php echo $shows ?>" <?php e($page->isHomePage() ||page('shows')->isOpen(), ' class="active"') ?>>Shows</a></li>
		<li class="sitenav_nav sitenav_artists"><a href="
			<?php 
			
			$url = $_SERVER['REQUEST_URI'];
			$timesClean = array('past+' => '','current+' => '','upcoming+' => '');
			$totalClean = array('past+' => '','current+' => '','upcoming+' => '', 'past' => '','current' => '','upcoming' => '','artists=' => '','times=' => '','?' => '','&' => '','/' => '' );
			$urlCleanTimes = strtr($url, $timesClean);
			$urlClean = strtr($url, $totalClean);
			$search = array("Ä", "Ö", "Ü", "ä", "ö", "ü", "ß", "´", "ó");
			$replace = array("Ae", "Oe", "Ue", "ae", "oe", "ue", "ss", "", "o");

			if(strpos($urlCleanTimes, 'artists') !== false && strpos($urlCleanTimes, '+') === false && $page->isHomePage()) {	
				
				foreach ($artists as $artist) {
					$artists = $artist->title()->text()->lower();
					$artists = str_replace(' ', '', $artists);
					$artists = str_replace('-', '', $artists);
					$artists = str_replace($search, $replace, $artists);
					
					if($artists === $urlClean) {
						echo $artist->url();
					}
				}
			} else {
				echo $artistsUrl;
			}
			
			?>
		" <?php e(page('artists')->isOpen(), ' class="active"') ?>>Artists</a></li>
		<li class="sitenav_nav sitenav_shop"><a href="/">Shop</a></li>
		<li class="sitenav_nav sitenav_fairs"><a href="/artfairs">Artfairs</a></li>
	</ol> -->



</div>