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

	$form = "<form id='signup' class='mailform' action='' method='post'>";
	$form .= "<input class='email' type='text' name='email' placeholder='Newsletter'>";
	$form .= "<input type='submit' name='submit' value='Subscribe'>";
	$form .= "</form>";

	echo $form; 

	if(isset($_POST['submit'])){
	    $email = email(array(
			'to'      => 'rbnschlz@gmail.com',
			'from'    => $_POST['email'],
			'subject' => 'Newsletter Subscription',
			'body'    => 'Please add ' . $_POST['email'] . ' to the list of subscribers'
		));

		if($email->send()) {
			echo "<span class='subscribed'>You are now subscribed.</span>";
		} else {
			// echo $email->error()->message();
		}
	}


// if(!isset($_POST['submit'])) {
// }

?>
	

</div>

<?php snippet('footer') ?>