<?php

/**
 * Plugin Name:       Elegent Test
 * Description:       Test Project
 * Version:           1.0.0
 * Requires at least: 6.3
 * Requires PHP:      8.2
 * Author:            Nasif Muquarrabin
 * Author URI:        https://nasifmuquarrabin.live
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 */

// Use prefix "test" everywhere in the plugin for security and compatibility


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

/**
 * The code that runs during plugin activation.
 */
register_activation_hook( __FILE__, 'activate_test' );
function activate_test() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/TestActivator.php';
    TestActivator::activate();
}

/**
 * The code that runs during plugin deactivation.
 */
register_deactivation_hook( __FILE__, 'deactivate_test' );
function deactivate_test() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/TestDeactivator.php';
    TestDeactivator::deactivate();
}

// Autoloads files load
$classes = glob(plugin_dir_path( __FILE__ ).'autoload/*.php');
if ($classes) {
    foreach ($classes as $class) {
        require_once $class;
    }
}

// Controller files load
$controllers = glob(plugin_dir_path( __FILE__ ).'controller/*.php');
if ($controllers) {
    foreach ($controllers as $controller) {
        require_once $controller;
    }
}