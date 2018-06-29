<?php
/**
 * Plugin Name:       CSS Lightbox - Altibox
 * Plugin URI:        http://www.alticreation.com/en/altibox/
 * Description:       Altibox is a lightweight and clean image viewer for WordPress.
 * Version:           0.2
 * Author:            Alexis Blondin
 * Author URI:        http://www.alticreation.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       altibox
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

function activate_altibox() {

	require_once plugin_dir_path( __FILE__ ) . 'includes/class-altibox.php';
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-altibox-activator.php';
	$activation = new Altibox_Activator();
	$activation->run();

}

function deactivate_altibox() {

	// require_once plugin_dir_path( __FILE__ ) . 'admin/class-altibox-admin.php';
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-altibox-deactivator.php';
	$deactivation = new Altibox_Deactivator();
	$deactivation->run();

}

register_activation_hook( __FILE__, 'activate_altibox' );
register_deactivation_hook( __FILE__, 'deactivate_altibox' );

require plugin_dir_path( __FILE__ ) . 'includes/class-altibox.php';

$plugin = new Altibox();
$plugin->run();
