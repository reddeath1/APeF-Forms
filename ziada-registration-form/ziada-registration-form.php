<?php
/**
 * Plugin Name:       Ziada
 * Plugin URI:        https://owesis.com/ziada
 * Description:       A multi-step registration form for Ziada.
 * Version:           4.0.0
 * Author:            Frank Galos
 * Author URI:        https://owesis.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       ziada-reg-form
 */

if ( ! defined( 'WPINC' ) ) die;

define( 'ZIADA_REG_FORM_VERSION', '4.0.0' );

function activate_ziada_registration_form() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-ziada-registration-form-activator.php';
    Ziada_Registration_Form_Activator::activate();
}
register_activation_hook( __FILE__, 'activate_ziada_registration_form' );

require plugin_dir_path( __FILE__ ) . 'includes/class-ziada-registration-form.php';

function run_ziada_registration_form() {
    $plugin = new Ziada_Registration_Form();
    $plugin->run();
}
run_ziada_registration_form();