<?php snippet('header'); ?>

<div class="menu_wrapper">
	<?php 
		snippet('site_nav_menu'); 
		snippet('site_nav_filter'); 
	?>
</div>

<div class="main_wrapper">
 <?php foreach($page->children() as $object) {

 	$artists = $object->artist();
	$artists = explode(",", $artists);
	$i = 0;
	$len = count($object->extartist()->artistname()->toStructure());
	$artistcount = count($artists);
 	$image = $object->images()->first();

 	//Artist Names Variable
 	if($object->artist()->isNotEmpty() && $object->extartist()->isNotEmpty() ){
				$artblock = "<li class='shop_object_info_artist'>";		
				foreach ($object->artist()->toStructure() as $artist) {	
					$artblock .= "<span>";
					$artblock .= $artist;
					$artblock .= ", ";
					$artblock .= "</span>";
					$artblock .= " ";
				}
				foreach ($object->extartist()->artistname()->toStructure() as $extartist) {
					$i++;
					$artblock .= "<span>";
					$artblock .= $extartist;
					$artblock .= $i < $len ? ", " : "";
					$artblock .= "</span>";
					$artblock .= " ";
				}	
				$artblock .= "</li>";
			} else if ($object->artist()->isNotEmpty()){
				$artblock = "<li class='shop_object_info_artist'>";
				foreach ($object->artist()->toStructure() as $artist) {
					$i++;	
					$artblock .= "<span>";
					$artblock .= $artist;
					$artblock .= $i < $artistcount ? ", " : "";
					$artblock .= "</span>";
					$artblock .= " ";
				}
				$artblock .= "</li>";
			} else if ($object->extartist()->isNotEmpty()){
				$artblock = "<li class='shop_object_info_artist'>";
				$i = 0;
				foreach ($object->extartist()->artistname()->toStructure() as $exhartist) {
				$i++;	
					$artblock .= "<span>";
					$artblock .= $exhartist;
					$artblock .= $i < $len ? ", " : "";
					$artblock .= "</span>";
					$artblock .= " ";
				}	
				$artblock .= "</li>";
			}

		//Dimensions
		$dimblock = "";
		if($object->height()->isNotEmpty() && $object->width()->isNotEmpty()) {
			$dimblock = "<li class='shop_object_info_dim'>";
			$dimblock .= $object->height()." cm&thinsp;&#215;&thinsp;".$object->width()." cm";
			if($object->length()->exists()) {
				if($object->length()->isNotEmpty()) {
					$dimblock .= "&thinsp;&#215;&thinsp;".$object->length()." cm";
				}
			}
			$dimblock .= "</li>";
		}

		//Price
		if($object->price()->isNotEmpty() && $object->availability() == "available") {
			$priceblock = "<li class='shop_object_info_price'><span>";
			$priceblock .= $object->price();
			$priceblock .= " €</span></li>";
		} else {
			$priceblock = "<li class='shop_object_info_price'>Sold Out</li>";
		}

		//Published by
		if($object->publisher()->isNotEmpty()) {
			$publisher = "<li class='shop_object_info_publisher'><span>Published by ";
			$publisher .= $object->publisher();
			$publisher .= "</span>";
			$publisher .= $object->year()->isNotEmpty() ? ", <span>".$object->year()."</span>" : "";
			$publisher .= "</li>";
		}

 	if($object->hasImages()) {
	 	$block = "<div class='shop_object'>";
	 		$block .= "<img class='shop_object_img' src='".$image->url()."'></img>";
	 		$block .="<div class='shop_object_info'>";
	 		$block .= "<li class='shop_object_info_title'><span class='dotted'>".$object->title()."</span></li>";
	 		$block .= $artblock;
	 		$block .= $dimblock;
	 		$block .= $object->isbn()->isNotEmpty() ? "<li class='shop_object_info_isbn'><span>ISBN: ".$object->isbn()."</span></li>" : "";
	 		$block .= $object->designer()->isNotEmpty() ? "<li class='shop_object_info_designer'><span>Designed by ".$object->designer()."</span></li>" : "";
	 		$block .= $publisher;
	 		$block .= $object->edition()->isNotEmpty() ? "<li class='shop_object_info_edition'><span>Edition of ".$object->edition()."</span></li>" : "";
	 		$block .= $object->description()->isNotEmpty() ? "<div class='shop_object_info_desc'>".$object->description()."</div>" : "";
	 		$block .= $priceblock;
			$block .= "</div>";
	 	$block .= "</div>";

	 	echo $block;
	}
 } ?>

<?php snippet('footer') ?>