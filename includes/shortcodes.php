<?php

/**
 * This is file for all of your custom shortcodes for the project
 */

/**
 * Button Shortcode
 *
 * @param array $atts
 * @param string $content
 * @return void
 */

function button_shortcode($atts, $content = null) {

	$buttonType['default'] = "text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800";
	$buttonType['dark'] = "text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700";
	$buttonType['light'] = "text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700";
	$buttonType['green'] = "focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800";
	$buttonType['red'] = "focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900";

	$classList = array_key_exists($atts['type'], $buttonType) ? $buttonType[$atts['type']]: $buttonType['default'];

	$atts['target'] = isset($atts['target']) ? $atts['target'] : '_self';

	return '<a data-type="' . $atts['type']. '" type="button" class="' . $classList . '" href="' . $atts['link'] . '" target="' . $atts['target'] . '">' . $content . '</a>';
}

add_shortcode('button', 'button_shortcode');
