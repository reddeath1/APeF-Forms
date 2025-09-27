<?php
/**
 * Plugin Name:       Ziada
 * Plugin URI:        https://owesis.com/ziada
 * Description:       A multi-step registration form for APEF.
 * Version:           1.0.0
 * Author:            Frank Galos
 * Author URI:        https://owesis.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       ziada-reg-form
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) die;

define( 'ZIADA_REG_FORM_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 */
function activate_ziada_registration_form() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-ziada-registration-form-activator.php';
    Ziada_Registration_Form_Activator::activate();
}
register_activation_hook( __FILE__, 'activate_ziada_registration_form' );

/**
 * The core plugin class.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-ziada-registration-form.php';

/**
 * Begins execution of the plugin.
 */
function run_ziada_registration_form() {
    $plugin = new Ziada_Registration_Form();
    $plugin->run();
}
run_ziada_registration_form();