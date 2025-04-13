<?php
/**
 * This is file for all of your custom shortcodes for the project
 */


define('THEME_DIR', get_stylesheet_directory());

require_once THEME_DIR . '/vendor/autoload.php';

use Dotenv\Dotenv;

// Load environment variables from .env
$dotenv_path = get_stylesheet_directory();
if (file_exists($dotenv_path . '/.env')) {
	// Create and load your .env
	$dotenv = Dotenv::createImmutable($dotenv_path);
	$dotenv->load();
}

if (! function_exists('mini_wp_enqueue_scripts')) {
	function mini_wp_enqueue_scripts() {
		wp_deregister_script('jquery');

		$manifestPath = get_theme_file_path('dist/.vite/manifest.json');

		// Attempt to read from environment variable
		$dev_server_url =  $_ENV['WP_SITE_URL'];

		$theme_version  = '1.0.0';
		$prod_js        = THEME_DIR . '/dist/assets/main.js';
		$prod_css       = THEME_DIR . '/dist/assets/main.css';

		// Check if Vite dev server is running
		$is_dev = false;
		$parsed_url = parse_url($dev_server_url);
		$host = $parsed_url['host'];
		$port = $parsed_url['port'] ?? '3000';

		$connection = @fsockopen($host, $port);
		if ($connection) {
			$is_dev = true;
			fclose($connection);
		}

		if ($is_dev) {
			// DEV MODE
			// Manually inject Vite HMR client & main.js in the head
			add_action('wp_head', function () use ($dev_server_url) {
				// 1) The Vite HMR client
				echo '<script type="module" src="' . $dev_server_url . '/@vite/client"></script>';
				// 2) Your main.js entry
				echo '<script type="module" src="' . $dev_server_url . '/main.js"></script>';
			});
		} elseif (file_exists($manifestPath)) {

			$manifest = json_decode(file_get_contents($manifestPath), true);

			wp_enqueue_script('main-js', get_theme_file_uri('dist/' . $manifest['main.js']['file']), ['jquery'], null, true);
			wp_enqueue_style('style-css', get_theme_file_uri('dist/' . $manifest['../scss/style.scss']['file']), [], null);

			// // PRODUCTION MODE
			// wp_enqueue_script(
			// 	'main-js',
			// 	$prod_js,
			// 	[],
			// 	$theme_version,
			// 	true
			// );
			// wp_enqueue_style(
			// 	'main-css',
			// 	$prod_css,
			// 	[],
			// 	$theme_version
			// );
		}
	}
}
add_action('wp_enqueue_scripts', 'mini_wp_enqueue_scripts');
