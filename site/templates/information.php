<?php snippet('header'); snippet('information_menu'); ?>

<div class="main_wrapper">
	<div class="information_info">
		<?php
		$openinghour = $page->openhour();
		$closinghour = $page->closinghour();
		$daysopen = $page->daysopen();

		$timestring = returnTime($openinghour, $closinghour);
		$daysstring = returnDays($daysopen);

		$block = "<span>";
		$block .= $page->street();
		$block .= ",</span><span>";
		$block .= $page->city();
		$block .= "</span><div class='information_info_open'><span>";
		$block .= $daysstring;	
		$block .= "</span>, <span>";
		$block .= $timestring;
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
				if($page->phone()->isNotEmpty() && $page->mobile()->isNotEmpty()) {
					$block .= ", ";
				}
				if($page->mobile()->isNotEmpty()) {
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
				if($page->facebook()->isNotEmpty() && $page->instagram()->isNotEmpty()) {
					$block .= ", ";
				}
				if($page->instagram()->isNotEmpty()) {
					
					$block .= "<a href='{$page->instagram()}' target='_blank'>Instagram</a>";
				}
				$block .= "</div>";	
			}
			
			echo $block;
		?>
	</div>

<?php 
	$form = "<span class='newsletter_headline'>Newsletter</span>";
	$form .= "<form id='signup' class='mailform' action='' method='post'>";
	$form .= "<input class='name' type='text' name='name' placeholder='Name'>";
	$form .= "<input class='email' type='text' name='email' placeholder='e-Mail'>";
	$form .= "<input type='submit' name='submit' value='Subscribe'>";
	$form .= "</form>";

	echo $form; 

	if(isset($_POST['submit'])){
	    $email = email(array(
			'to'      => $mail,
			'from'    => $_POST['email'],
			'subject' => 'Newsletter Subscription',
			'body'    => 'Please add ' . $_POST['email'] . ', '. $_POST['name'] . ' to the list of subscribers'
		));

		if($email->send()) {
			echo "<span class='subscribed'>You are now subscribed.</span>";
		}
	}
?>

<div class='information_credit'>
<span class="information_credit_headline">Imprint</span>
<div class="information_credit_text">
	<span class="information_credit_text_copy">Copyright by Galerie Martin van Zomeren (<?php echo date("Y") ?>)</span>
	<span>Development and Design by <a href="http://bramvandenberg.com/" target="_blank">Bram van den Berg</a> and <a href="http://robinscholz.com/" target="_blank">Robin Scholz</a></span>
	<span>Typeface by <a href="http://abcdinamo.com/" target="_blank">Dinamo</a></span>
</div>

</div>

<?php snippet('footer') ?>