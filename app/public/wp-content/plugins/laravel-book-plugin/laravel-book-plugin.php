<?php

/**
 * Plugin Name: Laravel Book Plugin
 * Description: Plugin to call a laravel API for more book data.
 * Version: 1.0.0
 * Text Domain: options-plugin
 * @author dcjohnson <johnson.daisyc@gmail.com>
 */

if (!defined('ABSPATH')) {
    die('Be gone from here.');
}

if (!class_exists('LaravelBookPlugin')) {
    class LaravelBookPlugin {
        public function __construct()
        {
            define('MY_PLUGIN_PATH', plugin_dir_path( __FILE__));
            define('LARAVEL_API', 'books.local/api');
            // require_once MY_PLUGIN_PATH . '/vendor/autoload';
        }

        public function intiialize()
        {
            include_once MY_PLUGIN_PATH . 'includes/utilities.php';
        }
    }

    $bookAPI = new LaravelBookPlugin;
    $bookAPI->intiialize();
}