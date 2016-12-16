<?php

/*

---------------------------------------
License Setup
---------------------------------------

Please add your license key, which you've received
via email after purchasing Kirby on http://getkirby.com/buy

It is not permitted to run a public website without a
valid license key. Please read the End User License Agreement
for more information: http://getkirby.com/license

*/

c::set('license', 'K2-PRO-b2c43ec4771aa32b0405abaa12f836b2');
c::set('debug', true);

kirby()->hook(['panel.page.create', 'panel.page.update'], function($page) {
	$values = Array("5","-5","10","-10","30","-45");
	$item = $values[array_rand($values)];

    if($page->rotateangle()->empty()) $page->update(array('rotateangle' => $item));
});

/*

---------------------------------------
Kirby Configuration
---------------------------------------

By default you don't have to configure anything to
make Kirby work. For more fine-grained configuration
of the system, please check out http://getkirby.com/docs/advanced/options

*/