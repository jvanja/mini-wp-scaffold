<?php

/**
 * This is file for all of your custom shortcodes for the project
 */
define('THEME_DIR', get_stylesheet_directory());

require_once get_stylesheet_directory() . '/vendor/autoload.php';

use Dotenv\Dotenv;

// Load environment variables from .env
if (file_exists(THEME_DIR . '/.env')) {
  // Create and load your .env
  $dotenv = Dotenv::createImmutable(THEME_DIR);
  $dotenv->load();
}

if (! function_exists('mini_wp_enqueue_scripts')) {
  function mini_wp_enqueue_scripts() {
    wp_deregister_script('jquery');

    $manifestPath = get_theme_file_path('dist/.vite/manifest.json');

    // Attempt to read from environment variable
    $dev_server_url =  $_ENV['WP_SITE_URL'];

    $theme_version  = '1.0.0';

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
      // PRODUCTION MODE

      $manifest = json_decode(file_get_contents($manifestPath), true);

      $prod_js        = get_theme_file_uri('dist/' . $manifest['main.js']['file']);
      $prod_css       = get_theme_file_uri('dist/' . $manifest['../scss/style.scss']['file']);

      wp_enqueue_script('main', $prod_js, [], $theme_version, [
        'strategy'  => 'defer',
        'in_footer' => true
      ]);
      wp_enqueue_style('main', $prod_css, [], $theme_version);
    }
  }
}
add_action('wp_enqueue_scripts', 'mini_wp_enqueue_scripts');
