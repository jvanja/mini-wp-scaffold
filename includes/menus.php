<?php

/**
 * Register nav menus
 *
 * @return void
 */

function mini_wp_register_nav_menus() {
	register_nav_menus([
		'header' => 'Header',
		'footer' => 'Footer',
	]);
}

add_action('after_setup_theme', 'mini_wp_register_nav_menus', 0);
