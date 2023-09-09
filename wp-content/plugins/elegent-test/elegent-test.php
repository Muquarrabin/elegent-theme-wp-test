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

define( 'LARAVEL_URL', 'http://127.0.0.1:8000' );

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
        require_once wp_normalize_path($class);
    }
}

// Controller files load
$controllers = glob(plugin_dir_path( __FILE__ ).'controller/*.php');
if ($controllers) {

    foreach ($controllers as $controller) {
        require_once wp_normalize_path($controller);
    }
}

function add_button_to_user_profile($user) {
    $custom_meta_value = get_user_meta($user->ID, 'is_imported', true);

    if ($custom_meta_value) {
        echo '<h3>Laravel Dashboard</h3>';
        echo '<a class="button-primary" href="'.LARAVEL_URL.'/customer-details/'.$user->user_email.'" target="_blank">Laravel Details</a>';
    }
}

add_action('show_user_profile', 'add_button_to_user_profile');
add_action('edit_user_profile', 'add_button_to_user_profile');




