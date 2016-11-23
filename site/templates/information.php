<?php snippet('header'); snippet('information_menu'); ?>

<div class="information_wrapper">
	<div class="information_info">
		<?php
		$openinghour = $page->openhour();
		$closinghour = $page->closinghour();
		$daysopen = $page->daysopen();

		$timestring = returnTime($openinghour, $closinghour);
		$daysstring = returnDays($daysopen);

		$block = "<span>";
		$block .= $page->street();
		$block .= "</span>";
		$block .= "<span>";
		$block .= $page->city();
		$block .= "</span>";

		$block .= "<div class='information_info_open'>";	
			$block .= "<span>";
			$block .= $daysstring;	
			$block .= "</span>";
			$block .= ", ";
			$block .= "<span>";
			$block .= $timestring;
			$block .= ".";
			$block .= "</span>";
		$block .= "</div>";
		echo $block;
	
		?>
	</div>

	<div class="information_contact">
		<?php
			$mail = $page->mail();
			


			$block = "<a href='mailto:{$mail}'>{$mail}</a>";

			if($page->phone()->isNotEmpty() || $page->mobile()->isNotEmpty() ) {
			$block .= "<div class='information_contact_telephone'>";
				if($page->phone()->isNotEmpty()) {
				$block .= "<span>";
				$block .= $page->phone();
				$block .= "</span>";
				}
				if($page->mobile()->isNotEmpty()) {
				$block .= ", ";
				$block .= "<span>";
				$block .= $page->mobile();
				$block .= "</span>";
				}
			$block .= "</div>";	
			}

			if($page->facebook()->isNotEmpty() || $page->instagram()->isNotEmpty() ) {
			$block .= "<div class='information_contact_socialm'>";
				if($page->facebook()->isNotEmpty()) {
				$block .= "<a href='{$page->facebook()}' target='_blank'>Facebook</a>";
				}
				if($page->instagram()->isNotEmpty()) {
				$block .= ", ";
				$block .= "<a href='{$page->instagram()}' target='_blank'>Instagram</a>";
				}
			$block .= "</div>";	
			}
			
			echo $block;
		?>
	</div>

	<div class="information_newsletter">
	Subscribe for the newsletter
	</div>
	

</div>

<?php snippet('footer') ?>